@extends('frontend.layouts.app'.config('theme_layout'))

@section('title', trans('labels.frontend.home.title').' | '.app_name())
@section('meta_description', '')
@section('meta_keywords','')


@push('after-styles')

    <link rel="stylesheet" href="https://cdn.plyr.io/3.6.8/plyr.css"/>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
    <link rel="stylesheet" href="https://cdn.plyr.io/3.6.8/plyr.css"/>
    <link rel="stylesheet" href="https://cdn.plyr.io/3.6.8/plyr.css"/>
    <link href="{{ asset('iv') }}/assets/rating/css/star-rating.css" media="all" rel="stylesheet" type="text/css"/>
    <link href="{{ asset('iv') }}/assets/rating/themes/krajee-svg/theme.css" media="all" rel="stylesheet"
          type="text/css"/>
    <script src="https://cdn.plyr.io/3.6.8/plyr.polyfilled.js"></script>
    <style>
        body {
            direction: rtl;
        }
        .rating-container .star {
            display: unset;
        }
        #student-screen .cont {

            text-align: center;
            height: 100%;
            width: 98%;
            margin-left: auto;
            margin-right: auto
        }
        .course-single-text{
            text-align: right !important;
            font-size: 22px;
            line-height: 28px;
        }
        .resource-list li{
            font-weight: 500
            text-decoration:line;
        }

        #content {
            display: none;
        }

        #student-screen .tabs h1 {
            border: 1px solid #4f198d;
            padding: 5px;
            font-size: 25px;

        }

        a {
            text-decoration: none;

        }
        .btn-check{
            background: #4f198d;
            color: #fff;
            padding:6px 20px;
            font-size: 20px;
            border-radius: 5px;
        }
        .file-upload{
            border: 1px solid #4f198d;
    padding: 5px;
    border-radius: 5px;
    text-align: center;

        }
       

        #student-screen {
            padding: 50px 0;
        }

        #toggleButton2, #toggleButton2 {
            display: block
        }
        .record-btn{
            background: #4f198d;
            color: #fff;
            padding: 10px;
            display: inline-block;
            margin: 10px;
            border-radius: 5px;
            border: 1px solid #4f198d;
        }
        ul{
            padding-right: 0 !important;
        }
        .record-btn:hover{
            background: transparent;
            border: 1px solid #4f198d;
            color: #4f198d
        }
        .tabs-details .tabs {
            display: flex;
            cursor: pointer;
            margin-bottom: 20px;
            justify-content: center;
            flex-wrap: wrap;
            flex-direction: column
        }

        .tabs-details .tab {
            padding: 10px 0px;
            color: #4f198d;
            border: 1px solid #eee;
            margin: 5px 0;
            font-size: 20px;
            border-radius: 6px;
            cursor: pointer;
            text-align: center;
         
        }

        .tabs-details .tab.active {
            background-color: #4f198d;
            color: #fff;
            /* box-shadow: rgba(0, 0, 0, 0.24) 0px 3px 8px; */
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

        .two-part .small-part .links-part {
            border: 1px solid #eee;
            display: flex;
            flex-direction: column;
            padding: 20px;
            box-shadow: rgba(99, 99, 99, 0.2) 0px 2px 8px 0px;
        }

        .two-part .small-part .tab {
            display: block;
            background-color: #4f198d !important;
            color: #fff;
            margin: 1% 0;
            padding: 10px 5px;
            border-radius: 5px;
            cursor: pointer;
        }

        .tab .list-group-item {
            background-color: #4f198d !important;
            color: #fff !important;
            cursor: pointer;
            border: none;
        }

        .two-part .small-part .tab a {
            color: #fff;
            line-height: 28px;
            font-weight: 500;
        }

        .display-content {
            font-size: 20px;
            line-height: 32px;
            font-weight: 600;
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
            margin: 5px 0;
            border-radius: 5px
        }

        .tab h1 {
            margin: 10px 0 !important;
            font-size: 22px;
            width: 100%;

        }
.course-details-content p{
    margin: 10px auto;
    line-height: 32px;
    text-align: justify;
}
        .tab {

            width: 100%;
        }
        h3{
            color:#000 !important;
        }

        .collapse-content {
            padding: 10px 0;
            /* border: 1px solid #ccc; */
            border-top: none;
            display: none;
            text-align: right;
            background-color: #fff;
            transition: .5s ease;
            margin: 10px 0;
        }

        .collapse-content.active {
            display: block;

            color: #fff;
            border-radius: 5px;
            /* box-shadow: rgba(0, 0, 0, 0.24) 0px 3px 8px; */
            text-align: center;
        }
       

        #student-screen .two-part .three {
            border: 1px solid #eee;
            border-radius: 10px;
            padding: 20px;
        }

        .video-player {
            margin-bottom: 40px;

        }

        .plyr--video {
            border-radius: 8px;
        }

        .email-field {
            margin-bottom: 10px;
        }

        .invite-part input[type="email"] {
            padding: 8px;
            margin-right: 10px;
            border-radius: 5px;
            width: 70%;
            border: 1px solid #ccc;

        }

        .invite-part button {
            padding: 8px 15px;
            cursor: pointer;
        }

        .invite-part {
            margin: 20px 0;
            border: 2px solid #eee;
            padding: 20px;
            border-radius: 5px;

        }

        .invite-part .newbtn {
            background: #4f198d;
            color: #fff;
            border: none;
            min-width: 50px;
            font-size: 18px;
            border-radius: 5px;
            margin-right: 2px;
        }

        #chat {
            border: 1px solid #ccc;
            height: 300px;
            padding: 10px;
            overflow-y: scroll;
            background: #fff;
        }
        input[type="file"]::file-selector-button {
  border: 2px solid #ffd857;
  padding: 0.2em 0.4em;
  border-radius: 0.2em;
  background-color: #ffd857;
  transition: 1s;
}
.options-list input{
    border: 1px solid #aaa;
    border-radius: 10px;
    background: #fff;
    font-size:20px;
    line-height:22px;
    color: #aaa;
}
input[type="file"]::file-selector-button:hover {
  background-color: #ffd857;
  border: 2px solid #ffd857;
}
input[type="file"]{
    width: 100%;
    border: 1px solid #eee;
    padding:5px;
    border-radius:5px;
    margin:10px 0;

}

        #message-form {
            margin-top: 10px;
            display: flex;
        }

        #message-input {
            width: 80%;
            padding: 8px;
            border-radius: 5px;
        }


        #rating {
            display: inline-block;
        }

        /*.star {*/
        /*    font-size: 30px;*/
        /*    color: #ccc;*/
        /*    cursor: pointer;*/
        /*    margin-right: 5px;*/
        /*}*/

        /*.star.selected, .star:hover, .star:hover ~ .star {*/
        /*    color: #ffcc00;*/
        /*}*/


        @media (max-width: 775px) {

            #student-screen .cont {

                text-align: center;
                height: 100%;
                width: 98%;
                margin-left: auto;
                margin-right: auto
            }
        }


        @media (min-width: 776px) {

            #student-screen .cont {
                width: 85%;
                margin-left: auto;
                margin-right: auto;
                max-width: 85%
            }

        }

        @media (min-width: 992px) {

            #student-screen .two-part {
                display: flex;
                flex-direction: row;
                justify-content: space-between;
                align-items: start;
            }

            #student-screen .two-part .three {
                width: 55%
            }

            .two-buttons {
                justify-content: start;
            }

            #student-screen .two-part .small-part {
                width: 35%;
                border-radius: 5px;

            }

            .tab-content .two {
                display: flex;
                justify-content: space-between;
                align-items: start;
            }

            .groups-data {
                display: flex;
                justify-content: space-between;
                align-items: end;
            }
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

    <div id='student-screen'>
        <div class="cont">

            <div class='two-part'>
                <div class="three">
                    <div class="text-part">

                        <div class="tabs-details">
                            {{-- message --}}
                            <div class="successMessage"></div>
                            <div>
                                @include('includes.partials.messages')
                            </div>

                            {{-- lesson --}}
                            @foreach($coursesData as $data)
                                <div id="tab-content-lesson-{{ $data['lesson']->id }}" class="tab-content">
                                    <div class="video-player">
                                        <p class="display-content">
                                            @if (session('locale') == 'ar')
                                                {{ $data['lesson']->title_ar }}
                                            @else
                                                {{ $data['lesson']->title }}
                                            @endif

