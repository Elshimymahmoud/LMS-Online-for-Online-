<?php

namespace  App\Models;

use App\Models\Auth\User;
use Illuminate\Database\Eloquent\Model;

class UserCourseRate extends Model
{
    public function rate()
    {
        return $this->belongsTo(Rate::class,'rate_id','id');
    }
    public function user()
    {
        return $this->belongsTo(User::class,'user_id','id');
    }
    public function Answer()
    {
        return $this->hasMany(UserRateAnswer::class,'user_course_rate_id','id');
    }
    //
}
