@extends('frontend.layouts.app'.config('theme_layout'))

@php
    //if group is null get it from request
    if(!isset($group)){
        $group = \App\Models\CourseGroup::find(request()->group);
        $groups =[];
    }
@endphp
@section('title', $course->meta_title ? $course->meta_title : app_name())
@section('meta_description', $course->meta_description)
@section('meta_keywords', $course->meta_keywords)

@push('after-styles')
    <!-- ====Custom Stylesheet -->
    <link rel="stylesheet" href="{{ asset('iv/css/course_details.css') }}" />
    <link href="{{ asset('iv/assets/rating/css/star-rating.css') }}" media="all" rel="stylesheet" type="text/css" />
    <link href="{{ asset('iv/css/event.css') }}" media="all" rel="stylesheet" type="text/css" />
    <link href="{{ asset('iv/assets/rating/themes/krajee-svg/theme.css') }}" media="all" rel="stylesheet"
        type="text/css" />
    <link href="{{ asset('iv/assets/count/flipdown.css') }}" media="all" rel="stylesheet" type="text/css" />
    @push('after-styles')
        <style>
            .leanth-course.go {
                right: 0;
            }

            .timeline {
                direction: ltr;
            }

            .timeline::before {
                background: #4f198d;
            }

            .slider-overlay {
                height: 100%;
                background: rgba(0, 0, 0, 0.5);
            }

            .guest {
                border-radius: 10px;

                border: 1px #641225 solid;
                width: 23.5%;
                margin-right: 1%;
            }
            @media (max-width: 991px) {
                .guest {
                    width: 94%;
                    margin: 3%;
                }
            }
            .guest img {
                margin-top: 20px;
            }

            .guest a h3 {
                /* border-bottom: 1px solid; */
                padding: 6px;
            }

            /*  */

            /*  */

        </style>
        <link rel="stylesheet" href="https://cdn.plyr.io/3.5.3/plyr.css" />
    @endpush

    @if (session('locale') == 'en')
        <style>
            .course-location .title {
                margin-right: 11;
                float: right;
            }

            .course-location-container div {
                width: 24%
            }

            .the-product.details .course-content .course-curriclum .btn-curr {
                text-align: left
            }

        </style>
    @else
        <style>
            /* .course-location-container div{
                                    width: 20%
                                }
                                .location-name{
                                           width: 40% !important;
                                       } */

        </style>
    @endif
    <style>
        .white-normal {
            white-space: normal;
            line-height: normal;
        }

    </style>
    <style>
        .floatCourseFooter {
            position: fixed;
            width: 100%;
            height: 100px;
            bottom: 0px;
            /* right: 40px; */
            background-color: #4f198d;
            ;
            color: #ffffff;
            /* border-radius: 50px; */
            text-align: center;
            font-size: 30px;
            box-shadow: 2px 2px 3px #999;
            z-index: 100;
        }

        .toggleCourseFooter {
            display: block
        }

        .zoom-in-zoom-out {
            margin: 24px;
            width: 110px;
            /* height: 50px; */

            animation: zoom-in-zoom-out 2s ease-out infinite;
        }

        .course-teachers .item.col-lg-2 {
            display: inline-block;
            float: none;
        }

        @keyframes zoom-in-zoom-out {
            0% {
                transform: scale(1, 1);
            }

            50% {
                transform: scale(1.5, 1.5);
            }

            100% {
                transform: scale(1, 1);
            }
        }

        @media (max-device-width: 360px),
        (max-device-width: 375px),
        (max-device-width: 540px),
        (max-device-width: 600px),
        (max-device-width: 612px),

        (max-device-width: 411px),

            {
            .course-content .course-location-container {
                flex-wrap: wrap;
            }

            .course-location-2 {
                display: none;

            }

            .course-location-1 {

                width: 39% !important;
            }

            .anchor-course a {
                margin-top: 9px !important;
            }

            .left-get {
                margin-top: 15px !important;
            }

            .course-location-3 {

                width: 53% !important;
            }

            .imgCourse {
                width: 89% !important;
            }

            .course-location-4 {

                width: 50% !important;
            }
        }

        @media (max-device-width: 285px),
        (max-device-width: 300px) {
            .course-content .course-location-container {
                flex-wrap: wrap;
            }

            .course-location-2 {
                display: none;

            }

            .course-location-1 {

                width: 100% !important;
            }

            .anchor-course a {
                margin-top: 9px !important;
            }

            .left-get {
                margin-top: 15px !important;
            }

            .course-location-3 {

                width: 100% !important;
            }

            .imgCourse {
                width: 89% !important;
            }

            .course-location-4 {

                width: 100% !important;
            }
        }

    </style>
