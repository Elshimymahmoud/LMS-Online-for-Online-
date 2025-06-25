<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Transcripts extends Model
{
    protected $guarded = [];

    protected $fillable = [
        'lesson_id',
        'description',
        'transcript',
        'channel_id',
        'published_at',
        'url',
    ];

    protected $casts = [
        'transcript' => 'array',
    ];


    public function lesson()
    {
        return $this->belongsTo(Lesson::class, 'lesson_id', 'id');
    }
}
