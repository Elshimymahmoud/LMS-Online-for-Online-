@extends('backend.layouts.app')
@php
$form_type=request('form_type');
$title="menus.backend.forms.$form_type";
$Create="menus.backend.forms.create";
$Edit="menus.backend.forms.edit";


@endphp
@section('title', __($title).' | '.app_name())

@push('after-styles')
<style>
    .form-control-label {
        line-height: 35px;
    }

    .remove {
        float: right;
        color: red;
        font-size: 20px;
        cursor: pointer;
    }

    .error {
        color: red;
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
{{ html()->form('PUT', route('admin.forms.update',['id'=>$rate->id,'form_type'=>$rate->form_type,'course_id'=>request('course_id')]))->id('rate-create')->class('form-horizontal')->acceptsFiles()->open() }}
<div class="alert alert-danger d-none" role="alert">
    <button type="button" class="close" data-dismiss="alert" aria-label="Close">
        <span aria-hidden="true">×</span>
    </button>
    <div class="error-list">
    </div>
</div>
<div class="card">
    <div class="card-header">
        <h3 class="page-title d-inline"> @lang($Edit) @lang($title) </h3>
        <div class="float-right">
            <!-- @if(request('course_id'))
                <a href="{{ route('admin.forms2.index2',['form_type'=>request('form_type'),'course_id'=>request('course_id')]) }}"
                   class="btn btn-success">&#8592</a>

                @else
                <a href="{{ route('admin.forms.index',['form_type'=>request('form_type')]) }}"
                   class="btn btn-success">&#8592</a>
                @endif -->
            <a href="{{ request('course_id')?(route('admin.forms2.index2',['form_type'=>request('form_type'),'course_id'=>request('course_id')])):(route('admin.forms.index',['form_type'=>request('form_type')])) }}" class="btn btn-primary">&#8592</a>



        </div>
    </div>
    <div class="card-body">

        {{-- rate title --}}
        <div class="row form-group">
            {{ html()->label(__('labels.backend.rates.fields.rate_title'))->class('col-md-2 form-control-label')->for('rate_title') }}

            <div class="col-md-10">
                {!! Form::text('title', $rate->title, ['class' => 'form-control ']) !!}



            </div><!--col-->
        </div>
        {{-- --}}
        <div class="row form-group">
            {{ html()->label(__('labels.backend.rates.fields.rate_title_ar'))->class('col-md-2 form-control-label')->for('rate_title_ar') }}

            <div class="col-md-10">
                {!! Form::text('title_ar',$rate->title_ar, ['class' => 'form-control ']) !!}


            </div><!--col-->

            {{ html()->label(__('labels.backend.rates.fields.taken_by'))->class('col-md-2 form-control-label')->for('rate_title_ar') }}

            <div class="col-md-10">
                <select name="type" id="" class="form-control">
                    @if($rate->type=='teacher')
                    <option value="teacher">{{ __('labels.backend.impact.fields.teacher') }}</option>
                    <option value="student">{{ __('labels.backend.impact.fields.student') }}</option>
                    @else
                    <option value="student">{{ __('labels.backend.impact.fields.student') }}</option>
                    <option value="teacher">{{ __('labels.backend.impact.fields.teacher') }}</option>
                    @endif
                </select>


            </div>
        </div>
        {{-- --}}

        @if (is_object($rate->questions) && sizeof($rate->questions) > 0)
        @foreach ($rate->questions as $key => $question)
        <input type="hidden" value="{{ $question->id }}" name="q[{{$key}}][id]">
        <div class="row" style="background:#3bcfcb;margin: 1px;padding-top: 10px;border-radius:5px;position:relative">
            <span class="delete_quest"><i class="fa fa-times"></i></span>
            <div class="col-4 form-group">
                <label for="">{{ trans('labels.backend.questions.fields.question') }}</label>
                <input class="form-control" placeholder="{{ trans('labels.backend.questions.fields.question') }}" value="{{ $question->question }}" name="q[{{$key}}][question]" type="text">
            </div>
            <div class="col-4 form-group">
                <label for="">{{ trans('labels.backend.questions.fields.question_ar') }}</label>
                <input class="form-control" placeholder="{{ trans('labels.backend.questions.fields.question_ar') }}" value="{{ $question->question_ar }}" name="q[{{$key}}][question_ar]" type="text">
            </div>
            <div class="col-4 form-group">
                <label for="">{{ trans('labels.backend.questions.fields.question_type') }}</label>
                <select class="form-control question_type" name="q[{{$key}}][question_type]">
                    <option @if ($question->question_type == 'short_answer') selected @endif value="short_answer">{{ trans('labels.backend.questions.fields.short_answer') }}</option>
                    <option @if ($question->question_type == 'paragraph') selected @endif value="paragraph">{{ trans('labels.backend.questions.fields.paragraph') }}</option>
                    <option @if ($question->question_type == 'multiple_choice') selected @endif value="multiple_choice">{{ trans('labels.backend.questions.fields.multiple_choice') }}</option>
                    <option @if ($question->question_type == 'drop_down') selected @endif value="drop_down">{{ trans('labels.backend.questions.fields.drop_down') }}</option>
                    <option @if ($question->question_type == 'file_upload') selected @endif value="file_upload">{{ trans('labels.backend.questions.fields.file_upload') }}</option>
                    <option @if ($question->question_type == 'date') selected @endif value="date">{{ trans('labels.backend.questions.fields.date') }}</option>
                    <option @if ($question->question_type == 'time') selected @endif value="time">{{ trans('labels.backend.questions.fields.time') }}</option>
                    <option @if ($question->question_type == 'radio') selected @endif value="radio">{{ trans('labels.backend.questions.fields.radio') }}</option>

                </select>
            </div>
            <div class="col-12 form-group form-body">
                @switch($question->question_type)
                @case('paragraph')
                <textarea type="text" class="form-control" autocomplete="off" style="color:#000" value="paragraph" disabled="">{{ trans('labels.backend.questions.fields.paragraph') }}</textarea>
                @break

                @case('file_upload')
                <input type="text" class="form-control" autocomplete="off" style="color:#000" value="{{ trans('labels.backend.questions.fields.file_upload') }}" disabled="">
                @break

                @case('date')
                <input type="text" class="form-control" autocomplete="off" style="color:#000" value="{{ trans('labels.backend.questions.fields.date') }}" disabled="">
                @break

                @case('time')
                <input type="text" class="form-control" autocomplete="off" style="color:#000" value="{{ trans('labels.backend.questions.fields.time') }}" disabled="">
                @case('radio')
                <input type="text" class="form-control" autocomplete="off" style="color:#000" value="{{ trans('labels.backend.questions.fields.radio') }}" disabled="">
                @break


                @case('multiple_choice')
                @case('drop_down')
                <div class="row options" style="background:#3bcfcb;margin: 1px;padding-top: 10px;border-radius:5px">

                    <div class="col-12 form-group">
                        <h6>{{ trans('labels.backend.questions.fields.options') }}</h6>
                    </div>
                    {{-- {{ dd($question->options) }} --}}
                    @foreach ($question->options as $option_key => $option)
                    <input type="hidden" value="{{ $option->id }}" name="q[{{$key}}][option_id][]">
                    <div class="col-4 form-group">
                        <label for="">{{ trans('labels.backend.questions.fields.option_text') }}</label>
                        <input class="form-control option_text" value="{{$option->option_text}}" placeholder="{{ trans('labels.backend.questions.fields.option_text') }}" name="q[{{$key}}][option_text][]" type="text">
                    </div>
                    <div class="col-4 form-group">
                        <label for="">{{ trans('labels.backend.questions.fields.option_text_ar') }}</label>
                        <input class="form-control " value="{{$option->option_text_ar}}" placeholder="{{ trans('labels.backend.questions.fields.option_text_ar') }}" name="q[{{$key}}][option_text_ar][]" type="text">
                    </div>
                    <div class="col-4 form-group">
                        <label for="">{{ trans('labels.backend.questions.fields.correct') }}</label>
                        <div><input @if ($option->correct == 1) checked @endif name="q[{{$key}}][correct][{{$option_key}}]" type="checkbox" value=1></div>
                    </div>
                    @endforeach

                    <div class="more_option col-12">
                    </div>
                    <div class="col-12 form-group">
                        <a href="javascript:void(0)" class="btn btn-success add_option"> + </a>
                    </div>
                </div>
                @break
                @case('radio')

                <input type="text" class="form-control" autocomplete="off" style="color:#000" value="{{ trans('labels.backend.questions.fields.radio') }}" disabled="">
                @break
                @case('short_answer')
                @default
                <input type="text" class="form-control" autocomplete="off" style="color:#000" value="{{ trans('labels.backend.questions.fields.short_answer') }}" disabled="">

                @endswitch
            </div>
        </div>

        @endforeach
        @endif
        <div class="row">
            <div class="col-12 form-group">
                <div class="questions" id="questions"> </div>
            </div>
        </div>

        <div class="row">
            <div class="col-12 form-group">
                <a href="javascript:void(0)" class="btn btn-success add_question">{{ trans('labels.backend.questions.fields.add_question') }}</a>
            </div>
        </div>


        <div class="row">
            <div class="col-12 form-group">
                <!--                     
                    {!! Form::checkbox('published', 1, $rate->published == 1 ? true : false, ['id' => 'published']) !!}
                    {!! Form::label('published', trans('labels.backend.tests.fields.published'), ['class' => 'control-label font-weight-bold']) !!}
         -->
                <input type="hidden" name="published" value="0">
                <input type="checkbox" id="published" name="published" value="1" {{ $rate->published == 1 ? 'checked' : '' }}>
                <label for="published" class="control-label font-weight-bold">{{ trans('labels.backend.tests.fields.published') }}</label>

            </div>
        </div>
        <div class="form-group row justify-content-center">
            <div class="col-4">
            <a href="{{ url()->previous() }}" class="btn btn-primary"> {{__('buttons.general.cancel')}}</a>

                <button class="btn btn-success pull-right" type="submit">{{__('buttons.general.crud.edit')}}</button>
            </div>
        </div><!--col-->
    </div>
</div>
{{ html()->form()->close() }}
@endsection


@push('after-scripts')
    <script>

        $(document).ready(function () {

        count_question={{ sizeof($rate->questions)-1}};
        $(".add_question").click(function(){
            count_question++;
            

            new_ques='<div class="row"  style="background:#3bcfcb;margin: 1px;padding-top: 10px;border-radius:5px;position:relative">'+
                        '<span class="delete_quest"><i class="fa fa-times"></i></span>'+
                        '<div class="col-4 form-group">'+
                            '<label for="">{{ trans('labels.backend.questions.fields.question') }}</label>'+
                            '<input class="form-control " placeholder="{{ trans('labels.backend.questions.fields.question') }}" name="q['+count_question+'][question]" type="text">'+
                        '</div>'+
                        '<div class="col-4 form-group">'+
                            '<label for="">{{ trans('labels.backend.questions.fields.question_ar') }}</label>'+
                            '<input class="form-control " placeholder="{{ trans('labels.backend.questions.fields.question_ar') }}" name="q['+count_question+'][question_ar]" type="text">'+
                        '</div>'+
                        '<div class="col-4 form-group">'+
                            '<label for="">{{ trans('labels.backend.questions.fields.question_type') }}</label>'+
                            '<select class="form-control question_type" name="q['+count_question+'][question_type]">'+
                                '<option value="short_answer">{{ trans('labels.backend.questions.fields.short_answer') }}</option>'+
                                '<option value="paragraph">{{ trans('labels.backend.questions.fields.paragraph') }}</option>'+
                                '<option value="multiple_choice">{{ trans('labels.backend.questions.fields.multiple_choice') }}</option>'+
                                '<option value="drop_down">{{ trans('labels.backend.questions.fields.drop_down') }}</option>'+
                                '<option value="file_upload">{{ trans('labels.backend.questions.fields.file_upload') }}</option>'+
                                '<option value="date">{{ trans('labels.backend.questions.fields.date') }}</option>'+
                                '<option value="time">{{ trans('labels.backend.questions.fields.time') }}</option>'+
                                '<option value="radio">{{ trans('labels.backend.questions.fields.radio') }}</option>' +
                            
                            '</select>'+
                        '</div>'+
                        '<div class="col-12 form-group form-body">'+
                            '<input type="text" class="form-control"  autocomplete="off"  style="color:#000" value="Short answer text" disabled="" >'+
                        '</div>'+
                    '</div>';
            $("#questions").append(new_ques)
            .ready(function () {

                $(".delete_quest").click(function(){
                    
                    
                    $(this).closest('.row')[0].remove()
                   
                });

                $(".question_type").change(function(){
                    console.log($(this),"sss");
                   
                    questcount=$($(this)[0]).attr('name').match(/\d+/);

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
                                '<input class="form-control option_text" placeholder="{{ trans('labels.backend.questions.fields.option_text') }}" name="q['+questcount+'][option_text][]" type="text">'+
                            '</div>'+
                            '<div class="col-4 form-group">'+
                                '<label for="">{{ trans('labels.backend.questions.fields.option_text_ar') }}</label>'+
                                '<input class="form-control " placeholder="{{ trans('labels.backend.questions.fields.option_text_ar') }}" name="q['+questcount+'][option_text_ar][]" type="text">'+
                            '</div>'+
                            '<div class="col-4 form-group">'+
                                '<label for="">{{ trans('labels.backend.questions.fields.correct') }}</label>'+
                                '<div><input name="q['+questcount+'][correct][0]" type="checkbox" value=1 ></div>'+
                            '</div>'+
                            '<div class="col-4 form-group">'+
                                '<label for="">{{ trans('labels.backend.questions.fields.option_text') }}</label>'+
                                '<input class="form-control option_text" placeholder="{{ trans('labels.backend.questions.fields.option_text') }}" name="q['+questcount+'][option_text][]" type="text">'+
                            '</div>'+
                            '<div class="col-4 form-group">'+
                                '<label for="">{{ trans('labels.backend.questions.fields.option_text_ar') }}</label>'+
                                '<input class="form-control " placeholder="{{ trans('labels.backend.questions.fields.option_text_ar') }}" name="q['+questcount+'][option_text_ar][]" type="text">'+
                            '</div>'+
                            '<div class="col-4 form-group">'+
                                '<label for="">{{ trans('labels.backend.questions.fields.correct') }}</label>'+
                                '<div><input name="q['+questcount+'][correct][1]" type="checkbox"  value=1 ></div>'+
                            '</div>'+
                            '<div class="more_option col-12">'+
                            '</div>'+
                            '<div class="col-12 form-group">'+
                                '<a href="javascript:void(0)" class="btn btn-success add_option"> + </a>'+
                            '</div>';
                    break;
                case 'radio':
                    html='<input type="text" class="form-control"  autocomplete="off"  style="color:#000" value="{{ trans('labels.backend.questions.fields.radio') }}" disabled="" >';
                    break;
                case 'short_answer':
                default:
                    html='<input type="text" class="form-control"  autocomplete="off"  style="color:#000" value="{{ trans('labels.backend.questions.fields.short_answer') }}" disabled="" >';
                }

                $(this).closest('.row').find('.form-body').html(html)
                .ready(function () {
                   $('.add_option').click(function () {
                   
                    count_option=$(this).closest('.row').find('.option_text')[0].length+1;
                 
                    option='';
                    option='<div class="row"  style="background:#3bcfcb;margin: 1px;padding-top: 10px;border-radius:5px">'+
                                '<div class="col-4 form-group" style="padding-right:0">'+
                                    '<label for="">{{ trans('labels.backend.questions.fields.option_text') }}</label>'+
                                    '<input class="form-control option_text" placeholder="{{ trans('labels.backend.questions.fields.option_text') }}" name="q['+questcount+'][option_text][]" type="text">'+
                                '</div>'+
                                '<div class="col-4 form-group">'+
                                    '<label for="">{{ trans('labels.backend.questions.fields.option_text_ar') }}</label>'+
                                    '<input class="form-control " placeholder="{{ trans('labels.backend.questions.fields.option_text_ar') }}" name="q['+questcount+'][option_text_ar][]" type="text">'+
                                '</div>'+
                                '<div class="col-4 form-group">'+
                                    '<label for="">{{ trans('labels.backend.questions.fields.correct') }}</label>'+
                                    '<div><input name="q['+questcount+'][correct]['+count_option+']" type="checkbox" value=1  ></div>'+
                                '</div>';

                       $(this).closest('.row').find('.more_option').append(option)
                   }); 
                });
                });
            });
        });

       

       
        $(".delete_quest").click(function(){
                    
                    
                    $(this).closest('.row')[0].remove()
                    
                });

        $(".question_type").change(function(){

        questcount=$($(this)[0]).attr('name').match(/\d+/);

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
                                '<input class="form-control option_text" placeholder="{{ trans('labels.backend.questions.fields.option_text') }}" name="q['+questcount+'][option_text][]" type="text">'+
                            '</div>'+
                            '<div class="col-4 form-group">'+
                                '<label for="">{{ trans('labels.backend.questions.fields.option_text_ar') }}</label>'+
                                '<input class="form-control " placeholder="{{ trans('labels.backend.questions.fields.option_text_ar') }}" name="q['+questcount+'][option_text_ar][]" type="text">'+
                            '</div>'+
                            '<div class="col-4 form-group">'+
                                '<label for="">{{ trans('labels.backend.questions.fields.correct') }}</label>'+
                                '<div><input name="q['+questcount+'][correct][0]" type="checkbox" value=1 ></div>'+
                            '</div>'+
                            '<div class="col-4 form-group">'+
                                '<label for="">{{ trans('labels.backend.questions.fields.option_text') }}</label>'+
                                '<input class="form-control " placeholder="{{ trans('labels.backend.questions.fields.option_text') }}" name="q['+questcount+'][option_text][]" type="text">'+
                            '</div>'+
                            '<div class="col-4 form-group">'+
                                '<label for="">{{ trans('labels.backend.questions.fields.option_text_ar') }}</label>'+
                                '<input class="form-control " placeholder="{{ trans('labels.backend.questions.fields.option_text_ar') }}" name="q['+questcount+'][option_text_ar][]" type="text">'+
                            '</div>'+
                            '<div class="col-4 form-group">'+
                                '<label for="">{{ trans('labels.backend.questions.fields.correct') }}</label>'+
                                '<div><input name="q['+questcount+'][correct][1]" type="checkbox"  value=1 ></div>'+
                            '</div>'+
                            '<div class="more_option col-12">'+
                            '</div>'+
                            '<div class="col-12 form-group">'+
                                '<a href="javascript:void(0)" class="btn btn-success add_option"> + </a>'+
                            '</div>';
                            
                    break;
                    case 'radio':
                            html ='<input type="text" class="form-control"  autocomplete="off"  style="color:#000" value="{{ trans('labels.backend.questions.fields.radio') }}" disabled="" >';
                            break;
                    case 'short_answer':
                    default:
                    html='<input type="text" class="form-control"  autocomplete="off"  style="color:#000" value="{{ trans('labels.backend.questions.fields.short_answer') }}" disabled="" >';
                }

                $(this).closest('.row').find('.form-body').html(html)
                .ready(function () {
                    $('.add_option').click(function () {
         
                   
                    count_option=$(this).closest('.row').find('.option_text').length+1;

                    option='';
                    option='<div class="row"  style="background:#3bcfcb;margin: 1px;padding-top: 10px;border-radius:5px">'+
                                '<div class="col-4 form-group" style="padding-right:0">'+
                                    '<label for="">{{ trans('labels.backend.questions.fields.option_text') }}</label>'+
                                    '<input class="form-control option_text" placeholder="{{ trans('labels.backend.questions.fields.option_text') }}" name="q['+questcount+'][option_text][]" type="text">'+
                                '</div>'+
                                '<div class="col-4 form-group">'+
                                    '<label for="">{{ trans('labels.backend.questions.fields.option_text_ar') }}</label>'+
                                    '<input class="form-control " placeholder="{{ trans('labels.backend.questions.fields.option_text_ar') }}" name="q['+questcount+'][option_text_ar][]" type="text">'+
                                '</div>'+
                                '<div class="col-4 form-group">'+
                                    '<label for="">{{ trans('labels.backend.questions.fields.correct') }}</label>'+
                                    '<div><input name="q['+questcount+'][correct]['+count_option+']" type="checkbox" value=1  ></div>'+
                                '</div>';

                       $(this).closest('.row').find('.more_option').append(option)
        }); 
            });
        });

        $('.add_option').click(function () {
           
                   
                    count_option=$(this).closest('.row').find('.option_text').length+1;

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

                       $(this).closest('.row').find('.more_option').append(option)
        }); 


    });

</script>

@endpush
