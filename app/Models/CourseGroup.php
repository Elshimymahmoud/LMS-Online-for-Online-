<?php

namespace App\Models;

use App\Models\Auth\User;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Auth;
use Illuminate\Database\Eloquent\SoftDeletes;

class CourseGroup extends Model
{
    use SoftDeletes;
    protected $table = 'course_groups';

    protected $guarded = ['id'];
    protected $dates = ['start', 'end'];

    public function courses(){
        return $this->belongsTo(Course::class,'course_id');
    }
    public function coordinators()
    {
        return $this->belongsToMany(Coordinator::class,'group_coordinators','group_id','coordinator_id');
    }
    public function teachers()
    {
        return $this->belongsToMany(User::class,'group_teachers','group_id','teacher_id');
    }
    public function students()
    {
        return $this->belongsToMany(User::class,'group_students','group_id','student_id');
    }
    public function clients()
    {
        return $this->belongsToMany(Course_clints::class,'group_clients','group_id','client_id');
    }
    public function scopeOfTeacher($query)
    {
        if (!Auth::user()->isAdmin()) {
            return $query->whereHas('teachers', function ($q) {
                $q->where('user_id', Auth::user()->id);
            });
        }
        // dd($query);
        return $query;
    }

    public function tests()
    {
        return $this->belongsToMany(CourseGroupTest::class, 'course_group_test')->withPivot('course_group_id', 'course_group_test_id', 'chapter_id', 'lesson_id', 'published');
    }

    public function rates()
    {
        return $this->belongsToMany(CourseGroupRates::class, 'course_group_rate')->withPivot('course_group_id','course_group_rates_id', 'published');
    }

    public function getUserRate($user_id, $course_group_id)
    {
        return $this->rates()->where('user_id', $user_id)->where('course_group_id', $course_group_id)->first();
    }

    public function impacts()
    {
        return $this->belongsToMany(CourseGroupImpact::class, 'course_group_impact')->withPivot('course_group_id', 'course_group_impact_id', 'published');
    }

    public function reccomendations()
    {
        return $this->belongsToMany(CourseGroupRecommendation::class, 'course_group_rec')->withPivot('course_group_id', 'course_group_recommendation_id', 'published');
    }

    public function groupPlaces()
    {
        return $this->belongsTo(course_place::class, 'place_id');
    }

    public function lessons()
    {
        return $this->belongsToMany(Lesson::class, 'lesson_course_group', 'course_group_id', 'model_id')
            ->withPivot(['course_group_id', 'model_id', 'model_type']);
    }

    public function location()
    {
        return $this->belongsTo(Location::class, 'location_id');
    }

    public function chapterStudents()
    {
        return $this->hasMany(ChapterStudent::class);
    }

    public function courseLessons()
    {
        return $this->belongsToMany(Lesson::class,'group_lesson', 'course_group_id', 'lesson_id')->withPivot('start_time', 'end_time', 'date', 'status');
    }

    public function chat()
    {
        return $this->hasOne(GroupChat::class, 'course_group_id');
    }

    public function groupActivity()
    {
        return $this->belongsToMany(GroupActivity::class, 'course_group_activity')
            ->withPivot('course_group_id', 'group_activity_id');
    }

    public function groupActivityResults()
    {
        return $this->hasMany(ActivityResult::class, 'group_id', 'id');
    }

    public function groupTimeline()
    {
        return $this->hasMany(GroupTimeline::class, 'group_id', 'id');
    }

    public function cert_template()
    {
        return $this->belongsTo(CertificateTemplates::class, 'certificate_template_id');
    }

    public function resources()
    {
        return $this->hasMany(GroupResourceLink::class, 'group_id');
    }
}
