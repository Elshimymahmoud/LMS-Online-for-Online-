    {{-- Form --}}
    {!! Form::open(['method' => 'POST', 'route' => ['admin.answerEvaluate.store'], 'files' => true,]) !!}
    
    <div class="first">
        <div class="middle-welcome">
            <table class="table  table-bordered">
                <thead>
                    <td colspan="3" 
                    style=" text-align: center;background-color: ##3bcfcb;
                    color: white;
                    text-decoration: underline;">
                        @lang('labels.backend.complainments.form')
                    </td>
                </thead>

                <tbody>
            {{--  --}}
            @php
                $quest_count=0;
                
            @endphp
            @foreach ($complaiments as $key => $complaiment)
            <input type="hidden" name="rate_ids[]" value="{{$complaiment->id}}">

            @foreach ($complaiment->questions as $Mainkey => $question)
                    <tr>
            @php
                $quest_count++;
                $userAnswers = $complaiment->getUserAnswers();
              
            @endphp
            
            <input type="hidden" name="rateQuestions[]"
                value="{{ $question->id }}">
            
            
            <td>
            <p>
                
                {{ $question->question_ar ? $question->question_ar : $question->question }}

               
            </p>
        </td>
         {{-- ///// --}}
            <td>
              <ul class="options-list pl-4">
            
            
                  @if (sizeof($question->options) && $question->question_type=="multiple_choice")
                      @foreach ($question->options as $option)
            
                      <div class="radio">
                        <label>
                            <input type="radio" name="{{ $question->id }}-options"
                                value="{{ $option->id }}" />
                            {{Lang::locale() == 'en'? $option->option_text: $option->option_text_ar}}<br />
                        </label>
                    </div>
                      @endforeach
                  @elseif (sizeof($question->options) && $question->question_type=="drop_down")
                      <select name="{{ $question->id }}-options"    class="form-control">
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
            </td>
            <td>
                {{ $question->question }}

            </td>
              {{-- ////////////////// --}}
            {{--  --}}
        </tr>
            @endforeach
            @endforeach

            {{--  --}}
            
           
        </tbody>
      
        </table>
            
          
            
    </div>
    </div>
    {{-- Form --}}
    @if ($complaiments)
    {{-- @if (count($userAnswers) == 0) --}}
        <div class="form-group row justify-content-center"
            style="margin-right: 5%;">
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
        {!! Form::close() !!}