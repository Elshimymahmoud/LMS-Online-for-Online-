@extends('backend.layouts.app')
@section('title', __('buttons.backend.access.users.addToGroup').' | '.app_name())

@section('content')
    {!! Form::open(['method' => 'POST', 'route' => ['admin.auth.user.storeUserToGroup'], 'files' => true,]) !!}

    <div class="card">
        <div class="card-header">
            <h3 class="page-title float-left mb-0">@lang('buttons.backend.access.users.addToGroup')</h3>
           
        </div>
        <div class="card-body">
            <div class="row">

                <div class="col-12 form-group">
                    {!! Form::label('name', trans('labels.backend.group.title').'*', ['class' =>
                    'control-label']) !!}
                    {!! Form::select('group_id', $groups,  old('group_id'), ['class' => 'form-control select2',
                    'id'=>'Group']) !!}


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
