<?php

namespace App\Http\Controllers;

use App\Models\CourseGroup;
use App\Models\Forms;
use App\Models\GroupChat;
use Cart;
use Firebase\JWT\JWT;
use Stripe\Charge;
use Stripe\Stripe;
use App\Models\Blog;
use App\Models\Rate;
use App\Models\Type;
use Stripe\Customer;
use App\Models\Bundle;
use App\Models\Course;
use App\Models\Review;
use App\Models\Category;
use App\Models\CourseLocation;
use App\Models\Banner;
use App\Models\Testimonial;
use App\Models\Location;
use App\Models\Result;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Session;
use App\Http\Controllers\Traits\CheckUserFillData;
use App\Mail\InviteFriend;
use App\Models\Guest;
use App\Models\Invitation;
use App\Models\Landing_color;
use App\Models\Sponsor;
use App\Models\Client;
use App\Models\Lesson;
use Carbon\Carbon;

class CoursesController extends Controller
{

    private $path;
    use CheckUserFillData;
    public function __construct()
    {
        $path = 'frontend';

        $this->path = $path;
    }

    public function all()
    {
        \DB::enableQueryLog();
        $courses = Course::Where('published', 1)
            ->withoutGlobalScope('filter');

        if (request('dates')) {
            $start = date("Y-m-d", strtotime("now"));
            $end = date("Y-m-d", strtotime("now + " . request('dates')));
            $courses =  $courses->whereHas('groups', function ($q) use ($start, $end) {
                //dates between start and end
                $q->whereDate('start', '>=', $start)->whereDate('end', '<=', $end);
            });
        }

        if (request('category')) {
            $category = Category::where('slug', '=', request('category'))
                ->where('status', '=', 1)
                ->first();

            $courses = $courses->where('category_id', $category->id);
        }

        if (request('type')) {

            $courses = $courses->where('type_id', request('type'));
        }

        if (request('location')) {
            $courses = $courses->whereHas('groups' , function ($q) {
                $q->where('location_id', request('location'));
            });
        }



        if (request('key')) {
            $courses = $courses->where(function ($query) {
                $query->where('title', 'like', '%' . request('key') . '%')
                    ->orWhere('title_ar', 'like', '%' . request('key') . '%')
                    ->orWhere('description', 'like', '%' . request('key') . '%')
                    ->orWhere('description_ar', 'like', '%' . request('key') . '%');
            });
        }

        if (request('type') == 'popular') {
            $courses = $courses->where('popular', '=', 1);
        } else if (request('type') == 'trending') {
            $courses = $courses->where('trending', '=', 1);
        } else if (request('type') == 'featured') {
            $courses = $courses->where('featured', '=', 1);
        }
        $courses = $courses->paginate(9);

        $purchased_courses = NULL;
        $purchased_bundles = NULL;
        $categories = Category::where('status', '=', 1)->get();
        $coursesTypes = (session('locale') == 'en') ? Type::get()->pluck('name', 'id')->toArray() : Type::get()->pluck('name_ar', 'id')->toArray();


        if (\Auth::check()) {
            $purchased_courses = Course::withoutGlobalScope('filter')->whereHas('students', function ($query) {
                $query->where('id', \Auth::id());
            })
                ->with('lessons')
                ->orderBy('id', 'desc')
                ->get();
        }
        $featured_courses = Course::withoutGlobalScope('filter')->where('published', '=', 1)
            ->where('featured', '=', 1)->take(8)->get();

        $recent_news = Blog::orderBy('created_at', 'desc')->take(2)->get();
        $type = 'App\Models\Course';

        if (app()->getLocale() == "ar") {
            $locations = Location::all()->pluck('name_ar', 'id');
        } else {
            $locations = Location::all()->pluck('name', 'id');
        }
//        dd($courses);

        return view($this->path . '.courses.index', compact('courses', 'locations', 'type', 'coursesTypes', 'purchased_courses', 'recent_news', 'featured_courses', 'categories'));
    }

    function base64url_encode($str) {
        return rtrim(strtr(base64_encode($str), '+/', '-_'), '=');
    }

    private function generateSignature($sdk_key, $api_secret, $meeting_number, $role)
    {
        $time = time() - 30;
        $exp = $time + 3600 * 2;
        $token = array(
            "sdkKey" => $sdk_key,
            "mn" => $meeting_number,
            "role" => $role,
            "iat" => $time,
            "exp" => $exp, //60 seconds as suggested
            'appKey' => $sdk_key,
            "tokenExp" => $exp,
        );
        $headers = array(
            'alg' => 'HS256', //alg is required
            'typ' => 'JWT'
        );
        $headers_encoded = $this->base64url_encode(json_encode($headers));

        $payload_encoded = $this->base64url_encode(json_encode($token));

        $signature = hash_hmac('SHA256', "$headers_encoded.$payload_encoded", $api_secret, true);

        $signature_encoded = $this->base64url_encode($signature);

        $jwt = "$headers_encoded.$payload_encoded.$signature_encoded";

        return $jwt;
    }

