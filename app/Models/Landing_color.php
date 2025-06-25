<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Landing_color extends Model
{
    //
    protected $fillable = [
        'body_color', 
        'heading_color', 
        'paragraph_color',
         'icon_color', 
         'about_color',
          'courses_color', 
          'speaker_color', 
          'blog_color',
          'sponser_color'
    ];
    
}
