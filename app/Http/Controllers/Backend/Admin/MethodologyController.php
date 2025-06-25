<?php

namespace App\Http\Controllers\Backend\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\Admin\StoreMethodologiesRequest;
use App\Http\Requests\Admin\UpdateMethodologiesRequest;
use Illuminate\Support\Facades\File;
use App\Http\Controllers\Traits\FileUploadTrait;
use App\Models\Methodology;
use Illuminate\Http\Request;
use Yajra\DataTables\DataTables;

class MethodologyController extends Controller
{
    use FileUploadTrait;

    /**
     * Display a listing of Methodology.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return view('backend.methodologies.index');
    }


    /**
     * Display a listing of Methodologies via ajax DataTable.
     *
     * @return \Illuminate\Http\Response
     */
    public function getData(Request $request)
    {
        $has_view = false;
        $has_delete = false;
        $has_edit = false;
        $methodologies = Methodology::orderBy('created_at', 'desc')->get();


        return DataTables::of($methodologies)
            ->addIndexColumn()
            ->addColumn('actions', function ($q) use ($request) {
                $view = "";
                $edit = "";
                $delete = "";

                $edit = view('backend.datatable.action-edit')
                    ->with(['route' => route('admin.methodologies.edit', ['methodologies_option' => $q->id])])
                    ->render();
                $view .= $edit;

                $delete = view('backend.datatable.action-delete')
                    ->with(['route' => route('admin.methodologies.destroy', ['methodologies_option' => $q->id])])
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
     * Show the form for creating new Methodology.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('backend.methodologies.create');
    }

    /**
     * Store a newly created Methodology in storage.
     *
     * @param  \App\Http\Requests\StoreMethodologiesRequest $request
     * @return \Illuminate\Http\Response
     */
    public function store(StoreMethodologiesRequest $request)
    {
        $request->all();
        $request = $this->saveFiles($request);
        Methodology::create($request->all());

        return redirect()->route('admin.methodologies.index')->withFlashSuccess(trans('alerts.backend.general.created'));
    }


    /**
     * Show the form for editing Methodology.
     *
     * @param  int $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {

        $methodology = Methodology::findOrFail($id);

        return view('backend.methodologies.edit', compact('methodology'));
    }

    /**
     * Update Methodology in storage.
     *
     * @param  \App\Http\Requests\UpdateMethodologiesRequest $request
     * @param  int $id
     * @return \Illuminate\Http\Response
     */
    public function update(UpdateMethodologiesRequest $request, $id)
    {
        $methodology = Methodology::findOrFail($id);
        $request = $this->saveFiles($request);
        $methodology->update($request->all());

        return redirect()->route('admin.methodologies.index')->withFlashSuccess(trans('alerts.backend.general.updated'));
    }



    /**
     * Remove Methodology from storage.
     *
     * @param  int $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {

        $methodology = Methodology::findOrFail($id);
        $methodology->delete();

        return redirect()->route('admin.methodologies.index')->withFlashSuccess(trans('alerts.backend.general.deleted'));
    }

    /**
     * Delete all selected Methodology at once.
     *
     * @param Request $request
     */
    public function massDestroy(Request $request)
    {

        if ($request->input('ids')) {
            $entries = Methodology::whereIn('id', $request->input('ids'))->get();

            foreach ($entries as $entry) {
                $entry->delete();
            }
        }
    }

    public function status($id)
    {
        $methodology = Methodology::findOrFail($id);
        if ($methodology->status == 1) {
            $methodology->status = 0;
        } else {
            $methodology->status = 1;
        }
        $methodology->save();

        return back()->withFlashSuccess(trans('alerts.backend.general.updated'));
    }

    /**
     * Update methodology status
     *
     * @param \Illuminate\Http\Request $request
     * @return \Illuminate\Http\Response
     **/
    public function updateStatus()
    {
        $methodology = Methodology::findOrFail(request('id'));
        $methodology->status = $methodology->status == 1? 0 : 1;
        $methodology->save();
    }
}
