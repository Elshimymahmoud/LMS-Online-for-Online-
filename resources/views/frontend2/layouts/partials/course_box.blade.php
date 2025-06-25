<style>
.date-span{
    font-size: 12px;
    margin: 0 10px ;
    display: inline-block;
}
</style>

<div class="relat">
    <div class="head-relat">
        <div class="img-relat">
            <img @if($course->course_image != "") src="{{asset('storage/uploads/'.$course->course_image)}}" @else  src="{{asset('images/course-default.jpeg')}}"   @endif  alt="Course3" class="img-fluid">
        </div>
        <a href="{{route('courses.show',['course'=>$course->slug])}}">{{$course->price}} SAR</a>
    </div>
    <div class="body-relat">
        <div class="top-body">
            <a href="{{route('courses.show',['course'=>$course->slug])}}">
                <h5 class="course-h5"> @if(session('locale') == 'ar') {{ $course->title_ar }} @else {{$course->title}}  @endif</h5>
            </a>
            @if($course->start_date )<span class="course-p date-span"><span class="black-red">  @lang('labels.frontend.layouts.home.start') :</span>{{ $course->start_date }}  </span>@endif
            @if($course->end_date )<span class="date-span"><span class="black-red"> @lang('labels.frontend.layouts.home.end') : </span>{{ $course->end_date }}</span>@endif
           
          
            
           <a href="{{route('courses.category',$course->category->slug)}}">
             <p> @if(session('locale') == 'ar') {{ $course->category->name_ar }} @else {{$course->category->name}}  @endif </p>
            </a>
            </div>
        <div class="bottom-body d-flex">
            <p >
                <i class="far fa-chart-bar"></i>
                {{ $course->students()->count() }}  @lang('labels.frontend.layouts.home.students')
            </p>
            <p>
                <i class="fas fa-list-ul"></i>
                {{ $course->lessons()->count() }} @lang('labels.frontend.layouts.home.lectures')
            </p>
            <p>
                <i class="fas fa-map-marker-alt"></i>
                @if(session('locale') == 'ar') {{ $course->type->name_ar }} @else {{$course->type->name}}  @endif
            </p>
        </div>
    </div>
</div>