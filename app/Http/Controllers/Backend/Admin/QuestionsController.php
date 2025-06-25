<?php

namespace App\Http\Controllers\Backend\Admin;

use App\Models\Question;
use App\Models\QuestionsOption;
use App\Models\Test;
use App\Models\Forms;

use function foo\func;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Gate;
use App\Http\Controllers\Controller;
use App\Http\Requests\Admin\StoreQuestionsRequest;
use App\Http\Requests\Admin\UpdateQuestionsRequest;
use App\Http\Controllers\Traits\FileUploadTrait;
use Yajra\DataTables\Facades\DataTables;

class QuestionsController extends Controller
{
    use FileUploadTrait;

    /**
     * Display a listing of Question.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $form_type = request('form_type');
        $forms_id = request('forms_id');


        if (!Gate::allows('question_access')) {
            return abort(401);
        }

        if (request('show_deleted') == 1) {
            if (!Gate::allows('question_delete')) {
                return abort(401);
            }
            $questions = Question::onlyTrashed()->get();
        } else {
            $questions = Question::orderBy('created_at', 'desc')->get();
        }

        $tests = Forms::where('published', '=', 1)->where('form_type', $form_type)->pluck('title', 'id')->prepend('Please select', '');
        $questions = Question::whereHas('forms', function ($q) use ($forms_id) {
            $q->where('forms_id', $forms_id);
        })->orderBy('created_at', 'desc')->get();

        return view('backend.questions.index', compact('questions', 'tests', 'form_type'));
    }


    /**
     * Display a listing of Questions via ajax DataTable.
     *
     * @return \Illuminate\Http\Response
     */
    public function getData(Request $request)
    {
        $has_view = false;
        $has_delete = false;
        $has_edit = false;
        $form_type = $request->form_type;

        /*TODO:: Show All questions if Admin, Show related if  Teacher*/
        $questions = Question::orderBy('created_at', 'desc');
        $test = null;

        if ($request->forms_id != "") {
            $forms_id = $request->forms_id;
            $test = Forms::find($forms_id);
            $questions = Question::whereHas('forms', function ($q) use ($forms_id) {
                $q->where('forms_id', $forms_id);
            })->orderBy('created_at', 'desc')->get();
        }

        if (!auth()->user()->role('administrator')) {
            $questions->where('user_id', '=', auth()->user()->id);
        }

        if ($request->show_deleted == 1) {
            if (!Gate::allows('question_delete')) {
                return abort(401);
            }
            $questions->onlyTrashed()->get();
        }


        if (auth()->user()->can('question_view')) {
            $has_view = true;
        }
        if (auth()->user()->can('question_edit')) {
            $has_edit = true;
        }
        if (auth()->user()->can('question_delete')) {
            $has_delete = true;
        }



        return DataTables::of($questions)
            ->addIndexColumn()
            ->addColumn('actions', function ($q) use ($has_view, $has_edit, $has_delete, $request, $form_type) {
                $view = "";
                $edit = "";
                $delete = "";

                if ($request->show_deleted == 1) {
                    return view('backend.datatable.action-trashed')->with(['route_label' => 'admin.questions', 'label' => 'question', 'value' => $q->id]);
                }
                if ($has_view) {
                    $view = view('backend.datatable.action-view')
                        ->with(['route' => route('admin.questions.show', ['questions_option' => $q->id, 'course_id' => $request->course_id, 'forms_id' => $request->forms_id, 'form_type' => $form_type])])->render();
                }
                if ($has_edit) {
                    $edit = view('backend.datatable.action-edit')
                        ->with(['route' => route('admin.questions.edit', ['questions_option' => $q->id, 'course_id' => $request->course_id, 'form_type' => $form_type])])
                        ->render();
                    $view .= $edit;
                }

                if ($has_delete) {
                    $delete = view('backend.datatable.action-delete')
                        ->with(['route' => route('admin.questions.destroy', ['questions_option' => $q->id, 'forms_id' => $request->forms_id, 'test_id' => $request->test_id ?? '', 'course_id' => $request->course_id, 'form_type' => $form_type])])
                        ->render();
                    $view .= $delete;
                }
                return $view;
            })
            ->editColumn('question_image', function ($q) {
                return ($q->question_image != null) ? '<img height="50px" src="' . asset('storage/uploads/' . $q->question_image) . '">' : 'N/A';
            })

            ->addColumn('test', function ($q) use ($test) {
                $questionTestsEn = $q->tests()->pluck('title')->toArray();
                $questionTestsAr = $q->tests()->pluck('title_ar')->toArray();

                return (app()->getLocale() == "ar") ? $questionTestsAr : $questionTestsEn;
            })
            ->rawColumns(['question_image', 'test', 'actions'])
            ->make();
    }

