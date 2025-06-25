@extends('backend.layouts.app')
@section('title', __('buttons.backend.access.users.addToGroup').' | '.app_name())
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
        <li class="breadcrumb-item"><a href="{{ route('admin.courses.index') }}"><i class="fa fa-home" ></i></a></li>
        <li class="breadcrumb-item" style="color:red">{{session('locale')=='ar'?$group->title_ar:$group->title}}</li>
        <li class="breadcrumb-item">{{$group->start->format('Y-m-d') ?? ""}}</li>
        <li class="breadcrumb-item active">{{session('locale')=='ar'?$location->name_ar:$location->name}}</li>

    </ol>
  </nav>
@endif
{!! Form::open(['method' => 'POST', 'route' => ['admin.groups.addStudents'], 'files' => true,]) !!}

    <div class="card" style="margin-top: 2%;">
        <div class="card-header">
            <h3 class="page-title d-inline float-left mb-0">@lang('buttons.backend.access.users.addToGroup')</h3>
            <div class="float-right">
                <a href="{{ url()->previous() }}"
                class="btn btn-primary">&#8592</a>
                </div>
        </div>
        <div class="card-body">
            <div class="row">
                <div class="col-12 form-group">
                    {!! Form::label('students1',trans('labels.backend.courses.fields.students'), ['class' => 'control-label']) !!}
                    {!! Form::select('students[]', $students ,old('students'), ['class' => 'form-control select2 js-example-placeholder-multiple', 'multiple' => 'multiple', 'required' => true]) !!}
                </div>

                @if(Route::currentRouteName() == 'admin.group.students.all.add')
                    <div class="col-12 form-group">
                        {!! Form::label('groups', trans('labels.backend.courses.fields.course-group-head'), ['class' => 'control-label']) !!}
                        {!! Form::select('groups[]', $groups ,old('groups'), ['class' => 'form-control select2', 'required' => true]) !!}
                    </div>
                @endif

                <div class="col-12 col-lg-4 form-group">
                  {{trans('labels.backend.courses.send_email')}} <input type="checkbox" name="send_email" id="">
                </div>
                <input type="hidden" value="{{ $group->id }}" name="group_id">
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
    $(document).ready(function() {
       
        $(".js-example-placeholder-multiple").select2({
                placeholder: "{{trans('labels.backend.courses.select_students')}}",
            });


    });
   
</script>
@endpush