<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class courseGroupTestResultAnswer extends Model
{
    //
    protected $fillable = ['result_id', 'question_id', 'option_id', 'correct','answer'];
    
    protected $table = 'course_group_results_answers';

    public function question(){
        return $this->belongsTo(Question::class);
    }

    public function option(){
        return $this->belongsTo(QuestionsOption::class,'option_id','id');
    }

    public function courseGroupTestResult()
    {
        return $this->belongsTo(CourseGroupTestResult::class);
    }
}
