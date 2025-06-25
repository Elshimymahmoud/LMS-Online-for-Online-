<?php

namespace App\Http\Controllers\Backend\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\Admin\StoreLocationsRequest;
use App\Http\Requests\Admin\UpdateLocationsRequest;
use Illuminate\Support\Facades\File;
use App\Http\Controllers\Traits\FileUploadTrait;
use App\Models\Location;
use App\Models\Type;
use Illuminate\Http\Request;
use Yajra\DataTables\DataTables;

class LocationController extends Controller
{
    use FileUploadTrait;

    /**
     * Display a listing of Location.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return view('backend.locations.index');
    }


    /**
     * Display a listing of Locations via ajax DataTable.
     *
     * @return \Illuminate\Http\Response
     */
    public function getData(Request $request)
    {
        $has_view = false;
        $has_delete = false;
        $has_edit = false;
        $locations = Location::orderBy('created_at', 'desc')->get();


        return DataTables::of($locations)
            ->addIndexColumn()
            ->addColumn('actions', function ($q) use ($request) {
                $view = "";
                $edit = "";
                $delete = "";

                $edit = view('backend.datatable.action-edit')
                    ->with(['route' => route('admin.locations.edit', ['locations_option' => $q->id])])
                    ->render();
                $view .= $edit;

                $delete = view('backend.datatable.action-delete')
                    ->with(['route' => route('admin.locations.destroy', ['locations_option' => $q->id])])
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
    public function getData2(Request $request)
    {
        $has_view = false;
        $has_delete = false;
        $has_edit = false;
        $locations = Location::orderBy('created_at', 'desc')->get();


        return DataTables::of($locations)
            ->addIndexColumn()
            ->addColumn('actions', function ($q) use ($request) {
                $view = "";
                $edit = "";
                $delete = "";

                $edit = view('backend.datatable.action-edit')
                    ->with(['route' => route('admin.locations.edit', ['locations_option' => $q->id])])
                    ->render();
                $view .= $edit;

                $delete = view('backend.datatable.action-delete')
                    ->with(['route' => route('admin.locations.destroy', ['locations_option' => $q->id])])
                    ->render();
                $view .= $delete;
                return $view;

            })
            ->editColumn('type', function ($q) {
                $html = session('locale')=='ar'?$q->course->type->name_ar:$q->course->type->name;
                return $html;
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
     * Show the form for creating new Location.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        if (app()->getLocale() == 'ar') {
            $courses_types = Type::where('status',1)->get()->pluck('name_ar', 'id');
        } else {
            $courses_types = Type::where('status',1)->get()->pluck('name', 'id');
        }
        return view('backend.locations.create',compact('courses_types'));
    }

    /**
     * Store a newly created Location in storage.
     *
     * @param  \App\Http\Requests\StoreLocationsRequest $request
     * @return \Illuminate\Http\Response
     */
    public function store(StoreLocationsRequest $request)
    {
        $request->all();
        $request = $this->saveFiles($request);
      
        Location::create($request->all());

        return redirect()->route('admin.locations.index')->withFlashSuccess(trans('alerts.backend.location.created'));
    }


    /**
     * Show the form for editing Location.
     *
     * @param  int $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {

        $location = Location::findOrFail($id);
        if (app()->getLocale() == 'ar') {
            $courses_types = Type::where('status',1)->get()->pluck('name_ar', 'id');
        } else {
            $courses_types = Type::where('status',1)->get()->pluck('name', 'id');
        }
        return view('backend.locations.edit', compact('location','courses_types'));
    }

    /**
     * Update Location in storage.
     *
     * @param  \App\Http\Requests\UpdateLocationsRequest $request
     * @param  int $id
     * @return \Illuminate\Http\Response
     */
    public function update(UpdateLocationsRequest $request, $id)
    {
        $location = Location::findOrFail($id);
        $request = $this->saveFiles($request);
        $location->update($request->all());

        return redirect()->route('admin.locations.index')->withFlashSuccess(trans('alerts.backend.location.updated'));
    }



    /**
     * Remove Location from storage.
     *
     * @param  int $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        // Find the location
        $location = Location::findOrFail($id);

        // Check if the location has any groups
        if ($location->groups->count() > 0) {
            return redirect()->route('admin.locations.index')->withFlashDanger(__('alerts.backend.location.group_remove_err'));
        }

        // Delete the location
        $location->delete();

        return redirect()->route('admin.locations.index')->withFlashSuccess(trans('alerts.backend.location.deleted'));
    }

    /**
     * Delete all selected Location at once.
     *
     * @param Request $request
     */
    public function massDestroy(Request $request)
    {

        if ($request->input('ids')) {
            $entries = Location::whereIn('id', $request->input('ids'))->get();

            foreach ($entries as $entry) {
                $entry->delete();
            }
        }
    }

    public function status($id)
    {
        $location = Location::findOrFail($id);
        if ($location->status == 1) {
            $location->status = 0;
        } else {
            $location->status = 1;
        }
        $location->save();

        return back()->withFlashSuccess(trans('alerts.backend.location.updated'));
    }

    /**
     * Update location status
     *
     * @param \Illuminate\Http\Request $request
     * @return \Illuminate\Http\Response
     **/
    public function updateStatus()
    {
        $location = Location::findOrFail(request('id'));
        $location->status = $location->status == 1? 0 : 1;
        $location->save();
    }
}
