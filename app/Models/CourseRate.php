<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class CourseRate extends Model
{
    protected $table = "course_rates";
    protected $guarded = [];

    public function course()
    {
        return $this->belongsTo(Course::class,'course_id','id');
    }
    public function rate()
    {
        return $this->belongsTo(Rate::class,'rate_id','id');
    }
}
