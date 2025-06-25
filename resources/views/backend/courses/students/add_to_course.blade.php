@extends('backend.layouts.app')
@section('title', __('buttons.backend.access.users.addToCourse').' | '.app_name())
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
      <li class="breadcrumb-item">   {{session('locale')=='ar'?$course->type->name_ar:$course->type->name}} </li>
      <li class="breadcrumb-item" style="color:red">{{session('locale')=='ar'?$course->title_ar:$course->title}}</li>

      
    </ol>
  </nav>
@endif
{!! Form::open(['method' => 'POST', 'route' => ['admin.courses.storeStudentsToCourse'], 'files' => true,]) !!}

    <div class="card" style="margin-top: 2%;">
        <div class="card-header">
            <h3 class="page-title d-inline float-left mb-0">@lang('buttons.backend.access.users.addToCourse')</h3>
            <div class="float-right">
                <a href="{{ route('admin.courses.index') }}"
                class="btn btn-primary">&#8592</a>
                </div>
        </div>
        <div class="card-body">
            <div class="row">
                <div class="col-12 form-group">
                    {!! Form::label('students1',trans('labels.backend.courses.fields.students'), ['class' => 'control-label']) !!}
                    {!! Form::select('students[]', $allStudents ,old('students'), ['class' => 'form-control select2 js-example-placeholder-multiple', 'multiple' => 'multiple', 'required' => true]) !!}
                </div>
              
                <div class="col-12 form-group">
                    {!! Form::label('name', trans('labels.backend.courses.fields.course').'*', ['class' => 'control-label']) !!}
                    {!! Form::select('course_id', $courses, request('course_id')?request('course_id'): old('course_id'), ['class' => 'form-control select2','id'=>'Course']) !!}
                    @if(request('course_id'))
                    <input type="hidden" name="course_id" value="{{request('course_id')}}">
                    @endif
                </div>
               
                <div class="col-lg-12 form-group">
                    {!! Form::label('course_location_label', trans('labels.backend.courses.fields.location').'*', ['class' => 'control-label']) !!}
                    <select name="course_location_id" class="form-control" required>
                    </select>
                    @if(request('course_location_id'))
                    <input type="hidden" name="course_location_id" value="{{request('course_location_id')}}">
                    @endif
                </div>
                
                <div class="col-12 col-lg-4 form-group">

                  {{trans('labels.backend.courses.send_email')}} <input type="checkbox" name="send_email" id="">
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
<script type="text/javascript">
    $(document).ready(function() {
       
        $(".js-example-placeholder-multiple").select2({
                placeholder: "{{trans('labels.backend.courses.select_students')}}",
            });
        $('select[name="course_id"]').on('change', function() {
            var courseID = $(this).val();
            route = '{{route('admin.courses.getCourseLocAjax',['course_id'=>'courseID'])}}';
            route=route.replace('courseID',courseID);

           
           
            if(courseID) {
                $.ajax({
                    url: route,
                    type: "GET",
                    dataType: "json",
                    success:function(data) {

                        console.log(data);
                        $('select[name="course_location_id"]').empty();
                        $.each(data, function(key, value) {
                            $('select[name="course_location_id"]').append('<option value="'+ key +'">'+ value +'</option>');
                            if("{{request('course_location_id')}}")
                            $('select[name="course_location_id"]').value=request('course_location_id');
                        });


                    },
                    error:function(){
                        
                    }
                });
            }else{
                $('select[name="city"]').empty();
            }
        });

      setTimeout(() => {
        var courseID = $('select[name="course_id"]').val();
            route = '{{route('admin.courses.getCourseLocAjax',['course_id'=>'courseID'])}}';
            route=route.replace('courseID',courseID);
            $course_location_id='{{request("course_location_id")}}'
       
           
            if(courseID) {
                $.ajax({
                    url: route,
                    type: "GET",
                    dataType: "json",
                    success:function(data) {

                        
                        $('select[name="course_location_id"]').empty();
                        $.each(data, function(key, value) {
                            $('select[name="course_location_id"]').append('<option value="'+ key +'">'+ value +'</option>');
                            if($course_location_id){
                            $('select[name="course_location_id"]').val($course_location_id);
                            $('select[name="course_location_id"]').prop('disabled', true);
                            $('select[name="course_id"]').prop('disabled', true);
                            }
                        });


                    },
                    error:function(){
                        
                    }
                });
            }else{
                $('select[name="city"]').empty();
            }
      }, 0);
    });
   
</script>
@endpush