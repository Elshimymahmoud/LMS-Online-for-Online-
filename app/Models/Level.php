<?php

namespace App\Models;

use App\Models\Course;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Level extends Model
{
    use SoftDeletes;

    protected $table = 'course_levels';
    protected $guarded = [];
    
}
