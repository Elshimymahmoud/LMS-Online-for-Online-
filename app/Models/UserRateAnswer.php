<?php

namespace  App\Models;

use Illuminate\Database\Eloquent\Model;

class UserRateAnswer extends Model
{
    
    //
    public function UserCourseRate()
    {
        # code...
        return $this->belongsTo(UserCourseRate::class,'user_course_rate_id','id');

    }

    public function RateQuestion()
    {
        # code...
        return $this->belongsTo(RateQuestion::class,'rate_question_id','id');

    }
}
