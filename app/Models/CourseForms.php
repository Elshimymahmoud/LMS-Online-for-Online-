<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class CourseForms extends Model
{
    //
    protected $table = 'course_forms';

    protected $fillable = ['course_id','forms_id'];

    public function test(){
        return $this->belongsTo(Forms::class,'forms_id');
    }
}
