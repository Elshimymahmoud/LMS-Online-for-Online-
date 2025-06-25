<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Services\OcrServices;
use App\Http\Controllers\Services\PlagiarismServices;
use App\Models\ActivityResult;
use App\Models\CourseGroup;
use App\Models\CourseGroupTest;
use App\Models\GroupActivity;
use App\Models\Tag;
use App\Models\Blog;
use App\Models\Test;
use App\Models\Forms;

use App\Models\Media;
use App\Models\Course;
use App\Models\Lesson;
use App\Models\Category;
use App\Models\Question;
use App\Helpers\Auth\Auth;
use App\Models\TestsResult;
use App\Models\Result;

use Illuminate\Http\Request;
use App\Models\VideoProgress;
use Illuminate\Http\Response;
use App\Models\QuestionsOption;
use App\Models\programRecommendation;
use App\Models\ImpactMeasurement;




use App\Http\Controllers\Traits\CheckUserFillData;


class LessonsController extends Controller
{
   
    private $path;
    use CheckUserFillData;

    private $plagiarismServices;
    private $ocrServices;

    public function __construct(PlagiarismServices $plagiarismService, OcrServices $ocrServices)
    {
        $path = 'frontend';
        
        $this->path = $path;
        $this->plagiarismServices = $plagiarismService;
        $this->ocrServices = $ocrServices;

    }

