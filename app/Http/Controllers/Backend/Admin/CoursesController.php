<?php

namespace App\Http\Controllers\Backend\Admin;

use App\Models\Content;
use App\Models\CourseGroup;
use App\Models\CourseResourceLink;
use App\Models\SubContent;
use App\Models\Rate;
use App\Models\Forms;
use App\Models\Type;
use App\Models\Level;
use App\Models\Media;
use App\Models\Course;
use Illuminate\Contracts\View\Factory;
use Illuminate\Foundation\Application;
use Illuminate\View\View;
use function foo\func;
use function GuzzleHttp\json_decode;
use App\Models\Course_clints;
use App\Models\Certificate;
use App\Models\TeacherProfile;


use App\Models\Category;
use App\Models\Location;
use App\Models\Auth\User;
use Illuminate\Http\Request;
use App\Models\CourseTimeline;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Facades\Gate;
use Yajra\DataTables\Facades\DataTables;
use App\Http\Controllers\Traits\FileUploadTrait;
use App\Http\Requests\Admin\StoreCoursesRequest;
use App\Http\Requests\Admin\UpdateCoursesRequest;
use App\Jobs\SendEmailJob;
use App\Mail\courseEmail;
use App\Models\Config;
use App\Models\CourseClassification;
use App\Models\CourseLocation;
use App\Models\CourseLocCoordinator;
use App\Models\CourseLocDays;
use App\Models\ImpactMeasurement;
use App\Models\Invitation;
use App\Models\Order;
use App\Models\programRecommendation;
use DB;
use Illuminate\Foundation\Auth\User as AuthUser;
use Intervention\Image\Facades\Image;

class CoursesController extends Controller
{
    use FileUploadTrait;


    /**
     * Display a listing of the resource.
     *
     * @return Factory|Application|View|null
     */
    public function index()
    {

        if (!Gate::allows('course_access')) {
            return abort(401);
        }

        if (request('show_deleted') == 1) {
            if (!Gate::allows('course_delete')) {
                return abort(401);
            }
            $courses = Course::onlyTrashed()->orderBy('created_at', 'desc')->get();
        } else {
            $courses = Course::ofTeacher()->orderBy('created_at', 'desc')->get();
        }
        $types = session('locale') == 'en' ? Type::where('status', 1)->pluck('name', 'id')->prepend(__('labels.backend.courses.fields.choose-cat'), '') : Type::where('status', 1)->pluck('name_ar', 'id')->prepend(__('labels.backend.courses.fields.choose-cat'), '');

        return view('backend.courses.index', compact('courses', 'types'));
    }

    public function getCoursesData(Request $request)
    {
        $length = $request->input('length');
        $start = $request->input('start');
        $page = $start ? ($start / $length) + 1 : 1;
        $searchTerm = $request->input('search.value');
        //if show deleted groups
        if (request('show_deleted') == 1) {
            $query = Course::onlyTrashed()->orderBy('created_at', 'desc');
        } else {
            if ($request->input('cat_id')) {
                $query = Course::where('category_id', $request->input('cat_id'))->orderBy('created_at', 'desc');
            }else{
                $query = Course::query()->orderBy('created_at', 'desc');
            }
        }

        if ($searchTerm) {
            $query->where('title_ar', 'like', '%' . $searchTerm . '%')
                ->orWhere('title', 'like', '%' . $searchTerm . '%');
        }

        $courses = $query->paginate($length, ['*'], 'page', $page);

        $data = [];
        foreach ($courses as $course) {
            $actions = ($request->input('show_deleted') == 1) ? $this->getCourseActions($course, true) :
                $this->getCourseActions($course, false);
            $data[] = [
                'id' => $course->id,
                'title' => app()->getLocale() == "ar" ? $course->title_ar : $course->title,
                'type' => app()->getLocale() == "ar" ? $course->type->name_ar : $course->type->name,
                'groups' => $course->groups->count(),
                'category' => app()->getLocale() == "ar" ? $course->category->name_ar : $course->category->name,
                'classification' => app()->getLocale() == "ar" ? $course->classification->name_ar : $course->classification->name,
                'level' => app()->getLocale() == "ar" ? $course->level->name_ar : $course->level->name,
                'actions' => $actions,
            ];
        }

        $response = [
            'draw' => $request->input('draw'),
            'recordsTotal' => $courses->total(),
            'recordsFiltered' => $courses->total(),
            'data' => $data
        ];
        return response()->json($response);
    }

    private function getCourseActions($course, $deleted = false)
    {
      if ($deleted) {
          $actions = view('backend.datatable.action-trashed')->with(['route_label' => 'admin.courses', 'label' =>
              'courses', 'value' => $course->id])->render();
      }else{
          $actions = '<a href="'.route('admin.courses.show', ['course' => $course->id]).'" class="btn btn-xs btn-info mb-1"><i class="icon-eye"></i></a>';

          $actions .= '<a data-method="delete" data-trans-button-cancel="Cancel" data-trans-button-confirm="Delete" data-trans-title="Are you sure?" class="btn btn-xs btn-danger text-white mb-1" style="cursor:pointer;" onclick="$(this).find(\'form\').submit();"><i class="fa fa-trash" data-toggle="tooltip" data-placement="top" title="" data-original-title="Delete"></i>
    <form action="'.route('admin.courses.destroy', ['course_id' => $course->id]).'" method="POST" name="delete_item" style="display:none">
        '.csrf_field().'
        '.method_field('DELETE').'
    </form></a>';

          $actions .= '<div class="btn-group btn-group-sm" style="display: inline-block;" role="group">
                        <a id="userActions" type="button" class="btn btn-xs bg-warning mb-1 p-2 dropdown-toggle" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                            <i class="fa fa-plus-square" aria-hidden="true"></i>
                        </a>';
          $actions .= '<div class="dropdown-menu drop" id="moreCourse" style=" max-height:200px; overflow:scroll; " aria-labelledby="userActions">
            <a tabindex="1" href="'.route('admin.courses.edit', ['course' => $course->id]).'" class="dropdown-item">'.__('menus.backend.sidebar.courses.editCourse').'</a>';

        //   if ($course->type_id == 1){
        //         $actions .= '<a tabindex="1" href="'.route('admin.chapters2.index2', ['course_id' => $course->id]).'" class="dropdown-item">'.__('menus.backend.sidebar.chapters.title').'</a>';
        //         $actions .= '<a tabindex="1" href="'.route('admin.chapters.rearrange', ['course_id' => $course->id]).'" class="dropdown-item">'.__('labels.backend.chapters.rearrange').'</a>';
        //   }
        $actions .= '<a tabindex="1" href="'.route('admin.chapters2.index2', ['course_id' => $course->id]).'" class="dropdown-item">'.__('menus.backend.sidebar.chapters.title').'</a>';
        $actions .= '<a tabindex="1" href="'.route('admin.chapters.rearrange', ['course_id' => $course->id]).'" class="dropdown-item">'.__('labels.backend.chapters.rearrange').'</a>';


          $actions .= '<a tabindex="1" href="'.route('admin.lessons.index2', ['course_id' => $course->id]).'" class="dropdown-item">'.__('labels.backend.lessons.title').'</a>
            </div>
            </div>';
      }

        return $actions;
    }

    public function index2()
    {

        if (!Gate::allows('course_access')) {
            return abort(401);
        }


        if (request('show_deleted') == 1) {
            if (!Gate::allows('course_delete')) {
                return abort(401);
            }
            $courses = Course::onlyTrashed()->ofTeacher()->get();
        } else {
            $courses = Course::ofTeacher()->get();
        }

        return view('backend.courses.index2', compact('courses'));
    }

    // new in admin
    public function index3()
    {

        if (!Gate::allows('course_access')) {
            return abort(401);
        }


        if (request('show_deleted') == 1) {
            if (!Gate::allows('course_delete')) {
                return abort(401);
            }
            $courses = Course::onlyTrashed()->ofTeacher()->orderBy('created_at', 'DESC')->get();
        }
        // elseif(auth()->user()->hasRole('coordinator')){
        //     $courses = Course::orderBy('created_at','DESC')->get();

        // }
        else {
            $courses = Course::ofTeacher()->orderBy('created_at', 'DESC')->get();
        }
        $types = session('locale') == 'en' ? Type::where('status', 1)->pluck('name', 'id')->prepend(__('labels.backend.courses.fields.choose-cat'), '') : Type::where('status', 1)->pluck('name_ar', 'id')->prepend(__('labels.backend.courses.fields.choose-cat'), '');

        return view('backend.courses.indexCoursesLocations', compact('courses', 'types'));
    }

