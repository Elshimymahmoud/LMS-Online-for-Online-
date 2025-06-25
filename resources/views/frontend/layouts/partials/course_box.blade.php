{{-- @dd(asset('public/').'uploads/'.$course->course_image) --}}

<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
<style>
    i{
        font-size: 22px;
        line-height: 28px;
        margin: 0 5px;
        color: #4f198d;
        
    }
    .product-div{
        display: flex;
        flex-direction: column;
    justify-content: space-between;
    flex-wrap: wrap;
    }
   .long-part{
    min-height: 300px;
    display: flex;
    flex-direction: column;
    justify-content: space-between;
    flex-wrap: wrap;
   }
   .collections .item .title{
    min-height: 80px;
    display: flex;
    align-items: center;
    justify-content: center;
   }
</style>
<div class="product-div" style="    min-height: 600px;">
    <div class="row m0 featured-img">
        <img style="width: 100%;height:220px"  @if($course->course_image != "" &&  file_exists('storage/uploads/'.$course->course_image)) src="{{ asset('storage/uploads/'.$course->course_image)}}" @else  src="{{asset('images/course-default.jpeg')}}"   @endif  alt="" />
        {{-- <img  @if($course->course_image != "" &&  file_exists('storage/uploads/'.$course->course_image)) src="{{ resize('uploads/'.$course->course_image,300,200)}}" @else  src="{{asset('images/course-default.jpeg')}}"   @endif  alt="" /> --}}
        
    
    </div>
    <div class="inner-contain right-align long-part">
        <a href="{{route('courses.category',['category'=>$course->category->slug])}}"><h5 class="category">@if(session('locale') == 'ar') {{ $course->category->name_ar }} @else {{$course->category->name}}  @endif</h5></a>
        <a href="{{route('courses.show',['course'=>$course->slug])}}" >
            <h4 class="title text-color" style="white-space:normal;font: 500 18px/1 'Noto Kufi Arabic', sans-serif;"> @if(session('locale') == 'ar') {{ $course->title_ar }} @else {{$course->title}}  @endif</h4></a>
        <p class="prod-det">
            @if(session('locale') == 'ar') {{ sub($course->description_ar,0,120) }} @else {{sub($course->description,0,120) }}  @endif
        </p>

        <div class="row"style="margin-top:20px">
            <div class="col-sm-6 col-md-6 course-lectures" style="display: flex;align-items:center">
                @php


                @endphp
                <i class="fas fa-chalkboard-teacher"></i>
                {{ $course->lessons->count() }}
                @lang('labels.frontend.layouts.home.lectures')


            </div>

            <div class="col-sm-6 col-md-6 course-price" style="display: flex;align-items:center;justify-content:end"> 
                
               </div>
                
        </div>
        <a href="{{route('courses.show',['course'=>$course->slug])}}" class=" btn btn-view fw100 mtb-10" style="margin-top:20px ;">@lang('labels.general.more')</a>
    
    </div>
</div>


