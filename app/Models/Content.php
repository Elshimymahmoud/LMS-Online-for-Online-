<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Content extends Model
{
    //
    protected $fillable = ['title'];

    public function subContents()
    {
        return $this->hasMany(SubContent::class, 'content_id');
    }

    public function courses()
    {
        return $this->belongsToMany(Course::class, 'course_content');
    }

    public function groups()
    {
        return $this->belongsToMany(CourseGroup::class, 'group_content', 'content_id', 'group_id');
    }
}
