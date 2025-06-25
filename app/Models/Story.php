<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Story extends Model
{
    protected $fillable = [
    'title', 
    'title_ar', 
    'description',
    'description_ar', 
    'image', 
    'logo',
    'course1',
    'course1_ar' ,
    'date1',
    'students1',
    'training_days1',
    'course2',
    'course2_ar',
    'date2',
    'students2',
    'training_days2'
    ];
}