    public function show($course_slug)
    {
        session()->put('previous_course_page', url()->current());
        $continue_course = NULL;
        $recent_news = Blog::orderBy('created_at', 'desc')->take(2)->get();
        $course = Course::withoutGlobalScope('filter')->where('slug', $course_slug)->with('publishedLessons')->firstOrFail();

        $purchased_course = \Auth::check() && $course->students()->where('user_id', \Auth::id())->count() > 0;
        if (($course->published == 0) && ($purchased_course == false)) {
            abort(404);
        }
        $course_rating = 0;
        $total_ratings = 0;
        $completed_lessons = "";
        $is_reviewed = false;
        if (auth()->check() && $course->reviews()->where('user_id', '=', auth()->user()->id)->first()) {
            $is_reviewed = true;
        }
        if ($course->reviews->count() > 0) {
            $course_rating = $course->reviews->avg('rating');
            $total_ratings = $course->reviews()->where('rating', '!=', "")->get()->count();
        }
         $lessons = $course->courseTimeline()->orderby('sequence', 'asc')->get();

        if (\Auth::check()) {

            $completed_lessons = \Auth::user()->chapters()->where('course_id', $course->id)->get()->pluck('model_id')->toArray();
            $course_lessons = $course->lessons->pluck('id')->toArray();

            $course_tests = ($course->tests) ? $course->tests->pluck('id')->toArray() : [];

            $course_lessons = array_merge($course_lessons, $course_tests);
            // $continue_course  = $course->courseTimeline()
            //     ->whereIn('model_id', $course_lessons)
            //     ->orderby('sequence', 'asc')
            //     ->whereNotIn('model_id', $completed_lessons)

            // ->first();
            $continue_course  = $course->courseTimeline()
                ->whereIn('model_id', $course_lessons)
                ->orderby('sequence', 'asc')


                ->first();
            if ($continue_course == null) {
                $continue_course = $course->courseTimeline()
                    ->whereIn('model_id', $course_lessons)
                    ->orderby('sequence', 'asc')->first();
            }
        }
        // get course rate questions///
        $rates = $course->forms()->where('form_type', 'rate')->get();

        $student_exist_on_course = @$course->students->contains(auth()->user()->id);

        // old query if found it comment
        $student_featured_courses = Course::withoutGlobalScope('filter')->where('published', '=', 1)->where('featured', '=', 1)->where('category_id', $course->category_id)->take(3)->get();

        // this new query to get @islam
        $student_featured_courses = Course::withoutGlobalScope('filter')->where('published', '=', 1)->where('category_id', $course->category_id)->take(3)->get();

        // this query was runed
        // $student_featured_courses = Course::withoutGlobalScope('filter')->where('published', '=', 1)
        // ->where('category_id',$course->category_id)
        // ->whereHas('locations',function ($q){

        //     $q->whereDate('end_date', '>=', Carbon::now())->orWhereNull('end_date');
        //     })
        // ->take(3)->get();

        $student_trending_courses = Course::withoutGlobalScope('filter')->where('published', '=', 1)->where('trending', '=', 1)->take(6)->get();
        $pdf = $course->mediaPdf;
        $courseMain = $course;

        $course_forms_rate_ids = $course->forms()->where('form_type', 'rate')->pluck('course_forms.id')->toArray();
        $rateResults = Result::whereIn('course_forms_id', $course_forms_rate_ids)->get();
        $sum = 0;
        $count = 0;
        // foreach ($rateResults as $key => $result) {
        //     # code...
        //     $sum += $result->answers()->sum('answer');

        //     $count += count($result->answers()->get());
        // }
        // $AllRateResult = $count > 0 ? number_format($sum / $count, 1) : 0;
        // $courseLocations = CourseLocation::where('course_id', $course->id)->get();

        $groups = $course->groups;
        $courseLocations = $groups->map(function ($group) {
            return $group;
        });
        if (auth()->check()) {
            $IsUserFilledData = $this->IsUserFilledData();
        } else {
            $IsUserFilledData = false;
        }
        // dd($course->chapters()->orderBy('sequence', 'asc')->get());

//        $lastCourseLocationsChaptersIds = Lesson::where('course_id', $course->id)->whereHas('courseLocations', function ($qq) use ($last) {
//            $qq->where('lesson_course_location.course_location_id', $last->id);
//        })->get()->pluck('chapter_id')->toArray();

        //course lessons
        $lessons = $course->courseTimeline()->orderby('sequence', 'asc')->get();


        $chapters = $course->chapters()->orderBy('sequence', 'asc')->get();



        return view($this->path . '.courses.course', compact('course', 'pdf', 'courseMain', 'purchased_course', 'recent_news', 'course_rating', 'completed_lessons', 'total_ratings', 'is_reviewed', 'continue_course', 'student_featured_courses', 'student_trending_courses', 'rates', 'student_exist_on_course', 'IsUserFilledData', 'lessons', 'chapters', 'groups'));
    }

    public function landing($course_slug)
    {

        $continue_course = NULL;
        $recent_news = Blog::orderBy('created_at', 'desc')->take(2)->get();
        $course = Course::withoutGlobalScope('filter')->where('slug', $course_slug)->with('publishedLessons')->firstOrFail();
        $banners = Banner::where('course_id', $course->id)->get();
        $testimonials = Testimonial::where('course_id', $course->id)->get();


        $purchased_course = \Auth::check() && $course->students()->where('user_id', \Auth::id())->count() > 0;
        if (($course->published == 0) && ($purchased_course == false)) {
            abort(404);
        }
        $course_rating = 0;
        $total_ratings = 0;
        $completed_lessons = "";
        $is_reviewed = false;
        if (auth()->check() && $course->reviews()->where('user_id', '=', auth()->user()->id)->first()) {
            $is_reviewed = true;
        }
        if ($course->reviews->count() > 0) {
            $course_rating = $course->reviews->avg('rating');
            $total_ratings = $course->reviews()->where('rating', '!=', "")->get()->count();
        }
        $lessons = $course->courseTimeline()->orderby('sequence', 'asc')->get();

        if (\Auth::check()) {

            $completed_lessons = \Auth::user()->chapters()->where('course_id', $course->id)->get()->pluck('model_id')->toArray();
            $course_lessons = $course->lessons->pluck('id')->toArray();

            $course_tests = ($course->tests) ? $course->tests->pluck('id')->toArray() : [];

            $course_lessons = array_merge($course_lessons, $course_tests);
            // $continue_course  = $course->courseTimeline()
            //     ->whereIn('model_id', $course_lessons)
            //     ->orderby('sequence', 'asc')
            //     ->whereNotIn('model_id', $completed_lessons)

            // ->first();
            $continue_course  = $course->courseTimeline()
                ->whereIn('model_id', $course_lessons)
                ->orderby('sequence', 'asc')


                ->first();
            if ($continue_course == null) {
                $continue_course = $course->courseTimeline()
                    ->whereIn('model_id', $course_lessons)
                    ->orderby('sequence', 'asc')->first();
            }
        }
        // get course rate questions///
        $rates = $course->forms()->where('form_type', 'rate')->get();
        // ////////////////////////////
        $blogs = Blog::has('category')->OrderBy('created_at', 'desc')->where('category_id',$course->category_id)->paginate(6);
        $student_exist_on_course = @$course->students->contains(auth()->user()->id);
        ////////////////////////

        // $student_featured_courses = Course::withoutGlobalScope('filter')->where('published', '=', 1)->where('featured', '=', 1)->where('category_id',$course->category_id)->take(3)->get();
        $student_featured_courses = Course::withoutGlobalScope('filter')->where('published', '=', 1)->where('category_id', $course->category_id)
            ->whereHas('locations', function ($q) {

                $q->whereDate('end_date', '>=', Carbon::now())->orWhereNull('end_date');
            })
            ->take(3)->get();

        $student_trending_courses = Course::withoutGlobalScope('filter')->where('published', '=', 1)->where('trending', '=', 1)->take(6)->get();
        $pdf = $course->mediaPdf;
        $courseMain = $course;

        $course_forms_rate_ids = $course->forms()->where('form_type', 'rate')->pluck('course_forms.id')->toArray();
        $rateResults = Result::whereIn('course_forms_id', $course_forms_rate_ids)->get();
        $sum = 0;
        $count = 0;
        foreach ($rateResults as $key => $result) {
            # code...
            $sum += $result->answers()->sum('answer');

            $count += count($result->answers()->get());
        }
        $AllRateResult = $count > 0 ? number_format($sum / $count, 1) : 0;
        $courseLocations = CourseLocation::where('course_id', $course->id)->get();
        if (auth()->check()) {
            $IsUserFilledData = $this->IsUserFilledData();
        } else {
            $IsUserFilledData = false;
        }

        return view($this->path . '.courses.landing', compact('testimonials', 'banners', 'course', 'pdf', 'courseMain', 'purchased_course', 'recent_news', 'course_rating', 'completed_lessons', 'total_ratings', 'is_reviewed', 'lessons', 'continue_course', 'student_featured_courses', 'student_trending_courses', 'rates', 'blogs', 'student_exist_on_course', 'AllRateResult', 'courseLocations', 'IsUserFilledData'));
    }

