<?php

namespace App\Http\Controllers\Backend;

use App\Models\CourseGroup;
use App\Models\Lesson;
use DateTimeZone;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\Attendence;
use App\Models\Auth\User;
use Illuminate\Support\Facades\Gate;
use App\Models\Course;
use App\Models\CourseLocation;
use Carbon\CarbonInterval;
use DateTime;
use Illuminate\Support\Carbon;
use Illuminate\Support\Facades\Lang;

class AttendanceController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index0()
    {
        //
        if (!Gate::allows('course_access')) {
            return abort(401);
        }
        $course_id=request('course');
        $course=Course::findOrFail($course_id);
        $courseLocations=CourseLocation::where('course_id',$course_id)->get();
        return view('backend.attendance.attendance', compact('course','courseLocations'));

       
    }
    public function index1()
    {

        if (!Gate::allows('group_access')) {
            return abort(401);
        }
        if (request('student_id' ) && empty(request('group')) ) {
            $student_id=request('student_id');
            $user=User::find($student_id);
            $groups=$user->purchasedGroups();
        }else{
            $group_id=request('group');
            $groups=CourseGroup::where('id',$group_id)->get();
        }

        return view('backend.attendance.attendance2', compact('groups'));

       
    }
    public function index()
    {
        
        
        if (!Gate::allows('course_access')) {
            return abort(401);
        }
       
        $course_id = request('course');
        $course= Course::findOrFail($course_id);
        $group = CourseGroup::findOrFail(request('group'));
        $lesson = Lesson::findOrFail(request('lesson'));
        $user=User::find(request('student_id'));
        return view('backend.attendance.index', compact('course','group','user', 'lesson'));

       
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {

        $student_ids=$request->student_ids;
        $attendance_time=$request->attendance_time;
        $late_time=$request->late_time;
        $attendance_status = $request->attendance_status;
        $group_id=$request->group_id;
        $lesson_id=$request->lesson_id;
        $course_id=$request->course_id;
        $lesson = Lesson::findOrFail($lesson_id);
        $group = CourseGroup::findOrFail($group_id);
        $gLesson = $group->courseLessons->where('id',$lesson_id)->first();

        // to initialize date for all user
        foreach ($student_ids as $key => $student_id) {

            $newAttendance=Attendence::where(['course_id'=>$course_id,'user_id'=>$student_id,
                'course_group_id'=>$group_id, 'lesson_id'=>$lesson_id])->first();


            if(!$newAttendance)
            {
                $newAttendance=new Attendence();
                $newAttendance->user_id=$student_id;
                $newAttendance->course_id=$course_id;
                $newAttendance->course_group_id=$group_id;
                $newAttendance->lesson_id=$lesson_id;
            }

            if ($attendance_status[$student_id] == 1){
                $attendanceTime = substr($attendance_time[$student_id], 11, 5) . ":00"; // Converts to "15:41:00"
                $lateTime = substr($late_time[$student_id], 11, 5) . ":00"; // Converts to "15:41:00"

                $attendanceTime = \DateTime::createFromFormat('H:i:s', $attendanceTime);
                $lateTime = \DateTime::createFromFormat('H:i:s', $lateTime);
                $startTime = \DateTime::createFromFormat('H:i:s', $gLesson->pivot->start_time);
                $endTime = \DateTime::createFromFormat('H:i:s', $gLesson->pivot->end_time);

                //check if attendance_time between the lesson start and end time
                if ($attendanceTime < $startTime || $attendanceTime > $endTime) {
                    return redirect()->back()->withFlashDanger(__('labels.backend.attendance.attendance_time'));
                }
                //check if late_time between the lesson start and end time
                if ($lateTime < $startTime || $lateTime > $endTime) {
                    return redirect()->back()->withFlashDanger(__('labels.backend.attendance.late_time'));
                }
                $newAttendance->attendance_time=$attendance_time[$student_id];
                $newAttendance->late_time=$late_time[$student_id];
            }
            $newAttendance->status=$attendance_status[$student_id];
            $newAttendance->course_group_id=$group_id;
            $newAttendance->lesson_id=$lesson_id;

            $newAttendance->save();
        }

        // to save actual date
//        foreach ($student_ids as $key => $student_id) {
//
//            $checkDate = new DateTime($attendance_time[$key]);
//
//            $newAttendance = Attendence::where(['course_id'=>$course_id,'user_id'=>$student_id,
//                'course_group_id'=>$group_id, 'lesson_id'=>$lesson_id])->first();
//
//            if(!$newAttendance)
//            {
//                $newAttendance=new Attendence();
//                $newAttendance->user_id=$student_id;
//                $newAttendance->course_id=$course_id;
//                $newAttendance->course_group_id=$group_id;
//                $newAttendance->lesson_id=$lesson_id;
//            }
//
//            if($attendance_status[$student_id]){
//                $newAttendance->attendance_time=$attendance_time[$key];
//                $newAttendance->late_time=$late_time[$key];
//            }
//
//            $newAttendance->status=$attendance_status[$student_id];
//            $newAttendance->save();
//
//        }

        return redirect()->route('admin.Attendance.show', ['group' => $group_id,'course'=>$course_id,
            'lesson'=>$lesson_id])->withFlashSuccess(trans('alerts.backend.general.created'));

    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($course_id,$group_id)
    {
        if (!Gate::allows('course_access')) {
            return abort(401);
        }
        $group = CourseGroup::findOrFail($group_id);
        $lesson = Lesson::findOrFail(request('lesson'));
        $course=Course::findOrFail($course_id);
        $attendences=Attendence::where('course_id',$course_id)->where('course_group_id',$group_id)
            ->where('lesson_id',$lesson->id)->get();
        $start_date = $group->start->format('Y-m-d');
        $end_date = $group->end->format('Y-m-d');

    
       $attendencesByDay=[];
       $attendencesByuser=[];

    //    dd($start_date);
  
        foreach ($attendences as $key => $attendence) {
            # code...
            $date = new DateTime($attendence->attendance_time);
            $date = $date->format('Y-m-d');
            $date2 = new DateTime($attendence->attendance_time);
            $date2= $date2->format('F d D');
            

            $attendencesByDay[$date2]=Attendence::where('course_id',$course_id)
                ->where('lesson_id',$lesson->id)
                ->where('course_group_id',$group_id)
                ->where('attendance_time','like',$date.'%')
            ->get();

            $attendencesByuser[$attendence->user->id]=Attendence::where('course_id',$course_id)
                ->where('lesson_id',$lesson->id)
                ->where('course_group_id',$group_id)
                ->where('user_id',$attendence->user->id)
            ->get();
        }
        $user=User::find(request('student_id'));

   
        return view('backend.attendance.show', compact('group','course','attendencesByDay','attendencesByuser',
            'user', 'lesson'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }

    public function present(Course $course, CourseGroup $group, Lesson $lesson, Request $request)
    {
        $user=User::findOrFail(request('user_id'));
        $gLesson = $group->courseLessons->where('id',$lesson->id)->first();
        $attendance=Attendence::where('course_id',$course->id)
            ->where('course_group_id',$group->id)
            ->where('lesson_id',$lesson->id)
            ->where('user_id',$user->id)
            ->first();

        // Check if the user is already present
        if ($attendance && $attendance->attendance_time != null) {
            // return error telling it is already present
            return response()->json(['error' => __('labels.frontend.attendance.alreadyMarkAsPresent')]);
        }

        // Check if the lesson has start_time and end_time set
        if ($gLesson->pivot->start_time == null || $gLesson->pivot->end_time == null) {
            return response()->json(['error' => __('labels.frontend.attendance.lesson_time_not_set')]);
        }

        $startTime = \DateTime::createFromFormat('Y-m-d H:i:s', $gLesson->pivot->date . ' ' . $gLesson->pivot->start_time);
        $endTime = \DateTime::createFromFormat('Y-m-d H:i:s',  $gLesson->pivot->date . ' ' . $gLesson->pivot->end_time);

        // Retrieve the user's timezone
        $timezone = $user->timezone;

        // Create a new DateTime object with the user's timezone
        $dateTime = new DateTime("now", new DateTimeZone($timezone));

        // Get the timezone offset in hours and minutes
        $offset = $dateTime->format('P');

        // Set the timezone for the start and end time
        $startTime->setTimezone(new DateTimeZone($timezone));
        $endTime->setTimezone(new DateTimeZone($timezone));

        //check if attendance_time between the lesson start and end time
        if ($dateTime < $startTime || $dateTime > $endTime) {
            return response()->json(['error' => __('labels.frontend.attendance.lesson_ended')]);
        }

        if (!$attendance){
            $attendance = new Attendence();
        }

        $attendance->course_id = $course->id;
        $attendance->course_group_id = $group->id;
        $attendance->lesson_id = $lesson->id;
        $attendance->user_id = $user->id;
        $attendance->status = 1;
        $attendance->attendance_time = Carbon::now(); // Store current time in UTC format
        $attendance->save();
        return response()->json(['success' => __('labels.frontend.attendance.markAsPresent')]);
    }

    public function finished(Course $course, CourseGroup $group, Lesson $lesson, Request $request)
    {
        $user=User::findOrFail(request('user_id'));
        $gLesson = $group->courseLessons->where('id', $lesson->id)->first();

        $attendance=Attendence::where('course_id', $course->id)
            ->where('course_group_id', $group->id)
            ->where('lesson_id', $lesson->id)
            ->where('user_id', $user->id)
            ->first();


        if ($attendance) {

            // Check if the user has already marked as present
            if ($attendance->attendance_time == null) {
                return response()->json(['error' => __('labels.frontend.attendance.notMarkAsPresent')]);
            }

            // Check if the user is already marked as finished
            if ($attendance->late_time != null) {
                return response()->json(['error' => __('labels.frontend.attendance.alreadyMarkAsFinished')]);
            }
        }

        // Check if the lesson has start_time and end_time set
        if ($gLesson->pivot->start_time == null || $gLesson->pivot->end_time == null) {
            return response()->json(['error' => __('labels.frontend.attendance.lesson_time_not_set')]);
        }

        $startTime = \DateTime::createFromFormat('Y-m-d H:i:s', $gLesson->pivot->date . ' ' . $gLesson->pivot->start_time);
        $endTime = \DateTime::createFromFormat('Y-m-d H:i:s',  $gLesson->pivot->date . ' ' . $gLesson->pivot->end_time);

        // Retrieve the user's timezone
        $timezone = $user->timezone;

        // Create a new DateTime object with the user's timezone
        $dateTime = new DateTime("now", new DateTimeZone($timezone));

        // Get the timezone offset in hours and minutes
        $offset = $dateTime->format('P');

        // Set the timezone for the start and end time
        $startTime->setTimezone(new DateTimeZone($timezone));
        $endTime->setTimezone(new DateTimeZone($timezone));

        if ($dateTime < $startTime || $dateTime > $endTime) {
            return response()->json(['error' => __('labels.frontend.attendance.lesson_ended')]);
        }

        if (!$attendance){
            $attendance = new Attendence();
        }

        $attendance->course_id = $course->id;
        $attendance->course_group_id = $group->id;
        $attendance->lesson_id = $lesson->id;
        $attendance->user_id = $user->id;
        $attendance->late_time = Carbon::now(); // Store current time in UTC format
        $attendance->save();

        return response()->json(['success' => __('labels.frontend.attendance.markAsFinished')]);
    }
}
