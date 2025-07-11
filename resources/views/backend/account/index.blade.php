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
                    <h3 class="mb-0">@lang('navs.frontend.user.edit_account')</h3>
                </div>

                <div class="card-body">
                    <div role="tabpanel">
                        <ul class="nav nav-tabs" role="tablist">
                            <li class="nav-item">
                                <a href="#profile" class="nav-link active" aria-controls="profile" role="tab" data-toggle="tab">@lang('navs.frontend.user.profile')</a>
                            </li>

                            <li class="nav-item">
                                <a href="#edit" class="nav-link" aria-controls="edit" role="tab" data-toggle="tab">@lang('labels.frontend.user.profile.update_information')</a>
                            </li>
                            
                            
                            @if($user->canChangePassword())
                            <li class="nav-item">
                                <a href="#password" class="nav-link" aria-controls="password" role="tab" data-toggle="tab">@lang('navs.frontend.user.change_password')</a>
                            </li>
                            @endif

                            <li class="nav-item">
                                <a href="#activation" class="nav-link" aria-controls="activation" role="tab" data-toggle="tab">حذف& تعطيل الحساب</a>
                            </li>

                            @if($logged_in_user->hasRole('teacher'))
                            <li class="nav-item">
                                <a href="#trainingDataForm" class="nav-link" aria-controls="trainingDataForm" role="tab" data-toggle="tab">@lang('labels.frontend.user.profile.answer_training_data_form')</a>
                            </li>
                            @endif
                        </ul>
                        <div class="tab-content">
                            <div role="tabpanel" class="tab-pane fade show active pt-3" id="profile" aria-labelledby="profile-tab">
                                @include('backend.account.tabs.profile')
                            </div><!--tab panel profile-->

                            <div role="tabpanel" class="tab-pane fade show pt-3" id="edit" aria-labelledby="edit-tab">
                                @include('backend.account.tabs.edit')
                            </div><!--tab panel profile-->

                            @if($user->canChangePassword())
                                <div role="tabpanel" class="tab-pane fade show pt-3" id="password" aria-labelledby="password-tab">
                                    @include('backend.account.tabs.change-password')
                                </div><!--tab panel change password-->
                            @endif
                            {{-- answer form --}}
                            <div role="tabpanel" class="tab-pane fade show pt-3" id="trainingDataForm" aria-labelledby="password-tab">
                                @include('backend.account.tabs.trainingDataForm')
                            </div><!--tab panel change password-->
                            {{-- answer form --}}

                            
                            <div role="tabpanel" class="tab-pane fade show pt-3" id="activation" aria-labelledby="activation-tab">
                                @include('backend.account.tabs.activation-account')
                            </div><!--tab activation account-->

                        </div><!--tab content-->
                    </div><!--tab panel-->
                </div><!--card body-->
            </div><!-- card -->
        </div><!-- col-xs-12 -->
    </div><!-- row -->
@endsection
