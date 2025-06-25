@extends('frontend.layouts.app'.config('theme_layout'))

@section('title', trans('labels.frontend.home.title') . ' | ' . app_name())
@section('meta_description', '')
@section('meta_keywords', '')


@push('after-styles')
    <link rel="stylesheet" href="https://cdn.plyr.io/3.5.3/plyr.css" />
    <link href="{{ asset('plugins/touchpdf-master/jquery.touchPDF.css') }}" rel="stylesheet">

    <link href="{{ asset('iv') }}/assets/rating/css/star-rating.css" media="all" rel="stylesheet" type="text/css" />
    <link href="{{ asset('iv') }}/assets/rating/themes/krajee-svg/theme.css" media="all" rel="stylesheet"
        type="text/css" />

    <link rel="stylesheet" href="{{ asset('iv') }}/css/course_curriculum.css" />
    <style>
        .x-notification{
            margin-top: 30px;
        }
        .zoom_lnk{
            display: flex;
            justify-content: center;
            align-items: center;
    
            border: 1px solid;
            margin-top: 10px;
            margin-bottom: 10px;
            margin-right: -18px;
            border-radius: 10px;
        }
        .zoom_lnk:hover{
          
           
            box-shadow: 0px 2px 8px rgb(0 0 0 / 16%);
            border-color: #7f3846;
           
        
            border-width: 5px;
            transition: all 0.2s ease-out;
        }
        .zoom_lnk img{
            
                position:relative;
                -webkit-animation:glide 2s ease-in-out alternate infinite;
                margin-bottom: 13px;
                box-shadow: 0px 15px 10px -15px 
        }
        @-webkit-keyframes glide  {
            from {
                left:0px;
                top:-3px;
            }
            
            to {
                left:0px;
                top:3px;
            }

        }

 

        .list-body {
            margin: 9px;
            border-radius: 13px;
            background-color: #eeeeee;
            color: #3bcfcb!important;

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
            @if (session('locale') == 'ar')margin-right: -2.3em;
        @else margin-left: -2.3em;
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
            @if (session('locale') == 'ar')margin-right: -2.3em;
        @else margin-left: -2.3em;
            @endif
            /* same as padding-left set on li */
            width: 1.3em;
            /* same as padding-left set on li */
        }
        .white-normal{
            white-space: normal;
            line-height: normal;
        }
    </style>

    <link rel="stylesheet" href="{{ asset('iv') }}/css/course-sidebar-right.css" />
    <link rel="stylesheet" href="{{ asset('iv') }}/css/course_curriculum.css" />

    <link rel="stylesheet" href="https://code.jquery.com/ui/1.12.1/themes/base/jquery-ui.css">
    <link rel="stylesheet" href="//cdnjs.cloudflare.com/ajax/libs/timepicker/1.3.5/jquery.timepicker.min.css">
    @if (session('locale') == 'en')
        <style>
            .list-group-item, .list-group .card-body {
                margin-right: 10px;
            }

        </style>

    @endif
@endpush

