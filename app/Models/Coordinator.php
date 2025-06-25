<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Coordinator extends Model
{
    //
    protected $table = 'coordinators';

    protected $fillable = ['name','name_ar','email','phone','gender'];

    public function coordinators()
    {
        return $this->belongsToMany(CourseLocation::class, 'course_loc_coordinators','coordinators_id','course_location_id')->withTimestamps()->withPivot(['course_location_id','coordinators_id','created_at']);
    }
}
