@extends('frontend.layouts.app' . config('theme_layout'))

@section('title', $course->meta_title ? $course->meta_title : app_name())
@section('meta_description', $course->meta_description)
@section('meta_keywords', $course->meta_keywords)

@push('course_pixel_code')
    {!! $course ? $course->pixel_code : '' !!}
@endpush
@push('after-styles')
    <!-- ====Custom Stylesheet -->
    <link rel="stylesheet" href="{{ asset('iv/css/course_details.css') }}" />
    <link href="{{ asset('iv/assets/rating/css/star-rating.css') }}" media="all" rel="stylesheet" type="text/css" />
    <link href="{{ asset('iv/assets/rating/themes/krajee-svg/theme.css') }}" media="all" rel="stylesheet" type="text/css" />
    @push('after-styles')
        <style>
            /* start */

            .rowLocation {
                display: flex;
                flex-direction: row;
                justify-content: space-between;
                flex-wrap: wrap;
                align-items: center


            }

            .locationsAll {
                margin-bottom: 10px;
                border-radius: 30px;
                /* padding: 0 28px; */
                width: 100%;
                border-style: solid;
                border-width: 1px;
                background-color: white;
                color: gray;
                display: flex;
                justify-content: center;
                font-size: revert;
                align-content: space-around;
                border: 2px bold solid black;
                padding: 10px;
            }

            .loc-cont img {
                height: 30px;
                width: 30px
            }

            .date-section {
                display: flex;
                justify-content: center;
            }

            .date-section img {
                height: 30px;
                width: 30px;
                margin-left: 5px;
                margin-right: 5px;

            }

            .date-data p {
                font-size: 12px !important;
                width: max-content;


            }
            .course-single-text {
                clear: both !important;
                order: 0 !important;
            }

            .loc-cont span {
                font-size: 13px;
            }

            @media screen and (max-width: 768px) {
                .date-section img {
                    height: 20px;
                    width: 20px;
                    margin-top: 5px;
                    margin-left: 5px;
                    margin-right: 5px;
                }

                .joinbtn {
                    padding-top: 5px;
                }

                .date-data p {
                    font-size: 13px !important;
                    width: max-content;


                }

                .rowLocation {
                    flex-wrap: wrap;
                }

                .  {
                    width: 50% !important;
                }
            }

            .date-data {
                padding-top: 2px;
                width: max-content;
            }

            .date-data p {
                margin-bottom: 9px;
                line-height: 0px;
                width: max-content;

            }

            .btn-get-course {
                padding: 6px;
                width: 100%;
            }

            .icon:hover .rt-icon:before {
                content: '\25BA';
                position: absolute;
                opacity: 1;
                left: 5px;
            }

            .iconboxborder {
                position: absolute;
                background: #DB2B39;
                width: 70%;
                height: 3px;
                left: 0px;
                top: 20px;
                z-index: -1;
            }

            /* end */
            .leanth-course.go {
                right: 0;
            }
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
            height: 150px;
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
            display: flex;
            flex-direction: column;
            align-items: center;
            justify-content: space-around;
        }
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
    </style>
@endpush


