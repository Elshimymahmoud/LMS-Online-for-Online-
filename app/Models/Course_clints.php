<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\File;
 
class Course_clints extends Model
{
    protected $guarded = [];
    protected $appends = ['image'];
    protected $table = 'course_clints';
    protected $fillable = [
        'name',
        'name_ar',
        'logo', 
        'link', 

               ];

    protected static function boot()
    {
        parent::boot();

        static::deleting(function ($Course_clints) { // before delete() method call this
            if (File::exists(public_path('/storage/uploads/' . $Course_clints->logo))) {
                File::delete(public_path('/storage/uploads/' . $Course_clints->logo));
            }
        });
    }

    public function getImageAttribute()
    {
        if ($this->logo != null) {
            return url('storage/uploads/'.$this->logo);
        }
        return NULL;
    }

    public function courses()
    {
        return $this->belongsToMany(CourseLocation::class, 'course_client', 'client_id', 'course_id')->withTimestamps();
    }


}
