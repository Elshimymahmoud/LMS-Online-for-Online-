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

        .nested-ul {
            /* border-bottom: 1px solid black; */
            border-radius: 10px;
        }

        .rates {
            padding: 22px;
        }

        .course-content h3 {
            padding-right: 30px;
        }
        
        .white-normal{
            white-space: normal;
            line-height: normal;
        }
       
        .evaluated{
          font-size: 18px;
      padding: 10px;
      border: 2px solid #ffffff;
      border-radius: 10px;
      margin-bottom: 20px;
      /* margin-bottom: 34px; */
      text-align: center;
      color: white;
      background-color: #4f198d;
      }
 
    </style>
    <link rel="stylesheet" href="{{ asset('iv') }}/css/course-sidebar-right.css" />

    <link rel="stylesheet" href="https://code.jquery.com/ui/1.12.1/themes/base/jquery-ui.css">

    {{-- rate --}}
    <link rel="stylesheet" href="https://cdn.plyr.io/3.5.3/plyr.css" />


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

        .course-content {
            padding: 10px;
        }

    </style>

    <link href="{{ asset('assets/rating/themes/krajee-svg/theme.css') }}" media="all" rel="stylesheet" type="text/css" />
    <style>
        .rating-container .star {
            display: unset;
        }

    </style>
    <link rel="stylesheet" href="//cdnjs.cloudflare.com/ajax/libs/timepicker/1.3.5/jquery.timepicker.min.css">
    <link href="{{ asset('assets/rating/css/star-rating.css') }}" media="all" rel="stylesheet" type="text/css" />
    @if (session('locale') == 'en')
    <style>
        .list-group-item {
            width: 210px
        }

    </style>

@endif
@endpush