    public function addStudents()
    {

        // $students = User::whereHas('roles', function ($q) {
        //     $q->where('role_id', 3);
        // })->get()->pluck('name', 'id');
        $students = User::whereHas('roles', function ($q) {
            $q->where('role_id', 3);
        })->get()->pluck(['email'], 'id');
        $students2 = User::whereHas('roles', function ($q) {
            $q->where('role_id', 3);
        })->get()->pluck('phone', 'id');

        $allStudents = [];
        foreach ($students as $key1 => $value1) {
            # code...
            foreach ($students2 as $key2 => $value2) {
                if ($key1 == $key2) {
                    $allStudents[$key1] = $value1 . ' , ' . $value2;
                }
            }
        }
        $course = Course::find(request('course_id'));
        $currentCourseLocation = CourseLocation::find(request('course_location_id'));

        $courses = session('locale') == 'ar' ? Course::where('published', 1)->pluck('title_ar', 'id')->prepend('اختر دورة', '') : Course::where('published', 1)->pluck('title', 'id')->prepend('Please select', '');
        return view('backend.courses.students.add_to_course', compact('students', 'courses', 'students2', 'allStudents', 'course', 'currentCourseLocation'));
    }

    public function getCourseLocAjax($course_id)
    {

        //    $courseLocation=session('locale') =='ar'?Course::find($course_id)->locations->pluck('name_ar','pivot.id')->prepend('اختر موقع الدوره',''):Course::find($course_id)->locations->pluck('name','pivot.id')->prepend('choose Course Location  ','');
        $courseLocationsColl = session('locale') == 'ar' ? Course::find($course_id)
            ->locations : Course::find($course_id)->locations;
        $courseLocation = [];
        foreach ($courseLocationsColl as $key => $loc) {
            # code...

            $courseLocation[$loc->pivot->id] = session('locale') == 'ar' ? $loc->pivot->start_date . ' ' . $loc->name_ar : $loc->start_date . ' ' . $loc->name;
        }

        return json_encode($courseLocation);
    }

    public function storeStudentsToCourse(Request $request)
    {


        $course = Course::findOrFail($request->course_id);
        $courseLocation = CourseLocation::find($request->course_location_id);
        $CourseCoordinators = $courseLocation->coordinators;

        if ($courseLocation->sms_email) {
            $sms_email = json_decode($courseLocation->sms_email);
            $is_sent_sms = $sms_email->sms;
            $is_sent_email = $sms_email->email;
        }
        $studentsMail = [];
        if (count($request->students) > 0) {

            foreach ($request->students as $student_id) {
                # code...

                $isINCourse = $course->whereHas('students', function ($q) use ($request, $student_id) {

                    return $q->where('course_student.user_id', '=', $student_id)->where('course_student.course_location_id', $request->course_location_id);
                })->get();
                // dd($isINCourse);
                if (count($isINCourse) == 0) {
                    $student = User::find($student_id);
                    $studentsMail[] = $student->email;

                    try {
                        //code...

                        $course->students()->attach($student_id, ['course_location_id' => $request->course_location_id]);

                        $content = [];
                        $content['course_name'] = $course->title_ar;
                        $content['course_slug'] = $course->slug;
                        $content['course'] = $course;
                        $content['email'] = 'khalf_doaa@yahoo.com';

                        // $content['email'] = $student->email;
                        $content['student'] = $student;
                        $content['teachers'] = $course->teachers;
                        $content['locations'] = $course->locations;
                        $content['courseLocation'] = $courseLocation;


                        // return redirect()->back()->with('success', 'User Added Successfly to course');
                        $order = $this->makeOrder($student_id, $course, $request->course_location_id);
                        // \Mail::to($student->email)->send(new courseEmail($content));
                        $message = trans('labels.backend.courses.join_message') . $course->title_ar . ' ' .
                            trans('labels.backend.courses.join_message_info') . ' ' . route('frontend.index');
                        // if ($is_sent_email) {
                        //     dispatch(new SendEmailJob($student->email, $content));

                        // }
                        // if($is_sent_sms){
                        // // $result = SendSMS(['Message' => $message, 'RecepientNumber' => str_replace('+', '00', $student->phone)]);
                        // $result = SendSMS(['Message' => $message, 'RecepientNumber' => str_replace('+', '', $student->phone)]);


                        // }

                        // \Mail::to($student->email)->send(new courseEmail($content));
                        // \Mail::queue(new courseEmail($content), $content, function ($message) {
                        //     //
                        // });
                        // $result = SendSMS(['Message' => $message, 'RecepientNumber' => str_replace('+', '00', $student->phone)]);
                    } catch (\Throwable $th) {
                        //throw $th;
                        return redirect()->back()->withFlashDanger(__('alerts.backend.general.try_again'));
                    }
                }
            }
            //     if($is_sent_email){
            //         $contentCoordinator=[];
            //         $contentCoordinator['course'] = $course;
            //         $contentCoordinator['students'] = $studentsMail;


            //       foreach ($CourseCoordinators as $key => $coordinator) {
            //         # code...
            //         $contentCoordinator['coordinator'] = $coordinator;
            //         dispatch(new SendEmailJob($coordinator->email, $contentCoordinator,'coordinator'));

            //     }
            //     // dispatch(new SendEmailJob('tr_coordinator@ivorytraining.com', $contentCoordinator,'coordinator'));
            //     // \Artisan::call('queue:work');
            // }
            return redirect()->back()->withFlashSuccess(' Users Added Successfly to course');
        } else {
            // return redirect()->back()->with('error', 'User already in  course'); 
            return redirect()->back()->withFlashDanger('plz select students');
        }
    }

    public function makeOrder($user_id, $course, $courseLocation_id)
    {
        $courseLocation = CourseLocation::findOrFail($courseLocation_id);

        $order = new Order();
        $order->user_id = $user_id;
        $order->reference_no = str_random(8);
        $order->amount = $courseLocation->price;
        $order->status = 1;
        $order->coupon_id = 0;

        $order->payment_type = 3; //manual
        $order->status = 1;
        $order->save();
        //Getting and Adding items

        $type = Course::class;
        $order->items()->create([
            'item_id' => $course->id,
            'item_type' => $type,
            'price' => $courseLocation->price,
            'item_location_id' => $courseLocation_id
        ]);
        return $order;
    }

    public function removeStudents()
    {

        $students = User::whereHas('roles', function ($q) {
            $q->where('role_id', 3);
        })->get()->pluck(['email'], 'id');
        $students2 = User::whereHas('roles', function ($q) {
            $q->where('role_id', 3);
        })->get()->pluck('phone', 'id');

        $allStudents = [];
        foreach ($students as $key1 => $value1) {
            # code...
            foreach ($students2 as $key2 => $value2) {
                if ($key1 == $key2) {
                    $allStudents[$key1] = $value1 . ' , ' . $value2;
                }
            }
        }
        $course = Course::find(request('course_id'));
        $currentCourseLocation = CourseLocation::find(request('course_location_id'));

        $courses = session('locale') == 'ar' ? Course::where('published', 1)->pluck('title_ar', 'id')->prepend('اختر دورة', '') : Course::where('published', 1)->pluck('title', 'id')->prepend('Please select', '');
        return view('backend.courses.students.remove_from_course', compact('students', 'courses', 'students2', 'allStudents', 'course', 'currentCourseLocation'));
    }

    public function removeStudentsFromCourse(Request $request)
    {

        $course = Course::findOrFail($request->course_id);
        // dd($request->students);

        if (count($request->students) > 0) {

            foreach ($request->students as $student_id) {
                # code...

                $isINCourse = $course->whereHas('students', function ($q) use ($request, $student_id) {

                    return $q->where('course_student.user_id', '=', $student_id)->where('course_student.course_location_id', $request->course_location_id);
                })->get();

                if (count($isINCourse) > 0) {


                    $course->students()->detach($student_id, ['course_location_id' => $request->course_location_id]);


                    // return redirect()->back()->with('success', 'User Added Successfly to course'); 
                    $order = $this->deleteOrder($student_id, $course, $request->course_location_id);
                }
            }
            return redirect()->back()->withFlashSuccess(' Users remove Successfly from course');
        } else {
            // return redirect()->back()->with('error', 'User already in  course'); 
            return redirect()->back()->withFlashDanger('plz select students');
        }
    }

    public function deleteOrder($user_id, $course, $courseLocation_id)
    {
        $courseLocation = CourseLocation::findOrFail($courseLocation_id);


        $order = Order::where('user_id', $user_id)->whereHas('items', function ($query) use ($course, $courseLocation_id) {
            $query->where('item_id', $course->id)->where('item_type', Course::class)->where('item_location_id', $courseLocation_id);
        })->first();

        //Getting and Adding items
        if ($order) {
            $order->items()->delete();
            $order->delete();
        }
        return true;
    }
    // invite friends

