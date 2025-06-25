<?php

namespace App\Http\Controllers\Backend\Admin;
use App\Http\Controllers\Controller;
use App\Models\course_place;
use App\Models\course_place_unit;

use App\Http\Controllers\Traits\FileUploadTrait;

use App\Http\Requests\Admin\StoreCourse_clintsRequest;
use App\Http\Requests\Admin\UpdateCourse_clintsRequest;
use Illuminate\Http\Request;
use Yajra\DataTables\DataTables;

class CoursePlaceUnit extends Controller
{
    //
    public function index()
    {
        // 
        $course_place = course_place::pluck('name_ar', 'id');

        $course_unit = course_place_unit::all();
        
        return view('backend.courses_place.unite', compact('course_unit','course_place'));

    }

    public function getData(Request $request)
    {
        $has_view = false;
        $has_delete = false;
        $has_edit = false;
        $course_unit = "";


        $course_unit = course_place_unit::orderBy('created_at','desc')->get();




        return DataTables::of($course_unit)
            ->addIndexColumn()
            ->addColumn('actions', function ($q) use ( $request) {
                $view = "";
                $edit = "";
                $delete = "";

                    $edit = view('backend.datatable.action-edit')
                        ->with(['route' => route('admin.courses_place_unit.edit', ['category' => $q->id])])
                        ->render();
                    $view .= $edit;

                    $delete = view('backend.datatable.action-delete')
                        ->with(['route' => route('admin.courses_place_unit.destroy', ['category' => $q->id])])
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

        return view('backend.courses_place.create');
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

        course_place_unit::create($request->all());


        return redirect()->route('admin.courses_place_unit.index')->withFlashSuccess(trans('alerts.backend.general.created'));
    }


    /**
     * Show the form for editing Category.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $course_unites = course_place_unit::findOrFail($id);
        $course_place = course_place::pluck('name_ar', 'id');


        return view('backend.courses_place.unite', compact('course_unites','course_place'));
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

        $course_unit = course_place_unit::findOrFail($id);
        $course_unit->update($request->all());

        return redirect()->route('admin.courses_place_unit.index')->withFlashSuccess(trans('alerts.backend.general.updated'));
    }



    /**
     * Remove Category from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {

        $course_unit = course_place_unit::findOrFail($id);
        $course_unit->delete();

        return redirect()->route('admin.courses_place_unit.index')->withFlashSuccess(trans('alerts.backend.general.deleted'));
    }

    /**
     * Delete all selected Category at once.
     *
     * @param Request $request
     */
    public function massDestroy(Request $request)
    {

        if ($request->input('ids')) {
            $entries = course_place_unit::whereIn('id', $request->input('ids'))->get();

            foreach ($entries as $entry) {
                $entry->delete();
            }
        }
    }

}
