<?php

namespace App\Http\Controllers\Backend\Admin;

use App\Models\Rate;
use App\Models\Type;
use App\Models\Level;
use App\Models\Media;
use App\Models\Course;
use function foo\func;
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

class CoursesController extends Controller
{
    use FileUploadTrait;

    /**
     * Display a listing of Course.
     *
     * @return \Illuminate\Http\Response
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
            $courses = Course::onlyTrashed()->ofTeacher()->get();
        } else {
            $courses = Course::ofTeacher()->get();
        }

        return view('backend.courses.index', compact('courses'));
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
        $has_evaluate=false;
        $has_article=false;
        $has_lessons=false;
        $has_tests=false;
        
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
        }
        if (auth()->user()->can('course_edit')) {
            $has_edit = true;
            $has_evaluate=true;
            $has_article=true;

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
            ->addColumn('actions', function ($q) use ($has_view, $has_edit, $has_delete,$has_evaluate,$has_article, $has_lessons, $has_tests, $request) {
                $view = "";
                $edit = "";
                $delete = "";
                $evaluate="";
                $article="";

                $view .='<div class="btn-group" role="group" aria-label="'.__('labels.backend.access.users.user_actions').'">';
                 
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

                 $view .='
                  <div class="btn-group btn-group-sm" role="group">
                    <button id="userActions" type="button" class="btn btn-secondary dropdown-toggle" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                      '.__('labels.general.more').'
                    </button>
                    <div class="dropdown-menu" aria-labelledby="userActions">';                     
          
    
                    if ($has_delete) {
                        $view .='<a onclick="$(this).find(\'form\').submit();"  class="dropdown-item">'.__('buttons.general.crud.delete').'
                            
                            <form action="'.route('admin.courses.destroy', ['course' => $q->id]).'"
                                    method="POST" name="delete_item" style="display:none">'.
                               csrf_field().method_field('DELETE').'
                            </form>
                            </a>
                        ';
                        
                    }
                    
                    if ($has_lessons) {
                        $view .='<a href="'.route('admin.chapters.index', ['course_id' => $q->id]).'" class="dropdown-item">'.__('menus.backend.sidebar.chapters.title').'</a> ';
                    }
                        
                    if ($has_lessons) {
                        $view .='<a href="'.route('admin.lessons.index', ['course_id' => $q->id]).'" class="dropdown-item">'.__('menus.backend.sidebar.lessons.title').'</a> ';
                    }
                        
                    if ($has_tests) {
                        $view .='<a href="'.route('admin.tests.index', ['course_id' => $q->id]).'" class="dropdown-item">'.__('menus.backend.sidebar.tests.title').'</a> ';
                    }
    
                    if ($has_evaluate) {
                        $view .='<a href="'.route('admin.rate.course.show', ['course' => $q->id]).'" class="dropdown-item">'.__('menus.backend.sidebar.rates.title').'</a> ';

                        }
                    if ($has_article) {
                        $view .='<a href="'.route('admin.courses.articles.index', ['course' => $q->id]).'" class="dropdown-item">'.__('menus.backend.sidebar.blogs.title').'</a> ';                            
                        }
                    if($q->published == 1){
                        $type = 'unpublish';
                    }else{
                        $type = 'publish';
                    }
    
                    $view .='<a href="'.route('admin.courses.publish', ['course' => $q->id]).'" class="dropdown-item">'.__('buttons.general.crud.'.$type).'</a> ';                            

                        $view .= '
                    </div>
                  </div>
                </div>';



                return $view;

            })
            ->editColumn('teachers', function ($q) {
                $teachers = "";
                foreach ($q->teachers as $singleTeachers) {
                    $teachers .= '<span class="label label-info label-many">' . $singleTeachers->name . ' </span>';
                }
                return $teachers;
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
            ->editColumn('price', function ($q) {
                if ($q->free == 1) {
                    return trans('labels.backend.courses.fields.free');
                }
                return $q->price;
            })
            ->addColumn('category', function ($q) {
                return $q->category->name;
            })
            ->rawColumns(['teachers', 'lessons', 'course_image', 'actions', 'status'])
            ->make();
    }


    /**
     * Show the form for creating new Course.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
       

        if (!Gate::allows('course_create')) {
            return abort(401);
        }
        $teachers = \App\Models\Auth\User::whereHas('roles', function ($q) {
            $q->where('role_id', 2);
        })->get()->pluck('name', 'id');

        $categories = Category::where('status', '=', 1)->pluck('name', 'id');
        $types = Type::all()->pluck('name', 'id');
        $levels = Level::all()->pluck('name', 'id');

        return view('backend.courses.create', compact('teachers', 'categories', 'types', 'levels'));
    }

    /**
     * Store a newly created Course in storage.
     *
     * @param  \App\Http\Requests\StoreCoursesRequest $request
     * @return \Illuminate\Http\Response
     */
    public function store(StoreCoursesRequest $request)
    {
      
        if (!Gate::allows('course_create')) {
            return abort(401);
        }

        $request->all();
       if($request->file('add_pdf')){
        $requestFileSize=$request->file('add_pdf')->getSize();
       }
        $request = $this->saveFiles($request);

        $course = Course::create($request->all());

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
        if (($request->slug == "") || $request->slug == null) {
            $SlugExist=Course::where('slug' , str_slug($request->title))->exists();
            if($SlugExist==false)
            $course->slug = str_slug($request->title);
            else
            $course->slug = str_slug($request->title).'-'.$course->id;

            $course->save();
        }
        if ((int)$request->price == 0) {
            $course->price = NULL;
            $course->save();
        }


        $teachers = \Auth::user()->isAdmin() ? array_filter((array)$request->input('teachers')) : [\Auth::user()->id];
        $course->teachers()->sync($teachers);


        return redirect()->route('admin.courses.index')->withFlashSuccess(trans('alerts.backend.general.created'));
    }