    public function landing2($course_slug)
    {

        $continue_course = NULL;
        $recent_news = Blog::orderBy('created_at', 'desc')->take(2)->get();
        $course = Course::withoutGlobalScope('filter')->where('slug', $course_slug)->with('publishedLessons')->firstOrFail();
        $banners = Banner::where('course_id', $course->id)->get();
        $testimonials = Testimonial::where('course_id', $course->id)->get();


        $purchased_course = \Auth::check() && $course->students()->where('user_id', \Auth::id())->count() > 0;
        if (($course->published == 0) && ($purchased_course == false)) {
            abort(404);
        }
        $course_rating = 0;
        $total_ratings = 0;
        $completed_lessons = "";
        $is_reviewed = false;
        if (auth()->check() && $course->reviews()->where('user_id', '=', auth()->user()->id)->first()) {
            $is_reviewed = true;
        }
        if ($course->reviews->count() > 0) {
            $course_rating = $course->reviews->avg('rating');
            $total_ratings = $course->reviews()->where('rating', '!=', "")->get()->count();
        }
        $lessons = $course->courseTimeline()->orderby('sequence', 'asc')->get();

        if (\Auth::check()) {

            $completed_lessons = \Auth::user()->chapters()->where('course_id', $course->id)->get()->pluck('model_id')->toArray();
            $course_lessons = $course->lessons->pluck('id')->toArray();

            $course_tests = ($course->tests) ? $course->tests->pluck('id')->toArray() : [];

            $course_lessons = array_merge($course_lessons, $course_tests);
            // $continue_course  = $course->courseTimeline()
            //     ->whereIn('model_id', $course_lessons)
            //     ->orderby('sequence', 'asc')
            //     ->whereNotIn('model_id', $completed_lessons)

            // ->first();
            $continue_course  = $course->courseTimeline()
                ->whereIn('model_id', $course_lessons)
                ->orderby('sequence', 'asc')


                ->first();
            if ($continue_course == null) {
                $continue_course = $course->courseTimeline()
                    ->whereIn('model_id', $course_lessons)
                    ->orderby('sequence', 'asc')->first();
            }
        }
        // get course rate questions///
        $rates = $course->forms()->where('form_type', 'rate')->get();
        // ////////////////////////////
        $blogs = Blog::has('category')->OrderBy('created_at', 'desc')->where('category_id',$course->category_id)->paginate(6);
        $student_exist_on_course = @$course->students->contains(auth()->user()->id);
        ////////////////////////
        // $student_featured_courses = Course::withoutGlobalScope('filter')->where('published', '=', 1)->where('featured', '=', 1)->where('category_id',$course->category_id)->take(3)->get();
        $student_featured_courses = Course::withoutGlobalScope('filter')->where('published', '=', 1)->where('category_id', $course->category_id)
            ->whereHas('locations', function ($q) {

                $q->whereDate('end_date', '>=', Carbon::now())->orWhereNull('end_date');
            })
            ->take(3)->get();
        $student_trending_courses = Course::withoutGlobalScope('filter')->where('published', '=', 1)->where('trending', '=', 1)->take(6)->get();
        $pdf = $course->mediaPdf;
        $courseMain = $course;

        $course_forms_rate_ids = $course->forms()->where('form_type', 'rate')->pluck('course_forms.id')->toArray();
        $rateResults = Result::whereIn('course_forms_id', $course_forms_rate_ids)->get();
        $sum = 0;
        $count = 0;
        foreach ($rateResults as $key => $result) {
            # code...
            $sum += $result->answers()->sum('answer');

            $count += count($result->answers()->get());
        }
        $AllRateResult = $count > 0 ? number_format($sum / $count, 1) : 0;
        $courseLocations = CourseLocation::where('course_id', $course->id)->get();
        if (auth()->check()) {
            $IsUserFilledData = $this->IsUserFilledData();
        } else {
            $IsUserFilledData = false;
        }
        // *****************

        // get page color
        $Landing_color = Landing_color::find(1);

        $sponsers = Sponsor::get();

        $clients = Client::where('status', '=', 1)->get();
        // ***************
        return view($this->path . '.courses.landing2', compact('clients', 'sponsers', 'Landing_color', 'testimonials', 'banners', 'course', 'pdf', 'courseMain', 'purchased_course', 'recent_news', 'course_rating', 'completed_lessons', 'total_ratings', 'is_reviewed', 'lessons', 'continue_course', 'student_featured_courses', 'student_trending_courses', 'rates', 'blogs', 'student_exist_on_course', 'AllRateResult', 'courseLocations', 'IsUserFilledData'));
    }
    public function landing3($course_slug)
    {

        $continue_course = NULL;
        $recent_news = Blog::orderBy('created_at', 'desc')->take(2)->get();
        $course = Course::withoutGlobalScope('filter')->where('slug', $course_slug)->with('publishedLessons')->firstOrFail();
        $banners = Banner::where('course_id', $course->id)->get();
        $testimonials = Testimonial::where('course_id', $course->id)->get();


        $purchased_course = \Auth::check() && $course->students()->where('user_id', \Auth::id())->count() > 0;
        if (($course->published == 0) && ($purchased_course == false)) {
            abort(404);
        }
        $course_rating = 0;
        $total_ratings = 0;
        $completed_lessons = "";
        $is_reviewed = false;
        if (auth()->check() && $course->reviews()->where('user_id', '=', auth()->user()->id)->first()) {
            $is_reviewed = true;
        }
        if ($course->reviews->count() > 0) {
            $course_rating = $course->reviews->avg('rating');
            $total_ratings = $course->reviews()->where('rating', '!=', "")->get()->count();
        }
        $lessons = $course->courseTimeline()->orderby('sequence', 'asc')->get();

        if (\Auth::check()) {

            $completed_lessons = \Auth::user()->chapters()->where('course_id', $course->id)->get()->pluck('model_id')->toArray();
            $course_lessons = $course->lessons->pluck('id')->toArray();

            $course_tests = ($course->tests) ? $course->tests->pluck('id')->toArray() : [];

            $course_lessons = array_merge($course_lessons, $course_tests);
            // $continue_course  = $course->courseTimeline()
            //     ->whereIn('model_id', $course_lessons)
            //     ->orderby('sequence', 'asc')
            //     ->whereNotIn('model_id', $completed_lessons)

            // ->first();
            $continue_course  = $course->courseTimeline()
                ->whereIn('model_id', $course_lessons)
                ->orderby('sequence', 'asc')


                ->first();
            if ($continue_course == null) {
                $continue_course = $course->courseTimeline()
                    ->whereIn('model_id', $course_lessons)
                    ->orderby('sequence', 'asc')->first();
            }
        }
        // get course rate questions///
        $rates = $course->forms()->where('form_type', 'rate')->get();
        // ////////////////////////////
        $blogs = Blog::has('category')->OrderBy('created_at', 'desc')->where('category_id',$course->category_id)->paginate(6);
        $student_exist_on_course = @$course->students->contains(auth()->user()->id);
        ////////////////////////
        // $student_featured_courses = Course::withoutGlobalScope('filter')->where('published', '=', 1)->where('featured', '=', 1)->take(3)->get();
        $student_featured_courses = Course::withoutGlobalScope('filter')->where('published', '=', 1)->where('category_id', $course->category_id)
            ->whereHas('locations', function ($q) {

                $q->whereDate('end_date', '>=', Carbon::now())->orWhereNull('end_date');
            })
            ->take(3)->get();
        $student_trending_courses = Course::withoutGlobalScope('filter')->where('published', '=', 1)->where('trending', '=', 1)->take(6)->get();

        $student_trending_courses = Course::withoutGlobalScope('filter')->where('published', '=', 1)->where('trending', '=', 1)->take(6)->get();
        $pdf = $course->mediaPdf;
        $courseMain = $course;

        $course_forms_rate_ids = $course->forms()->where('form_type', 'rate')->pluck('course_forms.id')->toArray();
        $rateResults = Result::whereIn('course_forms_id', $course_forms_rate_ids)->get();
        $sum = 0;
        $count = 0;
        foreach ($rateResults as $key => $result) {
            # code...
            $sum += $result->answers()->sum('answer');

            $count += count($result->answers()->get());
        }
        $AllRateResult = $count > 0 ? number_format($sum / $count, 1) : 0;
        $courseLocations = CourseLocation::where('course_id', $course->id)->get();
        if (auth()->check()) {
            $IsUserFilledData = $this->IsUserFilledData();
        } else {
            $IsUserFilledData = false;
        }
        // *****************



        $sponsors = Sponsor::where('status', '=', 1)->get();

        $clients = Client::where('status', '=', 1)->get();

        // ***************
        return view($this->path . '.courses.landing2-new', compact('sponsors', 'clients', 'testimonials', 'banners', 'course', 'pdf', 'courseMain', 'purchased_course', 'recent_news', 'course_rating', 'completed_lessons', 'total_ratings', 'is_reviewed', 'lessons', 'continue_course', 'student_featured_courses', 'student_trending_courses', 'rates', 'blogs', 'student_exist_on_course', 'AllRateResult', 'courseLocations', 'IsUserFilledData'));
    }
    public function rating($course_id, Request $request)
    {
        $course = Course::findOrFail($course_id);
        $course->students()->updateExistingPivot(\Auth::id(), ['rating' => $request->get('rating')]);

        return redirect()->back()->with('success', 'Thank you for rating.');
    }

