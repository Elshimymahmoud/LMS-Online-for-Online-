@extends('frontend.layouts.app1new')

@section('title', trans('labels.frontend.home.title') . ' | ' . app_name())
@section('meta_description', '')
@section('meta_keywords', '')


@push('after-styles')
    <style>
        .navbar-right {
    margin-left: -6px;
}
        .home-slider.owl-carousel .owl-item img {
            height: 196px;
        }

        .home-slider.owl-carousel .owl-next .fa-angle-right {
            margin-left: 20px;
        }

        .home-slider.owl-carousel .owl-prev .fa-angle-left {
            margin-right: 20px;
        }

        .main-color {
            color: #4f198d;
        }

        .btn-revert-color {
            color: #4f198d;
            background-color: white;
        }

        .padding-b-13 {
            padding-bottom: 13px;
        }

        .padding-t-82 {
            padding-top: 82px;
        }
        .owl-theme .owl-nav [class*=owl-] {

            background-color: #eaefea00;
            margin-top: 6%;
        }
        .owl-themee .owl-nav [class*=owl-] {
    background-color: #4f198d;
    /* margin-top: 6%; */
}
        .owl-theme .owl-nav [class*=owl-]:hover {
    background: #86979100;
    color: #FFF;
    text-decoration: none;}
       /* .owl-prev {background-color: #eaefea00;color: white;margin-top: 6%;} */
       .thumbnail{
    position:relative;
    border:0px;
}

.price {
    color: #fff;
    font-size:20px;
    background: #4f198d;
    padding: 8px 8px 10px 8px;
    position: absolute;
    display: block;
    top:0px;
    left:0px;
    right:auto;
    margin-top: 8px;
    margin-left: 6px;
    /* -moz-transform: rotate(8deg);
    -webkit-transform: rotate(8deg);
    -ms-transform: rotate(8deg); */
    z-index:100;
    width: 36%;
    margin-left: 4px;
    height: 40px;
    text-align: left;
}
.hh{
    z-index:100;
    position: absolute;
    display: block;
    bottom: 0;
    /* text-align: center; */
    /* padding: 66px; */
    margin-left: 36%;
    color: white;
}
.service_h{
    z-index:100;
    position: absolute;
    display: block;
    bottom: 54px;
    left:0px;
    right:auto;
    /* text-align: center; */
    /* padding: 66px; */
    margin-left: 36%;
    color: #4f198d;
    -webkit-text-decoration-line: underline;
    text-decoration-line: underline;
}
.testimon-h{

    z-index:100;
    position: absolute;
    display: block;
    top: 0;
    /* left:0px; */
    right:auto;
    /* text-align: center; */
    /* padding: 66px; */
    margin-left: 36%;
    color: #4f198d;
    width: 39%;
    
}
.testimon-hr{

z-index:100;
position: absolute;
display: block;
top: 66px;
/* left:0px; */
right:auto;
/* text-align: center; */
/* padding: 66px; */
margin-left: 36%;
color: #4f198d;
width: 39%;
font-size: xx-large;
}
.testimon-hv{

z-index:100;
position: absolute;
display: block;
top: 0;
/* left:0px; */
right:auto;
/* text-align: center; */
/* padding: 66px; */
margin-left: 36%;
color: #4f198d;
width: 39%;

}
.owl-prev:hover{
    background-color:white;
}
.fa-angle-left:before {
    color:white;
}
.fa-angle-right:before {
    color:white;
}

@media only screen and (max-width: 768px) {
  /* For mobile phones: */
  h2,h3{
    font-size: 18px;
  }
  .xs-img-width{
    width: 143px !important;
    /* margin-top: -62px; */
    margin-top: -80px !important;
  }
  .btn-primary.btn-lg {
    padding: 0 12px;
    margin-right: 0px;
    font-size: smaller;
    
}
.anonce{
    margin-right: 50px;
}
.anonce-btn{
    margin-right: 50px;
}
.split-column .texts p {
    text-align: center;
}
.annonce-b{
    /* float: right; */
   
    margin-right: 29%;
}
.order{
    padding:0px 0px 0px 0px;
}
.bac{

    margin-top: 140px !important;
    margin-left: 128px;
}


}
@media only screen and (max-width: 768px) {
.bac {
    margin-top: 23px !important;
    margin-left: 128px;
}
}
.owl-theme .owl-nav [class*=owl-] {
    margin-top: 0% ;
}
    </style>