{{--                                            @if($course->type_id != 1)--}}
{{--                                                <!-- Present Icon with hover label -->--}}
{{--                                                <i class="fas fa-check btn btn-check"--}}
{{--                                                   onclick="markAsPresent({{ $data['lesson']->id }}, {{ auth()->user()->id }})"--}}
{{--                                                   style="cursor:pointer; margin-right: 10px;padding: 5px 10px;border-radius: 9px;"--}}
{{--                                                   title="Mark as Present"></i>--}}
{{--                                                <!-- Finished Icon with hover label -->--}}
{{--                                                <i class="fas fa-flag btn btn-primary"--}}
{{--                                                   onclick="markAsFinished({{ $data['lesson']->id }}, {{ auth()->user()->id }})"--}}
{{--                                                   style="cursor:pointer; margin-right: 10px;padding: 5px 10px;border-radius: 9px;"--}}
{{--                                                   title="Mark as Finished"></i>--}}
{{--                                            @endif--}}
                                        </p>
                                        @if(isset($data['lesson']->zoom_link))
                                            <div id="meetingSDKElement-{{ $data['lesson']->id }}"
                                                 class="meetingSDKElement">

                                            </div>
                                        @endif

                                        @if ($data['lesson']->mediaVideo && $data['lesson']->mediavideo->count() > 0)
                                            @if ($data['lesson']->mediavideo != '')
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

                                                    <video poster="" id="player-{{$data['lesson']->id}}"
                                                           class="js-player"
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
                                            @endif
                                        @endif

                                        @if ($data['lesson']->mediaAudio)
                                            <div class="course-single-text mb-5">
                                                <audio id="audioPlayer" controls>
                                                    <source src="{{ $data['lesson']->mediaAudio->url }}"
                                                            type="audio/mp3"/>
                                                </audio>
                                            </div>
                                        @endif

                                        <div class="course-details-content">
                                            @if (session('locale') == 'ar')
                                                {!! $data['lesson']->full_text_ar ?? $data['lesson']->full_text !!}
                                            @else
                                                {!! $data['lesson']->full_text !!}
                                            @endif
                                        </div>

                                        @if(isset($data['lesson']->zoom_link))

                                            <hr>
                                            <div class="course-details-item border-bottom-0 mb-0 col-lg-12 ">
                                                <h3 style="margin-bottom: 17px; color: #4f198d  !important;  font-weight: bold !important;">
                                                    @lang('labels.backend.lessons.fields.zoom_link')
                                                </h3>

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

                                        @if($course->type_id != 1)
                                            <!-- Present Icon with hover label -->
                                            <a href='#' class='record-btn' onclick="markAsPresent({{ $data['lesson']->id }}, {{ auth()->user()->id }})">تسجيل حضور </a>

                                            <!-- Finished Icon with hover label -->
                                            <a href='#' class='record-btn' onclick="markAsFinished({{ $data['lesson']->id }}, {{ auth()->user()->id }})">تسجيل انصراف</a>
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


                                        @if (!$data['lesson']->isCompleted($group->id) && $course->type_id == 1)
                                            @if ($data['lesson']->isCompleted($group->id) == false)

                                                <a href="#nextVideo"
                                                   class="next-button complete-btn next"
                                                   style="justify-content: center;width:100%;display: flex;"
                                                   id="complete-btn-{{ $data['lesson']->id }}"
                                                   @if (!$data['lesson']->isCompleted($group->id)) onclick='courseCompleted("{{ $data['lesson']->id }}", "{{ get_class($data['lesson']) }}")'
                                                   @endif role="button">
                                                    <div style="    display: flex;
    gap: 10px;
    background: #4f198d;
    color: #fff;
    border: none;
    width: fit-content;
    font-size: 16px;
    border-radius: 5px;
    margin-right: 2px;
    padding: 8px;">
                                                        <span style="padding-left:3px"> @lang('labels.frontend.course.complete') </span>
                                                        <div class="icon">
                                                            <i class="fa fa-check-circle"></i>
                                                            {{--                                                                            <i class="fa fa-check"></i>--}}
                                                        </div>
                                                    </div>

                                                </a>
                                            @endif
                                        @endif

                                    </div>
                                </div>
                            @endforeach

                            {{-- chat --}}
                            <div id="tab-content-chat" class="tab-content">
                                @include('frontend.courses.course_chat')
                            </div>

                            {{-- tests --}}
                            @foreach($course_tests as $test)
                                @if(isset($test))
                                    <div id="tab-content-test-{{ $test->id }}" class="tab-content">
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
                                                    <form method="post"
                                                          action="{{ route('lessons.test', [$test->slug])}}"
                                                          enctype="multipart/form-data">
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
                                                                        <li class="@if ($answered == 1) correct
                                                                        @elseif($answered == 2) incorrect  @endif"
                                                                            style=" display:flex; flex-direction: row-reverse; justify-content: flex-end; gap: 10px;">
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
                                                                                       value="{{ $option->id }}"
                                                                                       required>
                                                                            @endif
                                                                        </li>
                                                                    @endforeach
                                                                @elseif(sizeof($question->options) &&
                                                                        $question->question_type=="drop_down")
                                                                    <select name="questions[{{ $question->id }}]"
                                                                            class="form-control" required>
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
                                                                                              $question->id }}]"
                                                                                      required>{{
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
                                                                                   name="questions[{{ $question->id }}]"
                                                                                   required/>
                                                                            @break
                                                                        @case("date")
                                                                            <input type="text"
                                                                                   class="form-control datepicker"
                                                                                   value="{{ @test_res($result->id, $question->id)->option_id }}"
                                                                                   placeholder="date"
                                                                                   name="questions[{{ $question->id }}]"
                                                                                   required/>
                                                                            @break
                                                                        @case("time")
                                                                            <input type="text"
                                                                                   class="form-control timepicker"
                                                                                   value="{{ @test_res($result->id, $question->id)->option_id }}"
                                                                                   placeholder="time"
                                                                                   name="questions[{{ $question->id }}]"
                                                                                   required/>
                                                                            @break
                                                                        @case("file_upload")
                                                                            <div style="margin-top: 20px">
                                                                                <label>
                                                                                    @lang('labels.frontend.course.or_upload')</label>
                                                                                <input type="file"
                                                                                       name="answer_file_{{
                                                                                               $question->id }}"
                                                                                       required>
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

                                                            <button class="btn-check "
                                                                    style=""
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
                                @endif
                            @endforeach

                            {{-- rates --}}
                            <div id="tab-content-rates" class="tab-content">
                                @if(count($rates)>0)

                                    <h3 style="border: 1px solid #4f198d;
                                      padding: 10px;
                                      border-radius: 10px;"> @lang('labels.frontend.course.ratings')</h3>
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
                                                        <input type="hidden" name="division_ids[]"
                                                               value="{{ $division->id }}">
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
                                                                 style="padding: 9px; border: 1px solid #4f198d; border-radius: 10px; margin-bottom: 10px;">
                                                                <h5 style="color: #4f198d  !important;  font-weight: bold !important;"
                                                                    class="mb-0 card-body">
                                                                    @if (Lang::locale() == 'en')
                                                                        {{ $division->title }}
                                                                    @else
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
                                                                                               id="kartik"
                                                                                               class="rating"
                                                                                               data-stars="5"
                                                                                               data-step="0.1"
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
                                                                                                    <textarea
                                                                                                            type="text"
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
                                                    $hasQuestions = $rates->flatMap->divisions->flatMap->questions->isNotEmpty();
                                                @endphp
                                                @if ($hasQuestions)
                                                    @php
                                                        $isAnyQuestionAnswered = $rates->flatMap->divisions->flatMap->questions->contains(function($question) use ($group) {
                                                            return $question->answers->where('user_id', auth()->id())
                                                            ->where('group_id', $group->id)->count() > 0;
                                                        });
                                                    @endphp
                                                    @if (!$isAnyQuestionAnswered)
                                                        <div class="form-group row justify-content-center" style="margin-top: 20px;margin-left: 16%;">
                                                            <div class="col-4">
                                                                <button class="btn-check" type="submit">{{ __('buttons.general.crud.send') }}</button>
                                                            </div>
                                                        </div>
                                                    @endif
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

                            {{-- impacts --}}
                            @if(count($impactMeasurments) > 0)
                                @foreach($impactMeasurments as $item)
                                    <div id="tab-content-impacts-{{ $item->id }}" class="tab-content">

                                        <h3 style="border: 1px solid #4f198d;
                                                padding: 10px;
                                                border-radius: 10px;color: #783141;">@lang('labels.frontend.course.impact')</h3>

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
                                                    @php
                                                        $hasQuestions = $item->questions->isNotEmpty();
                                                    @endphp
                                                    @if ($hasQuestions)
                                                        <div class="form-group row justify-content-center"
                                                             style="margin-top: 20px;margin-left: 16%;">
                                                            <div class="col-4">
                                                                <button class="btn"
                                                                        type="submit">{{ __('buttons.general.crud.send') }}</button>
                                                            </div>
                                                        </div>
                                                    @endif
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
                                                    <form method="post"
                                                          action="{{ route('admin.certificates.generate') }}">
                                                        @csrf
                                                        <input type="hidden" value="{{ $course->id }}"
                                                               name="course_id">
                                                        <input type="hidden" value="{{ $group->id }}"
                                                               name="group_id">
                                                        <button id="finish" class="btn btn-primary "
                                                                style="justify-content: center;padding:10px"
                                                                role="button">
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

                                    </div>
                                @endforeach
                            @endif

                            {{-- reccomendations --}}
                            @foreach($programRecommendations as $item)
                                <div id="tab-content-reccomendations-{{ $item->id }}" class="tab-content">
                                    <h3 style="border: 1px solid #4f198d;
                                                padding: 10px;
                                                border-radius: 10px;color: #4f198d;">@lang('labels.frontend.course.programRec')</h3>

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
                                            <input type="hidden" name="group_id" value="{{ $group->id }}">
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
                                                @php
                                                    $hasQuestions = $item->questions->isNotEmpty();
                                                @endphp
                                                @if ($hasQuestions)
                                                    <div class="form-group row justify-content-center"
                                                         style="margin-top: 20px;margin-left: 16%;">
                                                        <div class="col-4">
                                                            <button class="btn btn-check"
                                                                    type="submit">{{ __('buttons.general.crud.send') }}</button>
                                                        </div>
                                                    </div>
                                                @endif
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
                                                <form method="post"
                                                      action="{{ route('admin.certificates.generate') }}">
                                                    @csrf
                                                    <input type="hidden" value="{{ $course->id }}" name="course_id">
                                                    <input type="hidden" value="{{ $group->id }}"
                                                           name="group_id">
                                                    <button id="finish" class="btn btn-primary "
                                                            style="justify-content: center;padding:10px"
                                                            role="button">
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
                                </div>
                            @endforeach

                            {{-- activity --}}
                            @if(count($activity)>0)
                                @foreach($activity as $act)
                                    @if(isset($act))
                                        <div id="tab-content-activity-{{ $act->id }}" class="tab-content">
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

                                                        <small class="badge badge-danger"
                                                               style="float: left;top: 4rem;position: absolute;left: 4rem;">
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
                                                          action="{{ route('lessons.activity', [$act->slug])}}"
                                                          enctype="multipart/form-data">
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
                                                        <div style="margin-top: 20px file-upload">
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

                                                            <button class="btn btn-check"
                                                                    style=
                                                                    type="submit">
                                                                @lang('buttons.general.crud.send')</button>
                                                    </form>
                                                @endif

                                            </div>

                                        </div>
                                    @endif
                                @endforeach
                            @endif

                        </div>

                    </div>
                    <div class="tabs-part">
                        <div class="tabs-details">
                            <div class="div1">
                                <h1>محتوى الدورة </h1>
                                @php
                                    $currentPage=request()->segment(count(request()->segments()));

                                     $lessonCourse = $course;
                                     $mainLesson = $lesson ?? [];

                                     $chapters = $lessonCourse->chapters()->orderBy('sequence', 'asc')->get();
                                     
                                @endphp
                                <div class="tabs">
                                    @if(!$chapters->isEmpty())
                                        @foreach ($lessonCourse->chapters()->orderBy('sequence', 'asc')->get() as $key => $chapter)

                                            @if(count($chapter->lessons) > 0)
                                                <div class="collapse-section">
                                                    <div class="collapse-header"
                                                         data-target="content-chapter-{{ $chapter->id}}">
                                                        <i class="fas fa-play" style="margin-left:10px"></i>
                                                        {{  session('locale') == 'ar' ? $chapter->title_ar ?? $chapter->title : $chapter->title }}
                                                    </div>
                                                    @php
                                                        $chapterLessons = $chapter->lessons->where('published', 1);

                                                    @endphp
                                                    <div id="content-chapter-{{ $chapter->id}}"
                                                         class="collapse-content">
                                                        @php
                                                            // Get all GroupTimeline items for the specified group_id, sorted by sequence
                                                            $groupTimelines = \App\Models\GroupTimeline::where('group_id', $group->id)
                                                                ->whereIn('model_type', ['App\Models\Lesson', 'App\Models\CourseGroupTest'])
                                                                ->orderBy('sequence')->get();

                                                            // Initialize an empty collection to hold the sorted items
                                                            $sortedItems = collect();


                                                            // Foreach GroupTimeline item...
                                                            foreach ($groupTimelines as $groupTimeline) {
                                                                // Get the related Lesson or Test item
                                                                $relatedItem = $groupTimeline->model;
                                                                // Add the related item to the sorted items collection
                                                                $sortedItems->push($relatedItem);
                                                            }


                                                            // Get the IDs of the lessons and tests in the GroupTimeline
                                                            $chapterLesson = $sortedItems->whereInstanceOf(\App\Models\Lesson::class);

                                                            $chapterTest = $sortedItems->whereInstanceOf(\App\Models\CourseGroupTest::class);
                                                        @endphp

                                                        @foreach($chapterLesson as $chLesson)
                                                            @if($chLesson->chapter_id == $chapter->id)
                                                                <div class="tab" data-tab="lesson-{{ $chLesson->id }}">
                                                                    <span>{{ (app()->getLocale() == 'ar') ? $chLesson->title_ar : $chLesson->title }}</span>
                                                                </div>
                                                            @endif
                                                        @endforeach

                                                        @foreach($chapterTest as $chTest)

                                                                <div class="tab" data-tab="test-{{ $chTest->id }}">
                                                                    <span>{{ (app()->getLocale() == 'ar') ? $chTest->title_ar : $chTest->title }}</span>
                                                                </div>

                                                        @endforeach
                                                    </div>
                                                </div>
                                            @endif
                                        @endforeach

                                    @else
                                        @php
                                            $mainLesson != [] ? ($slugs = array_column($lessonCourse->lessons->where('published', 1)->toArray(), 'slug')) : ($slugs = []);
                                            // Get all GroupTimeline items for the specified group_id, sorted by sequence
                                            $groupTimelines = \App\Models\GroupTimeline::where('group_id', $group->id)
                                            ->whereIn('model_type', ['App\Models\Lesson', 'App\Models\CourseGroupTest'])
                                            ->orderBy('sequence')->get();

                                            // Initialize an empty collection to hold the sorted items
                                            $sortedItems = collect();
                                            // Foreach GroupTimeline item...
                                            foreach ($groupTimelines as $groupTimeline) {
                                            // Get the related Lesson or Test item
                                            $relatedItem = $groupTimeline->model;
                                            // Add the related item to the sorted items collection
                                            $sortedItems->push($groupTimeline);
                                            }
                                        @endphp
                                        @foreach ($sortedItems as $item)
                                            @if($item->model_type == 'App\Models\Lesson')
                                                @foreach($lessonCourse->lessons as $lesson)
                                                    @if($item->model->id == $lesson->id)
                                                        <div class="tab" data-tab="lesson-{{ $lesson->id }}">
                                                            <span>
                                                                {{ (app()->getLocale() == 'ar') ? $lesson->title_ar : $lesson->title }}

                                                                @php
                                                                    $lesson_time = $group->courseLessons()->where('lesson_id', $lesson->id)->first();
                                                                    $start = $lesson_time->pivot->start_time;
                                                                    $dateTime = new \DateTime($start);
                                                                @endphp
                                                                @if($start && $lesson_time && $course->type_id != 1)
                                                                    <span class="badge badge-secondary">
                                                                            {{ $lesson_time->pivot->date.' ('.$dateTime->format('h:i A') }})
                                                                        </span>
                                                                @endif

                                                            </span>
                                                        </div>
                                                    @endif
                                                @endforeach

                                            @elseif($item->model_type == 'App\Models\CourseGroupTest')
                                                @foreach($course_tests as $test)
                                                    @if($item->model->id == $test->id)
                                                        <div class="tab" data-tab="test-{{ $test->id }}">
                                                            <span>{{ (app()->getLocale() == 'ar') ? $test->title_ar : $test->title }}</span>
                                                        </div>
                                                    @endif
                                                @endforeach
                                            @endif
                                        @endforeach
                                    @endif
                                </div>
                                <div class="div2">

                                    <div class="tab" data-tab="chat"><h1> النقاشات </h1></div>

                                </div>

                                <div class="tab" data-tab="rates"><h1>التقييمات </h1></div>


                            </div>

                            @if(count($activity)>0)
                                <div class="div4">
                                    <button id="toggleButton2" class="collapse-header tab"
                                            data-target="content-activity">
                                        <h1>
                                            النشاط
                                        </h1>
                                    </button>


                                    <div id="content-activity" class="collapse-content">
                                        @foreach($activity as $act)
                                            <div class="tab" data-tab="activity-{{ $act->id }}">
                                                <span>
                                                    {{ (app()->getLocale() == 'ar') ? $act->title_ar : $act->title }}
                                                </span>
                                            </div>
                                        @endforeach
                                    </div>
                                </div>
                            @endif

                            @if (count($impactMeasurments) > 0 || count($programRecommendations) > 0)
                                <div class="div5">
                                    <button id="toggleButton2" class="collapse-header tab"
                                            data-target="content-others"><h1>النماذج</h1></button>

                                    <div id="content-others" class="collapse-content">
                                        @if(count($impactMeasurments) > 0)
                                            <div class="collapse-section">
                                                <div class="collapse-header" style="color: #666;"
                                                     data-target="content-impact">
                                                    <i class="fas fa-play" style="margin-left:10px"></i>
                                                    @lang('labels.frontend.course.impact')
                                                </div>

                                                <div id="content-impact"
                                                     class="collapse-content">
                                                    @foreach($impactMeasurments as $item)
                                                        <div class="tab" data-tab="impacts-{{ $item->id }}">
                                                            <span>
                                                                {{ session('locale') == 'ar' ? $item->impact_ar ?? $item->impact_ar : $item->impact }}
                                                            </span>
                                                        </div>
                                                    @endforeach
                                                </div>
                                            </div>
                                        @endif

                                        @if(count($programRecommendations) > 0)
                                            <div class="collapse-section">
                                                <div class="collapse-header" style="color: #666;"
                                                     data-target="content-reccomendations">
                                                    <i class="fas fa-play" style="margin-left:10px"></i>
                                                    @lang('labels.frontend.course.programRec')
                                                </div>

                                                <div id="content-reccomendations"
                                                     class="collapse-content">
                                                    @foreach($programRecommendations as $item)
                                                        <div class="tab" data-tab="reccomendations-{{ $item->id }}">
                                                        <span>
                                                            {{ session('locale') == 'ar' ? $item->recommendation_ar ?? $item->recommendationt_ar : $item->recommendation }}
                                                        </span>
                                                        </div>
                                                    @endforeach
                                                </div>
                                            </div>
                                        @endif

                                    </div>
                                </div>
                            @endif

                        </div>
                    </div>
                </div>

                <div class="small-part">
                    <div class='links-part'>
                        <div class="tabs-part">
                            <div class="progress">
                                <div class="progress-bar "
                                     id="progress-bar"
                                     style='width:{{ $course->progress($group->id) ? $course->progress($group->id) : 0 }}%'
                                     role="progressbar" aria-valuenow="0" aria-valuemin="0" aria-valuemax="100">
                                            <span style="color:{{$course->progress($group->id)?'white':'#641225'}}"
                                                  class="color">{{ $course->progress($group->id) ? $course->progress($group->id) : 0 }}%</span>
                                </div>
                            </div>
                            <div class="tabs-details">
                                <div class="tab" data-tab="10">
                                    <a class="list-group-item list-group-item-action list-group-item-light p-3 active "
                                       href="{{ route('admin.dashboard') }}">
                                        <i class="fa fa-area-chart primary-color"></i> @lang('labels.backend.dashboard.my_courses')
                                    </a>
                                </div>
                                <div class="tab" data-tab="11">
                                    <a class="list-group-item list-group-item-action list-group-item-light p-3 active"
                                       href="{{ route('admin.certificates.index') }}">
                                        <i class="fa fa-graduation-cap primary-color"></i> @lang('navs.general.certificates')
                                    </a>
                                </div>
                                <div class="tab" data-tab="12">
                                    <a class="list-group-item list-group-item-action list-group-item-light p-3 active"
                                       href="{{ route('admin.account') }}">
                                        <i class="fa fa-user primary-color"></i> @lang('navs.general.profile')
                                    </a>
                                </div>
                                @if ($data['lessonCourse']->progress($group->id) >= 50)
                                    @if (!$data['lessonCourse']->isUserCertified())
                                        <div class="tab" data-tab="13">
                                            <form method="post"
                                                  action="{{ route('admin.certificates.generate') }}">
                                                @csrf
                                                <input type="hidden" value="{{ $course->id }}"
                                                       name="course_id">
                                                <input type="hidden" value="{{ $group->id }}"
                                                       name="group_id">
                                                <button id="finish" class="list-group-item list-group-item-action list-group-item-light p-3 active"
                                                        style="display: flex;justify-content: center;"
                                                        role="button">
                                                    <span style="text-align:center">
                                                        @if ($days > 0)
                                                            @lang('labels.frontend.course.finish_course')
                                                        @else
                                                            <i class="fa fa-certificate primary-color"></i> @lang('labels.frontend.course.get_certificate')
                                                        @endif
                                                    </span>

                                                </button>


                                            </form>
                                        </div>

                                    @endif
                                @endif
                            </div>
                        </div>
                    </div>
                    <div class="second">
                        <div class="invite-part">
                            <div id="emailFieldsContainer">
                                <div class="email-field">
                                    <input type="email" name="email[]" placeholder="Enter friend's email" required>
                                    <button type="button" class="email_new newbtn">+</button>
                                </div>
                            </div>
                            <div id="emailListContainer"></div>
                            <button type="button" class='newbtn emailSendBtn'>دعوه</button>
                        </div>
                    </div>
                </div>

            </div>
        </div>
    </div>

