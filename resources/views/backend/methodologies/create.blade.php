@extends('backend.layouts.app')
@section('title', __('labels.backend.methodologies.title').' | '.app_name())

@section('content')
    {!! Form::open(['method' => 'POST', 'route' => ['admin.methodologies.store'], 'files' => true,]) !!}

    <div class="card">
        <div class="card-header">
            <h3 class="page-title float-left mb-0">@lang('labels.backend.methodologies.create')</h3>
            <div class="float-right">
                <a href="{{ route('admin.methodologies.index') }}"
                   class="btn btn-success">@lang('labels.backend.methodologies.view')</a>
            </div>
        </div>
        <div class="card-body">
            <div class="row">
                <div class="col-12 form-group">
                    {!! Form::label('title', trans('labels.backend.methodologies.fields.title').'*', ['class' => 'control-label']) !!}
                    {!! Form::text('title', old('title'), ['class' => 'form-control ', 'placeholder' =>  trans('labels.backend.methodologies.fields.title').'*', 'required' => 'true']) !!}
                </div>
                <div class="col-12 form-group">
                    {!! Form::label('title_ar', trans('labels.backend.methodologies.fields.title_ar').'*', ['class' => 'control-label']) !!}
                    {!! Form::text('title_ar', old('title_ar'), ['class' => 'form-control ', 'placeholder' =>  trans('labels.backend.methodologies.fields.title_ar').'*', 'required' => 'true']) !!}
                </div>
                <div class="col-12 form-group">
                    {!! Form::label('link', trans('labels.backend.methodologies.fields.link').'*', ['class' => 'control-label']) !!}
                    {!! Form::text('link', old('link'), ['class' => 'form-control ', 'placeholder' =>  trans('labels.backend.methodologies.fields.link').'*', 'required' => 'true']) !!}

                </div>
                <div class="col-12 col-lg-4 form-group">

                    {!! Form::label('methodology_image', trans('labels.backend.methodologies.fields.image'), ['class' => 'control-label','accept' => 'image/jpeg,image/gif,image/png']) !!}
                    {!! Form::file('methodology_image', ['class' => 'form-control']) !!}
                    {!! Form::hidden('methodology_image_max_size', 8) !!}
                    {!! Form::hidden('methodology_image_max_width', 4000) !!}
                    {!! Form::hidden('methodology_image_max_height', 4000) !!}
                    
                </div>
            </div>
        </div>
    </div>


    <div class="col-12 text-center">
        {!! Form::submit(trans('strings.backend.general.app_save'), ['class' => 'btn btn-danger mb-4 form-group']) !!}
    </div>

    {!! Form::close() !!}
@stop

