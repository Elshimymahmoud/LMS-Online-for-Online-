<?php

namespace App\Http\Controllers\Backend\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\Admin\StoreFormsRequest;
use App\Http\Requests\Admin\UpdateFormsRequest;
use App\Mail\replayComplaintEmail;
use App\Models\Auth\User;
use App\Models\Course;
use App\Models\CourseForms;
use App\Models\CourseGroupTest;
use App\Models\CourseTimeline;
use App\Models\Forms;
use App\Models\Location;
use App\Models\Question;
use App\Models\ReplyComplaints;
use App\Models\Result;
use App\Models\ResultsAnswer;
use App\Models\Test;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Gate;
use Yajra\DataTables\Facades\DataTables;

class courseGroupResultController extends Controller
{
    /**
     * Display a listing of Test.
     *
     * @return \Illuminate\Http\Response
     */
    public function index($form_id = null)
    {
        // check if the current user has permission to view the list of tests
        if (!Gate::allows('test_access')) {
            return abort(401);
        }
        $questions = [];
        $questionIds = [];
        $answers = [];
        $users = [];
        $group_id = CourseGroup::where('id', requ);
        $test = CourseGroupTest::where('id', request('test_id'))->first();

        if (request('show_deleted') == 1) {
            if (!Gate::allows('test_delete')) {
                return abort(401);
            }
            $tests_result = Result::onlyTrashed()->get();
        } else {
            $tests_result = Result::all();
        }

        if (request('lesson_id') != "") {

            $tests_result = Result::where('lesson_id', '=', request('lesson_id'))->orderBy('created_at', 'desc')->get();
        }
        if ($course_id && $form_id) {
            $course_form = CourseForms::where('course_id', $course_id)->where('forms_id', $form_id)->pluck('id')->toArray();
            $tests_result = Result::whereIn('course_forms_id', $course_form)->get();
        }


        if (app()->getLocale() == "ar") {
            $courses = Course::ofTeacher()->pluck('title_ar', 'id')->prepend('Please select', '');
            $locations = Location::pluck('name_ar', 'id');

        } else {
            $courses = Course::ofTeacher()->pluck('title', 'id')->prepend('Please select', '');
            $locations = Location::pluck('name', 'id');
        }

        if ($form_id) {
            $questions = Question::whereHas('tests', function ($query) use ($form_id) {
                $query->where('forms_id', $form_id);
            })->get();


            // $tests2 =\DB::table('questions')
            // ->join('question_form','questions.id', '=', 'question_form.question_id')
            // ->join('course_forms','course_forms.forms_id', '=', 'question_form.forms_id')
            // ->join('forms','course_forms.forms_id', '=', 'forms.id')

            // ->select('questions.*')
            // ->where('forms.id',$form_id)
            // ->groupBy('questions.id')
            // ->get();

            // dd($tests2 );


            $questionIds = $questions->pluck('id');
            // $answers=ResultsAnswer::whereIn('question_id',$questionIds)->with('testResult')->get();

            if (request('student_id')) {
                $answers = ResultsAnswer::whereIn('question_id', $questionIds)->with('testResult')
                    ->whereHas('testResult', function ($q) use ($form_id, $course_id) {
                        $q->where('results.user_id', request('student_id'))->whereHas('test', function ($query) use ($form_id, $course_id) {
                            $query->where('forms_id', $form_id)->where('course_id', $course_id);
                        })->groupBy('results.user_id')->orderBy('results.id');
                    })->orderBy('results_answers.result_id')->get();
            } else {
                $answers = ResultsAnswer::whereIn('question_id', $questionIds)->with('testResult')
                    ->whereHas('testResult', function ($q) use ($form_id) {
                        $q->whereHas('test', function ($query) use ($form_id) {
                            $query->where('forms_id', $form_id);
                        })->groupBy('results.user_id')->orderBy('results.id');
                    })->orderBy('results_answers.result_id')->get();

            }
            if ($course_id) {
                // $answers=ResultsAnswer::whereIn('question_id',$questionIds)->with('testResult')
                // ->whereHas('testResult',function($q) use($form_id,$course_id){
                //     $q->whereHas('test',function($query) use($form_id,$course_id){
                //       $query->where('forms_id',$form_id)->where('course_id',$course_id);
                //     })->groupBy('results.user_id')->orderBy('results.id');
                // })->orderBy('results_answers.result_id')->get();
                $resultids = $tests_result->pluck('id')->toArray();
                // dd($resultids);
                $answers = ResultsAnswer::whereIn('question_id', $questionIds)->whereIn('result_id', $resultids)->get();
            }

            // dd($answers);


            foreach ($answers as $key => $answer) {

                if (request('student_id')) {
                    if ($answer->testResult->user_id == request('student_id'))
                        $users[] = $answer->testResult->user;
                    $users = array_unique($users);
                } else {
                    if ($course_id) {
                        $usersid = $tests_result->pluck('user_id')->toArray();
                        $usersid = array_unique($usersid);
                        // dd($usersid);
                        $users = User::whereIn('id', $usersid)->get();
                    } else {
                        $users[] = $answer->testResult->user;
                        $users = array_unique($users);
                    }

                }
            }


        }
        $user = '';
        $course = '';
        $course_id = request('course_id');
        $student_id = request('student_id');
        if ($student_id)
            $user = User::find($student_id);
        if ($course_id)
            $course = Course::find($course_id);

        return view('backend.tests_result.index-new', compact('tests_result', 'courses', 'locations', 'questions', 'questionIds', 'answers', 'users', 'user', 'course'));

        // return view('backend.tests_result.index', compact('tests_result','courses','locations'));
    }

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
        $tests_result = "";
        $form = Forms::find($request->form_id);

