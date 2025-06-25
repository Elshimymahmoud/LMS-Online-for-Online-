@extends('backend.layouts.app')
@section('title', __('labels.backend.activities.title') . ' | ' . app_name())

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

    {!! Form::open(['method' => 'POST', 'route' => ['admin.courses.groups.activity.store'],'files' => true]) !!}
    <div class="card">
        <div class="card-header">
            <h3 class="page-title float-left mb-0">@lang('labels.backend.activities.create')</h3>
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
                    {!! Form::label('type', trans('labels.backend.activities.fields.mark_type'), ['class' =>
                    'control-label']) !!}
                    <select name="type" class="form-control">
                        <option value="points">@lang('labels.backend.activities.fields.points')</option>
                        <option value="rates">@lang('labels.backend.activities.fields.rate')</option>
                    </select>
                </div>

            </div>
            <div class="row">
                <div class="col-12 col-lg-6 form-group">
                    {!! Form::label('description_ar', trans('labels.backend.tests.fields.description_ar'), ['class' =>
                    'control-label']) !!}
                    {!! Form::textarea('description_ar', old('description_ar'), ['class' => 'form-control',
                    'placeholder' => trans('labels.backend.tests.fields.description_ar')]) !!}
                </div>
            </div>

            <div class="row">
                <div class="col-12 col-lg-6 form-group">
                    {!! Form::label('description', trans('labels.backend.tests.fields.description'), ['class' => 'control-label']) !!}
                    {!! Form::textarea('description', old('description'), ['class' => 'form-control', 'placeholder'
                    => trans('labels.backend.tests.fields.description')]) !!}
                </div>
            </div>
            <div class="row">
                <div class="col-12 form-group">
                    {!! Form::label('activity_img', trans('labels.backend.lessons.fields.downloadable_files').' '.trans('labels.backend.lessons.max_file_size'), ['class' => 'control-label']) !!}
                    {!! Form::file('activity_img', [
                        'multiple',
                        'class' => 'form-control file-upload',
                        'id' => 'activity_img',
                        'accept' => "image/jpeg,image/gif,image/png,application/msword,audio/mpeg,application/vnd.ms-excel,application/vnd.openxmlformats-officedocument.spreadsheetml.sheet,application,application/vnd.openxmlformats-officedocument.presentationml.presentation,application/vnd.ms-powerpoint,application/pdf,video/mp4"
                        ]) !!}
                    <div class="photo-block">
                        <div class="files-list"></div>
                    </div>
    
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