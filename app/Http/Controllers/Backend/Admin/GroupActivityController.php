<?php
namespace App\Http\Controllers\Backend\Admin;

use App\Http\Controllers\Controller;
use App\Models\ActivityResult;
use App\Models\Chapters;
use App\Models\Course;
use App\Models\CourseGroup;
use App\Models\GroupActivity;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Gate;
use Illuminate\Support\Str;
use Yajra\DataTables\Facades\DataTables;
use App\Http\Controllers\Traits\FileUploadTrait;

class GroupActivityController extends Controller
{
    use FileUploadTrait;

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {

        if (!Gate::allows('test_access')) {
            return abort(401);
        }

        return view('backend.courses.groups.activity.index');
    }

    /**
     * Get the data for the CourseGroupTests DataTable.
     *
     * @param \Illuminate\Http\Request $request
     * @return mixed
     */
    public function getData(Request $request)
    {
        // Check if the user is authorized to view CourseGroupTests
        if (!Gate::allows('test_access')) {
            return abort(401);
        }
        //if show_deleted is set to 1, then show deleted records only
        if (isset($request->show_deleted) && $request->show_deleted == 1) {
            if (isset($request->group_id)){
                $query = GroupActivity::whereHas('courseGroups', function ($q) use ($request) {
                    $q->where('course_group_id', $request->group_id);
                })->onlyTrashed();
            }else{
                $query = GroupActivity::onlyTrashed();
            }
        } elseif (isset($request->group_id)) {
            $query = GroupActivity::whereHas('courseGroups', function ($q) use ($request) {
                $q->where('course_group_id', $request->group_id);
            });
        } else {
            $query = GroupActivity::query();
        }
        $query->withCount('courseGroups'); // get the number of course groups related to it

        $activity = $query->get();
        // get nedded data
        $activity = $activity->map(function ($activity) {
            return [
                'id' => $activity->id,
                'title' => $activity->title,
                'title_ar' => $activity->title_ar,
                'course_groups_count' => $activity->course_groups_count,
                'published' => $activity->published
            ];
        });

        // check if the user has permission to view, edit, delete, copy, or rearrange the tests
        $has_view = false;
        $has_delete = false;
        $has_edit = false;

        if (auth()->user()->can('test_view')) {
            $has_view = true;
        }
        if (auth()->user()->can('test_edit')) {
            $has_edit = true;
        }
        if (auth()->user()->can('test_delete')) {
            $has_delete = true;
        }

        return DataTables::of($activity)
            ->addIndexColumn()
            ->addColumn('title', function ($row) {
                return app()->getLocale() == 'ar' ? $row['title_ar'] : $row['title'];
            })
            ->addColumn('course_groups_count', function ($row) {
                return $row['course_groups_count'];
            })
            ->addColumn('published', function ($row) {
                return $row['published'] ? __('labels.general.active') : __('labels.general.inactive');
            })
            ->addColumn('actions', function ($q) use ($has_view, $has_edit, $has_delete, $request) {
                $view = "";
                $edit = "";
                $delete = "";
                $results = "";

                if ($request->group_id) {
                    $resultsUrl = route('admin.courses.groups.activity.result', ['activity' => $q['id'], 'group' =>
                        $request->group_id]);
                    $results = view('backend.datatable.action-result')
                        ->with(['route' => $resultsUrl])
                        ->render();
                    $view .= $results;

                    if ($has_delete && \Auth::user()->id == 1) {
                        $delete = view('backend.datatable.action-delete')
                            ->with(['route' => route('admin.courses.groups.activity.detach', ['activity' => $q['id'],
                                'group' => $request['group_id']])])
                            ->render();
                        $view .= $delete;
                    }

                }else{
                    if ($request->show_deleted ==1) {
                        $view = view('backend.datatable.action-trashed')->with(['route_label' => 'admin.courses.groups.activity', 'label' =>
                            'id', 'value' =>$q['id']])->render();
                    }else{
                        if ($has_edit) {
                            $edit = view('backend.datatable.action-edit')
                                ->with(['route' => route('admin.courses.groups.activity.edit', ['activity' => $q['id']])])
                                ->render();
                            $view .= $edit;
                        }
                        if ($has_delete && \Auth::user()->id == 1) {
                            $delete = view('backend.datatable.action-delete')
                                ->with(['route' => route('admin.courses.groups.activity.destroy', ['activity' => $q['id']])])
                                ->render();
                            $view .= $delete;
                        }
                    }
                }

                return $view;
            })
            ->rawColumns(['actions'])
            ->make(true);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        if (!Gate::allows('test_create')) {
            return abort(401);
        }

        return view('backend.courses.groups.activity.create');

    }

