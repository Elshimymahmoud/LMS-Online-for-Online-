<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class TrainingDataQuestionsOptions extends Model
{
    //
    protected $table = 'training_data_questions_options';
    protected $fillable = ['training_data_questions_id','option_text'];

    public function question(){
        return $this->belongsTo(TrainingDataQuestions::class);
    }
   
}