    /**
     * Display a listing of Courses via ajax DataTable.
     *
     * @return \Illuminate\Http\Response
     */
    public function getData(Request $request)
    {
        $has_view = false;
        $has_delete = false;
        $has_edit = false;
        $has_evaluate = false;
        $has_article = false;
        $has_lessons = false;
        $has_tests = false;
        $has_attendance = false;
        $has_student_rate = false;
        $show_invitation = false;
        $has_landing = false;


        $courses = "";

        if (request('show_deleted') == 1) {
            if (!Gate::allows('course_delete')) {
                return abort(401);
            }
            $courses = Course::onlyTrashed()
                ->whereHas('category')
                ->ofTeacher()->orderBy('created_at', 'desc')->get();
        } else if (request('teacher_id') != "") {
            $id = request('teacher_id');
            $courses = Course::ofTeacher()
                ->whereHas('category')
                ->whereHas('teachers', function ($q) use ($id) {
                    $q->where('course_user.user_id', '=', $id);
                })->orderBy('created_at', 'desc')->get();
        } else if (request('cat_id') != "") {
            $id = request('cat_id');
            $courses = Course::ofTeacher()
                ->whereHas('category')
                ->where('category_id', '=', $id)->orderBy('created_at', 'desc')->get();
        }
        // else if(\Auth::user()->hasRole('coordinator')){
        //     $courses = Course::
        //     whereHas('category')
        //     ->orderBy('created_at', 'desc')->get();
        // }
        else {
            $courses = Course::ofTeacher()
                ->whereHas('category')
                ->orderBy('created_at', 'desc')->get();
        }


        if (auth()->user()->can('course_view')) {
            $has_view = true;
            $show_invitation = true;
        }
        if (auth()->user()->can('course_edit')) {
            $has_edit = true;
            $has_evaluate = true;
            $has_article = true;
            $has_attendance = true;
            $has_student_rate = true;
            $has_landing = true;
        }
        if (auth()->user()->can('blog_access')) {

            $has_article = true;
        }
        if (auth()->user()->can('lesson_delete')) {
            $has_delete = true;
        }

        if (auth()->user()->can('lesson_access')) {
            $has_lessons = true;
        }

        if (auth()->user()->can('test_access')) {
            $has_tests = true;
        }

        return DataTables::of($courses)
            ->addIndexColumn()
            ->addColumn('actions', function ($q) use ($has_view, $has_edit, $has_delete, $has_evaluate, $has_article, $has_lessons, $has_tests, $has_attendance, $has_student_rate, $show_invitation, $has_landing, $request) {
                $view = "";
                $edit = "";
                $delete = "";
                $evaluate = "";
                $article = "";

                $view .= '<div class="btn-group" role="group" aria-label="' . __('labels.backend.access.users.user_actions') . '">';

                if ($has_view) {
                    $view = view('backend.datatable.action-view')
                        ->with(['route' => route('admin.courses.show', ['course' => $q->id])])->render();
                }

                if ($has_edit) {
                    $edit = view('backend.datatable.action-edit')
                        ->with(['route' => route('admin.courses.edit', ['course' => $q->id])])
                        ->render();
                    $view .= $edit;
                }

                $view .= '
                  <div class="btn-group btn-group-sm" role="group">
                    <button id="userActions" type="button" class="btn btn-secondary dropdown-toggle" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                      ' . __('labels.general.more') . '
                    </button>
                    <div class="dropdown-menu drop" id="moreCourse" style=" max-height:200px;
                    overflow:scroll; " aria-labelledby="userActions">';


                if ($has_delete && \Auth::user()->id == 1) {
                    $view .= '<a tabindex="1" onclick="$(this).find(\'form\').submit();"  class="dropdown-item">' . __('buttons.general.crud.delete') . '
                            
                            <form action="' . route('admin.courses.destroy', ['course' => $q->id]) . '"
                                    method="POST" name="delete_item" style="display:none">' .
                        csrf_field() . method_field('DELETE') . '
                            </form>
                            </a>
                        ';
                }

                if ($has_lessons) {
                    $view .= '<a tabindex="1" href="' . route('admin.chapters.index', ['course_id' => $q->id]) . '" class="dropdown-item">' . __('menus.backend.sidebar.chapters.title') . '</a> ';
                }

                if ($has_lessons) {
                    $view .= '<a tabindex="1" href="' . route('admin.lessons.index', ['course_id' => $q->id]) . '" class="dropdown-item">' . __('menus.backend.sidebar.lessons.title') . '</a> ';
                }
                if ($has_lessons) {
                    $view .= '<a tabindex="1" href="' . route('admin.courses.location.index', ['course_id' => $q->id]) . '" class="dropdown-item">' . __('menus.backend.sidebar.courses.locations_times') . '</a> ';

                    // $view .='<a href="'.route('admin.courses.location.create', ['course_id' => $q->id]).'" class="dropdown-item">'.__('menus.backend.sidebar.courses.createLocation').'</a> ';
                }

                if ($has_tests) {
                    $view .= '<a href="' . route('admin.forms.index', ['course_id' => $q->id, 'form_type' => 'test']) . '" class="dropdown-item">' . __('menus.backend.sidebar.tests.title') . '</a> ';
                }

                if ($has_evaluate) {
                    // $view .='<a href="'.route('admin.rate.course.show', ['course' => $q->id]).'" class="dropdown-item">'.__('menus.backend.sidebar.rates.title').'</a> ';
                    $view .= '<a href="' . route('admin.forms.index', ['course_id' => $q->id, 'form_type' => 'rate']) . '" class="dropdown-item">' . __('menus.backend.sidebar.rates.title') . '</a> ';
                    $view .= '<a href="' . route('admin.forms.index', ['course_id' => $q->id, 'form_type' => 'impact_measurments']) . '" class="dropdown-item">' . __('menus.backend.sidebar.impact.title') . '</a> ';
                    $view .= '<a href="' . route('admin.forms.index', ['course_id' => $q->id, 'form_type' => 'program_recommendation']) . '" class="dropdown-item">' . __('menus.backend.sidebar.programRec.title') . '</a> ';
                }
                if ($has_article) {
                    $view .= '<a href="' . route('admin.courses.articles.index', ['course' => $q->id]) . '" class="dropdown-item">' . __('menus.backend.sidebar.blogs.title') . '</a> ';
                }
                if ($has_attendance) {
                    $view .= '<a href="' . route('admin.Attendance.course_locations', ['course' => $q->id]) . '" class="dropdown-item">' . __('menus.backend.sidebar.attendance.title') . '</a> ';
                }
                if ($has_student_rate) {
                    $view .= '<a href="' . route('admin.courses.get_course_student', ['course' => $q->id]) . '" class="dropdown-item">' . __('menus.backend.sidebar.students.title') . '</a> ';
                }
                if ($show_invitation) {
                    $view .= '<a href="' . route('admin.courses.get_invitations', ['course' => $q->id]) . '" class="dropdown-item">' . __('menus.backend.sidebar.courses.invitation') . '</a> ';
                }


                if ($q->published == 1) {
                    $type = 'unpublish';
                } else {
                    $type = 'publish';
                }
                // if (\Auth::user()->isAdmin() ||\Auth::user()->hasRole('coordinator')) {
                //
                if (\Auth::user()->isAdmin()) {

                    $view .= '<a href="' . route('admin.courses.publish', ['course' => $q->id]) . '" class="dropdown-item">' . __('buttons.general.crud.' . $type) . '</a> ';
                }

                $view .= '
                    </div>
                  </div>
                </div>';


                return $view;
            })
            ->editColumn('teachers', function ($q) {
                $teachers = "";

                foreach ($q->teachers as $singleTeachers) {
                    app()->getLocale() == "en" ?
                        $teachers .= '<span class="label label-info label-many">' . $singleTeachers->name . ' </span>'
                        :
                        $teachers .= '<span class="label label-info label-many">' . $singleTeachers->name_ar . ' </span>';
                }

                return $teachers;
            })
            ->editColumn('title', function ($q) {

                return (app()->getLocale() == "ar") ? $q->title_ar : $q->title;
            })
            ->addColumn('lessons', function ($q) {
                $lesson = '<a href="' . route('admin.lessons.create', ['course_id' => $q->id]) . '" class="btn btn-success mb-1"><i class="fa fa-plus-circle"></i></a>  <a href="' . route('admin.lessons.index', ['course_id' => $q->id]) . '" class="btn mb-1 btn-warning text-white"><i class="fa fa-arrow-circle-right"></a>';
                return $lesson;
            })
            ->editColumn('course_image', function ($q) {
                return ($q->course_image != null) ? '<img height="50px" src="' . asset('storage/uploads/' . $q->course_image) . '">' : 'N/A';
            })
            ->editColumn('status', function ($q) {
                $text = "";
                $text = ($q->published == 1) ? "<p class='text-white mb-1 font-weight-bold text-center bg-dark p-1 mr-1' >" . trans('labels.backend.courses.fields.published') . "</p>" : "";
                $text .= ($q->featured == 1) ? "<p class='text-white mb-1 font-weight-bold text-center bg-warning p-1 mr-1' >" . trans('labels.backend.courses.fields.featured') . "</p>" : "";
                $text .= ($q->trending == 1) ? "<p class='text-white mb-1 font-weight-bold text-center bg-success p-1 mr-1' >" . trans('labels.backend.courses.fields.trending') . "</p>" : "";
                $text .= ($q->popular == 1) ? "<p class='text-white mb-1 font-weight-bold text-center bg-primary p-1 mr-1' >" . trans('labels.backend.courses.fields.popular') . "</p>" : "";
                return $text;
            })
            // ->editColumn('price', function ($q) {
            //     if ($q->free == 1) {
            //         return trans('labels.backend.courses.fields.free');
            //     }
            //     return $q->price;
            // })
            ->addColumn('category', function ($q) {
                return (app()->getLocale() == "ar") ? $q->category->name_ar : $q->category->name;
            })
            ->addColumn('type', function ($q) {
                return (app()->getLocale() == "ar") ? $q->type->name_ar : $q->type->name;
            })
            ->rawColumns(['teachers', 'lessons', 'course_image', 'actions', 'status', 'type'])
            ->make();
    }

