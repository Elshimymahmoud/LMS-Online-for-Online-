<?php

namespace App\Http\Controllers\Backend;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\programRecommendation;
use App\Models\programRecommendationQuestion;

class programRecommendationQuestionsController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        //
        $programRec_id=$request->programRec_id;
        $programRecommendation=programRecommendation::findOrFail($programRec_id);
        return view('backend.programRecommendationQuestions.index',compact('programRecommendation'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create(Request $request)
    {
        //
        $program_id=$request->programRec_id;
        return view('backend.programRecommendationQuestions.create',compact('program_id'));
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
            'program_recommendations_id' => 'required',

        ]);
        $question=programRecommendationQuestion::create($request->all());
        
        return redirect()->route('admin.programRecommendationQuestions.index',['programRec_id' => $request->program_recommendations_id])->withFlashSuccess(trans('alerts.backend.general.created'));
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
        $programQuestion=programRecommendationQuestion::findOrFail($id);
        $program_id=$programQuestion->program_recommendations_id;
        return view('backend.programRecommendationQuestions.edit',compact('program_id','programQuestion'));
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
        $this->validate($request, [
            'question' => 'required',
            'question_ar' => 'required',
            'program_recommendations_id' => 'required',

        ]);
        $requestQuestionData=array_slice($request->all(), 2);
        $question=programRecommendationQuestion::where('id',$id)->update($requestQuestionData);
        
        return redirect()->route('admin.programRecommendationQuestions.index',['programRec_id' => $request->program_recommendations_id])->withFlashSuccess(trans('alerts.backend.general.created'));
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
        $question = programRecommendationQuestion::findOrFail($id);
        $program_id= $question->program_recommendations_id;

        $question->delete();
        return redirect()->route('admin.programRecommendationQuestions.index',['programRec_id'=>$program_id])->withFlashSuccess(trans('alerts.backend.general.deleted'));
    }
}
