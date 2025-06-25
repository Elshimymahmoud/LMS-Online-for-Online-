@extends('backend.layouts.app')
@section('title', __('labels.backend.home_services.title').' | '.app_name())

@section('content')

    {!! Form::model($home_service, ['method' => 'PUT', 'route' => ['admin.home_services.update', $home_service->id], 'files' => true,]) !!}

    <div class="card">
        <div class="card-header">
            <h3 class="page-title float-left mb-0">@lang('labels.backend.home_services.edit')</h3>
            <div class="float-right">
                <a href="{{ route('admin.home_services.index') }}"
                   class="btn btn-success">@lang('labels.backend.home_services.view')</a>
            </div>
        </div>
        <div class="card-body">
            <div class="row">
                <div class="col-12 form-group">
                    {!! Form::label('title', trans('labels.backend.home_services.fields.title').'*', ['class' => 'control-label']) !!}
                    {!! Form::text('title', old('title'), ['class' => 'form-control ', 'placeholder' =>  trans('labels.backend.home_services.fields.title').'*', 'required' => 'true']) !!}
                </div>
                <div class="col-12 form-group">
                    {!! Form::label('title_ar', trans('labels.backend.home_services.fields.title_ar').'*', ['class' => 'control-label']) !!}
                    {!! Form::text('title_ar', old('title_ar'), ['class' => 'form-control ', 'placeholder' =>  trans('labels.backend.home_services.fields.title_ar').'*', 'required' => 'true']) !!}
                </div>
                <div class="col-12 form-group">
                    {!! Form::label('link', trans('labels.backend.home_services.fields.link').'*', ['class' => 'control-label']) !!}
                    {!! Form::text('link', old('link'), ['class' => 'form-control ', 'placeholder' =>  trans('labels.backend.home_services.fields.link').'*', 'required' => 'true']) !!}

                </div>
                <div class="col-12 form-group">
                    {{ html()->label(__('labels.teacher.description'))->class('col-md-12 form-control-label')->for('description') }}

                    <div class="col-md-12">
                        {{ html()->textarea('description')
                                    ->value(@$home_service->description)
                                        ->class('form-control editor')
                                        ->placeholder(__('labels.teacher.description')) }}
                    </div><!--col-->
                </div>
                <div class="col-12 form-group">
                    {{ html()->label(__('labels.teacher.description_ar'))->class('col-md-12 form-control-label')->for('description_ar') }}

                    <div class="col-md-12">
                        {{ html()->textarea('description_ar')
                                        ->class('form-control editor_ar')
                                    ->value(@$home_service->description_ar)

                                        ->placeholder(__('labels.teacher.description_ar')) }}
                    </div><!--col-->
                </div>
                <div class="col-12 col-lg-4 form-group">

                    {!! Form::label('home_service_image', trans('labels.backend.home_services.fields.image'), ['class' => 'control-label','accept' => 'image/jpeg,image/gif,image/png']) !!}
                    {!! Form::file('home_service_image', ['class' => 'form-control']) !!}
                    {!! Form::hidden('home_service_image_max_size', 8) !!}
                    {!! Form::hidden('home_service_image_max_width', 4000) !!}
                    {!! Form::hidden('home_service_image_max_height', 4000) !!}
                    @if ($home_service->home_service_image)
                        <a href="{{ asset('storage/uploads/'.$home_service->home_service_image) }}" target="_blank"><img
                                    height="50px" src="{{ asset('storage/uploads/'.$home_service->home_service_image) }}"
                                    class="mt-1"></a>
                    @endif
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

