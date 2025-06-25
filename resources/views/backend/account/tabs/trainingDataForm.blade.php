{!! Form::open(['method' => 'POST', 'route' => ['admin.answerEvaluate.store'], 'files' => true]) !!}


{{--  --}}
@php
$quest_count = 0;

@endphp
@php
$test_result = \App\Models\Result::where(
    'course_group_test_id',
    null,
)
    ->where('user_id', \Auth::id())
    ->first();

@endphp
<input type="hidden" name="rate_ids[]" value="{{ @$trainingData->id }}">
@if(@$trainingData)
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




    {{--  --}}
    {{-- /////////////////// --}}
    <br />
    <ul class="options-list pl-4">


        @if (sizeof($question->options) && $question->question_type == 'multiple_choice')
            @foreach ($question->options as $option)


                <div class="radio">
                    <label>
                        <input type="radio" name="{{ $question->id }}-options" @if ($option->answered(@$test_result->id) != null)checked @endif
                            value="{{ $option->id }}" />
                        {{ $option->option_text }}<br />
                    </label>
                </div>
            @endforeach
        @elseif (sizeof($question->options) && $question->question_type=="drop_down")


            <select name="{{ $question->id }}-options" class="form-control">
                @foreach ($question->options as $option)

                    <option @if ($option->answered(@$test_result->id) != null)selected @endif value="{{ $option->id }}">
                        {{ $option->option_text }}
                    </option>
                @endforeach
            </select>
        @else
            @switch($question->question_type)
                @case("paragraph")
                    <textarea type="text" class="form-control editor"  style="height:100px"
                        name="{{ $question->id }}-options">{{ @test_res($test_result->id, $question->id)->option_id }}</textarea>
                @break
                @case("short_answer")
                    <input type="text" class="form-control"
                        value="{{ @test_res($test_result->id, $question->id)->option_id }}" 
                        name="{{ $question->id }}-options" />
                @break
                @case("date")
                    <input type="text" class="form-control datepicker"
                        value="{{ @test_res($test_result->id, $question->id)->option_id }}" 
                        name="{{ $question->id }}-options" />
                @break
                @case("time")
                    <input type="text" class="form-control timepicker"
                        value="{{ @test_res($test_result->id, $question->id)->option_id }}" 
                        name="{{ $question->id }}-options" />
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
    <hr>
    {{-- ////////////////// --}}
    {{--  --}}
@endforeach
@endif
{{--  --}}

@if (@$trainingData)
    
        <div class="form-group row justify-content-center" style="margin-top: 20px;margin-left: 16%;">
            <div class="col-4">
                <button class="btn btn-success" style="background-color: ##3bcfcb;"
                    type="submit">{{ __('buttons.general.crud.create') }}</button>
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


@push('after-scripts')
    <script>
        $(function() {
            var avatar_location = $("#avatar_location");

            if ($('input[name=avatar_type]:checked').val() === 'storage') {
                avatar_location.show();
            } else {
                avatar_location.hide();
            }

            $('input[name=avatar_type]').change(function() {
                if ($(this).val() === 'storage') {
                    avatar_location.show();
                } else {
                    avatar_location.hide();
                }
            });
        });
        $(document).on('change', '#payment_method', function() {
            if ($(this).val() === 'bank') {
                $('.paypal_details').hide();
                $('.bank_details').show();
            } else {
                $('.paypal_details').show();
                $('.bank_details').hide();
            }
        });
    </script>
     <script src="cdnjs.cloudflare.com/ajax/libs/timepicker/1.3.5/jquery.timepicker.min.js"></script>
     <script src="{{ asset('ivory/assets/js/datepickerConfig.js') }}"></script>
@endpush
