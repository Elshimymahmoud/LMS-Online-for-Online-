<?php

namespace App\Models;

use App\Models\ChapterStudent;
use Mtownsend\ReadTime\ReadTime;

//use Spatie\MediaLibrary\HasMedia\HasMediaTrait;
//use Spatie\MediaLibrary\HasMedia\HasMedia;
use Illuminate\Support\Facades\File;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;


/**
 * Class chapter
 *
 * @package App
 * @property string $course
 * @property string $title
 * @property string $slug
 * @property text $short_text
 * @property text $full_text
 * @property integer $position
 * @property string $downloadable_files
 * @property tinyInteger $free_chapter
 * @property tinyInteger $published
 */
class Chapters extends Model
{
    use SoftDeletes;

    protected $table = 'chapters';
    protected $fillable = ['title', 'title_ar', 'session_length', 'course_id', 'length_type'];



    public static function boot()
    {
        parent::boot();
    }

    public function lessons()
    {
        return $this->hasMany(Lesson::class, 'chapter_id');
    }

    public function blogs()
    {
        return $this->hasMany(Blog::class, 'chapter_id');
    }
    public function test()
    {
        return $this->hasMany(Forms::class, 'chapter_id');
    }

    public function course()
    {
        return $this->belongsTo(Course::class, 'course_id', 'id');
    }

    public function chapterStudents()
    {
        return $this->morphMany(ChapterStudent::class, 'model');
    }
    public function copyChapter($request)
    {
        //copy attributes
        $new = $this->replicate();
       
       $new->title_ar=$request->title_ar;
       $new->title=$request->title;
       $new->session_length=$request->session_length;
       $new->length_type=$request->length_type;
       $new->published=$request->published;
       $new->course_id=$request->course_id;
       
       
        //save model before you recreate relations (so it has an id)
        $new->push();

        //reset relations on EXISTING MODEL (this way you can control which ones will be loaded
        $this->relations = [];

        //load relations on EXISTING MODEL
        $this->load('lessons', 'test');
        
        //re-sync everything
        foreach ($this->relations as $relationName => $values) {
            if ($relationName == 'lessons') {
                foreach ($values as $key => $oldLesson) {
                    # code...
                    
                    $newLesson = $oldLesson->replicate();
                    $newLesson->chapter_id = $new->id;
                    $newLesson->push();
                   
                    $newLesson->slug = str_slug($newLesson->title) . '_' . $newLesson->id;
                    $newLesson->save();
                    //reset relations on EXISTING MODEL (this way you can control which ones will be loaded
                     $oldLesson->relations = [];

                    
                   
                    $course_location_ids = [];
                    
                    foreach ($oldLesson->courseLocations()->where('model_type','App\Models\Lesson')->get() as $key => $courseLocationsLesson) {
                        # code...
                        $id = $courseLocationsLesson->pivot->course_location_id;
                        $course_location_ids[$id] = ['model_type' => get_class($newLesson)];
                    }
                    $newLesson->courseLocations()->attach($course_location_ids);
                    // get media and save media
                    $media = Media::where('model_type', '=', 'App\Models\Lesson')
                        ->where('model_id', '=', $oldLesson->id)
                        ->first();
                    if ($media) {
                        $newMedia = $media->replicate();

                        $newMedia->push();
                        $media->relations = [];
                        $newMedia->model_id = $newLesson->id;
                        $newMedia->save();
                    }
                    // save sequence in timeline
                    $sequence = 1;
                    if (count($newLesson->course->courseTimeline) > 0) {
                        $sequence = $newLesson->course->courseTimeline->max('sequence');
                        $sequence = $sequence + 1;
                    }

                    if ($newLesson->published == 1) {
                        $timeline = CourseTimeline::where('model_type', '=', Lesson::class)
                            ->where('model_id', '=', $newLesson->id)
                            ->where('course_id', $new->course_id)->first();

                        if ($timeline == null) {
                            $timeline = new CourseTimeline();
                            $timeline->sequence = $sequence;
                        }

                        $timeline->course_id = $new->course_id;
                        $timeline->model_id = $newLesson->id;
                        $timeline->model_type = Lesson::class;
                        $timeline->sequence = $timeline->sequence ? $timeline->sequence : $sequence;
                        $timeline->save();
                    }
                }
            }
            if ($relationName == 'test') {
                foreach ($values->where('form_type', 'test') as $key => $OldTest) {
                    # code...
                    $newTest = $OldTest->replicate();
                    $newTest->chapter_id= $new->id;
                    $newTest->push();
                    $OldTest->relations = [];
                    $newTest->slug = str_slug($newTest->title) . '_' . $newTest->id;
                    $newTest->save();
                    // ################
                    $course_location_ids = [];
                    // save course location in pivot table

                    foreach ($OldTest->courseLocations()->where('model_type','App\Models\Forms')->get() as $key => $courseLocationsTest) {
                        # code...
                       
                        $id = $courseLocationsTest->pivot->course_location_id;
                        $course_location_ids[$id] = ['model_type' => get_class($newTest)];
                    }
                    $newTest->courseLocations()->attach($course_location_ids);
                    
                    // course forms
                    $newCourseForms = new CourseForms;
                    $newCourseForms->course_id = $newTest->chapter->course_id;
                    $newCourseForms->forms_id = $newTest->id;
                    $newCourseForms->save();
                    // dd($OldTest->questions);
                    foreach ($OldTest->questions as $question) {
                        # code...
                       $newQuestion=$question->replicate();
                       $newQuestion->push();
                        $newTest->questions()->attach($newQuestion);
                    }
                    //    save question options
                    
                    foreach ($newTest->questions as $key2 => $newQuestion) {

                        # code...
                        // $newQuestion->tests()->attach($newTest->id);
                        if (count($OldTest->questions[$key2]->options) > 0) {

                            foreach ($OldTest->questions[$key2]->options as  $option) {
                                # code...
                                QuestionsOption::create([
                                    'question_id' => $newQuestion->id,
                                    'option_text' => $option->option_text,
                                    'option_text_ar' => $option->option_text_ar,
                                    'correct' => $option->correct
                                ]);
                            }
                        }
                    }

                    $sequence = 1;
                    // if (count($test->course->courseTimeline) > 0) {
                    if (count($newTest->getcourseById($newTest->chapter->course_id)->courseTimeline) > 0) {

                        // $sequence = $test->course->courseTimeline->max('sequence');
                        $sequence = $newTest->getcourseById($newTest->chapter->course_id)->courseTimeline->max('sequence');

                        $sequence = $sequence + 1;
                    }

                    if ($newTest->published == 1) {
                        $timeline = CourseTimeline::where('model_type', '=', Forms::class)
                            ->where('model_id', '=', $newTest->id)
                            ->where('course_id', $newTest->chapter->course_id)->first();
                        if ($timeline == null) {
                            $timeline = new CourseTimeline();
                        }
                        $timeline->course_id =  $newTest->chapter->course_id;
                        $timeline->model_id = $newTest->id;
                        $timeline->model_type = Forms::class;
                        $timeline->sequence = $sequence;
                        $timeline->save();
                    } {
                    }


                    ####################
                } //end each

            }
        }

        # code...
    }
}
