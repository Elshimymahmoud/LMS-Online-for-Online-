<?php

namespace App\Http\Controllers;

use App\Models\RequestCourse;
use Illuminate\Http\Request;

class RequestCourseController extends Controller
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
        $newRequest=new RequestCourse();
        $newRequest=$newRequest->create($request->all());
       if($newRequest){
       if( session('locale') == 'ar')
       $msg='تم ارسال الطلب بنجاح';
        else
        $msg='Request Send Successfly';
       }
       else{
        if( session('locale') == 'ar')
        $msg='عذرا هناك خطأ في ارسال الطلب';
        else
        $msg='Sorry, Error in send request';
        

       }
       return redirect()->back()->with('flash_success', $msg);

       
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
