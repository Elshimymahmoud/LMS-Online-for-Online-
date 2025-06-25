@extends('backend.layouts.app')
@section('title', __('labels.backend.coordinator.title').' | '.app_name())
@push('after-styles')
<style>
    .iti {
     position: unset; 
    display: unset;
    }
    .iti__country-list{
        position: unset;
    }
</style>
@endpush
@section('content')
    {!! Form::open(['method' => 'POST', 'route' => ['admin.coordinator.store'], 'files' => true,]) !!}

    <div class="card">
        <div class="card-header">
            <h3 class="page-title float-left mb-0">@lang('labels.backend.coordinator.create')</h3>
            <div class="float-right">
                <a href="{{ route('admin.coordinator.index') }}"
                   class="btn btn-success">@lang('labels.backend.coordinator.view')</a>
            </div>
        </div>
        <div class="card-body">
            <div class="row">
                <div class="col-12 form-group">
                    {!! Form::label('content', trans('labels.backend.coordinator.fields.name').'*', ['class' => 'control-label']) !!}
                    {!! Form::text('name', old('name'), ['class' => 'form-control ', 'placeholder' =>  trans('labels.backend.coordinator.fields.name').'*', 'required' => '']) !!}
                   <br>
                    {!! Form::text('name_ar', old('name_ar'), ['class' => 'form-control ', 'placeholder' =>  trans('labels.backend.coordinator.fields.name_ar').'*', 'required' => '']) !!}

                </div>
                <div class="form-group col-12">
                           
                    {{ html()->label(__('labels.backend.general_settings.user_registration_settings.fields.gender'))->for('gender')->class('col-md-2 form-control-label') }}
                    
                        <label class="radio-inline mr-3 mb-0">
                            <input type="radio" name="gender" value="male" > {{__('validation.attributes.frontend.male')}}
                        </label>
                        <label class="radio-inline mr-3 mb-0">
                            <input type="radio" name="gender" value="female" > {{__('validation.attributes.frontend.female')}}
                        </label>
                        <label class="radio-inline mr-3 mb-0">
                            <input type="radio" name="gender" value="other" > {{__('validation.attributes.frontend.other')}}
                        </label>
                    
            </div>
                <div class="form-group col-12">
                    {{ html()->label(__('labels.backend.teachers.fields.email'))->class('col-md-2 form-control-label')->for('email') }}

                   
                        {{ html()->email('email')
                            ->class('form-control')
                            ->placeholder(__('labels.backend.teachers.fields.email'))
                            ->attribute('maxlength', 191)
                            ->required() }}
                   
                </div><!--form-group-->

                <div class="form-group col-12">
                   {{-- <div>
                    {{ html()->label(__('labels.backend.teachers.fields.phone'))->class('col-md-2 form-control-label')->for('phone') }}
                   </div> --}}

                    
                        
                        <input class="form-control" name="phone" id="phone" type="tel" required placeholder="@lang('labels.frontend.contact.phone_number')">
                        @if($errors->has('phone'))
                            <span class="help-block text-danger">{{$errors->first('phone')}}</span>
                        @endif
               
                </div>
            </div>
        </div>
    </div>


    <div class="col-12 text-center">
        {!! Form::submit(trans('strings.backend.general.app_save'), ['class' => 'btn btn-danger mb-4 form-group']) !!}
    </div>

    {!! Form::close() !!}
@stop

