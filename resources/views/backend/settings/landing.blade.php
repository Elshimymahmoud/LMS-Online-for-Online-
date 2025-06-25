@extends('backend.layouts.app')
@section('title', __('labels.backend.social_settings.management').' | '.app_name())

@section('content')
    {{ html()->form('POST', route('admin.landing-settings'))->class('form-horizontal')->open() }}
    <div class="card">
        <div class="card-body">
            <div class="row">
                <div class="col-sm-5">
                    <h4 class="card-title mb-0">
                        {{ __('labels.backend.landing.landing_colors') }}
                    </h4>
                </div><!--col-->
            </div><!--row-->

            <hr/>

            <div class="row mt-4 mb-4">
                <div class="col">
                    
                                

                    
                <div class="row">
                   
                   <div class="col-6 form-group">
                       {!! Form::label('body_color', trans('labels.backend.landing.body_color'), ['class' => 'control-label']) !!}
                       
                  <input class="form-control" placeholder="" required="true" style="width:50%" name="body_color" type="color" id="body_color" value="{{$Landing_color->body_color}}">
                  
                   </div>
                   <div class="col-6 form-group">
                       {!! Form::label('heading_color', trans('labels.backend.landing.heading_color'), ['class' => 'control-label']) !!}
                       <input class="form-control" placeholder="" required="true" style="width:50%" name="heading_color" type="color" id="heading_color"value="{{$Landing_color->heading_color}}">
                       
                  
                   </div>
                   <div class="col-6 form-group">
                       {!! Form::label('paragraph_color', trans('labels.backend.landing.paragraph_color'), ['class' => 'control-label']) !!}
                       <input class="form-control" placeholder="" required="true" style="width:50%" name="paragraph_color" type="color" id="paragraph_color" value="{{$Landing_color->paragraph_color}}">
                  
                   </div>
                   <div class="col-6 form-group">
                       {!! Form::label('icon_color', trans('labels.backend.landing.icon_color'), ['class' => 'control-label']) !!}
                       <input class="form-control" placeholder="" required="true" style="width:50%" name="icon_color" type="color" id="icon_color"value="{{$Landing_color->icon_color}}">
                       
                  
                   </div>
                   <div class="col-6 form-group">
                       {!! Form::label('about_color', trans('labels.backend.landing.about_color'), ['class' => 'control-label']) !!}
                       <input class="form-control" placeholder="" required="true" style="width:50%" name="about_color" type="color" id="about_color"value="{{$Landing_color->about_color}}">
                       
                  
                   </div>
                   <div class="col-6 form-group">
                       {!! Form::label('courses_color', trans('labels.backend.landing.courses_color'), ['class' => 'control-label']) !!}
                  
                       <input class="form-control" placeholder="" required="true" style="width:50%" name="courses_color" type="color" id="courses_color"value="{{$Landing_color->courses_color}}">
                  
                   </div>
                   <div class="col-6 form-group">
                       {!! Form::label('speaker_color', trans('labels.backend.landing.speaker_color'), ['class' => 'control-label']) !!}
                       <input class="form-control" placeholder="" required="true" style="width:50%" name="speaker_color" type="color" id="speaker_color"value="{{$Landing_color->speaker_color}}">
                       
                  
                   </div>
                   <div class="col-6 form-group">
                       {!! Form::label('blog_color',trans('labels.backend.landing.blog_color'), ['class' => 'control-label']) !!}
                       <input class="form-control" placeholder="" required="true" style="width:50%" name="blog_color" type="color" id="blog_color"value="{{$Landing_color->blog_color}}">
                        
                  
                   </div>
                   <div class="col-6 form-group">
                       {!! Form::label('sponser_color', trans('labels.backend.landing.sponser_color'), ['class' => 'control-label']) !!}
                  
                       <input class="form-control" placeholder="" required="true" style="width:50%" name="sponser_color" type="color" id="sponser_color"value="{{$Landing_color->sponser_color}}">
                  
                   </div>
            </div>

                </div><!--col-->
            </div><!--row-->
        </div><!--card-body-->

        <div class="card-footer clearfix">
            <div class="row">
                <div class="col">
                    {{ form_cancel(route('admin.landing-settings'), __('buttons.general.cancel')) }}
                </div><!--col-->

                <div class="col text-right">
                    {{ form_submit(__('buttons.general.crud.update')) }}
                </div><!--col-->
            </div><!--row-->
        </div><!--card-footer-->
    </div><!--card-->
    {{ html()->form()->close() }}
@endsection


@push('after-scripts')
    

@endpush
