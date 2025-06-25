<?php

namespace App\Models;


use App\Models\TestsResult;
use Mtownsend\ReadTime\ReadTime;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\SoftDeletes;
class Forms extends Model
{
    //
    use SoftDeletes;
    protected $table = 'forms';

    protected $fillable = ['title', 'description', 'title_ar', 'test_type','type', 'description_ar', 'slug', 'published', 'chapter_id', 'lesson_id','form_type'];


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
    
    public function course()
    {
        
        return $this->belongsToMany(Course::class,'course_forms')->withPivot('course_id','forms_id','id');

    }
    public function getcourseById($id)
    {
        
        return $this->belongsToMany(Course::class,'course_forms')->where('course_forms.course_id',$id)->first();

    }
    public function getcourseByFormId()
    {
       
        return $this->belongsToMany(Course::class,'course_forms')->where('forms_id',$this->id)->first();

    }
    public function lesson()
    {
        return $this->belongsTo(Lesson::class, 'lesson_id')->withTrashed();
    }
    
    public function questions()
    {
        // return $this->belongsToMany(Question::class, 'question_form')->withTrashed();
        return $this->belongsToMany(Question::class, 'question_form')->withPivot('question_id','forms_id');;
    
    }
    public function TestsResult() {
        return $this->hasMany(Result::class, 'course_forms_id','id');

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
    public function getUserRate($student_id=null,$course_id=null)
    {
        # code...
       if(@auth()->user()->id){
           if($student_id==null&&$course_id==null)
        $userCourseRate=UserCourseForm::where('form_id',$this->id)->where('user_id',auth()->user()->id)->latest('created_at')->first();
        elseif($student_id==null&&$course_id!=null)
        $userCourseRate=UserCourseForm::where('form_id',$this->id)->where('user_id',auth()->user()->id)->where('course_id',$course_id)->latest('created_at')->first();

        else
        $userCourseRate=UserCourseForm::where('form_id',$this->id)->where('user_id',auth()->user()->id)
        ->where('student_id', $student_id)
        ->where('course_id', $course_id)
        ->latest('created_at')->first();

    }
    
        if(@$userCourseRate)
            return $userAnswers=UserFormAnswer::where('user_course_form_id',$userCourseRate->id)->get();
            else
            return[];
        
    }
    public function getUserAnswers()
    {
        # code...
       if(@auth()->user()->id){
        $userCourseForm=UserCourseForm::where('form_id',$this->id)->where('user_id',auth()->user()->id)->latest('created_at')->first();
        }
        if(@$userCourseForm)
            return $userAnswers=UserFormAnswer::where('user_course_form_id',$userCourseForm->id)->get();
            else
            return[];
        
    }

    public function chapter()
    {
        return $this->belongsTo(Chapters::class);
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
}
