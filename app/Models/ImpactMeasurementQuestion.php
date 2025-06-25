<?php

namespace App\Models;


use Illuminate\Database\Eloquent\Model;

class ImpactMeasurementQuestion extends Model
{
    //
    protected $table = 'impact_measurement_questions';
    protected $fillable = ['question', 'question_ar','impact_measurement_id'];
    public function impactMeasurment()
    {
        return $this->belongsTo(ImpactMeasurement::class,'impact_measurement_id','id');
    }
}
