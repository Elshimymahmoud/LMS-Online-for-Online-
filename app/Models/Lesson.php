<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

//use Spatie\MediaLibrary\HasMedia\HasMediaTrait;
//use Spatie\MediaLibrary\HasMedia\HasMedia;
use Illuminate\Support\Facades\File;
use Mtownsend\ReadTime\ReadTime;


/**
 * Class Lesson
 *
 * @package App
// * @property string $course
 * @property string $title
 * @property string $slug
 * @property string $lesson_image
 * @property text $short_text
 * @property text $full_text
 * @property integer $position
 * @property string $downloadable_files
 * @property tinyInteger $free_lesson
 * @property tinyInteger $published
 */
class Lesson extends Model
{
    use SoftDeletes;

    protected $fillable = ['date','from_time','to_time','title','title_ar', 'slug', 'lesson_image', 'short_text', 'short_text_ar', 'full_text','full_text_ar', 'position', 'downloadable_files', 'free_lesson', 'published', 'course_id','chapter_id','zoom_link'];

    protected $appends = ['image','lesson_readtime'];


    public static function boot()
    {
        parent::boot();

        static::deleting(function ($lesson) { // before delete() method call this
            if ($lesson->isForceDeleting()) {
                $media = $lesson->media;
                foreach ($media as $item) {
                    if (File::exists(public_path('/storage/uploads/' . $item->name))) {
                        File::delete(public_path('/storage/uploads/' . $item->name));
                    }
                }
                $lesson->media()->delete();
            }

        });
    }


    /**
     * Set to null if empty
     * @param $input
     */
    public function setCourseIdAttribute($input)
    {
        $this->attributes['course_id'] = $input ? $input : null;
    }

    public function getImageAttribute()
    {
        if ($this->attributes['lesson_image'] != NULL) {
            return url('storage/uploads/'.$this->lesson_image);
        }
        return NULL;
    }

    public function getLessonReadtimeAttribute(){

        if($this->full_text != null){
            $readTime = (new ReadTime($this->full_text))->toArray();
            return $readTime['minutes'];
        }
        return 0;
    }

    public function lessonMediaAttribute(){

    }


    /**
     * Set attribute to money format
     * @param $input
     */
    public function setPositionAttribute($input)
    {
        $this->attributes['position'] = $input ? $input : null;
    }


    public function readTime()
    {
        if($this->full_text != null){
            $readTime = (new ReadTime($this->full_text))->toArray();
            return $readTime['minutes'];
        }
        return 0;
    }

    public function course()
    {
        return $this->belongsTo(Course::class,'course_id');
    }

    public function test()
    {
        return $this->hasOne('App\Models\Forms');
    }

    public function students()
    {
        return $this->belongsToMany('App\Models\Auth\User', 'lesson_student')->withTimestamps();
    }

    public function media()
    {
        return $this->morphMany(Media::class, 'model');
    }

    public function mediaType()
    {
        return $this->morphMany(Media::class, 'model');
    }

    public function chapterStudents()
    {
        return $this->morphMany(ChapterStudent::class, 'model');
    }
  
    public function chapter()
    {
        return $this->belongsTo(Chapter::class,'chapter_id','id');
    }

    public function downloadableMedia()
    {
        $types = ['youtube', 'vimeo', 'upload', 'embed', 'lesson_pdf', 'lesson_audio','zoom'];

        return $this->morphMany(Media::class, 'model')
            ->whereNotIn('type', $types);
    }


    public function mediaVideo()
    {
        $types = ['youtube', 'vimeo', 'upload', 'embed','zoom'];
        return $this->morphOne(Media::class, 'model')
            ->whereIn('type', $types);

    }

    public function mediaPDF()
    {
        return $this->morphOne(Media::class, 'model')
            ->where('type', '=', 'lesson_pdf');
    }

    public function mediaAudio()
    {
        return $this->morphOne(Media::class, 'model')
            ->where('type', '=', 'lesson_audio');
    }

    public function courseTimeline()
    {
        return $this->morphOne(CourseTimeline::class, 'model');
    }

    public function isCompleted($courseGroupId)
    {
        $isCompleted = $this->chapterStudents()
            ->where('user_id', \Auth::id())
            ->where('course_group_id', $courseGroupId)
            ->count();
        if ($isCompleted > 0) {
            return true;
        }
        return false;
    }

    public function courseLocations()
    {
        return $this->belongsToMany(CourseLocation::class,'lesson_course_location','model_id','course_location_id')->withPivot(['course_location_id','model_id','model_type']);
    }

    public function courseGroups()
    {
        return $this->belongsToMany(CourseGroup::class,'lesson_course_group','model_id','course_group_id')->withPivot(['course_group_id','model_id','model_type']);
    }

    public function groups()
    {
        return $this->belongsToMany(CourseGroup::class,'group_lesson', 'lesson_id', 'course_group_id')->withPivot('start_time',
            'end_time', 'date', 'status');
    }

    public function groupTimeline()
    {
        return  $this->morphOne(GroupTimeline::class, 'model');
    }

    public function isDirectlyAttachedToCourse()
    {
        return $this->chapter_id === null && $this->course_id !== null;
    }

    public function resources()
    {
        return $this->hasMany(LessonResourceLink::class, 'lesson_id');
    }

    public function transcript()
    {
        return $this->hasOne(Transcripts::class, 'lesson_id', 'id');
    }
}
