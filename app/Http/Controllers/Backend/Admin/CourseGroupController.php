<?php

namespace App\Http\Controllers\Backend\Admin;

use App\Http\Requests\Admin\UpdateCoursesRequest;
use App\Mail\groupEmail;
use App\Models\Auth\User;
use App\Models\Category;
use App\Models\Certificate;
use App\Models\CertificateTemplates;
use App\Models\Content;
use App\Models\Coordinator;
use App\Models\Course;
use App\Models\Course_clints;
use App\Models\course_place;
use App\Models\CourseClassification;
use App\Models\CourseGroup;
use App\Models\CourseGroupImpact;
use App\Models\CourseGroupRates;
use App\Models\CourseGroupRecommendation;
use App\Models\CourseGroupTest;
use App\Models\CourseLocation;
use App\Models\GroupChat;
use App\Models\GroupResourceLink;
use App\Models\GroupTimeline;
use App\Models\Lesson;
use App\Models\Level;
use App\Models\Location;
use App\Models\Media;
use App\Models\Order;
use App\Models\SubContent;
use App\Models\Type;
use App\Notifications\Backend\AddedStudent;
use DataTables;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Carbon\Carbon;
use Illuminate\Support\Facades\Gate;
use App\Http\Controllers\Traits\FileUploadTrait;

class CourseGroupController extends Controller
{
    use FileUploadTrait;

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        if (!Gate::allows('group_access')) {
            return abort(401);
        }
        // Check if the user wants to view the deleted courses
        if (request('show_deleted') == 1) {
            if (!Gate::allows('course_delete')) {
                return abort(401);
            }
            $courses = CourseGroup::with('clients', 'courses', 'teachers')->onlyTrashed()->orderBy('created_at', 'desc')->get();
        } else {
           if (request('teacher_id')) {
                $courses = CourseGroup::with('clients', 'courses', 'teachers')->whereHas('teachers', function ($q) {
                     $q->where('teacher_id', request('teacher_id'));
                })->orderBy('created_at', 'desc')->get();
           }else{
               $courses = CourseGroup::with('clients', 'courses', 'teachers')->ofTeacher()->orderBy('created_at', 'desc')->get();
           }
        }

        $types = session('locale') == 'en' ? Type::where('status', 1)->pluck('name', 'id')->prepend(__('labels.backend.courses.fields.choose-cat'), '') : Type::where('status', 1)->pluck('name_ar', 'id')->prepend(__('labels.backend.courses.fields.choose-cat'), '');
        $teachers = \App\Models\Auth\User::whereHas('roles', function ($q) {
            $q->where('role_id', 2);
        })->get();

        if (session('locale') == 'ar') {
            $coordinators = Coordinator::all()->pluck('name_ar', 'id');
            $clients = Course_clints::all()->pluck('name_ar', 'id');
            $locations = Location::all()->pluck('name_ar', 'id');
        } else {
            $coordinators = Coordinator::all()->pluck('name', 'id');
            $clients = Course_clints::all()->pluck('name', 'id');
            $locations = Location::all()->pluck('name', 'id');
        }

