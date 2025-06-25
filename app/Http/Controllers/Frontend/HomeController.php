<?php

namespace App\Http\Controllers\Frontend;

use App\Helpers\General\EarningHelper;
use View;
use Newsletter;

use Carbon\Carbon;
use App\Models\Faq;
use App\Models\Tag;
use App\Models\Blog;
use App\Models\Page;
use App\Models\Type;
use App\Models\Forms;
use App\Models\Story;
use App\Models\Bundle;
use App\Models\Client;
use App\Models\Config;
use App\Models\Course;
use App\Models\Lesson;
use App\Models\Reason;
use App\Models\Sponsor;
use App\Models\Category;
use App\Models\Location;
use App\Models\Auth\User;
use App\Models\HomeService;
use App\Models\Methodology;
use App\Models\Testimonial;
use Illuminate\Http\Request;
use App\Models\CourseTimeline;
use App\Models\System\Session;
use App\Http\Controllers\Controller;
use App\Models\Acheivment;
use App\Models\Order;
use App\Models\Subscription as ModelsSubscription;
use App\Models\Subscription;
use Illuminate\Support\Facades\Response;
use Stripe\Subscription as StripeSubscription;
use Cart;

/**
 * Class HomeController.
 */

class HomeController extends Controller
{
    /**
     * @return \Illuminate\View\View
     */

    private $path;

    public function __construct()
    {


        $path = 'frontend';

        $this->path = $path;
    }

