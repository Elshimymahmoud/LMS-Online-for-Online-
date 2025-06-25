<?php

namespace App\Http\Controllers\Backend\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\Admin\StoreTestsRequest;
use App\Http\Requests\Admin\UpdateTestsRequest;
use App\Models\Auth\User;
use App\Models\Chapters;
use App\Models\Course;
use App\Models\CourseForms;
use App\Models\CourseGroup;
use App\Models\CourseTimeline;
use App\Models\Forms;
use App\Models\Location;
use App\Models\Type;


use App\Models\Test;
use App\Models\Question;
use App\Models\QuestionsOption;
use App\Models\UserCourseForm;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Gate;
use Yajra\DataTables\Facades\DataTables;
use App\Http\Controllers\Traits\FileUploadTrait;
use App\Models\CourseLocation;

class FormsController extends Controller
{
    use FileUploadTrait;
    //
    /**
     * Display a listing of Test.
     *
     * @return \Illuminate\Http\Response
     */
    ///////////////
    // =======================================================================
    // Forms type
    // [test,rate,training_data,impact_measurments,program_recommendation]
    // =======================================================================

    // //////////////

    public function ReArrange($id)
    {
        if (!Gate::allows('test_edit')) {
            return abort(401);
        }


        $test = Forms::findOrFail($id)->questions()->orderBy('questions.sequence')->get();
        $group = Forms::findOrFail($id)->group_id;


        return view('backend.tests.rearrange', compact('test','group'));
    }
    public function saveSequence(Request $request)
    {
        if (!Gate::allows('lesson_edit')) {
            return abort(401);
        }

        foreach ($request->list as $item) {
            $Question = Question::find($item['id']);
            $Question->sequence = $item['sequence'];
            $Question->save();
        }

        return 'success';
    }


    // ************************
    public function index()
    {

        // dd(request('form_type'));
        $form_type = request('form_type');
        if ($form_type == 'test') {
            return $this->IndexTest();
        } elseif ($form_type == 'impact_measurments') {
            return $this->IndexImpact();
        } elseif ($form_type == 'program_recommendation') {
            return $this->IndexProgramRec();
        }

        // elseif ($form_type == 'rate' ) {
        else {
            return $this->IndexForm();
        }
    }
    public function index2()
    {
        $form_type = request('form_type');
        // dd($form_type);
        if ($form_type == 'test') {
            return $this->IndexTest2();
        } elseif ($form_type == 'impact_measurments' || $form_type == 'program_recommendation') {
            // return $this->IndexImpact2();
            return $this->IndexForm2();
        }
        // elseif ($form_type == 'rate' ) {
        else {
            return $this->IndexForm2();
        }
    }
    public function indexStudent()
    {
        $form_type = request('form_type');
        if ($form_type == 'test') {
            return $this->IndexTestStudent();
        } elseif ($form_type == 'impact_measurments') {
            return $this->IndexImpactStudent();
        }
        // elseif ($form_type == 'rate' ) {
        else {
            return $this->IndexFormStudent();
        }
    }
    public function IndexTest()
    {

        $form_type = request('form_type') ? request('form_type') : 'test';

        if (!Gate::allows('test_access')) {
            return abort(401);
        }

        if (request('show_deleted') == 1) {
            if (!Gate::allows('test_delete')) {
                return abort(401);
            }
            $tests = Forms::where('form_type', $form_type)->onlyTrashed()->get();
        } else {
            $tests = Forms::where('form_type', $form_type)->get();
        }

        if (request('lesson_id') != "") {
            $tests = Forms::where('form_type', $form_type)->where('lesson_id', '=', request('lesson_id'))->orderBy('created_at', 'desc')->get();
        }
        if (request('course_id') != "" && (request('course_location_id') != "" || request('course_location_id') != null)) {

            $tests = Forms::whereHas('course', function ($q) {
                $q->where('course_forms.course_id', request('course_id'));
            })

                ->whereHas('courseLocations', function ($query) {

                    $query->where('course_location_id', '=', request('course_location_id'))
                        ->where('model_type', '=', 'App\Models\Forms');
                })->where('form_type', request('form_type'))
                ->orderBy('created_at', 'desc')
                ->get();
        }
        if (app()->getLocale() == "ar") {
            $courses = Course::latest()->ofTeacher()->pluck('title_ar', 'id')->prepend('Please select', '');
        } else {
            $courses = Course::latest()->ofTeacher()->pluck('title', 'id')->prepend('Please select', '');
        }
        $courseLocationsColl = session('locale') == 'ar' ? Course::find(request('course_id'))
            ->locations : Course::find(request('course_id'))->locations;
        $courseLocations = [];
        foreach ($courseLocationsColl as $key => $loc) {
            # code...

            $courseLocations[$loc->pivot->id] = session('locale') == 'ar' ? $loc->pivot->start_date . ' ' . $loc->name_ar : $loc->start_date . ' ' . $loc->name;
        }
        $course_location_id = request('course_location_id');
        return view('backend.tests.index', compact('tests', 'courses', 'courseLocations', 'course_location_id'));
    }
    public function IndexForm()
    {
        $course_id = request('course_id');
        $course = Course::find($course_id);

        $form_type = request('form_type');
        $rates = Forms::orderBy('id', 'desc')->where('form_type', $form_type)->get();
        if ($course_id) {
            $rates = Forms::where('form_type', $form_type)
                ->whereHas('course', function ($query) use ($course_id) {
                    $query->where('course_forms.course_id', '=', $course_id);
                })

                ->orderBy('id', 'desc')

                ->get();
        }

        return view('backend.rates.index', compact('rates', 'course_id', 'course'));
    }
    public function IndexImpact()
    {
        $impacts = Forms::orderBy('id', 'desc')->where('form_type', 'impact_measurments')->get();

        return view('backend.impactMeasurment.index', compact('impacts'));
    }
    public function IndexProgramRec()
    {
        $programRecommendations = Forms::orderBy('id', 'desc')->where('form_type', 'program_recommendation')->get();

        return view('backend.programRecommendation.index', compact('programRecommendations'));
    }
    public function IndexTest2()
    {

        $form_type = request('form_type') ? request('form_type') : 'test';

        if (!Gate::allows('test_access')) {
            return abort(401);
        }

        if (request('show_deleted') == 1) {
            if (!Gate::allows('test_delete')) {
                return abort(401);
            }
            $tests = Forms::where('form_type', $form_type)->onlyTrashed()->get();
        } else {
            $tests = Forms::where('form_type', $form_type)->get();
        }

        if (request('lesson_id') != "") {
            $tests = Forms::where('form_type', $form_type)->where('lesson_id', '=', request('lesson_id'))->orderBy('created_at', 'desc')->get();
        }
        if (request('course_id') != "" && (request('course_location_id') != "" || request('course_location_id') != null)) {

            $tests = Forms::whereHas('course', function ($q) {
                $q->where('course_forms.course_id', request('course_id'));
            })

                ->whereHas('courseLocations', function ($query) {

                    $query->where('course_location_id', '=', request('course_location_id'))
                        ->where('model_type', '=', 'App\Models\Forms');
                })->where('form_type', request('form_type'))
                ->orderBy('created_at', 'desc')
                ->get();
        }
        if (app()->getLocale() == "ar") {
            $courses = Course::latest()->ofTeacher()->pluck('title_ar', 'id')->prepend('Please select', '');
        } else {
            $courses = Course::latest()->ofTeacher()->pluck('title', 'id')->prepend('Please select', '');
        }
        $courseLocationsColl = session('locale') == 'ar' ? Course::find(request('course_id'))
            ->locations : Course::find(request('course_id'))->locations;
        $courseLocations = [];
        foreach ($courseLocationsColl as $key => $loc) {
            # code...

            $courseLocations[$loc->pivot->id] = session('locale') == 'ar' ? $loc->pivot->start_date . ' ' . $loc->name_ar : $loc->start_date . ' ' . $loc->name;
        }
        $course_location_id = request('course_location_id');
        $currentCourseLocation = CourseLocation::find(request('course_location_id'));
        $course = Course::find(request('course_id'));

        return view('backend.tests.index2', compact('course', 'currentCourseLocation', 'tests', 'courses', 'courseLocations', 'course_location_id'));
    }
    public function IndexForm2()
    {
        $course_id = request('course_id');
        $course = Course::findOrFail(request('course_id'));
        $student_id = request('student_id') ? request('student_id') : null;
        $user = [];
        if ($student_id) {
            $user = User::find($student_id);
        }
        $form_type = request('form_type');
        $rates = Forms::orderBy('id', 'desc')->where('form_type', $form_type)->get();
        if ($course_id) {
            $rates = Forms::where('form_type', $form_type)
                ->whereHas('course', function ($query) use ($course_id) {
                    $query->where('course_forms.course_id', '=', $course_id);
                })

                ->orderBy('id', 'desc')

                ->get();
        }
        // dd($rates);

        $currentCourseLocation = CourseLocation::find(request('course_location_id'));

        return view('backend.rates.index', compact('currentCourseLocation', 'rates', 'course_id', 'course', 'student_id', 'user'));
    }

