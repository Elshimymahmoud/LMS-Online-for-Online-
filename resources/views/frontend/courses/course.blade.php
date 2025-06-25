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
            .newbtn a:hover {
                background-color: #4f198d !important;
                border: 1px solid #4f198d !important;

            }

            .new-title {
                font-size: 25px;
                font-weight: 600;
                color: #4f198d;
                margin: 20px auto;
                text-align: center;
            }

            .newbtn a {
                min-width: 200px !important;
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
                /* flex-wrap: wrap; */
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

            .course-single-text {
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

                . {
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

            .benefit-notes {
                margin: 20px auto;
            }

            .course-content p {
                line-height: 28px;
            }

            .button-new {
                background: #4f198d;
                color: #fff;
                border: 1px solid transparent;
                transition: .5s ease-in;
                margin: 10px 5px;
                min-width: 100px !important;

            }

            .button-new:hover {
                background: transparent;
                border: 1px solid #4f198d;
                color: #4f198d
            }

            .plyr.plyr--full-ui.plyr--video.plyr--youtube.plyr--fullscreen-enabled.plyr--paused.plyr--stopped.plyr__poster-enabled {
                border-radius: 20px;

            }

            .teacher-sec {
                clear: both;
                text-align: center
            }
        </style>
        <link rel="stylesheet" href="https://cdn.plyr.io/3.5.3/plyr.css"/>

        <style>
            body {
                direction: rtl;
            }

            #course-details .cont {

                text-align: center;
                height: 100%;
                width: 98%;
                margin-left: auto;
                margin-right: auto
            }


            a {
                text-decoration: none;

            }

            .collapse-header::after {
                content: "+";
                position: absolute;
                left: 10px;
                font-size: 22px;
                font-weight: 700;
            }

            .collapse-header.active::after {
                content: "-";
            }

            a:hover {
                text-decoration: none
            }

            #course-details {
                padding: 40px 0;
                
            }

            #course-details .two-part .text-part {

                margin-bottom: 20px;
                width: 100%
            }

            #course-details .image-part {
                width: 100%
            }

            #course-details .image-part img {
                width: 100%;
                height: 350px;
                max-width: 100%;
            }


            #course-details h3 {
                font-size: 25px;
                line-height: 32px;
                margin-bottom: 20px;
                color: #4f198d;
            }

            #course-details .two-part p {
                line-height: 32px;
                text-align: justify;
                font-size: 18px;
                padding: 10px;
            }

            #course-details .two-part {
                display: flex;
                width: 100%;

                flex-direction: column;


            }
.first{
    width: 100%;
}
            #course-details .two-part a {
                display: inline-block;
                padding: 10px 20px;
                min-width: 180px;
                border-radius: 10px;
                transition: .5s ease-in-out;
                margin: 10px 10px;
                text-align: center;
                line-height: 28px;
                font-size: 18px;
                font-weight: 500;
            }

            #course-details .two-part a.fbtn {
                background: #4f198d;
                color: #fff;
                border: 1px solid transparent;
            }

            #course-details .two-part a.fbtn:hover {
                background-color: transparent;
                border: 1px solid #4f198d;
                color: #4f198d;
            }

            #course-details .two-part a.sbtn {
                background-color: transparent;
                color: #4f198d;
                border: 1px solid #4f198d;

            }

            #course-details .two-part a.sbtn:hover {
                background: #4f198d;
                color: #fff;
            }

            #course-details .two-part .image-part,
            #course-details .two-part .text-part {
                width: 100%;
            }

            .two-buttons {
                display: flex;
                justify-content: start;
                flex-wrap: wrap;
                justify-content: center
            }


            .tabs-details {
                margin-top: 60px;
            }

            .tabs-details .tabs {
                display: flex;
                cursor: pointer;
                margin-bottom: 20px;
                justify-content: center;
                flex-wrap: wrap;
            }

            .tabs-details .tab {
                padding: 10px 20px;
                background-color: #f1f1f1;
                border: 1px solid #ccc;
                margin-right: 5px;
                font-size: 20px;
            
                margin: 5px;
                border-radius: 6px;

            }

            .tabs-details .tab.active {
                background-color: #4f198d;
                border-bottom: none;
                color: #fff;
                box-shadow: rgba(0, 0, 0, 0.24) 0px 3px 8px;
            }

            .tabs-details .tab-content {
                display: none;
                padding: 20px;
                border: 1px solid #ccc;
                background-color: #f9f9f9;
                border-radius: 10px;
            }

            .tabs-details .tab-content.active {
                display: block;
            }

            .tab-content .two {
                text-align: start
            }

            .tab-content .two li {
                line-height: 32px;
                font-size: 20px;
                margin: 5px 0;
            }

            .tab-content .two h5 {
                font-size: 20px;
                font-weight: 600;
                margin: 10px 0;
            }

            .tab-content .second {
                border: 1px solid #eee;
                box-shadow: rgba(0, 0, 0, 0.16) 0px 1px 4px;
                padding: 10px 20px;
                width: 100%;
                /* width: max-content; */
            }

            .tab-content .second .icons {
                font-size: 20px;
                color: #aaa;
                margin: 10px 0;
                display: flex;
                align-items: center;

            }

            .tab-content .second .icons i {
                color: #4f198d;

            }

            .tab-content .second .icons span {
                margin-left: 5px;
                font-size: 16px;
            }

            .tab-content .second .icons b {
                margin-right: 5px;
            }

            .tab-content .goals p {
                font-size: 18px;
                font-weight: 600;
                line-height: 30px
            }

            .tab-content .goals {
                text-align: start;
                padding: 0
            }

            .tab-content .goals li {
                font-size: 16px;
                color: #aaa;
                line-height: 25px;
                list-style: none;
                padding-right: 40px
            }

            .tab-content .goals li i {
                color: #aaa
            }

            .fa-circle {
                font-size: 16px;

            }

            .collapse-header {
                cursor: pointer;
                padding: 10px;
                background-color: #f1f1f1;
                border: 1px solid #ccc;
                margin-bottom: 10px;
                text-align: right;
                font-weight: bold;
                position: relative;
                transition: .5s ease;
            }

            .collapse-content {
                padding: 10px;
                border: 1px solid #ccc;
                border-top: none;
                display: none;
                text-align: right;
                background-color: #fff;
                transition: .5s ease;
                margin: 10px 0;
            }

            .collapse-content.active {
                display: block;
            }

            .tab-content iframe {
                border-radius: 20px;
                width: 100%;
                margin-bottom: 20px;
            }

            .rowLocation {
                display: flex;
             
                align-items: center;
                border-radius: 10px;
            }

            .date-section {
                display: flex;
                align-items: center
            }

            .groups-data {
                background-color: #fff;
                padding: 10px;
                margin: 10px 0;
                position: relative;

            }

            .basket {
            
             
                background: #aaa;
                color: rgba(0, 0, 0, .7);
                left: 10px;
                border-radius: 10px;
                padding: 10px;
                box-shadow: rgba(0, 0, 0, 0.16) 0px 1px 4px;
            }

            .loc-cont {
                display: flex;
                align-items: center;
                margin: 10px 0;
            }

            .loc-cont .icon {
                margin-left: 10px;
            }

            .newbtn {
                background: #4f198d;
                color: #fff;
                padding: 10px 20px;
                border-radius: 5px;
                display: block;
            }

            .newbtn a {
                color: #fff;
            }

            .teacher-img {
                border-style: solid;
                border-width: 1px;
                width: 40px;
                height: 42px;
                object-fit: cover;
                border-radius: 53%;
                /* margin-top: 2px; */
                margin-top: 2px;
                margin-right: 5px;
            }

            .trns-1 span {
                display: flex;
                align-items: center;
                font-size: 16px;
                font-weight: 600
            }

            .trns-1 span img {
                margin-left: 10px;
            }

            .trns-1 {
                background: #fff;
                box-shadow: rgba(0, 0, 0, 0.16) 0px 1px 4px;
                border: 1px solid #eee;
                padding: 10px 20px;
                border-radius: 10px;
                margin: 10px 0;
                display: block;
                position: relative;
            }

            .trns-1 .teacher-icon-download {
                position: absolute;
                top: 20px;
                left: 10px;
                border-radius: 10px;
                font-size: 20px;
                color: #aaa;
            }
            .btn-get-course{
                position: relative;
              
                cursor: pointer;
            }

            @media (max-width: 775px) {

                #course-details .cont {

                    text-align: center;
                    height: 100%;
                    width: 98%;
                    margin-left: auto;
                    margin-right: auto
                }
          
  
            }


            @media (min-width: 776px) {

                #course-details .cont {
                    width: 85%;
                    margin-left: auto;
                    margin-right: auto;
                    max-width: 85%

                }
                .first{
    width: 60%;
}
            }

            @media (min-width: 992px) {

                #course-details .two-part {
                    display: flex;
                    flex-direction: row;
                    justify-content: space-between;
                    align-items: start;
                }

                #course-details .two-part .text-part {

                    width: 55%;
                }

                .two-buttons {
                    justify-content: start;
                }

                #course-details .two-part .image-part {
                    width: 40%;

                }

                .tab-content .two {
                    display: flex;
                    justify-content: space-between;
                    align-items: start;
                }

                .groups-data {
                    display: flex;
                    justify-content: space-between;
                 

                    align-items: center;
                }
                .tab-content .second {
                    width:35%}

                    .btn-get-course{
                position: relative;
                cursor: pointer;
            }

            }

        </style>
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

        .ytp-button:not([aria-disabled=true]):not([disabled]):not([aria-hidden=true]) {
            display: none;
        }

        .course-content.new {
            border: 2px solid #aaa;
            box-shadow: rgba(0, 0, 0, 0.24) 0px 3px 8px;
            padding: 0px 5px;
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

        .course-det-list .li {
            display: flex;
            justify-content: space-between;
            align-items: center;
            margin-bottom: 10px;
        }

        .plyr--video {
            height: 360px
        }
    </style>
@endpush


@section('content')
    @php
        $mainCourse=$course;
    @endphp

    <div id='course-details'>

        <div class="cont">
            <div class="two-part">
                <div class="text-part ">
                    <div class="successMessage">
                        @include('includes.partials.messages')
                        <div id="flash-message">

                        </div>
                    </div>
                    <h3>{{ (app()->getLocale() == 'ar') ? $course->title_ar : $course->title }}</h3>
                    <p>
                        {!! (app()->getLocale() == 'ar') ? $course->short_description_ar : $course->short_description
                         !!}
                    </p>
                    <div class="two-buttons">
                        <a href='{{ route('courses.all', ['type' => $course->type_id]) }}' class='fbtn'>
                            {{ (app()->getLocale() == 'ar' ? $course->type->name_ar : $course->type->name) }}
                        </a>
                        <a href='{{ route('courses.category', $course->category->slug) }}' class=sbtn>
                            {{ (app()->getLocale() == 'ar' ? $course->category->name_ar : $course->category->name) }}
                        </a>
                    </div>
                </div>
                <div class="image-part ">
                    @if ($course->course_image != '')
                        <img class="w-100" src="{{ asset('storage/uploads/' . $course->course_image) }}">
                    @else
                        <img src="{{ asset('iv' . '/images/courses/1.jpg') }}" class='w-100 '>
                    @endif

                </div>
            </div>
            <div class="tabs-details">
                <h3>تفاصيل الدورة</h3>
                <div class="tabs">
                    <div class="tab active" data-tab="1"> أهداف الدورة</div>
                    @if(count($groups) > 0)
                        <div class="tab" data-tab="7"> المجموعات</div>
                    @endif


                    {{--                    <div class="tab" data-tab="2">الفئة المستهدفة</div>--}}
                    <div class="tab" data-tab="3">محاور الدورة</div>
                    <div class="tab" data-tab="4"> @lang('labels.frontend.course.teachers')</div>
                    @if($course->lessons->count() > 0)
                        <div class="tab" data-tab="5">محتويات الدورة</div>
                    @endif
                    <div class="tab" data-tab="6">بوايات الدفع</div>
                </div>

                <div id="tab-content-1" class="tab-content active">
                    <div class="two">
                        <div class="first" style="max-width: 100%">
                            @if ($course->mediaVideo && $course->mediavideo->count() > 0)
                                @if ($course->mediavideo != '')
                                    <div class="video-container mb-5" data-id="{{ $course->mediavideo->id }}">
                                        @if ($course->mediavideo->type == 'youtube')
                                            <div id="player" class="js-player" data-plyr-provider="youtube"
                                                 style="height: 360px"
                                                 data-plyr-embed-id="{{ $course->mediavideo->file_name }}"></div>
                                        @elseif($course->mediavideo->type == 'vimeo')
                                            <div id="player" class="js-player" data-plyr-provider="vimeo"
                                                 style="height: 360px"
                                                 data-plyr-embed-id="{{ $course->mediavideo->file_name }}"></div>
                                        @elseif($course->mediavideo->type == 'upload')
                                            <video poster="" id="player" class="js-player" playsinline
                                                   controls>
                                                <source src="{{ $course->mediavideo->url }}" type="video/mp4"/>
                                            </video>
                                        @elseif($course->mediavideo->type == 'embed')
                                            {!! $course->mediavideo->url !!}
                                        @endif
                                    </div>

                                @endif
                            @endif

                            <br>
                            <br>
                            <br>
                                {!! (app()->getLocale() == 'ar') ? $course->description_ar : $course->description
                                                        !!}

                            {{--                            <h5>سيكون كل مشارك في نهاية الدورة قادراً على: </h5>--}}
                            {{--                            <ul>--}}
                            {{--                                <li>توضيح مفهوم الاستدامة وأهميتها في سياق الأعمال الحديثة.</li>--}}
                            {{--                                <li>تعزيز الفهم للتحديات البيئية والاجتماعية والاقتصادية</li>--}}
                            {{--                                <li>التزود بالمهارات والأدوات اللازمة لتطبيق مبادئ الاستدامة في استراتيجيات الأعمال وعملياتها.</li>--}}
                            {{--                                <li>تعزيز الوعي بأفضل الممارسات والتقنيات لتحقيق الاستدامة في مختلف القطاعات والصناعات.</li>--}}
                            {{--                            </ul>--}}
                        </div>
                        <div class="second">
                            <div class='icons'>
                                <i class="fas fa-clock" style="margin:0 10px;"></i><span>المدة الزمنية</span> -
                                <b>
                                    @php
                                        if($course->type_id != 1){
                                            $duration = $course->courseDurationFromFirstGroup();
                                        }else{
                                            $duration = $course->courseDuration();
                                        }
                                    @endphp
                                   ( {{ @$duration['hours'] }}
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
                                    )
                                </b>
                            </div>
                            <div class='icons'>
                                <i class="fa fa-book" style="margin: 0 10px"></i><span>محاضرات</span> -
                                <b>({{ $lessons->count() }} @lang('labels.frontend.layouts.course.lectures'))</b>
                            </div>
                            <div class='icons'>
                                <i class="fa fa-line-chart" style="margin: 0 10px"></i><span>المستوى</span> -
                                <b> ({{ app()->getLocale() == 'ar' ? @$course->level->name_ar : @$course->level->name }}
                                    )</b>
                            </div>
                        </div>

                    </div>
                </div>
                <div id="tab-content-7" class="tab-content">
                    <div class="groups">
                        @if (count($groups) > 0)
                            @foreach ($groups as $group)
                                <div class="locationsAll">
                                    <div class="contai" style="width: 100%">

                                        <div class="groups-data">

                                            <div class="row rowLocation justify-content-center align-items-center">
                                                @if ($group->courses->type_id != 1)
                                                    <div class="col-md-6">
                                                        <div class="loc-cont" style="text-align: start">
                                                            <img src="{{ asset('iv') }}/icons/location.png" class="icon"
                                                                 alt="">
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
                                                    <div class="col-md-10" style="display: flex;

                                                    justify-content: center;">
                                                        <div class="date-section">

                                                          
                                                            <div class="date-data">
                                                                <img src="{{ asset('iv') }}/icons/calendar.png" class="icon"
                                                                alt="">
                                                                <p class="title">{{ $group->start->format('d-m-Y')
                                                                    }}</p><span class="title">الى</span>
                                                                @if ($group->end)
                                                                    <p class="title">{{ $group->end->format('d-m-Y') }}</p>
                                                                @endif

                                                            </div>


                                                        </div>

                                                    </div>
                                                @endif
                                                <div class="col-md-8">
                                                    <div class="loc-cont" style="text-align: end">
                                                        <img src="{{ asset('iv') }}/icons/price-tag.png"
                                                             class="icon icon-price" alt="">
                                                        <span class="title"> {{ $group->price }}  {{ ($group->currency =='SAR') ? $appCurrency['symbol'] : '$' }} </span>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="col-md-4" style="display: flex;
                                            justify-content: center; padding: 0;align-items:center">
                                                <div class="col-md-12  col-xs-12 ">
                                                    @include('frontend.courses.buy_button2')
                                                </div>

                                                <a href="#" class="btn btn-primary btn-white  basket
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
                        @endif
                    </div>

                </div>
                {{--                <div id="tab-content-2" class="tab-content">--}}
                {{--                    <div class="two">--}}
                {{--                        <div class="first">--}}
                {{--                            <li>المدراء التنفيذيين ومسؤولو اتخاذ القرار في الشركات والمؤسسات الذين يرغبون في تضمين مبادئ الاستدامة في استراتيجيات أعمالهم.</li>--}}
                {{--                            <li>الموظفون في مجالات إدارة البيئة والاستدامة الذين يسعون لتعزيز فهمهم ومعرفتهم بأحدث الممارسات والتقنيات في مجال الاستدامة.</li>--}}
                {{--                            <li>الخبراء والاستشاريون الذين يعملون في مجال الاستدامة ويرغبون في تطوير مهاراتهم وزيادة معرفتهم بأساليب تطبيق مفاهيم الاستدامة في الأعمال.</li>--}}
                {{--                        </div>--}}
                {{--                    </div>--}}
                {{--                </div>--}}
                <div id="tab-content-3" class="tab-content">
                    @foreach($course->courseContent as $content)
                        <ul class='goals'>
                            <p><i class="fa fa-circle" style="margin:0 10px;"></i>{{ $content->title }}</p>


                            @if(isset($content->subContents) && count($content->subContents) > 0)
                                @foreach($content->subContents as $index => $sub)
                                    <li><i class="fa fa-check" style="margin:0 10px;"></i>
                                        {{ $sub->title }}</li>
                                @endforeach
                            @endif
                        </ul>
                    @endforeach

                </div>
                <div id="tab-content-4" class="tab-content">
                    @foreach (collect($course->teachers)->unique('id')->all() as $key => $teacher)
                        <div class="trns">
                            <a href='{{ route('teachers.get-details', $teacher->id) }}' class="trns-1">



                            <span>
                                <i class="teacher-img-parent"><img class="teacher-img" src="{{ $teacher->picture }}"
                                                                   alt=""></i>
                                @if (session('locale') == 'ar')
                                    {{ str_limit($teacher->name_ar ?? $teacher->name, 19) }}
                                @else
                                    {{str_limit($teacher->name ?? $teacher->name_ar, 19) }}
                                @endif
                                <i class="teacher-icon-download fa fa-download"></i>
                            </span>

                            </a>
                        </div>
                    @endforeach

                </div>
                <div id="tab-content-5" class="tab-content">
                    @if($course->type_id != 1)
                        @php
                            $lessons = $course->lessons;
                        @endphp
                        <div class="collapse-content active">
                            @foreach ($lessons as $lesson)
                                <p>
                                    <i class="fas fa-file-pdf" style="font-size:24px; margin-left:10px;"></i>
                                    {{ session('locale') == 'ar' ?  $lesson->title_ar : $lesson->title }}
                                </p>
                            @endforeach
                        </div>

                    @else
                        @php
                            $chapters = $course->chapters()->orderBy('sequence', 'asc')->get()
                        @endphp
                        @foreach ($chapters as $key => $chapter)
                            @if(count($chapter->lessons) > 0)
                                <div class="collapse-section">
                                    <div class="collapse-header" data-target="content-chapter-{{ $chapter->id }}"> {{ session('locale') == 'ar' ? $chapter->title_ar : $chapter->title }} :</div>
                                    <div id="content-chapter-{{ $chapter->id }}" class="collapse-content">
                                        @foreach ($chapter->lessons as $lesson)
                                            <p>
                                                <i class="fas fa-file-pdf" style="font-size:24px; margin-left:10px;"></i>
                                                {{ session('locale') == 'ar' ?  $lesson->title_ar : $lesson->title }}
                                            </p>
                                        @endforeach
                                    </div>
                                </div>
                            @endif
                        @endforeach
                    @endif


                </div>
                <div id="tab-content-6" class="tab-content">
                    @if (count($groups) > 0)
                        @php
                            $firstGroupPrice = $groups->first()->price ?? 0;
                            $installmentAmount = $firstGroupPrice / 4;
                            $jeelInstallmentAmount = $firstGroupPrice / 12;
                            $currency =  $groups->first()->currency ;
                        @endphp

                        <div class="gets">
                            <div class="get-1">
                                <div class="sc-8a38d207-0 bRWrkE"
                                     style="background-image: initial;background-color: rgb(24, 26, 27);border-color: #4f198d;position: relative;cursor: pointer;display: flex;flex-direction:column;-webkit-box-align: center;align-items: center;-webkit-box-pack: start;justify-content: flex-start;background: rgb(255, 255, 255);border-radius: 8px;border: 1px solid #aaa; width: 100%;text-align:center;margin-bottom:20px">
                                    <div class="sc-8a38d207-5 gprheV" style="margin:10px auto;display:block;">
                                        <img src="https://k.nooncdn.com/s/app/com/noon/images/tabby_logo.svg"
                                             alt="tabby logo"
                                             width="100px" height="40px" class="sc-92fbb12b-1 kkpbGz"
                                             style="width: 100px;max-width: unset;height: 40px;max-height: unset;">
                                    </div>
                                    <div class="sc-8a38d207-1 fhYDVM"
                                         style="margin-right: auto;width: 100%;display: block;-webkit-box-align: center;align-items: center;-webkit-box-pack: justify;justify-content: space-between;">
                                        <span class="sc-8a38d207-2 cWkccj" style="width:100%">
                                             @if (session('locale') == 'ar')
                                                <p>قسم على 4 دفعات من {{ number_format($installmentAmount, 2) }} {{ $currency }} . بدون
                                                    فوائد. بدون رسوم تأخير.</p>
                                            @else
                                                <p>Split in 4 payments of {{ $currency }} {{ number_format($installmentAmount, 2) }}. No interest. No late fees.</p>
                                            @endif
                                        </span>

                                    </div>
                                </div>
                                <div class="sc-f43f071d-0 hJaViW"
                                     style="background-image: initial;background-color: rgb(24, 26, 27); border-color: rgb(116, 38, 45);width:100%;position: relative;cursor: pointer;display: flex;flex-direction:column; center;align-items: center;-webkit-box-pack: start;justify-content: flex-start; background: rgb(255, 255, 255);border-radius: 8px;border: 1px solid #aaa; width: 100%;text-align:center">
                                    <div class="sc-f43f071d-5 jbdSBD" style="">
                                        <img src="https://www.myfatoorah.com/assets/img/logo.png" alt="myfatoura" class="sc-92fbb12b-1 jhbcOQ"
                                             style="    width: 115px;
                                                max-width: unset;
                                                height: 55px;
                                                max-height: unset;
                                                margin: 2rem;">
                                    </div>
                                    <div class="sc-f43f071d-1 bwrdDG"
                                         style="margin-right: auto; width: 100%;display: block;-webkit-box-align: center; align-items: center;-webkit-box-pack: justify;justify-content: space-between;">
                                        <span class="sc-f43f071d-2 eDOZDt" style="width: 100%;">
                                            @if (session('locale') == 'ar')
                                                <p>تستطيع الأن دفع {{ number_format($firstGroupPrice, 2) }} {{
                                                            $currency }} باستعمال ماي فانوره</p>
                                            @else
                                                <p>You can now pay {{ number_format($firstGroupPrice, 2)}} {{ $currency }}. Using My Fatoorah.</p>
                                            @endif
                                        </span>
                                    </div>
                                    
                                </div>
                                <div class="sc-8a38d207-0 bRWrkE"
                                style="background-image: initial;background-color: rgb(24, 26, 27);border-color: #4f198d;position: relative;cursor: pointer;display: flex;flex-direction:column;-webkit-box-align: center;align-items: center;-webkit-box-pack: start;justify-content: flex-start;background: rgb(255, 255, 255);border-radius: 8px;border: 1px solid #aaa; width: 100%;text-align:center;margin:20px 0;">
                               <div class="sc-8a38d207-5 gprheV" style="margin:10px auto;display:block;">
                                   <svg width="178px" height="50px" viewBox="0 0 417 76" fill="none" xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" style="padding-block-start: 0px;"><rect width="417" height="76" fill="url(#pattern0_1148_6736)"></rect><defs><pattern id="pattern0_1148_6736" patternContentUnits="objectBoundingBox" width="1" height="1"><use xlink:href="#image0_1148_6736" transform="matrix(0.000283126 0 0 0.00155347 0 -1.4395)"></use></pattern><image id="image0_1148_6736" width="3532" height="2497" xlink:href="data:image/png;base64,iVBORw0KGgoAAAANSUhEUgAADcwAAAnBCAYAAADdsFf4AAAACXBIWXMAAC5xAAAucQGxbqlcAAAgAElEQVR4nOzBAQ0AMBADoZt/0X0dS4C3LQAAAAAAAAAAAAAAAAD4WnUAAAD//+zRAQkAAAwEoWP9Qy/Hg1bwDAIAAAAAAAAAAAAAAAAwr3oAAAD//+zbAQ0AAADCoPdPbQ436IEwBwAAAAAAAAAAAAAAAMC/agAAAP//7NsBDQAAAMKg909tDjfogTAHAAAAAAAAAAAAAAAAwL9qAAAA///s2wENAAAAwqD3T20ON+iBMAcAAAAAAAAAAAAAAADAv2oAAAD//+zbAQ0AAADCoPdPbQ436IEwBwAAAAAAAAAAAAAAAMC/agAAAP//7NsBDQAAAMKg909tDjfogTAHAAAAAAAAAAAAAAAAwL9qAAAA///s2wENAAAAwqD3T20ON+iBMAcAAAAAAAAAAAAAAADAv2oAAAD//+zbAQ0AAADCoPdPbQ436IEwBwAAAAAAAAAAAAAAAMC/agAAAP//7NsBDQAAAMKg909tDjfogTAHAAAAAAAAAAAAAAAAwL9qAAAA///s2wENAAAAwqD3T20ON+iBMAcAAAAAAAAAAAAAAADAv2oAAAD//+zbAQ0AAADCoPdPbQ436IEwBwAAAAAAAAAAAAAAAMC/agAAAP//7NsBDQAAAMKg909tDjfogTAHAAAAAAAAAAAAAAAAwL9qAAAA///s2wENAAAAwqD3T20ON+iBMAcAAAAAAAAAAAAAAADAv2oAAAD//+zbAQ0AAADCoPdPbQ436IEwBwAAAAAAAAAAAAAAAMC/agAAAP//7NsBDQAAAMKg909tDjfogTAHAAAAAAAAAAAAAAAAwL9qAAAA///s2wENAAAAwqD3T20ON+iBMAcAAAAAAAAAAAAAAADAv2oAAAD//+zbAQ0AAADCoPdPbQ436IEwBwAAAAAAAAAAAAAAAMC/agAAAP//7NsBDQAAAMKg909tDjfogTAHAAAAAAAAAAAAAAAAwL9qAAAA///s2wENAAAAwqD3T20ON+iBMAcAAAAAAAAAAAAAAADAv2oAAAD//+zbAQ0AAADCoPdPbQ436IEwBwAAAAAAAAAAAAAAAMC/agAAAP//7NsBDQAAAMKg909tDjfogTAHAAAAAAAAAAAAAAAAwL9qAAAA///s2wENAAAAwqD3T20ON+iBMAcAAAAAAAAAAAAAAADAv2oAAAD//+zbAQ0AAADCoPdPbQ436IEwBwAAAAAAAAAAAAAAAMC/agAAAP//7NsBDQAAAMKg909tDjfogTAHAAAAAAAAAAAAAAAAwL9qAAAA///s2wENAAAAwqD3T20ON+iBMAcAAAAAAAAAAAAAAADAv2oAAAD//+zbAQ0AAADCoPdPbQ436IEwBwAAAAAAAAAAAAAAAMC/agAAAP//7NsBDQAAAMKg909tDjfogTAHAAAAAAAAAAAAAAAAwL9qAAAA///s2wENAAAAwqD3T20ON+iBMAcAAAAAAAAAAAAAAADAv2oAAAD//+zbAQ0AAADCoPdPbQ436IEwBwAAAAAAAAAAAAAAAMC/agAAAP//7NsBDQAAAMKg909tDjfogTAHAAAAAAAAAAAAAAAAwL9qAAAA///s2wENAAAAwqD3T20ON+iBMAcAAAAAAAAAAAAAAADAv2oAAAD//+zbAQ0AAADCoPdPbQ436IEwBwAAAAAAAAAAAAAAAMC/agAAAP//7NsBDQAAAMKg909tDjfogTAHAAAAAAAAAAAAAAAAwL9qAAAA///s2wENAAAAwqD3T20ON+iBMAcAAAAAAAAAAAAAAADAv2oAAAD//+zbAQ0AAADCoPdPbQ436IEwBwAAAAAAAAAAAAAAAMC/agAAAP//7NsBDQAAAMKg909tDjfogTAHAAAAAAAAAAAAAAAAwL9qAAAA///s2wENAAAAwqD3T20ON+iBMAcAAAAAAAAAAAAAAADAv2oAAAD//+zbAQ0AAADCoPdPbQ436IEwBwAAAAAAAAAAAAAAAMC/agAAAP//7NsBDQAAAMKg909tDjfogTAHAAAAAAAAAAAAAAAAwL9qAAAA///s2wENAAAAwqD3T20ON+iBMAcAAAAAAAAAAAAAAADAv2oAAAD//+zbAQ0AAADCoPdPbQ436IEwBwAAAAAAAAAAAAAAAMC/agAAAP//7NsBDQAAAMKg909tDjfogTAHAAAAAAAAAAAAAAAAwL9qAAAA///s2wENAAAAwqD3T20ON+iBMAcAAAAAAAAAAAAAAADAv2oAAAD//+zbAQ0AAADCoPdPbQ436IEwBwAAAAAAAAAAAAAAAMC/agAAAP//7NsBDQAAAMKg909tDjfogTAHAAAAAAAAAAAAAAAAwL9qAAAA///s2wENAAAAwqD3T20ON+iBMAcAAAAAAAAAAAAAAADAv2oAAAD//+zbAQ0AAADCoPdPbQ436IEwBwAAAAAAAAAAAAAAAMC/agAAAP//7NsBDQAAAMKg909tDjfogTAHAAAAAAAAAAAAAAAAwL9qAAAA///s2wENAAAAwqD3T20ON+iBMAcAAAAAAAAAAAAAAADAv2oAAAD//+zbAQ0AAADCoPdPbQ436IEwBwAAAAAAAAAAAAAAAMC/agAAAP//7NsBDQAAAMKg909tDjfogTAHAAAAAAAAAAAAAAAAwL9qAAAA///s2wENAAAAwqD3T20ON+iBMAcAAAAAAAAAAAAAAADAv2oAAAD//+zbAQ0AAADCoPdPbQ436IEwBwAAAAAAAAAAAAAAAMC/agAAAP//7NsBDQAAAMKg909tDjfogTAHAAAAAAAAAAAAAAAAwL9qAAAA///s2wENAAAAwqD3T20ON+iBMAcAAAAAAAAAAAAAAADAv2oAAAD//+zbAQ0AAADCoPdPbQ436IEwBwAAAAAAAAAAAAAAAMC/agAAAP//7NsBDQAAAMKg909tDjfogTAHAAAAAAAAAAAAAAAAwL9qAAAA///s2wENAAAAwqD3T20ON+iBMAcAAAAAAAAAAAAAAADAv2oAAAD//+zbAQ0AAADCoPdPbQ436IEwBwAAAAAAAAAAAAAAAMC/agAAAP//7NsBDQAAAMKg909tDjfogTAHAAAAAAAAAAAAAAAAwL9qAAAA///s2wENAAAAwqD3T20ON+iBMAcAAAAAAAAAAAAAAADAv2oAAAD//+zbAQ0AAADCoPdPbQ436IEwBwAAAAAAAAAAAAAAAMC/agAAAP//7NsBDQAAAMKg909tDjfogTAHAAAAAAAAAAAAAAAAwL9qAAAA///s2wENAAAAwqD3T20ON+iBMAcAAAAAAAAAAAAAAADAv2oAAAD//+zbAQ0AAADCoPdPbQ436IEwBwAAAAAAAAAAAAAAAMC/agAAAP//7NsBDQAAAMKg909tDjfogTAHAAAAAAAAAAAAAAAAwL9qAAAA///s2wENAAAAwqD3T20ON+iBMAcAAAAAAAAAAAAAAADAv2oAAAD//+zbAQ0AAADCoPdPbQ436IEwBwAAAAAAAAAAAAAAAMC/agAAAP//7NsBDQAAAMKg909tDjfogTAHAAAAAAAAAAAAAAAAwL9qAAAA///s2wENAAAAwqD3T20ON+iBMAcAAAAAAAAAAAAAAADAv2oAAAD//+zbAQ0AAADCoPdPbQ436IEwBwAAAAAAAAAAAAAAAMC/agAAAP//7NsBDQAAAMKg909tDjfogTAHAAAAAAAAAAAAAAAAwL9qAAAA///s2wENAAAAwqD3T20ON+iBMAcAAAAAAAAAAAAAAADAv2oAAAD//+zbAQ0AAADCoPdPbQ436IEwBwAAAAAAAAAAAAAAAMC/agAAAP//7NsBDQAAAMKg909tDjfogTAHAAAAAAAAAAAAAAAAwL9qAAAA///s2wENAAAAwqD3T20ON+iBMAcAAAAAAAAAAAAAAADAv2oAAAD//+zbAQ0AAADCoPdPbQ436IEwBwAAAAAAAAAAAAAAAMC/agAAAP//7NsBDQAAAMKg909tDjfogTAHAAAAAAAAAAAAAAAAwL9qAAAA///s2wENAAAAwqD3T20ON+iBMAcAAAAAAAAAAAAAAADAv2oAAAD//+zbAQ0AAADCoPdPbQ436IEwBwAAAAAAAAAAAAAAAMC/agAAAP//7NsBDQAAAMKg909tDjfogTAHAAAAAAAAAAAAAAAAwL9qAAAA///s2wENAAAAwqD3T20ON+iBMAcAAAAAAAAAAAAAAADAv2oAAAD//+zbAQ0AAADCoPdPbQ436IEwBwAAAAAAAAAAAAAAAMC/agAAAP//7NsBDQAAAMKg909tDjfogTAHAAAAAAAAAAAAAAAAwL9qAAAA///s2wENAAAAwqD3T20ON+iBMAcAAAAAAAAAAAAAAADAv2oAAAD//+zbAQ0AAADCoPdPbQ436IEwBwAAAAAAAAAAAAAAAMC/agAAAP//7NsBDQAAAMKg909tDjfogTAHAAAAAAAAAAAAAAAAwL9qAAAA///s2wENAAAAwqD3T20ON+iBMAcAAAAAAAAAAAAAAADAv2oAAAD//+zbAQ0AAADCoPdPbQ436IEwBwAAAAAAAAAAAAAAAMC/agAAAP//7NsBDQAAAMKg909tDjfogTAHAAAAAAAAAAAAAAAAwL9qAAAA///s2wENAAAAwqD3T20ON+iBMAcAAAAAAAAAAAAAAADAv2oAAAD//+zbAQ0AAADCoPdPbQ436IEwBwAAAAAAAAAAAAAAAMC/agAAAP//7NsBDQAAAMKg909tDjfogTAHAAAAAAAAAAAAAAAAwL9qAAAA///s2wENAAAAwqD3T20ON+iBMAcAAAAAAAAAAAAAAADAv2oAAAD//+zbAQ0AAADCoPdPbQ436IEwBwAAAAAAAAAAAAAAAMC/agAAAP//7NsBDQAAAMKg909tDjfogTAHAAAAAAAAAAAAAAAAwL9qAAAA///s2wENAAAAwqD3T20ON+iBMAcAAAAAAAAAAAAAAADAv2oAAAD//+zbAQ0AAADCoPdPbQ436IEwBwAAAAAAAAAAAAAAAMC/agAAAP//7NsBDQAAAMKg909tDjfogTAHAAAAAAAAAAAAAAAAwL9qAAAA///s2wENAAAAwqD3T20ON+iBMAcAAAAAAAAAAAAAAADAv2oAAAD//+zbAQ0AAADCoPdPbQ436IEwBwAAAAAAAAAAAAAAAMC/agAAAP//7NsBDQAAAMKg909tDjfogTAHAAAAAAAAAAAAAAAAwL9qAAAA///s2wENAAAAwqD3T20ON+iBMAcAAAAAAAAAAAAAAADAv2oAAAD//+zbAQ0AAADCoPdPbQ436IEwBwAAAAAAAAAAAAAAAMC/agAAAP//7NsBDQAAAMKg909tDjfogTAHAAAAAAAAAAAAAAAAwL9qAAAA///s2wENAAAAwqD3T20ON+iBMAcAAAAAAAAAAAAAAADAv2oAAAD//+zbAQ0AAADCoPdPbQ436IEwBwAAAAAAAAAAAAAAAMC/agAAAP//7NsBDQAAAMKg909tDjfogTAHAAAAAAAAAAAAAAAAwL9qAAAA///s2wENAAAAwqD3T20ON+iBMAcAAAAAAAAAAAAAAADAv2oAAAD//+zbAQ0AAADCoPdPbQ436IEwBwAAAAAAAAAAAAAAAMC/agAAAP//7NsBDQAAAMKg909tDjfogTAHAAAAAAAAAAAAAAAAwL9qAAAA///s2wENAAAAwqD3T20ON+iBMAcAAAAAAAAAAAAAAADAv2oAAAD//+zbAQ0AAADCoPdPbQ436IEwBwAAAAAAAAAAAAAAAMC/agAAAP//7NsBDQAAAMKg909tDjfogTAHAAAAAAAAAAAAAAAAwL9qAAAA///s2wENAAAAwqD3T20ON+iBMAcAAAAAAAAAAAAAAADAv2oAAAD//+zbAQ0AAADCoPdPbQ436IEwBwAAAAAAAAAAAAAAAMC/agAAAP//7NsBDQAAAMKg909tDjfogTAHAAAAAAAAAAAAAAAAwL9qAAAA///s2wENAAAAwqD3T20ON+iBMAcAAAAAAAAAAAAAAADAv2oAAAD//+zbAQ0AAADCoPdPbQ436IEwBwAAAAAAAAAAAAAAAMC/agAAAP//7NsBDQAAAMKg909tDjfogTAHAAAAAAAAAAAAAAAAwL9qAAAA///s2wENAAAAwqD3T20ON+iBMAcAAAAAAAAAAAAAAADAv2oAAAD//+zbAQ0AAADCoPdPbQ436IEwBwAAAAAAAAAAAAAAAMC/agAAAP//7NsBDQAAAMKg909tDjfogTAHAAAAAAAAAAAAAAAAwL9qAAAA///s2wENAAAAwqD3T20ON+iBMAcAAAAAAAAAAAAAAADAv2oAAAD//+zbAQ0AAADCoPdPbQ436IEwBwAAAAAAAAAAAAAAAMC/agAAAP//7NsBDQAAAMKg909tDjfogTAHAAAAAAAAAAAAAAAAwL9qAAAA///s2wENAAAAwqD3T20ON+iBMAcAAAAAAAAAAAAAAADAv2oAAAD//+zbAQ0AAADCoPdPbQ436IEwBwAAAAAAAAAAAAAAAMC/agAAAP//7NsBDQAAAMKg909tDjfogTAHAAAAAAAAAAAAAAAAwL9qAAAA///s2wENAAAAwqD3T20ON+iBMAcAAAAAAAAAAAAAAADAv2oAAAD//+zbAQ0AAADCoPdPbQ436IEwBwAAAAAAAAAAAAAAAMC/agAAAP//7NsBDQAAAMKg909tDjfogTAHAAAAAAAAAAAAAAAAwL9qAAAA///s2wENAAAAwqD3T20ON+iBMAcAAAAAAAAAAAAAAADAv2oAAAD//+zbAQ0AAADCoPdPbQ436IEwBwAAAAAAAAAAAAAAAMC/agAAAP//7NsBDQAAAMKg909tDjfogTAHAAAAAAAAAAAAAAAAwL9qAAAA///s2wENAAAAwqD3T20ON+iBMAcAAAAAAAAAAAAAAADAv2oAAAD//+zbAQ0AAADCoPdPbQ436IEwBwAAAAAAAAAAAAAAAMC/agAAAP//7NsBDQAAAMKg909tDjfogTAHAAAAAAAAAAAAAAAAwL9qAAAA///s2wENAAAAwqD3T20ON+iBMAcAAAAAAAAAAAAAAADAv2oAAAD//+zbAQ0AAADCoPdPbQ436IEwBwAAAAAAAAAAAAAAAMC/agAAAP//7NsBDQAAAMKg909tDjfogTAHAAAAAAAAAAAAAAAAwL9qAAAA///s2wENAAAAwqD3T20ON+iBMAcAAAAAAAAAAAAAAADAv2oAAAD//+zbAQ0AAADCoPdPbQ436IEwBwAAAAAAAAAAAAAAAMC/agAAAP//7NsBDQAAAMKg909tDjfogTAHAAAAAAAAAAAAAAAAwL9qAAAA///s2wENAAAAwqD3T20ON+iBMAcAAAAAAAAAAAAAAADAv2oAAAD//+zbAQ0AAADCoPdPbQ436IEwBwAAAAAAAAAAAAAAAMC/agAAAP//7NsBDQAAAMKg909tDjfogTAHAAAAAAAAAAAAAAAAwL9qAAAA///s2wENAAAAwqD3T20ON+iBMAcAAAAAAAAAAAAAAADAv2oAAAD//+zbAQ0AAADCoPdPbQ436IEwBwAAAAAAAAAAAAAAAMC/agAAAP//7NsBDQAAAMKg909tDjfogTAHAAAAAAAAAAAAAAAAwL9qAAAA///s2wENAAAAwqD3T20ON+iBMAcAAAAAAAAAAAAAAADAv2oAAAD//+zbAQ0AAADCoPdPbQ436IEwBwAAAAAAAAAAAAAAAMC/agAAAP//7NsBDQAAAMKg909tDjfogTAHAAAAAAAAAAAAAAAAwL9qAAAA///s2wENAAAAwqD3T20ON+iBMAcAAAAAAAAAAAAAAADAv2oAAAD//+zbAQ0AAADCoPdPbQ436IEwBwAAAAAAAAAAAAAAAMC/agAAAP//7NsBDQAAAMKg909tDjfogTAHAAAAAAAAAAAAAAAAwL9qAAAA///s2wENAAAAwqD3T20ON+iBMAcAAAAAAAAAAAAAAADAv2oAAAD//+zbAQ0AAADCoPdPbQ436IEwBwAAAAAAAAAAAAAAAMC/agAAAP//7NsBDQAAAMKg909tDjfogTAHAAAAAAAAAAAAAAAAwL9qAAAA///s2wENAAAAwqD3T20ON+iBMAcAAAAAAAAAAAAAAADAv2oAAAD//+zbAQ0AAADCoPdPbQ436IEwBwAAAAAAAAAAAAAAAMC/agAAAP//7NsBDQAAAMKg909tDjfogTAHAAAAAAAAAAAAAAAAwL9qAAAA///s2wENAAAAwqD3T20ON+iBMAcAAAAAAAAAAAAAAADAv2oAAAD//+zbAQ0AAADCoPdPbQ436IEwBwAAAAAAAAAAAAAAAMC/agAAAP//7NsBDQAAAMKg909tDjfogTAHAAAAAAAAAAAAAAAAwL9qAAAA///s2wENAAAAwqD3T20ON+iBMAcAAAAAAAAAAAAAAADAv2oAAAD//+zbAQ0AAADCoPdPbQ436IEwBwAAAAAAAAAAAAAAAMC/agAAAP//7NsBDQAAAMKg909tDjfogTAHAAAAAAAAAAAAAAAAwL9qAAAA///s2wENAAAAwqD3T20ON+iBMAcAAAAAAAAAAAAAAADAv2oAAAD//+zbAQ0AAADCoPdPbQ436IEwBwAAAAAAAAAAAAAAAMC/agAAAP//7NsBDQAAAMKg909tDjfogTAHAAAAAAAAAAAAAAAAwL9qAAAA///s2wENAAAAwqD3T20ON+iBMAcAAAAAAAAAAAAAAADAv2oAAAD//+zbAQ0AAADCoPdPbQ436IEwBwAAAAAAAAAAAAAAAMC/agAAAP//7NsBDQAAAMKg909tDjfogTAHAAAAAAAAAAAAAAAAwL9qAAAA///s2wENAAAAwqD3T20ON+iBMAcAAAAAAAAAAAAAAADAv2oAAAD//+zbAQ0AAADCoPdPbQ436IEwBwAAAAAAAAAAAAAAAMC/agAAAP//7NsBDQAAAMKg909tDjfogTAHAAAAAAAAAAAAAAAAwL9qAAAA///s2wENAAAAwqD3T20ON+iBMAcAAAAAAAAAAAAAAADAv2oAAAD//+zbAQ0AAADCoPdPbQ436IEwBwAAAAAAAAAAAAAAAMC/agAAAP//7NsBDQAAAMKg909tDjfogTAHAAAAAAAAAAAAAAAAwL9qAAAA///s2wENAAAAwqD3T20ON+iBMAcAAAAAAAAAAAAAAADAv2oAAAD//+zbAQ0AAADCoPdPbQ436IEwBwAAAAAAAAAAAAAAAMC/agAAAP//7NsBDQAAAMKg909tDjfogTAHAAAAAAAAAAAAAAAAwL9qAAAA///s2wENAAAAwqD3T20ON+iBMAcAAAAAAAAAAAAAAADAv2oAAAD//+zbAQ0AAADCoPdPbQ436IEwBwAAAAAAAAAAAAAAAMC/agAAAP//7NsBDQAAAMKg909tDjfogTAHAAAAAAAAAAAAAAAAwL9qAAAA///s2wENAAAAwqD3T20ON+iBMAcAAAAAAAAAAAAAAADAv2oAAAD//+zbAQ0AAADCoPdPbQ436IEwBwAAAAAAAAAAAAAAAMC/agAAAP//7NsBDQAAAMKg909tDjfogTAHAAAAAAAAAAAAAAAAwL9qAAAA///s2wENAAAAwqD3T20ON+iBMAcAAAAAAAAAAAAAAADAv2oAAAD//+zbAQ0AAADCoPdPbQ436IEwBwAAAAAAAAAAAAAAAMC/agAAAP//7NsBDQAAAMKg909tDjfogTAHAAAAAAAAAAAAAAAAwL9qAAAA///s2wENAAAAwqD3T20ON+iBMAcAAAAAAAAAAAAAAADAv2oAAAD//+zbAQ0AAADCoPdPbQ436IEwBwAAAAAAAAAAAAAAAMC/agAAAP//7NsBDQAAAMKg909tDjfogTAHAAAAAAAAAAAAAAAAwL9qAAAA///s2wENAAAAwqD3T20ON+iBMAcAAAAAAAAAAAAAAADAv2oAAAD//+zbAQ0AAADCoPdPbQ436IEwBwAAAAAAAAAAAAAAAMC/agAAAP//7NsBDQAAAMKg909tDjfogTAHAAAAAAAAAAAAAAAAwL9qAAAA///s2wENAAAAwqD3T20ON+iBMAcAAAAAAAAAAAAAAADAv2oAAAD//+zbAQ0AAADCoPdPbQ436IEwBwAAAAAAAAAAAAAAAMC/agAAAP//7NsBDQAAAMKg909tDjfogTAHAAAAAAAAAAAAAAAAwL9qAAAA///s2wENAAAAwqD3T20ON+iBMAcAAAAAAAAAAAAAAADAv2oAAAD//+zbAQ0AAADCoPdPbQ436IEwBwAAAAAAAAAAAAAAAMC/agAAAP//7NsBDQAAAMKg909tDjfogTAHAAAAAAAAAAAAAAAAwL9qAAAA///s2wENAAAAwqD3T20ON+iBMAcAAAAAAAAAAAAAAADAv2oAAAD//+zbAQ0AAADCoPdPbQ436IEwBwAAAAAAAAAAAAAAAMC/agAAAP//7NsBDQAAAMKg909tDjfogTAHAAAAAAAAAAAAAAAAwL9qAAAA///s2wENAAAAwqD3T20ON+iBMAcAAAAAAAAAAAAAAADAv2oAAAD//+zbAQ0AAADCoPdPbQ436IEwBwAAAAAAAAAAAAAAAMC/agAAAP//7NsBDQAAAMKg909tDjfogTAHAAAAAAAAAAAAAAAAwL9qAAAA///s2wENAAAAwqD3T20ON+iBMAcAAAAAAAAAAAAAAADAv2oAAAD//+zbAQ0AAADCoPdPbQ436IEwBwAAAAAAAAAAAAAAAMC/agAAAP//7NsBDQAAAMKg909tDjfogTAHAAAAAAAAAAAAAAAAwL9qAAAA///s2wENAAAAwqD3T20ON+iBMAcAAAAAAAAAAAAAAADAv2oAAAD//+zbAQ0AAADCoPdPbQ436IEwB+z+C0gAACAASURBVAAAAAAAAAAAAAAAAMC/auzbAQ0AAADCoPdPbQ436IEwBwAAAAAAAAAAAAAAAMC/agAAAP//7NsBDQAAAMKg909tDjfogTAHAAAAAAAAAAAAAAAAwL9qAAAA///s2wENAAAAwqD3T20ON+iBMAcAAAAAAAAAAAAAAADAv2oAAAD//+zbAQ0AAADCoPdPbQ436IEwBwAAAAAAAAAAAAAAAMC/agAAAP//7NsBDQAAAMKg909tDjfogTAHAAAAAAAAAAAAAAAAwL9qAAAA///s2wENAAAAwqD3T20ON+iBMAcAAAAAAAAAAAAAAADAv2oAAAD//+zbAQ0AAADCoPdPbQ436IEwBwAAAAAAAAAAAAAAAMC/agAAAP//7NsBDQAAAMKg909tDjfogTAHAAAAAAAAAAAAAAAAwL9qAAAA///s2wENAAAAwqD3T20ON+iBMAcAAAAAAAAAAAAAAADAv2oAAAD//+zbAQ0AAADCoPdPbQ436IEwBwAAAAAAAAAAAAAAAMC/agAAAP//7NsBDQAAAMKg909tDjfogTAHAAAAAAAAAAAAAAAAwL9qAAAA///s2wENAAAAwqD3T20ON+iBMAcAAAAAAAAAAAAAAADAv2oAAAD//+zbAQ0AAADCoPdPbQ436IEwBwAAAAAAAAAAAAAAAMC/agAAAP//7NsBDQAAAMKg909tDjfogTAHAAAAAAAAAAAAAAAAwL9qAAAA///s2wENAAAAwqD3T20ON+iBMAcAAAAAAAAAAAAAAADAv2oAAAD//+zbAQ0AAADCoPdPbQ436IEwBwAAAAAAAAAAAAAAAMC/agAAAP//7NsBDQAAAMKg909tDjfogTAHAAAAAAAAAAAAAAAAwL9qAAAA///s2wENAAAAwqD3T20ON+iBMAcAAAAAAAAAAAAAAADAv2oAAAD//+zbAQ0AAADCoPdPbQ436IEwBwAAAAAAAAAAAAAAAMC/agAAAP//7NsBDQAAAMKg909tDjfogTAHAAAAAAAAAAAAAAAAwL9qAAAA///s2wENAAAAwqD3T20ON+iBMAcAAAAAAAAAAAAAAADAv2oAAAD//+zbAQ0AAADCoPdPbQ436IEwBwAAAAAAAAAAAAAAAMC/agAAAP//7NsBDQAAAMKg909tDjfogTAHAAAAAAAAAAAAAAAAwL9qAAAA///s2wENAAAAwqD3T20ON+iBMAcAAAAAAAAAAAAAAADAv2oAAAD//+zbAQ0AAADCoPdPbQ436IEwBwAAAAAAAAAAAAAAAMC/agAAAP//7NsBDQAAAMKg909tDjfogTAHAAAAAAAAAAAAAAAAwL9qAAAA///s2wENAAAAwqD3T20ON+iBMAcAAAAAAAAAAAAAAADAv2oAAAD//+zbAQ0AAADCoPdPbQ436IEwBwAAAAAAAAAAAAAAAMC/agAAAP//7NsBDQAAAMKg909tDjfogTAHAAAAAAAAAAAAAAAAwL9qAAAA///s2wENAAAAwqD3T20ON+iBMAcAAAAAAAAAAAAAAADAv2oAAAD//+zbAQ0AAADCoPdPbQ436IEwBwAAAAAAAAAAAAAAAMC/agAAAP//7NsBDQAAAMKg909tDjfogTAHAAAAAAAAAAAAAAAAwL9qAAAA///s2wENAAAAwqD3T20ON+iBMAcAAAAAAAAAAAAAAADAv2oAAAD//+zbAQ0AAADCoPdPbQ436IEwBwAAAAAAAAAAAAAAAMC/agAAAP//7NsBDQAAAMKg909tDjfogTAHAAAAAAAAAAAAAAAAwL9qAAAA///s2wENAAAAwqD3T20ON+iBMAcAAAAAAAAAAAAAAADAv2oAAAD//+zbAQ0AAADCoPdPbQ436IEwBwAAAAAAAAAAAAAAAMC/agAAAP//7NsBDQAAAMKg909tDjfogTAHAAAAAAAAAAAAAAAAwL9qAAAA///s2wENAAAAwqD3T20ON+iBMAcAAAAAAAAAAAAAAADAv2oAAAD//+zbAQ0AAADCoPdPbQ436IEwBwAAAAAAAAAAAAAAAMC/agAAAP//7NsBDQAAAMKg909tDjfogTAHAAAAAAAAAAAAAAAAwL9qAAAA///s2wENAAAAwqD3T20ON+iBMAcAAAAAAAAAAAAAAADAv2oAAAD//+zbAQ0AAADCoPdPbQ436IEwBwAAAAAAAAAAAAAAAMC/agAAAP//7NsBDQAAAMKg909tDjfogTAHAAAAAAAAAAAAAAAAwL9qAAAA///s2wENAAAAwqD3T20ON+iBMAcAAAAAAAAAAAAAAADAv2oAAAD//+zbAQ0AAADCoPdPbQ436IEwBwAAAAAAAAAAAAAAAMC/agAAAP//7NsBDQAAAMKg909tDjfogTAHAAAAAAAAAAAAAAAAwL9qAAAA///s2wENAAAAwqD3T20ON+iBMAcAAAAAAAAAAAAAAADAv2oAAAD//+zbAQ0AAADCoPdPbQ436IEwBwAAAAAAAAAAAAAAAMC/agAAAP//7NsBDQAAAMKg909tDjfogTAHAAAAAAAAAAAAAAAAwL9qAAAA///s2wENAAAAwqD3T20ON+iBMAcAAAAAAAAAAAAAAADAv2oAAAD//+zbAQ0AAADCoPdPbQ436IEwBwAAAAAAAAAAAAAAAMC/agAAAP//7NsBDQAAAMKg909tDjfogTAHAAAAAAAAAAAAAAAAwL9qAAAA///s2wENAAAAwqD3T20ON+iBMAcAAAAAAAAAAAAAAADAv2oAAAD//+zbAQ0AAADCoPdPbQ436IEwBwAAAAAAAAAAAAAAAMC/agAAAP//7NsBDQAAAMKg909tDjfogTAHAAAAAAAAAAAAAAAAwL9qAAAA///s2wENAAAAwqD3T20ON+iBMAcAAAAAAAAAAAAAAADAv2oAAAD//+zbAQ0AAADCoPdPbQ436IEwBwAAAAAAAAAAAAAAAMC/agAAAP//7NsBDQAAAMKg909tDjfogTAHAAAAAAAAAAAAAAAAwL9qAAAA///s2wENAAAAwqD3T20ON+iBMAcAAAAAAAAAAAAAAADAv2oAAAD//+zbAQ0AAADCoPdPbQ436IEwBwAAAAAAAAAAAAAAAMC/agAAAP//7NsBDQAAAMKg909tDjfogTAHAAAAAAAAAAAAAAAAwL9qAAAA///s2wENAAAAwqD3T20ON+iBMAcAAAAAAAAAAAAAAADAv2oAAAD//+zbAQ0AAADCoPdPbQ436IEwBwAAAAAAAAAAAAAAAMC/agAAAP//7NsBDQAAAMKg909tDjfogTAHAAAAAAAAAAAAAAAAwL9qAAAA///s2wENAAAAwqD3T20ON+iBMAcAAAAAAAAAAAAAAADAv2oAAAD//+zbAQ0AAADCoPdPbQ436IEwBwAAAAAAAAAAAAAAAMC/agAAAP//7NsBDQAAAMKg909tDjfogTAHAAAAAAAAAAAAAAAAwL9qAAAA///s2wENAAAAwqD3T20ON+iBMAcAAAAAAAAAAAAAAADAv2oAAAD//+zbAQ0AAADCoPdPbQ436IEwBwAAAAAAAAAAAAAAAMC/agAAAP//7NsBDQAAAMKg909tDjfogTAHAAAAAAAAAAAAAAAAwL9qAAAA///s2wENAAAAwqD3T20ON+iBMAcAAAAAAAAAAAAAAADAv2oAAAD//+zbAQ0AAADCoPdPbQ436IEwBwAAAAAAAAAAAAAAAMC/agAAAP//7NsBDQAAAMKg909tDjfogTAHAAAAAAAAAAAAAAAAwL9qAAAA///s2wENAAAAwqD3T20ON+iBMAcAAAAAAAAAAAAAAADAv2oAAAD//+zbAQ0AAADCoPdPbQ436IEwBwAAAAAAAAAAAAAAAMC/agAAAP//7NsBDQAAAMKg909tDjfogTAHAAAAAAAAAAAAAAAAwL9qAAAA///s2wENAAAAwqD3T20ON+iBMAcAAAAAAAAAAAAAAADAv2oAAAD//+zbAQ0AAADCoPdPbQ436IEwBwAAAAAAAAAAAAAAAMC/agAAAP//7NsBDQAAAMKg909tDjfogTAHAAAAAAAAAAAAAAAAwL9qAAAA///s2wENAAAAwqD3T20ON+iBMAcAAAAAAAAAAAAAAADAv2oAAAD//+zbAQ0AAADCoPdPbQ436IEwBwAAAAAAAAAAAAAAAMC/agAAAP//7NsBDQAAAMKg909tDjfogTAHAAAAAAAAAAAAAAAAwL9qAAAA///s2wENAAAAwqD3T20ON+iBMAcAAAAAAAAAAAAAAADAv2oAAAD//+zbAQ0AAADCoPdPbQ436IEwBwAAAAAAAAAAAAAAAMC/agAAAP//7NsBDQAAAMKg909tDjfogTAHAAAAAAAAAAAAAAAAwL9qAAAA///s2wENAAAAwqD3T20ON+iBMAcAAAAAAAAAAAAAAADAv2oAAAD//+zbAQ0AAADCoPdPbQ436IEwBwAAAAAAAAAAAAAAAMC/agAAAP//7NsBDQAAAMKg909tDjfogTAHAAAAAAAAAAAAAAAAwL9qAAAA///s2wENAAAAwqD3T20ON+iBMAcAAAAAAAAAAAAAAADAv2oAAAD//+zbAQ0AAADCoPdPbQ436IEwBwAAAAAAAAAAAAAAAMC/agAAAP//7NsBDQAAAMKg909tDjfogTAHAAAAAAAAAAAAAAAAwL9qAAAA///s2wENAAAAwqD3T20ON+iBMAcAAAAAAAAAAAAAAADAv2oAAAD//+zbAQ0AAADCoPdPbQ436IEwBwAAAAAAAAAAAAAAAMC/agAAAP//7NsBDQAAAMKg909tDjfogTAHAAAAAAAAAAAAAAAAwL9qAAAA///s2wENAAAAwqD3T20ON+iBMAcAAAAAAAAAAAAAAADAv2oAAAD//+zbAQ0AAADCoPdPbQ436IEwBwAAAAAAAAAAAAAAAMC/agAAAP//7NsBDQAAAMKg909tDjfogTAHAAAAAAAAAAAAAAAAwL9qAAAA///s2wENAAAAwqD3T20ON+iBMAcAAAAAAAAAAAAAAADAv2oAAAD//+zbAQ0AAADCoPdPbQ436IEwBwAAAAAAAAAAAAAAAMC/agAAAP//7NsBDQAAAMKg909tDjfogTAHAAAAAAAAAAAAAAAAwL9qAAAA///s2wENAAAAwqD3T20ON+iBMAcAAAAAAAAAAAAAAADAv2oAAAD//+zbAQ0AAADCoPdPbQ436IEwBwAAAAAAAAAAAAAAAMC/agAAAP//7NsBDQAAAMKg909tDjfogTAHAAAAAAAAAAAAAAAAwL9qAAAA///s2wENAAAAwqD3T20ON+iBMAcAAAAAAAAAAAAAAADAv2oAAAD//+zbAQ0AAADCoPdPbQ436IEwBwAAAAAAAAAAAAAAAMC/agAAAP//7NsBDQAAAMKg909tDjfogTAHAAAAAAAAAAAAAAAAwL9qAAAA///s2wENAAAAwqD3T20ON+iBMAcAAAAAAAAAAAAAAADAv2oAAAD//+zbAQ0AAADCoPdPbQ436IEwBwAAAAAAAAAAAAAAAMC/agAAAP//7NsBDQAAAMKg909tDjfogTAHAAAAAAAAAAAAAAAAwL9qAAAA///s2wENAAAAwqD3T20ON+iBMAcAAAAAAAAAAAAAAADAv2oAAAD//+zbAQ0AAADCoPdPbQ436IEwBwAAAAAAAAAAAAAAAMC/agAAAP//7NsBDQAAAMKg909tDjfogTAHAAAAAAAAAAAAAAAAwL9qAAAA///s2wENAAAAwqD3T20ON+iBMAcAAAAAAAAAAAAAAADAv2oAAAD//+zbAQ0AAADCoPdPbQ436IEwBwAAAAAAAAAAAAAAAMC/agAAAP//7NsBDQAAAMKg909tDjfogTAHAAAAAAAAAAAAAAAAwL9qAAAA///s2wENAAAAwqD3T20ON+iBMAcAAAAAAAAAAAAAAADAv2oAAAD//+zbAQ0AAADCoPdPbQ436IEwBwAAAAAAAAAAAAAAAMC/agAAAP//7NsBDQAAAMKg909tDjfogTAHAAAAAAAAAAAAAAAAwL9qAAAA///s2wENAAAAwqD3T20ON+iBMAcAAAAAAAAAAAAAAADAv2oAAAD//+zbAQ0AAADCoPdPbQ436IEwBwAAAAAAAAAAAAAAAMC/agAAAP//7NsBDQAAAMKg909tDjfogTAHAAAAAAAAAAAAAAAAwL9qAAAA///s2wENAAAAwqD3T20ON+iBMAcAAAAAAAAAAAAAAADAv2oAAAD//+zbAQ0AAADCoPdPbQ436IEwBwAAAAAAAAAAAAAAAMC/agAAAP//7NsBDQAAAMKg909tDjfogTAHAAAAAAAAAAAAAAAAwL9qAAAA///s2wENAAAAwqD3T20ON+iBMAcAAAAAAAAAAAAAAADAv2oAAAD//+zbAQ0AAADCoPdPbQ436IEwBwAAAAAAAAAAAAAAAMC/agAAAP//7NsBDQAAAMKg909tDjfogTAHAAAAAAAAAAAAAAAAwL9qAAAA///s2wENAAAAwqD3T20ON+iBMAcAAAAAAAAAAAAAAADAv2oAAAD//+zbAQ0AAADCoPdPbQ436IEwBwAAAAAAAAAAAAAAAMC/agAAAP//7NsBDQAAAMKg909tDjfogTAHAAAAAAAAAAAAAAAAwL9qAAAA///s2wENAAAAwqD3T20ON+iBMAcAAAAAAAAAAAAAAADAv2oAAAD//+zbAQ0AAADCoPdPbQ436IEwBwAAAAAAAAAAAAAAAMC/agAAAP//7NsBDQAAAMKg909tDjfogTAHAAAAAAAAAAAAAAAAwL9qAAAA///s2wENAAAAwqD3T20ON+iBMAcAAAAAAAAAAAAAAADAv2oAAAD//+zbAQ0AAADCoPdPbQ436IEwBwAAAAAAAAAAAAAAAMC/agAAAP//7NsBDQAAAMKg909tDjfogTAHAAAAAAAAAAAAAAAAwL9qAAAA///s2wENAAAAwqD3T20ON+iBMAcAAAAAAAAAAAAAAADAv2oAAAD//+zbAQ0AAADCoPdPbQ436IEwBwAAAAAAAAAAAAAAAMC/agAAAP//7NsBDQAAAMKg909tDjfogTAHAAAAAAAAAAAAAAAAwL9qAAAA///s2wENAAAAwqD3T20ON+iBMAcAAAAAAAAAAAAAAADAv2oAAAD//+zbAQ0AAADCoPdPbQ436IEwBwAAAAAAAAAAAAAAAMC/agAAAP//7NsBDQAAAMKg909tDjfogTAHAAAAAAAAAAAAAAAAwL9qAAAA///s2wENAAAAwqD3T20ON+iBMAcAAAAAAAAAAAAAAADAv2oAAAD//+zbAQ0AAADCoPdPbQ436IEwBwAAAAAAAAAAAAAAAMC/agAAAP//7NsBDQAAAMKg909tDjfogTAHAAAAAAAAAAAAAAAAwL9qAAAA///s2wENAAAAwqD3T20ON+iBMAcAAAAAAAAAAAAAAADAv2oAAAD//+zbAQ0AAADCoPdPbQ436IEwBwAAAAAAAAAAAAAAAMC/agAAAP//7NsBDQAAAMKg909tDjfogTAHAAAAAAAAAAAAAAAAwL9qAAAA///s2wENAAAAwqD3T20ON+iBMAcAAAAAAAAAAAAAAADAv2oAAAD//+zbAQ0AAADCoPdPbQ436IEwBwAAAAAAAAAAAAAAAMC/agAAAP//7NsBDQAAAMKg909tDjfogTAHAAAAAAAAAAAAAAAAwL9qAAAA///s2wENAAAAwqD3T20ON+iBMAcAAAAAAAAAAAAAAADAv2oAAAD//+zbAQ0AAADCoPdPbQ436IEwBwAAAAAAAAAAAAAAAMC/agAAAP//7NsBDQAAAMKg909tDjfogTAHAAAAAAAAAAAAAAAAwL9qAAAA///s2wENAAAAwqD3T20ON+iBMAcAAAAAAAAAAAAAAADAv2oAAAD//+zbAQ0AAADCoPdPbQ436IEwBwAAAAAAAAAAAAAAAMC/agAAAP//7NsBDQAAAMKg909tDjfogTAHAAAAAAAAAAAAAAAAwL9qAAAA///s2wENAAAAwqD3T20ON+iBMAcAAAAAAAAAAAAAAADAv2oAAAD//+zbAQ0AAADCoPdPbQ436IEwBwAAAAAAAAAAAAAAAMC/agAAAP//7NsBDQAAAMKg909tDjfogTAHAAAAAAAAAAAAAAAAwL9qAAAA///s2wENAAAAwqD3T20ON+iBMAcAAAAAAAAAAAAAAADAv2oAAAD//+zbAQ0AAADCoPdPbQ436IEwBwAAAAAAAAAAAAAAAMC/agAAAP//7NsBDQAAAMKg909tDjfogTAHAAAAAAAAAAAAAAAAwL9qAAAA///s2wENAAAAwqD3T20ON+iBMAcAAAAAAAAAAAAAAADAv2oAAAD//+zbAQ0AAADCoPdPbQ436IEwBwAAAAAAAAAAAAAAAMC/agAAAP//7NsBDQAAAMKg909tDjfogTAHAAAAAAAAAAAAAAAAwL9qAAAA///s2wENAAAAwqD3T20ON+iBMAcAAAAAAAAAAAAAAADAv2oAAAD//+zbAQ0AAADCoPdPbQ436IEwBwAAAAAAAAAAAAAAAMC/agAAAP//7NsBDQAAAMKg909tDjfogTAHAAAAAAAAAAAAAAAAwL9qAAAA///s2wENAAAAwqD3T20ON+iBMAcAAAAAAAAAAAAAAADAv2oAAAD//+zbAQ0AAADCoPdPbQ436IEwBwAAAAAAAAAAAAAAAMC/agAAAP//7NsBDQAAAMKg909tDjfogTAHAAAAAAAAAAAAAAAAwL9qAAAA///s2wENAAAAwqD3T20ON+iBMAcAAAAAAAAAAAAAAADAv2oAAAD//+zbAQ0AAADCoPdPbQ436IEwBwAAAAAAAAAAAAAAAMC/agAAAP//7NsBDQAAAMKg909tDjfogTAHAAAAAAAAAAAAAAAAwL9qAAAA///s2wENAAAAwqD3T20ON+iBMAcAAAAAAAAAAAAAAADAv2oAAAD//+zbAQ0AAADCoPdPbQ436IEwBwAAAAAAAAAAAAAAAMC/agAAAP//7NsBDQAAAMKg909tDjfogTAHAAAAAAAAAAAAAAAAwL9qAAAA///s2wENAAAAwqD3T20ON+iBMAcAAAAAAAAAAAAAAADAv2oAAAD//+zbAQ0AAADCoPdPbQ436IEwBwAAAAAAAAAAAAAAAMC/agAAAP//7NsBDQAAAMKg909tDjfogTAHAAAAAAAAAAAAAAAAwL9qAAAA///s2wENAAAAwqD3T20ON+iBMAcAAAAAAAAAAAAAAADAv2oAAAD//+zbAQ0AAADCoPdPbQ436IEwBwAAAAAAAAAAAAAAAMC/agAAAP//7NsBDQAAAMKg909tDjfogTAHAAAAAAAAAAAAAAAAwL9qAAAA///s2wENAAAAwqD3T20ON+iBMAcAAAAAAAAAAAAAAADAv2oAAAD//+zbAQ0AAADCoPdPbQ436IEwBwAAAAAAAAAAAAAAAMC/agAAAP//7NsBDQAAAMKg909tDjfogTAHAAAAAAAAAAAAAAAAwL9qAAAA///s2wENAAAAwqD3T20ON+iBMAcAAAAAAAAAAAAAAADAv2oAAAD//+zbAQ0AAADCoPdPbQ436IEwBwAAAAAAAAAAAAAAAMC/agAAAP//7NsBDQAAAMKg909tDjfogTAHAAAAAAAAAAAAAAAAwL9qAAAA///s2wENAAAAwqD3T20ON+iBMAcAAAAAAAAAAAAAAADAv2oAAAD//+zbAQ0AAADCoPdPbQ436IEwBwAAAAAAAAAAAAAAAMC/agAAAP//7NsBDQAAAMKg909tDjfogTAHAAAAAAAAAAAAAAAAwL9qAAAA///s2wENAAAAwqD3T20ON+iBMAcAAAAAAAAAAAAAAADAv2oAAAD//+zbAQ0AAADCoPdPbQ436IEwBwAAAAAAAAAAAAAAAMC/agAAAP//7NsBDQAAAMKg909tDjfogTAHAAAAAAAAAAAAAAAAwL9qAAAA///s2wENAAAAwqD3T20ON+iBMAcAAAAAAAAAAAAAAADAv2oAAAD//+zbAQ0AAADCoPdPbQ436IEwBwAAAAAAAAAAAAAAAMC/agAAAP//7NsBDQAAAMKg909tDjfogTAHAAAAAAAAAAAAAAAAwL9qAAAA///s2wENAAAAwqD3T20ON+iBMAcAAAAAAAAAAAAAAADAv2oAAAD//+zbAQ0AAADCoPdPbQ436IEwBwAAAAAAAAAAAAAAAMC/agAAAP//7NsBDQAAAMKg909tDjfogTAHAAAAAAAAAAAAAAAAwL9qAAAA///s2wENAAAAwqD3T20ON+iBMAcAAAAAAAAAAAAAAADAv2oAAAD//+zbAQ0AAADCoPdPbQ436IEwBwAAAAAAAAAAAAAAAMC/agAAAP//7NsBDQAAAMKg909tDjfogTAHAAAAAAAAAAAAAAAAwL9qAAAA///s2wENAAAAwqD3T20ON+iBMAcAAAAAAAAAAAAAAADAv2oAAAD//+zbAQ0AAADCoPdPbQ436IEwBwAAAAAAAAAAAAAAAMC/agAAAP//7NsBDQAAAMKg909tDjfogTAHAAAAAAAAAAAAAAAAwL9qAAAA///s2wENAAAAwqD3T20ON+iBMAcAAAAAAAAAAAAAAADAv2oAAAD//+zbAQ0AAADCoPdPbQ436IEwBwAAAAAAAAAAAAAAAMC/agAAAP//7NsBDQAAAMKg909tDjfogTAHAAAAAAAAAAAAAAAAwL9qAAAA///s2wENAAAAwqD3T20ON+iBMAcAAAAAAAAAAAAAAADAv2oAAAD//+zbAQ0AAADCoPdPbQ436IEwBwAAAAAAAAAAAAAAAMC/agAAAP//7NsBDQAAAMKg909tDjfogTAHAAAAAAAAAAAAAAAAwL9qAAAA///s2wENAAAAl60OXQAAIABJREFUwqD3T20ON+iBMAcAAAAAAAAAAAAAAADAv2rs2wENAAAAwqD3T20ON+iBMAcAAAAAAAAAAAAAAADAv2oAAAD//+zbAQ0AAADCoPdPbQ436IEwBwAAAAAAAAAAAAAAAMC/agAAAP//7NsBDQAAAMKg909tDjfogTAHAAAAAAAAAAAAAAAAwL9qAAAA///s2wENAAAAwqD3T20ON+iBMAcAAAAAAAAAAAAAAADAv2oAAAD//+zbAQ0AAADCoPdPbQ436IEwBwAAAAAAAAAAAAAAAMC/agAAAP//7NsBDQAAAMKg909tDjfogTAHAAAAAAAAAAAAAAAAwL9qAAAA///s2wENAAAAwqD3T20ON+iBMAcAAAAAAAAAAAAAAADAv2oAAAD//+zbAQ0AAADCoPdPbQ436IEwBwAAAAAAAAAAAAAAAMC/agAAAP//7NsBDQAAAMKg909tDjfogTAHAAAAAAAAAAAAAAAAwL9qAAAA///s2wENAAAAwqD3T20ON+iBMAcAAAAAAAAAAAAAAADAv2oAAAD//+zbAQ0AAADCoPdPbQ436IEwBwAAAAAAAAAAAAAAAMC/agAAAP//7NsBDQAAAMKg909tDjfogTAHAAAAAAAAAAAAAAAAwL9qAAAA///s2wENAAAAwqD3T20ON+iBMAcAAAAAAAAAAAAAAADAv2oAAAD//+zbAQ0AAADCoPdPbQ436IEwBwAAAAAAAAAAAAAAAMC/agAAAP//7NsBDQAAAMKg909tDjfogTAHAAAAAAAAAAAAAAAAwL9qAAAA///s2wENAAAAwqD3T20ON+iBMAcAAAAAAAAAAAAAAADAv2oAAAD//+zbAQ0AAADCoPdPbQ436IEwBwAAAAAAAAAAAAAAAMC/agAAAP//7NsBDQAAAMKg909tDjfogTAHAAAAAAAAAAAAAAAAwL9qAAAA///s2wENAAAAwqD3T20ON+iBMAcAAAAAAAAAAAAAAADAv2oAAAD//+zbAQ0AAADCoPdPbQ436IEwBwAAAAAAAAAAAAAAAMC/agAAAP//7NsBDQAAAMKg909tDjfogTAHAAAAAAAAAAAAAAAAwL9qAAAA///s2wENAAAAwqD3T20ON+iBMAcAAAAAAAAAAAAAAADAv2oAAAD//+zbAQ0AAADCoPdPbQ436IEwBwAAAAAAAAAAAAAAAMC/agAAAP//7NsBDQAAAMKg909tDjfogTAHAAAAAAAAAAAAAAAAwL9qAAAA///s2wENAAAAwqD3T20ON+iBMAcAAAAAAAAAAAAAAADAv2oAAAD//+zbAQ0AAADCoPdPbQ436IEwBwAAAAAAAAAAAAAAAMC/agAAAP//7NsBDQAAAMKg909tDjfogTAHAAAAAAAAAAAAAAAAwL9qAAAA///s2wENAAAAwqD3T20ON+iBMAcAAAAAAAAAAAAAAADAv2oAAAD//+zbAQ0AAADCoPdPbQ436IEwBwAAAAAAAAAAAAAAAMC/agAAAP//7NsBDQAAAMKg909tDjfogTAHAAAAAAAAAAAAAAAAwL9qAAAA///s2wENAAAAwqD3T20ON+iBMAcAAAAAAAAAAAAAAADAv2oAAAD//+zbAQ0AAADCoPdPbQ436IEwBwAAAAAAAAAAAAAAAMC/agAAAP//7NsBDQAAAMKg909tDjfogTAHAAAAAAAAAAAAAAAAwL9qAAAA///s2wENAAAAwqD3T20ON+iBMAcAAAAAAAAAAAAAAADAv2oAAAD//+zbAQ0AAADCoPdPbQ436IEwBwAAAAAAAAAAAAAAAMC/agAAAP//7NsBDQAAAMKg909tDjfogTAHAAAAAAAAAAAAAAAAwL9qAAAA///s2wENAAAAwqD3T20ON+iBMAcAAAAAAAAAAAAAAADAv2oAAAD//+zbAQ0AAADCoPdPbQ436IEwBwAAAAAAAAAAAAAAAMC/agAAAP//7NsBDQAAAMKg909tDjfogTAHAAAAAAAAAAAAAAAAwL9qAAAA///s2wENAAAAwqD3T20ON+iBMAcAAAAAAAAAAAAAAADAv2oAAAD//+zbAQ0AAADCoPdPbQ436IEwBwAAAAAAAAAAAAAAAMC/agAAAP//7NsBDQAAAMKg909tDjfogTAHAAAAAAAAAAAAAAAAwL9qAAAA///s2wENAAAAwqD3T20ON+iBMAcAAAAAAAAAAAAAAADAv2oAAAD//+zbAQ0AAADCoPdPbQ436IEwBwAAAAAAAAAAAAAAAMC/agAAAP//7NsBDQAAAMKg909tDjfogTAHAAAAAAAAAAAAAAAAwL9qAAAA///s2wENAAAAwqD3T20ON+iBMAcAAAAAAAAAAAAAAADAv2oAAAD//+zbAQ0AAADCoPdPbQ436IEwBwAAAAAAAAAAAAAAAMC/agAAAP//7NsBDQAAAMKg909tDjfogTAHAAAAAAAAAAAAAAAAwL9qAAAA///s2wENAAAAwqD3T20ON+iBMAcAAAAAAAAAAAAAAADAv2oAAAD//+zbAQ0AAADCoPdPbQ436IEwBwAAAAAAAAAAAAAAAMC/agAAAP//7NsBDQAAAMKg909tDjfogTAHAAAAAAAAAAAAAAAAwL9qAAAA///s2wENAAAAwqD3T20ON+iBMAcAAAAAAAAAAAAAAADAv2oAAAD//+zbAQ0AAADCoPdPbQ436IEwBwAAAAAAAAAAAAAAAMC/agAAAP//7NsBDQAAAMKg909tDjfogTAHAAAAAAAAAAAAAAAAwL9qAAAA///s2wENAAAAwqD3T20ON+iBMAcAAAAAAAAAAAAAAADAv2oAAAD//+zbAQ0AAADCoPdPbQ436IEwBwAAAAAAAAAAAAAAAMC/agAAAP//7NsBDQAAAMKg909tDjfogTAHAAAAAAAAAAAAAAAAwL9qAAAA///s2wENAAAAwqD3T20ON+iBMAcAAAAAAAAAAAAAAADAv2oAAAD//+zbAQ0AAADCoPdPbQ436IEwBwAAAAAAAAAAAAAAAMC/agAAAP//7NsBDQAAAMKg909tDjfogTAHAAAAAAAAAAAAAAAAwL9qAAAA///s2wENAAAAwqD3T20ON+iBMAcAAAAAAAAAAAAAAADAv2oAAAD//+zbAQ0AAADCoPdPbQ436IEwBwAAAAAAAAAAAAAAAMC/agAAAP//7NsBDQAAAMKg909tDjfogTAHAAAAAAAAAAAAAAAAwL9qAAAA///s2wENAAAAwqD3T20ON+iBMAcAAAAAAAAAAAAAAADAv2oAAAD//+zbAQ0AAADCoPdPbQ436IEwBwAAAAAAAAAAAAAAAMC/agAAAP//7NsBDQAAAMKg909tDjfogTAHAAAAAAAAAAAAAAAAwL9qAAAA///s2wENAAAAwqD3T20ON+iBMAcAAAAAAAAAAAAAAADAv2oAAAD//+zbAQ0AAADCoPdPbQ436IEwBwAAAAAAAAAAAAAAAMC/agAAAP//7NsBDQAAAMKg909tDjfogTAHAAAAAAAAAAAAAAAAwL9qAAAA///s2wENAAAAwqD3T20ON+iBMAcAAAAAAAAAAAAAAADAv2oAAAD//+zbAQ0AAADCoPdPbQ436IEwBwAAAAAAAAAAAAAAAMC/agAAAP//7NsBDQAAAMKg909tDjfogTAHAAAAAAAAAAAAAAAAwL9qAAAA///s2wENAAAAwqD3T20ON+iBMAcAAAAAAAAAAAAAAADAv2oAAAD//+zbAQ0AAADCoPdPbQ436IEwBwAAAAAAAAAAAAAAAMC/agAAAP//7NsBDQAAAMKg909tDjfogTAHAAAAAAAAAAAAAAAAwL9qAAAA///s2wENAAAAwqD3T20ON+iBMAcAAAAAAAAAAAAAAADAv2oAAAD//+zbAQ0AAADCoPdPbQ436IEwBwAAAAAAAAAAAAAAAMC/agAAAP//7NsBDQAAAMKg909tDjfogTAHAAAAAAAAAAAAAAAAwL9qAAAA///s2wENAAAAwqD3T20ON+iBMAcAAAAAAAAAAAAAAADAv2oAAAD//+zbAQ0AAADCoPdPbQ436IEwBwAAAAAAAAAAAAAAAMC/agAAAP//7NsBDQAAAMKg909tDjfogTAHAAAAAAAAAAAAAAAAwL9qAAAA///s2wENAAAAwqD3T20ON+iBMAcAAAAAAAAAAAAAAADAv2oAAAD//+zbAQ0AAADCoPdPbQ436IEwBwAAAAAAAAAAAAAAAMC/agAAAP//7NsBDQAAAMKg909tDjfogTAHAAAAAAAAAAAAAAAAwL9qAAAA///s2wENAAAAwqD3T20ON+iBMAcAAAAAAAAAAAAAAADAv2oAAAD//+zbAQ0AAADCoPdPbQ436IEwBwAAAAAAAAAAAAAAAMC/agAAAP//7NsBDQAAAMKg909tDjfogTAHAAAAAAAAAAAAAAAAwL9qAAAA///s2wENAAAAwqD3T20ON+iBMAcAAAAAAAAAAAAAAADAv2oAAAD//+zbAQ0AAADCoPdPbQ436IEwBwAAAAAAAAAAAAAAAMC/agAAAP//7NsBDQAAAMKg909tDjfogTAHAAAAAAAAAAAAAAAAwL9qAAAA///s2wENAAAAwqD3T20ON+iBMAcAAAAAAAAAAAAAAADAv2oAAAD//+zbAQ0AAADCoPdPbQ436IEwBwAAAAAAAAAAAAAAAMC/agAAAP//7NsBDQAAAMKg909tDjfogTAHAAAAAAAAAAAAAAAAwL9qAAAA///s2wENAAAAwqD3T20ON+iBMAcAAAAAAAAAAAAAAADAv2oAAAD//+zbAQ0AAADCoPdPbQ436IEwBwAAAAAAAAAAAAAAAMC/agAAAP//7NsBDQAAAMKg909tDjfogTAHAAAAAAAAAAAAAAAAwL9qAAAA///s2wENAAAAwqD3T20ON+iBMAcAAAAAAAAAAAAAAADAv2oAAAD//+zbAQ0AAADCoPdPbQ436IEwBwAAAAAAAAAAAAAAAMC/agAAAP//7NsBDQAAAMKg909tDjfogTAHAAAAAAAAAAAAAAAAwL9qAAAA///s2wENAAAAwqD3T20ON+iBMAcAAAAAAAAAAAAAAADAv2oAAAD//+zbAQ0AAADCoPdPbQ436IEwBwAAAAAAAAAAAAAAAMC/agAAAP//7NsBDQAAAMKg909tDjfogTAHAAAAAAAAAAAAAAAAwL9qAAAA///s2wENAAAAwqD3T20ON+iBMAcAAAAAAAAAAAAAAADAv2oAAAD//+zbAQ0AAADCoPdPbQ436IEwBwAAAAAAAAAAAAAAAMC/agAAAP//7NsBDQAAAMKg909tDjfogTAHAAAAAAAAAAAAAAAAwL9qAAAA///s2wENAAAAwqD3T20ON+iBMAcAAAAAAAAAAAAAAADAv2oAAAD//+zbAQ0AAADCoPdPbQ436IEwBwAAAAAAAAAAAAAAAMC/agAAAP//7NsBDQAAAMKg909tDjfogTAHAAAAAAAAAAAAAAAAwL9qAAAA///s2wENAAAAwqD3T20ON+iBMAcAAAAAAAAAAAAAAADAv2oAAAD//+zbAQ0AAADCoPdPbQ436IEwBwAAAAAAAAAAAAAAAMC/agAAAP//7NsBDQAAAMKg909tDjfogTAHAAAAAAAAAAAAAAAAwL9qAAAA///s2wENAAAAwqD3T20ON+iBMAcAAAAAAAAAAAAAAADAv2oAAAD//+zbAQ0AAADCoPdPbQ436IEwBwAAAAAAAAAAAAAAAMC/agAAAP//7NsBDQAAAMKg909tDjfogTAHAAAAAAAAAAAAAAAAwL9qAAAA///s2wENAAAAwqD3T20ON+iBMAcAAAAAAAAAAAAAAADAv2oAAAD//+zbAQ0AAADCoPdPbQ436IEwBwAAAAAAAAAAAAAAAMC/agAAAP//7NsBDQAAAMKg909tDjfogTAHAAAAAAAAAAAAAAAAwL9qAAAA///s2wENAAAAwqD3T20ON+iBMAcAAAAAAAAAAAAAAADAv2oAAAD//+zbAQ0AAADCoPdPbQ436IEwBwAAAAAAAAAAAAAAAMC/agAAAP//7NsBDQAAAMKg909tDjfogTAHAAAAAAAAAAAAAAAAwL9qAAAA///s2wENAAAAwqD3T20ON+iBMAcAAAAAAAAAAAAAAADAv2oAAAD//+zbAQ0AAADCoPdPbQ436IEwBwAAAAAAAAAAAAAAAMC/agAAAP//7NsBDQAAAMKg909tDjfogTAHAAAAAAAAAAAAAAAAwL9qAAAA///s2wENAAAAwqD3T20ON+iBMAcAAAAAAAAAAAAAAADAv2oAAAD//+zbAQ0AAADCoPdPbQ436IEwBwAAAAAAAAAAAAAAAMC/agAAAP//7NsBDQAAAMKg909tDjfogTAHAAAAAAAAAAAAAAAAwL9qAAAA///s2wENAAAAwqD3T20ON+iBMAcAAAAAAAAAAAAAAADAv2oAAAD//+zbAQ0AAADCoPdPbQ436IEwBwAAAAAAAAAAAAAAAMC/agAAAP//7NsBDQAAAMKg909tDjfogTAHAAAAAAAAAAAAAAAAwL9qAAAA///s2wENAAAAwqD3T20ON+iBMAcAAAAAAAAAAAAAAADAv2oAAAD//+zbAQ0AAADCoPdPbQ436IEwBwAAAAAAAAAAAAAAAMC/agAAAP//7NsBDQAAAMKg909tDjfogTAHAAAAAAAAAAAAAAAAwL9qAAAA///s2wENAAAAwqD3T20ON+iBMAcAAAAAAAAAAAAAAADAv2oAAAD//+zbAQ0AAADCoPdPbQ436IEwBwAAAAAAAAAAAAAAAMC/agAAAP//7NsBDQAAAMKg909tDjfogTAHAAAAAAAAAAAAAAAAwL9qAAAA///s2wENAAAAwqD3T20ON+iBMAcAAAAAAAAAAAAAAADAv2oAAAD//+zbAQ0AAADCoPdPbQ436IEwBwAAAAAAAAAAAAAAAMC/agAAAP//7NsBDQAAAMKg909tDjfogTAHAAAAAAAAAAAAAAAAwL9qAAAA///s2wENAAAAwqD3T20ON+iBMAcAAAAAAAAAAAAAAADAv2oAAAD//+zbAQ0AAADCoPdPbQ436IEwBwAAAAAAAAAAAAAAAMC/agAAAP//7NsBDQAAAMKg909tDjfogTAHAAAAAAAAAAAAAAAAwL9qAAAA///s2wENAAAAwqD3T20ON+iBMAcAAAAAAAAAAAAAAADAv2oAAAD//+zbAQ0AAADCoPdPbQ436IEwBwAAAAAAAAAAAAAAAMC/agAAAP//7NsBDQAAAMKg909tDjfogTAHAAAAAAAAAAAAAAAAwL9qAAAA///s2wENAAAAwqD3T20ON+iBMAcAAAAAAAAAAAAAAADAv2oAAAD//+zbAQ0AAADCoPdPbQ436IEwBwAAAAAAAAAAAAAAAMC/agAAAP//7NsBDQAAAMKg909tDjfogTAHAAAAAAAAAAAAAAAAwL9qAAAA///s2wENAAAAwqD3T20ON+iBMAcAAAAAAAAAAAAAAADAv2oAAAD//+zbAQ0AAADCoPdPbQ436IEwBwAAAAAAAAAAAAAAAMC/agAAAP//7NsBDQAAAMKg909tDjfogTAHAAAAAAAAAAAAAAAAwL9qAAAA///s2wENAAAAwqD3T20ON+iBMAcAAAAAAAAAAAAAAADAv2oAAAD//+zbAQ0AAADCoPdPbQ436IEwBwAAAAAAAAAAAAAAAMC/agAAAP//7NsBDQAAAMKg909tDjfogTAHAAAAAAAAAAAAAAAAwL9qAAAA///s2wENAAAAwqD3T20ON+iBMAcAAAAAAAAAAAAAAADAv2oAAAD//+zbAQ0AAADCoPdPbQ436IEwBwAAAAAAAAAAAAAAAMC/agAAAP//7NsBDQAAAMKg909tDjfogTAHAAAAAAAAAAAAAAAAwL9qAAAA///s2wENAAAAwqD3T20ON+iBMAcAAAAAAAAAAAAAAADAv2oAAAD//+zbAQ0AAADCoPdPbQ436IEwBwAAAAAAAAAAAAAAAMC/agAAAP//7NsBDQAAAMKg909tDjfogTAHAAAAAAAAAAAAAAAAwL9qAAAA///s2wENAAAAwqD3T20ON+iBMAcAAAAAAAAAAAAAAADAv2oAAAD//+zbAQ0AAADCoPdPbQ436IEwBwAAAAAAAAAAAAAAAMC/agAAAP//7NsBDQAAAMKg909tDjfogTAHAAAAAAAAAAAAAAAAwL9qAAAA///s2wENAAAAwqD3T20ON+iBMAcAAAAAAAAAAAAAAADAv2oAAAD//+zbAQ0AAADCoPdPbQ436IEwBwAAAAAAAAAAAAAAAMC/agAAAP//7NsBDQAAAMKg909tDjfogTAHAAAAAAAAAAAAAAAAwL9qAAAA///s2wENAAAAwqD3T20ON+iBMAcAAAAAAAAAAAAAAADAv2oAAAD//+zbAQ0AAADCoPdPbQ436IEwBwAAAAAAAAAAAAAAAMC/agAAAP//7NsBDQAAAMKg909tDjfogTAHAAAAAAAAAAAAAAAAwL9qAAAA///s2wENAAAAwqD3T20ON+iBMAcAAAAAAAAAAAAAAADAv2oAAAD//+zbAQ0AAADCoPdPbQ436IEwBwAAAAAAAAAAAAAAAMC/agAAAP//7NsBDQAAAMKg909tDjfogTAHAAAAAAAAAAAAAAAAwL9qAAAA///s2wENAAAAwqD3T20ON+iBMAcAAAAAAAAAAAAAAADAv2oAAAD//+zbAQ0AAADCoPdPbQ436IEwBwAAAAAAAAAAAAAAAMC/agAAAP//7NsBDQAAAMKg909tDjfogTAHAAAAAAAAAAAAAAAAwL9qAAAA///s2wENAAAAwqD3T20ON+iBMAcAAAAAAAAAAAAAAADAv2oAAAD//+zbAQ0AAADCoPdPbQ436IEwBwAAAAAAAAAAAAAAAMC/agAAAP//7NsBDQAAAMKg909tDjfogTAHAAAAAAAAAAAAAAAAwL9qAAAA///s2wENAAAAwqD3T20ON+iBMAcAAAAAAAAAAAAAAADAv2oAAAD//+zbAQ0AAADCoPdPbQ436IEwBwAAAAAAAAAAAAAAAMC/agAAAP//7NsBDQAAAMKg909tDjfogTAHAAAAAAAAAAAAAAAAwL9qAAAA///s2wENAAAAwqD3T20ON+iBMAcAAAAAAAAAAAAAAADAv2oAAAD//+zbAQ0AAADCoPdPbQ436IEwBwAAAAAAAAAAAAAAAMC/agAAAP//7NsBDQAAAMKg909tDjfogTAHAAAAAAAAAAAAAAAAwL9qAAAA///s2wENAAAAwqD3T20ON+iBMAcAAAAAAAAAAAAAAADAv2oAAAD//+zbAQ0AAADCoPdPbQ436IEwBwAAAAAAAAAAAAAAAMC/agAAAP//7NsBDQAAAMKg909tDjfogTAHAAAAAAAAAAAAAAAAwL9qAAAA///s2wENAAAAwqD3T20ON+iBMAcAAAAAAAAAAAAAAADAv2oAAAD//+zbAQ0AAADCoPdPbQ436IEwBwAAAAAAAAAAAAAAAMC/agAAAP//7NsBDQAAAMKg909tDjfogTAHAAAAAAAAAAAAAAAAwL9qAAAA///s2wENAAAAwqD3T20ON+iBMAcAAAAAAAAAAAAAAADAv2oAAAD//+zbAQ0AAADCoPdPbQ436IEwBwAAAAAAAAAAAAAAAMC/agAAAP//7NsBDQAAAMKg909tDjfogTAHAAAAAAAAAAAAAAAAwL9qAAAA///s2wENAAAAwqD3T20ON+iBMAcAAAAAAAAAAAAAAADAv2oAAAD//+zbAQ0AAADCoPdPbQ436IEwBwAAAAAAAAAAAAAAAMC/agAAAP//7NsBDQAAAMKg909tDjfogTAHAAAAAAAAAAAAAAAAwL9qAAAA///s2wENAAAAwqD3T20ON+iBMAcAAAAAAAAAAAAAAADAv2oAAAD//+zbAQ0AAADCoPdPbQ436IEwBwAAAAAAAAAAAAAAAMC/agAAAP//7NsBDQAAAMKg909tDjfogTAHAAAAAAAAAAAAAAAAwL9qAAAA///s2wENAAAAwqD3T20ON+iBMAcAAAAAAAAAAAAAAADAv2oAAAD//+zbAQ0AAADCoPdPbQ436IEwBwAAAAAAAAAAAAAAAMC/agAAAP//7NsBDQAAAMKg909tDjfogTAHAAAAAAAAAAAAAAAAwL9qAAAA///s2wENAAAAwqD3T20ON+iBMAcAAAAAAAAAAAAAAADAv2oAAAD//+zbAQ0AAADCoPdPbQ436IEwBwAAAAAAAAAAAAAAAMC/agAAAP//7NsBDQAAAMKg909tDjfogTAHAAAAAAAAAAAAAAAAwL9qAAAA///s2wENAAAAwqD3T20ON+iBMAcAAAAAAAAAAAAAAADAv2oAAAD//+zbAQ0AAADCoPdPbQ436IEwBwAAAAAAAAAAAAAAAMC/agAAAP//7NsBDQAAAMKg909tDjfogTAHAAAAAAAAAAAAAAAAwL9qAAAA///s2wENAAAAwqD3T20ON+iBMAcAAAAAAAAAAAAAAADAv2oAAAD//+zbAQ0AAADCoPdPbQ436IEwBwAAAAAAAAAAAAAAAMC/agAAAP//7NsBDQAAAMKg909tDjfogTAHAAAAAAAAAAAAAAAAwL9qAAAA///s2wENAAAAwqD3T20ON+iBMAcAAAAAAAAAAAAAAADAv2oAAAD//+zbAQ0AAADCoPdPbQ436IEwBwAAAAAAAAAAAAAAAMC/agAAAP//7NsBDQAAAMKg909tDjfogTAHAAAAAAAAAAAAAAAAwL9qAAAA///s2wENAAAAwqD3T20ON+iBMAcAAAAAAAAAAAAAAADAv2oAAAD//+zbAQ0AAADCoPdPbQ436IEwBwAAAAAAAAAAAAAAAMC/agDTZYG2AAAgAElEQVQAAP//7NsBDQAAAMKg909tDjfogTAHAAAAAAAAAAAAAAAAwL9qAAAA///s2wENAAAAwqD3T20ON+iBMAcAAAAAAAAAAAAAAADAv2oAAAD//+zbAQ0AAADCoPdPbQ436IEwBwAAAAAAAAAAAAAAAMC/agAAAP//7NsBDQAAAMKg909tDjfogTAHAAAAAAAAAAAAAAAAwL9qAAAA///s2wENAAAAwqD3T20ON+iBMAcAAAAAAAAAAAAAAADAv2oAAAD//+zbAQ0AAADCoPdPbQ436IEwBwAAAAAAAAAAAAAAAMC/agAAAP//7NsBDQAAAMKg909tDjfogTAHAAAAAAAAAAAAAAAAwL9qAAAA///s2wENAAAAwqD3T20ON+iBMAcAAAAAAAAAAAAAAADAv2oAAAD//+zbAQ0AAADCoPdPbQ436IEwBwAAAAAAAAAAAAAAAMC/agAAAP//7NsBDQAAAMKg909tDjfogTAHAAAAAAAAAAAAAAAAwL9qAAAA///s2wENAAAAwqD3T20ON+iBMAcAAAAAAAAAAAAAAADAv2oAAAD//+zbAQ0AAADCoPdPbQ436IEwBwAAAAAAAAAAAAAAAMC/agAAAP//7NsBDQAAAMKg909tDjfogTAHAAAAAAAAAAAAAAAAwL9qAAAA///s2wENAAAAwqD3T20ON+iBMAcAAAAAAAAAAAAAAADAv2oAAAD//+zbAQ0AAADCoPdPbQ436IEwBwAAAAAAAAAAAAAAAMC/agAAAP//7NsBDQAAAMKg909tDjfogTAHAAAAAAAAAAAAAAAAwL9qAAAA///s2wENAAAAwqD3T20ON+iBMAcAAAAAAAAAAAAAAADAv2oAAAD//+zbAQ0AAADCoPdPbQ436IEwBwAAAAAAAAAAAAAAAMC/agAAAP//7NsBDQAAAMKg909tDjfogTAHAAAAAAAAAAAAAAAAwL9qAAAA///s2wENAAAAwqD3T20ON+iBMAcAAAAAAAAAAAAAAADAv2oAAAD//+zbAQ0AAADCoPdPbQ436IEwBwAAAAAAAAAAAAAAAMC/agAAAP//7NsBDQAAAMKg909tDjfogTAHAAAAAAAAAAAAAAAAwL9qAAAA///s2wENAAAAwqD3T20ON+iBMAcAAAAAAAAAAAAAAADAv2oAAAD//+zbAQ0AAADCoPdPbQ436IEwBwAAAAAAAAAAAAAAAMC/agAAAP//7NsBDQAAAMKg909tDjfogTAHAAAAAAAAAAAAAAAAwL9qAAAA///s2wENAAAAwqD3T20ON+iBMAcAAAAAAAAAAAAAAADAv2oAAAD//+zbAQ0AAADCoPdPbQ436IEwBwAAAAAAAAAAAAAAAMC/agAAAP//7NsBDQAAAMKg909tDjfogTAHAAAAAAAAAAAAAAAAwL9qAAAA///s2wENAAAAwqD3T20ON+iBMAcAAAAAAAAAAAAAAADAv2oAAAD//+zbAQ0AAADCoPdPbQ436IEwBwAAAAAAAAAAAAAAAMC/agAAAP//7NsBDQAAAMKg909tDjfogTAHAAAAAAAAAAAAAAAAwL9qAAAA///s2wENAAAAwqD3T20ON+iBMAcAAAAAAAAAAAAAAADAv2oAAAD//+zbAQ0AAADCoPdPbQ436IEwBwAAAAAAAAAAAAAAAMC/agAAAP//7NsBDQAAAMKg909tDjfogTAHAAAAAAAAAAAAAAAAwL9qAAAA///s2wENAAAAwqD3T20ON+iBMAcAAAAAAAAAAAAAAADAv2oAAAD//+zbAQ0AAADCoPdPbQ436IEwBwAAAAAAAAAAAAAAAMC/agAAAP//7NsBDQAAAMKg909tDjfogTAHAAAAAAAAAAAAAAAAwL9qAAAA///s2wENAAAAwqD3T20ON+iBMAcAAAAAAAAAAAAAAADAv2oAAAD//+zbAQ0AAADCoPdPbQ436IEwBwAAAAAAAAAAAAAAAMC/agAAAP//7NsBDQAAAMKg909tDjfogTAHAAAAAAAAAAAAAAAAwL9qAAAA///s2wENAAAAwqD3T20ON+iBMAcAAAAAAAAAAAAAAADAv2oAAAD//+zbAQ0AAADCoPdPbQ436IEwBwAAAAAAAAAAAAAAAMC/agAAAP//7NsBDQAAAMKg909tDjfogTAHAAAAAAAAAAAAAAAAwL9qAAAA///s2wENAAAAwqD3T20ON+iBMAcAAAAAAAAAAAAAAADAv2oAAAD//+zbAQ0AAADCoPdPbQ436IEwBwAAAAAAAAAAAAAAAMC/agAAAP//7NsBDQAAAMKg909tDjfogTAHAAAAAAAAAAAAAAAAwL9qAAAA///s2wENAAAAwqD3T20ON+iBMAcAAAAAAAAAAAAAAADAv2oAAAD//+zbAQ0AAADCoPdPbQ436IEwBwAAAAAAAAAAAAAAAMC/agAAAP//7NsBDQAAAMKg909tDjfogTAHAAAAAAAAAAAAAAAAwL9qAAAA///s2wENAAAAwqD3T20ON+iBMAcAAAAAAAAAAAAAAADAv2oAAAD//+zbAQ0AAADCoPdPbQ436IEwBwAAAAAAAAAAAAAAAMC/agAAAP//7NsBDQAAAMKg909tDjfogTAHAAAAAAAAAAAAAAAAwL9qAAAA///s2wENAAAAwqD3T20ON+iBMAcAAAAAAAAAAAAAAADAv2oAAAD//+zbAQ0AAADCoPdPbQ436IEwBwAAAAAAAAAAAAAAAMC/agAAAP//7NsBDQAAAMKg909tDjfogTAHAAAAAAAAAAAAAAAAwL9qAAAA///s2wENAAAAwqD3T20ON+iBMAcAAAAAAAAAAAAAAADAv2oAAAD//+zbAQ0AAADCoPdPbQ436IEwBwAAAAAAAAAAAAAAAMC/agAAAP//7NsBDQAAAMKg909tDjfogTAHAAAAAAAAAAAAAAAAwL9qAAAA///s2wENAAAAwqD3T20ON+iBMAcAAAAAAAAAAAAAAADAv2oAAAD//+zbAQ0AAADCoPdPbQ436IEwBwAAAAAAAAAAAAAAAMC/agAAAP//7NsBDQAAAMKg909tDjfogTAHAAAAAAAAAAAAAAAAwL9qAAAA///s2wENAAAAwqD3T20ON+iBMAcAAAAAAAAAAAAAAADAv2oAAAD//+zbAQ0AAADCoPdPbQ436IEwBwAAAAAAAAAAAAAAAMC/agAAAP//7NsBDQAAAMKg909tDjfogTAHAAAAAAAAAAAAAAAAwL9qAAAA///s2wENAAAAwqD3T20ON+iBMAcAAAAAAAAAAAAAAADAv2oAAAD//+zbAQ0AAADCoPdPbQ436IEwBwAAAAAAAAAAAAAAAMC/agAAAP//7NsBDQAAAMKg909tDjfogTAHAAAAAAAAAAAAAAAAwL9qAAAA///s2wENAAAAwqD3T20ON+iBMAcAAAAAAAAAAAAAAADAv2oAAAD//+zbAQ0AAADCoPdPbQ436IEwBwAAAAAAAAAAAAAAAMC/agAAAP//7NsBDQAAAMKg909tDjfogTAHAAAAAAAAAAAAAAAAwL9qAAAA///s2wENAAAAwqD3T20ON+iBMAcAAAAAAAAAAAAAAADAv2oAAAD//+zbAQ0AAADCoPdPbQ436IEwBwAAAAAAAAAAAAAAAMC/agAAAP//7NsBDQAAAMKg909tDjfogTAHAAAAAAAAAAAAAAAAwL9qAAAA///s2wENAAAAwqD3T20ON+iBMAcAAAAAAAAAAAAAAADAv2oAAAD//+zbAQ0AAADCoPdPbQ436IEwBwAAAAAAAAAAAAAAAMC/agAAAP//7NsBDQAAAMKg909tDjfogTAHAAAAAAAAAAAAAAAAwL9qAAAA///s2wENAAAAwqD3T20ON+iBMAcAAAAAAAAAAAAAAADAv2oAAAD//+zbAQ0AAADCoPdPbQ436IEwBwAAAAAAAAAAAAAAAMC/agAAAP//7NsBDQAAAMKg909tDjfogTAHAAAAAAAAAAAAAAAAwL9qAAAA///s2wENAAAAwqD3T20ON+iBMAcAAAAAAAAAAAAAAADAv2oAAAD//+zbAQ0AAADCoPdPbQ436IEwBwAAAAAAAAAAAAAAAMC/agAAAP//7NsBDQAAAMKg909tDjfogTAHAAAAAAAAAAAAAAAAwL9qAAAA///s2wENAAAAwqD3T20ON+iBMAcAAAAAAAAAAAAAAADAv2oAAAD//+zbAQ0AAADCoPdPbQ436IEwBwAAAAAAAAAAAAAAAMC/agAAAP//7NsBDQAAAMKg909tDjfogTAHAAAAAAAAAAAAAAAAwL9qAAAA///s2wENAAAAwqD3T20ON+iBMAcAAAAAAAAAAAAAAADAv2oAAAD//+zbAQ0AAADCoPdPbQ436IEwBwAAAAAAAAAAAAAAAMC/agAAAP//7NsBDQAAAMKg909tDjfogTAHAAAAAAAAAAAAAAAAwL9qAAAA///s2wENAAAAwqD3T20ON+iBMAcAAAAAAAAAAAAAAADAv2oAAAD//+zbAQ0AAADCoPdPbQ436IEwBwAAAAAAAAAAAAAAAMC/agAAAP//7NsBDQAAAMKg909tDjfogTAHAAAAAAAAAAAAAAAAwL9qAAAA///s2wENAAAAwqD3T20ON+iBMAcAAAAAAAAAAAAAAADAv2oAAAD//+zbAQ0AAADCoPdPbQ436IEwBwAAAAAAAAAAAAAAAMC/agAAAP//7NsBDQAAAMKg909tDjfogTAHAAAAAAAAAAAAAAAAwL9qAAAA///s2wENAAAAwqD3T20ON+iBMAcAAAAAAAAAAAAAAADAv2oAAAD//+zbAQ0AAADCoPdPbQ436IEwBwAAAAAAAAAAAAAAAMC/agAAAP//7NsBDQAAAMKg909tDjfogTAHAAAAAAAAAAAAAAAAwL9qAAAA///s2wENAAAAwqD3T20ON+iBMAcAAAAAAAAAAAAAAADAv2oAAAD//+zbAQ0AAADCoPdPbQ436IEwBwAAAAAAAAAAAAAAAMC/agAAAP//7NsBDQAAAMKg909tDjfogTAHAAAAAAAAAAAAAAAAwL9qAAAA///s2wENAAAAwqD3T20ON+iBMAcAAAAAAAAAAAAAAADAv2oAAAD//+zbAQ0AAADCoPdPbQ436IEwBwAAAAAAAAAAAAAAAMC/agAAAP//7NsBDQAAAMKg909tDjfogTAHAAAAAAAAAAAAAAAAwL9qAAAA///s2wENAAAAwqD3T20ON+iBMAcAAAAAAAAAAAAAAADAv2oAAAD//+zbAQ0AAADCoPdPbQ436IEwBwAAAAAAAAAAAAAAAMC/agAAAP//7NsBDQAAAMKg909tDjfogTAHAAAAAAAAAAAAAAAAwL9qAAAA///s2wENAAAAwqD3T20ON+iBMAcAAAAAAAAAAAAAAADAv2oAAAD//+zbAQ0AAADCoPdPbQ436IEwBwAAAAAAAAAAAAAAAMC/agAAAP//7NsBDQAAAMKg909tDjfogTAHAAAAAAAAAAAAAAAAwL9qAAAA///s2wENAAAAwqD3T20ON+iBMAcAAAAAAAAAAAAAAADAv2oAAAD//+zbAQ0AAADCoPdPbQ436IEwBwAAAAAAAAAAAAAAAMC/agAAAP//7NsBDQAAAMKg909tDjfogTAHAAAAAAAAAAAAAAAAwL9qAAAA///s2wENAAAAwqD3T20ON+iBMAcAAAAAAAAAAAAAAADAv2oAAAD//+zbAQ0AAADCoPdPbQ436IEwBwAAAAAAAAAAAAAAAMC/agAAAP//7NsBDQAAAMKg909tDjfogTAHAAAAAAAAAAAAAAAAwL9qAAAA///s2wENAAAAwqD3T20ON+iBMAcAAAAAAAAAAAAAAADAv2oAAAD//+zbAQ0AAADCoPdPbQ436IEwBwAAAAAAAAAAAAAAAMC/agAAAP//7NsBDQAAAMKg909tDjfogTAHAAAAAAAAAAAAAAAAwL9qAAAA///s2wENAAAAwqD3T20ON+iBMAcAAAAAAAAAAAAAAADAv2oAAAD//+zbAQ0AAADCoPdPbQ436IEwBwAAAAAAAAAAAAAAAMC/agAAAP//7NsBDQAAAMKg909tDjfogTAHAAAAAAAAAAAAAAAAwL9qAAAA///s2wENAAAAwqD3T20ON+iBMAcAAAAAAAAAAAAAAADAv2oAAAD//+zbAQ0AAADCoPdPbQ436IEwBwAAAAAAAAAAAAAAAMC/agAAAP//7NsBDQAAAMKg909tDjfogTAHAAAAAAAAAAAAAAAAwL9qAAAA///s2wENAAAAwqD3T20ON+iBMAcAAAAAAAAAAAAAAADAv2oAAAD//+zbAQ0AAADCoPdPbQ436IEwBwAAAAAAAAAAAAAAAMC/agAAAP//7NsBDQAAAMKg909tDjfogTAHAAAAAAAAAAAAAAAAwL9qAAAA///s2wENAAAAwqD3T20ON+iBMAcAAAAAAAAAAAAAAADAv2oAAAD//+zbAQ0AAADCoPdPbQ436IEwBwAAAAAAAAAAAAAAAMC/agAAAP//7NsBDQAAAMKg909tDjfogTAHAAAAAAAAAAAAAAAAwL9qAAAA///s2wENAAAAwqD3T20ON+iBMAcAAAAAAAAAAAAAAADAv2oAAAD//+zbAQ0AAADCoPdPbQ436IEwBwAAAAAAAAAAAAAAAMC/agAAAP//7NsBDQAAAMKg909tDjfogTAHAAAAAAAAAAAAAAAAwL9qAAAA///s2wENAAAAwqD3T20ON+iBMAcAAAAAAAAAAAAAAADAv2oAAAD//+zbAQ0AAADCoPdPbQ436IEwBwAAAAAAAAAAAAAAAMC/agAAAP//7NsBDQAAAMKg909tDjfogTAHAAAAAAAAAAAAAAAAwL9qAAAA///s2wENAAAAwqD3T20ON+iBMAcAAAAAAAAAAAAAAADAv2oAAAD//+zbAQ0AAADCoPdPbQ436IEwBwAAAAAAAAAAAAAAAMC/agAAAP//7NsBDQAAAMKg909tDjfogTAHAAAAAAAAAAAAAAAAwL9qAAAA///s2wENAAAAwqD3T20ON+iBMAcAAAAAAAAAAAAAAADAv2oAAAD//+zbAQ0AAADCoPdPbQ436IEwBwAAAAAAAAAAAAAAAMC/agAAAP//7NsBDQAAAMKg909tDjfogTAHAAAAAAAAAAAAAAAAwL9qAAAA///s2wENAAAAwqD3T20ON+iBMAcAAAAAAAAAAAAAAADAv2oAAAD//+zbAQ0AAADCoPdPbQ436IEwBwAAAAAAAAAAAAAAAMC/agAAAP//7NsBDQAAAMKg909tDjfogTAHAAAAAAAAAAAAAAAAwL9qAAAA///s2wENAAAAwqD3T20ON+iBMAcAAAAAAAAAAAAAAADAv2oAAAD//+zbAQ0AAADCoPdPbQ436IEwBwAAAAAAAAAAAAAAAMC/agAAAP//7NsBDQAAAMKg909tDjfogTAHAAAAAAAAAAAAAAAAwL9qAAAA///s2wENAAAAwqD3T20ON+iBMAcAAAAAAAAAAAAAAADAv2oAAAD//+zbAQ0AAADCoPdPbQ436IEwBwAAAAAAAAAAAAAAAMC/agAAAP//7NsBDQAAAMKg909tDjfogTAHAAAAAAAAAAAAAAAAwL9qAAAA///s2wENAAAAwqD3T20ON+iBMAcAAAAAAAAAAAAAAADAv2oAAAD//+zbAQ0AAADCoPdPbQ436IEwBwAAAAAAAAAAAAAAAMC/agAAAP//7NsBDQAAAMKg909tDjfogTAHAAAAAAAAAAAAAAAAwL9qAAAA///s2wENAAAAwqD3T20ON+iBMAcAAAAAAAAAAAAAAADAv2oAAAD//+zbAQ0AAADCoPdPbQ436IEwBwAAAAAAAAAAAAAAAMC/agAAAP//7NsBDQAAAMKg909tDjfogTAHAAAAAAAAAAAAAAAAwL9qAAAA///s2wENAAAAwqD3T20ON+iBMAcAAAAAAAAAAAAAAADAv2oAAAD//+zbAQ0AAADCoPdPbQ436IEwBwAAAAAAAAAAAAAAAMC/agAAAP//7NsBDQAAAMKg909tDjfogTAHAAAAAAAAAAAAAAAAwL9qAAAA///s2wENAAAAwqD3T20ON+iBMAcAAAAAAAAAAAAAAADAv2oAAAD//+zbAQ0AAADCoPdPbQ436IEwBwAAAAAAAAAAAAAAAMC/agAAAP//7NsBDQAAAMKg909tDjfogTAHAAAAAAAAAAAAAAAAwL9qAAAA///s2wENAAAAwqD3T20ON+iBMAcAAAAAAAAAAAAAAADAv2oAAAD//+zbAQ0AAADCoPdPbQ436IEwBwAAAAAAAAAAAAAAAMC/agAAAP//7NsBDQAAAMKg909tDjfogTAHAAAAAAAAAAAAAAAAwL9qAAAA///s2wENAAAAwqD3T20ON+iBMAcAAAAAAAAAAAAAAADAv2oAAAD//+zbAQ0AAADCoPdPbQ436IEwBwAAAAAAAAAAAAAAAMC/agAAAP//7NsBDQAAAMKg909tDjfogTAHAAAAAAAAAAAAAAAAwL9qAAAA///s2wENAAAAwqD3T20ON+iBMAcAAAAAAAAAAAAAAADAv2oAAAD//+zbAQ0AAADCoPdPbQ436IEwBwAAAAAAAAAAAAAAAMC/agAAAP//7NsBDQAAAMKg909tDjfogTAHAAAAAAAAAAAAAAAAwL9qAAAA///s2wENAAAAwqD3T20ON+iBMAcAAAAAAAAAAAAAAADAv2oAAAD//+zbAQ0AAADCoPdPbQ436IEwBwAAAAAAAAAAAAAAAMC/agAAAP//7NsBDQAAAMKg909tDjfogTAHAAAAAAAAAAAAAAAAwL9qAAAA///s2wENAAAAwqD3T20ON+iBMAcAAAAAAAAAAAAAAADAv2oAAAD//+zbAQ0AAADCoPdPbQ436IEwBwAAAAAAAAAAAAAAAMC/agAAAP//7NsBDQAAAMKg909tDjfogTAHAAAAAAAAAAAAAAAAwL9qAAAA///s2wENAAAAwqD3T20ON+iBMAcAAAAAAAAAAAAAAADAv2oAAAD//+zbAQ0AAADCoPdPbQ436IEwBwAAAAAAAAAAAAAAAMC/agAAAP//7NsBDQAAAMKg909tDjfogTAHAAAAAAAAAAAAAAAAwL9qAAAA///s2wENAAAAwqD3T20ON+iBMAcAAAAAAAAAAAAAAADAv2oAAAD//+zbAQ0AAADCoPdPbQ436IEwBwAAAAAAAAAAAAAAAMC/agAAAP//7NsBDQAAAMKg909tDjfogTAHAAAAAAAAAAAAAAAAwL9qAAAA///s2wENAAAAwqD3T20ON+iBMAcAAAAAAAAAAAAAAADAv2oAAAD//+zbAQ0AAADCoPdPbQ436IEwBwAAAAAAAAAAAAAAAMC/agAAAP//7NsBDQAAAMKg909tDjfogTAHAAAAAAAAAAAAAAAAwL9qAAAA///s2wENAAAAwqD3T20ON+iBMAcAAAAAAAAAAAAAAADAv2oAAAD//+zbAQ0AAADCoPdPbQ436IEwBwAAAAAAAAAAAAAAAMC/agAAAP//7NsBDQAAAMKg909tDjfogTAHAAAAAAAAAAAAAAAAwL9qAAAA///s2wENAAAAwqD3T20ON+iBMAcAAAAAAAAAAAAAAADAv2oAAAD//+zbAQ0AAADCoPdPbQ436IEwBwAAAAAAAAAAAAAAAMC/agAAAP//7NsBDQAAAMKg909tDjfogTAHAAAAAAAAAAAAAAAAwL9qAAAA///s2wENAAAAwqD3T20ON+iBMAcAAAAAAAAAAAAAAADAv2oAAAD//+zbAQ0AAADCoPdPbQ436IEwBwAAAAAAAAAAAAAAAMC/agAAAP//7NsBDQAAAMKg909tDjfogTAHAAAAAAAAAAAAAAAAwL9qAAAA///s2wENAAAAwqD3T20ON+iBMAcAAAAAAAAAAAAAAADAv2oAAAD//+zbAQ0AAADCoPdPbQ436IEwBwAAAAAAAAAAAAAAAMC/agAAAP//7NsBDQAAAMKg909tDjfogTAHAAAAAAAAAAAAAAAAwL9qAAAA///s2wENAAAAwqD3T20ON+iBMAcAAAAAAAAAAAAAAADAv2oAAAD//+zbAQ0AAADCoPdPbQ436IEwBwAAAAAAAAAAAAAAAMC/agAAAP//7NsBDQAAAMKg909tDjfogTAHAAAAAAAAAAAAAAAAwL9qAAAA///s2wENAAAAwqD3T20ON+iBMAcAAAAAAAAAAAAAAADAv2oAAAD//+zbAQ0AAADCoPdPbQ436IEwBwAAAAAAAAAAAAAAAMC/agAAAP//7NsBDQAAAMKg909tDjfogTAHAAAAAAAAAAAAAAAAwL9qAAAA///s2wENAAAAwqD3T20ON+iBMAcAAAAAAAAAAAAAAADAv2oAAAD//+zbAQ0AAADCoPdPbQ436IEwBwAAAAAAAAAAAAAAAMC/agAAAP//7NsBDQAAAMKg909tDjfogTAHAAAAAAAAAAAAAAAAwL9qAAAA///s2wENAAAAwqD3T20ON+iBMAcAAAAAAAAAAAAAAADAv2oAAAD//+zbAQ0AAADCoPdPbQ436IEwBwAAAAAAAAAAAAAAAMC/agAAAP//7NsBDQAAAMKg909tDjfogTAHAAAAAAAAAAAAAAAAwL9qAAAA///s2wENAAAAwqD3T20ON+iBMAcAAAAAAAAAAAAAAADAv2oAAAD//+zbAQ0AAADCoPdPbQ436IEwBwAAAAAAAAAAAAAAAMC/agAAAP//7NsBDQAAAMKg909tDjfogTAHAAAAAAAAAAAAAAAAwL9qAAAA///s2wENAAAAwqD3T20ON+iBMAcAAAAAAAAAAAAAAADAv2oAAAD//+zbAQ0AAADCoPdPbQ436IEwB/+dKU4AACAASURBVAAAAAAAAAAAAAAAAMC/auzbAQ0AAADCoPdPbQ436IEwBwAAAAAAAAAAAAAAAMC/agAAAP//7NsBDQAAAMKg909tDjfogTAHAAAAAAAAAAAAAAAAwL9qAAAA///s2wENAAAAwqD3T20ON+iBMAcAAAAAAAAAAAAAAADAv2oAAAD//+zbAQ0AAADCoPdPbQ436IEwBwAAAAAAAAAAAAAAAMC/agAAAP//7NsBDQAAAMKg909tDjfogTAHAAAAAAAAAAAAAAAAwL9qAAAA///s2wENAAAAwqD3T20ON+iBMAcAAAAAAAAAAAAAAADAv2oAAAD//+zbAQ0AAADCoPdPbQ436IEwBwAAAAAAAAAAAAAAAMC/agAAAP//7NsBDQAAAMKg909tDjfogTAHAAAAAAAAAAAAAAAAwL9qAAAA///s2wENAAAAwqD3T20ON+iBMAcAAAAAAAAAAAAAAADAv2oAAAD//+zbAQ0AAADCoPdPbQ436IEwBwAAAAAAAAAAAAAAAMC/agAAAP//7NsBDQAAAMKg909tDjfogTAHAAAAAAAAAAAAAAAAwL9qAAAA///s2wENAAAAwqD3T20ON+iBMAcAAAAAAAAAAAAAAADAv2oAAAD//+zbAQ0AAADCoPdPbQ436IEwBwAAAAAAAAAAAAAAAMC/agAAAP//7NsBDQAAAMKg909tDjfogTAHAAAAAAAAAAAAAAAAwL9qAAAA///s2wENAAAAwqD3T20ON+iBMAcAAAAAAAAAAAAAAADAv2oAAAD//+zbAQ0AAADCoPdPbQ436IEwBwAAAAAAAAAAAAAAAMC/agAAAP//7NsBDQAAAMKg909tDjfogTAHAAAAAAAAAAAAAAAAwL9qAAAA///s2wENAAAAwqD3T20ON+iBMAcAAAAAAAAAAAAAAADAv2oAAAD//+zbAQ0AAADCoPdPbQ436IEwBwAAAAAAAAAAAAAAAMC/agAAAP//7NsBDQAAAMKg909tDjfogTAHAAAAAAAAAAAAAAAAwL9qAAAA///s2wENAAAAwqD3T20ON+iBMAcAAAAAAAAAAAAAAADAv2oAAAD//+zbAQ0AAADCoPdPbQ436IEwBwAAAAAAAAAAAAAAAMC/agAAAP//7NsBDQAAAMKg909tDjfogTAHAAAAAAAAAAAAAAAAwL9qAAAA///s2wENAAAAwqD3T20ON+iBMAcAAAAAAAAAAAAAAADAv2oAAAD//+zbAQ0AAADCoPdPbQ436IEwBwAAAAAAAAAAAAAAAMC/agAAAP//7NsBDQAAAMKg909tDjfogTAHAAAAAAAAAAAAAAAAwL9qAAAA///s2wENAAAAwqD3T20ON+iBMAcAAAAAAAAAAAAAAADAv2oAAAD//+zbAQ0AAADCoPdPbQ436IEwBwAAAAAAAAAAAAAAAMC/agAAAP//7NsBDQAAAMKg909tDjfogTAHAAAAAAAAAAAAAAAAwL9qAAAA///s2wENAAAAwqD3T20ON+iBMAcAAAAAAAAAAAAAAADAv2oAAAD//+zbAQ0AAADCoPdPbQ436IEwBwAAAAAAAAAAAAAAAMC/agAAAP//7NsBDQAAAMKg909tDjfogTAHAAAAAAAAAAAAAAAAwL9qAAAA///s2wENAAAAwqD3T20ON+iBMAcAAAAAAAAAAAAAAADAv2oAAAD//+zbAQ0AAADCoPdPbQ436IEwBwAAAAAAAAAAAAAAAMC/agAAAP//7NsBDQAAAMKg909tDjfogTAHAAAAAAAAAAAAAAAAwL9qAAAA///s2wENAAAAwqD3T20ON+iBMAcAAAAAAAAAAAAAAADAv2oAAAD//+zbAQ0AAADCoPdPbQ436IEwBwAAAAAAAAAAAAAAAMC/agAAAP//7NsBDQAAAMKg909tDjfogTAHAAAAAAAAAAAAAAAAwL9qAAAA///s2wENAAAAwqD3T20ON+iBMAcAAAAAAAAAAAAAAADAv2oAAAD//+zbAQ0AAADCoPdPbQ436IEwBwAAAAAAAAAAAAAAAMC/agAAAP//7NsBDQAAAMKg909tDjfogTAHAAAAAAAAAAAAAAAAwL9qAAAA///s2wENAAAAwqD3T20ON+iBMAcAAAAAAAAAAAAAAADAv2oAAAD//+zbAQ0AAADCoPdPbQ436IEwBwAAAAAAAAAAAAAAAMC/agAAAP//7NsBDQAAAMKg909tDjfogTAHAAAAAAAAAAAAAAAAwL9qAAAA///s2wENAAAAwqD3T20ON+iBMAcAAAAAAAAAAAAAAADAv2oAAAD//+zbAQ0AAADCoPdPbQ436IEwBwAAAAAAAAAAAAAAAMC/agAAAP//7NsBDQAAAMKg909tDjfogTAHAAAAAAAAAAAAAAAAwL9qAAAA///s2wENAAAAwqD3T20ON+iBMAcAAAAAAAAAAAAAAADAv2oAAAD//+zbAQ0AAADCoPdPbQ436IEwBwAAAAAAAAAAAAAAAMC/agAAAP//7NsBDQAAAMKg909tDjfogTAHAAAAAAAAAAAAAAAAwL9qAAAA///s2wENAAAAwqD3T20ON+iBMAcAAAAAAAAAAAAAAADAv2oAAAD//+zbAQ0AAADCoPdPbQ436IEwBwAAAAAAAAAAAAAAAMC/agAAAP//7NsBDQAAAMKg909tDjfogTAHAAAAAAAAAAAAAAAAwL9qAAAA///s2wENAAAAwqD3T20ON+iBMAcAAAAAAAAAAAAAAADAv2oAAAD//+zbAQ0AAADCoPdPbQ436IEwBwAAAAAAAAAAAAAAAMC/agAAAP//7NsBDQAAAMKg909tDjfogTAHAAAAAAAAAAAAAAAAwL9qAAAA///s2wENAAAAwqD3T20ON+iBMAcAAAAAAAAAAAAAAADAv2oAAAD//+zbAQ0AAADCoPdPbQ436IEwBwAAAAAAAAAAAAAAAMC/agAAAP//7NsBDQAAAMKg909tDjfogTAHAAAAAAAAAAAAAAAAwL9qAAAA///s2wENAAAAwqD3T20ON+iBMAcAAAAAAAAAAAAAAADAv2oAAAD//+zbAQ0AAADCoPdPbQ436IEwBwAAAAAAAAAAAAAAAMC/agAAAP//7NsBDQAAAMKg909tDjfogTAHAAAAAAAAAAAAAAAAwL9qAAAA///s2wENAAAAwqD3T20ON+iBMAcAAAAAAAAAAAAAAADAv2oAAAD//+zbAQ0AAADCoPdPbQ436IEwBwAAAAAAAAAAAAAAAMC/agAAAP//7NsBDQAAAMKg909tDjfogTAHAAAAAAAAAAAAAAAAwL9qAAAA///s2wENAAAAwqD3T20ON+iBMAcAAAAAAAAAAAAAAADAv2oAAAD//+zbAQ0AAADCoPdPbQ436IEwBwAAAAAAAAAAAAAAAMC/agAAAP//7NsBDQAAAMKg909tDjfogTAHAAAAAAAAAAAAAAAAwL9qAAAA///s2wENAAAAwqD3T20ON+iBMAcAAAAAAAAAAAAAAADAv2oAAAD//+zbAQ0AAADCoPdPbQ436IEwBwAAAAAAAAAAAAAAAMC/agAAAP//7NsBDQAAAMKg909tDjfogTAHAAAAAAAAAAAAAAAAwL9qAAAA///s2wENAAAAwqD3T20ON+iBMAcAAAAAAAAAAAAAAADAv2oAAAD//+zbAQ0AAADCoPdPbQ436IEwBwAAAAAAAAAAAAAAAMC/agAAAP//7NsBDQAAAMKg909tDjfogTAHAAAAAAAAAAAAAAAAwL9qAAAA///s2wENAAAAwqD3T20ON+iBMAcAAAAAAAAAAAAAAADAv2oAAAD//+zbAQ0AAADCoPdPbQ436IEwBwAAAAAAAAAAAAAAAMC/agAAAP//7NsBDQAAAMKg909tDjfogTAHAAAAAAAAAAAAAAAAwL9qAAAA///s2wENAAAAwqD3T20ON+iBMAcAAAAAAAAAAAAAAADAv2oAAAD//+zbAQ0AAADCoPdPbQ436IEwBwAAAAAAAAAAAAAAAMC/agAAAP//7NsBDQAAAMKg909tDjfogTAHAAAAAAAAAAAAAAAAwL9qAAAA///s2wENAAAAwqD3T20ON+iBMAcAAAAAAAAAAAAAAADAv2oAAAD//+zbAQ0AAADCoPdPbQ436IEwBwAAAAAAAAAAAAAAAMC/agAAAP//7NsBDQAAAMKg909tDjfogTAHAAAAAAAAAAAAAAAAwL9qAAAA///s2wENAAAAwqD3T20ON+iBMAcAAAAAAAAAAAAAAADAv2oAAAD//+zbAQ0AAADCoPdPbQ436IEwBwAAAAAAAAAAAAAAAMC/agAAAP//7NsBDQAAAMKg909tDjfogTAHAAAAAAAAAAAAAAAAwL9qAAAA///s2wENAAAAwqD3T20ON+iBMAcAAAAAAAAAAAAAAADAv2oAAAD//+zbAQ0AAADCoPdPbQ436IEwBwAAAAAAAAAAAAAAAMC/agAAAP//7NsBDQAAAMKg909tDjfogTAHAAAAAAAAAAAAAAAAwL9qAAAA///s2wENAAAAwqD3T20ON+iBMAcAAAAAAAAAAAAAAADAv2oAAAD//+zbAQ0AAADCoPdPbQ436IEwBwAAAAAAAAAAAAAAAMC/agAAAP//7NsBDQAAAMKg909tDjfogTAHAAAAAAAAAAAAAAAAwL9qAAAA///s2wENAAAAwqD3T20ON+iBMAcAAAAAAAAAAAAAAADAv2oAAAD//+zbAQ0AAADCoPdPbQ436IEwBwAAAAAAAAAAAAAAAMC/agAAAP//7NsBDQAAAMKg909tDjfogTAHAAAAAAAAAAAAAAAAwL9qAAAA///s2wENAAAAwqD3T20ON+iBMAcAAAAAAAAAAAAAAADAv2oAAAD//+zbAQ0AAADCoPdPbQ436IEwBwAAAAAAAAAAAAAAAMC/agAAAP//7NsBDQAAAMKg909tDjfogTAHAAAAAAAAAAAAAAAAwL9qAAAA///s2wENAAAAwqD3T20ON+iBMAcAAAAAAAAAAAAAAADAv2oAAAD//+zbAQ0AAADCoPdPbQ436IEwBwAAAAAAAAAAAAAAAMC/agAAAP//7NsBDQAAAMKg909tDjfogTAHAAAAAAAAAAAAAAAAwL9qAAAA///s2wENAAAAwqD3T20ON+iBMAcAAAAAAAAAAAAAAADAv2oAAAD//+zbAQ0AAADCoPdPbQ436IEwBwAAAAAAAAAAAAAAAMC/agAAAP//7NsBDQAAAMKg909tDjfogTAHAAAAAAAAAAAAAAAAwL9qAAAA///s2wENAAAAwqD3T20ON+iBMAcAAAAAAAAAAAAAAADAv2oAAAD//+zbAQ0AAADCoPdPbQ436IEwBwAAAAAAAAAAAAAAAMC/agAAAP//7NsBDQAAAMKg909tDjfogTAHAAAAAAAAAAAAAAAAwL9qAAAA///s2wENAAAAwqD3T20ON+iBMAcAAAAAAAAAAAAAAADAv2oAAAD//+zbAQ0AAADCoPdPbQ436IEwBwAAAAAAAAAAAAAAAMC/agAAAP//7NsBDQAAAMKg909tDjfogTAHAAAAAAAAAAAAAAAAwL9qAAAA///s2wENAAAAwqD3T20ON+iBMAcAAAAAAAAAAAAAAADAv2oAAAD//+zbAQ0AAADCoPdPbQ436IEwBwAAAAAAAAAAAAAAAMC/agAAAP//7NsBDQAAAMKg909tDjfogTAHAAAAAAAAAAAAAAAAwL9qAAAA///s2wENAAAAwqD3T20ON+iBMAcAAAAAAAAAAAAAAADAv2oAAAD//+zbAQ0AAADCoPdPbQ436IEwBwAAAAAAAAAAAAAAAMC/agAAAP//7NsBDQAAAMKg909tDjfogTAHAAAAAAAAAAAAAAAAwL9qAAAA///s2wENAAAAwqD3T20ON+iBMAcAAAAAAAAAAAAAAADAv2oAAAD//+zbAQ0AAADCoPdPbQ436IEwBwAAAAAAAAAAAAAAAMC/agAAAP//7NsBDQAAAMKg909tDjfogTAHAAAAAAAAAAAAAAAAwL9qAAAA///s2wENAAAAwqD3T20ON+iBMAcAAAAAAAAAAAAAAADAv2oAAAD//+zbAQ0AAADCoPdPbQ436IEwBwAAAAAAAAAAAAAAAMC/agAAAP//7NsBDQAAAMKg909tDjfogTAHAAAAAAAAAAAAAAAAwL9qAAAA///s2wENAAAAwqD3T20ON+iBMAcAAAAAAAAAAAAAAADAv2oAAAD//+zRUREAEBBAwfuQQxZRpBBCCtFuJNGCGbMb4b1iIwDcMfZqUvOhnLWnsQAAAAAAAAAAAADAcxFxAAAA///s20kNgEAQBMDGCCAFKahABCqQAg7QgJElmywKCC+qks685/hOV0qxCAB4abm2MUnN1OqTwWz5maO1u9dnuiTn2s+nIwAAAAAAAAAAAAAAPpfkBgAA///s20ENgDAQRNF1UAdoqCRUIAIVlVAJ1YKSZpNy5dBwfC8ZA3P/gjkA2HA9ra447l3xI3zKkC7DuXEfZ3cVAAAAAAAAAAAAAPC7iJgAAAD//+zdQQ3AIAAEwVNSTUhARUVUBRLAEgqQ0DSpABK+MxLuvznBHABsumcrfxxXPMfBsZHkC+f6c9VlTgAAAAAAAAAAAADgWJIXAAD//+zdMQ0AIBAEwZOCRCr0vDaUkDdAQ+hmfGxWMAcAF2vXSDJFcvBVx3PlPAcAAAAAAAAAAAAAPElyAAAA///s3TENgEAABMF1hitqJCABa7wSQkL5zTdUMxKuv6zDHABM7ON6S3JHtdkHfnNX53eeU50DAAAAAAAAAAAAANZUDwAAAP//7N0hFQAgEETBa0QlUpCDCGSjwTXAnEDiMDMR1v+3gjkAuIy9ej3KNbvAN1nh3BTOAQAAAAAAAAAAAADPIuIAAAD//+zdMREAAAyEMPyrroWOPyQ+OARzAOAoB6uEcwAAAAAAAAAAAADAX3UAAAD//+zdQQ3AIBQD0K+EzBEWUIGIqUAClkDJsoQrdxLek9CemxrMAXC1OtuzBjn59izgYON/fnxT6UoCAAAAAAAAAAAAALYi4gMAAP//7N0xEcAgAAPAOKgDtCGhEyJQgRWccCjp0g0Fvf5bSNZcDOYA+K22x/2+yl1aAJ8wk9Re6hIXAAAAAAAAAAAAAHBI8gAAAP//7N1BDQAhAAPBKsHKWUEPLyScRRwQEj5IIMxY2HdTgzkAnrNf5f4kn/pwnbGGrq3ULh0AAAAAAAAAAAAAcEgyAQAA///s3VEJACAAQ8FFNYU5jGAFK5nACIJYQryrsO/xHOYA+EqdvSRpqnLwvHFrc8uUAAAAAAAAAAAAAMCRZAMAAP//7N1REQAQFEXBl0QWTUghhBQiySCJeTXYrXC+71yDOQC+Mc7KV7mmODwj3+bqLH1LCgAAAAAAAAAAAABERFwAAAD//+zbwQCAQAAAwUWIIIWUSiKIoziUWCLJ45pR2Pca5gBY3v3OrXqqQ21Y0jX2c0oLAAAAAAAAAAAAAD9XfQAAAP//7NtRFQAQFETBPRJJ93JoQCQZJNGDmQh3v7dJAMDL6qyeZDvLwdNmnTVMDAAAAAAAAAAAAACfS3IBAAD//+zdQQ0AIBADwTrAAdpODy5wSkhQwc1Y2HdTD3MAfOuN5e6z3FAZWthrVkkNAAAAAAAAAAAAAE0lOQAAAP//7N1BEQBACAOxOsXF6UEbSvBxJBb23amHOQC+ZCwHJ9WbbukBAAAAAAAAAAAA4KgkCwAA///s2wEBAAAIw6D1T20PDz0Q5gB4R5aDadIcAAAAAAAAAAAAAKyqDgAA///s2wEBAAAIw6D1T20PDz0Q5gB4RZYDpDkAAAAAAAAAAAAAGFUdAAAA///s20EVgDAQQ8HUAQrQVhWIQEVxxsPI9oKKdkbCzzmtqswPwBKubxxJXmc54PfcZ+9iAAAAAAAAAAAAAMAmkkwAAAD//+zdQQ0AAAjEsPOvmpDwQAO0PpY5zAFwwsRyznLA1qc5wRwAAAAAAAAAAAAAfJGkAAAA///s20EBACAMA7E6wgKqsMO0oWR/JEAi4fquwxwAr6gkw5rAZa9TUxQAAAAAAAAAAAAA+ECSBgAA///s20ERACAQA7FKwRFWeKEHCWg6JShAAEwiYfuuwxwAz5u1RpJuSeBiz1pNHAAAAAAAAAAAAAD4XJIDAAD//+zdMREAIBADwTjACuqwgQW0oeQbanqYXQtXZ2IwB8DTxl49yVQRuGjnhRIAAAAAAAAAAAAA+FmSAgAA///s3UENACAMA8BJwBGu9kbKtE0JwQFfyJ2E9t3UYA6AZ2XXOM9RGgQuzOxaggIAAAAAAAAAAACAj0XEBgAA///s3cEJADAMAzFvklG7eilkgH4TpBX8PiyYA2CyF7+UBYFPp18pAQAAAAAAAAAAAICNklwAAAD//+zbMRUAIAxDwUjDEVv1VBtK0MBI352EnzkOcwB8qU6vJNt6wKMWDAAAAAAAAAAAAACGSnIBAAD//+zbMREAIAwEwXcUa1ToQRtK8JAuzK6E688wB8BUphego/Y9SzkAAAAAAAAAAAAA+FCSBwAA///s2zERACAQA8FIwAEuqZHy2l4JHuhgdiVc6jjMAfCc1bWTTMsBl/bqGuIBAAAAAAAAAAAAwGeSHAAAAP//7N0xEQAgEAPBc4B1JH+DAyqYXQnpbyKYA+ApJ3LxDgXcWNW2IAAAAAAAAAAAAAB8phoAAAD//+zbMREAIBAEsZOCMyxQoQdtKPkGB1QwiYTt1zAHwGvGmV0AbvS5V1MQAAAAAAAAAAAAAD6SpAAAAP//7NsxEQBACAPBOMfKS6VBAs0zuxKS+gRzAHxj4pbyGLDkGRIAAAAAAAAAAAAADknSAAAA///s2zERACAQA8E4A0lfoQdtKMEEzTO7Ei51HOYA6KSsBTw01tlTUAAAAAAAAAAAAAD4RJILAAD//+zbQREAIAwDwUhAIiqqAwloQwkm+JTZlXB5x2EOgBbq7JFkWgt4bAkKAAAAAAAAAAAAAJ9IcgEAAP//7NsxDQAgEATBc4AU3L0etKGE4IHmyYyFrdcwB0AXd5YbagGPzdrLjAsAAAAAAAAAAAAAP0hyAAAA///s2zERAAAIA7FKRgLSUcEAl0j4znWYA+CKshSwpIUFAAAAAAAAAAAAgAeSDAAAAP//7NtBDQAgDATBc1IrqEJPtVUJKkggmbGw7zXMAfC8Pb2SlFLAJbWnTXMAAAAAAAAAAAAA8LskBwAA///s20ERACAMA8FIQCIS+qoetKEEFTw6syvh8o7DHAATbCsBn1Xfs0QGAAAAAAAAAAAAgMGSPAAAAP//7N0xDQBADMNAMyi18kfzKH6odEfBcxSDOQAuWJWAz6byMgcAAAAAAAAAAAAAl1UPAAD//+zbQQ2DUBAE0P1GCDhDBSKqAgdYQAISGhTUwTQ4IIGSHt6TMJNsModtSXQIwN+a9vl4lls0BDxkeHXjW9gAVa21vqp6UfBrSVYhAwBwF1uGu9kscJ3bzEVbko8QAQAAADitqr4AAAD//+zdsQmAQBAEwD2wUDuxBVuyA0sSEzH47J9HcCa6eIOFC45bpAXAx/kuB8y06x2Ax5pkEwcTlJABABjILsNodhbop5vpUtWs4uM13wd1Z2N2bAcAAADwR0kuAAAA///s3UEJgEAQhtE/iVW0wVYwhSE2hdHUBEYQwYOIZ1nkPZj7FPhmBHMAtE64AnypTNs81G50NRoAAAAAAKBd/WOz8rbpFdutSZbbnEHd7osoAAAAwE8lOQAAAP//7N1BDYAwEEXB7wAJtYCEquJcKUhBCqkSQtILCCBAZpI1sHt+WcEcAK+19HVOMrkQ8LCWpFo6AAAAAADAL5Qxl8juFtNtI6Q7v9Ltzg4AAADwYUkOAAAA///s3UENgwAAA8AWBTjCAmr4gpQ5mIU5IUHBJPCaBmC5s9B+mw7yA+DGDFaAK0zL8fJuCQAAAAAA8P9+Q7o1yTvJ3vbb9tN2azu3HfUAAAAA4EGSnAAAAP//7N1RCcBADETBjYJar5SzUid1kKNw1EIPOiMh5Hd5CnMA7MxgDvjKmWS4PgAAAAAAwO8ca0T3Fumq6loFuqdEN7r79hYAAAAAm0oyAQAA///s3UEBQFAAA9AtiQg0UsFJDg2IJIMCKojhH96LsN03D3MAjGzRDvCTaX+uTfgAAAAAAAAkmZOsSc4kb9u77dHWCCwAAADAaJJ8AAAA///s2zERgDAQRNFbB0jDSTpqpMQJXlAQCUxmKHBAivck3M1s9wVzACzpuPs2gxXfAX50vlsEAAAAAAAAXzOga1V1JRlJepLdhQAAAAAWUFUPAAAA///s3TERACAQwLA6wL8KLLIws/JD4qNXwRwAU7nLAb+tymUOAAAAAACAl3Xvc1s8BwAAADBAdQAAAP//7NwxDQAgEAPASkElK1bQhhIM/MBEfriz0KRbazAHQFdDMkADa56tjwAAAAAAAHhRjeecxQIAAAD8lOQCAAD//+zbMRGAQBAEwRsHSEQKDkHSRwggoOqDbgm78QjmANiVQAXYxeUJAAAAAAAAPnrjubt6qrM6jAgAAADws5lZAAAA///s20ENgEAAA8FWERbOCS7QgQOQdkEJHkhI7jFjoc9mBXMArEowB6xiP557WAMAAAAAAICPtiRXktn2bOsPBwAAAPhLkhcAAP//7N0xEQAgAAJASGwlm1nFM4MODv81OEBhDoBfCQiAn3iZAwAAAAAA4NZ5nRtJVtvZ1mgjAAAAwGtJNgAAAP//7N0xEQAgEMTAO2VIQSpIQwLNl7s+MhHMAQDA33KZAwAAAAAAYNBOctpe4RwAAADAoCQPAAD//+zbMQEAAAjDsEnAEVaRigkOjsRC7xrmAPiqlAGeGUEAAAAAAAA41sY5AAAAgENJ4yMIzwAAIABJREFUln07qAEgBIIguKsEHGAJFeg5CacJJbwwQELCo0rCzLsFcwC8qnkGeEwZ8+tOAQAAAAAA4IIdzv2ZWQ0MAAAAcCgiFgAAAP//7N1RDcAgAEPBViFupgMJc0aCklmAj/3d2XhpajAHAADn5rNfD5gAAAAAAAD8ZSRZbWdbXQoAAADgVpIPAAD//+zbMQGAMBDAwLwCLOIAJCOlFujQ7U5C9hjmAADgv6t69QIAAAAAAOCwp/pm5hYaAAAAYEO1AAAA///s3DEVwCAUA8AfJ0hkqh2QUi1VwqsDGNjuJGTNSwzmAADgTH++2WQGAAAAAADAZf+Z40jyJtFPAQAAAOyoqgUAAP//7NsxDQAgAAPBVhnWcIoVggLCwnQnoeunDnMAAPDmhMlpMwAAAAAAAD4ZSVZbjQoAAADgJskGAAD//+zdMREAIBADwUjCES5osYIVrKAECXTMF7sWrs7EYA6AqrYyQGF9nNUEAgAAAAAA4KPpbQ4AAADgIckFAAD//+zdoREAIAADsXZTRmI0RuLwKAQqGeF9rwZzAADwZuoGAAAAAADAZ+dtbrUdwgMAAABcJNkAAAD//+zbMQGAMADEwH8F4Kiowk6rDSVdmRmY7iRkj2EOAAC+GfezLu0AAAAAAAD42ZFktl1tT/EBAAAAXpJsAAAA///s3UENACAQA8GeIxxhFQlI4nMegGTGwr6bGswB8KqtDPABL3MAAAAAAADcMpOsqhoKAAAAALQkBwAA///s20ERABAARcHfSBURpJBHNglEcNEBM7sV3vkZ5gB41VIG+EDpczShAAAAAAAAuKScaa4KAAAAAJAkyQYAAP//7N1BEcAgFEPBfAVFKqeeKwUHeEIJMminuxbeORODOQDeysMc8BXPvUZTCwAAAAAAgEOuJLOqugAAAADA7yXZAAAA///s20ERACAMA8FUCZKxgDSkIKMw7Fq4ZyYOcwDcaisDPGIkMT4CAAAAAADQbVbVUgEAAAD4WpIDAAD//+zdAQ0AIAwDwc0I1kACOlC94GKEOxtN8w5zALR0xlKYA16yVeYAAAAAAABoYN7TXGbargAAAIA/RUQBAAD//+zbQRHAIADAsDpA4iwhCZzNBhyJhb5rmAPgZFsd4BKjmmIBAAAAAABwgK9apjkAAADgSdUPAAD//+zdQREAIAwDwUjBAZJwgR60oaQ2yrBrIe+bCOYA6MzLHPCSte8ZFgMAAAAAAKCBKZoDAAAAvpSkAAAA///s20ERAAAIw7D5V4EUpGEDjsRC3zXMAbBZqwMcU4IBAAAAAACwhGkOAAAA+CfJAAAA///s20ERACAMBLFzVlShB20owUY7JBb2vYY5ADozzAHT1L5nqQYAAAAAAEATpjkAAADgL0keAAAA///s3EERACAQA7EqwQKWkMIbdzhBAjaOIbGw79ZgDoCyVhsnyVYIeMwUDAAAAAAAgEK6w1oAAADgG0kuAAAA///s3UENACAMA8BVEZaQhlSCi43cWeizaWowB0B3R0LAMO9lbgsNAAAAAACARlYS/TsAAADwv6q6AAAA///s3UENAAAIA7E5xSISsQGktbD3ZYI5ALZrCwEHeZkDAAAAAABgmxLNAQAAAO8lGQAAAP//7NtBDcAgAATBUwLWUIEIVGCpDpoqaXABZMbCvtcwB8DWRmlvkkcl4DC1f9M0BwAAAAAAwG7WNNdUAQAAAK6V5AcAAP//7NxBEQAgDAPB1gGSkMQLO6ANJdigzK6FeycGcwBU4OEOqGjMs5tyAAAAAAAAPGZlZhcFAAAA+FJEXAAAAP//7N0xEQAwDAMxB0EplP8UiKXR5CQKP/tsMAfABK0SMNBJ4mUOAAAAAACAH3VVXWUAAACAdZI8AAAA///s3EENwCAAA8A6mAO04WC/iUAFOCMomQ0gdxb6bFqDOQC210qdSYakgAO93+qKRgAAAAAAAHbzOK8FAAAArpTkBwAA///s3EENgDAURMFtgh+QggMsIKUSsIKyT/BASNrMSNh330VZAAZxJTnEAgbUk+zCAQAAAPziPWC7Tc1HNkMCMLm1tdar6hQaAAAAmEaSBwAA///s3bENwjAQBdC7DZiAFRgBMgIbMAUtqZmCUTILixwyFR1FghST91o39v+dZfmyqhQKQBeuz8cUEUdtAR0a7vvLpDigJ5nZJmSakskvtYenY1XtpAwAAKxNZr4/8quqVA7Mk5ljRNw6iXFYwR627vTl/J/r7V7psPXAFnKuKtPmAAAAgP8QES8AAAD//+zdsQnDMBAFUP0JklEyQkbJKB4lI3gDr5JNLgRUuDTGYIu816jXFQIdd1/CHAAj+TXTFhUDBjRtaPACXEpVfXoyAxwuyau/jze3CwAAXElfIDMbwID/VFWW351vVw2S3FfJoM/Vaahum3eSR/8XBgAAABhba+0LAAD//+zdsQ2EMBAEwHMjL0qhBL4D6iGiJSozsmQkiEk4mEmcW7rAkm9XwxwAqWiZAxL7L79ZMicAn9Y/Lq2tpeG4B20NAADAU5RSprYwcA738GaB+zI1zJn592rLYBEx9KW6sZ/CnK62WqsASAAAACC/iNgBAAD//+zdQQ3CQBiE0VmcoAQtOEBCJWABBSABCVhAyTRNeuDOpYX3FGwy5+/fgxkB2JnJYMBOXQ0HwD9bf2l4fsZyAAAAW7EGPXfxBMBvavtq+2g7LVFY2+Ww0zHJOcktydv0OY0xLht4BwAAAMB3kswAAAD//+zdOw0CURAF0BkjgAMsrQUaampUrAQs4AAJBCOXvGQlUPCy51iY6e58LMwBMJX7YRkDtk9VAyZ0vH5WISMAu9Td4zL1q6rOOgAAAPgn4xN2dz9m+X4FwO8keSdZkyxJTtsC3WXnefRtO3wFAAAAMK+q+gIAAP//7N0xDYAwFATQqwNQhgVUMCMBCTjBC0pIkw7MTDR9T8FPbvvJ5RTmAOiRwgnQq327z0l6AIyklLImuaw0AAAAf/Nawl6EA0Ar0B11gS7J3NbnRivP1R/e8YM7AAAAAL5L8gAAAP//7N1BDcJQEATQGQU4qAYk4AAk1ApXTAAOQcEnJL1y4dSm7ynY7JwnozAHwObcpvm7TPGUHLBBB6VfAPak7SPJXegAAMDatD1awgbglzHGa1mfOy3Lc9ck75087Nz2soI7AAAAAP6T5AMAAP//7N1LDYBADAXA1gEScIYLriABCUhAAlbAyBKSFQA3PjMKmvbWpnke5gB4q/FHBwngW4Z+n1szBeDLMrPJzCUiOoMGAACepj4BrJKwAbiiJs+NpZSmps5tP2jcdO74HlAHAAAAwH0RcQAAAP//7N1BDYAwDAXQPyOgBQVYQAISOGMGLThAClmCATix5T0FTf9taTsLcwA0aR+Wqz7SSw9o1CY4AHr1DNLUwdNZyAAAwN+UUpYkh2U5AL54fp2rhxGnJGfHTRyTrD+oAwAAAOC9JDcAAAD//+zdMRGAQBRDwe+Ic4QFKnTgAKSgBSOhoaCn4W52Lbw6E4M5AHq2eZkDOjWv19HEA2A0r7HcJC4AAPA3z1huFwaAr5KcSdrgj3OLlzkAAACgS1V1AwAA///s3UENwDAMBMFjUAbBVir5Fm0gRAZRKY5mIPhrrU4wB0Bb33iXlSagMSuZAFxFLAcAAJxMLAfAH2pxLkmFc/PCAz/+WQAAAEBLSTYAAAD//+zcQQ2AQAwEwJ4RggUUgBNQgQheSMASFlCAgxIc8CGBy4yCpvveVZgD4NeWZlorXuwD6tbPxzbIGIAaKMsBAABfpiwHwJsy88zMe+i1i4i9smePpZT2A3cAAAAAPBcRFwAAAP//7N1BDQAgDATBSkYCUpCEo8MCLwJkRkGTe28qmAPgB82KwKOG4QB4nVgOAAC4mVgOgFOSzCQ/fpvrF9wAAAAAsK+qFgAAAP//7N1BEYAwFEPBKAEtOKkKRKCiErBQK3WAAy54gM/sWnjnTAzmACjvWNqZZCgJFLTuszfhAKjKWA4AAPgyYzkA3vC8zW1Jrp8E8DIHAAAA1JLkBgAA///s3FENwDAIBUBwMClTVx2TMEuzMCMsVdHR3Fl4HySQh8IcALvw1Q7o6hrvfUgPgG6U5QAAgD/LzFNZDoBVqmruzeYsejYJwT0eAAAA6CMiPgAAAP//7N1RDYBADETBdYADtCAFCejAxTkBJzgpIcED3GXGwvtsNjWYA2AI+7w+B4emJtChKckmHAAdMpYDAAB+6R3LHeoA8KWqupIsSc4BQvgyBwAAAPQjyQ0AAP//7N1BEYBADAPAngIsIYkXek4bCnAQvjiA3uxa6DOTVGEOgJVYtQO6Os5rChkBaGOMMZXlAACAP3p9w94cCICvJbmT7IuMv8rjAQAAgB6q6gEAAP//7NwxDcAwDARAG0EZFFMhhErXTmXsKlJBONEdhR88WP8KcwBs4znHXOi7JQos6PBkBGAVmfnORWmBAQAA3SjLAdBVVY0NSnPXf2sBAAAAeouIDwAA///s3TENwDAMBEAbaSC0UEIpkMqgstS5sxPdIbD0679sMAfAaaq8+0gV2NDwZQ6A7jKzij2XoAAAgKamb9gAdPWN5tbGAdUg/W5wBwAAAMC/iHgBAAD//+zdQQ2AQAwEwK4RNCAFCScBHajAEk6QwIc37yuZUdBkP5s0TR3MAfArxzLudyEO0NEpNQBmlWTVtQEAgFkl2X3DBqCBraquxkGNCWYAAAAA+FZVDwAAAP//7NxBDcJAEAXQPw5Q0EoBCUioCs4991ILSMASOEDBkk24ct+S9xRM8g+TTDLfwxwAf2ebljXJU7LAAZ1vr/tFcACMpqpOSR7fFmkAAIChVFW/qe1SAWB0rbVeANv31vugYc1VdR1gDgAAAIDfknwAAAD//+zdQREAMAwCsDqZ1Unf7VcJtJdY4A0ozAGw1ZUsMJTnHgAS/bLckQwAAJCmDXwAwAitNDeVlzkAAAAgW1U9AAAA///s3UENw0AMBMA1kSgMCqEQQiEU+gmIojgqZRAMIXJR/wVwV80gsLTPlW0LcwD8pfeytyQf6QITehxXUzQCMIyq+h6jeEoEAAAYlG/YAEyn934meU2a3FZV6wBzAAAAAPyW5AYAAP//7N0xDYBQDATQ1gHSkMLEChKQgDaMlLCz80veU9Dk5rsqzAHwZ77MAV3t63VO0gPga5n5LF1vggAAAEaUmYuBDwC6qqqj8QjsPMANAAAAAO8i4gYAAP//7NtBDYBAEATBWSNgAUknAR18sIAFHGAJBwQV3JEqB5t+bsZgDoDf2qZ2JTkVBgY0J1mFA+BLVfWOtw8RAACAHlXVkmQXB4DBtST3gCf4YwEAAAD9SvIAAAD//+zdQRHAIAxFwe+kFpFQKUjDSXrBA6Sz6yDXzLxEMAfA31nUA10NX+YAOGzuiBsAAOBGDnwA0F5VrSRvwzmeHa8DAAAA3CfJBwAA///s20kRgEAMBMCJAhxgASkgAT28QBqKlto3AjiqW0GSeaZGYQ6AX9vGtT8YDikDHzQk2QUHwBOqakkyOz4AAPBGVdWLBZNwAPiD1lr/B50fXGV9wQwAAAAAd0kuAAAA///s3UENgDAMBdDWARKQhAMscNoVK9OGAxwQEm67kw3eU9DmH5vme5gD4A/uw/kpaWBAaznqLDgA3pSZk6YGAACgV0+bzS4gAD5mG3CdpYMZAAAAAFoRcQEAAP//7N0xDcAwEANAI2mpBU+nQmoZlcFnCYYqie4Y/PKDJcsKcwBs7zraZ6UJWJj/BcDf7rF0CgAAMCN5GQDbqaonybvYXecosgMAAADMJUkHAAD//+zbMRGAMAwF0EQZOEACVcGMlForSriOGOBaeE9Bkj9kyMXDHAB/0Q/oTdrAhLbjqqvgAHhDZvadsxs2AAAwoswsEbEIB4CPOidsqwxQAwAAAMBTRNwAAAD//+zdsREAIAgDwLCB+1eOauMMHur/CBQ0OYiDOQC+sFvmbgwYAGJ/AXDQNGwAAKCjqhra5QB42aUtc54+AgAAAP0kWQAAAP//7NxRDYAwDAXAVQEOAAdImBVUIAIVWMICSki/UECywZ2Cpu+rSVsHcwD8xj6uufx7ShzoUN2uw4dOAF4VEXmgPekyAADQqJxZBuEA8HG9PVFcImJuoA4AAACARynlBgAA///s3bENACAMA7B8DP9PLD0BpAL2C1k6pIqHOQB+MyUOXMrKHADH1FKDWxkAAGipivhDOgC8zsocAAAAwAZJFgAAAP//7N1BDYAwDAXQKtksIWEqELETEqoNJYQTCki29D0F7fU3P1WYA6CU2caOBwaAVz/vVJoD4C+XTw0AAMDC5GIAVJKb7XosMAMAAADAJyIeAAAA///s3UENgEAMBMDWAZJwAhJ4nR604QAFJSRI4HGXm3HQ7quPZj3MATCjXerAoI52nYvwAPjT19SwWSoAANCjzFzdLADMpKreh7l7oJE1zAEAAAB9iYgHAAD//+zdMQ3AMAwEwDeCMCiGQiqesgizQskQDJUS5Q6BJQ8vD7YtzAFwnPd6viRd54ENNde0AfiBbAEAAFZmZgHgRDt9mWtVdS9QBwAAAMCUZAAAAP//7N2xFQAQDAXAjGITI1GZx2wm0bCBguduhKRK8fMF5gD4VX3sKx/AVtroyTQAOEFTAwAAcLN1s2RLAuBDLwXmQsscAAAAcJWImAAAAP//7NxBEcAgDATAU4I29PRVaeAEB6mJPmDYdZDJ4yaPi8IcAFd6Wl9JXtsHDuWrNgB/kSkAAMDO3CwAXKmqRpJ50OwKcwAAAMA+knwAAAD//+zdQQ0AIAwEwdYRjnCBDiSgDSWI4FPCjIvm0qyHOQB+NlXmgEf1sZfhEYArmdmUGgAAgKrcLADwVGXObgUAAADUEREHAAD//+zdMQ0AMAgEQBzUaiVWWhccdKCEOwckDDA8CMwBMFZ+mds6AGjKdW0AXpmFAQCAn9lZAJjuNKp/ZdgdAAAAoF5EXAAAAP//7N1RDYAwDAXA1gjBCRaQgIqJQAWSsABGRmaBry27k/D61TRtLcwBMLVzOdpVvmf2HIAhbeW9dqUD4I/MXNvHUuEBAAA90rMAQESt9R5slm1hDgAAAOhDRHwAAAD//+zdMQ0AMAwDsEAdpEEpxB5jsKuVbAjJHcVgDgCSIwNgqas4AD55KgUAACbzLgcATy3KwWAOAAAAmCFJAwAA///s3UERgDAQA8CcAxSANVQgAhVIKVZQwgMF/NrproS8LzmFOQCmd657S3LPngMwpO14LsdDAPxSVUsSX0oBAICeGboDgE8bKAeFOQAAAKAPSV4AAAD//+zbsQ2AMAwEwPcEZCO2omYUZmOSCKVITZdIdxNY/sqSX2EOAAaFE2BX9/U+TXoA/PA9nh4WBgAArKiq3CwAMO1UmDsXmAEAAAAgSdIBAAD//+zdsQ2AMAwEwPcE7F+yUdiEDZyCLEAFke5G+MZy8XqFOQB4VuZGklMWwIYOpV8AXnI3AACAP/OzAMDS3XeSa5c8qsrKHAAAAPC9JBMAAP//7N0xDYBAEATAPSXgAAuoon2koA0HOCBUhIoSPpmRsNtdsjmDOQC4rUkOeQAdasu+jYoD4E1VzUkGQQEAAH9UVdeNa1IOADz09GXOYA4AAAD4XpITAAD//+zdsRHAIAwDQE2S2TwKdSpGZBQaOhq6hLv/EeRassIcACzvUyNJlwdwqeZwABwoIQEAAD/muxwA7G4qzBl4BAAAAL6XZAIAAP//7N1BEYAwDATAiwMkIaEOcIEOJCAJDVXCm2H4t8Ougsz97pHEwhwAPB2+zAGT2vZ+utoJwKeqWpI0CQEAAAPTWQDg7Zook3WAGQAAAIC/S3IDAAD//+zdQRGAMAwEwEQBDqg19KCyEnCQTn/w4Qud2ZWQfJM7D3MAcHPux6WlCViYlkwA3szD082EAACAP8rMGQbVLAcAnqqqLxT6qmEOAAAA+F5EDAAAAP//7N1BDQJBDEbheQ5QQHBCUIAFHHDjyh0VSEACEpBAULAOfrIJpw0JEA5Mw/sUNG16mOmkQxIrIUnSxO52vDqYl1TU6jDfnC2eJGkKOLXW1r0lJgkdhCH9FLD44EHZJclgxST9A+Dd3ymGJJV+3ZD0BDAug9r2lhvPLNL3gHFZ5b5CKu159QoYZz/LCgWyj1TVY4HD7EX43s1JkiRJUgWttTsAAAD//+zcwQnCQBAF0F2wAEuwAy3FUizJDqzBEuzAElKCDKwwLIkXQ0zkvdMcAgkJLEyYPzsfCgBGXUopN68G2KCr7Z0A9Gqt+zWG5eCfpFBHDr/1QzazDLbVOjp3Fpvmc1gk6qGrn20rPcAiukBwDr/l+jDH4qqJszE80nkY3ktmhnRuGniEdTj7DgAwaTOBuQgdWWjBL7T/4Kd266keNK45fvN4H/rPe6pzz6n/BAAAWFop5QUAAP//7N3BCQIxEADATSPWYAnaydmERdiE15HawWEFluAngSD6kPM0kRkI+e8jsMlu1oQ5AHhhfx27eXQAeLA7rIZRUAAoUkpDRBxbDIgfp+lFVXBTmuBKoU2PeWNprpvyOufpTCYVA2+rfuDf5H39qSa4H7hUhYy3XJSs2Ri+IJ8lpxZjLWeB+UyYg/lavt97YuuOgaX8UQ4q/wQAAFhSRNwBAAD//+zdwQ2CMBgG0HYCNjCO4AiM4hSe8eoUjuAGhg1cQRcpwVSjJJ7qoQ3vJb0TOJV+31+FOQD44fA4zz9Yr94P0KA5AL09bfamEwLwFGO81HrDnCAaNcrBm+XqVvKx7jmo816COkD4Lg73OYy4K53K35jxo2R8EwCG/6q5TGPPAuUU5qBcvtm+lbPrY0ppqOA5aNhieNWrFLeWgcf2nwAAAKVCCBMAAAD//+zd0QnCMBAG4NwizuAI2USn8N1Xp3AUR7AruEE3kEqEUqSorZjS74Ms0IdArvffCcwBwIjD7dxtaNr5RsACHU+bvZ+RADxERLUFII1o/FtpvsnlbG0af6ktU667Jp2LJh1YhxIezr2Q3BI3xv1a87wby/0oYAxfiohrrSFcbxaYTmAO5lFzjW9AYI6P9QZY5RUOaHlHM6jPeX8CAACMSSndAQAA///s3dENgjAQBuDeIsYRHMERGMEpHMIp3EBWYAM3MLqAbFBDAgnxwRhEU+L3JX2n99SD+4vAHAC8sL8du1vKLmoELFA31Lw5rHY+lgD8uYioUkqnUqtgEI1fewrIVQIgkzX9kE6dcz4vdA/AyCggN6x/+bPmnK5DeM4AI7yvP5/dSy2ZngU+JzAH84iIdiHn9CbnvC3gOShYRKz7d3N60GmG/rPu+892iZsAAAD4mpTSAwAA///s3cENgkAQBdCdRqyJEujAm0V4sgOxA0rQTtQOrABjsibEmHAADIvvJRTAcNpl/ozAHAAM2N2bYn7iAXw47Td1rSgA/y0iDiml7VKLoBGNX8ghkCo/plNP79Fr0Gk16EA5crC+skFuNrde82K70neE0SLidX91XGolnVlgPIE5mEZEnAvZjC8wx1f5DGqI1Twuvbs5w1sYFBHvsGoprl3XNb4sa5LD40X19NgiDEBRUkpPAAAA///s3eEJwjAQBtDLCI7gRLqBTuE8XcFNdAKlGzhBpBAhoNIfak31vQlCSmhT7rsTmAOAEbu+G7rbnnU0A2ZqacocwH9LKR1aDggpRONTSkhuqwDnK44R0SnQgfaUKU63kNzKI5rUpSpeFJ6DSkpp+G7YtLon7izwOoE5eI/W35k1Z4m4v4OaIjcd/+YYVYI6p5nt1EKzNn5J601PH9jnnNfNrQoAnomIKwAAAP//7N1BDQJBDAXQ+RjAARqQhAR0cAEnSCEoAQmkSY8EOC0ZeE9Cs5lkOv3bleIAwGuHza6aLSdlAiblL2sAf6wHEmzT4m9USK4eGJPUIMilHxqF5ZZX586xBi4qtJtk3+cR8CW1vSlJhbRuvcVJWG556x5uPie517Bzb1cAxtiqAQB8RPCFKdRd58kdVFhuOXpzvNVhyutkldJH4dfM9k2bPwJgLmOMBwAAAP//7N3BDcIwDAXQTMIqMAojcGIITozABrASLABMEGQpSFVPRULIIe9NEDWHNrG/KzAHAAscVtuYfHn1rIAOrfe308bGAQzLO4C/F5NwW9OHkFxO7wadezRKCYfA77QQcYSyHkJy6czDc8c22R2GY8gHAHykm7/q+L4dz+wMenYGTWN6Nxf7o2bAVG/Dw3cJ1gBf0WolPdWynrXWS4J1AMBypZQXAAAA///s3UENgDAMBdA5QApSkIAVnIEEHGCFNOmBcNoBEsbek1BOHf2twBwA1FvUCmiUK5kA/fLzm9+K4Y7cVH3k0IeQ3PdNl3DIYngOnhfBk1uIeLbF//OGDHvH5v8trgH2XhC6o2cBgHp7Q7XS83cge9C4aL7rQZsQ32eNNwO9J6m18MvoTZkfcV0OAN5WSjkBAAD//+zdsQ3CQAwF0BuBCWAE2IBVmIKWnooNgA2yAcomEYscsuQCUSFRmXtvg1ykSM752wJzAPCl8/oQhd/svICCtsfnzaUHwJg0n/JX3ppwIgjyMKm6rGicOmU4ZDLZGn6X2zbj39UiRFzaPrYBChYzmJ0XDgBQS9agl6xBrzYGl7P5qD1Xox/IqHrvsRHyXuzx9T1QXn53qwXmDOoGoJ7W2gsAAP//7N3LDYMwEAVAu6N0AtVwphRaooIgGnEuRkI5hZzYZaYC3yx/3j6BOQC4RsscENU87YvHDoDn8VGBFHpQbj59whEEyWPok621KsEfvto2TfLP4xwsXgTnSE5wHgB+F6lhTig+oVrrqw9refembGfQ2I6z5yY492jRWubcIZPBGGwPXVtr2w3WAQDXlFI+AAAA///s3cEJAjEQBdCpZC1NS7AD79uNHWwHtqCVRAIRxIu7LIiZvFdBSHIZmM8XmAOADeZ8SgGoAAAgAElEQVTptETE1Z0BHapL5WcPBzAOjU1k8BGUu1jCSe3VqnQXnIPvWlBu0bY5hKPgHMn51wCwUmsC6oXgTSJvM+itzSjkIjg3sFJKDcw9OrqBQw3v/sE5YA/tcgDwCxHxZO+ObQCEYSAAehNGYSVGZSQKTINEQcfjuxFSRIqTzwvMAcB7AidAqk3LHMAoLgyJJSg32iI4B89uQbnVUo0iOMfv9ENczcEAAB/VjXLOoHNcwbndXG6ctJY577aI1XO9tA/Q0vYIADhV1QEAAP//7N2xEYAgDAVQJnE2R7G2cwPdxBF0I88TTloKi8h7IwBNIOEbmAOARvMw3g2bi3UDArofOSYbB9ANjdSEY1COShmcOyRmwtNIoUmRzOAcf+KTDwBod1ozvpZr0DUnyqlB+1Pu5XZJXt2Ilh4VLZ0LatHO7xYs5RgAXimlCwAA///s3bERwjAMBVB7AkbJSIxAR80orMIEsEHu2IAJnNOdilw66ITf2yCuIvtL0jAHAL+JAOfH2QEFXa7vu0AdwBw8ZFNKTi1+aZTjYIkGoQzo+I9lOtlIHKGlVUiRg3NO/b/lli6oSM0CAN+rElg2/Kag3TCrNWsO5hb3EM+4l1B3/rcxRgywexT6yFPvXdMcVVXbkGi7HAB1tdY2AAAA///s3U0NAjEQBtBWAQ6wgpV1sOjABEhCAjjAQQnJR8IBDnDaYd9T0KZJm0nnR8EcAPzgsJ1uBTssATy5vwDWQfIpJTy6FGdq0jHdi+GdXSYqSdBhNXrv+0zcnJ06H2xSaH6WKEZR3nQAgIVIM6tLYgx4NSfuVAj7307FdjctYA3wlUztrPQPdh1jKJgDoK7W2h0AAP//7N1BDYQwEAXQOkQKt7WBBRwgAQloAAfrYDMJh3IgYbnANO85KCFphvL7BeYA4L4InKyeH5BQ99lGBxoA7dPQxatVrUmL1iT+0AuG0Lo9SByNm4P9nIviR5tJGycJ+T4FAPCwmCGqy6zMoJyJuXN2mVXTIhTzTbTAzrtIQtmCntmCtABwVEr5AQAA///s3UENwzAMBdAE0SCUUiEM0iAUQhlsEMogUyX30lujalqs9yDYUg5Jvi0wBwCdYsvcU/2AQTm/ABIz6ZV/F2Gn1dYkOh3BkJdPEWRyChI/NJcOU4SKZ8UDAEjro7Xcpda6vxe+DbPigv0+d4ktSSTSWtsiNDcSQ9UYjcAcAPxSKeULAAD//+zdMQ3DMBAFUCMJhUIohFAoiq7du5RCGBRDIYRCiDiydEPHJs7Qi96DYHlIfPf1BeYAoMNzuLUfw9kZAgld78uU7TEOgN8JkPCXIgzShu7vCD1Bj7EtCmqb4wxi0UyQmCO0RoiXtjmSsJgNANsJzNHtq9n84TTZ4RKhObPm88kWjnEHSSPmGJmaXD+1Vt+dAORWSlkBAAD//+zd0QmAMAwFwHYCR3JUV3EDXcFJKoVsUMGm3G3Qn0ADec/BHACMk9gMZKVlDmBd0l2ZTjQf3nHkBF/ZtM2RXST6Xw6J+Zi2OQAA/mQ/Oan4I5yazRnUd3JHrVX70EJaa302PIletAsLIpFswX/mOwD5lVJeAAAA///s3Q0NgzAQBtBTwqzgAAlMxURMxSTMAcHKHMzBckmnAJpw8J6C/iRN7tKvFZgDgI2ewz0bRqt1BAq6PT4voTkAoLsWBlmEQehoasGQ0SJTRV7o8aI/nf1/mxMq5nBcagSA06v0g8olZE2QtUHWCPaHHc3Z21Bznkq1kEy1EBIX1M7IudDMvxHxPsA4AGCbiPgBAAD//+zdUQ2AIBRAUUhkFaP4ZR4j2MAqzgQ2wLk9E+gYuHMS8PsGlyeYA4BvWPMP9Gqaj8UFBsD/CEZoQjzEEYNQyx1kbhFoQtNyzmNs3fSjPzU8UbEtH7REMAcAUEnMAnvMBvC1wcz5K70Fczbr04Pews61lHI2cA4AeCeldAEAAP//7N2xEcIwDAVQaQI2gNXYhJ6KFTIBK5AJsgKbmNMdJWUC6PLeBva5kewvC8wBwAqux3M1lyd7CTR00EQGALbw/unrKQzCD1z8psQ/y8xbRNxN9OfLKlS8ZKbBXwAAsCOZWfeAixqUjVXN+RCa62+MUT39udFCTs4dDXR7k9MtOAsAn0XECwAA///s3cENwjAMBVB7AlZgFDboKHDiyggdATZpV4FFwsUbULWJeG+CKL5E1o/twxwAbOdWK8kBRvO4f16megMAm6kgziKIw4EmIR16U1s314i4Kg4Hemam0AsAAPyBevvPas1OTtWPu7jw4Y3WNzAciG5l5nmwwZLv1trawTkA4HcR8QUAAP//7N1LDYAwDADQzQgWkIAFHIAUzpyQggOQgCSyZBKAbeQ9CW2T7dCPgTkAeMjazekU+SaeQKMWiQP4lUE6KUUjDhXpc5POKCmUloc3T280lZhijJdLnBSmiRYA4CV5YcuV/v5izMfS0Nzhunnz9sYWhqs3atZafVq0BcB/hBBuAAAA///s3UENgDAQBMA6QCIu0IEDcIAVNKAAByVNePRNSNprZjT008vuncIcAPxrdWUOCGperl1QCQD4rLqcJIhDT0pI5xDSoaWqLBdpkzDjK+/xdIkTAADG4g9KJzbzuLhyzvdbmotisjSNjinMAUArKaUHAAD//+zdgQmAMAwEwG7SFd3IGZzEFdwkImQCKZLI3QSlgUIhzwvMAcBC2TK3uVOgKS1zAMAr2VCjOYnKniUdrfB8LpfDzgxvQjUzmziF5gAA4AeE5Shm999srVtoRmCOcvINnI0mc0TEVeAcALDGGOMGAAD//+zdQQ2DQBAF0F0FdVArSKEOuFVETYAUcICF1siSJnvgRkgI2UnekzDH2fl/BeYA4GKf5+u/NPqaKxBQ9/5NFskAwCn1wW91iEMAQ85ZOyq3qWG50cRp3KOG5uwDAAC40mKa99qF5RS20BIlLUGVUuZgt099LfaDlkQr3Y/0syQAHEspbQAAAP//7N3BCYBADATAdGCJlmhtVhARFA78COJx0Zka8ks2KzAHAO+oVqcOcNK6AQDc1hziVPqQyb/NQnP0ICxHMftB7XLMLQAAYxMG4EK7OQObhOZK0zIHz1SayTUz7U4A+JaI2AAAAP//7N1RDYAwFAPAzQhYQwUi+MIBSEELSggJPwhYWMmdiSVd2qcwBwANLMN0WM0DQo3zuaetXAEAH7BaTTClOZqqta7KcoTalOYAALqndMKLwRYC3Pnx7vpXpLQMVaZBN573Oen/zHU5AP6nlHIBAAD//+zdMQ2AMBCG0asTHCABSWzMSEACFnBEMFIWVjaa9Mh7Cv50vXypYA4A2hGcAFmty7U7WAAAr8Ry/IBojiaeWG72uiQmmgMAgCTEciQyijHyqbWeEXEkGj6VUoYOdkAk/PFw62ADAHwrIm4AAAD//+zdQRGAIBBA0W1gA6sYwQrmsYWNqGASvHD1BjMs814C2OMOfxDMAcAg936ViHjMF0hoE/0CAH/EcixENEdX7aGiWI4ViOYAAGBybUcnliOTwy4upWyhY7ZIiQW1HzXPRDd7a61lgnMAQF8R8QEAAP//7N2xDYAwDARAj8YmrEBFzSiZjQ2YwIgOWkQkHN2NkLiK/B+BOQDoa4uIwxkDBS3r3rSvAQAPwnIMSGiOT2j1Z0BXaG5ysQAAvGTpuqPbGx1UMytoqSUzW7G9J/PFH1SbQ7/LATCmiDgBAAD//+zdUQ2AMAwFwDnAARaQgBX08DUJSEASEpBAQuaAkLTNnYIm20/TvU5gDgB+tM/bpakEkppG6BcA4DU2Yh7CchQkNMcnwnIUdo6HuAAAxLEmOYs7QA0lWWhFAV2vmU6mX+YW94sAsgXmzEcAqKm19gAAAP//7N1BDYAwEATAVgEWcIAkXKADCVjAAVowUkICBkgI3GVGQp/t7lZhDgDeN/tlDghqnPbFZTIAcJflziDO4DRIyro1j1wBHGU5sjoDuJugGQAA/INBK5LolDPCiTYU7p6Xz9Ra+2BvaWtrzdABADmVUg4AAAD//+zdQRGAMAwEwChBExKQgA5MYAkLOMBBGRgePOHRGVJ2FaTv3iUKcwBQ2dQNmytNQGKuZAIAcQUYlOVo3aw0xxu3rf7QsjPIeAVzAQDgKcHrOiy0ohXHFTD/0EmUUpaIWBON3H9gBv5rTPZyBWYA2hUROwAAAP//7N1BDQIxEIXheUbAAhJ2JaAAHHDjyp0LFpCAAyyAA4KDVfBIk17hAA0wu/+nYHaabtJ22pFtRhgAgC/Y3o+3iJiTawAJ9fvZmiJQAEhEUpoNH9v6gzDwQi1c2JAjTETpEN/VIhDgqXp56MJeDybkaptOc2hGUnlkbpcho6xZgM8x54E2JHURcU6Szt42Z0sNSSoF7avRfNDvDXVd/64Fnf6a4F+RhKRyCeiQKOSl7dMfxIGJkZSpPnCwzSNZAIDxiogHAAAA///s3dEJhDAMgOEWHKSb3I3giG5wXeE26G3gJjkCKQQf5LBcpfp/IOKbWhQbk3RieAEA6EaDRy9uN4AB6Q+4xMABAHA/ttoWxXLtPq6z+jYBpBzouq4JOf4nZnLfa4kCniaa6JR15TARoRs+9mSetWY+OXG1zTuSMPfcHPv35eOcy7wM7f6/iAgrcQIAAACdWaEKxXK/e1u8rbi9Kv+I91hTndpgpM5D65656L6FONww8mAFc7OdM9BNjHEeLGbM6nIAgGsLIXwBAAD//+zdwQ3CMAxAUXsRxAbABt2AFegGnBiCGxPAKHQCGIGyiFGrRAqViqiIEgL/nXqMLDWtrThmwhwAAAnt7qczBVEAhar3sw3FMgAoBBPmEEN3UEFELgTzbU3Q8NE3eeS8HTk4qOOb6fzzIteaCtOY2bDxBugxeXOSNtgX/SHFm5kNm+OScd+3cI9cMhlgktrMqA/gY0ybAv4L7zwQh7vY6FhIOFdMb4+DGt1Lrcszry7vzJpvjlFVX5+rXP5ZkYM+OZjZ9ovWgxGq2jWgrQuJT3dR05xmTKRU4DRY/tcAAL9NRB4AAAD//+zd0QnCMBQF0HQRZ+gIHcUpHMIp3MARxA3qBuoGTlBRogQ0IlSKj57z3a+EpOTxbiIwBwATWp03t8LnzpgDAd0LyuvFUkEZIACBOcbKYave60lV+6IRp//HRpxPmqbpioBIZ56rNOvwIt8SvDUyb10e+2KxP4Y5Q+YGxnJvFKKr00zDaMIzMC/WPPyGtTQ/uUZ3dDZ5OuUXo0LW5Eo5CNnmV7AE6JwzQwgW3E4u/WFKAf/Zh2EY2i++A4C4UkpXAAAA///s3c8NwiAUx3FIHMAJXEVHYAQ38ObZsydGqBswQkfQDYyLYGh+1Niz8if9fhLuQFMSXt973fD4AAAo57o7jufXcOusmwwAGAX1UrLwhd0AAGAVBoqovjyUiBNq/jXuV7SGeR0qEjloOBJ0Zidr7RhjDI3MB5XpXSHJ5iMXyE2j98Q2JVo+lXw5UQJjPhv3dWfYlJD2hi7tAAAAxW3Z8tUJxGmmxlVBcbluC+SWdIe+5ziDGlw5jTXGZb3u32hYKj6z1vqOziVHLA8F9fZtxTcwBwAA/ssY8wYAAP//7N3RCQIxEIThTAmWYAXaiVeCVdiGLaSFK8UKBDuwgshChDz4IHgc7s3/VXAsCRxhd4eEOQAAVnZ51GiuulN3AAmRMgcASZAwh19IiiH5K0Us83tj9Zaacb7RB0TOxg06o/gHPrqdAXwmKRrZDubleQ6NilbDpH1L9NjA6N60OrfWpj/4DiRFQg7ghTsPLCOWuiRZ5EBiyQLM3+hufcilOi7q6On2k+EiZtLAEpBUk53NPW+7WIOkeCs9JSr2jmVYAIDNK6W8AAAA///s3dERgjAQhOGNDWAFDi1QidIBdqAd6KtPWAKlWck6N4YKHBW8/6uAJAMzSW6PDasMAMB33XZDHMRcmXYAK9TQZQoAgP9Wg1KZw3JRjHOsF4WHKNDIeJkeHa5tn2xHw5dO0r2GZDJq6EIMvb6PY+KwXLz/k6Te9tb2kPHPi1FAEuOu44/wXF/D1VntSylD4vEDAAD8QruSWaf4+k1Jz+jmvWcXgUvbY9ZC/nnvGWeUks6SHgt4rG+41GY1WLa11QvQ7AcfV0ppVxaWmwjLAQBSkPQEAAD//+zdUQ2DMBSF4dYJKJmFOSBTsEmpJRxgAQk4IE1OE17gbax35/8UlKQlaXPPvQTmAAD4jWJcbAggtkmTMgEAwJ9RMYJjMGhTIGxUMY5l5+ozh/BcC4fMfa70qx6aiAFTOec6Vext+PUtRDy4huSuqIDxaVjAeFRUEAQAAIB7RJkCv3Swhuic3uhW3ana3ZP9I2rcUtTU6mVw76z/uE8H68AFndFIe5FmP7hDtGAm77wAAA8ppR0AAP//7N1BDcJAFATQVUKCgmrACRLqgJ5xWQdIIEv+oQcOJSQly7zn4m92ZgTmAOAH7qfrw0oTMDALGwDwn5aw9aR1EwSZE5fkPlXhkB4cOlfjd5JbtbsTJjRM3FfTLkLE+7z5wJgULLbCCQBwkMFuUjfEF6q0J+GN7vU212+p5DW5veo+TwjOzVbmhjDSf6dJ2Q8HGCnsuypGAyBGa+0JAAD//+zd0Q2CMBQFUDZwA1dRN3AEp/BX+HUK3YRZXKSmSU34NBiCj3fOBCVAmrz09grMAcBK7vtLn/TmaSC+w/X1OHqPALAdydqTpodxBEFmqOHCeuN3C84NiRrUhUJy6gO1OPzq2do2z6WUMfajrKPtK3VPPSUKztUWTg0AAADLi3TYX0PYTC3UcQu5+O/VOdLwmc1FWfS/mATntjqT22mZCyHav+ubYjHtUoNI82NhOQDy6LruDQAA///s3cENwjAMBdCMwgaFTTpCR+lKjMJGyFIO7akHQCT2exM4ucXKtwXmAOC/dvcPTMqWTADIpcLnlFNQboB6pteDc/GuvRfZOLf0Ke8UUShMHMGuRwRhbdv8jggcHoJzrwxnurCb1g4A8HM2zNWQvWcV/aNb7yfxgUNPLuOwFlvmBteH0D0nKnkdoAby2iY7mb8+ANTRWnsDAAD//+zdQQ0CMRAF0K0CHIAEcEBwsjiACyJQsVZWAhZwgIKSJnMiHAihIe2+p2BPm8ykf77AHAD80XU9Tgu6Ng30ZXu5T60t/gCANyIA1HN70iMuLu8E5ep4aZzrfcY9CYUsSu//jBIkPpRgV85ZA0QFEZwrDxiPnbdxrrRwAgBU10xgTmP1d1JKZbeyb/HbP3CL+XOMoA0/EDu5cqzl3NnMqWWuDS3tATZxGAtqaOndzOxgGgCLMgzDEwAA///s3VsRwjAQBdBEAZLAAmb4pRbqAAlYwApGthMmHwggQLbnOOhj2kmbe1dgDgB+T3saMKvl8rxp9wOAifXgzzXxNXz0oNxiM854b5t0zomDIUIhO5E8TPwKEveJmzayfkEPbLd37pr4MI+1Vo3tAADjzBKYy1wUMUyfppV14svaikSsP8eJiHbvnJJNODdl7s9FxH2yZ74yYD6ufws7THRm/dsAYF9KKRsAAAD//+zdywkCMRAA0HRgB2opWoIdWIpnT5aipVlBJDB4FtG4M75XQWAXdjNfDXMA8GPn9XEEhm+eA5DQxnQ/AEivanJsJOoPsTXJtMzJolhiW/iuqymkuOLNxM9G4gWc5a+Mxu3e+7hD72O7X0UXBY0AAJ8X/1hZBnrYXv2eU7KC+1fcY6ucXOIEsTl+Vyget9LglEKm/IJ4Lt+Q6b0a3+XrAs4BAPO01h4AAAD//+zdQQ3CQBAF0F0FWEACDmoBB0igFnCEFRw1DXPgRkhouzN5T8Gme2h2kj9fYA4AxmBIDGQ1a5kDgJwi8DMVvL41DHKO0BYHiWDItXDbXNWt77xVvd+HIPHxolXhUrRtzmIdAIBtZGmXawJzv4ulLfds5/7iFfM5rXI7+pjHVXlvel+OL1Ng7tR7F8Lkb2KhwS3RF32u/4kBzgEA+2mtLQAAAP//7N3BDcIwDAXQeAI2oCvABmzACjAJd7ZgJDboJkGVgtQrUiQS670NXOXQuvm2wBwADOB5vK1JL8kA+R3a1EsAYD4ZAyHfMIiffoPYbZt7JyttiQjvwQlFxDaN/Zqssm2b2dlWuXHsts1lDBU/2oVfAAD6uUz0LA3o+F22Ht2r1nrSn/uf9r15T1DK0oa+Mai22XCmvq/zRE+znaeZAq4A0Ecp5QMAAP//7N1BDcMwDAXQhFEpDMGgrKedB6XUOiKZIpnApB4c9z0QiRL5+wvMAUAen6Jb94H6Xu/vYRgOABbSe9+jBaaK+ZZ6CIPkFMGQim1Ke2yRpZZqg4qzdXOLASaSiVDxVjBU7D4GALjWSoE5b48/FFzaMpdZaXBKYIxxFAnNaZnLb6UQztN/Lhda6Xw6tb4CcEuttR8AAAD//+zdUQ0CMQwG4E0BDrBwEk4KYAcXJwEpOEACDkZIigACD13v+xxsD8vStfsNzAFAEtfj+Vk04QHYB+cXAEwiHoQrNbLfYxjEY19yhX63/ji4B9fSe3839S2FFrVJ3cxvjPGIBuhboWWdovEXAID/WGfZR/WZr1Wq0V18ZpVLkaG5VYp5erOlVhnq5WdxLs1UR5YuB8A+tdZeAAAA///s3cEJAjEQBdCUphW4HYgdePJuJ9uaViKBuXtZIX98r4NlAgvh/4zCHACsZQbtXmYCBLo83rswHABkuFfRp4NZljtV2YAAFdQ5N9qwfhXaaaVbUFEAKERt4txmybHRZwnKAgAcIOwhgm6bk3+qZhtThvziVnc+LKbm8gyfiy1zC6uHmpIeAXJfxhHSzpF/NAD/aYzxAQAA///s3UENgDAMBdA5QQI4AAlYQSIOkERIeubEoS3vKdguy7a0/RrmACCRSJlTTAJU5fwCgOQiXa5LgcGTnLRITqonps1vjZrm3IMbiHS5qcl2FCoWFU2OR5PtrFLmAAA+UelOdSVYQyVd/hO8QZOL5L/KA1r2BGvgXaUzYDYAjQ9Uapg7DZ0E4LfGGDcAAAD//+zdQRECMQwF0MYIawEHWEEF971yQsLiAClowEgYZhDAwKUJ71nIodNOf77AHABM5rw7brbvAUUdTo/NRjYAmFuXdrmr5qTaMvPeKDSnZa4HHxWZQmZeXnNsMg2BYgCA31UKigjMfahRu9zqDlrD+y216j+UJSKE5iaWmbdi77xaC/laROyLLV5zTgPwv8YYTwAAAP//7N3BDYAgEARAOrIV++/CDvxQgAmf23WmBDCBbFhPYQ4AZhLOAKk8hgOAoYqmyynLlSgrzbkHByuaLqcsV2LvY0NpzpQ5AIAD++csV9AaKsx915LRyUOy3ME5nMLcfEmZlO+JE0ln+CMvBuDX1lovAAAA///s3UENAkEMBdAqYSVhAQtcEIEKJCBhLeCAYKSEZBTshbZ5T0EnTebQ9KcCcwBQ0P102X8n0fUGaGi7fR5CvwBQ04TrcsJywwwKzbky19uEBT9huWFWP68DXmWBFgDguFYL/Zm5FyijvDU/ODd/xsuMrp/MfEdE174JONXXaS61rSthcESn/+hZoAYA+J+I+AIAAP//7N1BDcMwDAXQBMGGtudC6BiMUimUQRF4qhQA3S6LrfcQOMrtRz9WmAOAeQmYgazW5Xg/3R4AzKPIdrndNu6aCpXmlEISKrJdTlmuqIjYrrJ48tPZMgcA8LtM78U+g70ve35wjhyHhCLiKk+8Eo7+6L0rzU1sZLx7opG9NfC1kSVn+phym2AGAPif1toHAAD//+zdQQ3CQBAF0HWAAyxgAQmVgB5ulYIj6gAHS5rMiVMhHPa37ynoNntoZuZ3BOYAYFD38+25g4EY4JhOCswAMJy0Jt6ntdF+7b2/xnos/qUGKtK/IacKp5IlfVBxFpbbt9ra8Ag/pB+DAQB8qbaQXYLem+1yG1TdID30M6nRxVtrIUvgIQTmxpcUznGf+EXSvVmq7wIAx9VaewMAAP//7N2xDcIwEAVQj8JGjEBGoKJF2SQjwEoscgjJFVXS+cfvTeDYbmLdvxOYA4Cx3U/QYR+Y0/Px2S7OHgCGkRxE+v0TLQpxzq+HftbgD9U4IkyfepU8Xe5dVe7cHJawLu3/br3gGwCA/dIK+QXm9klvarVWlbMO199ZE98TBJzG9wpaq6mFHNJD79egXTNdDoDptdbaFwAA///s3UENwzAQBEAbQRkEUyEYSt9lUSiBECZlcFUlA2gelbLJDAPLftgn753AHAAc2HMZbw9YIFj6pAYAOIXe+wgPhAxdMK+jqh7hk5RMUcqS/GbZnLfrmJ8Z7+GNtYQ7AQD2ibo/CVH9LPlevM26DSdQVd9g0xq2kttsfsRBzfrFK2h/1NbYI+28JAVYAeA/WmsfAAAA///s3cENAiEQBVA6sRRLsAStwrsdbAm2YEdqI2xM5r7xtPzlvQ4IBJKB4WuYA4DxLVLmgFDX+/fp0gIA9pd86fuoxxvM5bdmP6EjPlWTKoOrtKtz6DxJ3pxQ7/0dfqbf6iduAAA2BKZhpzXd7OIAKefqHceTOKcSwcaXVM+/qFXwh6Q981W1RACYW2ttBQAA///s3bERhDAMBEC7AkrhS6QFOqAVOmN+RsFnkNn37FZgO5PGOhmYA4DJ1ZY5CcxAKkmTADBQ7/0TPBBySq1+p59NSql8IMuQ3GvZbN58pxoi30Mvv/jYCADwWFq9IuzomfRQK3Xon6lhiqRtYF/CWidXvYukMDS9Cm5V+Noa9FLHBGcAgPFaaxcAAAD//+zdwQ3CMAwF0EzCCozQERgBpuDOlRMjdBRWYAU26ARBkXyHW23y3gSWVaVq5O8KzAFAAffDZS28XR+Y23J9ry6ZAWA/VQMhm9DR3GII61a0CUuEVcmt6hkztgM/EtTBTnrv493+Ktp/S8EAAL6IgexTsT49E9SQWvzB6Fy0/DGn4Dv0f1VbWHaMc5LcKnkVOIMAACAASURBVAWp3VXwi0rPyRbBVQCYXmutfdi7YxsAQSgIoDCRKzmCI7iqG7gBNlBrY+TiexNQkBAC909gDgBy+CwKpPKIBgDfSQ2u733CMT/WGwZTQyHu8BOrta697SqNMDFD6j5YBIoBAG6lhVcOzWOPJA+X3Fpr5wTr4AVa5nhJ0v8AIUyeSDrHtcsBwFBKuQAAAP//7N3BCYAwEATApBFtzSoswipsJa1YiQgKfgK+xMWZEjTIIbdZgTkACLEM03EzX/O+gEDjvK2WOgHgZcGBkKY9iZvUOdL8+22x58qSIiW/hdP3EQCg41zYT2sh02DyTOoc3LTU/EJaUFdg7uPOIGbSRWj+VdBVaz3CcmPQExKYA4BLKWUHAAD//+zd0QmEMBQEwHTgdWRX1nElXAt2YAuWoJUcQj6CoOCPZGGmgvASAgnZPIE5AMiS1OIdoPWd9t9HRQDgVYJGxAsOhQw1tEpn6gPUMXBePFLk7AiXb4FVsTcCAFxLC60clg7G0LXgc2gJXZM8VMNNc1DdBOYyJH2K566CO0nd5VadfwGgUUr5AwAA///s3ckNwyAUBUCowKkgbsEluRVf00VKTAcREgd888niyTMVIIFYxF8kzAFAkM97b4/arzkDAi2SfgHgPsGBOEcP0IBRalJI0kf6k6TOi8AdTnq3wcR1sfTK3AAADEK7y/0U9rgk9f7bCrdIiHyOpI5Ea98zmVvS+dDW1DbBOJhMrfUVdo7rLgcAo1LKHwAA///s3cENQEAUBNDtkFKc1KMVpdCBDkTyDxIOTmLivRJ2HWT3z6zAHADkOVrcNvsGBBrGdXJ5AQDvSBzEWcJaZ3lJhUISyxe6ulDnWxK/JWFibtXw6hy4OgKgAABXiQPOwnLPpP7/el3uRyr8mlRY5ZW5j6sz3aRCcGcV3OmrHDqFwBwAnLXWdgAAAP//7N1BDYQwEAXQOsDBIgEJa2WlcMYFzrCAg73MgQAJN8IP7yloemnTmd8RmAOAMNPnt2giBUJ1imsAcJvE4u5YRXQ4qKadxFCIKUoPUj9F92HLXr0DcSHxzBcoBgDYqAm838A9EZi7UPfe4dGLPGe63DslBS1MA8uQdE4IzHEm6X1/VmMDgJ3W2h8AAP//7N1RDcIwFAXQVgEW5ggJc4GOSZilSWBGSkK6kPABPyPhbudI6EfTtL33CcwBQKbJlDkg1HhbZw8YAPBDtdYh8CPO0lrTfMk3ieULAnP/RZiYw+nTB5Ma2zf2RwCAV6AqsSTj3stt+Cz13Oue7pwE5thV2OTCSw+ww1N/a7sGrYZzGQC8K6U8AAAA///s3TENgDAQBdBTgjYkIIEZd0jAARIISQcGBhaS/vQ9BTQhpaXX+y7MAUCgbZpPKU1AMOkIAPCvxEPdpYNnoHOts3laypwUpb6kzY93Aar9E1+4UAwAkGsNTMIuRdmfJa57D42txtQasuwhg09M5RxV0vfCvwqekt4HjQwA4E1VXQAAAP//7N2xDYMwEAVQexFmYIOwCWyQjiFSZQRWySqZhMYFRQoLCSlfvDfCXXf2vxOYA4BQr2F5B21iAjh6rN9tUhEAuEzaBaVPC0JBD6EQTqm1joGfUC1LokvolTmBYgDg9tolm2doHQSq+iS+h+ntvcX0v816+H9Jy6BmswoOkhY9CssBwC+llB0AAP//7N3BDYQwDARAu4JrgQ7ovwuuoiAknjzggZQVMxVEeTmO1haYA4BstjAAqXy2AcALunupqjXsbm1P4rbQLXMCc3NI3C7n3cQTiQFLw3QAgM86ezipNf9/jLFNcI6pdfdR7/4Cj+4t+m1JoQuBuQDnkJ+kfq5eLonD1/yzAcCVqtoBAAD//+zd0Q1AQBAE0K2E1lShCFUogVKUQCUiuV8Jfybe6+BCjpMZqzAHAMGmblgCg4IAl3485rTpNwCQILEQ4s+XvJVWCjFF6RvS9kcBRV4JnTInhAYA/FI7Iy6hZaoSyn4s8X13bWcLfqpd/z1k9QpzOZK+c8kwUGH3webZDQA3quoEAAD//+zdwQmAMBAEwHRmV74twRIswZrsIB2IkIcfH4oQlsy0kMBxRy5rYQ4A8iX+Hg1wWeZj83AYAP6VltSin+G10JQ5KUodBaZvVg9Q+SitrlqYAwBGtYb1KHc1LIGqp8RZgLOlBN0DC3M59lY/EkxtlsjYkhbmzJEB4Ekp5QQAAP//7N3RCcJAEAXA2wrsQEvSDrQE67AKS0lJWsGFg/sWEUEfmakgWULChnu7AnMAEO62vyyB06MBhkNr7aoSAPBVx6ByPnvvNijxqbRnRyjkt9IOKd57748/uA7CzGnSSYHiXVU54AgAbEpVjX72HHzP+pU3zC2CiaFIgTmGJaQK+skQ87uR9H7xL3fDquoUtAXYIAMAeKW1tgIAAP//7N3RCYAwDAXAdAJXdARH0w39ybeICvL0bobS0rQvEZgDgG8wlQFItZgyBwDP6Ee8JMJyXNZhy5SuxGXC3OvS9kddgbkjbf34hAYA/MYYYw4Py5X7ymmJdYBNGJKWEpibOpxKhqT3AE1//y2pVrU6uwHgQFXtAAAA///s3VENwjAUBdBVAQ4Y0rDCLybQgAOQgASUvGWk34QAH1x6joK1TZZu7X1PYA4A/sBxu1+rRx+sJRBo43AVAL4m7SKOPQCfSrpkMbfWdj/wHKNKej9ee5cweEtVrVWl70GzJzAHAAyhh+VO4WM9+155WWJgTocaHnr44hYyG7rMhaiqS9D/illH/DH1EG5ScQOFKQHgmWmaFgAAAP//7N3BDUBAEAXQ3QqUoiSqUIcStjUqcSFxEREiZr1XwWaPk/9nFOYAoB5jsO36AJtumIvwMADcpxDC37iixKk13NIE+ikhB54QKejauggAANQu51wqKMsly48uiVi0UJhjL8qVOaWmWCLNvfoPvIH3RZrhT2sRFQA4klJaAAAA///s3cEJwzAMBVBN0hUyQlfpCJ0jW2WDjpJO4FLwNYSSHvzNexMYC2yQJVnDHABMYr09do8UQDBFoQBwQS80X4L20N3PZb3pMmXadYVOl59B0r6/W2vOR/4hLUfofAQApvTN1/RmuaSfSo5sirJ/cg9aa/X47gOsg3G8QmJhAEsWDXOM7hkUIXlkADhTVR8AAAD//+zdwQnDMBAEQF0F7iCkk7TiKvL2O1WkFbfiSoJBLz8Tg7NipgKBhDgJ7UlgDgAG8rrNy95BxpwCgR7P7e2BHAB8LyoQomM1J0oKhah3r5HUFdjeyCkEigEArldV9/5D0whhud3yB2OIUFWJ9a0wJEcpa8J5Mki/r1hDRjxVVdK9Ij/qtZvGlAAwktbaBwAA///s3cEJgDAQBMCUZOm2YAeWJEI+fkQlQjaZqUDyEM7segpzADAelxVAKlsyAeC7pGDA6o/VNJRUMDpDFksHzzGbpDNXmKOlpNCMgCMAMJQasN/DQtd3bJd7J3H2N49yUYtN8Iek7xUKc3NJ2iq4eU8DwAOllAMAAP//7N1RDcIwEAbgVQEowAISsIAEVCACFXNAcIKGOZiCkiZ74HFLyHJXvk/BbVnatLn/JjAHAJ15nG5joolMAN/O92nMdAkJAJGkCswFqIFOLOHLV6KnEQrZ0RJQPCQpd661Wh/5pUzfUy+N5ADAnyulHEspbTjgM9FZZA0DW7fJFphr59F3gDqIJ0PfySVADWzT7ivmJO/s2vb2AHWwj0y9Kv4uBwBrDMPwAQAA///s3dEJgCAUBVCdoBEasVkbpQ0ieL9BQQU3z9lAEjH1vicwBwD/5NICSGX9AoCb6sI25aG5QAhvSJpTOsx9S5iYYVWV6TVl/L13gWIAIFrtZ47Q0fKzL6m73H1p//7CcpwxN3hcFUBLOQebdJkbQxVem0MGuzlLBoCLWms7AAAA///s3cENwjAQBEBfI5DSUgIviqAKSkgHpJQolURI8EQoD6IsmanA8sOyzrdngTkA+EO3Uz+GTdgHeDtf57vQHACsk9SEo8GKX0h6HBYI2ZbAHEeXNG3a+QgARKqqrqqe9Y5HUKP1Gpecpe5G2g/K6nV8MiXsjAEskZLqFQJzx5B03xlewVMA4JvW2gIAAP//7N3BDcIwEATAKyEdUAol0Aov6kgJUBlKGjGydN9I8DDKJTMVnGxZftirFZgDgOPyeAFUdX+sz8nuAcDXBEI4tXwcrtKidMlWSP6jTKBY+yaDaOAEABgkg3L9w/87Iq4HXedXa03D1A+yoaYagTm2OP8Mkc2lS5HVvfU7fwdzMFalYOS8gxkAoIaI+AAAAP//7N3BCcJAEAXQ2QrswNaSerxZih2ZElLBipCLgqBCIH95r4KFuS3z5wvMAcCgLuf5ee3rar5AoFNVaZkDgO8lLeIIhLAXoRBebMHElHaH2wHewIB67/egBTSNAABAhLeg3DTw1FYHWv+SGKoQiuKTiIY5f22xtMxxCK21edtRSbA4ZgAAP6iqBwAAAP//7N2xDcIwEAVQ3wQwGiNkAzrqjMIIrMIIZJI0pkRCSEb5yXsTWDrJhX3/TmAOAPZt7p8ZAGmut+VuUhsAfCelwfzZN4HBCEmBOaGQ/0hqljLNn5FS7seTie0AwJZV1aWqHgcIyr3N3nF+khbceakzn/QhLAnOihgpKTA3beAMjGO7HADsVWttBQAA///s3cEJAjEQBdCZRmxBO7EF6/FkJ2JnliCB3JcVV/brexUEFpLZhPmjYQ4Aftj1cHn6WQaC2b8AYMGcoJSSfKkhhM3MVNWUwBip19+R1Jho+iZbSjp/7Y8AwK5096m7b909mkbuVXX+ky80Qo+80bwnraY1pYYlKVPLCTMbMh8hqz6OmmAH6+DD5htbUn3nHhkA1qiqFwAAAP//7N2xDcJAEATArQRKogU6ICMmdhW04Epcg6mE3AGWkbC0ZqaE++Clu98/gTkAOLjhdH1oYgKlLvfX0/YNAPisaUhrkMevtYRCPK7YR0ud56If2+kkMAcAsMEiJDcluSU5/1kNbdL5XtvWZIE51jT0LMyTezXNDNyNx9R0rqM+MgBslOQNAAD//+zdUQ1CMQwF0FYJOMAKEpCCBRw8iUNBCcnjFwJhhOado2Bpl33ttgJzALANZ30GmvJ+AcBzbT4DVJUNc8zW5Y7t1sm1zNUleONtZKqqGvcNIU2qLDAHAPxcZu4z85SZS2aODYfkHi7rFnc+c2hWN73mlaFCzFJVS0RcmxT4+Adn4Ps6BeYMpQSAd0XEDQAA///s3cENAVEUhtH/VqADrdAJVVhba8KUoAWVCB3oQCaZxGxESIhnzqlgMqu3uN+9gjkAmIDdfN01NBgDMLbYXDrb2gDgsVYGy48/8A38P1eUGGtluFUwxze4wAkAcI/jllW1rarDEMidkuyTrJLMJv6fzhYZvq/R5Tgu1fCMqJJPayUC6pegieb+SP8ubCh0vw6BKQDwiiQ3AAAA///s3csJg0AQANBZSCGWkA7SgqVYSjpKWrIDWZjcAgGJ4uh7IF51hAV353MTMAC4jCkiXj43UFA/nLX5BwDfDUXiIrGCzfUO+K21uUiC412h1HZ6Amyhx7U+sod3Tkk5uqtOcQEA/iiLlvo/1+c+5PUQ55/GnFDMOuUaQJgmyElovlLbM4vWKxhN+TqVqdDLyJcBgDUiYgEAAP//7N2xDYJAFMbxZ+kGaHXWzGAYQXdwAQtLGws6V2AmcALjCJQm4BESCoMdRLxP/r+OjgAJd/C+9wjMAUBAFuf0aFWdWP1y9qxUih4hJFovy3i74icHADmbPDvdd4crdw4AgA8q3S8JBmEqhUgRJN99vkvl+pYUJ2IiMs9ZG3j13rNuAAD8jFjzhTlyvfX++7EjgD/Khf3JaGp7/VsA54DwKUwhnPt0UGldE7SHyDt83wbzCZf/DaWJgQTmAAAYwswaAAAA///s3TEKwkAQheGZTgKyHsjCI3gFwRvYithZeoGAR9EcwdbKMgcQCUkxQUhhGZQYHv7fDXanWXb3zRCYA4AR+e4wt7rZ2LNe2KOaUQsMrbxVVk6myVLGXgNQs/VTnsdqzeUzAAAdd1fqnMuHK/zKRSQwR+frYTF9E3gTEXehCZwEigEAYztTAfyhIiL2FP5ramdZ3tzQh0JgDvpeU+aOAqtIXciK8JI4d18KNVq40tQAAIAPmVkLAAD//+zd0QmDMBAG4NMJO4ou4EzdwUkEQZD2wU4geewAHl77fSNcICHJHX+vdgD5WpJcN05brO859s/DsByplpd6AxW1x+fBygHAlyp3yZagpLGCLFU+jg3MXatKKogULTJV2R8NzAEA5DqKJazcWbW+D833wF08C62EM/M3SJcDgH8QEScAAAD//+zdwQkCMRAF0Jku7GqtxAqELcEGBGuwKcHTksteIywLNiCR0fc6SCaEQOYnAnMAA21BudN5icdyibYezD1f0daIZzP3QEVz3q4a5wDgrUogRPMNI1VZbxV+eaqsSpOi/ZGRqgQ0BYoBAMY69t79NPYZ1c6y6s7PyEx3yIXtD+7di4xgykwP4xe2109gDgD+QUS8AAAA///s3cEJAkEMBdBJJZZgK5ZgC2IB68167MdeRhDxLLsQ9uN7FQTmlDDJtzAH0KCW+6Guy/O9KCdNjj2QMgfkunk7APhK6S8lKNHm87ki4kpMVaUsvSY6htQsfZNOKQua5ucAAH0uc05zm/+lJ+UX0srpkpQyd95BDax3Cjpo93DYAAA2GGO8AAAA///s3cEJwkAQheF5YAm5W4qliJB6QgoQXMvz6FFC8mTREtzgJP9XwuyyOWTezIH6AUBbdatcPJ5DzIsoNf7Ga/qE5o4dZwIgm7Nu1+JLzw/cHZKUJTBZvs36ANBalqnVvIlYW23kOSWoOqGQBjJNFLfNhjmsKct9y/B+AwAAbMHd9shJ/o5tBuNgc2pQQ6LdCe3ZLpLGJEGmGpjjG5oX2+UAANiLiHgDAAD//+zdsQ3CMBAF0LNgAKgZAjZhBLagRWyWjEJDhWgY4JAlNkCJcsp7E9iy5MKX/yMwBzChdr0P8foY8LNMz3fEYR+x3TggoJoemjJ0XKdbkV0PwiHATKqEQtyJzK1KYO5UrDm5iip347iANbAivdSjykeOrbWd9mwAgEmNmenvOAAsTX8rvRQ4lWMv7VKgWs+vbO1cZOGPzDQ/AIB/RMQXAAD//+zdwQ3CMBAEwEsaoRRaQkoBaQQpNfHny5sGUEwNKHKSFTMVWOePH97b0QAB+him+Sksx6l91qrX2x0Bia7Dck/a+gUAvVwSJtta0wzL3lI+KmiY6yMlMCcMxBFSgpopLboAAIkeYc0qAPyPpNa22wnOwO+S3kDCcgCwVVV9AQAA///s3bENgzAQBdDbhUXYv/IKUCOlQoqUwhEoGyQIPnlvhDvLhX3fFpgDOMAelnusg9pyefNS9XzpE5Ao6bAcAH7u8wpmgkn3OUELKbpAyDFS9seUdcq9CGoCAPy3LSw3+s0XgCvqvbegOwXh80xJQUczMQDwrap6AwAA///s3VENhDAQRdEZJbWCFISRrCakoKAbNCzJ8uAcBU06X21uK5gDuJhYjjhnNAeQZ/RnW+0bAC+WEoSk/PTFs5i7d0v5uU8wxz+kzN1ygzUAADzNUVWrWA6Am0uJhEZ3O78I0t3nA3YjZMX7nNM9BwD8qqq+AAAA///s3bENgDAMBEBnMraiZwMGQIJRWIcyDTUNLV0kYribINJ3yTs2MAfQUBmn3bAc6Rw1op5yAzKay7pkKcMCQGsGQuBBoofkoYMzfFGWzX1KqrxB0QYA4J/qvVnOPQ0AvdsSJeSD31wy5WW7HAC0EBEXAAAA///s3bENg0AQBMCjArfmUigAySHt4A7cgktwTkYBT0KMHFjyr5ipYPWXXPCrU5gD+JHhMU+1bj46kenjyhwQ6VZVo9EBcFEKIXDu7X3oWWvtZUD8QUphLmXPAQBIoCwHQIzjEuozJO+9gwx8L6kwt3SQAQDyVdUOAAD//+zdsQ3CQBAEwN8KKAGXQgmUQgeWSNwEEqI5MkRAAxaSUyK/ZA5mSvhNPtlbhTmADjJO+3Z/nr0lZb0X5h4v+QEVnXK9DJIDgK+lEMJWSpQ1k/jL9uegFXxWpTBnTR4AoA9lOeBfHCT9U6qszO2SWJkrIMlxOchcwW0pjgIAa7XWZgAAAP//7N2xCYBAEATAtxNLtSRbMLMJGzA0MdKTB2OjBzl+poTb7GBZhTmAFo5zLdc9uCWpbbv8gIzqU3OSHAAdsrwC37KUQhTm+rT0fgD+EREKcwAA/ajL66OyHADZRMT8lr4zsDKXQ6acrMsBQCullAcAAP//7N2xCQJhDAbQZAu3cBRHuBUcwNYtBGdyhCtsBRtBbGz+3sID78P3JghJF/IRgTmAL/XhuK/7Y6OPxHu+qq43cwQSTX0+CQ0A8G9SDskdZfErKaEQFtTdQjbw2RzQo+0KagAASHYZn+V8JwEgVcqXuZ2d5LqN+Uwh5c4jMAoALKGq3gAAAP//7N2xDYAwDARAj8ZmrMAKWY2aioaGSAxBEdu6myDKu8w7CnMAf93P7g5p47wi3ilPoKJDagCQj4dZLFRl9rYEZ+ikyiINZWJWUigGAOhtKMsB0ECVwlz4ZS69SvlUmnsAyC8iPgAAAP//7N2xDYMADARAMxmrMAIrsAcSK7FE6jQUFAgjRekjJSkw3K1gl36/wBzAD17tcsvqSwzXse0Rj6eBAhW1zTQ6NgbgTiqEQio02HBdAkmcmcNV+MB3dgCArwyZ2QnLAVBdZs7vxtQKegt3apXmIzAHAP8UEQcAAAD//+zdsQ2DQAwFUN8EWYENmIWNMhoskxKJLhKFaahoKBJFmLw3gc+/O8uyhTmAT7guxx295oj3KlqgIp+HAPyTR4G3umAD/JoFGzg3FulRlYuRAABXsETEkJlPaQBwI1Xm/31rrbtAHRzsufRF+jJlprkaAHxTRGwAAAD//+zdMQ2AMBQE0FYJRhiQghJWTJBgAU3MeCiphaZDf/OehN7a+6cwB9AoH+dqXY4p1ZW595MtENGS72uXHAAAgRbmFEL6ivKeUQpLAADA+Or6zlZKeWQFwGQiHcz1T2FMkXJxIBoAeksp/QAAAP//7N1BCoMwEAXQyc29gnQreAaP5a5diO0qIuQAJRTqyHtHmFkkBP6PwBxAr/3zMDtua31FbG/7BTIayjwJtANwa6WULGedJkz+ptb6TDJ9d1cAAAB6jS0sl6U0BgC+1t54lyQTE5i7pix7OX8LVn4AAL8WEQcAAAD//+zdsQmAMBAF0MskWcBl3MTRXMgFbG3sIoKtTUDIyXsThPwmhFy+gTmAXsc52Tt+bdvlC2RUI2KRHAA/l6VBycAcAIwnS8OhBk4AgHf3o+q5tbYk+jAGAHpkad2qpRR3GQN58qhJlrs60wHAByLiAgAA///s3bEJgDAQBdATHMRBHMoJbJ3XxkKEiJhSEKw8fQ+yQFKEC3f5BuYAHmjGqY91a+0dnzYv5wLIZ5AyBwBAbSDkX7LUAdIf4J66HgDg2pG005VSpJAA8Hn1vsvyzutj33fJdB5ZBkMBIJeI2AEAAP//7N2xDYAwDARAb8AKjJTRGIk1KKkYAqRQIfpUcXI3wUuuXLytMAfQ4n68UWcOx2XQQEZLRGwmBwAwvQylpLWDDCNJccXZtWAAAKDB91Wu2CkAmEyWMlHpIAO/LPM4a617BzkAYDwR8QIAAP//7N3NDUBgEATQ3QqUoAgF0ZK7RH1KECQu7hKJny/eK2HOO7MKcwBXrFsjN35hXiImg/xAkdocB8fHAPAuH5TgXC0j4GGOqwEAytP7KgfAj5VSmKsyU2nuAzKzO4aWS2AMGgDuEhE7AAAA///s3MEJAjEQBdA/uEcPgg3YgS1Yki1agg14t4QFIZIORJAl5r0OMpNkYMhkEVyAL6wvD/CZx+OZHPfJspN0YDS9cX6RNQD+0GGQJZ2qSi1mS6OcFSbjbgQAAD50S3JtrfmUCIBp9TpYVfck5wFi0Ae1DLhvb6TBRfsFAH4lyRsAAP//7N2xDcJADAVQX09BQc8KbAAbMAMSg7ABCyBlBiaAUaCgpkcRRpkACQkll7w3ge//2mcLcwC/eLUzuTEZ7Tvi8YxYLnQO1GZdmtMmd/ur5gAYmVUlzzkOYAaAIbpoBb7yaR0AMGX3iDhkZi0XdQDg37orXE0FKW9LKfPMdOG/J13+XQ+VjHvOzNsA5gCAcYqIDwAAAP//7N2xCYBQFAPA4CSO5gpu4pSWgp2o8K1tBYundxuE1CGdagEe2E+DY/5lXpLtUDpQ0aQ1AAAAKMdgDgD4ozXJ2FrrjeUA4KbSC1eld7MvGgpl8i4HAG9KcgEAAP//7N2xDcIwFARQ30RZgREYhRHCBgyAhLIJIzADdZpMYGSJPlWiWHlvAsu/s/zvLMwBAOtay9x3dlFAj4a8nj09iAIAAAAAAOfSFuXuLTSg1ioIENhda2RKcklyTTImeSR5J/mYBkfwb2ybOhnG7QBnOLNe/ocsAhIAYGOllB8AAAD//+zdsQkCQRAF0L+BYGhgbAtnRyJYiIUIWoIlaWimFSgLFxiaHDj6XjLpMAMbLHzGhSQA4DO3R7JaJvOZgQHV7NvxcH5ud3ebAwCAn7a2XgAAoJBrkh6QO41BAIDJ9EBcksX4f/JeB1OniH6Na1Og1aG11kPwly/o5a/0uRd601yXA4CpJXkBAAD//+zdsQ2FMAwFQGcCNoANWIEVGImRWIX2d79ijCCkVFQUgAi6a9zb6awXC8wBAOf91oi+1TCgNl35xW0yOQAA+LTGeAEAgAose1DOVRHgSiUQtzvWQaP5gpzznFL6l/3/240lFM+zarru530AwN0iYgMAAP//7N2xDYMwEAVQp6VhtWwCo2QAJJRNGAFGoaG9yMAASRXbek9yfzpXlvz1BeYAWK5/mgAAIABJREFUgO/tx3X6ztKA2oyPeXppmQMAoDT5M1NELC4GAACgee+7Tc4bEPiZQByccivXUMEqRoGov3hWMucWEWsBcwBA21JKH/bu2IRhIAgC4F4FVgfGHRhX4tJUghpTAerCCB4MBgUKLDiYSS4/ePhkbwXmAIBz1i15PSwN6OY2GuY6XRQDAAAAAAB629vklhGUc9QPOFRVzyRTkt8pEAdfc5PA3H1/00JR16mqd5P2wYy/IQDwb0k+AAAA///s3TEKwkAQBdC/jZDK0mPokXIDr+TRYmlpIUGbDcLaKggGFt87wkw7f77AHMA3hs2c+TGYHX/pdk8u12S3tX+gN8fWMjfZHAAAAAAA8CPn1oBzcigPvLwJxB3a80/gg1rrVEp5htH3Hcxq9NB3Vb20y0VgDgBWkmQBAAD//+zdsQ2DMBCG0f8wJQVSFmDkbMAMGYk+C6RDrBApVizeG+Hk6uxPFswBfKNNnyubMztu63gnjyWZmzMAjOY52KIUAAAAAAD4fyI5uLmq2pJsgjj4uevOfx9gzIK5TqpqHegdyMuvwwDQSZITAAD//+zdoQ3CQBSA4XeiCQ6D7yiwAV2BhLFIukJHKCMwRHUNAoI4DAKBoknDle9Lzl/ePfvnBHMA31hVl7jetmbH37o/IoYxot7YAaA0+9Sedvlw7L0cAAAAAAAwwfkVyfUiOVi+tyDu06mtAMymKySYW6eUmpxz9wN3WbqmoDDZ73IAMJeIeAIAAP//7N2xCYNAGIbh7xohpXWWcYRs4Cqu4h4u4RIpBTcIghnAQITT54Hrj/+Kq15+wRzALx7NlEQwx729l+TZ2jIH1GhI0nk5AAAAAADggHmL477HdhC4FkEc1GH7f0spY5K+ggu/9sCP/8+5BquAEgBOlOQDAAD//+zcMQ0CQRCG0X8c0GKAGgdIQAKQIAAP2CC5AgNn4RygAAFoIEBzFQkNCSSbe6/ZdjPVFvuNYA7gO+ckR7Nj0u6P5HpLFvOpTwJoz6q60/a529vcBQAAAAAAfDKMcdxFIAftq6pZkmWS91MQB+3pGwnmNlV18Ib4nTF2XjdyXX9UAOCfkrwAAAD//+zdMQrCMBQG4JdB8AAdnLyCV+lVHLsUvYFH6xW62bGLayRQHB0EwZjvg5A1/NlCfp7CHMAH8nWY03m8x/o4yI+mLWvEsYvY71pPAqjPxWMkAAAAAABQpn1spbjXyjlPgoG6vCnElf3kOuF/lCldKaW5krJr72/CV9UyXa64/cAZAKAdEfEEAAD//+zdsQkCQRQE0NlAsAjB3CosRdFcS7AQwSos5BoQU7OzghXhAmNBcNn3KvjMj4dRmAP41nx2zTM7+dG92yNZLXpPAWjPslzOp7rdn/wOAAAAAAC6MCQZp9W48aMcZ/UFGlFKWSvEAZP3ytyhgTA2CnM/dWzkzqHWev+DOwCgH0leAAAA///s3csJAjEUBdD3VFy4sYUpwQ6mFsUC7MEGpgDBVizFBlwI4s4PQgbEpQgS5hwIyfplmVyuwBzAt6aTbYxHq7jd0wwZtNMl4nyNmM+GPgmgPpvc77rHcu0hHAAAAAAA6vVqmOk/IB/fzoeyC8VBRUoorimrD8S17hD40FUSmGszsxGW+r3MXFTSMhja5QDgDyLiCQAA///s3bEJwkAUBuD3JnADG3vJKI7gDlZWko0cwSwiphesrJVAAjYiCIEc930T/Lzq4O6/pzAH8KdXe+zzcLrG47kxQ6rX3yO269qnAJRnNf42ZsscAAAAAACD1hQW5fIlzM2jcyhbZk7b4ZqPYlwz3t8B/DScBTKzK6RQu1OYmsW+oKznBWQAgLpExBsAAP//7N2xDcIwFEXRnw6JAbKekbIHiyDFmYVpqKIU1EYpkNIDIl85ZwSXtq6fYA7gE+dTifl5d4Yc3row91gienfXQDrXbrzVdhk8rAMAAAAAHFxrzQdrAF+2Littgrj3elyWRSBg32qSYK4I5n4iSzA3WTsGgD+IiBcAAAD//+zdMQ0CQRQE0D+0VCgBKdihIxjCAgU2yGlAwV1+cgqABJa8p2AzzTY7Oxu5A7xuvpzutds+RAjryhzAmDyAAAAAAAAAgDd1OS7JMck5yS1JFwSmqrr2R5ZrsUVZDviUXu16DpDmPsnhB87xN/quGWiV1LocAHxDVS0AAAD//+zdsQnCYBCG4f/TxsKhhCzgBq6QgYRktDiGpPhFsEwhWITD55nguKtfTjAH8KvzaWjHQ7dH/t5zFc0BVd0y3S+uBwAAAAAAAN97ByBJxiRzkmUjjqsSMwAFfb52VYmRqnxDq+JaZM5H710wBwB7aK29AAAA///s3aERg1AQBND9GgPlRlIBLaQEaqABaoiJTAXJkGEGgcIg4M+8V8KaU3urMAdw0tI/XumaSY6Q5P1Jvj9JADWyMgcAAAAAAAAHdgW5cVuPm5MM64NKy3HARZ6VBF9Lwev2SintdndqoCwHAFdJ8gcAAP//7N3RCcJQDAXQXJBCp9BNHMER6kgdQHAVZ3GO4hOhn372o4+eM0FI/kLC9TAHsIVxmGo4LXrJ4S2fqreUOaBL1zwfFtQAAAAAAACwSnJJcv/zIHeTHgfsQWvt9Uvx6mAY5yRuErbRUx/nHdQAAMdUVV8AAAD//+zdsQ0CQQwEwN3OKIlS6ABRCpXwCTEpEsF98iUQ3OtmKrA3tGSthzmAPzha5h6yhCTvT/L9SQI4I4dKAAAAAAAAltb20vbWdkvySnL3IAdMTsvcWq4n2fY5xtgmmAMA1pRkBwAA///s3bEJAkEQBdA/iWB2HViCTZlbgfE1IWgndnK5FRgqC1fCBTfyXgXDZ6Jdhu9gDmAj3/l2yfHwkSckWd5SADo61ePe5WEVAAAAAAAANjFaj6rqubbIvZJcx9+ZdIEm2hzMVdW0gznaGs2nSc5N5u+ylwDwn5L8AAAA///s3bENg0AQBMD9mAC5QlOHIwpBogRowQU5QEJOIaEDCPx4poLVhSetVmEO4EqP5uWekOSzJsvXJYAa9WUcPKgBAAAAAAC4taMkN5dStiRTkqcVOaBGx4rXu4LorZW507pKci5J5h/IAQD/K8kOAAD//+zdsQ2AMAwEQJcU7MZAtAzAKFmJnoINjNJSI4Gjuwksp4v8eoE5gBfltu4xT5edQkQcpy0AFfUPai1zAAAAAAAADOfRJNdDcotXBgZRpmXuBzNUViUw1zLTHSkAfCkibgAAAP//7N1BDYNgDAbQfpcdZmJImBMEzAQSELJkFiZpBjhhgBAwQMJhP3lPQdM2vTWfhzmAs91vLz2F2hLmplkngBYN+bw7kwMAAAAAAKB1SbokY5KfJDngwr57qte/69e7bBGPS/Ksqkcj5bbywAkA11VVCwAAAP//7N2xDcJQDATQc03FhozABJCScaios0iE0rLEj5BYAESBxXsTnM6lZdnBHMCXjcvplv1u0SskWR5aADp6LggnkwMAAAAAAKCrqjpU1ZzknuTc6MgA4G2vb17XJs35MveZY5Oc6xhj/oEcAPDfkmwAAAD//+zdsQ3CUAwE0HNYIKOwQXZgATJYpEyXlj6igJYFkGL99yawfPXpFOYA/mGqR27Tx28Z3vlOjtfoXwB6eta+3WUHAAAAAABAF1U1/6zJ7UkW4QED6bLqtV7gho66FA2tywHAFST5AgAA///s3bENAkEMBMDdmADRAR3QIjnJ10QJVADElAACvfQNECD9iZkKfHZ69lqYA/iB9+l4yW5z1ltIcn8kz5dOACOaTA0AAAAAAIC1a7tvO3/Qv0qTA/7Vkup1G+D5h7YO+H5hTk1Nsh2kXAtzALAGST4AAAD//+zdsQmEQBQE0LlEsKqzExsTrOEqOhNjGxDX1AYWXH2vgs+feBiFOYBa+m60MgdJ9iNZN58AWvT9zNMgOQAAAAAAAO7oUpT7JxkbKhMA1GJl7plaWZf7lVKWG9wBAK+XJCcAAAD//+zdsQmAQAwF0NwAgoV7OY+liziDK7mFYKEcWtqKF3hvgk/a8BOFOYCPnPO0xdAt5gvPl7n9MAkgI5e/AAAAAAAAaMpLUQ6AW5Ydf5YC2O9KKX1EjEnirg1kAACqiLgAAAD//+zdsQmAQAwF0ByIa9wqDuMa1i4hOIOj2QuxudpO9OC9CcKv8xOFOYAX5brMMQ6XjKGV5gD6U8u+uewGAAAAAADA5xTlAJ61715HBzHVUsr0gzl60MvOxpmZjjIDwF9ExA0AAP//7N2xCYBAEATAvQIEA1s1twQLEKzP0MRY7OAT0YeZEvbivVWYA3jbNMwyhiTHmZyXJIAerbVvo8sBAAAAAADwhWddp6oWRTmAJr2sfHne26aXnKzLAcCfJLkBAAD//+zdsQkCQRAF0D9gbgeWoK1YiZgraGAB15IdaAnmBgYGZsqhxmog3HHvVTD8YTfZWWakIQD/dd+tmlqsN7neDNrD6ZxMJ4OPAeidcZJlkq3WAcBPjkkuIoOPnJPh2Q89APjCQUgAAPBUVe1Hgeb1ZgXAB+2Wr6rqw70570ANndZuVk0y60m5TQdqAADekjwAAAD//+zdsQkCQRAF0N1UkAtsxA60FcHAcEuxAOFSQ0uwFQsw0sBsZMHESE1kl3uvguHH82cU5gD+YZjt0v1xlDWTVz/MXW8pLeZTTwLoT8njYR+brWVmAPheiYizvADeRcRaJAAAAHySc16+lu9XwgL42amDj5xDLUXXgl8Ds7SqdDLnJSIcgAKAlqSUngAAAP//7N27DYNAEAXAd6QEFu0SgVwBZVANogAaoAlIiMkwPmmmhLfh/hoFAXje8e3ndO0makiy7VIAavRxDQwAAAAAAIBfKKUMSRbLcrxgvb7jT0lGBaBitfT3fZm7V0s+5kkA4N8kOQEAAP//7N0xCgIxFIThmU6w0M5yj+BR1huo4D12DyJ4FcWLaGnlWliIRZZAbMRSZUP+r3ldEt6QemiYA4B/GY9Wut6P7BvFezyly02aTUrfBID8LL3btmG9OZEdAAAAAAAAAAAAvi21ysWmoTnLxY8c0rH7NGMjUhdnCKF7v9J2QxDIUWz7sn2WVA38+bXt6af/Vzrbiwzye6ElEACAoZHUAwAA///s3bEJAkEQBdC/aGhmg1eC0YGhNqCt2IGCdVwumIgFrCgGBmaKuNx7yeZ/YLM/ozAH8CN1vTyWfnXI+Wr7FwynZD5LppPRRwE0577NszM2AAAAAAAAvqmUskiyESofuDwLcHkpxD3eWutesIzQtpF/tXOh7K1WrsvtFB4B4A8luQEAAP//7N0xCsJAFEXRF4WAvb1LyhLcYnakjbWkN0EGIgQsbEQc5pwm/WMg1ec6mAP4pUN/zn53ybx0dqdpjyW53ZPTsfUlgPqozAF812RPAAAAAKBlpSy0lmkGD4EPSi3r+irCbb+lpmU8eDM6mKvT+m+s5WBOXQ4A/lGSJwAAAP//7N07CgIxEADQmUKw29JSb6DH01JP5B7JxsJC0AuMLFgoYmGhbPA9SD8kmSKfSRTMAfxQbTeHXO/6OF1bWczB9xzPEbMuYjrRyUBr/DIHjFpmrhoaIQf4AAAAAMDfuu/nDgUdc7OAh4K4l1ZVHvSEDw15k5l9AwXJy8xcyPMnw/3KbkTxvHOpqv04QwOAPxcRNwAAAP//7N29CQJBEAbQ2Q4utQHr0RKECwwNjYwtQrAFW7GFiw2MVRg51MzMH26592DYfAYmWYbPwRzAn+V2My/L9TUuNzuYcetT5rpTxHQy9k4A9ZmV/a7JRXs2O2CgGoMBAAAAABi2UsorUaiGgwC+4/guHa5/M9PfI/zGoZIEz9WzeJAuBwB8JiLuAAAA///s3bENwkAMBVC7QwIJIUoaRmIcOhiAIRglTIPoYAKjiBQ0qcmR95qr/a+705eVNQB+Ybu6xP15lD2z93hF7DYRy8XckwDash4eqs/ujRF7wQAAAAAAAGMys/9nOgno79yGgbrvs6q6eYwP01NV18xsoZx8UJj76LftNVJyDIU5AJiwiHgDAAD//+zdsQ3CQAwFUHsR2IAwAptASUUfKS37ZBQYgAXokCjoDkU0FIiS3In3JjjZ0lX+tsAcwAzKcejzMOzj/nD5AS7XiNXi78sANGcnMMcXAnMAL5u3wRCAX5i2tHcqDQAAQM0ycxqu32pSc26fLsOFQBy0YGzg311m5rqUcqrgLXNr5brcWb8AoGIR8QQAAP//7N3BCcJAEAXQ2WM8xBLSki0IFmALVqAFCLZgSdpBBJHcDMEcc3c3+x5MAzMwt5nvYA7gX9rmFO/hrP9U7/X51XZTeyeAsnTpdt1994e7uQEAQDZ6owAAACBXKaXpqfLFsVy2nhHxWKi+1oOIOeUJ1qCU3Xucn/fWrpSkPelyAJCziBgBAAD//+zdoRHCMBSA4ZdJKroD8zBAHbICwwCMxApIXB2yqjpc7gqCO3BcG/p9GyTvIv88wRzAQvKpP6fDsYtxas2AzbvdI3aeAlCd/fwTHQAAAAAAAHw0x3IXm9EXdX3bDveK43LOw4bv5RvBHH+hRK8ppRLFNis/Ty2b1X6mbNmrYE5PgjkAWLOIeAAAAP//7N2xCUIxEADQSydY/NLWjXQEBfdxAUHcRHEB17ASCwuxOPnwXeH7Q95rUgYuRSCXu1MwB/BP89kmHq+rM6B570/E/Rmx6FqPBFCXVTkelrndSaABMDYTlAAq1ndn9xEPAACgHYrlRnMZNjoP668w7paZ3lSBfsrcfuJR6Eop68xsuXFvLRP2Tu4WAJi4iPgCAAD//+zdsQ3CQAwFUCMo6bIAWzAYFRWICRghq0SiSZcV6JEQBTUoUgoqqgA5/N4GZ3d3922BOYAfehy2p9lm18b1vtYH0jtfIqplxGKevRJAWfrL2r2efc2tfyRIclaAdzrVASjaaphgDwAAQA5HYbnRNC+b4QTiPs+GOf5JXUBgLoY/CAJz05e5RwBQhoh4AgAA///s3SEOAkEMBdDWIRAIPEfhCCuRnJGbcAOCQBMwKAiZBIEFwTLb927QTlIxkz8VmAMY23y2ievtEPdHOgtKa1vmTueI1bJ6J4C+CMz9Vnv4XFcqGL7U0wO24Ne0Lao3AAAAAIDaMrMFNLbV+/Chy+vueP8WjBOKG4fAHJPRZkhm7iJi+POahraZtOLMa9v1OvlA91h8CyAA9CEingAAAP//7N2xCYIxEAbQi62VE4gbOIIj6Ca2dv4bOICgo4ib2FgK9sqJYGVjI+aPvDdBchfSJB830CqAurJbnWI0PGoDRMT5EnG7qwTQknHZbac6xhtngtpaesD2weG/uQ+BXzO1DQAAgN4opayF5T66vqbGdRGxiIhJZj6DIrPMXGbmJjMPwnLAl+wbKeS8B2uooZV9C8sBQAsi4gEAAP//7N2xDcIwEAXQs4QyV0ZhBDYINRWMxgIMQJc+wpElKkCiAzt+b4LzXWPJ+j6BOYAK5NM0xrBbzILuLY+I2733LgDt2ZsZL2xUAgD4j1YCc+6LAAAAG5dSKu9Hkzm/uUbE5UM47li29eScfYZTl7H3BrAtz61gcwOHOlRQw0+VrXoNhczPFdQAAHwTESsAAAD//+zdsRGDQAwEQCkmcgd0AC1QqktyGQ6dMUMgJ8YlGIR3K/j5Dz7R6QTmAM7iNty9BUTE8xWxbm4C6ORft7sBcBzblAF608AJAABwYZk5G6b/2gNyS1VlVc2f5jjhOOAoHVrmpswcT3COX+oyd/HwfwFAExHxBgAA///s3bEJAjEUBuDYXSGIE9wormJxa1i7hCBuciM4w9W3Q45AClstjjzzfRMkL5AQeD9PYA6gEfl+m9Jx0PQIxbIqAxDJeHg+NLzu493DJqEz/kA/yDlHuQ+9jwAAAAB0pU7IKWGMU6cnXyY3veoEufNHQG5uYG1876Jm/KEIgbni2sAa9hRlqp5APABEkVLaAAAA///s3U0NwzAMBtBce5nKpBqDQRmVMiqVQhgST5UCYJe28fwegvxIycWfLTAHMJLHtLoPMGUOSOnl2i6RJVhTrdsf48n0JgnC/reqRUHAfbJ09p0HWAMAAADnOArpl2Jn++lT5J4RMUfEu0+Q0zAtsYLTrSiiNyXcE+y2TGCuvzcZ/s4jFL4NsA4A4BettS8AAAD//+zdMRGAMBAEwHxLgwSQhAOE0CIAmbQogGGGIg7gw66EXJfM5RTmAD7kXJet9N0uE7AyB6QziYzK4DAAAF6RpTBngRMAAKBBEXG/F80/yfaoSnLjsyLng7S2KMzRsgwrc0NE/OUeMUs5UBkcADIppVwAAAD//+zdwQmEMBAF0MnRw4IdrS142D4sSLCG7U/Bi2ABojjJexWECSSQ4WcE5gDe5tP97AkcU+bWTSWALL5lmU2JuJ/HZ4BTht9Po6FmLgAAAAANK6X0SQIYV/0jYjwmyQnJ1W1ovQBULct5Pb1gDU/IEphr4Z4HgHpExA4AAP//7N3BCUIxDADQ9C54cABxo7+OVydwFN3Ag4t48OwIEeF7F6HafN6bIG2hpC1pFMwBDCYP+2tsVi4U4eX+MA1AJR6N+iuTI7XW/LrJP1UqUHL2+V6VImIF5cAvVdkb5YoAAADLc4yI9ULX9d1NbpeZU2aeBoiJ/txfsFhzl7BzgfFNA8TQ1fzx4rZAqLfMvAwQBwDwqYh4AgAA///s3bENwyAQBVDOLiyl8WrZwLN4U2+SCIkiZZQCc+S9CRBIFNwd38AcwIge27Osy8vZ8PdqyhxAHgbm+KSIyJ3SNGW0giRzcx8C3ST61T5DAwgAAABfiohaIzom3K9asD/rG19Lk7sGWBP9ZPqcD36RIS1sj4jZh+aypOhJlwOAbEopbwAAAP//7N2xEYUgEEBBiI2sxPp+ph1Yk51YhvMDTZzRwNQZ79jtAC6EB4I5gA/ap99a+m4xG5q3/UVzQCQOjd4nrAG4RHnFUjAH8KDW6gdOAACAPOZks7yHcqOHz5o1tL4B5Hb+lhnhUlL2YC7K+gRzABBNKeUAAAD//+zdvQ2EMAwGUEdC1zISK7DB3UqMxCj0dLQU19BTIH4c3psgiiMlUvTZAnMATzUvfXyaVX14PYE5II9Orc6VaGJICFByl62TcRajg/IKAnPA1aYkO+69CAAAUIFSyq+yYNEgKEeyvwY4IkMI6ltr863tDm0fsJQ9oymrAJBQRPwBAAD//+zdsQnDMBQE0EudKqNkM4+QATxCSPBI3sRujCGFUmUEB0t6bwPpgxB8jhOYAzip8hqX3K6T+dC9dUv2T++3AFTi8n5aHvGjMQQ4Wi2LOYE54N9qeR/9FwEAANrwaOQcc5J7KWUQlCOJnSe9qKU1rNWWOe1yAMBxknwBAAD//+zduw1CMQwF0FRITMEKbMIKFKxBQcV6MAgFegXlpUlJB4iYnDOBFUuW8nGsYQ5gYDkfD229esgR07sts68AUIcpEd93LRKnBhF+pVId8hPjezTMAbxW5VGfvQMAAEBxfTLO5g/yeEqyTXIZIBbG4NyCKfS6V+H+eT9ADB/Vp+btCoR6T6JhDgAqaq09AQAA///s3bkNgDAQBEA7JqIi+qIKSqEpYlogogEewdozFfiTZVl3Wg1zAH83DrM9onvb3vsKADk0BbwvpQDaWeArSWk1GubuSbkPWygYArKkFPd5LwIAAORLT5c7U+VaScnjORLm6MkSMNep1traf2JKE+D6gzEAAFeUUg4AAAD//+zdQQqDQAwF0GTnQvBqvY/bHsCreDhB6cLitu2uCkbfO8EQBmYG5icCcwAntz77IdqmykdIOMbyiphmxQUq0G3xeCYqwXX2nnfOHyp1e85M5yPAN/dFAACAwi4wXW7cQlGmyvEpM7ewXKcw3EiVQNTjBGvYU5XAXIVAJQDwS0S8AQAA///s3bENwjAQBVD3adgkI2QCJEZhlYzAJqxCT4NEf2nSIEGFSPjyexOcz5ItS3c+DXMACQ7D0T7Rvfuz9wwAGSb79HMpDXMmKrGXpOJ7hRjfe4TEqSkE2NI1JNveDgAAANnOwdHPVXWqKp+a8Y7pcnRlPQsvAWtOvnderNPyxj8K6ZObxnIACNZaWwAAAP//7N2xDcIwEAVQu6ZJJmAFVmKMtMyBlGVYIyOkYgDTQEeBhBLpO++N4CvOsu/0LcwBBGi36VHG06JWHNr6PPoJACHqfB/UalMpC3Ofh37YW1KSl2GM/6V80kmYA/YU01/cFwEAADLVWi8hg/7fXFtr3SxdsIneUqzgFwkpc+d3/+lBSh+SLgcAyUopLwAAAP//7N2xDcIwFEXRr9CkiMRQLMJoWY0hIgVROMoAdAb8xDkTfNmF3VxbMAeQYplvdZma/eJvbc+q/WX/gQSigM+KCeb8qMSPXFMW3ouMXaREIc5G4GvCzhf3RQAAgEypwdkZy60DzMGggn59gq5aa2cw9whY1fsAM/SQEuYmhJQAwDtVdQAAAP//7N2xDcMgEAVQrnaVCbJK1nLpkbKCN/EIbtISpU1jN4n8xXsToAPpEPCFwBxAiL7MW7tNq/liaPtr9AoAGTx6/a2kwNzjAmNgIFWVtOYSLh0TpIRC9Ebg3/aQitsvAgAAZEr8gWsRluMEZxWMLCEcFR+Yq6pPD71fYChHnr33pLcJAMC31tobAAD//+zd0QmAIBQFUCkI+qoNW6URWqFFs59GsPDSORM8noKgXhWYA0gyT1sZh8uY8VsCc0AGoYAXhW1Krx3UwL8kzTkHTG2k9NGLxMDXUgLFfuAEAAAI81z0X8LKPmutewd10L/EMCi0cgR0cnnWoWQp9QuZA0C6UsoNAAD//+zdwQ2AIBAEQCjAn33Zih1Zk51oBRiNb38aNs5UQIDwOfZOYA4gyDVlbhwWZ8ZvbQJzAFzWkG3wAZqvJd25lCBD72KCh2ETEIF8AnMAAAC8JS2ocNZU5g7WQedqrWdTvsk58VffeSq4AAAgAElEQVR349aEOnRsYO5+ZxLWv7fWEiYOAgBPSikHe3dsgzAQQwHUBWKNrJQRUrAGddbKSClBQTINA9Akyof3Jrg7n+4ky5Y1zAGE6fl+q+vlJW78pedW9djEHjg7DQH7S2kQUQDN0ZLu3HqCNcTr7iVoD95E4Egp/8zwKRIBAAAgR1qjwtTd8rF8Y3JKEDFlbgzOKaZMaTVdDgB+QVW9AQAA///s3UENg1AQRdEZAYRNBSAFUwhAKhJQ8Luqg6blwTkKJmH5uXmCOYBEr2nz3Xis08ocADGLIXN3Lxe4g+dICpKSQq+rO0LuFJQDvyQoBgAA4Ou6ew350f9jH2OkvKnwf4I5qEpYFZuDV+ZS7hbMAcAdVNUbAAD//+zdsQ3CMBAF0HNHwQ6MwCgMREORAVghIzECQyDRGSGlS0GH/JP3JrDOsixZ/ncCcwCB+nS91/GgAxj79HrbeABSJsyVD9D82Smo4EnneHSmbgKsJd0zAsUAAAA5kgIKz977bYB1EKC19n2/Pdsr9m6ZyDkHlCEuMLc0mr0MsJRfHsLmALARVfUBAAD//+zdsQmAMBQE0NQ2juBIrmHp6oKNVWzEwk7Q4OF7I/xfhBAuJzAHkKrvJrvjl9bN3oGvEwh4n8AcXBw/G8eotQrMPSelRWnQugm0cpwzS8jABeYAAAByJN3htIVxx2xacEpomRsD31y0ywEAbZVSdgAAAP//7N2xDcIwEAVQu6YITMRetJmGMTIIBSPQ0B5CokSiCviH9yY4+ezK/j6BOYBQNZ/O7bC76B9/53bXc2B0kw6tq6pSwiHNA2i+KCmcuQxQw5aYogTwXsovwMcBagAAAOCD3vs+aALXEnaXwg+99nbctCpYS1U9A3PXgAVOO7cpwVyBOQDYitbaAwAA///s3bEJwzAQBdBT0gQyRFbyCFnRo2STlIEUMq5dOAFj/PF7Exw6kEDo9A3MASS73551vXQ95HQ+Xz0H4BWyAhLm2EvSIJJ0uW2lDISUgTlgZzH7Y1pSLAAAwEkl3fd77M8/Bh+CwkJCylxMkmhrbT5DHwcoZc3Ye38fu0QA4GdVNQEAAP//7NuxCYAwEEDR9BbiJM5nJ07gTOIijmF1NnbaCAqevjdCEhLC8QVzAInF0M2lqSZ7yO+sgjkA0gQ39T4AgKdlOmeZAq/XiwjBHMA59yMAAAB3yvJ3WyJCMMcVvdWCgzHBkrSJ5tBZ4j7vJwB8SSllAwAA///s3UEKgzAQBdDMRvAU9Wb2qt7EQ3TRXURob2DFX987wUACgUx+RmAOIN04zKbMcTuvtzUHIOkBtMAcP1VVU8ivjF8Cc8dbQup8fPYrwBkE5gAAADhSyl1/wlQkLqKqnmH9BThF730N6b2kBNES6twD585QAPgnrbUNAAD//+zdwQ0CIRAFUKYAowf7sYVtx6ONWMu2Yh9GNluAMR6M/N33KvhhgAsMaJgDCNdv10c7H+7qyK48X+oNwBw0Ai5A82tRc6z3nrR+UyQ1hUwDZAB2IOwHzktVnQbIAQAAwHspD0H5HYdvpDTbwD8k7KfDn7lU1ZrxOECUTzTLAcDWtNYWAAAA///s3bEJw0AMBVAdGK+RETKCl8kart1mtYyQEdykMsQYXDpdIJLz3gTidFwh+CeBOYATeE/jLfpu0Uv+xvzSawBsDIGad+yRoIYz8iYCHKuygTMEigEAANK7FqjxWewDGX6otbbNagc9gI+2ANWc/HgueyAtsypzz3uCGgCAb4qIFQAA///s3cENgzAMBdDk3lsXYZOO0FUYoMuxASOwgRESV4QQAsX0vQksR8rF+bHAHMBTvF8/ZwkA/IuImBIFb5ZBRZafZ8kpUwDJY41rZNra97FFCbiRrcQAAACcVmvtknTRdhyO6HULtq3z6Az3arOBtHUe9G2glD1DRIxtlwgAHFZKmQEAAP//7N2xDYMwEAXQc5eCHbISI2QNJFr2yIgpI1FA44LSBRAuvDfCnWRZtv6dwBzAn1imcYju8dFPbuE76zMAkSx4Y2MIh6hhzGei6mYKLqRRP/GuPuV0y5kInMV9EQAAgD1kGQDl/ZUmpZSX7XLQ5J2gTP2FBxXaLgcA/E5ErAAAAP//7N3BDYAgDAVQOHqRVV3BUR3DE0Yn4KJp8b0JCCQ9lDbfwhzATNZl9578wmlhDoCHxBDIN1wvYe49mWqipRDgK5lqY6u1qo8AAAAxZenx678ySrocDOi93/3FI/hdtcD/LluAM4yQ0AoAMyqlXAAAAP//7N3BCcJAEIXheWAfBizAdJIUkptHD7lYgCWYTmzBSsSD55GBLSDIGjPh/yoIs7CEzEzejoMFgO3wy/mq0zjY833gWAEA+JtMCT/ZZWr8dvFnP3cnERi1ZVrGfLk7Axu/E03bLsmzcieiOkltkmXMexmywALinpH0MLNjknr3DGegtpIa0CQo7K2k5gIAAAD4Eu/UmENSLLDsKRYwW6TMjSsvV7+2NDxJTZLvshP9KgAANsrMPgAAAP//7N3NCQIxEAbQyU2wKTtxO7MVxYLEg+csgRSgsKwzy3sV5OeSkPkmAnMAR3M+LfH6PO0rAPyNMMhORvCmtfaeXfMquCiAZksjcFQoIBXFfvmpqNr6pnu8pbxR6HMtMAmFa/u7VwrMCRSzpXlevFVY1N673w0AAMisQhOKR4IxkNy8J7p/wW8qBOYyNipcEozhG96qAOCoImIFAAD//+zdsQ2DMBAF0FP6iIZlaTNBhsoi7EFkGg9AQRR/670RbISsO5//w+YCzKW9tk+tT4VQ5nd8bTIAFTYgkpB6Q5akdLkyMPdbPb0vKeU0pVFKgH7RJ2FYrvwL/yJpzRdnRm6W8j2pZwMAMLqEgTmPr3DFO+ghShhCT+9MqF2M1ndJ6APtrTU1ewCYVVWdAAAA///s3c0NAiAMBtBWExOncAU30E1cwVFdwSE8eNKLZz34Ez58bwLSEkiAUgVzADNarw61XNzklqldrvILQCmY48+lzSkXTt+XFONddyc8NCJDynp4fjyu4LfS9h8FxXzSMSSaOnEDAMD7TmLIM929D/p0CkaT0IVsmHPF7t5W1WaAobyiuxwAzKyq7gAAAP//7N3LCYAwEAXA5O7NQqzPm5ZkKZZgCVYQEVKBxM/KTAVhA4GEfVmBOYAfKvO4pb5b7C0AvEIg5FmhJobknDVA00SdphQpMLfXCWjcK1qzuTORVqYglRQIeUEp5fxhfw20ZIFimqiNSUOQarpHAwAA3E8wBK4733b3j9dv+NC7YpRPnJyLAPBnKaUDAAD//+zdyQ0CMQwFUEdCc6UVWqEhNEfaohOmD6QgpJTAkj+8V0E25eDYjoI5gJ3q18u5lsPD/gIAezYKcLagKfpljnd5naVj0GpKgv4Ovyjxd0Zn7IROteUu/Km0YsWUhBLmlnKONo0VAAAIcLJJJGutrUExNJjOaMqVEGOcJR6U8CZ+673fJxgHAPApVfUEAAD//+zdsQ2AMBADwNQ0jMBIjMAojMG4ofmSClCQ0d0IiQREH2OBOYA/m6fD/gLAcC76jZd0+XzVGMJL0oJGWpUGqMFeUoh40bzJC2KCRb13z8LvxDVwVpss3FJnji1k9YSJAQBIkPDzMt/WXKoG8t3qwGMJbWSfB9Vq7pPw3tQuBwB/11o7AQAA///s3dENgyAQAFA+/TDpSHYDN+kI/e84buBIdQJMEzZAqSfvTXBIAqjcnYQ5gBvLn/crjcPXHANAU/be9qL9BNZljirlAvQU7Cm6rNGOLkp0o6yHc5DxLheIoVule9UWaPwPZ0YqRUpIl0wMAABwklKQx3sXHCDnvAYoWvgrVPj8cwwRvmtu1kYA6EBKaQcAAP//7N3BDYAgDAVQrnrQUVxRN3AUV3EijAkjGKD43gSGGg/U9huYAxjdMh1qzJDWWV2BXkmYq89wCH8TLZHrLsln1BHtm7h10Lwlrj3Qk2u+txetBpHebzpSfoaUvgkAAMDrfAdonAR8JkIqWbM+YrmXirDk7so5W4QMAKNLKT0AAAD//+zdsQ3CMBAF0KtpGBEhMQB9WgbISmxDywRBkW4CUJx89N4Elt1YZ31/gTmAP7c8prnOp5dzBoAh3sv1ZrA6WA+zn0FLXn/20xjCL9JCl9rlBuofTpNalEoohG90u9wlaPMEQvaXdgbrnTEtJM8x3LulMIH2TQAAgI30XCFpfgYJEgJze75Dp8wz5wOsAQDYWlV9AAAA///s3cENhDAMBMDkeQ9EK3RwVVAoHUEl5nNXAAiITGZaiJSPvV6BOYAeDJ/ZOwPAI7TLtaNlji78BtxZFqD/MgwP3ybbn/jVMscJmYKWi2u17SVtsRIo5pBs7XLCxAAAAPeotU4CIXC9iFgTHAAaGx7iyhCY2yLCXgcA9KCUsgMAAP//7N29EYAgDAbQ0Nu5gBs4n53nRA7hXtq4gJw/F3lvATo4IF8iMAfQgH2Ztug7Fz0AeJ7z9jvCIbQiW+G8T6dvCIXwa2fBj+ly1Mg2zcqUOa6akzVXsD8CAADc7GymsiZsvgdZZHjPeH3KXClliIjx7XUrCBMDQCsi4gAAAP//7N3dDYIwFAbQVh5IdAhHwk1wJN3AVRjFCUpIOoA8YLlwzgT9SfrQe79WYA7gLK79I3WXYr85hFtvH4G9EgpppL7mNwUbtnAIq+Scl+LWPdiqaYJuoP6i9A02bEFi1ohW0HYW7odAMYdVm5LGQPN7+30TAABgE5+AtQQIo5TyClCDGWp49p+ebaf8M/f1AHAWKaUZAAD//+zdwQ2CMBgG0CZy8+QmbMBcHt2EFVjBTZgEouFgvBg4CB99b4E2bZo0f/u1AnMAlZge97Hcrk/zzSk0F/MIHJXA3L76sP4Kh7BWykHTp7R1eSaJB35e9eSnJTzcBY3UIBByHCGXWb69fplL3APwf8LEAABQt7b2AeBdO+vDameQyi9z+7e3xbA8xAsA1KCUMgMAAP//7N3RCcIwFAXQBErXcQU3cAQruIf/bukI/gtPhGygNHnmnAlCCyVNuPcJzAFMJO63Y1mXl3dOeostDDCmuFwF5voyMYS/lTAg8vGICN/FfjKGFQ+11m2AdTCo1ogrEMK3Uu4ZOzRCk0gr4jglWvKzTcQFAAB+x3/j5Frhznn25wA7yXBOvVsJV7vHzDDZ0nkUAMyklPIGAAD//+zd0QmDMBAG4DwWfCjdwBHdxK7QTdoRHMUJIoHrY0sfiubw+xYweJCAZ/7ztznA2dyGh5qT3nBRQ6BHL1U5VqTBLcmWbcocv8o4eUvT6UC11me7tJhw6XeXQvhiStJ0f1tjohl9yXg+XQUt8Emcm9n2GnsjAADAH0UQ2eydwj4iMLL3HkwLKRx3elaG6XK+1wPA2ZRSNgAAAP//7N2xDcIwEAXQc0fBMBmJgp4JEHSMwSqMxAZBSKakJPEn7y2QxJYsx9a/E5gD2Jj5dj7Wfvc070TTYQ4Y08O8DCHxkDsxCMWCelXYpIDIh0un9QmF8Ddaa1NVXcK+xzo4oN7VKjFQfFJogS+ugXtF6yNvulEDAEkS/iOnAd6BFfSw3N3Yw+IS7ngPv35AL+aUEJhT6BMAtqaqXgAAAP//7N2xDYMwEAVQt0gIsgmjZQZGzAYZJc2liEiHAH/x3gJYUNg63z90mwPc0TSsvjvRRn+YA7okMNeHxMbLpQJRsFGXTInhoVdN1+RaqYFcoRD+SdzjBUL6ldocYdACPypM/Ax7K86JfBnsBwAkeQes9dHBGjiZsBxcKqHGeHhgrsJy8wnP2UttFQDuprX2AQAA///s3bENwjAQBdC4omAIRsgIzBKJLWgoGCAjsAIjZLJDlpwmfYRPfm8Cy1EsS3f/LDAHMKB4P1evzJHa9eL7Ad2J5SEw14GIqHecb8Klv1owCo7WJEWmIyGRDkREbeTZki7/41xkV0qpweE52YZsAiFdy9ocMbf/AfbBChnDn5qTAADgHHf7OhZhOfivVoPpvS59awOXzpThdTkDnABgRNM0/QAAAP//7N2xDcIwEAVQG9JRwAZhIcQIrMAGWSGrskEaV9QJ8sfvDeDCZ9nSyV8nMAcwqtvlofZEmk6lTGe1A3qTGkb4V4lBnauAEd/ahK1X6MY4z/1IrcUcOl2RnbW7cAncV/dgx8IDxcsPPrmQYW3vZZJP8IRHAADoXq31rkpjEJaDbiT0Od5HLdzenedR6+9Ivx4ARlRK2QAAAP//7N3BDYMwEERR+4bkUzqiA0rhnGsqcTqgCNrgQAlUMFGkTQlEO/J/FVhagSzv2sOFOQAYlF7PvTzaQf1hp03UDEBGDPwlIulbj9Nw6Uut1eEFPvxBJIa4Nm/ekfaIBCT1GE53tPJfHJtxetIV3x5yc0652kjhHFsMRjo+rNDZJ+JHEkn9AADAiUsqzZxgDbgZl+WAPEx6MHf2WVx6OJzXAwAwolLKBwAA///s3cENwjAMBVALLhVC6lAs2hFgQriEDajkj99bIY1TtfG3hjmAye7bo66Xt2eAKPvNegEdueTVT+pH70MCLEvixJAvP536SW4KURdne64prGmS99wYwSELtd4RnLdDrQmDqXVGfQQAIFVK8IOGuT+nWQ5a6h76tp8YTnja9LofeglwAoChquoDAAD//+zdwQnCMBgF4OTkoUJxIlep4BIeXc1J7CSVSA8OUDCPfN8ApaUhh5D3P4E5gIFtz8daLtPLGiDK+eR/Ab1Zt9s9ZbLoSFIvYs4aCwluDCnfPVFTRI+SQxWzJqUx1Vrbur2GfrxASI7k/bG1EydcSOFAP82biWHidjnp3cF70JfU4DIAMB6BOf5uPy8TloP+JJwHL0c/cB/qlDD80+AxABhVKeUDAAD//+zd0QmDMBSF4QREWhyiIziKI7iKG3QGN+gIjtBVfBeuBO5T8bGBHO//TRAUIiY5JwTmACC6Zz+nvjuiPwYIGR68LQCtIdzUIG+JW0WHP/qmJwISvzGkWBoYA3744XTVObEYCSDFIh4cXmmrlVLmll14/O+K7dBojIflNuFbiPmW4wohSgAAoEKlOPHla8y4kfI/mHP+CK+XAbdmZl+BQpipQjHh30N4FexmxnkOAACiSimdAAAA///s3csNg0AMhOHxAYUyaCUVpARqSCeUsK1Q2UZIPkXiEkVoB/+fRAE8hA/2eAnMAUBxecqc8+AkKnlM0jzxygGMhmDTuJwHMtcMC6CQbFQ10xNDlIEDmk7jch9SP/6LBDILyPrnvCmb79RIhhvda1djGLKMLUPkjnZOIcYJAnMAAMCF03Icegs3EhFLLk95XXBX7957fF+SnmUeOPA7hx7MvxdvOdQbZjkAAKhM0gcAAP//7N3BDYJAEIXhmYsJnizJEmiBhAJswHj0agfGDigBOrAFS/DkEbPJXD2hZN76fwVsYAlLssubITAHALD5fOyt2byYCaS32/KMAGTzmLteparo34lqfpPwfV/dfZ/gOrCeQfgn6OJCV6W8KlgTixNh4rpF6Ec5LHeLjo7Qoh5yLEH78QcVopFIdKBW7iRAmBif8N0EAAASYm9NBftnlYgzovtK5wZPgiXAIgrvz+FbA7l7K1IAVL2YJAAAWMLM3gAAAP//7N3BDcIwDAXQ5Myh6iSMwF4sU7FBmYAZOgobIITPvdBWcfreBE2kqFLibwvMAfAzXu52guYNAnNAczwctS97YeZsYsg5RBH0LfFi3x6dUuihWH0SmutT/O+yTx8SCEkoQo6P5MsQmutYB2E50+VYowkRAJDJkuRbB/dn+dVav/dMrwMDKRriwR/i/Dwb38NrTK3cwtbT6vawaHAHACdXSvkAAAD//+zdsQ2DQAwF0LsuBV0GyYApaBggo2TDRBeBRANBQorOznsbICQwxt8nMAfAx2u6P8pw0fyib9fBDQJ6IzDXuXkwM/KJSsvws9BcYgmGoJunn+n9S/BMXAjNJbMKy0XYSLvF6XKxZQg73oTm8klSJwoTs8e7EwCIJFLtog4Pqn3X11pbn2z84RV8W4hn0QUcE2F24HTQbe4/RuhXWfQJAP+ulPIGAAD//+zdwQkCQQwF0CwKgh4swVJswRYEDx4tbVuwsoiw4E08iE7CexWECSzDkL8RmAPgZb+9Og2GtdtErFf6A4zknueLwa4aqgcbheYaazIEHQYwSunSK6G5JpY+Vg/Lhe9gbU22zIXQXC9N7om2y/FWZhq8BQAqqXR3OXg7q2eaptMSzDz+uPi32+X8LA8+k5nzEkAd2e0LtVXYLvc0D1ADAPBPEfEAAAD//+zdMQoCMRAF0OmtrLb0CN7P1oMsllZ6FQ/gWbIIQexEWDEzvneDJBAmIT8jMAfAUzsezrHd3M0IQ5qyv50ECtJdLonW2mOtbsmHITRXUKGwnK5KiRTqMhdCc/n19ZsLhOXsgzVUCT3u1Y259W4CV58q8EeGr03tqQBAl+0zCPV4Ei/nwMsP7snedZcDPjP6G4LdCmfcNUJ333YS9gUAIiIWAAAA///s3csJAjEUBdAX3QjiygKcDizFFhQsyBatZESIoAu/KOaFcyrITLKZTG6uwBwAt+azbUwno7dCc5YLcwK05Dju9gJzuWTYuH/mEprLcmsfd9Sf372E5cLBi5R6mrNzaM4aTKiUcqhhuR5Ygx3oqGUuhObyKqUM9RDupoPH0S7HqzI0tQwNjAEA+L9s7bgr+2btu2qV+9d34MN2OeBtGc4QfHwRYd27Wn93OD+hXQ4AiIiIEwAAAP//7N29DcJADIZhu0AgpWIjNkpNFWAhxAqIAcIITGJkyZGgO4kiZ/M+GyT3U5z82QTmAABf7HJ8yH6481fQlWErstuwJgB6QlgumUITlTw0d1XVCgHAv+RhuSiCrhKWOzNVKZ+4E2+FPmnyEGqcL3Tuo2P2WGStuAdrOUVn9QqWZgtM4kxCVQ9RgJuh6KgFew+tMhSeE0AGAAASoaJnsj8x0UylTx46WXGq3OJlZq2hymx7H1iFmc0JzssvbzYZ3nv8biMwBwAARETkDQAA///s3cEJwkAQBdA9CZ5ytLyUpC1YiS2kBFuwAw+OJxGMBDIzvFdCEhayu3++wBwAn46HWcscqZz22h8G+Ori0ZTUaZLqWTiknriYcG90CfphPSytW/B2jmCI9o/EYh1cmjQnDetgPxF+7PROp2ji9J0mF60Ptx0vSW7tKkzMChWaCDW9AwBvFVuUnSUkE/+AGfbI1uwRa6GD32UfvjtFu+U/KgTmDD8GAF7GGE8AAAD//+zdwQnCQBCF4Z0Ccop3S0hNAe969SR2oA0IKcUKkhJMCVYQGRxB8CSyODP8Xwe7C0M2s2+XwBwA4MNy3M9l1VyYGbjRNqwFAE+Gpd/QFAoo4YtKr3AIt8MGYA3wMdEhaHWyW5URkB1iPydbOw2jTj80elHRWx1cJ5rnHXUwJQ2XzckGthWRiVCxP/bqpu5TDomGdU8YzEdF9l3qve521FAAAGAiBuY6LvzxQV8WF5Gb7QH/3Su48gITUE2EwNbXfRTrSUf4v09gDgAAPJVSHgAAAP//7N3NCcJAEMXxt6DiwZsFpZRcbEPIzXJsQSuwhvQhrAyMN08Byczk/+sgH+yG7Hu7FOYAAD/12/Wiw+7N3cHqzifpuOc5AIik0illW1QtuGkL3S8vISAgC1UWDEGbuffOe5ff5KH2SixocucUzjgKj4MWKmLhvSAvQVac476l4gy7QG+CF7wtKDkUu96JMjEWyBA8Z/wEAABKWpgzY2uNjS1W4kW5h58sHqVswvct8Cf+XyT6Jq7jgjWUDPPI0zfmAQAAkCR9AAAA///s3bENwjAQBVB7ADokxmMFGmqUCRgBNoAVsgFMFGTpJGgoSEHi03sbJJYs+c7nb2AOgO+2m6O/w+J2mUJYgARaupwCa8eiQD4k/LRTpIZIm1uRuIDwSHgJukgNySGatlnXci9tbnkx0G0fpDsxDDkmXLlWZLnUWu+SkpbzMUh8S5Y+3DynaZJcwRw9XDw/eJABAIh6Wq/nxbNHVP4rzn/XGJRbU31smDFQoj8Kv8mYMtdDv8UjdwDAWynlBQAA///s3csNwjAQRdHZIFiAWFAYBbFlD1RACaEUOoCUkAoGWXpIbJD45DMe3VOBk0hxYvvNEJgDALzl+93RlguqAWM685nZZsUDABAJ3ZRyKAc424TX9ew2R1elialabAmIHBIegjZVZ7wEGAd6kDgUYqrW3BAMGZ/eg3d1lcv4Hjy5+zXAODCszKHIrULFBD9HVL7RkweJjQ4F+EMN/xdrDt4BAACpeW30TGhueC9BuZsKe0XSuvsv+50E5oAvaB+tC37PPp4PNHdEX+vvKp+jAQBA38zsAQAA///s3U0Ng0AUxPF35oIUJIADbNQVFtYBFoqDIgEHZNPZa5OSQJfp/6cAOBA+3rwhMAcA+KxtHlwh/AztcgDqQrucCfNGpdDP11cexiU4dy39BE/aFtuZnubGILQl98BECYZwXzxZbjpVa9KswKKjlSUK/0GhSMdm4qJVu0B+bhzqOCRfGip6GgeJQw0FhIlxiN7TlxtcvZEBcwAAYDCMP7FA5RxaIpUqDcoVPM8C16l96Ur/xbLBO7TLJX1fAAAAeIuIHQAA///s3bENgzAQheETSpcCUWeorJA50mYBNoA2JRMkG2SCzOLopEMCCtJYyHf+vwmMJYyM/e4IzAEAdqXH/Snd+css4XCnRuTSMe8ASsLF6ECsqt8U+BFbu4xLcO4Am2qx1+CP26eUCA8HU0EoRDbrIheCMlusg5/AXZNmNw7dqxK1M/GShltfGnYlOJefBmus4+YQOEgs9p70BYwDvnnp3jZYt0gAAFAp+z/qIey/RwuojJwd5GF7v7mIVMlnBFro5F3AOIBaeNjn/g3C2bfCw/knXeEBAMCaiPwAAAD//+zd0Q2CMBDG8YvwYGJ4YhE3cBVHcDoxKawAACAASURBVANkA9iIFRyBSWpMzqQJDxbb6LX9/yYgbULg2vuOhjkAwGen41Wag2Ol8FN9J9I2rDkAK0amyxXpptOySuY3iEw7UgIRQNNiF+NpsSk9nHNcDC2U7m3uF31C+BOVaCiOlElqdkozl4rqos2RtSSvX2icS6eiRrk3momRQk6TWgZ9X54NPAsAAPiPEgIjXrUcvmm+pAFSd+/fz3qIVGx9n3NSYCcNK7R+7hJS+8yhPrpSuwcAABsi8mTvDk4QBoIoDM+ePQVy1hLSkh14zkmwAysSgnctQTswFSgDIwSUZAmLZJz/6yAbkmx2980QmAMATHoe2rNUq46Rwk+ta8YbwFL0VMr/T1YFNkr4RwMiOw00aLAhpTRZLRDfabhGu1PZJvgpQCeloSiBgcgi3eMNgeL5LAhydVA1u6Q7HYdjsoMWx0AX/w7O3exZJ1icyQ5L6jflESgoJ3QoQCkOO7Xo+/Jiwbkt80kAAMLxFPYf09ichjWPTLq/MiggtXfy79cXWPslMAfMs/RzBk1GcNrD3hHnOQAAwCcReQEAAP//7N09CsIwFMDxBNw7iqOLq3gTr1BwcOzoJt4kV/AE6k30BOKqwiuRJ0IVKdhKPv4/6J6mNE2T9/KsCAWDAADt2OXqZq73Ad2F3g0LYyYj+hlAKEopF46nkS6tEJZT0tPTRTf1HQGu32mg+FyvXBJDmjZUl8uDBsesM739rR8XRYTv/ge6aV7pWFgE18D+zfREYGRKk0SnGd69nzM6nTPyDjQwT3xUKKAaBTrjE8804TRWJw0kPhJQHK09ayT9iOlfU0RsAM0AEAFrrUus4r4/vKDiW/gugXWx8tc1T61Gv+uuSZ07+LlcwO1rhX2Y9Oja0Tn3fviDsR7EAwAA8GKMqQEAAP//7N2xDcJADIVhUyCxBwvQ0DPCjQASAzAABQ01M7BB2IAV2AAaWtjACMmmSoECEYf9fxNEl0tySfzOBOYAAG8brLcrud52jBh6Nx2LjIaMM4AanHSxpPgvOPtRcU5a/O88PNdYcdi9jsP6HesOMEseknMUQieTOEjsXvdEVY2yW3gnVgw0t3thlk5JbQgNw6+HY/I148V2a26yF6BYx+aSOEQs9rycZJ8L+C7ez1EB1n09ITAHIKI/CBB19QwebbIH5+z8lgDfxfaq+nF3qMDzvSqsQ2IKGLCuzUFVS/ZBAAAALUTkAQAA///s3bENwjAQheHzCFQUdGzABl4lEivQsxErwASECRAD0NEbhZwlF0kRESvR3f9J6SNLcRL73pnAHABgknA63+X9oVgW9ew2IvstAwxgLQ6pOXKKggNa8HrxPg6Fh4ZFWi8BuiIgly/PwZAShdAO6fPQUqj8k8NzVw2ImJ4PtUg9FwMxF/ZuKaW4hhvB8kIIXTd5mkn1XkW42HwRpb4b89zovZlC9vcJBcAQCgmxMAJzlRCYA2CV8cZTroJzxQni0VBzlG6vJ86xpqn/xc95bgtj+A6xiX3o6lijAgAAw0TkCwAA///s3bENgkAYhuH7lAHcwBF0BFdwBBN73cDSmglcwRWcQOktsLS0NSZniEdEA4UJF+HufRJ6uAt/DriPn8AcAOAn2mzH5no7m/sjYeTQumTw6i6XDBlbAF2Q2sVyzUzEQ1LRLWMV+zg0yFx4JnehkVOfQyPuw+706yAUUm8ee4etWPEBt1Hm6mBZC3sdJq3UwzIsPOnAaXXJxYWGo++8ijdJewJTtQ5lfQxhM6XrKDir1EjWip9Say3Py/DC3X9HRhd/QmDOEwJzAEIlqejctQt8goPtNl7pIhfie7HWf4YniY2mnrEOCZeknPdLXtystaMArwsAALTBGPMEAAD//+zdwQnCMBTG8ZcNeuhZV6gjuImCAziAVwdxBDfoCLqBJ6/qBM+DLxBEbYWGpOn/B+K1Wggpfd8XAnMAgL+53X4r1xtt2hjerBaZ1/yxAHLwGo5ebxiOnhjn3ImwQG+PIEQXfu6qmvxkRnvRLTbkXAXfpbb9xnBQ1VV5Pwt9jWmgMSG/FrZ+TcxhDfzE1sUqCH80nCLYaZHr/UQ61jjfsmfs9F64cMlxsNLupy9S8CFi9ou/nVW1yfkCMX6Fn9SCvBGYi4TAHICSTSwEcbRnvNGF56w4KixGKf25fjl0oQ2BufjYh5SL4tZoeJcJAAC+E5EnAAAA///s3cENwiAUxvHnwbgGiTt4d5QmruDdUdxEN1AnUAbw5h2jeSSE1AMI2pb/79TeGhIpxffxCMwBALLMtruT3B8URqCcxVxktWRAAQzF2nWb0XdFQDr9w/RMgKAYq0XS3i26/5YPwXmEP8qhEBpvFCtns3GYWN8vUiNYHISERQt+JAoMMzem65xz+7E9NH5Dux8d+W1lueic6L+3wvVh0VCdru2N3obXfp7k/ZbuFRQ3dN5Ebbq2OTDQ+AMCc5UQmAMwZY10metjfadx7TY+iABdcDCKCQ5IaW1/rMq+FoG5+liHTJfuU11bH4cKOPQOAAB8JiJPAAAA///s3bENwkAMhWG/kjRsgJiAGTICKyDR0VCzRSZhhmzACmxABRKNEQhIE0UIxQbC/y1wkq/IKfKzCcwBAN6m1eZop/OICqIXs4nZuKCWAL5B5Yvlmpv4XzTmATRCo8EmpVSPEEkXwm85KnfnPYhOkuZmtqVKKeoXDiH8Fu/6RixpQkIWBjfgQwjMBSEwB2DoJO34f3ZT34dGPQelBGw5axuIwuCoRti2JUkH6huLd8iw8a3o3d7dp8lnAgCAX2JmFwAAAP//7N2xDcIwEAXQs0QJVQaiYw82gA3YgKzABszABDAFJRNAUKIUUCAiglGA9waI5NiFk/M/j0wYAC8rJrM4nnZxvvhhQz/FWFgOGIqDsBx18TalNP/TjrAQ7UFoYTka9Vpou2S7SSk/hfJh2AjL0UVVVduU0jIi1l5YdgIzw7AQluPDVprZAABfZGHv0pjefMM1QemU7o6TdGmI8ui5PJctLNfamwvopVR/fqvyh8YCAOQQEVcAAAD//+zdzQnCQBAG0BlNA9ZgA16sRwIWIXgVbCMdSarwqB2sRG8eBH/CgnmvgvAlhyHszqdhDoCv5P5wjPN1J0U+1swi1suIZi5DoLbHtvx26wAgd5nZRcRGGkxMW0rpvHSeZeawnfkkGP5c79Iw7zIzMhFmRKrQMkcFGuZGomEOmAKzC5X1pZTVmI/gGx+fOeS/ZebQhHmZeg4/tPAvHwB4KSJuAAAA///s3bENgzAQBVCLmi5VFmAvNkhKpLQMwgieMEjoijQJkiEKOO+N8Cvr7O9rJATAFs/xMaRLq1hAue6qLAccxU1ZjlfxC+ckFP7I3UNo3omNMr2AqJiyHEXizJilR8UmZ0R+SHEJADiTb272gk+WuZaE4Nhi9uzueR/ZLB8AWJVSmgEAAP//7N2xDQIxDAVQlxRHdZOwCSOAxACMQE/DCrfBjcAobGIUKSUCoaADovdGiJsk/k4MzAHQLM+nTQwrh1DeNw4R49rCAb9gyv1BAJBHjrXRCL0rQeiLKvNMDcsbmqNH5afhrQY7DXb2jHRqqkOh8BWZeRUmBAD+RWbeym+lCsbClnwEyt0ZtJut4UfIdgAAr0XEHQAA///s3cEJwkAQBdBFRBBPdmIJtiJYgCXYQjozHWgJOXkcCc5RJCQSw/JeCTOHnWX/sBbmAPiN/e5QtpunajLYevX+XQ7g/9o4nQUA+SgfGI8C0FROEJrBcmmuUTEq0mWo6K6pjGVmpFJmRJbikuc1AMDiRcTV3ZAZzbks17tpLkwTEf3C3EMZJ+myjgAA35VSXgAAAP//7N2xDYNADAVQCyipUjNBtmKDtHRk1IzABE4DJRIRCMjpvRF80snF/7LCHACHyPfwiUfbR12libLJs4toarMCrjbNwVZYJQBN4QSh+Vlmvlz6oBBLWU7Yh93sjBTGjshtzP/r6EUAgD9il+YMZ5flgOMoe+3juhwAsE1EfAEAAP//7NuxDcIwFATQq9NAkSIVe1EiZQo6lAWyBmMwmSlwnwiCwNF7I/i7+LLvFOYA2EyZrvcMx7PSHItOfXLonBPwa6+A9GX0kcQiAWh2ShCat9W7ozRHy5Tl2JydkZ2wI/J3SilzkofJAAAtqG8NN8Pii5TloG2z+X1EYQ4AWCfJEwAA///s28EJg0AQQNEpwJz0bkspQSGFWIk92YGdTCB4FcQorvJeCXPZYZkvmAPgUL9ornmNpsqquopoG/MBStBl/3EgzWYOoHkYh9D8TTTHjYnlOI2dkZuzI1Ky9/KGAwAULzMHwT8nuTKWE+jBATJz9kbsNvnXBwA2i4gvAAAA///s3bENgzAQAMDvKFKkRFkgNStZYo3UTJEiG2RDIyS6NBA9Co7uRni/bMv2+xXMAZCuTo8x+utTZPlw6SLuN3EBzqDUMr6NBHt5AM2f8BCaNGsu+TGblixr+OBSnSPZM9Ioe0RObZ1b5SgA0BIF/2R7/biznPM0yKNL2nd05wMAtouIGQAA///s3NEJg0AMBuCgt0QncC7BBRyhI3QTR3KTkxaFQl+KnEjg+0bIveRC8juYA+ASjub4UbqI4RFRerUB7jbXcTKA5jQL0CRnEZrm9sTsUWVJ4EjgXj0WV9MzksxTj0gGtdZ3+NHLYwEAGXz9C6GFz2z/xmM5oK3FUfUpQpEBgP9FxAYAAP//7N2xDcJADAVQl0iswARUWSkSA8AobJCMkBGYzBGSCyijKEoO3hvBd5V93ycwB8BmhOb4cr1EnE9qAuxtzP5m6xirfQy6J9WkIU8PodlKZg4VmjPg5aimnTdw84fe9y0zu9oAD0fVV/gdmpCZ94h4OS0AoAX1w71FU6z10NuH31J9auGvZUb9fQBgkYiYAQAA///s3csNwyAQBcA955KzG0gdSQe4BJfiyrGItgFHsQBrpgQ48Nl9IDAHwKWE5vh6LRHPh7EAemthOcUk/iYboIsGaCaxZWMpXCZDc2+hOQbUCulFMZ1esqnNj0iMpq3Xn1y/YTbFD54AwCxyz72bMH7Qzm1rrdVjoHBP7mTOETAEAM6JiAMAAP//7N3RCYAgFAVQN+izNRqlFdq0FRrBTSJ4AxRkPfGcEZRC4d2rwBwAzQnNDe4Ky83T6KsA/E9YjmZiAFpDLFkZhOZT0Zq9GGAmkU0DNxlEcN2ZkSyOeHVztyP0KELwq6IGAKAX8aqz8j2eqHFvSxMQcYeEd8U3VS3rLTXT/xAA6EQp5QQAAP//7N3BEUAwEAXQtOCsCUpQolJSgg6UoJMYM3tw5IDgvRISE8naLwJzANxCaO6n2kZYDqjBKCzH1SKMNGjWozJbI3TnIzZ3K6UscdNcNvg8aHsn9wLD1CSex96ekYflaLqcTQRvtttzWlMBgFeIH/oIzXHEFLV95zb4PvXrY4TlAIDzUkorAAAA///s3c0JAjEQBtCgHXjx4GWxEsvwumABWoIdbAt2ZieRkRSwp/yQ9yoImZAQmI8RmAOgmn9o7nK6p+Mh2/UJRFDuep59F4D21rw+nupADSWUZKoSvfiURuivitBCTP3IOcfUj5cC0EA0FS2aiuhROZdLOadQ2zve5zKdC4ZX7lShOQBgGEJz7BD/tpt/G0xDYG6fbYRFAgCdSSn9AAAA///s3b0NwjAQBlAXiJoSFmAPxqBjDioQC5AxGINRGCE90qFDbqGgcELy3ghnyZZ/vrPAHABNxeV4K+vVviwXT5WfsAzLbTdzrwIwvAzLOWCmqQwnRUSG5jqVZyD9e/6LOLhQZwwi4lp/4HwYEBrxqIjRq6HiDHicjRaN5Dq8i4iTgjM1QnMAwL8RmuOD3r4N5qc2vtRY67u7BqEAwE9KKS8AAAD//+zdMQ6CMBSA4TeRODGyMngAr8JRPQqncSypdjAODoYWS77vCIXQNOXPE8wB0NwzmpvGa1yGh9U/oRzKieWAY70ulMRyHCillCcbLn7Yo7G1TJXz/eOvvE3gvHsyVCQGoTvlfRUVU1vef29lP4ZTEs0BAL0RzfEhn9vmTs5twh7Yn3u976wPAPCbiNgAAAD//+zdsQ3CMBAF0KuhYgNGygpILJCSkoaeggHYIAtRMEImMLI4SgqK4EDeG8Guzr6vLzAHQBPleLiXy2kVm/XNDfyRGpSr7XIA7TzDIru9RUCaK6UM9YNTQIQvOdd2w1wUhdnJNqUuInqLzEzgKgzCrxIqZkKv5uFO6yZLkLPQNt+GAABmL0NzmseXzdwGVIN/k7fGPB8AgM9FxAMAAP//7N2xCQJBEAXQ4TQ3NDA1sgpbsAQ7sAULEGzAHmzhKhs5GcHASA7P5d4rYReWmWX/jsAcAJPKy3kb69UtFl3aiYYtu4jdRlgOmFpfYTlhEf6GgAg/8JqodLLYtCAzrxUM8RMxYxjOwMPwwMyjIlr2VjOaUMxY+goS+4GbWal6YG9aCwDQipo8frRhs6RvA56qlxUK++zu7h8A+FpEPAAAAP//7N2xCcJAFIDhqwQLQbCxcgTBDbKGnULWSJHK2g1dwcrySeAJKayCkMR83wgXuJDj/jzBHACji1tTl/32XNarl6cxQ10sdzyUstssfSWAcbVxrbtYzmEpk5SBiGlz/FprohJzFBGPiKjyMpAwhKHuuQe6SMDf6E0oFnow1DND4qp731pFligj5Ev+uAYAYPIymDo5J1uMz1Q5321An3j2O+sCAAxXSnkDAAD//+zdsQnCUBQF0NcpBAvBAQQryxQO4CiCU1gJTmLpGG6gA1g4ghN8iX4hllHERM8ZIQ8++SH3PoE5AFohbVa7GA2mMSxOJtIhRS9iNoko+v/+JIDvudw2Ky2WazOg7WqbQ+Z5Iw68qmqeLav2Ya2KdFn+GUgwhKaOj82azkB+US3o4Z2Rpqog8ViQGO5ycU3pLAUAuiCldMjfyfYG9tO2+d7W5QCIAj/4gFyO6f767Kw0FAB4S0RcAQAA///s3bEJwlAQBuDDOICWYqPgAOIEjqLgEpbpbBzKDXSETPJEeQFNEQgWxvh9I9xrchfuPwtzAPRGKo9VOpermE1OUYySl+m5+TRis4wYF/9eCeB7Ls+fSvuDISk/5THYTykt8nUwibF0Ub0kz15VjiFoLIbcPCot6vRtlzX5C74Z6aAOU7BIDA25b1rnhVIAgF7Lc7Jt7gMZljoAaqdvA1q4pvZOPQCAz0TEHQAA///s3TEKwjAUBuCHOLmIk6CTjk4ewSt4hEAPoKPg4uBdXT1BJZBFqIo62NbvO0IKSZq8/M+DOQBapz4fDzGbLGI8uvg6LTQcRKzmEcvpv48E8Du5WHRfp2pTp8qlEp2Vu4OVwj2dlXjlWook1h1PnoWHysOQPCcmKao0OPUgfRs+UvaMunHSJK+XW2EK8FwpPN8JaAAAuqL8B+qU2w8CoIB3OP++ZzwAgO9ExA0AAP//7N2xCQJBEAXQCcRAEAMjw+1ASxIsRGzgbMEOtITrxBbMhZNbFjnEQE08vfdKmIFhYZn5FuYA6KWcNlftFjltbjy66lJPzCYRqxQxnw69EsD31HlhZL3Z6wH/oGmac0lWShFx0lSeOJQlka3LswxBWYhaSlSiaGdgMgMZuk4aZ7I4Ryd1uH0jHhUEXvNwoME7EwDoNUm5P+/iABTwrvbf2H/xXV3qAQDwuYi4AQAA///s3TEKg0AQBdBpAikEiwTSWaUWvEmO4FU8Wm4WyI6wfRI07ntHUJRh2fnfwhwAu/Zum7v197h0UpK3NlwjxiHifGr7OQBbKQmMpVXOwSiHk4tzj0y8f3rDVEsisyURWpOLIWujksW5NtX/QLMfpCpsYTIzNknrMHxBfj/mTABg96qm3ElT7l9ZDh6C5+4O/JZwpMLZFwDwuYh4AQAA///s3TEKwkAQheF5nWBhKi/gNSy8iQgewBNorGy9iwfwLN4gAQW7kcEFCy0Eg2yy/wfpN7NkmGR3NnJ3IgkA6AVtD3Nrbie73itm7I/ir3Kzqdl4VMwtA8hObJje+GpNwwiKISlOjo2F8CWzXpQ2LQAdaRABXiRVKSfGNSE0gxZ1X00OBL4jKRo+amrGwbuk3MhGIaBj1Jn4YJ8O70DHJEVcd32Iq7srg2EAwBtJm/QOSN2Sn2K+7UtamNk5g6EMEnUI7PmcNYXn+tbd2RsIAAB+Z2YPAAAA///s3cEJwjAYhuEfKd5z8eDJuoEbGXAAPXotDqDO5AA6giN4Fz6xphC9FQzW5H02CCUQQv+8FOYAAH9Dzfak487Z1G1sXN35colVI7P55FWVY1gOwG88iwkL+dWSYTmURtI51ENqMzvw6n32rtGrs2sGRYB3H8U5H/YM8tEVkxxFOaCfqDhXh4FTzox5ubSldWnGsByQRnfODD/iecotAABgyCTto1IuhuHG3T6ABEqvzJW+fgAA8C1m9gAAAP//7N3BCcJAEIXht5gGAt4ErcFKtAPThue04UE7sAQ7CJaQCjx5EQ8yOOA5sCFO9v8qSGZhmYXdeSTMAQDCSsf2pMfzoNe7YhUzW9XSeilVi1n9FoAw7BK8PZK7sWTAl0+93/v02A1lmQ17GHzmAjQwXErJ9kR7JLKjfGHdfeo2eyCQifeMjScl0TPGdfEekTMxMAFPfG/8DM5eWh4S5kZCwhwA5EXi+OR6r//VhjCU9OMkzI2LPgT6nUu7gouxteGyf/AdAAAgOkkfAAAA///s3TEKwjAUBuB0EBwEBwdX8SQeRcED9Qi9gjfSE4gniFRewclFK0n7fdA96ZTw3v8iMAdA9QTnfmizSmm/TWm5mMyWgKq8ikv5dNY0DR9EMXJo3lv7V9XpJ852ERIxbRa+FM1Bx/g0NJfvEdNhWwVvGNfbmVHzZB36+3AbQTkvrEMhYkjDQXhuVgTmRiIwBzAOwbm/u8S9bbavH8WwnnsBS5kk5xAGTdNcZ3oPveWcdwWsAwCYgpTSEwAA///s3cEJwjAUBuDk6kUP3h3BFRyh4CI6iY7gCDqSOyjoqVLbQq4FU2L7fRB6LSmEB83/nsAcAJPxDc493/vweK181YGWixA26/YJML52uoigHAySTJ2rTFgqXh8Quc75Rzrk1l1orgSKi3RLzkFBEBhRMnWuWVt7XxQhYvgjXYf/XbLUm9MkMJeJwBxAXklTqYM65efuXRO8iyZ4rRijC6eZqEPoxRib8/w0ww051nV9LuA9AIApCCF8AAAA///s3cEJwjAUBuA4gUevigs4ioN46ABe3Uc36ApO4AieRPAkwVcQLx5q2xC/D7JAAqEveX8qMAdAdWb7Q5Puj1263tZW94vF/DUE5YBpnCIo15p/6Ed4rki5AboVEIHx2ROLcY5moqNmIihDNFBuhecm5SEFqETsqZsYOUC39Be6KgjMDURgDmAcb+dijbqvl652yyE595gfBOaG4zuETtSclz+ckJX7BADgZ1JKTwAAAP//7N1BCoMwEIXhiVjoMrj0Ki3YI/RErgSvo0fyCO2mRYQU6Qihm3aTkJr/g4DLQEBCmDdDYA4AsFum7c/ynDu5P04yLyUnrcriHZKrK5HjIYktAcjKTQun16AcD51AAB9BEbrexzVtITkKoIE06D/xwuS5aJgkB/wJLzy3roZzC4o7IpARnURnNUhnvW+fpYA9WQTmAiEwBwDx6b1kmzjOm9h3NDj5EYG5cLiHwGeMGTJrCjg6564J7AMAAOyFiLwAAAD//+zdsQ0CMQyF4fcEEgVUUNIxSUY4RkCiZxVWuQ1gAxiBFWioIEgoQidEGeBI/m+CuLGi2I4ZmAMAVOG5de58Weh6q/OBaTyS5lNpNpGGgx4cCEBl2scvjKs1BSbgy2yHNCwSaIb+iDY1QO9ijIcC4wOKkhqFGnJiNsdODuSeB/ypl+HiwIakLPap0ZI7IgAAAICfs93wodRbp86QHJvkABTL9lbSpufxLakzAACArCTdAQAA///s3b0JQjEUBtCbQmwsLBzEZRxAcAtbwbV0A93AEXydYPFsXjCdgojx5ZwJUl3yw5dPYA6A5qTtbh+3+6qJ8Nx0ErGYaZMDfuXZMLLeaBiBSgjQfaTLwZCIOHlAh/9WBESWZuLbzsUcPGiRg3Ea2ufKPaMA3WvHYjbaIwIAANUawnP505TWznv5jj9/cHKpYE0AX5dSulYemO76vp9XsA4AYEwi4gEAAP//7N0xDoIwGIbhr5vEOHkBb4CTV3F1dfMCrO6ewCvpDeQQxqBDTUNJfj1B6f8+CXuBpAGalxLMAQBcC915r+Fz1HPY6fVuqrgWaSe59WoM5ZaLAgYEwJH+Z5GJSA6Yhbzbkj0IRkZp4fw2xXE5kGPxHKhcjortnNg6vuf9NP+ZUJjnO8ChHBhvTUC3cR7RpTjuYeZGdpADAAAAMEsOfphy//u2xfsbAHdCCAdJ18LP+xJjPBUwDgAAUBNJXwAAAP//7N2xDcIwEIXhh6CKkIjEAHgE2II1kCiyRUrWSjaAEbIDBSAjoYgDHXQgitj8X5OUqU6Ofe9MYA4AADOqdwvFa6VLXOscg46nNCbX9LfIlYU0K6T5VJqMB/BRAP5E93LDyGZLkATIhB2SB9cQHaxJesiTB7/VWcPz3j0JhQB4shCdr4tlZkE66iCAj7kQ3dKtFXNbLx58Xezfaa4EAAAAkDM7G3gMTEntP69929vi9m8AuNf2JoGBqSv23QAAwM9JugEAAP//7N1BCsIwEIXh15UbQQ/iQvBiHsCtB/MIPYF6g+4EMY3ETCUE6Uasg/4fhG5LFkPS6UsIzAEAMKLZ7bcK/Uq3sHmE6C7XhULffG3OUjhuPss3x6VnCskRkAMwjfJHwXwKIzfIAX/JgiOyhrmsYT4cNOCx2XKw58lGZ7Wso/EC4B1FuLgeclYPW6t9Q/2TreeogwA+YmS96C1wXK8Tn4ObhQEAAAAgqw7YWxZ7vKn3d+f6G39xuAl7OAB4wWr4AuZ4xAAAIABJREFU0fnctDHGtYP3AAAAv0bSnb07OGEQhsI4/lI8SCn06AidwWmcoZt0hK7StdT4xJTXxtwa0hLK/3dKDgYxEDTm8VEwBwBAhlBIp9rJ5Ptw9eQv4pc2tMf5JOPcfDxqc3gWwqXtLT1ucz4yVQC+5RGNaz+Y3gcFSY4DkCE6KG3iwrqSbL0yFIAAqMqP1kN7h3v1SYgDULMooc6k/VJ2iQIkDAAAAABAWcneV4l9r90+F99xAJDPOXcXkaHyR3hV1VsF9wEAAP6NiKwAAAD//+zcAQkAMAwDwTgo8292DGphUMqdgwjIO8wBAAAAAAAAAAAAACzQwaoXHa3ha44AIADwRZILAAD//+zbMREAMAgEwR8UxiJOUUERZlfC9VfKAgAAAAAAAAAAAACc8D6Y5dosBwCsSTIAAAD//+zbAREAAAgCMSIbzYjWUG9L8ATAYQ4AAAAAAAAAAAAA4Ic6sKIXNAAAXyUZAAAA///s0QENwDAQA7E8k0EYfxLFMCQpja6yEVyUaetfAAAAAAAAAAAAAIAfm5k3yTp8wdf2OaADALhVkg0AAP//7N0BDQAADMOg+ld9Hc/ACIY5AAAAAAAAAAAAAID/7HIAwLyqAwAA///s3QERACAMA7HOARbwbwoHSBg2gEsUfBXUwxwAAAAAAAAAAAAAwMOqaiTZDyyY3b0u6AAAfpXkAAAA///s3UENAAAMAjGkzvIcTcUeJK2CM0DwMAcAAAAAAAAAAAAA0G0K6tdYDgB4l+QAAAD//+zbAQ0AAAjDsEtGCpKxAaRVMAMzzAEAAAAAAAAAAAAA3FYH6ntBAwDwXZIBAAD//+zbARGAMBDAsL4SrEwy1nCAjW2XKKiBGuYAAAAAAAAAAAAAAA41M6t6Nq//qneDDgDgdtUPAAD//+zbAREAIBDDsElFItJwMGzwXKKgBmqYAwAAAAAAAAAAAACYaw0o323PAx0AwO+SXAAAAP//7NEBDcAwEAOxPJNRGfMyGZSUxlrZCE66aeszAAAAAAAAAAAAAMBhZuZJ8h1Q/bZdP+gAAG6XZAMAAP//7N0BCQAADMOw+Xd5J3cxGCQ+Sh3mAAAAAAAAAAAAAAA2LdzlTiwHANQkeQAAAP//7NsBDQAACMOw+1eBVGzw0CqYgRnmAAAAAAAAAAAAAAA6NQxzc6ABAPgiyQIAAP//7NsBCQAwDMCwTskt3b+auzgMEgU1UMMcAAAAAAAAAAAAAMAyM3Ors6DaMAcA/FM9AAAA///s3QERADAMAjH8u5qTOWE21mui4A1wGMwBAAAAAAAAAAAAAMwz4V3utL0fdAAAWyR5AAAA///s3QEJADAQxLC+kzmafzdzMXhIFNTAcQZzAAAAAAAAAAAAAACLzMyp7oJi73IAwF/VAwAA///s3QENADAMw7DwR3NqZzAan24jCIGqBnMAAAAAAAAAAAAAALtseJe71XmgAwD4STUAAAD//+zbAREAIBDDsElGGtJwMGzwR6KgBmqYAwAAAAAAAAAAAACYZQ2o3W3PAx0AwE+SXAAAAP//7N0BDQAgEAOxTQHWkUxwwYdWwRlYZjAHAAAAAAAAAAAAADBE2/sutwbU7gcaAIDfJDkAAAD//+zbAREAIBDDsElFMhZQMmzwR6KgBmqYAwAAAAAAAAAAAACYYw0oPW33Ax0AwG+SXAAAAP//7N0BDQAwDMOwjMmZnD+rw7gm2QhCoKrBHAAAAAAAAAAAAADAAjNzqrsg1bscAPBH9QAAAP//7NsBDQAACMOwS0YaErEBoVUwAzPMAQAAAAAAAAAAAADcUEc6e0EDAPBRkgEAAP//7NtBDQAgEAPBngMkYhFHODlsQJhRsEnfdZgDAAAAAAAAAAAAALhcVY0k84GdVnfvCzoAgB8lOQAAAP//7N0BDQAwDMOwMBi180dzGN8lG0EIVDWYAwAAAAAAAAAAAADY71TzQad3OQDgneoCAAD//+zRAQ3AQAwDsZTBmIw/i6cyBBmNSm8jOOmmrQMAAAAAAAAAAAAAAIvNzEnyLn/0tX0WdAAAt0ryAwAA///s3QENACAQA7HNEZKRSnDxhFbBGVjmYQ4AAAAAAAAAAAAAYLC264Gx3LUHNAAAP0tyAAAA///s27ENAAAIw7CezP8TZxQk+4XMMcwBAAAAAAAAAAAAANw2T/oY5gCAriQLAAD//+zRAQ2AQBADwZ4CkIJ/FzjASd/GJcwo2GSnrQsAAAAAAAAAAAAAAAvNzJ3kS3It//O2fRZ0AAB/luQAAAD//+zdAQkAAAjAsEe1fwprKGw9zh3mAAAAAAAAAAAAAADumgexXO5yAMAJ1QIAAP//7N0BDQAgDAPBTQIK8O8OByNzMcKdgiYV8ApzAAAAAAAAAAAAAABDZWbX5fYD/6yqOgN2AAA/i4gLAAD//+zdAQ0AMAzDsJbZKJ/haWySzSOKwxwAAAAAAAAAAAAAwEJt50gs98RyAMAKST4AAAD//+zbQQ0AMAwDsYM6aIU6Gq1kIzgp7zjMAQAAAAAAAAAAAADs9I7sMgsaAACq+gAAAP//7NEBDcBADAOxlMEgPH9WQzAIeRqdZCM4JdPWEgAAAAAAAAAAAAAAi8zMk+T7wSdv27OgAwAgSXIBAAD//+zdQQ0AAAgDsUlGGhJ5YAKSVsElEzAPcwAAAAAAAAAAAAAA99STTfpAAwDASjIAAAD//+zdAQkAMAwDwVTJmH9TddLZ6OBOwUMExMMcAAAAAAAAAAAAAMAyVdVJzge73JnpBR0AAEmSBwAA///s3QENADAMw7CW4aif0Wlsks0jisMcAAAAAAAAAAAAAMAibedILPfEcgDAKkk+AAAA///s20ENAAAIA7FJRRKSeWIBklbBJXvPYQ4AAAAAAAAAAAAA4JZ6skcfaAAAWEkGAAD//+zRQQ3AMBADQR+EMih/UqFQBs6jJBJpBsHKnrYWAQAAAAAAAAAAAAA4wMy8SdYlXzxtvwM6AAB+STYAAAD//+zdAQ0AAAzCMPy7uNPbgKT1scxhDgAAAAAAAAAAAACgx8pd7sRyAECdJA8AAP//7NtBEQAACMOw+VeBVN44GHeJghqoYQ4AAAAAAAAAAAAAoMeXYW4KGgAAriQLAAD//+zbQQ0AIAwEwVYJ/l1gBSUlfeKgJDMKLrn3CuYAAAAAAAAAAAAAAAbIzI7l1gdfnKraA3YAALwi4gIAAP//7N1BDQAADAIx/L8meQJmgCWtgjNAMJgDAAAAAAAAAAAAAOjw5V1uChoAAK4kCwAA///s0UERgDAUQ8F8J/VvqhZAQTijoDCzq+BNMm0tAwAAAAAAAAAAAABw0MysJPsHH9xJVtvrAy0AAG9JHgAAAP//7N1BDQAACAOxSUYaEpEBJK2Fey/zMAcAAAAAAAAAAAAAsK+eNGhjOQDgrCQDAAD//+zdQQ0AIAwDwE0BGvBvCicjeyMASO4UNOm7qYc5AAAAAAAAAAAAAIDLMrNHaOODHmZVrQdyAACcImIDAAD//+zdAQ0AMAzDsJbpqZ7ZYeyTbB5RHOYAAAAAAAAAAAAAAAa1PUtiuSuWAwC+luQBAAD//+zdUQ0AIRBDwa6i04BzJJyjxQD/QDKj4CUVUA9zAAAAAAAAAAAAAAAHVdWf5Htgg9Hd84IOAIC9JAsAAP//7NtBDQAgEAPBnhP8myIoORTwBpIZBZv+6zAHAAAAAAAAAAAAAHBJVY0k84P9V3ePBzoAAM6SbAAAAP//7NBBDQAwDMSwUxEPwqCPQb9rJRtBlLIHAAAAAAAAAAAAAOCbs2T9HdAAANBL8gAAAP//7N0BDQAgDMCwXQn+XSEFGUDSSpiBOcwBAAAAAAAAAAAAAFwyM7taj/d3lwMA/lAdAAAA///s3QENAAAIw7DfKf5VIIOQtD6WOcwBAAAAAAAAAAAAABxoOw9iubjLAQBvJFkAAAD//+zdAQ0AIAzAsF0Z1pGGDCBpJczAHOYAAAAAAAAAAAAAAC6YmV2tx9u7ywEA/6gOAAAA///s3QEJAAAMw7DN2f2ruovDIfFR6jAHAAAAAAAAAAAAAHCs7TyI5eIuBwC8kmQBAAD//+zdMQEAAAzDoPhXPRXrBUYwzAEAAAAAAAAAAAAAjNnlAAAeVAcAAP//7N0xAQAACAOgraH905hCLyiCYQ4AAAAAAAAAAAAA4FHbscsBABxIsgAAAP//7N0BDQAhEMCwnYN3gH83SMLFB5JWwgzMYQ4AAAAAAAAAAAAA4Ccz81W7Wpc3d5cDAN5THQAAAP//7N0BCQAACMCwRze6LQRh63HuMAcAAAAAAAAAAAAAcGcexHK5ywEAL1ULAAD//+zdUQ0AIRBDwa6zk4IztJyyRQM/BJIZBS81UA9zAAAAAAAAAAAAAAAHVNVIMh/Y+u/u74IOAIA9SRYAAAD//+zbQQ0AIRAEwVkFWMHCOcfZooEHyZFUKejMfxzmAAAAAAAAAAAAAAAuq6qZZCUZD2z9dff6QQcAwJkkGwAA///s2zENAAAMw7Bq/EmM6VDsqGRDyJ+RDAAAAAAAAAAAAADgT9kst2Y5AKBWkgMAAP//7N1RDcAgEETBPUdIqUSk1QIKrhr4IKHJjIJnYLMe5gAAAAAAAAAAAAAADqmqJ8n8yVhuJRnd/V7QAgCwL8kHAAD//+zdQQ0AMAwDsYT/p0xGcRqIPSrZPE7nMAcAAAAAAAAAAAAA8EHbSXKWxHLPiOUAgNWSXAAAAP//7N1RDcAgEETBPSVUGlJqFSVXD4QPmswoeFkD62EOAAAAAAAAAAAAAOCgqppJ3iTjR7uu7n4u6AAA2JfkAwAA///s20ENACAQA8FeggCkIQH/Knih4D6QzCjY9N9hPgAAAAAAAAAAAACAnqqaSdaHR7lrv5EBANCQ5AAAAP//7NuxCcAwEANAjZQN7BWzkTd7N79ASGPDHagX6uUwBwAAAAAAAAAAAADwUR/kniSzMy7e8K2qdUAPAIB/kmwAAAD//+zbwQmAQAwEwKQCW7BUW7UDO1gR7imIP+VmIP/d/aeTWBEAAAAAAAAAAAAAJtfd2+wbPFjH1XiUWz6b9J396pPk+FNoAIBbVXUCAAD//+zdAREAAAgCMarZv5RHDd1y8IdgDgAAAAAAAAAAAABoMGdY/NN4lwMAzkiyAAAA///s2zERAAAIA7Ee/hcc1wckFn7+URMAAAAAAAAAAAAA4KU1ywEApyQpAAAA///s3UEBACAMw8BKw/8PJ3NQfLA7CTEQhzkAAAAAAAAAAAAAwGFun5vktJ3tIQCAjyR5AAAA///s2zEBADAMw7BQGn8SZZTxaCUI/m2YAwAAAAAAAAAAAAAMc/e8tnM9AgCwTJIPAAD//+zbMREAAAgDsR6O8b/UByQWfv7RFAAAAAAAAAAAAADglTXLAQAnJSkAAAD//+zdAQEAMAjDsEm8VRTuPiCRUAN1mAMAAAAAAAAAAAAAHObumLbvegQAYKkkHwAA///s2zEBADAMw7BAG/9vTMog47FKEPzbMAcAAAAAAAAAAAAAGOZ2uElO29keAgD4VJIHAAD//+zbMQ0AMAzAsKhIy/8bg/GobAq5M9oCAAAAAAAAAAAAAJz3qjXLAQCnVR8AAP//7NsxDQAADMOw8kc3SFNpVDaF3DHMAQAAAAAAAAAAAADs6yx3OgMA05I8AAAA///s20ERAAAIw7BZxhkOhw8usdB3DXMAAAAAAAAAAAAAAL9N29UYAHgvyQEAAP//7NpBAQAwDAKx4nTWppT5WBMJx5e0NTQAAAAAAAAAAAAALJfEsfhPt+3ZHgEAWGJmHgAAAP//7N0BDQAADIMw/Ku+j6/1QXCYAwAAAAAAAAAAAAD4SSwHAGypDgAA///s3QEBADAIw7BJun8XKNp9QCKhBuowBwAAAAAAAAAAAAA4zO0zbd/1CADAMUk+AAAA///s3TEBADAMgDCk1f83R/XRJRYQgMMcAAAAAAAAAAAAAMAtrxpNAYDvVAsAAP//7NtBEQAwDMOw8Ec7BundYLQSBb9tmAMAAAAAAAAAAAAA2OPPcm2fpgDAOUkGAAD//+zbAQEAAAjDoPVPbQ8PPRDmAAAAAAAAAAAAAAB+kOUAgG3VAQAA///s2wENAAAMw6D6V30dz8AHwhwAAAAAAAAAAAAAwH+yHAAwr+oAAAD//+zbAQ0AAAzDoPp3cafXsQR8IMwBAAAAAAAAAAAAAGw7WQ4AoKoeAAD//+zRQREAIAzAsD4QirUpHTq4SyS0RwcAAAAAAAAAAAAAgG/N7l77AACq6gEAAP//7N0xDQAACMCwWcb/w4sFktbHMoc5AAAAAAAAAAAAAICfRiwHAHBUCwAA///s3UENACAQwLBJRSLWUHB8sUDSWpiAOcwBAAAAAAAAAAAAAPzlVGtmtm4AAI/qAgAA///s3TENADAMwLBAK/9vjEqgBCbZPKI4zAEAAAAAAAAAAAAA/ONVI5YDADhUCwAA///s2zENAAAIBLH37wJHSGJhxABJa+HmM8wBAAAAAAAAAAAAAPxQO8u1XgAAhyQDAAD//+zRMQEAIBDEsBsQjCQsouBw8DNDIqFdugAAAAAAAAAAAAAAfO0m2W2PTQAAgyQPAAD//+zbMQEAIAzAsErFKk5wMiTwciQWetcwBwAAAAAAAAAAAADwr12tmTkaAQA8VBcAAP//7N0xDQAgFEPBBmVYwv9QgoM/MtxJeHvTpREAAAAAAAAAAAAAwHfeq9xpu43lAACGklwAAAD//+zdMQEAAAzDoPhXPQ+7eoARDHMAAAAAAAAAAAAAAFuscgAAH9UBAAD//+zdMQEAMAzAoFis/2tO6qHXDjCCYQ4AAAAAAAAAAAAA4A+vGqscAMBRtQAAAP//7NsxAQAgEMSwk4JFnGENBYeHX1gSC51rmAMAAAAAAAAAAAAA+Osm2W1X26MFAMBQkgcAAP//7NuxDQAgEAJACvePo7oB5mewsLlLWABqlu4AAAAAAAAAAAAAAL6Yo9yetD0mAAB4lOQCAAD//+zbMQEAAAzDoPhXPRXrBT4Q5gAAAAAAAAAAAAAAtkQ5AIAP1QEAAP//7NtBAQAgDAChi75IVrKJKeYLeiDMAQAAAAAAAAAAAAD8caupjigHALCgegAAAP//7N0xEQAADAIx/Lupg0rrUgtsiYTfOQzmAAAAAAAAAAAAAAC65t/kVmcAgKIkBwAA///s3UEJADAQA8H1r+Is1VGph6OvGVgZIQZzAAAAAAAAAAAAAAD7TjUvb3IAAJ9UFwAA///s2zERADAMAzHzRxNIZeJOYdDrJEH4/Q1zAAAAAAAAAAAAAABv7CQ3bY+mAACfJbkAAAD//+zbMREAIAzAwPhXhSUc9GqBheV/iYoY5gAAAAAAAAAAAAAA3tzq7CC3NckBAHxWDQAAAP//7NshAQAACMTA75+OCjTBEACJuIswP8McAAAAAAAAAAAAAMBN7yBXO8iVbgAAjyQZAAAA///s2zENADAMA8HwR1kILQJXqrKEQYc7yQS8v2AOAAAAAAAAAAAAAGA6HcWt3ovkkmw/AQB8rKouAAAA///s2zERADAMAzHzR1Vm7mUIiF6lyQC8vmAOAAAAAAAAAAAAAPjFhnBr9kZwE8Wl7fEGAIBHJbkAAAD//+zRAQ0AAAwCIN8/tOb4BhW4tvoAAAAAAAAAAAAAAAAA+C3JAAAA///s0QEJAAAMBKFj/UMvx4NW8BQCAAAAAAAAAAAAAAAAMK96AAAA///s2wENAAAAwqD3T20ON+iBMAcAAAAAAAAAAAAAAADAv2oAAAD//+zbAQ0AAADCoPdPbQ436IEwBwAAAAAAAAAAAAAAAMC/agAAAP//7NsBDQAAAMKg909tDjfogTAHAAAAAAAAAAAAAAAAwL9qAAAA///s2wENAAAAwqD3T20ON+iBMAcAAAAAAAAAAAAAAADAv2oAAAD//+zbAQ0AAADCoPdPbQ436IEwBwAAAAAAAAAAAAAAAMC/agAAAP//7NsBDQAAAMKg909tDjfogTAHAAAAAAAAAAAAAAAAwL9qAAAA///s2wENAAAAwqD3T20ON+iBMAcAAAAAAAAAAAAAAADAv2oAAAD//+zbAQ0AAADCoPdPbQ436IEwBwAAAAAAAAAAAAAAAMC/agAAAP//7NsBDQAAAMKg909tDjfogTAHAAAAAAAAAAAAAAAAwL9qAAAA///s2wENAAAAwqD3T20ON+iBMAcAAAAAAAAAAAAAAADAv2oAAAD//+zbAQ0AAADCoPdPbQ436IEwBwAAAAAAAAAAAAAAAMC/agAAAP//7NsBDQAAAMKg909tDjfogTAHAAAAAAAAAAAAAAAAwL9qAAAA///s2wENAAAAwqD3T20ON+iBMAcAAAAAAAAAAAAAAADAv2oAAAD//+zbAQ0AAADCoPdPbQ436IEwBwAAAAAAAAAAAAAAAMC/agAAAP//7NsBDQAAAMKg909tDjfogTAHAAAAAAAAAAAAAAAAwL9qAAAA///s2wENAAAAwqD3T20ON+iBMAcAAAAAAAAAAAAAAADAv2oAAAD//+zbAQ0AAADCoPdPbQ436IEwBwAAAAAAAAAAAAAAAMC/agAAAP//7NsBDQAAAMKg909tDjfogTAHAAAAAAAAAAAAAAAAwL9qAAAA///s2wENAAAAwqD3T20ON+iBMAcAAAAAAAAAAAAAAADAv2oAAAD//+zbAQ0AAADCoPdPbQ436IEwBwAAAAAAAAAAAAAAAMC/agAAAP//7NsBDQAAAMKg909tDjfogTAHAAAAAAAAAAAAAAAAwL9qAAAA///s2wENAAAAwqD3T20ON+iBMAcAAAAAAAAAAAAAAADAv2oAAAD//+zbAQ0AAADCoPdPbQ436IEwBwAAAAAAAAAAAAAAAMC/agAAAP//7NsBDQAAAMKg909tDjfogTAHAAAAAAAAAAAAAAAAwL9qAAAA///s2wENAAAAwqD3T20ON+iBMAcAAAAAAAAAAAAAAADAv2oAAAD//+zbAQ0AAADCoPdPbQ436IEwBwAAAAAAAAAAAAAAAMC/agAAAP//7NsBDQAAAMKg909tDjfogTAHAAAAAAAAAAAAAAAAwL9qAAAA///s2wENAAAAwqD3T20ON+iBMAcAAAAAAAAAAAAAAADAv2oAAAD//+zbAQ0AAADCoPdPbQ436IEwBwAAAAAAAAAAAAAAAMC/agAAAP//7NsBDQAAAMKg909tDjfogTAHAAAAAAAAAAAAAAAAwL9qAAAA///s2wENAAAAwqD3T20ON+iBMAcAAAAAAAAAAAAAAADAv2oAAAD//+zbAQ0AAADCoPdPbQ436IEwBwAAAAAAAAAAAAAAAMC/agAAAP//7NsBDQAAAMKg909tDjfogTAHAAAAAAAAAAAAAAAAwL9qAAAA///s2wENAAAAwqD3T20ON+iBMAcAAAAAAAAAAAAAAADAv2oAAAD//+zbAQ0AAADCoPdPbQ436IEwBwAAAAAAAAAAAAAAAMC/agAAAP//7NsBDQAAAMKg909tDjfogTAHAAAAAAAAAAAAAAAAwL9qAAAA///s2wENAAAAwqD3T20ON+iBMAcAAAAAAAAAAAAAAADAv2oAAAD//+zbAQ0AAADCoPdPbQ436IEwBwAAAAAAAAAAAAAAAMC/agAAAP//7NsBDQAAAMKg909tDjfogTAHAAAAAAAAAAAAAAAAwL9qAAAA///s2wENAAAAwqD3T20ON+iBMAcAAAAAAAAAAAAAAADAv2oAAAD//+zbAQ0AAADCoPdPbQ436IEwBwAAAAAAAAAAAAAAAMC/agAAAP//7NsBDQAAAMKg909tDjfogTAHAAAAAAAAAAAAAAAAwL9qAAAA///s2wENAAAAwqD3T20ON+iBMAcAAAAAAAAAAAAAAADAv2oAAAD//+zbAQ0AAADCoPdPbQ436IEwBwAAAAAAAAAAAAAAAMC/agAAAP//7NsBDQAAAMKg909tDjfogTAHAAAAAAAAAAAAAAAAwL9qAAAA///s2wENAAAAwqD3T20ON+iBMAcAAAAAAAAAAAAAAADAv2oAAAD//+zbAQ0AAADCoPdPbQ436IEwBwAAAAAAAAAAAAAAAMC/agAAAP//7NsBDQAAAMKg909tDjfogTAHAAAAAAAAAAAAAAAAwL9qAAAA///s2wENAAAAwqD3T20ON+iBMAcAAAAAAAAAAAAAAADAv2oAAAD//+zbAQ0AAADCoPdPbQ436IEwBwAAAAAAAAAAAAAAAMC/agAAAP//7NsBDQAAAMKg909tDjfogTAHAAAAAAAAAAAAAAAAwL9qAAAA///s2wENAAAAwqD3T20ON+iBMAcAAAAAAAAAAAAAAADAv2oAAAD//+zbAQ0AAADCoPdPbQ436IEwBwAAAAAAAAAAAAAAAMC/agAAAP//7NsBDQAAAMKg909tDjfogTAHAAAAAAAAAAAAAAAAwL9qAAAA///s2wENAAAAwqD3T20ON+iBMAcAAAAAAAAAAAAAAADAv2oAAAD//+zbAQ0AAADCoPdPbQ436IEwBwAAAAAAAAAAAAAAAMC/agAAAP//7NsBDQAAAMKg909tDjfogTAHAAAAAAAAAAAAAAAAwL9qAAAA///s2wENAAAAwqD3T20ON+iBMAcAAAAAAAAAAAAAAADAv2oAAAD//+zbAQ0AAADCoPdPbQ436IEwBwAAAAAAAAAAAAAAAMC/agAAAP//7NsBDQAAAMKg909tDjfogTAHAAAAAAAAAAAAAAAAwL9qAAAA///s2wENAAAAwqD3T20ON+iBMAcAAAAAAAAAAAAAAADAv2oAAAD//+zbAQ0AAADCoPdPbQ436IEwBwAAAAAAAAAAAAAAAMC/agAAAP//7NsBDQAAAMKg909tDjfogTAHAAAAAAAAAAAAAAB+RyBzAAAgAElEQVQAwL9q7NsBDQAAAMKg909tDjfogTAHAAAAAAAAAAAAAAAAwL9qAAAA///s2wENAAAAwqD3T20ON+iBMAcAAAAAAAAAAAAAAADAv2oAAAD//+zbAQ0AAADCoPdPbQ436IEwBwAAAAAAAAAAAAAAAMC/agAAAP//7NsBDQAAAMKg909tDjfogTAHAAAAAAAAAAAAAAAAwL9qAAAA///s2wENAAAAwqD3T20ON+iBMAcAAAAAAAAAAAAAAADAv2oAAAD//+zbAQ0AAADCoPdPbQ436IEwBwAAAAAAAAAAAAAAAMC/agAAAP//7NsBDQAAAMKg909tDjfogTAHAAAAAAAAAAAAAAAAwL9qAAAA///s2wENAAAAwqD3T20ON+iBMAcAAAAAAAAAAAAAAADAv2oAAAD//+zbAQ0AAADCoPdPbQ436IEwBwAAAAAAAAAAAAAAAMC/agAAAP//7NsBDQAAAMKg909tDjfogTAHAAAAAAAAAAAAAAAAwL9qAAAA///s2wENAAAAwqD3T20ON+iBMAcAAAAAAAAAAAAAAADAv2oAAAD//+zbAQ0AAADCoPdPbQ436IEwBwAAAAAAAAAAAAAAAMC/agAAAP//7NsBDQAAAMKg909tDjfogTAHAAAAAAAAAAAAAAAAwL9qAAAA///s2wENAAAAwqD3T20ON+iBMAcAAAAAAAAAAAAAAADAv2oAAAD//+zbAQ0AAADCoPdPbQ436IEwBwAAAAAAAAAAAAAAAMC/agAAAP//7NsBDQAAAMKg909tDjfogTAHAAAAAAAAAAAAAAAAwL9qAAAA///s2wENAAAAwqD3T20ON+iBMAcAAAAAAAAAAAAAAADAv2oAAAD//+zbAQ0AAADCoPdPbQ436IEwBwAAAAAAAAAAAAAAAMC/agAAAP//7NsBDQAAAMKg909tDjfogTAHAAAAAAAAAAAAAAAAwL9qAAAA///s2wENAAAAwqD3T20ON+iBMAcAAAAAAAAAAAAAAADAv2oAAAD//+zbAQ0AAADCoPdPbQ436IEwBwAAAAAAAAAAAAAAAMC/agAAAP//7NsBDQAAAMKg909tDjfogTAHAAAAAAAAAAAAAAAAwL9qAAAA///s2wENAAAAwqD3T20ON+iBMAcAAAAAAAAAAAAAAADAv2oAAAD//+zbAQ0AAADCoPdPbQ436IEwBwAAAAAAAAAAAAAAAMC/agAAAP//7NsBDQAAAMKg909tDjfogTAHAAAAAAAAAAAAAAAAwL9qAAAA///s2wENAAAAwqD3T20ON+iBMAcAAAAAAAAAAAAAAADAv2oAAAD//+zbAQ0AAADCoPdPbQ436IEwBwAAAAAAAAAAAAAAAMC/agAAAP//7NsBDQAAAMKg909tDjfogTAHAAAAAAAAAAAAAAAAwL9qAAAA///s2wENAAAAwqD3T20ON+iBMAcAAAAAAAAAAAAAAADAv2oAAAD//+zbAQ0AAADCoPdPbQ436IEwBwAAAAAAAAAAAAAAAMC/agAAAP//7NsBDQAAAMKg909tDjfogTAHAAAAAAAAAAAAAAAAwL9qAAAA///s2wENAAAAwqD3T20ON+iBMAcAAAAAAAAAAAAAAADAv2oAAAD//+zbAQ0AAADCoPdPbQ436IEwBwAAAAAAAAAAAAAAAMC/agAAAP//7NsBDQAAAMKg909tDjfogTAHAAAAAAAAAAAAAAAAwL9qAAAA///s2wENAAAAwqD3T20ON+iBMAcAAAAAAAAAAAAAAADAv2oAAAD//+zbAQ0AAADCoPdPbQ436IEwBwAAAAAAAAAAAAAAAMC/agAAAP//7NsBDQAAAMKg909tDjfogTAHAAAAAAAAAAAAAAAAwL9qAAAA///s2wENAAAAwqD3T20ON+iBMAcAAAAAAAAAAAAAAADAv2oAAAD//+zbAQ0AAADCoPdPbQ436IEwBwAAAAAAAAAAAAAAAMC/agAAAP//7NsBDQAAAMKg909tDjfogTAHAAAAAAAAAAAAAAAAwL9qAAAA///s2wENAAAAwqD3T20ON+iBMAcAAAAAAAAAAAAAAADAv2oAAAD//+zbAQ0AAADCoPdPbQ436IEwBwAAAAAAAAAAAAAAAMC/agAAAP//7NsBDQAAAMKg909tDjfogTAHAAAAAAAAAAAAAAAAwL9qAAAA///s2wENAAAAwqD3T20ON+iBMAcAAAAAAAAAAAAAAADAv2oAAAD//+zbAQ0AAADCoPdPbQ436IEwBwAAAAAAAAAAAAAAAMC/agAAAP//7NsBDQAAAMKg909tDjfogTAHAAAAAAAAAAAAAAAAwL9qAAAA///s2wENAAAAwqD3T20ON+iBMAcAAAAAAAAAAAAAAADAv2oAAAD//+zbAQ0AAADCoPdPbQ436IEwBwAAAAAAAAAAAAAAAMC/agAAAP//7NsBDQAAAMKg909tDjfogTAHAAAAAAAAAAAAAAAAwL9qAAAA///s2wENAAAAwqD3T20ON+iBMAcAAAAAAAAAAAAAAADAv2oAAAD//+zbAQ0AAADCoPdPbQ436IEwBwAAAAAAAAAAAAAAAMC/agAAAP//7NsBDQAAAMKg909tDjfogTAHAAAAAAAAAAAAAAAAwL9qAAAA///s2wENAAAAwqD3T20ON+iBMAcAAAAAAAAAAAAAAADAv2oAAAD//+zbAQ0AAADCoPdPbQ436IEwBwAAAAAAAAAAAAAAAMC/agAAAP//7NsBDQAAAMKg909tDjfogTAHAAAAAAAAAAAAAAAAwL9qAAAA///s2wENAAAAwqD3T20ON+iBMAcAAAAAAAAAAAAAAADAv2oAAAD//+zbAQ0AAADCoPdPbQ436IEwBwAAAAAAAAAAAAAAAMC/agAAAP//7NsBDQAAAMKg909tDjfogTAHAAAAAAAAAAAAAAAAwL9qAAAA///s2wENAAAAwqD3T20ON+iBMAcAAAAAAAAAAAAAAADAv2oAAAD//+zbAQ0AAADCoPdPbQ436IEwBwAAAAAAAAAAAAAAAMC/agAAAP//7NsBDQAAAMKg909tDjfogTAHAAAAAAAAAAAAAAAAwL9qAAAA///s2wENAAAAwqD3T20ON+iBMAcAAAAAAAAAAAAAAADAv2oAAAD//+zbAQ0AAADCoPdPbQ436IEwBwAAAAAAAAAAAAAAAMC/agAAAP//7NsBDQAAAMKg909tDjfogTAHAAAAAAAAAAAAAAAAwL9qAAAA///s2wENAAAAwqD3T20ON+iBMAcAAAAAAAAAAAAAAADAv2oAAAD//+zbAQ0AAADCoPdPbQ436IEwBwAAAAAAAAAAAAAAAMC/agAAAP//7NsBDQAAAMKg909tDjfogTAHAAAAAAAAAAAAAAAAwL9qAAAA///s2wENAAAAwqD3T20ON+iBMAcAAAAAAAAAAAAAAADAv2oAAAD//+zbAQ0AAADCoPdPbQ436IEwBwAAAAAAAAAAAAAAAMC/agAAAP//7NsBDQAAAMKg909tDjfogTAHAAAAAAAAAAAAAAAAwL9qAAAA///s2wENAAAAwqD3T20ON+iBMAcAAAAAAAAAAAAAAADAv2oAAAD//+zbAQ0AAADCoPdPbQ436IEwBwAAAAAAAAAAAAAAAMC/agAAAP//7NsBDQAAAMKg909tDjfogTAHAAAAAAAAAAAAAAAAwL9qAAAA///s2wENAAAAwqD3T20ON+iBMAcAAAAAAAAAAAAAAADAv2oAAAD//+zbAQ0AAADCoPdPbQ436IEwBwAAAAAAAAAAAAAAAMC/agAAAP//7NsBDQAAAMKg909tDjfogTAHAAAAAAAAAAAAAAAAwL9qAAAA///s2wENAAAAwqD3T20ON+iBMAcAAAAAAAAAAAAAAADAv2oAAAD//+zbAQ0AAADCoPdPbQ436IEwBwAAAAAAAAAAAAAAAMC/agAAAP//7NsBDQAAAMKg909tDjfogTAHAAAAAAAAAAAAAAAAwL9qAAAA///s2wENAAAAwqD3T20ON+iBMAcAAAAAAAAAAAAAAADAv2oAAAD//+zbAQ0AAADCoPdPbQ436IEwBwAAAAAAAAAAAAAAAMC/agAAAP//7NsBDQAAAMKg909tDjfogTAHAAAAAAAAAAAAAAAAwL9qAAAA///s2wENAAAAwqD3T20ON+iBMAcAAAAAAAAAAAAAAADAv2oAAAD//+zbAQ0AAADCoPdPbQ436IEwBwAAAAAAAAAAAAAAAMC/agAAAP//7NsBDQAAAMKg909tDjfogTAHAAAAAAAAAAAAAAAAwL9qAAAA///s2wENAAAAwqD3T20ON+iBMAcAAAAAAAAAAAAAAADAv2oAAAD//+zbAQ0AAADCoPdPbQ436IEwBwAAAAAAAAAAAAAAAMC/agAAAP//7NsBDQAAAMKg909tDjfogTAHAAAAAAAAAAAAAAAAwL9qAAAA///s2wENAAAAwqD3T20ON+iBMAcAAAAAAAAAAAAAAADAv2oAAAD//+zbAQ0AAADCoPdPbQ436IEwBwAAAAAAAAAAAAAAAMC/agAAAP//7NsBDQAAAMKg909tDjfogTAHAAAAAAAAAAAAAAAAwL9qAAAA///s2wENAAAAwqD3T20ON+iBMAcAAAAAAAAAAAAAAADAv2oAAAD//+zbAQ0AAADCoPdPbQ436IEwBwAAAAAAAAAAAAAAAMC/agAAAP//7NsBDQAAAMKg909tDjfogTAHAAAAAAAAAAAAAAAAwL9qAAAA///s2wENAAAAwqD3T20ON+iBMAcAAAAAAAAAAAAAAADAv2oAAAD//+zbAQ0AAADCoPdPbQ436IEwBwAAAAAAAAAAAAAAAMC/agAAAP//7NsBDQAAAMKg909tDjfogTAHAAAAAAAAAAAAAAAAwL9qAAAA///s2wENAAAAwqD3T20ON+iBMAcAAAAAAAAAAAAAAADAv2oAAAD//+zbAQ0AAADCoPdPbQ436IEwBwAAAAAAAAAAAAAAAMC/agAAAP//7NsBDQAAAMKg909tDjfogTAHAAAAAAAAAAAAAAAAwL9qAAAA///s2wENAAAAwqD3T20ON+iBMAcAAAAAAAAAAAAAAADAv2oAAAD//+zbAQ0AAADCoPdPbQ436IEwBwAAAAAAAAAAAAAAAMC/agAAAP//7NsBDQAAAMKg909tDjfogTAHAAAAAAAAAAAAAAAAwL9qAAAA///s2wENAAAAwqD3T20ON+iBMAcAAAAAAAAAAAAAAADAv2oAAAD//+zbAQ0AAADCoPdPbQ436IEwBwAAAAAAAAAAAAAAAMC/agAAAP//7NsBDQAAAMKg909tDjfogTAHAAAAAAAAAAAAAAAAwL9qAAAA///s2wENAAAAwqD3T20ON+iBMAcAAAAAAAAAAAAAAADAv2oAAAD//+zbAQ0AAADCoPdPbQ436IEwBwAAAAAAAAAAAAAAAMC/agAAAP//7NsBDQAAAMKg909tDjfogTAHAAAAAAAAAAAAAAAAwL9qAAAA///s2wENAAAAwqD3T20ON+iBMAcAAAAAAAAAAAAAAADAv2oAAAD//+zbAQ0AAADCoPdPbQ436IEwBwAAAAAAAAAAAAAAAMC/agAAAP//7NsBDQAAAMKg909tDjfogTAHAAAAAAAAAAAAAAAAwL9qAAAA///s2wENAAAAwqD3T20ON+iBMAcAAAAAAAAAAAAAAADAv2oAAAD//+zbAQ0AAADCoPdPbQ436IEwBwAAAAAAAAAAAAAAAMC/agAAAP//7NsBDQAAAMKg909tDjfogTAHAAAAAAAAAAAAAAAAwL9qAAAA///s2wENAAAAwqD3T20ON+iBMAcAAAAAAAAAAAAAAADAv2oAAAD//+zbAQ0AAADCoPdPbQ436IEwBwAAAAAAAAAAAAAAAMC/agAAAP//7NsBDQAAAMKg909tDjfogTAHAAAAAAAAAAAAAAAAwL9qAAAA///s2wENAAAAwqD3T20ON+iBMAcAAAAAAAAAAAAAAADAv2oAAAD//+zbAQ0AAADCoPdPbQ436IEwBwAAAAAAAAAAAAAAAMC/agAAAP//7NsBDQAAAMKg909tDjfogTAHAAAAAAAAAAAAAAAAwL9qAAAA///s2wENAAAAwqD3T20ON+iBMAcAAAAAAAAAAAAAAADAv2oAAAD//+zbAQ0AAADCoPdPbQ436IEwBwAAAAAAAAAAAAAAAMC/agAAAP//7NsBDQAAAMKg909tDjfogTAHAAAAAAAAAAAAAAAAwL9qAAAA///s2wENAAAAwqD3T20ON+iBMAcAAAAAAAAAAAAAAADAv2oAAAD//+zbAQ0AAADCoPdPbQ436IEwBwAAAAAAAAAAAAAAAMC/agAAAP//7NsBDQAAAMKg909tDjfogTAHAAAAAAAAAAAAAAAAwL9qAAAA///s2wENAAAAwqD3T20ON+iBMAcAAAAAAAAAAAAAAADAv2oAAAD//+zbAQ0AAADCoPdPbQ436IEwBwAAAAAAAAAAAAAAAMC/agAAAP//7NsBDQAAAMKg909tDjfogTAHAAAAAAAAAAAAAAAAwL9qAAAA///s2wENAAAAwqD3T20ON+iBMAcAAAAAAAAAAAAAAADAv2oAAAD//+zbAQ0AAADCoPdPbQ436IEwBwAAAAAAAAAAAAAAAMC/agAAAP//7NsBDQAAAMKg909tDjfogTAHAAAAAAAAAAAAAAAAwL9qAAAA///s2wENAAAAwqD3T20ON+iBMAcAAAAAAAAAAAAAAADAv2oAAAD//+zbAQ0AAADCoPdPbQ436IEwBwAAAAAAAAAAAAAAAMC/agAAAP//7NsBDQAAAMKg909tDjfogTAHAAAAAAAAAAAAAAAAwL9qAAAA///s2wENAAAAwqD3T20ON+iBMAcAAAAAAAAAAAAAAADAv2oAAAD//+zbAQ0AAADCoPdPbQ436IEwBwAAAAAAAAAAAAAAAMC/agAAAP//7NsBDQAAAMKg909tDjfogTAHAAAAAAAAAAAAAAAAwL9qAAAA///s2wENAAAAwqD3T20ON+iBMAcAAAAAAAAAAAAAAADAv2oAAAD//+zbAQ0AAADCoPdPbQ436IEwBwAAAAAAAAAAAAAAAMC/agAAAP//7NsBDQAAAMKg909tDjfogTAHAAAAAAAAAAAAAAAAwL9qAAAA///s2wENAAAAwqD3T20ON+iBMAcAAAAAAAAAAAAAAADAv2oAAAD//+zbAQ0AAADCoPdPbQ436IEwBwAAAAAAAAAAAAAAAMC/agAAAP//7NsBDQAAAMKg909tDjfogTAHAAAAAAAAAAAAAAAAwL9qAAAA///s2wENAAAAwqD3T20ON+iBMAcAAAAAAAAAAAAAAADAv2oAAAD//+zbAQ0AAADCoPdPbQ436IEwBwAAAAAAAAAAAAAAAMC/agAAAP//7NsBDQAAAMKg909tDjfogTAHAAAAAAAAAAAAAAAAwL9qAAAA///s2wENAAAAwqD3T20ON+iBMAcAAAAAAAAAAAAAAADAv2oAAAD//+zbAQ0AAADCoPdPbQ436IEwBwAAAAAAAAAAAAAAAMC/agAAAP//7NsBDQAAAMKg909tDjfogTAHAAAAAAAAAAAAAAAAwL9qAAAA///s2wENAAAAwqD3T20ON+iBMAcAAAAAAAAAAAAAAADAv2oAAAD//+zbAQ0AAADCoPdPbQ436IEwBwAAAAAAAAAAAAAAAMC/agAAAP//7NsBDQAAAMKg909tDjfogTAHAAAAAAAAAAAAAAAAwL9qAAAA///s2wENAAAAwqD3T20ON+iBMAcAAAAAAAAAAAAAAADAv2oAAAD//+zbAQ0AAADCoPdPbQ436IEwBwAAAAAAAAAAAAAAAMC/agAAAP//7NsBDQAAAMKg909tDjfogTAHAAAAAAAAAAAAAAAAwL9qAAAA///s2wENAAAAwqD3T20ON+iBMAcAAAAAAAAAAAAAAADAv2oAAAD//+zbAQ0AAADCoPdPbQ436IEwBwAAAAAAAAAAAAAAAMC/agAAAP//7NsBDQAAAMKg909tDjfogTAHAAAAAAAAAAAAAAAAwL9qAAAA///s2wENAAAAwqD3T20ON+iBMAcAAAAAAAAAAAAAAADAv2oAAAD//+zbAQ0AAADCoPdPbQ436IEwBwAAAAAAAAAAAAAAAMC/agAAAP//7NsBDQAAAMKg909tDjfogTAHAAAAAAAAAAAAAAAAwL9qAAAA///s2wENAAAAwqD3T20ON+iBMAcAAAAAAAAAAAAAAADAv2oAAAD//+zbAQ0AAADCoPdPbQ436IEwBwAAAAAAAAAAAAAAAMC/agAAAP//7NsBDQAAAMKg909tDjfogTAHAAAAAAAAAAAAAAAAwL9qAAAA///s2wENAAAAwqD3T20ON+iBMAcAAAAAAAAAAAAAAADAv2oAAAD//+zbAQ0AAADCoPdPbQ436IEwBwAAAAAAAAAAAAAAAMC/agAAAP//7NsBDQAAAMKg909tDjfogTAHAAAAAAAAAAAAAAAAwL9qAAAA///s2wENAAAAwqD3T20ON+iBMAcAAAAAAAAAAAAAAADAv2oAAAD//+zbAQ0AAADCoPdPbQ436IEwBwAAAAAAAAAAAAAAAMC/agAAAP//7NsBDQAAAMKg909tDjfogTAHAAAAAAAAAAAAAAAAwL9qAAAA///s2wENAAAAwqD3T20ON+iBMAcAAAAAAAAAAAAAAADAv2oAAAD//+zbAQ0AAADCoPdPbQ436IEwBwAAAAAAAAAAAAAAAMC/agAAAP//7NsBDQAAAMKg909tDjfogTAHAAAAAAAAAAAAAAAAwL9qAAAA///s2wENAAAAwqD3T20ON+iBMAcAAAAAAAAAAAAAAADAv2oAAAD//+zbAQ0AAADCoPdPbQ436IEwBwAAAAAAAAAAAAAAAMC/agAAAP//7NsBDQAAAMKg909tDjfogTAHAAAAAAAAAAAAAAAAwL9qAAAA///s2wENAAAAwqD3T20ON+iBMAcAAAAAAAAAAAAAAADAv2oAAAD//+zbAQ0AAADCoPdPbQ436IEwBwAAAAAAAAAAAAAAAMC/agAAAP//7NsBDQAAAMKg909tDjfogTAHAAAAAAAAAAAAAAAAwL9qAAAA///s2wENAAAAwqD3T20ON+iBMAcAAAAAAAAAAAAAAADAv2oAAAD//+zbAQ0AAADCoPdPbQ436IEwBwAAAAAAAAAAAAAAAMC/agAAAP//7NsBDQAAAMKg909tDjfogTAHAAAAAAAAAAAAAAAAwL9qAAAA///s2wENAAAAwqD3T20ON+iBMAcAAAAAAAAAAAAAAADAv2oAAAD//+zbAQ0AAADCoPdPbQ436IEwBwAAAAAAAAAAAAAAAMC/agAAAP//7NsBDQAAAMKg909tDjfogTAHAAAAAAAAAAAAAAAAwL9qAAAA///s2wENAAAAwqD3T20ON+iBMAcAAAAAAAAAAAAAAADAv2oAAAD//+zbAQ0AAADCoPdPbQ436IEwBwAAAAAAAAAAAAAAAMC/agAAAP//7NsBDQAAAMKg909tDjfogTAHAAAAAAAAAAAAAAAAwL9qAAAA///s2wENAAAAwqD3T20ON+iBMAcAAAAAAAAAAAAAAADAv2oAAAD//+zbAQ0AAADCoPdPbQ436IEwBwAAAAAAAAAAAAAAAMC/agAAAP//7NsBDQAAAMKg909tDjfogTAHAAAAAAAAAAAAAAAAwL9qAAAA///s2wENAAAAwqD3T20ON+iBMAcAAAAAAAAAAAAAAADAv2oAAAD//+zbAQ0AAADCoPdPbQ436IEwBwAAAAAAAAAAAAAAAMC/agAAAP//7NsBDQAAAMKg909tDjfogTAHAAAAAAAAAAAAAAAAwL9qAAAA///s2wENAAAAwqD3T20ON+iBMAcAAAAAAAAAAAAAAADAv2oAAAD//+zbAQ0AAADCoPdPbQ436IEwBwAAAAAAAAAAAAAAAMC/agAAAP//7NsBDQAAAMKg909tDjfogTAHAAAAAAAAAAAAAAAAwL9qAAAA///s2wENAAAAwqD3T20ON+iBMAcAAAAAAAAAAAAAAADAv2oAAAD//+zbAQ0AAADCoPdPbQ436IEwBwAAAAAAAAAAAAAAAMC/agAAAP//7NsBDQAAAMKg909tDjfogTAHAAAAAAAAAAAAAAAAwL9qAAAA///s2wENAAAAwqD3T20ON+iBMAcAAAAAAAAAAAAAAADAv2oAAAD//+zbAQ0AAADCoPdPbQ436IEwBwAAAAAAAAAAAAAAAMC/agAAAP//7NsBDQAAAMKg909tDjfogTAHAAAAAAAAAAAAAAAAwL9qAAAA///s2wENAAAAwqD3T20ON+iBMAcAAAAAAAAAAAAAAADAv2oAAAD//+zbAQ0AAADCoPdPbQ436IEwBwAAAAAAAAAAAAAAAMC/agAAAP//7NsBDQAAAMKg909tDjfogTAHAAAAAAAAAAAAAAAAwL9qAAAA///s2wENAAAAwqD3T20ON+iBMAcAAAAAAAAAAAAAAADAv2oAAAD//+zbAQ0AAADCoPdPbQ436IEwBwAAAAAAAAAAAAAAAMC/agAAAP//7NsBDQAAAMKg909tDjfogTAHAAAAAAAAAAAAAAAAwL9qAAAA///s2wENAAAAwqD3T20ON+iBMAcAAAAAAAAAAAAAAADAv2oAAAD//+zbAQ0AAADCoPdPbQ436IEwBwAAAAAAAAAAAAAAAMC/agAAAP//7NsBDQAAAMKg909tDjfogTAHAAAAAAAAAAAAAAAAwL9qAAAA///s2wENAAAAwqD3T20ON+iBMAcAAAAAAAAAAAAAAADAv2oAAAD//+zbAQ0AAADCoPdPbQ436IEwB2tqSRkAACAASURBVAAAAAAAAAAAAAAAAMC/auzbAQ0AAADCoPdPbQ436IEwBwAAAAAAAAAAAAAAAMC/agAAAP//7NsBDQAAAMKg909tDjfogTAHAAAAAAAAAAAAAAAAwL9qAAAA///s2wENAAAAwqD3T20ON+iBMAcAAAAAAAAAAAAAAADAv2oAAAD//+zbAQ0AAADCoPdPbQ436IEwBwAAAAAAAAAAAAAAAMC/agAAAP//7NsBDQAAAMKg909tDjfogTAHAAAAAAAAAAAAAAAAwL9qAAAA///s2wENAAAAwqD3T20ON+iBMAcAAAAAAAAAAAAAAADAv2oAAAD//+zbAQ0AAADCoPdPbQ436IEwBwAAAAAAAAAAAAAAAMC/agAAAP//7NsBDQAAAMKg909tDjfogTAHAAAAAAAAAAAAAAAAwL9qAAAA///s2wENAAAAwqD3T20ON+iBMAcAAAAAAAAAAAAAAADAv2oAAAD//+zbAQ0AAADCoPdPbQ436IEwBwAAAAAAAAAAAAAAAMC/agAAAP//7NsBDQAAAMKg909tDjfogTAHAAAAAAAAAAAAAAAAwL9qAAAA///s2wENAAAAwqD3T20ON+iBMAcAAAAAAAAAAAAAAADAv2oAAAD//+zbAQ0AAADCoPdPbQ436IEwBwAAAAAAAAAAAAAAAMC/agAAAP//7NsBDQAAAMKg909tDjfogTAHAAAAAAAAAAAAAAAAwL9qAAAA///s2wENAAAAwqD3T20ON+iBMAcAAAAAAAAAAAAAAADAv2oAAAD//+zbAQ0AAADCoPdPbQ436IEwBwAAAAAAAAAAAAAAAMC/agAAAP//7NsBDQAAAMKg909tDjfogTAHAAAAAAAAAAAAAAAAwL9qAAAA///s2wENAAAAwqD3T20ON+iBMAcAAAAAAAAAAAAAAADAv2oAAAD//+zbAQ0AAADCoPdPbQ436IEwBwAAAAAAAAAAAAAAAMC/agAAAP//7NsBDQAAAMKg909tDjfogTAHAAAAAAAAAAAAAAAAwL9qAAAA///s2wENAAAAwqD3T20ON+iBMAcAAAAAAAAAAAAAAADAv2oAAAD//+zbAQ0AAADCoPdPbQ436IEwBwAAAAAAAAAAAAAAAMC/agAAAP//7NsBDQAAAMKg909tDjfogTAHAAAAAAAAAAAAAAAAwL9qAAAA///s2wENAAAAwqD3T20ON+iBMAcAAAAAAAAAAAAAAADAv2oAAAD//+zbAQ0AAADCoPdPbQ436IEwBwAAAAAAAAAAAAAAAMC/agAAAP//7NsBDQAAAMKg909tDjfogTAHAAAAAAAAAAAAAAAAwL9qAAAA///s2wENAAAAwqD3T20ON+iBMAcAAAAAAAAAAAAAAADAv2oAAAD//+zbAQ0AAADCoPdPbQ436IEwBwAAAAAAAAAAAAAAAMC/agAAAP//7NsBDQAAAMKg909tDjfogTAHAAAAAAAAAAAAAAAAwL9qAAAA///s2wENAAAAwqD3T20ON+iBMAcAAAAAAAAAAAAAAADAv2oAAAD//+zbAQ0AAADCoPdPbQ436IEwBwAAAAAAAAAAAAAAAMC/agAAAP//7NsBDQAAAMKg909tDjfogTAHAAAAAAAAAAAAAAAAwL9qAAAA///s2wENAAAAwqD3T20ON+iBMAcAAAAAAAAAAAAAAADAv2oAAAD//+zbAQ0AAADCoPdPbQ436IEwBwAAAAAAAAAAAAAAAMC/agAAAP//7NsBDQAAAMKg909tDjfogTAHAAAAAAAAAAAAAAAAwL9qAAAA///s2wENAAAAwqD3T20ON+iBMAcAAAAAAAAAAAAAAADAv2oAAAD//+zbAQ0AAADCoPdPbQ436IEwBwAAAAAAAAAAAAAAAMC/agAAAP//7NsBDQAAAMKg909tDjfogTAHAAAAAAAAAAAAAAAAwL9qAAAA///s2wENAAAAwqD3T20ON+iBMAcAAAAAAAAAAAAAAADAv2oAAAD//+zbAQ0AAADCoPdPbQ436IEwBwAAAAAAAAAAAAAAAMC/agAAAP//7NsBDQAAAMKg909tDjfogTAHAAAAAAAAAAAAAAAAwL9qAAAA///s2wENAAAAwqD3T20ON+iBMAcAAAAAAAAAAAAAAADAv2oAAAD//+zbAQ0AAADCoPdPbQ436IEwBwAAAAAAAAAAAAAAAMC/agAAAP//7NsBDQAAAMKg909tDjfogTAHAAAAAAAAAAAAAAAAwL9qAAAA///s2wENAAAAwqD3T20ON+iBMAcAAAAAAAAAAAAAAADAv2oAAAD//+zbAQ0AAADCoPdPbQ436IEwBwAAAAAAAAAAAAAAAMC/agAAAP//7NsBDQAAAMKg909tDjfogTAHAAAAAAAAAAAAAAAAwL9qAAAA///s2wENAAAAwqD3T20ON+iBMAcAAAAAAAAAAAAAAADAv2oAAAD//+zbAQ0AAADCoPdPbQ436IEwBwAAAAAAAAAAAAAAAMC/agAAAP//7NsBDQAAAMKg909tDjfogTAHAAAAAAAAAAAAAAAAwL9qAAAA///s2wENAAAAwqD3T20ON+iBMAcAAAAAAAAAAAAAAADAv2oAAAD//+zbAQ0AAADCoPdPbQ436IEwBwAAAAAAAAAAAAAAAMC/agAAAP//7NsBDQAAAMKg909tDjfogTAHAAAAAAAAAAAAAAAAwL9qAAAA///s2wENAAAAwqD3T20ON+iBMAcAAAAAAAAAAAAAAADAv2oAAAD//+zbAQ0AAADCoPdPbQ436IEwBwAAAAAAAAAAAAAAAMC/agAAAP//7NsBDQAAAMKg909tDjfogTAHAAAAAAAAAAAAAAAAwL9qAAAA///s2wENAAAAwqD3T20ON+iBMAcAAAAAAAAAAAAAAADAv2oAAAD//+zbAQ0AAADCoPdPbQ436IEwBwAAAAAAAAAAAAAAAMC/agAAAP//7NsBDQAAAMKg909tDjfogTAHAAAAAAAAAAAAAAAAwL9qAAAA///s2wENAAAAwqD3T20ON+iBMAcAAAAAAAAAAAAAAADAv2oAAAD//+zbAQ0AAADCoPdPbQ436IEwBwAAAAAAAAAAAAAAAMC/agAAAP//7NsBDQAAAMKg909tDjfogTAHAAAAAAAAAAAAAAAAwL9qAAAA///s2wENAAAAwqD3T20ON+iBMAcAAAAAAAAAAAAAAADAv2oAAAD//+zbAQ0AAADCoPdPbQ436IEwBwAAAAAAAAAAAAAAAMC/agAAAP//7NsBDQAAAMKg909tDjfogTAHAAAAAAAAAAAAAAAAwL9qAAAA///s2wENAAAAwqD3T20ON+iBMAcAAAAAAAAAAAAAAADAv2oAAAD//+zbAQ0AAADCoPdPbQ436IEwBwAAAAAAAAAAAAAAAMC/agAAAP//7NsBDQAAAMKg909tDjfogTAHAAAAAAAAAAAAAAAAwL9qAAAA///s2wENAAAAwqD3T20ON+iBMAcAAAAAAAAAAAAAAADAv2oAAAD//+zbAQ0AAADCoPdPbQ436IEwBwAAAAAAAAAAAAAAAMC/agAAAP//7NsBDQAAAMKg909tDjfogTAHAAAAAAAAAAAAAAAAwL9qAAAA///s2wENAAAAwqD3T20ON+iBMAcAAAAAAAAAAAAAAADAv2oAAAD//+zbAQ0AAADCoPdPbQ436IEwBwAAAAAAAAAAAAAAAMC/agAAAP//7NsBDQAAAMKg909tDjfogTAHAAAAAAAAAAAAAAAAwL9qAAAA///s2wENAAAAwqD3T20ON+iBMAcAAAAAAAAAAAAAAADAv2oAAAD//+zbAQ0AAADCoPdPbQ436IEwBwAAAAAAAAAAAAAAAMC/agAAAP//7NsBDQAAAMKg909tDjfogTAHAAAAAAAAAAAAAAAAwL9qAAAA///s2wENAAAAwqD3T20ON+iBMAcAAAAAAAAAAAAAAADAv2oAAAD//+zbAQ0AAADCoPdPbQ436IEwBwAAAAAAAAAAAAAAAMC/agAAAP//7NsBDQAAAMKg909tDjfogTAHAAAAAAAAAAAAAAAAwL9qAAAA///s2wENAAAAwqD3T20ON+iBMAcAAAAAAAAAAAAAAADAv2oAAAD//+zbAQ0AAADCoPdPbQ436IEwBwAAAAAAAAAAAAAAAMC/agAAAP//7NsBDQAAAMKg909tDjfogTAHAAAAAAAAAAAAAAAAwL9qAAAA///s2wENAAAAwqD3T20ON+iBMAcAAAAAAAAAAAAAAADAv2oAAAD//+zbAQ0AAADCoPdPbQ436IEwBwAAAAAAAAAAAAAAAMC/agAAAP//7NsBDQAAAMKg909tDjfogTAHAAAAAAAAAAAAAAAAwL9qAAAA///s2wENAAAAwqD3T20ON+iBMAcAAAAAAAAAAAAAAADAv2oAAAD//+zbAQ0AAADCoPdPbQ436IEwBwAAAAAAAAAAAAAAAMC/agAAAP//7NsBDQAAAMKg909tDjfogTAHAAAAAAAAAAAAAAAAwL9qAAAA///s2wENAAAAwqD3T20ON+iBMAcAAAAAAAAAAAAAAADAv2oAAAD//+zbAQ0AAADCoPdPbQ436IEwBwAAAAAAAAAAAAAAAMC/agAAAP//7NsBDQAAAMKg909tDjfogTAHAAAAAAAAAAAAAAAAwL9qAAAA///s2wENAAAAwqD3T20ON+iBMAcAAAAAAAAAAAAAAADAv2oAAAD//+zbAQ0AAADCoPdPbQ436IEwBwAAAAAAAAAAAAAAAMC/agAAAP//7NsBDQAAAMKg909tDjfogTAHAAAAAAAAAAAAAAAAwL9qAAAA///s2wENAAAAwqD3T20ON+iBMAcAAAAAAAAAAAAAAADAv2oAAAD//+zbAQ0AAADCoPdPbQ436IEwBwAAAAAAAAAAAAAAAMC/agAAAP//7NsBDQAAAMKg909tDjfogTAHAAAAAAAAAAAAAAAAwL9qAAAA///s2wENAAAAwqD3T20ON+iBMAcAAAAAAAAAAAAAAADAv2oAAAD//+zbAQ0AAADCoPdPbQ436IEwBwAAAAAAAAAAAAAAAMC/agAAAP//7NsBDQAAAMKg909tDjfogTAHAAAAAAAAAAAAAAAAwL9qAAAA///s2wENAAAAwqD3T20ON+iBMAcAAAAAAAAAAAAAAADAv2oAAAD//+zbAQ0AAADCoPdPbQ436IEwBwAAAAAAAAAAAAAAAMC/agAAAP//7NsBDQAAAMKg909tDjfogTAHAAAAAAAAAAAAAAAAwL9qAAAA///s2wENAAAAwqD3T20ON+iBMAcAAAAAAAAAAAAAAADAv2oAAAD//+zbAQ0AAADCoPdPbQ436IEwBwAAAAAAAAAAAAAAAMC/agAAAP//7NsBDQAAAMKg909tDjfogTAHAAAAAAAAAAAAAAAAwL9qAAAA///s2wENAAAAwqD3T20ON+iBMAcAAAAAAAAAAAAAAADAv2oAAAD//+zbAQ0AAADCoPdPbQ436IEwBwAAAAAAAAAAAAAAAMC/agAAAP//7NsBDQAAAMKg909tDjfogTAHAAAAAAAAAAAAAAAAwL9qAAAA///s2wENAAAAwqD3T20ON+iBMAcAAAAAAAAAAAAAAADAv2oAAAD//+zbAQ0AAADCoPdPbQ436IEwBwAAAAAAAAAAAAAAAMC/agAAAP//7NsBDQAAAMKg909tDjfogTAHAAAAAAAAAAAAAAAAwL9qAAAA///s2wENAAAAwqD3T20ON+iBMAcAAAAAAAAAAAAAAADAv2oAAAD//+zbAQ0AAADCoPdPbQ436IEwBwAAAAAAAAAAAAAAAMC/agAAAP//7NsBDQAAAMKg909tDjfogTAHAAAAAAAAAAAAAAAAwL9qAAAA///s2wENAAAAwqD3T20ON+iBMAcAAAAAAAAAAAAAAADAv2oAAAD//+zbAQ0AAADCoPdPbQ436IEwBwAAAAAAAAAAAAAAAMC/agAAAP//7NsBDQAAAMKg909tDjfogTAHAAAAAAAAAAAAAAAAwL9qAAAA///s2wENAAAAwqD3T20ON+iBMAcAAAAAAAAAAAAAAADAv2oAAAD//+zbAQ0AAADCoPdPbQ436IEwBwAAAAAAAAAAAAAAAMC/agAAAP//7NsBDQAAAMKg909tDjfogTAHAAAAAAAAAAAAAAAAwL9qAAAA///s2wENAAAAwqD3T20ON+iBMAcAAAAAAAAAAAAAAADAv2oAAAD//+zbAQ0AAADCoPdPbQ436IEwBwAAAAAAAAAAAAAAAMC/agAAAP//7NsBDQAAAMKg909tDjfogTAHAAAAAAAAAAAAAAAAwL9qAAAA///s2wENAAAAwqD3T20ON+iBMAcAAAAAAAAAAAAAAADAv2oAAAD//+zbAQ0AAADCoPdPbQ436IEwBwAAAAAAAAAAAAAAAMC/agAAAP//7NsBDQAAAMKg909tDjfogTAHAAAAAAAAAAAAAAAAwL9qAAAA///s2wENAAAAwqD3T20ON+iBMAcAAAAAAAAAAAAAAADAv2oAAAD//+zbAQ0AAADCoPdPbQ436IEwBwAAAAAAAAAAAAAAAMC/agAAAP//7NsBDQAAAMKg909tDjfogTAHAAAAAAAAAAAAAAAAwL9qAAAA///s2wENAAAAwqD3T20ON+iBMAcAAAAAAAAAAAAAAADAv2oAAAD//+zbAQ0AAADCoPdPbQ436IEwBwAAAAAAAAAAAAAAAMC/agAAAP//7NsBDQAAAMKg909tDjfogTAHAAAAAAAAAAAAAAAAwL9qAAAA///s2wENAAAAwqD3T20ON+iBMAcAAAAAAAAAAAAAAADAv2oAAAD//+zbAQ0AAADCoPdPbQ436IEwBwAAAAAAAAAAAAAAAMC/agAAAP//7NsBDQAAAMKg909tDjfogTAHAAAAAAAAAAAAAAAAwL9qAAAA///s2wENAAAAwqD3T20ON+iBMAcAAAAAAAAAAAAAAADAv2oAAAD//+zbAQ0AAADCoPdPbQ436IEwBwAAAAAAAAAAAAAAAMC/agAAAP//7NsBDQAAAMKg909tDjfogTAHAAAAAAAAAAAAAAAAwL9qAAAA///s2wENAAAAwqD3T20ON+iBMAcAAAAAAAAAAAAAAADAv2oAAAD//+zbAQ0AAADCoPdPbQ436IEwBwAAAAAAAAAAAAAAAMC/agAAAP//7NsBDQAAAMKg909tDjfogTAHAAAAAAAAAAAAAAAAwL9qAAAA///s2wENAAAAwqD3T20ON+iBMAcAAAAAAAAAAAAAAADAv2oAAAD//+zbAQ0AAADCoPdPbQ436IEwBwAAAAAAAAAAAAAAAMC/agAAAP//7NsBDQAAAMKg909tDjfogTAHAAAAAAAAAAAAAAAAwL9qAAAA///s2wENAAAAwqD3T20ON+iBMAcAAAAAAAAAAAAAAADAv2oAAAD//+zbAQ0AAADCoPdPbQ436IEwBwAAAAAAAAAAAAAAAMC/agAAAP//7NsBDQAAAMKg909tDjfogTAHAAAAAAAAAAAAAAAAwL9qAAAA///s2wENAAAAwqD3T20ON+iBMAcAAAAAAAAAAAAAAADAv2oAAAD//+zbAQ0AAADCoPdPbQ436IEwBwAAAAAAAAAAAAAAAMC/agAAAP//7NsBDQAAAMKg909tDjfogTAHAAAAAAAAAAAAAAAAwL9qAAAA///s2wENAAAAwqD3T20ON+iBMAcAAAAAAAAAAAAAAADAv2oAAAD//+zbAQ0AAADCoPdPbQ436IEwBwAAAAAAAAAAAAAAAMC/agAAAP//7NsBDQAAAMKg909tDjfogTAHAAAAAAAAAAAAAAAAwL9qAAAA///s2wENAAAAwqD3T20ON+iBMAcAAAAAAAAAAAAAAADAv2oAAAD//+zbAQ0AAADCoPdPbQ436IEwBwAAAAAAAAAAAAAAAMC/agAAAP//7NsBDQAAAMKg909tDjfogTAHAAAAAAAAAAAAAAAAwL9qAAAA///s2wENAAAAwqD3T20ON+iBMAcAAAAAAAAAAAAAAADAv2oAAAD//+zbAQ0AAADCoPdPbQ436IEwBwAAAAAAAAAAAAAAAMC/agAAAP//7NsBDQAAAMKg909tDjfogTAHAAAAAAAAAAAAAAAAwL9qAAAA///s2wENAAAAwqD3T20ON+iBMAcAAAAAAAAAAAAAAADAv2oAAAD//+zbAQ0AAADCoPdPbQ436IEwBwAAAAAAAAAAAAAAAMC/agAAAP//7NsBDQAAAMKg909tDjfogTAHAAAAAAAAAAAAAAAAwL9qAAAA///s2wENAAAAwqD3T20ON+iBMAcAAAAAAAAAAAAAAADAv2oAAAD//+zbAQ0AAADCoPdPbQ436IEwBwAAAAAAAAAAAAAAAMC/agAAAP//7NsBDQAAAMKg909tDjfogTAHAAAAAAAAAAAAAAAAwL9qAAAA///s2wENAAAAwqD3T20ON+iBMAcAAAAAAAAAAAAAAADAv2oAAAD//+zbAQ0AAADCoPdPbQ436IEwBwAAAAAAAAAAAAAAAMC/agAAAP//7NsBDQAAAMKg909tDjfogTAHAAAAAAAAAAAAAAAAwL9qAAAA///s2wENAAAAwqD3T20ON+iBMAcAAAAAAAAAAAAAAADAv2oAAAD//+zbAQ0AAADCoPdPbQ436IEwBwAAAAAAAAAAAAAAAMC/agAAAP//7NsBDQAAAMKg909tDjfogTAHAAAAAAAAAAAAAAAAwL9qAAAA///s2wENAAAAwqD3T20ON+iBMAcAAAAAAAAAAAAAAADAv2oAAAD//+zbAQ0AAADCoPdPbQ436IEwBwAAAAAAAAAAAAAAAMC/agAAAP//7NsBDQAAAMKg909tDjfogTAHAAAAAAAAAAAAAAAAwL9qAAAA///s2wENAAAAwqD3T20ON+iBMAcAAAAAAAAAAAAAAADAv2oAAAD//+zbAQ0AAADCoPdPbQ436IEwBwAAAAAAAAAAAAAAAMC/agAAAP//7NsBDQAAAMKg909tDjfogTAHAAAAAAAAAAAAAAAAwL9qAAAA///s2wENAAAAwqD3T20ON+iBMAcAAAAAAAAAAAAAAADAv2oAAAD//+zbAQ0AAADCoPdPbQ436IEwBwAAAAAAAAAAAAAAAMC/agAAAP//7NsBDQAAAMKg909tDjfogTAHAAAAAAAAAAAAAAAAwL9qAAAA///s2wENAAAAwqD3T20ON+iBMAcAAAAAAAAAAAAAAADAv2oAAAD//+zbAQ0AAADCoPdPbQ436IEwBwAAAAAAAAAAAAAAAMC/agAAAP//7NsBDQAAAMKg909tDjfogTAHAAAAAAAAAAAAAAAAwL9qAAAA///s2wENAAAAwqD3T20ON+iBMAcAAAAAAAAAAAAAAADAv2oAAAD//+zbAQ0AAADCoPdPbQ436IEwBwAAAAAAAAAAAAAAAMC/agAAAP//7NsBDQAAAMKg909tDjfogTAHAAAAAAAAAAAAAAAAwL9qAAAA///s2wENAAAAwqD3T20ON+iBMAcAAAAAAAAAAAAAAADAv2oAAAD//+zbAQ0AAADCoPdPbQ436IEwBwAAAAAAAAAAAAAAAMC/agAAAP//7NsBDQAAAMKg909tDjfogTAHAAAAAAAAAAAAAAAAwL9qAAAA///s2wENAAAAwqD3T20ON+iBMAcAAAAAAAAAAAAAAADAv2oAAAD//+zbAQ0AAADCoPdPbQ436IEwBwAAAAAAAAAAAAAAAMC/agAAAP//7NsBDQAAAMKg909tDjfogTAHAAAAAAAAAAAAAAAAwL9qAAAA///s2wENAAAAwqD3T20ON+iBMAcAAAAAAAAAAAAAAADAv2oAAAD//+zbAQ0AAADCoPdPbQ436IEwBwAAAAAAAAAAAAAAAMC/agAAAP//7NsBDQAAAMKg909tDjfogTAHAAAAAAAAAAAAAAAAwL9qAAAA///s2wENAAAAwqD3T20ON+iBMAcAAAAAAAAAAAAAAADAv2oAAAD//+zbAQ0AAADCoPdPbQ436IEwBwAAAAAAAAAAAAAAAMC/agAAAP//7NsBDQAAAMKg909tDjfogTAHAAAAAAAAAAAAAAAAwL9qAAAA///s2wENAAAAwqD3T20ON+iBMAcAAAAAAAAAAAAAAADAv2oAAAD//+zbAQ0AAADCoPdPbQ436IEwBwAAAAAAAAAAAAAAAMC/agAAAP//7NsBDQAAAMKg909tDjfogTAHAAAAAAAAAAAAAAAAwL9qAAAA///s2wENAAAAwqD3T20ON+iBMAcAAAAAAAAAAAAAAADAv2oAAAD//+zbAQ0AAADCoPdPbQ436IEwBwAAAAAAAAAAAAAAAMC/agAAAP//7NsBDQAAAMKg909tDjfogTAHAAAAAAAAAAAAAAAAwL9qAAAA///s2wENAAAAwqD3T20ON+iBMAcAAAAAAAAAAAAAAADAv2oAAAD//+zbAQ0AAADCoPdPbQ436IEwBwAAAAAAAAAAAAAAAMC/agAAAP//7NsBDQAAAMKg909tDjfogTAHAAAAAAAAAAAAAAAAwL9qAAAA///s2wENAAAAwqD3T20ON+iBMAcAAAAAAAAAAAAAAADAv2oAAAD//+zbAQ0AAADCoPdPbQ436IEwBwAAAAAAAAAAAAAAAMC/agAAAP//7NsBDQAAAMKg909tDjfogTAHAAAAAAAAAAAAAAAAwL9qAAAA///s2wENAAAAwqD3T20ON+iBMAcAAAAAAAAAAAAAAADAv2oAAAD//+zbAQ0AAADCoPdPbQ436IEwBwAAAAAAAAAAAAAAAMC/agAAAP//7NsBDQAAAMKg909tDjfogTAHAAAAAAAAAAAAAAAAwL9qAAAA///s2wENAAAAl60OXQAAIABJREFUwqD3T20ON+iBMAcAAAAAAAAAAAAAAADAv2rs2wENAAAAwqD3T20ON+iBMAcAAAAAAAAAAAAAAADAv2oAAAD//+zbAQ0AAADCoPdPbQ436IEwBwAAAAAAAAAAAAAAAMC/agAAAP//7NsBDQAAAMKg909tDjfogTAHAAAAAAAAAAAAAAAAwL9qAAAA///s2wENAAAAwqD3T20ON+iBMAcAAAAAAAAAAAAAAADAv2oAAAD//+zbAQ0AAADCoPdPbQ436IEwBwAAAAAAAAAAAAAAAMC/agAAAP//7NsBDQAAAMKg909tDjfogTAHAAAAAAAAAAAAAAAAwL9qAAAA///s2wENAAAAwqD3T20ON+iBMAcAAAAAAAAAAAAAAADAv2oAAAD//+zbAQ0AAADCoPdPbQ436IEwBwAAAAAAAAAAAAAAAMC/agAAAP//7NsBDQAAAMKg909tDjfogTAHAAAAAAAAAAAAAAAAwL9qAAAA///s2wENAAAAwqD3T20ON+iBMAcAAAAAAAAAAAAAAADAv2oAAAD//+zbAQ0AAADCoPdPbQ436IEwBwAAAAAAAAAAAAAAAMC/agAAAP//7NsBDQAAAMKg909tDjfogTAHAAAAAAAAAAAAAAAAwL9qAAAA///s2wENAAAAwqD3T20ON+iBMAcAAAAAAAAAAAAAAADAv2oAAAD//+zbAQ0AAADCoPdPbQ436IEwBwAAAAAAAAAAAAAAAMC/agAAAP//7NsBDQAAAMKg909tDjfogTAHAAAAAAAAAAAAAAAAwL9qAAAA///s2wENAAAAwqD3T20ON+iBMAcAAAAAAAAAAAAAAADAv2oAAAD//+zbAQ0AAADCoPdPbQ436IEwBwAAAAAAAAAAAAAAAMC/agAAAP//7NsBDQAAAMKg909tDjfogTAHAAAAAAAAAAAAAAAAwL9qAAAA///s2wENAAAAwqD3T20ON+iBMAcAAAAAAAAAAAAAAADAv2oAAAD//+zbAQ0AAADCoPdPbQ436IEwBwAAAAAAAAAAAAAAAMC/agAAAP//7NsBDQAAAMKg909tDjfogTAHAAAAAAAAAAAAAAAAwL9qAAAA///s2wENAAAAwqD3T20ON+iBMAcAAAAAAAAAAAAAAADAv2oAAAD//+zbAQ0AAADCoPdPbQ436IEwBwAAAAAAAAAAAAAAAMC/agAAAP//7NsBDQAAAMKg909tDjfogTAHAAAAAAAAAAAAAAAAwL9qAAAA///s2wENAAAAwqD3T20ON+iBMAcAAAAAAAAAAAAAAADAv2oAAAD//+zbAQ0AAADCoPdPbQ436IEwBwAAAAAAAAAAAAAAAMC/agAAAP//7NsBDQAAAMKg909tDjfogTAHAAAAAAAAAAAAAAAAwL9qAAAA///s2wENAAAAwqD3T20ON+iBMAcAAAAAAAAAAAAAAADAv2oAAAD//+zbAQ0AAADCoPdPbQ436IEwBwAAAAAAAAAAAAAAAMC/agAAAP//7NsBDQAAAMKg909tDjfogTAHAAAAAAAAAAAAAAAAwL9qAAAA///s2wENAAAAwqD3T20ON+iBMAcAAAAAAAAAAAAAAADAv2oAAAD//+zbAQ0AAADCoPdPbQ436IEwBwAAAAAAAAAAAAAAAMC/agAAAP//7NsBDQAAAMKg909tDjfogTAHAAAAAAAAAAAAAAAAwL9qAAAA///s2wENAAAAwqD3T20ON+iBMAcAAAAAAAAAAAAAAADAv2oAAAD//+zbAQ0AAADCoPdPbQ436IEwBwAAAAAAAAAAAAAAAMC/agAAAP//7NsBDQAAAMKg909tDjfogTAHAAAAAAAAAAAAAAAAwL9qAAAA///s2wENAAAAwqD3T20ON+iBMAcAAAAAAAAAAAAAAADAv2oAAAD//+zbAQ0AAADCoPdPbQ436IEwBwAAAAAAAAAAAAAAAMC/agAAAP//7NsBDQAAAMKg909tDjfogTAHAAAAAAAAAAAAAAAAwL9qAAAA///s2wENAAAAwqD3T20ON+iBMAcAAAAAAAAAAAAAAADAv2oAAAD//+zbAQ0AAADCoPdPbQ436IEwBwAAAAAAAAAAAAAAAMC/agAAAP//7NsBDQAAAMKg909tDjfogTAHAAAAAAAAAAAAAAAAwL9qAAAA///s2wENAAAAwqD3T20ON+iBMAcAAAAAAAAAAAAAAADAv2oAAAD//+zbAQ0AAADCoPdPbQ436IEwBwAAAAAAAAAAAAAAAMC/agAAAP//7NsBDQAAAMKg909tDjfogTAHAAAAAAAAAAAAAAAAwL9qAAAA///s2wENAAAAwqD3T20ON+iBMAcAAAAAAAAAAAAAAADAv2oAAAD//+zbAQ0AAADCoPdPbQ436IEwBwAAAAAAAAAAAAAAAMC/agAAAP//7NsBDQAAAMKg909tDjfogTAHAAAAAAAAAAAAAAAAwL9qAAAA///s2wENAAAAwqD3T20ON+iBMAcAAAAAAAAAAAAAAADAv2oAAAD//+zbAQ0AAADCoPdPbQ436IEwBwAAAAAAAAAAAAAAAMC/agAAAP//7NsBDQAAAMKg909tDjfogTAHAAAAAAAAAAAAAAAAwL9qAAAA///s2wENAAAAwqD3T20ON+iBMAcAAAAAAAAAAAAAAADAv2oAAAD//+zbAQ0AAADCoPdPbQ436IEwBwAAAAAAAAAAAAAAAMC/agAAAP//7NsBDQAAAMKg909tDjfogTAHAAAAAAAAAAAAAAAAwL9qAAAA///s2wENAAAAwqD3T20ON+iBMAcAAAAAAAAAAAAAAADAv2oAAAD//+zbAQ0AAADCoPdPbQ436IEwBwAAAAAAAAAAAAAAAMC/agAAAP//7NsBDQAAAMKg909tDjfogTAHAAAAAAAAAAAAAAAAwL9qAAAA///s2wENAAAAwqD3T20ON+iBMAcAAAAAAAAAAAAAAADAv2oAAAD//+zbAQ0AAADCoPdPbQ436IEwBwAAAAAAAAAAAAAAAMC/agAAAP//7NsBDQAAAMKg909tDjfogTAHAAAAAAAAAAAAAAAAwL9qAAAA///s2wENAAAAwqD3T20ON+iBMAcAAAAAAAAAAAAAAADAv2oAAAD//+zbAQ0AAADCoPdPbQ436IEwBwAAAAAAAAAAAAAAAMC/agAAAP//7NsBDQAAAMKg909tDjfogTAHAAAAAAAAAAAAAAAAwL9qAAAA///s2wENAAAAwqD3T20ON+iBMAcAAAAAAAAAAAAAAADAv2oAAAD//+zbAQ0AAADCoPdPbQ436IEwBwAAAAAAAAAAAAAAAMC/agAAAP//7NsBDQAAAMKg909tDjfogTAHAAAAAAAAAAAAAAAAwL9qAAAA///s2wENAAAAwqD3T20ON+iBMAcAAAAAAAAAAAAAAADAv2oAAAD//+zbAQ0AAADCoPdPbQ436IEwBwAAAAAAAAAAAAAAAMC/agAAAP//7NsBDQAAAMKg909tDjfogTAHAAAAAAAAAAAAAAAAwL9qAAAA///s2wENAAAAwqD3T20ON+iBMAcAAAAAAAAAAAAAAADAv2oAAAD//+zbAQ0AAADCoPdPbQ436IEwBwAAAAAAAAAAAAAAAMC/agAAAP//7NsBDQAAAMKg909tDjfogTAHAAAAAAAAAAAAAAAAwL9qAAAA///s2wENAAAAwqD3T20ON+iBMAcAAAAAAAAAAAAAAADAv2oAAAD//+zbAQ0AAADCoPdPbQ436IEwBwAAAAAAAAAAAAAAAMC/agAAAP//7NsBDQAAAMKg909tDjfogTAHAAAAAAAAAAAAAAAAwL9qAAAA///s2wENAAAAwqD3T20ON+iBMAcAAAAAAAAAAAAAAADAv2oAAAD//+zbAQ0AAADCoPdPbQ436IEwBwAAAAAAAAAAAAAAAMC/agAAAP//7NsBDQAAAMKg909tDjfogTAHAAAAAAAAAAAAAAAAwL9qAAAA///s2wENAAAAwqD3T20ON+iBMAcAAAAAAAAAAAAAAADAv2oAAAD//+zbAQ0AAADCoPdPbQ436IEwBwAAAAAAAAAAAAAAAMC/agAAAP//7NsBDQAAAMKg909tDjfogTAHAAAAAAAAAAAAAAAAwL9qAAAA///s2wENAAAAwqD3T20ON+iBMAcAAAAAAAAAAAAAAADAv2oAAAD//+zbAQ0AAADCoPdPbQ436IEwBwAAAAAAAAAAAAAAAMC/agAAAP//7NsBDQAAAMKg909tDjfogTAHAAAAAAAAAAAAAAAAwL9qAAAA///s2wENAAAAwqD3T20ON+iBMAcAAAAAAAAAAAAAAADAv2oAAAD//+zbAQ0AAADCoPdPbQ436IEwBwAAAAAAAAAAAAAAAMC/agAAAP//7NsBDQAAAMKg909tDjfogTAHAAAAAAAAAAAAAAAAwL9qAAAA///s2wENAAAAwqD3T20ON+iBMAcAAAAAAAAAAAAAAADAv2oAAAD//+zbAQ0AAADCoPdPbQ436IEwBwAAAAAAAAAAAAAAAMC/agAAAP//7NsBDQAAAMKg909tDjfogTAHAAAAAAAAAAAAAAAAwL9qAAAA///s2wENAAAAwqD3T20ON+iBMAcAAAAAAAAAAAAAAADAv2oAAAD//+zbAQ0AAADCoPdPbQ436IEwBwAAAAAAAAAAAAAAAMC/agAAAP//7NsBDQAAAMKg909tDjfogTAHAAAAAAAAAAAAAAAAwL9qAAAA///s2wENAAAAwqD3T20ON+iBMAcAAAAAAAAAAAAAAADAv2oAAAD//+zbAQ0AAADCoPdPbQ436IEwBwAAAAAAAAAAAAAAAMC/agAAAP//7NsBDQAAAMKg909tDjfogTAHAAAAAAAAAAAAAAAAwL9qAAAA///s2wENAAAAwqD3T20ON+iBMAcAAAAAAAAAAAAAAADAv2oAAAD//+zbAQ0AAADCoPdPbQ436IEwBwAAAAAAAAAAAAAAAMC/agAAAP//7NsBDQAAAMKg909tDjfogTAHAAAAAAAAAAAAAAAAwL9qAAAA///s2wENAAAAwqD3T20ON+iBMAcAAAAAAAAAAAAAAADAv2oAAAD//+zbAQ0AAADCoPdPbQ436IEwBwAAAAAAAAAAAAAAAMC/agAAAP//7NsBDQAAAMKg909tDjfogTAHAAAAAAAAAAAAAAAAwL9qAAAA///s2wENAAAAwqD3T20ON+iBMAcAAAAAAAAAAAAAAADAv2oAAAD//+zbAQ0AAADCoPdPbQ436IEwBwAAAAAAAAAAAAAAAMC/agAAAP//7NsBDQAAAMKg909tDjfogTAHAAAAAAAAAAAAAAAAwL9qAAAA///s2wENAAAAwqD3T20ON+iBMAcAAAAAAAAAAAAAAADAv2oAAAD//+zbAQ0AAADCoPdPbQ436IEwBwAAAAAAAAAAAAAAAMC/agAAAP//7NsBDQAAAMKg909tDjfogTAHAAAAAAAAAAAAAAAAwL9qAAAA///s2wENAAAAwqD3T20ON+iBMAcAAAAAAAAAAAAAAADAv2oAAAD//+zbAQ0AAADCoPdPbQ436IEwBwAAAAAAAAAAAAAAAMC/agAAAP//7NsBDQAAAMKg909tDjfogTAHAAAAAAAAAAAAAAAAwL9qAAAA///s2wENAAAAwqD3T20ON+iBMAcAAAAAAAAAAAAAAADAv2oAAAD//+zbAQ0AAADCoPdPbQ436IEwBwAAAAAAAAAAAAAAAMC/agAAAP//7NsBDQAAAMKg909tDjfogTAHAAAAAAAAAAAAAAAAwL9qAAAA///s2wENAAAAwqD3T20ON+iBMAcAAAAAAAAAAAAAAADAv2oAAAD//+zbAQ0AAADCoPdPbQ436IEwBwAAAAAAAAAAAAAAAMC/agAAAP//7NsBDQAAAMKg909tDjfogTAHAAAAAAAAAAAAAAAAwL9qAAAA///s2wENAAAAwqD3T20ON+iBMAcAAAAAAAAAAAAAAADAv2oAAAD//+zbAQ0AAADCoPdPbQ436IEwBwAAAAAAAAAAAAAAAMC/agAAAP//7NsBDQAAAMKg909tDjfogTAHAAAAAAAAAAAAAAAAwL9qAAAA///s2wENAAAAwqD3T20ON+iBMAcAAAAAAAAAAAAAAADAv2oAAAD//+zbAQ0AAADCoPdPbQ436IEwBwAAAAAAAAAAAAAAAMC/agAAAP//7NsBDQAAAMKg909tDjfogTAHAAAAAAAAAAAAAAAAwL9qAAAA///s2wENAAAAwqD3T20ON+iBMAcAAAAAAAAAAAAAAADAv2oAAAD//+zbAQ0AAADCoPdPbQ436IEwBwAAAAAAAAAAAAAAAMC/agAAAP//7NsBDQAAAMKg909tDjfogTAHAAAAAAAAAAAAAAAAwL9qAAAA///s2wENAAAAwqD3T20ON+iBMAcAAAAAAAAAAAAAAADAv2oAAAD//+zbAQ0AAADCoPdPbQ436IEwBwAAAAAAAAAAAAAAAMC/agAAAP//7NsBDQAAAMKg909tDjfogTAHAAAAAAAAAAAAAAAAwL9qAAAA///s2wENAAAAwqD3T20ON+iBMAcAAAAAAAAAAAAAAADAv2oAAAD//+zbAQ0AAADCoPdPbQ436IEwBwAAAAAAAAAAAAAAAMC/agAAAP//7NsBDQAAAMKg909tDjfogTAHAAAAAAAAAAAAAAAAwL9qAAAA///s2wENAAAAwqD3T20ON+iBMAcAAAAAAAAAAAAAAADAv2oAAAD//+zbAQ0AAADCoPdPbQ436IEwBwAAAAAAAAAAAAAAAMC/agAAAP//7NsBDQAAAMKg909tDjfogTAHAAAAAAAAAAAAAAAAwL9qAAAA///s2wENAAAAwqD3T20ON+iBMAcAAAAAAAAAAAAAAADAv2oAAAD//+zbAQ0AAADCoPdPbQ436IEwBwAAAAAAAAAAAAAAAMC/agAAAP//7NsBDQAAAMKg909tDjfogTAHAAAAAAAAAAAAAAAAwL9qAAAA///s2wENAAAAwqD3T20ON+iBMAcAAAAAAAAAAAAAAADAv2oAAAD//+zbAQ0AAADCoPdPbQ436IEwBwAAAAAAAAAAAAAAAMC/agAAAP//7NsBDQAAAMKg909tDjfogTAHAAAAAAAAAAAAAAAAwL9qAAAA///s2wENAAAAwqD3T20ON+iBMAcAAAAAAAAAAAAAAADAv2oAAAD//+zbAQ0AAADCoPdPbQ436IEwBwAAAAAAAAAAAAAAAMC/agAAAP//7NsBDQAAAMKg909tDjfogTAHAAAAAAAAAAAAAAAAwL9qAAAA///s2wENAAAAwqD3T20ON+iBMAcAAAAAAAAAAAAAAADAv2oAAAD//+zbAQ0AAADCoPdPbQ436IEwBwAAAAAAAAAAAAAAAMC/agAAAP//7NsBDQAAAMKg909tDjfogTAHAAAAAAAAAAAAAAAAwL9qAAAA///s2wENAAAAwqD3T20ON+iBMAcAAAAAAAAAAAAAAADAv2oAAAD//+zbAQ0AAADCoPdPbQ436IEwBwAAAAAAAAAAAAAAAMC/agAAAP//7NsBDQAAAMKg909tDjfogTAHAAAAAAAAAAAAAAAAwL9qAAAA///s2wENAAAAwqD3T20ON+iBMAcAAAAAAAAAAAAAAADAv2oAAAD//+zbAQ0AAADCoPdPbQ436IEwBwAAAAAAAAAAAAAAAMC/agAAAP//7NsBDQAAAMKg909tDjfogTAHAAAAAAAAAAAAAAAAwL9qAAAA///s2wENAAAAwqD3T20ON+iBMAcAAAAAAAAAAAAAAADAv2oAAAD//+zbAQ0AAADCoPdPbQ436IEwBwAAAAAAAAAAAAAAAMC/agAAAP//7NsBDQAAAMKg909tDjfogTAHAAAAAAAAAAAAAAAAwL9qAAAA///s2wENAAAAwqD3T20ON+iBMAcAAAAAAAAAAAAAAADAv2oAAAD//+zbAQ0AAADCoPdPbQ436IEwBwAAAAAAAAAAAAAAAMC/agAAAP//7NsBDQAAAMKg909tDjfogTAHAAAAAAAAAAAAAAAAwL9qAAAA///s2wENAAAAwqD3T20ON+iBMAcAAAAAAAAAAAAAAADAv2oAAAD//+zbAQ0AAADCoPdPbQ436IEwBwAAAAAAAAAAAAAAAMC/agAAAP//7NsBDQAAAMKg909tDjfogTAHAAAAAAAAAAAAAAAAwL9qAAAA///s2wENAAAAwqD3T20ON+iBMAcAAAAAAAAAAAAAAADAv2oAAAD//+zbAQ0AAADCoPdPbQ436IEwBwAAAAAAAAAAAAAAAMC/agAAAP//7NsBDQAAAMKg909tDjfogTAHAAAAAAAAAAAAAAAAwL9qAAAA///s2wENAAAAwqD3T20ON+iBMAcAAAAAAAAAAAAAAADAv2oAAAD//+zbAQ0AAADCoPdPbQ436IEwBwAAAAAAAAAAAAAAAMC/agAAAP//7NsBDQAAAMKg909tDjfogTAHAAAAAAAAAAAAAAAAwL9qAAAA///s2wENAAAAwqD3T20ON+iBMAcAAAAAAAAAAAAAAADAv2oAAAD//+zbAQ0AAADCoPdPbQ436IEwBwAAAAAAAAAAAAAAAMC/agAAAP//7NsBDQAAAMKg909tDjfogTAHAAAAAAAAAAAAAAAAwL9qAAAA///s2wENAAAAwqD3T20ON+iBMAcAAAAAAAAAAAAAAADAv2oAAAD//+zbAQ0AAADCoPdPbQ436IEwBwAAAAAAAAAAAAAAAMC/agAAAP//7NsBDQAAAMKg909tDjfogTAHAAAAAAAAAAAAAAAAwL9qAAAA///s2wENAAAAwqD3T20ON+iBMAcAAAAAAAAAAAAAAADAv2oAAAD//+zbAQ0AAADCoPdPbQ436IEwBwAAAAAAAAAAAAAAAMC/agAAAP//7NsBDQAAAMKg909tDjfogTAHAAAAAAAAAAAAAAAAwL9qAAAA///s2wENAAAAwqD3T20ON+iBMAcAAAAAAAAAAAAAAADAv2oAAAD//+zbAQ0AAADCoPdPbQ436IEwBwAAAAAAAAAAAAAAAMC/agAAAP//7NsBDQAAAMKg909tDjfogTAHAAAAAAAAAAAAAAAAwL9qAAAA///s2wENAAAAwqD3T20ON+iBMAcAAAAAAAAAAAAAAADAv2oAAAD//+zbAQ0AAADCoPdPbQ436IEwBwAAAAAAAAAAAAAAAMC/agAAAP//7NsBDQAAAMKg909tDjfogTAHAAAAAAAAAAAAAAAAwL9qAAAA///s2wENAAAAwqD3T20ON+iBMAcAAAAAAAAAAAAAAADAv2oAAAD//+zbAQ0AAADCoPdPbQ436IEwBwAAAAAAAAAAAAAAAMC/agAAAP//7NsBDQAAAMKg909tDjfogTAHAAAAAAAAAAAAAAAAwL9qAAAA///s2wENAAAAwqD3T20ON+iBMAcAAAAAAAAAAAAAAADAv2oAAAD//+zbAQ0AAADCoPdPbQ436IEwBwAAAAAAAAAAAAAAAMC/agAAAP//7NsBDQAAAMKg909tDjfogTAHAAAAAAAAAAAAAAAAwL9qAAAA///s2wENAAAAwqD3T20ON+iBMAcAAAAAAAAAAAAAAADAv2oAAAD//+zbAQ0AAADCoPdPbQ436IEwBwAAAAAAAAAAAAAAAMC/agAAAP//7NsBDQAAAMKg909tDjfogTAHAAAAAAAAAAAAAAAAwL9qAAAA///s2wENAAAAwqD3T20ON+iBMAcAAAAAAAAAAAAAAADAv2oAAAD//+zbAQ0AAADCoPdPbQ436IEwBwAAAAAAAAAAAAAAAMC/agAAAP//7NsBDQAAAMKg909tDjfogTAHAAAAAAAAAAAAAAAAwL9qAAAA///s2wENAAAAwqD3T20ON+iBMAcAAAAAAAAAAAAAAADAv2oAAAD//+zbAQ0AAADCoPdPbQ436IEwBwAAAAAAAAAAAAAAAMC/agAAAP//7NsBDQAAAMKg909tDjfogTAHAAAAAAAAAAAAAAAAwL9qAAAA///s2wENAAAAwqD3T20ON+iBMAcAAAAAAAAAAAAAAADAv2oAAAD//+zbAQ0AAADCoPdPbQ436IEwBwAAAAAAAAAAAAAAAMC/agAAAP//7NsBDQAAAMKg909tDjfogTAHAAAAAAAAAAAAAAAAwL9qAAAA///s2wENAAAAwqD3T20ON+iBMAcAAAAAAAAAAAAAAADAv2oAAAD//+zbAQ0AAADCoPdPbQ436IEwBwAAAAAAAAAAAAAAAMC/agAAAP//7NsBDQAAAMKg909tDjfogTAHAAAAAAAAAAAAAAAAwL9qAAAA///s2wENAAAAwqD3T20ON+iBMAcAAAAAAAAAAAAAAADAv2oAAAD//+zbAQ0AAADCoPdPbQ436IEwBwAAAAAAAAAAAAAAAMC/agAAAP//7NsBDQAAAMKg909tDjfogTAHAAAAAAAAAAAAAAAAwL9qAAAA///s2wENAAAAwqD3T20ON+iBMAcAAAAAAAAAAAAAAADAv2oAAAD//+zbAQ0AAADCoPdPbQ436IEwBwAAAAAAAAAAAAAAAMC/agAAAP//7NsBDQAAAMKg909tDjfogTAHAAAAAAAAAAAAAAAAwL9qAAAA///s2wENAAAAwqD3T20ON+iBMAcAAAAAAAAAAAAAAADAv2oAAAD//+zbAQ0AAADCoPdPbQ436IEwBwAAAAAAAAAAAAAAAMC/agAAAP//7NsBDQAAAMKg909tDjfogTAHAAAAAAAAAAAAAAAAwL9qAAAA///s2wENAAAAwqD3T20ON+iBMAcAAAAAAAAAAAAAAADAv2oAAAD//+zbAQ0AAADCoPdPbQ436IEwBwAAAAAAAAAAAAAAAMC/agDTZYG2AAAgAElEQVQAAP//7NsBDQAAAMKg909tDjfogTAHAAAAAAAAAAAAAAAAwL9qAAAA///s2wENAAAAwqD3T20ON+iBMAcAAAAAAAAAAAAAAADAv2oAAAD//+zbAQ0AAADCoPdPbQ436IEwBwAAAAAAAAAAAAAAAMC/agAAAP//7NsBDQAAAMKg909tDjfogTAHAAAAAAAAAAAAAAAAwL9qAAAA///s2wENAAAAwqD3T20ON+iBMAcAAAAAAAAAAAAAAADAv2oAAAD//+zbAQ0AAADCoPdPbQ436IEwBwAAAAAAAAAAAAAAAMC/agAAAP//7NsBDQAAAMKg909tDjfogTAHAAAAAAAAAAAAAAAAwL9qAAAA///s2wENAAAAwqD3T20ON+iBMAcAAAAAAAAAAAAAAADAv2oAAAD//+zbAQ0AAADCoPdPbQ436IEwBwAAAAAAAAAAAAAAAMC/agAAAP//7NsBDQAAAMKg909tDjfogTAHAAAAAAAAAAAAAAAAwL9qAAAA///s2wENAAAAwqD3T20ON+iBMAcAAAAAAAAAAAAAAADAv2oAAAD//+zbAQ0AAADCoPdPbQ436IEwBwAAAAAAAAAAAAAAAMC/agAAAP//7NsBDQAAAMKg909tDjfogTAHAAAAAAAAAAAAAAAAwL9qAAAA///s2wENAAAAwqD3T20ON+iBMAcAAAAAAAAAAAAAAADAv2oAAAD//+zbAQ0AAADCoPdPbQ436IEwBwAAAAAAAAAAAAAAAMC/agAAAP//7NsBDQAAAMKg909tDjfogTAHAAAAAAAAAAAAAAAAwL9qAAAA///s2wENAAAAwqD3T20ON+iBMAcAAAAAAAAAAAAAAADAv2oAAAD//+zbAQ0AAADCoPdPbQ436IEwBwAAAAAAAAAAAAAAAMC/agAAAP//7NsBDQAAAMKg909tDjfogTAHAAAAAAAAAAAAAAAAwL9qAAAA///s2wENAAAAwqD3T20ON+iBMAcAAAAAAAAAAAAAAADAv2oAAAD//+zbAQ0AAADCoPdPbQ436IEwBwAAAAAAAAAAAAAAAMC/agAAAP//7NsBDQAAAMKg909tDjfogTAHAAAAAAAAAAAAAAAAwL9qAAAA///s2wENAAAAwqD3T20ON+iBMAcAAAAAAAAAAAAAAADAv2oAAAD//+zbAQ0AAADCoPdPbQ436IEwBwAAAAAAAAAAAAAAAMC/agAAAP//7NsBDQAAAMKg909tDjfogTAHAAAAAAAAAAAAAAAAwL9qAAAA///s2wENAAAAwqD3T20ON+iBMAcAAAAAAAAAAAAAAADAv2oAAAD//+zbAQ0AAADCoPdPbQ436IEwBwAAAAAAAAAAAAAAAMC/agAAAP//7NsBDQAAAMKg909tDjfogTAHAAAAAAAAAAAAAAAAwL9qAAAA///s2wENAAAAwqD3T20ON+iBMAcAAAAAAAAAAAAAAADAv2oAAAD//+zbAQ0AAADCoPdPbQ436IEwBwAAAAAAAAAAAAAAAMC/agAAAP//7NsBDQAAAMKg909tDjfogTAHAAAAAAAAAAAAAAAAwL9qAAAA///s2wENAAAAwqD3T20ON+iBMAcAAAAAAAAAAAAAAADAv2oAAAD//+zbAQ0AAADCoPdPbQ436IEwBwAAAAAAAAAAAAAAAMC/agAAAP//7NsBDQAAAMKg909tDjfogTAHAAAAAAAAAAAAAAAAwL9qAAAA///s2wENAAAAwqD3T20ON+iBMAcAAAAAAAAAAAAAAADAv2oAAAD//+zbAQ0AAADCoPdPbQ436IEwBwAAAAAAAAAAAAAAAMC/agAAAP//7NsBDQAAAMKg909tDjfogTAHAAAAAAAAAAAAAAAAwL9qAAAA///s2wENAAAAwqD3T20ON+iBMAcAAAAAAAAAAAAAAADAv2oAAAD//+zbAQ0AAADCoPdPbQ436IEwBwAAAAAAAAAAAAAAAMC/agAAAP//7NsBDQAAAMKg909tDjfogTAHAAAAAAAAAAAAAAAAwL9qAAAA///s2wENAAAAwqD3T20ON+iBMAcAAAAAAAAAAAAAAADAv2oAAAD//+zbAQ0AAADCoPdPbQ436IEwBwAAAAAAAAAAAAAAAMC/agAAAP//7NsBDQAAAMKg909tDjfogTAHAAAAAAAAAAAAAAAAwL9qAAAA///s2wENAAAAwqD3T20ON+iBMAcAAAAAAAAAAAAAAADAv2oAAAD//+zbAQ0AAADCoPdPbQ436IEwBwAAAAAAAAAAAAAAAMC/agAAAP//7NsBDQAAAMKg909tDjfogTAHAAAAAAAAAAAAAAAAwL9qAAAA///s2wENAAAAwqD3T20ON+iBMAcAAAAAAAAAAAAAAADAv2oAAAD//+zbAQ0AAADCoPdPbQ436IEwBwAAAAAAAAAAAAAAAMC/agAAAP//7NsBDQAAAMKg909tDjfogTAHAAAAAAAAAAAAAAAAwL9qAAAA///s2wENAAAAwqD3T20ON+iBMAcAAAAAAAAAAAAAAADAv2oAAAD//+zbAQ0AAADCoPdPbQ436IEwBwAAAAAAAAAAAAAAAMC/agAAAP//7NsBDQAAAMKg909tDjfogTAHAAAAAAAAAAAAAAAAwL9qAAAA///s2wENAAAAwqD3T20ON+iBMAcAAAAAAAAAAAAAAADAv2oAAAD//+zbAQ0AAADCoPdPbQ436IEwBwAAAAAAAAAAAAAAAMC/agAAAP//7NsBDQAAAMKg909tDjfogTAHAAAAAAAAAAAAAAAAwL9qAAAA///s2wENAAAAwqD3T20ON+iBMAcAAAAAAAAAAAAAAADAv2oAAAD//+zbAQ0AAADCoPdPbQ436IEwBwAAAAAAAAAAAAAAAMC/agAAAP//7NsBDQAAAMKg909tDjfogTAHAAAAAAAAAAAAAAAAwL9qAAAA///s2wENAAAAwqD3T20ON+iBMAcAAAAAAAAAAAAAAADAv2oAAAD//+zbAQ0AAADCoPdPbQ436IEwBwAAAAAAAAAAAAAAAMC/agAAAP//7NsBDQAAAMKg909tDjfogTAHAAAAAAAAAAAAAAAAwL9qAAAA///s2wENAAAAwqD3T20ON+iBMAcAAAAAAAAAAAAAAADAv2oAAAD//+zbAQ0AAADCoPdPbQ436IEwBwAAAAAAAAAAAAAAAMC/agAAAP//7NsBDQAAAMKg909tDjfogTAHAAAAAAAAAAAAAAAAwL9qAAAA///s2wENAAAAwqD3T20ON+iBMAcAAAAAAAAAAAAAAADAv2oAAAD//+zbAQ0AAADCoPdPbQ436IEwBwAAAAAAAAAAAAAAAMC/agAAAP//7NsBDQAAAMKg909tDjfogTAHAAAAAAAAAAAAAAAAwL9qAAAA///s2wENAAAAwqD3T20ON+iBMAcAAAAAAAAAAAAAAADAv2oAAAD//+zbAQ0AAADCoPdPbQ436IEwBwAAAAAAAAAAAAAAAMC/agAAAP//7NsBDQAAAMKg909tDjfogTAHAAAAAAAAAAAAAAAAwL9qAAAA///s2wENAAAAwqD3T20ON+iBMAcAAAAAAAAAAAAAAADAv2oAAAD//+zbAQ0AAADCoPdPbQ436IEwBwAAAAAAAAAAAAAAAMC/agAAAP//7NsBDQAAAMKg909tDjfogTAHAAAAAAAAAAAAAAAAwL9qAAAA///s2wENAAAAwqD3T20ON+iBMAcAAAAAAAAAAAAAAADAv2oAAAD//+zbAQ0AAADCoPdPbQ436IEwBwAAAAAAAAAAAAAAAMC/agAAAP//7NsBDQAAAMKg909tDjfogTAHAAAAAAAAAAAAAAAAwL9qAAAA///s2wENAAAAwqD3T20ON+iBMAcAAAAAAAAAAAAAAADAv2oAAAD//+zbAQ0AAADCoPdPbQ436IEwBwAAAAAAAAAAAAAAAMC/agAAAP//7NsBDQAAAMKg909tDjfogTAHAAAAAAAAAAAAAAAAwL9qAAAA///s2wENAAAAwqD3T20ON+iBMAcAAAAAAAAAAAAAAADAv2oAAAD//+zbAQ0AAADCoPdPbQ436IEwBwAAAAAAAAAAAAAAAMC/agAAAP//7NsBDQAAAMKg909tDjfogTAHAAAAAAAAAAAAAAAAwL9qAAAA///s2wENAAAAwqD3T20ON+iBMAcAAAAAAAAAAAAAAADAv2oAAAD//+zbAQ0AAADCoPdPbQ436IEwBwAAAAAAAAAAAAAAAMC/agAAAP//7NsBDQAAAMKg909tDjfogTAHAAAAAAAAAAAAAAAAwL9qAAAA///s2wENAAAAwqD3T20ON+iBMAcAAAAAAAAAAAAAAADAv2oAAAD//+zbAQ0AAADCoPdPbQ436IEwBwAAAAAAAAAAAAAAAMC/agAAAP//7NsBDQAAAMKg909tDjfogTAHAAAAAAAAAAAAAAAAwL9qAAAA///s2wENAAAAwqD3T20ON+iBMAcAAAAAAAAAAAAAAADAv2oAAAD//+zbAQ0AAADCoPdPbQ436IEwBwAAAAAAAAAAAAAAAMC/agAAAP//7NsBDQAAAMKg909tDjfogTAHAAAAAAAAAAAAAAAAwL9qAAAA///s2wENAAAAwqD3T20ON+iBMAcAAAAAAAAAAAAAAADAv2oAAAD//+zbAQ0AAADCoPdPbQ436IEwBwAAAAAAAAAAAAAAAMC/agAAAP//7NsBDQAAAMKg909tDjfogTAHAAAAAAAAAAAAAAAAwL9qAAAA///s2wENAAAAwqD3T20ON+iBMAcAAAAAAAAAAAAAAADAv2oAAAD//+zbAQ0AAADCoPdPbQ436IEwBwAAAAAAAAAAAAAAAMC/agAAAP//7NsBDQAAAMKg909tDjfogTAHAAAAAAAAAAAAAAAAwL9qAAAA///s2wENAAAAwqD3T20ON+iBMAcAAAAAAAAAAAAAAADAv2oAAAD//+zbAQ0AAADCoPdPbQ436IEwBwAAAAAAAAAAAAAAAMC/agAAAP//7NsBDQAAAMKg909tDjfogTAHAAAAAAAAAAAAAAAAwL9qAAAA///s2wENAAAAwqD3T20ON+iBMAcAAAAAAAAAAAAAAADAv2oAAAD//+zbAQ0AAADCoPdPbQ436IEwBwAAAAAAAAAAAAAAAMC/agAAAP//7NsBDQAAAMKg909tDjfogTAHAAAAAAAAAAAAAAAAwL9qAAAA///s2wENAAAAwqD3T20ON+iBMAcAAAAAAAAAAAAAAADAv2oAAAD//+zbAQ0AAADCoPdPbQ436IEwBwAAAAAAAAAAAAAAAMC/agAAAP//7NsBDQAAAMKg909tDjfogTAHAAAAAAAAAAAAAAAAwL9qAAAA///s2wENAAAAwqD3T20ON+iBMAcAAAAAAAAAAAAAAADAv2oAAAD//+zbAQ0AAADCoPdPbQ436IEwBwAAAAAAAAAAAAAAAMC/agAAAP//7NsBDQAAAMKg909tDjfogTAHAAAAAAAAAAAAAAAAwL9qAAAA///s2wENAAAAwqD3T20ON+iBMAcAAAAAAAAAAAAAAADAv2oAAAD//+zbAQ0AAADCoPdPbQ436IEwBwAAAAAAAAAAAAAAAMC/agAAAP//7NsBDQAAAMKg909tDjfogTAHAAAAAAAAAAAAAAAAwL9qAAAA///s2wENAAAAwqD3T20ON+iBMAcAAAAAAAAAAAAAAADAv2oAAAD//+zbAQ0AAADCoPdPbQ436IEwBwAAAAAAAAAAAAAAAMC/agAAAP//7NsBDQAAAMKg909tDjfogTAHAAAAAAAAAAAAAAAAwL9qAAAA///s2wENAAAAwqD3T20ON+iBMAcAAAAAAAAAAAAAAADAv2oAAAD//+zbAQ0AAADCoPdPbQ436IEwBwAAAAAAAAAAAAAAAMC/agAAAP//7NsBDQAAAMKg909tDjfogTAHAAAAAAAAAAAAAAAAwL9qAAAA///s2wENAAAAwqD3T20ON+iBMAcAAAAAAAAAAAAAAADAv2oAAAD//+zbAQ0AAADCoPdPbQ436IEwBwAAAAAAAAAAAAAAAMC/agAAAP//7NsBDQAAAMKg909tDjfogTAHAAAAAAAAAAAAAAAAwL9qAAAA///s2wENAAAAwqD3T20ON+iBMAcAAAAAAAAAAAAAAADAv2oAAAD//+zbAQ0AAADCoPdPbQ436IEwBwAAAAAAAAAAAAAAAMC/agAAAP//7NsBDQAAAMKg909tDjfogTAHAAAAAAAAAAAAAAAAwL9qAAAA///s2wENAAAAwqD3T20ON+iBMAcAAAAAAAAAAAAAAADAv2oAAAD//+zbAQ0AAADCoPdPbQ436IEwBwAAAAAAAAAAAAAAAMC/agAAAP//7NsBDQAAAMKg909tDjfogTAHAAAAAAAAAAAAAAAAwL9qAAAA///s2wENAAAAwqD3T20ON+iBMAcAAAAAAAAAAAAAAADAv2oAAAD//+zbAQ0AAADCoPdPbQ436IEwBwAAAAAAAAAAAAAAAMC/agAAAP//7NsBDQAAAMKg909tDjfogTAHAAAAAAAAAAAAAAAAwL9qAAAA///s2wENAAAAwqD3T20ON+iBMAcAAAAAAAAAAAAAAADAv2oAAAD//+zbAQ0AAADCoPdPbQ436IEwBwAAAAAAAAAAAAAAAMC/agAAAP//7NsBDQAAAMKg909tDjfogTAHAAAAAAAAAAAAAAAAwL9qAAAA///s2wENAAAAwqD3T20ON+iBMAcAAAAAAAAAAAAAAADAv2oAAAD//+zbAQ0AAADCoPdPbQ436IEwBwAAAAAAAAAAAAAAAMC/agAAAP//7NsBDQAAAMKg909tDjfogTAHAAAAAAAAAAAAAAAAwL9qAAAA///s2wENAAAAwqD3T20ON+iBMAcAAAAAAAAAAAAAAADAv2oAAAD//+zbAQ0AAADCoPdPbQ436IEwBwAAAAAAAAAAAAAAAMC/agAAAP//7NsBDQAAAMKg909tDjfogTAHAAAAAAAAAAAAAAAAwL9qAAAA///s2wENAAAAwqD3T20ON+iBMAcAAAAAAAAAAAAAAADAv2oAAAD//+zbAQ0AAADCoPdPbQ436IEwBwAAAAAAAAAAAAAAAMC/agAAAP//7NsBDQAAAMKg909tDjfogTAHAAAAAAAAAAAAAAAAwL9qAAAA///s2wENAAAAwqD3T20ON+iBMAcAAAAAAAAAAAAAAADAv2oAAAD//+zbAQ0AAADCoPdPbQ436IEwBwAAAAAAAAAAAAAAAMC/agAAAP//7NsBDQAAAMKg909tDjfogTAHAAAAAAAAAAAAAAAAwL9qAAAA///s2wENAAAAwqD3T20ON+iBMAcAAAAAAAAAAAAAAADAv2oAAAD//+zbAQ0AAADCoPdPbQ436IEwBwAAAAAAAAAAAAAAAMC/agAAAP//7NsBDQAAAMKg909tDjfogTAHAAAAAAAAAAAAAAAAwL9qAAAA///s2wENAAAAwqD3T20ON+iBMAcAAAAAAAAAAAAAAADAv2oAAAD//+zbAQ0AAADCoPdPbQ436IEwBwAAAAAAAAAAAAAAAMC/agAAAP//7NsBDQAAAMKg909tDjfogTAHAAAAAAAAAAAAAAAAwL9qAAAA///s2wENAAAAwqD3T20ON+iBMAcAAAAAAAAAAAAAAADAv2oAAAD//+zbAQ0AAADCoPdPbQ436IEwBwAAAAAAAAAAAAAAAMC/agAAAP//7NsBDQAAAMKg909tDjfogTAHAAAAAAAAAAAAAAAAwL9qAAAA///s2wENAAAAwqD3T20ON+iBMAcAAAAAAAAAAAAAAADAv2oAAAD//+zbAQ0AAADCoPdPbQ436IEwBwAAAAAAAAAAAAAAAMC/agAAAP//7NsBDQAAAMKg909tDjfogTAHAAAAAAAAAAAAAAAAwL9qAAAA///s2wENAAAAwqD3T20ON+iBMAcAAAAAAAAAAAAAAADAv2oAAAD//+zbAQ0AAADCoPdPbQ436IEwBwAAAAAAAAAAAAAAAMC/agAAAP//7NsBDQAAAMKg909tDjfogTAHAAAAAAAAAAAAAAAAwL9qAAAA///s2wENAAAAwqD3T20ON+iBMAcAAAAAAAAAAAAAAADAv2oAAAD//+zbAQ0AAADCoPdPbQ436IEwBwAAAAAAAAAAAAAAAMC/agAAAP//7NsBDQAAAMKg909tDjfogTAHAAAAAAAAAAAAAAAAwL9qAAAA///s2wENAAAAwqD3T20ON+iBMAcAAAAAAAAAAAAAAADAv2oAAAD//+zbAQ0AAADCoPdPbQ436IEwBwAAAAAAAAAAAAAAAMC/agAAAP//7NsBDQAAAMKg909tDjfogTAHAAAAAAAAAAAAAAAAwL9qAAAA///s2wENAAAAwqD3T20ON+iBMAcAAAAAAAAAAAAAAADAv2oAAAD//+zbAQ0AAADCoPdPbQ436IEwBwAAAAAAAAAAAAAAAMC/agAAAP//7NsBDQAAAMKg909tDjfogTAHAAAAAAAAAAAAAAAAwL9qAAAA///s2wENAAAAwqD3T20ON+iBMAcAAAAAAAAAAAAAAADAv2oAAAD//+zbAQ0AAADCoPdPbQ436IEwBwAAAAAAAAAAAAAAAMC/agAAAP//7NsBDQAAAMKg909tDjfogTAHAAAAAAAAAAAAAAAAwL9qAAAA///s2wENAAAAwqD3T20ON+iBMAcAAAAAAAAAAAAAAADAv2oAAAD//+zbAQ0AAADCoPdPbQ436IEwBwAAAAAAAAAAAAAAAMC/agAAAP//7NsBDQAAAMKg909tDjfogTAHAAAAAAAAAAAAAAAAwL9qAAAA///s2wENAAAAwqD3T20ON+iBMAcAAAAAAAAAAAAAAADAv2oAAAD//+zbAQ0AAADCoPdPbQ436IEwBwAAAAAAAAAAAAAAAMC/agAAAP//7NsBDQAAAMKg909tDjfogTAHAAAAAAAAAAAAAAAAwL9qAAAA///s2wENAAAAwqD3T20ON+iBMAcAAAAAAAAAAAAAAADAv2oAAAD//+zbAQ0AAADCoPdPbQ436IEwBwAAAAAAAAAAAAAAAMC/agAAAP//7NsBDQAAAMKg909tDjfogTAHAAAAAAAAAAAAAAAAwL9qAAAA///s2wENAAAAwqD3T20ON+iBMAcAAAAAAAAAAAAAAADAv2oAAAD//+zbAQ0AAADCoPdPbQ436IEwBwAAAAAAAAAAAAAAAMC/agAAAP//7NsBDQAAAMKg909tDjfogTAHAAAAAAAAAAAAAAAAwL9qAAAA///s2wENAAAAwqD3T20ON+iBMAcAAAAAAAAAAAAAAADAv2oAAAD//+zbAQ0AAADCoPdPbQ436IEwBwAAAAAAAAAAAAAAAMC/agAAAP//7NsBDQAAAMKg909tDjfogTAHAAAAAAAAAAAAAAAAwL9qAAAA///s2wENAAAAwqD3T20ON+iBMAcAAAAAAAAAAAAAAADAv2oAAAD//+zbAQ0AAADCoPdPbQ436IEwBwAAAAAAAAAAAAAAAMC/agAAAP//7NsBDQAAAMKg909tDjfogTAHAAAAAAAAAAAAAAAAwL9qAAAA///s2wENAAAAwqD3T20ON+iBMAcAAAAAAAAAAAAAAADAv2oAAAD//+zbAQ0AAADCoPdPbQ436IEwBwAAAAAAAAAAAAAAAMC/agAAAP//7NsBDQAAAMKg909tDjfogTAHAAAAAAAAAAAAAAAAwL9qAAAA///s2wENAAAAwqD3T20ON+iBMAcAAAAAAAAAAAAAAADAv2oAAAD//+zbAQ0AAADCoPdPbQ436IEwBwAAAAAAAAAAAAAAAMC/agAAAP//7NsBDQAAAMKg909tDjfogTAHAAAAAAAAAAAAAAAAwL9qAAAA///s2wENAAAAwqD3T20ON+iBMAcAAAAAAAAAAAAAAADAv2oAAAD//+zbAQ0AAADCoPdPbQ436IEwBwAAAAAAAAAAAAAAAMC/agAAAP//7NsBDQAAAMKg909tDjfogTAHAAAAAAAAAAAAAAAAwL9qAAAA///s2wENAAAAwqD3T20ON+iBMAcAAAAAAAAAAAAAAADAv2oAAAD//+zbAQ0AAADCoPdPbQ436IEwBwAAAAAAAAAAAAAAAMC/agAAAP//7NsBDQAAAMKg909tDjfogTAHAAAAAAAAAAAAAAAAwL9qAAAA///s2wENAAAAwqD3T20ON+iBMAcAAAAAAAAAAAAAAADAv2oAAAD//+zbAQ0AAADCoPdPbQ436IEwBwAAAAAAAAAAAAAAAMC/agAAAP//7NsBDQAAAMKg909tDjfogTAHAAAAAAAAAAAAAAAAwL9qAAAA///s2wENAAAAwqD3T20ON+iBMAcAAAAAAAAAAAAAAADAv2oAAAD//+zbAQ0AAADCoPdPbQ436IEwBwAAAAAAAAAAAAAAAMC/agAAAP//7NsBDQAAAMKg909tDjfogTAHAAAAAAAAAAAAAAAAwL9qAAAA///s2wENAAAAwqD3T20ON+iBMAcAAAAAAAAAAAAAAADAv2oAAAD//+zbAQ0AAADCoPdPbQ436IEwBwAAAAAAAAAAAAAAAMC/agAAAP//7NsBDQAAAMKg909tDjfogTAHAAAAAAAAAAAAAAAAwL9qAAAA///s2wENAAAAwqD3T20ON+iBMAcAAAAAAAAAAAAAAADAv2oAAAD//+zbAQ0AAADCoPdPbQ436IEwBwAAAAAAAAAAAAAAAMC/agAAAP//7NsBDQAAAMKg909tDjfogTAHAAAAAAAAAAAAAAAAwL9qAAAA///s2wENAAAAwqD3T20ON+iBMAcAAAAAAAAAAAAAAADAv2oAAAD//+zbAQ0AAADCoPdPbQ436IEwB/+dKU4AAAjXSURBVAAAAAAAAAAAAAAAAMC/auzbAQ0AAADCoPdPbQ436IEwBwAAAAAAAAAAAAAAAMC/agAAAP//7NsBDQAAAMKg909tDjfogTAHAAAAAAAAAAAAAAAAwL9qAAAA///s2wENAAAAwqD3T20ON+iBMAcAAAAAAAAAAAAAAADAv2oAAAD//+zbAQ0AAADCoPdPbQ436IEwBwAAAAAAAAAAAAAAAMC/agAAAP//7NsBDQAAAMKg909tDjfogTAHAAAAAAAAAAAAAAAAwL9qAAAA///s2wENAAAAwqD3T20ON+iBMAcAAAAAAAAAAAAAAADAv2oAAAD//+zbAQ0AAADCoPdPbQ436IEwBwAAAAAAAAAAAAAAAMC/agAAAP//7NsBDQAAAMKg909tDjfogTAHAAAAAAAAAAAAAAAAwL9qAAAA///s2wENAAAAwqD3T20ON+iBMAcAAAAAAAAAAAAAAADAv2oAAAD//+zbAQ0AAADCoPdPbQ436IEwBwAAAAAAAAAAAAAAAMC/agAAAP//7NsBDQAAAMKg909tDjfogTAHAAAAAAAAAAAAAAAAwL9qAAAA///s2wENAAAAwqD3T20ON+iBMAcAAAAAAAAAAAAAAADAv2oAAAD//+zbAQ0AAADCoPdPbQ436IEwBwAAAAAAAAAAAAAAAMC/agAAAP//7NsBDQAAAMKg909tDjfogTAHAAAAAAAAAAAAAAAAwL9qAAAA///s2wENAAAAwqD3T20ON+iBMAcAAAAAAAAAAAAAAADAv2oAAAD//+zbAQ0AAADCoPdPbQ436IEwBwAAAAAAAAAAAAAAAMC/agAAAP//7NsBDQAAAMKg909tDjfogTAHAAAAAAAAAAAAAAAAwL9qAAAA///s2wENAAAAwqD3T20ON+iBMAcAAAAAAAAAAAAAAADAv2oAAAD//+zbAQ0AAADCoPdPbQ436IEwBwAAAAAAAAAAAAAAAMC/agAAAP//7NsBDQAAAMKg909tDjfogTAHAAAAAAAAAAAAAAAAwL9qAAAA///s2wENAAAAwqD3T20ON+iBMAcAAAAAAAAAAAAAAADAv2oAAAD//+zbAQ0AAADCoPdPbQ436IEwBwAAAAAAAAAAAAAAAMC/agAAAP//7NsBDQAAAMKg909tDjfogTAHAAAAAAAAAAAAAAAAwL9qAAAA///s2wENAAAAwqD3T20ON+iBMAcAAAAAAAAAAAAAAADAv2oAAAD//+zbAQ0AAADCoPdPbQ436IEwBwAAAAAAAAAAAAAAAMC/agAAAP//7NsBDQAAAMKg909tDjfogTAHAAAAAAAAAAAAAAAAwL9qAAAA///s2wENAAAAwqD3T20ON+iBMAcAAAAAAAAAAAAAAADAv2oAAAD//+zbAQ0AAADCoPdPbQ436IEwBwAAAAAAAAAAAAAAAMC/agAAAP//7NsBDQAAAMKg909tDjfogTAHAAAAAAAAAAAAAAAAwL9qAAAA///s2wENAAAAwqD3T20ON+iBMAcAAAAAAAAAAAAAAADAv2oAAAD//+zbAQ0AAADCoPdPbQ436IEwBwAAAAAAAAAAAAAAAMC/agAAAP//7NsBDQAAAMKg909tDjfogTAHAAAAAAAAAAAAAAAAwL9qAAAA///s2wENAAAAwqD3T20ON+iBMAcAAAAAAAAAAAAAAADAv2oAAAD//+zbAQ0AAADCoPdPbQ436IEwBwAAAAAAAAAAAAAAAMC/agAAAP//7NsBDQAAAMKg909tDjfogTAHAAAAAAAAAAAAAAAAwL9qAAAA///s2wENAAAAwqD3T20ON+iBMAcAAAAAAAAAAAAAAADAv2oAAAD//+zbAQ0AAADCoPdPbQ436IEwBwAAAAAAAAAAAAAAAMC/agAAAP//7NsBDQAAAMKg909tDjfogTAHAAAAAAAAAAAAAAAAwL9qAAAA///s2wENAAAAwqD3T20ON+iBMAcAAAAAAAAAAAAAAADAv2oAAAD//+zbAQ0AAADCoPdPbQ436IEwBwAAAAAAAAAAAAAAAMC/agAAAP//7NsBDQAAAMKg909tDjfogTAHAAAAAAAAAAAAAAAAwL9qAAAA///s2wENAAAAwqD3T20ON+iBMAcAAAAAAAAAAAAAAADAv2oAAAD//+zbAQ0AAADCoPdPbQ436IEwBwAAAAAAAAAAAAAAAMC/agAAAP//7NsBDQAAAMKg909tDjfogTAHAAAAAAAAAAAAAAAAwL9qAAAA///s2wENAAAAwqD3T20ON+iBMAcAAAAAAAAAAAAAAADAv2oAAAD//+zbAQ0AAADCoPdPbQ436IEwBwAAAAAAAAAAAAAAAMC/agAAAP//7NsBDQAAAMKg909tDjfogTAHAAAAAAAAAAAAAAAAwL9qAAAA///s2wENAAAAwqD3T20ON+iBMAcAAAAAAAAAAAAAAADAv2oAAAD//+zbAQ0AAADCoPdPbQ436IEwBwAAAAAAAAAAAAAAAMC/agAAAP//7NsBDQAAAMKg909tDjfogTAHAAAAAAAAAAAAAAAAwL9qAAAA///s2wENAAAAwqD3T20ON+iBMAcAAAAAAAAAAAAAAADAv2oAAAD//+zbAQ0AAADCoPdPbQ436IEwBwAAAAAAAAAAAAAAAMC/agAAAP//7NsBDQAAAMKg909tDjfogTAHAAAAAAAAAAAAAAAAwL9qAAAA///s2wENAAAAwqD3T20ON+iBMAcAAAAAAAAAAAAAAADAv2oAAAD//+zbAQ0AAADCoPdPbQ436IEwBwAAAAAAAAAAAAAAAMC/agAAAP//7NsBDQAAAMKg909tDjfogTAHAAAAAAAAAAAAAAAAwL9qAAAA///s2wENAAAAwqD3T20ON+iBMAcAAAAAAAAAAAAAAADAv2oAAAD//+zbAQ0AAADCoPdPbQ436IEwBwAAAAAAAAAAAAAAAMC/agAAAP//7NsBDQAAAMKg909tDjfogTAHAAAAAAAAAAAAAAAAwL9qAAAA//8DAELcvky63JGAAAAAAElFTkSuQmCC"></image></defs></svg>
                               </div>
                               <div class="sc-8a38d207-1 fhYDVM"
                                    style="margin-right: auto;width: 100%;display: block;-webkit-box-align: center;align-items: center;-webkit-box-pack: justify;justify-content: space-between;margin:20px 0">
                                   <span class="sc-8a38d207-2 cWkccj" style="width:100%">
                                        @if (session('locale') == 'ar')
                                           <p>قسم على 12 دفعات من {{ number_format($jeelInstallmentAmount, 2) }} {{
                                           $currency }} . بدون
                                               فوائد. بدون رسوم تأخير.</p>
                                       @else
                                           <p>Split in 12 payments of {{ $currency }} {{ number_format
                                           ($jeelInstallmentAmount, 2) }}. No interest. No late fees.</p>
                                       @endif
                                   </span>

                               </div>
                           </div>
                            </div>
                        </div>
                    @endif
                </div>

            </div>
        </div>
    </div>

@endsection
@section('course-footer')
    {{--    @include('frontend.courses.course-footer-new')--}}

@endsection
@push('after-scripts')

    <!-- custom js -->
    <script src="{{ asset('iv/assets/rating/js/star-rating.js') }}"></script>
    <script>

        const tabs = document.querySelectorAll('.tabs-details .tab');
        const contents = document.querySelectorAll('.tabs-details .tab-content');

        tabs.forEach(tab => {
            tab.addEventListener('click', () => {

                tabs.forEach(t => t.classList.remove('active'));
                contents.forEach(c => c.classList.remove('active'));


                tab.classList.add('active');
                document.getElementById(`tab-content-${tab.getAttribute('data-tab')}`).classList.add('active');
            });
        });
    </script>
    <script>

        const headers = document.querySelectorAll('.collapse-header');

        headers.forEach(header => {
            header.addEventListener('click', () => {
                const targetId = header.getAttribute('data-target');
                const content = document.getElementById(targetId);


                header.classList.toggle('active');


                content.classList.toggle('active');
            });
        });
    </script>
    <script src="https://cdn.plyr.io/3.6.8/plyr.polyfilled.js"></script>
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
                            $('<a></a>').attr('href', remove_url + data.course_id).append(
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
