@extends('frontend.layouts.app'.config('theme_layout'))

@section('title', trans('labels.frontend.home.title') . ' | ' . app_name())
@section('meta_description', '')
@section('meta_keywords', '')


@push('after-styles')
    <style>
        .home-slider.owl-carousel .owl-item img {
            height: 196px;
        }
        .owl-carousel .owl-item img {
            height: 166px !important;
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
        .methodology-item div ul li {
            color: white;
        }

    </style>
@endpush

@section('content')


    {{-- @include('frontend.layouts.partials.slider') --}}

    {{-- direct courses --}}
    <div style="width:25%;position:fixed;z-index:10;right:15px;">
        @include('includes.partials.messages')
    </div>
    @if (count($live_courses) > 0)
        <section class="row the-product padding-b-13" id="features">
            <div class="container">
                <div class="row section-header wow fadeInUp">
                    <h2 style="padding: 14px;border-radius: 11px;" class="main-color main-color-border text-color">
                        @lang('labels.frontend.layouts.home.live-online')
                    </h2>
                </div>

                <div class="row benefit-notes">
                    <div class="row collections" style="display: flex;justify-content: center;flex-wrap:wrap">
                        <!--==========Collection Items==========-->


                        @foreach ($live_courses as $key => $course)
                            <!--==========Collection Items==========-->
                            @if (count($course->locations) > 0)
                                <div class="  col-md-4 item bg-white fadeIn">
                                    @include('frontend.layouts.partials.course_box')
                                </div>
                            @endif
                        @endforeach

                    </div>
                </div>
            </div>
            <div>


            </div>
        </section>
    @endif
    {{-- direct --}}

    {{-- online courses --}}
    @if (count($online_courses) > 0)

        <section class="row the-product padding-b-13" id="features">
            <div class="container">
                <div class="row section-header wow fadeInUp">
                    <h2 style="padding: 14px;
                    border-radius: 11px;" class="main-color  main-color-border">
                        @lang('labels.frontend.layouts.home.online-courses')
                    </h2>
                </div>

                <div class="row benefit-notes">
                    <div class="row collections">
                        <!--==========Collection Items==========-->



                        @foreach ($online_courses as $key => $course)
                            <!--==========Collection Items==========-->
                                <div class="  col-md-4 item bg-white fadeIn">
                                    @include('frontend.layouts.partials.course_box')
                                </div>
                        @endforeach

                    </div>
                </div>
            </div>
            <div>


            </div>
        </section>
    @endif

    {{-- Conference courses --}}
    @if (count($conference_courses) > 0)

        <section class="row the-product padding-b-13" id="features">
            <div class="container">
                <div class="row section-header wow fadeInUp">
                    <h2 style="padding: 14px;
                    border-radius: 11px;" class="main-color  main-color-border">
                        @lang('labels.frontend.layouts.home.classroom_courses')
                    </h2>
                </div>

                <div class="row benefit-notes">
                    <div class="row collections">
                        <!--==========Collection Items==========-->



                        @foreach ($conference_courses as $key => $course)
                            <!--==========Collection Items==========-->
                                <div class="  col-md-4 item bg-white fadeIn">
                                    @include('frontend.layouts.partials.course_box')
                                </div>
                        @endforeach

                    </div>
                </div>
            </div>
            <div>


            </div>
        </section>
    @endif
    {{--  --}}

    <!-- ==========How its Works==========
    <section class="row join-us">
        <div class="container">
            <div class="row  wow fadeInUp" style="    display: flex;
            justify-content: space-between;">

                <div class="col-sm-10 col-md-8" style="margin-top: 40px;margin-bottom: 40px">
                    {{-- @if (auth()->check()) --}}

                        @if ($freeCourseSlug)
                        
                            <div class="product-div">
                                <div class="row m0 featured-img">
                                    <img style="object-fit: cover; width:100%;height:200px"
                                        @if ($freeCourseSlug->course_image != '' && file_exists('storage/uploads/' . $freeCourseSlug->course_image)) src="{{ asset('storage/uploads/' . $freeCourseSlug->course_image) }}" @else  src="{{ asset('images/course-default.jpeg') }}" @endif
                                        alt="" />
                                 


                                </div>
                                <div style="background-color: white" class="inner-contain right-align">
                                    <a href="{{ route('courses.category', ['category' => $freeCourseSlug->category->slug]) }}">
                                        <h5 class="category" style="    text-align: center;
                                        color: #4f198d;
                                        ">
                                            @if (session('locale') == 'ar')
                                                {{ $freeCourseSlug->category->name_ar }}
                                            @else
                                                {{ $freeCourseSlug->category->name }}
                                            @endif
                                        </h5>
                                    </a>
                                    <a href="{{ route('courses.show', ['course' => $freeCourseSlug->slug]) }}">
                                        <h4 class="title text-color" style="    text-align: center;
                                        color: #4f198d;
                                        font-weight: bold;">
                                            @if (session('locale') == 'ar')
                                                {{ $freeCourseSlug->title_ar }}
                                            @else
                                                {{ $freeCourseSlug->title }}
                                            @endif
                                        </h4>
                                    </a>
                                    <p class="prod-det" style="color: black">
                                        @if (session('locale') == 'ar')
                                            {{ sub($freeCourseSlug->description_ar, 0, 120) }}
                                        @else
                                            {{ sub($freeCourseSlug->description, 0, 120) }}
                                        @endif
                                    </p>
                                    <a href="{{ route('courses.show', ['course' => $freeCourseSlug->slug]) }}"
                                        class=" btn btn-view fw100 mtb-10">@lang('labels.general.join')</a>
                                    <div class="row">
                                        <div class="  col-md-6 course-lectures">
                                            {{ $freeCourseSlug->lessons()->count() }}
                                            @lang('labels.frontend.layouts.home.lectures')
                                        </div>

                                        <div class="  col-md-6 course-price">
                                            {{ $freeCourseSlug->minPricelocation() }}
                                            @if ($freeCourseSlug->minPricelocationCurr() == 'SAR')
                                                {{ $freeCourseSlug->minPricelocationCurr() }}
                                            @else
                                                $
                                            @endif
                                        </div>
                                    </div>
                                </div>
                            </div>


                        @endif

                    {{-- @endif --}}

                    {{-- <a href="https://www.youtube.com/watch?v=dPL1-8ypnEs"
                        class="btn btn-primary btn-white btn-lg video">@lang('labels.frontend.home.join_now_bottom')</a> --}}
                </div>
            </div>
        </div>
    </section> -->

    <!-- @(1) -->
    {{-- ========================================= --}}


    <!--==========The types= in tabs=========-->

    <!--==========The types= in section=========-->
    <!-- @foreach ($course_types as $key => $course_type)
        @php
            $CoursesOfType = $course_type->PublishedAvailableCourses();
            
        @endphp
        @if (count($CoursesOfType) > 0)
            <section class="row the-benefits padding-b-13" id="features">
                <div class="container">
                    <div class="row section-header wow fadeInUp">
                        <h2 style="padding: 14px;
                    border-radius: 11px;" class="main-color main-color-border text-color">
                            @if ($course_type->name == 'Direct Training' || $course_type->id == 3)
                                @lang('labels.frontend.layouts.home.classroom_courses')
                            @else
                                {{ Lang::locale() == 'ar' ? $course_type->name_ar : $course_type->name }}
                            @endif
                        </h2>
                    </div>
                    {{-- <div class="row section-header desktop wow fadeInUp center">
                <span class="inline-block">
                    @foreach ($featured_categories as $category)
                    <a href="{{route('courses.category',['category'=>$category->slug])}}" class=" btn btn-default ">
                        @if (session('locale') == 'ar') {{ $category->name_ar }} @else {{$category->name}}  @endif
                    </a>
                    @endforeach
                </span>
            </div> --}}
                    <div class="row benefit-notes">
                        <div class="row collections">

                            {{-- @foreach ($home_featured_courses as $key => $course) --}}
                            @foreach ($CoursesOfType as $key => $course)
                                @if (count($course->locations) > 0)
                                    <div class="  col-md-4 item  fadeIn">
                                        @include('frontend.layouts.partials.course_box')
                                    </div>
                                @endif
                            @endforeach
                        </div>
                    </div>
                </div>
                <div style="text-align: center;">
                    <a style="width:unset" href="courses?type={{ $course_type->id }}"
                        class=" btn btn-view fw100 mtb-10">
                        @lang('labels.general.more')

                        <i class="fa fa-angle-left"></i>
                    </a>

                </div>
            </section>
        @endif
        {{-- <hr style="margin: 0px;border-top: 5px solid #932a2a;"> --}}
        {{-- ========================================= --}}
    @endforeach -->
    <!--==========The types= in section=========-->

    <!--==========Our Collection==========-->
    <!-- <section class="row our-collection padding-t-82">
        <div class="container">
            <div class="row section-header wow fadeInUp">
                <h2 class="main-color"> @lang('labels.general.ivory_services') </h2>
            </div>
            <div class="row collections services-collections">

                @foreach ($home_services as $key => $home_service)
                    
                    <div class="  col-md-3  fadeIn" style="margin-bottom: 20px">
                        <div class="services-box">
                            <div class="row m0 service-img">
                                <img src="{{ asset('storage/uploads/' . $home_service->home_service_image) }}" alt=""
                                    style="width:100px" />
                            </div>
                            <div class="inner-contain">
                                <h4 class="title text-color">
                                    @if (session('locale') == 'ar')
                                        {{ $home_service->title_ar }}
                                    @else
                                        {{ $home_service->title }}
                                    @endif
                                </h4>
                                <a href="{{ route('home_services.details', $home_service->id) }}"
                                    class="btn btn-view fw100 fw100 mtb-10">@lang('labels.general.more')</a>

                                {{-- <a href="#product-choose" class="btn btn-view fw100 fw100 mtb-10">@lang('labels.general.more')</a> --}}
                            </div>
                        </div>
                    </div>
                @endforeach

            </div>
        </div>
    </section> -->

    <!--==========Split Columns==========-->
    <section class="row split-columns red-bg">
        <div class="row m0 split-column wow fadeIn">
            <div class="  image text-right">
                <img style="height: 100%;" src="{{ asset('iv') }}/images/methodology.jpg" alt="" />
            </div>
            <div style="padding-bottom: 35px;" class="  texts">
                <div class="texts-inner row m0">
                    <h2 class="white-color">@lang('labels.frontend.layouts.home.methodology')</h2>
                    <p class="white-color med-font">
                        @lang('labels.frontend.layouts.home.methodology_more')
                    </p>
                </div>
                <div class="texts-inner row m0">
                    @foreach ($methodologies as $index => $methodology)
                        <div class="row methodology-item">
                            <div class="col-sm-2 image text-right">
                                <img src="{{ asset('storage/uploads/' . $methodology->image) }}"  alt="" />
                            </div>
                            <div class="col-sm-10 image text-right">
                                <div class="title white-color">@lang('labels.frontend.layouts.home.'.$methodology->type)</div>
                                <p class="white-color med-font">
                                    @if (session('locale') == 'ar')
                                        {!! $methodology->description_ar !!}
                                    @else
                                    {!! $methodology->description!!}
                                    @endif
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
                <div class="large-12 columns" style="text-align: -webkit-center;">
                    <div class="owl-carousel owl-theme">

                        @foreach ($featured_categories as $category)
                            @if($category->courses->count() > 0)
                            <div class="item">
                                <div class="category-box">
                                    <div class="row m0 category-img" style="font-size: 60px;color:#d6d6d6">
                                        <i class="{{ $category->icon }}"></i>
                                    </div>
                                    <div class="inner-contain">
                                        <a href="{{ route('courses.category', ['category' => $category->slug]) }}">
                                            <h4 class="title text-color">
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

    <!--==========locations==========-->
    <!-- <section class="row locations" id="locations"
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

                        @foreach ($locations as $location)
                            <div class="item">
                                <div class="location-box">
                                    <a href="/courses?location={{ $location->id }}">
                                        <img src="{{ asset('storage/uploads/' . $location->image) }}" class="img-fluid"
                                            alt="   " />
                                    </a>
                                    <a href="/courses?location={{ $location->id }}">
                                        <h3>
                                            @if (session('locale') == 'ar')
                                                {{ $location->name_ar }}
                                            @else
                                                {{ $location->name }}
                                            @endif
                                        </h3>
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
    </section> -->

    <!--==========our customer==========-->
    <!-- <section class="row partners" id="partners">
        <div class="container">
            <div class="row section-header wow fadeInUp">
                <h2 class="main-color">@lang('labels.frontend.layouts.home.clients')</h2>
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
    </section> -->

    <!--==========Reviews==========-->
    <section class="row clients" id="clients">
        <div class="container">
            <div class="row section-header wow fadeInUp">
                <h2 class="main-color">@lang('labels.frontend.layouts.home.partners')</h2>
            </div>
            <div class="row">
                <div class="large-12 columns">
                    <div class="home-clients owl-theme">
                        @foreach ($sponsors as $sponsor)
                            <div class="item">
                                <div class="client-box">
                                    <a href="#">
                                        <img style="height: 200px;object-fit: contain" src="{{ $sponsor->image }}"
                                            class="img-fluid" alt="{{ $sponsor->name }}" />
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
