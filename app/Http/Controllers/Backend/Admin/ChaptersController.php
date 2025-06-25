<?php

namespace App\Http\Controllers\Backend\Admin;

use App\Models\Test;
use App\Models\Media;
use App\Models\Course;
use App\Models\Chapter;
use App\Models\Chapters;
use Illuminate\Http\Request;
use App\Models\CourseTimeline;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Facades\Gate;
use Yajra\DataTables\Facades\DataTables;
use App\Http\Controllers\Traits\FileUploadTrait;
use App\Http\Requests\Admin\StoreChaptersRequest;
use App\Http\Requests\Admin\UpdateChaptersRequest;
use App\Models\CourseLocation;

class ChaptersController extends Controller
{
    use FileUploadTrait;

    /**
     * Display a listing of Chapters.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        if (!Gate::allows('lesson_access')) {
            return abort(401);
        }
        $courses = $courses = Course::latest()->has('category')->ofTeacher()->pluck('title_ar', 'id')->prepend('Please select', '');

        return view('backend.chapters.index', compact('courses'));
    }
    public function index2(Request $request)
    { 
        
        if (!Gate::allows('lesson_access')) {
            return abort(401);
        }
        $courses = $courses = Course::latest()->has('category')->ofTeacher()->pluck('title_ar', 'id')->prepend('Please select', '');
        $course = Course::find($request->course_id);
        $currentCourseLocation = CourseLocation::find($request->course_location_id);

        return view('backend.chapters.index-2', compact('courses','course','currentCourseLocation'));
    }


    public function ReArrange(Request $request){
        if (!Gate::allows('lesson_create')) {
            return abort(401);
        }
        if(app()->getLocale()=="ar"){
            $chapters = Chapters::where('course_id',request('course_id'))->select('title_ar', 'id','sequence','published')->orderBy('sequence', 'asc')->get();
        }
        else
        {
            $chapters = Chapters::where('course_id',request('course_id'))->select('title', 'id','sequence','published')->orderBy('sequence', 'asc')->get();

        }
       $course=Course::find(request('course_id'));
       $currentCourseLocation = CourseLocation::find($request->course_location_id);

        return view('backend.chapters.rearrange', compact('chapters','course','currentCourseLocation'));
    }
    /**
     * Display a listing of Chapters via ajax DataTable.
     *
     * @return \Illuminate\Http\Response
     */
    public function getData(Request $request)
    {

        $has_view = false;
        $has_delete = false;
        $has_edit = false;
        $has_lessons = false;
        $has_copy = false;

        if (auth()->user()->can('lesson_access')) {
            $has_lessons = true;
        }

        $chapters = "";
        $chapters = Chapters::whereIn('course_id', Course::latest()->ofTeacher()->pluck('id'));


        if ($request->course_id != "") {
            // $chapters = $chapters->where('course_id', (int)$request->course_id)->orderBy('created_at', 'desc')->get();
            $chapters = $chapters->where('course_id', (int)$request->course_id)->orderBy('created_at', 'asc')->get();

        }

        if ($request->show_deleted == 1) {
            if (!Gate::allows('lesson_delete')) {
                return abort(401);
            }
            // $chapters = Chapters::query()->with('course')->orderBy('created_at', 'desc')->onlyTrashed()->get();
            $chapters = Chapters::query()->with('course')->orderBy('created_at', 'asc')->onlyTrashed()->get();

        }
        // if(\Auth::user()->hasRole('coordinator')&& $request->course_id != ""){
        //     $chapters = Chapters::where('course_id', (int)$request->course_id)->orderBy('created_at', 'asc')->get();


        // }

       
        if (auth()->user()->can('lesson_view')) {
            $has_view = true;
            $has_copy = true;
        }
        if (auth()->user()->can('lesson_edit')) {
            $has_edit = true;
        }
        if (auth()->user()->can('lesson_delete')) {
            $has_delete = true;
        }
        

        return DataTables::of($chapters)
            ->addIndexColumn()
            ->addColumn('actions', function ($q) use ($has_view, $has_edit, $has_delete,$has_copy, $request) {
                $view = "";
                $edit = "";
                $delete = "";
                if ($request->show_deleted == 1) {
                    return view('backend.datatable.action-trashed')->with(['route_label' => 'admin.chapters', 'label' => 'chapter', 'value' => $q->id]);
                }
                if ($has_view) {
                    $view = view('backend.datatable.action-view')
                        ->with(['route' => route('admin.chapters.show', ['chapter' => $q->id])])->render();
                }
                if ($has_edit) {
                    $edit = view('backend.datatable.action-edit')
                        ->with(['route' => route('admin.chapters.edit', ['chapter' => $q->id])])
                        ->render();
                    $view .= $edit;
                }
//                if ($has_copy) {
//                    $copy = view('backend.datatable.action-copy')
//                        ->with(['route' => route('admin.chapters.copy', ['chapter' => $q->id])])
//                        ->render();
//                    $view .= $copy;
//                }
                if ($has_delete && \Auth::user()->id==1) {
                    $delete = view('backend.datatable.action-delete')
                        ->with(['route' => route('admin.chapters.destroy', ['chapter' => $q->id])])
                        ->render();
                    $view .= $delete;
                }

                return $view;

            })->addColumn('lessons', function ($q) use ($has_lessons) {
                $view = "";
                  
                if ($has_lessons) {
                    $view .='<a href="'.route('admin.lessons.index', ['course_id' => $q->course_id,'chapter_id' => $q->id]).'" class="btn mb-1 btn-warning text-white"><i class="fa fa-arrow-circle-right"></i></a> ';
                    $view .='<a href="'.route('admin.lessons.create', ['course_id' => $q->course_id,'chapter_id' => $q->id]).'" class="btn mb-1 btn-success text-white"><i class="fa fa-plus-circle"></i></a> ';
                }
                    

                return $view;

            })->editColumn('title', function ($q) {
               
                return (app()->getLocale()=="ar")?$q->title_ar:$q->title;
                
               
            })
          
            ->rawColumns([ 'lessons' , 'actions'])
            ->make();

            
    }
    public function getData2(Request $request)
    {

        $has_view = false;
        $has_delete = false;
        $has_edit = false;
        $has_lessons = false;
        $has_copy = false;
        $course_location_id=$request->course_location_id; 
        if (auth()->user()->can('lesson_access')) {
            $has_lessons = true;
        }

        $chapters = "";
        $chapters = Chapters::whereIn('course_id', Course::latest()->ofTeacher()->pluck('id'));


        if ($request->course_id != "") {
            // $chapters = $chapters->where('course_id', (int)$request->course_id)->orderBy('created_at', 'desc')->get();
            $chapters = $chapters->where('course_id', (int)$request->course_id)->orderBy('created_at', 'asc')->get();

        }
       
        if ($request->show_deleted == 1) {
            if (!Gate::allows('lesson_delete')) {
                return abort(401);
            }
            // $chapters = Chapters::query()->with('course')->orderBy('created_at', 'desc')->onlyTrashed()->get();
            $chapters = Chapters::query()->with('course')->orderBy('created_at', 'asc')->onlyTrashed()->get();

        }
        // if(\Auth::user()->hasRole('coordinator')&& $request->course_id != ""){
        //     $chapters = Chapters::where('course_id', (int)$request->course_id)->orderBy('created_at', 'asc')->get();


        // }

        if (auth()->user()->can('lesson_view')) {
            $has_view = true;
            $has_copy = true;
        }
        if (auth()->user()->can('lesson_edit')) {
            $has_edit = true;
        }
        if (auth()->user()->can('lesson_delete')) {
            $has_delete = true;
        }
        

        return DataTables::of($chapters)
            ->addIndexColumn()
            ->addColumn('actions', function ($q) use ($has_view, $has_edit, $has_delete,$has_copy, $request,$course_location_id) {
                $view = "";
                $edit = "";
                $delete = "";
                if ($request->show_deleted == 1) {
                    return view('backend.datatable.action-trashed')->with(['route_label' => 'admin.chapters', 'label' => 'chapter', 'value' => $q->id]);
                }
                if ($has_view) {
                    $view = view('backend.datatable.action-view')
                        ->with(['route' => route('admin.chapters.show', ['chapter' => $q->id])])->render();
                }
                if ($has_edit) {
                    $edit = view('backend.datatable.action-edit')
                        ->with(['route' => route('admin.chapters.edit', ['chapter' => $q->id])])
                        ->render();
                    $view .= $edit;
                }
//                if ($has_copy) {
//                    $copy = view('backend.datatable.action-copy')
//                        ->with(['route' => route('admin.chapters.copy', ['chapter' => $q->id])])
//                        ->render();
//                    $view .= $copy;
//                }
                if ($has_delete) {
                    $delete = view('backend.datatable.action-delete')
                        ->with(['route' => route('admin.chapters.destroy', ['chapter' => $q->id])])
                        ->render();
                    $view .= $delete;
                }

                return $view;

            })->addColumn('lessons', function ($q) use ($has_lessons,$course_location_id) {
                $view = "";
                  
                if ($has_lessons) {
                    $view .='<a href="'.route('admin.lessons.index', ['course_id' => $q->course_id,'chapter_id' => $q->id]).'" class="btn mb-1 btn-warning text-white"><i class="fa fa-arrow-circle-right"></i></a> ';
                    $view .='<a href="'.route('admin.lessons.create', ['course_id' => $q->course_id,'chapter_id' => $q->id]).'" class="btn mb-1 btn-success "><i class="fa fa-plus-circle"></i></a> ';
                }
                    

                return $view;

            })->editColumn('title', function ($q) {
               
                return (app()->getLocale()=="ar")?$q->title_ar:$q->title;
                
               
            })
          
            ->rawColumns([ 'lessons' , 'actions'])
            ->make();

            
    }
    /**
     * Show the form for creating new Chapters.
     *
     * @return \Illuminate\Http\Response
     */
    public function get_chapter($id)
    {        
        $chapters = Chapters::where('course_id',$id)->pluck('title', 'id')->prepend('Please select', '0');        
        return response()->json(['chapters' => $chapters]);
    }