    public function getData1(Request $request)
    {
        $has_view = false;
        $has_delete = false;
        $has_edit = false;
        $has_evaluate = false;
        $has_article = false;
        $has_lessons = false;
        $has_tests = false;
        $has_attendance = false;
        $has_student_rate = false;
        $show_invitation = false;
        $has_landing = false;


        $courses = "";

        if (request('show_deleted') == 1) {
            if (!Gate::allows('course_delete')) {
                return abort(401);
            }
            $courses = Course::onlyTrashed()
                ->whereHas('category')
                ->ofTeacher()->orderBy('created_at', 'desc')->get();
        } else if (request('teacher_id') != "") {
            $id = request('teacher_id');
            $courses = Course::ofTeacher()
                ->whereHas('category')
                ->whereHas('teachers', function ($q) use ($id) {
                    $q->where('course_user.user_id', '=', $id);
                })->orderBy('created_at', 'desc')->get();
        } else if (request('cat_id') != "") {
            $id = request('cat_id');
            $courses = Course::ofTeacher()
                ->whereHas('category')
                ->where('category_id', '=', $id)->orderBy('created_at', 'desc')->get();
        } else if (auth()->user()->can('course_access')) {
            $id = request('cat_id');
            $courses = Course::ofTeacher()
                ->whereHas('category')
                ->orderBy('created_at', 'desc')->get();
        } else {
            $courses = Course::ofTeacher()
                ->whereHas('category')
                ->orderBy('created_at', 'desc')->get();
        }


        if (auth()->user()->can('course_view')) {
            $has_view = true;
            $show_invitation = true;
        }
        if (auth()->user()->can('course_edit')) {
            $has_edit = true;
            $has_evaluate = true;
            $has_article = true;
            $has_attendance = true;
            $has_student_rate = true;
            $has_landing = true;
        }
        if (auth()->user()->can('blog_access')) {

            $has_article = true;
        }
        if (auth()->user()->can('lesson_delete')) {
            $has_delete = true;
        }

        if (auth()->user()->can('lesson_access')) {
            $has_lessons = true;
        }

        if (auth()->user()->can('test_access')) {
            $has_tests = true;
        }

        return DataTables::of($courses)
            ->addIndexColumn()
            ->addColumn('actions', function ($q) use ($has_view, $has_edit, $has_delete, $has_evaluate, $has_article, $has_lessons, $has_tests, $has_attendance, $has_student_rate, $show_invitation, $has_landing, $request) {
                $view = "";
                $edit = "";
                $delete = "";
                $evaluate = "";
                $article = "";

                $view .= '<div class="btn-group" role="group" aria-label="' . __('labels.backend.access.users.user_actions') . '">';

                if ($has_view) {
                    $view = view('backend.datatable.action-view')
                        ->with(['route' => route('admin.courses.show', ['course' => $q->id])])->render();
                }

                if ($has_edit) {
                    $edit = view('backend.datatable.action-edit')
                        ->with(['route' => route('admin.courses.edit', ['course' => $q->id])])
                        ->render();
                    $view .= $edit;
                }

                $view .= '
                  <div class="btn-group btn-group-sm" role="group">
                    <button id="userActions" type="button" class="btn btn-secondary dropdown-toggle" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                      ' . __('labels.general.more') . '
                    </button>
                    <div class="dropdown-menu drop" id="moreCourse" style=" max-height:200px;
                    overflow:scroll; " aria-labelledby="userActions">';


                if ($has_delete && \Auth::user()->id == 1) {
                    $view .= '<a tabindex="1" onclick="$(this).find(\'form\').submit();"  class="dropdown-item">' . __('buttons.general.crud.delete') . '
                            
                            <form action="' . route('admin.courses.destroy', ['course' => $q->id]) . '"
                                    method="POST" name="delete_item" style="display:none">' .
                        csrf_field() . method_field('DELETE') . '
                            </form>
                            </a>
                        ';
                }


                if ($has_lessons) {
                    $view .= '<a tabindex="1" href="' . route('admin.courses.location2.index', ['course_id' => $q->id]) . '" class="dropdown-item">' . __('menus.backend.sidebar.courses.locations_times') . '</a> ';

                    // $view .='<a href="'.route('admin.courses.location.create', ['course_id' => $q->id]).'" class="dropdown-item">'.__('menus.backend.sidebar.courses.createLocation').'</a> ';
                }


                if ($q->published == 1) {
                    $type = 'unpublish';
                } else {
                    $type = 'publish';
                }
                if (\Auth::user()->isAdmin()) {
                    $view .= '<a href="' . route('admin.courses.publish', ['course' => $q->id]) . '" class="dropdown-item">' . __('buttons.general.crud.' . $type) . '</a> ';
                }

                $view .= '
                    </div>
                  </div>
                </div>';


                return $view;
            })
            ->editColumn('teachers', function ($q) {
                $teachers = "";

                foreach ($q->teachers as $singleTeachers) {
                    app()->getLocale() == "en" ?
                        $teachers .= '<span class="label label-info label-many">' . $singleTeachers->name . ' </span>'
                        :
                        $teachers .= '<span class="label label-info label-many">' . $singleTeachers->name_ar . ' </span>';
                }

                return $teachers;
            })
            ->editColumn('title', function ($q) {

                return (app()->getLocale() == "ar") ? $q->title_ar : $q->title;
            })
            ->editColumn('course_image', function ($q) {
                return ($q->course_image != null) ? '<img height="50px" src="' . asset('storage/uploads/' . $q->course_image) . '">' : 'N/A';
            })
            ->editColumn('status', function ($q) {
                $text = "";
                $text = ($q->published == 1) ? "<p class='text-white mb-1 font-weight-bold text-center bg-dark p-1 mr-1' >" . trans('labels.backend.courses.fields.published') . "</p>" : "";
                $text .= ($q->featured == 1) ? "<p class='text-white mb-1 font-weight-bold text-center bg-warning p-1 mr-1' >" . trans('labels.backend.courses.fields.featured') . "</p>" : "";
                $text .= ($q->trending == 1) ? "<p class='text-white mb-1 font-weight-bold text-center bg-success p-1 mr-1' >" . trans('labels.backend.courses.fields.trending') . "</p>" : "";
                $text .= ($q->popular == 1) ? "<p class='text-white mb-1 font-weight-bold text-center bg-primary p-1 mr-1' >" . trans('labels.backend.courses.fields.popular') . "</p>" : "";
                return $text;
            })
            // ->editColumn('price', function ($q) {
            //     if ($q->free == 1) {
            //         return trans('labels.backend.courses.fields.free');
            //     }
            //     return $q->price;
            // })
            ->addColumn('category', function ($q) {
                return (app()->getLocale() == "ar") ? $q->category->name_ar : $q->category->name;
            })
            ->addColumn('type', function ($q) {
                return (app()->getLocale() == "ar") ? $q->type->name_ar : $q->type->name;
            })
            ->rawColumns(['teachers', 'lessons', 'course_image', 'actions', 'status', 'type'])
            ->make();
    }

