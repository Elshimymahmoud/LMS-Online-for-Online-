<?php

namespace App\Http\Controllers\Backend\Admin;

use App\Http\Controllers\Controller;
use App\Http\Controllers\Traits\FileUploadTrait;
use App\Models\Chapters;
use App\Models\Course;
use App\Models\CourseGroup;
use App\Models\CourseGroupTest;
use App\Models\GroupTimeline;
use App\Models\Lesson;
use App\Models\Question;
use App\Models\QuestionsOption;
use App\Models\Result;
use App\Models\ResultsAnswer;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Gate;
use Illuminate\Support\Str;
use Illuminate\Validation\Rule;
use Yajra\DataTables\Facades\DataTables;

class CourseGroupTestController extends Controller
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

        return view('backend.courses.groups.tests.index');
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
                $query = CourseGroupTest::whereHas('courseGroups', function ($q) use ($request) {
                    $q->where('course_group_id', $request->group_id);
                })->onlyTrashed();
            }else{
                $query = CourseGroupTest::onlyTrashed();
            }
        } elseif (isset($request->group_id)) {
            $query = CourseGroupTest::whereHas('courseGroups', function ($q) use ($request) {
                $q->where('course_group_id', $request->group_id);
            });
        } else {
            $query = CourseGroupTest::query();
        }
        $query->withCount('questions'); // get the number of questions
        $query->withCount('courseGroups'); // get the number of course groups related to it
        $query->with('courseGroups');


        $tests = $query->get();
        // get nedded data
        $tests = $tests->map(function ($test) use ($request) {

            $published = $test->published;
            if(isset($request->group_id)){
                $published = $test->courseGroups->where('id', $request->group_id)->first()->pivot->published;
            }

            return [
                'id' => $test->id,
                'title' => $test->title,
                'title_ar' => $test->title_ar,
                'questions_count' => $test->questions_count,
                'course_groups_count' => $test->course_groups_count,
                'published' => $published,
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
            $has_copy = true;
            $has_arrang = true;
        }
        if (auth()->user()->can('test_delete')) {
            $has_delete = true;
        }

        return DataTables::of($tests)
            ->addIndexColumn()
            ->addColumn('title', function ($row) {
                return app()->getLocale() == 'ar' ? $row['title_ar'] : $row['title'];
            })
            ->addColumn('questions_count', function ($row) {
                return $row['questions_count'];
            })
            ->addColumn('course_groups_count', function ($row) {
                return $row['course_groups_count'];
            })
            ->addColumn('published', function ($row) {
                return $row['published'] ? __('labels.general.active') : __('labels.general.inactive');
            })
            ->addColumn('actions', function ($q) use ($has_view, $has_edit, $has_delete, $has_arrang, $request) {
                $view = "";
                $edit = "";
                $delete = "";
                $arrang = "";
                $results = "";

                if ($request->group_id) {
                    // active btn
                    $active = view('backend.datatable.action-status')
                        ->with(['route' => route('admin.courses.groups.tests2.activate', ['test' => $q['id'], 'group' =>
                            $request['group_id']]), 'published' => $q['published']])
                        ->render();
                    $view .= $active;

                    $resultsUrl = route('admin.courses.groups.tests2.result', ['test' => $q['id'], 'group' =>
                        $request->group_id]);
                    $results = view('backend.datatable.action-result')
                        ->with(['route' => $resultsUrl])
                        ->render();
                    $view .= $results;

//
//                    if ($has_arrang) {
//                        $arrang = view('backend.datatable.action-arrang')
//                            ->with(['route' => route('admin.courses.groups.tests2.rearrange', ['test' => $q['id']])])
//                            ->render();
//                        $view .= $arrang;
//                    }

                    if ($has_delete && \Auth::user()->id == 1) {
                        $delete = view('backend.datatable.action-delete')
                            ->with(['route' => route('admin.courses.groups.tests2.detach', ['test' => $q['id'], 'group' =>
                                $request['group_id']])])
                            ->render();
                        $view .= $delete;
                    }

                }else{
                    if ($request->show_deleted ==1) {
                        $view = view('backend.datatable.action-trashed')->with(['route_label' => 'admin.courses.groups.tests2', 'label' =>
                            'id', 'value' =>$q['id']])->render();
                    }else{
                        if ($has_edit) {
                            $edit = view('backend.datatable.action-edit')
                                ->with(['route' => route('admin.courses.groups.tests2.edit', ['test' => $q['id']])])
                                ->render();
                            $view .= $edit;
                        }
                        if ($has_delete && \Auth::user()->id == 1) {
                            $delete = view('backend.datatable.action-delete')
                                ->with(['route' => route('admin.test.destroy', ['test' => $q['id']])])
                                ->render();
                            $view .= $delete;
                        }
                        if ($has_arrang) {
                            $arrang = view('backend.datatable.action-arrang')
                                ->with(['route' => route('admin.courses.groups.tests2.rearrange', ['test' => $q['id']])])
                                ->render();
                            $view .= $arrang;
                        }
                    }
                }

                return $view;
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
    public function getCourseChapters(Request $request)
    {
        $course_id = $request->course_id;
        //get chapters name_ar if locale is arabic else get name and id
        if (app()->getLocale() == 'ar') {
            $chapters = Chapters::where('course_id', $course_id)->pluck('title_ar', 'id');
        } else {
            $chapters = Chapters::where('course_id', $course_id)->pluck('title', 'id');
        }
        return response()->json($chapters);
    }

    public function getCourseLessons(Request $request){
        $chapter_id = $request->chapter_id;
        if(app()->getLocale() == 'ar'){
            $lessons = Lesson::where('chapter_id', $chapter_id)->pluck('title_ar', 'id');
        }else{
            $lessons = Lesson::where('chapter_id', $chapter_id)->pluck('title', 'id');
        }
        return response()->json($lessons);
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

        return view('backend.courses.groups.tests.create');

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

        $courseGroupTest = CourseGroupTest::create($request->all());
//        $request = $this->saveAllFiles($request, 'downloadable_files', CourseGroupTest::class, $courseGroupTest);


        //if slug is empty or null, generate a new slug from the title and id
        if ($courseGroupTest->slug == null || $courseGroupTest->slug == '') {
            $courseGroupTest->slug = $courseGroupTest->id . '-' . Str::slug($courseGroupTest->title);
            $courseGroupTest->save();
        }

        //if request has questions save the questions
        if ($request->q && is_array($request->q)) {
            foreach ($request->q as $key => $question) {

                $question['user_id'] = auth()->user()->id;
                $q = Question::create($question);
                //if question type is true_false then make it multiple_choice
                if ($q->question_type == 'true_false') {
                    $q->question_type = 'multiple_choice';
                    $q->save();
                }
                $q->courseGroupTests()->sync($courseGroupTest->id);

                // If the question has image, save it
                if (isset($question['image'])) {
                    $image = $question['image'];
                    $image = $question['image'];
                    $originalName = pathinfo($image->getClientOriginalName(), PATHINFO_FILENAME); // Get original file name without extension
                    $extension = $image->getClientOriginalExtension(); // Get file extension
                    $time = time(); // Get current time
                    $randomCharacter = chr(rand(97, 122)); // Generate a random lowercase letter

                    $imageName = $originalName . '_' . $time . '_' . $randomCharacter . '.' . $extension;
                    $destinationPath = public_path('/storage/questions');
                    $image->move($destinationPath, $imageName);
                    $q->question_image = $imageName;
                    $q->save();
                }

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

        return redirect()->route('admin.courses.groups.tests2.index')->withFlashSuccess(trans('alerts.backend.test.created'));

    }

    /**
     * Display the specified resource.
     *
     * @param \App\Models\CourseGroupTest $courseGroupTest
     * @return \Illuminate\Http\Response
     */
    public function show(CourseGroupTest $courseGroupTest)
    {
        // Return view or JSON response for a single CourseGroupTest
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param \App\Models\CourseGroupTest $courseGroupTest
     * @return \Illuminate\Http\Response
     */
    public function edit(CourseGroupTest $test)
    {
        //get questions and options for the test
        $questions = $test->questions()->with('options')->get();
        return view('backend.courses.groups.tests.edit', compact('test', 'questions'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param \Illuminate\Http\Request $request
     * @param \App\Models\CourseGroupTest $courseGroupTest
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request)
    {
        if (!Gate::allows('test_edit')) {
            return abort(401);
        }
        $test = CourseGroupTest::find($request->id);
        $test->update($request->all());

        //if slug is empty or null, generate a new slug from the title and id
        if ($test->slug == null || $test->slug == '') {
            $test->slug = $test->id . '-' . Str::slug($test->title);
            $test->save();
        }

        //save all files
        $request = $this->saveAllFiles($request, 'downloadable_files', CourseGroupTest::class, $test);

        //if request has same questions update them else delete all questions and create new ones
        if ($request->q && is_array($request->q)) {
            $test->questions()->forceDelete();
            foreach ($request->q as $key => $question) {
                //if nothing is in the array except one element which is the id of the question, then it is an deleted question do not create it
                if (count($question) == 1 && isset($question['id'])) {
                    continue;
                } else {
                    $question['user_id'] = auth()->user()->id;
                    $q = Question::create($question);
                    //if question type is true_false then make it multiple_choice
                    if ($q->question_type == 'true_false') {
                        $q->question_type = 'multiple_choice';
                        $q->save();
                    }
                    $q->courseGroupTests()->sync($test->id);

                }

                if (isset($question['image'])) {
                    $image = $question['image'];
                    $originalName = pathinfo($image->getClientOriginalName(), PATHINFO_FILENAME); // Get original file name without extension
                    $extension = $image->getClientOriginalExtension(); // Get file extension
                    $time = time(); // Get current time
                    $randomCharacter = chr(rand(97, 122)); // Generate a random lowercase letter

                    $imageName = $originalName . '_' . $time . '_' . $randomCharacter . '.' . $extension;
                    $destinationPath = public_path('/storage/questions');
                    $image->move($destinationPath, $imageName);
                    $q->question_image = $imageName;
                    $q->save();
                }

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

        return redirect()->route('admin.courses.groups.tests2.index')->withFlashSuccess(trans('alerts.backend.test.updated'));

    }

    /**
     * Remove the specified resource from storage.
     *
     * @param \App\Models\CourseGroupTest $courseGroupTest
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        if (!Gate::allows('test_delete')) {
            return abort(401);
        }
        $test = CourseGroupTest::find($id);
        if ($test->courseGroups()->count() > 0) {
            return redirect()->route('admin.courses.groups.tests2.index')
                ->withFlashDanger(__('alerts.backend.test.group_remove_err'));
        }
        $test->delete();
        return redirect()->route('admin.courses.groups.tests2.index')->withFlashSuccess(trans('alerts.backend.test.deleted'));
    }

    /**
     * Restore the specified resource from storage.
     *
     * @param \App\Models\CourseGroupTest $courseGroupTest
     * @return \Illuminate\Http\Response
     */
    public function restore($id)
    {
        if (!Gate::allows('test_delete')) {
            return abort(401);
        }
        $test = CourseGroupTest::withTrashed()->find($id);
        $test->restore();
        return redirect()->route('admin.courses.groups.tests2.index')->withFlashSuccess(trans('alerts.backend.test.restored'));
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param \App\Models\CourseGroupTest $courseGroupTest
     * @return \Illuminate\Http\Response
     */
    public function forceDelete($id)
    {
        if (!Gate::allows('test_delete')) {
            return abort(401);
        }
        $test = CourseGroupTest::withTrashed()->find($id);
        $test->forceDelete();
        return redirect()->route('admin.courses.groups.tests2.index')->withFlashSuccess(trans('alerts.backend.test.deleted'));
    }

    /**
     * Rearrange the questions of a test
     *
     * @param \App\Models\CourseGroupTest $courseGroupTest
     * @return \Illuminate\Http\Response
     */
    public function rearrange($id)
    {
        // Check if the user is authorized to rearrange the questions
        if (!Gate::allows('test_edit')) {
            return abort(401);
        }
        //if sequence is null then order by id else order by sequence
        if (CourseGroupTest::find($id)->questions()->first()->sequence == null) {
            $test = CourseGroupTest::find($id);
            $questions = $test->questions()->orderBy('questions.id')->get();
            $chapters = $test->chapters()->orderBy('sequence', 'asc')->get();

        } else {
            $test = CourseGroupTest::find($id);
            $questions = $test->questions()->orderBy('questions.sequence')->get();
            $chapters = $test->chapters()->orderBy('sequence', 'asc')->get();
        }

        return view('backend.courses.groups.tests.rearrange', compact('questions', 'test', 'chapters'));
    }

    /**
     * Save the sequence of the questions
     *
     * @param \Illuminate\Http\Request $request
     * @return \Illuminate\Http\Response
     */
    public function saveSequence(Request $request)
    {
        // Check if the user is authorized to rearrange the questions
        if (!Gate::allows('test_edit')) {
            return abort(401);
        }

        foreach ($request->list as $item) {
            $Question = Question::find($item['id']);
            $Question->sequence = $item['sequence'];
            $Question->save();
        }

        return response()->json(['success' => true]);
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
            $tests = CourseGroupTest::all()->pluck('title_ar', 'id');
            $chapters = $group->courses->chapters->pluck('title_ar', 'id');
        } else {
            $tests = CourseGroupTest::all()->pluck('title', 'id');
            $chapters = $group->courses->chapters->pluck('title', 'id');
        }

        // Return the add form view with the course groups and tests
        return view('backend.courses.groups.tests.add', compact('group', 'tests', 'chapters'));
    }

    /**
     * Attach a group to a test.
     *
     * @param \Illuminate\Http\Request $request
     * @return \Illuminate\Http\Response
     */
    public function saveGroupTest(Request $request)
    {
        // Check if the user is authorized to attach a group to a test
        if (!Gate::allows('test_edit')) {
            return abort(401);
        }

        // Validate the request data
        $request->validate([
            'group_id' => 'required|exists:course_groups,id',
            'test' => 'required|exists:tests,id',
            'chapter' => [
                Rule::requiredIf(function () use ($request) {
                    $group = CourseGroup::findOrFail($request->group_id);
                    return $group->courses && $group->courses->type_id == 1;
                }),
                'exists:chapters,id'
            ],
        ]);

        // Find the course group and test
        $courseGroup = CourseGroup::find($request->group_id);
        $courseGroupTest = CourseGroupTest::find($request->test);

        // Check if the group is already attached to the test
        if ($courseGroupTest->courseGroups->contains($courseGroup)) {
            return redirect()->back()->withFlashWarning(trans('alerts.backend.test.group_already_attached'));
        }

        // Attach the group to the test with the additional data
        $courseGroupTest->courseGroups()->attach($courseGroup->id, [
            'chapter_id' => $request->chapter,
            'published' => $request->published
        ]);

        $courseGroupTest->chapters()->attach($request->chapter);

        $group = CourseGroup::findOrFail($request->group_id);

        // Get the GroupTimeline entries for the group
        $groupTimelines = GroupTimeline::where('group_id', $group->id)->get();

        // Add test to the group timeline
        $this->checkAndCreateTimeline($group, $courseGroupTest, CourseGroupTest::class, $groupTimelines);

        // Redirect back with a success message
        return redirect()->route('admin.courses.groups.tests2.index', ['group_id' => $group->id])->withFlashSuccess(trans('alerts.backend.test.group_attached'));
    }

    public function activateGroupTest(Request $request)
    {
        if (!Gate::allows('test_edit')) {
            return abort(401);
        }

        $group = CourseGroup::findOrFail($request->group);
        $test = CourseGroupTest::findOrFail($request->test);

        // Update the published status of the test
        $group->tests()->updateExistingPivot($test->id, ['published' => $request->published]);

        return redirect()->back()->withFlashSuccess('The test has been successfully activated.');
    }

    public function groupDetach(Request $request)
    {
        // Check if the user is authorized to detach a group from a test
        if (!Gate::allows('test_edit')) {
            return abort(401);
        }

        // Find the course group and test
        $courseGroup = CourseGroup::find($request->group);
        $courseGroupTest = CourseGroupTest::find($request->test);

        // Detach the chapters from the test
        foreach ($courseGroupTest->chapters as $chapter) {
            $courseGroupTest->chapters()->detach($chapter->id);
        }

        // Detach the group from the test
        $courseGroupTest->courseGroups()->detach($courseGroup->id);



        // Redirect back with a success message
        return redirect()->back()->withFlashSuccess(trans('alerts.backend.test.group_detached'));
    }

    public function results(CourseGroupTest $test, Request $request)
    {

        if($request->test){
            $test = CourseGroupTest::findOrFail($request->test);
        }
        // Check if the user is authorized to view the test results
        if (!Gate::allows('test_view')) {
            return abort(401);
        }


        if($request->user_id && $request->group){
            $courseGroup = CourseGroup::find($request->group);
            $test = [];
            $results = [];
            $testResults = collect();
            foreach ($courseGroup->tests as $test) {
                $results = $test->results()->where('user_id', $request->user_id)->get();
            }
            $testResults = $testResults->concat($results);
        }
        elseif($request->user_id){
            $testResults = Result::where('user_id', $request->user_id)->get();
            $courseGroup = [];
        }
        elseif ($request->group){
            $courseGroup = CourseGroup::find($request->group);
            $test = $test->first();
            $testResults = $test->results()->where('course_group_id', $request->group)->get();

        }
        else{
            $test = $test->first();
            $courseGroup = CourseGroup::find($request->group);
            $testResults = $test->first()->results;
        }

        // Return the view with the test results
        return view('backend.courses.groups.tests.result', compact('test', 'courseGroup', 'testResults'));
    }

    public function studentResult(CourseGroupTest $test, Result $result, Request $request)
    {
        // Check if the user is authorized to view the test results
        if (!Gate::allows('test_view')) {
            return abort(401);
        }

        // Find the test res = $tesults related to the course group
        $questions = $test->questions;
        $answers = $result->answers;
//        dd($answers, $questions);

        // Return the view with the test results
        return view('backend.courses.groups.tests.student_result', compact('test', 'result', 'questions', 'answers'));
    }

    public function markStudentAnswer(Request $request)
    {
        $answer = ResultsAnswer::findOrFail($request->answer_id);
        $answer->correct = 1;
        $answer->save();

        $score = $answer->question->score;
        $result = $answer->testResult;
        $result->test_result += $score;
        $result->save();


        return back()->withFlashSuccess('The answer has been marked as correct.');
    }

    private function checkAndCreateTimeline($group, $model, $modelClass, $groupTimelines)
    {
        if (!Gate::allows('group_edit')) {
            return abort(401);
        }
        // Check if the model is in the GroupTimeline
        $inTimeline = $groupTimelines->contains(function ($timeline) use ($model, $modelClass, $group) {
            return $timeline->model_type == $modelClass && $timeline->model_id == $model->id && $timeline->group_id == $group->id;
        });
        // If the model is not in the GroupTimeline, create a new GroupTimeline entry for it
        if (!$inTimeline) {
            $maxSequence = GroupTimeline::where('group_id', $group->id)->max('sequence');
            $groupTimeline = new GroupTimeline();
            $groupTimeline->model_type = $modelClass;
            $groupTimeline->model_id = $model->id;
            $groupTimeline->group_id = $group->id;
            $groupTimeline->sequence = $maxSequence + 1;
            $groupTimeline->save();
        }
    }

}