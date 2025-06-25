<?php

namespace App\Http\Controllers\Backend\Admin;

use App\Http\Controllers\Services\YouTubeServices;
use App\Models\Course;
use App\Models\Chapters;
use App\Models\CourseTimeline;
use App\Models\GroupTimeline;
use App\Models\Lesson;
use App\Models\LessonResourceLink;
use App\Models\Media;
use App\Models\Test;
use App\Models\Transcripts;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Facades\Gate;
use App\Http\Controllers\Controller;
use App\Http\Requests\Admin\StoreLessonsRequest;
use App\Http\Requests\Admin\UpdateLessonsRequest;
use App\Http\Controllers\Traits\FileUploadTrait;
use App\Models\CourseLocation;
use Yajra\DataTables\Facades\DataTables;

class LessonsController extends Controller
{
    use FileUploadTrait;

    private $youtubeServices;

    public function __construct(YouTubeServices $youTubeServices) {
        $this->youtubeServices = $youTubeServices;
    }

    /**
     * Display a listing of Lesson.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        if (!Gate::allows('lesson_access')) {
            return abort(401);
        }
        $course = Course::find($request->course_id);
        if (app()->getLocale() == "ar") {
            $courses = Course::latest()->has('category')->ofTeacher()->get()->pluck('title_ar', 'id')->prepend('Please select', '');
        } else {
            $courses = Course::latest()->has('category')->ofTeacher()->get()->pluck('title', 'id')->prepend('Please select', '');
        }

        $lessons = Lesson::whereIn('course_id', Course::latest()->ofTeacher()->pluck('id'));


        // $courseLocations=request('course_id')?(session('locale') =='ar'?Course::find(request('course_id'))->locations->pluck('name_ar','pivot.id'):Course::find(request('course_id'))->locations->pluck('name','pivot.id')):[];

        $courseLocations = [];
        $groups = Course::find(request('course_id'))->groups;
        //courseLocationsColl returns all locations of the course from the group groupPlaces
        if ($groups->count() > 0) {
            $courseLocations = [];
            foreach ($groups as $key => $group) {
                $courseLocations[$group->id] = session('locale') == 'ar' ? $group->start->format('d-m-y') . ' ' .
                    $group->title_ar : $group->start->format('d-m-y') . ' ' . $group->title_en;
            }
        }

        return view('backend.lessons.index2', compact('courses', 'course', 'lessons', 'courseLocations'));
    }

    public function index3(Request $request)
    {
      
        if (!Gate::allows('lesson_access')) {
            return abort(401);
        }

        if (app()->getLocale() == "ar") {
            $courses = Course::latest()->has('category')->ofTeacher()->get()->pluck('title_ar', 'id')->prepend('Please select', '');
        } else {
            $courses = Course::latest()->has('category')->ofTeacher()->get()->pluck('title', 'id')->prepend('Please select', '');
        }
// dd($courses);
        $lessons = Lesson::whereIn('course_id', Course::latest()->ofTeacher()->pluck('id'));
        if ($request->course_id != "") {
            $lessons = $lessons->where('course_id', (int)$request->course_id)->orderBy('position', 'asc')->get();
        }
        if ($request->course_id != "" && $request->chapter_id != "") {
            $lessons = Lesson::where('chapter_id', (int)$request->chapter_id)->where('course_id', (int)$request->course_id)->orderBy('position', 'asc')->get();
        }

        // $lessons = Lesson::whereIn('course_id', CourseTimeline::orderBy()->course()->pluck('id'));

        if ($request->course_id != "" && $request->course_location_id != "") {
            $lessons = Lesson::where('course_id', (int)$request->course_id)
                ->orderBy('position', 'asc')
                ->whereHas('courseLocations', function ($query) use ($request) {

                    $query->where('course_location_id', '=', $request->course_location_id)
                        ->where('model_type', '=', 'App\Models\Lesson');
                })->get();
        }
        // $courseLocations=request('course_id')?(session('locale') =='ar'?Course::find(request('course_id'))->locations->pluck('name_ar','pivot.id'):Course::find(request('course_id'))->locations->pluck('name','pivot.id')):[];
        $courseLocationsColl = session('locale') == 'ar' ? Course::find(request('course_id'))
            ->locations : Course::find(request('course_id'))->locations;
        $courseLocations = [];
        foreach ($courseLocationsColl as $key => $loc) {
            # code...

            $courseLocations[$loc->pivot->id] = session('locale') == 'ar' ? $loc->pivot->start_date . ' ' . $loc->name_ar : $loc->start_date . ' ' . $loc->name;
        }

        return view('backend.lessons.index', compact('courses', 'lessons', 'courseLocations'));
    }


    public function index2(Request $request)
    {
        if (!Gate::allows('lesson_access')) {
            return abort(401);
        }
        $course = Course::find($request->course_id);
        if (app()->getLocale() == "ar") {
            $courses = Course::latest()->has('category')->ofTeacher()->get()->pluck('title_ar', 'id')->prepend('Please select', '');
        } else {
            $courses = Course::latest()->has('category')->ofTeacher()->get()->pluck('title', 'id')->prepend('Please select', '');
        }

        $lessons = Lesson::whereIn('course_id', Course::latest()->ofTeacher()->pluck('id'));
        if ($request->course_id != "") {
            $lessons = $lessons->where('course_id', (int)$request->course_id)
                ->whereHas('courseLocations', function ($query) use ($request) {

                    $query->where('course_location_id', '=', $request->course_location_id)
                        ->where('model_type', '=', 'App\Models\Lesson');
                })->orderBy('position', 'asc')
                ->get();
        }
        if ($request->course_id != "" && $request->chapter_id != "") {
            $lessons = Lesson::where('chapter_id', (int)$request->chapter_id)->where('course_id', (int)$request->course_id)->orderBy('position', 'asc')->get();
        }

        // $lessons = Lesson::whereIn('course_id', CourseTimeline::orderBy()->course()->pluck('id'));

        if ($request->course_id != "" && $request->course_location_id != "") {
            $lessons = Lesson::where('course_id', (int)$request->course_id)
                ->orderBy('position', 'asc')
                ->whereHas('courseLocations', function ($query) use ($request) {

                    $query->where('course_location_id', '=', $request->course_location_id)
                        ->where('model_type', '=', 'App\Models\Lesson');
                })->get();
        }
        // $courseLocations=request('course_id')?(session('locale') =='ar'?Course::find(request('course_id'))->locations->pluck('name_ar','pivot.id'):Course::find(request('course_id'))->locations->pluck('name','pivot.id')):[];

        $courseLocations = [];
        $groups = Course::find(request('course_id'))->groups;
        //courseLocationsColl returns all locations of the course from the group groupPlaces
        if ($groups->count() > 0) {
            $courseLocations = [];
            foreach ($groups as $key => $group) {
                $courseLocations[$group->id] = session('locale') == 'ar' ? $group->start->format('d-m-y') . ' ' .
                    $group->title_ar : $group->start->format('d-m-y') . ' ' . $group->title_en;
            }
        }

        return view('backend.lessons.index2', compact('courses', 'course', 'lessons', 'courseLocations'));
    }

    /**
     * Display a listing of Lessons via ajax DataTable.
     *
     * @return \Illuminate\Http\Response
     */
    public function getData(Request $request)
    {
        $has_view = false;
        $has_delete = false;
        $has_edit = false;
        $has_copy = false;

        $lessons = "";

        $lessons = Lesson::whereIn('lessons.course_id', Course::latest()->ofTeacher()->pluck('id'));


        if ($request->course_id != "") {
            // $lessons = $lessons->where('course_id', (int)$request->course_id)->orderBy('position', 'asc')
            // ->get();

            $lessons = $lessons
                ->Join('course_timeline', function ($join) use ($request) {
                    $join->on('lessons.id', '=', 'course_timeline.model_id')
                        ->where('model_type', '=', 'App\Models\Lesson')
                        ->where('course_timeline.course_id', (int)$request->course_id);
                })->orderBy('course_timeline.sequence')
                ->where('lessons.course_id', (int)$request->course_id)->orderBy('lessons.position', 'asc')
                ->select('lessons.*', 'course_timeline.*', 'lessons.id')
                ->get();
        }

        if ($request->course_id != "" && $request->chapter_id != "") {
            $lessons = Lesson::Join('course_timeline', function ($join) use ($request) {
                    $join->on('lessons.id', '=', 'course_timeline.model_id')
                        ->where('model_type', '=', 'App\Models\Lesson')
                        ->where('course_timeline.course_id', (int)$request->course_id);
                })->orderBy('course_timeline.sequence')
                ->where('lessons.course_id', (int)$request->course_id)
                ->where('lessons.chapter_id', (int)$request->chapter_id)
                ->orderBy('lessons.position', 'asc')
                ->select('lessons.*', 'course_timeline.*', 'lessons.id')
                ->get();
        }


        if ($request->course_id != "" && $request->course_location_id != "") {

            $lessons = Lesson::where('course_id', (int)$request->course_id)

                ->whereHas('courseLocations', function ($query) use ($request) {

                    $query->where('course_location_id', '=', $request->course_location_id)
                        ->where('model_type', '=', 'App\Models\Lesson');
                })->whereHas('courseTimeline', function ($query) use ($request) {

                    $query->where('course_id', '=', (int)$request->course_id)
                        ->where('model_type', '=', 'App\Models\Lesson')->orderBy('sequence');
                })
                ->get();
        }
        if ($request->lesson_id != "" && $request->lesson_id != 0) {
            $lessons = Lesson::whereIn('lessons.course_id', Course::latest()->ofTeacher()->pluck('id'))
                ->where('lessons.id', (int)$request->lesson_id)->get();
        }
        if ($request->show_deleted == 1) {
            if (!Gate::allows('lesson_delete')) {
                return abort(401);
            }
            $lessons = Lesson::query()->with('course')->whereHas('courseTimeline', function ($query) use ($request) {

                $query->where('course_id', '=', $request->course_id)
                    ->where('model_type', '=', 'App\Models\Lesson');
            })->onlyTrashed()->get();
        }


        if (auth()->user()->can('lesson_view')) {
            $has_view = true;
        }
        if (auth()->user()->can('lesson_edit')) {
            $has_edit = true;
            $has_copy = true;
        }
        if (auth()->user()->can('lesson_delete')) {
            $has_delete = true;
        }

        $str = '';
        foreach ($lessons as $key => $value) {
            # code...
            foreach ($value->courseLocations as $key2 => $loc) {
                # code...

                $str .= (app()->getLocale() == "ar") ? $loc->location->name_ar : $loc->location->name;
                $str .= $loc->start_date;
            }
        }

        return DataTables::of($lessons)
            ->addIndexColumn()
            ->addColumn('actions', function ($q) use ($has_view, $has_edit, $has_delete, $has_copy, $str, $request) {
                $view = "";
                $edit = "";
                $delete = "";
                if ($request->show_deleted == 1) {
                    return view('backend.datatable.action-trashed')->with(['route_label' => 'admin.lessons', 'label' => 'lesson', 'value' => $q->id,'course_location_id'=>$request->course_location_id]);
                }
                if ($has_view) {
                    $view = view('backend.datatable.action-view')
                        ->with(['route' => route('admin.lessons.show', ['lesson' => $q->id])])->render();
                }
                if ($has_edit) {
                    $edit = view('backend.datatable.action-edit')
                        ->with(['route' => route('admin.lessons.edit', ['lesson' => $q->id, 'course_id' =>
                            $q->course->id])])
                        ->render();
                    $view .= $edit;
                }

                if ($has_delete && \Auth::user()->id==1) {
                    $delete = view('backend.datatable.action-delete')
                        ->with(['route' => route('admin.lessons.destroy', ['lesson' => $q->id,'course_location_id'=>$request->course_location_id])])
                        ->render();
                    $view .= $delete;
                }
                if ($has_copy) {
                    $copy = view('backend.datatable.action-copy')
                        ->with(['route' => route('admin.lessons.edit', ['lesson' => $q->id, 'course_id' =>
                            $q->course->id])])
                        ->render();
                    $view .= $copy;
                }

                return $view;
            })
            ->editColumn('course', function ($q) {
                return (app()->getLocale() == "ar") ? $q->course->title_ar : $q->course->title;
            })
            ->editColumn('chapter', function ($q) {
                return (app()->getLocale() == "ar") ? (@$q->chapter->title_ar ? @$q->chapter->title_ar : @$q->chapter->title) : @$q->chapter->title;
            })
            ->editColumn('lesson_image', function ($q) {
                return ($q->lesson_image != null) ? '<img height="50px" src="' . asset('/storage/uploads/' . $q->lesson_image) . '">' : 'N/A';
            })
            ->editColumn('free_lesson', function ($q) {
                return ($q->free_lesson == 1) ? "Yes" : "No";
            })
            ->editColumn('published', function ($q) {
                $yes = app()->getLocale() == "ar" ? 'تم النشر' : 'Yes';
                $no = app()->getLocale() == "ar" ? 'لم يتم النشر' : 'No';

                return ($q->published == 1) ? $yes : $no;
            })->editColumn('title', function ($q) {
                return (app()->getLocale() == "ar") ? ($q->title_ar ? $q->title_ar : $q->title) : $q->title;
            })
            ->editColumn('locations', function ($q) {
                $str = ' ';

                foreach ($q->courseLocations()->where('model_type', 'App\Models\Lesson')->get() as $key2 => $loc) {
                    # code...

                    $str .= (app()->getLocale() == "ar") ? $loc->location->name_ar : $loc->location->name;
                    $str .= '(';
                    $str .= $loc->start_date;
                    $str .= ')';
                    $str .= ' ';
                }

                return $str;
            })
            ->rawColumns(['lesson_image', 'actions'])
            ->make();
    }
    public function getData2(Request $request)
    {
        $has_view = false;
        $has_delete = false;
        $has_edit = false;
        $has_copy = false;

        $lessons = "";
        $lessons = Lesson::whereIn('lessons.course_id', Course::latest()->ofTeacher()->pluck('id'));


        if ($request->course_id != "") {
            // $lessons = $lessons->where('course_id', (int)$request->course_id)->orderBy('position', 'asc')
            // ->get();

            $lessons = $lessons
                ->Join('course_timeline', function ($join) use ($request) {
                    $join->on('lessons.id', '=', 'course_timeline.model_id')
                        ->where('model_type', '=', 'App\Models\Lesson')
                        ->where('course_timeline.course_id', (int)$request->course_id);
                })->orderBy('course_timeline.sequence')
                ->where('lessons.course_id', (int)$request->course_id)->orderBy('lessons.position', 'asc')
                ->select('lessons.*', 'course_timeline.*', 'lessons.id')
                ->get();
        }

        if ($request->course_id != "" && $request->chapter_id != "") {
            $lessons = Lesson::Join('course_timeline', function ($join) use ($request) {
                    $join->on('lessons.id', '=', 'course_timeline.model_id')
                        ->where('model_type', '=', 'App\Models\Lesson')
                        ->where('course_timeline.course_id', (int)$request->course_id);
                })->orderBy('course_timeline.sequence')
                ->where('lessons.course_id', (int)$request->course_id)
                ->where('lessons.chapter_id', (int)$request->chapter_id)
                ->orderBy('lessons.position', 'asc')
                ->select('lessons.*', 'course_timeline.*', 'lessons.id')
                ->get();
        }


        if ($request->course_id != "" && $request->course_location_id != "") {

            $lessons = Lesson::where('course_id', (int)$request->course_id)

                ->whereHas('courseLocations', function ($query) use ($request) {

                    $query->where('course_location_id', '=', $request->course_location_id)
                        ->where('model_type', '=', 'App\Models\Lesson');
                })->whereHas('courseTimeline', function ($query) use ($request) {

                    $query->where('course_id', '=', (int)$request->course_id)
                        ->where('model_type', '=', 'App\Models\Lesson')->orderBy('sequence');
                })
                ->get();
        }
        if ($request->show_deleted == 1) {
            if (!Gate::allows('lesson_delete')) {
                return abort(401);
            }
            $lessons = Lesson::query()->with('course')->whereHas('courseTimeline', function ($query) use ($request) {

                $query->where('course_id', '=', $request->course_id)
                    ->where('model_type', '=', 'App\Models\Lesson');
            })->orderBy('sequence', 'asc')->onlyTrashed()->get();
        }


        if (auth()->user()->can('lesson_view')) {
            $has_view = true;
        }
        if (auth()->user()->can('lesson_edit')) {
            $has_edit = true;
            $has_copy = true;
        }
        if (auth()->user()->can('lesson_delete')) {
            $has_delete = true;
        }

        $str = '';
        foreach ($lessons as $key => $value) {
            # code...
            foreach ($value->courseLocations as $key2 => $loc) {
                # code...

                $str .= (app()->getLocale() == "ar") ? $loc->location->name_ar : $loc->location->name;
                $str .= $loc->start_date;
            }
        }

        return DataTables::of($lessons)
            ->addIndexColumn()
            ->addColumn('actions', function ($q) use ($has_view, $has_edit, $has_delete, $has_copy, $str, $request) {
                $view = "";
                $edit = "";
                $delete = "";
                if ($request->show_deleted == 1) {
                    return view('backend.datatable.action-trashed')->with(['route_label' => 'admin.lessons', 'label' => 'lesson', 'value' => $q->id]);
                }
                if ($has_view) {
                    $view = view('backend.datatable.action-view')
                        ->with(['route' => route('admin.lessons.show', ['lesson' => $q->id])])->render();
                }
                if ($has_edit) {
                    $edit = view('backend.datatable.action-edit')
                        ->with(['route' => route('admin.lessons.edit', ['lesson' => $q->id, 'course_id' =>
                            $q->course->id])])
                        ->render();
                    $view .= $edit;
                }

                if ($has_delete) {
                    $delete = view('backend.datatable.action-delete')
                        ->with(['route' => route('admin.lessons.destroy', ['lesson' => $q->id])])
                        ->render();
                    $view .= $delete;
                }
                if ($has_copy) {
                    $copy = view('backend.datatable.action-copy')
                        ->with(['route' => route('admin.lessons.edit', ['lesson' => $q->id, 'course_id' =>
                            $q->course->id])])
                        ->render();
                    $view .= $copy;
                }

                return $view;
            })
            ->editColumn('course', function ($q) {
                return (app()->getLocale() == "ar") ? $q->course->title_ar : $q->course->title;
            })
            ->editColumn('chapter', function ($q) {
                return (app()->getLocale() == "ar") ? (@$q->chapter->title_ar ? @$q->chapter->title_ar : @$q->chapter->title) : @$q->chapter->title;
            })
            ->editColumn('lesson_image', function ($q) {
                return ($q->lesson_image != null) ? '<img height="50px" src="' . asset('/storage/uploads/' . $q->lesson_image) . '">' : 'N/A';
            })
            ->editColumn('free_lesson', function ($q) {
                return ($q->free_lesson == 1) ? "Yes" : "No";
            })
            ->editColumn('published', function ($q) {
                $yes = app()->getLocale() == "ar" ? 'تم النشر' : 'Yes';
                $no = app()->getLocale() == "ar" ? 'لم يتم النشر' : 'No';

                return ($q->published == 1) ? $yes : $no;
            })->editColumn('title', function ($q) {
                return (app()->getLocale() == "ar") ? ($q->title_ar ? $q->title_ar : $q->title) : $q->title;
            })
            // ->editColumn('locations', function ($q) {
            //     $str = ' ';

            //     foreach ($q->courseLocations()->where('model_type', 'App\Models\Lesson')->get() as $key2 => $loc) {
            //         # code...

            //         $str .= (app()->getLocale() == "ar") ? $loc->location->name_ar : $loc->location->name;
            //         $str .= '(';
            //         $str .= $loc->start_date;
            //         $str .= ')';
            //         $str .= ' ';
            //     }

            //     return $str;
            // })
            ->rawColumns(['lesson_image', 'actions'])
            ->make();
    }

