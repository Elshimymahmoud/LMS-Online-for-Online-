<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class ResultsAnswer extends Model
{
    //
    protected $fillable = ['result_id', 'question_id', 'option_id', 'correct','answer', 'plagiarism_degree'];
    
    protected $table = 'results_answers';

    public function question(){
        return $this->belongsTo(Question::class);
    }

    public function option(){
        return $this->belongsTo(QuestionsOption::class,'option_id','id');
    }

    public function testResult(){
        return $this->belongsTo(Result::class,'result_id','id');
    }
}