    public function IndexImpactStudent()
    {
        $impacts = Forms::orderBy('id', 'desc')->where('form_type', 'impact_measurments')->get();

        return view('backend.impactMeasurment.index', compact('impacts'));
    }
    public function IndexTestStudent()
    {

        $form_type = request('form_type') ? request('form_type') : 'test';
        $course_location_id = request('course_location_id');
        $course_id = request('course_id');
        $student_id = request('student_id');
        $user = [];
        $course = [];
        if (!Gate::allows('test_access')) {
            return abort(401);
        }

        if (request('show_deleted') == 1) {
            if (!Gate::allows('test_delete')) {
                return abort(401);
            }
            $tests = Forms::where('form_type', $form_type)->onlyTrashed()->get();
        } else {
            $tests = Forms::where('form_type', $form_type)->get();
        }

        if (request('lesson_id') != "") {
            $tests = Forms::where('form_type', $form_type)->where('lesson_id', '=', request('lesson_id'))->orderBy('created_at', 'desc')->get();
        }
        if (request('course_id') != "" && (request('course_location_id') != "" || request('course_location_id') != null)) {

            $tests = Forms::whereHas('course', function ($q) {
                $q->where('course_forms.course_id', request('course_id'));
            })

                ->whereHas('courseLocations', function ($query) {

                    $query->where('lesson_course_location.course_location_id', '=', request('course_location_id'))
                        ->where('lesson_course_location.model_type', '=', 'App\Models\Forms');
                })
                ->where('form_type', request('form_type'))
                ->orderBy('created_at', 'desc')
                ->get();
        }
        if (app()->getLocale() == "ar") {
            $courses = Course::latest()->ofTeacher()->pluck('title_ar', 'id')->prepend('Please select', '');
        } else {
            $courses = Course::latest()->ofTeacher()->pluck('title', 'id')->prepend('Please select', '');
        }
        $courseLocationsColl = session('locale') == 'ar' ? Course::find(request('course_id'))
            ->locations : Course::find(request('course_id'))->locations;
        $courseLocations = [];
        foreach ($courseLocationsColl as $key => $loc) {
            # code...

            $courseLocations[$loc->pivot->id] = session('locale') == 'ar' ? $loc->pivot->start_date . ' ' . $loc->name_ar : $loc->start_date . ' ' . $loc->name;
        }


        if ($student_id)
            $user = User::find($student_id);
        if ($course_id)
            $course = Course::find($course_id);
        $currentCourseLocation = CourseLocation::find(request('course_location_id'));

        return view('backend.tests.index2Student', compact('tests', 'courses', 'courseLocations', 'course_location_id', 'course_id', 'student_id', 'user', 'course', 'currentCourseLocation'));
    }
    public function IndexFormStudent()
    {
        $course_id = request('course_id');
        $course = Course::findOrFail(request('course_id'));
        $student_id = request('student_id') ? request('student_id') : null;
        $user = [];
        if ($student_id) {
            $user = User::find($student_id);
        }
        $form_type = request('form_type');
        $rates = Forms::orderBy('id', 'desc')->where('form_type', $form_type)->get();
        if ($course_id) {
            $rates = Forms::where('form_type', $form_type)
                ->whereHas('course', function ($query) use ($course_id) {
                    $query->where('course_forms.course_id', '=', $course_id);
                })

                ->orderBy('id', 'desc')

                ->get();
        }

        return view('backend.rates.indexStudent', compact('rates', 'course_id', 'course', 'student_id', 'user'));
    }

