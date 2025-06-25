<?php

namespace App\Models;

use App\Models\Type;
use App\Models\Course;
use App\Models\RateQuestion;
use Illuminate\Database\Eloquent\Model;

class Rate extends Model
{
    protected $table = 'rates';
    protected $fillable = ['name','name_ar'];
    //
    public function course()
    {
        return $this->belongsToMany(Course::class,'course_rates');
    }
   
    public function RateQuestion()
    {
        return $this->hasMany(RateQuestion::class,'rate_id','id');
    }
    public function UserCourseRate()
    {
        # code... 
        return $this->hasMany(UserCourseRate::class,'rate_id','id');

    }
    public function getUserRate()
    {
        # code...
       if(@auth()->user()->id){
        $userCourseRate=UserCourseRate::where('rate_id',$this->id)->where('user_id',auth()->user()->id)->latest('created_at')->first();
        }
        if(@$userCourseRate)
            return $userAnswers=UserRateAnswer::where('user_course_rate_id',$userCourseRate->id)->get();
            else
            return[];
        
    }
}
