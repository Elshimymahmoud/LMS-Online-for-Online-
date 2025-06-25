<?php

namespace App\Http\Controllers\Backend;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\UserCourseImpactMeasurement;
use App\Models\ImpactMeasurementQuestion;
use App\Models\UserCourseImpactMeasurementAnswer;

class AnswerImpactController extends Controller
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
        $impact_measurement_id=$request->impact_measurement_id;

        $user=auth()->user();
        $userCourseimpactmeasurements=UserCourseImpactMeasurement::where('user_id',$user->id)->pluck('impact_measurement_id')->toArray();
        
        // dd($UserCourseRates);
        $newUserCourseImpact=UserCourseImpactMeasurement::where('user_id',$user->id)->where('impact_measurement_id',$impact_measurement_id)->first();
        if(!in_array($impact_measurement_id,$userCourseimpactmeasurements)){
            $newUserCourseImpact=new UserCourseImpactMeasurement();
            $newUserCourseImpact->impact_measurement_id=$impact_measurement_id;
            $newUserCourseImpact->user_id=$user->id;
            $newUserCourseImpact->course_id=$request->course_id;
            $newUserCourseImpact->save();
        }
        
            $ImpactQuestions=ImpactMeasurementQuestion::where('impact_measurement_id','=',$impact_measurement_id)->pluck('id')->toArray();
            $userAnswers=UserCourseImpactMeasurementAnswer::where('user_course_impact_id',$newUserCourseImpact->id)->pluck('impact_questions_id')->toArray();
            foreach ($ImpactQuestions as $key => $ImpactQuestion) {
                # code...
                $questionAnswer='questionAnswer-'.$ImpactQuestion; //Answer

                if(!in_array($ImpactQuestion,$userAnswers)){
                $newUserImpactAnswer=new UserCourseImpactMeasurementAnswer();
                }
                else{
                    $newUserImpactAnswer=UserCourseImpactMeasurementAnswer::where('user_course_impact_id',$newUserCourseImpact->id)
                    ->where('impact_questions_id',$ImpactQuestion)->first();

                }
                $newUserImpactAnswer->user_course_impact_id=$newUserCourseImpact->id;
                $newUserImpactAnswer->impact_questions_id=$ImpactQuestion;
                if(isset($request->$questionAnswer))
                {                
                    $newUserImpactAnswer->answer=$request->$questionAnswer;
                }
                else
                {            
                    $newUserImpactAnswer->answer=null;                
                }
                $newUserImpactAnswer->save();

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