    /**
     * Show the form for creating new Chapters.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        if (!Gate::allows('lesson_create')) {
            return abort(401);
        }

        $course=Course::find(request('course_id'));

        return view('backend.chapters.create', compact('course'));
    }

    /**
     * Store a newly created Chapters in storage.
     *
     * @param  \App\Http\Requests\StoreChaptersRequest $request
     * @return \Illuminate\Http\Response
     */
    public function store(StoreChaptersRequest $request)
    {
        if (!Gate::allows('lesson_create')) {
            return abort(401);
        }
        if ($request->session_length) {
            $request->session_length = preg_replace('/[^0-9]/', '', $request->session_length);
        }
        $chapter = Chapters::create($request->all());
        if ($request->session_length) {
            $chapter->session_length=$request->session_length;
        }
        $chapter->save();
        return redirect()->route('admin.chapters2.index2', ['course_id' => $request->course_id])->withFlashSuccess(__('alerts.backend.general.created'));
    }


    /**
     * Show the form for editing Chapters.
     *
     * @param  int $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        if (!Gate::allows('lesson_edit')) {
            return abort(401);
        }
        $videos = '';

        
        if(app()->getLocale()=="ar"){
            $courses = Course::latest()->has('category')->ofTeacher()->get()->pluck('title_ar', 'id')->prepend('Please select', '');
        }
        else
        {
            $courses = Course::latest()->has('category')->ofTeacher()->get()->pluck('title', 'id')->prepend('Please select', '');
        }

        $chapter = Chapters::findOrFail($id);

        return view('backend.chapters.edit', compact('chapter', 'courses', 'videos'));
    }
    public function copy($id)
    {
        if (!Gate::allows('lesson_edit')) {
            return abort(401);
        }
        $videos = '';

        
        if(app()->getLocale()=="ar"){
            $courses = Course::latest()->has('category')->ofTeacher()->get()->pluck('title_ar', 'id')->prepend('Please select', '');
        }
        else
        {
            $courses = Course::latest()->has('category')->ofTeacher()->get()->pluck('title', 'id')->prepend('Please select', '');
        }

        $chapter = Chapters::findOrFail($id);

        return view('backend.chapters.copy', compact('chapter', 'courses', 'videos'));
    }
    public function storeCopy(StoreChaptersRequest $request)
    {
        // return abort(401);
        if (!Gate::allows('lesson_create')) {
            return abort(401);
        }
        $OldChapter=Chapters::find($request->copied_chapter_id);
        $OldChapter->copyChapter($request);
        
       
        return redirect()->route('admin.chapters.index', ['course_id' => $request->course_id])->withFlashSuccess(__('alerts.backend.general.created'));
       

       
    }
   
   
    /**
     * Update Chapters in storage.
     *
     * @param  \App\Http\Requests\UpdateChaptersRequest $request
     * @param  int $id
     * @return \Illuminate\Http\Response
     */
    public function update(UpdateChaptersRequest $request, $id)
    {
        
        if (!Gate::allows('lesson_edit')) {
            return abort(401);
        }
        $chapter = Chapters::findOrFail($id);
        //dd($request->all());
        $chapter->update($request->all());

        return redirect()->route('admin.chapters2.index2', ['course_id' => $request->course_id])->withFlashSuccess(__('alerts.backend.general.updated'));
    }