@endpush

@section('content')
 

   
    <!--==========How its Works==========-->
    <section class="row join-us" style="background-image: url('{{ asset('images/header.png')}}');background-repeat: no-repeat;height: 542px;width: 100%;background-size:100% 100%;background-size:contain">
        <div class="container">
            <div class="row  wow fadeInUp" style="    display: flex;
            justify-content: space-between;">

                <div class="col-sm-10 col-md-9 bac" style="margin-top: 139px;margin-bottom: 40px">
                   
<h2 style="color:#4f198d">@lang('labels.frontend.home.header_head1')</h2>
<h2  style="color:#4f198d">@lang('labels.frontend.home.header_head2')</h2>
<br>
                   <a href="https://www.youtube.com/watch?v=dPL1-8ypnEs"style="background-color: #742636;color: white;border-radius: 0px;margin-right: 15%"
                        class="btn btn-primary btn-white btn-lg video">@lang('labels.frontend.home.join_now_bottom')</a> 
                </div>
            </div>
        </div>
    </section>

    
    {{-- ========================================= --}}


    <!--==========The types= in tabs=========-->

    
    <!--==========The types= in section=========-->
   <!-- ******************* live courses-->
   <div class="row section-header wow fadeInUp" style="    margin-top: 50px;">
                  <button style="background-color: #4f198d;border: 4px solid #4f198d;border-radius: 13px;padding: 8px 24px;">
                           <h2 class="main-color" style="color:white;margin:0 0 0px"> @lang('labels.general.live_courses') </h2>

                     </button>
            </div>
   <section class="row categories-sec" id="categories-sec" style="background-color:#4f198d">
        <div class="container">
            <div class="row section-header wow fadeInUp">
            
            </div>
            <div class="row">
                <div class="large-12 columns">
                @if(session('locale') == 'ar')
                    <div class="owl-carousel owl-theme "   >
                    @else
                    <div class="owl-carousel owl-theme "  >

                    @endif
                    @foreach ($live_courses as $key => $course)
                            <!--==========Collection Items==========-->
                            @if (count($course->locations) > 0)
                            <div class="item">
                            @include('frontend.layouts.partials.coursebox2')
                               
                            </div>
                            @endif
                        @endforeach



                    </div>

                    <script>
                        $(document).ready(function() {
                            var owl = $(".owl-carousel");
                            owl.owlCarousel({
                                margin: 10,
                                nav: true,
                                loop: true,
                                dots: false,
                                navText: [
                                    '<i class="fa fa-angle-left " aria-hidden="true"></i>',
                                    '<i class="fa fa-angle-right " aria-hidden="true"></i>'
                                ],
                                responsive: {
                                    0: {
                                        items: 1
                                    },
                                    600: {
                                        items: 3
                                    },
                                    1000: {
                                        items: 3
                                    }
                                }
                            });
                        });
                    </script>
                </div>
            </div>
        </div>
    </section>
<!-- ************************* course pricing-->
  