@endsection

@push('after-scripts')


    <script>
        const originalConsoleError = console.error;
        console.error = function(message, ...optionalParams) {
            originalConsoleError.apply(console, arguments);
            if (message && typeof message === 'object' && (message.type === 'JOIN_MEETING_FAILED' || message.errorCode === 3707 || message.errorCode === 200)) {
                $('.successMessage').html("<div class='alert alert-danger' role='alert'>" +
                    "@lang('alerts.frontend.zoom.meeting_not_allowed')" +
                    "<button type='button' class='close' data-dismiss='alert' aria-label='Close'>" +
                    "<span aria-hidden='true'>&times;</span>" +
                    "</button>" +
                    "</div>");
            }

            console.log("asd")
        };
    </script>
    {{-- <script>
        const tabs = document.querySelectorAll('.tabs-details .tab');
        const contents = document.querySelectorAll('.tabs-details .tab-content');

        tabs.forEach(tab => {
            tab.addEventListener('click', () => {
                // Remove active class from all tabs and content
                tabs.forEach(t => t.classList.remove('active'));
                contents.forEach(c => c.classList.remove('active'));

                // Add active class to the clicked tab and corresponding content
                tab.classList.add('active');
                document.getElementById(`tab-content-${tab.getAttribute('data-tab')}`).classList.add(
                    'active');

                // Return to top of the page
                window.scrollTo(0, 0);
            });
        });
    </script> --}}
    <script>
        const tabs = document.querySelectorAll('.tabs-details .tab');
        const contents = document.querySelectorAll('.tabs-details .tab-content');
    
        tabs.forEach(tab => {
            tab.addEventListener('click', () => {
                // Remove active class from all tabs and content
                tabs.forEach(t => t.classList.remove('active'));
                contents.forEach(c => c.classList.remove('active'));
    
                // Add active class to the clicked tab and corresponding content
                tab.classList.add('active');
                const content = document.getElementById(`tab-content-${tab.getAttribute('data-tab')}`);
                content.classList.add('active');
    
                // Scroll to the corresponding content
                content.scrollIntoView({
                    behavior: 'smooth', // Smooth scrolling animation
                    block: 'start'      // Scroll to the start of the content
                });
            });
        });
    </script>
    
    <script src="https://cdn.plyr.io/3.6.8/plyr.polyfilled.js"></script>
    <!-- Dependencies for client view and component view -->
    <script src="https://source.zoom.us/3.7.0/lib/vendor/react.min.js"></script>
    <script src="https://source.zoom.us/3.7.0/lib/vendor/react-dom.min.js"></script>
    <script src="https://source.zoom.us/3.7.0/lib/vendor/redux.min.js"></script>
    <script src="https://source.zoom.us/3.7.0/lib/vendor/redux-thunk.min.js"></script>
    <script src="https://source.zoom.us/3.7.0/lib/vendor/lodash.min.js"></script>
    <script src="{{ asset('iv') }}/assets/rating/js/star-rating.js"></script>
    <script>
        $(document).on('change', 'input[name="stars"]', function () {
            $('#rating').val($(this).val());

        })
    </script>
    <!-- Choose between the client view or component view: -->
