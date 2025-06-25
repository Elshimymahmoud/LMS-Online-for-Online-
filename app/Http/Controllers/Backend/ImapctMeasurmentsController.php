<?php

namespace App\Http\Controllers\Backend;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\ImpactMeasurement;

class ImapctMeasurmentsController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
        $impacts = ImpactMeasurement::orderBy('id', 'desc')->get();
            

        return view('backend.impactMeasurment.index', compact('impacts'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('backend.impactMeasurment.create');

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

        $impact = ImpactMeasurement::create($request->all());
        if($request->course_id!=null){
            $courseImpact=new CourseImpactMeasurement();
            $courseImpact->impact_measurement_id=$impact->id;
            $courseImpact->course_id=$request->course_id;
            $courseImpact->save();
        }
        return redirect()->route('admin.impact.index')->withFlashSuccess(trans('alerts.backend.general.created'));

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
        $impact = ImpactMeasurement::findOrFail($id);

        return view('backend.impactMeasurment.edit', compact('impact'));
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
        ImpactMeasurement::where('id', $id)
            ->update([
                //   'course_id'=>$request->course_id,
                'name' => $request->name,
                'name_ar' => $request->name_ar,
                'type'=>$request->type

            ]);
        return redirect()->route('admin.impact.index')->withFlashSuccess(trans('alerts.backend.general.updated'));
    
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $impact = ImpactMeasurement::findOrFail($id);
        $impact->delete();
        return redirect()->route('admin.impact.index')->withFlashSuccess(trans('alerts.backend.general.deleted'));
        //
    }
}
