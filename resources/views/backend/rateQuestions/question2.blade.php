@extends('backend.layouts.app')
@section('title', __('labels.backend.tests.title') . ' | ' . app_name())

{{-- {{ dd($test->questions) }} --}}
@push('after-styles')
    <style>
        .select2-container--default .select2-selection--single {
            height: 35px;
        }

        .select2-container--default .select2-selection--single .select2-selection__rendered {
            line-height: 35px;
        }

        .select2-container--default .select2-selection--single .select2-selection__arrow {
            height: 35px;
        }

        .delete_quest {
            position: absolute;
            left: 10px;
            top: 10px;
            z-index: 99999;
        }

    </style>
@endpush
@section('content')


{{ html()->form('POST', route('admin.questions.storeQuestion'))->class('form-horizontal')->acceptsFiles()->open() }}
    <input type="hidden" name="form_type" value="{{request('form_type')}}">
    <input type="hidden" name="form_id" value="{{$forms_id}}">

    <div class="card">
        <div class="card-header">
            <h3 class="page-title float-left mb-0">@lang('labels.backend.questions.create')</h3>
            <div class="float-right">
                <a href="{{ route('admin.questions.index') }}"
                   class="btn btn-success">@lang('labels.backend.questions.view')</a>
            </div>
        </div>
        <div class="card-body">
           

     
               
                <input type="hidden"  name="question_id">
                    <div class="row"
                        style="background:#3bcfcb;margin: 1px;padding-top: 10px;border-radius:5px;position:relative">
                        <span class="delete_quest"><i class="fa fa-times"></i></span>
                        <div class="col-6 form-group">
                            <label for="">{{ trans('labels.backend.questions.fields.question') }}</label>
                            <input class="form-control" placeholder="{{ trans('labels.backend.questions.fields.question') }}"  name="question" type="text">
                        </div>
                        <div class="col-6 form-group">
                            <label for="">{{ trans('labels.backend.questions.fields.question_ar') }}</label>
                            <input class="form-control"  placeholder="{{ trans('labels.backend.questions.fields.question_ar') }}"  name="question_ar" type="text">
                        </div>
                        <div class="col-6 form-group">
                            <label for="">{{ trans('labels.backend.questions.fields.score') }}</label>
                            <input class="form-control " placeholder="{{ trans('labels.backend.questions.fields.score') }}" name="score" type="text">
                        </div>
                        <div class="col-6 form-group">
                            <label for="">{{ trans('labels.backend.questions.fields.question_type') }}</label>
                            <select class="form-control question_type" name="question_type">
                                <option  value="short_answer">{{ trans('labels.backend.questions.fields.short_answer') }}</option>
                                <option  value="paragraph">{{ trans('labels.backend.questions.fields.paragraph') }}</option>
                                <option  value="multiple_choice">{{ trans('labels.backend.questions.fields.multiple_choice') }}</option>
                                <option  value="drop_down">{{ trans('labels.backend.questions.fields.drop_down') }}</option>
                                <option  value="file_upload">{{ trans('labels.backend.questions.fields.file_upload') }}</option>
                                <option  value="date">{{ trans('labels.backend.questions.fields.date') }}</option>
                                <option  value="time">{{ trans('labels.backend.questions.fields.time') }}</option>
                                <option  value="radio">{{ trans('labels.backend.questions.fields.radio') }}</option>
                           
                            </select>
                        </div>
                      <div class="form-body"></div>
                    </div>

               
            
         
    
 

           
        </div>
    </div>

{!! Form::submit(trans('strings.backend.general.app_update'), ['class' => 'btn  btn-danger']) !!}
{{ html()->form()->close() }}

@stop

@push('after-scripts')
    <script>

