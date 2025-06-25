@extends('backend.layouts.app')
@section('title', __('labels.backend.methodologies.title').' | '.app_name())

@section('content')

    {!! Form::model($methodology, ['method' => 'PUT', 'route' => ['admin.methodologies.update', $methodology->id], 'files' => true,]) !!}

    <div class="card">
        <div class="card-header">
            <h3 class="page-title float-left mb-0">@lang('labels.backend.methodologies.edit')</h3>
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
                <div class="row">
                    <div class="col-12 form-group">
                        {!! Form::label('description',trans('labels.backend.courses.fields.description'), ['class' => 'control-label']) !!}
                        {!! Form::textarea('description', old('description'), ['class' => 'form-control editor', 'placeholder' => trans('labels.backend.courses.fields.description')]) !!}
                    </div>
                </div>
                
                <div class="row">
                    <div class="col-12 form-group">
                        {!! Form::label('description_ar',trans('labels.backend.courses.fields.description_ar'), ['class' => 'control-label']) !!}
                        {!! Form::textarea('description_ar', old('description_ar'), ['class' => 'form-control editor', 'placeholder' => trans('labels.backend.courses.fields.description_ar')]) !!}
                    </div>
                </div>
                <div class="col-12 col-lg-4 form-group">

                    {!! Form::label('image', trans('labels.backend.methodologies.fields.image'), ['class' => 'control-label','accept' => 'image/jpeg,image/gif,image/png']) !!}
                    {!! Form::file('image', ['class' => 'form-control']) !!}
                    {!! Form::hidden('image_max_size', 8) !!}
                    {!! Form::hidden('image_max_width', 4000) !!}
                    {!! Form::hidden('image_max_height', 4000) !!}
                    @if ($methodology->image)
                        <a href="{{ asset('storage/uploads/'.$methodology->image) }}" target="_blank"><img
                                    height="50px" src="{{ asset('storage/uploads/'.$methodology->image) }}"
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

@push('after-scripts')
   
<script src="{{asset('plugins/bootstrap-tagsinput/bootstrap-tagsinput.js')}}"></script>


@endpush