<section class="row split-columns "style="margin-top: -5px;">
        <div class="row m0 split-column wow fadeIn" style="margin-top:16px;" >
        <div class="col-xs-4  image text-right "style="padding: 0px 0px 0px 0px">
            <img src="{{ asset('images/66.jpg') }}" class="img-fluid xs-img-width"
                                            alt="   " style="float: left;
                                            height: 437px;
                                            width: 303px;
                                            object-fit: contain;
                                           " />
                   
            </div>
        <div class="col-sm-8 texts col-xs-7 " >
             <div class="row m0 split-column wow fadeIn" >
                   <h3 class="" style="color:#4f198d;">    وضع الموازنات الفعاله ورقابه التكاليف</h3>
            </div>
            <div class="row m0 split-column wow fadeIn" >
                    <div class="col-sm-5 image text-right "style="padding: 0px 0px 0px 0px">
                        <img src="{{ asset('images/55.jpg') }}" class="img-fluid anonce"
                                                    alt="   " style="float: left;border-radius: 10px;width:100%;highte:229px;border: 8px solid #4f198d;" />
                                                    <br><br><br><br>
                                                    <button clacss="annonce-b"style="    margin-top: 21px;
                                                    background-color: #4f198d;
                                                    border: 0px solid #4f198d;
                                                    /* padding: 8px 24px; */
                                                    /* float: left; */
                                                    border-radius: 10px;
                                                    margin-right: 23%;">
                                                    
                                                        <h4 clacss="anonce_b"style="color: white;">انضم واغتنم الفرصه</h4>
                                                        </button>
                    </div>
                    <div class="col-sm-5 image text-right "style="padding: 0px 0px 0px 0px">

                                <p style="color:black;margin-right:14px;"> نبذه عن البرنامج تتعرض الحكومات في الدول العربيه لكثير من الضغوطات المستمرهمن اجل اجراء مراجعات  لسياستيها الماليه

                                </p>
                                
                                <br>
                                <button clacss="annonce-b" style="background-color: #4f198d;border: 0px solid #4f198d;padding: 8px 24px;">
                                <h4 style="color: white;">150.000RS</h4>
                                    </button>
                                    
                                    <h5 clacss="annonce-b"style="color: #4f198d;margin-right:14px;"> <i class="fa fa-calendar"></i> اخر ميعاد للحجز يوم 22 مارس</h5>
                            
                    </div>
             </div>
           
         </div>
     </div>
    </section>
       <!-- ******************* online courses -->
   <section class="row categories-sec" id="categories-sec" style="background-color:#f3ecee">
        <div class="container">
            <div class="row section-header wow fadeInUp">
                     <button style="background-color: #4f198d;border: 4px solid #4f198d;border-radius: 13px;padding: 8px 24px;">
                           <h2 class="main-color" style="color:white;margin:0 0 0px"> @lang('labels.general.online_courses') </h2>

                     </button>
            </div>
            <div class="row" >
                <div class="large-12 columns">
                @if(session('locale') == 'ar')
                    <div class="owl-carousel owl-theme "  style="direction: rtl;" >
                    @else
                    <div class="owl-carousel owl-theme "  >

                    @endif

                    @foreach ($online_courses as $key => $course)
                            <!--==========Collection Items==========-->
                            @if (count($course->locations) > 0)
                            <div class="item">
                            @include('frontend.layouts.partials.coursebox3')
                               
                            </div>
                            @endif
                        @endforeach



                    </div>

                    <script>
                        $(document).ready(function() {
                            var owl = $(".owl-carousel");
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
                                        items: 1
                                    },
                                    600: {
                                        items: 3
                                    },
                                    1000: {
                                        items: 3
                                    }
                                }
                            });
                        });
                    </script>
                </div>
            </div>
        </div>
    </section>
    <!-- ******************* face to face courses-->
    <div class="row section-header wow fadeInUp" style="    margin-top: 50px;">
     
                     <button style="background-color: #4f198d;border: 4px solid #4f198d;border-radius: 13px;padding: 8px 24px;">
                           <h2 class="main-color" style="color:white;margin:0 0 0px"> @lang('labels.general.facetoface_courses') </h2>

                     </button>
            </div>
   <section class="row categories-sec" id="categories-sec" style="background-color:#4f198d">
        <div class="container">
            
            <div class="row">
                <div class="large-12 columns">
                @if(session('locale') == 'ar')
                    <div class="owl-carousel owl-theme "   >
                    @else
                    <div class="owl-carousel owl-theme "  >

                    @endif

                       
                      
                    @foreach ($conference_courses as $key => $course)
                            <!--==========Collection Items==========-->
                            @if (count($course->locations) > 0)
                            <div class="item">
                            @include('frontend.layouts.partials.coursebox2')
                               
                            </div>
                            @endif
                        @endforeach

                    </div>

                    <script>
                        $(document).ready(function() {
                            var owl = $(".owl-carousel");
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
                                        items: 1
                                    },
                                    600: {
                                        items: 3
                                    },
                                    1000: {
                                        items: 3
                                    }
                                }
                            });
                        });
                    </script>
                </div>
            </div>
        </div>
    </section>

    <!--==========Our Collection==========-->
    <section class="row our-collection padding-t-82">
        <div class="container">
            <div class="row section-header wow fadeInUp">
              
                     <button style="background-color: white;border: 4px solid #4f198d;border-radius: 13px;padding: 8px 24px;">
                           <h2 class="main-color" style="color:#4f198d;margin:0 0 0px"> @lang('labels.general.ivory_services') </h2>

                     </button>
            </div>
            <div class="row collections services-collections">

                @foreach ($home_services as $key => $home_service)
                    <!--==========Collection Items==========-->
                    <div class="col-xs-6 col-md-3  fadeIn" style="margin-bottom: 20px">
                        <div class="services-box thumbnail" style="background-color: #931d1d61;height: 426px;border-radius: 0px;margin:0 -1px;"> 
                            <div class="row m0 service-img" style="height: 100%;">
                                
                            <h4 class="service_h">
                           
                                    @if (session('locale') == 'ar')
                                        {{ $home_service->title_ar }}
                                    @else
                                        {{ $home_service->title }}
                                    @endif
                                   
                                </h4>
                                <!-- <hr class="service_h"> -->
                   
                            <a href="{{ route('home_services.details', $home_service->id) }}">

                                <img src="{{ asset('storage/uploads/' . $home_service->home_service_image) }}" alt=""
                                    style="width:100%;height: 100%;margin-top: -30px;" />
                             </a>
                                      
                            </div>

                            
                        </div>
                    </div>
                @endforeach

            </div>
        </div>
    </section>
 <!--==========Reviews====== topics====-->
 <section class="row categories-sec" id="categories-sec">
        <div class="container">
            <div class=" section-header wow fadeInUp">
                
                     <button style="background-color: white;border: 4px solid #4f198d;border-radius: 13px;padding: 8px 24px;">
                           <h2 class="main-color" style="color:#4f198d;margin:0 0 0px"> @lang('labels.frontend.layouts.home.topics')</h2>

                     </button>
            </div>
            <div class="row">
                <div class="large-12 columns">
                    <div class="owl-carousell owl-themee">

                        @foreach ($featured_categories as $category)
                            <div class="item">
                                <div class="category-box" style="border:0px">
                                    <div class="row m0 category-img" style="font-size: 60px;color:#d6d6d6 ">
                                        <i class="{{ $category->icon }}" style="color: #4f198d;"></i>
                                    </div>
                                    <div class="inner-contain">
                                        <a href="{{ route('courses.category', ['category' => $category->slug]) }}">
                                            <h4 class="title text-color" style="color: #4f198d;">
                                                @if (session('locale') == 'ar')
                                                    {{ $category->name_ar }}
                                                @else
                                                    {{ $category->name }}
                                                @endif
                                            </h4>
                                        </a>
                                    </div>
                                </div>
                            </div>
                        @endforeach



                    </div>

                    <script>
                        $(document).ready(function() {
                            var owl = $(".owl-carousell");
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
                                        items: 1
                                    },
                                    600: {
                                        items: 3
                                    },
                                    1000: {
                                        items: 5
                                    }
                                }
                            });
                        });
                    </script>
                </div>
            </div>
        </div>
    </section>

    <!--==========Split Columns===== =====-->
    
    <section class="row our-collection padding-t-82" style="background-color:#f3ecee;">
        <div class="container">
            <div class="row section-header wow fadeInUp">
                
                     <button style="background-color: white;border: 4px solid #4f198d;border-radius: 13px;padding: 8px 24px;">
                           <h2 class="main-color" style="color:#4f198d;margin:0 0 0px">@lang('labels.frontend.layouts.home.methodology')</h2>

                     </button>
            </div>
            <div class="row collections services-collections">

            @foreach ($methodologies as $index => $methodology)

                    <!--==========Collection Items==========-->
                    <div class="col-xs-6 col-md-3  fadeIn" style="margin-bottom: 20px">
                        <div class="services-box thumbnail" style="background-color: #4f198d;height: 426px;border-radius: 0px;margin:0 -1px;"> 
                            <div class="row m0 service-img" style="height: 80%">
                                
                            
                   
                            <a href="{{ route('home_services.details', $home_service->id) }}">

                                <img src="{{ asset('storage/uploads/' . $methodology->image) }}" alt=""
                                    style="width:100%;height: 100%;margin-top: -30px;" />
                             </a>
                                      
                            </div>
                            <h4 class="" style="color:white">
                           
                           @lang('labels.frontend.layouts.home.'.$methodology->type)
                               </h4>
                            
                        </div>
                    </div>
                @endforeach

            </div>
        </div>
    </section>

    
    <!--==========Reviews==========-->
    <section class="row locations" id="locations"
        style="direction: ltr;max-width: 100%;overflow: hidden;background-color:#4f198d;    padding: 60px;">
        <div class="container">
            <div class="row section-header wow fadeInUp">
                <h2 style="color:white;">
                    @lang('labels.frontend.layouts.home.locations')
                </h2>
            </div>
            <div class="row">
                <div class="large-12 columns">
                    <div class="home-locations owl-theme">

                        @foreach ($locations as $location)
                            <div class="item">
                                <div class="location-box thumbnail" style="border:1px solid white;border-radius: 6px;width: 250px;height: 250px;">
                                <h3 class="hh">
                                            @if (session('locale') == 'ar')
                                                {{ $location->name_ar }}
                                            @else
                                                {{ $location->name }}
                                            @endif
                                        </h3>
                                    <a href="/courses?location={{ $location->id }}">
                                        <img src="{{ asset('storage/uploads/' . $location->image) }}" class="img-fluid"
                                            alt="   " style="border-radius: 10px;highte:100%" />
                                    
                                        </a>
                                    
                                </div>
                            </div>
                        @endforeach

                    </div>

                    <script>
                        $(document).ready(function() {
                            var owl = $(".home-locations");
                            owl.owlCarousel({
                                margin: 5,
                                nav: true,
                                loop: true,
                                dots: false,
                                navText: [
                                    '<i class="fa fa-angle-left" aria-hidden="true"></i>',
                                    '<i class="fa fa-angle-right" aria-hidden="true"></i>'
                                ],
                                responsive: {
                                    0: {
                                        items: 1
                                    },
                                    600: {
                                        items: 3
                                    },
                                    1000: {
                                        items: 4
                                    }
                                }
                            });
                        });
                    </script>
                </div>
            </div>
        </div>
    </section>
    <!-- *************************tistimonintial -->
  
    <section class="row split-columns "style="margin-top: 146px;">
        <div class="row m0 split-column wow fadeIn">
        <div class="col-sm-6 texts thumbnail" style="@if (session('locale') == 'ar')padding: 0px 87px 0px 0px; @else padding: 0px 0px 0px 87px; @endif">
            
            <h2 class="testimon-h" style="font-weight:400"> @lang('labels.frontend.layouts.home.testimonial')</h2>
            <h2 class="testimon-hr">____________</h2>
            <img src="{{ asset('images/Group 76.jpg') }}" class="img-fluid"
                                            alt="   " style="border-radius: 10px;highte:100%" />
                  

                </div>
            <div class="col-sm-6 image text-right thumbnail"style="@if (session('locale') == 'ar')padding: 0px 0px 0px 87px @else padding: 0px 87px 0px 0px @endif">
            <h2 class="" style="margin-right: 42%;margin-bottom: 0;color:#4f198d;"> @lang('labels.frontend.layouts.home.video_tour')</h2>
            <img src="{{ asset('images/Group 78.jpg') }}" class="img-fluid"
                                            alt="   " style="border-radius: 10px;highte:100%" />
                   
            </div>
           
            </div>
        </div>
    </section>
    <!-- *************************order course -->
  
    <section class="row split-columns "style="margin-top: -69px;
    position: relative;">
        <div class="row m0 split-column wow fadeIn" style="background-color: #f3ecee;">
        <div class="col-sm-8 texts order" style="@if (session('locale') == 'ar') padding: 0px 320px 0px 0px @else padding: 0px 0px 0px 320px ;  @endif ">
            
            <h2 class="" style="color:#4f198d;">اطلب دوره مخصصه لفريقك الان</h2>
                 <p> الان يمكنك طلب دوره مخصصه لفريقك بالمهام المطلوبه
 والتي تعمل علي انجاز الاعمال والمشروعات لدي شركتك


                </p>
                <br>
                <br>
                <button style="background-color: #4f198d;border: 0px solid #4f198d;border-radius: 13px;padding: 8px 24px;">
                <h4 style="color: white;"> انضم الان</h4>
                     </button>
                     <br>
                <br>     
                </div>
            <div class="col-sm-4 image text-right "style="padding: 0px 0px 0px 0px">
            <div style="width:250px;highte:250px">
            <img src="{{ asset('images/77.jpg') }}" class="img-fluid"
                                            alt="   " style="border-radius: 10px;width:250px;margin-top: 35px;" />
                   
            </div></div>
            
           
            </div>
        </div>
    </section>
    <!--==========Reviews==========-->
    <section class="row partners" id="partners">
        <div class="container">
            <div class="row section-header wow fadeInUp">
                
                     <button style="background-color: white;border: 4px solid #4f198d;border-radius: 13px;padding: 8px 24px;">
                           <h2 class="main-color" style="color:#4f198d;margin:0 0 0px">@lang('labels.frontend.layouts.home.clients')</h2>

                     </button>
            </div>
            <div class="row">
                <div class="large-12 columns">
                    <div class="home-partners owl-theme">

                        @foreach ($clients as $client)
                            <div class="item">
                                <div class="partner-box">
                                    <a href="#">
                                        <img src="{{ $client->image }}" class="img-fluid" alt="   " />
                                    </a>
                                </div>
                            </div>
                        @endforeach


                    </div>

                    <script>
                        $(document).ready(function() {
                            var owl = $(".home-partners");
                            owl.owlCarousel({
                                margin: 10,
                                nav: false,
                                loop: true,
                                dots: true,
                                responsive: {
                                    0: {
                                        items: 1
                                    },
                                    600: {
                                        items: 3
                                    },
                                    1000: {
                                        items: 5
                                    }
                                }
                            });
                        });
                    </script>
                </div>
            </div>
        </div>
    </section>

    <!--==========Reviews==========-->
    <section class="row clients" id="clients">
        <div class="container">
            <div class="row section-header wow fadeInUp">
               
                     <button style="background-color: white;border: 4px solid #4f198d;border-radius: 13px;padding: 8px 24px;">
                           <h2 class="main-color" style="color:#4f198d;margin:0 0 0px">@lang('labels.frontend.layouts.home.partners')</h2>

                     </button>
            </div>
            <div class="row">
                <div class="large-12 columns">
                    <div class="home-clients owl-theme">
                        @foreach ($sponsors as $sponsor)
                            <div class="item">
                                <div class="client-box">
                                    <a href="#">

                                        <img style="height: 200px;object-fit: contain" src="{{ $sponsor->image }}"
                                            class="img-fluid" alt="   " />
                                    </a>
                                </div>
                            </div>
                        @endforeach
                    </div>

                    <script>
                        $(document).ready(function() {
                            var owl = $(".home-clients");
                            owl.owlCarousel({
                                margin: 10,
                                nav: false,
                                loop: true,
                                dots: true,
                                responsive: {
                                    0: {
                                        items: 1
                                    },
                                    600: {
                                        items: 3
                                    },
                                    1000: {
                                        items: 5
                                    }
                                }
                            });
                        });
                    </script>
                </div>
            </div>
        </div>
    </section>


@endsection

@push('after-scripts')
@endpush
