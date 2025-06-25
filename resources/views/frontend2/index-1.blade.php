
@extends('frontend.layouts.app'.config('theme_layout'))

@section('title', trans('labels.frontend.home.title').' | '.app_name())
@section('meta_description', '')
@section('meta_keywords','')


@push('after-styles')
    
@endpush

@section('content')



    <!-- Start of slider section ============================================= -->
     @include('frontend.layouts.partials.slider')
    <!-- End of slider section   ============================================= -->


    {{-- startcourse types foreach --}}
    @foreach ($courseTypes as $key=>$courseType)
    <!--  Training  -->
 
    <section class="training pt-35 pb-35 text-center justify-content-center">
        <div class="container-custome">
            <div class="training-overlay">
               @if($key==0)
                <div class="training-head">
                    <div class="title text-color">
                        <h2>@lang('labels.frontend.layouts.home.training')</h2>
                    </div>
               
                    <div class="desc">
                        <p>@lang('labels.frontend.layouts.home.training')</p>
                    </div>
                </div>
                @endif
                @if(count($courseType->PublishedAvailableCourses())>0)
                {{-- type title --}}
                <section class="locations pt-30 pb-80">
                    <div class="title title-courses">
                        <h2>{{(Lang::locale()=='en')?$courseType->name:$courseType->name_ar}}</h2>

                    </div>
                </section>
                {{-- end type title --}}
               @endif
                <div class="training-body">
                    {{-- <div class="links">
                        <ul class="list-unstyled d-flex text-center justify-content-center">
                            <li data-content="live-online" class="active">@lang('labels.frontend.layouts.home.live-online')</li>
                            <li data-content="online-courses">@lang('labels.frontend.layouts.home.online-courses')</li>
                        
                        </ul>
                    </div> --}}
                
    

                    <div class="training-content">   
                        @if(count($courseType->PublishedAvailableCourses())>0)


                        <div class="training-found live-online active">
                            <div class="related mb-0">
                                <div class="related-overlay">

                                    <div class="row">
                                        @foreach($courseType->PublishedAvailableCourses() as $key => $course)                                                                                   
                                        <div class="col-lg-3 col-md-6">
                                            @include('frontend.layouts.partials.course_box')
                                        </div>
                                        @endforeach                                        
                                    </div>
                                </div>
                            </div>
                        </div>
                        @endif
                      
                    </div>
                   
                </div>
            </div>
        </div>
    </section>
  
    <!--  Training  -->
    @endforeach

    
    
     
    {{-- end course types foreach --}}

    <!--  Classroom  -->

    <section class="classroom pt-35 pb-35">
        <div class="container-fluid">
            <div class="classroom-overlay">
                <div class="title text-color">
                    <h2>@lang('labels.frontend.layouts.home.classroom_courses')</h2>
                </div>
                <div class="title-pages">
                    <a href="{{url('courses')}}">@lang('labels.frontend.layouts.home.view_all_courses')</a>
                </div>
                <div class="desc related" style="margin-bottom: 0;padding-top: 0;padding-bottom: 0;">
                    <div class="container-custome related-overlay">
                        <div class="row">        
                          
                            @foreach($home_featured_courses as $key => $course)                                                                                   
                            <div class="col-lg-3 col-md-6">
                                @include('frontend.layouts.partials.course_box')
                            </div>
                            @endforeach    
                        </div>     
                    </div>
                </div>
            </div>
            
            <section class="training  text-center justify-content-center">
                <div class="container-custome">
                    <div class="training-overlay">
                        <div class="training-body"> 
                            <div class="training-content"> 
                                <a href="{{url('courses')}}" class="more">@lang('labels.frontend.layouts.home.see-more')</a>
                            </div>
                        </div>
                    </div>
                </div>
            </section>


        </div>
    </section>

    <!--  Classroom  -->

    <!--  Services  -->

    <section class="services pt-35 pb-35">
        <div class="container-custome">
            <div class="services-overlay">
                <div class="title text-color">
                    <h2> @lang('labels.frontend.layouts.home.services')</h2>
                </div>
                <div class="row">
                   
                    <div class="col-md-4 mb-35">
                        <div class="service">
                            <img src="{{asset('storage/uploads/'.$home_services[0]->home_service_image)}}" alt="Training" class="img-fluid" style="width: 100%;">
                            <div class="service-overlay">
                                <div class="service-content">
                                    <h2 class="text-center">@if(session('locale') == 'ar')  {{$home_services[0]->title_ar}} @else {{$home_services[0]->title}} @endif</h2>
                                </div>
                            </div>
                            <a href="{{$home_services[0]->link}}"></a>
                        </div>
                    </div>
                   
                    <div class="col-md-4 mb-35">
                        <div class="service middle">
                            <img src="{{asset('storage/uploads/'.$home_services[1]->home_service_image)}}" alt="Consulting" class="img-fluid">
                            <div class="service-overlay">
                                <div class="service-content">
                                    <h2 class="text-center">@if(session('locale') == 'ar')  {{$home_services[1]->title_ar}} @else {{$home_services[1]->title}} @endif</h2>
                                </div>
                            </div>
                            <a href="{{$home_services[1]->link}}"></a>
                        </div>
                        <div class="service middle">
                            <img src="{{asset('storage/uploads/'.$home_services[2]->home_service_image)}}" alt="Executing Coaching" class="img-fluid">
                            <div class="service-overlay">
                                <div class="service-content">
                                    <h2 class="text-center">@if(session('locale') == 'ar')  {{$home_services[2]->title_ar}} @else {{$home_services[2]->title}} @endif</h2>
                                </div>
                            </div>
                            <a href="{{$home_services[2]->link}}"></a>
                        </div>
                    </div>
                    <div class="col-md-4 mb-35">
                        <div class="service">
                            <img src="{{asset('storage/uploads/'.$home_services[3]->home_service_image)}}" alt="E-Learning" class="img-fluid">
                            <div class="service-overlay">
                                <div class="service-content">
                                    <h2 class="text-center">@if(session('locale') == 'ar')  {{$home_services[3]->title_ar}} @else {{$home_services[3]->title}} @endif</h2>
                                </div>
                            </div>
                            <a href="{{$home_services[3]->link}}"></a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <!--  Services  -->
    
    
    <!--  Training Methodology  -->

    <section class="training-methds pt-35 pb-35">
        <div class="container-custome">
            <div class="methds-overlay">
                <div class="title text-color">
                    <h2>@lang('labels.frontend.layouts.home.methodology')</h2>
                    <p>@lang('labels.frontend.layouts.home.methodology_more')</p>
                </div>
                <div class="row">
                    @foreach($methodologies as $index=>$methodology)
                    @if($index%2==0)
                    <div class="col-lg-3 col-md-6">
                        <div class="methd">
                            <div class="methd-top">
                                <div class="img-icon">
                                    <i class="fas fa-calendar-alt"></i>
                                </div>
                                <div class="title-methd">
                                    <h3>@lang('labels.frontend.layouts.home.'.$methodology->type)</h3>
                                    <div class="title text-color">@lang('labels.frontend.layouts.home.step') {{$index+1}}</div>
                                </div>
                            </div>
                            <div class="methd-bottom">
                                <div class="methd-front">
                                    <img src="{{asset('storage/uploads/'.$methodology->image)}}" alt="Analysis">
                                    <div class="center-title">
                                        <h2>@if(session('locale') == 'ar')  {{$methodology->title_ar}} @else {{$methodology->title}} @endif</h2>
                                    </div>
                                </div>
                                <div class="methd-back">
                                    <div class="back-content">
                                        @if(session('locale') == 'ar')  {!! $methodology->description_ar !!} @else {!! $methodology->description !!} @endif
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    @else
                    <div class="col-lg-3 col-md-6">
                        <div class="methd">
                            <div class="methd-bottom">
                                <div class="methd-front">
                                    <img src="{{asset('storage/uploads/'.$methodology->image)}}" alt="Analysis">
                                    <div class="center-title">
                                        <h2>@if(session('locale') == 'ar')  {{$methodology->title_ar}} @else {{$methodology->title}} @endif</h2>
                                    </div>
                                </div>
                                <div class="methd-back">
                                    <div class="back-content">
                                        @if(session('locale') == 'ar')  {!! $methodology->description_ar !!} @else {!! $methodology->description !!} @endif
                                    </div>
                                </div>
                            </div>
                            <div class="methd-top">
                                <div class="img-icon">
                                    <i class="far fa-edit"></i>
                                </div>
                                <div class="title-methd">
                                    <h3>@lang('labels.frontend.layouts.home.'.$methodology->type)</h3>
                                    <div class="title text-color">@lang('labels.frontend.layouts.home.step') {{$index+1}}</div>
                                </div>
                            </div>
                        </div>
                    </div>
                    @endif
                    @endforeach
                    
                </div>
            </div>
        </div>
    </section>

    <!--  Training Methodology  -->


    <!--  Topics  -->

    <section class="topics pt-35 pb-35">
        <div class="container-custome">
            <div class="topics-overlay">
                <div class="title text-color">
                    <h2>@lang('labels.frontend.layouts.home.topics')</h2>
                    <p>@lang('labels.frontend.layouts.home.topics_more')</p>
                </div>
                <div class="topics-content web-topics">
                   
                    @foreach($featured_categories as $category)
                    <div class="topic">
                        <div class="topic-content">
                            <div class="img-topic">
                                <i class="{{ $category->icon }}"></i>
                            </div>
                            <div class="title-topic">
                                <h3 class="text-center"> @if(session('locale') == 'ar') {{ $category->name_ar }} @else {{$category->name}}  @endif </h3>
                            </div>
                            <div class="mask-topic">
                                <h4> @lang('labels.frontend.layouts.home.view_courses') </h4>
                            </div>
                            <a href="{{route('courses.category',['category'=>$category->slug])}}"></a>
                        </div>
                    </div>
                    @endforeach
                    
                </div>
                
            </div>
        </div>
    </section>

    <!--  Topics  -->


    <!--  Locations  -->

    <section class="locations pt-30 pb-80">
        <div class="title title-courses">
            <h2>@lang('labels.frontend.layouts.home.locations')</h2>
        </div>
        <div class="container-custome">
            <div class="owl-carousel animate__animated animate__zoomIn wow owl-locations  owl-theme">  
                @foreach($locations as $location)
                <div class="item">
                    <a href="{{route('search-course')}}?location={{ $location->id }}">
                        <img src="{{asset('storage/uploads/'.$location->image)}}" class="img-fluid" alt=" @if(session('locale') == 'ar') {{ $location->title_ar }} @else {{$location->title}}  @endif">
                    </a>
                </div>
                @endforeach
            </div>
        </div>
    </section>
    

    <!--  Locations  -->


    <!--  Request  -->

    <div class="request pt-85 pb-85">
        <div class="container-custome">
            <div class="row">
                <div class="col-md-7">
                    <div class="request-left">
                        <div class="title-request">
                            <h4>@lang('labels.frontend.layouts.home.talk_to_us')</h4>
                            <h5>
                                @lang('labels.frontend.layouts.home.talk_to_us_desc')
                            </h5>
                        </div>
                    </div>
                </div>
                <div class="col-md-5">
                    <div class="request-right">
                        <form action="#">
                            <div class="row">
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <input type="text" name="name" id="name" class="form-control" placeholder="@lang('labels.frontend.layouts.home.name')">
                                    </div>
                                    <div class="form-group">
                                        <input type="text" name="phone" id="phone" class="form-control" placeholder="@lang('labels.frontend.layouts.home.phone')">
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <input type="email" name="mail" id="mail" class="form-control" placeholder="@lang('labels.frontend.layouts.home.email')">
                                    </div>
                                    <div class="form-group">
                                        <select  name="type" id="type" class="form-control" placeholder="type">                                        
                                            <option class="active active2">@lang('labels.frontend.layouts.home.Adminstration')</option>
                                            <option>@lang('labels.frontend.layouts.home.Training')</option>
                                            <option>@lang('labels.frontend.layouts.home.Consulting')</option>                                        
                                        </select>
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="form-group mb-0">
                                        <button type="submit">@lang('labels.frontend.layouts.home.request')</button>
                                    </div>
                                </div>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!--  Request  -->


    <!--  Proud  -->

    <section class="prouds pb-20">
        <div class="title title-prouds pb-65">
            <h2>@lang('labels.frontend.layouts.home.reasons')</h2>
            <p>@lang('labels.frontend.layouts.home.reasons_description')</p>
        </div>
        <div class="container-custome">
            <div class="row noowl-prouds" style="margin: 0;">
                @foreach($reasons as $reason)
                <div class="col-md-3">
                    <div class="proud">
                        <div class="proud-content">
                            <div class="img-icon">
                                <i class=" {{ $reason->icon }} "></i>
                            </div>
                            <div class="title-proud">
                                <h4> @if(session('locale') == 'ar') {{ $reason->title_ar }} @else {{$reason->title}}  @endif</h4>
                            </div>
                            <div class="desc-proud">
                                <p style="text-align: justify;height:100px;overflow:hidden"> @if(session('locale') == 'ar') {{ $reason->content_ar }} @else {{$reason->content}} @endif</p>
                            </div>
                        </div>
                    </div>
                </div>
                @endforeach
            </div>
            
        </div>
    </section>

    <!--  Proud  -->


    <!--  Clients Partners  -->

    <section class="clients-partners pt-30 pb-80">
        <div class="container-custome">
            <div class="row">
                <div class="col-md-6">
                    <div class="title title-clients-partners">
                        <h2>@lang('labels.frontend.layouts.home.clients')</h2>
                    </div>
                    <div class="owl-carousel animate__animated animate__zoomIn wow owl-clients owl-theme">
                        @foreach($clients as $client)
                        <div class="item">
                            <img src="{{ $client->image}}" class="img-fluid" alt="Clients">
                        </div>
                         @endforeach                       
                    </div>
                </div>
                <div class="col-md-6">
                    <div class="title title-clients-partners">
                        <h2>@lang('labels.frontend.layouts.home.partners')</h2>
                    </div>
                    <div class="owl-carousel animate__animated animate__zoomIn wow owl-partners owl-theme">
                        @foreach($sponsors as $sponsor)
                        <div class="item">
                            <img src="{{ $sponsor->image}}" class="img-fluid" alt="Clients">
                        </div>
                         @endforeach  
                    </div>
                </div>
            </div>
        </div>
    </section>
    
    <!--  Clients Partners  -->

    <!--  Stories  -->

    <section class="stories">
        <div class="stories-overlay">
            <div class="container-custome">
                <div class="title title-stories pb-20">
                    <h2>@lang('labels.frontend.layouts.home.stories')</h2>
                    <p>@lang('labels.frontend.layouts.home.stories_description')</p>
                </div>
                <div class="row stories-content noowl-stories" style="margin: 0;">
                    @foreach($stories as $story)
                    <div class="col-md-6">
                        <div class="story">
                            <div class="story-content">
                                <div class="story-top">
                                    <div class="story-front">
                                        <div class="story-front-content" style="background-image: url({{asset('storage/uploads/'.$story->image)}});"></div>
                                    </div>
                                    <div class="story-back">
                                        <div class="back-content">
                                            <p>
                                                <b>
                                                    @if(session('locale') == 'ar') {!! $story->description_ar !!} @else {!! $story->description !!}  @endif
                                                </b>
                                            </p>
                                        </div>
                                    </div>
                                </div>
                                <div class="story-bottom">
                                    <div class="bottom-head">
                                        <img src="{{asset('storage/uploads/'.$story->logo)}}" class="img-fluid" alt="Health">
                                        <h3>@if(session('locale') == 'ar') {{ $story->title_ar }} @else {{$story->title}}  @endif</h3>
                                    </div>
                                    <div class="bottom-body">
                                        <div class="row">
                                            <div class="col-md-6">
                                                <div class="part-story">
                                                    <div class="part-head">
                                                        <h4>@if(session('locale') == 'ar') {{ $story->course1_ar }} @else {{$story->course1}}  @endif</h4>
                                                    </div>
                                                    <div class="part-body">
                                                        <ul class="list-unstyled">
                                                            <li><i class="fas fa-calendar-alt"></i> {{ $story->date1 }} </li>
                                                            <li><i class="fas fa-users"></i>{{ $story->students1 }}  @lang('labels.frontend.layouts.home.students')</li>
                                                            <li><i class="fas fa-pencil-alt"></i>{{ $story->training_days1 }}  @lang('labels.frontend.layouts.home.training_days')</li>
                                                        </ul>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="col-md-6">
                                                <div class="part-story">
                                                    <div class="part-head">
                                                        <h4>@if(session('locale') == 'ar') {{ $story->course2_ar }} @else {{$story->course2}}  @endif</h4>
                                                    </div>
                                                    <div class="part-body">
                                                        <ul class="list-unstyled">
                                                            <li><i class="fas fa-calendar-alt"></i>{{ $story->date2 }} </li>
                                                            <li><i class="fas fa-users"></i>{{ $story->students2 }}  @lang('labels.frontend.layouts.home.students')</li>
                                                            <li><i class="fas fa-pencil-alt"></i>{{ $story->training_days2 }}  @lang('labels.frontend.layouts.home.training_days')</li>
                                                        </ul>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    @endforeach  
                </div>
                
            </div>
        </div>
    </section>

    <!--  Stories  -->

    <!--  What People Say  -->

    <section class="people-say pt-35 pb-35">
        <div class="people-overlay">
            <div class="container-custome">
                <div class="row">
                    <div class="col-md-8">
                        <div class="people">
                            <div class="head-people">
                                <h2>@lang('labels.frontend.layouts.home.testimonial')</h2>
                            </div>
                            <div class="body-people">
                                <div class="owl-carousel  owl-theme owl-people">
                                    @foreach($testimonials as $testimonial)
                                    <div class="item">
                                        <div class="item-content">
                                            <div class="media">
                                                <img src="{{asset('storage/uploads/'.$testimonial->image)}}" alt="Client" class="img-fluid" width="69px">
                                                <div class="media-body">
                                                    <h4>@if(session('locale') == 'ar') {{ $testimonial->name_ar }} @else {{$testimonial->name}}  @endif</h4>
                                                    <p>@if(session('locale') == 'ar') {{ $testimonial->occupation_ar }} @else {{$testimonial->occupation}}  @endif</p>
                                                    <div class="short-line"></div>
                                                </div>
                                            </div>
                                            <div class="item-body">
                                                <p>
                                                    @if(session('locale') == 'ar') {{ $testimonial->content_ar }} @else {{$testimonial->content}}  @endif
                                                </p>
                                            </div>
                                        </div>
                                    </div>
                                    @endforeach
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="col-md-4">
                        <div class="tour">
                            <div class="head-tour">
                                <h2>@lang('labels.frontend.layouts.home.video_tour')</h2>
                            </div>
                            <div class="body-tour">
                                <div class="tour-content">
                                    <span><i class="fas fa-play"></i></span>
                                </div>

                                <iframe width="100%" height="215px" src="https://www.youtube.com/embed/Odhx02TwZw8" frameborder="0" allowfullscreen></iframe>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <!--  What People Say  -->

    
@endsection

@push('after-scripts')
    
@endpush
