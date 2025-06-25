<?php

namespace  App\Models;

use App\Models\Rate;
use Illuminate\Database\Eloquent\Model;

class RateQuestion extends Model
{
    //
    protected $table = 'rate_questions';
    protected $fillable = ['question', 'question_ar','question_option','question_option_ar','question_type','rate_id'];
    public function rate()
    {
        return $this->belongsTo(Rate::class,'rate_id','id');
    }
}
