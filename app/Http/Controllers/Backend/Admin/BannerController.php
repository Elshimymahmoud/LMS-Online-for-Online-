<?php

namespace App\Http\Controllers\Backend\Admin;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Http\Controllers\Traits\FileUploadTrait;
use App\Http\Requests\Admin\StoreBannersRequest;
use App\Http\Requests\Admin\UpdateBannersRequest;
use App\Models\Banner;
use App\Models\Course;
use DataTables;

class BannerController extends Controller
{
    use FileUploadTrait;
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return view('backend.banners.index');

        //
    }
    public function getData(Request $request)
    {
        $has_view = false;
        $has_delete = false;
        $has_edit = false;
        $banners = Banner::orderBy('created_at', 'desc')->get();


        return DataTables::of($banners)
            ->addIndexColumn()
            ->addColumn('actions', function ($q) use ($request) {
                $view = "";
                $edit = "";
                $delete = "";

                $edit = view('backend.datatable.action-edit')
                    ->with(['route' => route('admin.banners.edit', ['banners_option' => $q->id])])
                    ->render();
                $view .= $edit;

                $delete = view('backend.datatable.action-delete')
                    ->with(['route' => route('admin.banners.destroy', ['banners_option' => $q->id])])
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
        if(app()->getLocale()=="ar"){
            $courses = Course::latest()->has('category')->ofTeacher()->get()->pluck('title_ar', 'id')->prepend('Please select', '');
           
        }
        else
        {
            $courses = Course::latest()->has('category')->ofTeacher()->get()->pluck('title', 'id')->prepend('Please select', '');
        }
        return view('backend.banners.create',compact('courses'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(StoreBannersRequest $request)
    {
        $request = $this->saveFiles($request);
        Banner::create($request->all());

        return redirect()->route('admin.banners.index')->withFlashSuccess(trans('alerts.backend.general.created'));
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
        $banner = Banner::findOrFail($id);
        if(app()->getLocale()=="ar"){
            $courses = Course::latest()->has('category')->ofTeacher()->get()->pluck('title_ar', 'id')->prepend('Please select', '');
           
        }
        else
        {
            $courses = Course::latest()->has('category')->ofTeacher()->get()->pluck('title', 'id')->prepend('Please select', '');
        }
        return view('backend.banners.edit', compact('banner','courses'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(UpdateBannersRequest $request, $id)
    {
        //
        $banner = Banner::findOrFail($id);
        $request = $this->saveFiles($request);
        $banner->update($request->all());

        return redirect()->route('admin.banners.index')->withFlashSuccess(trans('alerts.backend.general.updated'));
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {

        $banner = Banner::findOrFail($id);
        $banner->delete();

        return redirect()->route('admin.banners.index')->withFlashSuccess(trans('alerts.backend.general.deleted'));
    }

    /**
     * Delete all selected Testimonial at once.
     *
     * @param Request $request
     */
    public function massDestroy(Request $request)
    {

        if ($request->input('ids')) {
            $entries = Banner::whereIn('id', $request->input('ids'))->get();

            foreach ($entries as $entry) {
                $entry->delete();
            }
        }
    }
    public function status($id)
    {
        $banner = Banner::findOrFail($id);
        if ($banner->status == 1) {
            $banner->status = 0;
        } else {
            $banner->status = 1;
        }
        $banner->save();

        return back()->withFlashSuccess(trans('alerts.backend.general.updated'));
    }
    public function updateStatus()
    {
        $banner = Banner::findOrFail(request('id'));
        $banner->status = $banner->status == 1? 0 : 1;
        $banner->save();
    }
}