@section('content')

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

    <section class="row the-slider" id="slider">
        <div style="background-size: cover;height:fit-content;background-color: white;padding-bottom: 20px;">
            <div class="containers">
                <div class="row benefit-notes">
                    <div class="col-sm-12 col-md-12   wow fadeInUp2  course-nav mt-0">
                        <nav class="navbar navbar-default second-nav" style="position: unset">
                            <div class="container">
                                <!--========== Brand and toggle get grouped for better mobile display ==========-->


                                <div class="nav navbar-nav navbar-right col-md-6">
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
                                            style='width:{{ $course->progress() ? $course->progress() : 0 }}%'
                                            role="progressbar" aria-valuenow="0" aria-valuemin="0" aria-valuemax="100">
                                            <span class="color-primary text-color">{{ $course->progress() ? $course->progress() : 0 }}%</span>
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

                            @include('frontend.courses.course_sidebar_right')
                            {{-- Sidebar right --}}

                            {{-- Sidebar right --}}

                        </div>
                        <!--/*==========course description right ==========-->

                        <!--==========course description details ==========-->

                        <div class="col-sm-12 col-md-9  benefit wow fadeInUp ptb-50 course-content mt-0">
                            {{-- content rate --}}
                            @include('includes.partials.messages')
                            <h3 > @lang('labels.frontend.course.ratings')</h3>
                            <hr>
                            <div class="rates content">
                                {{ html()->form('POST', route('admin.answerEvaluate.store'))->id('rate-create')->class('form-horizontal')->acceptsFiles()->open() }}

                                <div id="accordion">
                                    <input type="hidden" name="rateForm" value="rate" id="">
                                    @foreach ($rates as $rate)
                                        <input type="hidden" name="rate_ids[]" value="{{ $rate->id }}">
                                        <input type="hidden" name="course_id" value="{{ $course->id }}">
                                        @php
                                            $quest_count = 0;
                                            
                                            $userAnswers = $rate->getUserRate(null, $course->id);
                                            
                                            $test_result = App\Models\Result::where('course_forms_id', $rate->course()->first()->pivot->id)
                                                ->where('user_id', \Auth::id())
                                                ->first();
                                        @endphp
                                        <div class="card0">
                                            @if (count($userAnswers) >0)
                                            <div>
                                            
                                            <p class="evaluated">@lang('buttons.general.crud.evaluated') <i class="fa fa-check-circle"></i></p>
                                            </div>
                                            @endif
                                            <div class="card-header0" id="heading{{ $rate->id }}" 
                                                style="padding: 9px;
                                                border: 1px solid #88ceb9;
                                                border-radius: 10px;
                                                margin-bottom: 10px;">
                                                <h5 class="mb-0 card-body" style="color: #4f198d ">
                                                    {{-- <button class="btn btn-link" data-toggle="collapse" data-target="#collapse{{$rate->id}}" aria-expanded="true" aria-controls="collapseOne"> --}}
                                                    @if (Lang::locale() == 'en')
                                                        {{ $rate->title }}
                                                        {{-- @lang('labels.backend.rates.rate') --}}

                                                    @else
                                                        {{-- @lang('labels.backend.rates.rate') --}}
                                                        {{ $rate->title_ar }}

                                                    @endif



                                                </h5>

                                                {{-- <h5 class="mb-0">
                                                <button class="btn btn-link" data-toggle="collapse" data-target="#collapse{{$rate->id}}" aria-expanded="true"  aria-controls="collapseOne"></button>
                                            </h5> --}}
                                            </div>


                                            <div id="collapse{{ $rate->id }}" class=" show"
                                                aria-labelledby="headingOne" data-parent="#accordion">
                                                <div class="card-body">

                                                    <ol type="A">
                                                        @foreach ($rate->questions as $Mainkey => $question)
                                                            @php
                                                                $quest_count++;
                                                                
                                                            @endphp

                                                            <input type="hidden" name="rateQuestions[]"
                                                                value="{{ $question->id }}">
                                                            <li>
                                                                <p>
                                                                    @if (Lang::locale() == 'en')
                                                                        {{ $question->question }}
                                                                    @else
                                                                        {{ $question->question_ar ? $question->question_ar : $question->question }}

                                                                    @endif
                                                                </p>


                                                                @if ($question->question_type == 'radio')

                                                                    <div
                                                                        style="direction: ltr;display: inline-block;width: 100%">
                                                                        <input name="{{ $question->id }}-options"
                                                                            id="kartik" class="rating"
                                                                            data-stars="5" data-step="0.1" title=""
                                                                            data-rtl=1 />
                                                                    </div>


                                                                @else

                                                                    {{-- <textarea name="{{ $question->id }}-options" id="" cols="50"
                                                                rows="2"></textarea> --}}

                                                                    <br />
                                                                    <ul class="options-list pl-4">


                                                                        @if (sizeof($question->options) && $question->question_type == 'multiple_choice')
                                                                            @foreach ($question->options as $option)

                                                                                <div class="radio">
                                                                                    <label>
                                                                                        <input type="radio"
                                                                                            name="{{ $question->id }}-options"
                                                                                            value="{{ $option->id }}" />
                                                                                        {{ Lang::locale() == 'en' ? $option->option_text : $option->option_text_ar }}<br />
                                                                                        <br />
                                                                                    </label>
                                                                                </div>
                                                                            @endforeach
                                                                        @elseif (sizeof($question->options) &&
                                                                            $question->question_type=="drop_down")
                                                                            <select name="{{ $question->id }}-options"
                                                                                class="form-control">
                                                                                @foreach ($question->options as $option)
                                                                                    <option @if (($option->answered(@$test_result->id) != null && $option->answered(@$test_result->id) == 1) || $option->correct == true)  selected @endif
                                                                                        value="{{ $option->id }}">
                                                                                        {{ Lang::locale() == 'en' ? $option->option_text : $option->option_text_ar }}<br />

                                                                                    </option>
                                                                                @endforeach
                                                                            </select>
                                                                        @else
                                                                            @switch($question->question_type)
                                                                                @case("
                                                                                    paragraph")
                                                                                    <textarea type="text"
                                                                                        class="form-control editor"
                                                                                        placeholder="paragraph"
                                                                                        style="height:100px"
                                                                                        name="{{ $question->id }}-options">{{ @test_res($test_result->id, $question->id)->option_id }}</textarea>
                                                                                @break
                                                                                @case("
                                                                                    short_answer")
                                                                                    <input type="text" class="form-control"
                                                                                        value="{{ @test_res($test_result->id, $question->id)->option_id }}"
                                                                                        placeholder="short_answer"
                                                                                        name="{{ $question->id }}-options" />
                                                                                @break
                                                                                @case(" date")
                                                                                    <input type="text"
                                                                                        class="form-control datepicker"
                                                                                        value="{{ @test_res($test_result->id, $question->id)->option_id }}"
                                                                                        placeholder="date"
                                                                                        name="{{ $question->id }}-options" />
                                                                                @break
                                                                                @case(" time")
                                                                                    <input type="text"
                                                                                        class="form-control timepicker"
                                                                                        value="{{ @test_res($test_result->id, $question->id)->option_id }}"
                                                                                        placeholder="time"
                                                                                        name="{{ $question->id }}-options" />
                                                                                @break
                                                                                @case("
                                                                                    file_upload")
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
                                                                    <br />
                                                                @endif

                                                            </li>
                                                        @endforeach
                                                    </ol>
                                                </div>
                                            </div>
                                        </div>
                                        <hr>
                                    @endforeach
                                    @if (count($rates) > 0)
                                        @if (count($userAnswers) == 0)
                                            <div class="form-group row justify-content-center"
                                                style="margin-top: 20px;margin-left: 16%;">
                                                <div class="col-4">
                                                    <button class="btn btn-success" style="background-color: ##3bcfcb;"
                                                        type="submit">{{ __('buttons.general.crud.create') }}</button>
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

                            {{-- // check complete --}}
                            <div class="col-md-4 offset-4" style="margin-top: 74px;margin-right:27%">
                                

                                @if ($course->progress() >= 50)
                                    @if (!$course->isUserCertified())
                                        <form method="post" class="validator" action="{{ route('admin.certificates.generate') }}">
                                            @csrf

                                            <input type="hidden" value="{{ $course->id }}" name="course_id">
                                            <button id="finish" class="next-button complete-btn" @if (!$rates[0]->isCompleted()) onclick='courseCompleted("{{ $rates[0]->id }}", "{{ get_class($rates[0]) }}")' @endif
                                                role="button">
                                                <span>@lang('labels.frontend.course.finish_course') </span>
                                                <div class="icon">
                                                    <i class="fa fa-check-circle"></i>
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
                            {{-- // --}}
                            {{-- content rate --}}

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

    <script src="{{ asset('iv') }}/assets/rating/js/star-rating.js"></script>
    <script src="{{ asset('iv') }}/js/toggleSideBar.js"></script>
    <script src="{{asset('iv/assets/js/x-notify.js')}}"></script>  

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
                    // alert("@lang('labels.frontend.course.completed_message')");
                    $(".complete-btn").hide();
                  
                
                }
            });
        }
    </script>
    {{-- <script src="//www.youtube.com/iframe_api"></script> --}}

    <script src="{{ asset('plugins/touchpdf-master/jquery.mousewheel.js') }}"></script>
    <script src="https://cdn.jsdelivr.net/npm/js-cookie@2/src/js.cookie.min.js"></script>

    <script src="https://cdn.plyr.io/3.5.3/plyr.polyfilled.js"></script>
   
    <script src="http://code.jquery.com/jquery-1.9.1.js"></script>
    <script src="http://code.jquery.com/ui/1.11.0/jquery-ui.js"></script>
    <script src="//cdnjs.cloudflare.com/ajax/libs/timepicker/1.3.5/jquery.timepicker.min.js"></script>
    <script src="{{ asset('ivory/assets/js/datepickerConfig.js') }}"></script>
@endpush
