<?php

namespace App\Models;

use App\Models\Auth\User;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\File;

class LessonResourceLink extends Model
{
    public $timestamps = false;

    protected $fillable = ['lesson_id', 'link'];

    /**
     * The table associated with the model.
     *
     * @var string
     */
    protected $table = 'lesson_resources';

    /**
     * Get the course group that owns the resource link.
     */
    public function lesson()
    {
        return $this->belongsTo(Lesson::class, 'lesson_id');
    }
}
