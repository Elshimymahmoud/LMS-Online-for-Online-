<?php

namespace App\Http\Controllers\Backend\Admin;

use App\Http\Controllers\Controller;
use App\Http\Controllers\Traits\FileUploadTrait;
use App\Models\Course;
use App\Models\CourseGroup;
use App\Models\CourseGroupRates;
use App\Models\Question;
use App\Models\QuestionsOption;
use App\Models\RateDivision;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Gate;
use Yajra\DataTables\Facades\DataTables;

class CourseGroupRatesController extends Controller
{
    use FileUploadTrait;

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return view('backend.courses.groups.rates.index');
    }

    /**
     * Get the data for the CourseGroupRatess DataTable.
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
                $query = DB::table('course_group_rate')
                    ->where('course_group_id', $request->group_id)
                    ->join('course_group_rates', 'course_group_rate.course_group_rates_id', '=', 'course_group_rates.id')
                    ->select('course_group_rates.*', 'course_group_rate.published as group_published');
            } else {
                $query = CourseGroupRates::onlyTrashed()->with('courseGroup')->get();
            }
        } else {
            if ($request->group_id && $request->user_id) {
                $query = CourseGroupRates::whereHas('courseGroup', function ($query) use ($request) {
                    $query->where('course_groups.id', $request->group_id);
                })->whereHas('divisions.questions.answers', function ($query) use ($request) {
                    $query->where('user_id', $request->user_id);
                })->get();
            } elseif ($request->group_id) {
                $query = DB::table('course_group_rate')
                    ->where('course_group_id', $request->group_id)
                    ->join('course_group_rates', 'course_group_rate.course_group_rates_id', '=', 'course_group_rates.id')
                    ->select('course_group_rates.*', 'course_group_rate.published as group_published');
            } elseif ($request->user_id) {
                $query = CourseGroupRates::whereHas('divisions.questions.answers', function ($query) use ($request) {
                    $query->where('user_id', $request->user_id);
                })->with('courseGroup')->get();
            } else {
                $query = CourseGroupRates::with('courseGroup')->get();
            }
        }

        return DataTables::of($query)
            ->addIndexColumn()
            ->editColumn('title', function ($rate) {
                //if locale is arabic return arabic name else return english
                return app()->getLocale() == 'ar' ? $rate->title_ar : $rate->title;
            })
            ->editColumn('courseGroup', function ($rate) use ($request) {
                if ($request->group_id) {
                    $count = DB::table('course_group_rate')
                        ->where('course_group_rates_id', $rate->id)
                        ->join('course_group_rates', 'course_group_rate.course_group_rates_id', '=', 'course_group_rates.id')
                        ->count();
                    return $count;
                }else{
                    return $rate->courseGroup()->count();
                }
            })
            ->editColumn('published', function ($rate) {
                return $rate->group_published == 1 ? __('labels.general.active') : __('labels.general.inactive');
            })
            ->editColumn('user_type', function ($rate) {
                return  $rate->user_type == 'teacher_rate_student' ? __('labels.backend.rates.fields.teacher_rate_student') : __('labels.backend.rates.fields.student');
            })
            ->addColumn('actions', function ($rate) use ($request) {
                $actions = '';



                if (!$request->group_id) {
                    if ($request->show_deleted == 1){
                        $actions = view('backend.datatable.action-trashed')->with(['route_label' => 'admin.groups.rates', 'label' =>
                            'id', 'value' =>$rate->id])->render();
                    } else {
                        $editUrl = route('admin.groups.rates.edit', ['rate' => $rate->id]);
                        $deleteUrl = route('admin.rates.destroy',['id'=>$rate->id]);
                        $divisionUrl = route('admin.groups.rates.divisions', ['rate' => $rate->id]);
                        $edit = view('backend.datatable.action-edit')
                            ->with(['route' => $editUrl])
                            ->render();
                        $actions .= $edit;

                        $division = view('backend.datatable.action-lessons')
                            ->with(['route' => $divisionUrl])
                            ->render();
                        $actions .= $division;

                        $delete = view('backend.datatable.action-delete')
                            ->with(['route' => $deleteUrl])
                            ->render();
                        $actions .= $delete;
                    }

                }
                else{
                    if ($request->user_id){
                        $resultsUrl = route('admin.group.rates.getRates', ['group' => $request->group_id,'rate'=>$rate->id,'user_id'=>$request->user_id]);
                    }else{
                        $resultsUrl = route('admin.group.rates.getRates', ['group' => $request->group_id,
                            'rate'=>$rate->id]);
                    }

                    $published = $rate->group_published;

                    // active btn
                    $active = view('backend.datatable.action-status')
                        ->with(['route' => route('admin.groups.rates.activate', ['rate' => $rate->id, 'group' =>
                            $request['group_id']]), 'published' => $published])
                        ->render();
                    $actions .= $active;

                    $results = view('backend.datatable.action-result')
                        ->with(['route' => $resultsUrl])
                        ->render();
                    $actions .= $results;
                    $deleteUrl = route('admin.groups.rates.detach', ['id' => $rate->id, 'group_id' => $request->group_id]);
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


    public function create()
    {
        return view('backend.courses.groups.rates.create');
    }

    public function store(Request $request)
    {
        // Validate the request
        $request->validate([
            'title' => 'required',
            'title_ar' => 'required',
            'user_type' => 'required'
        ]);

        // Create a new CourseGroupRates
        $rate = new CourseGroupRates();
        $rate->title = $request->title;
        $rate->title_ar = $request->title_ar;
        $rate->user_type = $request->user_type;
        $rate->published = $request->published;
        $rate->save();


        // Redirect to the CourseGroupRates index
        return redirect()->route('admin.group.rates')->withFlashSuccess(__('alerts.backend.rate.created'));
    }

    public function storeQuestion(Request $request)
    {
        // Validate the request
        $request->validate([
            'title' => 'required',
            'title_ar' => 'required',
            'user_type' => 'required'
        ]);

        // Create a new CourseGroupRates
        $rate = new CourseGroupRates();
        $rate->title = $request->title;
        $rate->title_ar = $request->title_ar;
        $rate->user_type = $request->user_type;
        $rate->published = $request->published;
        $rate->save();

        $request = $this->saveAllFiles($request, 'downloadable_files', CourseGroupRates::class, $rate);

        if ($request->q && is_array($request->q)) {
            foreach ($request->q as $key => $question) {
                $question['user_id'] = auth()->user()->id;
                $q = Question::create($question);
                //if question type is true_false then make it multiple_choice
                if ($q->question_type == 'true_false') {
                    $q->question_type = 'multiple_choice';
                    $q->save();
                }
                $q->courseGroupRates()->sync($rate->id);

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

        // Redirect to the CourseGroupRates index
        return redirect()->route('admin.group.rates')->withFlashSuccess(__('alerts.backend.rate.created'));
    }

    public function show(CourseGroupRates $CourseGroupRates)
    {
    }

    public function edit(CourseGroupRates $rate)
    {
        return view('backend.courses.groups.rates.edit', compact('rate'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param \Illuminate\Http\Request $request
     * @param \App\Models\CourseGroupRates $CourseGroupRates
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {

        $request->validate([
            'title' => 'required',
            'title_ar' => 'required',
            'user_type' => 'required',
        ]);

        $rate = CourseGroupRates::find($id);
        $rate->title = $request->title;
        $rate->title_ar = $request->title_ar;
        $rate->user_type = $request->user_type;
        $rate->published = $request->published;
        $rate->save();

        return redirect()->route('admin.group.rates')->withFlashSuccess(__('alerts.backend.rate.updated'));

    }

    /**
     * Remove the specified resource from storage.
     *
     * @param \App\Models\CourseGroupRates $CourseGroupRates
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $rate = CourseGroupRates::find($id);
        if ($rate->courseGroup()->count() > 0) {
            return redirect()->route('admin.group.rates')
                ->withFlashDanger(__('alerts.backend.rate.group_remove_err'));

        }
        $rate->delete();
        return redirect()->route('admin.group.rates')->withFlashSuccess(__('alerts.backend.rate.deleted'));
    }

    /**
     * Restore the specified resource from storage.
     *
     * @param \App\Models\CourseGroupRates $CourseGroupRates
     * @return \Illuminate\Http\Response
     */
    public function restore($id)
    {
        $rate = CourseGroupRates::withTrashed()->find($id);
        $rate->restore();
        return redirect()->route('admin.group.rates')->withFlashSuccess(__('alerts.backend.rate.restored'));
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param \App\Models\CourseGroupRates $CourseGroupRates
     * @return \Illuminate\Http\Response
     */
    public function forceDelete($id)
    {
        $rate = CourseGroupRates::withTrashed()->find($id);
        $rate->forceDelete();
        return redirect()->route('admin.group.rates')->withFlashSuccess(__('alerts.backend.rate.deleted'));
    }

    public function divisions(CourseGroupRates $rate)
    {
        return view('backend.courses.groups.rates.divisions', compact('rate'));
    }

    public function getDivisionData(Request $request)
    {
        //check if user has permission to view all course groups
        if (!Gate::allows('course_view')) {
            abort(403);
        }

        //check if request has show deleted
        if ($request->show_deleted == 1) {
            $query = RateDivision::onlyTrashed();
            $query = $query->with('rate')->get();
        }else{
            if ($request->rate_id) {
                $query = RateDivision::where('course_group_rates_id', $request->rate_id);
            } else {
                $query = RateDivision::query();
                $query = $query->with('rate')->get();
            }
        }

        return DataTables::of($query)
            ->addIndexColumn()
            ->editColumn('title', function ($division) {
                //if locale is arabic return arabic name else return english
                return app()->getLocale() == 'ar' ? $division->title_ar : $division->title;
            })
            ->editColumn('questions', function ($division) {
                return $division->questions()->count();
            })
            ->editColumn('published', function ($division) {
                return $division->published == 1 ? __('labels.general.active') : __('labels.general.inactive');
            })
            ->addColumn('actions', function ($division) use ($request) {
                $actions = '';

                if ($request->show_deleted == 1) {
                    $actions = view('backend.datatable.action-trashed')->with(['route_label' => 'admin.groups.rate.division', 'label' => 'division', 'value' => $division->id])->render();
                } else {
                    $editUrl = route('admin.groups.rate.division.edit', ['division' => $division->id]);
                    $deleteUrl = route('admin.groups.rate.division.destroy', ['division' => $division->id]);

                    $edit = view('backend.datatable.action-edit')->with(['route' => $editUrl])->render();
                    $actions .= $edit;

                    $delete = view('backend.datatable.action-delete')->with(['route' => $deleteUrl])->render();
                    $actions .= $delete;
                }

                return $actions;
            })
            ->rawColumns(['actions'])
            ->make(true);

    }

    public function divisionCreate(CourseGroupRates $rate)
    {
        return view('backend.courses.groups.rates.division_create', compact('rate'));
    }

    public function divisionStore(Request $request)
    {
        // Validate the request
        $request->validate([
            'title' => 'required',
            'title_ar' => 'required',
            'rate_id' => 'required'
        ]);

        // Create a new RateDivision
        $division = new RateDivision();
        $division->title = $request->title;
        $division->title_ar = $request->title_ar;
        $division->published = $request->published;
        $division->course_group_rates_id = $request->rate_id;
        $division->save();

        if ($request->q && is_array($request->q)) {
            foreach ($request->q as $key => $question) {
                $question['user_id'] = auth()->user()->id;
                $q = Question::create($question);

                //if question type is true_false then make it multiple_choice
                if ($q->question_type == 'true_false') {
                    $q->question_type = 'multiple_choice';
                    $q->save();
                }
                $q->rateDivisions()->sync($division->id);

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

        // Redirect to the RateDivision index
        return redirect()->route('admin.groups.rates.divisions', ['rate' => $request->rate_id])->withFlashSuccess(__('alerts.backend.rate.division.created'));
    }

    public function divisionEdit(RateDivision $division)
    {
        $questions = $division->questions;
        return view('backend.courses.groups.rates.division_edit', compact('division', 'questions'));
    }

    public function divisionUpdate(Request $request, RateDivision $division)
    {

        $request->validate([
            'title' => 'required',
            'title_ar' => 'required',
        ]);

        $division->title = $request->title;
        $division->title_ar = $request->title_ar;
        $division->published = $request->published;
        $division->save();

        if ($request->q && is_array($request->q)) {
            $division->questions()->forceDelete();
            foreach ($request->q as $key => $question) {
                $question['user_id'] = auth()->user()->id;
                $q = Question::create($question);
                $q->rateDivisions()->sync($division->id);

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

        return redirect()->route('admin.groups.rates.divisions', ['rate' => $division->rate->id])->withFlashSuccess(__('alerts.backend.rate.division.updates'));
    }

    public function divisionDestroy(RateDivision $division)
    {
        $division->delete();
        return redirect()->route('admin.groups.rates.divisions', ['rate' => $division->rate->id])->withFlashSuccess(__('alerts.backend.rate.division.deleted'));
    }

    public function divisionRestore($division)
    {
        $division = RateDivision::withTrashed()->findOrfail($division);
        $division->restore();
        return redirect()->route('admin.groups.rates.divisions', ['rate' => $division->rate->id])->withFlashSuccess(__('alerts.backend.rate.division.restored'));
    }

    public function divisionForceDelete($division)
    {
        $division = RateDivision::withTrashed()->findOrfail($division);
        $division->forceDelete();
        return redirect()->route('admin.groups.rates.divisions', ['rate' => $division->rate->id])->withFlashSuccess(__('alerts.backend.rate.division.deleted'));
    }


    public function detach(Request $request)
    {
        $rate = CourseGroupRates::where('id', $request->id)->whereHas('courseGroup', function ($q) use ($request) {
            $q->where('course_group_id', $request->group_id);
        })->first();
        $rate->courseGroup()->detach($request->group_id);
        return back()->withFlashSuccess(__('alerts.backend.rate.group_detached'));

    }

    public function groupAttach(CourseGroup $group)
    {
        //if locale is arabic return arabic name else return english
        if (app()->getLocale() == 'ar') {
            //if $group type is online show all rates where user_type is student else show all rates
            if ($group->courses->type_id == 1) {
                $rates = CourseGroupRates::where('user_type', 'student')->get()->pluck('title_ar', 'id');
            } else {
                $rates = CourseGroupRates::all()->pluck('title_ar', 'id');
            }
        } else {
            if ($group->courses->type_id == 1) {
                $rates = CourseGroupRates::where('user_type', 'student')->get()->pluck('title', 'id');
            } else {
                $rates = CourseGroupRates::all()->pluck('title', 'id');
            }
        }
        return view('backend.courses.groups.rates.add', compact('group', 'rates'));
    }

    public function groupAttachStore(Request $request)
    {
        $group = CourseGroup::find($request->group_id);
        foreach ($request->rates as $rate) {
           //check if rate already attached to group
            if ($group->rates->contains($rate)) {
                return back()->withFlashDanger(__('alerts.backend.rate.group_attached'));
            }
            $group->rates()->attach($rate, ['published' => $request->published]);
        }
        return redirect()->route('admin.group.rates', ['group_id' => $group->id])->withFlashSuccess(__('alerts.backend.rate.group_attached_success'));
    }

    public function getGroupRates(CourseGroup $group, CourseGroupRates $rate)
    {

        return view('backend.courses.groups.rates.view', compact('group', 'rate'));
    }

    public function getGroupRates2(Request $request)
    {
        $rates = [];
        $group = [];
        if ($request->user_id) {
           $rates = CourseGroupRates::whereHas('questions.answers', function ($query) use ($request) {
                $query->where('user_id', $request->user_id);
            })->get();
        }
        if ($request->group_id) {
            $group = CourseGroup::find($request->group_id);
            $rates = $group->rates;

        }
        return view('backend.courses.groups.rates.view', compact('group', 'rates'));
    }

    public function rateStudent(CourseGroup $group, Request $request)
    {
        $student = $group->students()->wherePivot('student_id', $request->student)->firstOrFail();
        $rates = $group->rates()->where('user_type', 'teacher_rate_student')->where('published', 1)->get();
        return view('frontend.courses.course_details_rates', compact('rates', 'group', 'student'));
    }

    public function activateGroupRate(Request $request)
    {
        if (!Gate::allows('test_edit')) {
            return abort(401);
        }

        $group = CourseGroup::findOrFail($request->group);
        $rate = CourseGroupRates::findOrFail($request->rate);

        // Update the published status of the rate
        $group->rates()->updateExistingPivot($rate->id, ['published' => $request->published]);

        return redirect()->back()->withFlashSuccess('The rate has been successfully activated.');
    }

}