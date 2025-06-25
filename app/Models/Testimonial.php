<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Testimonial extends Model
{
    protected $guarded = [];
    protected $fillable = [
        'name', 
        'occupation', 
        'content',
        'name_ar', 
        'occupation_ar', 
        'content_ar',
        'image',
        'course_id'
        ];
        public function course()
        {
            return $this->belongsTo(Course::class, 'course_id')->withTrashed();
        }
}
