<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class TrainingDataQuestions extends Model
{
    protected $table = 'training_data_questions';
    protected $fillable = ['question','question_ar','type','training_data_id','choose_number'];
 
    public function options()
    {
        return $this->hasMany('App\Models\TrainingDataQuestionsOptions','training_data_questions_id','id');
    }
}