    public function getData2(Request $request)
    {
        $has_view = false;
        $has_delete = false;
        $has_edit = false;
        $has_evaluate = false;
        $has_article = false;
        $has_lessons = false;
        $has_tests = false;
        $has_attendance = false;
        $has_student_rate = false;
        $show_invitation = false;
        $has_landing = false;


        $courses = "";

        if (request('show_deleted') == 1) {
            if (!Gate::allows('course_delete')) {
                return abort(401);
            }
            $courses = Course::onlyTrashed()
                ->whereHas('category')
                ->ofTeacher()->orderBy('created_at', 'desc')->get();
        } else if (request('teacher_id') != "") {
            $id = request('teacher_id');
            $courses = Course::ofTeacher()
                ->whereHas('category')
                ->whereHas('teachers', function ($q) use ($id) {
                    $q->where('course_user.user_id', '=', $id);
                })->orderBy('created_at', 'desc')->get();
        } else if (request('cat_id') != "") {
            $id = request('cat_id');
            $courses = Course::ofTeacher()
                ->whereHas('category')
                ->where('category_id', '=', $id)->orderBy('created_at', 'desc')->get();
        } else {
            $courses = Course::ofTeacher()
                ->whereHas('category')
                ->orderBy('created_at', 'desc')->get();
        }


        if (auth()->user()->can('course_view')) {
            $has_view = true;
            $show_invitation = true;
        }
        if (auth()->user()->can('course_edit')) {
            $has_edit = true;
            $has_evaluate = true;
            $has_article = true;
            $has_attendance = true;
            $has_student_rate = true;
            $has_landing = true;
        }
        if (auth()->user()->can('blog_access')) {

            $has_article = true;
        }
        if (auth()->user()->can('lesson_delete')) {
            $has_delete = true;
        }

        if (auth()->user()->can('lesson_access')) {
            $has_lessons = true;
        }

        if (auth()->user()->can('test_access')) {
            $has_tests = true;
        }

        return DataTables::of($courses)
            ->addIndexColumn()
            ->addColumn('actions', function ($q) use ($has_view, $has_edit, $has_delete, $has_evaluate, $has_article, $has_lessons, $has_tests, $has_attendance, $has_student_rate, $show_invitation, $has_landing, $request) {
                $view = "";
                $edit = "";
                $delete = "";
                $evaluate = "";
                $article = "";

                $view .= '<div class="btn-group" role="group" aria-label="' . __('labels.backend.access.users.user_actions') . '">';

                if ($has_view) {
                    $view = view('backend.datatable.action-view')
                        ->with(['route' => route('admin.courses.show', ['course' => $q->id])])->render();
                }

                if ($has_edit) {
                    $edit = view('backend.datatable.action-edit')
                        ->with(['route' => route('admin.courses.edit', ['course' => $q->id])])
                        ->render();
                    $view .= $edit;
                }

                $view .= '
                  <div class="btn-group btn-group-sm" role="group">
                    <button id="userActions" type="button" class="btn btn-secondary dropdown-toggle" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                      ' . __('labels.general.more') . '
                    </button>
                    <div class="dropdown-menu drop" id="moreCourse" style=" max-height:200px;
                    overflow:scroll; " aria-labelledby="userActions">';


                if ($has_delete && \Auth::user()->id == 1) {
                    $view .= '<a tabindex="1" onclick="$(this).find(\'form\').submit();"  class="dropdown-item">' . __('buttons.general.crud.delete') . '
                            
                            <form action="' . route('admin.courses.destroy', ['course' => $q->id]) . '"
                                    method="POST" name="delete_item" style="display:none">' .
                        csrf_field() . method_field('DELETE') . '
                            </form>
                            </a>
                        ';
                }

                if ($has_lessons) {
                    $view .= '<a tabindex="1" href="' . route('admin.chapters.index', ['course_id' => $q->id]) . '" class="dropdown-item">' . __('menus.backend.sidebar.chapters.title') . '</a> ';
                }

                if ($has_lessons) {
                    $view .= '<a tabindex="1" href="' . route('admin.lessons.index', ['course_id' => $q->id]) . '" class="dropdown-item">' . __('menus.backend.sidebar.lessons.title') . '</a> ';
                }
                if ($has_lessons) {
                    $view .= '<a tabindex="1" href="' . route('admin.courses.location.index', ['course_id' => $q->id]) . '" class="dropdown-item">' . __('menus.backend.sidebar.courses.locations_times') . '</a> ';

                    // $view .='<a href="'.route('admin.courses.location.create', ['course_id' => $q->id]).'" class="dropdown-item">'.__('menus.backend.sidebar.courses.createLocation').'</a> ';
                }

                if ($has_tests) {
                    $view .= '<a href="' . route('admin.forms.index', ['course_id' => $q->id, 'form_type' => 'test']) . '" class="dropdown-item">' . __('menus.backend.sidebar.tests.title') . '</a> ';
                }

                if ($has_evaluate) {
                    // $view .='<a href="'.route('admin.rate.course.show', ['course' => $q->id]).'" class="dropdown-item">'.__('menus.backend.sidebar.rates.title').'</a> ';
                    $view .= '<a href="' . route('admin.forms.index', ['course_id' => $q->id, 'form_type' => 'rate']) . '" class="dropdown-item">' . __('menus.backend.sidebar.rates.title') . '</a> ';
                }
                if ($has_article) {
                    $view .= '<a href="' . route('admin.courses.articles.index', ['course' => $q->id]) . '" class="dropdown-item">' . __('menus.backend.sidebar.blogs.title') . '</a> ';
                }
                if ($has_attendance) {
                    $view .= '<a href="' . route('admin.Attendance.course_locations', ['course' => $q->id]) . '" class="dropdown-item">' . __('menus.backend.sidebar.attendance.title') . '</a> ';
                }
                if ($has_student_rate) {
                    $view .= '<a href="' . route('admin.courses.get_course_student', ['course' => $q->id]) . '" class="dropdown-item">' . __('menus.backend.sidebar.students.title') . '</a> ';
                }
                if ($show_invitation) {
                    $view .= '<a href="' . route('admin.courses.get_invitations', ['course' => $q->id]) . '" class="dropdown-item">' . __('menus.backend.sidebar.courses.invitation') . '</a> ';
                }


                if ($q->published == 1) {
                    $type = 'unpublish';
                } else {
                    $type = 'publish';
                }
                if (\Auth::user()->isAdmin()) {
                    $view .= '<a href="' . route('admin.courses.publish', ['course' => $q->id]) . '" class="dropdown-item">' . __('buttons.general.crud.' . $type) . '</a> ';
                }

                $view .= '
                    </div>
                  </div>
                </div>';


                return $view;
            })
            ->editColumn('teachers', function ($q) {
                $teachers = "";

                foreach ($q->teachers as $singleTeachers) {
                    app()->getLocale() == "en" ?
                        $teachers .= '<span class="label label-info label-many">' . $singleTeachers->name . ' </span></br>'
                        :
                        $teachers .= '<span class="label label-info label-many">' . $singleTeachers->name_ar . ' </span></br>';
                }

                return $teachers;
            })
            ->editColumn('title', function ($q) {

                return (app()->getLocale() == "ar") ? $q->title_ar : $q->title;
            })
            ->editColumn('type', function ($q) {

                return (app()->getLocale() == "ar") ? $q->type->name_ar : $q->type->name;
            })
            ->addColumn('lessons', function ($q) {
                $lesson = '<a href="' . route('admin.lessons.create', ['course_id' => $q->id]) . '" class="btn btn-success mb-1"><i class="fa fa-plus-circle"></i></a>  <a href="' . route('admin.lessons.index', ['course_id' => $q->id]) . '" class="btn mb-1 btn-warning text-white"><i class="fa fa-arrow-circle-right"></a>';
                return $lesson;
            })
            ->editColumn('course_image', function ($q) {
                return ($q->course_image != null) ? '<img height="50px" src="' . asset('storage/uploads/' . $q->course_image) . '">' : 'N/A';
            })
            ->editColumn('status', function ($q) {
                $text = "";
                $text = ($q->published == 1) ? "<p class='text-white mb-1 font-weight-bold text-center bg-dark p-1 mr-1' >" . trans('labels.backend.courses.fields.published') . "</p>" : "";
                $text .= ($q->featured == 1) ? "<p class='text-white mb-1 font-weight-bold text-center bg-warning p-1 mr-1' >" . trans('labels.backend.courses.fields.featured') . "</p>" : "";
                $text .= ($q->trending == 1) ? "<p class='text-white mb-1 font-weight-bold text-center bg-success p-1 mr-1' >" . trans('labels.backend.courses.fields.trending') . "</p>" : "";
                $text .= ($q->popular == 1) ? "<p class='text-white mb-1 font-weight-bold text-center bg-primary p-1 mr-1' >" . trans('labels.backend.courses.fields.popular') . "</p>" : "";
                return $text;
            })
            // ->editColumn('price', function ($q) {
            //     if ($q->free == 1) {
            //         return trans('labels.backend.courses.fields.free');
            //     }
            //     return $q->price;
            // })
            ->addColumn('category', function ($q) {
                return (app()->getLocale() == "ar") ? $q->category->name_ar : $q->category->name;
            })
            ->addColumn('type', function ($q) {
                return (app()->getLocale() == "ar") ? $q->type->name_ar : $q->type->name;
            })
            ->rawColumns(['teachers', 'lessons', 'course_image', 'actions', 'status', 'type'])
            ->make();
    }