    public function show($course_id, $lesson_slug,$course_location_id=null)
    {
       
        $IsUserFilledData=$this->IsUserFilledData();
        
        $test_result = "";
        $completed_lessons = "";
        
        $course = Course::where('id',$course_id)->first();
        
        $lesson = Lesson::where('slug', $lesson_slug)->where('course_id', $course_id)->where('published', '=', 1)->first();
       
        if ($lesson == "") {
            // $lesson = Test::where('slug', $lesson_slug)->where('course_id', $course_id)->where('published', '=', 1)->firstOrFail();
            $lesson = Forms::where('slug', $lesson_slug)
            ->whereHas('course', function ($query) use($course_id) {
                
                $query->where('course_forms.course_id', '=', $course_id);
            })
           ->where('published', '=', 1)->firstOrFail();
       
       
            
            $lesson->full_text = $lesson->description;
            // dd($lesson->course()->first()->pivot->id);
            $test_result = NULL;
            if ($lesson) {
                // $test_result = Result::where('test_id', $lesson->id)
                //     ->where('user_id', \Auth::id())
                //     ->first();
                $test_result = Result::where('course_forms_id', $lesson->course()->first()->pivot->id)
                ->where('user_id', \Auth::id())
                ->first();
                
            }
            // dd($test_result->test->first()->test);
        }
        if(get_class($lesson)=='App\Models\Forms'){
            $lessonCourse=$lesson->getcourseById($course_id);
            // dd($lessonCourse->chapter[0]->test);
        }
        else{
            $lessonCourse=$lesson->course;
        

        }
       
        if($course_location_id!==null){
            $course_lessons = $course->lessons()->whereHas('courseLocations', function($query) use($course_location_id) {
                $query->where('course_location_id', '=', $course_location_id)
                ->where('model_type', '=', 'App\Models\Lesson');
            })->pluck('id')->toArray();

           
            $course_tests = ($lessonCourse->tests ) ? $lessonCourse->tests()->whereHas('courseLocations', function($query) use($course_location_id) {
                $query->where('course_location_id', '=', $course_location_id)
                ->where('model_type', '=', 'App\Models\Forms');
            })->pluck('forms.id')->toArray():[];
            
             // $course_lessons = $lessonCourse->lessons->pluck('id')->toArray();
            //  $course_tests = ($lessonCourse->tests ) ? $lessonCourse->tests->pluck('id')->toArray() : [];
            
            }
        else{
            $course_lessons = $lessonCourse->lessons->pluck('id')->toArray();
            $course_tests = ($lessonCourse->tests ) ? $lessonCourse->tests->pluck('id')->toArray() : [];
      
        }
       
        $course_lessons = array_merge($course_lessons,$course_tests);
        
        
        $lessons = $lessonCourse->courseTimeline()
        ->whereIn('model_id',$course_lessons)
        ->orderby('sequence', 'asc')
        ->get();

      
    $purchased_course = $lessonCourse->students()->where('user_id', \Auth::id())->count() > 0;
    $test_exists = FALSE;

    if (get_class($lesson) == 'App\Models\Forms') {
        $test_exists = TRUE;
    }
   
    $completed_lessons = \Auth::user()->chapters()
        ->where('course_id', $lessonCourse->id)
        ->get()
        ->pluck('model_id')
        ->toArray();
        
   
        $blogs = Blog::has('category')->OrderBy('created_at','desc')->paginate(6);
    
    $impactMeasurments =$course->impactMeasurment();
        // $course->impactMeasurments()->get();
        // dd($impactMeasurments);
        $programRecommendations = $course->programRecommendations()->get();
        // $course->programRecommendations()->get();
        
       
        $previous_lesson = $lessonCourse->courseTimeline()
            ->where('sequence', '<', $lesson->courseTimeline->sequence)
            ->whereIn('model_id',$course_lessons)
            ->orderBy('sequence', 'desc')
            ->first();
        $next_lesson = $lessonCourse->courseTimeline()
            ->whereIn('model_id',$course_lessons)
            ->where('sequence', '>', $lesson->courseTimeline->sequence)
            ->orderBy('sequence', 'asc')
            ->first();
            //  dd($next_lesson);

    
            

            return view($this->path . '.courses.lesson-new-2', compact('lesson', 'previous_lesson', 'next_lesson', 'test_result','course_id',
            'purchased_course', 'test_exists', 'lessons', 'completed_lessons', 'blogs', 'course','IsUserFilledData','impactMeasurments','programRecommendations','course_location_id'));

        // return view($this->path . '.courses.lesson', compact('lesson', 'previous_lesson', 'next_lesson', 'test_result','course_id',
        //     'purchased_course', 'test_exists', 'lessons', 'completed_lessons', 'blogs', 'course','IsUserFilledData','impactMeasurments','programRecommendations'));
    }


    
    public function blog($course_id,$slug,$course_location_id=null)
    {

        $blog = Blog::where('slug',$slug)->first();
        $lesson=$blog;
        $course = Course::where('id',$course_id)->first();
      
        $blogs = Blog::has('category')->OrderBy('created_at','desc')->where('category_id',$course->category_id)->paginate(6);
        // $impactMeasurments = $course->impactMeasurments()->get();
        // $programRecommendations = $course->programRecommendations()->get();
        $impactMeasurments =$course->impactMeasurment();
        $programRecommendations = $course->programRecommendations()->get();
        $course_lessons = $course->lessons->pluck('id')->toArray();
        $course_tests = ($course->tests ) ? $course->tests->pluck('id')->toArray() : [];
        $course_lessons = array_merge($course_lessons,$course_tests);


        $lessons = $course->courseTimeline()
            ->whereIn('model_id',$course_lessons)
            ->orderby('sequence', 'asc')
            ->get();
 
        $completed_lessons = \Auth::user()->chapters()
            ->where('course_id', $course->id)
            ->get()
            ->pluck('model_id')
            ->toArray();
        return view($this->path . '.courses.blog-new', compact('lessons', 'lesson','completed_lessons', 'blogs', 'blog', 'course','impactMeasurments','programRecommendations','course_location_id'));
           
        // return view($this->path . '.courses.blog', compact('lessons', 'completed_lessons', 'blogs', 'blog', 'course','impactMeasurments','programRecommendations'));
    }
    public function impacts($course_id,$id,$course_location_id=null)
    {
        if(!\Auth::user()){
            return redirect('login');
        }
        $ImpactMeasurement=$lesson = Forms::where('id',$id)->first();
        $course = Course::where('id',$course_id)->first();
      
        $blogs = Blog::has('category')->OrderBy('created_at','desc')->where('category_id',$course->category_id)->paginate(6);
        $impactMeasurments =$course->impactMeasurment();
        $programRecommendations = $course->programRecommendations()->get();
       
        $course_lessons = $course->lessons->pluck('id')->toArray();
        $course_tests = ($course->tests ) ? $course->tests->pluck('id')->toArray() : [];
        $course_lessons = array_merge($course_lessons,$course_tests);


        $lessons = $course->courseTimeline()
            ->whereIn('model_id',$course_lessons)
            ->orderby('sequence', 'asc')
            ->get();
 
        $completed_lessons = \Auth::user()->chapters()
            ->where('course_id', $course->id)
            ->get()
            ->pluck('model_id')
            ->toArray();
// 
        return view($this->path . '.courses.impacts-new', compact('lessons','lesson', 'completed_lessons', 'blogs', 'course','ImpactMeasurement','impactMeasurments','programRecommendations','course_location_id'));

        // return view($this->path . '.courses.impacts', compact('lessons','lesson', 'completed_lessons', 'blogs', 'course','ImpactMeasurement','impactMeasurments','programRecommendations'));
    }
    public function programRecommendation($course_id,$id,$course_location_id=null)
    {

        $programRecommendation =$lesson= Forms::where('id',$id)->first();
        $course = Course::where('id',$course_id)->first();
      
        $blogs = Blog::has('category')->OrderBy('created_at','desc')->where('category_id',$course->category_id)->paginate(6);
        $impactMeasurments =$course->impactMeasurment();
            $programRecommendations = $course->programRecommendations()->get();
        $course_lessons = $course->lessons->pluck('id')->toArray();
        $course_tests = ($course->tests ) ? $course->tests->pluck('id')->toArray() : [];
        $course_lessons = array_merge($course_lessons,$course_tests);


        $lessons = $course->courseTimeline()
            ->whereIn('model_id',$course_lessons)
            ->orderby('sequence', 'asc')
            ->get();
 
        $completed_lessons = \Auth::user()->chapters()
            ->where('course_id', $course->id)
            ->get()
            ->pluck('model_id')
            ->toArray();
            return view($this->path . '.courses.programRecommendation-new', compact('lessons','lesson', 'completed_lessons', 'blogs', 'course','programRecommendation','impactMeasurments','programRecommendations','course_location_id'));

        // return view($this->path . '.courses.programRecommendation', compact('lessons','lesson', 'completed_lessons', 'blogs', 'course','programRecommendation','impactMeasurments','programRecommendations'));
    }
     
