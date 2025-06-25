<?php

namespace App\Models;

use App\Models\Auth\User;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;


class QuestionAnswers extends Model
{
    use SoftDeletes;

    protected $table = 'question_answers';

    protected $fillable = ['question_id', 'user_id', 'answer', 'answer_type',];

    public function question()
    {
        return $this->belongsTo(Question::class);
    }

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function options()
    {
        return $this->hasMany(QuestionsOption::class, 'question_id', 'question_id');
    }
}