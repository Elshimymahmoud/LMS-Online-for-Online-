<?php

namespace App\Http\Controllers\Backend\Admin;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Http\Requests\Admin\StoreTypeRequest;
use App\Http\Requests\Admin\UpdateTypesRequest;
use App\Models\CourseClassification;
use App\Models\Type;
use DataTables;

class CourseClassificationController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
        return view('backend.course_classifications.index');

    }
    public function getData(Request $request)
    {
        $has_view = false;
        $has_delete = false;
        $has_edit = false;
        $courseTypes = CourseClassification::orderBy('created_at', 'desc')->get();

        return DataTables::of($courseTypes)
            ->addIndexColumn()
            ->addColumn('actions', function ($q) use ($request) {
                $view = "";
                $edit = "";
                $delete = "";

                $edit = view('backend.datatable.action-edit')
                    ->with(['route' => route('admin.course_classification.edit', ['types_option' => $q->id])])
                    ->render();
                $view .= $edit;

                $delete = view('backend.datatable.action-delete')
                    ->with(['route' => route('admin.course_classification.destroy', ['types_option' => $q->id])])
                    ->render();
                $view .= $delete;
                return $view;

            })
            ->editColumn('status', function ($q) {
                $html = html()->label(html()->checkbox('')->id($q->id)
                ->checked(($q->status == 1) ? true : false)->class('switch-input')->attribute('data-id', $q->id)->value(($q->status == 1) ? 1 : 0).'<span class="switch-label"></span><span class="switch-handle"></span>')->class('switch switch-lg switch-3d switch-primary');
                return $html;
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
      
        return view('backend.course_classifications.create');
    }


    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(StoreTypeRequest $request)
    {
       
        CourseClassification::create($request->all());

        return redirect()->route('admin.course_classification.index')->withFlashSuccess(trans('alerts.backend.general.created'));
        //
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
        
        $type = CourseClassification::findOrFail($id);
        
        return view('backend.course_classifications.edit', compact('type'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(UpdateTypesRequest $request, $id)
    {
        //
        $type = CourseClassification::findOrFail($id);
        
        $type->update($request->all());

        return redirect()->route('admin.course_classification.index')->withFlashSuccess(trans('alerts.backend.general.updated'));
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {

        $type = CourseClassification::findOrFail($id);

        if ($type->courses->count() > 0) {
            return redirect()->route('admin.course_classification.index')->withFlashDanger(trans('alerts.backend.classification.group_remove_err'));
        }
        $type->delete();

        return redirect()->route('admin.course_classification.index')->withFlashSuccess(trans('alerts.backend.general.deleted'));
    }

    /**
     * Delete all selected Testimonial at once.
     *
     * @param Request $request
     */
    public function massDestroy(Request $request)
    {

        if ($request->input('ids')) {
            $entries = CourseClassification::whereIn('id', $request->input('ids'))->get();

            foreach ($entries as $entry) {
                $entry->delete();
            }
        }
    }
    public function status($id)
    {
        $type = CourseClassification::findOrFail($id);
        if ($type->status == 1) {
            $type->status = 0;
        } else {
            $type->status = 1;
        }
        $type->save();

        return back()->withFlashSuccess(trans('alerts.backend.general.updated'));
    }
    public function updateStatus()
    {
        $type = CourseClassification::findOrFail(request('id'));
        $type->status = $type->status == 1? 0 : 1;
        $type->save();
    }
}
