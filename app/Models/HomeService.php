<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class HomeService extends Model
{
    protected $fillable = ['title', 'title_ar', 'link', 'home_service_image','description','description_ar'];
}