    public function index()
    {
        if (request('page')) {
            $page = Page::where('slug', '=', request('page'))
                ->where('published', '=', 1)->first();
            if ($page != "") {
                return view($this->path . '.pages.index', compact('page'));
            }
            abort(404);
        }
        $type = config('theme_layout');
        $sections = Config::where('key', '=', 'layout_' . $type)->first();
        $sections = json_decode($sections->value);

        $popular_courses = Course::withoutGlobalScope('filter')
            ->whereHas('category')
            ->where('published', '=', 1)
            ->where('popular', '=', 1)->where(function ($q) {
                $q->whereDate('end_date', '>=', Carbon::now())->orWhereNull('end_date');
            })->latest()->take(6)->get();

        $online_courses = Course::withoutGlobalScope('filter')
            ->whereHas('category')
            ->where('published', '=', 1)
            ->where('type_id', '=', 1)->latest()->take(6)->get();

        $live_courses = Course::withoutGlobalScope('filter')
            ->whereHas('category')
            ->where('published', '=', 1)
            ->where('type_id', '=', 2)->where(function ($q) {
                $q->whereDate('end_date', '>=', Carbon::now())->orWhereNull('end_date');
            })->latest()->take(6)->get();

        $conference_courses = Course::withoutGlobalScope('filter')
            ->whereHas('category')
            ->where('published', '=', 1)
            ->where('type_id', '=', 3)->where(function ($q) {
                $q->whereDate('end_date', '>=', Carbon::now())->orWhereNull('end_date');
            })->take(6)->get();

        $home_featured_courses = Course::withoutGlobalScope('filter')
            ->where('published', '=', 1)
            ->whereHas('category')
            ->where('featured', '=', 1)->where(function ($q) {
                $q->whereDate('end_date', '>=', Carbon::now())->orWhereNull('end_date');
            })->latest()->take(8)->get();


        $course_categories = Category::with('courses')->latest()->where('icon', '!=', "")->take(12)->get();

        $trending_courses = Course::withoutGlobalScope('filter')
            ->whereHas('category')
            ->where('published', '=', 1)
            ->where('trending', '=', 1)->where(function ($q) {
                $q->whereDate('end_date', '>=', Carbon::now())->orWhereNull('end_date');
            })->take(2)->get();

        $teachers = User::role('teacher')->with('courses')->where('active', '=', 1)->take(7)->get();

        $sponsors = Sponsor::where('status', '=', 1)->get();

        $clients = Client::where('status', '=', 1)->get();

        $home_services = HomeService::where('status', '=', 1)->get();

        $methodologies = Methodology::where('status', '=', 1)->get();

        $stories = Story::where('status', '=', 1)->get();

        $locations = Location::all();

        $news = Blog::orderBy('created_at', 'desc')->take(2)->get();

        $faqs = Category::with('faqs')->get()->take(6);

        $testimonials = Testimonial::where('status', '=', 1)->orderBy('created_at', 'desc')->get();

        $reasons = Reason::where('status', '=', 1)->orderBy('created_at', 'desc')->get();

        $cart_items = Cart::session(auth()->user()->id)->getContent();

        if ((int)config('counter') == 1) {
            $total_students = config('total_students');
            $total_courses = config('total_courses');
            $total_teachers = config('total_teachers');
        } else {
            $total_course = Course::where('published', '=', 1)->get()->count();
            $total_bundle = Bundle::where('published', '=', 1)->get()->count();
            $total_students = User::role('student')->get()->count();
            $total_courses = $total_course + $total_bundle;
            $total_teachers = User::role('teacher')->get()->count();
        }

        $categories = Category::get();
        $course_types = Type::where('status', 1)->get();
        return view($this->path . '.index-' . config('theme_layout'), compact('online_courses', 'cart_items', 'live_courses', 'conference_courses', 'popular_courses', 'home_featured_courses', 'sponsors', 'total_students', 'total_courses', 'total_teachers', 'testimonials', 'news', 'trending_courses', 'teachers', 'faqs', 'course_categories', 'reasons', 'sections', 'categories', 'clients', 'home_services', 'methodologies', 'stories', 'locations', 'course_types'));
    }
    public function index2()
    {
        // dd(request());

        if (request('page')) {
            $page = Page::where('slug', '=', request('page'))
                ->where('published', '=', 1)->first();
            if ($page != "") {
                return view($this->path . '.pages.index', compact('page'));
            }
            abort(404);
        }
        $type = config('theme_layout');
        $sections = Config::where('key', '=', 'layout_' . $type)->first();
        $sections = json_decode($sections->value);

        $popular_courses = Course::where('published', '=', 1)
            ->where('popular', '=', 1)
            ->latest()->take(6)->get();

        $online_courses = Course::where('published', '=', 1)
            ->where('type_id', '=', 1)
            ->latest()->take(6)->get();

        $live_courses = Course::where('published', '=', 1)
            ->where('type_id', '=', 2)
            ->latest()->take(6)->get();

        $conference_courses = Course::where('published', '=', 1)
            ->where('type_id', '=', 3)
            ->take(6)->get();

        $home_featured_courses = Course::where('published', '=', 1)
            ->whereHas('category')
            ->where('featured', '=', 1)
            ->latest()->take(8)->get();


        $courseTypes = Type::all();
        $course_categories = Category::with('courses')->latest()->where('icon', '!=', "")->take(12)->get();

        $trending_courses = Course::where('published', '=', 1)
            ->where('trending', '=', 1)->take(2)->get();

        // $teachers = User::role('teacher')->with('courses')->where('active', '=', 1)->take(7)->get();

        $sponsors = Sponsor::where('status', '=', 1)->get();

        $clients = Client::where('status', '=', 1)->get();

        // $home_services = HomeService::where('status', '=', 1)->latest()->get();
        $home_services = HomeService::where('status', '=', 1)->orderBy('updated_at', 'asc')->get();


        $methodologies = Methodology::where('status', '=', 1)->get();

        $stories = Story::where('status', '=', 1)->get();

        $locations = Location::all();

        // $news = Blog::orderBy('created_at', 'desc')->take(2)->get();

        // $faqs = Category::with('faqs')->get()->take(6);

        $testimonials = Testimonial::where('status', '=', 1)->orderBy('created_at', 'desc')->get();

        // $reasons = Reason::where('status', '=', 1)->orderBy('created_at', 'desc')->get();

        // if ((int)config('counter') == 1) {
        //     $total_students = config('total_students');
        //     $total_courses = config('total_courses');
        //     $total_teachers = config('total_teachers');
        // } else {
        //     $total_course = Course::where('published', '=', 1)->get()->count();
        //     $total_bundle = Bundle::where('published', '=', 1)->get()->count();
        //     $total_students = User::role('student')->get()->count();
        //     $total_courses = $total_course + $total_bundle;
        //     $total_teachers = User::role('teacher')->get()->count();
        // }

        // $categories = Category::get();
        $course_types = Type::where('status', 1)->orderBy('id', 'desc')->get();
        $configFreeCourseHome = Config::where('key', 'home_free_course')->first();

        $freeCourseSlug = null;
        if ($configFreeCourseHome) {
            $freeCourseSlug = Course::find($configFreeCourseHome->value) ? Course::find($configFreeCourseHome->value) : '';
        }



        // dd(config('theme_layout'));


        return view($this->path . '.index-' . config('theme_layout'), compact('online_courses',  'live_courses', 'conference_courses', 'popular_courses', 'home_featured_courses', 'sponsors', 'testimonials',  'trending_courses', 'course_categories',  'sections', 'clients', 'home_services', 'methodologies', 'stories', 'course_types', 'freeCourseSlug', 'locations'));
    }
    // *************


