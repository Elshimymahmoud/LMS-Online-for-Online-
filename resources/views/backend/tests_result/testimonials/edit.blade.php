@extends('backend.layouts.app')
@section('title', __('labels.backend.testimonials.title').' | '.app_name())

@section('content')

    {!! Form::model($testimonial, ['method' => 'PUT', 'route' => ['admin.testimonials.update', $testimonial->id], 'files' => true,]) !!}

    <div class="card">
        <div class="card-header">
            <h3 class="page-title float-left mb-0">@lang('labels.backend.testimonials.edit')</h3>
            <div class="float-right">
                <a href="{{ route('admin.testimonials.index') }}"
                   class="btn btn-success">@lang('labels.backend.testimonials.view')</a>
            </div>
        </div>
        <div class="card-body">
            <div class="row">
                <div class="col-12 form-group">
                    {!! Form::label('content', trans('labels.backend.testimonials.fields.name').'*', ['class' => 'control-label']) !!}
                    {!! Form::text('name', old('name'), ['class' => 'form-control ', 'placeholder' =>  trans('labels.backend.testimonials.fields.name').'*', 'required' => '']) !!}
                    {!! Form::text('name_ar', old('name_ar'), ['class' => 'form-control ', 'placeholder' =>  trans('labels.backend.testimonials.fields.name_ar').'*', 'required' => '']) !!}

                </div>
                <div class="col-12 col-lg-12 form-group">
                    {!! Form::label('course_id', trans('labels.backend.lessons.fields.course'), ['class' => 'control-label']) !!}
                    {!! Form::select('course_id', $courses, old('course_id')??request()->course_id, ['class' => 'form-control select2']) !!}
                </div>
                <div class="col-12 form-group">
                    {!! Form::label('occupation', trans('labels.backend.testimonials.fields.occupation').'*', ['class' => 'control-label']) !!}
                    {!! Form::text('occupation', old('occupation'), ['class' => 'form-control ', 'placeholder' =>  trans('labels.backend.testimonials.fields.occupation').'*', 'required' => '']) !!}
                    {!! Form::text('occupation_ar', old('occupation_ar'), ['class' => 'form-control ', 'placeholder' =>  trans('labels.backend.testimonials.fields.occupation_ar').'*', 'required' => '']) !!}

                </div>
                <div class="col-12 form-group">
                    {!! Form::label('content', trans('labels.backend.testimonials.fields.content').'*', ['class' => 'control-label']) !!}
                    {!! Form::textarea('content', old('content'), ['class' => 'form-control ', 'placeholder' =>  trans('labels.backend.testimonials.fields.content').'*', 'required' => '']) !!}
                    {!! Form::textarea('content_ar', old('content_ar'), ['class' => 'form-control ', 'placeholder' =>  trans('labels.backend.testimonials.fields.content_ar').'*', 'required' => '']) !!}

                </div>
                <div class="col-12 col-lg-12 form-group">

                    {!! Form::label('image', trans('labels.backend.testimonials.fields.image').'*', ['class' => 'control-label','accept' => 'image/jpeg,image/gif,image/png']) !!}
                    {!! Form::file('image', ['class' => 'form-control']) !!}
                    {!! Form::hidden('image_max_size', 8) !!}
                    {!! Form::hidden('image_max_width', 4000) !!}
                    {!! Form::hidden('image_max_height', 4000) !!}
                    @if ($testimonial->image)
                        <a href="{{ asset('storage/uploads/'.$testimonial->image) }}" target="_blank"><img
                                    height="50px" src="{{ asset('storage/uploads/'.$testimonial->image) }}"
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

