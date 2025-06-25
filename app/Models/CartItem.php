<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use App\Models\Auth\User;
use Illuminate\Database\Eloquent\SoftDeletes;

class CartItem extends Model
{
    use SoftDeletes;

    protected $fillable = ['user_id', 'course_id', 'group_id', 'quantity'];

    public function course(){
        return $this->belongsTo(Course::class);
    }

    public function group(){
        return $this->belongsTo(CourseGroup::class);
    }

    public function user(){
        return $this->belongsTo(User::class);
    }

}