@endpush


@section('content')
@php
   $mainCourse=$course; 
@endphp
    @php $start_time=time(); @endphp
    <!--==========Reviews==========-->
   
    <a href="{{ route('courses.details', ['course' => $course->slug, 'group' => $group->id]) }}"><img
            style="width: 100%"
            src="@if ($course->course_image != '' && file_exists('storage/uploads/' . $course->course_image)) {{ asset('storage/uploads/' . $course->course_image) }}@else{{ asset('slider-bg.jpg') }} @endif"
            alt=""></a>
    <section class="row ltr  the-slider" id="slider"
        style="display: none; @if ($course->course_image != '' && file_exists('storage/uploads/' . $course->course_image)) background: url({{ asset('storage/uploads/' . $course->course_image) }});@else background: url({{ asset('slider-bg.jpg') }}); @endif background-size: cover;height:500px;background-color: #fdfaf1;">
        <div class="row slider-overlay">
            <div class="large-12 columns">
                <div class="home-slider owl-theme">

                    <div>
                        <div>
                            <div class="container">
                                <div class="row benefit-notes rtl">
                                    <!--==========Single Benefit==========-->
                                    <div class="col-sm-6 col-md-12 benefit wow fadeInUp ptb-50 slider-content">

                                        <h1 style="text-align: center">
                                            <a style="color: #ffffff" href="#">
                                                @if (session('locale') == 'ar')
                                                {{ $course->title_ar ?? $course->title }} @else
                                                    {{ $course->title ?? $course->title_ar }}
                                                @endif
                                            </a>
                                        </h1>
                                        <p style="color: #ffffff;text-align: center">
                                            @if (session('locale') == 'ar')
                                                {!! $course->short_description_ar ?? $course->short_description !!}
                                            @else
                                                {!! $course->short_description ?? $course->short_description_ar !!}
                                            @endif
                                        </p>
                                        @if ($group)
                                           
                                                @php $start_time=strtotime($group->start); @endphp

                                                <h3 style="color: #ffffff;text-align: center">
                                                    {{ $group->start }}
                                                    @if ($group->end)
                                                        - {{ $group->end }}
                                                    @endif
                                                </h3>
                                                <h2 style="color: #ffffff;text-align: center">
                                                    {{ session('locale') == 'ar' ? $group->name_ar : $group->name }}
                                                </h2>
                                            
                                        @endif
                                        <div style="text-align: center">
                                            @include('frontend.courses.buy_button2')
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>



                    <div>
                        <div>
                            <div class="container">
                                <div class="row benefit-notes rtl">
                                    <!--==========Single Benefit==========-->
                                    <div class="col-sm-6 col-md-12 benefit wow fadeInUp ptb-50 slider-content"
                                        style="margin-top:80px;text-align: center;color: #ffffff;font-size: 24px;list-style: none;line-height: 60px">

                                        <div>
                                            <i class="fa fa-clock-o"></i>
                                            <span
                                                class="title text-color">@lang('labels.frontend.layouts.course.duration')</span>
                                            <span> {{ @$course->chapters->sum('session_length') }}
                                                @lang('labels.frontend.layouts.course.hours') </span>
                                        </div>
                                        <div>
                                            <i class="fa fa-book"></i>
                                            <span class="title text-color"> @lang('labels.frontend.layouts.course.lectures')
                                            </span>
                                            {{-- <span>{{count($lessons)}}  @lang('labels.frontend.layouts.course.lectures') </span> --}}
                                            <span>{{ @$course->lessons()->count() }}
                                                @lang('labels.frontend.layouts.course.lectures')
                                            </span>
                                        </div>
                                        <div>
                                            <i class="fa fa-line-chart"></i>
                                            <span class="title text-color"> @lang('labels.frontend.layouts.course.level')
                                            </span>
                                            <span>
                                                @if (session('locale') == 'ar')
                                                    {{ @$course->level->name_ar ? @$course->level->name_ar : @$course->level->name }}
                                                @else {{ @$course->level->name }}
                                                @endif
                                            </span>
                                        </div>


                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>





                </div>

            </div>
        </div>
    </section>

    @if (time() < $start_time)
        <section class="row locations" id="locations" style="direction: ltr;max-width: 100%;overflow: hidden;padding:0">
            <div class="container">
                <div class="row section-header wow fadeInUp">
                    <h2 style="margin-top: 30px">متبقي من الزمن</h2>

                    @include('frontend.courses.count')

                </div>
            </div>
        </section>
    @endif


    <section class="row split-columns red-bg" style="padding-bottom: 50px">
        <div class="row m0 split-column wow fadeIn">

            <div class="col-sm-12 texts">
                <div class="texts-inner row m0">
                    <h2 class="white-color"> @lang('labels.frontend.home.teachers') </h2>

                </div>
                <div class="texts-inner row m0" style="width: 100%;">
                    <div class="row">
                        @foreach ($group->teachers as $key => $teacher)
                        
                            <div class="col-lg-6">
                                <div class=" methodology-item" style="min-height: 200px;">
                                    <div class="col-sm-12 col-md-2 image text-right" style="padding: 10px">
                                       
                                        <img src="{{ $teacher->picture ? resize($teacher->avatar_location, 150, 150) : 'avatar.png' }}"
                                            class="img-fluid" alt="" style="width: 100%;border-radius: 50%;" />
                                    </div>
                                    
                                    <div class="col-sm-12 col-md-10 image text-right" style="padding: 10px">
                                        <div class="title text-color">
                                           
                                            @if (session('locale') == 'ar')
                                                {{ $teacher->name_ar ?? $teacher->name }}
                                            @else
                                                {{ $teacher->name ?? $teacher->name_ar }}
                                            @endif
                                        
                                        </div>
                                        <p class="white-color med-font">
                                            @if (session('locale') == 'ar')
                                                {{ sub($teacher->teacherProfile->description_ar ?? $teacher->teacherProfile->description, 0, 350) }}
                                            @else
                                                {{ sub($teacher->teacherProfile->description ?? $teacher->teacherProfile->description_ar, 0, 350) }}
                                            @endif
                                        </p>
                                    </div>
                                </div>
                            </div>
                        @endforeach
                        
                    </div>
                </div>
            </div>
        </div>
    </section>

 {{-- GUEST --}}
    <!--==========Reviews==========-->
    <section class="row locations" id="locations" style="direction: ltr;max-width: 100%;overflow: hidden;padding: 100px 0">
        <div class="container">
            <div class="row section-header wow fadeInUp">
                <h2>
                    @lang('labels.backend.guest.title')
                </h2>
            </div>
            <div class="row">
                <div class="large-12 columns">
                    <div class="course-teachers" style="text-align: center">

                        @foreach ($course->guests as $key => $guest)
                            <div class="item col-lg-2 guest">
                                <a>
                                    <img src="{{ resize('uploads/'.$guest->image,450,450) }}"
                                        class="img-fluid" alt=""
                                        style="width: 100%;border-radius: 50%;" />
                                </a>

                                <a class="color-primary text-color">
                                    <h3>
                                        @if (session('locale') == 'ar')
                                            {{ $guest->name_ar ?? $guest->name }}
                                        @else
                                            {{ $guest->name ?? $guest->name_ar }}
                                        @endif
                                    </h3>
                                </a>
                                <hr>
                                <p style="height: 55px">
                                    @if (session('locale') == 'ar')
                                        {{ $guest->job_ar ?? $guest->job }}
                                    @else
                                        {{ $guest->job ?? $guest->job_ar }}
                                    @endif
                                </p>
                            </div>
                        @endforeach


                    </div>
                </div>
            </div>
    </section>
    
    
    {{-- end guest --}}

    <!--==========The Product==========-->
    <section class="row details" style="overflow: hidden" id="product">
        <div class="container">
            <div class="row benefit-notes">

                <div class="col-sm-12 col-md-12  benefit wow fadeInUp  course-content mt-0" style="text-align: justify;
                                                padding-top: 50px;">
                    @if (session('locale') == 'ar')
                        {!! $course->description_ar ?? $course->description !!}
                    @else
                        {!! $course->description ?? $course->description_ar !!}
                    @endif






                </div>
                <div class="col-sm-12 col-md-12  benefit wow fadeInUp course-content course-curriclum mt-0">

                    @if ($course->mediaVideo && $course->mediavideo->count() > 0)
                        <div class="course-single-text">
                            @if ($course->mediavideo != '')
                                <div class="course-details-content mt-3">
                                    <div class="video-container mb-5" data-id="{{ $course->mediavideo->id }}">
                                        @if ($course->mediavideo->type == 'youtube')
                                            <div id="player" class="js-player" data-plyr-provider="youtube"
                                                data-plyr-embed-id="{{ $course->mediavideo->file_name }}"></div>
                                        @elseif($course->mediavideo->type == 'vimeo')
                                            <div id="player" class="js-player" data-plyr-provider="vimeo"
                                                data-plyr-embed-id="{{ $course->mediavideo->file_name }}"></div>
                                        @elseif($course->mediavideo->type == 'upload')
                                            <video poster="" id="player" class="js-player" playsinline controls>
                                                <source src="{{ $course->mediavideo->url }}" type="video/mp4" />
                                            </video>
                                        @elseif($course->mediavideo->type == 'embed')
                                            {!! $course->mediavideo->url !!}
                                        @endif
                                    </div>
                                </div>
                            @endif
                        </div>
                    @endif





                </div>

            </div>

        </div>
    </section>



    <!--==========The Product==========-->
    <section class="row the-product details" id="product">
        <div class="container">
            <div class="row benefit-notes">


                <div class="col-sm-12 col-md-12  benefit wow fadeInUp ptb-50 course-content course-curriclum mt-0"
                    style="text-align: center">




                    @if ($pdf)
                        @if (auth()->check())
                            <a target="_blank" href="{{ asset('storage/uploads/' . $pdf->name . '') }}"
                                class="btn btn-primary btn-xl btn-gray link-border">
                                <span>
                                    @if (session('locale') == 'ar')
                                        {{ $course->pdf_title_ar ?? __('labels.frontend.course.brochure') }}
                                    @else
                                        {{ $course->pdf_title ?? __('labels.frontend.course.brochure') }}
                                    @endif
                                </span>
                                <i class="pdf-icon-parent"><img class="pdf-icon"
                                        src="{{ asset('iv') }}/icons/pdf-download.png" alt=""></i>
                            </a>
                        @else
                            <a href="/login" style="width: auto" class="btn btn-primary btn-xl btn-gray link-border">
                                <span>
                                    @lang('labels.frontend.course.pdf_warning')
                                </span>
                                <i class="pdf-icon-parent" style="margin-right:0"><img class="pdf-icon"
                                        src="{{ asset('iv') }}/icons/pdf-download.png" style="width: 10%" alt=""></i>
                            </a>
                        @endif
                    @endif


                </div>

            </div>

        </div>
    </section>




    @include('frontend.courses.course-footer-new')

    @if (sizeof($banners) > 0)
        <!--==========Split Columns==========-->
        <section class="row split-columns red-bg">
            <div class="row m0 split-column wow fadeIn">
                <div class="col-sm-6 image text-right">
                    <img src="{{ asset('iv') }}/images/methodology.jpg" alt="" />
                </div>
                <div class="col-sm-6 texts">
                    <div class="texts-inner row m0">
                        <h2 class="white-color">@lang('labels.frontend.layouts.home.goals')</h2>
                    </div>
                    <div class="texts-inner row m0">
                        @foreach ($banners as $index => $banner)
                            <div class="row methodology-item">
                                <div class="col-sm-12 image text-right" style="padding: 10px">
                                    <div class="title text-color">
                                        @if (session('locale') == 'ar')
                                        {{ $banner->name_ar }} @else {{ $banner->name }}
                                        @endif
                                    </div>
                                    <p class="white-color med-font">
                                        @if (session('locale') == 'ar')
                                        {{ $banner->content_ar }} @else {{ $banner->content }}
                                        @endif
                                    </p>
                                </div>
                            </div>
                        @endforeach
                    </div>
                </div>
            </div>
        </section>
    @endif

    @if (sizeof($testimonials) > 0)
        @include('frontend.layouts.course_testimonial')
    @endif
    @if($course->timeline or $course->timeline_ar)
        @if (session('locale') == 'ar')
            {!! $course->timeline_ar ?? $course->timeline !!}
        @else
            {!! $course->timeline_ar ?? $course->timeline_ar !!}
        @endif
    @else
    <section class="schedule" id="schedule"
        style=";background: url({{ asset('iv') }}/locations/map.svg);background-size: contain;background-repeat: no-repeat;background-position: center;padding: 100px 0;background-color: #f0f0f0;">

        <div class="container">
            <div class="section-title wow fadeInUp center">
                <h4>@lang('labels.frontend.course.course-curr')</h4>
            </div>

            
            <div class="timeline">
                @foreach ($course->chapters()->orderBy('sequence', 'asc')->get()  as $key => $chapter)
                    @foreach ($course->courseTimeline as $item)
                        @if (@$item->model->chapter_id == $chapter->id)
                            <div class="timeline-block">
                                <div class="timeline-bullet wow zoomIn" data-wow-delay="0s">

                                </div>
                                <!-- timeline-bullet -->

                                <div class="timeline-content">
                                    <h2 class="wow flipInX" data-wow-delay="0.3s">
                                        {{ session('locale') == 'ar' ? $item->model->title_ar : $item->model->title }}
                                    </h2>
                                    <span class="date wow flipInX"
                                        data-wow-delay="0.3s">{{ session('locale') == 'ar' ? $chapter->title_ar : $chapter->title }}</span>
                                </div>
                                <!-- timeline-content -->
                            </div>
                            <!-- timeline-block -->
                        @endif
                    @endforeach
                @endforeach
            </div>

        </div>
        <!-- end .container -->

    </section>
    <!-- end section.schedule -->
    @endif


    <!-- ===========More course Details -->
    <!--==========The Product==========-->
    <section class="row the-product details " id="product" style="display: none">
        <div class="container">
            <div class="row benefit-notes">

                <div class="col-sm-6 col-md-6  benefit wow fadeInUp  course-content mt-0" style="text-align: justify;
                                        padding-top: 50px;">
                    <h3> @lang('labels.frontend.course.course_detail') </h3>
                    @if (session('locale') == 'ar')
                        {!! $course->description_ar ?? $course->description !!}
                    @else
                        {!! $course->description ?? $course->description_ar !!}
                    @endif






                </div>
                <div class="col-sm-6 col-md-6  benefit wow fadeInUp ptb-50 course-content course-curriclum mt-0">

                    @if ($course->mediaVideo && $course->mediavideo->count() > 0)
                        <div class="course-single-text">
                            @if ($course->mediavideo != '')
                                <div class="course-details-content mt-3">
                                    <div class="video-container mb-5" data-id="{{ $course->mediavideo->id }}">
                                        @if ($course->mediavideo->type == 'youtube')
                                            <div id="player" class="js-player" data-plyr-provider="youtube"
                                                data-plyr-embed-id="{{ $course->mediavideo->file_name }}"></div>
                                        @elseif($course->mediavideo->type == 'vimeo')
                                            <div id="player" class="js-player" data-plyr-provider="vimeo"
                                                data-plyr-embed-id="{{ $course->mediavideo->file_name }}"></div>
                                        @elseif($course->mediavideo->type == 'upload')
                                            <video poster="" id="player" class="js-player" playsinline controls>
                                                <source src="{{ $course->mediavideo->url }}" type="video/mp4" />
                                            </video>
                                        @elseif($course->mediavideo->type == 'embed')
                                            {!! $course->mediavideo->url !!}
                                        @endif
                                    </div>
                                </div>
                            @endif
                        </div>
                    @endif


                    @if ($pdf)
                        @if (auth()->check())
                            <a target="_blank" href="{{ asset('storage/uploads/' . $pdf->name . '') }}"
                                class="btn btn-primary btn-xl btn-gray link-border mt-10-per">
                                <span>
                                    @if (session('locale') == 'ar')
                                        {{ $course->pdf_title_ar ?? __('labels.frontend.course.brochure') }}
                                    @else
                                        {{ $course->pdf_title ?? __('labels.frontend.course.brochure') }}
                                    @endif
                                </span>
                                <i class="pdf-icon-parent"><img class="pdf-icon"
                                        src="{{ asset('iv') }}/icons/pdf-download.png" alt=""></i>
                            </a>
                        @else
                            <a href="/login" style="width: auto"
                                class="btn btn-primary btn-xl btn-gray link-border mt-10-per">
                                <span>
                                    @lang('labels.frontend.course.pdf_warning')
                                </span>
                                <i class="pdf-icon-parent" style="margin-right:0"><img class="pdf-icon"
                                        src="{{ asset('iv') }}/icons/pdf-download.png" style="width: 10%" alt=""></i>
                            </a>
                        @endif
                    @endif


                </div>

            </div>

        </div>
    </section>

   