        // if($form->form_type=='complainment'){

        // }

        $tests_result = \DB::table('results')
            ->join('course_forms', 'course_forms.id', '=', 'results.course_forms_id')
            ->join('courses', 'course_forms.course_id', '=', 'courses.id')
            ->join('forms', 'course_forms.forms_id', '=', 'forms.id')
            ->join('users', 'results.user_id', '=', 'users.id')
            ->select('results.*', 'courses.title as course_title', 'courses.title_ar  as course_title_ar', 'forms.title', 'forms.title_ar', 'users.first_name', 'users.last_name')
            ->where('forms.id', $request->form_id)
            ->get();

        if (request('location_id') && $request->form_id) {
            $tests_result = \DB::table('results')
                ->join('course_forms', 'course_forms.id', '=', 'results.course_forms_id')
                ->join('courses', 'course_forms.course_id', '=', 'courses.id')
                ->join('course_locations', 'courses.id', '=', 'course_locations.course_id')
                ->where('course_locations.location_id', request('location_id'))
                ->join('forms', 'course_forms.forms_id', '=', 'forms.id')
                ->join('users', 'results.user_id', '=', 'users.id')
                ->select('results.*', 'courses.title as course_title', 'courses.title_ar  as course_title_ar', 'forms.title', 'forms.title_ar', 'users.first_name', 'users.last_name', 'course_locations.location_id')
                ->where('forms.id', $request->form_id)
                ->get();

        }
        if (request('location_id') && $request->form_id == 0) {
            $tests_result = \DB::table('results')
                ->join('course_forms', 'course_forms.id', '=', 'results.course_forms_id')
                ->join('courses', 'course_forms.course_id', '=', 'courses.id')
                ->join('course_locations', 'courses.id', '=', 'course_locations.course_id')
                ->where('course_locations.location_id', request('location_id'))
                ->join('forms', 'course_forms.forms_id', '=', 'forms.id')
                ->join('users', 'results.user_id', '=', 'users.id')
                ->select('results.*', 'courses.title as course_title', 'courses.title_ar  as course_title_ar', 'forms.title', 'forms.title_ar', 'users.first_name', 'users.last_name', 'course_locations.location_id')
                ->get();

        }
        if ($request->form_id)
            if ($form->form_type == 'complainment') {

                $tests_result = \DB::table('results')
                    ->join('course_forms', 'course_forms.id', '=', 'results.course_forms_id')
                    ->join('forms', 'course_forms.forms_id', '=', 'forms.id')
                    ->join('users', 'results.user_id', '=', 'users.id')
                    ->select('results.*', 'forms.title', 'forms.title_ar', 'users.first_name', 'users.last_name')
                    ->where('forms.id', $request->form_id)
                    ->get();

            }


        if (auth()->user()->can('test_view')) {
            $has_view = true;
        }
        if (auth()->user()->can('test_edit')) {
            $has_edit = true;
        }