    public function filterData(Request $request)
    {
        $types = session('locale') == 'en' ? Type::where('status', 1)->pluck('name', 'id')->prepend(__('labels.backend.courses.fields.choose-cat'), '') : Type::where('status', 1)->pluck('name_ar', 'id')->prepend(__('labels.backend.courses.fields.choose-cat'), '');
        $course_name = $request->course_name;
        $type = $request->type;
        $start_date = $request->start_date;
        $end_date = $request->end_date;
        $location = $request->location;
        $price = $request->price;
        $client = $request->client;
        $teacher = $request->teacher;
        $dateRange = $request->dateRange;
        $courses = new Course;

        if ($course_name)

            $courses = $courses->where(function ($query) use ($course_name) {

                $query->where('title_ar', 'like', '%' . $course_name . '%')->orWhere('title', 'like', '%' . $course_name . '%');
            });

        if ($type)
            $courses = $courses->where(function ($query) use ($type) {

                $query->where('type_id', $type);
            });
        if ($start_date)
            $courses = $courses->whereHas('locations', function ($q) use ($start_date) {
                $q->where('start_date', $start_date);
            });
        if ($end_date)
            $courses = $courses->whereHas('locations', function ($q) use ($end_date) {
                $q->where('end_date', $end_date);
            });
        // if ($location)

        // $getlocationsIds = Location::where('name_ar', 'like', $location)
        //     ->orWhere('name', 'like', $location)
        //     ->pluck('id')
        //     ->toArray();


        if ($price)
            $courses = $courses->whereHas('locations', function ($q) use ($price) {
                $q->where('price', $price);
            });
        if ($client) {
            // Get client IDs based on the client name filter
            $clientIds = Course_clints::where(function ($query) use ($client) {
                $query->where('name_ar', 'like', '%' . $client . '%')->orWhere('name', 'like', '%' . $client . '%');
            })->pluck('id')->toArray();

            // Get course IDs associated with the client IDs
            $courseIds = DB::table('course_client')
                ->whereIn('client_id', $clientIds)
                ->pluck('course_id')
                ->toArray();

            // Filter courses based on course IDs associated with the client
            $courses = $courses->whereHas('locations', function ($q) use ($courseIds) {
                $q->whereIn('course_locations.id', $courseIds);
            });
            // dd($courses->count());
        }

        if ($teacher) {

            // Search for users where name_ar is like the $teacher string
            $users = User::where('name_ar', 'like', '%' . $teacher . '%')->pluck('id')->toArray();

            if (empty($users)) {
                // If the first query returns empty, search using the CONCAT method
                $users = User::whereRaw("CONCAT(first_name, ' ', last_name) LIKE '%" . $teacher . "%'")
                    ->pluck('id')
                    ->toArray();
            }


            $courseUserIds = DB::table('teacher_profiles')->where('user_id', $users)->pluck('user_id')->toArray();

            // dd($courseUserIds);


            $courseUserIds = DB::table('course_user')->where('user_id', $courseUserIds)->pluck('course_id')->toArray();
            // dd($courseUserIds);


            // $courses = $courses->whereIn('course_id', $courseUserIds);
            $courses = $courses->whereHas('locations', function ($q) use ($courseUserIds) {
                $q->whereIn('course_locations.course_id', $courseUserIds);
            });
            // dd($courses);


        }

        if ($dateRange) {
            // dd($dateRange);

            $dates = explode(' to ', $dateRange);
            $start_date = $dates[0];
            $end_date = $dates[1];

            // dd($start_date);

            $courses = $courses->whereHas('locations', function ($q) use ($start_date, $end_date) {
                $q->where('start_date', '>=', $start_date)
                    ->where('start_date', '<=', $end_date);
            });
        }


        $courses = $courses->orderBy('created_at', 'DESC')->get();

        return view('backend.courses.index', compact('courses', 'types'));
    }


    /**
     * Display course create form
     * @return Factory|Application|View|null
     */
    public function create()
    {
        if (!Gate::allows('course_create')) {
            return abort(401);
        }

        $teachers = \App\Models\Auth\User::whereHas('roles', function ($q) {
            $q->where('role_id', 2);
        })->get()->pluck('name', 'id');

        if (app()->getLocale() == "ar") {
            $categories = Category::where('status', '=', 1)->pluck('name_ar', 'id');
            $types = Type::where('status', 1)->get()->pluck('name_ar', 'id');
            $course_classifications = CourseClassification::where('status', 1)->get()->pluck('name_ar', 'id');
            $levels = Level::all()->pluck('name_ar', 'id');
        } else {
            $categories = Category::where('status', '=', 1)->pluck('name', 'id');
            $types = Type::where('status', 1)->get()->pluck('name', 'id');
            $course_classifications = CourseClassification::where('status', 1)->get()->pluck('name', 'id');
            $levels = Level::all()->pluck('name', 'id');
        }

        // $rates = Forms::Latest()->where('form_type', 'rate')->get();
//        $impactMeasurments = Forms::Latest()->where('form_type', 'impact_measurments')->where('type', 'student')->get();
//        $programRecommendation = Forms::Latest()->where('form_type', 'program_recommendation')->get();

        return view('backend.courses.create', compact('teachers', 'course_classifications', 'categories', 'types', 'levels'));
    }

