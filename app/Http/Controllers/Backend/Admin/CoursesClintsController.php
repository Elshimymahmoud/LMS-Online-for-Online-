<?php

namespace App\Http\Controllers\Backend\Admin;
use App\Http\Controllers\Controller;
use App\Models\Course_clints;
use App\Http\Controllers\Traits\FileUploadTrait;

use App\Http\Requests\Admin\StoreCourse_clintsRequest;
use App\Http\Requests\Admin\UpdateCourse_clintsRequest;
use Illuminate\Http\Request;
use Yajra\DataTables\DataTables;



// namespace App\Http\Controllers\Backend\Admin;

// use App\Http\Controllers\Controller;
// use App\Http\Controllers\Traits\FileUploadTrait;
use App\Http\Requests\Admin\StoreClientsRequest;
use App\Http\Requests\Admin\UpdateClientsRequest;
use App\Models\Client;
// use Illuminate\Http\Request;
// use Yajra\DataTables\DataTables;

class CoursesClintsController extends Controller
{ 
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        // 
        $courses_clints = Course_clints::all();
        return view('backend.courses_clints.index', compact('courses_clints'));

    }

    public function getData(Request $request)
    {
        $has_view = false;
        $has_delete = false;
        $has_edit = false;
        $courses_clints = "";


        $courses_clints = Course_clints::orderBy('created_at','desc')->get();




        return DataTables::of($courses_clints)
            ->addIndexColumn()
            ->addColumn('actions', function ($q) use ( $request) {
                $view = "";
                $edit = "";
                $delete = "";

                    $edit = view('backend.datatable.action-edit')
                        ->with(['route' => route('admin.courses_clints.edit', ['category' => $q->id])])
                        ->render();
                    $view .= $edit;

                    $delete = view('backend.datatable.action-delete')
                        ->with(['route' => route('admin.courses_clints.destroy', ['category' => $q->id])])
                        ->render();
                    $view .= $delete;

                return $view;

            })
            ->editColumn('logo',function ($q){
                if($q->logo != null){
                    return  '<img src="'.asset('storage/uploads/'.$q->logo).'" height="50px">';
                }
                return 'N/A';
            })
            ->editColumn('status', function ($q) {
                $html = html()->label(html()->checkbox('')->id($q->id)
                ->checked(($q->status == 1) ? true : false)->class('switch-input')->attribute('data-id', $q->id)->value(($q->status == 1) ? 1 : 0).'<span class="switch-label"></span><span class="switch-handle"></span>')->class('switch switch-lg switch-3d switch-primary');
                return $html;
            })
            ->rawColumns(['actions','logo','status'])
            ->make();
    }

    /**
     * Show the form for creating new Category.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {

        return view('backend.Course_clints.create');
    }

    /**
     * Store a newly created Category in storage.
     *
     * @param  \App\Http\Requests\Admin\StoreClientsRequest  $request
     * @return \Illuminate\Http\Response
     */
    public function store(StoreCourse_clintsRequest $request)
    {
        // $request = $this->saveFiles($request);

        Course_clints::create($request->all());


        return redirect()->route('admin.courses_clints.index')->withFlashSuccess(trans('alerts.backend.general.created'));
    }


    /**
     * Show the form for editing Category.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $courses_clint = Course_clints::findOrFail($id);

        return view('backend.courses_clints.index', compact('courses_clint'));
    }

    /**
     * Update Category in storage.
     *
     * @param  \App\Http\Requests\Admin\UpdateClientsRequest  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(UpdateCourse_clintsRequest $request, $id)
    {
        // $request = $this->saveFiles($request);

        $courses_clints = Course_clints::findOrFail($id);
        $courses_clints->update($request->all());

        return redirect()->route('admin.courses_clints.index')->withFlashSuccess(trans('alerts.backend.general.updated'));
    }



    /**
     * Remove Category from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {

        $courses_clints = Course_clints::findOrFail($id);
        $courses_clints->delete();

        return redirect()->route('admin.courses_clints.index')->withFlashSuccess(trans('alerts.backend.general.deleted'));
    }

    /**
     * Delete all selected Category at once.
     *
     * @param Request $request
     */
    public function massDestroy(Request $request)
    {

        if ($request->input('ids')) {
            $entries = Course_clints::whereIn('id', $request->input('ids'))->get();

            foreach ($entries as $entry) {
                $entry->delete();
            }
        }
    }

    public function status($id)
    {
        $slide = Course_clints::findOrFail($id);
        if ($slide->status == 1) {
            $slide->status = 0;
        } else {
            $slide->status = 1;
        }
        $slide->save();

        return back()->withFlashSuccess(trans('alerts.backend.general.updated'));
    }

    /**
     * Update client status
     *
     * @param \Illuminate\Http\Request $request
     * @return \Illuminate\Http\Response
     **/
    public function updateStatus()
    {
        $courses_clints = Course_clints::findOrFail(request('id'));
        $courses_clints->status = $courses_clints->status == 1? 0 : 1;
        $courses_clints->save();
    }
}