<script>
    $(document).ready(function() {
        let emails = [];

        function addEmailField() {
            const emailInput = $("input[name='email[]']");
            const email = emailInput.val().trim();

            if (email !== "") {
                emails.push(email);
                updateEmailList();
                emailInput.val("");
            }
        }

        function updateEmailList() {
            const emailListContainer = $("#emailListContainer");
            emailListContainer.empty();

            emails.forEach((email, index) => {
                const emailItem = $("<div>").addClass("email-item").text(email);
                const removeButton = $("<button>")
                    .attr("type", "button")
                    .text("x")
                    .addClass("newbtn")
                    .on("click", () => removeEmail(index));
                emailItem.append(removeButton);
                emailListContainer.append(emailItem);
            });
        }

        function removeEmail(index) {
            emails.splice(index, 1);
            updateEmailList();
        }

        $(".email_new").on("click", addEmailField);


        $(".emailSendBtn").on("click", function() {
            const userId = "{{ auth()->user()->id }}";
            const courseId = "{{ $course->id }}";

            $.ajax({
                url: "{{ route('courses.sendInvitation') }}",
                method: "POST",
                data: {
                    "_token": "{{ csrf_token() }}",
                    "emails": emails,
                    "user_id": userId,
                    "course_id": courseId
                },
                success: function(response) {
                    $('.successMessage').html("<div class='alert alert-success' role='alert'>" +
                        "@lang('alerts.frontend.invitation.invited')" +
                        "<button type='button' class='close' data-dismiss='alert' aria-label='Close'>" +
                        "<span aria-hidden='true'>&times;</span>" +
                        "</button>" +
                        "</div>");

                    emails = [];
                    updateEmailList();
                },
                error: function(error) {
                    $('.successMessage').html("<div class='alert alert-danger' role='alert'>" +
                        "@lang('alerts.frontend.invitation.error')" +
                        "<button type='button' class='close' data-dismiss='alert' aria-label='Close'>" +
                        "<span aria-hidden='true'>&times;</span>" +
                        "</button>" +
                        "</div>");
                }
            });
        });
    });
