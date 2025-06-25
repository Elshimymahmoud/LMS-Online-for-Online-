<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Result extends Model
{
    //
    protected $table = 'results';

    protected $fillable = ['course_group_test_id', 'user_id', 'test_result', 'course_group_id'];

    public function answers()
    {
        return $this->hasMany('App\Models\ResultsAnswer');
    }


    public function test(){
        return $this->belongsTo(CourseGroupTest::class,'course_group_test_id','id');
    }

    public function user(){
        return $this->belongsTo('App\Models\Auth\User');
    }

    public function group(){
        return $this->belongsTo(CourseGroup::class,'course_group_id','id');
    }

}
