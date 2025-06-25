<?php

namespace App\Http\Controllers;

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

    public function __construct()
    {
        $path = 'frontend';
        
        $this->path = $path;
    }

    public function show($course_id, $lesson_slug)
    {

        $IsUserFilledData=$this->IsUserFilledData();
        
        $test_result = "";
        $completed_lessons = "";
        
        $course = Course::where('id',$course_id)->first();
        $lesson = Lesson::where('slug', $lesson_slug)->where('course_id', $course_id)->where('published', '=', 1)->first();

        if ($lesson == "") {
            $lesson = Test::where('slug', $lesson_slug)->where('course_id', $course_id)->where('published', '=', 1)->firstOrFail();
            $lesson->full_text = $lesson->description;
            
            $test_result = NULL;
            if ($lesson) {
                $test_result = TestsResult::where('test_id', $lesson->id)
                    ->where('user_id', \Auth::id())
                    ->first();
            }
        }


        $course_lessons = $lesson->course->lessons->pluck('id')->toArray();
        $course_tests = ($lesson->course->tests ) ? $lesson->course->tests->pluck('id')->toArray() : [];
        $course_lessons = array_merge($course_lessons,$course_tests);
        
        
        $previous_lesson = $lesson->course->courseTimeline()
            ->where('sequence', '<', $lesson->courseTimeline->sequence)
            ->whereIn('model_id',$course_lessons)
            ->orderBy('sequence', 'desc')
            ->first();
        $next_lesson = $lesson->course->courseTimeline()
            ->whereIn('model_id',$course_lessons)
            ->where('sequence', '>', $lesson->courseTimeline->sequence)
            ->orderBy('sequence', 'asc')
            ->first();

        $lessons = $lesson->course->courseTimeline()
            ->whereIn('model_id',$course_lessons)
            ->orderby('sequence', 'asc')
            ->get();


        $purchased_course = $lesson->course->students()->where('user_id', \Auth::id())->count() > 0;
        $test_exists = FALSE;

        if (get_class($lesson) == 'App\Models\Test') {
            $test_exists = TRUE;
        }

        $completed_lessons = \Auth::user()->chapters()
            ->where('course_id', $lesson->course->id)
            ->get()
            ->pluck('model_id')
            ->toArray();

        
            $blogs = Blog::has('category')->OrderBy('created_at','desc')->where('course_id',$lesson->course->id)->paginate(6);
            $impactMeasurments = $course->impactMeasurments()->get();
            $programRecommendations = $course->programRecommendations()->get();
            
// dd($lesson->course->chapter()->get());

        return view($this->path . '.courses.lesson', compact('lesson', 'previous_lesson', 'next_lesson', 'test_result',
            'purchased_course', 'test_exists', 'lessons', 'completed_lessons', 'blogs', 'course','IsUserFilledData','impactMeasurments','programRecommendations'));
    }


    
    public function blog($course_id,$slug)
    {

        $blog = Blog::where('slug',$slug)->first();
        $course = Course::where('id',$course_id)->first();
      
        $blogs = Blog::has('category')->OrderBy('created_at','desc')->where('category_id',$course->category_id)->paginate(6);
        $impactMeasurments = $course->impactMeasurments()->get();
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

        return view($this->path . '.courses.blog', compact('lessons', 'completed_lessons', 'blogs', 'blog', 'course','impactMeasurments','programRecommendations'));
    }
    public function impacts($course_id,$id)
    {

        $ImpactMeasurement = ImpactMeasurement::where('id',$id)->first();
        $course = Course::where('id',$course_id)->first();
      
        $blogs = Blog::has('category')->OrderBy('created_at','desc')->where('category_id',$course->category_id)->paginate(6);
        $impactMeasurments = $course->impactMeasurments()->get();
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

        return view($this->path . '.courses.impacts', compact('lessons', 'completed_lessons', 'blogs', 'course','ImpactMeasurement','impactMeasurments','programRecommendations'));
    }
    public function programRecommendation($course_id,$id)
    {

        $programRecommendation = programRecommendation::where('id',$id)->first();
        $course = Course::where('id',$course_id)->first();
      
        $blogs = Blog::has('category')->OrderBy('created_at','desc')->where('category_id',$course->category_id)->paginate(6);
        $impactMeasurments = $course->impactMeasurments()->get();
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

        return view($this->path . '.courses.programRecommendation', compact('lessons', 'completed_lessons', 'blogs', 'course','programRecommendation','impactMeasurments','programRecommendations'));
    }
     
    public function rate($course_id)
    {

        $course = Course::where('id',$course_id)->first();
      
                 
        $course_lessons = $course->lessons->pluck('id')->toArray();
        $course_tests = ($course->tests ) ? $course->tests->pluck('id')->toArray() : [];
        $course_lessons = array_merge($course_lessons,$course_tests);

        $blogs = Blog::has('category')->OrderBy('created_at','desc')->where('category_id',$course->category_id)->paginate(6);
        $impactMeasurments = $course->impactMeasurments()->get();
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
        
        $rates=$course->rates;
        
        return view($this->path . '.courses.rate', compact('lessons', 'completed_lessons', 'course', 'blogs', 'rates','impactMeasurments','programRecommendations'));
    }



    public function test($lesson_slug, Request $request)
    {
        $test = Test::where('slug', $lesson_slug)->firstOrFail();
        $totalScore=0;
    
        foreach ($test->questions as $key => $question) {
            # code...
            if(count($question->options)==0)
            $totalScore+=$question->score;
        }
        $answers = [];
        $test_score = 0;
        

        foreach ($request->get('questions') as $question_id => $answer_id) {

            Media::where('model_type', 'App\Models\TestsResult')
        ->where('model_id', \Auth::id())
        ->where('file_name', $question_id)
        ->forceDelete();

        
            $question = Question::find($question_id);
            $correct = QuestionsOption::where('question_id', $question_id)
                    ->where('id', $answer_id)
                    ->where('correct', 1)->count() > 0;
            $answers[] = [
                'question_id' => $question_id,
                'option_id' => $answer_id,
                'correct' => $correct
            ];
            if ($correct) {
                if($question->score) {
                    $test_score += $question->score;
                }
            }
            /*
             * Save the answer
             * Check if it is correct and then add points
             * Save all test result and show the points
             */
            

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
                    $media->model_type = 'App\Models\TestsResult';
                    $media->model_id = $name;
                    $media->name = $name;
                    $media->url = $url;
                    $media->type = 'answer_file';
                    $media->file_name = $video_id;
                    $media->size = $size;
                    $media->save();
            
            }
        
            
        }
        $test_score+=$totalScore;

        $test_result = TestsResult::create([
            'test_id' => $test->id,
            'user_id' => \Auth::id(),
            'test_result' => $test_score,
        ]);
        $test_result->answers()->createMany($answers);




        if ($test->chapterStudents()->where('user_id', \Auth::id())->get()->count() == 0) {
            $test->chapterStudents()->create([
                'model_type' => $test->model_type,
                'model_id' => $test->id,
                'user_id' => auth()->user()->id,
                'course_id' => $test->course->id
            ]);
        }


        return back()->with(['message'=>'Test score: ' . $test_score,'result'=>$test_result]);
    }
    
    public function retest(Request $request)
    {
        $test = TestsResult::where('id', '=', $request->result_id)
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
                if ($lesson->chapterStudents()->where('user_id', \Auth::id())->get()->count() == 0) {
                    $lesson->chapterStudents()->create([
                        'model_type' => $request->model_type,
                        'model_id' => $request->model_id,
                        'user_id' => auth()->user()->id,
                        'course_id' => $lesson->course->id
                    ]);
                    
                    return "true";
                }
            }
        }
      
        return "false";
    }

}