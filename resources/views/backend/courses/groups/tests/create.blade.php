@extends('backend.layouts.app')
@section('title', __('labels.backend.tests.title') . ' | ' . app_name())

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
        .delete_quest{
            position: absolute;
            left: 10px;
            top: 10px;
            z-index: 99999;
        }
        .delete_option{
            position: relative;
            top: 57px;
            left: 21px;
        }

    </style>
@endpush
@section('content')

    {!! Form::open(['method' => 'POST', 'route' => ['admin.courses.groups.tests.store'],'files' => true]) !!}
    <input type="hidden" name="form_type" value="test">
    <div class="card">
        <div class="card-header">
            <h3 class="page-title float-left mb-0">@lang('labels.backend.tests.create')</h3>
            <div class="float-right">
                {{-- <a href="{{ route('admin.tests.index') }}" class="btn btn-success">@lang('labels.backend.tests.view')</a> --}}
                <a href="{{  url()->previous() }}"
                    class="btn btn-primary">&#8592</a>
            </div>
        </div>
        <div class="card-body">

{{--            <div class="row">--}}
{{--                <div class="col-12 col-lg-6 form-group">--}}
{{--                    {!! Form::label('course_id', trans('labels.backend.tests.fields.course'), ['class' => 'control-label']) !!}--}}
{{--                    {!! Form::select('course_id', $courses, old('course_id') ?? request('course_id'), ['class' => 'form-control select2']) !!}--}}
{{--                </div>--}}

{{--                <div class="col-12 col-lg-6 form-group">--}}
{{--                    {!! Form::label('chapter_id', trans('labels.backend.lessons.fields.test_chapter'), ['class' => 'control-label']) !!}--}}
{{--                    <select name="chapter_id" class="form-control select2">--}}
{{--                       Choose course first--}}
{{--                    </select>--}}
{{--                </div>--}}
{{--            </div>--}}
{{--            <div class="row">--}}
{{--                {!! Form::label('lesson_id', trans('labels.backend.tests.fields.lesson'), ['class' => 'control-label']) !!}--}}
{{--                <select name="lesson_id" class="form-control select2">--}}
{{--                    choose chapter first--}}
{{--                </select>--}}
{{--            </div>--}}
            <div class="row">

                <div class="col-12 col-lg-6  form-group">
                    {!! Form::label('title', trans('labels.backend.tests.fields.title_ar'), ['class' => 'control-label']) !!}
                    {!! Form::text('title_ar', old('title_ar'), ['class' => 'form-control', 'placeholder' => trans('labels.backend.tests.fields.title_ar')]) !!}
                </div>

                <div class="col-12 col-lg-6  form-group">
                    {!! Form::label('title', trans('labels.backend.tests.fields.title_en'), ['class' => 'control-label']) !!}
                    {!! Form::text('title', old('title'), ['class' => 'form-control', 'placeholder' => trans('labels.backend.tests.fields.title')]) !!}
                </div>
                <div class="col-12 col-lg-6  form-group">
                    {!! Form::label('questions_to_answer', trans('labels.backend.tests.fields.questions_to_answer'), ['class' => 'control-label']) !!}
                    {!! Form::number('questions_to_answer', old('questions_to_answer'), ['class' => 'form-control', 'placeholder' => trans('labels.backend.tests.fields.questions_to_answer')]) !!}
                </div>

            </div>
            <div class="row">
                <div class="col-12 form-group">
                    {!! Form::label('downloadable_files', trans('labels.backend.lessons.fields.downloadable_files').' '.trans('labels.backend.lessons.max_file_size'), ['class' => 'control-label']) !!}
                    {!! Form::file('downloadable_files[]', [
                        'multiple',
                        'class' => 'form-control file-upload',
                        'id' => 'downloadable_files',
                        'accept' => "image/jpeg,image/gif,image/png,application/msword,audio/mpeg,application/vnd.ms-excel,application/vnd.openxmlformats-officedocument.spreadsheetml.sheet,application,application/vnd.openxmlformats-officedocument.presentationml.presentation,application/vnd.ms-powerpoint,application/pdf,video/mp4"
                        ]) !!}
                    <div class="photo-block">
                        <div class="files-list"></div>
                    </div>
    
                </div>
            </div>

            <div class="questions" id="questions">
                
            </div>

            <div class="row">
                <div class="col-12 form-group">
                    <a href="javascript:void(0)" class="btn btn-success add_question">{{ trans('labels.backend.questions.fields.add_question') }}</a>
                </div>
            </div>

            <div class="row">
                <div class="col-12 form-group">
                    {!! Form::hidden('published', 0) !!}
                    {!! Form::checkbox('published', 1, false, []) !!}
                    {!! Form::label('published', trans('labels.backend.tests.fields.published'), ['class' => 'control-label font-weight-bold']) !!}

                </div>
            </div>

        </div>
    </div>

    {!! Form::submit(trans('strings.backend.general.app_save'), ['class' => 'btn btn-danger']) !!}
    {!! Form::close() !!}
