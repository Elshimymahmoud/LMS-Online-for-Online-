<?php

namespace App\Models;

use App\Models\Auth\User;
use Illuminate\Database\Eloquent\Model;

class OrderItem extends Model
{
    protected $guarded = [];

//    public function course(){
//        return $this->belongsTo(Course::class);
//    }
//
//    public function bundle(){
//        return $this->belongsTo(Bundle::class);
//    }
//

    public function course(){
        return $this->hasManyThrough(Course::class,User::class);
    }

    public function item()
    {
        return $this->morphTo();
    }

    public function order(){
        return $this->belongsTo(Order::class);
    }
    public function courseLocation(){
        return $this->belongsTo(CourseLocation::class,'item_location_id');
    }
    public function group()
    {
        return $this->belongsTo(CourseGroup::class, 'item_group_id');
    }
}