    public function makeStudentRate(Request $request)
    {

        $course = Course::findOrFail($request->course_id);
        $rates[] = Forms::find($request->id);

        $student_id = $request->student_id;
        $user = User::find($student_id);
        return view('backend.courses.students.rateByAdmin', compact('course', 'rates', 'student_id', 'user'));
    }
    public function makeStudentTest(Request $request)
    {

        $course = Course::findOrFail($request->course_id);
        $rates[] = Forms::find($request->id);

        $student_id = $request->student_id;
        $user = User::find($student_id);
        return view('backend.courses.students.testByAdmin', compact('course', 'rates', 'student_id', 'user'));
    }
    /**
     * Display a listing of Courses via ajax DataTable.
     *
     * @return \Illuminate\Http\Response
     */
    public function getData(Request $request)
    {
        if ($request->form_type == 'test') {
            return $this->getDataTest($request);
        }
    }
    public function getDataTest(Request $request)
    {
        $has_view = false;
        $has_delete = false;
        $has_edit = false;
        $has_copy = false;

        $tests = "";

        if ($request->course_id != "") {
            $tests = Forms::whereHas('course', function ($q) use ($request) {
                $q->where('course_forms.course_id', $request->course_id);
            })
                ->where('form_type', $request->form_type)
                ->orderBy('created_at', 'desc')
                ->get();
            // $tests = Forms::where('course_id', '=', $request->course_id)->orderBy('created_at', 'desc')->get();
        }
        if ($request->course_id != "" && ($request->course_location_id != "" || $request->course_location_id != null)) {

            $tests = Forms::whereHas('course', function ($q) use ($request) {
                $q->where('course_forms.course_id', $request->course_id);
            })

                ->whereHas('courseLocations', function ($query) use ($request) {

                    $query->where('course_location_id', '=', $request->course_location_id)
                        ->where('model_type', '=', 'App\Models\Forms');
                })->where('form_type', $request->form_type)
                ->orderBy('created_at', 'desc')
                ->get();
        }

        if (request('show_deleted') == 1) {
            if (!Gate::allows('test_delete')) {
                return abort(401);
            }
            $tests = Forms::onlyTrashed()->get();
        }

        if (auth()->user()->can('test_view')) {
            $has_view = true;
        }
        if (auth()->user()->can('test_edit')) {
            $has_edit = true;
            $has_copy = true;
            $has_arrang = true;
        }
        if (auth()->user()->can('test_delete')) {
            $has_delete = true;
        }

        return DataTables::of($tests)
            ->addIndexColumn()
            ->addColumn('actions', function ($q) use ($has_view, $has_edit, $has_delete, $has_copy, $has_arrang, $request) {
                $view = "";
                $edit = "";
                $delete = "";
                $arrang = "";

                if ($request->show_deleted == 1) {
                    return view('backend.datatable.action-trashed')->with(['route_label' => 'admin.tests', 'label' => 'test', 'value' => $q->id]);
                }
                // if ($has_view) {
                //     $view = view('backend.datatable.action-view')
                //         ->with(['route' => route('admin.tests.show', ['test' => $q->id])])->render();
                // }
                if ($has_edit) {
                    $edit = view('backend.datatable.action-edit')
                        ->with(['route' => route('admin.forms.edit', ['test' => $q->id, 'form_type' => request('form_type'), 'course_id' => request('course_id')])])
                        ->render();
                    $view .= $edit;
                }
                if ($has_edit) {
                    $edit = view('backend.datatable.action-result')
                        ->with(['route' => route('admin.results.index', ['test' => $q->id, 'form_type' => request('form_type'), 'course_id' => request('course_id')])])
                        ->render();
                    $view .= $edit;
                }

                if ($has_delete && \Auth::user()->id == 1) {
                    $delete = view('backend.datatable.action-delete')
                        ->with(['route' => route('admin.forms.destroy', ['test' => $q->id, 'form_type' => request('form_type'), 'course_id' => request('course_id')])])
                        ->render();
                    $view .= $delete;
                }
                if ($has_copy) {
                    $copy = view('backend.datatable.action-copy')
                        ->with(['route' => route('admin.forms.copy', ['test' => $q->id, 'form_type' => request('form_type'), 'course_id' => request('course_id')])])
                        ->render();
                    $view .= $copy;
                }
                if ($has_arrang) {
                    $arrang = view('backend.datatable.action-arrang')
                        ->with(['route' => route('admin.forms.rearrange', ['test' => $q->id, 'form_type' => request('form_type'), 'course_id' => request('course_id')])])
                        ->render();
                    $view .= $arrang;
                }

                return $view;
            })
            ->editColumn('questions', function ($q) use ($request) {
                return "<span>" . count($q->questions) . "</span>";

                return count($q->questions);
            })

            ->editColumn('course', function ($q) {
                if (app()->getLocale() == "ar") {
                    return ($q->course) ? $q->course->pluck('title_ar')->toArray() : "N/A";
                } else {
                    return ($q->course) ? $q->course->pluck('title')->toArray() : "N/A";
                }
            })

            ->editColumn('lesson', function ($q) {
                return ($q->lesson) ? $q->lesson->title : "N/A";
            })

            ->editColumn('published', function ($q) {
                return ($q->published == 1) ? "Yes" : "No";
            })
            ->rawColumns(['actions', 'questions'])
            ->make();
    }
    public function getData2(Request $request)
    {
        if ($request->form_type == 'test' && $request->student_id) {
            return $this->getDataTest2Student($request);
        }
        if ($request->form_type == 'test') {
            return $this->getDataTest2($request);
        }
    }

