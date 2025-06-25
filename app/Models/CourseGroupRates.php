<?php

namespace App\Models;


use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class CourseGroupRates extends Model
{
    //
    use SoftDeletes;
    protected $table = 'course_group_rates';

    protected $fillable = [
        'course_group_id',
        'user_type',
        'description',
        'description_ar',
        'rate'
    ];

    public function courseGroup()
    {
        return $this->belongsToMany(CourseGroup::class, 'course_group_rate')->withPivot('course_group_id', 'course_group_rates_id', 'published');
//        return $this->belongsToMany(CourseGroup::class, 'course_group_rate', 'course_group_rates_id', 'course_group_id');

    }

    public function user()
    {
        return $this->belongsTo(User::class, 'user_id');
    }

    public function scopeFilter(Builder $builder, $request)
    {
        return $builder;
    }

//    public function questions()
//    {
//        return $this->belongsToMany(Question::class, 'course_group_rate_question')->withPivot('question_id', 'course_group_rates_id');
//    }
//
    public function divisions()
    {
        return $this->hasMany(RateDivision::class, 'course_group_rates_id');
    }
}
