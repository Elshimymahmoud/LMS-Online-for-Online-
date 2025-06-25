<?php

namespace App\Http\Controllers\Backend\Admin;

use App\Http\Controllers\Controller;
use App\Http\Controllers\Traits\FileUploadTrait;
use App\Models\Auth\User;
use App\Models\CourseGroup;
use App\Models\CourseGroupImpact;
use App\Models\Question;
use App\Models\QuestionsOption;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Gate;
use Yajra\DataTables\Facades\DataTables;

class CourseGroupImpactController extends Controller
{
    use FileUploadTrait;


    public function index()
    {

        return view('backend.courses.groups.impacts.index');
    }

    public function getData(Request $request)
    {
        //check if user has permission to view all course groups
        if (!Gate::allows('course_view')) {
            abort(403);
        }

        //check if request has show deleted
        if ($request->show_deleted == 1) {
            if ($request->group_id) {
                $query = CourseGroupImpact::whereHas('courseGroup', function ($q) use ($request) {
                    $q->where('course_group_id', $request->group_id);
                })->onlyTrashed();
            } else {
                $query = CourseGroupImpact::onlyTrashed();
            }
        } else {
            if ($request->group_id) {
                $query = CourseGroupImpact::whereHas('courseGroup', function ($q) use ($request) {
                    $q->where('course_group_id', $request->group_id);
                });
            } else {
                $query = CourseGroupImpact::query();
            }
        }

        $query = $query->with('courseGroup')->get();
        return DataTables::of($query)
            ->addIndexColumn()
            ->editColumn('impact', function ($impact) {
                //if locale is arabic then show arabic name else show english name
                return app()->getLocale() == 'ar' ? $impact->impact_ar : $impact->impact;
            })
            ->editColumn('user_type', function ($impact) {
                return  $impact->user_type == 'teacher' ? __('labels.backend.impact.fields.teacher') : __('labels.backend.impact.fields.student');
            })
            ->editColumn('group_count', function ($impact) {
                return $impact->courseGroup()->count();
            })
            ->editColumn('published', function ($impact) use ($request) {
                return $impact->courseGroup->where('id', $request->group_id)->first()
                    ->pivot->published == 1 ? __('labels.general.active') : __('labels.general.inactive');
            })
            ->addColumn('actions', function ($impact) use ($request) {
                $actions = '';

                if (!$request->group_id) {
                    if ($request->show_deleted == 1){
                        $actions = view('backend.datatable.action-trashed')->with(['route_label' => 'admin.groups.impacts', 'label' =>
                            'id', 'value' =>$impact->id])->render();
                    } else {
                        $editUrl = route('admin.groups.impacts.edit', ['impact' => $impact->id]);
                        $deleteUrl = route('admin.impacts.destroy', ['id' => $impact->id]);

                        $edit = view('backend.datatable.action-edit')
                            ->with(['route' => $editUrl])
                            ->render();
                        $actions .= $edit;

                        $delete = view('backend.datatable.action-delete')
                            ->with(['route' => $deleteUrl])
                            ->render();
                        $actions .= $delete;
                    }
                }
                else{

                    $published = $impact->courseGroup->where('id', $request->group_id)->first()
                        ->pivot->published;

                    // active btn
                    $active = view('backend.datatable.action-status')
                        ->with(['route' => route('admin.groups.impacts.activate', ['impact' => $impact->id, 'group' =>
                            $request['group_id']]), 'published' => $published])
                        ->render();
                    $actions .= $active;

                    $resultsUrl = route('admin.group.impacts.getImpacts', ['group' => $request->group_id, 'impact' => $impact->id]);
                    $deleteUrl = route('admin.groups.impacts.detach', ['id' => $impact->id, 'group_id' => $request->group_id]);
                    $deatach = view('backend.datatable.action-deatach')
                        ->with(['route' => $deleteUrl])
                        ->render();
                    $actions .= $deatach;
                    $results = view('backend.datatable.action-result')
                        ->with(['route' => $resultsUrl])
                        ->render();
                    $actions .= $results;
                }






                return $actions;
            })
            ->rawColumns(['actions'])
            ->make(true);
    }
    public function create()
    {
        if (app()->getLocale() == 'ar') {
            $users = User::all()->pluck('name_ar', 'id');
        }else{
            $users = User::all()->pluck('name', 'id');
        }
        return view('backend.courses.groups.impacts.create', compact('users'));
    }
    public function store(Request $request)
    {
        $this->validate($request, [
            'impact' => 'required',
            'impact_ar' => 'required',
            'user_type' => 'required',
        ]);
        $impact = new CourseGroupImpact();
        $impact->impact = $request->impact;
        $impact->impact_ar = $request->impact_ar;
        $impact->user_type = $request->user_type;
        $impact->save();

        $request = $this->saveAllFiles($request, 'downloadable_files', CourseGroupImpact::class, $impact);

        if ($request->q && is_array($request->q)) {
            foreach ($request->q as $key => $question) {
                $question['user_id'] = auth()->user()->id;
                $q = Question::create($question);
                $q->courseGroupImpacts()->sync($impact->id);

                if (isset($question['option_text']) && count($question['option_text']) > 0) {
                    foreach ($question['option_text'] as $key => $q_option) {
                        QuestionsOption::create([
                            'question_id' => $q->id,
                            'option_text' => $question['option_text'][$key],
                            'option_text_ar' => $question['option_text_ar'][$key],
                            'correct' => @(int)$question['correct'][$key]
                        ]);
                    }
                }
            }
        }

        return redirect()->route('admin.group.impacts')->with('success', 'Impact created successfully');
    }

