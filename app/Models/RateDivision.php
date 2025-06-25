<?php

namespace App\Models;


use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class RateDivision extends Model
{
    //
    use SoftDeletes;
    protected $table = 'rate_division';

    protected $fillable = [
        'course_group_rates_id',
        'title',
        'title_ar',
    ];


    public function rate(){
        return $this->belongsTo(CourseGroupRates::class, 'course_group_rates_id');
    }

    public function scopeFilter(Builder $builder, $request)
    {
        return $builder;
    }

    public function questions()
    {
        return $this->belongsToMany(Question::class, 'rate_division_question')->withPivot('question_id', 'rate_division_id');
    }
}