    public function index3()
    {


        if (request('page')) {
            $page = Page::where('slug', '=', request('page'))
                ->where('published', '=', 1)->first();
            if ($page != "") {
                return view($this->path . '.pages.index', compact('page'));
            }
            abort(404);
        }
        $type = config('theme_layout');
        $sections = Config::where('key', '=', 'layout_' . $type)->first();
        $sections = json_decode($sections->value);

        $popular_courses = Course::whereHas('locations', function ($q) {

            $q->whereDate('end_date', '>=', Carbon::now())->orWhereNull('end_date');
        })
            ->withoutGlobalScope('filter')
            ->whereHas('category')
            ->where('published', '=', 1)
            ->where('popular', '=', 1)

            ->latest()->take(6)->get();
        $online_courses = Course::whereHas('locations', function ($q) {

            // $q->whereDate('end_date', '>=', Carbon::now())->orWhereNull('end_date');
        })
            ->withoutGlobalScope('filter')
            ->whereHas('category')
            ->where('published', '=', 1)
            ->where('type_id', '=', 1)
            ->latest()->take(6)->get();
        //    dd($online_courses);

        $live_courses = Course::whereHas('locations', function ($q) {

            // $q->whereDate('end_date', '>=', Carbon::now())->orWhereNull('end_date');
        })
            ->withoutGlobalScope('filter')
            ->whereHas('category')
            ->where('published', '=', 1)
            ->where('type_id', '=', 2)
            ->latest()->take(6)->get();

        $conference_courses = Course::whereHas('locations', function ($q) {

            // $q->whereDate('end_date', '>=', Carbon::now())->orWhereNull('end_date');
        })
            ->withoutGlobalScope('filter')
            ->whereHas('category')
            ->where('published', '=', 1)
            ->where('type_id', '=', 3)
            ->take(6)->get();

        $home_featured_courses = Course::whereHas('locations', function ($q) {

            $q->whereDate('end_date', '>=', Carbon::now())->orWhereNull('end_date');
        })
            ->withoutGlobalScope('filter')
            ->where('published', '=', 1)
            ->whereHas('category')
            ->where('featured', '=', 1)
            ->latest()->take(8)->get();


        $courseTypes = Type::all();
        $course_categories = Category::with('courses')->latest()->where('icon', '!=', "")->take(12)->get();

        $trending_courses = Course::whereHas('locations', function ($q) {

            $q->whereDate('end_date', '>=', Carbon::now())->orWhereNull('end_date');
        })
            ->withoutGlobalScope('filter')
            ->whereHas('category')
            ->where('published', '=', 1)
            ->where('trending', '=', 1)->take(2)->get();

        $teachers = User::role('teacher')->with('courses')->where('active', '=', 1)->take(7)->get();

        $sponsors = Sponsor::where('status', '=', 1)->get();

        $clients = Client::where('status', '=', 1)->get();

        // $home_services = HomeService::where('status', '=', 1)->latest()->get();
        $home_services = HomeService::where('status', '=', 1)->orderBy('updated_at', 'asc')->get();


        $methodologies = Methodology::where('status', '=', 1)->get();

        $stories = Story::where('status', '=', 1)->get();

        $locations = Location::all();

        $news = Blog::orderBy('created_at', 'desc')->take(2)->get();

        $faqs = Category::with('faqs')->get()->take(6);

        $testimonials = Testimonial::where('status', '=', 1)->orderBy('created_at', 'desc')->get();

        $reasons = Reason::where('status', '=', 1)->orderBy('created_at', 'desc')->get();

        if ((int)config('counter') == 1) {
            $total_students = config('total_students');
            $total_courses = config('total_courses');
            $total_teachers = config('total_teachers');
        } else {
            $total_course = Course::where('published', '=', 1)->get()->count();
            $total_bundle = Bundle::where('published', '=', 1)->get()->count();
            $total_students = User::role('student')->get()->count();
            $total_courses = $total_course + $total_bundle;
            $total_teachers = User::role('teacher')->get()->count();
        }

        $categories = Category::get();
        $course_types = Type::where('status', 1)->orderBy('id', 'desc')->get();
        $configFreeCourseHome = Config::where('key', 'home_free_course')->first();
        $freeCourseSlug = null;
        if ($configFreeCourseHome) {
            $freeCourseSlug = Course::find($configFreeCourseHome->value)->first();
        }
        return view($this->path . '.index-5', compact('online_courses', 'live_courses', 'conference_courses', 'popular_courses', 'home_featured_courses', 'courseTypes', 'sponsors', 'total_students', 'total_courses', 'total_teachers', 'testimonials', 'news', 'trending_courses', 'teachers', 'faqs', 'course_categories', 'reasons', 'sections', 'categories', 'clients', 'home_services', 'methodologies', 'stories', 'locations', 'course_types', 'freeCourseSlug'));
    }
    // ************
    public function getFaqs()
    {
        $faq_categories = Category::has('faqs', '>', 0)->get();
        return view($this->path . '.faq', compact('faq_categories'));
    }

