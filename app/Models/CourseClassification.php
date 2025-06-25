<?php

namespace App\Models;

use Carbon\Carbon;
use App\Models\Course;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class CourseClassification extends Model
{
    use SoftDeletes;

    protected $table = 'course_classification';
    protected $guarded = [];

    public function PublishedAvailableCourses()
    {
       
        return  Course::whereHas('locations',function ($q){
                
            // $q->whereDate('end_date', '>=', Carbon::now())->orWhereNull('end_date');
            })
            ->withoutGlobalScope('filter')
        ->whereHas('category')
        ->where('published', '=', 1)
        ->where('type_id', '=', $this->id)->latest()->take(6)->get();
        
    }

    public function classification(){
        // return $this->belongsTo(\App\Models\Course::class, )
    }
    public function courses()
    {
        return $this->hasMany(\App\Models\Course::class,'course_classification_id');
    }

    
    
}
