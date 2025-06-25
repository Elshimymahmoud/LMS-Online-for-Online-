<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\MorphTo;

class ChapterStudent extends Model
{
    protected $table = "chapter_students";
    protected $guarded = [];

    public function model()
    {
        return $this->morphTo();
    }

    public function courseGroup()
    {
        return $this->belongsTo(CourseGroup::class);
    }

}
