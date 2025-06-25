<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\File;

class Client extends Model
{
    protected $guarded = [];
    protected $appends = ['image'];

    protected static function boot()
    {
        parent::boot();

        static::deleting(function ($client) { // before delete() method call this
            if (File::exists(public_path('/storage/uploads/' . $client->logo))) {
                File::delete(public_path('/storage/uploads/' . $client->logo));
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
    public function courseLocation()
    {
        return $this->hasMany(CourseLocation::class);
    }

}
