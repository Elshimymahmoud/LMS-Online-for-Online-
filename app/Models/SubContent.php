<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class SubContent extends Model
{
    //
    protected $fillable = ['content_id', 'title'];

    public function content()
    {
        return $this->belongsTo(Content::class, 'content_id');
    }

}
