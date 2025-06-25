
@extends('frontend.layouts.app'.config('theme_layout'))

@section('title', trans('labels.frontend.home.title').' | '.app_name())
@section('meta_description', '')
@section('meta_keywords','')


@push('after-styles')
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
        .collections{
    display: flex;
    justify-content: center;
    flex-wrap: wrap
    

}
    </style>
@endpush

@section('content')


    @include('frontend.layouts.partials.slider')
    <!--==========The Product==========-->
    <section class="row the-product" id="product">
        <div class="container">
            <div class="row section-header wow fadeInUp">
                <h2 class="main-color"> @lang('labels.frontend.layouts.partials.courses_categories') </h2>
                <p>@lang('labels.frontend.layouts.partials.browse_course_by_category')</p>
            </div>

            <div class="nav-center m-b-40">
                <!-- Nav tabs -->
                <ul class="nav nav-pills" role="tablist" id="schedule-tabs">
                    <li role="presentation" class="active">
                        <a href="#tab-1" aria-controls="tab-1" role="tab" data-toggle="tab">@lang('labels.frontend.layouts.home.live-online')</a>
                    </li>
                    <li role="presentation">
                        <a href="#tab-2" aria-controls="tab-2" role="tab" data-toggle="tab">@lang('labels.frontend.layouts.home.online-courses')</a>
                    </li>
                </ul>
            </div>
            <div class="tab-content">
                <div role="tabpanel" class="tab-pane active" id="tab-1">
                    <div class="row collections">
                       @if(count($live_courses)>0)
                        @foreach($live_courses as $key => $course)   
                            <!--==========Collection Items==========-->
                        @if(count($course->locations)>0)

                            <div class="  col-md-4 item  fadeIn">
                                @include('frontend.layouts.partials.course_box')
                            </div>
                            @endif
                        @endforeach        
                       @else
                       <div style="text-align: center">
                       @lang('labels.frontend.layouts.home.no-live-courses')

                       </div>
                      @endif
                    </div>
                </div>
                <!-- end .tabpanel -->
                <div role="tabpanel" class="tab-pane" id="tab-2">
                    <div class="row collections">
                        @if(count($online_courses)>0)
                     
                        @foreach($online_courses as $key => $course)   
                            <!--==========Collection Items==========-->
                    @if(count($course->locations)>0)

                            <div class="  col-md-4 item  fadeIn">
                                @include('frontend.layouts.partials.course_box')
                            </div>
                            @endif
                        @endforeach   
                        @else
                        <div style="text-align: center">

                       @lang('labels.frontend.layouts.home.no-online-courses')

                        </div>

                        @endif
                    </div>
                </div>
                <!-- end .tabpanel -->
            </div>
            <!-- end .tab-content -->
        </div>
    </section>

    <!--==========How its Works==========-->
    <section class="row join-us">
        <div class="container">
            <div class="row  wow fadeInUp">
                <div class="  col-md-3 join-us-mt-30">
                    <img src="{{ asset('iv') }}/images/join.png" alt="" />
                </div>
                <div class="  col-md-6 join-us-mt80">
                    <p>@lang('labels.frontend.home.join_now')</p>
                    <h2>@lang('labels.frontend.home.join_now_desc')</h2>
                </div>
                <div class="  col-md-3 join-us-mt100">
                    @if(!auth()->check() )
                    <a href="{{route('frontend.auth.login')}}" class="btn btn-primary btn-md btn-revert-color ">
                        @lang('labels.frontend.home.join_now2_bottom')</a>
                       
                         
                       @else
                       @if($freeCourseSlug)
                       <a href="{{route('courses.show',['course'=>$freeCourseSlug])}}" class="btn btn-primary btn-md btn-revert-color ">
                           @lang('labels.frontend.home.join_now2_bottom')</a>
                   @endif
                       
                        @endif
                   
                    {{-- <a href="https://www.youtube.com/watch?v=dPL1-8ypnEs"
                        class="btn btn-primary btn-white btn-lg video">@lang('labels.frontend.home.join_now_bottom')</a> --}}
                </div>
            </div>
        </div>
    </section>

    <!--==========The Benefits==========-->
   {{-- conference courses --}}
    {{-- <section class="row the-benefits padding-b-13" id="features">
        <div class="container">
            <div class="row section-header wow fadeInUp">
                <h2 class="main-color" >@lang('labels.frontend.layouts.home.classroom_courses')</h2>
            </div>
       
            <div class="row benefit-notes">
                <div class="row collections">
              
                    @foreach($conference_courses as $key => $course) 

                         
                    @if(count($course->locations)>0)

                        <div class="  col-md-4 item  fadeIn">
                            @include('frontend.layouts.partials.course_box')
                        </div>
                        @endif
                    @endforeach    
                </div>
            </div>
        </div>
    </section> --}}
   {{-- conference courses --}}

    {{-- ========================================= --}}
            
  <!--==========The types in tabs==========-->
  {{-- <section class="row the-product" id="product">
    <div class="container">
        <div class="row section-header wow fadeInUp">
            <h2 class="main-color"> @lang('labels.frontend.layouts.partials.courses_categories') </h2>
            <p>@lang('labels.frontend.layouts.partials.browse_course_by_category')</p>
        </div>

        <div class="nav-center m-b-40">
            <!-- Nav tabs -->
            <ul class="nav nav-pills" role="tablist" id="schedule-tabs2">
                @foreach ($course_types as $key=>$course_type)
                <li role="presentation" class="{{$key==0?'active':''}}">
                    <a style="border-radius: 37px !important;" href="#tab-{{$course_type->id}}-dynamic" aria-controls="tab-{{$course_type->id}}-dynamic" role="tab" data-toggle="tab">{{Lang::locale()=='ar'?$course_type->name_ar:$course_type->name}}</a>
                </li>
                @endforeach
               
            </ul>
        </div>
        <div class="tab-content">
            @foreach ($course_types as $key=>$course_type)
            <div role="tabpanel" class="tab-pane {{$key==0?'active':''}}" id="tab-{{$course_type->id}}-dynamic">
                <div class="row collections">
                    @php
                        $CoursesOfType=$course_type->PublishedAvailableCourses();
                    @endphp
                  
                   @if(count($CoursesOfType)>0)
                    @foreach($CoursesOfType as $key => $course)   
                        <!--==========Collection Items==========-->
                    @if(count($course->locations)>0)

                        <div class="  col-md-4 item  fadeIn">
                            @include('frontend.layouts.partials.course_box')
                        </div>
                        @endif
                    @endforeach        
                   @else
                   <div style="text-align: center">
                   @lang('labels.frontend.layouts.home.no-live-courses')

                   </div>
                  @endif
                </div>
            </div>
            @endforeach
            <!-- end .tabpanel -->
           
            <!-- end .tabpanel -->
        </div>
        <!-- end .tab-content -->
    </div>
</section> --}}
 <!--==========The types= in tabs=========-->

 <!--==========The types= in section=========-->
 @foreach ($course_types as $key=>$course_type)

    @php
    $CoursesOfType=$course_type->PublishedAvailableCourses();

    @endphp