@section('content')

    @php
    use App\Models\Forms;
    if (get_class($lesson) == 'App\Models\Forms') {
        $lessonCourse = $lesson->getcourseById($course_id);
    } else {
        $lessonCourse = $lesson->course;
    }

    @endphp
 @php
 use Carbon\Carbon;
 
 $days=0;
 if(count(auth()->user()->courseLoc($course->id)->get())>0){
     if($course->free!=1){
     $courseLocId=isset($course_location_id)?$course_location_id:auth()->user()->courseLoc($course->id)->latest('pivot_created_at')->first()->pivot->course_location_id;
    $courseLocation=\App\Models\CourseLocation::find($courseLocId) ;
    
   
    $isEndDatePast = Carbon::parse($courseLocation->end_date)->isPast();
     if($isEndDatePast==true){
         $days=0;
     }
     else{
         $days=now()->diffInDays($courseLocation->end_date);
     }
 }
 
 }

 @endphp
    {{-- @if ($IsUserFilledData == false)
        <div class="alert alert-danger">
            <a href="{{ route('admin.account') }}"><i class="fa fa-edit"></i> @lang('validation.complete-data')</a>
        </div>
    @endif --}}
    <div id="x-notify-container"></div>

    <section class="row the-slider" id="slider">
        <div style="background-size: cover;height:fit-content;background-color: white;padding-bottom: 20px;">
            <div class="containers">
                <div class="row benefit-notes">
                    <div class="col-sm-12 col-md-12   wow fadeInUp2  course-nav mt-0">
                        <nav class="navbar navbar-default second-nav" style="position: unset">
                            <div class="container">
                                <!--========== Brand and toggle get grouped for better mobile display ==========-->


                                <div class="nav navbar-nav  col-md-6">
                                    <button type="button" onclick="toggleShow()" id="sidebarToggle"
                                        class="Button Button--link course-nav-toggle" aria-live="polite"
                                        aria-label="إخفاء قائمة التنقل بين الدورات" title="إخفاء قائمة التنقل بين الدورات">
                                        <i class="fa fa-bars" aria-hidden="true"></i>
                                    </button>
                                </div>
                                <div class="nav navbar-nav navbar-left col-md-6"></div>
                                <!--========== Collect the nav links, forms, and other content for toggling ==========-->

                                <div class="pull-right col-md-3 col-xs-6  ">
                                    <div class="progress">
                                        <div class="progress-bar "
                                            style='width:{{ $lessonCourse->progress() ? $lessonCourse->progress() : 0 }}%'
                                            role="progressbar" aria-valuenow="0" aria-valuemin="0" aria-valuemax="100">
                                            <span class="color-primary text-color">{{ $lessonCourse->progress() ? $lessonCourse->progress() : 0 }}%</span>
                                        </div>


                                    </div>
                                </div>
                                <div class="pull-right col-md-3 col-xs-6 mb-10 ">
                                @if($days>0)
                                   @include('frontend.courses.remaining_days')
                                 @endif
                                </div>
                            </div>

                        </nav>
                        <!--========== /.navbar-collapse ==========-->
                    </div>
                    <!--========== /.container-fluid ==========-->

                    <div class="top-banner"></div>

                </div>
                <!-- ===========course details part1============ -->
                <!--==========course description right==========-->
                <div class="row">

                    <div class="container">
                        <div class="col-sm-12 col-md-3  benefit wow fadeInUp ptb-50 course-content mt-0" id="sidebar-right">
                            <!-- Sidebar right-->

                            @php
                                $show_course_lesson=1;
                            @endphp
                            @include('frontend.courses.course_sidebar_right')

                            {{-- Sidebar right --}}

                            {{-- Sidebar right --}}
                        </div>
                        <!--/*==========course description right ==========-->

                        <!--==========course description details ==========-->

                        <div class="col-sm-12 col-md-9  benefit wow fadeInUp ptb-50 course-content mt-0" id="les-content">
                            {{-- conten lesson --}}
                            <div class="container " style="width: 100%;padding-right: 29px;">
                                <div class="row main-content" style="margin-left: unset">
                                    <div class=" col-sm-12 col-md-10" style="width: 100%">
                                        @if (session()->has('success'))
                                            <div class="alert alert-dismissable alert-success fade show">
                                                <button type="button" class="close"
                                                    data-dismiss="alert">&times;</button>
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
                                       

                                        {{--  --}}
                                        <div class="course-single-text">
                                            <div class="course-title mt10 headline relative-position">
                                                <h3 style="margin: 30px 0">
                                                    <b>
                                                        @if (session('locale') == 'ar')
                                                        {{ $lesson->title_ar }} @else {{ $lesson->title }}
                                                        @endif
                                                    </b>
                                                </h3>
                                            </div>
                                            <hr>
                                            {{-- <div class="course-details-content">
                                                @if (session('locale') == 'ar')
                                                    {!! $lesson->full_text_ar ?? $lesson->full_text !!}
                                                @else {!! $lesson->full_text !!} @endif
                                            </div> --}}
                                        </div>
                                        {{--  --}}
                                        <div class="course-details-item border-bottom-0 mb-0">
                                            @if ($lesson->lesson_image != '')
                                                <div class="course-single-pic mb30">
                                                    <img style="    width: 100%;
                                                    height: 300px;
                                                    object-fit: contain;
                                                    margin-bottom: 10px;" src="{{ asset('storage/uploads/' . $lesson->lesson_image) }}"
                                                        alt="">
                                                </div>
                                            @endif

                                            
         
                                            {{-- @dd($lesson->mediaVideo); --}}
                                    
                                            @if ($lesson->mediaVideo && $lesson->mediavideo->count() > 0)
                                                <div class="course-single-text">
                                                    @if ($lesson->mediavideo != '')
                                                        <div class="course-details-content mt-3">
                                                            <div class="video-container mb-5"
                                                                data-id="{{ $lesson->mediavideo->id }}">
                                                                @if ($lesson->mediavideo->type == 'youtube')


                                                                    <div id="player" class="js-player"
                                                                        data-plyr-provider="youtube"
                                                                        data-plyr-embed-id="{{ $lesson->mediavideo->file_name }}">
                                                                    </div>
                                                                @elseif($lesson->mediavideo->type == 'vimeo')
                                                                    <div id="player" class="js-player"
                                                                        data-plyr-provider="vimeo"
                                                                        data-plyr-embed-id="{{ $lesson->mediavideo->file_name }}">
                                                                    </div>
                                                                @elseif($lesson->mediavideo->type == 'upload')
                                                              
                                                                    <video poster="" id="player" class="js-player"
                                                                        playsinline controls>
                                                                        <source src="{{ $lesson->mediavideo->url }}"
                                                                            type="video/mp4" />
                                                                    </video>
                                                                @elseif($lesson->mediavideo->type == 'embed')
                                                                    {!! $lesson->mediavideo->url !!}
                                                                    @elseif($lesson->mediavideo->type == 'zoom')
                                                                    <a style="padding:10px;color:#701f33" target="_blank" href="{{$lesson->mediavideo->url}}" class="zoom_lnk">
                                                                        @lang('labels.backend.lessons.fields.zoom_video')
                                                                        </a>
                                                                @endif
                                                            </div>
                                                        </div>
                                                    @endif
                                                </div>
                                            @endif

                                            @if ($lesson->mediaAudio)
                                                <div class="course-single-text mb-5">
                                                    <audio id="audioPlayer" controls>
                                                        <source src="{{ $lesson->mediaAudio->url }}" type="audio/mp3" />
                                                    </audio>
                                                </div>
                                            @endif


                                            <div class="course-single-text" style="margin: 14px">
                                                {{-- <div class="course-title mt10 headline relative-position">
                                                    <h3 style="margin: 30px 0">
                                                        <b>
                                                            @if (session('locale') == 'ar')
                                                            {{ $lesson->title_ar }} @else {{ $lesson->title }}
                                                            @endif
                                                        </b>
                                                    </h3>
                                                </div> --}}
                                                <div class="course-details-content">
                                                    @if (session('locale') == 'ar')
                                                        {!! $lesson->full_text_ar ?? $lesson->full_text !!}
                                                    @else {!! $lesson->full_text !!} @endif
                                                </div>

                                            </div>
                                            @if(isset($lesson->zoom_link))
                                                {{-- zoom --}}
                                                <hr>
                                            <div class="course-details-item border-bottom-0 mb-0 col-lg-12 ">
                                                <h3 style="margin-bottom: 17px;">@lang('labels.backend.lessons.fields.zoom_link')</h3>
                                            <a  target="_blank" href="{{$lesson->zoom_link}}" class="zoom_lnk">
                                            <img style="width: 36%" src="{{asset('images/zoom-1.png')}}" alt="">
                                            </a>
                                        
                                        </div>
                                        {{-- zoom --}}
                                        @endif
                                            @if ($lesson->mediaPDF)
                                                @if ($IsUserFilledData)
                                                    <div class="course-single-text mb-5">
                                                        <iframe
                                                            src="{{ asset('storage/uploads/' . $lesson->mediaPDF->name) }}"
                                                            width="100%" height="500px">
                                                        </iframe>
                                                        {{-- <div id="myPDF"></div> --}}

                                                    </div>


                                                @else

                                                    <div class="course-single-text mb-5">
                                                        <iframe
                                                            src="{{ asset('storage/uploads/' . $lesson->mediaPDF->name . '#toolbar=0') }}"
                                                            width="100%" height="500px">
                                                        </iframe>
                                                        {{-- <div id="myPDF"></div> --}}

                                                    </div>
                                                @endif
                                            @endif


                                                  
                                            @if ($lesson->downloadableMedia != '' && $lesson->downloadableMedia->count() > 0)
                                                <div class="course-single-text mt-4 px-3 py-1 gradient-bg ">
                                                    <div class="course-title mt10 headline relative-position">
                                                        <h4>
                                                            @lang('labels.frontend.course.download_files')
                                                        </h4>
                                                    </div>
                                                    @php
                                                        $lessonType=get_class($lesson);
                                                    @endphp
                                                    @foreach ($lesson->downloadableMedia as $media)
                                                        <div class="course-details-content">
                                                            <p class="form-group">
                                                                @if($lessonType=='App\Models\Lesson')
                                                                <a href="{{ route('download', ['filename' => $media->name, 'lesson' => $lesson->id]) }}"
                                                                    class="font-weight-bold"><i class="fa fa-download"></i>
                                                                    {{ $media->name }}
                                                                    ({{ number_format((float) $media->size / 1024, 2, '.', '') }}
                                                                    @lang('labels.frontend.course.mb')
                                                                    )</a>
                                                                    @else
                                                                    <a href="{{ route('download', ['filename' => $media->name, 'test' => $lesson->id]) }}"
                                                                        class="font-weight-bold"><i class="fa fa-download"></i>
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



                                        

                                            @if ($test_exists)

                                                {{-- <hr /> --}}
                                                @if (!is_null($test_result))
                                               
                                                    <div class="alert alert-info">
                                                        @lang('labels.frontend.course.your_test_score') :
                                                        {{ $test_result->test_result }}</div>

                                                    @if (count($lesson->questions) > 0)
                                                        <hr>

                                                        @foreach ($lesson->questions as $question)
                                                        <h3 class="color-primary text-color" style="margin-bottom: 35px;">
                                                           
                                                            {{Lang::locale()=='en'?$question->title:$question->title_ar}}
                                                        </h3>
                                                            <h4 class="mb-0">{{ $loop->iteration }}
                                                                {!! Lang::locale()=='ar'?$question->question_ar:$question->question !!}
                                                                @if (!$question->isAttempted($test_result->id))
                                                                    <small class="badge badge-danger">
                                                                        @lang('labels.frontend.course.not_attempted')</small>
                                                                @endif
                                                            </h4>
                                                            <br />
                                                            <ul class="options-list pl-4">


                                                                @if (sizeof($question->options) && $question->question_type == 'multiple_choice')
                                                                    @foreach ($question->options as $option)

                                                                        <li class="@if (($option->answered($test_result->id) != null && $option->answered($test_result->id) == 1) || $option->correct == true) correct @elseif($option->answered($test_result->id) != null && $option->answered($test_result->id) == 2) incorrect  @endif">
                                                                            {{ Lang::locale()=='en'?$option->option_text: $option->option_text_ar}}

                                                                            @if ($option->correct == 1 && $option->explanation != null)
                                                                                <p class="text-dark"
                                                                                    style="color:#802c41 !important">
                                                                                    <b>@lang('labels.frontend.course.explanation')</b><br>
                                                                                    {{ $option->explanation }}
                                                                                </p>
                                                                            @endif
                                                                        </li>

                                                                    @endforeach
                                                                @elseif (sizeof($question->options) &&
                                                                    $question->question_type=="drop_down")
                                                                    <select name="questions[{{ $question->id }}]"
                                                                        class="form-control">
                                                                        @foreach ($question->options as $option)
                                                                            <option @if (($option->answered($test_result->id) != null && $option->answered($test_result->id) == 1) || $option->correct == true)  selected @endif
                                                                                value="{{ $option->id }}">
                                                                                {{ Lang::locale()=='en'?$option->option_text:$option->option_text_ar }}
                                                                            </option>
                                                                        @endforeach
                                                                    </select>
                                                                @else
                                                                
                                                                    @switch($question->question_type)
                                                                        @case("paragraph")
                                                                        
                                                                            <textarea type="text" class="form-control editor"
                                                                                placeholder="paragraph" style="height:100px"
                                                                                name="questions[{{ $question->id }}]">{{ @test_res($test_result->id, $question->id)->option_id }}</textarea>
                                                                        @break
                                                                        @case("short_answer")
                                                                            <input type="text" class="form-control"
                                                                                value="{{ @test_res($test_result->id, $question->id)->option_id }}"
                                                                                placeholder="short_answer"
                                                                                name="questions[{{ $question->id }}]" />
                                                                        @break
                                                                        @case("date")
                                                                            <input type="text" class="form-control datepicker"
                                                                                value="{{ @test_res($test_result->id, $question->id)->option_id }}"
                                                                                placeholder="date"
                                                                                name="questions[{{ $question->id }}]" />
                                                                        @break
                                                                        @case("time")
                                                                            <input type="text" class="form-control timepicker"
                                                                                value="{{ @test_res($test_result->id, $question->id)->option_id }}"
                                                                                placeholder="time"
                                                                                name="questions[{{ $question->id }}]" />
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

                                                                    <p class=" warning  ">@if (!empty(test_res($test_result->id, $question->id)->option_id))   @lang('labels.frontend.course.will_be_revied') @endif</p>




                                                                @endif



                                                            </ul>
                                                            <br />
                                                        @endforeach
                                                        @if (config('retest'))
                                                            <div class="row main-content" style="margin-bottom: 60px;">
                                                                <div class="col-4 offset-4" style="margin-right: 30%;">
                                                                    {{-- <form action="{{ route('lessons.retest', [$test_result->test->slug]) }}"
                                                                    method="post"> --}}
                                                                   
                                                                    <form
                                                                        {{-- action="{{ route('lessons.retest', [$test_result->test->first()->test->slug]) }}" --}}
                                                                        action="{{ route('lessons.retest', [$test_result->test->test->slug]) }}"
                                                                       
                                                                        method="post">

                                                                        @csrf
                                                                        <input type="hidden" name="result_id"
                                                                            value="{{ $test_result->id }}">

                                                                        <button class="retest next-button" role="button" style="justify-content: center;">
                                                                            <span>
                                                                                @lang('labels.frontend.course.give_test_again')
                                                                            </span>
                                                                            <div class="icon">
                                                                                <i class="fa fa-repeat"></i>
                                                                                <i class="fa fa-check"></i>
                                                                            </div>
                                                                        </button>


                                                                    </form>
                                                                </div>
                                                            </div>
                                                            <div class="clear"></div>
                                                        @endif
                                                    @else
                                                        <h3>@lang('labels.general.no_data_available')</h3>
                                                    @endif
                                                @else
                                                    <div class="test-form">
                                                        @if (count($lesson->questions) > 0)
                                                            <form action="{{ route('lessons.test', [$lesson->slug]) }}"
                                                                method="post" enctype="multipart/form-data">
                                                                {{ csrf_field() }}
                                                                @foreach ($lesson->questions as $question)
                                                                <h3 class="color-primary text-color" style="margin-bottom: 35px;">
                                                           
                                                                    {{Lang::locale()=='en'?$question->title:$question->title_ar}}
                                                                </h3>
                                                                    <h4 class="mb-0">{{ $loop->iteration }}.
                                                                        {!! Lang::locale()=='ar'?$question->question_ar:$question->question !!} </h4>
                                                                    <br />
                                                                    @if (sizeof($question->options) && $question->question_type == 'multiple_choice')
                                                                        @foreach ($question->options as $option)
                                                                            <div class="radio">
                                                                                <label>
                                                                                    <input type="radio"
                                                                                        name="questions[{{ $question->id }}]"
                                                                                        value="{{ $option->id }}" />
                                                                                        {{ Lang::locale()=='en'?$option->option_text:$option->option_text_ar }}
                                                                                        <br />
                                                                                </label>
                                                                            </div>
                                                                        @endforeach
                                                                    <hr>
                                                                    @elseif (sizeof($question->options) &&
                                                                        $question->question_type=="drop_down")
                                                                        <select name="questions[{{ $question->id }}]"
                                                                            class="form-control"
                                                                            style="padding: 7px 18px"
                                                                            style="padding: 7px 18px"
                                                                            >
                                                                            @foreach ($question->options as $option)
                                                                                <option value="{{ $option->id }}">
                                                                                    {{ Lang::locale()=='en'?$option->option_text:$option->option_text_ar }}

                                                                                </option>
                                                                            @endforeach
                                                                        </select>
                                                                    <hr>

                                                                    @else
                                                                        @switch($question->question_type)
                                                                            @case("paragraph")
                                                                                <textarea type="text"
                                                                                    class="form-control editor"
                                                                                    placeholder="paragraph" style="height:100px"
                                                                                    name="questions[{{ $question->id }}]"></textarea>
                                                                                    <hr>
                                                                                    @break
                                                                            
                                                                            @case("short_answer")
                                                                                <input type="text" class="form-control"
                                                                                    placeholder="short_answer"
                                                                                    name="questions[{{ $question->id }}]" />
                                                                                    <hr>
                                                                                    @break
                                                                            
                                                                            @case("date")
                                                                                <input type="text"
                                                                                    class="form-control datepicker"
                                                                                    placeholder="date"
                                                                                    name="questions[{{ $question->id }}]" />
                                                                                    <hr>
                                                                                    @break
                                                                            @case("time")
                                                                                <input type="text"
                                                                                    class="form-control timepicker"
                                                                                    placeholder="time"
                                                                                    name="questions[{{ $question->id }}]" />
                                                                                    <hr>
                                                                                    @break
                                                                            @case("file_upload")
                                                                                <div style="margin-top: 20px">
                                                                                    <label>
                                                                                        @lang('labels.frontend.course.or_upload')</label>
                                                                                    <input type="file"
                                                                                        name="answer_file_{{ $question->id }}">
                                                                                </div>
                                                                                <hr>
                                                                                @break
                                                                        @endswitch
                                                                    @endif
                                                                    <br />
                                                                @endforeach


                                                                <div
                                                                    style="position: relative;width: 300px;margin: auto;margin-bottom: 90px">
                                                                    <button style="height: 60px;            box-shadow: 5px 4px #cac5c5;
                                                                                height: 60px;
                                                                                border-radius: 10px;
                                                                                color: white;
                                                                                border-color: white;
                                                                                background-color: #4f198d;"
                                                                        class="next-button result-btn " role="button">
                                                                        <span>
                                                                            @lang('labels.frontend.course.submit_results')
                                                                        </span>
                                                                        <div class="icon">
                                                                            <i class="fa fa-save"></i>
                                                                            <i class="fa fa-check"></i>
                                                                        </div>
                                                                    </button>
                                                                </div>





                                                            </form>
                                                        @else
                                                            <h3>@lang('labels.general.no_data_available')</h3>

                                                        @endif
                                                    </div>
                                                @endif
                                            @endif

                                            {{-- split by line befor next prev buttons --}}
                                            <hr>
                                            <div class="course-details-category ul-li col-lg-12" style="margin-top: 30px">
                                                <div class="row main-content">

                                                    <div class="col-md-4" style="height: 64px">
                                                        @if ($previous_lesson && isset($previous_lesson->model->slug))



                                                            <a class="next-button next"
                                                            style="justify-content: center;"
                                                                href="{{ route('lessons.show', [$previous_lesson->course_id, $previous_lesson->model->slug,$course_location_id]) }}"
                                                                role="button">
                                                                <span> @lang('labels.frontend.course.prev') </span>
                                                                <div class="icon">
                                                                    {{-- <i class="fa fa-chevron-right"></i> --}}
                                                                    <i class="fa fa-check"></i>
                                                                </div>
                                                            </a>



                                                        @endif
                                                    </div>
                                                    <div class="col-md-4">
                                                        @if (!$lesson->isCompleted() && !$test_exists)
                                                            {{-- @if ($lesson->isCompleted() == false && $test_exists == false) --}}

                                                            <a href="#" class="next-button complete-btn next"
                                                            style="justify-content: center;width:50%"
                                                                @if (!$lesson->isCompleted()) onclick='courseCompleted("{{ $lesson->id }}", "{{ get_class($lesson) }}")' @endif role="button">
                                                                <span style="padding-left:3px"> @lang('labels.frontend.course.complete') </span>
                                                                <div class="icon">
                                                                    <i class="fa fa-check-circle"></i>
                                                                    {{-- <i class="fa fa-check"></i> --}}
                                                                </div>
                                                            </a>



                                                        @endif
                                                    </div>
                                                    <div class="col-md-4" style="height: 64px">
                                                        @if ($next_lesson && isset($next_lesson->model->slug))


                                                            <a class="next-button next"
                                                                href="{{ route('lessons.show', [$next_lesson->course_id, $next_lesson->model->slug,$course_location_id]) }}"
                                                                style="justify-content: center;"
                                                                role="button">
                                                                <span> @lang('labels.frontend.course.next') </span>
                                                                <div class="icon">
                                                                    {{-- <i class="fa fa-chevron-left"></i> --}}
                                                                    <i class="fa fa-check"></i>
                                                                </div>
                                                            </a>


                                                        @endif
                                                    </div>
                                                   
                                                    <div class="col-md-4 offset-4"
                                                        style="margin-top: 74px;margin-right: 26%; ">
                                                       
                                                        <form method="post" id="finishForm" style="display: none"
                                                        action="{{ route('admin.certificates.generate') }}">
                                                        @csrf
                                                        <input type="hidden" value="{{ $lessonCourse->id }}"
                                                            name="course_id">
                                                            <input type="hidden" value="{{ $course_location_id }}"
                                                            name="course_location_id">
                                                            
                                                        <button id="finishBtn"
                                                            class="next-button complete-btn next "
                                                            style="justify-content: center;"
                                                            @if (!$lesson->isCompleted()) onclick='courseCompleted("{{ $lesson->id }}", "{{ get_class($lesson) }}")' @endif role="button">
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
                                                        @if ($lessonCourse->progress() >= 50)
                                                            @if (!$lessonCourse->isUserCertified())
                                                          
                                                                <form method="post"
                                                                    action="{{ route('admin.certificates.generate') }}">
                                                                    @csrf
                                                                    <input type="hidden" value="{{ $lessonCourse->id }}"
                                                                        name="course_id">
                                                                        <input type="hidden" value="{{ $course_location_id }}"
                                                                        name="course_location_id">
                                                                    <button id="finish"
                                                                        class="next-button complete-btn next "
                                                                        style="justify-content: center;"
                                                                        @if (!$lesson->isCompleted()) onclick='courseCompleted("{{ $lesson->id }}", "{{ get_class($lesson) }}")' @endif role="button">
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
                                                                {{-- @else
                                                       
                                                            <div class="alert alert-success">
                                                                @lang('labels.frontend.course.certified')
                                                            </div> --}}
                                                            @endif
                                                        @endif
                                                    </div>
                                                </div>


                                            </div>

                                        </div>
                                        <!-- /course-details -->

                                        <!-- /market guide -->

                                        <!-- /review overview -->
                                    </div>


                                </div>
                            </div>
                            {{-- content lesson --}}

                        </div>
                        <!-- =======course side bar left -->
                        {{-- <div class="col-sm-12 col-md-3  benefit wow fadeInUp ptb-50 course-content mt-0">

                        <!-- Sidebar left-->
                        
                    @include('frontend.courses.course_sidebar_left')

                    </div> --}}
                    </div>
                </div>
            </div>


        </div>
        </div>
    </section>








@endsection

@push('after-scripts')
    <!-- custom js -->
    <script>
       let height=$(document).height();
       let width=$(document).width();
     
       function scroll() {
    $('html, body').animate({
        scrollTop: $("#invite_friends").offset().top
    }, 1000)};
    if(width<=1000){
        // window.location.hash = '#les-content';
        window.onload = scroll;

       }

    </script>
    <script src="{{ asset('iv') }}/assets/rating/js/star-rating.js"></script>
    <script src="{{ asset('iv') }}/js/toggleSideBar.js"></script>

    <script>
        $(document).on('change', 'input[name="stars"]', function() {
            $('#rating').val($(this).val());

        })
        $(document).ready(function() {
            $('.caption').css({
                'display': 'none'
            })
            
            $barWidth=$('.progress-bar').width();
            if($barWidth!=0){
                $('.progress-bar span').removeClass("color-primary");
            }
        
            $('.course-sidebar').on('click', 'a.list-group-item', function() {
                $(".course-sidebar .list-group-item").removeClass("active");
                $(".course-sidebar .list-group-item").addClass("unactive");


                $(this).addClass("active");
            });

        })
    </script>
    {{-- <script src="//www.youtube.com/iframe_api"></script> --}}

    <script src="{{ asset('plugins/sticky-kit/sticky-kit.js') }}"></script>
    <script src="https://cdn.plyr.io/3.5.3/plyr.polyfilled.js"></script>
    <script src="{{ asset('plugins/touchpdf-master/pdf.compatibility.js') }}"></script>
    <script src="{{ asset('plugins/touchpdf-master/pdf.js') }}"></script>
    <script src="{{ asset('plugins/touchpdf-master/jquery.touchSwipe.js') }}"></script>
    <script src="{{ asset('plugins/touchpdf-master/jquery.touchPDF.js') }}"></script>
    <script src="{{ asset('plugins/touchpdf-master/jquery.panzoom.js') }}"></script>
    <script src="{{ asset('plugins/touchpdf-master/jquery.mousewheel.js') }}"></script>
    <script src="https://cdn.jsdelivr.net/npm/js-cookie@2/src/js.cookie.min.js"></script>

    <script src="{{asset('iv/assets/js/x-notify.js')}}"></script>  

    <script>
        @if ($lesson->mediaPDF)
            $(function () {
            $("#myPDF").pdf({
            source: "{{ asset('storage/uploads/' . $lesson->mediaPDF->name) }}",
            loadingHeight: 800,
            loadingWidth: 800,
            loadingHTML: ""
            });
        
            });
        @endif
        var storedDuration = 0;
        var storedLesson;
        storedDuration = Cookies.get("duration_" + "{{ auth()->user()->id }}" + "_" + "{{ $lesson->id }}" + "_" +
            "{{ $lessonCourse->id }}");
        storedLesson = Cookies.get("lesson" + "{{ auth()->user()->id }}" + "_" + "{{ $lesson->id }}" + "_" +
            "{{ $lessonCourse->id }}");
        var user_lesson;
        if (parseInt(storedLesson) != parseInt("{{ $lesson->id }}")) {
            Cookies.set('lesson', parseInt('{{ $lesson->id }}'));
        }
        @if ($lesson->mediaVideo && $lesson->mediaVideo->type != 'embed')
            var current_progress = 0;
        
        
            @if ($lesson->mediaVideo->getProgress(auth()->user()->id) != '')
                current_progress = "{{ $lesson->mediaVideo->getProgress(auth()->user()->id)->progress }}";
            @endif
        
        
        
            const player2 = new Plyr('#audioPlayer');
        
            const player = new Plyr('#player');
            duration = 10;
            var progress = 0;
            var video_id = $('#player').parents('.video-container').data('id');
            player.on('ready', event => {
            player.currentTime = parseInt(current_progress);
            duration = event.detail.plyr.duration;
        
        
            if (!storedDuration || (parseInt(storedDuration) === 0)) {
            Cookies.set("duration_" + "{{ auth()->user()->id }}" + "_" + "{{ $lesson->id }}" + "_" +
            "{{ $lessonCourse->id }}", duration);
            }
        
            });
        
            {{-- if (!storedDuration || (parseInt(storedDuration) === 0)) { --}}
            {{-- Cookies.set("duration_" + "{{auth()->user()->id}}" + "_" + "{{$lesson->id}}" + "_" + "{{$lessonCourse->id}}", player.duration); --}}
            {{-- } --}}
        
        
            setInterval(function () {
            player.on('timeupdate', event => {
            if ((parseInt(current_progress) > 0) && (parseInt(current_progress) < parseInt(event.detail.plyr.currentTime))) {
                progress=current_progress; } else { progress=parseInt(event.detail.plyr.currentTime); } }); if(duration !==0 ||
                parseInt(progress) !==0 ) { saveProgress(video_id, duration, parseInt(progress)); } }, 3000); function
                saveProgress(id, duration, progress) { $.ajax({ url: "{{ route('update.videos.progress') }}" , method: "POST"
                , data: { "_token" : "{{ csrf_token() }}" , 'video' : parseInt(id), 'duration' :
                parseInt(duration), 'progress' : parseInt(progress) }, success: function (result) { if (progress===duration) {
                location.reload(); } } }); } $('#notice').on('hidden.bs.modal', function () { location.reload(); });
                @endif
        $("#sidebar").stick_in_parent();
        @if ((int) config('lesson_timer') != 0)
            //Next Button enables/disable according to time
        
            var readTime, totalQuestions, testTime;
            user_lesson = Cookies.get("user_lesson_" + "{{ auth()->user()->id }}" + "_" + "{{ $lesson->id }}" + "_" +
            "{{ $lessonCourse->id }}");
        
            @if ($test_exists)
                totalQuestions = '{{ count($lesson->questions) }}'
                readTime = parseInt(totalQuestions) * 30;
            @else
                readTime = parseInt("{{ $lesson->readTime() }}") * 60;
            @endif
        
            @if (!$lesson->isCompleted())
                storedDuration = Cookies.get("duration_" + "{{ auth()->user()->id }}" + "_" + "{{ $lesson->id }}" + "_"
                +
                "{{ $lessonCourse->id }}");
                storedLesson = Cookies.get("lesson" + "{{ auth()->user()->id }}" + "_" + "{{ $lesson->id }}" + "_" +
                "{{ $lessonCourse->id }}");
        
        
                var totalLessonTime = readTime + (parseInt(storedDuration) ? parseInt(storedDuration) : 0);
                var storedCounter = (Cookies.get("storedCounter_" + "{{ auth()->user()->id }}" + "_" +
                "{{ $lesson->id }}"
                +
                "_" + "{{ $lessonCourse->id }}")) ? Cookies.get("storedCounter_" + "{{ auth()->user()->id }}" + "_" +
                "{{ $lesson->id }}" + "_" + "{{ $lessonCourse->id }}") : 0;
                var counter;
                if (user_lesson) {
                if (user_lesson === 'true') {
                counter = 1;
                }
                } else {
                if ((storedCounter != 0) && storedCounter < totalLessonTime) { counter=storedCounter; } else {
                    counter=totalLessonTime; } } var interval=setInterval(function () { counter--; // Display 'counter' wherever
                    you want to display it. if (counter>= 0) {
                    // Display a next button box
                    $('#nextButton').html("<a class='btn btn-block bg-danger font-weight-bold text-white'   href='#'>@lang('labels.frontend.course.next') (in " + counter + " seconds)</a>")
                    Cookies.set("duration_" + "{{ auth()->user()->id }}" + "_" + "{{ $lesson->id }}" + "_" +
                    "{{ $lessonCourse->id }}", counter);
        
                    }
                    if (counter === 0) {
                    Cookies.set("user_lesson_" + "{{ auth()->user()->id }}" + "_" + "{{ $lesson->id }}" + "_" +
                    "{{ $lessonCourse->id }}", 'true');
                    Cookies.remove('duration');
        
                    @if ($test_exists && is_null($test_result))
                        $('#nextButton').html("<a class='btn btn-block bg-danger font-weight-bold text-white' href='#'>@lang('labels.frontend.course.complete_test')</a>")
                    @else
                        @if ($next_lesson)
                            $('#nextButton').html("<a class='btn btn-block gradient-bg font-weight-bold text-white'" +
                                                                 "
                                href='{{ route('lessons.show', [$next_lesson->course_id, $next_lesson->model->slug,$course_location_id]) }}'>@lang('labels.frontend.course.next')<i class='fa fa-angle-double-right'></i> </a>");
                        @else
                            $('#nextButton').html("<form method='post' action='{{ route('admin.certificates.generate') }}'>" +
                                "<input type='hidden' name='_token' id='csrf-token' value='{{ Session::token() }}' />" +
                                "<input type='hidden' value='{{ $course_location_id }}' name='course_location_id'> " +
                                
                                "<input type='hidden' value='{{ $lessonCourse->id }}' name='course_id'> " +
                                "<button id='finish' class='next-button complete-btn' @if (!$lesson->isCompleted()) onclick='courseCompleted(\'{{ $lesson->id }}\', \'{{ get_class($lesson) }}\')' @endif role='button'><span>@if($days>0)@lang('labels.frontend.course.finish_course')@else @lang('labels.frontend.course.get_certificate') @endif </span> <div class='icon'><i class='fa fa-check-circle'></i> <i class='fa fa-check'></i></div></button>"+
                                "</form>");
        
                        @endif
        
                        @if (!$lesson->isCompleted())
                            courseCompleted("{{ $lesson->id }}", "{{ get_class($lesson) }}");
                        @endif
                    @endif
                    clearInterval(counter);
                    }
                    }, 1000);
        
            @endif
        @endif

        function courseCompleted(id, type) {
           
           
         
            $.ajax({
                url: "{{ route('update.course.progress') }}",
                method: "POST",
                data: {
                    "_token": "{{ csrf_token() }}",
                    'model_id': parseInt(id),
                    'model_type': type,
                },
                success: function(data) {
                    
                    let progress=data.progress;
                    let isUserCertified=data.isUserCertified;
                    // alert("@lang('labels.frontend.course.completed_message')");
                    $(".complete-btn").hide();
                    if (progress>= 100)
                     if (!isUserCertified){
    
                     $('#finishForm').show();
                     $('#finishBtn').show();
                     }
                   
                    const Notify = new XNotify();
                         Notify.info({ 
                                title: "@lang('labels.frontend.course.completed_message')", 
                                description: "", 
                                duration: 4000,
                                position:'TopRight',
                                marginTop:'30px',
                                width: "300px",
						borderRadius: "4px",
						background: "rgb(28,197,91)",
                        
						color: "rgb(255,255,255)"
					    });
                    
                }
            });
        }
  
    </script>
    <script src="http://code.jquery.com/jquery-1.9.1.js"></script>
    <script src="http://code.jquery.com/ui/1.11.0/jquery-ui.js"></script>
    <script src="//cdnjs.cloudflare.com/ajax/libs/timepicker/1.3.5/jquery.timepicker.min.js"></script>
    <script src="{{ asset('ivory/assets/js/datepickerConfig.js') }}"></script>
@endpush
