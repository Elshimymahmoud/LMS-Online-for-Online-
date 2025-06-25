<i class="fa fa-clock-o" aria-hidden="true"></i>
<span>
    
    @php
    use Carbon\Carbon;
    $days=0;
    if(count(auth()->user()->courseLoc($course->id)->get())>0){
        $courseLocId=isset($course_location_id)?$course_location_id:auth()->user()->courseLoc($course->id)->latest('pivot_created_at')->first()->pivot->course_location_id;
       $courseLocation=\App\Models\CourseLocation::find($courseLocId) ;
       
       
       $isEndDatePast = Carbon::parse($courseLocation->end_date)->isPast();
        if($isEndDatePast==true){
            $days=0;
        }
        else{
            $days=now()->diffInDays($courseLocation->end_date);
        }
    }
    
       


    @endphp
  
  باقي {{$days}} يوم على موعد انتهاء الدورة

</span>
