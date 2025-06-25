<?php

namespace App\Http\Controllers\Backend\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\Admin\StoreHomeServicesRequest;
use App\Http\Requests\Admin\UpdateHomeServicesRequest;
use Illuminate\Support\Facades\File;
use App\Http\Controllers\Traits\FileUploadTrait;
use App\Models\HomeService;
use Illuminate\Http\Request;
use Yajra\DataTables\DataTables;

class HomeServiceController extends Controller
{
    use FileUploadTrait;

    /**
     * Display a listing of HomeService.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return view('backend.home_services.index');
    }


    /**
     * Display a listing of HomeServices via ajax DataTable.
     *
     * @return \Illuminate\Http\Response
     */
    public function getData(Request $request)
    {
        $has_view = false;
        $has_delete = false;
        $has_edit = false;
        $home_services = HomeService::orderBy('created_at', 'desc')->get();


        return DataTables::of($home_services)
            ->addIndexColumn()
            ->addColumn('actions', function ($q) use ($request) {
                $view = "";
                $edit = "";
                $delete = "";

                $edit = view('backend.datatable.action-edit')
                    ->with(['route' => route('admin.home_services.edit', ['home_services_option' => $q->id])])
                    ->render();
                $view .= $edit;

                $delete = view('backend.datatable.action-delete')
                    ->with(['route' => route('admin.home_services.destroy', ['home_services_option' => $q->id])])
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
     * Show the form for creating new HomeService.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('backend.home_services.create');
    }

    /**
     * Store a newly created HomeService in storage.
     *
     * @param  \App\Http\Requests\StoreHomeServicesRequest $request
     * @return \Illuminate\Http\Response
     */
    public function store(StoreHomeServicesRequest $request)
    {
        $request->all();
        $request = $this->saveFiles($request);
        HomeService::create($request->all());

        return redirect()->route('admin.home_services.index')->withFlashSuccess(trans('alerts.backend.general.created'));
    }


    /**
     * Show the form for editing HomeService.
     *
     * @param  int $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {

        $home_service = HomeService::findOrFail($id);

        return view('backend.home_services.edit', compact('home_service'));
    }

    /**
     * Update HomeService in storage.
     *
     * @param  \App\Http\Requests\UpdateHomeServicesRequest $request
     * @param  int $id
     * @return \Illuminate\Http\Response
     */
    public function update(UpdateHomeServicesRequest $request, $id)
    {
        $home_service = HomeService::findOrFail($id);
        $request = $this->saveFiles($request);
        $home_service->update($request->all());

        return redirect()->route('admin.home_services.index')->withFlashSuccess(trans('alerts.backend.general.updated'));
    }



    /**
     * Remove HomeService from storage.
     *
     * @param  int $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {

        $home_service = HomeService::findOrFail($id);
        $home_service->delete();

        return redirect()->route('admin.home_services.index')->withFlashSuccess(trans('alerts.backend.general.deleted'));
    }

    /**
     * Delete all selected HomeService at once.
     *
     * @param Request $request
     */
    public function massDestroy(Request $request)
    {

        if ($request->input('ids')) {
            $entries = HomeService::whereIn('id', $request->input('ids'))->get();

            foreach ($entries as $entry) {
                $entry->delete();
            }
        }
    }

    public function status($id)
    {
        $home_service = HomeService::findOrFail($id);
        if ($home_service->status == 1) {
            $home_service->status = 0;
        } else {
            $home_service->status = 1;
        }
        $home_service->save();

        return back()->withFlashSuccess(trans('alerts.backend.general.updated'));
    }

    /**
     * Update home_service status
     *
     * @param \Illuminate\Http\Request $request
     * @return \Illuminate\Http\Response
     **/
    public function updateStatus()
    {
        $home_service = HomeService::findOrFail(request('id'));
        $home_service->status = $home_service->status == 1? 0 : 1;
        $home_service->save();
    }
}