    public function getDataTest2(Request $request)
    {
        $has_view = false;
        $has_delete = false;
        $has_edit = false;
        $has_copy = false;

        $tests = "";

        if ($request->course_id != "") {
            $tests = Forms::whereHas('course', function ($q) use ($request) {
                $q->where('course_forms.course_id', $request->course_id);
            })
                ->where('form_type', $request->form_type)
                ->orderBy('created_at', 'desc')
                ->get();
            // $tests = Forms::where('course_id', '=', $request->course_id)->orderBy('created_at', 'desc')->get();
        }
        if ($request->course_id != "" && ($request->course_location_id != "" || $request->course_location_id != null)) {

            $tests = Forms::whereHas('course', function ($q) use ($request) {
                $q->where('course_forms.course_id', $request->course_id);
            })

                ->whereHas('courseLocations', function ($query) use ($request) {

                    $query->where('course_location_id', '=', $request->course_location_id)
                        ->where('model_type', '=', 'App\Models\Forms');
                })->where('form_type', $request->form_type)
                ->orderBy('created_at', 'desc')
                ->get();
        }

        if (request('show_deleted') == 1) {
            if (!Gate::allows('test_delete')) {
                return abort(401);
            }
            $tests = Forms::onlyTrashed()->get();
        }

        if (auth()->user()->can('test_view')) {
            $has_view = true;
        }
        if (auth()->user()->can('test_edit')) {
            $has_edit = true;
            $has_copy = true;
            $has_arrang = true;
        }
        if (auth()->user()->can('test_delete')) {
            $has_delete = true;
        }

        return DataTables::of($tests)
            ->addIndexColumn()
            ->addColumn('actions', function ($q) use ($has_view, $has_edit, $has_delete, $has_copy, $has_arrang, $request) {
                $view = "";
                $edit = "";
                $delete = "";
                $arrang = "";

                if ($request->show_deleted == 1) {
                    return view('backend.datatable.action-trashed')->with(['route_label' => 'admin.tests', 'label' => 'test', 'value' => $q->id]);
                }
                // if ($has_view) {
                //     $view = view('backend.datatable.action-view')
                //         ->with(['route' => route('admin.tests.show', ['test' => $q->id])])->render();
                // }
                if ($has_edit) {
                    $edit = view('backend.datatable.action-edit')
                        ->with(['route' => route('admin.forms.edit', ['test' => $q->id, 'form_type' => request('form_type'), 'course_id' => request('course_id')])])
                        ->render();
                    $view .= $edit;
                }
                if ($has_edit) {
                    $edit = view('backend.datatable.action-result')
                        ->with(['route' => route('admin.results.index', ['test' => $q->id, 'form_type' => request('form_type'), 'course_id' => request('course_id')])])
                        ->render();
                    $view .= $edit;
                }

                if ($has_delete && \Auth::user()->id == 1) {
                    $delete = view('backend.datatable.action-delete')
                        ->with(['route' => route('admin.forms.destroy', ['test' => $q->id, 'form_type' => request('form_type'), 'course_id' => request('course_id')])])
                        ->render();
                    $view .= $delete;
                }
                if ($has_copy) {
                    $copy = view('backend.datatable.action-copy')
                        ->with(['route' => route('admin.forms.copy', ['test' => $q->id, 'form_type' => request('form_type'), 'course_id' => request('course_id')])])
                        ->render();
                    $view .= $copy;
                }
                if ($has_arrang) {
                    $arrang = view('backend.datatable.action-arrang')
                        ->with(['route' => route('admin.forms.rearrange', ['test' => $q->id, 'form_type' => request('form_type'), 'course_id' => request('course_id')])])
                        ->render();
                    $view .= $arrang;
                }

                return $view;
            })
            ->editColumn('questions', function ($q) use ($request) {
                return "<span>" . count($q->questions) . "</span>";

                return count($q->questions);
            })

            ->editColumn('course', function ($q) {
                if (app()->getLocale() == "ar") {
                    return ($q->course) ? $q->course->pluck('title_ar')->toArray() : "N/A";
                } else {
                    return ($q->course) ? $q->course->pluck('title')->toArray() : "N/A";
                }
            })

            ->editColumn('lesson', function ($q) {
                return ($q->lesson) ? $q->lesson->title : "N/A";
            })

            ->editColumn('published', function ($q) {
                return ($q->published == 1) ? "Yes" : "No";
            })
            ->rawColumns(['actions', 'questions'])
            ->make();
    }
    public function getDataTest2Student(Request $request)
    {
        $has_view = false;
        $has_delete = false;
        $has_edit = false;
        $has_copy = false;

        $tests = "";

        if ($request->course_id != "") {
            $tests = Forms::whereHas('course', function ($q) use ($request) {
                $q->where('course_forms.course_id', $request->course_id);
            })
                ->where('form_type', $request->form_type)
                ->orderBy('created_at', 'desc')
                ->get();
            // $tests = Forms::where('course_id', '=', $request->course_id)->orderBy('created_at', 'desc')->get();
        }
        if ($request->course_id != "" && ($request->course_location_id != "" || $request->course_location_id != null)) {

            $tests = Forms::whereHas('course', function ($q) use ($request) {
                $q->where('course_forms.course_id', $request->course_id);
            })

                ->whereHas('courseLocations', function ($query) use ($request) {

                    $query->where('course_location_id', '=', $request->course_location_id)
                        ->where('model_type', '=', 'App\Models\Forms');
                })->where('form_type', $request->form_type)
                ->orderBy('created_at', 'desc')
                ->get();
        }

        if (request('show_deleted') == 1) {
            if (!Gate::allows('test_delete')) {
                return abort(401);
            }
            $tests = Forms::onlyTrashed()->get();
        }

        if (auth()->user()->can('test_view')) {
            $has_view = true;
        }
        if (auth()->user()->can('test_edit')) {
            $has_edit = true;
            $has_copy = true;
            $has_arrang = true;
        }
        if (auth()->user()->can('test_delete')) {
            $has_delete = true;
        }

        return DataTables::of($tests)
            ->addIndexColumn()
            ->addColumn('actions', function ($q) use ($has_view, $has_edit, $has_delete, $has_copy, $has_arrang, $request) {
                $view = "";
                $edit = "";
                $delete = "";
                $arrang = "";

                if ($request->show_deleted == 1) {
                    return view('backend.datatable.action-trashed')->with(['route_label' => 'admin.tests', 'label' => 'test', 'value' => $q->id]);
                }
                // if ($has_view) {
                //     $view = view('backend.datatable.action-view')
                //         ->with(['route' => route('admin.tests.show', ['test' => $q->id])])->render();
                // }
                // if ($has_edit) {
                //     $edit = view('backend.datatable.action-edit')
                //         ->with(['route' => route('admin.forms.edit', ['test' => $q->id, 'form_type' => request('form_type'), 'course_id' => request('course_id')])])
                //         ->render();
                //     $view .= $edit;
                // }
                if ($has_edit) {

                    $edit = view('backend.datatable.action-edit')
                        ->with(['route' => route('admin.forms.make_student_test', ['id' => $q->id, 'form_type' => request('form_type'), 'course_id' => request('course_id'), 'student_id' => request('student_id'), 'course_location_id' => request('course_location_id')])])
                        ->render();
                    $view .= $edit;
                }
                if ($has_edit) {
                    $edit = view('backend.datatable.action-result')
                        ->with(['route' => route('admin.results.index', ['test' => $q->id, 'form_type' => request('form_type'), 'course_id' => request('course_id'), 'student_id' => request('student_id')])])
                        ->render();
                    $view .= $edit;
                }

                // if ($has_delete) {
                //     $delete = view('backend.datatable.action-delete')
                //         ->with(['route' => route('admin.forms.destroy', ['test' => $q->id, 'form_type' => request('form_type'), 'course_id' => request('course_id')])])
                //         ->render();
                //     $view .= $delete;
                // }
                // if ( $has_copy) {
                //     $copy = view('backend.datatable.action-copy')
                //         ->with(['route' => route('admin.forms.copy', ['test' => $q->id, 'form_type' => request('form_type'), 'course_id' => request('course_id')])])
                //         ->render();
                //     $view .= $copy;
                // }
                // if ( $has_arrang) {
                //     $arrang = view('backend.datatable.action-arrang')
                //         ->with(['route' => route('admin.forms.rearrange', ['test' => $q->id, 'form_type' => request('form_type'), 'course_id' => request('course_id')])])
                //         ->render();
                //     $view .= $arrang;
                // }

                return $view;
            })
            ->editColumn('questions', function ($q) use ($request) {
                return "<span>" . count($q->questions) . "</span>";

                return count($q->questions);
            })

            ->editColumn('course', function ($q) {
                if (app()->getLocale() == "ar") {
                    return ($q->course) ? $q->course->pluck('title_ar')->toArray() : "N/A";
                } else {
                    return ($q->course) ? $q->course->pluck('title')->toArray() : "N/A";
                }
            })

            ->editColumn('lesson', function ($q) {
                return ($q->lesson) ? $q->lesson->title : "N/A";
            })

            ->editColumn('published', function ($q) {
                return ($q->published == 1) ? "Yes" : "No";
            })
            ->rawColumns(['actions', 'questions'])
            ->make();
    }
    /**
     * Show the form for creating new Test.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $form_type = request()->form_type;
        if ($form_type == 'test') {
            return $this->createTest();
        }
        // elseif ($form_type == 'impact_measurments') {
        //     // return $this->createImpact();
        // }
        // if ($form_type == 'rate') {
        else {
            if (request('course_id')) {
                return $this->createRate2();
            }
            return $this->createRate();
        }
    }

    public function createTest()
    {
        $form_type = request()->form_type;

        if (!Gate::allows('test_create')) {
            return abort(401);
        }
        $courses = \App\Models\Course::latest()->ofTeacher()->get();
        $courses_ids = $courses->pluck('id');
        $lessons = \App\Models\Lesson::whereIn('course_id', $courses_ids)->get()->pluck('title', 'id')->prepend('Please select', '');

        if (app()->getLocale() == "ar") {
            $courses = $courses->pluck('title_ar', 'id')->prepend('أختار', '');
            $chapters = Chapters::where('course_id', request()->course_id)->pluck('title_ar', 'id')->prepend('أختار', '');
        } else {
            $courses = $courses->pluck('title', 'id')->prepend('أختار', '');
            $chapters = Chapters::where('course_id', request()->course_id)->pluck('title', 'id')->prepend('أختار', '');
        }
        $courseLocations = session('locale') == 'ar' ? Course::find(request()->course_id)->locations->pluck('name_ar', 'pivot.id') : Course::find(request()->course_id)->locations->pluck('name', 'pivot.id');

        return view('backend.tests.create2', compact('courses', 'lessons', 'chapters', 'form_type', 'courseLocations'));
    }

    public function createRate()
    {

        return view('backend.rates.create2');
    }
    public function createRate2()
    {
        $course_id = request('course_id');
        $course = Course::find($course_id);
        if (!Gate::allows('course_create')) {
            return abort(401);
        }
        $teachers = \App\Models\Auth\User::whereHas('roles', function ($q) {
            $q->where('role_id', 2);
        })->get()->pluck('name', 'id');

        if (app()->getLocale() == "ar") {

            $types = Type::all()->pluck('name_ar', 'id');
        } else {

            $types = Type::all()->pluck('name', 'id');
        }
        // $rates=Rate::Latest()->get();

        /**
         * rates to create rates depend on form_type
         * impactMeasurments depend on form_type
         * programRecommendation depend on form_type
         * at the end we ruturn only one varaibe ('rates') 
         */
        $rates = Forms::Latest()->where('form_type', request('form_type'))->get();

