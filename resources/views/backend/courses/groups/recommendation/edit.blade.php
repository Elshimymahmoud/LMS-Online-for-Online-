@extends('backend.layouts.app')
@section('title', __('labels.backend.programRec.title') . ' | ' . app_name())

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

    </style>

@endpush
@section('content')
    {!! Form::model($recommendation, ['method' => 'PUT', 'route' => ['admin.recommendations.update', "id"=> $recommendation->id],'files' => true]) !!}
    <div class="alert alert-danger d-none" role="alert">
        <button type="button" class="close" data-dismiss="alert" aria-label="Close">
            <span aria-hidden="true">×</span>
        </button>
        <div class="error-list">
        </div>
    </div>
    <div class="card">
        <div class="card-header">
            <h3 class="page-title d-inline">@lang('labels.backend.programRec.create')</h3>
            <div class="float-right">
                <a href="{{ route('admin.group.recommendations') }}" class="btn btn-success">@lang('labels.backend.programRec.view')</a>

            </div>
        </div>
        <div class="card-body">

            {{-- rate title --}}
            <div class="row form-group">
                {{ html()->label(__('labels.backend.programRec.fields.program_title_ar'))->class('col-md-2 form-control-label')->for('programRec_title') }}

                <div class="col-md-10">
                    {!! Form::text('recommendation_ar', old('recommendation_ar'), ['class' => 'form-control', 'placeholder' => trans('labels.backend.tests.fields.title_ar')]) !!}



                </div>
                <!--col-->
            </div>
            {{--  --}}
            <div class="row form-group">
                {{ html()->label(__('labels.backend.programRec.fields.program_title'))->class('col-md-2 form-control-label')->for('rate_title_ar') }}

                <div class="col-md-10">
                    {!! Form::text('recommendation', old('recommendation'), ['class' => 'form-control', 'placeholder' => trans('labels.backend.tests.fields.title')]) !!}


                </div>
                <!--col-->
            </div>
            {{--  --}}
            <div class="row form-group">
                {{ html()->label(__('labels.backend.impact.fields.type'))->class('col-md-2 form-control-label')->for('impact_title_ar') }}

                <div class="col-md-10">
                    <select name="user_type" id="" class="form-control">
                        @if ($recommendation->user_type == 'teacher')

                            <option value="teacher" selected>{{ __('labels.backend.impact.fields.teacher') }}</option>
                            <option value="student">{{ __('labels.backend.impact.fields.student') }}</option>

                        @else
                            <option value="student" selected>{{ __('labels.backend.impact.fields.student') }}</option>
                            <option value="teacher">{{ __('labels.backend.impact.fields.teacher') }}</option>

                        @endif
                    </select>


                </div>
                <!--col-->
            </div>

            <div class="row">
                <div class="col-12 form-group">
                    <div class="questions" id="questions">
                        @if (is_object($questions) && sizeof($questions) > 0)
                            @foreach ($questions as $key => $question)
                                <div class="row question_div"
                                     style="background:#3bcfcb;margin: 1px;padding-top: 10px;border-radius:5px;position:relative">
                                    <input type="hidden" value="{{ $question->id }}" name="q[{{$key}}][id]">
                                    <span class="delete_quest"><i class="fa fa-times"></i></span>
                                    <div class="col-4 form-group">
                                        <label for="">{{ trans('labels.backend.questions.fields.question_ar') }}</label>
                                        <input class="form-control" required  placeholder="{{ trans('labels.backend.questions.fields.question_ar') }}" value="{{ $question->question_ar }}" name="q[{{$key}}][question_ar]" type="text">
                                    </div>
                                    <div class="col-4 form-group">
                                        <label for="">{{ trans('labels.backend.questions.fields.question') }}</label>
                                        <input class="form-control" required placeholder="{{ trans('labels.backend.questions.fields.question') }}" value="{{ $question->question }}" name="q[{{$key}}][question]" type="text">
                                    </div>
                                    <div class="col-4 form-group">
                                        <label for="">{{ trans('labels.backend.questions.fields.question_type') }}</label>
                                        <select class="form-control question_type" question_type_key="{{$key}}" name="q[{{$key}}][question_type]">
                                            <option @if ($question->question_type == 'short_answer') selected @endif value="short_answer">{{ trans('labels.backend.questions.fields.short_answer') }}</option>
                                            <option @if ($question->question_type == 'paragraph') selected @endif value="paragraph">{{ trans('labels.backend.questions.fields.paragraph') }}</option>
                                            <option @if ($question->question_type == 'multiple_choice') selected @endif value="multiple_choice">{{ trans('labels.backend.questions.fields.multiple_choice') }}</option>
                                            <option @if ($question->question_type == 'drop_down') selected @endif value="drop_down">{{ trans('labels.backend.questions.fields.drop_down') }}</option>
                                            <option @if ($question->question_type == 'file_upload') selected @endif value="file_upload">{{ trans('labels.backend.questions.fields.file_upload') }}</option>
                                            <option @if ($question->question_type == 'date') selected @endif value="date">{{ trans('labels.backend.questions.fields.date') }}</option>
                                            <option @if ($question->question_type == 'time') selected @endif value="time">{{ trans('labels.backend.questions.fields.time') }}</option>
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
                                                @break

                                            @case('multiple_choice')
                                            @case('drop_down')
                                                <div class="row options" style="background:#3bcfcb;margin: 1px;padding-top: 10px;border-radius:5px">

                                                    <div class="col-12 form-group">
                                                        <h6>{{ trans('labels.backend.questions.fields.options') }}</h6>
                                                    </div>
                                                    {{-- {{ dd($question->options) }} --}}
                                                    @foreach ($question->options as $option_key => $option)

                                                        <div class="row"  style="background:#3bcfcb;margin: 1px;padding-top: 10px;border-radius:5px">


                                                            <input type="hidden" value="{{ $option->id }}" name="q[{{$key}}][option_id][]">
                                                            @if($option_key>1)
                                                                <span class="col-12 delete_option" style="left: 24px"><i class="fa fa-times"></i></span>

                                                            @endif
                                                            <div class="col-4 form-group">
                                                                <label for="">{{ trans('labels.backend.questions.fields.option_text') }}</label>
                                                                <input class="form-control option_text" value="{{$option->option_text}}" placeholder="{{ trans('labels.backend.questions.fields.option_text') }}" name="q[{{$key}}][option_text][]" type="text">
                                                            </div>
                                                            <div class="col-4 form-group">
                                                                <label for="">{{ trans('labels.backend.questions.fields.option_text_ar') }}</label>
                                                                <input class="form-control " value="{{$option->option_text_ar}}"  placeholder="{{ trans('labels.backend.questions.fields.option_text_ar') }}" name="q[{{$key}}][option_text_ar][]" type="text">
                                                            </div>
                                                            <div class="col-4 form-group">
                                                                <label for="">{{ trans('labels.backend.questions.fields.correct') }}</label>
                                                                <div><input @if ($option->correct == 1) checked  @endif name="q[{{$key}}][correct][{{$option_key}}]" type="checkbox" value=1></div>
                                                            </div>
                                                        </div>

                                                    @endforeach

                                                    <div class="more_option col-12">
                                                    </div>
                                                    <div class="col-12 form-group">
                                                        <a href="javascript:void(0)" count_question2="{{$key}}" class="btn btn-success add_option"> + </a>
                                                    </div>
                                                </div>
                                                @break

                                            @case('short_answer')
                                            @default:
                                            <input type="text" class="form-control" autocomplete="off" style="color:#000"  value="{{ trans('labels.backend.questions.fields.short_answer') }}" disabled="">

                                        @endswitch
                                    </div>
                                </div>
                            @endforeach
                        @endif
                    </div>
                </div>
            </div>

            <div class="row">
                <div class="col-12 form-group">
                    <a href="javascript:void(0)" class="btn btn-success add_question">{{ trans('labels.backend.questions.fields.add_question') }}</a>
                </div>
            </div>

            <div class="row">
                <div class="col-12 form-group">
                    {!! Form::hidden('published', 0) !!}
                    {!! Form::checkbox('published', 1, old('published'), []) !!}
                    {!! Form::label('published', trans('labels.backend.tests.fields.published'), ['class' => 'control-label font-weight-bold']) !!}
                </div>
            </div>

            <div class="form-group row justify-content-center">
                <div class="col-4">
                    {{ form_cancel(route('admin.group.recommendations'), __('buttons.general.cancel')) }}

                    <button class="btn btn-success pull-right" type="submit">{{ __('buttons.general.crud.edit') }}</button>
                </div>
            </div>
            <!--col-->
        </div>
    </div>
    {{ html()->form()->close() }}
