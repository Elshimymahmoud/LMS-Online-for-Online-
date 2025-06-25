<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class CourseLocDays extends Model
{
    //
    protected $table = 'course_loc_days';
    protected $fillable = ['course_location_id','name','name_ar'];
     
      
}
