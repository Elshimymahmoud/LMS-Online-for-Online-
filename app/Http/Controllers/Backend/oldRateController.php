<?php

namespace App\Http\Controllers\Backend;

use App\Models\Rate;
use App\Models\Type;
use App\Models\Course;
use App\Models\RateType;
use App\Models\CourseRate;
use Illuminate\Http\Request;
use Illuminate\Validation\Rule;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Validator;

class RateController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
        $rates = Rate::orderBy('created_at', 'desc')->with('course')->with('course.type')

            ->get();

        return view('backend.rates.index', compact('rates'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //

        // $course_types= Type::pluck('name','id')->prepend('Please select', '');
        // $course_types_ar= Type::pluck('name_ar','id')->prepend('Please select', '');
        // $courses= Course::pluck('title','id')->prepend('Please select', '');
        // $courses_ar= Course::pluck('title_ar','id')->prepend('Please select', '');


        // $rate_types= RateType::pluck('rate_type','id')->prepend('Please select', '');
        // $rate_types_ar= RateType::pluck('rate_type_ar','id')->prepend('Please select', '');


        return view('backend.rates.create');
    }
    public function createCourseRate($course_id){
        return view('backend.rates.create',compact('course_id'));

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

            // 'course_id' => 'required|unique:rates,course_id,NULL,id,rate_types_id,' . $request->rate_types_id,
            // 'rate_types_id' => 'required|unique:rates,rate_types_id,NULL,id,course_id,' . $request->course_id,
            // 'course_id' => 'required',
            'name' => 'required',
            'name_ar' => 'required',


        ]);

   
        $rate = Rate::create($request->all());
        if($request->course_id!=null){
            $courseRate=new CourseRate();
            $courseRate->rate_id=$rate->id;
            $courseRate->course_id=$request->course_id;
            $courseRate->save();
        }
        return redirect()->route('admin.rate.index')->withFlashSuccess(trans('alerts.backend.general.created'));
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

    public function userQuestion($rate_id)
    {
        $rate = Rate::where('id', $rate_id)->with('course')
            ->with('RateQuestion')->with('UserCourseRate')->with('UserCourseRate.Answer')
            ->with('UserCourseRate.user')
            ->with('UserCourseRate.Answer.RateQuestion')
            ->first();

        return  view('backend.rates.showUserQuestion', compact('rate'));
    }

    public function showCourseRate($course_id)
    {
        //
        $rates = Rate::select('rates.*')->join('course_rates', 'course_rates.rate_id', '=', 'rates.id')->where('course_rates.course_id', $course_id)->with('course')
            ->with('RateQuestion')->with('UserCourseRate')->with('UserCourseRate.Answer')
            ->with('UserCourseRate.Answer.RateQuestion')
            ->get();

        $course=Course::where('id',$course_id)->first();

        return view('backend.rates.show', compact('rates','course'));
    }


    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {

        $rate = Rate::findOrFail($id);

        // $courses= Course::pluck('title','id')->prepend($rate->course->title, $rate->course->id);
        // $courses_ar= Course::pluck('title_ar','id')->prepend($rate->course->title_ar,$rate->course->id);

        // $rate_types= RateType::pluck('rate_type','id')->prepend($rate->RateTypes->rate_type,$rate->RateTypes->id);
        // $rate_types_ar= RateType::pluck('rate_type_ar','id')->prepend($rate->RateTypes->rate_type_ar,$rate->RateTypes->id);


        return view('backend.rates.edit', compact('rate'));

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

        Rate::where('id', $id)
            ->update([
                //   'course_id'=>$request->course_id,
                'name' => $request->name,
                'name_ar' => $request->name_ar,

            ]);
        return redirect()->route('admin.rate.index')->withFlashSuccess(trans('alerts.backend.general.updated'));
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

        $rate = Rate::findOrFail($id);
        $rate->delete();
        return redirect()->route('admin.rate.index')->withFlashSuccess(trans('alerts.backend.general.deleted'));
    }
}
