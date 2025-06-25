@extends('frontend.layouts.app'.config('theme_layout'))

@section('title', $course->meta_title ? $course->meta_title : app_name())
@section('meta_description', $course->meta_description)
@section('meta_keywords', $course->meta_keywords)

@push('course_pixel_code')
    {!! $course ? $course->pixel_code : '' !!}
@endpush
@push('after-styles')
    <!-- ====Custom Stylesheet -->
    <link rel="stylesheet" href="{{ asset('iv/css/course_details.css') }}"/>
    <link href="{{ asset('iv/assets/rating/css/star-rating.css') }}" media="all" rel="stylesheet" type="text/css"/>
    <link href="{{ asset('iv/assets/rating/themes/krajee-svg/theme.css') }}" media="all" rel="stylesheet"
          type="text/css"/>
    @push('after-styles')
        <style>
            /* start */
            .newbtn a:hover{
    background-color:#4f198d !important;
    border:1px solid #4f198d !important;
  
}
.new-title{
    font-size: 25px;font-weight: 600;
    color: #4f198d;
    margin: 20px auto;text-align: center;
}
.newbtn a{
    min-width:200px !important;
}
            .disabled-hover {
                pointer-events: none;
                opacity: 0.5;
                cursor: default;
                background: #4f198d!important;
                border-color: #4f198d !important;
                color: #fff !important;
            }

            .rowLocation {
                display: flex;
                flex-direction: row;
                justify-content: center;
             
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
                align-items: center;
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

            .loc-cont span {
                font-size: 13px;
            }
            .course-single-text{
                clear: both
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
                margin-right: 10px;
                display: flex;
                align-items: center;
            }

            .date-data p {
                margin-bottom: 9px;
                line-height: 0px;
                width: max-content;
                margin: 0 10px;

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
            .benefit-notes{
                margin: 20px auto;
            }
            .course-content p {
                line-height: 28px;
            }
            .button-new{
                background: #4f198d;
                color:#fff;
                border:1px solid transparent;
                transition: .5s ease-in;
                margin: 10px 5px;
                min-width: 100px !important;
            
            }
            .button-new:hover{
                background:transparent;
                border:1px solid #4f198d;
                color:#4f198d
            }
            .plyr.plyr--full-ui.plyr--video.plyr--youtube.plyr--fullscreen-enabled.plyr--paused.plyr--stopped.plyr__poster-enabled{
                border-radius: 20px;

            }
            .teacher-sec{
                clear:both;
                text-align: center
            }
        </style>
        <link rel="stylesheet" href="https://cdn.plyr.io/3.5.3/plyr.css"/>
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
        .ytp-button:not([aria-disabled=true]):not([disabled]):not([aria-hidden=true]){
            display: none;
        }
.course-content.new{
    border: 2px solid #aaa;
    box-shadow: rgba(0, 0, 0, 0.24) 0px 3px 8px;
    padding:0px 5px;
    border-radius: 10px;

}
    </style>
    <style>
        .floatCourseFooter {
            position: fixed;
            width: 100%;
            height: 150px;
            bottom: 0px;
            /* right: 40px; */
            background-color: #4f198d;;
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

.course-det-list .li{
    display: flex;
    justify-content: space-between;
    align-items: center;
    margin-bottom: 10px;
}
    </style>
@endpush


@section('content')
    @php
        $mainCourse=$course;
    @endphp

    <section class="row the-slider" id="slider">
        <div style="background-size: cover;height:fit-content;padding-bottom: 20px;">
            <div class="container">
                <div class="row benefit-notes mb-4" style="padding: 50px 0;display:flex;justify-content:space-between">
                    <!-- ===========course details part1============ -->
                    <!--==========course description right==========-->
                    <div class=" col-md-7  benefit wow fadeInUp ptb-55 course-content  " style="margin-top: 0;text-align:center">
                        <div class="successMessage">
                            @include('includes.partials.messages')
                            <div id="flash-message">

                            </div>
                        </div>
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
                                {!! $course->short_description ?? $course->description_ar !!}
                            @endif
                        </p>

                        <a href="{{ route('courses.all', ['type' => $course->type_id]) }}"
                           class="btn  btn-sm  button-new link-border col-lg-4">
                            @if (session('locale') == 'ar')
                                {{ $course->type->name_ar }}
                            @else
                                {{ $course->type->name }}
                            @endif
                        </a>
                        <a href="{{ route('courses.category', $course->category->slug) }}"
                           class="btn  btn-sm button-new link-border col-lg-4">
                            @if (session('locale') == 'ar')
                                {{ @$course->category->name_ar }}
                            @else
                                {{ @$course->category->name }}
                            @endif
                        </a>

                    </div>
                    <!--/*==========course description right ==========-->

                    <!--==========course description left ==========-->

                    <div class=" col-md-5  benefit wow fadeInUp ptb-50 course-content mt-0 p-0"
                         id="courseLocContent" style="padding: 0">
                        @if ($course->course_image != '')
                            {{-- <a class="color-primary text-color" href="{{route('courses.details',['course'=>$course->slug])}}"> --}}
                            <a class="color-primary text-color" href="#">

                                <img class="imgCourse" src="{{ asset('storage/uploads/' . $course->course_image) }}"
                                     style="width: 100%;object-fit: fill;
                            border-radius: 10px;
                            height: 307px;" alt="">
                            </a>
                        @else
                            {{-- <a class="color-primary text-color" href="{{route('courses.details',['course'=>$course->slug])}}"> --}}
                            <a class="color-primary text-color" href="#">

                                <img src="{{ asset('iv' . '/images/courses/1.jpg') }}" style="width: 100%;object-fit: cover;
                            border-radius: 10px;
                            height: 307px;" alt="">
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
                    <div class="col-xs-12 col-md-12 mt-min-36  mb-36 benefit wow fadeInUp ptb-16 course-content d-grid ">
                        @if (count($groups) > 0)
                            @php
                                $firstGroupPrice = $groups->first()->price ?? 0;
                                $installmentAmount = $firstGroupPrice / 4;
                                $currency =  $groups->first()->currency ;
                            @endphp
                            <div class="sc-869d045a-27 gYHqBF" style="display: flex;gap: 8px; margin: 16px 0px; width: 100%;">
                                <div class="sc-8a38d207-0 bRWrkE" style="width: 100%;background-image: initial;background-color: rgb(24, 26, 27);border-color: #4f198d;position: relative;cursor: pointer;display: flex;flex-direction:column;-webkit-box-align: center;align-items: center;-webkit-box-pack: start;justify-content: flex-start;padding: 16px 12px 8px;background: rgb(255, 255, 255);border-radius: 8px;border: 1px solid #4f198d; width: 100%;text-align:center">
                                    <div class="sc-8a38d207-5 gprheV" style="margin:10px auto;display:block;">
                                        <img src="https://k.nooncdn.com/s/app/com/noon/images/tabby_logo.svg" alt=""
                                                width="100px" height="40px" class="sc-92fbb12b-1 kkpbGz" style="width: 100px;max-width: unset;height: 40px;max-height: unset;">
                                    </div>
                                    <div class="sc-8a38d207-1 fhYDVM" style="margin-right: auto;width: 100%;display: block;-webkit-box-align: center;align-items: center;-webkit-box-pack: justify;justify-content: space-between;">
                                        <span class="sc-8a38d207-2 cWkccj" style="width:100%">
                                            @if (session('locale') == 'ar')
                                                <p>قسم على 4 دفعات من {{ number_format($installmentAmount, 2) }} {{ $currency }} . بدون
                                                    فوائد. بدون رسوم تأخير.</p>
                                            @else
                                                <p>Split in 4 payments of {{ $currency }} {{ number_format($installmentAmount, 2) }}. No interest. No late fees.</p>
                                            @endif
                                        </span>
    {{--                                    <span class="sc-8a38d207-3 gryidy" style="color: rgb(72, 144, 226); text-decoration-color: initial;">Learn more</span>--}}
                                    </div>
                                </div>
                                <div class="sc-f43f071d-0 hJaViW" style="background-image: initial;background-color: rgb(24, 26, 27); border-color: rgb(116, 38, 45);width:100%;position: relative;cursor: pointer;display: flex;flex-direction:column; center;align-items: center;-webkit-box-pack: start;justify-content: flex-start;padding: 16px 12px 8px; background: rgb(255, 255, 255);border-radius: 8px;border: 1px solid rgb(124 159 212); width: 100%;text-align:center">
                                    <div class="sc-f43f071d-5 jbdSBD" style="">
                                        <img src="{{ asset('images') }}/myfatoura.JFIF" alt=""
                                                width="100px" height="40px" class="sc-92fbb12b-1 jhbcOQ" style="width: 100px;max-width: unset;height: 70px; max-height: unset;">
                                    </div>
                                    <div class="sc-f43f071d-1 bwrdDG" style="margin-right: auto; width: 100%;display: block;-webkit-box-align: center; align-items: center;-webkit-box-pack: justify;justify-content: space-between;">
                                        <span class="sc-f43f071d-2 eDOZDt" style="width: 100%;">


                                            @if (session('locale') == 'ar')
                                                <p>تستطيع الأن دفع {{ number_format($firstGroupPrice, 2) }} {{
                                                $currency }} باستعمال ماي فانوره</p>
                                            @else
                                                <p>You can now pay {{ number_format($firstGroupPrice, 2)}} {{ $currency }}. Using My Fatoorah.</p>
                                            @endif
                                        </span>
    {{--                                    <span class="sc-f43f071d-3 kmJKac" style="color: rgb(72, 144, 226);text-decoration-color: initial;">Learn more</span>--}}
                                    </div>
                                </div>
                            </div>
                        @endif
                        <ul class="course-det-list mt-18">
                            <li  class='li'>
                                {{-- <i class="fa fa-clock-o"></i> --}}
                                <span class="title text-color">   <i class="fa fa-clock-o " style="margin:0 10px"></i>@lang('labels.frontend.layouts.course.duration')</span>
                                {{-- <span> {{ @$course->chapters->sum('session_length')}} @lang('labels.frontend.layouts.course.hours') </span> --}}
                                <span>
                                    @php
                                        if($course->type_id != 1){
                                            $duration = $course->courseDurationFromFirstGroup();
                                        }else{
                                            $duration = $course->courseDuration();
                                        }
                                    @endphp
                                    {{ @$duration['hours'] }}
                                    @if (in_array(@$duration['hours'], [3, 4, 5, 6, 7, 8, 9, 10]))
                                        @lang('labels.frontend.course.hours')
                                    @else
                                        @lang('labels.frontend.course.hour')
                                    @endif
                                    @if ($duration['minutes'] > 0)
                                        {{ @$duration['minutes'] }}
                                        @if (in_array(@$duration['minutes'], [3, 4, 5, 6, 7, 8, 9, 10]))
                                            @lang('labels.frontend.course.minutes')
                                        @else
                                            @lang('labels.frontend.course.minute')
                                        @endif

                                    @endif
                                </span>


                            </li>
                            <li class='li'>
                                @php
                                    $countLessons=0;
                                    $countLessons= $lessons->count();
                                @endphp
                                {{-- <i class="fa fa-book"></i> --}}
                                <span class="title text-color" >  <i class="fa fa-book" style="margin: 0 10px"></i> @lang('labels.frontend.layouts.course.lectures') </span>

                                {{-- <span>{{ @$course->lessons()->count() }} @lang('labels.frontend.layouts.course.lectures') --}}
                                <span>{{ @$countLessons }} @lang('labels.frontend.layouts.course.lectures')

                                </span>

                            </li>
                            <li class='li'>
                                {{-- <i class="fa fa-line-chart"></i> --}}
                                <span class="title text-color"><i class="fa fa-line-chart" style="margin: 0 10px"></i> @lang('labels.frontend.layouts.course.level') </span>
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
                                   class="btn btn-primary btn-xl btn-gray link-border mt-10-per" >
                                    <span>
                                        @if (session('locale') == 'ar')
                                            {{ $course->pdf_title_ar ?? __('labels.frontend.course.brochure') }}
                                        @else
                                            {{ $course->pdf_title ?? __('labels.frontend.course.brochure') }}
                                        @endif
                                    </span>
                                    <i class="pdf-icon-parent"><img class="pdf-icon"
                                                                    src="{{ asset('iv') }}/icons/pdf-download.png"
                                                                    alt=""></i>
                                </a>
                            @else
                                <a href="/login" style="width: auto"
                                   class="btn btn-primary btn-xl btn-gray link-border mt-10-per" style="margin-bottom: 20px">
                                    <span>
                                        @lang('labels.frontend.course.pdf_warning')
                                    </span>
                                    <i class="pdf-icon-parent" style="margin-right:0"><img class="pdf-icon"
                                                                                           src="{{ asset('iv') }}/icons/pdf-download.png"
                                                                                           style="width: 20%"
                                                                                           alt=""></i>
                                </a>
                            @endif
                        @endif
                    </div>
                    <!--/*==========course description right ==========-->

                    <!--==========course description left ==========-->

                    <div class="col-xs-12 col-md-12 mt-min-36 benefit wow fadeInUp ptb-16 course-content mt-0">
                        {{-- @if ($IsUserFilledData == false)
                        <div class="alert alert-danger">
                            <a href="{{ route('admin.account') }}"><i class="fa fa-edit"></i> @lang('validation.complete-data')</a>
                        </div>
                    @endif --}}

                        @if (count($groups) > 0)
                            <div id='chooseMsg' class="zoom-in-zoom-out fadeInUp" style="display: none">
                                <h3>اختر مكان</h3>
                            </div>
                            <h4 class='new-title'>المجموعات</h4>
                            @foreach ($groups as $group)

                                <div class="clear" style="clear: both"></div>
                               
                                <div class="locationsAll" class="">
                                    <div class="container" style="width: 100%">
                                        <div class="row rowLocation justify-content-center align-items-center">

                                            @if ($group->courses->type_id != 1)
                                                <div class="col-md-4   col-xs-6">
                                                    <div class="loc-cont" style="text-align: start">
                                                        <img src="{{ asset('iv') }}/icons/location.png"
                                                             class="icon" alt="">
                                                        <span class="title">
                                                            @if($course->type_id == 3)
                                                                {{ session('locale') == 'ar' ?$group->groupPlaces->name_ar : $group->groupPlaces->name }}
                                                            @else
                                                                {{ session('locale') == 'ar'
                                                                ?$group->location->name_ar :
                                                                $group->location->name }}
                                                            @endif
                                                            </span>
                                                    </div>
                                                </div>
                                                <div class="col-md-4   col-xs-6 " style="    display: flex;
                                                    flex-direction: column-reverse;
                                                    justify-content: center;
                                                ">
                                                    <div class="date-section">

                                                        <img src="{{ asset('iv') }}/icons/calendar.png"
                                                             class="icon" alt="">
                                                        <div class="date-data">
                                                            <p class="title">{{ $group->start->format('d-m-Y')
                                                                }}</p><span class="title">الى</span>
                                                            @if ($group->end)
                                                                <p class="title">{{ $group->end->format('d-m-Y') }}</p>
                                                            @endif

                                                        </div>

                                                    </div>

                                                </div>
                                            @endif
                                            <div class="col-md-4    col-xs-8">
                                                <div class="loc-cont" style="text-align: end">
                                                    <img src="{{ asset('iv') }}/icons/price-tag.png"
                                                         class="icon icon-price" alt="">
                                                    <span class="title"> {{ $group->price }}
                                                        @if ($group->currency == 'SAR')
                                                            {{ $appCurrency['symbol'] }}
                                                        @else
                                                            $
                                                        @endif
                                                        </span>
                                                </div>

                                            </div>
                                            <div class="col-md-4" style="display: flex;align-items: center;
                                                justify-content: center; padding: 0;margin:20px auto">
                                                <div class="col-md-12  col-xs-12 joinbtn newbtn" >
                                                    @include('frontend.courses.buy_button2')
                                                </div>
                                                <a href="#" class="btn btn-primary btn-white link-border
                                                    btn-add-course" data-group-id="{{ $group->id }}"
                                                   style="width: 48px;padding: 0px;height: 34px;">

                                                    <i class="fa fa-shopping-cart"
                                                       style="position: relative;top: -4px;"></i>
                                                </a>

                                            </div>

                                        </div>

                                    </div>
                                </div>

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

                <div class=" col-md-12  benefit wow fadeInUp  course-content new mt-0" style="text-align: justify;
                    ">
                    @if ($course->mediaVideo && $course->mediavideo->count() > 0)
                        <div class="course-single-text ">
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
                                                <source src="{{ $course->mediavideo->url }}" type="video/mp4"/>
                                            </video>
                                        @elseif($course->mediavideo->type == 'embed')
                                            {!! $course->mediavideo->url !!}
                                        @endif
                                    </div>
                                </div>
                            @endif
                        </div>
                    @endif
                   
                    <div class="col-md-6">
                    <h3> @lang('labels.frontend.course.course_detail') </h3>
                    @if (session('locale') == 'ar')
                        {!! $course->description_ar ?? $course->description !!}
                    @else
                        {!! $course->description ?? $course->description_ar !!}
                    @endif

                    <br>
                    {{-- Course Content --}}
                    @foreach($course->courseContent as $content)
                        <h3>{{ $content->title }}</h3>
                        @if(isset($content->subContents) && count($content->subContents) > 0)
                            <ul>
                                @foreach($content->subContents as $index => $sub)
                                    <li>{{ $sub->title }}</li>
                                @endforeach
                            </ul>
                        @endif
                    @endforeach
                    <br>
                </div>

<div class="teacher-sec">
                    <h4 style="margin-top: 21px;">@lang('labels.frontend.course.teachers') </h4>

                    @foreach (collect($course->teachers)->unique('id')->all() as $key => $teacher)
                        <a href="{{ route('teachers.get-details', $teacher->id) }}" style="    width: 235px;"
                           class="btn btn-primary btn-xl btn-gray teacher link-border mt-10">
                           

                            <span>
                                <i class="teacher-img-parent"><img class="teacher-img" src="{{ $teacher->picture }}"
                                    alt=""></i>
                                @if (session('locale') == 'ar')
                                    {{ str_limit($teacher->name_ar ?? $teacher->name, 19) }}
                                @else
                                    {{str_limit($teacher->name ?? $teacher->name_ar, 19) }}
                                @endif
                            </span>
                            <i class="teacher-icon-download fa fa-download"></i>
                        </a>
                    @endforeach
                </div>

                </div>
                <div class=" col-md-12 benefit wow fadeInUp ptb-50 course-content course-curriclum mt-0">
                    <div class="course-curriclum">
                        <h4>

                            @lang('labels.frontend.course.course-curr')
                        </h4>
                        <!--  -->

                        <div id="accordion" class="curriclum-content">
                            {{-- ->whereIn('id',$lastCourseLocationsChaptersIds) --}}

                            @foreach ($chapters as $key => $chapter)
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
                                            {{-- @dd($course->LessonsByChapter($chapter->id,$last)) --}}
                                            @foreach ($chapter->lessons as $lesson)
                                                {{--                                                @foreach ($item as $title)--}}


                                                {{-- @if (@$item->model->chapter_id == $chapter->id) --}}
                                                <div class=" mb-7 d-flex">
                                                    <i class=" mb-14 "> <img class="w-24"
                                                                             src="{{ asset('iv') }}/icons/document.png"
                                                                             alt=""></i>
                                                    <p class="display-content">

                                                        {{ $lesson->title  }}
                                                    </p>
                                                </div>
                                                {{-- @endif --}}
                                                {{--                                                    @endforeach--}}
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
    <!--==========The Product==========-->
    <section class="row the-product course-related" id="product">
        <div class="container">
            <div class="row section-header wow fadeInUp">
                <h2>@lang('labels.frontend.layouts.course.related')</h2>

            </div>
            <div class="tab-content">

                <div role="tabpanel" class="tab-pane active" id="tab-1">
                    <div class="row collections">

                        @if (count($student_featured_courses) > 0)
                            @foreach ($student_featured_courses as $course)
                                <div class="  col-md-4 item  fadeIn">
                                    @include(
                                        'frontend.layouts.partials.course_box'
                                    )
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
        $(document).on('change', 'input[name="stars"]', function () {
            $('#rating').val($(this).val());

        })
        //if one of the groups is already added to the cart, make the add to cart button hovered and disabled

        $(document).ready(function () {
            $('.caption').css({
                'display': 'none'
            })
            @foreach ($groups as $group)
            @php
                if(!Auth::user()){
                     $groupCoursesInCart = Cart::session('guest')->getContent()->where('attributes.course_group_id', $group->id);
                }else{
                    $groupCoursesInCart = Cart::session(auth()->id())->getContent()->where('attributes.course_group_id', $group->id);
                }
            @endphp
            @if ($groupCoursesInCart->count() > 0)
            $('.btn-add-course').addClass('disabled-hover');
            @endif
            @endforeach

            $('.btn-add-course').click(function (e) {
                e.preventDefault();
                var groupId = $(this).data('group-id');
                var form = $('#checkoutForm-' + groupId);
                var url = form.attr('action');
                var remove_url = '{{ route('cart.remove', ['course' => '']) }}';
                var input = $('<input>').attr('type', 'hidden').attr('name', 'is_add_to_cart').val('1');
                form.append(input);
                $.ajax({
                    type: "POST",
                    url: url,
                    data: form.serialize(), // serializes the form's elements.
                    headers: {
                        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content') // Include CSRF token
                    },
                    success: function (data) {
                        //remove is_add_to_cart
                        $('input[name="is_add_to_cart"]').remove();
                        //alert msg
                        var successAlert = '<div class="alert alert-success" role="alert" id="success-alert">' +
                            '<button type="button" class="close" data-dismiss="alert" aria-label="Close">' +
                            '<span aria-hidden="true">&times;</span>' +
                            '</button>' +
                            '@lang('alerts.frontend.course_added')' +
                            '</div>';

                        $('#flash-message').append(successAlert);
                        //make the add to cart button hovered and disabled
                        $('.btn-add-course').addClass('disabled-hover');
                        // $this.addClass('disabled-hover');

                        // Check if the element exists
                        if ($('#cart-item-count').length) {
                            var cartCount = parseInt($('#cart-item-count').text());
                            $('#cart-item-count').text(cartCount + 1);
                        } else {
                            // Element does not exist, create it and set its value to 1
                            $('#cart-item-count-container').append('<span id="cart-item-count">1</span>');
                        }

                        //add item to side cart
                        var cartItem = $('<div class="cart-item"></div>');
                        var cartButtons = $('<div class="cart-buttons"></div>').append(
                            $('<a></a>').attr('href', remove_url+data.course_id).append(
                                $('<span class="cart-delete-btn"></span>')
                            )
                        );
                        var cartDescription = $('<div class="cart-description"></div>').append(
                            $('<span></span>').text(data.course_name),
                            $('<span></span>').text(data.group_name)
                        );
                        var cartTotalPrice = $('<div class="cart-total-price"></div>').text(data.price + ' ' + data.currency);

                        var cartImageDiv = $('<div class="image"></div>');
                        var cartImage = data.course_img ?
                            $('<img>').attr('src', '/storage/uploads/' + data.course_img).attr('alt', data.course_name) :
                            $('<img>').attr('src', '{{ asset('iv' . '/images/courses/1.jpg') }}').attr('alt', data.course_name);
                        cartImage.css({
                            "width": "100%",
                            "object-fit": "cover",
                            "border-radius": "10px",
                            "height": "100%"
                        });
                        cartImageDiv.append(cartImage);

                        cartItem.append(cartButtons, cartDescription, cartTotalPrice, cartImageDiv);

                        $('#side-cart').append(cartItem);


                        if ($('.shopping-cart').css('display') == 'none') {
                            $('.shopping-cart').css('display', 'flex');
                            $('body').addClass('no-scroll');
                        } else {
                            $('.shopping-cart').css('display', 'none');
                            $('body').removeClass('no-scroll');
                        }
                        $('.page-shadow').toggle();
                    },
                    error: function (xhr, status, error) {
                        // Handle error
                        console.error("An error occurred: " + status + " " + error);
                    }
                });
            });
            // Prevent default action for disabled buttons
            $(document).on('click', '.btn-add-course.disabled-hover', function (e) {
                e.preventDefault();
            });
        })
    </script>


    <script>
        $(document).on('change', 'input[name="stars"]', function () {
            $('#rating').val($(this).val());
        })
        @if (isset($review))
        var rating = "{{ $review->rating }}";
        $('input[value="' + rating + '"]').prop("checked", true);
        $('#rating').val(rating);
        @endif


        $(window).scroll(function () {
            var bodyTop = $('html').scrollTop();
            if (bodyTop >= 30) {
                $('.count').each(function () {
                    $(this).prop('Counter', 0).animate({
                        Counter: $(this).data('value')
                    }, {
                        duration: 2000,
                        easing: 'swing',
                        step: function (now) {
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
        $(window).scroll(function () {
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

        $(document).on('change', 'input[name="stars"]', function () {
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