    public function getByCategory(Request $request)
    {
        $category = Category::where('slug', '=', $request->category)
            ->where('status', '=', 1)
            ->first();
        $categories = Category::where('status', '=', 1)->get();

        if ($category != "") {
            $recent_news = Blog::orderBy('created_at', 'desc')->take(2)->get();
            $featured_courses = Course::where('published', '=', 1)
                ->where('featured', '=', 1)->take(8)->get();

            if (request('type') == 'popular') {
                $courses = $category->courses()->withoutGlobalScope('filter')->where('published', 1)->where('popular', '=', 1)->orderBy('id', 'desc')->paginate(9);
            } else if (request('type') == 'trending') {
                $courses = $category->courses()->withoutGlobalScope('filter')->where('published', 1)->where('trending', '=', 1)->orderBy('id', 'desc')->paginate(9);
            } else if (request('type') == 'featured') {
                $courses = $category->courses()->withoutGlobalScope('filter')->where('published', 1)->where('featured', '=', 1)->orderBy('id', 'desc')->paginate(9);
            } else {
                $courses = $category->courses()->withoutGlobalScope('filter')->where('published', 1)->orderBy('id', 'desc')->paginate(9);
            }

            // $coursesTypes = (session('locale') == 'en')?Type::get()->pluck('name','id')->toArray():Type::get()->pluck('name_ar','id')->toArray();

            // if(app()->getLocale()=="ar"){
            //     $locations = Location::all()->pluck('name_ar', 'id')->prepend('...اختر موقع الدورة','');

            // }
            // else{
            //     $locations = Location::all()->pluck('name', 'id')->prepend('choose course location...','');

            // }

            return view($this->path . '.courses.index', compact('courses', 'category', 'recent_news', 'featured_courses', 'categories', 'coursesTypes', 'locations'));
        }
        return abort(404);
    }

    public function addReview(Request $request)
    {
        $this->validate($request, [
            'review' => 'required'
        ]);
        $course = Course::findORFail($request->id);
        $review = new Review();
        $review->user_id = auth()->user()->id;
        $review->reviewable_id = $course->id;
        $review->reviewable_type = Course::class;
        $review->rating = $request->rating;
        $review->content = $request->review;
        $review->save();

        return back();
    }

    public function editReview(Request $request)
    {
        $review = Review::where('id', '=', $request->id)->where('user_id', '=', auth()->user()->id)->first();
        if ($review) {
            $course = $review->reviewable;
            $recent_news = Blog::orderBy('created_at', 'desc')->take(2)->get();
            $purchased_course = \Auth::check() && $course->students()->where('user_id', \Auth::id())->count() > 0;
            $course_rating = 0;
            $total_ratings = 0;
            $lessons = $course->courseTimeline()->orderby('sequence', 'asc')->get();

            if ($course->reviews->count() > 0) {
                $course_rating = $course->reviews->avg('rating');
                $total_ratings = $course->reviews()->where('rating', '!=', "")->get()->count();
            }
            if (\Auth::check()) {

                $completed_lessons = \Auth::user()->chapters()->where('course_id', $course->id)->get()->pluck('model_id')->toArray();
                $continue_course  = $course->courseTimeline()->orderby('sequence', 'asc')->whereNotIn('model_id', $completed_lessons)->first();
                if ($continue_course == "") {
                    $continue_course = $course->courseTimeline()->orderby('sequence', 'asc')->first();
                }
            }

            return view($this->path . '.courses.course', compact('course', 'purchased_course', 'recent_news', 'completed_lessons', 'continue_course', 'course_rating', 'total_ratings', 'lessons', 'review'));
        }
        return abort(404);
    }


