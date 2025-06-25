<?php

namespace App\Http\Controllers\Backend;

use App\Models\QuestionAnswers;
use App\Models\RateQuestion;
use Illuminate\Http\Request;
use App\Models\UserCourseRate;
use App\Models\UserCourseForm;

use App\Models\UserFormAnswer;
use App\Models\Question;

use App\Models\UserRateAnswer;
use App\Http\Controllers\Controller;
use App\Models\Auth\User;
use App\Models\CourseForms;
use App\Models\Forms;
use App\Models\Media;
use App\Models\QuestionsOption;
use App\Models\Result;
use Illuminate\Support\Facades\Hash;

class AnswerController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    // public function store(Request $request)
    // {
    //     //
    //     $request_rates=$request->rate_ids;

    //     $user=auth()->user();
    //     $UserCourseRates=UserCourseRate::where('user_id',$user->id)->pluck('rate_id')->toArray();
        
    //     // dd($UserCourseRates);

    //     foreach ($request_rates as $key => $rate) {
    //         # code...
    //        if(!in_array($rate,$UserCourseRates)){
    //         $newUserCourseRate=new UserCourseRate();
    //         $newUserCourseRate->rate_id=$rate;
    //         $newUserCourseRate->user_id=$user->id;
    //         $newUserCourseRate->course_id=$request->course_id;
    //         $newUserCourseRate->save();
        
    //         $rateQuestions=RateQuestion::where('rate_id','=',$rate)->pluck('id')->toArray();
         
    //         foreach ($rateQuestions as $key => $rateQuestion) {
    //             # code...
    //             $option=$rateQuestion.'-options'; //Answer
    //             $newUserRateAnswer=new UserRateAnswer();
    //             $newUserRateAnswer->user_course_rate_id=$newUserCourseRate->id;
    //             $newUserRateAnswer->rate_question_id=$rateQuestion;
    //             if(isset($request->$option))
    //             {                
    //                 $newUserRateAnswer->answer=$request->$option;
    //             }
    //             else
    //             {            
    //                 $newUserRateAnswer->answer=null;                
    //             }
    //             $newUserRateAnswer->save();

    //         }
    //      }
       

    //     }
    //     return redirect()->back()->withFlashSuccess(trans('alerts.backend.general.created'));

       
    // }
    
   
