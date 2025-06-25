@extends('backend.layouts.app')
@section('title', __('labels.backend.chapters.title').' | '.app_name())

@push('after-styles')
    <link rel="stylesheet" type="text/css" href="{{asset('plugins/bootstrap-tagsinput/bootstrap-tagsinput.css')}}">
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

        .bootstrap-tagsinput {
            width: 100% !important;
            display: inline-block;
        }

        .bootstrap-tagsinput .tag {
            line-height: 1;
            margin-right: 2px;
            background-color: #2f353a;
            color: white;
            padding: 3px;
            border-radius: 3px;
        }

        label {
        font-size: 14px;
        line-height: 22px;
        padding: 5px;
        font-weight: 600;
    }

    </style>

@endpush

@section('content')

    {!! Form::open(['method' => 'POST', 'route' => ['admin.chapters.store'], 'files' => true,]) !!}
    {!! Form::hidden('model_id',0,['id'=>'chapter_id']) !!}

    <div class="card"  style="      font-family: 'Cairo', sans-serif;">
        <div class="card-header">
            <h3 class="page-title float-left mb-0">@lang('labels.backend.chapters.create')</h3>
            <div class="float-right">
                <a href="{{ route('admin.chapters.index') }}"
                   class="btn btn-success">@lang('labels.backend.chapters.view')</a>
                   <a href="{{  url()->previous() }}"
                   class="btn btn-primary">&#8592</a>
            </div>
        </div>

        <div class="card-body">

        <div class="row">
        <div class="col-12 col-lg-6 form-group">
                    {!! Form::label('title_ar', trans('labels.backend.chapters.fields.title_ar').'*', ['class' => 'control-label']) !!}
                    {!! Form::text('title_ar', old('title_ar'), ['class' => 'form-control', 'placeholder' => trans('labels.backend.chapters.fields.title_ar'), 'required' => '']) !!}

                </div>
                <div class="col-12 col-lg-6 form-group">
                    {!! Form::label('title', trans('labels.backend.chapters.fields.title').'*', ['class' => 'control-label']) !!}
                    {!! Form::text('title', old('title'), ['class' => 'form-control', 'placeholder' => trans('labels.backend.chapters.fields.title'), 'required' => '']) !!}

                </div>

            </div>
{{--            <div class="row">--}}

{{--                <div class="col-12 col-lg-6 form-group">--}}
{{--                    {!! Form::label('session_length', trans('labels.backend.chapters.fields.session_length').'*', ['class' => 'control-label']) !!}--}}
{{--                    {!! Form::text('session_length', old('session_length'), ['class' => 'form-control', 'placeholder' => trans('labels.backend.chapters.fields.session_length'), 'required' => '','pattern'=>'[0-9]*']) !!}--}}
{{--                    <span style='color:red;font-size:10px'>@lang('labels.backend.chapters.session_length')</span>--}}

{{--                </div>--}}
{{--                <div class="col-12 col-lg-6 form-group">--}}
{{--                    {!! Form::label('length_type', trans('labels.backend.chapters.fields.session_length_type').'*', ['class' => 'control-label']) !!}--}}
{{--                    {!! Form::select('length_type', Lang::locale()=='ar'?['minute'=>'دقائق','hour'=>'ساعات']:['minute'=>'Minutes','hour'=>'Hours'],old('length_type'), ['class' => 'form-control select2', 'placeholder' => trans('labels.backend.chapters.fields.session_length_type'), 'required' => '']) !!}--}}


{{--                </div>--}}
{{--            </div>--}}

            <div class="row">

                <input type="hidden" name="course_id" value="{{$course->id}}">
                <div class="col-12  text-left form-group">
                    {!! Form::submit(trans('strings.backend.general.app_save'), ['class' => 'btn  btn-danger']) !!}
                </div>
            </div>
        </div>
    </div>

    {!! Form::close() !!}



@stop

@push('after-scripts')
    <script src="{{asset('plugins/bootstrap-tagsinput/bootstrap-tagsinput.js')}}"></script>

    <script>

        var uploadField = $('input[type="file"]');

        $(document).on('change', 'input[name="chapter_image"]', function () {
            var $this = $(this);
            $(this.files).each(function (key, value) {
                if (value.size > 5000000) {
                    alert('"' + value.name + '"' + 'exceeds limit of maximum file upload size')
                    $this.val("");
                }
            })
        });

        $(document).on('change', '#media_type', function () {
            if ($(this).val()) {
                if ($(this).val() != 'upload') {
                    $('#video').removeClass('d-none').attr('required', true)
                    $('#video_file').addClass('d-none').attr('required', false)
                } else if ($(this).val() == 'upload') {
                    $('#video').addClass('d-none').attr('required', false)
                    $('#video_file').removeClass('d-none').attr('required', true)
                }
            } else {
                $('#video_file').addClass('d-none').attr('required', false)
                $('#video').addClass('d-none').attr('required', false)
            }
        })

    </script>

@endpush