@endsection
@push('after-scripts')

    <!-- custom js -->
    <script src="{{ asset('iv/assets/rating/js/star-rating.js') }}"></script>
    <script src="{{ asset('iv/assets/count/flipdown.js') }}"></script>

    <script>
        $(document).on('change', 'input[name="stars"]', function() {
            $('#rating').val($(this).val());

        })
        $(document).ready(function() {
            $('.btn-get-course').addClass('btn-sm');
            $('.caption').css({
                'display': 'none'
            })
        })
    </script>


    <script>
        $(document).on('change', 'input[name="stars"]', function() {
            $('#rating').val($(this).val());
        })
        @if (isset($review))
            var rating = "{{ $review->rating }}";
            $('input[value="' + rating + '"]').prop("checked", true);
            $('#rating').val(rating);
        @endif

        $('#rating').rating("{{ $AllRateResult }}");
        $(window).scroll(function() {
            var bodyTop = $('html').scrollTop();
            if (bodyTop >= 30) {
                $('.count').each(function() {
                    $(this).prop('Counter', 0).animate({
                        Counter: $(this).data('value')
                    }, {
                        duration: 2000,
                        easing: 'swing',
                        step: function(now) {
                            $(this).text(Math.ceil(now));
                        }
                    });
                });
            }
            if (bodyTop > 320) {
                $('.get-course').addClass('active')
                $('.get-course').addClass('active2')

            } else {
                $('.get-course').removeClass('active')
                $('.get-course').removeClass('active2')

            }
            console.log(bodyTop)
        });
    </script>
    <script>
        $(window).scroll(function() {
            var bodyTop = $('html').scrollTop();
            if (bodyTop >= 200) {
                // $('.count').each(function () {
                //     $(this).prop('Counter',0).animate({
                //         Counter: $(this).data('value')
                //     }, {
                //         duration: 2000,
                //         easing: 'swing',
                //         step: function (now) {
                //             $(this).text(Math.ceil(now));
                //         }
                //     });
                // });
            }
            if (bodyTop > 320) {
                // $('.get-course').addClass('active')
                // $('.get-course').addClass('active2')

                $('.get-course').show(1000)


            } else {
                $('.get-course').hide(1000)


                // $('.get-course').removeClass('active')
                // $('.get-course').removeClass('active2')

            }
            console.log(bodyTop)
        });
    </script>
    <script src="https://cdn.plyr.io/3.5.3/plyr.polyfilled.js"></script>

    <script>
        const player = new Plyr('#player');

        $(document).on('change', 'input[name="stars"]', function() {
            $('#rating').val($(this).val());
        })
        @if (isset($review))
            var rating = "{{ $review->rating }}";
            $('input[value="' + rating + '"]').prop("checked", true);
            $('#rating').val(rating);
        @endif
    </script>
@endpush
