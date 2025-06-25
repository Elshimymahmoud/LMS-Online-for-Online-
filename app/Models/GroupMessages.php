<?php

namespace App\Models;

use App\Models\Auth\User;
use Illuminate\Database\Eloquent\Model;

class GroupMessages extends Model
{
    protected $table = 'group_messages';
    protected $fillable = ['course_group_chat_id', 'user_id', 'message'];


    public function courseGroupChat()
    {
        return $this->belongsTo(GroupChat::class,'course_group_chat_id','id');
    }

    public function user()
    {
        return $this->belongsTo(User::class,'user_id','id');
    }
}