@if(count($CoursesOfType)>0)
    <section class="row the-benefits padding-b-13" id="features">
        <div class="container">
            <div class="row section-header wow fadeInUp">
                <h2 style="border: 2px solid #4f198d;
                padding: 14px;
                border-radius: 11px;" class="main-color" >
                    @if($course_type->name=='Direct Training'||$course_type->id==3)@lang('labels.frontend.layouts.home.classroom_courses')
                   
                    @else
                    {{Lang::locale()=='ar'?$course_type->name_ar:$course_type->name}}
                    @endif
                </h2>
            </div>
            {{-- <div class="row section-header desktop wow fadeInUp center">
                <span class="inline-block">
                    @foreach($featured_categories as $category)
                    <a href="{{route('courses.category',['category'=>$category->slug])}}" class=" btn btn-default ">
                        @if(session('locale') == 'ar') {{ $category->name_ar }} @else {{$category->name}}  @endif
                    </a>
                    @endforeach
                </span>
            </div> --}}
            <div class="row benefit-notes">
                <div class="row collections">
                    <!--==========Collection Items==========-->

                    {{-- @foreach($home_featured_courses as $key => $course)  --}}
                    @foreach($CoursesOfType as $key => $course) 

                         
                    @if(count($course->locations)>0)

                        <div class="  col-md-4 item  fadeIn">
                            @include('frontend.layouts.partials.course_box')
                        </div>
                        @endif
                    @endforeach    
                </div>
            </div>
        </div>
        <div>
            <a style="margin-right: 48%;width:unset" href="courses?type={{$course_type->id}}" class=" btn btn-view fw100 mtb-10">
                @lang('labels.general.more')
               
                <i class="fa fa-angle-left"></i>
            </a>

        </div>
    </section>
   @endif
    {{-- <hr style="margin: 0px;border-top: 5px solid #932a2a;"> --}}
    {{-- ========================================= --}}
