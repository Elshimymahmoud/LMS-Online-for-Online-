<?php

namespace App\Models;

use App\Models\Auth\User;
use Illuminate\Database\Eloquent\Model;

class GroupChat extends Model
{
    protected $table = 'course_group_chat';
    protected $fillable = ['course_group_id'];


    public function courseGroup()
    {
        return $this->belongsTo(CourseGroup::class,'course_group_id','id');
    }

    public function messages()
    {
        return $this->hasMany(GroupMessages::class, 'course_group_chat_id', 'id');
    }
}
