<?php

namespace App\Http\Controllers\Backend\Admin;

use App\Http\Controllers\Controller;
use App\Http\Controllers\Traits\FileUploadTrait;
use App\Models\CourseGroup;
use App\Models\CourseGroupRecommendation;
use App\Models\Question;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Gate;
use Yajra\DataTables\Facades\DataTables;

class CourseGroupRecommendationController extends Controller
{
    use FileUploadTrait;

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return view('backend.courses.groups.recommendation.index');
    }

    /**
     * Get the data for the CourseGroupRecommendation DataTable.
     *
     * @param \Illuminate\Http\Request $request
     * @return mixed
     */
    public function getData(Request $request)
    {
        //check if user has permission to view all course groups
        if (!Gate::allows('course_view')) {
            abort(403);
        }

        //check if request has show deleted
        if ($request->show_deleted == 1) {
            if ($request->group_id) {
                $query = CourseGroupRecommendation::whereHas('courseGroup', function ($q) use ($request) {
                    $q->where('course_group_id', $request->group_id);
                })->onlyTrashed();
            } else {
                $query = CourseGroupRecommendation::onlyTrashed();
            }
        } else {
            if ($request->group_id) {
                $query = CourseGroupRecommendation::whereHas('courseGroup', function ($q) use ($request) {
                    $q->where('course_group_id', $request->group_id);
                });
            } else {
                $query = CourseGroupRecommendation::query();
            }
        }

        $query = $query->with('courseGroup')->get();
        return DataTables::of($query)
            ->addIndexColumn()
            ->editColumn('recommendation', function ($recommendation) {
                return $recommendation->recommendation;
            })
            ->editColumn('group_count', function ($recommendation) {
                return $recommendation->courseGroup()->count();
            })
            ->editColumn('published', function ($recommendation) use ($request) {
                return $recommendation->courseGroup->where('id', $request->group_id)->first()
                    ->pivot->published == 1 ? __('labels.general.active') : __('labels.general.inactive');
            })
            ->editColumn('user_type', function ($recommendation) {
                return  $recommendation->user_type == 'teacher' ? __('labels.backend.impact.fields.teacher') : __('labels.backend.impact.fields.student');
            })
            ->addColumn('actions', function ($recommendation) use ($request) {
                $actions = '';


                if (!$request->group_id) {
                    if ($request->show_deleted == 1){
                        $actions = view('backend.datatable.action-trashed')->with(['route_label' => 'admin.groups.rec', 'label' =>
                            'id', 'value' =>$recommendation->id])->render();
                    } else {
                        $editUrl = route('admin.groups.rec.edit', ['recommendation' => $recommendation->id]);
                        $deleteUrl = route('admin.recommendations.destroy',['id'=>$recommendation->id]);

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

                    $published = $recommendation->courseGroup->where('id', $request->group_id)->first()
                        ->pivot->published;

                    // active btn
                    $active = view('backend.datatable.action-status')
                        ->with(['route' => route('admin.groups.rec.activate', ['rec' => $recommendation->id, 'group' =>
                            $request['group_id']]), 'published' => $published])
                        ->render();
                    $actions .= $active;

                    $resultsUrl = route('admin.results.index', ['forms_id' => $recommendation->id,'form_type' => $recommendation->form_type,'course_id'=>request('course_id')]);
                    $results = view('backend.datatable.action-result')
                        ->with(['route' => $resultsUrl])
                        ->render();
                    $actions .= $results;

                    $deleteUrl = route('admin.groups.rec.detach', ['id' => $recommendation->id, 'group_id' => $request->group_id]);
                    $deatach = view('backend.datatable.action-deatach')
                        ->with(['route' => $deleteUrl])
                        ->render();
                    $actions .= $deatach;
                }


                return $actions;
            })
            ->rawColumns(['actions'])
            ->make(true);
    }
    /**
     * Get the chapters of a course
     *
     * @param \Illuminate\Http\Request $request
     * @return mixed
     */

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('backend.courses.groups.recommendation.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param \Illuminate\Http\Request $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $this->validate($request, [
            'recommendation' => 'required',
            'recommendation_ar' => 'required',
            'user_type' => 'required',
        ]);

        $recommendation = new CourseGroupRecommendation();
        $recommendation->recommendation = $request->recommendation;
        $recommendation->recommendation_ar = $request->recommendation_ar;
        $recommendation->user_type = $request->user_type;
        $recommendation->published = $request->published;
        $recommendation->save();

        $request = $this->saveAllFiles($request, 'downloadable_files', CourseGroupRecommendation::class, $recommendation);

        if ($request->q && is_array($request->q)) {
            foreach ($request->q as $key => $question) {
                $question['user_id'] = auth()->user()->id;
                $q = Question::create($question);
                $q->courseGroupRecommendations()->sync($recommendation->id);

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

        return redirect()->route('admin.group.recommendations')->withFlashSuccess(__('alerts.backend.rate.group_detached'));
    }

    /**
     * Display the specified resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function show()
    {
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function edit(CourseGroupRecommendation $recommendation)
    {
        //if group has questions then get them
        $questions = $recommendation->questions;
        return view('backend.courses.groups.recommendation.edit', compact('recommendation', 'questions'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param \Illuminate\Http\Request $request
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $this->validate($request, [
            'recommendation' => 'required',
            'recommendation_ar' => 'required',
            'user_type' => 'required',
        ]);

        $recommendation = CourseGroupRecommendation::find($id);
        $recommendation->recommendation = $request->recommendation;
        $recommendation->recommendation_ar = $request->recommendation_ar;
        $recommendation->user_type = $request->user_type;
        $recommendation->published = $request->published;
        $recommendation->save();

        $request = $this->saveAllFiles($request, 'downloadable_files', CourseGroupRecommendation::class, $recommendation);

        if ($request->q && is_array($request->q)) {
            $recommendation->questions()->detach();
            foreach ($request->q as $key => $question) {
                $question['user_id'] = auth()->user()->id;
                $q = Question::create($question);
                $q->courseGroupRecommendations()->sync($recommendation->id);

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

        return redirect()->route('admin.group.recommendations')->withFlashSuccess("Recommendation updated successfully");
    }

    /**
     * Remove the specified resource from storage.
     *
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $recommendation = CourseGroupRecommendation::find($id);
        $recommendation->delete();
        return  redirect()->route('admin.group.recommendations')->withFlashSuccess("Recommendation deleted successfully");
    }

    /**
     * Restore the specified resource from storage.
     *
     * @return \Illuminate\Http\Response
     */
    public function restore($id)
    {
        $recommendation = CourseGroupRecommendation::withTrashed()->find($id);
        $recommendation->restore();
        return  redirect()->route('admin.group.recommendations')->withFlashSuccess("Recommendation restored successfully");
    }

    /**
     * Remove the specified resource from storage.
     *
     * @return \Illuminate\Http\Response
     */
    public function forceDelete($id)
    {
        $recommendation = CourseGroupRecommendation::withTrashed()->find($id);
        $recommendation->forceDelete();
        return  redirect()->route('admin.group.recommendations')->withFlashSuccess("Recommendation deleted permanently");
    }

    public function detach(Request $request)
    {
        $recommendation = CourseGroupRecommendation::where('id', $request->id)->whereHas('courseGroup', function ($q) use ($request) {
            $q->where('course_group_id', $request->group_id);
        })->first();
        $recommendation->courseGroup()->detach($request->group_id);
        return back()->withFlashSuccess("Recommendation detached successfully");

    }

    public function group(CourseGroup $group)
    {
        return view('backend.courses.groups.recommendation.index', compact('group'));
    }

    public function groupAttach(CourseGroup $group)
    {
        //if locale is arabic then get arabic recommendations
        if (app()->getLocale() == 'ar') {
            $recommendations = CourseGroupRecommendation::all()->pluck('recommendation_ar', 'id');
        }else{
            $recommendations = CourseGroupRecommendation::all()->pluck('recommendation', 'id');
        }
        return view('backend.courses.groups.recommendation.add', compact('group', 'recommendations'));
    }

    public function groupAttachStore(Request $request)
    {
        $group = CourseGroup::find($request->group_id);
        foreach ($request->recommendations as $recommendation) {
            //check if recommendation is already attached
            if (!$group->reccomendations->contains($recommendation)) {
                $group->reccomendations()->attach($recommendation, ['published' => $request->published]);
            }
        }
        return redirect()->route('admin.groups.rec.attach', ['group' => $group->id])->withFlashSuccess("Recommendations attached successfully");
    }


    public function activateGroupRec(Request $request)
    {
        if (!Gate::allows('test_edit')) {
            return abort(401);
        }

        $group = CourseGroup::findOrFail($request->group);
        $rec = CourseGroupRecommendation::findOrFail($request->rec);

        // Update the published status of the Recommendation
        $group->reccomendations()->updateExistingPivot($rec->id, ['published' => $request->published]);

        return redirect()->back()->withFlashSuccess('The Recommendation has been successfully activated.');
    }

}