    public function rate($course_id,$course_location_id=null)
    {

        $course = Course::where('id',$course_id)->first();
      
                 
        $course_lessons = $course->lessons->pluck('id')->toArray();
        $course_tests = ($course->tests ) ? $course->tests->pluck('id')->toArray() : [];
        $course_lessons = array_merge($course_lessons,$course_tests);

        $blogs = Blog::has('category')->OrderBy('created_at','desc')->where('category_id',$course->category_id)->paginate(6);
        // $impactMeasurments = $course->impactMeasurments()->get();
        // $programRecommendations = $course->programRecommendations()->get();
        $impactMeasurments =$course->impactMeasurment();
            $programRecommendations = $course->programRecommendations()->get();
        $lessons = $course->courseTimeline()
            ->whereIn('model_id',$course_lessons)
            ->orderby('sequence', 'asc')
            ->get();
 
        $completed_lessons = \Auth::user()->chapters()
            ->where('course_id', $course->id)
            ->get()
            ->pluck('model_id')
            ->toArray();
        
        $rates=$course->forms()->where('form_type','rate')->where('type','student')->get();
        // dd($rates);
        // dd($course);
        return view($this->path . '.courses.rate-new', compact('lessons', 'completed_lessons', 'course', 'blogs', 'rates','impactMeasurments','programRecommendations','course_id','course_location_id'));
        
        // return view($this->path . '.courses.rate', compact('lessons', 'completed_lessons', 'course', 'blogs', 'rates','impactMeasurments','programRecommendations','course_id'));
    }