        return view('backend.rates.create22', compact('types',  'rates', 'course'));
    }
    public function createImpact()
    {

        return view('backend.impactMeasurment.create2');
    }
    /**
     * Store a newly created Test in storage.
     *
     * @param  \App\Http\Requests\StoreTestsRequest  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {

        $form_type = request()->form_type;
        if ($form_type == 'test' || $form_type == 'group_test') {
            return $this->storeTest($request);
        }
        // elseif ($form_type == 'rate'||$form_type == 'impact_measurments') {
        else {
            if (request('course_id')) {
                return $this->storeRate2($request);
            }
            return $this->storeRate($request);
        }
    }
    public function storeTest(Request $request)
    {

        $StoreTestsRequest = new StoreTestsRequest();
        $StoreTestsRequest->rules($request);
        $this->validate($request, [
            'course_id' => 'required',
            'chapter_id' => 'required',
            'title' => 'required',
        ], ['course_id.required' => 'The course field is required']);

        if (!Gate::allows('test_create')) {
            return abort(401);
        }

        $test = Forms::create($request->all());

        $request = $this->saveAllFiles($request, 'downloadable_files', Forms::class, $test);

        // save course location in pivot table
        $course_location_ids = [];
        foreach ($request->course_location_id as $key => $id) {
            # code...
            $course_location_ids[$id] = ['model_type' => get_class($test)];
        }
        $test->courseLocations()->attach($course_location_ids);
        // course forms
        $newCourseForms = new CourseForms;
        $newCourseForms->course_id = $request->course_id;
        $newCourseForms->forms_id = $test->id;
        $newCourseForms->save();

        if ($request->slug == "" || $request->slug == null) {
            $SlugExist = Forms::where('slug', str_slug($request->title))->exists();
            if ($SlugExist == false) {
                $test->slug = str_slug($request->title);
            } else {
                $test->slug = str_slug($request->title) . '-' . $test->id;
            }
        }
        // //////////////

        $test->save();

        if (is_array($request->q)) {
            foreach ($request->q as $q) {
                // dd($q);
                $new_q = [];
                $new_q['question'] = $q['question'];
                $new_q['question_ar'] = $q['question_ar'];
                $new_q['question_type'] = $q['question_type'];
                $new_q['score'] = $q['score'];
                $new_q['title'] = $q['title'];
                $new_q['title_ar'] = $q['title_ar'];

                $new_q['user_id'] = auth()->user()->id;
                $question = Question::create($new_q);
                $question->tests()->sync($test->id);

                if (isset($q['option_text']) && count($q['option_text']) > 0) {
                    foreach ($q['option_text'] as $q_option_index => $q_option) {

                        QuestionsOption::create([
                            'question_id' => $question->id,
                            'option_text' => $q['option_text'][$q_option_index],
                            'option_text_ar' => $q['option_text_ar'][$q_option_index],
                            'correct' => @(int)$q['correct'][$q_option_index]
                        ]);
                    }
                }
            }
        }

        $sequence = 1;
        // if (count($test->course->courseTimeline) > 0) {
        if (count($test->getcourseById($request->course_id)->courseTimeline) > 0) {

            // $sequence = $test->course->courseTimeline->max('sequence');
            $sequence = $test->getcourseById($request->course_id)->courseTimeline->max('sequence');

            $sequence = $sequence + 1;
        }

        if ($test->published == 1) {
            $timeline = CourseTimeline::where('model_type', '=', Forms::class)
                ->where('model_id', '=', $test->id)
                ->where('course_id', $request->course_id)->first();
            if ($timeline == null) {
                $timeline = new CourseTimeline();
            }
            $timeline->course_id = $request->course_id;
            $timeline->model_id = $test->id;
            $timeline->model_type = Forms::class;
            $timeline->sequence = $sequence;
            $timeline->save();
        }
        //if form type is group test redirect to group test page else redirect to test page
        if ($request->form_type == 'group_test') {
            return redirect()->route('admin.courses.groups.tests.index', ['group' => $request->group_id])->withFlashSuccess(trans('alerts.backend.general.created'));
        }
        else{
            return redirect()->route('admin.forms2.index2', ['course_id' => $request->course_id, 'form_type' => $request->form_type])->withFlashSuccess(trans('alerts.backend.general.created'));

        }
    }
    public function storeRate($request)
    {
        //
        //  dd($request->all());
        $this->validate($request, [
            'title' => 'required',
            'title_ar' => 'required',
        ]);



        $rate = Forms::create($request->all());
        if ($request->course_id != null) {
            $courseRate = new CourseForms();
            $courseRate->forms_id = $rate->id;
            $courseRate->course_id = $request->course_id;
            $courseRate->save();
        }

        if (is_array($request->q)) {
            foreach ($request->q as $q) {
                // dd($q);
                $new_q = [];
                $new_q['question'] = $q['question'];
                $new_q['question_ar'] = $q['question_ar'];
                $new_q['question_type'] = $q['question_type'];
                $new_q['user_id'] = auth()->user()->id;
                $question = Question::create($new_q);
                $question->tests()->sync($rate->id);

                if (isset($q['option_text']) && count($q['option_text']) > 0) {
                    foreach ($q['option_text'] as $q_option_index => $q_option) {

                        QuestionsOption::create([
                            'question_id' => $question->id,
                            'option_text' => $q['option_text'][$q_option_index],
                            'option_text_ar' => $q['option_text_ar'][$q_option_index],
                            'correct' => @(int)$q['correct'][$q_option_index]
                        ]);
                    }
                }
            }
        }

        return redirect()->route('admin.forms.index', ['form_type' => $request->form_type, 'course_id' => $request->course_id])->withFlashSuccess(trans('alerts.backend.general.created'));
    }
    public function storeRate2($request)
    {

        $course_id = request('course_id');

        $course = Course::find($course_id);

        $courseTestsIds = $course->tests()->where('form_type', $request->form_type)->pluck('forms.id')->toArray();

        $AllFormsIdsToSync = array_merge($courseTestsIds, (array)$request->input('forms'));

        $courses = $course->forms()->attach(array_filter($AllFormsIdsToSync));

        return redirect()->route('admin.forms2.index2', ['form_type' => $request->form_type, 'course_id' => $request->course_id])->withFlashSuccess(trans('alerts.backend.general.created'));
    }

    /**
     * Show the form for editing Test.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $form_type = request('form_type') ?? Forms::findOrFail($id)->form_type;
        if ($form_type == 'test' || $form_type == 'group_test') {
            return $this->editTest($id);
        }
        // elseif ($form_type == 'rate') {
        else {
            return $this->editRate($id);
        }
    }
    public function editTest($id)
    {


        if (!Gate::allows('test_edit')) {
            return abort(401);
        }
        $courses = \App\Models\Course::latest()->ofTeacher()->get();

        $courses_ids = $courses->pluck('id');
        $lessons = \App\Models\Lesson::whereIn('course_id', $courses_ids)->get()->pluck('title', 'id')->prepend('Please select', '');

        $test = Forms::findOrFail($id);
        // dd($course=$test->course);

        $course = $test->course[0]->id;
        $testsCoursesIds = $test->course()->pluck('course_id')->toArray();

        if (app()->getLocale() == "ar") {
            $courses = $courses->pluck('title_ar', 'id')->prepend(' أختار ', '');
            // $chapters = Chapters::where('course_id', $test->course_id)->pluck('title_ar', 'id')->prepend('أختار', '');
            $chapters = Chapters::whereIn('course_id', $testsCoursesIds)->pluck('title_ar', 'id')->prepend('أختار', '');
        } else {
            $courses = $courses->pluck('title', 'id')->prepend('Please select', '');
            // $chapters = Chapters::where('course_id', $test->course_id)->pluck('title', 'id')->prepend('Please select', '');
            $chapters = Chapters::whereIn('course_id', $testsCoursesIds)->pluck('title', 'id')->prepend('Please select', '');
        }
        // $courseLocations=session('locale') =='ar'?Course::find(request()->course_id)->locations->pluck('name_ar','pivot.id'):Course::find(request()->course_id)->locations->pluck('name','pivot.id');
        if ($test->form_type == 'group_test') {
            $group = CourseGroup::where('id', $test->group_id)->first();
            $courseLocationsColl = Location::where('id', $group->location_id)->first();

        } else {
            $courseLocationsColl = session('locale') == 'ar' ? Course::find(request('course_id'))
                ->locations : Course::find(request('course_id'))->locations;
        }
        $courseLocations = [];

        if ($test->form_type == 'group_test') {
            $courseLocations[$courseLocationsColl->id] = session('locale') == 'ar' ? $courseLocationsColl->name_ar : $courseLocationsColl->name;
        }
        else{
            foreach ($courseLocationsColl as $key => $loc) {
                $courseLocations[$loc->pivot->id] = session('locale') == 'ar' ? $loc->pivot->start_date . ' ' . $loc->name_ar : $loc->start_date . ' ' . $loc->name;
            }
        }
        // $test->course()->sync(array_filter((array)request('course_id')));
        return view('backend.tests.edit2', compact('test', 'courses', 'course', 'lessons', 'chapters', 'courseLocations'));
    }
    public function copyTest($id)
    {


        if (!Gate::allows('test_edit')) {
            return abort(401);
        }
        $courses = \App\Models\Course::latest()->ofTeacher()->get();

        $courses_ids = $courses->pluck('id');
        $lessons = \App\Models\Lesson::whereIn('course_id', $courses_ids)->get()->pluck('title', 'id')->prepend('Please select', '');

        $test = Forms::findOrFail($id);
        // dd($course=$test->course);

        $course = $test->course[0]->id;
        $testsCoursesIds = $test->course()->pluck('course_id')->toArray();

        if (app()->getLocale() == "ar") {
            $courses = $courses->pluck('title_ar', 'id')->prepend(' أختار ', '');
            // $chapters = Chapters::where('course_id', $test->course_id)->pluck('title_ar', 'id')->prepend('أختار', '');
            $chapters = Chapters::whereIn('course_id', $testsCoursesIds)->pluck('title_ar', 'id')->prepend('أختار', '');
        } else {
            $courses = $courses->pluck('title', 'id')->prepend('Please select', '');
            // $chapters = Chapters::where('course_id', $test->course_id)->pluck('title', 'id')->prepend('Please select', '');
            $chapters = Chapters::whereIn('course_id', $testsCoursesIds)->pluck('title', 'id')->prepend('Please select', '');
        }
        // $courseLocations=session('locale') =='ar'?Course::find(request()->course_id)->locations->pluck('name_ar','pivot.id'):Course::find(request()->course_id)->locations->pluck('name','pivot.id');
        if ($test->form_type == 'group_test') {
            $group = CourseGroup::where('id', $test->group_id)->first();
            $courseLocationsColl = Location::where('id', $group->location_id)->first();

        } else {
            $courseLocationsColl = session('locale') == 'ar' ? Course::find(request('course_id'))
                ->locations : Course::find(request('course_id'))->locations;
        }
        $courseLocations = [];

        if ($test->form_type == 'group_test') {
            $courseLocations[$courseLocationsColl->id] = session('locale') == 'ar' ? $courseLocationsColl->name_ar : $courseLocationsColl->name;
        }
        else{
            foreach ($courseLocationsColl as $key => $loc) {
                $courseLocations[$loc->pivot->id] = session('locale') == 'ar' ? $loc->pivot->start_date . ' ' . $loc->name_ar : $loc->start_date . ' ' . $loc->name;
            }
        }
        // $test->course()->sync(array_filter((array)request('course_id')));
        return view('backend.tests.copy', compact('test', 'courses', 'course', 'lessons', 'chapters', 'courseLocations'));
    }
    public function editRate($id)
    {
        $rate = Forms::findOrFail($id);
        return view('backend.rates.edit2', compact('rate'));
    }

    /**
     * Update Test in storage.
     *
     * @param  \App\Http\Requests\UpdateTestsRequest  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {

        $form_type = request()->form_type;
        if ($form_type == 'test'|| $form_type == 'group_test') {

            return $this->updateTest($request, $id);
        }
        // elseif ($form_type == 'rate') {
        else {

            return $this->updateRate($request, $id);
        }
    }
    public function updateTestOld($request, $id)
    {

        if (!Gate::allows('test_edit')) {
            return abort(401);
        }
        $test = Forms::findOrFail($id);

        $UpdateTestsRequest = new UpdateTestsRequest();
        $UpdateTestsRequest->rules($request);
        $test->update($request->all());
        // $test->slug = str_slug($request->title);
        if ($request->slug == "" || $request->slug == null) {
            $SlugExist = Forms::where('slug', str_slug($request->title))->exists();
            if ($SlugExist == false) {
                $test->slug = str_slug($request->title);
            } else {
                $test->slug = str_slug($request->title) . '-' . $test->id;
            }
        }
        $test->save();

        $testsCoursesIds = $test->course()->pluck('course_id')->toArray();
        $CourseForms = CourseForms::where('forms_id', $test->id)->whereIn('course_id', $testsCoursesIds)->get();

        $sequence = 1;
        if (count($testsCoursesIds) > 0) {
            foreach ($testsCoursesIds as $key => $course_id) {
                if (count($test->getcourseById($course_id)->courseTimeline) > 0) {
                    // $sequence = $test->course->courseTimeline->max('sequence');
                    $sequence = $test->getcourseById($course_id)->courseTimeline->max('sequence');
                    $sequence = $sequence + 1;
                }
            }
        } else {
            $newCourseForms = new CourseForms;
            $newCourseForms->course_id = $request->course_id;
            $newCourseForms->forms_id = $test->id;
            $newCourseForms->save();
        }

        if ($test->published == 1) {
            $timelines = CourseTimeline::where('model_type', '=', Forms::class)
                ->where('model_id', '=', $test->id)
                ->whereIn('course_id', $testsCoursesIds)->get();
            if (count($testsCoursesIds) > 0) {
                foreach ($testsCoursesIds as $key => $course_id) {
                    if (count($timelines) == 0) {
                        $timeline = new CourseTimeline();
                        $timeline->course_id = $course_id;
                        $timeline->model_id = $test->id;
                        $timeline->model_type = Forms::class;
                        $timeline->sequence = $sequence;
                        $timeline->save();
                    } else {
                        foreach ($timelines as $key => $timeline) {
                            # code...
                            $timeline->course_id = $course_id;
                            $timeline->model_id = $test->id;
                            $timeline->model_type = Forms::class;
                            $timeline->sequence = $sequence;
                            $timeline->save();
                        }
                    }
                }
            }
        }

        return redirect()->route('admin.forms.index', ['form_type' => request('form_type')])->withFlashSuccess(trans('alerts.backend.general.updated'));
    }

    public function UpdateTest($request, $id)
    {
            if (!Gate::allows('test_edit')) {
                return abort(401);
            }
        $test = Forms::findOrFail($id);

        $UpdateTestsRequest = new UpdateTestsRequest();
        $UpdateTestsRequest->rules($request);
        $test->update($request->all());
        // save course location in pivot table
        $course_location_ids = [];
        foreach ($request->course_location_id as $key => $id) {
            # code...

            $course_location_ids[$id] = ['model_type' => get_class($test)];
        }

        $test->courseLocations()->sync($course_location_ids);
        // $test->slug = str_slug($request->title);
        if ($request->slug == "" || $request->slug == null) {
            $SlugExist = Forms::where('slug', str_slug($request->title))->exists();
            if ($SlugExist == false)
                $test->slug = str_slug($request->title);
            else
                $test->slug = str_slug($request->title) . '-' . $test->id;
        }

        $test->save();
        $request = $this->saveAllFiles($request, 'downloadable_files', Forms::class, $test);


        $testsCoursesIds = $test->course()->pluck('course_id')->toArray();
        $CourseForms = CourseForms::where('forms_id', $test->id)->whereIn('course_id', $testsCoursesIds)->get();

        if ($request->q)
            foreach ($request->q as $q) {
                if (!isset($q['question'])) {
                    if (isset($q['id'])) {
                        $question = Question::where(['id' => $q['id']])->first();
                        $question->forceDelete();
                    }
                } else {
                    $new_q = [];
                    $new_q['question'] = $q['question'];
                    $new_q['question_ar'] = $q['question_ar'];
                    $new_q['question_type'] = $q['question_type'];
                    $new_q['user_id'] = auth()->user()->id;
                    $new_q['score'] = $q['score'];
                    $new_q['title'] = $q['title'];
                    $new_q['title_ar'] = $q['title_ar'];

                    $question = Question::updateOrCreate(['id'   => @$q['id']], $new_q);
                    $question->tests()->sync($test->id);
                    // dd($request->all());
                    if (isset($q['option_text']) && count($q['option_text']) > 0) {
                        foreach ($q['option_text'] as $q_option_index => $q_option) {

                            QuestionsOption::updateOrCreate(['id' => @$q['option_id'][$q_option_index]], [
                                'question_id' => $question->id,
                                'option_text' => $q['option_text'][$q_option_index],
                                'option_text_ar' => $q['option_text_ar'][$q_option_index],
                                'correct' => @(int)$q['correct'][$q_option_index]
                            ]);
                        }
                        $optionIds = QuestionsOption::where('question_id', $question->id)->get()->pluck('id')->toArray();

                        if (count($q['option_text']) < count($optionIds)) {
                            $diff = array_diff($optionIds, $q['option_id']);
                            QuestionsOption::whereIn('id', $diff)->delete();
                        }
                    }
                }
            }



        $sequence = 1;
        if (count($testsCoursesIds) > 0) {
            foreach ($testsCoursesIds as $key => $course_id) {
                if (count($test->getcourseById($course_id)->courseTimeline) > 0) {
                    // $sequence = $test->course->courseTimeline->max('sequence');
                    $sequence = $test->getcourseById($course_id)->courseTimeline->max('sequence');
                    $sequence = $sequence + 1;
                }
            }
        } else {
            $newCourseForms = new CourseForms;
            $newCourseForms->course_id = $request->course_id;
            $newCourseForms->forms_id = $test->id;
            $newCourseForms->save();
        }

        if ($test->published == 1) {
            $timelines = CourseTimeline::where('model_type', '=', Forms::class)
                ->where('model_id', '=', $test->id)
                ->whereIn('course_id', $testsCoursesIds)->get();
            if (count($testsCoursesIds) > 0) {
                foreach ($testsCoursesIds as $key => $course_id) {
                    if (count($timelines) == 0) {
                        $timeline = new CourseTimeline();
                        $timeline->course_id = $course_id;
                        $timeline->model_id = $test->id;
                        $timeline->model_type = Forms::class;
                        $timeline->sequence = $sequence;
                        $timeline->save();
                    } else {
                        foreach ($timelines as $key => $timeline) {
                            # code...
                            $timeline->course_id = $course_id;
                            $timeline->model_id = $test->id;
                            $timeline->model_type = Forms::class;
                            $timeline->sequence = $sequence;
                            $timeline->save();
                        }
                    }
                }
            }
        }
        if ($request->form_type == 'group_test') {
            return redirect()->route('admin.courses.groups.tests.index', ['group' => $test->group_id])->withFlashSuccess(trans('alerts.backend.general.created'));

        }
        else{
            return redirect()->route('admin.forms.edit', ['id' => $test->id, 'form_type' => request('form_type'), 'course_id' => $request->course_id])->withFlashSuccess(trans('alerts.backend.general.updated'));
        }
    }

    public function updateRate($request, $id)
    {


        $rate = Forms::findOrFail($id);
        $rate->update($request->all());

        if (request('q')) {
            foreach ($request->q as $q) {
                if (!isset($q['question'])) {
                    if (isset($q['id'])) {
                        $question = Question::where(['id' => $q['id']])->first();
                        $question->forceDelete();
                    }
                    $new_q = [];
                    $new_q['question'] = $q['question'];
                    $new_q['question_ar'] = $q['question_ar'];
                    $new_q['question_type'] = $q['question_type'];
                    $new_q['user_id'] = auth()->user()->id;
                    $question = Question::updateOrCreate(['id'   => @$q['id']], $new_q);
                    $question->tests()->sync($rate->id);
                    // dd($request->all());
                    if (isset($q['option_text']) && count($q['option_text']) > 0) {
                        foreach ($q['option_text'] as $q_option_index => $q_option) {
                            QuestionsOption::updateOrCreate(['id' => @$q['option_id'][$q_option_index]], [
                                'question_id' => $question->id,
                                'option_text' => $q['option_text'][$q_option_index],
                                'option_text_ar' => $q['option_text_ar'][$q_option_index],
                                'correct' => @(int)$q['correct'][$q_option_index]
                            ]);
                        }
                    }
                } else {
    
                    $new_q = [];
                    $new_q['question'] = $q['question'];
                    $new_q['question_ar'] = $q['question_ar'];
                    $new_q['question_type'] = $q['question_type'];
                    $new_q['user_id'] = auth()->user()->id;
                    $question = Question::updateOrCreate(['id'   => @$q['id']], $new_q);
                    $question->tests()->sync($rate->id);
                    // dd($request->all());
                    if (isset($q['option_text']) && count($q['option_text']) > 0) {
                        foreach ($q['option_text'] as $q_option_index => $q_option) {
                            QuestionsOption::updateOrCreate(['id' => @$q['option_id'][$q_option_index]], [
                                'question_id' => $question->id,
                                'option_text' => $q['option_text'][$q_option_index],
                                'option_text_ar' => $q['option_text_ar'][$q_option_index],
                                'correct' => @(int)$q['correct'][$q_option_index]
                            ]);
                        }
                    }
                }
            }
        }


        //if request have courses id go to ... else show all
        if (request()->query('course_id')) {
            return redirect()->route('admin.forms2.index2', ['form_type' => request('form_type'), 'course_id' => request('course_id')])->withFlashSuccess(trans('alerts.backend.general.updated'));
        } else {
            return redirect()->route('admin.forms.index', ['form_type' => request('form_type')])->withFlashSuccess(trans('alerts.backend.general.updated'));
        }
    }

    public function getComplainForms()
    {
        $allComplains = UserCourseForm::whereHas('form', function ($query) {
            $query->where('form_type', 'complainment');
        })->get();
        return view('backend.complains.index', compact('allComplains'));
    }

    /**
     * Display Test.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        if (!Gate::allows('test_view')) {
            return abort(401);
        }
        $test = Forms::findOrFail($id);

        return view('backend.tests.show', compact('test'));
    }

    /**
     * Remove Test from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        if (!Gate::allows('test_delete')) {
            return abort(401);
        }
        $test = Forms::findOrFail($id);
        $type = get_class($test);

        $test->chapterStudents()->where('model_type', 'App\Models\Lesson')->where('model_id', $test->lesson_id)->forceDelete();
        $test->delete();
        $courseTimeLine = CourseTimeline::where('model_id', $id)->where('model_type', $type)->delete();

        return back()->withFlashSuccess(trans('alerts.backend.general.deleted'));
    }

    /**
     * Delete all selected Test at once.
     *
     * @param Request $request
     */
    public function massDestroy(Request $request)
    {
        if (!Gate::allows('test_delete')) {
            return abort(401);
        }
        if ($request->input('ids')) {
            $entries = Forms::whereIn('id', $request->input('ids'))->get();

            foreach ($entries as $entry) {
                $entry->delete();
            }
        }
    }

    /**
     * Restore Test from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function restore($id)
    {
        if (!Gate::allows('test_delete')) {
            return abort(401);
        }
        $test = Forms::onlyTrashed()->findOrFail($id);
        $test->restore();

        return back()->withFlashSuccess(trans('alerts.backend.general.restored'));
    }

    /**
     * Permanently delete Test from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function perma_del($id)
    {
        if (!Gate::allows('test_delete')) {
            return abort(401);
        }
        $test = Forms::onlyTrashed()->findOrFail($id);
        $test->forceDelete();

        return back()->withFlashSuccess(trans('alerts.backend.general.deleted'));
    }

    public function userQuestion($course_id, $user_id)
    {
        $rate = UserCourseForm::where('course_id', $course_id)->where('user_id', $user_id)
            ->get();

        $course = Course::where('id', $course_id)->first();
        $user = User::where('id', $user_id)->first();

        return  view('backend.rates.showUserQuestion', compact('rate', 'course', 'user'));
    }

    public function showCourseRate($course_id)
    {
        //
        $rates = UserCourseForm::where('course_id', $course_id)->with('form')->with('user')->groupBy('user_id')->get();
        $course = Course::where('id', $course_id)->first();

        return view('backend.rates.show', compact('rates', 'course'));
    }
}
