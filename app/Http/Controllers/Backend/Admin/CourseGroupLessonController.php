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
use Illuminate\Http\Response;
use Illuminate\Support\Facades\Gate;
use Yajra\DataTables\Facades\DataTables;

class CourseGroupLessonController extends Controller
{

    public function index(CourseGroup $group)
    {
        $course = $group->courses;
        //foreach lesson in groups attach it to the group
        //if group doesnt have lesson attach it to the group

        if ($group->courseLessons()->get()->count() == 0){
            foreach ($group->courses->lessons as $lesson) {
                $group->courseLessons()->attach($lesson->id, ['start_time' => $lesson->from_time, 'end_time' =>
                    $lesson->to_time, 'date' => $lesson->date, 'status' => 1]);
            }
        }
        return view('backend.courses.groups.lessons.index', compact('group', 'course'));
    }


    public function getData(CourseGroup $group)
    {
        $course = $group->courses;
        $lessons = $group->courseLessons()->get();
        return DataTables::of($lessons)
            ->addIndexColumn()
            ->addColumn('lesson', function ($lesson) {
                return (app()->getLocale() == 'ar') ? $lesson->title_ar : $lesson->title;
            })
            ->addColumn('chapter', function ($lesson) use ($course){
                // if ($course->type_id != 1){
                //     return __('labels.backend.lessons.fields.directly_attached_to_course');
                // }
                return (app()->getLocale() == 'ar') ? $lesson->chapter->title_ar : $lesson->chapter->title;
            })
            ->addColumn('start_time', function ($lesson) {
                if (is_null($lesson->pivot->start_time)) {
                    return 'N/A';
                }
                $dateTime = new \DateTime($lesson->pivot->start_time);
                return $dateTime->format('h:i A');
            })
            ->addColumn('end_time', function ($lesson) {
                if (is_null($lesson->pivot->end_time)) {
                    return 'N/A';
                }
                $dateTime = new \DateTime($lesson->pivot->end_time);
                return $dateTime->format('h:i A');
            })
            ->addColumn('date', function ($lesson) {
                if (is_null($lesson->pivot->date)) {
                    return 'N/A';
                }
                $dateTime = new \DateTime($lesson->pivot->date);
                return $dateTime->format('Y-m-d');
            })
            ->addColumn('status', function ($lesson) {
                if ($lesson->pivot->status == 1) {
                    return '<span class="badge badge-success">'.__('labels.backend.lessons.fields.published').'</span>';
                } else {
                    return '<span class="badge badge-warning">'.__('labels.backend.courses.fields.not_published').'</span>';
                }
            })
            ->addColumn('actions', function ($lesson) use ($group) {
                $edit = '<a href="' . route('admin.groups.lessons.edit', ['group' => $group->id,'lesson' => $lesson->id]) . '" class="btn btn-primary btn-sm"><i class="fa fa-edit"></i></a>';
                $show = '<a href="' . route('admin.lessons.index', ['course_id' => $group->courses->id,'lesson_id' =>
                        $lesson->id]) . '" class="btn btn-info btn-sm"><i class="fa fa-eye"></i></a>';
                $attendance = '';
                if($group->courses->type_id != 1){
                    $attendance = '<a href="' . route('admin.Attendance.index', ['course' => $group->courses->id,'group' => $group->id,'lesson' => $lesson->id, 'student_id'=>request('student_id')]) . '" class="btn btn-success btn-sm"><i class="fa fa-users"></i></a>';
                }
                return $edit . ' ' . $show . ' ' . $attendance;
            })
            ->rawColumns(['actions', 'status'])
            ->make(true);
    }

    /**
     * Display the specified resource.
     *
     * @param int $groupId
     * @param int $lessonId
     * @return \Illuminate\Http\Response
     */
    public function show($groupId, $lessonId)
    {

    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param int $groupId
     * @param int $lessonId
     * @return \Illuminate\Http\Response
     */
    public function edit(CourseGroup $group, Lesson $lesson)
    {
        return view('backend.courses.groups.lessons.add', compact('group', 'lesson'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param Request $request
     * @return Response
     */
    public function lessonAttachStore(Request $request)
    {
        $group = CourseGroup::findOrFail($request->group_id);
        $lesson = Lesson::findOrFail($request->lesson_id);
        //if group is not 1 then date, start_time, end_time, status are required else status only
        if ($group->courses->type_id != 1) {
            $validatedData = $request->validate([
                'date' => 'required|date|after_or_equal:'.$group->start->toDateString().'|before_or_equal:'.$group->end->toDateString(),
                'start_time' => 'required',
                'end_time' => 'required',
                'status' => 'required'
            ], [
                'date.after_or_equal' => (app()->getLocale() == 'ar') ? 'يجب أن يكون التاريخ بعد أو يساوي تاريخ بداية المجموعة.' : 'The date must be on or after the start date of the group.',
                'date.before_or_equal' => (app()->getLocale() == 'ar') ? 'يجب أن يكون التاريخ قبل أو يساوي تاريخ نهاية المجموعة.' : 'The date must be on or before the end date of the group.'
            ]);
        } else {
            $validatedData = $request->validate([
                'status' => 'required'
            ]);
        }

        if ($group->courses->type_id != 1) {
            $group->courseLessons()->updateExistingPivot($lesson->id, [
                'start_time' => $request->start_time,
                'end_time' => $request->end_time,
                'date' => $request->date,
                'status' => $request->status
            ]);
        } else {
            $group->courseLessons()->updateExistingPivot($lesson->id, [
                'status' => $request->status
            ]);
        }

        return redirect()->route('admin.groups.lessons', $group->id)->with('success', 'Lesson attached successfully');
    }
}
