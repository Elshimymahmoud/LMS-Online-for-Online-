<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class CourseLocCoordinator extends Model
{
    //
    protected $table = 'course_loc_coordinators';

    protected $fillable = ['course_location_id','coordinators_id'];
    public function location()
    {
        return $this->belongsTo(CourseLocation::class,'course_location_id');
    }
    public function coordinator()
    {
        return $this->belongsTo(Coordinator::class,'coordinators_id');
    }
}
