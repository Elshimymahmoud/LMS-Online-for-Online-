<?php

namespace App\Models;
use Illuminate\Database\Eloquent\Model;

class programRecommendationQuestion extends Model
{
    //
    protected $table = 'program_recommendation_questions';
    protected $fillable = ['question', 'question_ar','program_recommendations_id'];
    public function programRecommendation()
    {
        return $this->belongsTo(programRecommendation::class,'program_recommendations_id','id');
    }
}
