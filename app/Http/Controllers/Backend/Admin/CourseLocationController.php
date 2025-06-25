<?php

namespace App\Http\Controllers\Backend\Admin;

use App\Models\course_place;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\Coordinator;
use App\Models\Course;
use App\Models\CourseLocation;
use App\Models\CourseLocDays;
use App\Models\Location;
use App\Models\Course_clints;
use App\Models\course_place_unit;


use Gate;
use PhpParser\Node\Expr\Cast\Object_;

class CourseLocationController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index($course_id)
    {
        //
        $course=Course::findOrFail($course_id);
        $courseLocations=CourseLocation::where('course_id',$course_id)->get();
        $course_place_unit = course_place_unit::pluck('name_ar', 'id');

        return view('backend.courses.locations.index',compact('course','courseLocations','course_place_unit'));
        
    }
    public function index2($course_id)
    {
        //
        $course=Course::findOrFail($course_id);
        $courseLocations=CourseLocation::where('course_id',$course_id)->get();
        $course_place_unit = course_place_unit::pluck('name_ar', 'id');

        return view('backend.courses.locations.index-2',compact('course','courseLocations','course_place_unit'));
        
    }
    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */ 
    public function create($course_id)
    {

        $course=Course::findOrFail($course_id);
        if(app()->getLocale()=="ar"){
            $locations = Location::all()->where('courses_type',$course->type_id)->pluck('name_ar', 'id')->prepend('...اختر موقع الدورة','');
            $coordinators=Coordinator::all()->pluck('name_ar', 'id');
            $Course_clints= Course_clints::pluck('name', 'id');
        }
        else{
            $locations = Location::all()->where('courses_type',$course->type_id)->pluck('name', 'id')->prepend('choose course location...','');
            $coordinators=Coordinator::all()->pluck('name', 'id');
            $Course_clints= Course_clints::pluck('name', 'id');
        }

        $course_place_unit = course_place_unit::pluck('name_ar', 'id');
        $teachers = \App\Models\Auth\User::whereHas('roles', function ($q) {
            $q->where('role_id', 2);
        })->get()->pluck('name', 'id');
        return view('backend.courses.locations.create',compact('course_place_unit','course','Course_clints','locations','coordinators','teachers'));
        
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request,$course_id)
    {
        //
        //     $validated = $request->validate([
        //     'location_id' => ['required',function($attribute, $value, $fail) use ($course_id) {
        //         if(CourseLocation::where('course_id', $course_id)->where('location_id', $value)->exists()){
        //             app()->getLocale()=="ar"?$fail('تم اختيار الموقع من قبل'):$fail('location is already chosen before');
        //         }
        //     }],
        // ]);
        $data=$request->location;
        $from_time=$request->fromTime;
        $to_time=$request->toTime;
        // $CoursClint_id=$request->CoursClint_id;
        $place=$request->place;

        $loc_days=$request->daysAr;
        
         
        // dd(request());

        foreach ($data as $key => $location) {
            # code...
            $daysAr=($request->daysAr)?$request->daysAr[$key]:[];
            $daysEn=($request->daysEn)?$request->daysEn[$key]:[];
            $coordinators=($request->coordinator)?$request->coordinator[$key]:[];
            $teachers=($request->teachers)?$request->teachers[$key]:[];
            $teachers = \Auth::user()->isAdmin() ? $teachers : [\Auth::user()->id];
            $coursClints = ($request->Course_clints)?$request->Course_clints[$key]:[];

            $preparedTeachers=[];
            // $preparedCliets=[];

            $timeLinks=$request->time_links[$key];
           
            foreach ($teachers as $key2 => $teacher) {
                # code...
                $preparedTeachers[$teacher]=['course_id'=>$course_id];
            }

            // foreach ($coursClints as $key2 => $teacher) {
            //     # code...
            //     $preparedCliets[$teacher]=['course_id'=>$course_id];
            // }


            $courseLocation=new CourseLocation();
            $courseLocation=$courseLocation
            ->create($location);
            $courseLocation->course_id=$course_id;
            $courseLocation->from_time=$from_time[$key]['time'];
            $courseLocation->to_time=$to_time[$key]['time'];
            // $courseLocation->CoursClint_id=$CoursClint_id;
            $courseLocation->place=$place;
            $courseLocation->location_id=$request->locations;
            $courseLocation->time_links=$timeLinks;
            
            $courseLocation->save();
            if($coordinators){
                $courseLocation->coordinators()->sync($coordinators);
            }
            if($daysAr)
          if($daysAr['days']){
            foreach ($daysAr['days'] as $key2 => $day) {
                
                $newDays=new CourseLocDays();
                $newDays->name=$daysEn['days'][$key2];
                $newDays->name_ar=$day;
                $newDays->course_location_id=$courseLocation->id;
                $newDays->save();
            }
             }  
             if($teachers){
                $courseLocation->teachers()->sync($preparedTeachers);
                
            }
            if($coursClints){
                $courseLocation->clients()->sync($coursClints);
                
            }
           

        }
        // $courseLocation=new CourseLocation();
        // $courseLocation=$courseLocation
        // ->create($request->only('location_id','price','start_date','end_date','zoom_url'));
        // $courseLocation->course_id=$course_id;
        // $courseLocation->save();

        
        return redirect()->route('admin.courses.location2.index',['course_id'=>$course_id])->withFlashSuccess(trans('alerts.backend.general.created'));

       
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($course_id,$location_id)
    {
        //
        $courseLocation=CourseLocation::findOrFail($location_id);

        $course=Course::findOrFail($course_id);
        if(app()->getLocale()=="ar"){
            $locations = Location::all()->where('courses_type',$course->type_id)->pluck('name_ar', 'id')->prepend('...اختر موقع الدورة','');
            $coordinators=Coordinator::all()->pluck('name_ar', 'id');
            $Course_clints= Course_clints::pluck('name', 'id');
            
        }
        else{
            $locations = Location::all()->where('courses_type',$course->type_id)->pluck('name', 'id')->prepend('choose course location...','');
            $coordinators=Coordinator::all()->pluck('name', 'id');
            $Course_clints= Course_clints::pluck('name', 'id');
        }
//        $Course_clints= Course_clints::select('id','name')->get();

      $LocationDays=$courseLocation->LocationDays;
      $course_place_unit = course_place_unit::pluck('name_ar', 'id');
      $teachers = \App\Models\Auth\User::whereHas('roles', function ($q) {
        $q->where('role_id', 2);
    })->get()->pluck('name', 'id');
        $place = course_place::all()->pluck('name_ar', 'id');

        return view('backend.courses.locations.edit',compact('course_place_unit', 'place','course','Course_clints','locations','courseLocation','coordinators','LocationDays','teachers'));
        
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $course_id,$location_id)
    {
       
        //
       
        $courseLocation=CourseLocation::findOrFail($location_id);
        $courseLocation->course_id=$course_id;
        $courseLocation->save();
        $courseLocation=$courseLocation
        ->update($request->only('location_id','CoursClint_id','place','price','start_date','end_date','zoom_url','currency'));
        $courseLocation=CourseLocation::findOrFail($location_id);
        
        
        $courseLocation->to_time=$request->toTime;
        $courseLocation->from_time=$request->fromTime;
        $courseLocation->time_links=$request->time_links;
        $courseLocation->save();
        $courseLocation->coordinators()->sync($request->coordinator);
        if($request->daysAr){
        $daysAr=$request->daysAr[0];
        $daysEn=$request->daysEn[0];

        $delete=CourseLocDays::where('course_location_id',$courseLocation->id)->delete();
        if($daysAr['days']){
            foreach ($daysAr['days'] as $key2 => $day) {
                
                $newDays=new CourseLocDays();
                $newDays->name=$daysEn['days'][$key2];
                $newDays->name_ar=$day;
                $newDays->course_location_id=$courseLocation->id;
                $newDays->save();
            }
             } 
             
        }
           
        $teachers=($request->teachers)?$request->teachers:[];
        $teachers = \Auth::user()->isAdmin() ? $teachers : [\Auth::user()->id];
        $preparedTeachers=[];

        

        $coursClints = ($request->Course_clints)?$request->Course_clints:[];
        // $preparedclients=[];

        // dd($preparedTeachers);
     
        foreach ($teachers as $key2 => $teacher) {
            # code...
            $preparedTeachers[$teacher]=['course_id'=>$course_id];
        }
        // foreach ($coursClints as $key2 => $client) {
        //     # code...
        //     $preparedclients[$client]=['course_id'=>$course_id];
        // }
        if($teachers){
            $courseLocation->teachers()->sync($preparedTeachers);
            
        }
        if($coursClints){
            $courseLocation->clients()->sync($coursClints);
            
        }
       
        // return redirect()->back()->withFlashSuccess(trans('alerts.backend.general.updated'));

         return redirect()->route('admin.courses.location2.index',['course_id'=>$course_id])->withFlashSuccess(trans('alerts.backend.general.updated'));
      
        
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($course_id,$location_id)
    {

        // $this->validate(request(), [
        //     'course_id' => 'required',
        //     'location_id' => 'required',
        // ], ['course_id.required' => 'The course field is required'],
        // ['location_id.required' => 'The location field is required']);
        
        //
        if (!Gate::allows('course_delete')) {
            return abort(401);
        }

        $course = Course::findOrFail($course_id);

        $courseLocation=CourseLocation::findOrFail($location_id);

        if ($course->studentsCourseLocation($location_id)->count() >= 1) {
            return redirect()->back()->withFlashDanger(trans('alerts.backend.general.delete_warning'));
            // return redirect()->route('admin.courses.location.index',['course_id'=>$course_id])->withFlashDanger(trans('alerts.backend.general.delete_warning'));
       
        } else {
             $courseLocation->delete();
            //  $course->delete();
        };

        return redirect()->back()->withFlashSuccess(trans('alerts.backend.general.deleted'));

        // return redirect()->route('admin.courses.location.index',['course_id'=>$course_id])->withFlashSuccess(trans('alerts.backend.general.deleted'));
    }
}
