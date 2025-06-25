<?php

namespace App\Models;

use App\Models\Course;
use Mtownsend\ReadTime\ReadTime;

//use Spatie\MediaLibrary\HasMedia\HasMediaTrait;
//use Spatie\MediaLibrary\HasMedia\HasMedia;
use Illuminate\Support\Facades\File;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;


/**
 * Class Chapter
 *
 * @package App
 * @property string $course
 * @property string $title
 * @property string $slug
 * @property string $chapter_image
 * @property text $short_text
 * @property text $full_text
 * @property integer $position
 * @property string $downloadable_files
 * @property tinyInteger $free_chapter
 * @property tinyInteger $published
 */
class Chapter extends Model
{
    use SoftDeletes;

    protected $fillable = ['title', 'slug', 'chapter_image', 'short_text', 'full_text', 'position', 'downloadable_files', 'free_chapter', 'published', 'course_id'];

    protected $appends = ['image','chapter_readtime'];


    public static function boot()
    {
        parent::boot();

        static::deleting(function ($chapter) { // before delete() method call this
            if ($chapter->isForceDeleting()) {
                $media = $chapter->media;
                foreach ($media as $item) {
                    if (File::exists(public_path('/storage/uploads/' . $item->name))) {
                        File::delete(public_path('/storage/uploads/' . $item->name));
                    }
                }
                $chapter->media()->delete();
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


 
    public function chapterMediaAttribute(){

    }


    /**
     * Set attribute to money format
     * @param $input
     */
    public function setPositionAttribute($input)
    {
        $this->attributes['position'] = $input ? $input : null;
    }

    public function lessons()
    {
        return $this->hasMany(Lesson::class,'chapter_id','id');
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
        return $this->belongsTo(Course::class,'course_id','id');

    }

    public function tests()
    {
        return $this->belongsToMany(CourseGroupTest::class, 'chapter_test');
    }

    public function students()
    {
        return $this->belongsToMany('App\Models\Auth\User', 'chapter_student')->withTimestamps();
    }

    public function media()
    {
        return $this->morphMany(Media::class, 'model');
    }

    public function chapterStudents()
    {
        return $this->morphMany(ChapterStudent::class, 'model');
    }

    public function downloadableMedia()
    {
        $types = ['youtube', 'vimeo', 'upload', 'embed', 'chapter_pdf', 'chapter_audio','zoom'];

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
            ->where('type', '=', 'chapter_pdf');
    }

    public function mediaAudio()
    {
        return $this->morphOne(Media::class, 'model')
            ->where('type', '=', 'chapter_audio');
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

}