    /**
     * Display the specified resource.
     *
     * @param \App\Models\CourseGroupTest $courseGroupTest
     * 
     */
    public function show(CourseGroupTest $courseGroupTest)
    {
        // Return view or JSON response for a single CourseGroupTest
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param \App\Models\CourseGroupTest $courseGroupTest
     * 
     */
    public function edit(CourseGroupImpact $impact)
    {
        //if group has questions then get them
        $questions = $impact->questions;
        return view('backend.courses.groups.impacts.edit', compact('impact', 'questions'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param \Illuminate\Http\Request $request
     * @param \App\Models\CourseGroupTest $courseGroupTest
     * 
     */
    public function update(Request $request, $id)
    {
        if (!Gate::allows('course_edit')) {
            return abort(401);
        }

        $this->validate($request, [
            'impact' => 'required',
            'impact_ar' => 'required',
            'user_type' => 'required',
        ]);

//        dd($request->all());
        $impact = CourseGroupImpact::find($id);
        $impact->update($request->all());
        $impact->published = $request->published ? 1 : 0;
        $impact->save();
        $request = $this->saveAllFiles($request, 'downloadable_files', CourseGroupImpact::class, $impact);

        if ($request->q && is_array($request->q)) {
            $impact->questions()->forceDelete();
            foreach ($request->q as $key => $question) {
                $question['user_id'] = auth()->user()->id;
                $q = Question::create($question);
                $q->courseGroupImpacts()->sync($impact->id);

                if (isset($question['option_text']) && count($question['option_text']) > 0) {
                    foreach ($question['option_text'] as $key => $q_option) {
                        QuestionsOption::create([
                            'question_id' => $q->id,
                            'option_text' => $question['option_text'][$key],
                            'option_text_ar' => $question['option_text_ar'][$key],
                            'correct' => @(int)$question['correct'][$key]
                        ]);
                    }
                }
            }
        }

        return redirect()->route('admin.group.impacts')->with('success', 'Impact updated successfully');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param \App\Models\CourseGroupTest $courseGroupTest
     * 
     */
    public function destroy($id)
    {
        $impact = CourseGroupImpact::find($id);
        if ($impact->courseGroup()->count() > 0) {
            return redirect()->route('admin.group.impacts')
                ->withFlashDanger(__('alerts.backend.impact.group_remove_err'));

        }
        $impact->delete();

        return redirect()->route('admin.group.impacts')->with('success', 'Impact deleted successfully');
    }

    /**
     * Restore the specified resource from storage.
     *
     * @param \App\Models\CourseGroupTest $courseGroupTest
     * 
     */
    public function restore($id)
    {
        $impact = CourseGroupImpact::withTrashed()->find($id);
        $impact->restore();
        return redirect()->route('admin.group.impacts')->with('success', 'Impact restored successfully');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param \App\Models\CourseGroupTest $courseGroupTest
     * 
     */
    public function forceDelete($id)
    {
        $impact = CourseGroupImpact::withTrashed()->find($id);
        $impact->forceDelete();
        return redirect()->route('admin.group.impacts')->with('success', 'Impact deleted permanently');
    }

    public function detach(Request $request)
    {
        $impact = CourseGroupImpact::find($request->id);
        $group_id = $request->group_id;
        $impact->courseGroup()->detach($group_id);
        return back()->with('success', 'Impact unattached from group successfully');
    }

    public function groupAttach(CourseGroup $group)
    {
        if (app()->getLocale() == 'ar') {
            $impacts = CourseGroupImpact::all()->pluck('impact_ar', 'id');
        } else {
            $impacts = CourseGroupImpact::all()->pluck('impact', 'id');
        }
        return view('backend.courses.groups.impacts.add', compact('group', 'impacts'));
    }

    public function groupAttachStore(Request $request)
    {
        $group = CourseGroup::find($request->group_id);
        foreach ($request->impacts as $impact) {
            if (!$group->impacts->contains($impact)){
                $group->impacts()->attach($impact, ['published' => $request->published]);
            }
        }
        return back()->withFlashSuccess("Impact attached successfully");
    }

    public function getGroupImpacts(CourseGroup $group, CourseGroupImpact $impact)
    {

        return view('backend.courses.groups.impacts.view', compact('impact', 'group'));
    }

    public function activateGroupImpact(Request $request)
    {
        if (!Gate::allows('test_edit')) {
            return abort(401);
        }

        $group = CourseGroup::findOrFail($request->group);
        $impact = CourseGroupImpact::findOrFail($request->impact);

        // Update the published status of the impact
        $group->impacts()->updateExistingPivot($impact->id, ['published' => $request->published]);

        return redirect()->back()->withFlashSuccess('The impact has been successfully activated.');
    }


}