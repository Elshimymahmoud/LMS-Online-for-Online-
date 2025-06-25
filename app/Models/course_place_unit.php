<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class course_place_unit extends Model
{
    //
    protected $table = 'course_place_units';
    protected $fillable = ['id', 'place_id','name','name_ar'];

}