    /**
     * Store a newly created Course in storage.
     *
     * @param \App\Http\Requests\StoreCoursesRequest $request
     * @return \Illuminate\Http\Response
     */
    public function store(StoreCoursesRequest $request)
    {
//        dd($request->all());
        if (!Gate::allows('course_create')) {
            return abort(401);
        }

        if ($request->file('add_pdf')) {
            $requestFileSize = $request->file('add_pdf')->getSize();
        }

        $course = Course::create($request->all());
        $course->title = ucwords(strtolower($request->title));
        $course->save();

        if ($request->has('courseContentsJson')){
            $courseContents = json_decode($request->courseContentsJson);
            foreach ($courseContents as $courseContent) {
//                dd($courseContent);
                $mainContent = new Content();
                $mainContent->title = $courseContent->mainContent;
                $mainContent->save();

                $subContents = $courseContent->subContents;
                foreach ($subContents as $subContent) {
                    $subContentModel = new SubContent();
                    $subContentModel->title = $subContent;
                    $subContentModel->content_id = $mainContent->id;
                    $subContentModel->save();
                }
                $course->courseContent()->attach($mainContent->id);
            }
        }

        //attach resource links to the lesson
        if ($request->has('resourceLinks')){
            $links = explode(',', $request->input('resourceLinks'));

            foreach ($links as $link) {
                // Check if link isnt empty
                if($link == '') continue;

                // Get the title and url from the link
                list($title, $url) = explode('|', $link);

                // Save the link
                $courseResourceLink = new CourseResourceLink();
                $courseResourceLink->course_id = $course->id;
                $courseResourceLink->title = $title;
                $courseResourceLink->link = $url;
                $courseResourceLink->save();
            }
        }

        //Saving  videos
        if ($request->media_type != "") {
            $model_type = Course::class;
            $model_id = $course->id;
            $size = 0;
            $media = '';
            $url = '';
            $video_id = '';
            $name = $course->title . ' - video';

            if (($request->media_type == 'youtube') || ($request->media_type == 'vimeo')) {
                $video = $request->video;
                $url = $video;
                $video_id = array_last(explode('/', $request->video));
                $media = Media::where('url', $video_id)
                    ->where('type', '=', $request->media_type)
                    ->where('model_type', '=', 'App\Models\Course')
                    ->where('model_id', '=', $course->id)
                    ->first();
                $size = 0;
            } elseif ($request->media_type == 'upload') {
                if (\Illuminate\Support\Facades\Request::hasFile('video_file')) {
                    $file = \Illuminate\Support\Facades\Request::file('video_file');
                    $filename = time() . '-' . $file->getClientOriginalName();
                    $size = $file->getSize() / 1024;
                    $path = public_path() . '/storage/uploads/';
                    $file->move($path, $filename);

                    $video_id = $filename;
                    $url = asset('storage/uploads/' . $filename);

                    $media = Media::where('type', '=', $request->media_type)
                        ->where('model_type', '=', 'App\Models\Lesson')
                        ->where('model_id', '=', $course->id)
                        ->first();
                }
            } else if ($request->media_type == 'embed') {
                $url = $request->video;
                $filename = $course->title . ' - video';
            }


            if ($media == null) {
                $media = new Media();
                $media->model_type = $model_type;
                $media->model_id = $model_id;
                $media->name = $name;
                $media->url = $url;
                $media->type = $request->media_type;
                $media->file_name = $video_id;
                $media->size = 0;
                $media->save();
            }
        }

        if ($request->add_pdf) {
            $extension = array_last(explode('.', $request->file('add_pdf')->getClientOriginalName()));
            $name = array_first(explode('.', $request->file('add_pdf')->getClientOriginalName()));
            $filename = time() . '-' . str_slug($name) . '.' . $extension;
            // $size = $request->file('add_pdf')->getSize() / 1024;
            $request->file('add_pdf')->move(public_path('storage/uploads'), $filename);
            $model_type = Course::class;
            $model_id = $course->id;

            Media::create([
                'model_type' => $model_type,
                'model_id' => $model_id,
                'name' => $filename,
                'url' => asset('storage/uploads/' . $filename),
                'type' => 'course_pdf',
                'file_name' => $filename,
                'size' => $requestFileSize,
            ]);
        }

        if (($request->slug == "") || $request->slug == null) {
            $SlugExist = Course::where('slug', str_slug($request->title))->exists();
            if ($SlugExist == false)
                $course->slug = str_slug($request->title);
            else
                $course->slug = str_slug($request->title) . '-' . $course->id;
            $course->save();
        }

        $courseTestsIds = $course->tests()->where('form_type', 'test')->pluck('forms.id')->toArray();
        $AllFormsIdsToSync = array_merge($courseTestsIds, (array)$request->input('forms'));
        $course->forms()->sync(array_filter($AllFormsIdsToSync));


        if ($request->hasFile('course_image')) {

            if ($request->has('course_image_max_width') && $request->has('course_image_max_height')) {
                $extension = array_last(explode('.', $request->file('course_image')->getClientOriginalName()));
                $name = array_first(explode('.', $request->file('course_image')->getClientOriginalName()));
                $filename = time() . '-' . str_slug($name) . '.' . $extension;
                $file = $request->file('course_image');
                $image = Image::make($file);
                if (!file_exists(public_path('storage/uploads/thumb'))) {
                    mkdir(public_path('storage/uploads/thumb'), 0777, true);
                }
                // resize image and save it
                Image::make($file)->resize(50, 50)->save(public_path('storage/uploads/thumb') . '/' . $filename);

                $width = $image->width();
                $height = $image->height();
                if ($width > $request->{'course_image' . '_max_width'} && $height > $request->{'course_image' . '_max_height'}) {
                    $image->resize($request->{'course_image' . '_max_width'}, $request->{'course_image' . '_max_height'});
                } elseif ($width > $request->{'course_image' . '_max_width'}) {
                    $image->resize($request->{'course_image' . '_max_width'}, null, function ($constraint) {
                        $constraint->aspectRatio();
                    });
                } elseif ($height > $request->{'course_image' . '_max_width'}) {
                    $image->resize(null, $request->{'course_image' . '_max_height'}, function ($constraint) {
                        $constraint->aspectRatio();
                    });
                }
                $image->save(public_path('storage/uploads') . '/' . $filename);
                // $request = new Request(array_merge($request->all(), ['course_image' => $filename]));
                $course->course_image = $filename;
                $course->save();
            }
        }

        // $teachers = \Auth::user()->isAdmin() ? array_filter((array)$request->input('teachers')) : [\Auth::user()->id];
        // $course->teachers()->sync($teachers);


        return redirect()->route('admin.courses.index')->withFlashSuccess(trans('alerts.backend.general.created'));
    }

    /**
     * Show the form for editing Course.
     *
     * @param int $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        if (!Gate::allows('course_edit')) {
            return abort(401);
        }
        $teachers = \App\Models\Auth\User::whereHas('roles', function ($q) {
            $q->where('role_id', 2);
        })->get()->pluck('name', 'id');


        $course = Course::findOrFail($id);

        if (app()->getLocale() == "ar") {
            $categories = Category::where('status', '=', 1)->pluck('name_ar', 'id');
            $types = Type::where('status', 1)->get()->pluck('name_ar', 'id');
            $levels = Level::all()->pluck('name_ar', 'id');
            $locations = Location::all()->pluck('name_ar', 'id');
            $course_classifications = CourseClassification::where('status', 1)->get()->pluck('name_ar', 'id');
        } else {
            $categories = Category::where('status', '=', 1)->pluck('name', 'id');
            $types = Type::where('status', 1)->get()->pluck('name', 'id');
            $levels = Level::all()->pluck('name', 'id');
            $locations = Location::all()->pluck('name', 'id');
            $course_classifications = CourseClassification::where('status', 1)->get()->pluck('name', 'id');
        }

        // $rates=Rate::Latest()->get();
        $rates = Forms::Latest()->where('form_type', 'rate')->get();

        $impactMeasurments = Forms::Latest()->where('form_type', 'impact_measurments')->where('type', 'student')->get();
        $programRecommendation = Forms::Latest()->where('form_type', 'program_recommendation')->get();
        $contents = $course->courseContent()->get();
        // $impactMeasurments=[];
        // $programRecommendation=[];
        // $rates=$course->rates()->latest()->get();
        // $Course_clints= Course_clints::pluck('name', 'id');

        return view('backend.courses.edit', compact('course', 'course_classifications', 'teachers', 'contents', 'categories', 'types', 'levels', 'locations', 'rates', 'impactMeasurments', 'programRecommendation'));
    }

    /**
     * Update Course in storage.
     *
     * @param \App\Http\Requests\UpdateCoursesRequest $request
     * @param int $id
     * @return \Illuminate\Http\Response
     */
    public function update(UpdateCoursesRequest $request, $id)
    {

        if (!Gate::allows('course_edit')) {
            return abort(401);
        }
        $course = Course::findOrFail($id);

        if ($request->file('add_pdf')) {
            $requestFileSize = $request->file('add_pdf')->getSize();
        }

        $request = $this->saveFiles($request);

        if ($request->has('courseContentsJson')){
            //deatach all contents
            $course->courseContent()->delete();

            $courseContents = json_decode($request->courseContentsJson);
            foreach ($courseContents as $courseContent) {
                $mainContent = new Content();
                $mainContent->title = $courseContent->mainContent;
                $mainContent->save();

                $subContents = $courseContent->subContents;
                foreach ($subContents as $subContent) {
                    $subContentModel = new SubContent();
                    $subContentModel->title = $subContent->title;
                    $subContentModel->content_id = $mainContent->id;
                    $subContentModel->save();
                }

                $course->courseContent()->attach($mainContent->id);
            }
        }

        //attach resource links to the lesson
        if ($request->has('resourceLinks')){
            $links = explode(',', $request->input('resourceLinks'));
            $course->resources()->delete();

            foreach ($links as $link) {
                // Check if link isnt empty
                if($link == '') continue;

                // Get the title and url from the link
                list($title, $url) = explode('|', $link);

                // Save the link
                $courseResourceLink = new CourseResourceLink();
                $courseResourceLink->course_id = $course->id;
                $courseResourceLink->title = $title;
                $courseResourceLink->link = $url;
                $courseResourceLink->save();
            }
        }

        //Saving  videos
        if ($request->media_type != "" || $request->media_type != null || $request->add_pdf != null || $request->add_pdf != "") {
            if ($course->mediavideo) {
                $course->mediavideo->delete();
            }
            if ($course->mediaPdf) {
                $course->mediaPdf->delete();
            }

            $model_type = Course::class;
            $model_id = $course->id;
            $size = 0;
            $media = '';
            $url = '';
            $video_id = '';
            $name = $course->title . ' - video';
            $media = $course->mediavideo;
            if ($media == "") {
                $media = new  Media();
            }
            if ($request->media_type != 'upload') {
                if (($request->media_type == 'youtube') || ($request->media_type == 'vimeo')) {
                    $video = $request->video;
                    $url = $video;
                    $video_id = array_last(explode('/', $request->video));
                    $size = 0;
                } else if ($request->media_type == 'embed') {
                    $url = $request->video;
                    $filename = $course->title . ' - video';
                }
                $media->model_type = $model_type;
                $media->model_id = $model_id;
                $media->name = $name;
                $media->url = $url;
                $media->type = $request->media_type;
                $media->file_name = $video_id;
                $media->size = 0;
                $media->save();
            }

            if ($request->media_type == 'upload') {

                if ($request->video_file != null) {

                    $media = Media::where('type', '=', $request->media_type)
                        ->where('model_type', '=', 'App\Models\Course')
                        ->where('model_id', '=', $course->id)
                        ->first();

                    if ($media == null) {
                        $media = new Media();
                    }
                    $media->model_type = $model_type;
                    $media->model_id = $model_id;
                    $media->name = $name;
                    $media->url = url('storage/uploads/' . $request->video_file);
                    $media->type = $request->media_type;
                    $media->file_name = $request->video_file;
                    $media->size = 0;
                    $media->save();
                }
            }
            if ($request->add_pdf) {
                //    ///////////
                $model_type = Course::class;
                $model_id = $course->id;

                Media::create([
                    'model_type' => $model_type,
                    'model_id' => $model_id,
                    'name' => $request->add_pdf,
                    'url' => asset('storage/uploads/' . $request->add_pdf),
                    'type' => 'course_pdf',
                    'file_name' => $request->add_pdf,
                    'size' => $requestFileSize,
                ]);


                // /////////
            }
        }
        // dd($request->all());

        $course->update($request->all());
        if (($request->slug == "") || $request->slug == null) {

            $SlugExist = Course::where('slug', str_slug($request->title))->exists();
            if ($SlugExist == false)
                $course->slug = str_slug($request->title);
            else
                $course->slug = str_slug($request->title) . '-' . $course->id;
            $course->save();
        }

        // if ((int)$request->price == 0) {
        //     $course->price = NULL;
        //     $course->save(); 
        // }

        $courseTestsIds = $course->tests()->where('form_type', 'test')->pluck('forms.id')->toArray();
        $AllFormsIdsToSync = array_merge($courseTestsIds, (array)$request->input('forms'));
        $course->forms()->sync(array_filter($AllFormsIdsToSync));

        // $course->impactMeasurments()->sync(array_filter((array)$request->input('impacts')),false);
        // $course->programRecommendations()->sync(array_filter((array)$request->input('programs')));

        // $teachers = \Auth::user()->isAdmin() ? array_filter((array)$request->input('teachers')) : [\Auth::user()->id];
        // $course->teachers()->sync($teachers);

        return redirect()->route('admin.courses.index')->withFlashSuccess(trans('alerts.backend.general.updated'));
    }

