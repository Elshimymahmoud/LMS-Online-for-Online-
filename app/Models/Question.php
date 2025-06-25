<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Support\Facades\File;

/**
 * Class Question
 *
 * @package App
 * @property text $question
 * @property string $question_image
 * @property integer $score
 */
class Question extends Model
{
    use SoftDeletes;

    protected $fillable = ['question', 'question_ar', 'question_type', 'user_id', 'question_image', 'score','title','title_ar'];

    protected static function boot()
    {
        parent::boot();
        if (auth()->check()) {
            if (auth()->user()->hasRole('teacher')) {
                if(request('form_type')=='test')
                static::addGlobalScope('filter', function (Builder $builder) {
                    $courses = auth()->user()->courses->pluck('id');
                    $builder->whereHas('tests', function ($q) use ($courses) {
                        $q->whereHas('course', function ($r) use ($courses) {
                            $r->whereIn('course_id', $courses);
                        });
                    });
                });
            }
        }

        static::deleting(function ($question) { // before delete() method call this
            if ($question->isForceDeleting()) {
                if (File::exists(public_path('/storage/uploads/' . $question->question_image))) {
                    File::delete(public_path('/storage/uploads/' . $question->question_image));
                }
            }
        });

    }

    /**
     * Set attribute to money format
     * @param $input
     */
    public function setScoreAttribute($input)
    {
        $this->attributes['score'] = $input ? $input : null;
    }

    public function options()
    {
        return $this->hasMany('App\Models\QuestionsOption');
    }

    public function isAttempted($result_id){
        $result = ResultsAnswer::where('result_id', '=', $result_id)
            ->where('question_id', '=', $this->id)
            ->first();
        if($result != null){
            return true;
        }
        return false;
    }

    public function isQuestionAttempted(){
        $result = ResultsAnswer::where('question_id', '=', $this->id)
            ->first();
        if($result != null){
            return true;
        }
        return false;
    }

    public function tests()
    {
        return $this->belongsToMany(Forms::class, 'question_form')->withPivot('question_id','forms_id');;;
    }
    public function forms()
    {
        return $this->belongsToMany(Forms::class, 'question_form')->withPivot('question_id','forms_id');;;
    }
    public function courseGroupTests()
    {
        return $this->belongsToMany(CourseGroupTest::class, 'tests_question')->withPivot('question_id','course_group_test_id');
    }

    public function courseGroupImpacts()
    {
        return $this->belongsToMany(CourseGroupImpact::class, 'course_group_impacts_question')->withPivot('question_id','course_group_impact_id');
    }

    public function courseGroupRecommendations()
    {
        return $this->belongsToMany(CourseGroupRecommendation::class, 'course_group_rec_question')->withPivot('question_id','course_group_recommendation_id');
    }

//    public function courseGroupRates()
//    {
//        return $this->belongsToMany(CourseGroupRates::class, 'course_group_rate_question')->withPivot('question_id','course_group_rates_id');
//    }

    public function rateDivisions()
    {
        return $this->belongsToMany(RateDivision::class, 'rate_division_question')->withPivot('question_id','rate_division_id');
    }

    public function answers()
    {
        return $this->hasMany(QuestionAnswers::class);
    }
}