    public function updateReview(Request $request)
    {
        $review = Review::where('id', '=', $request->id)->where('user_id', '=', auth()->user()->id)->first();
        if ($review) {
            $review->rating = $request->rating;
            $review->content = $request->review;
            $review->save();

            return redirect()->route('courses.show', ['slug' => $review->reviewable->slug]);
        }
        return abort(404);
    }

    public function deleteReview(Request $request)
    {
        $review = Review::where('id', '=', $request->id)->where('user_id', '=', auth()->user()->id)->first();
        if ($review) {
            $slug = $review->reviewable->slug;
            $review->delete();
            return redirect()->route('courses.show', ['slug' => $slug]);
        }
        return abort(404);
    }
    public function filterCourses(Request $request, $courseType = null)
    {


        $min_price = $request->from_price == null ? 0 : $request->from_price;
        $max_price = $request->to_price == null ? 0 : $request->to_price;
        $course_type = $request->type_id == null ? '' : $request->type_id;

        $startDate = $request->start_date ? $request->start_date : '';
        $request->category = $request->category ? $request->category : [];
        $model = $request->type ?? 'App\Models\Course';
        $type = $request->type ?? 'App\Models\Course';
        $location_id = $request->location_id ?? null;
        //    /////////////////
        $categories = Category::where('status', '=', 1)->get();
        $checkedCategory = $request->category;
        $coursesTypes = (session('locale') == 'en') ? Type::get()->pluck('name', 'id')->toArray() : Type::get()->pluck('name_ar', 'id')->toArray();
        if (app()->getLocale() == "ar") {
            $locations = Location::all()->pluck('name_ar', 'id')->prepend('...اختر موقع الدورة', '');
        } else {
            $locations = Location::all()->pluck('name', 'id')->prepend('choose course location...', '');
        }
        // /////////////////////
        if ($courseType != null) {

            $courses = Course::where('published', '=', 1)

                ->where('type_id', $courseType)
                ->paginate(9);
            $typeRow = Type::find($courseType);
            $typeTitle = (session('locale') == 'ar') ? $typeRow->name_ar : $typeRow->name;
            return view($this->path . '.courses.index', compact('courses', 'type', 'categories', 'typeTitle'));
        }
        // search by all filter 

        if (count($request->category) > 0 && $min_price >= 0 && $max_price > 0 && $startDate != '' && $course_type != '' && $location_id != null) {
            if ($model == 'App\Models\Bundle')
                $courses = $model::whereIn('category_id', $request->category)->where('published', '=', 1)
                    ->whereBetween('price', [$min_price - 1, $max_price + 1])
                    ->where('start_date', $startDate)
                    ->where('type_id', $course_type)

                    ->paginate(9);
            else
                $courses = $model::whereIn('category_id', $request->category)->where('published', '=', 1)


                    ->whereHas('locations', function ($q) use ($startDate, $location_id, $min_price, $max_price) {

                        $q->where('start_date', $startDate)
                            ->where('location_id', $location_id)
                            ->whereBetween('price', [$min_price - 1, $max_price + 1]);
                    })
                    ->where('type_id', $course_type)
                    ->paginate(9);
        }
        // search by price

        elseif (count($request->category) == 0 && $min_price >= 0 && $max_price > 0 && $startDate == '' && $location_id == null) {

            if ($model == 'App\Models\Bundle') {
                $courses = $model::WhereBetween('price', [$min_price - 1, $max_price + 1])
                    ->where('published', '=', 1)
                    ->paginate(9);
            } else
                $courses = $model::where('published', '=', 1)
                    ->whereHas('locations', function ($q) use ($min_price, $max_price) {

                        $q->whereBetween('price', [$min_price - 1, $max_price + 1]);
                    })
                    ->paginate(9);
        }
        // search by location

        elseif (count($request->category) == 0 && $min_price == 0 && $max_price == 0 && $startDate == '' && $course_type == '' && $location_id != null) {

            $courses = $model::where('published', '=', 1)
                ->whereHas('locations', function ($q) use ($location_id) {

                    $q->where('location_id', [$location_id]);
                })
                ->paginate(9);
        }
        // search by category

        elseif (count($request->category) > 0 && $min_price == 0 && $max_price == 0 && $startDate == '' && $course_type == '' && $location_id == null) {
            $courses = $model::whereIn('category_id', $request->category)

                ->where('published', '=', 1)
                ->paginate(9);
        }
        // search by type

        elseif (count($request->category) == 0 && $min_price == 0 && $max_price == 0 && $startDate == '' && $course_type !== '' && $location_id == null) {
            $courses = $model::where('type_id', '=', $course_type)
                ->where('published', '=', 1)
                ->paginate(9);
        }
        // search by Date
        elseif (count($request->category) == 0 && $min_price == 0 && $max_price == 0 && $startDate != '' && $location_id == null) {

            if ($model == 'App\Models\Bundle')
                $courses = $model::where('start_date', $startDate)
                    ->where('published', '=', 1)
                    ->paginate(9);
            else
                $courses = $model::whereHas('locations', function ($q) use ($startDate) {

                    $q->where('start_date', $startDate);
                })
                    ->where('published', '=', 1)
                    ->paginate(9);
        }
        // search by category and date

        elseif (count($request->category) > 0 && $min_price == 0 && $max_price == 0 && $startDate != '' && $location_id == null) {
            if ($model == 'App\Models\Bundle')
                $courses = $model::whereIn('category_id', $request->category)
                    ->where('start_date', $startDate)

                    ->where('published', '=', 1)
                    ->paginate(9);
            else
                $courses = $model::whereIn('category_id', $request->category)
                    ->whereHas('locations', function ($q) use ($startDate) {

                        $q->where('start_date', $startDate);
                    })
                    ->where('published', '=', 1)
                    ->paginate(9);
        }
        // search by category and price

        elseif (count($request->category) > 0 && $min_price >= 0 && $max_price > 0 && $startDate == '' && $location_id == null) {
            if ($model == 'App\Models\Bundle')
                $courses = $model::whereIn('category_id', $request->category)
                    ->WhereBetween('price', [$min_price - 1, $max_price + 1])
                    ->where('published', '=', 1)
                    ->paginate(9);
            else
                $courses = $model::whereIn('category_id', $request->category)

                    ->whereHas('locations', function ($q) use ($min_price, $max_price) {

                        $q->WhereBetween('price', [$min_price - 1, $max_price + 1]);
                    })
                    ->where('published', '=', 1)
                    ->paginate(9);
        }
        // search by category and location
        elseif (count($request->category) > 0 && $min_price == 0 && $max_price == 0 && $startDate == '' && $location_id != null) {

            $courses = $model::whereIn('category_id', $request->category)

                ->whereHas('locations', function ($q) use ($location_id) {

                    $q->Where('location_id', $location_id);
                })
                ->where('published', '=', 1)
                ->paginate(9);
        }

        // search by category and type

        elseif (count($request->category) > 0 && $min_price == 0 && $max_price == 0 && $startDate == '' && $course_type != '' && $location_id == null) {

            $courses = $model::whereIn('category_id', $request->category)
                ->where('type_id', '=', $course_type)
                ->where('published', '=', 1)
                ->paginate(9);
        }
        // search by date and type

        elseif (count($request->category) == 0 && $min_price == 0 && $max_price == 0 && $startDate != '' && $course_type != '' && $location_id == null) {
            if ($model == 'App\Models\Bundle')
                $courses = $model::where('start_date', $startDate)
                    ->where('type_id', '=', $course_type)
                    ->where('published', '=', 1)
                    ->paginate(9);
            else
                $courses = $model::whereHas('locations', function ($q) use ($startDate) {

                    $q->where('start_date', $startDate);
                })
                    ->where('type_id', '=', $course_type)
                    ->where('published', '=', 1)
                    ->paginate(9);
        }
        // search by price and date

        elseif (count($request->category) == 0 && $min_price >= 0 && $max_price > 0 && $startDate != '' && $location_id == null) {
            if ($model == 'App\Models\Bundle')
                $courses = $model::WhereBetween('price', [$min_price - 1, $max_price + 1])
                    ->where('start_date', $startDate)
                    ->where('published', '=', 1)
                    ->paginate(9);
            else
                $courses = $model
                    ->whereHas('locations', function ($q) use ($startDate, $min_price, $max_price) {

                        $q->where('start_date', $startDate)->WhereBetween('price', [$min_price - 1, $max_price + 1]);
                    })
                    ->where('published', '=', 1)
                    ->paginate(9);
        }
        // search by location and date

        elseif (count($request->category) == 0 && $min_price == 0 && $max_price == 0 && $startDate != '' && $location_id != null) {

            $courses = $model::whereHas('locations', function ($q) use ($startDate, $location_id) {

                $q->where('start_date', $startDate)->Where('location_id', $location_id);
            })
                ->where('published', '=', 1)
                ->paginate(9);
        }
        // search by price and type

        elseif (count($request->category) == 0 && $min_price >= 0 && $max_price > 0 && $startDate == '' && $course_type != '' && $location_id == null) {
            if ($model == 'App\Models\Bundle')
                $courses = $model::WhereBetween('price', [$min_price - 1, $max_price + 1])
                    ->where('type_id', '=', $course_type)
                    ->where('published', '=', 1)
                    ->paginate(9);
            else
                $courses = $model::whereHas('locations', function ($q) use ($min_price, $max_price) {

                    $q->WhereBetween('price', [$min_price - 1, $max_price + 1]);
                })
                    ->where('type_id', '=', $course_type)
                    ->where('published', '=', 1)
                    ->paginate(9);
        }
        // search by price and location
        elseif (count($request->category) == 0 && $min_price >= 0 && $max_price > 0 && $startDate == '' && $course_type == '' && $location_id != null) {

            $courses = $model::whereHas('locations', function ($q) use ($min_price, $max_price, $location_id) {

                $q->WhereBetween('price', [$min_price - 1, $max_price + 1])
                    ->where('location_id', $location_id);
            })
                ->where('type_id', '=', $course_type)
                ->where('published', '=', 1)
                ->paginate(9);
        }
        // search by location and type


        elseif (count($request->category) == 0 && $min_price == 0 && $max_price == 0 && $startDate == '' && $course_type != '' && $location_id != null) {

            $courses = $model::whereHas('locations', function ($q) use ($location_id) {

                $q->where('location_id', $location_id);
            })
                ->where('type_id', '=', $course_type)
                ->where('published', '=', 1)
                ->paginate(9);
        }
        // elseif(count($request->category)==0&&$min_price==0&&$max_price==0&&$startDate==''){
        else {
            $courses = $model::where('published', '=', 1)
                ->paginate(9);
        }

        //    //////////////////////////
        if ($model == 'App\Models\Course') {

            return view($this->path . '.courses.index', compact('courses', 'locations', 'coursesTypes', 'type', 'categories', 'checkedCategory', 'min_price', 'max_price', 'startDate', 'location_id'));
        } else {

            $bundles = $courses;
            $purchased_bundles = NULL;
            if (\Auth::check()) {
                $purchased_bundles = Bundle::withoutGlobalScope('filter')->whereHas('students', function ($query) {
                    $query->where('id', \Auth::id());
                })
                    ->with('courses')
                    ->orderBy('id', 'desc')
                    ->get();
            }

            return view($this->path . '.bundles.index', compact('bundles', 'coursesTypes', 'type', 'categories', 'checkedCategory', 'min_price', 'max_price', 'startDate'));
        }
        # code...
    }
    public function filterCoursesNew($request)
    {
        if ($request->dates) {
            $start = date("Y-m-d", strtotime("now"));
            $end = date("Y-m-d", strtotime("now + " . $request->dates));

            // dd("now + 1".request('dates'));
            $courses =  Course::whereHas('locations', function ($q) use ($start, $end) {
                $q->whereBetween('start_date', [$start, $end]);
            })->get();
        } elseif (request('type')) {

            $courses = Course::where('type_id', request('type'));
        } elseif (request('location')) {
            $courses = $courses->whereHas('locations', function ($q) {

                $q->where('location_id', request('location'));
            });
        }



        if (request('key')) {
            $courses->where(function ($query) {
                $query->where('title', 'like', '%' . request('key') . '%')
                    ->orWhere('title_ar', 'like', '%' . request('key') . '%')
                    ->orWhere('description', 'like', '%' . request('key') . '%')
                    ->orWhere('description_ar', 'like', '%' . request('key') . '%');
            });
        }
    }
    public function courseDetails($course_slug, $group = null)
    {
        session()->put('previous_course_page', url()->current());
        $group = CourseGroup::find(\request('group'));
        if (auth()->user() && $group) {
            $course = Course::withoutGlobalScope('filter')->where('slug', $course_slug)->with('publishedLessons')->firstOrFail();

            // Check if the course has the group
            if($course->groups->contains($group->id)) {
                // Check if the user isnot an admin and in the group
                if (!auth()->user()->hasRole('administrator') && !$group->students->contains(auth()->user()->id)) {
                    abort(404);
                }
            } else {
                abort(404);

            }

//            $rates = $course->forms()->where('form_type', 'rate')->where('type', 'student')->get();
            $rates = $group->rates()->where('user_type', 'student')
                ->where('course_group_rates.published', 1)
                ->wherePivot('published', 1)
                ->get();
            $impactMeasurments = $group->impacts()
                ->where('course_group_impacts.published', 1)
                ->wherePivot('published', 1)
                ->get();

            $programRecommendations = $group->reccomendations()
                ->where('course_group_recs.published', 1)
                ->wherePivot('published', 1)
                ->get();
            $activity = $group->groupActivity()->get();
            $coursesData = [];
            $lessons = $group->groupTimeline()
                ->where('model_type', Lesson::class)
                ->orderBy('sequence', 'asc')
                ->get();

            foreach ($lessons as $lesson) {

                $IsUserFilledData=$this->IsUserFilledData();

                $test_result = "";
                $completed_lessons = "";
                $course_id = $course->id;
                $lesson_slug = $lesson->model->slug;

                $lesson = Lesson::where('slug', $lesson_slug)->where('course_id', $course_id)->where('published', '=', 1)->first();
                $status = $group->courseLessons()->where('lesson_id', $lesson->id)->wherePivot('status', 1)->first();

                if ($status != null) {
                    $transcript = $lesson->transcript;

                    $lessonCourse = $lesson->course;

                    $course_lessons = $course->lessons->pluck('id')->toArray();

                    $course_tests = ($group->tests ) ? $group->tests()->wherePivot('published', 1)->get()->pluck('id')
                        ->toArray() : [];

                    $purchased_course = $group->students()->where('student_id', \Auth::id())->count() > 0;
                    $test_exists = FALSE;

                    if ($course_tests) {
                        $test_exists = TRUE;
                    }

                    $completed_lessons = \Auth::user()->chapters()
                        ->where('course_id', $course->id)
                        ->get()
                        ->pluck('model_id')
                        ->toArray();

                    $previous_lesson = $group->groupTimeline()
                        ->where('model_type', Lesson::class)
                        ->where('sequence', '<', $lesson->groupTimeline->sequence)
                        ->whereIn('model_id',$course_lessons)
                        ->orderBy('sequence', 'desc')
                        ->first();
                    $next_lesson = $group->groupTimeline()
                        ->where('model_type', Lesson::class)
                        ->whereIn('model_id',$course_lessons)
                        ->where('sequence', '>', $lesson->groupTimeline->sequence)
                        ->orderBy('sequence', 'asc')
                        ->first();

                    // Assemble data for current lesson
                    $lessonData = compact('course', 'lesson', 'transcript', 'lessonCourse', 'previous_lesson', 'next_lesson', 'test_result', 'purchased_course', 'test_exists', 'lessons', 'completed_lessons',  'course', 'IsUserFilledData', 'impactMeasurments', 'programRecommendations', 'group', 'course_tests');

                    // Add lesson data to the array
                    $coursesData[] = $lessonData;
                }

            }

            $groupTimeline = $group->groupTimeline()->orderBy('sequence', 'asc')->get();

            $sortedCourseData = [];
            foreach ($groupTimeline as $timelineEntry) {
                foreach ($coursesData as $courseEntry) {
                    if ($courseEntry['lesson']->id == $timelineEntry->model_id) {
                        $sortedCourseData[] = $courseEntry;
                        break;
                    }
                }
            }
            $sortedCourseData = $coursesData;
            $completed_lessons = \Auth::user()->chapters()
                ->where('course_id', $course->id)
                ->get()
                ->pluck('model_id')
                ->toArray();

            $course_tests = ($group->tests) ? $group->tests()->wherePivot('published', 1)->get(): [];


            $lessonsTimeline = $course->courseTimeline();
            $zoom_sdk = config('zoom_sdk_key');
            $zoom_secret = config('zoom_secret_key');

            $zoom_signatures = [];
            foreach ($lessons as $lesson) {
                if ($lesson->model->zoom_link) {
                    // slice the zoom link to get the meeting id
                    $zoom_link = $lesson->model->zoom_link; // your zoom link
                    $parsed_url = parse_url($zoom_link);
                    $meeting_number = basename($parsed_url['path']);
                    // Slice meeting password
                    $meeting_password = explode('pwd=', $parsed_url['query']);
                    $meeting_password = $meeting_password[1];
                    $zoom_signature = $this->generateSignature($zoom_sdk, $zoom_secret, $meeting_number, 0);
                    $zoom_signatures[] = [
                        'lesson_id' => $lesson->model->id,
                        'zoom_signature' => $zoom_signature,
                        'meeting_number' => $meeting_number,
                        'meeting_password' => $meeting_password,
                        'meeting_link' => $zoom_link
                    ];
                }
            }

            $chat =  GroupChat::firstOrCreate(['course_group_id' => $group->id]);

            return view($this->path . '.courses.course_details_blogs', compact('coursesData', 'course', 'rates', 'impactMeasurments', 'programRecommendations', 'group', 'lessons', 'completed_lessons', 'course_tests', 'zoom_signatures', 'zoom_sdk', 'chat', 'activity'));
        }
        elseif ($group == null){
            return abort(404);
        }
        else {
             return redirect('/login');
        }


    }
    public function courseDetailsBlogs($course_slug, $course_location_id = null)
    {
        if($course_location_id==null){
            $course_location_id = CourseLocation::where('course_id', Course::where('slug', $course_slug)->first()->id)->first()->id;
        }

        $course = Course::withoutGlobalScope('filter')->where('slug', $course_slug)->with('publishedLessons')->firstOrFail();
        $rates = $course->forms()->where('form_type', 'rate')->where('type', 'student')->get();
        $blogs = Blog::where('course_id', $course->id)->get();
        $impactMeasurments = $course->impactMeasurment();
//        $ImpactMeasurement=$lesson = Forms::where('id',$id)->first();
        $programRecommendations = $course->programRecommendations()->get();

        $coursesData = [];
        $lessons = $course->courseTimeline()->orderBy('sequence', 'asc')->get();

        foreach ($lessons as $lesson) {

            $IsUserFilledData=$this->IsUserFilledData();

            $test_result = "";
            $completed_lessons = "";
            $course_id = $course->id;
            $lesson_slug = $lesson->model->slug;
            $lesson = Lesson::where('slug', $lesson_slug)->where('course_id', $course_id)->where('published', '=', 1)->first();

            if ($lesson == "") {
                // $lesson = Test::where('slug', $lesson_slug)->where('course_id', $course_id)->where('published', '=', 1)->firstOrFail();
                $lesson = Forms::where('slug', $lesson_slug)
                    ->whereHas('course', function ($query) use($course_id) {

                        $query->where('course_forms.course_id', '=', $course_id);
                    })
                    ->where('published', '=', 1)->firstOrFail();



                $lesson->full_text = $lesson->description;
                // dd($lesson->course()->first()->pivot->id);
                $test_result = NULL;
                if ($lesson) {
                    // $test_result = Result::where('test_id', $lesson->id)
                    //     ->where('user_id', \Auth::id())
                    //     ->first();
                    $test_result = Result::where('course_forms_id', $lesson->course()->first()->pivot->id)
                        ->where('user_id', \Auth::id())
                        ->first();

                }
                // dd($test_result->test->first()->test);
            }
            if(get_class($lesson)=='App\Models\Forms'){
                $lessonCourse=$lesson->getcourseById($course_id);
            }
            else{
                $lessonCourse=$lesson->course;
            }

            if($course_location_id!==null){
                $course_lessons = $course->lessons()->whereHas('courseLocations', function($query) use($course_location_id) {
                    $query->where('course_location_id', '=', $course_location_id)
                        ->where('model_type', '=', 'App\Models\Lesson');
                })->pluck('id')->toArray();


                $course_tests = ($lessonCourse->tests ) ? $lessonCourse->tests()->whereHas('courseLocations', function($query) use($course_location_id) {
                    $query->where('course_location_id', '=', $course_location_id)
                        ->where('model_type', '=', 'App\Models\Forms');
                })->pluck('forms.id')->toArray():[];

                // $course_lessons = $lessonCourse->lessons->pluck('id')->toArray();
                //  $course_tests = ($lessonCourse->tests ) ? $lessonCourse->tests->pluck('id')->toArray() : [];

            }
            else{
                $course_lessons = $lessonCourse->lessons->pluck('id')->toArray();
                $course_tests = ($lessonCourse->tests ) ? $lessonCourse->tests->pluck('id')->toArray() : [];

            }

            $course_lessons = array_merge($course_lessons,$course_tests);


            $lessons = $lessonCourse->courseTimeline()
                ->whereIn('model_id',$course_lessons)
                ->orderby('sequence', 'asc')
                ->get();


            $purchased_course = $lessonCourse->students()->where('user_id', \Auth::id())->count() > 0;
            $test_exists = FALSE;

            if (get_class($lesson) == 'App\Models\Forms') {
                $test_exists = TRUE;
            }

            $completed_lessons = \Auth::user()->chapters()
                ->where('course_id', $lessonCourse->id)
                ->get()
                ->pluck('model_id')
                ->toArray();


            $blogs = Blog::has('category')->OrderBy('created_at','desc')->paginate(6);

            $impactMeasurments =$course->impactMeasurment();
            // $course->impactMeasurments()->get();
            // dd($impactMeasurments);
            $programRecommendations = $course->programRecommendations()->get();
            // $course->programRecommendations()->get();


            $previous_lesson = $lessonCourse->courseTimeline()
                ->where('sequence', '<', $lesson->courseTimeline->sequence)
                ->whereIn('model_id',$course_lessons)
                ->orderBy('sequence', 'desc')
                ->first();
            $next_lesson = $lessonCourse->courseTimeline()
                ->whereIn('model_id',$course_lessons)
                ->where('sequence', '>', $lesson->courseTimeline->sequence)
                ->orderBy('sequence', 'asc')
                ->first();

            // Assemble data for current lesson
            $lessonData = compact('course', 'lesson', 'lessonCourse', 'previous_lesson', 'next_lesson', 'test_result', 'purchased_course', 'test_exists', 'lessons', 'completed_lessons', 'blogs', 'course', 'IsUserFilledData', 'impactMeasurments', 'programRecommendations', 'course_location_id');

            // Add lesson data to the array
            $coursesData[] = $lessonData;
        }


        $completed_lessons = \Auth::user()->chapters()
            ->where('course_id', $course->id)
            ->get()
            ->pluck('model_id')
            ->toArray();

        return view($this->path . '.courses.course_details_blogs', compact('coursesData', 'course', 'blogs', 'rates', 'impactMeasurments', 'programRecommendations', 'course_location_id', 'lessons', 'completed_lessons'));




    }
    public function courseDetailsRates($course_slug, $course_location_id = null)
    {
        $course = Course::withoutGlobalScope('filter')->where('slug', $course_slug)->with('publishedLessons')->firstOrFail();
        $rates = $course->forms()->where('form_type', 'rate')->where('type', 'student')->get();
        $impactMeasurments = $course->impactMeasurment();
        $programRecommendations = $course->programRecommendations()->get();
        $blogs = Blog::where('course_id', $course->id)->get();

        return view($this->path . '.courses.course_details_rates', compact('course', 'rates','blogs', 'impactMeasurments', 'programRecommendations', 'course_location_id'));
    }
    public function inviteFriends($course_id, $group_id)
    {
        $user = auth()->user();
        $course = Course::withoutGlobalScope('filter')->where('id', $course_id)->with('publishedLessons')->firstOrFail();
        $rates = $course->forms()->where('form_type', 'rate')->where('type', 'student')->get();
        $impactMeasurments = $course->impactMeasurment();
        $programRecommendations = $course->programRecommendations()->get();
        $group = CourseGroup::findOrFail($group_id);
        $course_tests = ($group->tests) ? $group->tests()->wherePivot('published', 1)->get(): [];
        $activity = $group->groupActivity()->get();
        return view($this->path . '.courses.invite.friends2', compact('course', 'user', 'rates', 'impactMeasurments',
            'programRecommendations', 'group', 'course_tests', 'activity'));
    }

    public function sendInvitation(Request $request)
    {

        $course = Course::find($request->course_id);
        $content = [];
        $content['course_name'] = $course->title_ar;
        $content['course_slug'] = $course->slug;

        foreach ($request->emails as $key => $email) {
            # code...
            if ($email != '') {
                $exist = Invitation::where(['email' => $email, 'course_id' => $course->id, 'user_id' => auth()->user()->id])->get();

                if(count($exist)==0){
                $newInvitation = new Invitation();
                $newInvitation->email = $email;
                $newInvitation->user_id = auth()->user()->id;
                $newInvitation->course_id = $course->id;
                $newInvitation->save();

                // send mail
                \Mail::to($email)->send(new InviteFriend($content));


                }
            }
        }

        return response()->json(['message' => 'success']);

        // try {
        //     \Mail::to(auth()->user()->email)->send(new InviteFriend($content));
        // } catch (\Exception $e) {
        //     return false;
        // }
    }
}
