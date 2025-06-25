@extends('frontend.layouts.app'.config('theme_layout'))

@section('title', trans('labels.frontend.home.title').' | '.app_name())
@section('meta_description', '')
@section('meta_keywords','')


@push('after-styles')

    <link href="{{ asset('iv') }}/assets/rating/css/star-rating.css" media="all" rel="stylesheet" type="text/css"/>
    <link href="{{ asset('iv') }}/assets/rating/themes/krajee-svg/theme.css" media="all" rel="stylesheet"
          type="text/css"/>

    <link rel="stylesheet" href="{{ asset('iv') }}/css/course_curriculum.css"/>
    <style>
        [data-theme="dark"] .navbar {
            padding: 0 !important;
        }

        /*#meetingSDKElement {*/
        /*    display: none; !* Hidden by default *!*/
        /*    position: fixed; !* Stay in place *!*/
        /*    z-index: 100; !* Sit on top *!*/
        /*    left: 0;*/
        /*    top: 0;*/
        /*    width: 100%; !* Full width *!*/
        /*    height: 100%; !* Full height *!*/
        /*    overflow: auto; !* Enable scroll if needed *!*/
        /*    background-color: rgb(0,0,0); !* Fallback color *!*/
        /*    background-color: rgba(0,0,0,0.4); !* Black w/ opacity *!*/
        /*}*/

        /*.css-zo3rmm{*/
        /*    display: flex;*/
        /*    -webkit-box-pack: center;*/
        /*    justify-content: center;*/
        /*    position: relative;*/
        /*    height: 70vh!important;*/
        /*}*/

        .name-ar {
            width: 25% !important;
            float: right;
        }

        .white-normal {
            white-space: normal;
            line-height: normal;
        }

        .countrySelection {
            width: 50% !important;


        }

        #countrySelection, #gds-cr-one {
            border-radius: 10px;
        }

        .gds-cr-one {
            width: 50% !important;
            float: left;
        }

        .user-avatar-span {
            float: right !important;
            min-width: 65px !important;
        }

        .user-avatar {
            width: 50% !important;
        }

        .nationality {
            border-radius: 30px;
        }
        .two-part{
            display: flex;
            align-items: center;
            justify-content: space-between;
            flex-direction: column
        }
        .list-group.list-group-flush.course-sidebar{
            

        }
    
    </style>

    <link href="{{ asset('plugins/touchpdf-master/jquery.touchPDF.css') }}" rel="stylesheet">
    <style>
        .x-notification {
            margin-top: 30px;
        }

        .zoom_lnk {
            display: flex;
            justify-content: center;
            align-items: center;

            border: 1px solid;
            margin-top: 10px;
            margin-bottom: 10px;
            margin-right: -18px;
            border-radius: 10px;
        }

        .zoom_lnk:hover {


            box-shadow: 0px 2px 8px rgb(0 0 0 / 16%);
            border-color: #7f3846;


            border-width: 5px;
            transition: all 0.2s ease-out;
        }

        .zoom_lnk img {

            position: relative;
            -webkit-animation: glide 2s ease-in-out alternate infinite;
            margin-bottom: 13px;
            box-shadow: 0px 15px 10px -15px
        }

        @-webkit-keyframes glide {
            from {
                left: 0px;
                top: -3px;
            }

            to {
                left: 0px;
                top: 3px;
            }

        }


        .list-body {
            margin: 9px;
            border-radius: 13px;
            background-color: #eeeeee;
            color: #6e0c25 !important;

            padding: 7px;
            width: 100%;

        }

        .color-primary {
            color: #802c41;
        }

        .next {
            width: 47%;
            display: flex;
            /* padding: 10px; */
            border: 1px solid #337ab7;
            border-radius: 26px;
            padding: 10px;
        }

        button.next {
            width: 74%;
            color: white;
            background-color: #802c41
        }

        button.retest {
            width: 30%;
            color: white;
            background-color: #802c41;
            display: flex;
            /* padding: 10px; */
            border: 1px solid #337ab7;
            border-radius: 26px;
            padding: 10px;

        }

        .course-details-category {
            display: flex;
            flex-wrap: wrap;
            flex-direction: column;
            align-content: stretch;
        }

        .options-list li.correct {
            color: green;
        }

        .options-list li.incorrect {
            color: red;
        }

        .options-list li.correct:before {
            content: "\f058";
            /* FontAwesome Unicode */
            font-family: 'FontAwesome';
            display: inline-block;
            color: green;
            @if (session('locale') == 'ar')      margin-right: -2.3em;
            @else       margin-left: -2.3em;
        @endif
      /* same as padding-left set on li */
            width: 1.3em;
            /* same as padding-left set on li */
        }

        .options-list li.incorrect:before {
            content: "\f057";
            /* FontAwesome Unicode */
            font-family: 'FontAwesome';
            display: inline-block;
            color: red;
            @if (session('locale') == 'ar')      margin-right: -2.3em;
            @else       margin-left: -2.3em;
        @endif
      /* same as padding-left set on li */
            width: 1.3em;
            /* same as padding-left set on li */
        }

        .white-normal {
            white-space: normal;
            line-height: normal;
        }
        .progress{
            margin-bottom: 0 !important;
        }
        .course-nav-toggle{
            border: none;
            background: #701e32 !important;
            border-radius: 5px
        }
        .course-nav-toggle i{
            color: #fff
        }
        .navbar.navbar-default.second-nav,
        .course-nav{
            background: #eee;
            
        }
        .course-nav{
            padding: 0;
            margin-bottom: 20px
        }
        .lesson-cards .card{
            padding: 0
        }
    </style>

    <link rel="stylesheet" href="{{ asset('iv') }}/css/course-sidebar-right.css"/>

    <link rel="stylesheet" href="https://code.jquery.com/ui/1.12.1/themes/base/jquery-ui.css">
    <link rel="stylesheet" href="//cdnjs.cloudflare.com/ajax/libs/timepicker/1.3.5/jquery.timepicker.min.css">
    @if (session('locale') == 'en')
        <style>
            .list-group-item, .list-group .card-body {
                margin-right: 10px;
            }

        </style>
    @endif

    <link rel="stylesheet" href="https://cdn.plyr.io/3.5.3/plyr.css"/>
    <link href="{{ asset('plugins/touchpdf-master/jquery.touchPDF.css') }}" rel="stylesheet">
    {{--<link href="{{ asset('css/buttons.css') }}" rel="stylesheet">--}}

    <style>
        .resource-list {
            list-style: none;
            counter-reset: resource-counter;
            padding-left: 0;
        }

        .resource-list li {
            counter-increment: resource-counter;
            color: gray;
            margin-bottom: 5px;
        }

        .resource-list li:before {
            content: counter(resource-counter) ". ";
            color: black; /* Color for the numbers */
        }

        .resource-link {
            color: gray;
            text-decoration: none;
        }

        .resource-link:hover {
            color: #007bff; /* Change to your preferred hover color */
        }
        .noData {
            width: 100%;
            height: 500px;
        }

        .white-normal {
            white-space: normal;
            line-height: normal;
        }

        .next {
            width: 47%;
            display: flex;
            /* padding: 10px; */
            border: 1px solid #337ab7;
            border-radius: 26px;
            padding: 10px;
        }

        button.next {
            width: 74%;
            color: white;
            background-color: #802c41
        }

        button.retest {
            width: 30%;
            color: white;
            background-color: #802c41;
            display: flex;
            /* padding: 10px; */
            border: 1px solid #337ab7;
            border-radius: 26px;
            padding: 10px;

        }

        .course-details-category {
            display: flex;
            flex-wrap: wrap;
            flex-direction: column;
            align-content: stretch;
        }

        .options-list li.correct {
            color: green;
        }

        .options-list li.incorrect {
            color: red;
        }

        .options-list li.correct:before {
            content: "\f058";
            /* FontAwesome Unicode */
            font-family: 'FontAwesome';
            display: inline-block;
            color: green;
            @if (session('locale') == 'ar')      margin-right: -2.3em;
            @else       margin-left: -2.3em;
        @endif
      /* same as padding-left set on li */
            width: 1.3em;
            /* same as padding-left set on li */
        }

        .options-list li.incorrect:before {
            content: "\f057";
            /* FontAwesome Unicode */
            font-family: 'FontAwesome';
            display: inline-block;
            color: red;
            @if (session('locale') == 'ar')      margin-right: -2.3em;
            @else       margin-left: -2.3em;
        @endif
      /* same as padding-left set on li */
            width: 1.3em;
            /* same as padding-left set on li */
        }

        .nested-ul {
            /* border-bottom: 1px solid black; */
            border-radius: 10px;
        }

    </style>
    <style>
        .cicuclum_title {
            border-bottom: 1px gray solid;
            font-size: 18px !important;
            color: #802d42 !important;
            font-weight: 700 !important;
        }

        .cicuclum_li {
            border-bottom: 1px gray solid;

        }

        .complete-btn {
            background-color: #802d42;
            color: white;
            padding: 10px;
            border-radius: 10px;
        }

        .benefit .course-details-item {
            padding: 20px;
        }

    </style>
    <style>
        .rating-container .star {
            display: unset;
        }
        .caption-display {
            position: absolute;
            bottom: 10%;
            width: 75%;
            text-align: center;
            color: white;
            background-color: rgba(0, 0, 0, 0.5);
            padding: 10px;
            font-size: 16px;
            border-radius: 5px;
            display: none;
        }

        .plyr__video-wrapper{
            display: flex;
            justify-content: center;
        }
        .course-single-text{
            clear: both !important;
        }
    </style>
@endpush

