@extends('frontend.layouts.app'.config('theme_layout'))

@section('title', trans('labels.frontend.home.registerTrainer') . ' | ' . app_name())
@section('meta_description', '')
@section('meta_keywords', '')


@push('after-styles')
    <style>
        .link-terms {
            border: none !important;
        }

        .title {
            font-size: 22px !important;
            color: ##3bcfcb;
            text-align: center;
            padding: 10px;
        }

        .submit {
            background-color: ##3bcfcb;
            padding: 10px;
            font-weight: bold;
        }

        .form-cnt {
            background-color: white;
            margin-top: 23px;
        }

        .page-breadcrumb-title {
            background-color: ##3bcfcb;
        }

        .page-breadcrumb-title .title {
            color: white
        }
        .options-list{
            padding: 0px;
        }
    </style>
@endpush

@section('title', app_name() . ' | ' . __('labels.frontend.passwords.reset_password_box_title'))

@section('content')
    <section class="row the-slider" id="slider">
        <div style="background-size: cover;height:fit-content;background-color: #f1f3f3;padding-bottom: 20px;">
            <div class="container">
                <div class="row benefit-notes">

                    <!--========== /.container-fluid ==========-->
                    <div class=" container">

                        <div class="row form-cnt">



                            <!--==========blog details  ==========-->

                            <div class="col-sm-12 col-md-12   wow fadeInUp ptb-50  mt-0">
                                <div class="page-breadcrumb-title">
                                    <h2 class="breadcrumb-head title black bold">
                                        {{-- {{ __('labels.frontend.user.profile.answer_training_data_form') }} --}}
                                       {{trans('labels.frontend.home.registerTrainer')}} 
                                    </h2>
                                </div>
                            </div>
                            <div class="col-sm-2 col-md-2   wow fadeInUp ptb-50  mt-0">
                            </div>
                            <div class="col-sm-8 col-md-8   wow fadeInUp ptb-50  mt-0">

                                <div class="card border-0">

                                    <div class="card-body">
                                        @if ($errors->has('error'))
                                            <div class="alert alert-dismissable alert-danger show">
                                                <button type="button" class="close"
                                                    data-dismiss="alert">&times;</button>
                                                {{ $errors->first('error') }}
                                            </div>
                                        @endif
                                        @if (session('status'))
                                            <div class="alert alert-success">
                                                {{ session('status') }}
                                            </div>
                                        @endif
                                        {{-- form --}}
                                        {!! Form::open(['method' => 'POST', 'route' => ['answerEvaluateTraining.storeData'], 'files' => true]) !!}


                                        {{--  --}}
                                        @php
                                            $quest_count = 0;
                                            
                                        @endphp
                                        @php
                                            $test_result = \App\Models\Result::where('course_forms_id', null)
                                                ->where('user_id', \Auth::id())
                                                ->first();
                                            
                                        @endphp
                                        <input type="hidden" name="rate_ids[]" value="{{ @$trainingData->id }}">
                                        <input type="hidden" name="by_link" value="true">

                                        @if (@$trainingData)
                                            @foreach (@$trainingData->questions as $Mainkey => $question)
                                                @php
                                                    $quest_count++;
                                                    $userAnswers = @$trainingData->getUserAnswers();
                                                    
                                                @endphp


                                                <input type="hidden" name="rateQuestions[]" value="{{ $question->id }}">



                                                <p>
                                                    @if (Lang::locale() == 'en')
                                                        {{ $question->question }}
                                                    @else
                                                        {{ $question->question_ar ? $question->question_ar : $question->question }}
                                                    @endif
                                                </p>

                                                {{-- @if ($question->question_type == 'radio')

        <div style="direction: ltr;display: inline-block;width: 100%">
            <input name="{{ $question->id }}-options" id="kartik"
                class="rating" data-stars="5" data-step="1"
                title="" />
        </div>

    @else
        <textarea name="{{ $question->id }}-options" id="" cols="50"
            rows="2"></textarea>
    @endif




    {{-- --}}
                                                {{-- /////////////////// --}}
                                                <br />
                                                <ul class="options-list pl-4">


                                                    @if (sizeof($question->options) && $question->question_type == 'multiple_choice')
                                                        @foreach ($question->options as $option)
                                                            <div class="radio">
                                                                <label>
                                                                    <input type="radio" name="{{ $question->id }}-options"
                                                                       
                                                                        value="{{ $option->id }}" />
                                                                    {{ $option->option_text }}<br />
                                                                </label>
                                                            </div>
                                                        @endforeach
                                                    @elseif (sizeof($question->options) && $question->question_type == 'drop_down')
                                                        <select name="{{ $question->id }}-options"
                                                            class="form-control">
                                                            @foreach ($question->options as $option)
                                                                <option 
                                                                    value="{{ $option->id }}">
                                                                    {{ $option->option_text }}
                                                                </option>
                                                            @endforeach
                                                        </select>
                                                    @else
                                                        @switch($question->question_type)
                                                            @case('paragraph')
                                                                <textarea type="text" class="form-control editor" style="height:100px"
                                                                    name="{{ $question->id }}-options"></textarea>
                                                            @break

                                                            @case('short_answer')
                                                                <input type="text" class="form-control"
                                                                   
                                                                    name="{{ $question->id }}-options" />
                                                            @break

                                                            @case('date')
                                                                <input type="text" class="form-control datepicker"
                                                                   
                                                                    name="{{ $question->id }}-options" />
                                                            @break

                                                            @case('time')
                                                                <input type="text" class="form-control timepicker"
                                                                  
                                                                    name="{{ $question->id }}-options" />
                                                            @break

                                                            @case('file_upload')
                                                                <div style="margin-top: 20px">
                                                                    <label> @lang('labels.frontend.course.or_upload')</label>
                                                                    <input type="file" name="answer_file_{{ $question->id }}">
                                                                    <p>{!! get_test_file(auth()->id(), $question->id) !!} </p>
                                                                </div>
                                                            @break
                                                        @endswitch
                                                    @endif
                                                </ul>
                                                <br />
                                                <hr>
                                                {{-- ////////////////// --}}
                                                {{--  --}}
                                            @endforeach
                                        @endif
                                        {{--  --}}

                                        @if (@$trainingData)
                                            <div class="form-group row justify-content-center"
                                                style="margin-top: 20px;display: flex;
                                                justify-content: center;">
                                                <div class="col-4">
                                                    <button class="btn btn-success" style="background-color: ##3bcfcb;"
                                                        type="submit">{{ __('labels.frontend.home.register') }}</button>
                                                </div>
                                            </div>
                                            <!--col-->
                                        @else
                                            <div class="form-group row">
                                                <div class="col-12" style="text-align: center">
                                                    <h3>@lang('labels.general.no_data_available')</h3>
                                                </div>
                                            </div>
                                        @endif

                                        {!! Form::close() !!}




                                        {{-- form --}}
                                        

                                    </div><!-- card-body -->
                                </div><!-- card -->
                            </div>
                            <div class="col-sm-2 col-md-2   wow fadeInUp ptb-50  mt-0">
                            </div>
                        </div>
                    </div>
                    {{--  --}}

                </div>
            </div>
        </div>
    </section>

@endsection

@push('after-scripts')
<script src="cdnjs.cloudflare.com/ajax/libs/timepicker/1.3.5/jquery.timepicker.min.js"></script>
<script src="{{ asset('ivory/assets/js/datepickerConfig.js') }}"></script>
@endpush
