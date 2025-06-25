<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Article extends Model
{
    protected $table = 'articles';
    protected $fillable = ['course_id', 'title','title_ar','article','article_ar'];


    public function course()
    {
        return $this->belongsTo(Course::class,'course_id','id');
    }
}
