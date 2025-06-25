<?php

namespace App\Http\Controllers\Backend\Admin;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\Acheivment;
use DataTables;

class AcheivmentController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
        $achivment=Acheivment::first();
        return view('backend.acheivments.index',compact('achivment'));

    }
    public function getData(Request $request)
    {
        $has_view = false;
        $has_delete = false;
        $has_edit = false;
        $achivments = Acheivment::orderBy('created_at', 'desc')->get();


        return DataTables::of($achivments)
            ->addIndexColumn()
            ->addColumn('actions', function ($q) use ($request) {
                $view = "";
                $edit = "";
                $delete = "";

                $edit = view('backend.datatable.action-edit')
                    ->with(['route' => route('admin.acheivment.edit', ['achivments_option' => $q->id])])
                    ->render();
                $view .= $edit;

                $delete = view('backend.datatable.action-delete')
                    ->with(['route' => route('admin.acheivment.destroy', ['achivments_option' => $q->id])])
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
        return view('backend.acheivments.create');

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
        $achivment= Acheivment::create(array_slice($request->all(),2));
        return redirect()->back()->withFlashSuccess(__('alerts.backend.general.created'));

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
        $achivment=Acheivment::find($id);
        return view('backend.acheivments.edit',compact('achivment'));
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
        // dd($request->all());
       if($id==0){
           $achivment= Acheivment::create(array_slice($request->all(),2));
       }
       else{
        $achivment= Acheivment::where('id',$id)->update(array_slice($request->all(),2));

       }
       return redirect()->back()->withFlashSuccess(__('alerts.backend.general.updated'));

    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {

        $banner = Acheivment::findOrFail($id);
        $banner->delete();

        return redirect()->route('admin.acheivment.index')->withFlashSuccess(trans('alerts.backend.general.deleted'));
    }

    /**
     * Delete all selected Testimonial at once.
     *
     * @param Request $request
     */
    public function massDestroy(Request $request)
    {

        if ($request->input('ids')) {
            $entries = Acheivment::whereIn('id', $request->input('ids'))->get();

            foreach ($entries as $entry) {
                $entry->delete();
            }
        }
    }

    public function status($id)
    {
        $acheivment = Acheivment::findOrFail($id);
        if ($acheivment->status == 1) {
            $acheivment->status = 0;
        } else {
            $acheivment->status = 1;
        }
        $acheivment->save();

        return back()->withFlashSuccess(trans('alerts.backend.general.updated'));
    }
    public function updateStatus()
    {
        $acheivment = Acheivment::findOrFail(request('id'));
        $acheivment->status = $acheivment->status == 1? 0 : 1;
        $acheivment->save();
    }
}
