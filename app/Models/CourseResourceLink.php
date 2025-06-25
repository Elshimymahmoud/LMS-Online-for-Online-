<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class CourseResourceLink extends Model
{
    public $timestamps = false;

    protected $fillable = ['course_id', 'title', 'link'];

    /**
     * The table associated with the model.
     *
     * @var string
     */
    protected $table = 'course_resources';

    /**
     * Get the course group that owns the resource link.
     */
    public function course()
    {
        return $this->belongsTo(Course::class, 'course_id');
    }
}
