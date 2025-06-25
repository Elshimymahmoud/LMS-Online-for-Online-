<?php

namespace App\Models;


use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class CourseGroupRecommendation extends Model
{
    //
    use SoftDeletes;
    protected $table = 'course_group_recs';

    protected $fillable = [
        'course_group_id',
        'user_id',
        'recommendation',
        'recommendation_ar',
    ];

    public function courseGroup()
    {
        return $this->belongsToMany(CourseGroup::class, 'course_group_rec')->withPivot('course_group_id', 'course_group_recommendation_id', 'published');
    }

    public function user()
    {
        return $this->belongsTo(User::class, 'user_id');
    }

    public function scopeFilter(Builder $builder, $request)
    {
        return $builder;
    }

    public function questions()
    {
        return $this->belongsToMany(Question::class, 'course_group_rec_question')->withPivot('question_id', 'course_group_recommendation_id');
    }

}
