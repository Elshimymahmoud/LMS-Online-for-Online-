<?php

namespace App\Http\Controllers\Backend;

use App\Models\RateType;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class RateTypeController extends Controller
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
        return view('backend.rateType.create');

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
            
            'rate_type' => 'required|unique:rate_types,rate_type,NULL,id,rate_type_ar,' . $request->rate_type_ar,
            'rate_type_ar' => 'required|unique:rate_types,rate_type_ar,NULL,id,rate_type,' . $request->rate_type,
           

        ]);
   
        $rateType=new RateType();
        $rateType->rate_type=$request->rate_type;
        $rateType->rate_type_ar=$request->rate_type_ar;
        $rateType->save();
        return redirect()->back();


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