//    public function store(Request $request)
//    {
//        //
//
//        $request_rates=$request->rate_ids;
//        $user=auth()->user();
//        $student_id=$request->student_id??null;
//
//        if($student_id==null)
//        $UserCourseRates=UserCourseForm::where('user_id',$user?$user->id:0)
//        ->where('course_id',$request->course_id)->pluck('form_id')->toArray();
//       else
//       $UserCourseRates=UserCourseForm::where('user_id',$user->id)
//       ->where('course_id',$request->course_id)->where('student_id',$student_id)->pluck('form_id')->toArray();
//
//       foreach ($request_rates as $key => $form_id) {
//            # code...
//
//            $form=Forms::findOrFail($form_id);
//                   // save user as teacher if form is training data form
//                   if($form->form_type=='training_data'){
//
//                    if($request->by_link && !auth()->user()){
//
//                        $rateQuestions=Question::whereHas('forms',function($query) use($form_id){
//                            $query->where('forms_id','=',$form_id);
//                        })->get();
//
//                       $newUser=new User();
//                        foreach ($rateQuestions as $key2 => $rateQuestion) {
//
//                            if($rateQuestion->question=='Name'){
//                                $option=$rateQuestion->id.'-options';
//                                $newUser->name_ar=$request->$option;
//                            }
//
//                            if($rateQuestion->question=='Email'){
//                                $option=$rateQuestion->id.'-options';
//                                $newUser->email=$request->$option;
//                            }
//                            if($rateQuestion->id==220){//   رقم الجوال- للاتصال
//                                $option=$rateQuestion->id.'-options';
//                                $newUser->phone=$request->$option;
//                            }
//                            if($rateQuestion->id==223){//    الجنسية-
//                                $option=$rateQuestion->id.'-options';
//                                $newUser->nationality=$request->$option;
//                            }
//                            if($rateQuestion->id==224){//    المدينة-
//                                $option=$rateQuestion->id.'-options';
//                                $newUser->city=$request->$option;
//                            }
//                            $newUser->password=Hash::make('123456');
//                            $newUser->is_active=0;
//
//
//                        }
//
//                        if($newUser->email){
//                            $user=User::where('email',$newUser->email)->first();
//
//                            if(!$user){
//                            $newUser->save();
//
//                            }
//                            $user=$newUser;
//
//                        }
//                    }
//                }
//            $test_result = Result::updateOrCreate([
//                'course_forms_id' => $form->course()->where('courses.id',$request->course_id)->first()->pivot->id??null,
//                'user_id' => \Auth::id(),
//                'test_result' => 0,
//            ]);
//
//            if($form->form_type=='complainment'){
//                $courseForm=CourseForms::updateOrCreate([
//                    'forms_id'=>$form->id,
//                     'course_id'=>NULL
//                ]);
//
//                $newUserCourseRate=UserCourseForm::
//                where(['user_id'=>$user->id,'form_id'=>$form_id])->first();
//                $test_result = Result::Create([
//                    'course_forms_id' => $courseForm->id,
//                    'user_id' => \Auth::id(),
//                    'test_result' => 0,
//                ]);
//            }
//
//           if(!in_array($form_id,$UserCourseRates)||($form->form_type=='complainment'||$form->form_type=='training_data'))
//                $newUserCourseRate=new UserCourseForm();
//           else{
//                if($student_id==null){
//                $newUserCourseRate=UserCourseForm::
//                where(['user_id'=>$user->id,'form_id'=>$form_id,'course_id'=>$request->course_id])->first();
//
//                }
//                else
//                $newUserCourseRate=UserCourseForm::
//                where(['user_id'=>$user->id,'student_id'=>$student_id,'form_id'=>$form_id,'course_id'=>$request->course_id])->first();
//            }
//
//            $newUserCourseRate->form_id=$form_id;
//            $newUserCourseRate->user_id=$user?$user->id:0;
//            $newUserCourseRate->student_id=$student_id;
//
//            $newUserCourseRate->course_id=$request->course_id;
//            $newUserCourseRate->save();
//
//            $rateQuestions=Question::whereHas('forms',function($query) use($form_id){
//                $query->where('forms_id','=',$form_id);
//            })->get()->pluck('id')->toArray();
//
//            foreach ($rateQuestions as $key => $rateQuestion) {
//                # code...
//
//                Media::where('model_type', 'App\Models\Result')
//                ->where('model_id', \Auth::id())
//                ->where('file_name', $rateQuestion)
//                ->forceDelete();
//                $option=$rateQuestion.'-options'; //Answer
//                $Answers=[
//                    'user_course_form_id'=>$newUserCourseRate->id,
//                    'question_id'=>$rateQuestion
//                ];
//                $Ans=[
//                    'question_id' => $rateQuestion,
//                ];
//                if(isset($request->$option))
//                {
//
//                    $Answers['answer']=$request->$option;
//                    $Ans['option_id']=$request->$option;
//                    $Ans['answer']=$request->$option;
//
//
//
//                }
//                else
//                {
//                    $fileid='answer_file_'.$rateQuestion;
//                    if (isset($request->$fileid)) {
//
//                            $file =$request->file('answer_file_'.$rateQuestion);
//
//                            $filename = time() . '-' . $file->getClientOriginalName();
//                            $size = $file->getSize() / 1024;
//                            $path = public_path() . '/storage/uploads/';
//                            $file->move($path, $filename);
//
//                            $video_id = $rateQuestion;
//                            $url = asset('storage/uploads/' . $filename);
//                            $name = \Auth::id();
//
//
//                            $media = new Media();
//                            $media->model_type = 'App\Models\Result';
//                            $media->model_id = $name;
//                            $media->name = $name;
//                            $media->url = $url;
//                            $media->type = 'answer_file';
//                            $media->file_name = $video_id;
//                            $media->size = $size;
//                            $media->save();
//
//                            $Answers['answer']=$url;
//                            $Ans['option_id']=null;
//                            $Ans['answer']=$url;
//
//                    }
//                    else{
//
//                        $Answers['answer']=null;
//                        $Ans['option_id']=null;
//                        $Ans['answer']=null;
//
//                    }
//                }
//
//                UserFormAnswer::updateOrCreate(
//                    ['user_course_form_id'=>$newUserCourseRate->id,'question_id'=>$rateQuestion],
//                    $Answers
//                );
//
//                $answers[] = $Ans;
//
//                    $test_result->answers()->updateOrCreate(['question_id' => $rateQuestion,'result_id'=>$test_result->id],$Ans);
//
//
//            }
//
//
//
//        }
//
//        return redirect()->back()->withFlashSuccess(trans('alerts.backend.general.created'));
//
//
//    }
    public function storeResultByAdmin(Request $request)
    {
        //
      
        $request_rates=$request->rate_ids;
        $user=auth()->user();
        $student_id=$request->student_id??null;
       
        
       $UserCourseRates=UserCourseForm::
       where('course_id',$request->course_id)->where('student_id',$student_id)->pluck('form_id')->toArray();
      
       foreach ($request_rates as $key => $form_id) {
            # code...
            $form=Forms::findOrFail($form_id);
           
            $test_result = Result::updateOrCreate([
                'course_forms_id' => $form->course()->where('courses.id',$request->course_id)->first()->pivot->id??null,
                'user_id' => $student_id,
                'test_result' => 0,
            ]);
            if($form->form_type=='complainment'){
                $courseForm=CourseForms::updateOrCreate([
                    'forms_id'=>$form->id,
                     'course_id'=>NULL
                ]);
                
                $newUserCourseRate=UserCourseForm::
                where(['user_id'=>$user->id,'form_id'=>$form_id])->first();
                $test_result = Result::Create([
                    'course_forms_id' => $courseForm->id,
                    'user_id' => \Auth::id(),
                    'test_result' => 0,
                ]);
            }
           if(!in_array($form_id,$UserCourseRates)||$form->form_type=='complainment')
                $newUserCourseRate=new UserCourseForm();
           else{
                
                $newUserCourseRate=UserCourseForm::
                where(['student_id'=>$student_id,'form_id'=>$form_id,'course_id'=>$request->course_id])->first();
            }
            $newUserCourseRate->form_id=$form_id;
            $newUserCourseRate->user_id=$user->id;
            $newUserCourseRate->student_id=$student_id;

            $newUserCourseRate->course_id=$request->course_id;
            $newUserCourseRate->save();
        
            $rateQuestions=Question::whereHas('forms',function($query) use($form_id){
                $query->where('forms_id','=',$form_id);
            })->get()->pluck('id')->toArray();
           
            foreach ($rateQuestions as $key => $rateQuestion) {
                # code...
                
                Media::where('model_type', 'App\Models\Result')
                ->where('model_id', \Auth::id())
                ->where('file_name', $rateQuestion)
                ->forceDelete();
                $option=$rateQuestion.'-options'; //Answer
                $Answers=[
                    'user_course_form_id'=>$newUserCourseRate->id,
                    'question_id'=>$rateQuestion
                ];
                $Ans=[
                    'question_id' => $rateQuestion,
                ];
                if(isset($request->$option))
                {                
                    
                    $Answers['answer']=$request->$option;
                    $Ans['option_id']=$request->$option;
                    $Ans['answer']=$request->$option;


                    
                }
                else
                {           
                    $fileid='answer_file_'.$rateQuestion;
                    if (isset($request->$fileid)) {
                       
                            $file =$request->file('answer_file_'.$rateQuestion);
                        
                            $filename = time() . '-' . $file->getClientOriginalName();
                            $size = $file->getSize() / 1024;
                            $path = public_path() . '/storage/uploads/';
                            $file->move($path, $filename);
            
                            $video_id = $rateQuestion;
                            $url = asset('storage/uploads/' . $filename);
                            $name = \Auth::id();
        
        
                            $media = new Media();
                            $media->model_type = 'App\Models\Result';
                            $media->model_id = $name;
                            $media->name = $name;
                            $media->url = $url;
                            $media->type = 'answer_file';
                            $media->file_name = $video_id;
                            $media->size = $size;
                            $media->save();
                             
                            $Answers['answer']=$url;
                            $Ans['option_id']=null;
                            $Ans['answer']=$url;

                    } 
                    else{
                    
                        $Answers['answer']=null;
                        $Ans['option_id']=null;
                        $Ans['answer']=null;

                    }            
                }
             
                UserFormAnswer::updateOrCreate(
                    ['user_course_form_id'=>$newUserCourseRate->id,'question_id'=>$rateQuestion],
                    $Answers
                );
           
                $answers[] = $Ans;
                   
                    $test_result->answers()->updateOrCreate(['question_id' => $rateQuestion,'result_id'=>$test_result->id],$Ans);
                    

            }
      
    

        }
   
        return redirect()->back()->withFlashSuccess(trans('alerts.backend.general.created'));

       
    }
    public function storeResultTestByAdmin(Request $request)
    {
        //
      
        $request_rates=$request->rate_ids;
        $user=auth()->user();
        $student_id=$request->student_id??null;
       $test_result_all=0;
        
       $UserCourseRates=UserCourseForm::where('course_id',$request->course_id)->where('student_id',$student_id)->pluck('form_id')->toArray();
      
       foreach ($request_rates as $key => $form_id) {
            # code...
            $form=Forms::findOrFail($form_id);
           
            $test_result = Result::updateOrCreate([
                'course_forms_id' => $form->course()->where('courses.id',$request->course_id)->first()->pivot->id??null,
                'user_id' => $student_id,
                'test_result' => 0,
                
            ]);
            
            if($form->form_type=='complainment'){
                $courseForm=CourseForms::updateOrCreate([
                    'forms_id'=>$form->id,
                     'course_id'=>NULL
                ]);
                
                $newUserCourseRate=UserCourseForm::
                where(['user_id'=>$user->id,'form_id'=>$form_id])->first();
                $test_result = Result::Create([
                    'course_forms_id' => $courseForm->id,
                    'user_id' => \Auth::id(),
                    'test_result' => 0,
                ]);
            }
           if(!in_array($form_id,$UserCourseRates)||$form->form_type=='complainment')
                $newUserCourseRate=new UserCourseForm();
           else{
                
                $newUserCourseRate=UserCourseForm::
                where(['student_id'=>$student_id,'form_id'=>$form_id,'course_id'=>$request->course_id])->first();
            }
            $newUserCourseRate->form_id=$form_id;
            $newUserCourseRate->user_id=$user->id;
            $newUserCourseRate->student_id=$student_id;

            $newUserCourseRate->course_id=$request->course_id;
            $newUserCourseRate->save();
        
            $rateQuestions=Question::whereHas('forms',function($query) use($form_id){
                $query->where('forms_id','=',$form_id);
            })->get()->pluck('id')->toArray();
           
            foreach ($rateQuestions as $key => $rateQuestion) {
                # code...
                $questionOBJ=Question::find($rateQuestion);
                $optionObj=[];
                Media::where('model_type', 'App\Models\Result')
                ->where('model_id', \Auth::id())
                ->where('file_name', $rateQuestion)
                ->forceDelete();
                $option=$rateQuestion.'-options'; //Answer
                $Answers=[
                    'user_course_form_id'=>$newUserCourseRate->id,
                    'question_id'=>$rateQuestion
                ];
                $Ans=[
                    'question_id' => $rateQuestion,
                ];
                if(isset($request->$option))
                {                
                    $optionObj=QuestionsOption::find($request->$option);
                    
                    $Answers['answer']=$request->$option;
                    $Ans['option_id']=$request->$option;
                    $Ans['answer']=$request->$option;
                    $Ans['correct']=$optionObj?$optionObj->correct:0;
                    if($optionObj&&$optionObj->correct==1)
                    {
                        $test_result_all+=$questionOBJ->score;
                    }  
                    
                }
                else
                {           
                    $fileid='answer_file_'.$rateQuestion;
                    if (isset($request->$fileid)) {
                       
                            $file =$request->file('answer_file_'.$rateQuestion);
                        
                            $filename = time() . '-' . $file->getClientOriginalName();
                            $size = $file->getSize() / 1024;
                            $path = public_path() . '/storage/uploads/';
                            $file->move($path, $filename);
            
                            $video_id = $rateQuestion;
                            $url = asset('storage/uploads/' . $filename);
                            $name = \Auth::id();
        
        
                            $media = new Media();
                            $media->model_type = 'App\Models\Result';
                            $media->model_id = $name;
                            $media->name = $name;
                            $media->url = $url;
                            $media->type = 'answer_file';
                            $media->file_name = $video_id;
                            $media->size = $size;
                            $media->save();
                             
                            $Answers['answer']=$url;
                            $Ans['option_id']=null;
                            $Ans['answer']=$url;

                    } 
                    else{
                    
                        $Answers['answer']=null;
                        $Ans['option_id']=null;
                        $Ans['answer']=null;

                    }    
                      
                }
                $test_result_all+=$questionOBJ->score;
                $test_result = Result::updateOrCreate([
                    'course_forms_id' => $form->course()->where('courses.id',$request->course_id)->first()->pivot->id??null,
                    'user_id' => $student_id,
                    
                    
                ]);
                $test_result->test_result=$test_result_all;
                $test_result->save();
                UserFormAnswer::updateOrCreate(
                    ['user_course_form_id'=>$newUserCourseRate->id,'question_id'=>$rateQuestion],
                    $Answers
                );
           
                $answers[] = $Ans;
                   
                    $test_result->answers()->updateOrCreate(['question_id' => $rateQuestion,'result_id'=>$test_result->id],$Ans);
                    

            }
      
    

        }
   
        return redirect()->back()->withFlashSuccess(trans('alerts.backend.general.created'));

       
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
    }

    public function store(Request $request)
    {
        $form_type = $request->form_type;
        $user = auth()->user();
        
        foreach ($request->all() as $key => $value) {
            if (str_contains($key, '-options')) {
                $question_id = explode('-options', $key)[0];
                $question = Question::find($question_id);
                //if question type is multiple choice save the answer as choice id and type is option
                if ($question->question_type == 'multiple_choice') {
                    $answer = new QuestionAnswers();
                    $answer->question_id = $question_id;
                    $answer->user_id = $user->id;
                    $answer->answer = $value;
                    $answer->answer_type = 'option';
                    if ($form_type == 'teacher_rate_student') {
                        $answer->student_id = $request->student_id;
                    }
                    $answer->group_id = $request->group_id;
                    $answer->save();
                }
                else{
                    $answer = new QuestionAnswers();
                    $answer->question_id = $question_id;
                    $answer->user_id = $user->id;
                    $answer->answer = $value;
                    $answer->answer_type = $question->question_type;
                    if ($form_type == 'teacher_rate_student') {
                        $answer->student_id = $request->student_id;
                    }
                    $answer->group_id = $request->group_id;
                    $answer->save();
                }
            }
            elseif (str_contains($key, 'answer_file_')) {
                $question_id = explode('answer_file_', $key)[1];

                $fileKey = 'answer_file_' . $question_id;
                $file = $request->file($fileKey);
                $filename = time() . '-' . $file->getClientOriginalName();
                $path = public_path() . '/storage/uploads/';
                $file->move($path, $filename);
                $url = 'storage/uploads/' . $filename;
                $answer = new QuestionAnswers();
                $answer->question_id = $question_id;
                $answer->user_id = $user->id;
                $answer->answer = $url;
                $answer->answer_type = 'file';

                if ($form_type == 'teacher_rate_student') {
                    $answer->student_id = $request->student_id;

                }
                $answer->group_id = $request->group_id;
                $answer->save();
            }
        }
        // redirect back to admin -> group -> students route
        if ($form_type == 'teacher_rate_student'){
            return redirect()->route('admin.group.students', ['group' => $request->group_id])->withFlashSuccess(trans('alerts.backend.general.created'));
        }

        return redirect()->back()->withFlashSuccess(trans('alerts.backend.general.created'));
    }

}
