<?php

namespace App\Http\Controllers\Backend\Admin;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Http\Controllers\Traits\FileUploadTrait;
use App\Models\Course;
use App\Models\Guest;
use DataTables;
class GuestController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    use FileUploadTrait;
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return view('backend.guests.index');

        //
    }
    public function getData(Request $request)
    {
        $has_view = false;
        $has_delete = false;
        $has_edit = false;
        $guests = Guest::orderBy('created_at', 'desc')->get();


        return DataTables::of($guests)
            ->addIndexColumn()
            ->addColumn('actions', function ($q) use ($request) {
                $view = "";
                $edit = "";
                $delete = "";

                $edit = view('backend.datatable.action-edit')
                    ->with(['route' => route('admin.guests.edit', ['guests_option' => $q->id])])
                    ->render();
                $view .= $edit;

                $delete = view('backend.datatable.action-delete')
                    ->with(['route' => route('admin.guests.destroy', ['guests_option' => $q->id])])
                    ->render();
                $view .= $delete;
                return $view;

            })
            ->editColumn('courses', function ($q) {  
                $str=' '; 
                foreach ($q->courses as $key2 => $course) {
                    # code...
                   
                    $str.=(app()->getLocale()=="ar")?$course->title_ar:$course->title;
                   
                    $str.=' , ';
            
                    
                }  
                      
                        return $str;                           
                    })
            ->rawColumns( ['actions','status'])
            ->make();
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
        if(app()->getLocale()=="ar"){
            $courses = Course::latest()->has('category')->ofTeacher()->get()->pluck('title_ar', 'id');
           
        }
        else
        {
            $courses = Course::latest()->has('category')->ofTeacher()->get()->pluck('title', 'id');
        }
        return view('backend.guests.create',compact('courses'));
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
    

        $request = $this->saveFiles($request);

        $guest = Guest::create($request->all());
  
        $guest->courses()->attach($request->course_id);
        return redirect()->route('admin.guests.index')->withFlashSuccess(trans('alerts.backend.general.created'));

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
        $guest = Guest::findOrFail($id);
        if(app()->getLocale()=="ar"){
            $courses = Course::latest()->has('category')->ofTeacher()->get()->pluck('title_ar', 'id')->prepend('Please select', '');
           
        }
        else
        {
            $courses = Course::latest()->has('category')->ofTeacher()->get()->pluck('title', 'id')->prepend('Please select', '');
        }
        return view('backend.guests.edit', compact('guest','courses'));
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
        $guest = Guest::findOrFail($id);
        $request = $this->saveFiles($request);
        $guest->update($request->all());

        $guest->courses()->sync($request->course_id);
        return redirect()->route('admin.guests.index')->withFlashSuccess(trans('alerts.backend.general.updated'));


    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {

        $guest = Guest::findOrFail($id);
        $guest->delete();

        return redirect()->route('admin.guests.index')->withFlashSuccess(trans('alerts.backend.general.deleted'));
    }
}
