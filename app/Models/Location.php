<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Location extends Model
{
    protected $table = 'locations';
    protected $fillable = ['name', 'name_ar',  'image','country_name','country_name_ar','courses_type'];

    /**
     * Get all of the places for the Location
     *
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function places()
    {
        return $this->hasMany(course_place::class);
    }

    public function cur()
    {

    }

    public function groups()
    {
        return $this->hasMany(CourseGroup::class, 'location_id');
    }


}
