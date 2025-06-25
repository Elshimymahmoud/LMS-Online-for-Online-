<?php

namespace App\Http\Controllers\Backend\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\Admin\StoreStoriesRequest;
use App\Http\Requests\Admin\UpdateStoriesRequest;
use Illuminate\Support\Facades\File;
use App\Http\Controllers\Traits\FileUploadTrait;
use App\Models\Story;
use Illuminate\Http\Request;
use Yajra\DataTables\DataTables;

class StoryController extends Controller
{
    use FileUploadTrait;

    /**
     * Display a listing of Story.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return view('backend.stories.index');
    }


    /**
     * Display a listing of Stories via ajax DataTable.
     *
     * @return \Illuminate\Http\Response
     */
    public function getData(Request $request)
    {
        $has_view = false;
        $has_delete = false;
        $has_edit = false;
        $stories = Story::orderBy('created_at', 'desc')->get();


        return DataTables::of($stories)
            ->addIndexColumn()
            ->addColumn('actions', function ($q) use ($request) {
                $view = "";
                $edit = "";
                $delete = "";

                $edit = view('backend.datatable.action-edit')
                    ->with(['route' => route('admin.stories.edit', ['stories_option' => $q->id])])
                    ->render();
                $view .= $edit;

                $delete = view('backend.datatable.action-delete')
                    ->with(['route' => route('admin.stories.destroy', ['stories_option' => $q->id])])
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
     * Show the form for creating new Story.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('backend.stories.create');
    }

    /**
     * Store a newly created Story in storage.
     *
     * @param  \App\Http\Requests\StoreStoriesRequest $request
     * @return \Illuminate\Http\Response
     */
    public function store(StoreStoriesRequest $request)
    {
        $request->all();
        $request = $this->saveFiles($request);
        Story::create($request->all());

        return redirect()->route('admin.stories.index')->withFlashSuccess(trans('alerts.backend.general.created'));
    }


    /**
     * Show the form for editing Story.
     *
     * @param  int $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {

        $story = Story::findOrFail($id);

        return view('backend.stories.edit', compact('story'));
    }

    /**
     * Update Story in storage.
     *
     * @param  \App\Http\Requests\UpdateStoriesRequest $request
     * @param  int $id
     * @return \Illuminate\Http\Response
     */
    public function update(UpdateStoriesRequest $request, $id)
    {
        $story = Story::findOrFail($id);
        $request = $this->saveFiles($request);
        $story->update($request->all());

        return redirect()->route('admin.stories.index')->withFlashSuccess(trans('alerts.backend.general.updated'));
    }



    /**
     * Remove Story from storage.
     *
     * @param  int $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {

        $story = Story::findOrFail($id);
        $story->delete();

        return redirect()->route('admin.stories.index')->withFlashSuccess(trans('alerts.backend.general.deleted'));
    }

    /**
     * Delete all selected Story at once.
     *
     * @param Request $request
     */
    public function massDestroy(Request $request)
    {

        if ($request->input('ids')) {
            $entries = Story::whereIn('id', $request->input('ids'))->get();

            foreach ($entries as $entry) {
                $entry->delete();
            }
        }
    }

    public function status($id)
    {
        $story = Story::findOrFail($id);
        if ($story->status == 1) {
            $story->status = 0;
        } else {
            $story->status = 1;
        }
        $story->save();

        return back()->withFlashSuccess(trans('alerts.backend.general.updated'));
    }

    /**
     * Update story status
     *
     * @param \Illuminate\Http\Request $request
     * @return \Illuminate\Http\Response
     **/
    public function updateStatus()
    {
        $story = Story::findOrFail(request('id'));
        $story->status = $story->status == 1? 0 : 1;
        $story->save();
    }
}
