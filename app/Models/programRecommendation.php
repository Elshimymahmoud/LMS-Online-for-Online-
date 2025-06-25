<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class programRecommendation extends Model
{
    //
    protected $table = 'program_recommendations';
    protected $fillable = ['name','name_ar','is_active'];
    //
    public function course()
    {
        return $this->belongsToMany(Course::class,'course_program_recommendations');
    }
   
    public function ProgramRecommendationQuestion()
    {
        return $this->hasMany(programRecommendationQuestion::class,'program_recommendations_id','id');
    }
    public function UserCourseProgramRecommendation()
    {
        # code... user_course_impact_measurements
        return $this->hasMany(UserCourseProgramRecommendation::class,'program_recommendations_id','id');

    }
    public function getUserProgramRecommendation()
    {
        # code...
       if(@auth()->user()->id){
        $userCourseprogram=UserCourseProgramRecommendation::where('program_recommendations_id',$this->id)->where('user_id',auth()->user()->id)->latest('created_at')->first();
        }
        if(@$userCourseprogram)
            return $userAnswers=UserCourseProgramRecommendationAnswers::where('user_course_program_recommendations_id',$userCourseprogram->id)->get();
            else
            return[];
        
        }
        public function getUserProgramRecommendationAnswers($course_id)
        {
            # code...
           if(@auth()->user()->id){
            $userCourseprogram=UserCourseProgramRecommendation::where('program_recommendations_id',$this->id)->where('user_id',auth()->user()->id)->where('course_id',$course_id)->latest('created_at')->first();
            }
            if(@$userCourseprogram)
                return $userAnswers=UserCourseProgramRecommendationAnswers::where('user_course_program_recommendations_id',$userCourseprogram->id)->get();
                else
                return[];
            
            }
       
}