    /**
     * Show the form for creating new Lesson.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        if (!Gate::allows('lesson_create')) {
            return abort(401);
        }
        $course = '';
        $chapters = '';
        $courseLocations = [];
        if (app()->getLocale() == "ar") {
            $courses = Course::latest()->has('category')->ofTeacher()->get()->pluck('title_ar', 'id')->prepend('Please select', '');
        } else {
            $courses = Course::latest()->has('category')->ofTeacher()->get()->pluck('title', 'id')->prepend('Please select', '');
        }
        $course = Course::find(request('course_id'));
        if ($course->type_id == 1) {
            $chapters = Chapters::all()->pluck('title_ar', 'id', 'id')->prepend('Please select', '');
        }
        if (request('course_id')) {
            $chapters = $chapters = Chapters::where('course_id', request('course_id'))->pluck('title_ar', 'id')->prepend('Please select', '');
            // $courseLocations=session('locale') =='ar'?Course::find(request('course_id'))->locations->pluck('name_ar','pivot.id'):Course::find(request('course_id'))->locations->pluck('name','pivot.id');
            $groups = Course::find(request('course_id'))->groups;
            //courseLocationsColl returns all locations of the course from the group groupPlaces
            if ($groups->count() > 0) {
                $courseLocations = [];
                foreach ($groups as $key => $group) {
                  $courseLocations[$group->id] = session('locale') == 'ar' ? $group->start->format('d-m-y') . ' ' .
                      $group->title_ar : $group->start->format('d-m-y') . ' ' . $group->title_en;
                }
            }
        }

        return view('backend.lessons.create', compact('courses','course', 'chapters', 'courseLocations'));
    }

    /**
     * Store a newly created Lesson in storage.
     *
     * @param  \App\Http\Requests\StoreLessonsRequest $request
     * @return \Illuminate\Http\Response
     */
    public function store(StoreLessonsRequest $request)
    {

        if (!Gate::allows('lesson_create')) {
            return abort(401);
        }

        $course = Course::find($request->course_id);
        if ($course->type_id == 2) {
            $parsedUrl = parse_url($request->zoom_link);
            if (!preg_match('/\.?zoom\.us$/', $parsedUrl['host'])) {
                return redirect()->back()->withFlashDanger(__('alerts.backend.lesson.valid_zoom_link'));
            }
        }


        $lesson = Lesson::create($request->except('downloadable_files', 'lesson_image', 'zoom_link')
            + ['position' => Lesson::where('course_id', $request->course_id)->max('position') + 1]);

        if ($request->zoom_link != null) {
            if (strpos($request->zoom_link, 'zoom.us') !== false) {
                $lesson->zoom_link = $request->zoom_link;
                $lesson->save();
            }
        }

        //attach resource links to the lesson
        if ($request->has('resourceLinks')){
            $links = explode(',', $request->input('resourceLinks'));
            foreach ($links as $link) {
                // Check if link isnt empty
                if($link == '') continue;

                // Save the link
                $lessonResourceLink = new LessonResourceLink();
                $lessonResourceLink->lesson_id = $lesson->id;
                $lessonResourceLink->link = $link;
                $lessonResourceLink->save();
            }
        }


        //attach lesson to all course groups if available
        $groups = $course->groups;
        if ($groups->isNotEmpty()) {
            foreach ($groups as $group) {
                $group->courseLessons()->attach($lesson->id, ['status' => 1]);

                // Get the GroupTimeline entries for the group
                $groupTimelines = GroupTimeline::where('group_id', $group->id)->get();
                $this->checkAndCreateTimeline($group, $lesson, Lesson::class, $groupTimelines);

            }
        }



        //save media files/urls
        if ($request->media_type != "") {
            $model_type = Lesson::class;
            $model_id = $lesson->id;
            $size = 0;
            $media = '';
            $url = '';
            $video_id = '';
            $name = $lesson->title . ' - video';

            if (($request->media_type == 'youtube') || ($request->media_type == 'vimeo')) {
                $video = $request->video;
                $url = $video;
                $video_id = array_last(explode('/', $request->video));
                $media = Media::where('url', $video_id)
                    ->where('type', '=', $request->media_type)
                    ->where('model_type', '=', 'App\Models\Lesson')
                    ->where('model_id', '=', $lesson->id)
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
                        ->where('model_id', '=', $lesson->id)
                        ->first();
                }
            } else if ($request->media_type == 'embed') {
                $url = $request->video;
                $filename = $lesson->title . ' - video';
            } else if ($request->media_type == 'zoom') {
                $url = $request->video;
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
        $request = $this->saveAllFiles($request, 'downloadable_files', Lesson::class, $lesson);
        //create slug
        if (($request->slug == "") || $request->slug == null) {
            $lesson->slug = str_slug($request->title);
            $slug_exist = count(Lesson::where('slug', str_slug($request->title))->get());
            if ($slug_exist > 0) {
                $lesson->slug = str_slug($request->title) . '_' . $lesson->id;
            }
            $lesson->save();
        }

        $sequence = 1;
        if (count($lesson->course->courseTimeline) > 0) {
            $sequence = $lesson->course->courseTimeline->max('sequence');
            $sequence = $sequence + 1;
        }

        if ($lesson->published == 1) {
            $timeline = CourseTimeline::where('model_type', '=', Lesson::class)
                ->where('model_id', '=', $lesson->id)
                ->where('course_id', $request->course_id)->first();
            if ($timeline == null) {
                $timeline = new CourseTimeline();
                $timeline->sequence = $sequence;
            }
            $timeline->course_id = $request->course_id;
            $timeline->model_id = $lesson->id;
            $timeline->model_type = Lesson::class;
            $timeline->sequence = $timeline->sequence ? $timeline->sequence : $sequence;
            $timeline->save();
        }

        if ($request->media_type == 'youtube'){
            // slice the video id from the url
            $video_id = $this->get_yt_video_id($request->video);

            // Get transcript from youtube service
            $video_info = $this->youtubeServices->get_transcript($video_id);

            // Save the transcript to the database
            $lesson->transcript()->create([
                'description' => $video_info['video']['description'],
                'transcript' => $video_info['video']['transcript'],
                'channel_id' => $video_info['video']['channelId'],
                'published_at' => $video_info['video']['publishedAt'],
                'url' => $video_info['video']['url'],
            ]);

        }

        return redirect()->route('admin.lessons.index2', ['course_id' => $lesson->course_id])->withFlashSuccess(__('alerts.backend.general.created'));
    }


    /**
     * Show the form for editing Lesson.
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
        $course = '';
        $chapters = '';

        if (app()->getLocale() == "ar") {
            $courses = Course::latest()->has('category')->ofTeacher()->get()->pluck('title_ar', 'id')->prepend('Please select', '');
            $course = Course::find(request('course_id'));
        } else {
            $courses = Course::latest()->has('category')->ofTeacher()->get()->pluck('title', 'id')->prepend('Please select', '');
            $course = Course::find(request('course_id'));

        }

        $lesson = Lesson::with('media')->findOrFail($id);

        if ($lesson->media) {
            $videos = $lesson->media()->where('media.type', '=', 'YT')->pluck('url')->implode(',');
        }

        if ($course->type_id == 1){
            // $chapters = Chapters::where('course_id', $lesson->course_id)->pluck('title', 'id')->prepend('Please select', '');
        }
        $chapters = Chapters::where('course_id', $lesson->course_id)->pluck('title', 'id')->prepend('Please select', '');


        // $courseLocations=session('locale') =='ar'?Course::find($lesson->course_id)->locations->pluck('name_ar','pivot.id'):Course::find($lesson->course_id)->locations->pluck('name','pivot.id');
        $groups = Course::find(request('course_id'))->groups;
        $courseLocations = [];
        if ($groups->count() > 0) {
            $courseLocations = [];
            foreach ($groups as $key => $group) {
                $courseLocations[$group->id] = session('locale') == 'ar' ? $group->start->format('d-m-y') . ' ' .
                    $group->title_ar : $group->start->format('d-m-y') . ' ' . $group->title_en;
            }
        }

        return view('backend.lessons.edit', compact('lesson', 'courses','course', 'chapters', 'videos', 'courseLocations'));
    }
    public function copyLesson($id)
    {
        if (!Gate::allows('lesson_edit')) {
            return abort(401);
        }
        $videos = '';

        if (app()->getLocale() == "ar") {
            $courses = Course::latest()->has('category')->ofTeacher()->get()->pluck('title_ar', 'id')->prepend('Please select', '');
        } else {
            $courses = Course::latest()->has('category')->ofTeacher()->get()->pluck('title', 'id')->prepend('Please select', '');
        }

        $lesson = Lesson::with('media')->findOrFail($id);
        if ($lesson->media) {
            $videos = $lesson->media()->where('media.type', '=', 'YT')->pluck('url')->implode(',');
        }
        $chapters = Chapters::where('course_id', $lesson->course_id)->pluck('title', 'id')->prepend('Please select', '');
        // $courseLocations=session('locale') =='ar'?Course::find($lesson->course_id)->locations->pluck('name_ar','pivot.id'):Course::find($lesson->course_id)->locations->pluck('name','pivot.id');
        $courseLocationsColl = session('locale') == 'ar' ? Course::find($lesson->course_id)
            ->locations : Course::find($lesson->course_id)->locations;
        $courseLocations = [];
        foreach ($courseLocationsColl as $key => $loc) {
            # code...

            $courseLocations[$loc->pivot->id] = session('locale') == 'ar' ? $loc->pivot->start_date . ' ' . $loc->name_ar : $loc->start_date . ' ' . $loc->name;
        }

        return view('backend.lessons.copy', compact('lesson', 'courses', 'chapters', 'videos', 'courseLocations'));
    }
    /**
     * Update Lesson in storage.
     *
     * @param  \App\Http\Requests\UpdateLessonsRequest $request
     * @param  int $id
     * @return \Illuminate\Http\Response
     */
    public function update(UpdateLessonsRequest $request, $id)
    {
        if (!Gate::allows('lesson_edit')) {
            return abort(401);
        }

        $course = Course::find($request->course_id);
        $lesson = Lesson::findOrFail($id);
        if ($course->type_id == 2) {
            $parsedUrl = parse_url($request->zoom_link);
            if (!preg_match('/\.?zoom\.us$/', $parsedUrl['host'])) {
                return redirect()->back()->withFlashDanger(__('alerts.backend.lesson.valid_zoom_link'));
            }
        }

        $lesson->update($request->except('downloadable_files', 'lesson_image'));
        if (($request->slug == "") || $request->slug == null) {
            $lesson->slug = str_slug($request->title);
            $slug_exist = count(Lesson::where('slug', str_slug($request->title))->get());
            if ($slug_exist > 0) {
                $lesson->slug = str_slug($request->title) . '_' . $lesson->id;
            }
            $lesson->save();
        }

        //attach resource links to the lesson
        if ($request->has('resourceLinks')){
            $links = explode(',', $request->input('resourceLinks'));
            $lesson->resources()->delete();

            foreach ($links as $link) {
                // Check if link isnt empty
                if($link == '') continue;

                // Save the link
                $lessonResourceLink = new LessonResourceLink();
                $lessonResourceLink->lesson_id = $lesson->id;
                $lessonResourceLink->link = $link;
                $lessonResourceLink->save();
            }
        }

        //Saving  videos
        if ($request->media_type != "" || $request->media_type != null) {
            $model_type = Lesson::class;
            $model_id = $lesson->id;
            $size = 0;
            $media = '';
            $url = '';
            $video_id = '';
            $name = $lesson->title . ' - video';
            $media = $lesson->mediavideo;
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
                    $filename = $lesson->title . ' - video';
                } else if ($request->media_type == 'zoom') {
                    $url = $request->video;
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
                        ->where('model_id', '=', $lesson->id)
                        ->first();

                    if ($media == null) {
                        $media = new Media();
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
            }
        }
        // delete video 
        if ($request->media_type == "" || $request->media_type == null) {
            $model_type = Lesson::class;

            $media = Media::where('model_type', $model_type)->where('model_id', $lesson->id)->delete();
        }
        if ($request->hasFile('add_pdf')) {
            $pdf = $lesson->mediaPDF;
            if ($pdf) {
                $pdf->delete();
            }
        }

        $request = $this->saveAllFiles($request, 'downloadable_files', Lesson::class, $lesson);

        $sequence = 1;
        if (count($lesson->course->courseTimeline) > 0) {
            $sequence = $lesson->course->courseTimeline->max('sequence');
            $sequence = $sequence + 1;
        }

        if ((int)$request->published == 1) {
            $timeline = CourseTimeline::where('model_type', '=', Lesson::class)
                ->where('model_id', '=', $lesson->id)
                ->where('course_id', $request->course_id)->first();
            if ($timeline == null) {
                $timeline = new CourseTimeline();
                $timeline->sequence = $sequence;
            }

            $timeline->course_id = $request->course_id;
            $timeline->model_id = $lesson->id;
            $timeline->model_type = Lesson::class;
            $timeline->sequence = $timeline->sequence ? $timeline->sequence : $sequence;
            $timeline->save();
        }

        if ($request->media_type == 'youtube') {
            // slice the video id from the url
            $video_id = $this->get_yt_video_id($request->video);

            // Get transcript from youtube service
            $video_info = $this->youtubeServices->get_transcript($video_id);
            try {
                $transcript = $lesson->transcript;
                if ($transcript) {
                    // Update the transcript if it exists
                    $transcript->update([
                        'description' => $video_info['video']['description'],
                        'transcript' => $video_info['video']['transcript'],
                        'channel_id' => $video_info['video']['channelId'],
                        'published_at' => $video_info['video']['publishedAt'],
                        'url' => $video_info['video']['url'],
                    ]);
                } else {
                    // Handle the case where the transcript does not exist
                    // For example, you might want to create a new transcript
                    $lesson->transcript()->create([
                        'description' => $video_info['video']['description'],
                        'transcript' => $video_info['video']['transcript'],
                        'channel_id' => $video_info['video']['channelId'],
                        'published_at' => $video_info['video']['publishedAt'],
                        'url' => $video_info['video']['url'],
                    ]);
                }
            } catch (\Exception $e) {
                // Log the exception message
                \Log::error('Error updating transcript: ' . $e->getMessage());
                // Optionally, you can rethrow the exception or handle it as needed
                throw $e;
            }

        }

        return redirect()->route('admin.lessons.index2', ['course_id' => $request->course_id])->withFlashSuccess(__('alerts.backend.general.updated'));
    }


    /**
     * Display Lesson.
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

        $tests = Test::where('lesson_id', $id)->get();

        $lesson = Lesson::findOrFail($id);


        return view('backend.lessons.show', compact('lesson', 'tests', 'courses'));
    }


    /**
     * Remove Lesson from storage.
     *
     * @param  int $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        
        if (!Gate::allows('lesson_delete')) {
            return abort(401);
        }
        $lesson = Lesson::findOrFail($id);
        //if course has a group don't delete the lesson
        if ($lesson->course->groups->count() > 0) {
            return back()->withFlashDanger(__('alerts.backend.lesson.group_remove_err'));
        }
        $type = get_class($lesson);

        $lesson->chapterStudents()->where('course_id', $lesson->course_id)->forceDelete();
       
            $lesson->courseLocations()
            ->wherePivot('model_id','=',$id)
            ->wherePivot('model_type','=','App\Models\Lesson')
            ->detach();
        
       
       
        $courseTimeLine = CourseTimeline::where('model_id', $id)->where('model_type', $type)->delete();
       
        Lesson::find($id)->delete();
        
        return back()->withFlashSuccess(__('alerts.backend.general.deleted'));
    }

    /**
     * Delete all selected Lesson at once.
     *
     * @param Request $request
     */
    public function massDestroy(Request $request)
    {
        if (!Gate::allows('lesson_delete')) {
            return abort(401);
        }
        if ($request->input('ids')) {
            $entries = Lesson::whereIn('id', $request->input('ids'))->get();

            foreach ($entries as $entry) {
                $entry->delete();
            }
        }
    }


    /**
     * Restore Lesson from storage.
     *
     * @param  int $id
     * @return \Illuminate\Http\Response
     */
    public function restore($id)
    {
        if (!Gate::allows('lesson_delete')) {
            return abort(401);
        }
        $lesson = Lesson::onlyTrashed()->findOrFail($id);
        $lesson->restore();

        return back()->withFlashSuccess(trans('alerts.backend.general.restored'));
    }



    /**
     * Permanently save Sequence from storage.
     *
     * @param  Request
     */
    public function saveSequence(Request $request)
    {
        foreach ($request->list as $item) {
            $slide = CourseTimeline::where('model_id', $item['id'])->first();
            $slide->sequence = $item['sequence'];
            $slide->save();

            $lesson = Lesson::where('id', $item['id'])->first();
            $lesson->position = $item['sequence'];
            $lesson->save();
        }
        return 'success';
    }

    /**
     * Permanently delete Lesson from storage.
     *
     * @param  int $id
     * @return \Illuminate\Http\Response
     */
    public function perma_del($id)
    {
        if (!Gate::allows('lesson_delete')) {
            return abort(401);
        }
        $lesson = Lesson::onlyTrashed()->findOrFail($id);

        if (File::exists(public_path('/storage/uploads/' . $lesson->lesson_image))) {
            File::delete(public_path('/storage/uploads/' . $lesson->lesson_image));
            File::delete(public_path('/storage/uploads/thumb/' . $lesson->lesson_image));
        }

        $timelineStep = CourseTimeline::where('model_id', '=', $id)
            ->where('course_id', '=', $lesson->course->id)->first();
        if ($timelineStep) {
            $timelineStep->delete();
        }

        $lesson->forceDelete();



        return back()->withFlashSuccess(trans('alerts.backend.general.deleted'));
    }

    /**
     * Slice url to get the video id
     * @param $url
     * @return void
     */
    private function get_yt_video_id($url) {
        // check if domain is youtube.com or youtu.be
        if (strpos($url, 'youtube.com')){
            $video_id = explode('v=', $url);
            $video_id = $video_id[1];
            $video_id = explode('&', $video_id);
            $video_id = $video_id[0];
            return $video_id;
        }
        if (strpos($url, 'youtu.be')){
            $video_id = explode('youtu.be/', $url);
            $video_id = $video_id[1];
            // return id without any unwanted parameters like si
            return explode('?', $video_id)[0];
        }

    }


    private function checkAndCreateTimeline($group, $model, $modelClass, $groupTimelines)
    {
        if (!Gate::allows('group_edit')) {
            return abort(401);
        }
        // Check if the model is in the GroupTimeline
        $inTimeline = $groupTimelines->contains(function ($timeline) use ($model, $modelClass, $group) {
            return $timeline->model_type == $modelClass && $timeline->model_id == $model->id && $timeline->group_id == $group->id;
        });
        // If the model is not in the GroupTimeline, create a new GroupTimeline entry for it
        if (!$inTimeline) {
            $maxSequence = GroupTimeline::where('group_id', $group->id)->max('sequence');
            $groupTimeline = new GroupTimeline();
            $groupTimeline->model_type = $modelClass;
            $groupTimeline->model_id = $model->id;
            $groupTimeline->group_id = $group->id;
            $groupTimeline->sequence = $maxSequence + 1;
            $groupTimeline->save();
        }
    }

}