    public function test($lesson_slug, Request $request)
    {

        $group = CourseGroup::findOrfail($request->group_id);

        $test = CourseGroupTest::where('slug', $lesson_slug)->first();
        $totalScore=0;
        $userQuestions = session('test_questions', []);
        $answers = [];
        $test_score = 0;

        if(!is_array($request->get('questions'))  || empty($request->get('questions')))
        {
            return back()->withErrors(['message'=>trans('labels.frontend.course.test.msgAnswers')]);
        }
        else
        {
//            TODO: Fix this
//            if ($this->userHasSwitchedAway()) {
//                // Create a new Result with a test_result of 0 and no answers
//                foreach ($userQuestions as $question_id) {
//                    $answers[] = [
//                        'question_id' => $question_id,
//                        'option_id' => null,
//                        'correct' => null,
//                        'answer'=>null
//                    ];
//                }
//
//                $test_result = Result::create([
//                    'course_group_test_id' => $test->id,
//                    'user_id' => \Auth::id(),
//                    'test_result' => 0,
//                ]);
//                $test_result->answers()->createMany($answers);
//
//                // Clear the questions from the session
//                session()->forget('test_questions');
//                return back()->withFlashDanger(__('alerts.frontend.course.cheated'));
//            }

            foreach ($userQuestions as $question_id) {

                $answer_id = $request->get('questions')[$question_id] ?? null;

                Media::where('model_type', 'App\Models\Result')
                    ->where('model_id', \Auth::id())
                    ->where('file_name', $question_id)
                    ->forceDelete();

                $question = Question::find($question_id);

                $totalScore+=$question->score;
                $plagiarism_degree = 0;

                // Check the type of the question
                if(in_array($question->question_type, ['short_answer', 'paragraph', 'file_upload'])) {
                    // If the question type is 'short_answer', 'paragraph', or 'file', then don't mark it
                    $correct = null;

                    if ($question->question_type == 'file_upload'){

                        $file = \Illuminate\Support\Facades\Request::file('answer_file_'.$question_id);
                        $filename = time() . '-' . $file->getClientOriginalName();
                        $extention = $file->getClientOriginalExtension();

                        // Initialize data to extract the text from ocr api
                        $data = [
                            'language' => 'ara',
                            'isOverlayRequired' => 'false',
                            'iscreatesearchablepdf' => 'false',
                            'issearchablepdfhidetextlayer' => 'false',
                            'filetype' => $extention,
                            'file' => $request->file('answer_file_'.$question_id) // This is an instance of UploadedFile
                        ];

                        // Send file to the ocr api
                        $response = $this->ocrServices->extract($data);

                        $parsed_text = '';
                        // Loop through the response to get the parsed text
                        if (isset($response['ParsedResults']) && is_array($response['ParsedResults'])) {
                            foreach ($response['ParsedResults'] as $page) {
                                $parsed_text .= $page['ParsedText'] ?? '';
                            }
                        }

                        // Remove \r\n from the result
                        $parsed_text = str_replace("\r\n", '', $parsed_text);

                        // Initialize data for the plagiarism api
                        $answer_id = $parsed_text;
                    }

                    // Initialize data for the plagiarism api
                    $data = [
                        'text' => strip_tags($answer_id),
                        'language' => 'en', // we choose en cause it searches in a wore area more than ar
                        'includeCitations' => False,
                        'scrapeSources' => False,
                    ];

                    // Send the data to the plagiarism api
                    $response = $this->plagiarismServices->checkPlagiarism($data);
                    $plagiarism_degree = $response['percentPlagiarism'] ?? 0;

                } else {
                    // Otherwise, mark the question as before
                    $correct = QuestionsOption::where('question_id', $question_id)
                            ->where('id', $answer_id)
                            ->where('correct', 1)->count() > 0;
                }



                $answers[] = [
                    'question_id' => $question_id,
                    'option_id' => $answer_id,
                    'correct' => $correct,
                    'answer'=>$answer_id,
                    'plagiarism_degree' => $plagiarism_degree,
                ];

                if ($correct) {
                    if($question->score) {
                        $test_score += $question->score;
                    }
                }

                if (\Illuminate\Support\Facades\Request::hasFile('answer_file_'.$question_id)) {
                    $file = \Illuminate\Support\Facades\Request::file('answer_file_'.$question_id);
                    $filename = time() . '-' . $file->getClientOriginalName();
                    $size = $file->getSize() / 1024;
                    $path = public_path() . '/storage/uploads/';
                    $file->move($path, $filename);

                    $video_id = $question_id;
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
                }
            }
        }


        $test_result = Result::create([
            'course_group_test_id' => $test->id,
            'user_id' => \Auth::id(),
            'test_result' => $test_score,
            'course_group_id' => $group->id,
        ]);
        $test_result->answers()->createMany($answers);
        // Clear the questions from the session
        session()->forget('test_questions');
        return back()->with(['message'=>'Test score: ' . $test_score,'result'=>$test_result]);
    }
    
    public function retest(Request $request)
    {
        $test = Result::where('id', '=', $request->result_id)
            ->where('user_id', '=', auth()->user()->id)
            ->first();
        $test->delete();
        return back();
    }

