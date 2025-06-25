@extends('backend.layouts.app')
@section('title', __('labels.backend.trainingData.title').' | '.app_name())

@section('content')
{!! Form::open(['method' => 'POST', 'route' => ['admin.trainingDataQuestions.store'], 'files' => true,]) !!}

<div class="card">
    <div class="card-header">
        <h3 class="page-title float-left mb-0">@lang('labels.backend.trainingData.create')</h3>
        <div class="float-right">
            <a href="{{ route('admin.trainingDataQuestions.index') }}"
                class="btn btn-success">@lang('labels.backend.trainingData.view')</a>
        </div>
    </div>
    <div class="card-body">
        <div class="row">
            <div class="col-12 form-group">
                {!! Form::label('question', trans('labels.backend.trainingData.fields.question').'*', ['class' =>
                'control-label']) !!}
                {!! Form::text('question', old('question'), ['class' => 'form-control ', 'placeholder' => '', 'required'
                => '']) !!}
                <p class="help-block"></p>
                @if($errors->has('question'))
                <p class="help-block">
                    {{ $errors->first('question') }}
                </p>
                @endif
            </div>
        </div>
        <div class="row">
            <div class="col-12 form-group">
                {!! Form::label('question_ar', trans('labels.backend.trainingData.fields.questions_ar').'*', ['class' =>
                'control-label']) !!}
                {!! Form::text('question_ar', old('question_ar'), ['class' => 'form-control ', 'placeholder' => '',
                'required' => '']) !!}
                <p class="help-block"></p>
                @if($errors->has('question'))
                <p class="help-block">
                    {{ $errors->first('question') }}
                </p>
                @endif
            </div>
        </div>

        {{-- --}}

        <div class="row form-group">
            {{ html()->label(__('labels.backend.trainingData.fields.questions_type'))->class('col-md-2
            form-control-label')->for('impact_title_ar') }}

            <div class="col-md-12">
                <select name="type" onchange="controlChoose(event)" id="questionType" class="form-control">
                    <option value="text">{{__('labels.backend.trainingData.text')}}</option>
                    <option value="choose">{{__('labels.backend.trainingData.choose')}}</option>
                    <option value="file">{{__('labels.backend.trainingData.file')}}</option>

                </select>


            </div>
            <!--col-->
        </div>
        {{-- --}}

        {{-- --}}

        <div class="row form-group" id="chooseNumberDiv" style="display: none">
            {{ html()->label(__('labels.backend.trainingData.fields.answer_option_number'))->class('col-md-2
            form-control-label')->for('impact_title_ar') }}

            <div class="col-md-12">
                <input type="number" value="4" min="1" onchange="setOptions(event)" name="chooseNumber" class="form-control"
                    id="chooseNumber">


            </div>
            <!--col-->
        </div>
        {{-- --}}


    </div>
</div>
<div id="optionsDiv">
    @php

    $count=@$_COOKIE['count'];

    @endphp

    @for ($question=1; $question<=$count; $question++) <div class="card chooseDiv " style="display:none">
        <div class="card-body">
            <div class="row">
                <div class="col-12 form-group">
                    {!! Form::label('option_text_' . $question,
                    trans('labels.backend.questions.fields.option_text').'*', ['class' => 'control-label']) !!}
                    {!! Form::text('option_text_' . $question, old('option_text'), ['class' => 'form-control ', 'rows'
                    => 3]) !!}
                    <p class="help-block"></p>
                    @if($errors->has('option_text_' . $question))
                    <p class="help-block">
                        {{ $errors->first('option_text_' . $question) }}
                    </p>
                    @endif
                </div>
            </div>


        </div>
</div>
@endfor
</div>
<input type="hidden" name="training_data_id" value="{{$training_data_id}}">
<div class="col-12 text-center">
    {!! Form::submit(trans('strings.backend.general.app_save'), ['class' => 'btn btn-danger mb-4 form-group']) !!}
</div>

{!! Form::close() !!}
@stop

@push('after-scripts')
<script>
    function controlChoose(event){
            let value=event.target.value;
            let chooseNumberDiv=document.getElementById('chooseNumberDiv');
            let chooseNumber=document.getElementById('chooseNumber');
            
            if(value=='choose'){
                chooseNumberDiv.style.display='block';
                chooseNumber.onchange();
               
            }
            else{
                chooseNumberDiv.style.display='none';
                hideOptions();

            }
        
         
        }
        function setOptions(event){
            let chooseNumber=document.getElementById('chooseNumber');
            let count=chooseNumber.value;
            document.cookie = "count = " + count;
            //refresh div that show options to take new value from cookie
            $( "#optionsDiv" ).load(window.location.href + " #optionsDiv" );
            setTimeout(() => {
                showOptions();
            }, 1000);
        }
        function showOptions(){
            document.querySelectorAll('.chooseDiv').forEach(element => {
               console.log(element);
               element.style.display='block';
               
               
            });;
        }
        
        function hideOptions(){
            document.querySelectorAll('.chooseDiv').forEach(element => {
               console.log(element);
               element.style.display='none';
               
               
            });;
        }
</script>
@endpush