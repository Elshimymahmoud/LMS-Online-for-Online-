<?php

namespace App\Models;


use Illuminate\Database\Eloquent\Model;

class ImpactMeasurement extends Model
{
    //

    protected $table = 'impact_measurements';
    protected $fillable = ['name','name_ar','type'];
    //
    public function course()
    {
        return $this->belongsToMany(Course::class,'course_impact_measurements');
    }
   
    public function ImpactQuestion()
    {
        return $this->hasMany(ImpactMeasurementQuestion::class,'impact_measurement_id','id');
    }
    public function UserCourseImpact()
    {
        # code... user_course_impact_measurements
        return $this->hasMany(UserCourseImpactMeasurement::class,'impact_measurement_id','id');

    }
    public function getUserImpact()
    {
        # code...
       if(@auth()->user()->id){
        $userCourseImpact=UserCourseImpactMeasurement::where('impact_measurement_id',$this->id)->where('user_id',auth()->user()->id)->latest('created_at')->first();
        }
        if(@$userCourseImpact)
            return $userAnswers=UserCourseImpactMeasurementAnswer::where('user_course_impact_id',$userCourseImpact->id)->get();
            else
            return[];
        
    }
    public function getUserCourseImpactAnswers($course_id)
    {
        # code...
       if(@auth()->user()->id){
        $userCourseImpact=UserCourseImpactMeasurement::where('impact_measurement_id',$this->id)->where('user_id',auth()->user()->id)->where('course_id',$course_id)->latest('created_at')->first();
        }
        if(@$userCourseImpact)
            return $userAnswers=UserCourseImpactMeasurementAnswer::where('user_course_impact_id',$userCourseImpact->id)->get();
            else
            return[];
        
    }
}
