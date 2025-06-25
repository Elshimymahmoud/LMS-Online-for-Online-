@extends('frontend.layouts.app1new')


@section('title', trans('labels.frontend.landing.landing_home').' | '.app_name())
@section('meta_description', '')
@section('meta_keywords','')


@push('after-styles')
<link rel="shortcut icon" type="image/x-icon" href="assets/images/x-icon/01.png">

<!-- <link rel="stylesheet" href="{{asset('assets-land/css/bootstrapp.min.css')}}"> -->
<link rel="stylesheet" href="{{asset('assets-land/css/all.min.css')}}">
<link rel="stylesheet" href="{{asset('assets-land/css/icofont.min.css')}}">
<link rel="stylesheet" href="{{asset('assets-land/css/lightcase.css')}}">
<link rel="stylesheet" href="{{asset('assets-land/css/swiper.min.css')}}">
<link rel="stylesheet" href="{{asset('assets-land/css/style.css')}}">
    <style>
        .home-slider.owl-carousel .owl-item img {
            height: 196px;
        }
        .home-slider.owl-carousel .owl-next  .fa-angle-right{
            margin-left: 20px;
        }
        .home-slider.owl-carousel .owl-prev  .fa-angle-left{
            margin-right: 20px;
        }
        .main-color{
            color: #4f198d;
        }
        .btn-revert-color{
            color: #4f198d;
            background-color: white;
        }
        .padding-b-13{
            padding-bottom: 13px;
        }
        .padding-t-82{
            padding-top: 82px;
        }
  
    </style>
    <style>
            .people-say {
    background-color: #e2e2e2;
}
.pb-35 {
    padding-bottom: 35px!important;
}
.pt-35 {
    padding-top: 35px!important;
}
.people-say .people-overlay .people .head-people, .people-say .people-overlay .people .head-tour, .people-say .people-overlay .tour .head-people, .people-say .people-overlay .tour .head-tour {
    padding-bottom: 8px;
    margin-bottom: 10px;
    border-bottom: 1px solid #ccc;
}
.no-js .owl-carousel, .owl-carousel.owl-loaded {
    display: block;
}