    /**
     * Show the form for editing Course.
     *
     * @param  int $id
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
        $categories = Category::where('status', '=', 1)->pluck('name', 'id');


        $course = Course::findOrFail($id);
        $types = Type::all()->pluck('name', 'id');
        $levels = Level::all()->pluck('name', 'id');
        $locations = Location::all()->pluck('name', 'id');
        // $rates=Rate::Latest('course_id',$id)->get();
        // $rates=$course->rates()->latest()->get();
        $rates=Rate::Latest()->get();


        return view('backend.courses.edit', compact('course', 'teachers', 'categories', 'types', 'levels','locations','rates'));
    }

    /**
     * Update Course in storage.
     *
     * @param  \App\Http\Requests\UpdateCoursesRequest $request
     * @param  int $id
     * @return \Illuminate\Http\Response
     */
    public function update(UpdateCoursesRequest $request, $id)
    {
       
        if (!Gate::allows('course_edit')) {
            return abort(401);
        }
        $course = Course::findOrFail($id);
       
        if($request->file('add_pdf')){
            $requestFileSize=$request->file('add_pdf')->getSize();
           }
        $request = $this->saveFiles($request);
      
        //Saving  videos
        if ($request->media_type != "" || $request->media_type  != null || $request->add_pdf  != null|| $request->add_pdf  != "") {
//            if($course->mediavideo){
//                $course->mediavideo->delete();
//            }
//            if($course->mediaPdf){
//                $course->mediaPdf->delete();
//            }
           
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

//                if ($request->video_file != null) {
                if (\Illuminate\Support\Facades\Request::hasFile('video_file')) {
                    $file = \Illuminate\Support\Facades\Request::file('video_file');
                    $filename = time() . '-' . $file->getClientOriginalName();
                    $size = $file->getSize() / 1024;
                    $path = public_path() . '/storage/uploads/';
                    $file->move($path, $filename);

                    $video_id = $filename;
                    $url = asset('storage/uploads/' . $filename);

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
                    $media->url = $url;
                    $media->type = $request->media_type;
                    $media->file_name = $request->video_file;
                    $media->size = 0;
                    $media->save();

                }
            }
            if ($request->hasFile('add_pdf')) {
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

      
        $course->update($request->all());
        if (($request->slug == "") || $request->slug == null) {
           
            $SlugExist=Course::where('slug' , str_slug($request->title))->exists();
            if($SlugExist==false)
            $course->slug = str_slug($request->title);
            else
            $course->slug = str_slug($request->title).'-'.$course->id;
            $course->save();
        }
        if ((int)$request->price == 0) {
            $course->price = NULL;
            $course->save();
        }

        $course->forms()->sync(array_filter((array)$request->input('rates')));

        $teachers = \Auth::user()->isAdmin() ? array_filter((array)$request->input('teachers')) : [\Auth::user()->id];
        $course->teachers()->sync($teachers);

        return redirect()->route('admin.courses.index')->withFlashSuccess(trans('alerts.backend.general.updated'));
    }


    /**
     * Display Course.
     *
     * @param  int $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        if (!Gate::allows('course_view')) {
            return abort(401);
        }
        $teachers = User::get()->pluck('name', 'id');
        $lessons = \App\Models\Lesson::where('course_id', $id)->get();
        $tests = \App\Models\Test::where('course_id', $id)->get();

        $course = Course::findOrFail($id);
        $courseTimeline = $course->courseTimeline()->orderBy('sequence', 'asc')->get();
        // $courseTimeline = $course->courseTimeline()->get();

       
        return view('backend.courses.show', compact('course', 'lessons', 'tests', 'courseTimeline'));
    }


    /**
     * Remove Course from storage.
     *
     * @param  int $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        if (!Gate::allows('course_delete')) {
            return abort(401);
        }
        $course = Course::findOrFail($id);
        if ($course->students->count() >= 1) {
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
     * @param  int $id
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
     * @param  int $id
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
     * @param  Request
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
     * @param  Request
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
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function upload(Request $request)
    {
    //dd(request()->file);
    $request = $this->saveFiles($request);
        $location=$request->file;
        return response()->json(['location' => url("storage/uploads/".$location)]);            
     
        }


    
}
