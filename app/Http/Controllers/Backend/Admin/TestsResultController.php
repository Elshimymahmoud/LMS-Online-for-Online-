<?php

namespace App\Http\Controllers\Backend\Admin;

use App\Models\Course;
use App\Models\CourseTimeline;
use App\Models\Test;
use App\Models\Result;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Gate;
use App\Http\Controllers\Controller;
use App\Http\Requests\Admin\StoreTestsRequest;
use App\Http\Requests\Admin\UpdateTestsRequest;
use Yajra\DataTables\Facades\DataTables;

class TestsResultController extends Controller
{
    /**
     * Display a listing of Test.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        if (! Gate::allows('test_access')) {
            return abort(401);
        }
        dd(request());

        if (request('show_deleted') == 1) {
            if (! Gate::allows('test_delete')) {
                return abort(401);
            }
            $tests_result = Result::onlyTrashed()->get();
        } else {
            $tests_result = Result::all();
        }

        if (request('lesson_id') != "") {
            $tests_result = Result::where('lesson_id','=',request('lesson_id'))->orderBy('created_at', 'desc')->get();
        }

         
        if(app()->getLocale()=="ar"){
            $courses = Course::ofTeacher()->pluck('title_ar','id')->prepend('Please select', '');
        }
        else
        {
            $courses = Course::ofTeacher()->pluck('title','id')->prepend('Please select', '');
        }


        return view('backend.tests_result.index', compact('tests_result','courses'));
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

 
        $tests_result = Result::all();


        if (request('show_deleted') == 1) {
            if (!Gate::allows('test_delete')) {
                return abort(401);
            }
            $tests_result = Result::onlyTrashed()->get();
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

            ->editColumn('course',function ($q){
                return   $q->test->course->title ?? "N/A";
            })

            ->editColumn('test',function ($q){
                return ($q->test) ? $q->test->title : "N/A";
            })
            
            ->editColumn('user',function ($q){
                return ($q->user) ? $q->user->full_name : "N/A";
            })

            
            ->editColumn('result',function ($q){
                return ($q->result) ? $q->result : "N/A";
            })

            ->editColumn('published', function ($q) {
                return ($q->published == 1) ? "Yes" : "No";
            })
            ->rawColumns(['actions','questions'])
            ->make();
    }

    /**
     * Show the form for creating new Test.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        if (! Gate::allows('test_create')) {
            return abort(401);
        }
        $courses = \App\Models\Course::ofTeacher()->get();
        $courses_ids = $courses->pluck('id');
        $courses = $courses->pluck('title', 'id')->prepend('Please select', '');
        if(!empty(request('lesson_id')))
        $lesson = \App\Models\Lesson::where('id',request('lesson_id'))->first();
 
        return view('backend.tests_result.create', compact('courses','lesson'));
    }

    /**
     * Store a newly created Test in storage.
     *
     * @param  \App\Http\Requests\StoreTestsRequest  $request
     * @return \Illuminate\Http\Response
     */
    public function store(StoreTestsRequest $request)
    {
        $this->validate($request,[
            'test_result' => 'required'
        ],['test_result.required' => 'The test result is required']);

        if (! Gate::allows('test_create')) {
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
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        if (! Gate::allows('test_edit')) {
            return abort(401);
        }
        
        $tests_result = Result::findOrFail($id);
        return view('backend.tests_result.edit', compact('tests_result'));
    }

    /**
     * Update Test in storage.
     *
     * @param  \App\Http\Requests\UpdateTestsRequest  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(UpdateTestsRequest $request, $id)
    {

        $this->validate($request,[
            'test_result' => 'required'
        ],['test_result.required' => 'The test result is required']);


        if (! Gate::allows('test_edit')) {
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
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        if (! Gate::allows('test_view')) {
            return abort(401);
        }
        $test = Test::findOrFail($id);

        return view('backend.tests_result.show', compact('test'));
    }


    /**
     * Remove Test from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        if (! Gate::allows('test_delete')) {
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
        if (! Gate::allows('test_delete')) {
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
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function restore($id)
    {
        if (! Gate::allows('test_delete')) {
            return abort(401);
        }
        $test = Test::onlyTrashed()->findOrFail($id);
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
        if (! Gate::allows('test_delete')) {
            return abort(401);
        }
        $test = Test::onlyTrashed()->findOrFail($id);
        $test->forceDelete();

        return back()->withFlashSuccess(trans('alerts.backend.general.deleted'));
    }
}
