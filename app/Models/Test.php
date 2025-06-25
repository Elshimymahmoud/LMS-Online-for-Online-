<?php
namespace App\Models;

use App\Models\TestsResult;
use Mtownsend\ReadTime\ReadTime;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\SoftDeletes;

/**
 * Class Test
 *
 * @package App
 * @property string $course
 * @property string $lesson
 * @property string $title
 * @property text $description
 * @property tinyInteger $published
*/
class Test extends Model
{
    use SoftDeletes;

    protected $fillable = ['title', 'description', 'title_ar', 'test_type', 'description_ar', 'slug', 'published', 'chapter_id', 'course_id', 'lesson_id'];

    protected $table = 'forms';

    protected static function boot()
    {
        parent::boot();
        if(auth()->check()) {
            if (auth()->user()->hasRole('teacher')) {
                static::addGlobalScope('filter', function (Builder $builder) {
                    $builder->whereHas('course', function ($q) {
                        $q->whereHas('teachers', function ($t) {
                            $t->where('course_user.user_id', '=', auth()->user()->id);
                        });
                    });
                });
            }
        }

    }


    /**
     * Set to null if empty
     * @param $input
     */
    public function setCourseIdAttribute($input)
    {
        $this->attributes['course_id'] = $input ? $input : null;
    }


    /**
     * Set to null if empty
     * @param $input
     */
    public function setLessonIdAttribute($input)
    {
        $this->attributes['lesson_id'] = $input ? $input : null;
    }
    
    public function course()
    {
        return $this->belongsTo(Course::class, 'course_id')->withTrashed();
    }
    public function lesson()
    {
        return $this->belongsTo(Lesson::class, 'lesson_id')->withTrashed();
    }


    public function chapter()
    {
        return $this->belongsTo(Chapter::class,'chapter_id','id');
    }

    public function questions()
    {
        return $this->belongsToMany(Question::class, 'question_test')->with('options')->withTrashed();
    }
    public function TestsResult() {
        return $this->hasMany(TestsResult::class, 'test_id','id');

    }

    public function chapterStudents()
    {
        return $this->morphMany(ChapterStudent::class,'model');
    }

    public function courseTimeline()
    {
        return $this->morphOne(CourseTimeline::class,'model');
    }

    public function isCompleted(){
        $isCompleted = $this->chapterStudents()->where('user_id', \Auth::id())->count();
        if($isCompleted > 0){
            return true;
        }
        return false;

    }


}
