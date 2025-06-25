<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class GroupActivity extends Model
{
    use SoftDeletes;
    protected $table = 'group_activity';

    protected $fillable = ['title', 'description', 'title_ar', 'type', 'description_ar', 'slug', 'published', 'document'];

    public function results()
    {
        return $this->hasMany(ActivityResult::class, 'group_activity_id', 'id');
    }
    public function studentResults($studentID)
    {
        return $this->hasMany(ActivityResult::class, 'group_activity_id', 'id')->where('user_id',$studentID);
    }

    public function courseGroups()
    {
        return $this->belongsToMany(CourseGroup::class, 'course_group_activity')
            ->withPivot('course_group_id', 'group_activity_id');
    }

}
