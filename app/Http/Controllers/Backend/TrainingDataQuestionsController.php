<?php

namespace App\Http\Controllers\Backend;

use Illuminate\Http\Request;

use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Gate;
use App\Models\TrainingDataQuestions;
use App\Models\TrainingDataQuestionsOptions;

class TrainingDataQuestionsController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        $questions=TrainingDataQuestions::all();
        $training_data_id=$request->training_data_id;
        return view('backend.trainingDataQuestion.index',compact('questions','training_data_id'));


        //
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create(Request $request)
    {
        //
        $training_data_id=$request->training_data_id;

        
        return view('backend.trainingDataQuestion.create',compact('training_data_id'));

    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        // dd($request->all());

        if (!Gate::allows('question_create')) {
            return abort(401);
        }
        
        $question = TrainingDataQuestions::create($request->only('question','question_ar','type','training_data_id','choose_number'));
        

        for ($q = 1; $q <= $request->chooseNumber; $q++) {
            $option = $request->input('option_text_' . $q, '');
           
            if ($option != '') {
                TrainingDataQuestionsOptions::create([
                    'training_data_questions_id' => $question->id,
                    'option_text' => $option,
                    
                ]);
            }
        }

        return redirect()->route('admin.trainingDataQuestions.index')->withFlashSuccess(trans('alerts.backend.general.created'));
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
        // dd($id);
        $trainingDataQuestion=TrainingDataQuestions::findOrFail($id);
       
        return view('backend.trainingDataQuestion.edit',compact('trainingDataQuestion'));

        
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
        if (!Gate::allows('question_create')) {
            return abort(401);
        }
        
        $question = TrainingDataQuestions::findOrFail($id);
        $question->update($request->only('question','question_ar','type','training_data_id','choose_number'));
        
        $options=[];
        for ($q = 1; $q <= $request->chooseNumber; $q++) {
            $option = $request->input('option_text_' . $q, '');
           
            if ($option != '') {
                if(isset($question->options[$q-1])){
                    $question->options[$q-1]->update([
                        'option_text' => $option
                    ]);
                }
                else{
                TrainingDataQuestionsOptions::create([
                    'training_data_questions_id' => $question->id,
                    'option_text' => $option,
                    
                ]);
            }
            
                
            }
        }
        //if number of old options > current ===>delete old
        if(count($question->options)>$request->chooseNumber){
            for ($i=$request->chooseNumber; $i <count($question->options) ; $i++) { 
                # code...
                $question->options[$i]->delete();
            }
        }
        return redirect()->route('admin.trainingDataQuestions.index')->withFlashSuccess(trans('alerts.backend.general.created'));
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
        if (!Gate::allows('question_delete')) {
            return abort(401);
        }
        $question = TrainingDataQuestions::findOrFail($id);
        $question->delete();

        return redirect()->route('admin.trainingDataQuestions.index')->withFlashSuccess(trans('alerts.backend.general.deleted'));
    }
}
