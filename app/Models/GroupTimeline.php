<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class GroupTimeline extends Model
{
    protected $table = 'group_timeline';

    protected $fillable = ['model_type', 'model_id', 'sequence', 'group_id'];

    public function model()
    {
        return $this->morphTo();
    }

    public function groups(){
        return $this->belongsTo(CourseGroup::class,'group_id');
    }


    public function lessons()
    {
        return $this->hasMany(Lesson::class);
    }

    public function tests()
    {
        return $this->hasMany(CourseGroupTest::class);
    }

    public function course()
    {
        return $this->groups()->courses();
    }


    
}
