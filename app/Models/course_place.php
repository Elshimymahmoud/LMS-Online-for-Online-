<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class course_place extends Model
{
    //
    protected $fillable = ['id', 'name','name_ar', 'location_id'];

    /**
     * Get the location that owns the course_place
     *
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function location()
    {
        return $this->belongsTo(Location::class);
    }

    public function groups()
    {
        return $this->hasMany(CourseGroup::class, 'place_id');
    }

}
