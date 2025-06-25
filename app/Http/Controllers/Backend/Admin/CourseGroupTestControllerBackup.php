<?php

namespace App\Http\Controllers\Backend\Admin;

use App\Http\Controllers\Controller;
use App\Models\Chapters;
use App\Models\Course;
use App\Models\course_place;
use App\Models\CourseGroup;
use App\Models\Forms;
use App\Models\Lesson;
use App\Models\Location;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Gate;
use Yajra\DataTables\Facades\DataTables;

class CourseGroupTestControllerBackup extends Controller
{

    /**
     * Display a listing of the tests.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(CourseGroup $group)
    {

        $form_type = 'group_test';

        if (!Gate::allows('test_access')) {
            return abort(401);
        }

        if (request('show_deleted') == 1) {
            if (!Gate::allows('test_delete')) {
                return abort(401);
            }
            $tests = Forms::where('form_type', $form_type)->where('group_id', $group->id)->onlyTrashed()->get();
        } else {
            $tests = Forms::where('group_id', $group->id)->where('form_type', $form_type)->get();
        }

        if (request('lesson_id') != "") {
            $tests = Forms::where('form_type', $form_type)->where('lesson_id', '=', request('lesson_id'))->orderBy('created_at', 'desc')->get();
        } else {
            $tests = Forms::where('form_type', $form_type)->orderBy('created_at', 'desc')->get();
        }
        if (app()->getLocale() == "ar") {
            $courses = Course::latest()->ofTeacher()->pluck('title_ar', 'id')->prepend('Please select', '');
        } else {
            $courses = Course::latest()->ofTeacher()->pluck('title', 'id')->prepend('Please select', '');
        }
        $course = Course::where('id', $group->course_id)->first();
        $location = Location::where('id', $group->location_id)->first();
        return view('backend.courses.groups.tests.index', compact('course', 'group', 'tests', 'courses', 'location'));


    }

    /**
     * Show the form for creating a new test.
     *
     * @return \Illuminate\Http\Response
     */
    public function create(CourseGroup $group)
    {
        if (!Gate::allows('test_create')) {
            return abort(401);
        }
        $course = Course::where('id', $group->course_id)->first();
        $lessons = Lesson::where('course_id', $course->id)->get()->pluck('title', 'id')->prepend('Please select', '');
        if (app()->getLocale() == "ar") {
            $chapters = Chapters::where('course_id', $course->id)->pluck('title_ar', 'id')->prepend('أختار', '');
        } else {
            $chapters = Chapters::where('course_id', $course->id)->pluck('title', 'id')->prepend('أختار', '');
        }
        $courseLocations = course_place::where('id', $group->place_id)->pluck('name', 'id')->prepend('أختار', '');
        $form_type = 'group_test';

        return view('backend.courses.groups.tests.create', compact('course', 'group', 'form_type', 'lessons', 'chapters', 'courseLocations'));
    }

    public function show()
    {
    }

    /**
     * Get data for the tests DataTable.
     *
     * @param \Illuminate\Http\Request $request
     * @return \Illuminate\Http\Response
     */
    public function getData(Request $request)
    {
        $has_view = false;
        $has_delete = false;
        $has_edit = false;
        $has_copy = false;
        $form_type = 'group_test';
        $tests = "";
        if ($request->group_id != "") {
            $tests = Forms::where('group_id', $request->group_id)->where('form_type', $form_type)->get();

        }

        if (request('show_deleted') == 1) {
            if (!Gate::allows('test_delete')) {
                return abort(401);
            }
            $tests = Forms::where('form_type', $form_type)->where('group_id', $request->group_id)->onlyTrashed()->get();
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
                        ->with(['route' => route('admin.courses.groups.tests.edit', ['test' => $q->id, 'group' => $q->group_id])])
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

    /**
     * Show the edit form for test.
     *
     * @param \Illuminate\Http\Request $request
     * @return \Illuminate\Http\Response
     */
    public function edit(CourseGroup $group, Forms $test)
    {
        if (!Gate::allows('test_edit')) {
            return abort(401);
        }
        $courses = \App\Models\Course::latest()->ofTeacher()->get();

        $courses_ids = $courses->pluck('id');
        $lessons = \App\Models\Lesson::whereIn('course_id', $courses_ids)->get()->pluck('title', 'id')->prepend('Please select', '');

        $test = Forms::findOrFail($test->id);

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
        if ($test->form_type == 'group_test') {
            $group = CourseGroup::where('id', $test->group_id)->first();
            $courseLocationsColl = course_place::where('id', $group->place_id)->first();

        } else {
            $courseLocationsColl = session('locale') == 'ar' ? Course::find(request('course_id'))
                ->locations : Course::find(request('course_id'))->locations;
        }
        $courseLocations = [];

        if ($test->form_type == 'group_test') {
            $courseLocations[$courseLocationsColl->id] = session('locale') == 'ar' ? $courseLocationsColl->name_ar : $courseLocationsColl->name;
        } else {
            foreach ($courseLocationsColl as $key => $loc) {
                $courseLocations[$loc->pivot->id] = session('locale') == 'ar' ? $loc->pivot->start_date . ' ' . $loc->name_ar : $loc->start_date . ' ' . $loc->name;
            }
        }
        return view('backend.courses.groups.tests.edit', compact('test', 'courses', 'course', 'lessons', 'chapters', 'courseLocations'));
    }

    public function store(Request $request){

    }
}
