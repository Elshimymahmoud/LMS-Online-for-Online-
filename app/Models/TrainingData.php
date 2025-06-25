<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class TrainingData extends Model
{
    //
    protected $table = 'training_data';
    protected $fillable = ['name','name_ar','is_active'];
    public function questions()
    {
        return $this->hasMany(TrainingDataQuestions::class,'id','training_data_id');
    }
}