        return view('backend.courses.groups.index', compact('courses', 'types', 'teachers', 'coordinators', 'clients', 'locations'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        if (!Gate::allows('group_create')) {
            return abort(401);
        }
        $courses = Course::all();

        if (app()->getLocale() == "ar") {
            $categories = Category::where('status', '=', 1)->pluck('name_ar', 'id');
            $types = Type::where('status', 1)->get()->pluck('name', 'id');
            $locations = Location::all()->pluck('name_ar', 'id');
            $coordinators = Coordinator::all()->pluck('name_ar', 'id');
            $clients = Course_clints::all()->pluck('name_ar', 'id');
            $tests = CourseGroupTest::all()->pluck('title_ar', 'id');

            $rates = CourseGroupRates::where('user_type', 'student')->where('published', 1)->get()->pluck('title_ar', 'id');
            $rateTeacher = CourseGroupRates::where('user_type', 'teacher_rate_student')->where('published', 1)->get()->pluck('title_ar', 'id');
            $impacts = CourseGroupImpact::all()->pluck('impact_ar', 'id');
            $reccomendations = CourseGroupRecommendation::all()->pluck('recommendation_ar', 'id');
            $cert_templates = CertificateTemplates::all()->pluck('title_ar', 'id');
            $students = \App\Models\Auth\User::whereHas('roles', function ($q) {
                $q->where('role_id', 3);
            })->get()->pluck('full_name_ar', 'id');
            $teachers = \App\Models\Auth\User::whereHas('roles', function ($q) {
                $q->where('role_id', 2);
            })->get()->pluck('full_name_ar', 'id');
            $places = course_place::all()->pluck('name_ar', 'id');
            $locations = Location::all()->pluck('name_ar', 'id');
        } else {
            $categories = Category::where('status', '=', 1)->pluck('name', 'id');
            $types = Type::where('status', 1)->get()->pluck('name', 'id');
            $locations = Location::all()->pluck('name', 'id');
            $coordinators = Coordinator::all()->pluck('name', 'id');
            $clients = Course_clints::all()->pluck('name', 'id');
            $tests = CourseGroupTest::all()->pluck('title', 'id');
            $rates = CourseGroupRates::where('user_type', 'student')->where('published', 1)->get()->pluck('title', 'id');
            $rateTeacher = CourseGroupRates::where('user_type', 'teacher_rate_student')->where('published', 1)->get()
                ->pluck('title', 'id');
            $impacts = CourseGroupImpact::all()->pluck('impact', 'id');
            $reccomendations = CourseGroupRecommendation::all()->pluck('recommendation', 'id');
            $students = \App\Models\Auth\User::whereHas('roles', function ($q) {
                $q->where('role_id', 3);
            })->get()->pluck('full_name', 'id');
            $teachers = \App\Models\Auth\User::whereHas('roles', function ($q) {
                $q->where('role_id', 2);
            })->get()->pluck('full_name', 'id');
            $places = course_place::all()->pluck('name', 'id');
            $locations = Location::all()->pluck('name', 'id');
            $cert_templates = CertificateTemplates::all()->pluck('title', 'id');
        }


        return view('backend.courses.groups.create', compact('courses', 'categories', 'types', 'tests', 'places', 'locations', 'coordinators', 'teachers', 'students', 'clients', 'rates', 'impacts', 'reccomendations', 'rateTeacher', 'cert_templates'));
    }

    /**
     * Get the data for the specified course.
     *
     * @param \App\Models\Course $course
     * @return array
     */
    public function getData(Course $course)
    {
        if (!Gate::allows('group_access')) {
            return abort(401);
        }
        return [
            'description' => $course->description, // Assuming 'description_en' is the attribute for English description
            'description_ar' => $course->description_ar, // Assuming 'description_ar' is the attribute for Arabic description
            'course_type' => $course->type->name, // Assuming 'description_ar' is the attribute for Arabic description
//            'location' => $course->locations->pluck('name')->unique(),
            'locations' => Location::where('courses_type', $course->type->id)->get()->pluck('name', 'id'),
            'resources' => $course->resources->pluck('link'),
        ];
    }

    public function getGroupsData(Request $request){
        
        if (!Gate::allows('group_access')) {
            return abort(401);
        }
        $length = $request->input('length');
        $start = $request->input('start');
        $page = $start ? ($start / $length) + 1 : 1;
        $searchTerm = $request->input('search.value');
        //if show deleted groups
        if (request('show_deleted') == 1) {
            $query = CourseGroup::with('clients', 'courses', 'teachers')->onlyTrashed()->orderBy('created_at', 'desc');
        } else {
            if ($request->input('teacher_id')) {
                $query = CourseGroup::with('clients', 'courses', 'teachers')->whereHas('teachers', function ($q) use ($request) {
                    $q->where('teacher_id', $request->input('teacher_id'));
                })->orderBy('created_at', 'desc');
            }else{
                $query = CourseGroup::query()->orderBy('created_at', 'desc');
            }
        }

        if ($searchTerm) {
            $query->where('title_ar', 'like', '%' . $searchTerm . '%')
                ->orWhere('title', 'like', '%' . $searchTerm . '%');
        }

        $groups = $query->paginate($length, ['*'], 'page', $page);

        $data = [];
        foreach ($groups as $group) {

            if($group instanceof CourseGroup && $group->courses instanceof Course){
                $clientNames = '';
                foreach ($group->clients as $client) {
                    $clientNames .= '<p style="margin-top: -10px;">' . (app()->getLocale() == 'ar' ? $client->name_ar : $client->name) . '</p>';
                }
                $teacherNames = '';
                foreach ($group->teachers as $teacher) {
                    $teacherNames .= '<p style="margin-top: -10px;">' . (app()->getLocale() == 'ar' ? $teacher->full_name_ar : $teacher->full_name) . '</p>';
                }
                if ($request->show_deleted ==1 ){
                    $actions = view('backend.datatable.action-trashed')->with(['route_label' => 'admin.groups', 'label' =>
                        'id', 'value' => $group->id])->render();
                }else {
                     $actions = view('backend.courses.groups.datatables_actions', compact('group'))->render();
                }
                $data[] = [
                    'DT_RowIndex' => $group->id,
                    'id' => $group->id,
                    'title' => (app()->getLocale() == 'ar') ? $group->title_ar : $group->title,
                    'course' => (app()->getLocale() == 'ar') ? $group->courses->title_ar : $group->courses->title,
                    'start' => $group->start->format('Y-m-d'),
                    'end' => $group->end->format('Y-m-d'),
                    'students' => $group->students->count(),
                    'clients' => $clientNames,
                    'teachers' =>$teacherNames,
                    'actions' => $actions,

                ];
            }
        }
        $response = [
            'draw' => $request->input('draw'),
            'recordsTotal' => $groups->total(),
            'recordsFiltered' => $groups->total(),
            'data' => $data
        ];
        return $response;
    }

    public function getHall(Location $location)
    {
        if (!Gate::allows('group_access')) {
            return abort(401);
        }
         $places = $location->places;
         return [
               'halls' => $places->pluck('name', 'id'),
         ];
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param \Illuminate\Http\Request $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        // Validate the request data
        if (!Gate::allows('group_create')) {
            return abort(401);
        }

        $rules = [
            'course_id' => 'required|exists:courses,id',
            'title_ar' => 'required',
            'title_en' => 'required',
            'price' => 'required',
            'description_ar' => 'required',
            'description' => 'required',
            'cert_templates' => 'required',
            'from_datetime' => 'required',
            'to_datetime' => 'required',
        ];

        // Get course
        $course = Course::find($request->course_id);

        if ($course->type_id != 1) {
            $rules['location2'] = 'required';
            if ( $course->type_id == 3) {
                $rules['location'] = 'required';
            }
        }

        $validatedData = $request->validate($rules);
        // Create a new CourseGroup instance
        $courseGroup = new CourseGroup();

        // Fill the CourseGroup instance with the validated data
        $courseGroup->course_id = $validatedData['course_id'];
        if (ctype_digit($request->location2)) {
            $courseGroup->location_id = $validatedData['location2'];
            if (ctype_digit($request->location)) {
                $courseGroup->place_id = $validatedData['location'];
            }
        }
        $courseGroup->title_en = $request->title_en;
        $courseGroup->title_ar = $request->title_ar;
        $courseGroup->description_ar = $request->description_ar;
        $courseGroup->description_en = $request->description;
        $courseGroup->price = $request->price;
        $courseGroup->certificate_template_id = $request->cert_templates;
//        $courseGroup->number_hours = $request->number_hours;
//        $courseGroup->price = $request->price;
        $courseGroup->start = Carbon::parse($request->from_datetime);
        $courseGroup->end = Carbon::parse($request->to_datetime);
//        $courseGroup->image = null;
        $courseGroup->save();

        //attach resource links to the lesson
        if ($request->has('resourceLinks')){
            $links = explode(',', $request->input('resourceLinks'));

            foreach ($links as $link) {
                // Check if link isnt empty
                if($link == '') continue;

                // Get the title and url from the link
                list($title, $url) = explode('|', $link);

                // Save the link
                $groupResourceLink = new GroupResourceLink();
                $groupResourceLink->group_id = $courseGroup->id;
                $groupResourceLink->title = $title;
                $groupResourceLink->link = $url;
                $groupResourceLink->save();
            }
        }

        if ($request->hasFile('image')) {

            // Store the uploaded image in the 'public' disk
            $path = $this->saveFiles($request);
            // Save the image path to the CourseGroup instance
            $courseGroup->image = $path->image;
            $courseGroup->save();
        }

        //attach tests to the group
        if ($request->has('tests')) {
            foreach ($request->tests as $key => $test) {
               $courseGroup->tests()->attach($test);
            }
        }

        //attach rates to the group
        if ($request->has('rates') || $request->has('rateTeacher')) {
            // Combine rates and rateTeacher into a single array
            $rates = array_merge($request->rates, $request->rateTeacher);

            foreach ($rates as $rate) {
                $courseGroup->rates()->attach($rate);
            }
        }

        //attach impacts to the group
        if ($request->has('impacts')) {
            foreach ($request->impacts as $key => $impact) {
                $courseGroup->impacts()->attach($impact);
            }
        }
        //attach group it to reccomendations
        if ($request->has('reccomendations')) {
            foreach ($request->reccomendations as $key => $reccomendation) {
                $courseGroup->reccomendations()->attach($reccomendation);
            }
        }

        // Attach coordinators to the CourseGroup
        $coordinatorIds = [];
        if($request->coordinator > 0) {
            foreach ($request->coordinator as $coordinatorArray) {
                // Merge coordinator IDs into a single array
                $coordinatorIds = array_merge($coordinatorIds, $coordinatorArray);
            }
            $coordinatorIds = array_unique($coordinatorIds);
            $courseGroup->coordinators()->attach($coordinatorIds);
        }
        // Attach Teachers to the CourseGroup
        $teacherIds = [];
        if($request->teachers > 0) {
            foreach ($request->teachers as $teacherArray) {
                // Merge coordinator IDs into a single array
                $teacherIds = array_merge($teacherIds, $teacherArray);
            }
            $teacherIds = array_unique($teacherIds);
            $courseGroup->teachers()->attach($teacherIds);

        }




        // Attach Students to the CourseGroup
        $studentIds = [];
        if ($request->students > 0) {
            foreach ($request->students as $studentArray) {
                $studentIds = array_merge($studentIds, $studentArray);
            }
             $studentIds = array_unique($studentIds);
            $courseGroup->students()->attach($studentIds);
        }


        foreach ($courseGroup->courses->lessons as $lesson) {
            $courseGroup->courseLessons()->attach($lesson->id, ['start_time' => $lesson->from_time, 'end_time' =>
                $lesson->to_time, 'date' => $lesson->date]);
        }


        // Get the GroupTimeline entries for the group
        $groupTimelines = GroupTimeline::where('group_id', $courseGroup->id)->get();

        // Check each lesson and create a timeline
        foreach ($courseGroup->courses->lessons as $lesson) {
            $this->checkAndCreateTimeline($courseGroup, $lesson, Lesson::class, $groupTimelines);
        }



        // Attach Clients to the CourseGroup
        $clientIds = [];
        if($request->clients > 0) {
            foreach ($request->clients as $clientArray) {
                $clientIds = array_merge($clientIds, $clientArray);
            }
            $clientIds = array_unique($clientIds);
            $courseGroup->clients()->attach($clientIds);
        }

        // Create Group Chat
        $groupChat = new GroupChat();
        $groupChat->course_group_id = $courseGroup->id;
        $groupChat->save();

        // Redirect the user to a page, for example, the index page of CourseGroups
        return redirect()->route('admin.groups.index')->with('success', 'Course group created successfully');
    }

    /**
     * Filter data
     *
     * @param \Illuminate\Http\Request $request
     * @return \Illuminate\Http\Response
     */
    public function filterData(Request $request)
    {
        if (!Gate::allows('group_access')) {
            return abort(401);
        }
        $types = Type::where('status', 1)->get()->pluck('name', 'id');
        $group_name = $request->group_name;
        $course_name = $request->course_name;
        $type = $request->type;
        $start_date = $request->start_date;
        $end_date = $request->end_date;
        $location = $request->location;
        $client = $request->client;
        $teacher = $request->teacher;
        $dateRange = $request->dateRange;
        $courses = new CourseGroup();

        if ($group_name)
            $group = CourseGroup::where('title_ar', 'like', '%' . $group_name . '%')
                ->orWhere('title', 'like', '%' . $group_name . '%');


        if ($course_name)
            $courses = $courses->whereHas('courses', function ($q) use ($course_name) {
                $q->where('title_ar', 'like', '%' . $course_name . '%')
                    ->orWhere('title', 'like', '%' . $course_name . '%');
            });

        if ($start_date)
            //show all courses that start at this date no matter the time of the day
            $courses = $courses->whereDate('start', $start_date);

        if ($end_date)
            $courses = $courses->whereDate('end', $end_date);

        if ($dateRange) {
            $dateRange = explode(' to ', $dateRange);
            $courses = $courses->whereBetween('start', [Carbon::parse($dateRange[0]), Carbon::parse($dateRange[1])]);
        }

        if ($location)
            $courses = $courses->where('location_id', $location);

        if($client)
            $courses = $courses->whereHas('clients', function ($q) use ($client) {
                $q->where($q->getModel()->getQualifiedKeyName(), $client);
            });

        if ($teacher)
            $courses = $courses->whereHas('teachers', function ($q) use ($teacher) {
                $q->where($q->getModel()->getQualifiedKeyName(), $teacher);
            });

        if ($type)
            $courses = $courses->whereHas('courses', function ($q) use ($type) {
                $q->where('type_id', $type);
            });


        $courses = $courses->orderBy('created_at', 'DESC')->get();
        $teachers = \App\Models\Auth\User::whereHas('roles', function ($q) {
            $q->where('role_id', 2);
        })->get();
        $coordinators = Coordinator::all()->pluck('name_ar', 'id');
        $clients = Course_clints::all()->pluck('name_ar', 'id');
        $locations = Location::all()->pluck('name_ar', 'id');
        return view('backend.courses.groups.index', compact('courses', 'types', 'teachers', 'coordinators', 'clients', 'locations'));
    }

    /**
     * Display Group.
     *
     * @param int $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        if (!Gate::allows('group_view')) {
            return abort(401);
        }
        $group = CourseGroup::where('id', $id)->first();
        $teachers = $group->teachers;
        $coordinators = $group->coordinators;
        $clients = $group->clients;
        $course = $group->courses;
        $students = $group->students;

//        $courseTimeline = $course->courseTimeline()->get();

        return view('backend.courses.groups.show', compact('course', 'group', 'teachers', 'coordinators', 'clients', 'students'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param int $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        if (!Gate::allows('group_edit')) {
            return abort(401);
        }

        $group = CourseGroup::where('id', $id)->first();
        $teachers = \App\Models\Auth\User::whereHas('roles', function ($q) {
            $q->where('role_id', 2);
        })->get();
        $students = \App\Models\Auth\User::whereHas('roles', function ($q) {
            $q->where('role_id', 3);
        })->get();
        $coordinators = Coordinator::all()->pluck('name_ar', 'id');
        $course = $group->courses;
        $courses = Course::all()->pluck('title_ar', 'id');
        $clients = Course_clints::all()->pluck('name_ar', 'id');
        $types = session('locale') == 'en' ? Type::where('status', 1)->pluck('name', 'id')->prepend(__('labels.backend.courses.fields.choose-cat'), '') : Type::where('status', 1)->pluck('name_ar', 'id')->prepend(__('labels.backend.courses.fields.choose-cat'), '');
        $locations = Location::where('courses_type', $course->type->id)->get()->pluck('name', 'id');
        $hall = course_place::where('id', $group->place_id)->get();
        $tests = CourseGroupTest::all();
        $rates = CourseGroupRates::where('user_type', 'student')->where('published', 1)->get();
        $rateTeacher = CourseGroupRates::where('user_type', 'teacher_rate_student')->where('published', 1)->get();
        $impacts = CourseGroupImpact::all();
        $reccomendations = CourseGroupRecommendation::all();
        $cert_templates = CertificateTemplates::all()->pluck('title_ar', 'id');

        return view('backend.courses.groups.edit2', compact('group', 'courses', 'hall','locations', 'course', 'teachers', 'students', 'coordinators', 'clients', 'types', 'tests', 'rates', 'impacts', 'reccomendations', 'rateTeacher', 'cert_templates'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param \Illuminate\Http\Request $request
     * @param int $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        if (!Gate::allows('group_edit')) {
            return abort(401);
        }

        // Validate the request data
        $rules = [
            'course_id' => 'required|exists:courses,id',
            'title_ar' => 'required',
            'title_en' => 'required',
            'price' => 'required',
            'description_ar' => 'required',
            'description_en' => 'required',
            'cert_templates' => 'required',
            'from_datetime' => 'required',
            'to_datetime' => 'required',
        ];

        // Get course
        $course = Course::find($request->course_id);

        if ($course->type_id != 1) {
            $rules['location2'] = 'required';
            if ( $course->type_id == 3) {
                $rules['location'] = 'required';
            }
        }

        $validatedData = $request->validate($rules);

        // Create a new CourseGroup instance
        $courseGroup = CourseGroup::where('id', $id)->first();
        // Fill the CourseGroup instance with the validated data
        $courseGroup->course_id = $validatedData['course_id'];
        if (ctype_digit($request->location2)) {
            $courseGroup->location_id = $validatedData['location2'];
            if (ctype_digit($request->location)) {
                $courseGroup->place_id = $validatedData['location'];
            }
        }else{
            //if course type changes to online or another, remove location and place
            $courseGroup->location_id = null;
            $courseGroup->place_id = null;
        }
        $courseGroup->title_en = $request->title_en;
        $courseGroup->title_ar = $request->title_ar;
        $courseGroup->price = $request->price;
        $courseGroup->description_ar = $request->description_ar;
        $courseGroup->description_en = $request->description_en;
        $courseGroup->certificate_template_id = $request->cert_templates;
        $courseGroup->start = Carbon::parse($request->from_datetime);
        $courseGroup->end = Carbon::parse($request->to_datetime);

        $courseGroup->save();

        //attach resource links to the lesson
        if ($request->has('resourceLinks')){
            $links = explode(',', $request->input('resourceLinks'));
            $courseGroup->resources()->delete();

            foreach ($links as $link) {
                // Check if link isnt empty
                if($link == '') continue;

                // Get the title and url from the link
                list($title, $url) = explode('|', $link);

                // Save the link
                $groupResourceLink = new GroupResourceLink();
                $groupResourceLink->group_id = $courseGroup->id;
                $groupResourceLink->title = $title;
                $groupResourceLink->link = $url;
                $groupResourceLink->save();
            }
        }

        //attach tests to the group
        if ($request->has('tests')) {
            $courseGroup->tests()->detach();
            foreach ($request->tests as $key => $test) {
                $courseGroup->tests()->attach($test);
            }
        }

        //attach rates to the group
        if ($request->has('rates') || $request->has('rateTeacher')) {
            // Detach all existing rates
            $courseGroup->rates()->detach();

            // Combine rates and rateTeacher into a single array
            $rates = array_merge($request->rates, $request->rateTeacher);

            foreach ($rates as $rate) {
                $courseGroup->rates()->attach($rate);
            }
        }

        //attach impacts to the group
        if ($request->has('impacts')) {
            $courseGroup->impacts()->detach();
            foreach ($request->impacts as $key => $impact) {
                $courseGroup->impacts()->attach($impact);
            }
        }

        //attach reccomendations to the group
        if ($request->has('reccomendations')) {
            $courseGroup->reccomendations()->detach();
            foreach ($request->reccomendations as $key => $reccomendation) {
                $courseGroup->reccomendations()->attach($reccomendation);
            }
        }

        if ($request->hasFile('image')) {
            $image = $request->file('image');

            // Store the uploaded image in the 'public' disk
            $path = $this->saveFiles($request);

            // Save the image path to the CourseGroup instance
            $courseGroup->image = $path->image;
            $courseGroup->save();
        }
        // Attach Coordinators to the CourseGroup
        if($request->coordinators != null) {
            $courseGroup->coordinators()->detach();
            $coordinatorIds = [];
            foreach ($request->coordinators[0] as $coordinatorArray) {
                $coordinator = Coordinator::where('name_ar', $coordinatorArray)->first();
                if ($coordinator) {
                    $coordinatorIds[] = $coordinator->id;
                }
            }
            $coordinatorIds = array_unique($coordinatorIds);

            $courseGroup->coordinators()->attach($coordinatorIds);
        }

        // Attach Teachers to the CourseGroup
        if($request->teachers != null) {
            $courseGroup->teachers()->detach();
            $teacherIds = [];
            foreach ($request->teachers[0] as $teacherArray) {
                $teacher = User::where('id', $teacherArray)->first();
                if ($teacher) {
                    $teacherIds[] = $teacher->id;
                }
            }
            $teacherIds = array_unique($teacherIds);
            $courseGroup->teachers()->attach($teacherIds);
        }

        if($request->students != null) {
            $courseGroup->students()->detach();
            $studentIds = [];
            foreach ($request->students[0] as $studentArray) {
                $student = User::where('id', $studentArray)->first();
                if ($student) {
                    $studentIds[] = $student->id;
                }
            }
            $studentIds = array_unique($studentIds);
            $courseGroup->students()->attach($studentIds);
        }


        // Attach Clients to the CourseGroup
        if($request->clients != null) {
            $courseGroup->clients()->detach();
            $clientIds = [];
            foreach ($request->clients[0] as $clientArray) {
                $client = Course_clints::where('name_ar', $clientArray)->first();
                if ($client) {
                    $clientIds[] = $client->id;
                }
            }
            $clientIds = array_unique($clientIds);
            $courseGroup->clients()->attach($clientIds);
        }

        // Redirect the user to a page, for example, the index page of CourseGroups
        return redirect()->route('admin.groups.index')->with('success', 'Course group created successfully');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param int $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        if (!Gate::allows('group_delete')) {
            return abort(401);
        }
        $group = CourseGroup::where('id', $id)->first();
        if ($group->students->count() >= 1) {
            return redirect()->route('admin.groups.index')->withFlashDanger(trans('alerts.backend.general.delete_warning'));
        } else {
            $group->delete();
        }
        return redirect()->route('admin.groups.index')->withFlashSuccess(trans('alerts.backend.general.deleted'));
    }

    /**
     * Restore the specified resource from storage.
     *
     * @param int $id
     * @return \Illuminate\Http\Response
     */
    public function restore($id)
    {
        if (!Gate::allows('group_delete')) {
            return abort(401);
        }
        $group = CourseGroup::where('id', $id)->onlyTrashed()->first();
        $group->restore();

        return redirect()->route('admin.groups.index')->withFlashSuccess(trans('alerts.backend.general.restored'));
    }

    /**
     * Force delete the specified resource from storage.
     *
     * @param int $id
     * @return \Illuminate\Http\Response
     */
    public function forceDelete($id)
    {
        if (!Gate::allows('group_delete')) {
            return abort(401);
        }
        $group = CourseGroup::where('id', $id)->onlyTrashed()->first();
        $group->forceDelete();

        return redirect()->route('admin.groups.index')->withFlashSuccess(trans('alerts.backend.general.deleted'));
    }

    public function students(CourseGroup $group)
    {
        if (!Gate::allows('group_view')) {
            return abort(401);
        }
        $students = $group->students;
        $course = $group->courses;
        $location = Location::where('id', $group->location_id)->first();
        $certificates = Certificate::where('course_id', $course->id)->get();
        return view('backend.courses.groups.students.index', compact('students', 'group', 'location', 'course', 'certificates'));
    }

    public function addStudentsView(CourseGroup $group)
    {
        if (!Gate::allows('group_view')) {
            return abort(401);
        }
        if (app()->getLocale() == 'ar') {
            $students = User::whereHas('roles', function ($q) {
                $q->where('role_id', 3);
            })->get()->pluck('full_name_ar', 'id');
            $groups = CourseGroup::all()->pluck('title_ar', 'id');
        } else {
            $students = User::whereHas('roles', function ($q) {
                $q->where('role_id', 3);
            })->get()->pluck('full_name', 'id');
            $groups = CourseGroup::all()->pluck('title', 'id');
        }

        return view('backend.courses.groups.students.add', compact('students', 'group', 'groups'));
    }

    public function addStudents( Request $request)
    {
        if (!Gate::allows('group_view')) {
            return abort(401);
        }
        if($request->groups){
            $group = CourseGroup::where('id', $request->groups)->first();
            $studentIds = [];
            foreach ($request->students as $studentArray) {
                $student = User::where('id', $studentArray)->first();
                if ($student) {
                    //check if the student is already in the group or not
                    if ($group->students->contains($student->id)) {
                        //if the student is already in the group, skip adding him
                        continue;
                    }else{
                        $studentIds[] = $student->id;

                        // Create an order for the student
                        $order = new Order();
                        $order->user_id = $student->id;
                        $order->reference_no = str_random(8);
                        $order->amount = 0;
                        $order->status = 1;
                        $order->coupon_id = 0;
                        $order->payment_type = 2;
                        $order->save();

                        // Create an item for the order
                        $order->items()->create([
                            'item_id' => $group->courses->id,
                            'item_type' => Course::class,
                            'price' => 0,
                            'item_group_id'=> $group->id,
                        ]);
                    }

                }
            }

            $studentIds = array_unique($studentIds);
            $group->students()->attach($studentIds);

            //send email foreach student
            if ($request->send_email == 'on') {
                foreach ($studentIds as $studentId) {
                    $student = User::where('id', $studentId)->first();
                    $content = [
                        'group_id' => $group->id,
                        'group_name' => $group->title_ar,
                        'course_name' => $group->courses->title_ar,
                        'course_slug' => $group->courses->slug,
                    ];
                    \Mail::to($student->email)->send(new groupEmail($content));
                    // Notify Student
                    $student->notify(new AddedStudent($group));
                }
            }

            return redirect()->route('admin.group.students.all')->with('success', 'Students added successfully');
        }else{

            $group = CourseGroup::where('id', $request->group_id)->first();
            $studentIds = [];
            foreach ($request->students as $studentArray) {
                $student = User::where('id', $studentArray)->first();
                if ($student) {
                    //check if the student is already in the group or not
                    if ($group->students->contains($student->id)) {
                        //if the student is already in the group, skip adding him
                        continue;
                    }else{
                        $studentIds[] = $student->id;

                        // Create an order for the student
                        $order = new Order();
                        $order->user_id = $student->id;
                        $order->reference_no = str_random(8);
                        $order->amount = 0;
                        $order->status = 1;
                        $order->coupon_id = 0;
                        $order->payment_type = 2;
                        $order->save();

                        // Create an item for the order
                        $order->items()->create([
                            'item_id' => $group->courses->id,
                            'item_type' => Course::class,
                            'price' => 0,
                            'item_group_id'=> $group->id,
                        ]);
                    }

                }
            }
            $studentIds = array_unique($studentIds);
            $group->students()->attach($studentIds);
            if ($request->send_email == 'on') {
                foreach ($studentIds as $studentId) {
                    $student = User::where('id', $studentId)->first();
                    $content = [
                        'group_id' => $group->id,
                        'group_name' => $group->title_ar,
                        'course_name' => $group->courses->title_ar,
                        'course_slug' => $group->courses->slug,
                    ];
                    \Mail::to($student->email)->send(new groupEmail($content));
                    // Notify Student
                    $student->notify(new AddedStudent($group));
                }
            }



            return redirect()->route('admin.group.students', $group->id)->with('success', 'Students added successfully');
        }
    }

    public function allstudents()
    {
        if (!Gate::allows('group_view')) {
            return abort(401);
        }

        $students = User::whereHas('roles', function ($q) {
            $q->where('role_id', 3);
        })->get();

        $certificates = Certificate::all();
        return view('backend.courses.groups.students.all', compact('students', 'certificates'));
    }

    public function getStudentsData(Request $request)
    {
        if (!Gate::allows('group_view')) {
            return abort(401);
        }
        $length = $request->input('length');
        $start = $request->input('start');
        $page = $start ? ($start / $length) + 1 : 1;
        $searchTerm = $request->input('search.value');
        $query = User::whereHas('roles', function ($q) {
            $q->where('role_id', 3);
        })
            ->select('first_name', 'last_name', 'third_name', 'fourth_name', 'name_ar', 'sec_name_ar',
                'third_name_ar', 'fourth_name_ar', 'email', 'id')
            ->withCount('groups');

        if ($searchTerm) {
            $query->where('first_name', 'like', '%' . $searchTerm . '%')
                ->orWhere('last_name', 'like', '%' . $searchTerm . '%')
                ->orWhere('third_name', 'like', '%' . $searchTerm . '%')
                ->orWhere('fourth_name', 'like', '%' . $searchTerm . '%')
                ->orWhere('email', 'like', '%' . $searchTerm . '%')
                ->orWhere('name_ar', 'like', '%' . $searchTerm . '%')
                ->orWhere('sec_name_ar', 'like', '%' . $searchTerm . '%')
                ->orWhere('third_name_ar', 'like', '%' . $searchTerm . '%')
                ->orWhere('fourth_name_ar', 'like', '%' . $searchTerm . '%')
                ->orWhere('id', 'like', '%' . $searchTerm . '%');
        }

        $students = $query->paginate($length, ['*'], 'page', $page);

        $data = [];
        foreach ($students as $student) {
            $data[] = [
                'DT_RowIndex' => $student->id,
                'id' => $student->id,
                'name' => (app()->getLocale() == 'ar') ? $student->full_name_ar : $student->full_name,
                'email' => $student->email,
                'groups_count' => $student->groups_count,
                'actions' => '
                <div class="btn-group btn-group-sm" role="group">
                    <a id="userActions" type="button" class="btn btn-xs bg-warning mb-1 p-2 dropdown-toggle" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                        <i class="fa fa-plus-square" aria-hidden="true"></i>
                    </a>
                    <div class="dropdown-menu drop" id="moreCourse" style=" max-height:200px; overflow:scroll; " aria-labelledby="userActions">
                        <a tabindex="1" target="_blank" href="/user/auth/user/'.$student->id.'" class="dropdown-item">'.__('labels.frontend.user.profile.view').'</a>
                        <a tabindex="1" href="'.route('admin.groups.rates.getUserRates', ['user_id' => $student->id]).'" class="dropdown-item"> '.__('menus.backend.sidebar.rates.title') .'</a>
                        <a tabindex="1" href="'.route('admin.courses.groups.tests2.result', [''=>'', 'user_id' =>
                        $student->id,]).'" class="dropdown-item"> '.__('menus.backend.sidebar.tests.title').'</a>
                        <a tabindex="1" href="'.route('admin.groups.student.cert.get', ['student' =>
                        $student->id,]).'" class="dropdown-item"> '.__('labels.backend.certificates.title').'</a>
                        <a tabindex="1" href="'.route('admin.students.attendance', ['student_id'=>$student->id]).'" class="dropdown-item"> '.__('labels.backend.attendance.title').'</a>
                    </div>
                </div>'
            ];
        }

        $response = [
            'draw' => $request->input('draw'),
            'recordsTotal' => $students->total(),
            'recordsFiltered' => $students->total(),
            'data' => $data
        ];
        return response()->json($response);
    }

    public function destroyStudent(Request $request)
    {
        if (!Gate::allows('group_delete')) {
            return abort(401);
        }
        $group = CourseGroup::where('id', $request->group_id)->first();
        $group->students()->detach($request->student_id);
        return redirect()->route('admin.group.students', $group->id)->with('success', 'Student removed successfully');
    }

    public function detachStudent(CourseGroup $group, Request $request)
    {
        if (!Gate::allows('group_delete')) {
            return abort(401);
        }
//        $group = CourseGroup::where('id', $request->group_id)->first();
        $studentId = $request->input('student_id');


        $group->students()->detach($studentId);
        return back()->with('success', 'Student removed successfully');
    }

    public function rearrange(CourseGroup $group)
    {
        if (!Gate::allows('group_edit')) {
            return abort(401);
        }
        // Get the lessons and tests in the group
        $lessons = $group->courses->lessons;
        $tests = $group->tests;

        // Get the GroupTimeline entries for the group
        $groupTimelines = GroupTimeline::where('group_id', $group->id)->get();
        // Check each lesson and test in the group
        foreach ($lessons as $lesson) {
            $this->checkAndCreateTimeline($group, $lesson, Lesson::class, $groupTimelines);
        }
        foreach ($tests as $test) {
            $this->checkAndCreateTimeline($group, $test, CourseGroupTest::class, $groupTimelines);
        }

        //get the updated GroupTimeline entries for the group
        $groupTimelines = GroupTimeline::where('group_id', $group->id)->orderBy('sequence')->get();

        return view('backend.courses.groups.rearrange', compact('group', 'groupTimelines'));
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

    public function saveRearrange(CourseGroup $group, Request $request)
    {
        if (!Gate::allows('group_edit')) {
            return abort(401);
        }
        $groupTimelines = GroupTimeline::where('group_id', $group->id)->orderBy('sequence')->get();

        foreach ($request->list as $key => $item) {
            // Split the id by '-' to get the model type and id
            list($modelType, $modelId) = explode('-', $item['id']);

            // Convert the model type to the correct class name
            $modelClass = $modelType === 'lesson' ? Lesson::class : CourseGroupTest::class;

            $inTimeline = $groupTimelines->contains(function ($timeline) use ($modelId, $modelClass, $group) {
                return $timeline->model_type == $modelClass && $timeline->model_id == $modelId && $timeline->group_id == $group->id;
            });
            // If the model is not in the GroupTimeline, create a new GroupTimeline entry for it
            if (!$inTimeline) {
                $maxSequence = GroupTimeline::where('group_id', $group->id)->max('sequence');
                $groupTimeline = new GroupTimeline();
                $groupTimeline->model_type = $modelClass;
                $groupTimeline->model_id = $modelId;
                $groupTimeline->group_id = $group->id;
                $groupTimeline->sequence =$item['sequence'];
                $groupTimeline->save();
            }else {
                $groupTimeline = GroupTimeline::where('model_id', $modelId)->where('model_type', $modelClass)->where('group_id', $group->id)->first();
                $groupTimeline->sequence = $item['sequence'];
                $groupTimeline->save();

            }
        }
    }

}