    /**
     * Show the form for creating new Question.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $form_type = request('form_type');
        if ($form_type == 'test') {
            return $this->createTest();
        }
        //    elseif($form_type=='rate' || $form_type=='impact_measurments' )
        else {
            return $this->createForm();
        }
    }

    public function createTest()
    {
        if (!Gate::allows('question_create')) {
            return abort(401);
        }
        $tests = \App\Models\Forms::where('form_type', request('form_type'))->get()->pluck('title', 'id');
        return view('backend.questions.create', compact('tests'));
    }
    public function createForm()
    {
        $forms_id = request('forms_id');
        return view('backend.rateQuestions.question', compact('forms_id'));
    }
    /**
     * Store a newly created Question in storage.
     *
     * @param  \App\Http\Requests\StoreQuestionsRequest $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {


        if (!Gate::allows('question_create')) {
            return abort(401);
        }
        if ($request->form_type == 'test') {
            $StoreQuestionsRequest = new StoreQuestionsRequest();
            $StoreQuestionsRequest->rules($request);
        }
        $request = $this->saveFiles($request);
        $question = Question::create($request->all());
        $question->user_id = auth()->user()->id;
        $question->save();
        if ($request->input('tests')) {
            $question->tests()->sync(array_filter((array)$request->input('tests')));
        } else {
            $question->tests()->sync([$request->input('form_id')]);
        }
        $countChooseNumber = substr_count(json_encode($request->all()), 'option_text_');
        for ($q = 1; $q <= $countChooseNumber; $q++) {
            $option = $request->input('option_text_' . $q, '');
            $explanation = $request->input('explanation_' . $q, '');
            if ($option != '') {
                QuestionsOption::create([
                    'question_id' => $question->id,
                    'option_text' => $option,
                    'explanation' => $explanation,
                    'correct' => $request->input('correct_' . $q)
                ]);
            }
        }

        return redirect()->route('admin.questions.index', ['form_type' => request('form_type'), 'forms_id' => $request->input('form_id')])->withFlashSuccess(trans('alerts.backend.general.created'));
    }


    /**
     * Show the form for editing Question.
     *
     * @param  int $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        if (!Gate::allows('question_edit')) {
            return abort(401);
        }
        $question = Question::findOrFail($id);
        $tests = \App\Models\Forms::where('form_type', request('form_type'))->get()->pluck('title', 'id');

        return view('backend.questions.edit2', compact('question', 'tests'));
    }

    /**
     * Update Question in storage.
     *
     * @param  \App\Http\Requests\UpdateQuestionsRequest $request
     * @param  int $id
     * @return \Illuminate\Http\Response
     */
    public function update(UpdateQuestionsRequest $request, $id)
    {
   
               
       
            if (!isset($request->question)) {
                if (isset($id)) {
                    $question = Question::where(['id' => $id])->first();
                    $question->forceDelete();
                }
            } else {
                $new_q = [];
                $new_q['question'] = $request->question;
                $new_q['question_ar'] = $request->question_ar;
                $new_q['question_type'] = $request->question_type;
                $new_q['score'] = $request->score;

                $new_q['user_id'] = auth()->user()->id;
                $question = Question::updateOrCreate(['id'   => @$id], $new_q);
                // $question->tests()->sync($test->id);
                // dd($request->all());
                if(isset($request->q))
                foreach ($request->q as $q) {
                if (isset($q['option_text']) && count($q['option_text']) > 0) {
                    foreach ($q['option_text'] as $q_option_index => $q_option) {
                        QuestionsOption::updateOrCreate(['id' => @$q['option_id'][$q_option_index]], [
                            'question_id' => $question->id,
                            'option_text' => $q['option_text'][$q_option_index],
                            'option_text_ar' => $q['option_text_ar'][$q_option_index],
                            'correct' => @(int)$q['correct'][$q_option_index]
                        ]);
                    }
                }
            }
            }
        
        return redirect()->route('admin.questions.index',['form_type'=>$request->form_type])->withFlashSuccess(trans('alerts.backend.general.updated'));

    }
    public function updateOld(UpdateQuestionsRequest $request, $id)
    {
        if (!Gate::allows('question_edit')) {
            return abort(401);
        }
        $request = $this->saveFiles($request);
        $question = Question::findOrFail($id);
        $question->update($request->all());
        $question->user_id = auth()->user()->id;
        $question->save();
        $question->tests()->sync(array_filter((array)$request->input('tests')));

        for ($q = 1; $q <= 4; $q++) {
            $option = $request->input('option_text_' . $q, '');
            $explanation = $request->input('explanation_' . $q, '');
            $option_id = $request->input('option_id_' . $q, '');
            $correct = ($request->input('correct_' . $q) == 1) ? 1 : 0;
            if ($option != '') {
                $option_data = QuestionsOption::find($option_id);
                if ($option_data) {
                    $option_data->question_id = $question->id;
                    $option_data->option_text = $option;
                    $option_data->explanation = $explanation;
                    $option_data->correct = $correct;
                    $option_data->save();
                }
            }
        }

        return redirect()->route('admin.questions.index', ['form_type' => $request->form_type])->withFlashSuccess(trans('alerts.backend.general.updated'));
    }
    public function storeQuestion(UpdateQuestionsRequest $request)
    {
   
               
       
           
                $new_q = [];
                $new_q['question'] = $request->question;
                $new_q['question_ar'] = $request->question_ar;
                $new_q['question_type'] = $request->question_type;
                $new_q['score'] = $request->score;

                $new_q['user_id'] = auth()->user()->id;
                $question = Question::updateOrCreate( $new_q);
                // $question->tests()->sync($test->id);
                // dd($request->all());
                if($request->input('form_id')!=0)
                $question->tests()->sync([$request->input('form_id')]);

                if(isset($request->q))
                foreach ($request->q as $q) {
                if (isset($q['option_text']) && count($q['option_text']) > 0) {
                    foreach ($q['option_text'] as $q_option_index => $q_option) {
                        QuestionsOption::updateOrCreate(['id' => @$q['option_id'][$q_option_index]], [
                            'question_id' => $question->id,
                            'option_text' => $q['option_text'][$q_option_index],
                            'option_text_ar' => $q['option_text_ar'][$q_option_index],
                            'correct' => @(int)$q['correct'][$q_option_index]
                        ]);
                    }
                }
            }
            
        
        return redirect()->route('admin.questions.index',['form_type'=>$request->form_type])->withFlashSuccess(trans('alerts.backend.general.updated'));

    }

