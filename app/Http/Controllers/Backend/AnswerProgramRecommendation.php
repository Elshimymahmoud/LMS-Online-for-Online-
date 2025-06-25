<?php

namespace App\Http\Controllers\Backend;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\UserCourseProgramRecommendation;
use App\Models\UserCourseProgramRecommendationAnswers;
use App\Models\programRecommendation;
use App\Models\programRecommendationQuestion;


class AnswerProgramRecommendation extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
        // dd($request->all());
        $program_recommendations_id=$request->program_recommendations_id;

        $user=auth()->user();
        $userCourseProgramRecommendations=UserCourseProgramRecommendation::where('user_id',$user->id)->pluck('program_recommendations_id')->toArray();
        
        // dd($UserCourseRates);
        $newUserCourseProgram=UserCourseProgramRecommendation::where('user_id',$user->id)->where('program_recommendations_id',$program_recommendations_id)->first();
        if(!in_array($program_recommendations_id,$userCourseProgramRecommendations)){
            $newUserCourseProgram=new UserCourseProgramRecommendation();
            $newUserCourseProgram->program_recommendations_id=$program_recommendations_id;
            $newUserCourseProgram->user_id=$user->id;
            $newUserCourseProgram->course_id=$request->course_id;
            $newUserCourseProgram->save();
        }
        
            $ProgramQuestions=programRecommendationQuestion::where('program_recommendations_id','=',$program_recommendations_id)->pluck('id')->toArray();
            $userAnswers=UserCourseProgramRecommendationAnswers::where('user_course_program_recommendations_id',$newUserCourseProgram->id)->pluck('program_recommendation_questions_id')->toArray();
            foreach ($ProgramQuestions as $key => $ProgramQuestion) {
                # code...
                $questionAnswer='questionAnswer-'.$ProgramQuestion; //Answer

                if(!in_array($ProgramQuestion,$userAnswers)){
                $newUserProgramAnswer=new UserCourseProgramRecommendationAnswers();
                }
                else{
                    $newUserProgramAnswer=UserCourseProgramRecommendationAnswers::where('user_course_program_recommendations_id',$newUserCourseProgram->id)
                    ->where('program_recommendation_questions_id',$ProgramQuestion)->first();

                }
                $newUserProgramAnswer->user_course_program_recommendations_id=$newUserCourseProgram->id;
                $newUserProgramAnswer->program_recommendation_questions_id=$ProgramQuestion;
                if(isset($request->$questionAnswer))
                {                
                    $newUserProgramAnswer->answer=$request->$questionAnswer;
                }
                else
                {            
                    $newUserProgramAnswer->answer=null;                
                }
                $newUserProgramAnswer->save();

            }
         
        return redirect()->back()->withFlashSuccess(trans('alerts.backend.general.created'));

    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }
}
