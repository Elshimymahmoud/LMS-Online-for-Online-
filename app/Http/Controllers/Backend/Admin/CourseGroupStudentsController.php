<?php

namespace App\Http\Controllers\Backend\Admin;

use App\Http\Controllers\Controller;
use App\Http\Controllers\Traits\FileUploadTrait;
use App\Models\Auth\User;
use App\Models\Category;
use App\Models\Coordinator;
use App\Models\Course;
use App\Models\Course_clints;
use App\Models\course_place;
use App\Models\CourseGroup;
use App\Models\CourseGroupImpact;
use App\Models\CourseGroupRates;
use App\Models\CourseGroupRecommendation;
use App\Models\CourseGroupTest;
use App\Models\Location;
use App\Models\Type;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Gate;

class CourseGroupStudentsController extends Controller
{
    use FileUploadTrait;

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(CourseGroup $group)
    {

        if (!Gate::allows('course_access')) {
            return abort(401);
        }

        //return all student in this group
        $students = $group->students;
        return view('backend.courses.groups.students.index', compact('students', 'group'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {

        $courses = Course::all();

        if (app()->getLocale() == "ar") {
            $categories = Category::where('status', '=', 1)->pluck('name_ar', 'id');
            $types = Type::where('status', 1)->get()->pluck('name', 'id');
            $locations = Location::all()->pluck('name_ar', 'id');
            $coordinators = Coordinator::all()->pluck('name_ar', 'id');
            $clients = Course_clints::all()->pluck('name_ar', 'id');
            $tests = CourseGroupTest::all()->pluck('title_ar', 'id');

            $rates = CourseGroupRates::all()->pluck('title_ar', 'id');
            $impacts = CourseGroupImpact::all()->pluck('impact_ar', 'id');
            $reccomendations = CourseGroupRecommendation::all()->pluck('recommendation_ar', 'id');

        } else {
            $categories = Category::where('status', '=', 1)->pluck('name', 'id');
            $types = Type::where('status', 1)->get()->pluck('name', 'id');
            $locations = Location::all()->pluck('name_ar', 'id');
            $coordinators = Coordinator::all()->pluck('name_ar', 'id');
            $clients = Course_clints::all()->pluck('name_ar', 'id');
            $tests = CourseGroupTest::all()->pluck('title', 'id');

            $rates = CourseGroupRates::all()->pluck('title', 'id');
            $impacts = CourseGroupImpact::all()->pluck('impact', 'id');
            $reccomendations = CourseGroupRecommendation::all()->pluck('recommendation', 'id');
        }
        $teachers = \App\Models\Auth\User::whereHas('roles', function ($q) {
            $q->where('role_id', 2);
        })->get()->pluck('name', 'id');
//        $locations = Location::all()->pluck('name_ar', 'id');
        $students = \App\Models\Auth\User::whereHas('roles', function ($q) {
            $q->where('role_id', 3);
        })->get()->pluck('name', 'id');
        $places = course_place::all()->pluck('name_ar', 'id');
        $locations = Location::all()->pluck('name_ar', 'id');

        return view('backend.courses.groups.create', compact('courses', 'categories', 'types', 'tests', 'places', 'locations', 'coordinators', 'teachers', 'students', 'clients', 'rates', 'impacts', 'reccomendations'));
    }

    /**
     * Get the data for the specified course.
     *
     * @param \App\Models\Course $course
     * @return array
     */
    public function getData(Course $course)
    {
        return [
            'description' => $course->description, // Assuming 'description_en' is the attribute for English description
            'description_ar' => $course->description_ar, // Assuming 'description_ar' is the attribute for Arabic description
            'course_type' => $course->type->name, // Assuming 'description_ar' is the attribute for Arabic description
//            'location' => $course->locations->pluck('name')->unique(),
            'locations' => Location::where('courses_type', $course->type->id)->get()->pluck('name', 'id'),
        ];
    }

    public function getHall(Location $location)
    {
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
        $validatedData = $request->validate([
            'course_id' => 'required|exists:courses,id',
            'location' => 'required',
            'location2' => 'required',
        ]);

        // Create a new CourseGroup instance
        $courseGroup = new CourseGroup();

        // Fill the CourseGroup instance with the validated data
        $courseGroup->course_id = $validatedData['course_id'];
        $courseGroup->place_id = $validatedData['location'];
        $courseGroup->location_id = $validatedData['location2'];

        $courseGroup->title_en = $request->title_en;
        $courseGroup->title_ar = $request->title_ar;
        $courseGroup->description_ar = $request->description_ar;
        $courseGroup->description_en = $request->description;
//        $courseGroup->number_hours = $request->number_hours;
//        $courseGroup->price = $request->price;
        $courseGroup->start = Carbon::parse($request->from_datetime);
        $courseGroup->end = Carbon::parse($request->to_datetime);
//        $courseGroup->image = null;
        $courseGroup->save();

        if ($request->hasFile('image')) {

            // Store the uploaded image in the 'public' disk
            $path = $this->saveFiles($request);
            // Save the image path to the CourseGroup instance
            $courseGroup->image = $path->image;
            $courseGroup->save();
        }

        //if request has tests
        if ($request->has('tests')) {
            foreach ($request->tests as $key => $test) {
               $courseGroup->tests()->attach($test);
            }
        }

        if ($request->has('rates')) {
            foreach ($request->rates as $key => $rate) {
                $courseGroup->rates()->attach($rate);
            }
        }

        //attach group it to impacts
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
        foreach ($request->coordinator as $coordinatorArray) {
            // Merge coordinator IDs into a single array
            $coordinatorIds = array_merge($coordinatorIds, $coordinatorArray);
        }

        // Remove duplicates (if any)
        $coordinatorIds = array_unique($coordinatorIds);

        // Attach coordinators to the CourseGroup
        $courseGroup->coordinators()->attach($coordinatorIds);

        // Attach Teachers to the CourseGroup
        $teacherIds = [];
        foreach ($request->teachers as $teacherArray) {
            // Merge coordinator IDs into a single array
            $teacherIds = array_merge($teacherIds, $teacherArray);
        }
        $teacherIds = array_unique($teacherIds);
        $courseGroup->teachers()->attach($teacherIds);




        // Attach Students to the CourseGroup
        $studentIds = [];
        foreach ($request->students as $studentArray) {
            $studentIds = array_merge($studentIds, $studentArray);
        }
        $studentIds = array_unique($studentIds);
        $courseGroup->students()->attach($studentIds);



        // Attach Clients to the CourseGroup
        $clientIds = [];
        foreach ($request->clients as $clientArray) {
            $clientIds = array_merge($clientIds, $clientArray);
        }
        $clientIds = array_unique($clientIds);
        $courseGroup->clients()->attach($clientIds);


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
        if (!Gate::allows('course_view')) {
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
        if (!Gate::allows('course_edit')) {
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
        $clients = Course_clints::all()->pluck('name_ar', 'id');
        $types = session('locale') == 'en' ? Type::where('status', 1)->pluck('name', 'id')->prepend(__('labels.backend.courses.fields.choose-cat'), '') : Type::where('status', 1)->pluck('name_ar', 'id')->prepend(__('labels.backend.courses.fields.choose-cat'), '');
        $locations = Location::where('courses_type', $course->type->id)->get()->pluck('name', 'id');
        $hall = course_place::where('id', $group->place_id)->get();
        $tests = CourseGroupTest::all();
        $rates = CourseGroupRates::all();
        $impacts = CourseGroupImpact::all();
        $reccomendations = CourseGroupRecommendation::all();

        return view('backend.courses.groups.edit2', compact('group', 'hall','locations', 'course', 'teachers', 'students', 'coordinators', 'clients', 'types', 'tests', 'rates', 'impacts', 'reccomendations'));
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

        // Validate the request data
        $validatedData = $request->validate([
            'course_id' => 'required|exists:courses,id',
            'location' => 'required|exists:course_places,id',
            'location2' => 'required|exists:locations,id',
        ]);

        // Create a new CourseGroup instance
        $courseGroup = CourseGroup::where('id', $id)->first();
        // Fill the CourseGroup instance with the validated data
        $courseGroup->course_id = $validatedData['course_id'];
        $courseGroup->location_id = $validatedData['location2'];
        $courseGroup->place_id = $validatedData['location'];
        $courseGroup->title_en = $request->title_en;
        $courseGroup->title_ar = $request->title_ar;
        $courseGroup->description_ar = $request->description_ar;
        $courseGroup->description_en = $request->description_en;
        $courseGroup->start = Carbon::parse($request->from_datetime);
        $courseGroup->end = Carbon::parse($request->to_datetime);

        $courseGroup->save();

        //attach group it to test
        if ($request->has('tests')) {
            $courseGroup->tests()->detach();
            foreach ($request->tests as $key => $test) {
                $courseGroup->tests()->attach($test);
            }
        }

        //attach group it to rates
        if ($request->has('rates')) {
            $courseGroup->rates()->detach();
            foreach ($request->rates as $key => $rate) {
                $courseGroup->rates()->attach($rate);
            }
        }

        //attach group it to impacts
        if ($request->has('impacts')) {
            $courseGroup->impacts()->detach();
            foreach ($request->impacts as $key => $impact) {
                $courseGroup->impacts()->attach($impact);
            }
        }
        //attach group it to reccomendations
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

        // Attach Teachers to the CourseGroup
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


        // Attach Clients to the CourseGroup
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
        if (!Gate::allows('course_delete')) {
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
        if (!Gate::allows('course_delete')) {
            return abort(401);
        }
        $group = CourseGroup::where('id', $id)->first();
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
        if (!Gate::allows('course_delete')) {
            return abort(401);
        }
        $group = CourseGroup::where('id', $id)->first();
        $group->forceDelete();

        return redirect()->route('admin.groups.index')->withFlashSuccess(trans('alerts.backend.general.deleted'));
    }
}