@stop

@push('after-scripts')
    <script>

        $(document).ready(function () {

            count_question=0;
            $(".add_question").click(function(){
                count_question++;

                new_ques='<div class="row"  style="background:#3bcfcb;margin: 1px;padding-top: 10px;border-radius:5px;position:relative">'+
                    '<span class="delete_quest"><i class="fa fa-times"></i></span>'+
                    {{--'<div class="col-6 form-group">'+--}}
                    {{--'<label for="">{{ trans('labels.backend.questions.fields.title_ar') }}</label>'+--}}
                    {{--'<input class="form-control " placeholder="{{ trans('labels.backend.questions.fields.title_ar') }}" name="q['+count_question+'][title_ar]" type="text">'+--}}
                    {{--'</div>'+--}}
                    {{--'<div class="col-6 form-group">'+--}}
                    {{--'<label for="">{{ trans('labels.backend.questions.fields.title') }}</label>'+--}}
                    {{--'<input class="form-control " placeholder="{{ trans('labels.backend.questions.fields.title') }}" name="q['+count_question+'][title]" type="text">'+--}}
                    {{--'</div>'+--}}
                    '<div class="col-6 form-group">'+
                    '<label for="">{{ trans('labels.backend.questions.fields.question_ar') }}</label>'+
                    '<input class="form-control " required placeholder="{{ trans('labels.backend.questions.fields.question_ar') }}" name="q['+count_question+'][question_ar]" type="text">'+
                    '</div>'+
                    '<div class="col-6 form-group">'+
                    '<label for="">{{ trans('labels.backend.questions.fields.question') }}</label>'+
                    '<input class="form-control " required placeholder="{{ trans('labels.backend.questions.fields.question') }}" name="q['+count_question+'][question]" type="text">'+
                    '</div>'+
                    '<div class="col-6 form-group">'+
                    '<label for="">{{ trans('labels.backend.questions.fields.score') }}</label>'+
                    '<input class="form-control " placeholder="{{ trans('labels.backend.questions.fields.score') }}" name="q['+count_question+'][score]"  type="number" pattern="[0-9]*">'+
                    '<span style="color:red;font-size:10px">@lang('labels.backend.questions.fields.score_hint')</span>'+

                    '</div>'+
                    '<div class="col-6 form-group">'+
                    '<label for="">{{ trans('labels.backend.questions.fields.question_type') }}</label>'+
                    '<select class="form-control question_type" name="q['+count_question+'][question_type]">'+
                    '<option value="short_answer">{{ trans('labels.backend.questions.fields.short_answer') }}</option>'+
                    '<option value="paragraph">{{ trans('labels.backend.questions.fields.paragraph') }}</option>'+
                    '<option value="multiple_choice">{{ trans('labels.backend.questions.fields.multiple_choice') }}</option>'+
                    '<option value="true_false">{{ trans('labels.backend.questions.fields.true_false') }}</option>' +
                    '<option value="drop_down">{{ trans('labels.backend.questions.fields.drop_down') }}</option>'+
                    '<option value="file_upload">{{ trans('labels.backend.questions.fields.file_upload') }}</option>'+
                    '<option value="date">{{ trans('labels.backend.questions.fields.date') }}</option>'+
                    '<option value="time">{{ trans('labels.backend.questions.fields.time') }}</option>'+

                    '</select>'+
                    '</div>'+
                    '<div class="col-12 form-group form-body">'+
                    '<input type="text" class="form-control"  autocomplete="off"  style="color:#000" value="Short answer text" disabled="" >'+
                    '</div>'+
                    '<div class="col-12 form-group">'+
                    '<label for="question_image">{{ trans('labels.backend.questions.fields.question_image') }}</label>'+
                    '<input type="file" id="question_image" name="q['+count_question+'][image]" accept="image/*">'+
                    '</div>'+
                    '</div>';
                $("#questions").append(new_ques)
                    .ready(function () {

                        $(".delete_quest").click(function(){
                            // alert('remove');
                            $(this).parents('.row').remove()
                        });
                        $(".delete_option").click(function(){
                            // alert('remove');
                            $(this).parents('.row').remove()
                        });
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

                                case 'true_false':
                                    html =
                                        '<div class="row options"  style="background:#3bcfcb;margin: 1px;padding-top: 10px;border-radius:5px">' +
                                        '<div class="col-12 form-group">' +
                                        '<h6>{{ trans('labels.backend.questions.fields.options') }}</h6>' +
                                        '</div>' +
                                        '<div class="col-4 form-group">' +
                                        '<label for="">{{ trans('labels.backend.questions.fields.option_text_ar') }}</label>' +
                                        '<input class="form-control " placeholder="{{ trans('labels.backend.questions.fields.option_text_ar') }}" name="q[' +
                                        count_question + '][option_text_ar][]" type="text" value="أجل">' +
                                        '</div>' +
                                        '<div class="col-4 form-group">' +
                                        '<label for="">{{ trans('labels.backend.questions.fields.option_text') }}</label>' +
                                        '<input class="form-control " placeholder="{{ trans('labels.backend.questions.fields.option_text') }}" name="q[' +
                                        count_question + '][option_text][]" type="text" value="Yes">' +
                                        '</div>' +
                                        '<div class="col-4 form-group">' +
                                        '<label for="">{{ trans('labels.backend.questions.fields.correct') }}</label>' +
                                        '<div><input name="q[' + count_question +
                                        '][correct][0]" type="checkbox" value=1 ></div>' +
                                        '</div>' +

                                        '<div class="col-4 form-group">' +
                                        '<label for="">{{ trans('labels.backend.questions.fields.option_text_ar') }}</label>' +
                                        '<input class="form-control " placeholder="{{ trans('labels.backend.questions.fields.option_text_ar') }}" name="q[' +
                                        count_question + '][option_text_ar][]" type="text" value="لا">' +
                                        '</div>' +
                                        '<div class="col-4 form-group">' +
                                        '<label for="">{{ trans('labels.backend.questions.fields.option_text') }}</label>' +
                                        '<input class="form-control " placeholder="{{ trans('labels.backend.questions.fields.option_text') }}" name="q[' +
                                        count_question + '][option_text][]" type="text" value="No">' +
                                        '</div>' +

                                        '<div class="col-4 form-group">' +
                                        '<label for="">{{ trans('labels.backend.questions.fields.correct') }}</label>' +
                                        '<div><input name="q[' + count_question +
                                        '][correct][1]" type="checkbox"  value=1 ></div>' +
                                        '</div>' +
                                        '<div class="more_option col-12">' +
                                        '</div>' +
                                        '<div class="col-12 form-group">' +
                                        '<a href="javascript:void(0)" class="btn btn-success add_option"> + </a>' +
                                        '</div>';
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
                            count_option=1;
                            $(this).parents('.row').find('.form-body').html(html)
                                .ready(function () {
                                    $('.add_option').click(function () {
                                        count_option++;
                                        option='';
                                        option='<div class="row"  style="background:#3bcfcb;margin: 1px;padding-top: 10px;border-radius:5px">'+
                                            '<span class="col-12 delete_option"><i class="fa fa-times"></i></span>'+
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
                                            '<div><input name="q['+count_question+'][correct]['+count_option+']" type="checkbox" value=1  ></div>'+
                                            '</div>';

                                        $(this).parents('.row').find('.more_option').append(option)
                                        $(".delete_option").click(function(){
                                            // alert('remove');
                                            $(this).parents('.row')[0].remove()



                                        });
                                    });

                                });
                        });
                    });
            });


        });

    </script>
    <script>

        $(document).ready(function () {
            //on change of course get chapters of course
            $('select[name="course_id"]').on('change', function () {
                var course_id = $(this).val();
                if (course_id) {
                    $.ajax({
                        url: '{{ route('admin.courses.groups.tests2.get_chapters') }}',
                        data: {
                            course_id: course_id
                        },
                        success: function (data) {
                            $('select[name="chapter_id"]').empty();
                            $('select[name="chapter_id"]').append('<option value="">@lang('labels.backend.lessons.fields.test_chapter')</option>');
                            $.each(data, function (key, value) {
                                $('select[name="chapter_id"]').append('<option value="' + key + '">' + value + '</option>');
                            });
                        }
                    });
                } else {
                    $('select[name="chapter_id"]').empty();
                }
            });

            //on change of chapter get lessons of chapter
            $('select[name="chapter_id"]').on('change', function () {
                var chapter_id = $(this).val();
                if (chapter_id) {
                    $.ajax({
                        url: '{{ route('admin.courses.groups.tests2.get_lessons') }}',
                        data: {
                            chapter_id: chapter_id
                        },
                        success: function (data) {
                            $('select[name="lesson_id"]').empty();
                            $('select[name="lesson_id"]').append('<option value="">@lang('labels.backend.tests.fields.lesson')</option>');
                            $.each(data, function (key, value) {
                                $('select[name="lesson_id"]').append('<option value="' + key + '">' + value + '</option>');
                            });
                        }
                    });
                } else {
                    $('select[name="lesson_id"]').empty();
                }
            });
        });
    </script>
@endpush