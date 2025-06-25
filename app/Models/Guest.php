<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Guest extends Model
{
    //
    protected $fillable = [
        'name', 
        'name_ar', 
        'job', 
        'job_ar',
        'image',
       
        ];

    public function courses()
    {
        return $this->belongsToMany(Course::class,'course_guests','guest_id','course_id');
    }
}
