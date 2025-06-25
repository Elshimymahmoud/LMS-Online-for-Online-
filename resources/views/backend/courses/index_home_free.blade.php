@extends('backend.layouts.app')
@section('title', __('labels.backend.banners.title').' | '.app_name())

@section('content')
    {!! Form::open(['method' => 'POST', 'route' => ['admin.home_free_course.store'], 'files' => true,]) !!}

    <div class="card">
        <div class="card-header">
            <h3 class="page-title float-left mb-0">@lang('labels.backend.banners.create')</h3>
            <div class="float-right">
                <a href="{{ route('admin.banners.index') }}"
                   class="btn btn-success">@lang('labels.backend.banners.view')</a>
            </div>
        </div>
        <div class="card-body">
            <div class="row">
            
                <div class="col-12 col-lg-12 form-group">
                    {!! Form::label('course_id', trans('labels.backend.lessons.fields.course'), ['class' => 'control-label']) !!}
                    {!! Form::select('course_id', $courses, $configCourse?(int)$configCourse->value:'', ['class' => 'form-control select2']) !!}
                </div>
               
               
               
            </div>
        </div>
    </div>


    <div class="col-12 text-center">
        {!! Form::submit(trans('strings.backend.general.app_save'), ['class' => 'btn btn-danger mb-4 form-group']) !!}
    </div>

    {!! Form::close() !!}
@stop