.owl-carousel {
    direction: ltr !important;
}
.owl-carousel {
    display: none;
    width: 100%;
    z-index: 1;
}
.owl-carousel, .owl-carousel .owl-item {
    -webkit-tap-highlight-color: transparent;
    position: relative;
}
.owl-carousel .owl-stage-outer {
    position: relative;
    overflow: hidden;
    -webkit-transform: translate3d(0,0,0);
}
content.active {
    opacity: 0;
    z-index: 1;
}
.people-say .people-overlay .tour .body-tour .tour-content {
    background: url(../img/home/1.jpg) center center no-repeat;
    background-size: cover;
    width: 100%;
    
    position: relative;
    cursor: pointer;
    z-index: 3;
}
.people-say .people-overlay .tour .body-tour {
    position: relative;
}
.people-say .people-overlay .people .body-people .owl-people .item .item-content .media .media-body h4, .people-say .people-overlay .tour .body-people .owl-people .item .item-content .media .media-body h4 {
    margin: 8px 0 4px;
    line-height: 26px;
    font-weight: 700;
    font-size: 15px;
    color: ##3bcfcb;}

    .people-say .people-overlay .people .body-people .owl-people .item .item-content .media img, .people-say .people-overlay .tour .body-people .owl-people .item .item-content .media img {
    margin-right: 0;
    margin-left: 8px;
}

.people-say .people-overlay .people .body-people .owl-people .item .item-content .media img, .people-say .people-overlay .tour .body-people .owl-people .item .item-content .media img {
    width: 69px;
    border-radius: 50%;
    margin-right: 15px;
}
.section-header h2{
    
    background-image: linear-gradient(90deg, {{$Landing_color->heading_color}} 0%, {{$Landing_color->heading_color}} 100%);
}
.speaker-infos a{
    color:{{$Landing_color->heading_color}};

}
.schedule-pack h5{ 
    color:{{$Landing_color->heading_color}};

}
.schedule-pack .schedule-list .accordion-item .accordion-header .accordion-button .accor-header-inner .h7
{
    color:{{$Landing_color->heading_color}};
}


.news-item .news-inner .news-content h6 a {
    color:{{$Landing_color->heading_color}};
}
i{
    color:{{$Landing_color->icon_color}};
}
.news-item .news-inner .news-content p{
    color:{{$Landing_color->paragraph_color}};
}
.section-header p{
    color:{{$Landing_color->paragraph_color}};

}
.sponsor-section .section-header p{
    color:{{$Landing_color->paragraph_color}};

}
.speaker-item .speaker-inner .speaker-content .spkr-content-details p{
    color:{{$Landing_color->paragraph_color}};

}
.about-section{
    background-color:{{$Landing_color->about_color}};

}
.schedule-section{
    background-color:{{$Landing_color->courses_color}};

}
.speaker-item .speaker-inner{
    /* background-color:{{$Landing_color->speaker_color}}; */
    background-color:#F6F0E7;

}
.sponsor-section{
    background-color:{{$Landing_color->sponser_color}};

}
.news-section{
    background-color:{{$Landing_color->blog_color}};


}
.owl-theme .owl-nav [class*=owl-] {
    background: #d6d6d60f;
    color:white;
}
.schedule-pack .schedule-list .accordion-item .accordion-header .accordion-button.collapsed:after {

    float: right;
    margin-top: -12%;
    margin-right: 13%;
}
.owl-prev i, .owl-next i {
    margin-left: 63px;
    color: white;
}

    </style>
@endpush

@section('content')


   
    <!--==========content==========-->
    <section class="row ltr  the-slider" id="slider">
            <div class="row">
                <div class="large-12 columns">
                    <div class="home-slider ">
                       
                      
                        
                        <div class="item">
                            <div  style="background: url({{asset('images/landing/6.jpg')}});background-size: cover;height:500px;background-color: #fdfaf1;">
                                <div class="container">
                                    <div class="row benefit-notes rtl">
                                        <!--==========Single Benefit==========-->
                                        <div class="col-sm-8 col-md-7 benefit wow fadeInUp ptb-50 slider-content">
                                            <div class="row benefit-notes rtl" style=" float: right; margin-right: 26%;">
                                                <div class="col-4  " style="float: left;padding: 2px">
                                                <h5 style="color:black;background-color: white;text-align: center;">دقيقه</h5>

                                                    <div style="width: 94px;height: 84px;background-color:#F45978;margin-top: -10px;text-align: center;">
                                                        <p style="color:black;font-weight: 900;padding: 28px 9px">00</p>
                                                    </div>
                                                </div>
                                                <div class="col-4 "style="float: left;padding: 2px">
                                                <h5 style="color:black;background-color: white;text-align: center;">ساعه</h5>

                                                <div style="width: 94px;height: 84px;background-color:#D15CD5;margin-top: -10px;text-align: center;">
                                                    <p style="color:black;font-weight: 900;padding: 28px 9px">00</p>
                                                </div>
                                                </div>
                                             <div class="col-4"style="float: left;padding: 2px">
                                                <h5 style="color:black;background-color: white;text-align: center;">يوم</h5>
                                                    <div style="width: 94px;height: 84px;background-color:#7ECBFF;margin-top: -10px;text-align: center;">
                                                         <p style="color:black;font-weight: 900;padding: 28px 9px">00</p>
                                                    </div>
                                             </div>

                                            </div>
                                            <h4 style="color:white;margin-bottom: 0px;margin-right: 26%;margin-top: 20%;">
                                                     @if (session('locale') == 'ar') {{ $course->title_ar ?? $course->title }} @else {{ $course->title ?? $course->title_ar }} @endif
                      
                                            </h4>
                                            <p style="color:white;margin-bottom: 0px;margin-right: 26%;font-size: 20px;line-height: 40px">
                                                انضم الي عائلتناالدوليه اليوم ! يرجي الاتصال بنا للحصول علي مذيد من المعلومات
                                            </p>

                                           @if(!auth()->check() )
                                                <a href="{{route('frontend.auth.login')}}" style="margin-right: 52%;background: #ffffff;color: #0a0a0a;border-radius:0px;margin-top: 5%;"class="btn btn-primary btn-lg ">
                                                    @lang('labels.frontend.home.join_now_bottom')
                                                </a>
                                                    @endif
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    

                    </div>

                    
                </div>
            </div>
    </section>


    
    <!-- ==========Banner Section end Here========== -->

<div class="">
    <!-- ==========About Section start Here========== -->
    <section class="about-section padding-tb padding-b ">
        <div class="container">
            <div class="row justify-content-center">
                <div class="col-lg-12">
                    <div class="about-image">
                        <img src="{{asset('images/landing/8.png')}}" alt="about image" style="width:100%">
                        <a href="https://www.youtube.com/embed/Odhx02TwZw8" class="play-btn" data-rel="lightcase">
                            <i class="icofont-ui-play"></i>
                            <span class="pluse_2"></span>
                        </a>
                    </div>
                </div>
                <div class="col-lg-12">
                    <div class="section-header text-center">
                        <h2> @if (session('locale') == 'ar') {{ $course->title_ar ?? $course->title }} @else {{ $course->title ?? $course->title_ar }} @endif
                       </h2>
                        <!-- <p>About Digital Meetup Conference 2021</p> -->
                    </div>
                    <div class="section-wrapper text-center">
                        <p>
                        @if (session('locale') == 'ar')
                                {!! $course->short_description_ar ?? $course->short_description !!}
                            @else
                                {!! $course->short_description ?? $course->short_description_ar !!}
                            @endif
                        </p>
                        <div class="about-btn-grp">
                            <!-- <a href="registration.html" class="lab-btn style-orange "><span><i
                                        class="icofont-tasks"></i> Register
                                    Now</span> </a>
                            <a href="pricing-plan.html" class="lab-btn"><span><i class="icofont-ticket"></i> Purchase
                                    Ticket</span></a> -->
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>


    <!-- ==========schedule Section start Here========== -->
    <section class="schedule-section padding-tb padding-b "style="position: relative;
             background: url({{asset('images/landing/5.jpg')}});background-size: cover;highte:1291px;background-color: #fdfaf1;">
       
        <div class="container">
            <div class="section-header">
                <h2 style="background-image: linear-gradient(90deg, #ffffff 0%, #ffffff 100%);"> @lang('labels.frontend.course.course-curr')</h2>
                <!-- <p>A Representation of the event planning</p> -->
            </div>
            <div class="section-wrapper section-sch owl-theme">
                <div class="row g-4 justify-content-center">
                @foreach($course->chapters()->orderBy('sequence', 'asc')->get() as $key=> $chapter)
                   
                      <div class="item" style="padding:12px">
                        <div class="schedule-left schedule-pack">
                            <h5>
                            {{ (session('locale') == 'ar')?$chapter->title_ar:$chapter->title}} : {{$chapter->session_length}} 
                                         
                                         @if($chapter->length_type=='hour')
                                         @if(in_array($chapter->session_length,[3,4,5,6,7,8,9,10]))
                                         @lang('labels.frontend.course.hours')
                                         @else
                                         @lang('labels.frontend.course.hour')

                                         @endif
                                         @else 
                                         @if(in_array($chapter->session_length,[3,4,5,6,7,8,9,10]))

                                         @lang('labels.frontend.course.minutes')
                                         @else
                                         @lang('labels.frontend.course.minute')

                                         @endif
                                         @endif
                            </h5>
                            @foreach($course->courseTimeline as $item)
                             @if(@$item->model->chapter_id==$chapter->id)
                            <div class="schedule-list" id="accordionExample">
                                <div class="accordion-item">
                                    <div class="accordion-header" id="headingOne">
                                        <button class="accordion-button collapsed" type="button"style="width: 100%;"
                                            data-bs-toggle="collapse" data-bs-target="#collapseOne{{$item->model->id}}" aria-expanded="true"
                                            aria-controls="collapseOne{{$item->model->id}}">
                                            <span class="accor-header-inner d-flex flex-wrap align-items-center">
                                              <div class="row" style="margin: 3%">
                                                  <div class="col-4"style="float: left;" >
                                                    <span class="">
                                                            <img style="width: 100px;height:100px;border-radius: 50%;" @if($course->course_image != "" &&  file_exists('images/landing/'.$course->course_image)) src="{{ asset('images/landing/'.$course->course_image)}}" @else  src="{{asset('images/course-default.jpeg')}}"   @endif  alt="speaker">

                                                        </span> 
                                                   </div>
                                                   <div class="col-4"style="float: left;" >
                                                <span> </span>
                                                </div>
                                                <div class="col-4"style="float: left;margin-left: 9%; margin-top: 7%;" >
                                                <span class="h7" style="display: inline;color:white">
                                                 {{ (session('locale') == 'ar')?$item->model->title_ar:$item->model->title}}
                                                </span>
                                                </div>
                                                </div>
                                            </span>
                                           
                                        </button>
                                    </div>
                                    <div id="collapseOne{{$item->model->id}}" class="accordion-collapse collapse"
                                        aria-labelledby="headingOne" data-bs-parent="#accordionExample">
                                        <div class="accordion-body" style="padding-right: 95px;">
                                            <p>  @if(session('locale') == 'ar') {{ sub($course->description_ar,0,120) }} @else {{sub($course->description,0,120) }}  @endif

                                            </p>
                                            <ul class="ev-schedule-meta d-flex flex-wrap" style="overflow-x:hidden;white-space:nowrap; ">
                                                    @if (count($courseLocations) > 0)
                                                    @foreach ($courseLocations as $location)
                                                                        
                                            
                                                <li style="display: inline;"><span><i class="icofont-location-pin"></i>
                                                   {{session('locale') == 'ar'? $location->location->name_ar:$location->location->name }}
                                                         </span>
                                                </li>
                                               

                                              
                                                @if($location->location->id!=2)
                                                <li style="display: inline;"><span><i class="fa fa-calendar" ></i>
                                                {{ $location->start_date }}
                                                          </span> 
                                                  </li>
                                               @endif
                                               @endforeach
                                               @endif
                                            </ul>
                                        </div>
                                    </div>
                                </div>
                                
                               
                               
                                
                                </div>
                                @endif
                            @endforeach
                            </div>
                           
                        </div>
                      @endforeach

                       </div>

                         
                

                </div>
                <div class="schedule-btns text-center mt-5" style="margin-top: 3%;">
                    <a href="#" class="lab-btn" style="background-image: linear-gradient(90deg, #ffffff 0%, #ffffff 100%);"><span style="color:#742b3c"><i class="icofont-cloud-download"></i> تحميل الجدول</span>
                    </a>
                </div>
                <script>
                        $(document).ready(function() {
                            var owl = $(".section-sch");
                            owl.owlCarousel({
                                margin: 10,
                                nav: true,
                                loop: true,
                                dots: false,
                                navText: [
                                    '<i class="fa fa-angle-left" aria-hidden="true"></i>',
                                    '<i class="fa fa-angle-right" aria-hidden="true"></i>'
                                ],
                                responsive: {
                                    0: {
                                        items: 2
                                    },
                                    600: {
                                        items: 2
                                    },
                                    1000: {
                                        items: 2
                                    }
                                }
                            });
                        });
                    </script>
            </div>
  
                
    </section>
    <!-- ==========schedule Section end Here========== -->


    <!-- Speakers section start here -->
    <section class="speakers-section padding-tb padding-b ">
        <div class="container">
            <div class="section-header">
                <h2>@lang('labels.frontend.landing.Our_Speakers')</h2>
                <p>@lang('labels.frontend.landing.Meet_Our_World’s_Leading_Speakers')</p>
            </div>
            <div class="section-wrapper">
                <div class="row g-4 justify-content-center">
                @foreach ($course->teachers as $key => $teacher)

                    <div class="col-xl-4 col-lg-6 col-12">
                        <div class="speaker-item"style="padding:5px;">
                            <div class="speaker-inner">
                                <div class="speaker-thumb">
                                <img style="width: 200px;height:200px;border-radius: 50%;" src="{{ $teacher->picture }}" >
                                       
                                </div>
                                <div class="speaker-content">
                                    <div class="spkr-content-title d-flex flex-wrap justify-content-between">
                                        <div class="speaker-infos">
                                            <h5><a href="#">
                                            @if (session('locale') == 'ar')
                                                {{ $teacher->name_ar ?? $teacher->name }}
                                            @else
                                                {{ $teacher->name ?? $teacher->name_ar }}
                                            @endif
                                            </a> </h5>
                                            
                                        </div>
                                        <div class="speaker-comp-logo">
                                             </div>
                                    </div>
                                    <div class="spkr-content-details">
                                        <p>
                                        @if (session('locale') == 'ar')
                                                {{ sub($teacher->teacherProfile->description_ar ?? $teacher->teacherProfile->description, 0, 350) }}
                                            @else
                                                {{ sub($teacher->teacherProfile->description ?? $teacher->teacherProfile->description_ar, 0, 350) }}
                                            @endif
                                        </p>
                                        <ul class="social-icons">
                                            <li><a href="{{ $teacher->teacherProfile->facebook_link }}"><i class="icofont-facebook"></i></a></li>
                                            <li><a href="{{ $teacher->teacherProfile->twitter_link }}"><i class="icofont-twitter"></i></a></li>
                                            <li><a href="{{ $teacher->teacherProfile->linkedin_link }}"><i class="icofont-linkedin"></i></a></li>
                                        </ul>
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
    <!-- Speakers section end here -->

    <!-- ======= Sponsor sectin start here ======== -->
    <section class="sponsor-section padding-tb padding-b bg-image" style="background: url({{asset('images/landing/7.jpg')}});background-size: cover;highte:1291px;background-color: #fdfaf1;">
        <div class="container">
            <div class="section-header">
                <h2>@if (session('locale') == 'ar') {{ $course->title_ar ?? $course->title }} @else {{ $course->title ?? $course->title_ar }} @endif
                     </h2>
                <p>حول 
                @if (session('locale') == 'ar') {{ $course->title_ar ?? $course->title }} @else {{ $course->title ?? $course->title_ar }} @endif
                     
                </p>
            </div>
            <div class="section-wrapper text-center">
                <div class="all-sponsor">
                    <h5>الراعي الذهبي</h5>
                    <div class="platinum-sponsor">
                        <div class="swiper-wrapper">
                        @foreach($sponsers as $sponser)
                            <div class="swiper-slide" style="width:282px !important">
                                <img  alt="sponsor" @if($sponser->logo != "" &&  file_exists('images/landing/'.$sponser->logo)) src="{{ asset('images/landing/'.$sponser->logo)}}" @else  src="{{asset('images/course-default.jpeg')}}"   @endif  alt="sponser">
                            </div>
                           @endforeach 
                            
                        </div>
                    </div>

                    <!-- silver-sponsor -->
                    <h5 class="mt-4">الراعي الفضي</h5>
                    <div class="silver-sponsor">
                        <div class="swiper-wrapper">
                        @foreach ($clients as $client)
                            <div class="swiper-slide">
                                <img src="{{ $client->image }}" alt="sponsor">
                            </div>
                           @endforeach 

                            
                        </div>
                    </div>
                </div>
                <a href="#" class="lab-btn" style="background-image: linear-gradient(90deg, #ffffff 0%, #ffffff 100%);">
                <span style="color:#742b3c"> كن راعيا لنا</span>
                    </a>
                    </span></a>
            </div>
        </div>
    </section>
    <!-- ======= Sponsor sectin end here ======== -->

<!-- ===== Pricing Plan Start here  ==== -->
<section class="pricing-plan-section padding-tb padding-b shape-img">
        <div class="container">
            <div class="section-header">
                <h2> خطه التسعير لدينا</h2>
                <p>حول  
                @if (session('locale') == 'ar') {{ $course->title_ar ?? $course->title }} @else {{ $course->title ?? $course->title_ar }} @endif
                      
                </p>
            </div>
            <div class="section-wrapper">
                <div class="row g-4 justify-content-center">
                    <div class="col-4 col-md-4 col-6">
                        <div class="pricing-item blue-style">
                            <div class="pricing-inner">
                                <div class="pricing-header">
                                    <h3>تمرير كبار الشخصيات</h3>
                                    

                                </div>
                                <div class="pricing-content">
                                    <ul class="facilites">
                                        <li class="facility-item" style="text-align: center;">
                                            <span>
                                            </span> حضور الحدث
                                        </li>
                                        <li class="facility-item" style="text-align: center;">
                                            <span>
                                            </span> الوصول الي منطقه الشبكات
                                        </li>
                                        <li class="facility-item" style="text-align: center;">
                                            <span>
                                            </span> الشاي والقهوه
                                        </li>
                                        <li class="facility-item" style="text-align: center;">
                                            <span>
                                            </span>غداء
                                        </li>
                                        <li class="facility-item" style="text-align: center;">
                                            <span>
                                            </span> واي فاي مجاني
                                        </li>
                                        <li class="facility-item" style="text-align: center;">
                                            <span>
                                            </span>تذكره يانصيب 3
                                        </li>
                                    </ul>
                                    <div class="get-ticket">
                                        <a href="#" style="text-align: center;">
                                            
                                                    <h4 style="color: white; background-color: #359af1;padding: 15px;">$99</h4>
                                                   
                                          
                                        </a>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="col-4 col-md-4 col-6">
                        <div class="pricing-item orange-style">
                            <div class="pricing-inner">
                                <div class="pricing-header">
                                    <h3>تمرير كامل</h3>
                                

                                </div>
                                <div class="pricing-content">
                                    <ul class="facilites">
                                        <li class="facility-item" style="text-align: center;">
                                            <span>
                                            </span> حضور الحدث
                                        </li>
                                        <li class="facility-item" style="text-align: center;" >
                                            <span>
                                            </span> الوصول الي منطقه الشبكات
                                        </li>
                                        <li class="facility-item" style="text-align: center;">
                                            <span>
                                            </span> الشاي والقهوه
                                        </li>
                                        <li class="facility-item" style="text-align: center;">
                                            <span>
                                            </span>غداء
                                        </li>
                                        <li class="facility-item" style="text-align: center;">
                                            <span>
                                            </span> واي فاي مجاني
                                        </li>
                                        <li class="facility-item" style="text-align: center;">
                                            <span>
                                            </span>تذكره يانصيب 3
                                        </li>
                                    </ul>
                                    <div class="get-ticket">
                                        <a href="#" style="text-align: center;">
                                            
                          
                                                    <h4 style="color:white;color: white; background-color: #fa5876;padding: 15px;" >$99</h4>
                                                   
                                                
                                        </a>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="col-4 col-md-4 col-6">
                        <div class="pricing-item purple-style">
                            <div class="pricing-inner">
                                <div class="pricing-header">
                                    <h3> يوم واحد</h3>
                                   

                                </div>
                                <div class="pricing-content">
                                    <ul class="facilites">
                                        <li class="facility-item" style="text-align: center;">
                                            <span>
                                            </span> حضور الحدث
                                        </li>
                                        <li class="facility-item" style="text-align: center;">
                                            <span>
                                            </span> الوصول الي منطقه الشبكات
                                        </li>
                                        <li class="facility-item" style="text-align: center;">
                                            <span>
                                            </span> الشاي والقهوه
                                        </li>
                                        <li class="facility-item" style="text-align: center;">
                                            <span>
                                            </span>غداء
                                        </li>
                                        <li class="facility-item" style="text-align: center;">
                                            <span>
                                            </span> واي فاي مجاني
                                        </li>
                                        <li class="facility-item" style="text-align: center;">
                                            <span>
                                            </span>تذكره يانصيب 3
                                        </li>
                                    </ul>
                                    <div class="get-ticket">
                                        <a href="#" style="text-align: center;">
                                            
                                                    <h4 style="color: white; background-color: #8042cd;padding: 15px;">$99</h4>
                                                   
                                                
                                        </a>
                                    </div>
                                </div>

                            </div>
                        </div>
                    </div>
                </div>

                <div class="register-button">
                            @if(!auth()->check() )
                                                <a href="{{route('frontend.auth.login')}}" style="margin-right: 40%;background: #4f198d637;color:white;border-radius:0px;margin-top: 5%;outline: thick double #4f198d637;"class="btn btn-primary btn-lg ">
                                                    @lang('labels.frontend.home.join_now_bottom')
                                                </a>
                                                    @endif
                            </div>
            </div>
        </div>
    </section>
    <!-- ===== Pricing Plan end here  ==== -->

    <!-- ===== Event Gift start here  ==== -->
    <section class="event-gift-section padding-tb padding-b"style="background: url({{asset('images/landing/7.jpg')}});background-size: cover;highte:1291px;background-color: #fdfaf1;">
        <div class="container">
            <div class="row flex-lg-row-reverse">
            <div class="col-lg-6 col-12">
                    <div class="image-part">
                        <img src="{{asset('images/landing/12.png')}}" alt="gift-img">
                    </div>
                </div>
                <div class="col-lg-6 col-12">
                    <div class="section-header">
                        <h2 style="    text-align: right;background-image: linear-gradient(90deg, #ffffff 0%, #ffffff 100%);">هدايا المناسبات</h2>
                        <p style="    text-align: right;">هدايانا المجانيه لك</p>
                    </div>
                    <div class="section-wrapper">
                        <div class="gift-content">
                            <p style="    text-align: right;font-weight: 400;font-size: 18px;">
                             هناك حقيقه مثبته منذ زمن طويل و هي ان المحتوي المقروء لصفحه ما سيلهي القارئ عن التركيز علي الشكل الخارجي  للنص او شكل
                             وضع الفقرات في الصفحه التي يقرأها 
        
                            </p>
                            <ul class="gift-list"style="    text-align: right;">
                                <li class="gift-item"style="    text-align: right;"><span style="font-weight: 900;font-size: 50px;">.
                                    </span> تي شرت حصري</li>
                                <li class="gift-item"style="    text-align: right;"><span style="font-weight: 900;font-size: 50px;">
                                   . </span> كيس رغوه</li>
                                <li class="gift-item"style="    text-align: right;"><span style="font-weight: 900;font-size: 50px;">
                                    .</span> قدح</li>
                                <li class="gift-item"style="    text-align: right;"><span style="font-weight: 900;font-size: 50px;">
                                   . </span> سله الهدايا</li>
                            </ul>
                            <div class="register-button">
                            @if(!auth()->check() )
                                                <a href="{{route('frontend.auth.login')}}" style="margin-right: 40%;background: #ffffff;color: #4f198d637;border-radius:0px;margin-top: 5%;"class="btn btn-primary btn-lg ">
                                                    @lang('labels.frontend.home.join_now_bottom')
                                                </a>
                                                    @endif
                            </div>
                        </div>
                    </div>
                </div>
                
            </div>
        </div>
    </section>
    <!-- ===== Event Gift end here  ==== -->

    <!-- ===== Event Gift end here  ==== -->

    <!-- ===== News Section Start here  ==== -->
    <section class="news-section padding-tb padding-b ">
        <div class="container">
            <div class="section-header">
                <h2>  اخبار حديثه</h2>
                <p>ابدا رحلتك الرائعه</p>
            </div>
            <div class="section-wrapper">
                <div class="row g-4 justify-content-center">
                    @foreach($blogs as $blog)
                    <div class="col-lg-4 col-sm-6 col-xs-12">
                        <div class="news-item">
                            <div class="news-inner">
                                <div class="news-thumb">
                                <img style="width: 370px;height:260px;" @if($blog->image != "" &&  file_exists('images/landing/'.$blog->image)) src="{{ asset('images/landing/'.$blog->image)}}" @else  src="{{asset('images/course-default.jpeg')}}"   @endif  alt="speaker" >
                                 
                                </div>
                                <div class="news-content">
                                    <h6><a href="#">
                                           {{$blog->title}}
                                        </a>
                                    </h6>
                                    <p><span><i class="fa fa-calendar" aria-hidden="true"></i>
                                        </span> {{$blog->created_at}}</p>
                                </div>
                            </div>
                        </div>
                    </div>
                    @endforeach
                </div>
            </div>
        </div>
    </section>
    <!-- ===== News Section end here  ==== -->
    <!-- <div class="map-section"> -->

    
    <div class="map-section">
        <div class="container-fluid">
            <div class="map-wrapper" >
                <!-- <iframe class="w-100"
                    src="https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d423283.43556693953!2d-118.69192993092697!3d34.0207304944894!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x80c2c75ddc27da13%3A0xe22fdf6f254608f4!2sLos%20Angeles%2C%20CA%2C%20USA!5e0!3m2!1sen!2sbd!4v1633767876287!5m2!1sen!2sbd"
                    allowfullscreen="" loading="lazy"style="width:100%"></iframe> -->
                    <iframe class="w-100" src="https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d927755.0519899436!2d46.262027123739045!3d24.72539808840737!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x3e2f03890d489399%3A0xba974d1c98e79fd5!2sRiyadh%20Saudi%20Arabia!5e0!3m2!1sen!2seg!4v1649665228006!5m2!1sen!2seg" 
                        allowfullscreen="" loading="lazy"style="width:100%">
                    </iframe>
            </div>
        </div>
    </div>
    
    <!-- </div> -->
    <!-- ===== Map  Section start here  ==== -->
        <!-- <div class="container-fluid">
            <div class="map-wrapper">
                <iframe class="w-100"
                    src="https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d423283.43556693953!2d-118.69192993092697!3d34.0207304944894!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x80c2c75ddc27da13%3A0xe22fdf6f254608f4!2sLos%20Angeles%2C%20CA%2C%20USA!5e0!3m2!1sen!2sbd!4v1633767876287!5m2!1sen!2sbd"
                    allowfullscreen="" loading="lazy"></iframe>
            </div>
        </div>
    </div> --> 
    <!-- ===== Map  Section end here  ==== -->


    <!-- ==== Newsletter  Section start here  ==== -->
</div>
   
<!-- ************end content******** -->
   
    @endsection

    @push('after-scripts')
    <!-- <script src="{{asset('assets-land/js/jquery.js')}}"></script> -->
    <script src="{{asset('assets-land/js/fontawesome.min.js')}}"></script>
    <script src="{{asset('assets-land/js/waypoints.min.js')}}"></script>
    <script src="{{asset('assets-land/js/bootstrap.bundle.min.js')}}"></script>
    <script src="{{asset('assets-land/js/swiper.min.js')}}"></script>
    <script src="{{asset('assets-land/js/circularProgressBar.min.js')}}"></script>
    <script src="{{asset('assets-land/js/isotope.pkgd.min.js')}}"></script>
    <script src="{{asset('assets-land/js/lightcase.js')}}"></script>
    <script src="{{asset('assets-land/js/functions.js')}}"></script>
    @endpush
    