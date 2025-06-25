<?php

namespace App\Models;

use App\Models\Auth\User;
use Illuminate\Database\Eloquent\Model;

class CourseLocation extends Model
{
    //  
    protected $table = 'course_locations';

    protected $fillable = ['course_id','location_id','CoursClint_id','place','start_date','end_date','zoom_url','price','currency','from_time','to_time','time_links'];
    public function location()
    {
        return $this->belongsTo(Location::class,'location_id');
    }
    public function locations()
    {
        return $this->belongsToMany(Location::class, 'course_locations');
    }
    public function teachers()
    {
        return $this->belongsToMany(User::class, 'course_user','course_location_id','user_id')->withPivot('user_id');
    }
    public function course()
    {
        return $this->belongsTo(Course::class);
    }
    public function lessons()
    {
        //lessons,tests,blogs
        return $this->belongsToMany(Lesson::class,'lesson_course_location','course_location_id','model_id');
    }
    public function coordinators()
    {
        return $this->belongsToMany(Coordinator::class, 'course_loc_coordinators','course_location_id','coordinators_id')->withTimestamps()->withPivot(['course_location_id','coordinators_id','created_at']);
    }
    public function LocationDays()
    {
        return $this->hasMany(CourseLocDays::class);
    }
    public function client()
    {
        return $this->belongsTo(Client::class,'CoursClint_id');
    }
    public function courseClient()
    {
        return $this->belongsTo(Course_clints::class,'CoursClint_id');
    }

    public function clients()
    {
        return $this->belongsToMany(Course_clints::class, 'course_client', 'course_id', 'client_id')->withTimestamps();
    }
}