    public function about()
    {
        return view($this->path . '.pages.about-new');
    }
    public function privacy()
    {
        return view($this->path . '.pages.privacy-new');
    }
    public function AcademicIntegrity()
    {
        return view($this->path . '.pages.AcademicIntegrity-new');
    }
    public function commonQuestions()
    {
        return view($this->path . '.pages.commonQuestions-new');
    }
    public function termsConditions()
    {
        return view($this->path . '.pages.termsConditions-new');
    }
    public function technicalSupport()
    {
        return view($this->path . '.pages.technicalSupport-new');
    }

    public function technicalSpecifications()
    {
        return view($this->path . '.pages.technicalSpecifications-new');
    }
    public function returnPolicy()
    {
        return view($this->path . '.pages.return-policy');
    }
    public function achievements($id)
    {
        $achievement = Acheivment::find($id);
        return view($this->path . '.pages.achievements', compact('achievement'));
    }
    public function AllAchievements()
    {
        $achievements = Acheivment::where('status', 1)->get();

        return view($this->path . '.pages.achievements_all', compact('achievements'));
    }

    public function plan2021()
    {
        return view($this->path . '.pages.plan2021-new');
    }
    public function plan2020()
    {
        return view($this->path . '.pages.plan2020-new');
    }
    public function plan2022()
    {
        $recent_news = Blog::orderBy('created_at', 'desc')->take(2)->get();


        return view($this->path . '.pages.plan2022', compact('recent_news'));
    }

