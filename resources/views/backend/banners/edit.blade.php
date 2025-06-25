@extends('backend.layouts.app')
@section('title', __('labels.backend.banners.title').' | '.app_name())

@section('content')

    {!! Form::model($banner, ['method' => 'PUT', 'route' => ['admin.banners.update', $banner->id], 'files' => true,]) !!}

    <div class="card">
        <div class="card-header">
            <h3 class="page-title float-left mb-0">@lang('labels.backend.banners.edit')</h3>
            <div class="float-right">
                <a href="{{ route('admin.banners.index') }}"
                   class="btn btn-success">@lang('labels.backend.banners.view')</a>
            </div>
        </div>
        <div class="card-body">
            <div class="row">
                <div class="col-12 form-group">
                    {!! Form::label('content', trans('labels.backend.banners.fields.name').'*', ['class' => 'control-label']) !!}
                    {!! Form::text('name', old('name'), ['class' => 'form-control ', 'placeholder' =>  trans('labels.backend.banners.fields.name').'*', 'required' => '']) !!}
                    {!! Form::text('name_ar', old('name_ar'), ['class' => 'form-control ', 'placeholder' =>  trans('labels.backend.banners.fields.name_ar').'*', 'required' => '']) !!}

                </div>
                <div class="col-12 col-lg-12 form-group">
                    {!! Form::label('course_id', trans('labels.backend.lessons.fields.course'), ['class' => 'control-label']) !!}
                    {!! Form::select('course_id', $courses, old('course_id')??request()->course_id, ['class' => 'form-control select2']) !!}
                </div>
               
                <div class="col-12 form-group">
                    {!! Form::label('content', trans('labels.backend.banners.fields.content').'*', ['class' => 'control-label']) !!}
                    {!! Form::text('content', old('content'), ['class' => 'form-control ', 'placeholder' =>  trans('labels.backend.banners.fields.content').'*', 'required' => '']) !!}
                    {!! Form::text('content_ar', old('content_ar'), ['class' => 'form-control ', 'placeholder' =>  trans('labels.backend.banners.fields.content_ar').'*', 'required' => '']) !!}

                </div>
                
            </div>
        </div>

    </div>
    <div class="row">
        <div class="col-12 text-center mb-4">
            {!! Form::submit(trans('strings.backend.general.app_update'), ['class' => 'btn btn-danger']) !!}

        </div>
    </div>
    {!! Form::close() !!}
@stop

