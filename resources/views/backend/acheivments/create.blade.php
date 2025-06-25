@extends('backend.layouts.app')
@section('title', __('labels.backend.guest.title').' | '.app_name())

@section('content')

   
    {!! Form::open(['method' => 'POST', 'route' => ['admin.acheivment.store'], 'files' => true,]) !!}

    <div class="card">
        <div class="card-header">
            <h3 class="page-title float-left mb-0">@lang('labels.backend.acheivment.edit')</h3>
           
        </div>
        <div class="card-body">
            <div class="row">
                <div class="col-12 form-group">
                    {!! Form::label('year', trans('labels.backend.acheivment.fields.year').'*', ['class' => 'control-label']) !!}
                    {!! Form::text('year', old('year'), ['class' => 'form-control ', 'placeholder' =>  trans('labels.backend.acheivment.fields.year').'*', 'required' => '']) !!}
                  
                </div>
                <div class="col-12 form-group">
                    {!! Form::label('content', trans('labels.backend.acheivment.fields.title').'*', ['class' => 'control-label']) !!}
                    {!! Form::text('title', old('title'), ['class' => 'form-control ', 'placeholder' =>  trans('labels.backend.guest.fields.name').'*', 'required' => '']) !!}
                  <br>
                    {!! Form::label('content', trans('labels.backend.acheivment.fields.title_ar').'*', ['class' => 'control-label']) !!}
                    
                    {!! Form::text('title_ar', old('title_ar'), ['class' => 'form-control ', 'placeholder' =>  trans('labels.backend.guest.fields.name_ar').'*', 'required' => '']) !!}

                </div>
                
                    <div class="col-12 form-group">
                        {!! Form::label('full_text', trans('labels.backend.acheivment.fields.introduction'), ['class' => 'control-label']) !!}
                        
                        {!! Form::textarea('introduction', old('introduction'), ['class' => 'form-control editor', 'placeholder' => '','id' => 'editor']) !!}
                       <br>
                        {!! Form::label('full_text', trans('labels.backend.acheivment.fields.introduction_ar'), ['class' => 'control-label']) !!}
                        
                        {!! Form::textarea('introduction_ar', old('introduction_ar'), ['class' => 'form-control editor', 'placeholder' => '','id' => 'editor']) !!}
                   
                    </div>
               
             
                    <div class="col-12 form-group">
                        {!! Form::label('full_text', trans('labels.backend.acheivment.fields.content'), ['class' => 'control-label']) !!}
                        {!! Form::textarea('content', old('content'), ['class' => 'form-control editor', 'placeholder' => '','id' => 'editor']) !!}
                      
                   
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