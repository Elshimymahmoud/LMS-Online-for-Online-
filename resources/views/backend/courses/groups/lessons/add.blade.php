@extends('backend.layouts.app')
@section('title', __('labels.backend.lessons.edit').' | '.app_name())
@push('after-styles')
    <link rel="stylesheet" type="text/css" href="{{asset('plugins/amigo-sorter/css/theme-default.css')}}">
    <style>
.headerr{
            top: 15%;
            /* width:80%;  */
            height:100px;
            background:white;
            /* position:fixed; */
            text-align: center;
            -webkit-box-shadow: 0 3px 5px rgba(57, 63, 72, 0.3);
                -moz-box-shadow: 0 3px 5px rgba(57, 63, 72, 0.3);
                box-shadow: 0 3px 5px rgba(57, 63, 72, 0.3);
                border: 1px solid #d7cece;
                padding: 20px;
                color: darkslategray;
                font-size: x-large;
                border-radius: 7px;
}

    </style>
@endpush
@section('content')
@if(@$currentCourseLocation)
<nav aria-label="breadcrumb" class="headerr ">
    <ol class="breadcrumb">
        <li class="breadcrumb-item"><a href="{{ route('admin.groups.index') }}"><i class="fa fa-home" ></i></a></li>
        <li class="breadcrumb-item">   {{session('locale')=='ar'?$course->type->name_ar:$course->type->name}} </li>
        <li class="breadcrumb-item">{{session('locale')=='ar'?$course->title_ar:$course->title}}</li>
        <li class="breadcrumb-item" style="color:red">{{session('locale')=='ar'?$group->title_ar:$group->title}}</li>
    </ol>
  </nav>
@endif
{!! Form::model($lesson, ['method' => 'POST', 'route' => ['admin.groups.lessons.attach']]) !!}

    <div class="card" style="margin-top: 2%;">
        <div class="card-header">
            <h3 class="page-title d-inline float-left mb-0">@lang('buttons.backend.lessons.edit')</h3>
            <div class="float-right">
                <a href="{{ route('admin.groups.lessons', ['group'=>$group->id]) }}"
                class="btn btn-primary">&#8592</a>
                </div>
        </div>

        <div class="card-body">
            <div class="row">
                @if($group->courses->type_id != 1)
                    <div class="col-12 form-group">
                        {!! Form::label('date',trans('labels.backend.lessons.fields.date'), ['class' =>
                        'control-label']) !!}
                        {!! Form::date('date', old('date'), ['class' => 'form-control', 'required' => true]) !!}
                    </div>
                    <div class="col-12 form-group">
                        {!! Form::label('start_time', trans('labels.backend.lessons.fields.from_time'), ['class' => 'control-label']) !!}
                        {!! Form::time('start_time', old('start_time'), ['class' => 'form-control', 'required' => true]) !!}

                    </div>
                    <div class="col-12 form-group">
                        {!! Form::label('end_time', trans('labels.backend.lessons.fields.to_time'), ['class' =>'control-label']) !!}
                        {!! Form::time('end_time', old('end_time'), ['class' => 'form-control', 'required' => true]) !!}
                    </div>
                @endif
                    <div class="col-12 form-group">
                        {!! Form::label('status', trans('labels.backend.lessons.fields.status'), ['class' => 'control-label']) !!}
                        <select name="status" class="form-control" required>
                            <option value="1" selected> {{ __('labels.backend.lessons.fields.published') }}</option>
                            <option value="0"> {{ __('labels.backend.courses.fields.not_published') }}</option>
                        </select>
                    </div>



                <input type="hidden" value="{{ $group->id }}" name="group_id">
                <input type="hidden" value="{{ $lesson->id }}" name="lesson_id">
            </div>
        </div>
    </div>


    <div class="col-12 text-center">
        {!! Form::submit(trans('strings.backend.general.app_save'), ['class' => 'btn btn-danger mb-4 form-group']) !!}
    </div>

    {!! Form::close() !!}
@stop

@push('after-scripts')
<script type="text/javascript">

   
</script>
@endpush