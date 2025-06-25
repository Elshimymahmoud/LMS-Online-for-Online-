
@extends('frontend.layouts.app'.config('theme_layout'))

@section('title', trans('labels.frontend.home.title').' | '.app_name())
@section('meta_description', '')
@section('meta_keywords','')


@push('after-styles')

    <link href="{{ asset('iv') }}/assets/rating/css/star-rating.css" media="all" rel="stylesheet" type="text/css" />
    <link href="{{ asset('iv') }}/assets/rating/themes/krajee-svg/theme.css" media="all" rel="stylesheet" type="text/css" />

    <link rel="stylesheet" href="{{ asset('iv') }}/css/course_curriculum.css" />
    <style>
        .name-ar{
            width: 25% !important;
            float: right;
        }
        .white-normal {
            white-space: normal;
            line-height: normal;
        }
        .countrySelection{
            width: 50% !important;


        }
        #countrySelection, #gds-cr-one{
            border-radius: 10px;
        }

        .gds-cr-one{
            width: 50% !important;
            float: left;
        }
        .user-avatar-span{
            float: right !important;
            min-width: 65px !important;
        }
        .user-avatar{
            width: 50% !important;
        }
        .nationality{
            border-radius: 30px;
        }
    </style>
@endpush

@section('content')

    <section class="row the-slider" id="slider">
        <div style="background-size: cover;height:fit-content;background-color: white;padding-bottom: 20px;">
            <div class="containers">

                <div class="row">

                    <div class="container">

                        <!--==========course description details ==========-->
                        <div class="col-sm-12 col-md-6 benefit wow fadeInUp ptb-50 course-content mt-0">
                            <!--==========Step1==========-->
                            <div class="curriclum-content lesson-cards" style="padding: 10px;" id="step1">
                                @if(count($rates)>0)
                                    {{-- rates start --}}
                                    @include('includes.partials.messages')

                                    <h3 style="border: 1px solid #88ceb9;
                          padding: 10px;
                          border-radius: 10px;color: #783141;"> @lang('labels.frontend.course.ratings')</h3>
                                    <hr>
                                    <div class="rates content">
                                        {{ html()->form('POST', route('admin.answerEvaluate.store'))->id('rate-create')->class('form-horizontal')->acceptsFiles()->open() }}

                                        <div id="accordion">
                                            <input type="hidden" name="rateForm" value="teacher_rate_student" id="">
                                            <input type="hidden" name="form_type" value="teacher_rate_student">
                                            <input type="hidden" name="student_id" value="{{ $student->id }}">
                                            <input type="hidden" name="group_id" value="{{ $group->id }}">
                                            <input type="hidden" name="course_id" value="{{ $group->courses->id }}">

                                        @foreach ($rates as $rate)
                                                <input type="hidden" name="rate_ids[]" value="{{ $rate->id }}">

                                                @php
                                                    $quest_count = 0;

                                                    $userAnswers = $rate->divisions->flatMap(function ($division) use ($student, $group) {
                                                        return $division->questions->map(function ($question) use ($student, $group) {
                                                            return $question->answers->where('user_id', \Auth::id())
                                                            ->where('student_id', $student->id)->where('group_id', $group->id)->first();
                                                        });
                                                    });

                                                @endphp
                                                <div class="card0">

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
                                                                {{ $rate->title }}
                                                                @lang('labels.backend.rates.rate')

                                                            @else
                                                                @lang('labels.backend.rates.rate')
                                                                {{ $rate->title_ar }}

                                                            @endif
                                                        </h5>
                                                    </div>


                                                    <div id="collapse{{ $rate->id }}" class=" show"
                                                         aria-labelledby="headingOne" data-parent="#accordion">
                                                        <div class="card-body">

                                                            <ol type="A">
                                                                @foreach ($rate->divisions as $Mainkey => $division)
                                                                    @foreach($division->questions as $question)
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

                                                                                    if($userAnswers->filter()->count() > 0)
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
                                                                                           value="{{$quest_answer?$quest_answer->answer:0}}" required/>
                                                                                </div>
                                                                            @else

                                                                                {{--                                                                            <textarea name="{{ $question->id }}-options"--}}
                                                                                {{--                                                                                      id="" cols="50"--}}
                                                                                {{--                                                                                      rows="2"></textarea>--}}

                                                                                <br/>
                                                                                <ul class="options-list pl-4">


                                                                                    @if (sizeof($question->options) && $question->question_type == 'multiple_choice')
                                                                                        @foreach ($question->options as $option)
                                                                                            @php
                                                                                                $isAnswered =$question->options->where('id', $userAnswers->first()->answer)->first();


                                                                                            @endphp
                                                                                            <div class="radio">
                                                                                                <label>
                                                                                                    <input type="radio"
                                                                                                           name="{{ $question->id }}-options"
                                                                                                           value="{{
                                                                                                           $option->id }}"{{ $isAnswered->id == $option->id ? 'checked' : '' }} required/>
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

                                                                @endforeach
                                                            </ol>
                                                        </div>
                                                    </div>
                                                </div>
                                                <hr>
                                            @endforeach
                                            @if (count($rates) > 0)
                                                @if ($userAnswers->filter()->count() == 0)
                                                    <div class="form-group row justify-content-center"
                                                         style="margin-top: 20px;margin-left: 16%;">
                                                        <div class="col-4">
                                                            <button class="btn btn-success"
                                                                    style="background-color: ##3bcfcb;"
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
                                    {{--  rates end--}}

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

    <script>
        $(document).on('change', 'input[name="stars"]', function() {
            $('#rating').val($(this).val());

        })
        $(document).ready(function() {
            $('.caption').css({
                'display': 'none'
            })

            $('.course-sidebar').on('click', 'a.list-group-item', function() {
                $(".course-sidebar .list-group-item").removeClass("active");
                $(this).addClass("active");
            });

        })

    </script>
    <script>window.onload = function() {
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

            document.getElementById("anchor1").addEventListener("click", function() {
                toggleSteps(this);
            });

            document.getElementById("anchor2").addEventListener("click", function() {
                toggleSteps(this);
            });

            // Set div1 (step1) to be visible by default
            document.getElementById("step1").style.display = "block";
        };

    </script>

@endpush


