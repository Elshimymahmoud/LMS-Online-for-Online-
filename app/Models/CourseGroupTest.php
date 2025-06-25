<?php

namespace App\Models;

use App\Models\TestsResult;
use Mtownsend\ReadTime\ReadTime;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\SoftDeletes;

class CourseGroupTest extends Model
{
    use SoftDeletes;
    protected $table = 'tests';

    protected $fillable = ['title', 'description', 'title_ar', 'test_type','type', 'description_ar', 'slug', 'published', 'chapter_id', 'lesson_id','form_type', 'questions_to_answer'];


    protected static function boot()
    {
        parent::boot();
        if(auth()->check()) {
            if (auth()->user()->hasRole('teacher')) {
                if(request('form_type')=='test')
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

    public function lesson()
    {
        return $this->belongsTo(Lesson::class, 'lesson_id')->withTrashed();
    }

    public function questions()
    {
        return $this->belongsToMany(Question::class, 'tests_question')->withPivot('question_id','course_group_test_id');

    }

    public function results()
    {
        return $this->hasMany(Result::class,'course_group_test_id','id');
    }
    public function studentResults($studentID, $groupID = null)
    {
        if($groupID)
            return $this->hasMany(Result::class,'course_group_test_id','id')->where('user_id',$studentID)->where('course_group_id',$groupID);
        return $this->hasMany(Result::class,'course_group_test_id','id')->where('user_id',$studentID);
    }

    public function chapterStudents()
    {
        return $this->morphMany(ChapterStudent::class,'model');
    }

    public function courseTimeline()
    {
        return $this->morphOne(CourseTimeline::class,'model');
    }

    public function chapters()
    {
        return $this->belongsToMany(Chapter::class, 'chapter_test');
    }

    public function courseLocations()
    {
        return $this->belongsToMany(CourseLocation::class,'lesson_course_location','model_id','course_location_id');
    }
    public function media()
    {
        return $this->morphMany(Media::class, 'model');
    }

    public function mediaType()
    {
        return $this->morphMany(Media::class, 'model');
    }

    public function downloadableMedia()
    {
        $types = ['youtube', 'vimeo', 'upload', 'embed', 'lesson_pdf', 'lesson_audio','zoom'];

        return $this->morphMany(Media::class, 'model')
            ->whereNotIn('type', $types);
    }

    public function courseGroups()
    {
        return $this->belongsToMany(CourseGroup::class, 'course_group_test')
            ->withPivot('course_group_id', 'course_group_test_id', 'chapter_id', 'lesson_id', 'published');
    }

    public function groupTimeline()
    {
        return $this->belongsTo(GroupTimeline::class);
    }
}