    /**
     * Display Question.
     *
     * @param  int $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        if (!Gate::allows('question_view')) {
            return abort(401);
        }
        $questions_options = \App\Models\QuestionsOption::where('question_id', $id)->get();
        $tests = \App\Models\Forms::whereHas(
            'questions',
            function ($query) use ($id) {
                $query->where('id', $id);
            }
        )->get();

        $question = Question::findOrFail($id);
        $form_type = request('form_type');

        return view('backend.questions.show', compact('question', 'questions_options', 'tests', 'form_type'));
    }


    /**
     * Remove Question from storage.
     *
     * @param  int $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        if (!Gate::allows('question_delete')) {
            return abort(401);
        }
        $question = Question::findOrFail($id);
        if (request()->get('forms_id'))
            \DB::table('question_form')->where('question_id', $id)->where('forms_id', request()->get('forms_id'))->delete();
        else
            \DB::table('question_form')->where('question_id', $id)->delete();

        $question->delete();

        return redirect()->route('admin.questions.index', ['forms_id' => request('forms_id'), 'form_type' => request('form_type')])->withFlashSuccess(trans('alerts.backend.general.deleted'));
    }

    /**
     * Delete all selected Question at once.
     *
     * @param Request $request
     */
    public function massDestroy(Request $request)
    {
        if (!Gate::allows('question_delete')) {
            return abort(401);
        }
        if ($request->input('ids')) {
            $entries = Question::whereIn('id', $request->input('ids'))->get();

            foreach ($entries as $entry) {
                $entry->delete();
            }
        }
    }


    /**
     * Restore Question from storage.
     *
     * @param  int $id
     * @return \Illuminate\Http\Response
     */
    public function restore($id)
    {
        if (!Gate::allows('question_delete')) {
            return abort(401);
        }
        $question = Question::onlyTrashed()->findOrFail($id);
        $question->restore();

        return redirect()->route('admin.questions.index')->withFlashSuccess(trans('alerts.backend.general.restored'));
    }

    /**
     * Permanently delete Question from storage.
     *
     * @param  int $id
     * @return \Illuminate\Http\Response
     */
    public function perma_del($id)
    {
        if (!Gate::allows('question_delete')) {
            return abort(401);
        }
        $question = Question::onlyTrashed()->findOrFail($id);
        $question->forceDelete();

        return redirect()->route('admin.questions.index')->withFlashSuccess(trans('alerts.backend.general.deleted'));
    }
}
