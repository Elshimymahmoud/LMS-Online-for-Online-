<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class UserCourseForm extends Model
{
    //
    protected $table = 'user_course_forms';
    protected $fillable = ['user_id','student_id','form_id','course_id'];

    public function form()
    {
        return $this->belongsTo(Forms::class,'form_id','id');
    }
    public function user() //who make rate or fill form
    {
        return $this->belongsTo(User::class,'user_id','id');
    }
    public function student() //when teacher evaluate student
    {
        return $this->belongsTo(User::class,'student_id','id');
    }
    public function Answer()
    {
        
        return $this->hasMany(UserFormAnswer::class,'user_course_form_id','id');
    }
}
