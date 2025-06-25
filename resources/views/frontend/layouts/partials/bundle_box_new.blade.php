{{-- @dd(asset('public/').'uploads/'.$course->course_image) --}}
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">

<div class="product-div">
    <div class="row m0 featured-img">
        {{-- <img style="width: 300px;height:200px"  @if($bundle->course_image != "" &&  file_exists('storage/uploads/'.$bundle->course_image)) src="{{ asset('storage/uploads/'.$bundle->course_image)}}" @else  src="{{asset('images/course-default.jpeg')}}"   @endif  alt="" /> --}}
        {{-- <img  @if($course->course_image != "" &&  file_exists('storage/uploads/'.$course->course_image)) src="{{ resize('uploads/'.$course->course_image,300,200)}}" @else  src="{{asset('images/course-default.jpeg')}}"   @endif  alt="" /> --}}
        <img style="height:200px" @if($bundle->course_image != "") src="{{asset('storage/uploads/'.$bundle->course_image)}}" @else src="{{asset('images/course-default.jpeg')}}"  @endif  alt="Course3" class="img-fluid">

        
    
    </div>
    <div class="inner-contain right-center">
        <a href="{{route('courses.category',['category'=>$bundle->category->slug])}}"><h5 class="category">@if(session('locale') == 'ar') {{ $bundle->category->name_ar }} @else {{$bundle->category->name}}  @endif</h5></a>
        
        <a href="{{route('bundles.show',['course'=>$bundle->slug])}}" ><h4 class="title text-color"> @if(session('locale') == 'ar') {{ $bundle->title_ar??$bundle->title}} @else {{$bundle->title}}  @endif</h4></a>

        @if($bundle->description_ar||$bundle->description)
        <p class="prod-det">
            @if(session('locale') == 'ar') {{ sub($bundle->description_ar,0,120) }} @else {{sub($bundle->description,0,120) }}  @endif
        </p>
        @endif
        <a href="{{ route('bundles.show', [$bundle->slug]) }}" class=" btn btn-view fw100 mtb-10">@lang('labels.general.more')</a>
        <div class="row">
            <div class="col-sm-6 col-md-6 course-lectures">
                <p>
                    <i class="fas fa-chalkboard-teacher"></i>
                    <i class="far fa-chart-bar"></i>
                    {{ $bundle->students()->count() }}  @lang('labels.frontend.layouts.home.students')
                </p>
                <p>
                    <i class="fas fa-list-ul"></i>
                    <i class="fas fa-money-bill-alt"></i>
                    {{ $bundle->courses()->count() }}
                    @if($bundle->courses()->count() > 1 )
                        @lang('labels.frontend.course.courses')
                    @else
                        @lang('labels.frontend.course.course')
                    @endif 
                </p>
            </div>
            <div class="col-sm-6 col-md-6 course-price">{{$bundle->price}}  {{$appCurrency['symbol']}} </div>
        </div>
    </div>
</div>

