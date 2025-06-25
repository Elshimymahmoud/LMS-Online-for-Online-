<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class CourseGroupTestResult extends Model
{
    //
    protected $table = 'course_group_test_results';

    protected $fillable = ['course_forms_id', 'user_id', 'test_result'];

    public function answers()
    {
        return $this->hasMany('App\Models\ResultsAnswer');
    }


    public function courseGroupTest(){
        return $this->belongsTo(CourseGroupTest::class,'course_group_test_id','id');
        //return $this->hasMany(CourseForms::class, 'id','course_forms_id');
        
    }

    public function user(){
        return $this->belongsTo('App\Models\Auth\User');
    }

}
