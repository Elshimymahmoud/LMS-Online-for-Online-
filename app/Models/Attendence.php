<?php

namespace App\Models;

use App\Models\Auth\User;
use Illuminate\Database\Eloquent\Model;

class Attendence extends Model
{
    //
    public function course()
    {
        return $this->belongsTo(Course::class);
    }
    public function user()
    {
        return $this->belongsTo(User::class, 'user_id');
    }
}
