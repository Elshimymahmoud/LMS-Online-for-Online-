<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class GroupResourceLink extends Model
{
    public $timestamps = false;

    protected $fillable = ['group_id', 'link', 'title'];

    /**
     * The table associated with the model.
     *
     * @var string
     */
    protected $table = 'group_resources';

    /**
     * Get the course group that owns the resource link.
     */
    public function group()
    {
        return $this->belongsTo(CourseGroup::class, 'group_id');
    }
}
