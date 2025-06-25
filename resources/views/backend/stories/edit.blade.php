@extends('backend.layouts.app')
@section('title', __('labels.backend.stories.title').' | '.app_name())

@section('content')

    {!! Form::model($story, ['method' => 'PUT', 'route' => ['admin.stories.update', $story->id], 'files' => true,]) !!}

    <div class="card">
        <div class="card-header">
            <h3 class="page-title float-left mb-0">@lang('labels.backend.stories.edit')</h3>
            <div class="float-right">
                <a href="{{ route('admin.stories.index') }}"
                   class="btn btn-success">@lang('labels.backend.stories.view')</a>
            </div>
        </div>
        <div class="card-body">
            <div class="row">
                <div class="col-12 form-group">
                    {!! Form::label('title', trans('labels.backend.stories.fields.title').'*', ['class' => 'control-label']) !!}
                    {!! Form::text('title', old('title'), ['class' => 'form-control ', 'placeholder' =>  trans('labels.backend.stories.fields.title').'*', 'required' => 'true']) !!}
                </div>
                <div class="col-12 form-group">
                    {!! Form::label('title_ar', trans('labels.backend.stories.fields.title_ar').'*', ['class' => 'control-label']) !!}
                    {!! Form::text('title_ar', old('title_ar'), ['class' => 'form-control ', 'placeholder' =>  trans('labels.backend.stories.fields.title_ar').'*', 'required' => 'true']) !!}
                </div>
                <div class="col-12 col-lg-12 ">
                    <div class=" form-group">
                    {!! Form::label('description',trans('labels.backend.stories.fields.description').'*', ['class' => 'control-label']) !!}
                    {!! Form::textarea('description', old('description'), ['class' => 'form-control', 'placeholder' => trans('labels.backend.stories.fields.description')]) !!}
                    </div>
                </div>
            
                <div class="col-12 col-lg-12">
                    <div class=" form-group">
                    {!! Form::label('description_ar',trans('labels.backend.stories.fields.description_ar').'*', ['class' => 'control-label']) !!}
                    {!! Form::textarea('description_ar', old('description_ar'), ['class' => 'form-control', 'placeholder' => trans('labels.backend.stories.fields.description_ar')]) !!}
                    </div>
                </div>
                
                <div class="col-6 form-group">
                    {!! Form::label('course1', trans('labels.backend.stories.fields.course1').'*', ['class' => 'control-label']) !!}
                    {!! Form::text('course1', old('course1'), ['class' => 'form-control ', 'placeholder' =>  trans('labels.backend.stories.fields.course1').'*', 'required' => 'true']) !!}
                </div>
                <div class="col-6 form-group">
                    {!! Form::label('course1_ar', trans('labels.backend.stories.fields.course1_ar').'*', ['class' => 'control-label']) !!}
                    {!! Form::text('course1_ar', old('course1_ar'), ['class' => 'form-control ', 'placeholder' =>  trans('labels.backend.stories.fields.course1_ar').'*', 'required' => 'true']) !!}
                </div>

                <div class="col-12 col-lg-4 form-group">
                    {!! Form::label('date1', trans('labels.backend.stories.fields.date1').' (yyyy-mm-dd)'.'*', ['class' => 'control-label']) !!}
                    {!! Form::text('date1', old('date1'), ['class' => 'form-control date', 'pattern' => '(?:19|20)[0-9]{2}-(?:(?:0[1-9]|1[0-2])-(?:0[1-9]|1[0-9]|2[0-9])|(?:(?!02)(?:0[1-9]|1[0-2])-(?:30))|(?:(?:0[13578]|1[02])-31))', 'placeholder' => trans('labels.backend.stories.fields.date1').' (Ex . 2019-01-01)']) !!}
                    <p class="help-block"></p>
                    @if($errors->has('date1'))
                        <p class="help-block">
                            {{ $errors->first('date1') }}
                        </p>
                    @endif
                </div>
                <div class="col-4 form-group">
                    {!! Form::label('students1', trans('labels.backend.stories.fields.students1').'*', ['class' => 'control-label']) !!}
                    {!! Form::text('students1', old('students1'), ['class' => 'form-control ', 'placeholder' =>  trans('labels.backend.stories.fields.students1').'*', 'required' => 'true']) !!}
                </div>
                <div class="col-4 form-group">
                    {!! Form::label('training_days1', trans('labels.backend.stories.fields.training_days1').'*', ['class' => 'control-label']) !!}
                    {!! Form::text('training_days1', old('training_days1'), ['class' => 'form-control ', 'placeholder' =>  trans('labels.backend.stories.fields.training_days1').'*', 'required' => 'true']) !!}
                </div>
                <div class="col-6 form-group">
                    {!! Form::label('course2', trans('labels.backend.stories.fields.course2').'*', ['class' => 'control-label']) !!}
                    {!! Form::text('course2', old('course2'), ['class' => 'form-control ', 'placeholder' =>  trans('labels.backend.stories.fields.course2').'*', 'required' => 'true']) !!}
                </div>
                <div class="col-6 form-group">
                    {!! Form::label('course2_ar', trans('labels.backend.stories.fields.course2_ar').'*', ['class' => 'control-label']) !!}
                    {!! Form::text('course2_ar', old('course2_ar'), ['class' => 'form-control ', 'placeholder' =>  trans('labels.backend.stories.fields.course2_ar').'*', 'required' => 'true']) !!}
                </div>
                <div class="col-12 col-lg-4 form-group">
                    {!! Form::label('date2', trans('labels.backend.stories.fields.date2').' (yyyy-mm-dd)'.'*', ['class' => 'control-label']) !!}
                    {!! Form::text('date2', old('date2'), ['class' => 'form-control date', 'pattern' => '(?:19|20)[0-9]{2}-(?:(?:0[1-9]|1[0-2])-(?:0[1-9]|1[0-9]|2[0-9])|(?:(?!02)(?:0[1-9]|1[0-2])-(?:30))|(?:(?:0[13578]|1[02])-31))', 'placeholder' => trans('labels.backend.stories.fields.date2').' (Ex . 2019-01-01)']) !!}
                    <p class="help-block"></p>
                    @if($errors->has('date2'))
                        <p class="help-block">
                            {{ $errors->first('date2') }}
                        </p>
                    @endif
                </div>
                <div class="col-4 form-group">
                    {!! Form::label('students2', trans('labels.backend.stories.fields.students2').'*', ['class' => 'control-label']) !!}
                    {!! Form::text('students2', old('students2'), ['class' => 'form-control ', 'placeholder' =>  trans('labels.backend.stories.fields.students2').'*', 'required' => 'true']) !!}
                </div>
                <div class="col-4 form-group">
                    {!! Form::label('training_days2', trans('labels.backend.stories.fields.training_days2').'*', ['class' => 'control-label']) !!}
                    {!! Form::text('training_days2', old('training_days2'), ['class' => 'form-control ', 'placeholder' =>  trans('labels.backend.stories.fields.training_days2').'*', 'required' => 'true']) !!}
                </div>
                <div class="col-12 col-lg-6 form-group">

                    {!! Form::label('image', trans('labels.backend.stories.fields.image').'*', ['class' => 'control-label','accept' => 'image/jpeg,image/gif,image/png']) !!}
                    {!! Form::file('image', ['class' => 'form-control']) !!}
                    {!! Form::hidden('image_max_size', 8) !!}
                    {!! Form::hidden('image_max_width', 4000) !!}
                    {!! Form::hidden('image_max_height', 4000) !!}
                    @if ($story->image)
                        <a href="{{ asset('storage/uploads/'.$story->image) }}" target="_blank"><img
                                    height="50px" src="{{ asset('storage/uploads/'.$story->image) }}"
                                    class="mt-1"></a>
                    @endif
                </div>
                <div class="col-12 col-lg-6 form-group">

                    {!! Form::label('logo', trans('labels.backend.stories.fields.logo').'*', ['class' => 'control-label','accept' => 'image/jpeg,image/gif,image/png']) !!}
                    {!! Form::file('logo', ['class' => 'form-control']) !!}
                    {!! Form::hidden('logo_max_size', 8) !!}
                    {!! Form::hidden('logo_max_width', 4000) !!}
                    {!! Form::hidden('logo_max_height', 4000) !!}
                    @if ($story->logo)
                        <a href="{{ asset('storage/uploads/'.$story->logo) }}" target="_blank"><img
                                    height="50px" src="{{ asset('storage/uploads/'.$story->logo) }}"
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

<script>

    $(document).ready(function () {
        $('#date1').datepicker({
                autoclose: true,
                dateFormat: "{{ config('app.date_format_js') }}"
            });

            $('#date2').datepicker({
                autoclose: true,
                dateFormat: "{{ config('app.date_format_js') }}"
            });

            
        });

</script>

@endpush