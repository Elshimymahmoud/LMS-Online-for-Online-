@extends('backend.layouts.app')
@section('title', __('buttons.backend.access.users.addToCourse').' | '.app_name())

@section('content')
    {!! Form::open(['method' => 'POST', 'route' => ['admin.auth.user.storeUserToCourse'], 'files' => true,]) !!}

    <div class="card">
        <div class="card-header">
            <h3 class="page-title float-left mb-0">@lang('buttons.backend.access.users.addToCourse')</h3>
           
        </div>
        <div class="card-body">
            <div class="row">

                <div class="col-12 form-group">
                    {!! Form::label('name', trans('labels.backend.courses.fields.course').'*', ['class' => 'control-label']) !!}
                    {!! Form::select('course_id', $courses,  old('course_id'), ['class' => 'form-control select2','id'=>'Course']) !!}


                </div>
                <div class="col-lg-12 form-group">
                    {!! Form::label('course_location_label', trans('labels.backend.courses.fields.location').'*', ['class' => 'control-label']) !!}
                    <select name="course_location_id" class="form-control" required>
                    </select>
                </div>
                
                <div class="col-12 col-lg-4 form-group">

                  
                    {!! Form::hidden('user_id', $user->id) !!}
                    
                    
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
        $('select[name="course_id"]').on('change', function() {
            var stateID = $(this).val();
            var userId = "<?php echo $user->id;?>"
            // route = '{{route('admin.auth.user.addUserToCourseAjax','<?php echo $user->id;?>','stateID')}}';
            route = '{{route('admin.auth.user.addUserToCourseAjax',['user' => 'userId','course_id'=>'stateID'])}}';

            // route = '{{route('admin.courses.get_data',['cat_id' => request('cat_id')])}}';
            route=route.replace('stateID',stateID);
            route=route.replace('userId',userId)


            if(stateID) {
                $.ajax({
                    url: route,
                    type: "GET",
                    dataType: "json",
                    success:function(data) {

                        
                        $('select[name="course_location_id"]').empty();
                        $.each(data, function(key, value) {
                            $('select[name="course_location_id"]').append('<option value="'+ key +'">'+ value +'</option>');
                        });


                    },
                    error:function(){
                        
                    }
                });
            }else{
                $('select[name="city"]').empty();
            }
        });
    });
</script>
@endpush