@section('content')
    @php
    $mainCourse = $course;
    \Debugbar::enable();

    @endphp

    <section class="row the-slider" id="slider">
        <div style="background-size: cover;height:fit-content;padding-bottom: 20px;">
            <div class="container">
                <div class="row benefit-notes">
                    <!-- ===========course details part1============ -->
                    <!--==========course description right==========-->
                    <div class="col-md-5  benefit wow fadeInUp ptb-55 course-content ">
                        <h4>
                            {{-- <a class="color-primary text-color" href="{{route('courses.details',['course'=>$course->slug])}}"> --}}

                            <a class="color-primary text-color" href="#">
                                @if (session('locale') == 'ar')
                                    {{ $course->title_ar ?? $course->title }}
                                @else
                                    {{ $course->title ?? $course->title_ar }}
                                @endif
                            </a>
                        </h4>
                        <p style="text-align: justify">
                            @if (session('locale') == 'ar')
                                {!! $course->short_description_ar ?? $course->short_description !!}
                            @else
                                {!! $course->short_description ?? $course->short_description_ar !!}
                            @endif
                        </p>

                        <a href="{{ route('courses.all', ['type' => $course->type_id]) }}"
                            class="btn btn-primary btn-sm btn-gray  link-border col-lg-6">
                            @if (session('locale') == 'ar')
                                {{ $course->type->name_ar }}
                            @else
                                {{ $course->type->name }}
                            @endif
                        </a>
                        <a href="{{ route('courses.category', $course->category->slug) }}"
                            class="btn btn-primary btn-gray btn-sm  link-border col-lg-6">
                            @if (session('locale') == 'ar')
                                {{ @$course->category->name_ar }}
                            @else
                                {{ @$course->category->name }}
                            @endif
                        </a>

                    </div>
                    <!--/*==========course description right ==========-->

                    <!--==========course description left ==========-->

                    <div class="  col-md-7  benefit wow fadeInUp ptb-50 course-content mt-0" id="courseLocContent">
                        @if ($course->course_image != '')
                            {{-- <a class="color-primary text-color" href="{{route('courses.details',['course'=>$course->slug])}}"> --}}
                            <a class="color-primary text-color" href="#">

                                <img class="imgCourse" src="{{ asset('storage/uploads/' . $course->course_image) }}"
                                    style="width: 100%;object-fit: fill;
                            border-radius: 10px;
                            height: 307px;"
                                    alt="">
                            </a>
                        @else
                            {{-- <a class="color-primary text-color" href="{{route('courses.details',['course'=>$course->slug])}}"> --}}
                            <a class="color-primary text-color" href="#">

                                <img src="{{ asset('iv' . '/images/courses/1.jpg') }}"
                                    style="width: 100%;object-fit: cover;
                            border-radius: 10px;
                            height: 307px;"
                                    alt="">
                            </a>
                        @endif

                        {{-- <div class="mt-16" style="display: flex;justify-content: space-between;">
                            <div>


                                <div style="direction: ltr;display: block;width: 100%">
                                    <span class="rate-title" for=""> قيم الدورة</span>
                                    <input name="course_rate" id="kartik" class="rating rating-loading" data-stars="5"
                                        data-step="1" title="" data-rtl=1 />
                                </div>
                            </div>
                            <div class="prefer">
                                <span class="rate-title mr-3 " for="">
                                    @lang('labels.frontend.layouts.course.add_to_wishlist') </span>
                                <a href="">
                                    <img class="add-star" src="{{ asset('iv') }}/images/star.png" alt="">
                                    <i class="fa fa-plus plus-icon-star"></i>
                                </a>
                            </div>

                            <div class="clear"></div>
                        </div> --}}

                    </div>
                </div>
                <!-- =======course details part2 =================-->
                <div class="row benefit-notes">
                    <!--==========course description right==========-->
                    <div class="col-xs-10 col-md-5 mt-min-36  mb-36 benefit wow fadeInUp ptb-16 course-content d-grid ">


                        <ul class="course-det-list mt-18">
                            <li>
                                <i class="fa fa-clock-o"></i>
                                <span class="title text-color">@lang('labels.frontend.layouts.course.duration')</span>
                                {{-- <span> {{ @$course->chapters->sum('session_length')}} @lang('labels.frontend.layouts.course.hours') </span> --}}
                                <span>
                                    {{ @$course->courseDuration()['hours'] }}
                                    @if (in_array(@$course->courseDuration()['hours'], [3, 4, 5, 6, 7, 8, 9, 10]))
                                        @lang('labels.frontend.course.hours')
                                    @else
                                        @lang('labels.frontend.course.hour')
                                    @endif
                                    @if ($course->courseDuration()['minutes'] > 0)
                                        {{ @$course->courseDuration()['minutes'] }}
                                        @if (in_array(@$course->courseDuration()['minutes'], [3, 4, 5, 6, 7, 8, 9, 10]))
                                            @lang('labels.frontend.course.minutes')
                                        @else
                                            @lang('labels.frontend.course.minute')
                                        @endif

                                    @endif
                                </span>


                            </li>
                            <li>
                                @php
                                    
                                    $lessonOfFirstLocationNum = 0;
                                    $AlllessonOfFirstLocation=$course->LessonsByChapter(0,$last)[1];
                                    $lessonOfFirstLocationNum=count($AlllessonOfFirstLocation);
                                    // foreach ($course->courseTimeline as $item) {
                                    //     if ($item->model_type == 'App\Models\Lesson') {
                                    //         $lessonOfFirstLocation = $item->model
                                    //             ? $item->model
                                    //                 ->whereHas('courseLocations', function ($qq) use ($last) {
                                    //                     $qq->where('lesson_course_location.course_location_id', $last->id)->where('lesson_course_location.model_type', 'App\Models\Lesson');
                                    //                 })
                                    //                 ->get()
                                    //                 ->pluck('id')
                                    //                 ->toArray()
                                    //             : [];
                                    //         $lessonOfFirstLocationNum = count($lessonOfFirstLocation);
                                    //         break;
                                    //     }
                                    // }
                                    
                                @endphp
                                <i class="fa fa-book"></i>
                                <span class="title text-color"> @lang('labels.frontend.layouts.course.lectures') </span>

                                {{-- <span>{{ @$course->lessons()->count() }} @lang('labels.frontend.layouts.course.lectures') --}}
                                {{-- <span>{{ @$countLessons }} @lang('labels.frontend.layouts.course.lectures') --}}
                                <span>{{ @$lessonOfFirstLocationNum }} @lang('labels.frontend.layouts.course.lectures')


                                </span>

                            </li>
                            <li>
                                <i class="fa fa-line-chart"></i>
                                <span class="title text-color"> @lang('labels.frontend.layouts.course.level') </span>
                                <span>
                                    @if (session('locale') == 'ar')
                                        {{ @$course->level->name_ar ? @$course->level->name_ar : @$course->level->name }}
                                    @else
                                        {{ @$course->level->name }}
                                    @endif
                                </span>
                            </li>
                        </ul>
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
                                            src="{{ asset('iv') }}/icons/pdf-download.png" style="width: 10%"
                                            alt=""></i>
                                </a>
                            @endif
                        @endif
                    </div>
                    <!--/*==========course description right ==========-->

                    <!--==========course description left ==========-->

                    <div class="col-xs-10 col-md-7 mt-min-36 benefit wow fadeInUp ptb-16 course-content mt-0">
                        {{-- @if ($IsUserFilledData == false)
                        <div class="alert alert-danger">
                            <a href="{{ route('admin.account') }}"><i class="fa fa-edit"></i> @lang('validation.complete-data')</a>
                        </div>
                    @endif --}}

                        @if (count($courseLocations) > 0)
                            <div id='chooseMsg' class="zoom-in-zoom-out fadeInUp" style="display: none">
                                <h3>اختر مكان</h3>
                            </div>
                            @foreach ($courseLocations as $location)
                                @if ($location->end_date < \Carbon\Carbon::now() && $course->type_id != 1)
                                    <div></div>
                                @else
                                    <div class="clear" style="clear: both"></div>
                                    <div class="locationsAll" class="">
                                        <div class="container" style="width: 100%">
                                            <div class="row rowLocation">
                                                <div class="col-md-3   col-xs-6">
                                                    <div class="loc-cont">
                                                        <img src="{{ asset('iv') }}/icons/location.png" class="icon"
                                                            alt="">
                                                        <span
                                                            class="title text-color">{{ session('locale') == 'ar' ? $location->location->name_ar : $location->location->name }}
                                                        </span>
                                                    </div>

                                                </div>
                                                @if ($location->location->id != 2)
                                                    <div class="col-md-3   col-xs-6 "
                                                        style="    display: flex;
                                                flex-direction: column-reverse;
                                                justify-content: center;
                                            ">
                                                        <div class="date-section">

                                                            <img src="{{ asset('iv') }}/icons/calendar.png"
                                                                class="icon" alt="">
                                                            <div class="date-data">
                                                                <p class="title text-color">{{ $location->start_date }}</p>
                                                                @if ($location->end_date)
                                                                    <p class="title text-color">{{ $location->end_date }}</p>
                                                                @endif

                                                            </div>

                                                        </div>

                                                    </div>
                                                @endif
                                                <div class="col-md-3    col-xs-8">
                                                    <div class="loc-cont">
                                                        <img src="{{ asset('iv') }}/icons/price-tag.png"
                                                            class="icon icon-price" alt="">
                                                        <span class="title text-color"> {{ $location->price }}
                                                            @if ($location->currency == 'SAR')
                                                                {{ $appCurrency['symbol'] }}
                                                            @else
                                                                $
                                                            @endif
                                                        </span>
                                                    </div>

                                                </div>
                                                <div class="col-md-3   col-xs-12 joinbtn">

                                                    @include('frontend.courses.buy_button2')



                                                </div>
                                            </div>

                                        </div>
                                    </div>
                                @endif
                            @endforeach
                        @else
                            @lang('menus.backend.sidebar.courses.no_location')
                        @endif


                    </div>
                </div>


            </div>
        </div>
    </section>

    <!-- ===========More course Details -->
    <!--==========The Product==========-->
    <section class="row the-product details" id="product">
        <div class="container">
            <div class="row benefit-notes">

                <div class="  col-md-6  benefit wow fadeInUp  course-content mt-0"
                    style="text-align: justify;
                    padding-top: 50px;">
                  


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

                    <h3> @lang('labels.frontend.course.course_detail') </h3>
                    @if (session('locale') == 'ar')
                        {!! $course->description_ar ?? $course->description !!}
                    @else
                        {!! $course->description ?? $course->description_ar !!}
                    @endif
                    <h4 style="margin-top: 21px;">@lang('labels.frontend.course.teachers') </h4>


                    @foreach ($course->teachers()->where('course_location_id', $last->id)->get() as $key => $teacher)
                        <a href="{{ route('teachers.get-details', $teacher->id) }}"
                            class="btn btn-primary btn-xl btn-gray teacher link-border mt-10">
                            <i class="teacher-img-parent"><img class="teacher-img" src="{{ $teacher->picture }}"
                                    alt=""></i>

                            <span>
                                @if (session('locale') == 'ar')
                                    {{ $teacher->name_ar ?? $teacher->name }}
                                @else
                                    {{ $teacher->name ?? $teacher->name_ar }}
                                @endif
                            </span>
                            <i class="teacher-icon-download fa fa-download"></i>
                        </a>
                    @endforeach


                </div>
                <div class="  col-md-6  benefit wow fadeInUp ptb-50 course-content course-curriclum mt-0">
                    <div class="course-curriclum">
                        <h4>

                            @lang('labels.frontend.course.course-curr')
                        </h4>
                        <!--  -->

                        <div id="accordion" class="curriclum-content">
                            {{-- ->whereIn('id',$lastCourseLocationsChaptersIds) --}}

                            @foreach ($course->chapters()->whereIn('id', $lastCourseLocationsChaptersIds)->orderBy('sequence', 'asc')->get() as $key => $chapter)
                                <div class="card">
                                    <div class="card-header" id="headingOne">
                                        <h5 class="mb-0">
                                            <button
                                                class="btn btn-link white-normal btn-curr @if ($key != 0) collapsed @endif"
                                                data-toggle="collapse" data-target="#collapse-{{ $key }}"
                                                aria-controls="collapse-{{ $key }}">
                                                {{ session('locale') == 'ar' ? $chapter->title_ar : $chapter->title }} :
                                                {{ $chapter->session_length }}

                                                @if ($chapter->length_type == 'hour')
                                                    @if (in_array($chapter->session_length, [3, 4, 5, 6, 7, 8, 9, 10]))
                                                        @lang('labels.frontend.course.hours')
                                                    @else
                                                        @lang('labels.frontend.course.hour')
                                                    @endif
                                                @else
                                                    @if (in_array($chapter->session_length, [3, 4, 5, 6, 7, 8, 9, 10]))
                                                        @lang('labels.frontend.course.minutes')
                                                    @else
                                                        @lang('labels.frontend.course.minute')
                                                    @endif
                                                @endif
                                            </button>
                                        </h5>
                                    </div>

                                    <div id="collapse-{{ $key }}"
                                        class="@if ($key == 0) collapsed in @endif  collapse "
                                        aria-labelledby="headingOne" data-parent="#accordion">
                                        <div class="card-body">
                                            @php
                                            $lessonOfFirstLocation=$course->LessonsByChapter($chapter->id,$last)[0];
                                            $testsOfFirstLocation=$course->TestsByChapter($chapter->id,$last);
                                            $lessonOfFirstLocation->merge($testsOfFirstLocation);
                                       @endphp
                                            @foreach ($lessonOfFirstLocation as $item)
                                                @php
                                                    
                                               
                                                    $lessonsChapter = $chapter->lessons;
                                                    
                                                @endphp
                                               
                                                    <div class=" mb-7 d-flex">
                                                        <i class=" mb-14 "> <img class="w-24"
                                                                src="{{ asset('iv') }}/icons/document.png"
                                                                alt=""></i>
                                                        <p class="display-content">
                                                            {{ session('locale') == 'ar' ? $item->title_ar : $item->title }}
                                                        </p>
                                                    </div>
                                              
                                                
                                            @endforeach





                                        </div>
                                    </div>
                                </div>
                            @endforeach

                        </div>
                        <!--  -->

                    </div>
                </div>

            </div>

        </div>
    </section>
    <style>
        .row.collections{
            display: flex;
            justify-content: center;
            flex-wrap: wrap;


        }
    </style>
    <!--==========The Product==========-->
    <section class="row the-product course-related" id="product">
        <div class="container">
            <div class="row section-header wow fadeInUp">
                <h2>@lang('labels.frontend.layouts.course.related')</h2>

            </div>
            <div class="tab-content">

                <div role="tabpanel" class="tab-pane active" id="tab-1">
                    <div class="">

                        @if (count($student_featured_courses) > 0)
                            @foreach ($student_featured_courses as $course)
                                <div class="  col-md-4 item  fadeIn">
                                    @include('frontend.layouts.partials.course_box')
                                </div>
                            @endforeach
                        @else
                            <span style="text-align: center;">
                                @lang('labels.frontend.layouts.course.no-related')
                            </span>

                        @endif


                    </div>
                </div>

            </div>

        </div>
    </section>
    <!--========== /*The Product==========-->

    <!--  -->




@endsection
@section('course-footer')
    @include('frontend.courses.course-footer-new')

@endsection
@push('after-scripts')
    <!-- custom js -->
    <script src="{{ asset('iv/assets/rating/js/star-rating.js') }}"></script>

    <script>
        $(document).on('change', 'input[name="stars"]', function() {
            $('#rating').val($(this).val());

        })
        $(document).ready(function() {
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

@push('course-pixel_code_footer')
    <footer>
        {{ $course ? $course->pixel_code : '' }}
    </footer>
@endpush
