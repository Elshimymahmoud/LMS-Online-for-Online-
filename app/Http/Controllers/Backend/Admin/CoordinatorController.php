<?php

namespace App\Http\Controllers\Backend\Admin;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\Coordinator;
use DataTables;

class CoordinatorController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return view('backend.coordinator.index');

        //
    }
    public function getData(Request $request)
    {
        $has_view = false;
        $has_delete = false;
        $has_edit = false;
        $coordinator = Coordinator::orderBy('created_at', 'desc')->get();


        return DataTables::of($coordinator)
            ->addIndexColumn()
            ->addColumn('actions', function ($q) use ($request) {
                $view = "";
                $edit = "";
                $delete = "";

                $edit = view('backend.datatable.action-edit')
                    ->with(['route' => route('admin.coordinator.edit', ['coordinator_option' => $q->id])])
                    ->render();
                $view .= $edit;

                $delete = view('backend.datatable.action-delete')
                    ->with(['route' => route('admin.coordinator.destroy', ['coordinator_option' => $q->id])])
                    ->render();
                $view .= $delete;
                return $view;

            })
           
            ->rawColumns( ['actions'])
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
        return view('backend.coordinator.create');

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
        Coordinator::create($request->all());

        return redirect()->route('admin.coordinator.index')->withFlashSuccess(trans('alerts.backend.general.created'));
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
        $coordinator=Coordinator::findOrFail($id);
        return view('backend.coordinator.edit',compact('coordinator'));
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
        $coordinator = Coordinator::findOrFail($id);
       
        $coordinator->update($request->all());

        return redirect()->route('admin.coordinator.index')->withFlashSuccess(trans('alerts.backend.general.updated'));
        
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
        $coordinator = Coordinator::findOrFail($id);
        $coordinator->delete();

        return redirect()->route('admin.coordinator.index')->withFlashSuccess(trans('alerts.backend.general.deleted'));
    }
}
