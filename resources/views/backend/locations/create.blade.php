@extends('backend.layouts.app')
@section('title', __('labels.backend.locations.title').' | '.app_name())

@section('content')
    {!! Form::open(['method' => 'POST', 'route' => ['admin.locations.store'], 'files' => true,]) !!}

    <div class="card">
        <div class="card-header">
            <h3 class="page-title float-left mb-0">@lang('labels.backend.locations.create')</h3>
            <div class="float-right">
                <a href="{{ route('admin.locations.index') }}"
                   class="btn btn-success">@lang('labels.backend.locations.view')</a>
            </div>
        </div>
        <div class="card-body">
            <div class="row">

               
                <div class="col-12 form-group">
                    {!! Form::label('name_ar', trans('labels.backend.locations.fields.title_ar').'*', ['class' => 'control-label']) !!}
                    {!! Form::text('name_ar', old('name_ar'), ['class' => 'form-control ', 'placeholder' =>  trans('labels.backend.locations.fields.title_ar').'*', 'required' => 'true']) !!}
                </div>
                <div class="col-12 form-group">
                    {!! Form::label('name', trans('labels.backend.locations.fields.title').'*', ['class' => 'control-label']) !!}
                    {!! Form::text('name', old('name'), ['class' => 'form-control ', 'placeholder' =>  trans('labels.backend.locations.fields.title').'*']) !!}
                </div>
                <div class="col-12  form-group">
                    {!! Form::label('courses_type',trans('labels.backend.courses.fields.type').' *', ['class' => 'control-label', 'required' => 'true']) !!}
                    {!! Form::select('courses_type', $courses_types, old('courses_type'), ['class' => 'form-control select2 js-example-placeholder-single', 'multiple' => false]) !!}

                </div>
                <div class="col-12 form-group">
                    {!! Form::label('country_name_ar', trans('labels.backend.locations.fields.country_name_ar').'*', ['class' => 'control-label']) !!}
                    {!! Form::text('country_name_ar', old('country_name_ar'), ['class' => 'form-control ', 'placeholder' =>  trans('labels.backend.locations.fields.country_name_ar').'*', 'required' => 'true']) !!}
                </div>
                <div class="col-12 form-group">
                    {!! Form::label('country_name', trans('labels.backend.locations.fields.country_name').'*', ['class' => 'control-label']) !!}
                    {!! Form::text('country_name', old('country_name'), ['class' => 'form-control ', 'placeholder' =>  trans('labels.backend.locations.fields.country_name').'*', 'required' => 'true']) !!}
                </div>
                <div class="col-12 col-lg-4 form-group">

                    {!! Form::label('location_image1', trans('labels.backend.locations.fields.image'), ['class' => 'control-label','accept' => 'image/jpeg,image/gif,image/png']) !!}
                    {!! Form::file('image', ['class' => 'form-control']) !!}

                    {!! Form::hidden('location_image_max_size', 8) !!}
                    {!! Form::hidden('location_image_max_width', 4000) !!}
                    {!! Form::hidden('location_image_max_height', 4000) !!}

                </div>
            </div>
        </div>
    </div>


    <div class="col-12 text-center">
        {!! Form::submit(trans('strings.backend.general.app_save'), ['class' => 'btn btn-danger mb-4 form-group']) !!}
    </div>

    {!! Form::close() !!}
@stop