        return DataTables::of($tests_result)
            ->addIndexColumn()
            ->addColumn('actions', function ($q) use ($has_view, $has_edit, $has_delete, $request) {
                $view = "";
                $edit = "";
                $delete = "";
                if ($request->show_deleted == 1) {
                    return view('backend.datatable.action-trashed')->with(['route_label' => 'admin.tests_result', 'label' => 'test', 'value' => $q->id]);
                }
                // if ($has_view) {
                //     $view = view('backend.datatable.action-view')
                //         ->with(['route' => route('admin.tests_result.show', ['test' => $q->id])])->render();
                // }
                if ($has_edit) {
                    $edit = view('backend.datatable.action-edit')
                        ->with(['route' => route('admin.tests_result.edit', ['test' => $q->id])])
                        ->render();
                    $view .= $edit;
                }

                if ($has_delete) {
                    $delete = view('backend.datatable.action-delete')
                        ->with(['route' => route('admin.tests_result.destroy', ['test' => $q->id])])
                        ->render();
                    $view .= $delete;
                }
                return $view;

            })
            ->editColumn('course', function ($q) {
                return $q->course_title ?? "N/A";
            })
            ->editColumn('test', function ($q) {
                return $q->title ?? "N/A";
            })
            ->editColumn('user', function ($q) {
                return $q->first_name . " " . $q->last_name ?? "N/A";
            })
            ->editColumn('result', function ($q) {
                return $q->tests_result ?? "N/A";
            })
            ->editColumn('published', function ($q) {
                return "Yes";
            })
            ->rawColumns(['actions', 'questions'])
            ->make();
    }

    public function filterData(Request $request)
    {
        $has_view = false;
        $has_delete = false;
        $has_edit = false;
        $tests_result = "";


        $tests_result = \DB::table('results')
            ->join('course_forms', 'course_forms.id', '=', 'results.course_forms_id')
            ->join('courses', 'course_forms.course_id', '=', 'courses.id')
            ->join('forms', 'course_forms.forms_id', '=', 'forms.id')
            ->join('users', 'results.user_id', '=', 'users.id')
            ->select('results.*', 'courses.title as course_title', 'courses.title_ar  as course_title_ar', 'forms.title', 'forms.title_ar', 'users.first_name', 'users.last_name')
            ->where('forms.id', $request->form_id)
            ->get();


        if (auth()->user()->can('test_view')) {
            $has_view = true;
        }
        if (auth()->user()->can('test_edit')) {
            $has_edit = true;
        }


        return DataTables::of($tests_result)
            ->addIndexColumn()
            ->addColumn('actions', function ($q) use ($has_view, $has_edit, $has_delete, $request) {
                $view = "";
                $edit = "";
                $delete = "";
                if ($request->show_deleted == 1) {
                    return view('backend.datatable.action-trashed')->with(['route_label' => 'admin.tests_result', 'label' => 'test', 'value' => $q->id]);
                }
                // if ($has_view) {
                //     $view = view('backend.datatable.action-view')
                //         ->with(['route' => route('admin.tests_result.show', ['test' => $q->id])])->render();
                // }
                if ($has_edit) {
                    $edit = view('backend.datatable.action-edit')
                        ->with(['route' => route('admin.tests_result.edit', ['test' => $q->id])])
                        ->render();
                    $view .= $edit;
                }

                if ($has_delete) {
                    $delete = view('backend.datatable.action-delete')
                        ->with(['route' => route('admin.tests_result.destroy', ['test' => $q->id])])
                        ->render();
                    $view .= $delete;
                }
                return $view;

            })
            ->editColumn('course', function ($q) {
                return $q->course_title ?? "N/A";
            })
            ->editColumn('test', function ($q) {
                return $q->title ?? "N/A";
            })
            ->editColumn('user', function ($q) {
                return $q->first_name . " " . $q->last_name ?? "N/A";
            })
            ->editColumn('result', function ($q) {
                return $q->tests_result ?? "N/A";
            })
            ->editColumn('published', function ($q) {
                return "Yes";
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
        if (!Gate::allows('test_create')) {
            return abort(401);
        }
        if (request('lesson_id') == null) {
            $this->validate(request(), [
                'lesson_id' => 'required'
            ], ['lesson_id.required' => 'The lesson is required, you must add it']);

        }

        $courses = \App\Models\Course::ofTeacher()->get();
        $courses_ids = $courses->pluck('id');
        $courses = $courses->pluck('title', 'id')->prepend('Please select', '');
        if (!empty(request('lesson_id')))
            $lesson = \App\Models\Lesson::where('id', request('lesson_id'))->first();

        return view('backend.tests_result.create', compact('courses', 'lesson'));
    }

    /**
     * Store a newly created Test in storage.
     *
     * @param \App\Http\Requests\StoreRequest $request
     * @return \Illuminate\Http\Response
     */
    public function store(StoreFormsRequest $request)
    {
        $this->validate($request, [
            'test_result' => 'required'
        ], ['test_result.required' => 'The test result is required']);

        if (!Gate::allows('test_create')) {
            return abort(401);
        }


        $test = Test::create($request->all());
        $test->slug = str_slug($request->title);
        $test->save();

        $sequence = 1;
        if (count($test->course->courseTimeline) > 0) {
            $sequence = $test->course->courseTimeline->max('sequence');
            $sequence = $sequence + 1;
        }

        if ($test->published == 1) {
            $timeline = CourseTimeline::where('model_type', '=', Test::class)
                ->where('model_id', '=', $test->id)
                ->where('lesson_id', $request->lesson_id)->first();
            if ($timeline == null) {
                $timeline = new CourseTimeline();
            }
            $timeline->lesson_id = $request->lesson_id;
            $timeline->model_id = $test->id;
            $timeline->model_type = Test::class;
            $timeline->sequence = $sequence;
            $timeline->save();
        }


        return redirect()->route('admin.tests_result.index')->withFlashSuccess(trans('alerts.backend.general.created'));
    }


    /**
     * Show the form for editing Test.
     *
     * @param int $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        if (!Gate::allows('test_edit')) {
            return abort(401);
        }

        $tests_result = Result::findOrFail($id);
        $form_type = $tests_result->test->test->form_type;
        return view('backend.tests_result.edit', compact('tests_result', 'form_type'));
    }

    public function replyComplaints(Request $request, $id)
    {
        $result = Result::findOrFail($id);


        $reply = new ReplyComplaints();
        $reply->reply = $request->reply;
        $reply->result_id = $id;
        $reply->save();
        $user = User::findOrFail($request->user_id);
        $complain_title = $result->answers[2]->answer;  //موضوع الشكوي

        $content = [];
        $content['complain_title'] = $complain_title;
        $content['reply'] = $request->reply;

        \Mail::to($user->email)->send(new replayComplaintEmail($content));
        return redirect()->back()->withFlashSuccess('تم الرد علي الشكوي بنجاح');


    }

    /**
     * Update Test in storage.
     *
     * @param \App\Http\Requests\UpdateRequest $request
     * @param int $id
     * @return \Illuminate\Http\Response
     */
    public function update(UpdateFormsRequest $request, $id)
    {

        $this->validate($request, [
            'test_result' => 'required'
        ], ['test_result.required' => 'The test result is required']);


        if (!Gate::allows('test_edit')) {
            return abort(401);
        }
        $test = Result::findOrFail($id);
        $test->update($request->all());
        $test->save();


        return redirect()->route('admin.tests_result.index')->withFlashSuccess(trans('alerts.backend.general.updated'));
    }


    /**
     * Display Test.
     *
     * @param int $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        if (!Gate::allows('test_view')) {
            return abort(401);
        }
        $test = Test::findOrFail($id);

        return view('backend.tests_result.show', compact('test'));
    }


    /**
     * Remove Test from storage.
     *
     * @param int $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        if (!Gate::allows('test_delete')) {
            return abort(401);
        }
        $test = Test::findOrFail($id);
        $test->chapterStudents()->where('lesson_id', $test->lesson_id)->forceDelete();
        $test->delete();

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
            $entries = Test::whereIn('id', $request->input('ids'))->get();

            foreach ($entries as $entry) {
                $entry->delete();
            }
        }
    }


    /**
     * Restore Test from storage.
     *
     * @param int $id
     * @return \Illuminate\Http\Response
     */
    public function restore($id)
    {
        if (!Gate::allows('test_delete')) {
            return abort(401);
        }
        $test = Test::onlyTrashed()->findOrFail($id);
        $test->restore();

        return back()->withFlashSuccess(trans('alerts.backend.general.restored'));
    }

    /**
     * Permanently delete Test from storage.
     *
     * @param int $id
     * @return \Illuminate\Http\Response
     */
    public function perma_del($id)
    {
        if (!Gate::allows('test_delete')) {
            return abort(401);
        }
        $test = Test::onlyTrashed()->findOrFail($id);
        $test->forceDelete();

        return back()->withFlashSuccess(trans('alerts.backend.general.deleted'));
    }

    public function correctTest(Request $request)
    {
        foreach ($request->resultAnswer as $key => $value) {
            # code...
            $resultAnswer = ResultsAnswer::find($key);

            $result = Result::find($resultAnswer->result_id);
            if ($value > 0)
                $result->test_result = $value;
            $result->save();
        }
        return back()->withFlashSuccess(trans('alerts.backend.general.updated'));

    }
}
