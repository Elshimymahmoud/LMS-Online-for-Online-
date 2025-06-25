<?php

namespace App\Http\Controllers\Backend;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\ImpactMeasurement;
use App\Models\ImpactMeasurementQuestion;

class ImpactQuestionsController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        //
        $impact_id=$request->impact_id;
        $impact=ImpactMeasurement::findOrFail($impact_id);
        return view('backend.ImpactQuestions.index',compact('impact'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create(Request $request)
    {
        $impact_id=$request->impact_id;
        return view('backend.ImpactQuestions.create',compact('impact_id'));
       
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
        $this->validate($request, [
            'question' => 'required',
            'question_ar' => 'required',
            'impact_measurement_id' => 'required',

        ]);
        $question=ImpactMeasurementQuestion::create($request->all());
        
        return redirect()->route('admin.ImpactQuestions.index',['impact_id' => $request->impact_measurement_id])->withFlashSuccess(trans('alerts.backend.general.created'));
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
        $impactQuestion=ImpactMeasurementQuestion::findOrFail($id);
        $impact_id=$impactQuestion->impact_measurement_id;
        return view('backend.ImpactQuestions.edit',compact('impact_id','impactQuestion'));
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
        $this->validate($request, [
            'question' => 'required',
            'question_ar' => 'required',
            'impact_measurement_id' => 'required',

        ]);
        $requestQuestionData=array_slice($request->all(), 2);
        $question=ImpactMeasurementQuestion::where('id',$id)->update($requestQuestionData);
        
        return redirect()->route('admin.ImpactQuestions.index',['impact_id' => $request->impact_measurement_id])->withFlashSuccess(trans('alerts.backend.general.created'));
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
        $question = ImpactMeasurementQuestion::findOrFail($id);
        $impact_id= $question->impact_measurement_id;

        $question->delete();
        return redirect()->route('admin.ImpactQuestions.index',['impact_id'=>$impact_id])->withFlashSuccess(trans('alerts.backend.general.deleted'));
    }
}
