@inject('request', 'Illuminate\Http\Request')
@extends('backend.layouts.app')

@section('title', __('labels.backend.blogs.title') . ' | ' . app_name())
@push('after-styles')


    <link href="{{ asset('assets/rating/css/star-rating.css') }}" media="all" rel="stylesheet" type="text/css" />
    <link href="{{ asset('assets/rating/themes/krajee-svg/theme.css') }}" media="all" rel="stylesheet" type="text/css" />
 
    @endpush
@section('content')




    <!-- Start of course details section
                ============================================= -->
    <section id="course-details" class="course-details-section">
        <div class="container ">
            <div class="row main-content">
                <div class="col-md-12">
                    @if (session()->has('success'))
                        <div class="alert alert-dismissable alert-success fade show">
                            <button type="button" class="close" data-dismiss="alert">&times;</button>
                            {{ session('success') }}
                        </div>
                    @endif

                    <div class="course-details-item border-bottom-0 mb-0">



                       
                        <div class="rates content">
                            {{ html()->form('POST', route('admin.answerEvaluate.store'))->id('rate-create')->class('form-horizontal')->acceptsFiles()->open() }}

                            <div id="accordion">

                                @foreach ($rates as $rate)
                                    <input type="hidden" name="rate_ids[]" value="{{ $rate->id }}">
                                    <input type="hidden" name="course_id" value="{{ $course->id }}">
                                    <input type="hidden" name="student_id" value="{{ $student_id }}">

                                    @php
                                    $quest_count = 0;
                                    $userAnswers = $rate->getUserRate($student_id,$course->id);
                                    $test_result = App\Models\Result::where('course_forms_id', $rate->course()->where('courses.id',$course->id)->first()->pivot->id)
                                                    ->where('user_id', \Auth::id())
                                                   
                                                    ->first();
                                                 
                                @endphp
                               
                                    <div class="card0">
                                      
                                        <div class="card-header0" id="heading{{ $rate->id }}">
                                            <h5 class="mb-0 card-body">
                                                {{-- <button class="btn btn-link" data-toggle="collapse" data-target="#collapse{{$rate->id}}" aria-expanded="true" aria-controls="collapseOne"> --}}
                                                @if (Lang::locale() == 'en')
                                                    {{ $rate->title }}
                                                   

                                                @else
                                                    
                                                    {{ $rate->title_ar }}

                                                @endif

                                                @if (count($userAnswers) >0)
                                               
                                                    <button class="btn btn-success"
                                                       >{{ __('buttons.general.crud.evaluated') }}</button>
                                                
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
                                                        $answ=$userAnswers?$userAnswers->where('question_id',$question->id)->first():0;
                                                        
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

                                                            <div style="direction: ltr;display: inline-block;width: 100%">
                                                                <input name="{{ $question->id }}-options" id="kartik"
                                                                    class="rating" data-stars="5" value="{{$answ?$answ->answer:$answ}}" data-step="1"
                                                                    title="" data-rtl=1 />
                                                            </div>


                                                        @else

                                                            {{-- <textarea name="{{ $question->id }}-options" id="" cols="50"
                                                                rows="2"></textarea> --}}
                                                       
                                                                <br />
                                                                <ul class="options-list pl-4">


                                                                    @if (sizeof($question->options) && $question->question_type=="multiple_choice")
                                                                        @foreach ($question->options as $option)
                        
                                                                        <div class="radio">
                                                                            <label>
                                                                                <input type="radio" name="{{ $question->id }}-options"
                                                                                    value="{{ $option->id }}" />
                                                                                    {{Lang::locale() == 'en'? $option->option_text: $option->option_text_ar}}<br />
                                                                                    <br />
                                                                            </label>
                                                                        </div>
                                                                        @endforeach
                                                                    @elseif (sizeof($question->options) && $question->question_type=="drop_down")
                                                                        <select  name="{{ $question->id }}-options"    class="form-control">
                                                                        @foreach ($question->options as $option)
                                                                            <option @if (($option->answered(@$test_result->id) != null && $option->answered(@$test_result->id) == 1) || $option->correct == true)  selected @endif value="{{ $option->id }}" >
                                                                                {{Lang::locale() == 'en'? $option->option_text: $option->option_text_ar}}<br />

                                                                            </option>
                                                                        @endforeach
                                                                        </select>
                                                                    @else
                                                                        @switch($question->question_type)
                                                                                @case("paragraph")
                                                                                <textarea type="text" class="form-control editor"   placeholder="paragraph" style="height:100px" name="{{ $question->id }}-options">{{ @test_res($test_result->id, $question->id)->option_id }}</textarea>
                                                                                @break
                                                                                @case("short_answer")
                                                                                <input type="text" class="form-control" value="{{ @test_res($test_result->id, $question->id)->option_id }}" placeholder="short_answer" name="{{ $question->id }}-options" />
                                                                                @break
                                                                                @case("date")
                                                                                <input type="text" class="form-control datepicker" value="{{ @test_res($test_result->id, $question->id)->option_id }}" placeholder="date" name="{{ $question->id }}-options" />
                                                                                @break
                                                                                @case("time")
                                                                                <input type="text" class="form-control timepicker" value="{{ @test_res($test_result->id, $question->id)->option_id }}"  placeholder="time" name="{{ $question->id }}-options" />
                                                                                @break
                                                                                @case("file_upload")
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
                                    {{-- @if (count($userAnswers) == 0) --}}
                                        <div class="form-group row justify-content-center"
                                            style="margin-top: 20px;margin-left: 16%;">
                                            <div class="col-4">
                                                <button class="btn btn-success" style="background-color: ##3bcfcb;"
                                                    type="submit">{{ __('buttons.general.crud.create') }}</button>
                                            </div>
                                        </div>
                                        <!--col-->
                                    {{-- @endif --}}
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









                    </div>
                    <!-- /course-details -->

                    <!-- /market guide -->

                    <!-- /review overview -->
                </div>
             

            </div>
        </div>
    </section>
    <!-- End of course details section
            ============================================= -->

@endsection


@push('after-scripts')

    <script src="{{ asset('plugins/touchpdf-master/jquery.mousewheel.js') }}"></script>
    <script src="https://cdn.jsdelivr.net/npm/js-cookie@2/src/js.cookie.min.js"></script>
    <script src="{{ asset('assets/rating/js/star-rating.js') }}"></script>

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
     <script src="//cdnjs.cloudflare.com/ajax/libs/timepicker/1.3.5/jquery.timepicker.min.js"></script>
     <script src="{{ asset('ivory/assets/js/datepickerConfig.js') }}"></script>
@endpush