@extends('backend.layouts.app')
@push('after-styles')
    <style>
        .name-ar{
            width: 25%;
            float: right;
        }
        .countrySelection{
        width: 50% !important;
       

    }
    #countrySelection, #gds-cr-one{
        border-radius: 10px;
    }
   
    .gds-cr-one{
        width: 50% !important;
        float: left;
    }
   
    </style>
@endpush
@section('content')


<div class="row justify-content-center align-items-center mb-3">
        <div class="col col-sm-12 align-self-center">
            <div class="card">
                <div class="card-header">
                    <h3 class="mb-0">@lang('labels.general.buttons.update') @lang('validation.attributes.frontend.password')</h3>
                </div>

                <div class="card-body">
                    <div role="tabpanel">
                <div class="tab-content" style="padding: 22px 22px;">
                           
                            
                           
                                
<!-- ****************************************** -->
{{ html()->form('PATCH', route('admin.account.post2',$user->email))->class('form-horizontal')->open() }}

{{-- @if(!Route::is('admin.auth.user.change-password', $user) && Route::is('admin.account')) --}}
<div class="row">
        <div class="col">
            <div class="form-group">
                {{ html()->label(__('validation.attributes.frontend.old_password'))->for('old_password') }}

                {{ html()->password('old_password')
                    ->class('form-control')
                    ->placeholder(__('validation.attributes.frontend.old_password'))
                    ->autofocus()
                    ->required() }}
            </div><!--form-group-->
        </div><!--col-->
    </div><!--row-->
{{-- @endif  --}}

    <div class="row">
        <div class="col">
            <div class="form-group">
                {{ html()->label(__('validation.attributes.frontend.new_password'))->for('password') }}

                {{ html()->password('password')
                    ->class('form-control')
                    ->placeholder(__('validation.attributes.frontend.new_password'))
                    ->required() }}
            </div><!--form-group-->
        </div><!--col-->
    </div><!--row-->

    <div class="row">
        <div class="col">
            <div class="form-group">
                {{ html()->label(__('validation.attributes.frontend.password_confirmation'))->for('password_confirmation') }}

                {{ html()->password('password_confirmation')
                    ->class('form-control')
                    ->placeholder(__('validation.attributes.frontend.password_confirmation'))
                    ->required() }}
            </div><!--form-group-->
        </div><!--col-->
    </div><!--row-->

    <div class="row">
        <div class="col">
            <div class="form-group mb-0 clearfix" style="float: left;">
                {{ form_submit(__('labels.general.buttons.update') . ' ' . __('validation.attributes.frontend.password')) }}
            </div><!--form-group-->
        </div><!--col-->
    </div><!--row-->
{{ html()->form()->close() }}


<!-- ************************************** -->
                                
                          
                           
                        </div><!--tab content-->
                    </div><!--tab panel-->
                </div><!--card body-->
            </div><!-- card -->
        </div><!-- col-xs-12 -->
    </div><!-- row -->



@endsection