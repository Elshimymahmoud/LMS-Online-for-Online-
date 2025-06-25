@extends('backend.layouts.app')
@section('title', __('labels.backend.guest.title').' | '.app_name())

@section('content')
    {!! Form::open(['method' => 'POST', 'route' => ['admin.guests.store'], 'files' => true,]) !!}

    <div class="card">
        <div class="card-header">
            <h3 class="page-title float-left mb-0">@lang('labels.backend.guest.create')</h3>
            <div class="float-right">
                <a href="{{ route('admin.guests.index') }}"
                   class="btn btn-success">@lang('labels.backend.guest.view')</a>
            </div>
        </div>
        <div class="card-body">
            <div class="row">
                <div class="col-12 form-group">
                    {!! Form::label('content', trans('labels.backend.guest.fields.name').'*', ['class' => 'control-label']) !!}
                    {!! Form::text('name', old('name'), ['class' => 'form-control ', 'placeholder' =>  trans('labels.backend.guest.fields.name').'*', 'required' => '']) !!}
                    {!! Form::text('name_ar', old('name_ar'), ['class' => 'form-control ', 'placeholder' =>  trans('labels.backend.guest.fields.name_ar').'*', 'required' => '']) !!}

                </div>
                <div class="col-12 col-lg-12 form-group">
                    {!! Form::label('course_id', trans('labels.backend.guest.fields.courses'), ['class' => 'control-label']) !!}
                    {!! Form::select('course_id[]', $courses, old('course_id')??request()->course_id, ['class' => 'form-control  js-example-placeholder-multiple select2','multiple' => 'multiple','required'=>true]) !!}
                </div>
               
                <div class="col-12 form-group">
                    {!! Form::label('content', trans('labels.backend.guest.fields.job').'*', ['class' => 'control-label']) !!}
                    {!! Form::text('job', old('content'), ['class' => 'form-control ', 'placeholder' =>  trans('labels.backend.guest.fields.job').'*', 'required' => '']) !!}
                    {!! Form::text('job_ar', old('content_ar'), ['class' => 'form-control ', 'placeholder' =>  trans('labels.backend.guest.fields.job_ar').'*', 'required' => '']) !!}

                </div>
                <div class="col-12 col-lg-12 form-group">
                    {!! Form::label('image',  trans('labels.backend.guest.fields.image'), ['class' => 'control-label']) !!}
                    {!! Form::file('image',  ['class' => 'form-control', 'accept' => 'image/jpeg,image/gif,image/png']) !!}
                    {!! Form::hidden('image_max_size', 8) !!}
                    {!! Form::hidden('image_max_width', 4000) !!}
                    {!! Form::hidden('image_max_height', 4000) !!}

                </div>
            </div>
        </div>
    </div>


    <div class="col-12 text-center">
        {!! Form::submit(trans('strings.backend.general.app_save'), ['class' => 'btn btn-danger mb-4 form-group']) !!}
    </div>

    {!! Form::close() !!}
@stop

@push('after-scripts')

    <script>
            $(document).ready(function() {
           
           $(".js-example-placeholder-multiple").select2({
                   placeholder: "{{trans('labels.backend.guest.fields.courses')}}",
               });
            });
    </script>
@endpush