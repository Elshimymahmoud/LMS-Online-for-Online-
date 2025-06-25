@extends('backend.layouts.app')
@section('title', __('labels.backend.courses.fields.classification').' | '.app_name())

@section('content')
    {!! Form::open(['method' => 'POST', 'route' => ['admin.course_classification.store'], 'files' => true,]) !!}

    <div class="card">
        <div class="card-header">
            <h3 class="page-title float-left mb-0">@lang('labels.backend.courseTypes.creatclassification')</h3>
            <div class="float-right">
                <a href="{{ route('admin.course_classification.index') }}"
                   class="btn btn-success">@lang('labels.backend.courseTypes.viewclassification')</a>
            </div>
        </div>
        <div class="card-body">
            <div class="row">
                <div class="col-12 form-group">
                {!! Form::label('content', trans('labels.backend.guest.fields.name_ar').'*', ['class' => 'control-label']) !!}
                   
                   {!! Form::text('name_ar', old('name_ar'), ['class' => 'form-control ', 'placeholder' =>  trans('labels.backend.guest.fields.name_ar').'*', 'required' => '']) !!}
<br>
                    {!! Form::label('content', trans('labels.backend.guest.fields.name').'*', ['class' => 'control-label']) !!}
                    {!! Form::text('name', old('name'), ['class' => 'form-control ', 'placeholder' =>  trans('labels.backend.guest.fields.name').'*', 'required' => '']) !!}    
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