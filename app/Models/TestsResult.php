<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class TestsResult extends Model
{

    protected $table = 'results';
    protected $fillable = ['test_id', 'user_id', 'test_result'];

    public function answers()
    {
        return $this->hasMany('App\Models\TestsResultsAnswer');
    }


    public function test(){
        return $this->belongsTo(Test::class);
    }

    public function user(){
        return $this->belongsTo('App\Models\Auth\User');
    }

    
}