    /**
     * plan for 2023
     * view html page
     */
    public function plan2023()
    {
        return view($this->path . '.pages.plan2023');
    }

    /**
     * plan for 2023
     * view html page
     */
    public function plan2024()
    {
        return view($this->path . '.pages.plan2024');
    }

    public function complainments()
    {
        $complaiments = Forms::where('form_type', 'complainment')->get();

        return view($this->path . '.pages.complainments-new', compact('complaiments'));
    }

    public function why()
    {
        return view($this->path . '.pages.why-new');
    }

    public function training()
    {
        return view($this->path . '.pages.training-new');
    }

    public function facilitator()
    {
        $categories = Category::where('status', '=', 1)->get();
        return view($this->path . '.pages.facilitator-new', compact('categories'));
    }

    public function subscribe(Request $request)
    {
        $this->validate($request, [
            'subs_email' => 'required'
        ]);

        if (config('mail_provider') != "" && config('mail_provider') == "mailchimp") {
            try {
                if (!Newsletter::isSubscribed($request->subs_email)) {
                    if (config('mailchimp_double_opt_in')) {
                        Newsletter::subscribePending($request->subs_email);
                        session()->flash('alert', "We've sent you an email, Check your mailbox for further procedure.");
                    } else {
                        Newsletter::subscribe($request->subs_email);
                        session()->flash('alert', "You've subscribed successfully");
                    }
                    return back();
                } else {
                    session()->flash('alert', "Email already exist in subscription list");
                    return back();
                }
            } catch (Exception $e) {
                \Log::info($e->getMessage());
                session()->flash('alert', "Something went wrong, Please try again Later");
                return back();
            }
        } elseif (config('mail_provider') != "" && config('mail_provider') == "sendgrid") {
            try {
                $apiKey = config('sendgrid_api_key');
                $sg = new \SendGrid($apiKey);
                $query_params = json_decode('{"page": 1, "page_size": 1}');
                $response = $sg->client->contactdb()->recipients()->get(null, $query_params);
                if ($response->statusCode() == 200) {
                    $users = json_decode($response->body());
                    $emails = [];
                    foreach ($users->recipients as $user) {
                        array_push($emails, $user->email);
                    }
                    if (in_array($request->subs_email, $emails)) {
                        session()->flash('alert', "Email already exist in subscription list");
                        return back();
                    } else {
                        $request_body = json_decode(
                            '[{
                             "email": "' . $request->subs_email . '",
                             "first_name": "",
                             "last_name": ""
                              }]'
                        );
                        $response = $sg->client->contactdb()->recipients()->post($request_body);
                        if ($response->statusCode() != 201 || (json_decode($response->body())->new_count == 0)) {

                            session()->flash('alert', "Email already exist in subscription list");
                            return back();
                        } else {
                            $recipient_id = json_decode($response->body())->persisted_recipients[0];
                            $list_id = config('sendgrid_list');
                            $response = $sg->client->contactdb()->lists()->_($list_id)->recipients()->_($recipient_id)->post();
                            if ($response->statusCode() == 201) {
                                session()->flash('alert', "You've subscribed successfully");
                            } else {
                                session()->flash('alert', "Check your email and try again");
                                return back();
                            }
                        }
                    }
                }
            } catch (Exception $e) {
                \Log::info($e->getMessage());
                session()->flash('alert', "Something went wrong, Please try again Later");
                return back();
            }
        } else {
            session()->flash('alert', "Please configure Newsletter from Admin");
            return back();
        }
    }
    public function newsletterSubscribe(Request $request)
    {
        // $this->validate($request, [
        //     'subs_email' => 'required'
        // ]);
        $subscriptionAll = Subscription::where('email', $request->email)->get();
        if (count($subscriptionAll) == 0) {
            $subscription = new Subscription();
            $subscription->email = $request->email;
            $subscription->save();
            if (session('locale') == 'ar')
                $msg = ['success' => 'تم الاشتراك بنجاح'];
            else
                $msg = ['success' => 'Subscription successfly'];
        } else {
            if (session('locale') == 'ar')
                $msg = ['success' => 'تم الاشتراك من قبل'];
            else
                $msg = ['success' => 'Mail already subscribe before'];
        }
        return json_encode($msg);
    }
    public function getTeachers()
    {
        $recent_news = Blog::orderBy('created_at', 'desc')->take(2)->get();
        $teachers = User::role('teacher')->paginate(12);
        return view($this->path . '.teachers.index', compact('teachers', 'recent_news'));
    }

    public function showTeacher(Request $request)
    {
        $recent_news = Blog::orderBy('created_at', 'desc')->take(2)->get();
        $teacher = User::role('teacher')->where('id', '=', $request->id)->first();
        $courses = $teacher->courses;
        if (count($teacher->courses) > 0) {
            $courses = $teacher->courses()->paginate(12);
        }
        return view($this->path . '.teachers.show', compact('teacher', 'recent_news', 'courses'));
    }

    public function getDownload(Request $request)
    {

        if (auth()->check()) {
            if ($request->lesson) {

                $lesson = Lesson::findOrfail($request->lesson);
                $course_id = $lesson->course_id;
            }

            if ($request->blog) {
                $blog = Blog::findOrfail($request->blog);
                $course_id = $blog->course_id;
            }

            if ($request->test) {
                $test = Forms::findOrfail($request->test);
                $courses = $test->course;
                if (count($courses) > 0)
                    $course_id = $courses[0]->id;
                else
                    $course_id = 0;
            }
            $course = Course::findOrfail($course_id);
            $purchased_course = \Auth::check() && $course->students()->where('user_id', \Auth::id())->count() > 0;

            if ($purchased_course) {
                $file = public_path() . "/storage/uploads/" . $request->filename;

                return Response::download($file);
            }
            return abort(404);
        }
        return abort(404);
    }

    public function searchCourse(Request $request)
    {

        if (request('type') == 'popular') {
            $courses = Course::withoutGlobalScope('filter')->where('published', 1)->where('popular', '=', 1)->orderBy('id', 'desc')->paginate(12);
        } else if (request('type') == 'trending') {
            $courses = Course::withoutGlobalScope('filter')->where('published', 1)->where('trending', '=', 1)->orderBy('id', 'desc')->paginate(12);
        } else if (request('type') == 'featured') {
            $courses = Course::withoutGlobalScope('filter')->where('published', 1)->where('featured', '=', 1)->orderBy('id', 'desc')->paginate(12);
        } else {
            $courses = Course::withoutGlobalScope('filter')->where('published', 1)->orderBy('id', 'desc')->paginate(12);
        }


        if ($request->category != null) {
            $category = Category::find((int)$request->category);
            if ($category) {
                $ids = $category->courses->pluck('id')->toArray();
                $types = ['popular', 'trending', 'featured'];
                if ($category) {

                    if (in_array(request('type'), $types)) {
                        $type = request('type');
                        $courses = $category->courses()->where(function ($query) use ($request) {
                            $query->where('title', 'LIKE', '%' . $request->q . '%');
                            $query->orWhere('description', 'LIKE', '%' . $request->q . '%');
                        })
                            ->whereIn('id', $ids)
                            ->where('published', '=', 1)
                            ->where($type, '=', 1)
                            ->paginate(12);
                    } else {
                        $courses = $category->courses()
                            ->where(function ($query) use ($request) {
                                $query->where('title', 'LIKE', '%' . $request->q . '%');
                                $query->orWhere('description', 'LIKE', '%' . $request->q . '%');
                            })
                            ->where('published', '=', 1)
                            ->whereIn('id', $ids)
                            ->paginate(12);
                    }
                }
            }
        } else {
            $courses = Course::where('title', 'LIKE', '%' . $request->q . '%')
                ->orWhere('description', 'LIKE', '%' . $request->q . '%')
                ->where('published', '=', 1)
                ->paginate(12);
        }

        $categories = Category::where('status', '=', 1)->get();


        $q = $request->q;
        $recent_news = Blog::orderBy('created_at', 'desc')->take(2)->get();

        return view($this->path . '.search-result.courses', compact('courses', 'q', 'recent_news', 'categories'));
    }


    public function searchBundle(Request $request)
    {

        if (request('type') == 'popular') {
            $bundles = Bundle::withoutGlobalScope('filter')->where('published', 1)->where('popular', '=', 1)->orderBy('id', 'desc')->paginate(12);
        } else if (request('type') == 'trending') {
            $bundles = Bundle::withoutGlobalScope('filter')->where('published', 1)->where('trending', '=', 1)->orderBy('id', 'desc')->paginate(12);
        } else if (request('type') == 'featured') {
            $bundles = Bundle::withoutGlobalScope('filter')->where('published', 1)->where('featured', '=', 1)->orderBy('id', 'desc')->paginate(12);
        } else {
            $bundles = Bundle::withoutGlobalScope('filter')->where('published', 1)->orderBy('id', 'desc')->paginate(12);
        }


        if ($request->category != null) {
            $category = Category::find((int)$request->category);
            $ids = $category->bundles->pluck('id')->toArray();
            $types = ['popular', 'trending', 'featured'];
            if ($category) {

                if (in_array(request('type'), $types)) {
                    $type = request('type');
                    $bundles = $category->bundles()->where(function ($query) use ($request) {
                        $query->where('title', 'LIKE', '%' . $request->q . '%');
                        $query->orWhere('description', 'LIKE', '%' . $request->q . '%');
                    })
                        ->whereIn('id', $ids)
                        ->where('published', '=', 1)
                        ->where($type, '=', 1)
                        ->paginate(12);
                } else {
                    $bundles = $category->bundles()
                        ->where(function ($query) use ($request) {
                            $query->where('title', 'LIKE', '%' . $request->q . '%');
                            $query->orWhere('description', 'LIKE', '%' . $request->q . '%');
                        })
                        ->where('published', '=', 1)
                        ->whereIn('id', $ids)
                        ->paginate(12);
                }
            }
        } else {
            $bundles = Bundle::where('title', 'LIKE', '%' . $request->q . '%')
                ->orWhere('description', 'LIKE', '%' . $request->q . '%')
                ->where('published', '=', 1)
                ->paginate(12);
        }

        $categories = Category::where('status', '=', 1)->get();


        $q = $request->q;
        $recent_news = Blog::orderBy('created_at', 'desc')->take(2)->get();

        return view($this->path . '.search-result.bundles', compact('bundles', 'q', 'recent_news', 'categories'));
    }

    public function searchBlog(Request $request)
    {
        $blogs = Blog::where('title', 'LIKE', '%' . $request->q . '%')
            ->paginate(12);
        $categories = Category::has('blogs')->where('status', '=', 1)->paginate(10);
        $popular_tags = Tag::has('blogs', '>', 4)->get();


        $q = $request->q;
        return view($this->path . '.search-result.blogs', compact('blogs', 'q', 'categories', 'popular_tags'));
    }
    public function homeServiceDetails($service_id)
    {
        $home_service = HomeService::find($service_id);
        return view($this->path . '.home_services.service_details', compact('home_service'));
    }
    
    public function pages($page)
    {
        $page = Page::where('slug', '=', $page)->where('published', '=', 1)->first();
        if ($page == null) {
            abort(404);
        }
        return view($this->path . '.pages.page', compact('page'));
    }
}
