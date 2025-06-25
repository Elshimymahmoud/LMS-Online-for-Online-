<?php

namespace App\Http\Controllers\Backend;

use App\Models\TrainingData;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class TrainingDataController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
        $AllTrainingData = TrainingData::orderBy('id', 'desc')->get();
            

        return view('backend.trainingData.index', compact('AllTrainingData'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
       

        return view('backend.trainingData.create');

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
        $this->validate($request, [

            'name' => 'required',
            'name_ar' => 'required',
        ]);

        $trainingData = TrainingData::create($request->all());
    
        return redirect()->route('admin.trainingData.index')->withFlashSuccess(trans('alerts.backend.general.created'));

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
        $trainingData=TrainingData::findOrFail($id);
        return view('backend.trainingData.edit',compact('trainingData'));


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
        TrainingData::where('id', $id)
        ->update([
            //   'course_id'=>$request->course_id,
            'name' => $request->name,
            'name_ar' => $request->name_ar,
            

        ]);
       

    return redirect()->route('admin.trainingData.index')->withFlashSuccess(trans('alerts.backend.general.updated'));
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
        $TrainingData = TrainingData::findOrFail($id);
        $TrainingData->delete();
        return redirect()->route('admin.trainingData.index')->withFlashSuccess(trans('alerts.backend.general.deleted'));
    }
}
