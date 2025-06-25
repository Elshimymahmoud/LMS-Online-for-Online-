@extends('backend.layouts.app')
@section('title', __('labels.backend.guest.title').' | '.app_name())

@section('content')

    {!! Form::model($guest, ['method' => 'PUT', 'route' => ['admin.guests.update', $guest->id], 'files' => true,]) !!}

    <div class="card">
        <div class="card-header">
            <h3 class="page-title float-left mb-0">@lang('labels.backend.guest.edit')</h3>
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
                    {!! Form::label('course_id', trans('labels.backend.lessons.fields.course'), ['class' => 'control-label']) !!}
                    {!! Form::select('course_id[]', $courses,$guest->courses, ['class' => 'form-control js-example-placeholder-multiple select2','multiple' => 'multiple','required'=>true]) !!}
                </div>
               
                <div class="col-12 form-group">
                    {!! Form::label('job', trans('labels.backend.guest.fields.job').'*', ['class' => 'control-label']) !!}
                    {!! Form::text('job', old('job'), ['class' => 'form-control ', 'placeholder' =>  trans('labels.backend.guest.fields.job').'*', 'required' => '']) !!}
                    {!! Form::text('job_ar', old('job_ar'), ['class' => 'form-control ', 'placeholder' =>  trans('labels.backend.guest.fields.job_ar').'*', 'required' => '']) !!}

                </div>

                <div class="col-12 col-lg-12 form-group">
                    {!! Form::label('image',  trans('labels.backend.guest.fields.image'), ['class' => 'control-label']) !!}
                    {!! Form::file('image',  ['class' => 'form-control', 'accept' => 'image/jpeg,image/gif,image/png']) !!}
                    {!! Form::hidden('image_max_size', 8) !!}
                    {!! Form::hidden('image_max_width', 4000) !!}
                    {!! Form::hidden('image_max_height', 4000) !!}
                    <img style="width: 50px;
                    height: 50px;" src="{{asset('storage/uploads/')}}/{{$guest->image}}">
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

@push('after-scripts')

    
@endpush