$(document).ready(function () {
count_question=0;
    $(".question_type").change(function(){

switch($(this).val()) {


case 'paragraph':
    html='<textarea type="text" class="form-control"  autocomplete="off"  style="color:#000" value="paragraph" disabled="" >{{ trans('labels.backend.questions.fields.paragraph') }}</textarea>';
    break;

case 'file_upload':
    html='<input type="text" class="form-control"  autocomplete="off"  style="color:#000" value="{{ trans('labels.backend.questions.fields.file_upload') }}" disabled="" >';
    break;

case 'date':
    html='<input type="text" class="form-control"  autocomplete="off"  style="color:#000" value="{{ trans('labels.backend.questions.fields.date') }}" disabled="" >';
    break;

case 'time':
    html='<input type="text" class="form-control"  autocomplete="off"  style="color:#000" value="{{ trans('labels.backend.questions.fields.time') }}" disabled="" >';
    break;


case 'multiple_choice':
case 'drop_down':
    html='<div class="row options"  style="background:#3bcfcb;margin: 1px;padding-top: 10px;border-radius:5px">'+
            '<div class="col-12 form-group">'+
                '<h6>{{ trans('labels.backend.questions.fields.options') }}</h6>'+
            '</div>'+
            '<div class="col-4 form-group">'+
                '<label for="">{{ trans('labels.backend.questions.fields.option_text') }}</label>'+
                '<input class="form-control " placeholder="{{ trans('labels.backend.questions.fields.option_text') }}" name="q['+count_question+'][option_text][]" type="text">'+
            '</div>'+
            '<div class="col-4 form-group">'+
                '<label for="">{{ trans('labels.backend.questions.fields.option_text_ar') }}</label>'+
                '<input class="form-control " placeholder="{{ trans('labels.backend.questions.fields.option_text_ar') }}" name="q['+count_question+'][option_text_ar][]" type="text">'+
            '</div>'+
            '<div class="col-4 form-group">'+
                '<label for="">{{ trans('labels.backend.questions.fields.correct') }}</label>'+
                '<div><input name="q['+count_question+'][correct][0]" type="checkbox" value=1 ></div>'+
            '</div>'+
            '<div class="col-4 form-group">'+
                '<label for="">{{ trans('labels.backend.questions.fields.option_text') }}</label>'+
                '<input class="form-control " placeholder="{{ trans('labels.backend.questions.fields.option_text') }}" name="q['+count_question+'][option_text][]" type="text">'+
            '</div>'+
            '<div class="col-4 form-group">'+
                '<label for="">{{ trans('labels.backend.questions.fields.option_text_ar') }}</label>'+
                '<input class="form-control " placeholder="{{ trans('labels.backend.questions.fields.option_text_ar') }}" name="q['+count_question+'][option_text_ar][]" type="text">'+
            '</div>'+
            '<div class="col-4 form-group">'+
                '<label for="">{{ trans('labels.backend.questions.fields.correct') }}</label>'+
                '<div><input name="q['+count_question+'][correct][1]" type="checkbox"  value=1 ></div>'+
            '</div>'+
            '<div class="more_option col-12">'+
            '</div>'+
            '<div class="col-12 form-group">'+
                '<a href="javascript:void(0)" class="btn btn-success add_option"> + </a>'+
            '</div>';
    break;

case 'short_answer':
default:
    html='<input type="text" class="form-control"  autocomplete="off"  style="color:#000" value="{{ trans('labels.backend.questions.fields.short_answer') }}" disabled="" >';
}
console.log($(this).parents('.row').find('.form-body'));
$(this).parents('.row').find('.form-body').html(html)
});

});

$('.add_option').click(function () {
    count_question=0
count_option=$(this).parents('.row').find('.option_text').length+1;

option='';
option='<div class="row"  style="background:#3bcfcb;margin: 1px;padding-top: 10px;border-radius:5px">'+
            '<div class="col-4 form-group" style="padding-right:0">'+
                '<label for="">{{ trans('labels.backend.questions.fields.option_text') }}</label>'+
                '<input class="form-control option_text" placeholder="{{ trans('labels.backend.questions.fields.option_text') }}" name="q['+count_question+'][option_text][]" type="text">'+
            '</div>'+
            '<div class="col-4 form-group">'+
                '<label for="">{{ trans('labels.backend.questions.fields.option_text_ar') }}</label>'+
                '<input class="form-control " placeholder="{{ trans('labels.backend.questions.fields.option_text_ar') }}" name="q['+count_question+'][option_text_ar][]" type="text">'+
            '</div>'+
            '<div class="col-4 form-group">'+
                '<label for="">{{ trans('labels.backend.questions.fields.correct') }}</label>'+
                '<div><input name="q['+count_question+'][correct]['+count_option+']" type="checkbox" value=1  ></div>'+
            '</div>';

   $(this).parents('.row').find('.more_option').append(option)
}); 
</script>

@endpush
