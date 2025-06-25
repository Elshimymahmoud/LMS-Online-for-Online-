<?php

namespace App\Http\Controllers\Backend\Admin;
use App\Http\Controllers\Controller;
use App\Models\Course;
use App\Models\course_place;
use App\Models\course_place_unit;

use App\Http\Controllers\Traits\FileUploadTrait;

use App\Http\Requests\Admin\StoreCourse_clintsRequest;
use App\Http\Requests\Admin\UpdateCourse_clintsRequest;
use App\Models\Location;
use Illuminate\Http\Request;
use Yajra\DataTables\DataTables;




class courses_placeController extends Controller
{
    //
    public function index()
    {
        // 
        $course_place = course_place::all();
        $course_place_unit = course_place_unit::all();
        
        return view('backend.courses_place.index', compact('course_place'));

    }

    public function getData(Request $request)
    {
        $has_view = false;
        $has_delete = false;
        $has_edit = false;
        $course_place = "";


        $course_place = course_place::orderBy('created_at','desc')->get();




        return DataTables::of($course_place)
            ->addIndexColumn()
            ->addColumn('actions', function ($q) use ( $request) {
                $view = "";
                $edit = "";
                $delete = "";

                    $edit = view('backend.datatable.action-edit')
                        ->with(['route' => route('admin.courses_place.edit', ['category' => $q->id])])
                        ->render();
                    $view .= $edit;

                    $delete = view('backend.datatable.action-delete')
                        ->with(['route' => route('admin.courses_place.destroy', ['category' => $q->id])])
                        ->render();
                    $view .= $delete;

                return $view;

            })
            ->rawColumns(['actions'])
            ->make();
    }

    /**
     * Show the form for creating new Category.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //get all locations that are on site
        if (app()->getLocale() == 'ar') {
            $locations = Location::where('courses_type', '3')->pluck('name_ar', 'id');
        } else {
            $locations = Location::where('courses_type', '3')->pluck('name', 'id');
        }
        return view('backend.courses_place.create', compact('locations'));
    }

    /**
     * Store a newly created Category in storage.
     *
     * @param  \App\Http\Requests\Admin\StoreClientsRequest  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        // $request = $this->saveFiles($request);

        course_place::create($request->all());


        return redirect()->route('admin.courses_place.index')->withFlashSuccess(trans('alerts.backend.hall.created'));
    }


    /**
     * Show the form for editing Category.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $course_place = course_place::findOrFail($id);
        if (app()->getLocale() == 'ar') {
            $locations = Location::where('courses_type', '3')->pluck('name_ar', 'id');
        } else {
            $locations = Location::where('courses_type', '3')->pluck('name', 'id');
        }
        return view('backend.courses_place.edit', compact('course_place', 'locations'));
    }

    /**
     * Update Category in storage.
     *
     * @param  \App\Http\Requests\Admin\UpdateClientsRequest  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        // $request = $this->saveFiles($request);

        $course_place = course_place::findOrFail($id);
        $course_place->update($request->all());

        return redirect()->route('admin.courses_place.index')->withFlashSuccess(trans('alerts.backend.hall.updated'));
    }



    /**
     * Remove Category from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        // Find the hall
        $courses_place = course_place::findOrFail($id);

        // Check if the hall has any groups
        if ($courses_place->groups->count() > 0) {
            return redirect()->route('admin.courses_place.index')->withFlashDanger(__('alerts.backend.hall.group_remove_err'));
        }

        // Delete the hall
        $courses_place->delete();

        return redirect()->route('admin.courses_place.index')->withFlashSuccess(trans('alerts.backend.hall.deleted'));
    }

    /**
     * Delete all selected Category at once.
     *
     * @param Request $request
     */
    public function massDestroy(Request $request)
    {

        if ($request->input('ids')) {
            $entries = course_place::whereIn('id', $request->input('ids'))->get();

            foreach ($entries as $entry) {
                $entry->delete();
            }
        }
    }

   
}
 