</script>
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
                                width: 400,
                                height: 300
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

        $(document).ready(function () {


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
                success: function (response) {
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
                error: function (error) {
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
                success: function (response) {
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
                        @if($course->type_id != 1)
                            // Mark lesson as completed
                            courseCompleted(lessonId, "{{ \App\Models\Lesson::class }}");
                        @endif

                    }
                },
                error: function (error) {
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
    <script>
        const headers = document.querySelectorAll('.collapse-header');

        headers.forEach(header => {
            header.addEventListener('click', () => {
                const targetId = header.getAttribute('data-target');
                const content = document.getElementById(targetId);
                console.log(targetId);
                console.log(content);


                header.classList.toggle('active');


                content.classList.toggle('active');
            });
        });
    </script>
    {{-- <script>
        
        function addEmailField() {
            // Create a new div for the email input and button
            const emailFieldsContainer = document.getElementById("emailFieldsContainer");
            const newField = document.createElement("div");
            newField.classList.add("email-field");

            // Create the input element
            const newInput = document.createElement("input");
            newInput.type = "email";
            newInput.name = "email[]";
            newInput.placeholder = "Enter friend's email";
            newInput.required = true;

            // Add the input to the new div
            newField.appendChild(newInput);

            // Optionally add the button to add more fields
            const newButton = document.createElement("button");
            newButton.type = "button";
            newButton.textContent = "+";
            newButton.onclick = addEmailField;
            newField.appendChild(newButton);

            // Append the new div to the container
            emailFieldsContainer.appendChild(newField);
        }

        function sendInvitations() {
            const emailInputs = document.querySelectorAll('input[type="email"]');
            const emails = [];
            const userId = "{{ auth()->user()->id }}";
            const courseId = "{{ $course->id }}";

            emailInputs.forEach(input => {
                emails.push(input.value);
            });

            $.ajax({
                url: "{{ route('courses.sendInvitation') }}", // Update with your actual endpoint
                method: "POST",
                data: {
                    "_token": "{{ csrf_token() }}", // Ensure CSRF token is included
                    "emails": emails,
                    "user_id": userId,
                    "course_id": courseId
                },
                success: function(response) {
                    $('.successMessage').html("<div class='alert alert-success' role='alert'>" +
                       @lang('alerts.frontend.invitation.invited') +
                        "<button type='button' class='close' data-dismiss='alert' aria-label='Close'>" +
                        "<span aria-hidden='true'>&times;</span>" +
                        "</button>" +
                        "</div>");

                    // Clear the email fields
                    emailInputs.forEach(input => {
                        input.value = "";
                    });

                },
                error: function(error) {
                    $('.successMessage').html("<div class='alert alert-danger' role='alert'>" +
                            @lang('alerts.frontend.invitation.error') +
                        "<button type='button' class='close' data-dismiss='alert' aria-label='Close'>" +
                        "<span aria-hidden='true'>&times;</span>" +
                        "</button>" +
                        "</div>");
                }
            });
        }
    </script> --}}
    <script>
        $(document).ready(function() {
            const originalConsoleError = console.error;
            console.error = function(message, ...optionalParams) {
                originalConsoleError.apply(console, arguments);
                if (message.type === 'JOIN_MEETING_FAILED' || message.errorCode === 3707 || message.errorCode === 200) {
                    $('.successMessage').html("<div class='alert alert-danger' role='alert'>" +
                        "@lang('alerts.frontend.zoom.meeting_not_allowed')" +
                        "<button type='button' class='close' data-dismiss='alert' aria-label='Close'>" +
                        "<span aria-hidden='true'>&times;</span>" +
                        "</button>" +
                        "</div>");
                }
            };
        });


    </script>
@endpush