    /**
     * Display Chapters.
     *
     * @param  int $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        if (!Gate::allows('lesson_view')) {
            return abort(401);
        }
        $courses = Course::latest()->get()->pluck('title', 'id')->prepend('Please select', '');
        $chapter = Chapter::findOrFail($id);
        // $chapter = Chapters::findOrFail($id);


        return view('backend.chapters.show', compact('chapter','courses'));
    }


    /**
     * Remove Chapters from storage.
     *
     * @param  int $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        if (!Gate::allows('lesson_delete')) {
            return abort(401);
        }
        $chapter = Chapters::findOrFail($id);
        //if course has a group don't delete the chapter
        if ($chapter->course->groups()->count() > 0) {
            return back()->withFlashDanger(__('alerts.backend.chapter.group_remove_err'));
        }
        // $chapter->chapterStudents()->where('course_id', $chapter->course_id)->forceDelete();
        $chapter->delete();

        return back()->withFlashSuccess(__('alerts.backend.general.deleted'));
    }

    /**
     * Delete all selected Chapters at once.
     *
     * @param Request $request
     */
    public function massDestroy(Request $request)
    {
        if (!Gate::allows('lesson_delete')) {
            return abort(401);
        }
        if ($request->input('ids')) {
            $entries = Chapters::whereIn('id', $request->input('ids'))->get();

            foreach ($entries as $entry) {
                $entry->delete();
            }
        }
    }


    /**
     * Restore Chapters from storage.
     *
     * @param  int $id
     * @return \Illuminate\Http\Response
     */
    public function restore($id)
    {
        if (!Gate::allows('lesson_delete')) {
            return abort(401);
        }
        $chapter = Chapters::onlyTrashed()->findOrFail($id);
        $chapter->restore();

        return back()->withFlashSuccess(trans('alerts.backend.general.restored'));
    }

    /**
     * Permanently delete Chapters from storage.
     *
     * @param  int $id
     * @return \Illuminate\Http\Response
     */
    public function perma_del($id)
    {
        if (!Gate::allows('lesson_delete')) {
            return abort(401);
        }
        $chapter = Chapters::onlyTrashed()->findOrFail($id);

       
        $chapter->forceDelete();



        return back()->withFlashSuccess(trans('alerts.backend.general.deleted'));
    }
 

    public function saveSequence(Request $request)
    {
        if (!Gate::allows('lesson_edit')) {
            return abort(401);
        }

        foreach ($request->list as $item) {
            $chapterTimeline = Chapters::find($item['id']);
            $chapterTimeline->sequence = $item['sequence'];
            $chapterTimeline->save();
        }

        return 'success';
    }
}
