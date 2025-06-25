@extends('backend.layouts.app')
@section('title', __('labels.backend.activities.title') . ' | ' . app_name())

{{-- {{ dd($activity->questions) }} --}}
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

        .delete_option {
            position: relative;
            top: 57px;
            left: 31px;
        }
    </style>
@endpush
@section('content')

    {!! Form::model($activity, ['method' => 'PUT', 'route' => ['admin.courses.groups.activity.update', "id"=>
    $activity->id],'files' => true]) !!}
    <input type="hidden" name="form_type" value="group_test">
    <div class="card">
        <div class="card-header">
            <h3 class="page-title float-left mb-0">@lang('labels.backend.activities.edit')</h3>
            <div class="float-right">
                <a href="{{  route('admin.courses.groups.activity.index') }}" class="btn btn-success">@lang('labels.backend.activities.show_activity')
                </a>
            </div>
        </div>
        <div class="card-body">
            <div class="row">
                <div class="col-12 col-lg-6  form-group">
                    {!! Form::label('title', trans('labels.backend.tests.fields.title_ar'), ['class' => 'control-label']) !!}
                    {!! Form::text('title_ar', old('title_ar'), ['class' => 'form-control', 'placeholder' => trans('labels.backend.tests.fields.title_ar')]) !!}
                </div>

                <div class="col-12 col-lg-6  form-group">
                    {!! Form::label('title', trans('labels.backend.tests.fields.title'), ['class' => 'control-label']) !!}
                    {!! Form::text('title', old('title'), ['class' => 'form-control', 'placeholder' => trans('labels.backend.tests.fields.title')]) !!}
                </div>

            </div>
            <div class="col-12 col-lg-6  form-group">
                {!! Form::label('type', trans('labels.backend.activities.fields.mark_type'), ['class' =>
                'control-label']) !!}
                <select name="type" class="form-control">
                    <option value="points" @if($activity->type == 'points') selected @endif>@lang('labels.backend.activities.fields.points')</option>
                    <option value="rates" @if($activity->type == 'rates') selected @endif>@lang('labels.backend.activities.fields.rate')</option>
                </select>
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
                    <div class="photo-block mt-3">
                        <div class="files-list">
                            @if($activity->image)
                                <img src="{{ asset('storage/activities/'.$activity->image) }}" alt="" style="width:
                                250px; height: 250px;">
                            @endif


                            {{--                            @if(count($activity->downloadableMedia) > 0)--}}
                            {{--                                @foreach($activity->downloadableMedia as $media)--}}
                            {{--                                    <p class="form-group">--}}
                            {{--                                        <a href="{{ asset('storage/uploads/'.$media->name) }}"--}}
                            {{--                                           target="_blank">{{ $media->name }}--}}
                            {{--                                            ({{ $media->size }} KB)</a>--}}
                            {{--                                        <a href="#" data-media-id="{{$media->id}}"--}}
                            {{--                                           class="btn btn-xs btn-danger delete remove-file">@lang('labels.backend.test.remove')</a>--}}
                            {{--                                    </p>--}}
                            {{--                                @endforeach--}}
                            {{--                            @endif--}}
                        </div>
                    </div>

                </div>
            </div>


            <div class="row">
                <div class="col-12 form-group">
                    {!! Form::hidden('published', 0) !!}
                    {!! Form::checkbox('published', 1, old('published'), []) !!}
                    {!! Form::label('published', trans('labels.backend.tests.fields.published'), ['class' => 'control-label font-weight-bold']) !!}
                </div>
            </div>
        </div>
    </div>

    {!! Form::submit(trans('strings.backend.general.app_update'), ['class' => 'btn  btn-danger']) !!}
    {!! Form::close() !!}
@stop

@push('after-scripts')
    <script>

        $(document).ready(function () {
            // /// get course locations
            $('#course_id').on('change', function (e) {
                var course_id = e.target.value;
                $.ajax({
                    url: "{{ url('/user/getCourseLoc/ajax/') }}/" + course_id,
                    type: "GET",
                    dataType: "json",
                    success: function (data) {
                        $('select[name="course_location_id[]"]').empty();
                        $.each(data, function (key, value) {
                            $('select[name="course_location_id[]"]').append('<option value="' + key + '">' + value + '</option>');
                        });
                    }
                })
            });

        });
    </script>

@endpush