@section('content')

    @php
        use App\Models\Question;use Carbon\Carbon;

        $days=0;
        if (count($coursesData) > 0) {
            $course = $coursesData[0]['course'];
        }


        if(count(auth()->user()->courseLoc($course->id)->get())>0){

           $isEndDatePast = Carbon::parse($group->end)->isPast();
            if($isEndDatePast==true){
                $days=0;
            }
            else{
                $days=now()->diffInDays($group->end);
            }
        }



    @endphp

    <section class="row the-slider" id="slider">
        <div style="background-size: cover;height:fit-content;padding-bottom: 20px;">
            <div class="containers">
                <div class="row benefit-notes">
                    <div class="col-sm-12 col-md-12 wow fadeInUp2  course-nav mt-0">
                        <nav class="navbar navbar-default second-nav" style="position: unset">
                            <div class="container">
                                <!--========== Brand and toggle get grouped for better mobile display ==========-->
                                <div class="nav navbar-nav  col-md-6">
                                    <button type="button" onclick="toggleShow()" id="sidebarToggle"
                                            class="Button Button--link course-nav-toggle" aria-live="polite"
                                            aria-label="إخفاء قائمة التنقل بين الدورات"
                                            title="إخفاء قائمة التنقل بين الدورات">
                                        <i class="fa fa-bars" aria-hidden="true"></i>
                                    </button>
                                </div>
                                <div class="nav navbar-nav navbar-left col-md-6"></div>
                                <!--========== Collect the nav links, forms, and other content for toggling ==========-->
                                <div class="pull-right col-md-3 col-xs-6  ">
                                    <div class="progress">
                                        <div class="progress-bar "
                                             id="progress-bar"
                                             style='width:{{ $course->progress($group->id) ? $course->progress($group->id) : 0 }}%'
                                             role="progressbar" aria-valuenow="0" aria-valuemin="0" aria-valuemax="100">
                                            <span style="color:{{$course->progress($group->id)?'white':'#641225'}}"
                                                  class="color">{{ $course->progress($group->id) ? $course->progress($group->id) : 0 }}%</span>
                                        </div>
                                    </div>
                                </div>
                                <div class="pull-right col-md-3 col-xs-6 mb-10 ">
{{--                                    @if($days>0)--}}
{{--                                        @include('frontend.courses.remaining_days')--}}
{{--                                    @endif--}}

                                </div>
                            </div>
                        </nav>
                    </div>
                    <!--========== /.container-fluid ==========-->

                    <div class="top-banner"></div>
                </div>
                <!-- ===========course details part1============ -->

                <!--==========course description right==========-->
                <div class="row">
                    <div class="container">
                        <div class="successMessage">
                            @include('includes.partials.messages')
                        </div>
                        <!--/*========== course description right ==========-->
                        <div class="row justify-content-between align-items-center two-part">
                        <div class="col-sm-12 col-md-12 benefit wow fadeInUp ptb-50 course-content mt-0"
                             id="sidebar-right">
                            @include('frontend.courses.course_curr_sidebar_right')
                        </div>
                        <!--========== course description details ==========-->
                        <div class="col-sm-12 col-md-12 benefit wow fadeInUp ptb-50 course-content mt-0"
                             id="textContent">
                            <!--==========Step1==========-->
                            <div class="curriclum-content lesson-cards" id="step1">

                                <div class="card">
                                    <div class="card-header bbb" id="headingOne">
                                        <h5 class="mb-0">

                                            @include('frontend.courses.course_chat')
                                        </h5>
                                    </div>

                                </div>


                            </div>
                            <!--==========Step2==========-->
                            <div class="curriclum-content lesson-cards" style="padding: 10px; display:none;" id="step2">
                                @if(count($rates)>0)

                                    <h3 style="border: 1px solid #88ceb9;
                                      padding: 10px;
                                      border-radius: 10px;color: #783141;"> @lang('labels.frontend.course.ratings')</h3>
                                    <hr>
                                    <div class="rates content">
                                        {{ html()->form('POST', route('admin.answerEvaluate.store'))->id('rate-create')->class('form-horizontal')->acceptsFiles()->open() }}

                                        <div id="accordion">
                                            <input type="hidden" name="form_type" value="rate" id="">

                                            @foreach ($rates as $rate)
                                                <input type="hidden" name="form_ids[]" value="{{ $rate->id }}">
                                                <input type="hidden" name="course_id" value="{{ $course->id }}">
                                                <input type="hidden" name="group_id" value="{{ $group->id }}">
                                               @foreach($rate->divisions as $division)
                                                   @if($division->published)
                                                        <input type="hidden" name="division_ids[]" value="{{ $division->id }}">
                                                        <div class="card0">
                                                            @php
                                                                $quest_count = 0;

                                                               $userAnswers = $division->questions->map(function ($question) use ($division, $group) {
                                                                    return $question->answers->where('user_id', \Auth::id())->where('group_id', $group->id)->first();
                                                                });


                                                            @endphp
                                                            @if ($userAnswers->filter()->count() > 0)
                                                                <div>

                                                                    <p class="evaluated">@lang('buttons.general.crud.evaluated')
                                                                        <i class="fa fa-check-circle"></i></p>
                                                                </div>
                                                            @endif
                                                            <div class="card-header0" id="heading{{ $rate->id }}"
                                                                 style="padding: 9px; border: 1px solid #88ceb9; border-radius: 10px; margin-bottom: 10px;">
                                                                <h5 style="color: #4f198d  !important;  font-weight: bold !important;"
                                                                    class="mb-0 card-body">
                                                                    @if (Lang::locale() == 'en')
                                                                        {{ $division->title }}
                                                                        @lang('labels.backend.rates.rate')

                                                                    @else
                                                                        @lang('labels.backend.rates.rate')
                                                                        {{ $division->title_ar }}

                                                                    @endif
                                                                </h5>
                                                            </div>


                                                            <div id="collapse{{ $rate->id }}" class=" show"
                                                                 aria-labelledby="headingOne" data-parent="#accordion">
                                                                <div class="card-body">

                                                                    <ol type="A">
                                                                        @foreach ($division->questions as $Mainkey => $question)
                                                                            @php
                                                                                $quest_count++;

                                                                            @endphp

                                                                            <input type="hidden" name="questions[]"
                                                                                   value="{{ $question->id }}">
                                                                            <li style="color: black !important; font-weight:
                                                                        bold !important;">
                                                                                <p style="color: black !important;
                                                                        font-weight: bold !important;">
                                                                                    @if (Lang::locale() == 'en')
                                                                                        {{ $question->question }}
                                                                                    @else
                                                                                        {{ $question->question_ar ? $question->question_ar : $question->question }}

                                                                                    @endif
                                                                                </p>


                                                                                @if ($question->question_type == 'radio')
                                                                                    @php
                                                                                        if($userAnswers->filter()->count() >0)
                                                                                        $quest_answer=$userAnswers->where('question_id',$question->id)->first();
                                                                                        else
                                                                                        $quest_answer=[];
                                                                                    @endphp
                                                                                    <div
                                                                                            style="direction: ltr;display: inline-block;width: 100%">
                                                                                        <input name="{{ $question->id }}-options"
                                                                                               id="kartik" class="rating"
                                                                                               data-stars="5" data-step="0.1"
                                                                                               title=""
                                                                                               data-rtl=1
                                                                                               value="{{$quest_answer?$quest_answer->answer:0}}"/>
                                                                                    </div>
                                                                                @else

                                                                                    {{--                                                                            <textarea name="{{ $question->id }}-options"--}}
                                                                                    {{--                                                                                      id="" cols="50"--}}
                                                                                    {{--                                                                                      rows="2"></textarea>--}}

                                                                                    <br/>
                                                                                    <ul class="options-list pl-4">


                                                                                        @if (sizeof($question->options) && $question->question_type == 'multiple_choice')
                                                                                            @foreach ($question->options as $option)

                                                                                                <div class="radio">
                                                                                                    <label>
                                                                                                        <input type="radio"
                                                                                                               name="{{ $question->id }}-options"
                                                                                                               value="{{ $option->id }}"/>
                                                                                                        {{ Lang::locale() == 'en' ? $option->option_text : $option->option_text_ar }}
                                                                                                        <br/>
                                                                                                        <br/>
                                                                                                    </label>
                                                                                                </div>
                                                                                            @endforeach
                                                                                        @elseif (sizeof($question->options) &&
                                                                                            $question->question_type=="drop_down")
                                                                                            <select name="{{ $question->id }}-options"
                                                                                                    class="form-control">
                                                                                                @foreach ($question->options as $option)
                                                                                                    <option @if (($option->answered(@$data['test_exists']->id) != null && $option->answered(@$data['test_exists']->id) == 1) || $option->correct == true)  selected
                                                                                                            @endif
                                                                                                            value="{{ $option->id }}">
                                                                                                        {{ Lang::locale() == 'en' ? $option->option_text : $option->option_text_ar }}
                                                                                                        <br/>

                                                                                                    </option>
                                                                                                @endforeach
                                                                                            </select>
                                                                                        @else
                                                                                            @switch($question->question_type)
                                                                                                @case("paragraph")
                                                                                                    <textarea type="text"
                                                                                                              class="form-control editor"
                                                                                                              placeholder="paragraph"
                                                                                                              style="height:100px"
                                                                                                              name="{{ $question->id }}-options">{{ @test_res($data['test_exists']->id, $question->id)->option_id }}</textarea>
                                                                                                    @break
                                                                                                @case("short_answer")
                                                                                                    <input type="text"
                                                                                                           class="form-control"
                                                                                                           value="{{ @test_res($data['test_exists']->id, $question->id)->option_id }}"
                                                                                                           placeholder="@lang('labels.backend.questions.fields.short_answer')"
                                                                                                           name="{{ $question->id }}-options"/>
                                                                                                    @break
                                                                                                @case("date")
                                                                                                    <input type="text"
                                                                                                           class="form-control datepicker"
                                                                                                           value="{{ @test_res($data['test_exists']->id, $question->id)->option_id }}"
                                                                                                           placeholder="date"
                                                                                                           name="{{ $question->id }}-options"/>
                                                                                                    @break
                                                                                                @case("time")
                                                                                                    <input type="text"
                                                                                                           class="form-control timepicker"
                                                                                                           value="{{ @test_res($data['test_exists']->id, $question->id)->option_id }}"
                                                                                                           placeholder="time"
                                                                                                           name="{{ $question->id }}-options"/>
                                                                                                    @break
                                                                                                @case("file_upload")
                                                                                                    <div style="margin-top: 20px">
                                                                                                        <label>
                                                                                                            @lang('labels.frontend.course.or_upload')</label>
                                                                                                        <input type="file"
                                                                                                               name="answer_file_{{ $question->id }}">
                                                                                                        <p>{!! get_test_file(auth()->id(), $question->id) !!} </p>
                                                                                                    </div>
                                                                                                    @break
                                                                                            @endswitch
                                                                                        @endif
                                                                                    </ul>
                                                                                    <br/>
                                                                                @endif

                                                                            </li>
                                                                        @endforeach
                                                                    </ol>
                                                                </div>
                                                            </div>
                                                        </div>
                                                   @endif
                                                    <hr>
                                                @endforeach
                                            @endforeach

                                            @if (count($rates) > 0)
                                                @php

                                                    $isAnyQuestionAnswered = $rates->flatMap->divisions->flatMap->questions->contains(function($question) use ($group) {
                                                        return $question->answers->where('user_id', auth()->id())
                                                        ->where('group_id', $group->id)->count() > 0;
                                                     });
                                                @endphp
                                                @if (!$isAnyQuestionAnswered)
                                                <div class="form-group row justify-content-center"
                                                         style="margin-top: 20px;margin-left: 16%;">
                                                        <div class="col-4">
                                                            <button class="btn btn-success"
                                                                    style="background-color: #6e0c25;"
                                                                    type="submit">{{ __('buttons.general.crud.send') }}</button>
                                                        </div>
                                                    </div>
                                                    <!--col-->
                                                @endif
                                            @else
                                                <div class="form-group row">
                                                    <div class="col-12" style="text-align: center">
                                                        <h3>@lang('labels.general.no_data_available')</h3>
                                                    </div>
                                                </div>
                                            @endif
                                        </div>

                                        {{ html()->form()->close() }}

                                    </div>

                                @else
                                    <div class="card">
                                        <div class="card-header" id="headingOne">
                                            <h5 class="mb-0">

                                                @lang('labels.general.no_data_available')
                                            </h5>
                                        </div>

                                    </div>
                                @endif

                            </div>
                        </div>
                    </div>
                        <!--========== lesson video step ==========-->
                        <div class="col-sm-12 col-md-9 benefit wow fadeInUp ptb-50 course-content mt-0"
                             style="" id="accordionParent">
                            @foreach($coursesData as $data)

                                @if(isset($data['lesson']->zoom_link))
                                    <div id="meetingSDKElement-{{ $data['lesson']->id }}" class="meetingSDKElement">

                                    </div>

                                @endif

                                <div id="collapse-video-{{ $data['lesson']->id }}" class="collapse-lesson-video container
                            collapsed collapsed collapse" data-parent="#accordionParent"
                                     style="width: 100%;padding-right: 29px;">
                                    <div class="row main-content" style="margin-left: unset">
                                        <div class=" col-sm-12 col-md-10" style="width: 100%">
                                            @if (session()->has('success'))
                                                <div class="alert alert-dismissable alert-success fade show">
                                                    <button type="button" class="close"
                                                            data-dismiss="alert">&times;
                                                    </button>
                                                    {{ session('success') }}
                                                </div>
                                            @endif

                                            @if($errors->any())
                                                <div class="alert alert-danger">
                                                    <ul class="list-inline list-style-none">
                                                        <li>{{$errors->first()}}</li>
                                                    </ul>
                                                </div>
                                            @endif
                                            <div class="course-single-text">
                                                <div class="course-title mt10 headline relative-position"
                                                     style="display: flex; flex-direction: row; flex-wrap: nowrap; align-items: center; justify-content: space-between;">
                                                    <h3 style="margin: 30px 0; color: #4f198d  !important;  font-weight: bold !important;">
                                                        <b>
                                                            @if (session('locale') == 'ar')
                                                                {{ $data['lesson']->title_ar }}
                                                            @else
                                                                {{ $data['lesson']->title }}
                                                            @endif
                                                        </b>
                                                    </h3>


                                                    @php
                                                        $lesson_time = $group->courseLessons()->where('lesson_id', $data['lesson']->id)->first();
                                                    @endphp

                                                        <div class="course-details-content">
                                                            <div style="display: flex;align-items: center;">
                                                                @if($lesson_time && $lesson_time->pivot->start_time && $lesson_time->pivot->end_time)
                                                                    <p style="{{ (app()->getLocale() == 'ar') ?  'padding-left:1.5rem' : 'padding-right:1.5rem' }}; margin: 0;height: fit-content;">
                                                                        <i class="fa fa-calendar"></i>
                                                                        {{ $lesson_time->pivot->date }}
                                                                    </p>
                                                                    <p style="margin: 0;height: fit-content;">
                                                                        @php
                                                                            $dateTime = new \DateTime($lesson_time->pivot->start_time);
                                                                        @endphp
                                                                        <i class="fa fa-clock"></i>
                                                                        {{ $dateTime->format('h:i A') }}
                                                                    </p>
                                                                @endif
                                                                @if($course->type_id != 1)
                                                                    <!-- Present Icon with hover label -->
                                                                    <i class="fas fa-check btn btn-success" onclick="markAsPresent({{ $data['lesson']->id }}, {{ auth()->user()->id }})" style="cursor:pointer; margin-right: 10px;padding: 5px 10px;border-radius: 9px;" title="Mark as Present"></i>
                                                                    <!-- Finished Icon with hover label -->
                                                                    <i class="fas fa-flag btn btn-primary" onclick="markAsFinished({{ $data['lesson']->id }}, {{ auth()->user()->id }})" style="cursor:pointer; margin-right: 10px;padding: 5px 10px;border-radius: 9px;" title="Mark as Finished"></i>
                                                                @endif
                                                            </div>
                                                        </div>

                                                </div>
                                                <hr>
                                            </div>

                                            <div class="course-details-item border-bottom-0 mb-0">
                                                @if ($data['lesson']->lesson_image != '')
                                                    <div class="course-single-pic mb30">
                                                        <img style="    width: 100%;
                                                        height: 300px;
                                                        object-fit: contain;
                                                        margin-bottom: 10px;"
                                                             src="{{ asset('storage/uploads/' . $data['lesson']->lesson_image) }}"
                                                             alt="">
                                                    </div>
                                                @endif

                                                @if ($data['lesson']->mediaVideo && $data['lesson']->mediavideo->count() > 0)
                                                    <div class="course-single-text">
                                                        @if ($data['lesson']->mediavideo != '')
                                                            <div class="course-details-content mt-3">
                                                                <div class="video-container mb-5"
                                                                     data-id="{{ $data['lesson']->mediavideo->id }}">
                                                                    @if ($data['lesson']->mediavideo->type == 'youtube')
                                                                        <div id="player-{{$data['lesson']->id}}" class="js-player"
                                                                             data-plyr-provider="youtube"
                                                                             data-plyr-embed-id="{{ $data['lesson']->mediavideo->file_name }}">

                                                                        </div>
                                                                    @elseif($data['lesson']->mediavideo->type == 'vimeo')
                                                                        <div id="player-{{$data['lesson']->id}}" class="js-player"
                                                                             data-plyr-provider="vimeo"
                                                                             data-plyr-embed-id="{{ $data['lesson']->mediavideo->file_name }}">
                                                                        </div>
                                                                    @elseif($data['lesson']->mediavideo->type == 'upload')

                                                                        <video poster="" id="player-{{$data['lesson']->id}}" class="js-player"
                                                                               playsinline controls>
                                                                            <source src="{{ $data['lesson']->mediavideo->url }}"
                                                                                    type="video/mp4"/>
                                                                        </video>
                                                                    @elseif($data['lesson']->mediavideo->type == 'embed')
                                                                        {!! $data['lesson']->mediavideo->url !!}
                                                                    @elseif($data['lesson']->mediavideo->type == 'zoom')
                                                                        <a style="padding:10px;color:#701f33"
                                                                           target="_blank"
                                                                           href="{{$data['lesson']->mediavideo->url}}"
                                                                           class="zoom_lnk">
                                                                            @lang('labels.backend.lessons.fields.zoom_video')
                                                                        </a>
                                                                    @endif
                                                                </div>
                                                            </div>
                                                        @endif
                                                    </div>
                                                @endif

                                                @if ($data['lesson']->mediaAudio)
                                                    <div class="course-single-text mb-5">
                                                        <audio id="audioPlayer" controls>
                                                            <source src="{{ $data['lesson']->mediaAudio->url }}"
                                                                    type="audio/mp3"/>
                                                        </audio>
                                                    </div>
                                                @endif

                                                <div class="course-single-text" style="margin: 14px">
                                                    <div class="course-details-content">
                                                        @if (session('locale') == 'ar')
                                                            {!! $data['lesson']->full_text_ar ?? $data['lesson']->full_text !!}
                                                        @else
                                                            {!! $data['lesson']->full_text !!}
                                                        @endif
                                                    </div>

                                                </div>
                                                @if(isset($data['lesson']->zoom_link))

                                                    <hr>
                                                    <div class="course-details-item border-bottom-0 mb-0 col-lg-12 ">
                                                        <h3 style="margin-bottom: 17px; color: #4f198d  !important;  font-weight: bold !important;">
                                                            @lang('labels.backend.lessons.fields.zoom_link')</h3>
                                                        {{--                                                        <div id="meetingSDKElement-{{ $data['lesson']->id }}">--}}
                                                        {{--                                                            <div id="meetingSDKElement-content">--}}
                                                        {{--                                                                <!-- Zoom meeting will be initialized here -->--}}
                                                        {{--                                                            </div>--}}
                                                        {{--                                                        </div>--}}
                                                        <a href="#zoom-{{ $data['lesson']->id }}"
                                                           id="zoom-btn-{{ $data['lesson']->id }}"
                                                           class="zoom_lnk">
                                                            <img style="width: 36%" src="{{asset('images/zoom-1.png')}}"
                                                                 alt="">
                                                        </a>

                                                    </div>

                                                @endif
                                                @if ($data['lesson']->mediaPDF)

                                                    <div class="course-single-text mb-5">
                                                        <iframe
                                                                src="{{ asset('storage/uploads/' . $data['lesson']->mediaPDF->name . '#toolbar=0') }}"
                                                                width="100%" height="500px">
                                                        </iframe>
                                                        <div id="myPDF"></div>
                                                    </div>

                                                @endif

                                                @if ($data['lesson']->downloadableMedia != '' && $data['lesson']->downloadableMedia->count() > 0)
                                                    <div class="course-single-text mt-4 px-3 py-1">
                                                        <div class="course-title mt10 headline relative-position">
                                                            <h4>
                                                                @lang('labels.frontend.course.download_files')
                                                            </h4>
                                                        </div>
                                                        @php
                                                            $lessonType=get_class($data['lesson']);
                                                        @endphp
                                                        @foreach ($data['lesson']->downloadableMedia as $media)
                                                            <div class="course-details-content">
                                                                <p class="form-group">
                                                                    @if($lessonType=='App\Models\Lesson')
                                                                        <a href="{{ route('download', ['filename' => $media->name, 'lesson' => $data['lesson']->id]) }}"
                                                                           class="font-weight-bold"><i
                                                                                    class="fa fa-download"></i>
                                                                            {{ $media->name }}
                                                                            ({{ number_format((float) $media->size / 1024, 2, '.', '') }}
                                                                            @lang('labels.frontend.course.mb')
                                                                            )</a>
                                                                    @else
                                                                        <a href="{{ route('download', ['filename' => $media->name, 'test' => $data['lesson']->id]) }}"
                                                                           class="font-weight-bold"><i
                                                                                    class="fa fa-download"></i>
                                                                            {{ $media->name }}
                                                                            ({{ number_format((float) $media->size / 1024, 2, '.', '') }}
                                                                            @lang('labels.frontend.course.mb')
                                                                            )</a>
                                                                    @endif
                                                                </p>
                                                            </div>
                                                        @endforeach
                                                    </div>
                                                @endif

                                                @if($data['lesson']->resources && $data['lesson']->resources->count() > 0)
                                                    <div class="course-single-text mt-4 px-3 py-1">
                                                        <div class="course-title mt10 headline relative-position">
                                                            <h4>
                                                                @lang('labels.frontend.course.resources')
                                                            </h4>
                                                        </div>
                                                        <div class="course-details-content my-2">
                                                            <ul class="resource-list">
                                                                @foreach ($data['lesson']->resources as $resource)
                                                                    <li>
                                                                        <a href="{{ $resource->link }}" target="_blank"
                                                                           class="resource-link">
                                                                            {{ $resource->link }}
                                                                        </a>
                                                                    </li>
                                                                @endforeach
                                                            </ul>
                                                        </div>
                                                    </div>
                                                @endif

                                                {{--                                                @if ($data['test_exists'])--}}

                                                {{--                                                    <hr/>--}}
                                                {{--                                                    @if (!is_null($data['test_exists']))--}}

                                                {{--                                                        <div class="alert alert-info">--}}
                                                {{--                                                            @lang('labels.frontend.course.your_test_score') :--}}
                                                {{--                                                            {{ $data['test_exists']->test_result }}</div>--}}

                                                {{--                                                        @if (count($data['lesson']->questions) > 0)--}}
                                                {{--                                                            <hr>--}}

                                                {{--                                                            @foreach ($data['lesson']->questions as $question)--}}
                                                {{--                                                                <h3 class="color-primary text-color" style="margin-bottom: 35px;">--}}

                                                {{--                                                                    {{Lang::locale()=='en'?$question->title:$question->title_ar}}--}}
                                                {{--                                                                </h3>--}}
                                                {{--                                                                <h4 class="mb-0">{{ $loop->iteration }}--}}
                                                {{--                                                                    {!! Lang::locale()=='ar'?$question->question_ar:$question->question !!}--}}
                                                {{--                                                                    @if (!$question->isAttempted($data['test_exists']->id))--}}
                                                {{--                                                                        <small class="badge badge-danger">--}}
                                                {{--                                                                            @lang('labels.frontend.course.not_attempted')</small>--}}
                                                {{--                                                                    @endif--}}
                                                {{--                                                                </h4>--}}
                                                {{--                                                                <br/>--}}
                                                {{--                                                                <ul class="options-list pl-4">--}}


                                                {{--                                                                    @if (sizeof($question->options) && $question->question_type == 'multiple_choice')--}}
                                                {{--                                                                        @foreach ($question->options as $option)--}}

                                                {{--                                                                            <li class="@if (($option->answered($data['test_exists']->id) != null && $option->answered($data['test_exists']->id) == 1) || $option->correct == true) correct @elseif($option->answered($data['test_exists']->id) != null && $option->answered($data['test_exists']->id) == 2) incorrect  @endif">--}}
                                                {{--                                                                                {{ Lang::locale()=='en'?$option->option_text: $option->option_text_ar}}--}}

                                                {{--                                                                                @if ($option->correct == 1 && $option->explanation != null)--}}
                                                {{--                                                                                    <p class="text-dark"--}}
                                                {{--                                                                                       style="color:#802c41 !important">--}}
                                                {{--                                                                                        <b>@lang('labels.frontend.course.explanation')</b><br>--}}
                                                {{--                                                                                        {{ $option->explanation }}--}}
                                                {{--                                                                                    </p>--}}
                                                {{--                                                                                @endif--}}
                                                {{--                                                                            </li>--}}

                                                {{--                                                                        @endforeach--}}
                                                {{--                                                                    @elseif (sizeof($question->options) &&--}}
                                                {{--                                                                        $question->question_type=="drop_down")--}}
                                                {{--                                                                        <select name="questions[{{ $question->id }}]"--}}
                                                {{--                                                                                class="form-control">--}}
                                                {{--                                                                            @foreach ($question->options as $option)--}}
                                                {{--                                                                                <option @if (($option->answered($data['test_exists']->id) != null && $option->answered($data['test_exists']->id) == 1) || $option->correct == true)  selected--}}
                                                {{--                                                                                        @endif--}}
                                                {{--                                                                                        value="{{ $option->id }}">--}}
                                                {{--                                                                                    {{ Lang::locale()=='en'?$option->option_text:$option->option_text_ar }}--}}
                                                {{--                                                                                </option>--}}
                                                {{--                                                                            @endforeach--}}
                                                {{--                                                                        </select>--}}
                                                {{--                                                                    @else--}}

                                                {{--                                                                        @switch($question->question_type)--}}
                                                {{--                                                                            @case("paragraph")--}}

                                                {{--                                                                                <textarea type="text"--}}
                                                {{--                                                                                          class="form-control editor"--}}
                                                {{--                                                                                          placeholder="paragraph"--}}
                                                {{--                                                                                          style="height:100px"--}}
                                                {{--                                                                                          name="questions[{{ $question->id }}]">{{ @test_res($data['test_exists']->id, $question->id)->option_id }}</textarea>--}}
                                                {{--                                                                                @break--}}
                                                {{--                                                                            @case("short_answer")--}}
                                                {{--                                                                                <input type="text" class="form-control"--}}
                                                {{--                                                                                       value="{{ @test_res($data['test_exists']->id, $question->id)->option_id }}"--}}
                                                {{--                                                                                       placeholder="short_answer"--}}
                                                {{--                                                                                       name="questions[{{ $question->id }}]"/>--}}
                                                {{--                                                                                @break--}}
                                                {{--                                                                            @case("date")--}}
                                                {{--                                                                                <input type="text"--}}
                                                {{--                                                                                       class="form-control datepicker"--}}
                                                {{--                                                                                       value="{{ @test_res($data['test_exists']->id, $question->id)->option_id }}"--}}
                                                {{--                                                                                       placeholder="date"--}}
                                                {{--                                                                                       name="questions[{{ $question->id }}]"/>--}}
                                                {{--                                                                                @break--}}
                                                {{--                                                                            @case("time")--}}
                                                {{--                                                                                <input type="text"--}}
                                                {{--                                                                                       class="form-control timepicker"--}}
                                                {{--                                                                                       value="{{ @test_res($data['test_exists']->id, $question->id)->option_id }}"--}}
                                                {{--                                                                                       placeholder="time"--}}
                                                {{--                                                                                       name="questions[{{ $question->id }}]"/>--}}
                                                {{--                                                                                @break--}}
                                                {{--                                                                            @case("file_upload")--}}
                                                {{--                                                                                <div style="margin-top: 20px">--}}
                                                {{--                                                                                    <label>--}}
                                                {{--                                                                                        @lang('labels.frontend.course.or_upload')</label>--}}
                                                {{--                                                                                    <input type="file"--}}
                                                {{--                                                                                           name="answer_file_{{ $question->id }}">--}}
                                                {{--                                                                                    <p>{!! get_test_file(auth()->id(), $question->id) !!} </p>--}}
                                                {{--                                                                                </div>--}}
                                                {{--                                                                                @break--}}
                                                {{--                                                                        @endswitch--}}

                                                {{--                                                                        <p class=" warning  ">@if (!empty(test_res($data['test_exists']->id, $question->id)->option_id))--}}
                                                {{--                                                                                @lang('labels.frontend.course.will_be_revied')--}}
                                                {{--                                                                            @endif</p>--}}

                                                {{--                                                                    @endif--}}


                                                {{--                                                                </ul>--}}
                                                {{--                                                                <br/>--}}
                                                {{--                                                            @endforeach--}}
                                                {{--                                                            @if (config('retest'))--}}
                                                {{--                                                                <div class="row main-content"--}}
                                                {{--                                                                     style="margin-bottom: 60px;">--}}
                                                {{--                                                                    <div class="col-4 offset-4"--}}
                                                {{--                                                                         style="margin-right: 30%;">--}}
                                                {{--                                                                        <form action="{{ route('lessons.retest', [$data['test_exists']->test->slug]) }}"--}}
                                                {{--                                                                              method="post">--}}
                                                {{--                                                                            <form--}}
                                                {{--                                                                                    action="{{ route('lessons.retest', [$data['test_exists']->test->first()->test->slug]) }}"--}}
                                                {{--                                                                                    action="{{ route('lessons.retest', [$data['test_exists']->test->test->slug]) }}"--}}

                                                {{--                                                                                    method="post">--}}

                                                {{--                                                                                @csrf--}}
                                                {{--                                                                                <input type="hidden" name="result_id"--}}
                                                {{--                                                                                       value="{{ $data['test_exists']->id }}">--}}

                                                {{--                                                                                <button class="retest next-button"--}}
                                                {{--                                                                                        role="button"--}}
                                                {{--                                                                                        style="justify-content: center;">--}}
                                                {{--                                                                                <span>--}}
                                                {{--                                                                                    @lang('labels.frontend.course.give_test_again')--}}
                                                {{--                                                                                </span>--}}
                                                {{--                                                                                    <div class="icon">--}}
                                                {{--                                                                                        <i class="fa fa-repeat"></i>--}}
                                                {{--                                                                                        <i class="fa fa-check"></i>--}}
                                                {{--                                                                                    </div>--}}
                                                {{--                                                                                </button>--}}


                                                {{--                                                                            </form>--}}
                                                {{--                                                                        </form>--}}
                                                {{--                                                                    </div>--}}
                                                {{--                                                                </div>--}}
                                                {{--                                                                <div class="clear"></div>--}}
                                                {{--                                                            @endif--}}
                                                {{--                                                        @else--}}
                                                {{--                                                            <h3>@lang('labels.general.no_data_available')</h3>--}}
                                                {{--                                                        @endif--}}
                                                {{--                                                    @else--}}
                                                {{--                                                        <div class="test-form">--}}
                                                {{--                                                            @if (count($data['lesson']->questions) > 0)--}}
                                                {{--                                                                <form action="{{ route('lessons.test', [$data['lesson']->slug]) }}"--}}
                                                {{--                                                                      method="post" enctype="multipart/form-data">--}}
                                                {{--                                                                    {{ csrf_field() }}--}}
                                                {{--                                                                    @foreach ($data['lesson']->questions as $question)--}}
                                                {{--                                                                        <h3 class="color-primary text-color"--}}
                                                {{--                                                                            style="margin-bottom: 35px;">--}}

                                                {{--                                                                            {{Lang::locale()=='en'?$question->title:$question->title_ar}}--}}
                                                {{--                                                                        </h3>--}}
                                                {{--                                                                        <h4 class="mb-0">{{ $loop->iteration }}.--}}
                                                {{--                                                                            {!! Lang::locale()=='ar'?$question->question_ar:$question->question !!} </h4>--}}
                                                {{--                                                                        <br/>--}}
                                                {{--                                                                        @if (sizeof($question->options) && $question->question_type == 'multiple_choice')--}}
                                                {{--                                                                            @foreach ($question->options as $option)--}}
                                                {{--                                                                                <div class="radio">--}}
                                                {{--                                                                                    <label>--}}
                                                {{--                                                                                        <input type="radio"--}}
                                                {{--                                                                                               name="questions[{{ $question->id }}]"--}}
                                                {{--                                                                                               value="{{ $option->id }}"/>--}}
                                                {{--                                                                                        {{ Lang::locale()=='en'?$option->option_text:$option->option_text_ar }}--}}
                                                {{--                                                                                        <br/>--}}
                                                {{--                                                                                    </label>--}}
                                                {{--                                                                                </div>--}}
                                                {{--                                                                            @endforeach--}}
                                                {{--                                                                            <hr>--}}
                                                {{--                                                                        @elseif (sizeof($question->options) &&--}}
                                                {{--                                                                            $question->question_type=="drop_down")--}}
                                                {{--                                                                            <select name="questions[{{ $question->id }}]"--}}
                                                {{--                                                                                    class="form-control"--}}
                                                {{--                                                                                    style="padding: 7px 18px"--}}
                                                {{--                                                                                    style="padding: 7px 18px"--}}
                                                {{--                                                                            >--}}
                                                {{--                                                                                @foreach ($question->options as $option)--}}
                                                {{--                                                                                    <option value="{{ $option->id }}">--}}
                                                {{--                                                                                        {{ Lang::locale()=='en'?$option->option_text:$option->option_text_ar }}--}}

                                                {{--                                                                                    </option>--}}
                                                {{--                                                                                @endforeach--}}
                                                {{--                                                                            </select>--}}
                                                {{--                                                                            <hr>--}}

                                                {{--                                                                        @else--}}
                                                {{--                                                                            @switch($question->question_type)--}}
                                                {{--                                                                                @case("paragraph")--}}
                                                {{--                                                                                    <textarea type="text"--}}
                                                {{--                                                                                              class="form-control editor"--}}
                                                {{--                                                                                              placeholder="paragraph"--}}
                                                {{--                                                                                              style="height:100px"--}}
                                                {{--                                                                                              name="questions[{{ $question->id }}]"></textarea>--}}
                                                {{--                                                                                    <hr>--}}
                                                {{--                                                                                    @break--}}

                                                {{--                                                                                @case("short_answer")--}}
                                                {{--                                                                                    <input type="text"--}}
                                                {{--                                                                                           class="form-control"--}}
                                                {{--                                                                                           placeholder="short_answer"--}}
                                                {{--                                                                                           name="questions[{{ $question->id }}]"/>--}}
                                                {{--                                                                                    <hr>--}}
                                                {{--                                                                                    @break--}}

                                                {{--                                                                                @case("date")--}}
                                                {{--                                                                                    <input type="text"--}}
                                                {{--                                                                                           class="form-control datepicker"--}}
                                                {{--                                                                                           placeholder="date"--}}
                                                {{--                                                                                           name="questions[{{ $question->id }}]"/>--}}
                                                {{--                                                                                    <hr>--}}
                                                {{--                                                                                    @break--}}
                                                {{--                                                                                @case("time")--}}
                                                {{--                                                                                    <input type="text"--}}
                                                {{--                                                                                           class="form-control timepicker"--}}
                                                {{--                                                                                           placeholder="time"--}}
                                                {{--                                                                                           name="questions[{{ $question->id }}]"/>--}}
                                                {{--                                                                                    <hr>--}}
                                                {{--                                                                                    @break--}}
                                                {{--                                                                                @case("file_upload")--}}
                                                {{--                                                                                    <div style="margin-top: 20px">--}}
                                                {{--                                                                                        <label>--}}
                                                {{--                                                                                            @lang('labels.frontend.course.or_upload')</label>--}}
                                                {{--                                                                                        <input type="file"--}}
                                                {{--                                                                                               name="answer_file_{{ $question->id }}">--}}
                                                {{--                                                                                    </div>--}}
                                                {{--                                                                                    <hr>--}}
                                                {{--                                                                                    @break--}}
                                                {{--                                                                            @endswitch--}}
                                                {{--                                                                        @endif--}}
                                                {{--                                                                        <br/>--}}
                                                {{--                                                                    @endforeach--}}


                                                {{--                                                                    <div--}}
                                                {{--                                                                            style="position: relative;width: 300px;margin: auto;margin-bottom: 90px">--}}
                                                {{--                                                                        <button style="height: 60px;            box-shadow: 5px 4px #cac5c5;--}}
                                                {{--                                                                                    height: 60px;--}}
                                                {{--                                                                                    border-radius: 10px;--}}
                                                {{--                                                                                    color: white;--}}
                                                {{--                                                                                    border-color: white;--}}
                                                {{--                                                                                    background-color: #4f198d;"--}}
                                                {{--                                                                                class="next-button result-btn "--}}
                                                {{--                                                                                role="button">--}}
                                                {{--                                                                            <span>--}}
                                                {{--                                                                                @lang('labels.frontend.course.submit_results')--}}
                                                {{--                                                                            </span>--}}
                                                {{--                                                                            <div class="icon">--}}
                                                {{--                                                                                <i class="fa fa-save"></i>--}}
                                                {{--                                                                                <i class="fa fa-check"></i>--}}
                                                {{--                                                                            </div>--}}
                                                {{--                                                                        </button>--}}
                                                {{--                                                                    </div>--}}


                                                {{--                                                                </form>--}}
                                                {{--                                                            @else--}}
                                                {{--                                                                <h3>@lang('labels.general.no_data_available')</h3>--}}

                                                {{--                                                            @endif--}}
                                                {{--                                                        </div>--}}
                                                {{--                                                    @endif--}}
                                                {{--                                                @endif--}}

                                                <hr>
                                                <div class="course-details-category ul-li col-lg-12"
                                                     style="margin-top: 30px">
                                                    <div class="row main-content">

                                                        <div class="col-md-4" style="height: 64px">
                                                            @if ($data['previous_lesson'] && isset($data['previous_lesson']->model->slug))

                                                                <a class="next-button previous"
                                                                   style="justify-content: center; display:flex;
                                                                   flex-direction: row-reverse; gap:10px"
                                                                   href="#previousVideo"
                                                                   role="button">
                                                                    <span> @lang('labels.frontend.course.prev') </span>
                                                                    <div class="icon">
                                                                        <i class="fa fa-chevron-right"></i>
{{--                                                                        <i class="fa fa-check"></i>--}}
                                                                    </div>
                                                                </a>
                                                            @endif
                                                        </div>
                                                        <div class="col-md-4">
                                                            @if (!$data['lesson']->isCompleted($group->id))
                                                                @if ($data['lesson']->isCompleted($group->id) == false)

                                                                    <a href="#nextVideo"
                                                                       class="next-button complete-btn next"
                                                                       style="justify-content: center;width:85%;
                                                                       gap:10px"
                                                                       id="complete-btn-{{ $data['lesson']->id }}"
                                                                       @if (!$data['lesson']->isCompleted($group->id)) onclick='courseCompleted("{{ $data['lesson']->id }}", "{{ get_class($data['lesson']) }}")'
                                                                       @endif role="button">
                                                                        <span style="padding-left:3px"> @lang('labels.frontend.course.complete') </span>
                                                                        <div class="icon">
                                                                            <i class="fa fa-check-circle"></i>
{{--                                                                            <i class="fa fa-check"></i>--}}
                                                                        </div>
                                                                    </a>
                                                                @endif
                                                            @endif
                                                        </div>
                                                        <div class="col-md-4" style="height: 64px">
                                                            @if ($data['next_lesson'] && isset($data['next_lesson']->model->slug))

                                                                <a class="next-button next"
                                                                   href="#nextVideo"
                                                                   style="justify-content: center; width:80%;gap: 10px;"
                                                                   role="button">
                                                                    <span> @lang('labels.frontend.course.next') </span>
                                                                    <div class="icon">
                                                                        <i class="fa fa-chevron-left"></i>
{{--                                                                        <i class="fa fa-check"></i>--}}
                                                                    </div>
                                                                </a>

                                                            @endif
                                                        </div>

                                                        <div class="col-md-4 offset-4"
                                                             style="margin-top: 74px;margin-right: 26%; ">

                                                            <form method="post" id="finishForm" style="display: none"
                                                                  action="{{ route('admin.certificates.generate') }}">
                                                                @csrf
                                                                <input type="hidden"
                                                                       value="{{ $data['lessonCourse']->id }}"
                                                                       name="course_id">
                                                                {{-- TODO: generate certificatue using group --}}
                                                                <input type="hidden" value="{{ $group->id }}"
                                                                       name="group_id">

                                                                <button id="finishBtn"
                                                                        class="next-button complete-btn "
                                                                        style="justify-content: center;"
                                                                        @if (!$data['lesson']->isCompleted($group->id)) onclick='courseCompleted("{{ $data['lesson']->id }}", "{{ get_class($data['lesson']) }}")'
                                                                        @endif role="button">
                                                                <span>
                                                                    @if($days>0)
                                                                        @lang('labels.frontend.course.finish_course')
                                                                    @else
                                                                        @lang('labels.frontend.course.get_certificate')

                                                                    @endif
                                                                </span>
                                                                    <div class="icon">

                                                                        <i class="fa fa-check"></i>
                                                                    </div>
                                                                </button>


                                                            </form>
                                                            @if ($data['lessonCourse']->progress($group->id) >= 50)
                                                                @if (!$data['lessonCourse']->isUserCertified())

                                                                    <form method="post"
                                                                          action="{{ route('admin.certificates.generate') }}">
                                                                        @csrf
                                                                        <input type="hidden"
                                                                               value="{{ $data['lessonCourse']->id }}"
                                                                               name="course_id">
                                                                        {{-- TODO: generate certificatue using group --}}

                                                                        <input type="hidden" value="{{ $group->id }}"
                                                                               name="group_id">
                                                                        <button id="finish"
                                                                                class="next-button complete-btn "

                                                                                style="justify-content: center;"
                                                                                role="button" type="submit">
                                                                            <span>
                                                                                @if($days>0)
                                                                                    @lang('labels.frontend.course.finish_course')
                                                                                @else
                                                                                    @lang('labels.frontend.course.get_certificate')

                                                                                @endif
                                                                            </span>
                                                                            <div class="icon">

                                                                                <i class="fa fa-check"></i>
                                                                            </div>
                                                                        </button>


                                                                    </form>
                                                                @else

                                                                    <div class="alert alert-success">
                                                                        @lang('labels.frontend.course.certified')
                                                                    </div>
                                                                @endif
                                                            @endif
                                                        </div>
                                                    </div>

                                                </div>

                                            </div>


                                        </div>


                                    </div>
                                </div>
                            @endforeach
                        </div>

                        <!--========== Test step ==========-->
                        <div class="col-sm-12 col-md-9 benefit wow fadeInUp ptb-50 course-content mt-0"
                             style="" id="accordionTestParent">
                            @foreach($course_tests as $test)
                                @if(isset($test))
                                    <div id="collapse-test-{{ $test->id }}"
                                         class="collapse-lesson-test container collapsed collapsed collapse"
                                         data-parent="#accordionTestParent"
                                         style="width: 100%;padding-right: 29px;">
                                        <div class="row main-content" style="margin-left: unset">
                                            <div class=" col-sm-12 col-md-10" style="width: 100%">
                                                @if (session()->has('success'))
                                                    <div class="alert alert-dismissable alert-success fade show">
                                                        <button type="button" class="close"
                                                                data-dismiss="alert">&times;
                                                        </button>
                                                        {{ session('success') }}
                                                    </div>
                                                @endif

                                                @if($errors->any())
                                                    <div class="alert alert-danger">
                                                        <ul class="list-inline list-style-none">
                                                            <li>{{$errors->first()}}</li>
                                                        </ul>
                                                    </div>
                                                @endif
                                                <div class="course-single-text">
                                                    <div class="course-title mt10 headline relative-position">
                                                        <h3 class="color-primary text-color" style="margin: 30px 0">
                                                            <b>
                                                                @if (session('locale') == 'ar')
                                                                    {{ $test->title_ar }}
                                                                @else
                                                                    {{ $test->title }}
                                                                @endif
                                                            </b>
                                                        </h3>
                                                    </div>
                                                    <hr>
                                                </div>

                                                <div class="course-details-item border-bottom-0 mb-0">

                                                    @php
                                                        $result = false
                                                    @endphp
                                                    @if($test->studentResults(auth()->id(), $group->id) && $test->studentResults(auth()->id(), $group->id)->count() > 0)

                                                        <div class="alert alert-info">
                                                            @lang('labels.frontend.course.your_test_score') :
                                                            @php
                                                                $result = $test->studentResults(auth()->id(), $group->id)->latest()->first();
                                                                $answer = $result->answers->first()->answer;
                                                            @endphp
                                                            {{ $result->test_result }}
                                                        </div>
                                                        <hr>
                                                    @endif



                                                    @if (count($test->questions) > 0)

                                                        @if(!$test->studentResults(auth()->id(), $group->id)->exists())
                                                            <form method="post" action="{{ route('lessons.test', [$test->slug])}}"enctype="multipart/form-data">
                                                                @csrf
                                                                <input type="hidden" name="group_id" value="{{ $group->id }}">
                                                                @endif

                                                                @php

                                                                    if($test->studentResults(auth()->id(), $group->id)->exists()) {
                                                                        // Get the student's result for the test
                                                                        $result = $test->studentResults(auth()->id(), $group->id)->latest()->first();

                                                                        // Get the questions that the student answered
                                                                        $questions = $result->answers->pluck('question_id')->map(function ($question_id) {
                                                                            return Question::find($question_id);
                                                                        });

                                                                    } else {
                                                                        // Select random questions
                                                                        $questions = $test->questions->shuffle()->take($test->questions_to_answer);

                                                                    }

                                                                        // Store the question IDs in the user session
                                                                        session(['test_questions' => $questions->pluck('id')->toArray()]);
                                                                @endphp
                                                                @foreach ($questions as $question)

                                                                    @if($question && $question->question_image)
                                                                        <img src="{{ asset('storage/questions/' . $question->question_image) }}"
                                                                             style="display: block; max-width: 80%;max-height: 20rem;"/>
                                                                    @endif

                                                                    {{--                                                                <h3 class="color-primary text-color"--}}
                                                                    {{--                                                                    style="margin-bottom: 35px;">--}}

                                                                    {{--                                                                    {{Lang::locale()=='en'?$question->title:$question->title_ar}}--}}
                                                                    {{--                                                                </h3>--}}
                                                                    <h4 class="mb-0">{{ $loop->iteration }}
                                                                        {!! Lang::locale()=='ar'?$question->question_ar:$question->question !!}
                                                                        @if (!$question->isQuestionAttempted())
                                                                            <small class="badge badge-danger">
                                                                                @lang('labels.frontend.course.not_attempted')</small>
                                                                        @endif
                                                                    </h4>
                                                                    <br/>
                                                                    <ul class="options-list pl-4">


                                                                        @if (sizeof($question->options) && $question->question_type == 'multiple_choice')
                                                                            @foreach ($question->options as $option)
                                                                                @php
                                                                                    $result = $test->studentResults(auth()->id(), $group->id)->latest()->first();
                                                                                    if ($result) {
                                                                                        $answered = $option->answered($result->id);
                                                                                    } else {
                                                                                        $answered = 0;
                                                                                    }
                                                                                @endphp
                                                                                <li class="@if ($answered == 1) correct @elseif($answered == 2) incorrect  @endif">
                                                                                    {{ Lang::locale()=='en'?$option->option_text: $option->option_text_ar}}

                                                                                    @if ($answered == 1 || $answered == 2)
                                                                                        {{--                                                                                    <p class="text-dark"--}}
                                                                                        {{--                                                                                       style="color:#802c41 !important">--}}
                                                                                        {{--                                                                                        <b>@lang('labels.frontend.course.explanation')</b><br>--}}
                                                                                        {{--                                                                                        {{ $option->explanation }}--}}
                                                                                        {{--                                                                                    </p>--}}
                                                                                    @else
                                                                                        <!-- Let the user choose an answer -->
                                                                                        <input type="radio"
                                                                                               name="questions[{{ $question->id }}]"
                                                                                               value="{{ $option->id }}" required>
                                                                                    @endif
                                                                                </li>
                                                                            @endforeach
                                                                        @elseif(sizeof($question->options) &&
                                                                                $question->question_type=="drop_down")
                                                                            <select name="questions[{{ $question->id }}]"
                                                                                    class="form-control"  required>
                                                                                @foreach ($question->options as $option)
                                                                                    <option @if (($option->answered($test->id) != null && $option->answered($test->id) == 1) || $option->correct == true)  selected
                                                                                            @endif
                                                                                            value="{{ $option->id }}">
                                                                                        {{ Lang::locale()=='en'?$option->option_text:$option->option_text_ar }}
                                                                                    </option>
                                                                                @endforeach
                                                                            </select>
                                                                        @else

                                                                            @switch($question->question_type)
                                                                                @case("paragraph")

                                                                                    <textarea type="text"
                                                                                              class="form-control editor"
                                                                                              placeholder="paragraph"
                                                                                              style="height:100px"
                                                                                              name="questions[{{
                                                                                              $question->id }}]" required>{{
                                                                                              @test_res($result->id,
                                                                                              $question->id)->option_id }}</textarea>
                                                                                    @break
                                                                                @case("short_answer")
                                                                                    <input type="text"
                                                                                           class="form-control"
                                                                                           value="{{ @test_res
                                                                                           ($result->id, $question->id)
                                                                                           ->option_id }}"
                                                                                           placeholder="@lang('labels.backend.questions.fields.short_answer')"
                                                                                           name="questions[{{ $question->id }}]" required/>
                                                                                    @break
                                                                                @case("date")
                                                                                    <input type="text"
                                                                                           class="form-control datepicker"
                                                                                           value="{{ @test_res($result->id, $question->id)->option_id }}"
                                                                                           placeholder="date"
                                                                                           name="questions[{{ $question->id }}]" required/>
                                                                                    @break
                                                                                @case("time")
                                                                                    <input type="text"
                                                                                           class="form-control timepicker"
                                                                                           value="{{ @test_res($result->id, $question->id)->option_id }}"
                                                                                           placeholder="time"
                                                                                           name="questions[{{ $question->id }}]" required/>
                                                                                    @break
                                                                                @case("file_upload")
                                                                                    <div style="margin-top: 20px">
                                                                                        <label>
                                                                                            @lang('labels.frontend.course.or_upload')</label>
                                                                                        <input type="file"
                                                                                               name="answer_file_{{
                                                                                               $question->id }}" required>
                                                                                        <p>{!! get_test_file(auth()->id(), $question->id) !!} </p>
                                                                                    </div>
                                                                                    @break
                                                                            @endswitch
                                                                            @if($result)
                                                                                <p class=" warning  ">@if (!empty(test_res($result->id, $question->id)->option_id))
                                                                                        @lang('labels.frontend.course.will_be_revied')
                                                                                    @endif
                                                                                </p>
                                                                            @endif
                                                                        @endif


                                                                    </ul>
                                                                    <br/>
                                                                @endforeach
                                                                @if(!$test->studentResults(auth()->id(), $group->id)->exists())

                                                                    <button class="btn btn-success"
                                                                            style="background-color: #6e0c25;"
                                                                            type="submit">
                                                                        @lang('buttons.general.crud.send')</button>
                                                            </form>
                                                        @endif
                                                        @if (config('retest'))
                                                            <div class="row main-content"
                                                                 style="margin-bottom: 60px;">
                                                                <div class="col-4 offset-4"
                                                                     style="margin-right: 30%;">
                                                                    <form action="{{ route('lessons.retest', [$test->slug]) }}"
                                                                          method="post">
                                                                        <form
                                                                                action="{{ route('lessons.retest', [$test->first()->test->slug]) }}"
                                                                                action="{{ route('lessons.retest', [$test->slug]) }}"

                                                                                method="post">

                                                                            @csrf
                                                                            <input type="hidden" name="result_id"
                                                                                   value="{{ $test->id }}">

                                                                            <button class="retest next-button"
                                                                                    role="button"
                                                                                    style="justify-content: center;">
                                                                                        <span>
                                                                                            @lang('labels.frontend.course.give_test_again')
                                                                                        </span>
                                                                                <div class="icon">
                                                                                    <i class="fa fa-repeat"></i>
                                                                                    <i class="fa fa-check"></i>
                                                                                </div>
                                                                            </button>


                                                                        </form>
                                                                    </form>
                                                                </div>
                                                            </div>
                                                            <div class="clear"></div>
                                                        @endif
                                                    @else
                                                        <h3>@lang('labels.general.no_data_available')</h3>
                                                    @endif


                                                </div>


                                            </div>


                                        </div>
                                    </div>
                                @endif
                            @endforeach
                        </div>

                        <!--========== lesson impact step ==========-->
                        <div class="col-sm-12 col-md-9 benefit wow fadeInUp ptb-50 course-content mt-0"
                             style="display:none;" id="impactaccordionParent">
                            @foreach($impactMeasurments as $item)
                                <div id="collapse-impact-{{ $item->id }}"
                                     class="course-details-item border-bottom-0 mb-0 collapsed collapsed collapse"
                                     data-parent="#impactaccordionParent" style="background-color:unset">


                                    <h3 style="border: 1px solid #88ceb9;
                                                padding: 10px;
                                                border-radius: 10px;color: #783141;">@lang('labels.frontend.course.impact')</h3>

                                    @if (($logged_in_user->hasRole('student') ||  $item->type == 'student') || ($logged_in_user->hasRole('teacher') || $item->type == 'teacher'))
                                        <div class="course-single-text">

                                            <div class="course-title mt10 headline relative-position">
                                                <h3 style="margin: 30px 0">
                                                    <b>
                                                        @if (Lang::locale() == 'en')
                                                            {{ $item->impact ? $item->impact : $item->impact_ar }}
                                                        @else
                                                            {{ $item->impact_ar ? $item->impact_ar : $item->impact }}
                                                        @endif
                                                    </b>
                                                </h3>
                                            </div>


                                            <hr>
                                            <form method="POST" enctype="multipart/form-data"
                                                  action="{{ route('admin.answerEvaluate.store') }}">
                                                @csrf
                                                <input type="hidden" name="course_id" value="{{ $course->id }}">
                                                <input type="hidden" name="group_id" value="{{ $group->id }}">
                                                <input type="hidden" name="rate_ids[]" value="{{ $item->id }}">
                                                @php
                                                    $quest_count = 0;

                                                    $userAnswers = $item->questions->map(function ($question) use ($item, $course) {
                                                        return $question->answers->where('user_id', \Auth::id());
                                                    })->flatten();
                                                @endphp
                                                <div class="">

                                                    @foreach ($item->questions as $question)
                                                        <p style="color: black !important;
                                                                    font-weight: bold !important;">
                                                            @if (Lang::locale() == 'en')
                                                                {{ $question->question }}
                                                            @else
                                                                {{ $question->question_ar ? $question->question_ar : $question->question }}
                                                            @endif
                                                        </p>
                                                        <br/>
                                                        <ul class="options-list pl-4">


                                                            @if (sizeof($question->options) && $question->question_type == 'multiple_choice')
                                                                @foreach ($question->options as $option)
                                                                    <div class="radio">
                                                                        <label>
                                                                            <input type="radio"
                                                                                   name="{{ $question->id }}-options"
                                                                                   @if ($option->answered(@$test_result->id) != null) checked
                                                                                   @endif
                                                                                   value="{{ $option->id }}"/>
                                                                            {{ $option->option_text }}<br/>
                                                                        </label>
                                                                    </div>
                                                                @endforeach
                                                            @elseif (sizeof($question->options) && $question->question_type == 'drop_down')
                                                                <select name="{{ $question->id }}-options"
                                                                        class="form-control">
                                                                    @foreach ($question->options as $option)
                                                                        <option
                                                                                @if ($option->answered(@$test_result->id) != null) selected
                                                                                @endif
                                                                                value="{{ $option->id }}">
                                                                            {{ $option->option_text }}
                                                                        </option>
                                                                    @endforeach
                                                                </select>
                                                            @else
                                                                @switch($question->question_type)
                                                                    @case('paragraph')
                                                                        <textarea type="text" class="form-control"
                                                                                  style="height:100px"
                                                                                  name="{{ $question->id }}-options">{{ @test_res($test_result->id, $question->id)->option_id }}</textarea>
                                                                        @break

                                                                    @case('short_answer')
                                                                        <input type="text" class="form-control"
                                                                               value="{{ @test_res($test_result->id, $question->id)->option_id }}"
                                                                               name="{{ $question->id }}-options"/>
                                                                        @break

                                                                    @case('date')
                                                                        <input type="text"
                                                                               class="form-control datepicker"
                                                                               value="{{ @test_res($test_result->id, $question->id)->option_id }}"
                                                                               name="{{ $question->id }}-options"/>
                                                                        @break

                                                                    @case('time')
                                                                        <input type="text"
                                                                               class="form-control timepicker"
                                                                               value="{{ @test_res($test_result->id, $question->id)->option_id }}"
                                                                               name="{{ $question->id }}-options"/>
                                                                        @break

                                                                    @case('file_upload')
                                                                        <div style="margin-top: 20px">
                                                                            <label>
                                                                                @lang('labels.frontend.course.or_upload')</label>
                                                                            <input type="file"
                                                                                   name="answer_file_{{ $question->id }}">
                                                                            <p>{!! get_test_file(auth()->id(), $question->id) !!} </p>
                                                                        </div>
                                                                        @break
                                                                @endswitch
                                                            @endif
                                                        </ul>
                                                        <br/>

                                                        <hr>
                                                    @endforeach


                                                </div>
                                                @if (count($impactMeasurments) > 0)
                                                    {{-- @if (count($userAnswers) == 0) --}}
                                                    <div class="form-group row justify-content-center"
                                                         style="margin-top: 20px;margin-left: 16%;">
                                                        <div class="col-4">
                                                            <button class="btn btn-success"
                                                                    style="background-color: #6e0c25;"
                                                                    type="submit">{{ __('buttons.general.crud.send') }}</button>
                                                        </div>
                                                    </div>
                                                    {{-- @endif --}}
                                                @endif

                                                <!--col-->
                                            </form>

                                        </div>
                                        @if ($data['lessonCourse']->progress($group->id) >= 50)
                                            @if (!$data['lessonCourse']->isUserCertified())

                                            <div style="    position: relative;
                                            display: flex;
                                            justify-content: space-around;
                                            flex-direction: row-reverse;">
                                                <form method="post" action="{{ route('admin.certificates.generate') }}">
                                                @csrf
                                                <input type="hidden" value="{{ $course->id }}" name="course_id">
                                                <input type="hidden" value="{{ $group->id }}"
                                                       name="group_id">
                                                <button id="finish" class="btn btn-primary "
                                                        style="justify-content: center;padding:10px" role="button">
                                                    <span>
                                                        @if ($days > 0)
                                                            @lang('labels.frontend.course.finish_course')
                                                        @else
                                                            @lang('labels.frontend.course.get_certificate')
                                                        @endif
                                                    </span>

                                                </button>


                                            </form>
                                            </div>
                                                @endif
                                                @endif
                                    @else
                                        <div class="course-single-text noData"
                                             style="background-image: url('{{ asset('assets/img/noData.png') }}')"></div>
                                    @endif


                                </div>
                            @endforeach
                            @foreach($programRecommendations as $item)
                                <div id="collapse-rec-{{ $item->id }}"
                                     class="course-details-item border-bottom-0 mb-0 collapsed collapsed collapse"
                                     data-parent="#impactaccordionParent" style="background-color:unset">


                                    <h3 style="border: 1px solid #88ceb9;
                                                padding: 10px;
                                                border-radius: 10px;color: #783141;">@lang('labels.frontend.course.programRec')</h3>

                                    @if (($logged_in_user->hasRole('student') ||  $item->type == 'student') || ($logged_in_user->hasRole('teacher') || $item->type == 'teacher'))
                                        <div class="course-single-text">

                                            <div class="course-title mt10 headline relative-position">
                                                <h3 style="margin: 30px 0">
                                                    <b>
                                                        @if (Lang::locale() == 'en')
                                                            {{ $item->recommendation ? $item->recommendation : $item->recommendation_ar }}
                                                        @else
                                                            {{ $item->recommendation_ar ? $item->recommendation_ar : $item->recommendation }}
                                                        @endif
                                                    </b>
                                                </h3>
                                            </div>


                                            <hr>
                                            <form method="POST" enctype="multipart/form-data"
                                                  action="{{ route('admin.answerEvaluate.store') }}">
                                                @csrf
                                                <input type="hidden" name="course_id" value="{{ $course->id }}">
                                                <input type="hidden" name="rate_ids[]" value="{{ $item->id }}">
                                                <input type="hidden" name="form_type" value="reccommendation" id="">

                                                @php
                                                    $quest_count = 0;

                                                    $userAnswers = $item->questions->map(function ($question) use ($item, $course) {
                                                        return $question->answers->where('user_id', \Auth::id());
                                                    })->flatten();
                                                @endphp
                                                <div class="">

                                                    @foreach ($item->questions as $question)
                                                        <p style="color: black !important;
                                                                    font-weight: bold !important;">
                                                            @if (Lang::locale() == 'en')
                                                                {{ $question->question }}
                                                            @else
                                                                {{ $question->question_ar ? $question->question_ar : $question->question }}
                                                            @endif
                                                        </p>
                                                        <br/>
                                                        <ul class="options-list pl-4">


                                                            @if (sizeof($question->options) && $question->question_type == 'multiple_choice')
                                                                @foreach ($question->options as $option)
                                                                    <div class="radio">
                                                                        <label>
                                                                            <input type="radio"
                                                                                   name="{{ $question->id }}-options"
                                                                                   @if ($option->answered(@$test_result->id) != null) checked
                                                                                   @endif
                                                                                   value="{{ $option->id }}"/>
                                                                            {{ $option->option_text }}<br/>
                                                                        </label>
                                                                    </div>
                                                                @endforeach
                                                            @elseif (sizeof($question->options) && $question->question_type == 'drop_down')
                                                                <select name="{{ $question->id }}-options"
                                                                        class="form-control">
                                                                    @foreach ($question->options as $option)
                                                                        <option
                                                                                @if ($option->answered(@$test_result->id) != null) selected
                                                                                @endif
                                                                                value="{{ $option->id }}">
                                                                            {{ $option->option_text }}
                                                                        </option>
                                                                    @endforeach
                                                                </select>
                                                            @else
                                                                @switch($question->question_type)
                                                                    @case('paragraph')
                                                                        <textarea type="text" class="form-control"
                                                                                  style="height:100px"
                                                                                  name="{{ $question->id }}-options">{{ @test_res($test_result->id, $question->id)->option_id }}</textarea>
                                                                        @break

                                                                    @case('short_answer')
                                                                        <input type="text" class="form-control"
                                                                               value="{{ @test_res($test_result->id, $question->id)->option_id }}"
                                                                               name="{{ $question->id }}-options"/>
                                                                        @break

                                                                    @case('date')
                                                                        <input type="text"
                                                                               class="form-control datepicker"
                                                                               value="{{ @test_res($test_result->id, $question->id)->option_id }}"
                                                                               name="{{ $question->id }}-options"/>
                                                                        @break

                                                                    @case('time')
                                                                        <input type="text"
                                                                               class="form-control timepicker"
                                                                               value="{{ @test_res($test_result->id, $question->id)->option_id }}"
                                                                               name="{{ $question->id }}-options"/>
                                                                        @break

                                                                    @case('file_upload')
                                                                        <div style="margin-top: 20px">
                                                                            <label>
                                                                                @lang('labels.frontend.course.or_upload')</label>
                                                                            <input type="file"
                                                                                   name="answer_file_{{ $question->id }}">
                                                                            <p>{!! get_test_file(auth()->id(), $question->id) !!} </p>
                                                                        </div>
                                                                        @break
                                                                @endswitch
                                                            @endif
                                                        </ul>
                                                        <br/>

                                                        <hr>
                                                    @endforeach


                                                </div>
                                                @if (count($programRecommendations) > 0)
                                                    {{-- @if (count($userAnswers) == 0) --}}
                                                    <div class="form-group row justify-content-center"
                                                         style="margin-top: 20px;margin-left: 16%;">
                                                        <div class="col-4">
                                                            <button class="btn btn-success"
                                                                    style="background-color: #6e0c25;"
                                                                    type="submit">{{ __('buttons.general.crud.send') }}</button>
                                                        </div>
                                                    </div>
                                                    {{-- @endif --}}
                                                @endif

                                                <!--col-->
                                            </form>

                                        </div>
                                        @if ($data['lessonCourse']->progress($group->id) >= 50)
                                            @if (!$data['lessonCourse']->isUserCertified())

                                            <div style="    position: relative;
                                            display: flex;
                                            justify-content: space-around;
                                            flex-direction: row-reverse;">
                                            <form method="post" action="{{ route('admin.certificates.generate') }}">
                                                @csrf
                                                <input type="hidden" value="{{ $course->id }}" name="course_id">
                                                <input type="hidden" value="{{ $group->id }}"
                                                       name="group_id">
                                                <button id="finish" class="btn btn-primary "
                                                        style="justify-content: center;padding:10px" role="button">
                                                    <span>
                                                        @if ($days > 0)
                                                            @lang('labels.frontend.course.finish_course')
                                                        @else
                                                            @lang('labels.frontend.course.get_certificate')
                                                        @endif
                                                    </span>

                                                </button>


                                            </form>
                                        </div>
                                                @endif
                                                @endif
                                    @else
                                        <div class="course-single-text noData"
                                             style="background-image: url('{{ asset('assets/img/noData.png') }}')"></div>
                                    @endif


                                </div>
                            @endforeach
                        </div>

                        <!--========== Activity step ==========-->
                        <div class="col-sm-12 col-md-9 benefit wow fadeInUp ptb-50 course-content mt-0"
                             style="display:none;" id="accordionActivityParent">
                            @foreach($activity as $act)
                                @if(isset($act))
                                    <div id="collapse-activity-{{ $act->id }}" class="collapse-lesson-test container
                                    collapsed collapsed collapse" data-parent="#accordionActivityParent"
                                         style="width: 100%;padding-right: 29px;">
                                        <div class="row main-content" style="margin-left: unset">
                                            <div class=" col-sm-12 col-md-10" style="width: 100%">
                                                @if (session()->has('success'))
                                                    <div class="alert alert-dismissable alert-success fade show">
                                                        <button type="button" class="close"
                                                                data-dismiss="alert">&times;
                                                        </button>
                                                        {{ session('success') }}
                                                    </div>
                                                @endif

                                                @if($errors->any())
                                                    <div class="alert alert-danger">
                                                        <ul class="list-inline list-style-none">
                                                            <li>{{$errors->first()}}</li>
                                                        </ul>
                                                    </div>
                                                @endif
                                                <div class="course-single-text">
                                                    <div class="course-title mt10 headline relative-position">
                                                        <h3 class="color-primary text-color" style="margin: 30px 0">
                                                            <b>
                                                                @if (session('locale') == 'ar')
                                                                    {{ $act->title_ar }}
                                                                @else
                                                                    {{ $act->title }}
                                                                @endif
                                                            </b>
                                                        </h3>
                                                        @if(!$act->studentResults(auth()->id())->exists())

                                                            <small class="badge badge-danger" style="float: left;top: 4rem;position: absolute;left: 4rem;">
                                                                @lang('labels.frontend.course.not_attempted')</small>
                                                        @endif
                                                    </div>
                                                    <hr>
                                                </div>

                                                <div class="course-details-item border-bottom-0 mb-0">

                                                    @php
                                                        $result = false
                                                    @endphp
                                                    @if($act->studentResults(auth()->id()) && $act->studentResults(auth()->id())->count() > 0)

                                                        <div class="alert alert-info">
                                                            @php
                                                                $result = $act->studentResults(auth()->id())->latest()->first();
                                                                $answer = $result->answers;
                                                            @endphp
                                                            @if($result->result != null)

                                                                @lang('labels.backend.activities.your_activity_score') :

                                                                @if($act->type == 'points')
                                                                    {{ $result->result }}
                                                                    @else
                                                                    @lang('labels.backend.activities.rates.'.$result->result)
                                                                @endif
                                                            @else
                                                                    @lang('labels.frontend.course.under_correction')
                                                            @endif



                                                        </div>
                                                        <hr>
                                                    @endif



                                                    @if(!$act->studentResults(auth()->id())->exists())
                                                        <form method="post"
                                                              action="{{ route('lessons.activity', [$act->slug])}}" enctype="multipart/form-data">
                                                            <input type="hidden" value="{{ $act->id }}"
                                                                   name="activity_id">
                                                            <input type="hidden" value="{{ $group->id }}"
                                                                   name="group_id">
                                                            @csrf
                                                            @endif

                                                            @php

                                                                if($act->studentResults(auth()->id())->exists()) {
                                                                    // Get the student's result for the test
                                                                    $result = $act->studentResults(auth()->id())->latest()->first();
                                                                }

                                                            @endphp

                                                            @if($act->image)
                                                                <img src="{{ asset('storage/activities/' . $act->image) }}"
                                                                     style="display: block; max-width: 80%;max-height: 20rem;"/>
                                                            @endif

                                                            <h4 class="mb-0">{{ $loop->iteration }}
                                                                {!! Lang::locale()=='ar'?$act->description_ar:$act->description !!}

                                                            </h4>
                                                            <br/>
                                                            <div style="margin-top: 20px">
                                                                <textarea type="text"
                                                                              class="form-control editor"
                                                                              placeholder="paragraph"
                                                                              style="height:100px"
                                                                              name="answer">
                                                                    @if($act->studentResults(auth()->id())->exists())
                                                                        @if($result->answers)
                                                                            {{ $result->answers }}
                                                                        @endif
                                                                    @endif
                                                                </textarea>
                                                            </div>
                                                                <div style="margin-top: 20px">
                                                                    <label>
                                                                        @lang('labels.frontend.course.or_upload')</label>
                                                                    <input type="file"
                                                                           name="answer_file">
                                                                    @if($act->studentResults(auth()->id())->exists())
                                                                        @if($result->file)
                                                                            <a href="{{ $result->file }}"
                                                                               target="_blank">
                                                                                @lang('labels.frontend.course.download_file')
                                                                            </a>
                                                                        @endif
                                                                    @endif
                                                                </div>
                                                            <br/>

                                                            @if(!$act->studentResults(auth()->id())->exists())

                                                                <button class="btn btn-success"
                                                                        style="background-color: #6e0c25;"
                                                                        type="submit">
                                                                    @lang('buttons.general.crud.send')</button>
                                                        </form>
                                                    @endif

                                                </div>


                                            </div>


                                        </div>
                                    </div>
                                @endif
                            @endforeach
                        </div>

                        <!--========== course side bar left ==========-->
                        <div class="col-sm-12 col-md-12  benefit wow fadeInUp ptb-50 course-content mt-0"
                             id="leftSidebar">

                            <!-- Sidebar left-->

                            @include('frontend.courses.course_sidebar_left')

                        </div>

                    </div>
                </div>
            </div>
        </div>
    </section>

@endsection

@push('after-scripts')

    <!-- Dependencies for client view and component view -->
    <script src="https://source.zoom.us/3.7.0/lib/vendor/react.min.js"></script>
    <script src="https://source.zoom.us/3.7.0/lib/vendor/react-dom.min.js"></script>
    <script src="https://source.zoom.us/3.7.0/lib/vendor/redux.min.js"></script>
    <script src="https://source.zoom.us/3.7.0/lib/vendor/redux-thunk.min.js"></script>
    <script src="https://source.zoom.us/3.7.0/lib/vendor/lodash.min.js"></script>

    <!-- Choose between the client view or component view: -->

    <!-- CDN for client view -->
    <script src="https://source.zoom.us/zoom-meeting-3.7.0.min.js"></script>

    <!-- CDN for component view -->
    <script src="https://source.zoom.us/zoom-meeting-embedded-3.7.0.min.js"></script>
    <script>
        // Signatures array
        var signatures = [
                @foreach($zoom_signatures as $lesson)
            {
                lesson_id: '{{ $lesson['lesson_id'] }}',
                signature: '{{ $lesson['zoom_signature'] }}',
                meeting_number: '{{ $lesson['meeting_number'] }}',
                meeting_pass: '{{ $lesson['meeting_password'] }}',
            },
            @endforeach
        ];

        signatures.forEach(signature => {
            const client = ZoomMtgEmbedded.createClient();

            // Modify the meetingSDKElement to include the lesson id
            let meetingSDKElement = document.getElementById(`meetingSDKElement-${signature.lesson_id}`);

            client.init({
                zoomAppRoot: meetingSDKElement,
                language: 'en-US',
                customize: {
                    video: {
                        isResizable: true,
                        viewSizes: {
                            default: {
                                width: 800,
                                height: 600
                            },
                            ribbon: {
                                width: 1000,
                                height: 700
                            }
                        }
                    }
                }
            });

            // Add event listener to the button
            document.getElementById(`zoom-btn-${signature.lesson_id}`).addEventListener('click', function () {

                meetingSDKElement.style.display = "block";

                client.join({
                    sdkKey: '{{ $zoom_sdk }}',
                    signature: signature.signature,
                    meetingNumber: signature.meeting_number,
                    password: signature.meeting_pass,
                    userName: '{{ auth()->user()->full_name }}',
                });
            });
        });
    </script>
    <script src="https://cdn.plyr.io/3.5.3/plyr.polyfilled.js"></script>
    <script>
        const lessons = @json($coursesData);
        let players = {};
        let animationFrameId = {}; // Object to store request IDs for each lesson

        // Function to show captions
        function showCaption(lessonId) {
            const player = players[lessonId];
            const captions = lessons.find(data => data.lesson.id == lessonId).transcript.transcript;
            // const showCaptions = $(`#caption-toggle-${lessonId}`).data('showCaptions');

            if (player && Array.isArray(captions)) {
                const currentTime = player.currentTime;
                // console.log("time: " + currentTime);
                const caption = captions.find(c => currentTime >= c.offset && currentTime <= c.offset + c.duration);
                if (caption) {
                    $(`#caption-display-${lessonId}`).text(caption.text);
                    // console.log("caption: " + caption.text);
                } else {
                    $(`#caption-display-${lessonId}`).text('');
                    // console.log("caption: nothing");
                }
            }
            // requestAnimationFrame(() => showCaption(lessonId));
            animationFrameId[lessonId] = requestAnimationFrame(() => showCaption(lessonId));
        }

        $(document).ready(function() {


            // Initialize players for each lesson
            lessons.forEach(data => {
                const lesson = data.lesson;
                const playerElement = document.querySelector(`#player-${lesson.id}`);
                if (playerElement) {
                    players[lesson.id] = new Plyr(playerElement);

                    // Change Caption BTN Style and Enable it
                    $('div.plyr--fullscreen-enabled').addClass('plyr--captions-enabled plyr--captions-active');
                    $('button[data-plyr="captions"]').addClass('plyr__controls__item plyr__control plyr__control--pressed');

                    // Create and append caption div
                    const captionDiv = document.createElement('div');
                    captionDiv.id = `caption-display-${lesson.id}`;
                    captionDiv.className = 'caption-display';
                    playerElement.parentNode.appendChild(captionDiv);
                }
            });

            // Event listener for showing transcript
            lessons.forEach(data => {
                const lesson = data.lesson;
                const captions = data.transcript.transcript;
                $(`#show-transcript-${lesson.id}`).on('click', function () {
                    let transcript = captions.map(c => c.text).join('\n');
                    $(`#transcript-display-${lesson.id}`).text(transcript);
                });
            });
        });
    </script>
    <!-- custom js -->
    <script src="{{ asset('iv') }}/assets/rating/js/star-rating.js"></script>
    <script src="{{ asset('iv') }}/js/toggleSideBar.js"></script>

    <script>
        $(document).on('change', 'input[name="stars"]', function () {
            $('#rating').val($(this).val());

        })
        $(document).ready(function () {
            $('.caption').css({
                'display': 'none'
            })

            $('.course-sidebar').on('click', 'a.list-group-item', function () {
                $(".course-sidebar .list-group-item").removeClass("active");
                $(this).addClass("active");
            });

        });
        $(document).ready(function () {
            $('.btn-video-collapse').on('click', function (e) {
                // Get the target collapse element
                var target = $(this).data('target');
                if ($(target).attr('aria-expanded') == 'true') {
                    e.preventDefault();
                    return false;
                } else {
                    $('.collapse').collapse('hide');
                    $('#accordionParent').show();
                    $('#accordionTestParent').hide();
                    $('#accordionActivityParent').hide();
                    $('#textContent').hide();
                    $('#leftSidebar').hide();
                    $(target).collapse('show');
                }

                // Change Caption BTN Style
                $('button[data-plyr="captions"]').addClass('plyr__controls__item plyr__control plyr__control--pressed');

                // Event listener for captions button
                $('button[data-plyr="captions"]').on('click', function (e) {
                    e.preventDefault();
                    const lessonDiv = $(this).closest('div.collapse-lesson-video');
                    const lessonId = lessonDiv.attr('id').split('-').pop();
                    // const showCaptions = !$(this).data('showCaptions');
                    // $(this).data('showCaptions', showCaptions);
                    // requestAnimationFrame(() => showCaption(lessonId));
                    if (animationFrameId[lessonId]) {
                        cancelAnimationFrame(animationFrameId[lessonId]);
                        animationFrameId[lessonId] = null;

                        // Hide caption display
                        $(`#caption-display-${lessonId}`).text('');
                        $(`#caption-display-${lessonId}`).hide();
                    } else {
                        $(`#caption-display-${lessonId}`).show();
                        animationFrameId[lessonId] = requestAnimationFrame(() => showCaption(lessonId));
                    }
                });
            });
            $('.btn-test-collapse').on('click', function (e) {
                // Get the target collapse element
                var target = $(this).data('target');
                if ($(target).attr('aria-expanded') == 'true') {
                    e.preventDefault();
                    return false;
                } else {
                    $('.collapse').collapse('hide');
                    $('#accordionTestParent').show();
                    $('#accordionActivityParent').hide();
                    $('#accordionParent').hide();
                    $('#textContent').hide();
                    $('#leftSidebar').hide();
                    $(target).collapse('show');
                    var isSolved = $(this).data('solved');
                    if (isSolved) {
                        console.log("solved");
                    } else {
                        // Prevent copy paste cut
                        $(document).bind('cut copy paste', function (e) {
                            e.preventDefault();
                        });
                        // Enter full screen and disable right click and F12, esc key
                        $(document).keydown(function (event) {
                            // Disable F12
                            if (event.keyCode == 123) {
                                return false;
                            }
                            // Disable Ctrl + Shift + I
                            else if (event.ctrlKey && event.shiftKey && event.keyCode == 73) {
                                return false;
                            }
                            // Disable Ctrl + U
                            else if (event.ctrlKey && event.keyCode == 85) {
                                return false;
                            }
                            // Disable Ctrl + S
                            else if (event.ctrlKey && event.keyCode == 83) {
                                return false;
                            }
                            // Disable Ctrl + C
                            else if (event.ctrlKey && event.keyCode == 67) {
                                return false;
                            }
                            // Disable Ctrl + V
                            else if (event.ctrlKey && event.keyCode == 86) {
                                return false;
                            }
                            // Disable Ctrl + F6
                            else if (event.ctrlKey && event.keyCode == 117) {
                                return false;
                            }
                            // Disable Ctrl + J
                            else if (event.ctrlKey && event.keyCode == 74) {
                                return false;
                            }
                            // Disable Ctrl + A
                            else if (event.ctrlKey && event.keyCode == 65) {
                                return false;
                            }
                            // Disable Ctrl + X
                            else if (event.ctrlKey && event.keyCode == 88) {
                                return false;
                            }
                            // Disable Ctrl + E
                            else if (event.ctrlKey && event.keyCode == 69) {
                                return false;
                            }
                            // Disable Ctrl + F
                            else if (event.ctrlKey && event.keyCode == 70) {
                                return false;
                            }
                            // Disable Ctrl + N
                            else if (event.ctrlKey && event.keyCode == 78) {
                                return false;
                            }
                            // Disable Ctrl + P
                            else if (event.ctrlKey && event.keyCode == 80) {
                                return false;
                            }
                            // Disable Ctrl + Q
                            else if (event.ctrlKey && event.keyCode == 81) {
                                return false;
                            }
                            // Disable Ctrl + R
                            else if (event.ctrlKey && event.keyCode == 82) {
                                return false;
                            }
                            // Disable Ctrl + T
                            else if (event.ctrlKey && event.keyCode == 84) {
                                return false;
                            }
                            // Disable Ctrl + W
                            else if (event.ctrlKey && event.keyCode == 87) {
                                return false;
                            }
                            // Disable Ctrl + Y
                            else if (event.ctrlKey && event.keyCode == 89) {
                                return false;
                            }
                            // Disable Ctrl + Z
                            else if (event.ctrlKey && event.keyCode == 90) {
                                return false;
                            }
                            // Disable Esc
                            else if (event.keyCode == 27) {
                                return false;
                            }
                        });

                        // Disable right click
                        document.addEventListener('contextmenu', function (e) {
                            e.preventDefault();
                        });

                        var elem = document.documentElement;

                        /* Function to open fullscreen mode */
                        function openFullscreen() {
                            if (elem.requestFullscreen) {
                                elem.requestFullscreen();
                            } else if (elem.mozRequestFullScreen) { /* Firefox */
                                elem.mozRequestFullScreen();
                            } else if (elem.webkitRequestFullscreen) { /* Chrome, Safari and Opera */
                                elem.webkitRequestFullscreen();
                            } else if (elem.msRequestFullscreen) { /* IE/Edge */
                                elem.msRequestFullscreen();
                            }
                        }

                        openFullscreen();

                        // Prevent user from leaving the page
                        $(window).on('beforeunload', function () {
                            return "Are you sure you want to navigate away from this page?The exam will stop!!!";
                        });

                        $(window).blur(function () {
                            // Check if the active element is an input field, file upload, option, or radio button
                            if (!$(document.activeElement).is("input, select, option, [type='radio'], iframe, textarea")) {
                                // User has switched away from your page
                                alert('Please do not switch tabs.The exam will stop!!!');
                            }
                        });
                    }

                }
            });
            $('.btn-right-collapse-2').on('click', function () {
                // Get the target collapse element
                $('#accordionParent').hide();
                $('#impactaccordionParent').hide();
                $('#accordionTestParent').hide();
                $('#accordionActivityParent').hide();
                $('#textContent').show();
                $('#leftSidebar').show();
                $(target).collapse('show');
            });
            $('.btn-impact-collapse').on('click', function () {
                // Get the target collapse element
                var target = $(this).data('target');
                // $('.collapse').collapse('hide');
                $('#impactaccordionParent').show();
                $('#accordionTestParent').hide();
                $('#accordionActivityParent').hide();
                $('#textContent').hide();
                $('#leftSidebar').hide();
                $(target).collapse('show');
            });
            $('.btn-activity-collapse').on('click', function () {
                // Get the target collapse element
                var target = $(this).data('target');
                // $('.collapse').collapse('hide');
                console.log(target);
                $('#accordionActivityParent').show();
                $('#impactaccordionParent').hide();
                $('#accordionParent').hide();
                $('#accordionTestParent').hide();
                $('#textContent').hide();
                $('#leftSidebar').hide();
                $(target).collapse('show');
            });
            $('#accordionParent').hide();
            $('#impactaccordionParent').hide();
            $('#accordionTestParent').hide();
            $('#accordionActivityParent').hide();
            $('#textContent').show();
            $('#leftSidebar').show();
            $(target).collapse('show');
            var showCategory = "{{ session('showCategory') }}";
            if (showCategory) {
                if (showCategory == 'rates') {
                    $('.btn-right-collapse-2').click();
                    $('#step1').hide();
                    $('#step2').show();
                }
                if (showCategory == 'impact') {
                    $('.btn-impact-collapse').click();
                    $('a[id^="collapse-impact-"]:first').click();
                }
            }
        });
        $(document).ready(function () {
            $('.next-button.previous').on('click', function (e) {
                e.preventDefault(); // Prevent the default action (navigation)

                // Get the current and previous lesson divs
                var currentLessonDiv = $(this).closest('.collapse-lesson-video');
                var previousLessonDiv = currentLessonDiv.prevAll('.collapse-lesson-video').first();

                // Toggle visibility
                currentLessonDiv.hide();
                previousLessonDiv.show();
            });
        });
        $(document).ready(function () {
            $('.next-button.next').on('click', function (e) {
                e.preventDefault(); // Prevent the default action (navigation)

                // Get the current and next lesson divs
                var currentLessonDiv = $(this).closest('.collapse-lesson-video');
                var nextLessonDiv = currentLessonDiv.nextAll('.collapse-lesson-video').first();

                // var nextLessonDiv = currentLessonDiv.next('.collapse-lesson-video');

                // Toggle visibility
                currentLessonDiv.hide();
                nextLessonDiv.show();
            });
        });
        @if($course->type_id != 1)
            var markAsPresentUrlPattern = '{{ route('courses.markAsPresent', ['course' => $course->id, 'group' => $group->id, 'lesson' => ':lessonId']) }}';
            var markAsFinishedUrlPattern = '{{ route('courses.markAsFinished', ['course' => $course->id, 'group' => $group->id, 'lesson' => ':lessonId']) }}';

            function markAsPresent(lessonId, userId) {
                var url = markAsPresentUrlPattern.replace(':lessonId', lessonId);
                $.ajax({
                    url: url,
                    type: 'POST',
                    data: {
                        lesson_id: lessonId,
                        user_id: userId,
                        _token: $('meta[name="csrf-token"]').attr('content') // Assuming you're using Laravel that requires CSRF token
                    },
                    success: function(response) {
                        if (response.error) {
                            $('.successMessage').html("<div class='alert alert-danger' role='alert'>" +
                                response.error +
                                "<button type='button' class='close' data-dismiss='alert' aria-label='Close'>" +
                                "<span aria-hidden='true'>&times;</span>" +
                                "</button>" +
                                "</div>");
                        } else {
                            $('.successMessage').html("<div class='alert alert-success' role='alert' id='success-alert'>" +
                                response.success +
                                "<button type='button' class='close' data-dismiss='alert' aria-label='Close'>" +
                                "<span aria-hidden='true'>&times;</span>" +
                                "</button>" +
                                "</div>");
                        }
                    },
                    error: function(error) {
                        $('.successMessage').html("<div class='alert alert-danger' role='alert'>" +
                            error +
                            "<button type='button' class='close' data-dismiss='alert' aria-label='Close'>" +
                            "<span aria-hidden='true'>&times;</span>" +
                            "</button>" +
                            "</div>");
                    }
                });
            }
            function markAsFinished(lessonId, userId) {
                var url = markAsFinishedUrlPattern.replace(':lessonId', lessonId);
                $.ajax({
                    url: url,
                    type: 'POST',
                    data: {
                        lesson_id: lessonId,
                        user_id: userId,
                        _token: $('meta[name="csrf-token"]').attr('content') // CSRF token for Laravel applications
                    },
                    success: function(response) {
                        if (response.error) {
                            $('.successMessage').html("<div class='alert alert-danger' role='alert'>" +
                                response.error +
                                "<button type='button' class='close' data-dismiss='alert' aria-label='Close'>" +
                                "<span aria-hidden='true'>&times;</span>" +
                                "</button>" +
                                "</div>");
                        } else {
                            $('.successMessage').html("<div class='alert alert-success' role='alert' id='success-alert'>" +
                                response.success +
                                "<button type='button' class='close' data-dismiss='alert' aria-label='Close'>" +
                                "<span aria-hidden='true'>&times;</span>" +
                                "</button>" +
                                "</div>");
                        }
                    },
                    error: function(error) {
                        $('.successMessage').html("<div class='alert alert-danger' role='alert'>" +
                            error +
                            "<button type='button' class='close' data-dismiss='alert' aria-label='Close'>" +
                            "<span aria-hidden='true'>&times;</span>" +
                            "</button>" +
                            "</div>");
                    }
                });
            }
        @endif

    </script>
    <script>
        window.onload = function () {
            function toggleSteps(clickedAnchor) {
                const step1 = document.getElementById("step1");
                const step2 = document.getElementById("step2");

                if (clickedAnchor.id === "anchor1") {
                    step1.style.display = "block";
                    step2.style.display = "none";
                    console.log("step1");
                } else if (clickedAnchor.id === "anchor2") {
                    step1.style.display = "none";
                    step2.style.display = "block";
                    console.log("step2");
                }
            }

            document.getElementById("anchor1").addEventListener("click", function () {
                toggleSteps(this);
            });
            document.getElementById("anchor2").addEventListener("click", function () {
                toggleSteps(this);
            });
            document.getElementById("step1").style.display = "block";


        };

    </script>
    <script>
        {{-- TODO: generate certificatue using group --}}

        function courseCompleted(id, type) {
            $.ajax({
                url: "{{ route('update.course.progress') }}",
                method: "POST",
                data: {
                    "_token": "{{ csrf_token() }}",
                    'model_id': parseInt(id),
                    'model_type': type,
                    'group_id': "{{ $group->id }}"
                },
                success: function (data) {
                    var newProgress = data.progress;
                    $('.successMessage').html("<div class='alert alert-success' role='alert' id='success-alert'>" +
                        "@lang('labels.frontend.course.completed_message')" +
                        "<button type='button' class='close' data-dismiss='alert' aria-label='Close'>" +
                        "<span aria-hidden='true'>&times;</span>" +
                        "</button>" +
                        "</div>");
                    $('#complete-btn-' + id).hide();
                    //change progress bar to the new value
                    $('#progress-bar').css('width', newProgress + '%').attr('aria-valuenow', newProgress);
                    $('#progress-bar').text(newProgress + '%');
                }
            });
        }
    </script>


@endpush
