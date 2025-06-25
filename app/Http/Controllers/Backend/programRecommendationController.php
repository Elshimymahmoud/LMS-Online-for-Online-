<?php

namespace App\Http\Controllers\Backend;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\programRecommendation;
use App\Models\CourseProgramRecommendation;
class programRecommendationController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
        $programRecommendations = programRecommendation::orderBy('id', 'desc')->get();
            

        return view('backend.programRecommendation.index', compact('programRecommendations'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('backend.programRecommendation.create');

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

            'name' => 'required',
            'name_ar' => 'required',
        ]);

        $program = programRecommendation::create($request->all());
        if($request->course_id!=null){
            $courseImpact=new CourseProgramRecommendation();
            $courseImpact->program_recommendations_id=$program->id;
            $courseImpact->course_id=$request->course_id;
            $courseImpact->save();
        }
        return redirect()->route('admin.programRecommendation.index')->withFlashSuccess(trans('alerts.backend.general.created'));
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
        
        $program = programRecommendation::findOrFail($id);
        dd($program);

        return view('backend.programRecommendation.edit', compact('program'));
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
        programRecommendation::where('id', $id)
        ->update([
            //   'course_id'=>$request->course_id,
            'name' => $request->name,
            'name_ar' => $request->name_ar,
           

        ]);
    return redirect()->route('admin.programRecommendation.index')->withFlashSuccess(trans('alerts.backend.general.updated'));
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
        $program = programRecommendation::findOrFail($id);
        $program->delete();
        return redirect()->route('admin.programRecommendation.index')->withFlashSuccess(trans('alerts.backend.general.deleted'));
    }
}
