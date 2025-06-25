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

    </style>

@endpush
@section('content')
    {!! Form::model($chapter, ['method' => 'POST', 'route' => ['admin.chapters.storeCopy'], 'files' => true,]) !!}
    <input type="hidden" value="{{$chapter->id}}" name="copied_chapter_id">
    <div class="card">
        <div class="card-header">
            <h3 class="page-title float-left mb-0">@lang('labels.backend.chapters.edit')</h3>
            <div class="float-right" style="margin-right: 10px">
            <a href="{{  url()->previous() }}"
                    class="btn btn-primary">&#8592</a>
                    </div>
            <div class="float-right">
                <a href="{{ route('admin.chapters.index') }}"
                   class="btn btn-success">@lang('labels.backend.chapters.view')</a>
            </div>
        </div>
        <div class="card-body">
            <div class="row">
                <div class="col-12 col-lg-6 form-group">
                    {!! Form::label('course_id', trans('labels.backend.chapters.fields.course'), ['class' => 'control-label']) !!}
                    {!! Form::select('course_id', $courses, old('course_id'), ['class' => 'form-control select2']) !!}
                </div>
                <div class="col-12 col-lg-3 form-group">
                    {!! Form::label('session_length', trans('labels.backend.chapters.fields.session_length').'*', ['class' => 'control-label']) !!}
                    {!! Form::text('session_length', old('session_length'), ['class' => 'form-control', 'placeholder' => trans('labels.backend.chapters.fields.session_length'), 'required' => '','pattern'=>'[0-9]*']) !!}
                 <span style='color:red;font-size:8px'>@lang('labels.backend.chapters.session_length')</span>
                </div>
                <div class="col-12 col-lg-3 form-group">
                    {!! Form::label('length_type', trans('labels.backend.chapters.fields.session_length_type').'*', ['class' => 'control-label']) !!}
                    {!! Form::select('length_type', Lang::locale()=='ar'?['minute'=>'دقائق','hour'=>'ساعات']:['minute'=>'Minutes','hour'=>'Hours'],old('length_type'), ['class' => 'form-control select2', 'placeholder' => trans('labels.backend.chapters.fields.session_length_type'), 'required' => '']) !!}
                   
               
                </div>
            </div>
 
            <div class="row">
                <div class="col-12 col-lg-6 form-group">
                    {!! Form::label('title', trans('labels.backend.chapters.fields.title').'*', ['class' => 'control-label']) !!}
                    {!! Form::text('title', old('title'), ['class' => 'form-control', 'placeholder' => trans('labels.backend.chapters.fields.title'), 'required' => '']) !!}

                </div>
                <div class="col-12 col-lg-6 form-group">
                    {!! Form::label('title_ar', trans('labels.backend.chapters.fields.title_ar').'*', ['class' => 'control-label']) !!}
                    {!! Form::text('title_ar', old('title_ar'), ['class' => 'form-control', 'placeholder' => trans('labels.backend.chapters.fields.title_ar'), 'required' => '']) !!}

                </div>
            </div>
            
  
 
            <div class="row">
   
                <div class="col-12  text-left form-group">
                    {!! Form::submit(trans('strings.backend.general.app_update'), ['class' => 'btn  btn-primary']) !!}
                </div>
            </div>
        </div>
    </div>
    {!! Form::close() !!}
@stop

@push('after-scripts')
    <script src="{{asset('plugins/bootstrap-tagsinput/bootstrap-tagsinput.js')}}"></script>

    <script>
       
        $(document).ready(function () {
            $(document).on('click', '.delete', function (e) {
                e.preventDefault();
                var parent = $(this).parent('.form-group');
                var confirmation = confirm('{{trans('strings.backend.general.are_you_sure')}}')
                if (confirmation) {
                    var media_id = $(this).data('media-id');
                    $.post('{{route('admin.media.destroy')}}', {media_id: media_id, _token: '{{csrf_token()}}'},
                        function (data, status) {
                            if (data.success) {
                                parent.remove();
                            } else {
                                alert('Something Went Wrong')
                            }
                        });
                }
            })
        });



    </script>
@endpush