@endforeach
 <!--==========The types= in section=========-->

    <!--==========Our Collection==========-->
    <section class="row our-collection padding-t-82">
        <div class="container">
            <div class="row section-header wow fadeInUp">
                <h2 class="main-color">  @lang('labels.general.ivory_services') </h2>
            </div>
            <div class="row collections services-collections">
                
                @foreach($home_services as $key => $home_service) 
                <!--==========Collection Items==========-->
                <div class="  col-md-3  fadeIn" style="margin-bottom: 20px">
                    <div class="services-box">
                        <div class="row m0 service-img">
                            <img  src="{{asset('storage/uploads/'.$home_service->home_service_image)}}" alt="" style="width:100px" />
                        </div>
                        <div class="inner-contain">
                            <h4 class="title text-color"> @if(session('locale') == 'ar')  {{$home_service->title_ar}} @else {{$home_service->title}} @endif</h4>
                            <a href="{{route('home_services.details',$home_service->id)}}" class="btn btn-view fw100 fw100 mtb-10">@lang('labels.general.more')</a>
                           
                            {{-- <a href="#product-choose" class="btn btn-view fw100 fw100 mtb-10">@lang('labels.general.more')</a> --}}
                        </div>
                    </div>
                </div> 
                @endforeach 
                
            </div>
        </div>
    </section>

    <!--==========Split Columns==========-->
    <section class="row split-columns red-bg">
        <div class="row m0 split-column wow fadeIn">
            <div class="  image text-right">
                <img src="{{ asset('iv') }}/images/methodology.jpg" alt="" />
            </div>
            <div class="  texts">
                <div class="texts-inner row m0">
                    <h2 class="white-color">@lang('labels.frontend.layouts.home.methodology')</h2>
                    <p class="white-color med-font">
                        @lang('labels.frontend.layouts.home.methodology_more')
                    </p>
                </div>
                <div class="texts-inner row m0">
                    @foreach($methodologies as $index=>$methodology)
                    <div class="row methodology-item">
                        <div class="col-sm-2 image text-right">
                            <img src="{{asset('storage/uploads/'.$methodology->image)}}" alt="" />
                        </div>
                        <div class="col-sm-10 image text-right">
                            <div class="title text-color">@lang('labels.frontend.layouts.home.'.$methodology->type)</div>
                            <p class="white-color med-font">
                                @if(session('locale') == 'ar')  {{$methodology->title_ar}} @else {{$methodology->title}} @endif
                            </p>
                        </div>
                    </div>
                    @endforeach
                   
                </div>
            </div>
        </div>
    </section>

    <!--==========Reviews==========-->
    <section class="row categories-sec" id="categories-sec">
        <div class="container">
            <div class="row section-header wow fadeInUp">
                <h2>@lang('labels.frontend.layouts.home.topics')</h2>
                <p>@lang('labels.frontend.layouts.home.topics_more')</p>
            </div>
            <div class="row">
                <div class="large-12 columns">
                    <div class="owl-carousel owl-theme">
                       
                        @foreach($featured_categories as $category)
                        <div class="item">
                            <div class="category-box">
                                <div class="row m0 category-img" style="font-size: 60px;color:#d6d6d6 ">
                                    <i class="{{ $category->icon }}"></i>
                                </div>
                                <div class="inner-contain">
                                    <a href="{{route('courses.category',['category'=>$category->slug])}}" >
                                        <h4 class="title text-color">  @if(session('locale') == 'ar') {{ $category->name_ar }} @else {{$category->name}}  @endif  </h4>
                                    </a>
                                </div>
                            </div>
                        </div>
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
    <section class="row locations" id="locations"
        style="direction: ltr;max-width: 100%;overflow: hidden;background: url({{ asset('iv') }}/locations/map.svg);background-size: contain;background-repeat: no-repeat;background-position: center;padding: 100px;background-color: #f0f0f0;">
        <div class="container">
            <div class="row section-header wow fadeInUp">
                <h2> 
                    @lang('labels.frontend.layouts.home.locations')
                </h2>
            </div>
            <div class="row">
                <div class="large-12 columns">
                    <div class="home-locations owl-theme">
                       
                        @foreach($locations as $location)
                        <div class="item">
                            <div class="location-box">
                                <a href="/courses?location={{$location->id}}">
                                    <img src="{{asset('storage/uploads/'.$location->image)}}" class="img-fluid" alt="   " />
                                </a>
                                <a href="/courses?location={{$location->id}}">
                                    <h3>@if(session('locale') == 'ar') {{ $location->name_ar }} @else {{$location->name}}  @endif</h3>
                                </a>
                            </div>
                        </div>
                        @endforeach
                        
                    </div>

                    <script>
                        $(document).ready(function() {
                            var owl = $(".home-locations");
                            owl.owlCarousel({
                                margin: 10,
                                nav: true,
                                loop: true,
                                dots: true,
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

    <!--==========Reviews==========-->
    <section class="row partners" id="partners">
        <div class="container">
            <div class="row section-header wow fadeInUp">
                <h2 class="main-color">@lang('labels.frontend.layouts.home.clients')</h2>
            </div>
            <div class="row">
                <div class="large-12 columns">
                    <div class="home-partners owl-theme">
                       
                        @foreach($clients as $client)
                        
                            <div class="item">
                                <div class="partner-box">
                                    <a href="#">
                                        <img src="{{ $client->image}}" class="img-fluid" alt="   " />
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
                <h2 class="main-color">@lang('labels.frontend.layouts.home.partners')</h2>
            </div>
            <div class="row">
                <div class="large-12 columns">
                    <div class="home-clients owl-theme">
                        @foreach($sponsors as $sponsor)
                     
                        <div class="item">
                            <div class="client-box">
                                <a href="#">

                                    <img style="height: 200px;object-fit: contain" src="{{ $sponsor->image}}" class="img-fluid" alt="   " />
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
    