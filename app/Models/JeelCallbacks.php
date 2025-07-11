<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class JeelCallbacks extends Model
{
    protected $guarded = [];

    public function order()
    {
        return $this->hasOne(Order::class, 'id', 'order_id');
    }
}
