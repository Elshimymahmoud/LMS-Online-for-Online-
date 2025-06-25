<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class UserFormAnswer extends Model
{
    //
    protected $table = 'user_form_answers';
    protected $fillable = ['user_course_form_id','question_id','answer','notes'];

    public function UserCourseForm()
    {
        # code...
        return $this->belongsTo(UserCourseForm::class,'user_course_form_id','id');

    }

    public function FormQuestion()
    {
        # code...
        
        return $this->belongsToMany(Question::class, 'question_form');


    }
}