    /**
     * Store a newly created resource in storage.
     *
     * @param \Illuminate\Http\Request $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        // Check if the user is authorized to create a CourseGroupTest
        if (!Gate::allows('test_create')) {
            return abort(401);
        }

        // Validate and store the CourseGroupTest
        $GroupActivity = GroupActivity::create($request->all());

        //if slug is empty or null, generate a new slug from the title and id
        if ($GroupActivity->slug == null || $GroupActivity->slug == '') {
            $GroupActivity->slug = $GroupActivity->id . '-' . Str::slug($GroupActivity->title);
            $GroupActivity->save();
        }

        // check if there is any image uploaded
        if ($request->hasFile('activity_img')) {
            // Store the uploaded image in the 'public' disk
            $extension = array_last(explode('.', $request->file('activity_img')->getClientOriginalName()));
            $name = array_first(explode('.', $request->file('activity_img')->getClientOriginalName()));
            $filename = time() . '-' . str_slug($name) . '.' . $extension;
            $request->file('activity_img')->move(public_path('storage/activities'), $filename);
            $GroupActivity->image = $filename;
            $GroupActivity->save();
        }

        return redirect()->route('admin.courses.groups.activity.index')->withFlashSuccess(trans('alerts.backend.general.created'));
    }

    /**
     * Display the specified resource.
     *
     * @param \App\Models\GroupActivity $activity
     * @return \Illuminate\Http\Response
     */
    public function show(GroupActivity $activity)
    {
        // Return view or JSON response for a single CourseGroupTest
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param \App\Models\GroupActivity $activity
     * @return \Illuminate\Http\Response
     */
    public function edit(GroupActivity $activity)
    {
        return view('backend.courses.groups.activity.edit', compact('activity'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param \Illuminate\Http\Request $request
     * @param \App\Models\GroupActivity $activity
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request)
    {
        if (!Gate::allows('test_edit')) {
            return abort(401);
        }
        $activity = GroupActivity::find($request->id);
        $activity->update($request->all());

        //if slug is empty or null, generate a new slug from the title and id
        if ($activity->slug == null || $activity->slug == '') {
            $activity->slug = $activity->id . '-' . Str::slug($activity->title);
            $activity->save();
        }

        // check if there is any image uploaded
        if ($request->hasFile('activity_img')) {
            // Store the uploaded image in the 'public' disk
            $extension = array_last(explode('.', $request->file('activity_img')->getClientOriginalName()));
            $name = array_first(explode('.', $request->file('activity_img')->getClientOriginalName()));
            $filename = time() . '-' . str_slug($name) . '.' . $extension;
            $request->file('activity_img')->move(public_path('storage/activities'), $filename);
            $activity->image = $filename;
            $activity->save();
        }

        return redirect()->route('admin.courses.groups.activity.index')->withFlashSuccess(trans('alerts.backend.general.created'));
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param \App\Models\GroupActivity $activity
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        if (!Gate::allows('test_delete')) {
            return abort(401);
        }
        $activity = GroupActivity::find($id);
        if ($activity->courseGroups()->count() > 0) {
            return redirect()->route('admin.courses.groups.activity.index')
                ->withFlashDanger(__('alerts.backend.test.group_remove_err'));
        }
        $activity->delete();
        return redirect()->route('admin.courses.groups.activity.index')->withFlashSuccess(trans('alerts.backend.general.created'));
    }

    /**
     * Restore the specified resource from storage.
     *
     * @param \App\Models\GroupActivity $activity
     * @return \Illuminate\Http\Response
     */
    public function restore($id)
    {
        if (!Gate::allows('test_delete')) {
            return abort(401);
        }
        $activity = GroupActivity::withTrashed()->find($id);
        $activity->restore();
        return redirect()->route('admin.courses.groups.activity.index')->withFlashSuccess(trans('alerts.backend.general.created'));
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param \App\Models\GroupActivity $activity
     * @return \Illuminate\Http\Response
     */
    public function forceDelete($id)
    {
        if (!Gate::allows('test_delete')) {
            return abort(401);
        }
        $activity = GroupActivity::withTrashed()->find($id);
        $activity->forceDelete();
        return redirect()->route('admin.courses.groups.activity.index')->withFlashSuccess(trans('alerts.backend.general.created'));
    }


    /**
     * Show the form for attaching a group to a test.
     *
     * @return \Illuminate\Http\Response
     */
    public function showAddForm(CourseGroup $group)
    {
        // Check if the user is authorized to attach a group to a test
        if (!Gate::allows('test_edit')) {
            return abort(401);
        }

        //if locale is arabic, get the courses in arabic else get them in english
        if (app()->getLocale() == 'ar') {
            $activity = GroupActivity::all()->pluck('title_ar', 'id');
        } else {
            $activity = GroupActivity::all()->pluck('title', 'id');
        }

        // Return the add form view with the course groups and tests
        return view('backend.courses.groups.activity.add', compact('group', 'activity'));
    }

    /**
     * Attach a group to a test.
     *
     * @param \Illuminate\Http\Request $request
     * @return \Illuminate\Http\Response
     */
    public function attachActivity(Request $request)
    {
        // Check if the user is authorized to attach a group to an activity
        if (!Gate::allows('test_edit')) {
            return abort(401);
        }

        // Validate the request data
        $request->validate([
            'group_id' => 'required|exists:course_groups,id',
            'activity' => 'required|exists:group_activity,id',
        ]);

        // Find the course group and the activity
        $courseGroup = CourseGroup::find($request->group_id);
        $groupActivity = GroupActivity::find($request->activity);

        // Check if the group is already attached to the activity
        if ($groupActivity->courseGroups->contains($courseGroup->id)) {
            return redirect()->back()->withFlashDanger(__('alerts.backend.activity.group_already_attached'));
        }

        // Attach the group to the activity
        $groupActivity->courseGroups()->attach($courseGroup->id);
        return redirect()->back()->withFlashSuccess(__('alerts.backend.activity.group_attached'));

    }

    /**
     * Show the form for detaching a group from an activity.
     *
     * @return \Illuminate\Http\Response
     */
    public function groupDetach(Request $request)
    {
        // Check if the user is authorized to detach a group from a test
        if (!Gate::allows('test_edit')) {
            return abort(401);
        }

        // Find the course group and test
        $courseGroup = CourseGroup::find($request->group);
        $groupActivity = GroupActivity::find($request->activity);

        // Detach the group from the test
        $groupActivity->courseGroups()->detach($courseGroup->id);
        
        // Redirect back with a success message
        return redirect()->back()->withFlashSuccess(__('alerts.backend.activity.group_detached'));
    }

    /**
     * Show the results of an activity for a group.
     *
     * @return \Illuminate\Http\Response
     */
    public function results(GroupActivity $activity)
    {
        // Check if the user is authorized to view the results of an activity
        if (!Gate::allows('test_view')) {
            return abort(401);
        }
        $group = CourseGroup::findOrFail(request()->group);
        // Get the results of the activity for the group
        $results = $group->groupActivityResults()->where('group_activity_id', $activity->id)->get();
        // Return the view with the results
        return view('backend.courses.groups.activity.result', compact('activity', 'group', 'results'));
    }

    /**
     * Show the form for marking the results.
     *
     * @return \Illuminate\Http\Response
     */
    public function markResults(GroupActivity $activity, ActivityResult $result)
    {
        // Check if the user is authorized to mark the results of an activity
        if (!Gate::allows('test_edit')) {
            return abort(401);
        }
        $group = CourseGroup::findOrFail($result->group_id);
        return view('backend.courses.groups.activity.student_result', compact('activity', 'group', 'result'));
    }

    /**
     * Delete the result of an activity.
     *
     * @return \Illuminate\Http\Response
     */
    public function resultDestroy(GroupActivity $activity,ActivityResult $result)
    {
        // Check if the user is authorized to delete the result of an activity
        if (!Gate::allows('test_delete')) {
            return abort(401);
        }
        $result->delete();
        return redirect()->back()->withFlashSuccess(__('alerts.backend.result.deleted'));
    }

    /**
     * Update the result of an activity.
     *
     * @return \Illuminate\Http\Response
     */
    public function resultUpdate(Request $request, GroupActivity $activity)
    {
        // Check if the user is authorized to update the result of an activity
        if (!Gate::allows('test_edit')) {
            return abort(401);
        }
        $result = ActivityResult::findOrFail($request->result_id);
        $request->validate([
            'score' => 'required'
        ]);
        $result->result = $request->score;
        $result->save();
        return  response()->json(['success' => __('alerts.backend.result.updated')]);
    }
}