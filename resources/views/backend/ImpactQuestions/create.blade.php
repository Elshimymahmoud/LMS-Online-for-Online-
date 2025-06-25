@extends('backend.layouts.app')
@section('title', __('labels.backend.impact.title').' | '.app_name())

@push('after-styles')
    <style>
        .form-control-label {
            line-height: 35px;
        }
        .remove{
            float: right;
            color: red;
            font-size: 20px;
            cursor: pointer;
        }
        .error{
            color: red;
        }

    </style>

@endpush
@section('content')
    {{ html()->form('POST', route('admin.ImpactQuestions.store'))->id('question-create')->class('form-horizontal')->acceptsFiles()->open() }}
    <div class="alert alert-danger d-none" role="alert">
        <button type="button" class="close" data-dismiss="alert" aria-label="Close">
            <span aria-hidden="true">×</span>
        </button>
        <div class="error-list">
        </div>
    </div>
<div class="card">
    <div class="card-header">
        <h3 class="page-title d-inline">@lang('labels.backend.impact.fields.questions')</h3>
        
    </div>
    <div class="card-body">

        <div class="row form-group">
            {{ html()->label(__('labels.backend.impact.fields.question'))->class('col-md-2 form-control-label')->for('course_type') }}

            <div class="col-md-10">
         
          
                {{ html()->text('question')
                    ->class('form-control')
                    ->required('true')
                    ->placeholder(__('labels.backend.impact.fields.question'))
                ->autofocus()
                }}

 
            </div><!--col-->
        </div>


        <div class="row form-group">
            {{ html()->label(__('labels.backend.impact.fields.questions_ar'))->class('col-md-2 form-control-label')->for('course_type') }}

            <div class="col-md-10">
         
          
            
                {{ html()->text('question_ar')
                    ->class('form-control')
                    ->placeholder(__('labels.backend.impact.fields.questions_ar'))
                ->autofocus()
                }}

 
            </div><!--col-->
        </div>


        <input type="hidden" name="impact_measurement_id" value="{{$impact_id}}">
        <div class="form-group row justify-content-center">
            <div class="col-4">
                {{ form_cancel(route('admin.impact.index'), __('buttons.general.cancel')) }}

                <button class="btn btn-success pull-right" type="submit">{{__('buttons.general.crud.create')}}</button>
            </div>
        </div><!--col-->
    </div>
</div>

{{ html()->form()->close() }}
@endsection

@push('head-scripts')
<script type="text/javascript">
    function changeRequiredAttr(src) {
        $question_option=document.getElementById('question_option');
        $question_option_ar=document.getElementById('question_option_ar');
        if(src.value=='radio'){
            $question_option.setAttribute('required', true);
            $question_option_ar.setAttribute('required', true);
        }
        else{
          
            $question_option.removeAttribute('required');
            $question_option_ar.removeAttribute('required');
        
        }
    }
    
 
</script>
@endpush
