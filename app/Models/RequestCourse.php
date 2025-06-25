<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class RequestCourse extends Model
{
    //
    protected $table = 'request_courses';

    protected $fillable = ['first_name','job','company', 'second_name', 'organization','phone','course_name','message'];
    
}