@endsection


@push('after-scripts')
    <script>
        $(document).ready(function() {

            count_question={{ sizeof($questions)-1}};
            $(".add_question").click(function(){
                count_question++;

                new_ques='<div class="row"  style="background:#3bcfcb;margin: 1px;padding-top: 10px;border-radius:5px;position:relative">'+
                    '<span class="delete_quest"><i class="fa fa-times"></i></span>'+
                    '<div class="col-4 form-group">'+
                    '<label for="">{{ trans('labels.backend.questions.fields.question_ar') }}</label>'+
                    '<input class="form-control " required placeholder="{{ trans('labels.backend.questions.fields.question_ar') }}" name="q['+count_question+'][question_ar]" type="text">'+
                    '</div>'+
                    '<div class="col-4 form-group">'+
                    '<label for="">{{ trans('labels.backend.questions.fields.question') }}</label>'+
                    '<input class="form-control " required placeholder="{{ trans('labels.backend.questions.fields.question') }}" name="q['+count_question+'][question]" type="text">'+
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
                            // alert('remove');
                            $(this).closest('.row')[0].remove()
                        });
                        $(".delete_option").click(function(){
                            // alert('remove');
                            $(this).parents('.row').remove()
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
                                            '<span class="col-12 delete_option"><i class="fa fa-times"></i></span>'+

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
                                        $(".delete_option").click(function(){
                                            // alert('remove');
                                            $(this).parents('.row')[0].remove()

                                        });
                                    });
                                });
                        });
                    });
            });




            $(".delete_quest").click(function(){
                // alert('remove');
                $(this).closest('.row')[0].remove()
            });

            $(".question_type").change(function(){
                count_question=$($(this)[0]).attr('name').match(/\d+/);
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
                            '<input class="form-control option_text" placeholder="{{ trans('labels.backend.questions.fields.option_text') }}" name="q['+count_question+'][option_text][]" type="text">'+
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
                            '<a href="javascript:void(0)" count_question2='+count_question+' class="btn btn-success add_option"> + </a>'+
                            '</div>';
                        break;

                    case 'short_answer':
                    default:
                        html='<input type="text" class="form-control"  autocomplete="off"  style="color:#000" value="{{ trans('labels.backend.questions.fields.short_answer') }}" disabled="" >';
                }

                $(this).closest('.row').find('.form-body').html(html)
                    .ready(function () {
                        $('.add_option').click(function () {

                            count_option=$(this).closest('.row').find('.option_text').length+1;
                            count_question2=$(this).attr('count_question2');

                            option='';
                            option='<div class="row"  style="background:#3bcfcb;margin: 1px;padding-top: 10px;border-radius:5px">'+
                                '<span class="col-12 delete_option"><i class="fa fa-times"></i></span>'+

                                '<div class="col-4 form-group" style="padding-right:0">'+
                                '<label for="">{{ trans('labels.backend.questions.fields.option_text') }}</label>'+
                                '<input class="form-control option_text" placeholder="{{ trans('labels.backend.questions.fields.option_text') }}" name="q['+count_question2+'][option_text][]" type="text">'+
                                '</div>'+
                                '<div class="col-4 form-group">'+
                                '<label for="">{{ trans('labels.backend.questions.fields.option_text_ar') }}</label>'+
                                '<input class="form-control " placeholder="{{ trans('labels.backend.questions.fields.option_text_ar') }}" name="q['+count_question2+'][option_text_ar][]" type="text">'+
                                '</div>'+
                                '<div class="col-4 form-group">'+
                                '<label for="">{{ trans('labels.backend.questions.fields.correct') }}</label>'+
                                '<div><input name="q['+count_question2+'][correct]['+count_option+']" type="checkbox" value=1  ></div>'+
                                '</div>';

                            $(this).closest('.row').find('.more_option').append(option)
                            $(".delete_option").click(function(){
                                // alert('remove');
                                $(this).parents('.row')[0].remove()



                            });
                        });
                    });
            });

            $('.add_option').click(function () {

                count_option=$(this).closest('.row').find('.option_text').length+1;
                count_question2=$(this).attr('count_question2');

                option='';
                option='<div class="row"  style="background:#3bcfcb;margin: 1px;padding-top: 10px;border-radius:5px">'+
                    '<span class="col-12 delete_option"><i class="fa fa-times"></i></span>'+

                    '<div class="col-4 form-group" style="padding-right:0">'+
                    '<label for="">{{ trans('labels.backend.questions.fields.option_text') }}</label>'+
                    '<input class="form-control option_text" placeholder="{{ trans('labels.backend.questions.fields.option_text') }}" name="q['+count_question2+'][option_text][]" type="text">'+
                    '</div>'+
                    '<div class="col-4 form-group">'+
                    '<label for="">{{ trans('labels.backend.questions.fields.option_text_ar') }}</label>'+
                    '<input class="form-control " placeholder="{{ trans('labels.backend.questions.fields.option_text_ar') }}" name="q['+count_question2+'][option_text_ar][]" type="text">'+
                    '</div>'+
                    '<div class="col-4 form-group">'+
                    '<label for="">{{ trans('labels.backend.questions.fields.correct') }}</label>'+
                    '<div><input name="q['+count_question2+'][correct]['+count_option+']" type="checkbox" value=1  ></div>'+
                    '</div>';

                $(this).closest('.row').find('.more_option').append(option)
                $(".delete_option").click(function(){
                    // alert('remove');
                    $(this).parents('.row')[0].remove()



                });
            });

            $(".delete_option").click(function(){
                // alert('remove');
                $(this).parents('.row')[0].remove()

            });
        });


    </script>
@endpush
