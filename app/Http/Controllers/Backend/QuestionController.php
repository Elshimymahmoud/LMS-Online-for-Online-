<?php

namespace App\Http\Controllers\Backend;

use App\Models\Rate;
use App\Models\RateQuestion;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class QuestionController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        //
        $rate_id=$request->rate_id;
        $rate=Rate::findOrFail($rate_id);
        return view('backend.rateQuestions.index',compact('rate'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create(Request $request)
    {
        $rate_id=$request->rate_id;
        return view('backend.rateQuestions.question',compact('rate_id'));
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
            'rate_id' => 'required',

        ]);
        $question=RateQuestion::create($request->all());
        
        return redirect()->route('admin.question.index',['rate_id' => $request->rate_id])->withFlashSuccess(trans('alerts.backend.general.created'));
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
        $rateQuestion=RateQuestion::findOrFail($id);
        $rate_id=$rateQuestion->rate_id;
        return view('backend.rateQuestions.edit',compact('rate_id','rateQuestion'));
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
            'rate_id' => 'required',

        ]);
        $requestQuestionData=array_slice($request->all(), 2);
        $question=RateQuestion::where('id',$id)->update($requestQuestionData);
        
        return redirect()->route('admin.question.index',['rate_id' => $request->rate_id])->withFlashSuccess(trans('alerts.backend.general.created'));
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
        $question = RateQuestion::findOrFail($id);
        $rate_id= $question->rate_id;

        $question->delete();
        return redirect()->route('admin.question.index',['rate_id'=>$rate_id])->withFlashSuccess(trans('alerts.backend.general.deleted'));
    }
}
