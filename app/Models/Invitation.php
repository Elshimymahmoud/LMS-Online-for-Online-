<?php

namespace App\Models;

use App\Models\Auth\User;
use Illuminate\Database\Eloquent\Model;

class Invitation extends Model
{
    public function user(){
        return $this->belongsTo(User::class);
    }
    //
}