    public function videoProgress(Request $request)
    {
        $user = auth()->user();
        $video = Media::findOrFail($request->video);
        $video_progress = VideoProgress::where('user_id', '=', $user->id)
            ->where('media_id', '=', $video->id)->first() ?: new VideoProgress();
        $video_progress->media_id = $video->id;
        $video_progress->user_id = $user->id;
        $video_progress->duration = $video_progress->duration ?: round($request->duration, 2);
        $video_progress->progress = round($request->progress, 2);
        if ($video_progress->duration - $video_progress->progress < 5) {
            $video_progress->progress = $video_progress->duration;
            $video_progress->complete = 1;
        }
        $video_progress->save();
        return $video_progress->progress;
    }


    public function courseProgress(Request $request)
    {
        if (\Auth::check()) {
            $lesson = Lesson::find($request->model_id);
            if ($lesson != null) {
                if ($lesson->chapterStudents()->where('user_id', \Auth::id())->where('course_group_id',
                        $request->group_id)->get()
                        ->count() == 0) {
                    $lesson->chapterStudents()->create([
                        'model_type' => $request->model_type,
                        'model_id' => $request->model_id,
                        'user_id' => auth()->user()->id,
                        'course_id' => $lesson->course->id,
                        'course_group_id' => $request->group_id
                    ]);
                    $progress=$lesson->course->progress($request->group_id);

                    $isUserCertified=$lesson->course->isUserCertified();
                    return ['msg'=>"true",'progress'=>$progress,'isUserCertified'=>$isUserCertified];
                }
            }
        }
      
        return "false";
    }


    public function activity(Request $request)
    {
//        dd($request->all());

        $activity = GroupActivity::findOrFail($request->activity_id);
        $group = CourseGroup::findOrFail($request->group_id);




        // Create new activity result
        $activity_result = ActivityResult::create([
            'group_id' => $group->id,
            'group_activity_id' => $activity->id,
            'user_id' => auth()->user()->id,
        ]);

        // Check if user answers by uploading a file
        if ($request->hasFile('answer_file')) {
            // Get file info
            $file = $request->file('answer_file');
            $extension = array_last(explode('.', $request->file('answer_file')->getClientOriginalName()));
            $name = array_first(explode('.', $request->file('answer_file')->getClientOriginalName()));
            $filename = time() . '-' . str_slug($name) . '.' . $extension;

            // Initialize data to extract the text from ocr api
            $data = [
                'language' => 'ara',
                'isOverlayRequired' => 'false',
                'iscreatesearchablepdf' => 'false',
                'issearchablepdfhidetextlayer' => 'false',
                'filetype' => $extension,
                'file' => $request->file('answer_file') // This is an instance of UploadedFile
            ];

            // Send file to the ocr api
            $ocr_response = $this->ocrServices->extract($data);

            $parsed_text = '';
            // Loop through the response to get the parsed text
            if (isset($ocr_response['ParsedResults']) && is_array($ocr_response['ParsedResults'])) {
                foreach ($ocr_response['ParsedResults'] as $page) {
                    $parsed_text .= $page['ParsedText'] ?? '';
                }
            }

            // Remove \r\n from the result
            $parsed_text = str_replace("\r\n", '', $parsed_text);

            // Initialize data for the plagiarism api
            $data = [
                'text' => strip_tags($parsed_text),
                'language' => 'en', // we choose en cause it searches in a wore area more than ar
                'includeCitations' => False,
                'scrapeSources' => False,
            ];

            // Send the data to the plagiarism api
            $response = $this->plagiarismServices->checkPlagiarism($data);

            // Save the result of the plagiarism api
            $activity_result->plagiarism_degree = $response['percentPlagiarism'] ?? 0;

            // Save the file
            $request->file('answer_file')->move(public_path('storage/uploads'), $filename);
            $url = asset('storage/uploads/' . $filename);
            $name = auth()->user()->id;

            $activity_result->file = $url;
        }

        // Check if user answers by writing a text
        if ($request->has('answer')) {
            // Initialize data for the plagiarism api
            $data = [
                'text' => strip_tags($request->answer),
                'language' => 'en', // we choose en cause it searches in a wore area more than ar
                'includeCitations' => False,
                'scrapeSources' => False,
            ];

            // Send the data to the plagiarism api
            $response = $this->plagiarismServices->checkPlagiarism($data);

            // Save the result of the plagiarism api anduser answer
            $activity_result->plagiarism_degree = $response['percentPlagiarism'] ?? 0;
            $activity_result->answers = $request->answer;
        }


        $activity_result->save();
        return back()->withFlashSuccess(__('alerts.frontend.course.activitySubmitted'));


    }

}