    /**
     * Display Course.
     *
     * @param int $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        if (!Gate::allows('course_view')) {
            return abort(401);
        }
        $teachers = User::get()->pluck('name', 'id');
        $lessons = \App\Models\Lesson::where('course_id', $id)->get();
        // $tests = \App\Models\Test::where('course_id', $id)->get();
        $tests = \App\Models\Forms::whereHas('course', function ($query) use ($id) {
            $query->where('course_forms.course_id', '=', $id);
        })->get();

        $course = Course::findOrFail($id);
        $groups = $course->groups()->get();
        $courseTimeline = $course->courseTimeline()->orderBy('sequence', 'asc')->get();


        return view('backend.courses.show', compact('course', 'lessons', 'tests', 'courseTimeline', 'groups'));
    }

    public function invite()
    {
        if (!Gate::allows('course_view')) {
            return abort(401);
        }
        $user = User::get()->pluck('name', 'id');


        $course = Course::findOrFail(request('course_id'));


        $currentCourseLocation = CourseLocation::find(request('course_location_id'));

        return view('backend.courses.invitation', compact('currentCourseLocation', 'course', 'user'));
    }

    /**
     * Remove Course from storage.
     *
     * @param int $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        if (!Gate::allows('course_delete')) {
            return abort(401);
        }
        $course = Course::findOrFail($id);
        if ($course->students->count() >= 1 && count($course->groups) >= 1) {
            return redirect()->route('admin.courses.index')->withFlashDanger(trans('alerts.backend.general.delete_warning'));
        } else {
            $course->delete();
        }


        return redirect()->route('admin.courses.index')->withFlashSuccess(trans('alerts.backend.general.deleted'));
    }

    /**
     * Delete all selected Course at once.
     *
     * @param Request $request
     */
    public function massDestroy(Request $request)
    {
        if (!Gate::allows('course_delete')) {
            return abort(401);
        }
        if ($request->input('ids')) {
            $entries = Course::whereIn('id', $request->input('ids'))->get();

            foreach ($entries as $entry) {
                $entry->delete();
            }
        }
    }

    /**
     * Restore Course from storage.
     *
     * @param int $id
     * @return \Illuminate\Http\Response
     */
    public function restore($id)
    {
        if (!Gate::allows('course_delete')) {
            return abort(401);
        }
        $course = Course::onlyTrashed()->findOrFail($id);
        $course->restore();

        return redirect()->route('admin.courses.index')->withFlashSuccess(trans('alerts.backend.general.restored'));
    }

    /**
     * Permanently delete Course from storage.
     *
     * @param int $id
     * @return \Illuminate\Http\Response
     */
    public function perma_del($id)
    {
        if (!Gate::allows('course_delete')) {
            return abort(401);
        }
        $course = Course::onlyTrashed()->findOrFail($id);
        $course->forceDelete();

        return redirect()->route('admin.courses.index')->withFlashSuccess(trans('alerts.backend.general.deleted'));
    }

    /**
     * Permanently save Sequence from storage.
     *
     * @param Request
     */
    public function saveSequence(Request $request)
    {
        if (!Gate::allows('course_edit')) {
            return abort(401);
        }

        foreach ($request->list as $item) {
            $courseTimeline = CourseTimeline::find($item['id']);
            $courseTimeline->sequence = $item['sequence'];
            $courseTimeline->save();
        }

        return 'success';
    }

    /**
     * Publish / Unpublish courses
     *
     * @param Request
     */
    public function publish($id)
    {
        if (!Gate::allows('course_edit')) {
            return abort(401);
        }

        $course = Course::findOrFail($id);
        if ($course->published == 1) {
            $course->published = 0;
        } else {
            $course->published = 1;
        }
        $course->save();

        return back()->withFlashSuccess(trans('alerts.backend.general.updated'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param \Illuminate\Http\Request $request
     * @param int $id
     * @return \Illuminate\Http\Response
     */
    public function upload(Request $request)
    {
        //dd(request()->file);
        $request = $this->saveFiles($request);
        $location = $request->file;
        return response()->json(['location' => url("storage/uploads/" . $location)]);
    }

    public function getCourseStudent($course_id)
    {
        $course = Course::findOrFail($course_id);
        return view('backend.courses.students.index', compact('course'));
    }

    public function getCourseStudent2(Request $request)
    {
        $course = Course::findOrFail(request('course_id'));
        $currentCourseLocation = CourseLocation::find($request->course_location_id);

        return view('backend.courses.students.index2', compact('course', 'currentCourseLocation'));
    }

    public function getCourseStudent3(Request $request)
    {
        $course = Course::findOrFail(request('course_id'));

        $certificates = Certificate::where('course_id', request()->course_id)->get();
        $user = auth()->user();
        $isTeacher = $user->hasRole('teacher');
        if ($isTeacher) {
            $courses = $user->courses()->pluck('id')->toArray();

            $certificates = Certificate::whereIn('course_id', $courses)->get();
        }
        if (request('course_id') || request('course_location_id')) {

            $certificates = Certificate::where('course_id', request()->course_id)->get();
        }
        $currentCourseLocation = CourseLocation::find($request->course_location_id);

        return view('backend.courses.students.index3', compact('currentCourseLocation', 'course', 'certificates'));
    }

    public function getCourseInvitations($course_id)
    {
        $course = Course::findOrFail($course_id);
        $invitations = Invitation::where('course_id', $course_id)->get();
        $currentCourseLocation = CourseLocation::find(request('course_location_id'));

        return view('backend.courses.students.invitation', compact('currentCourseLocation', 'course', 'invitations'));
    }

    public function evaluateStudent($course_id, $student_id)
    {
        $course = Course::findOrFail($course_id);
        $rates = $course->forms()->where('form_type', 'rate')->where('type', 'teacher')->get();
        // dd($rates);
        return view('backend.courses.students.rate', compact('course', 'rates', 'student_id'));
    }

    public function indexHomeFreeCourse()
    {
        if (app()->getLocale() == "ar") {
            $courses = Course::latest()->has('category')->ofTeacher()->get()->pluck('title_ar', 'id');
        } else {
            $courses = Course::latest()->has('category')->ofTeacher()->get()->pluck('title', 'id');
        }
        $configCourse = Config::where('key', 'home_free_course')->first();

        return view('backend.courses.index_home_free', compact('courses', 'configCourse'));
    }

    public function setHomeFreeCourse(Request $request)
    {

        $course_id = $request->course_id;
        $config = Config::where('key', 'home_free_course')->first();
        if ($config) {
            $config->value = $course_id;
            $config->save();
        } else {
            $config = Config::create(['key' => 'home_free_course', 'value' => $course_id]);
        }
        return redirect()->back()->withFlashSuccess(trans('alerts.backend.general.updated'));
    }

    public function getContents($course_id)
    {
        $course = Course::findOrFail($course_id);
        $courseContents = $course->courseContent()->with('subContents')->get();

        return response()->json($courseContents);
    }

}
