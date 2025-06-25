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
                                    <a href="#password" class="nav-link active" aria-controls="password" role="tab" data-toggle="tab">@lang('navs.frontend.user.change_password')</a>
                                </li>
                           
                            @if($logged_in_user->hasRole('teacher'))
                            <li class="nav-item">
                                <a href="#trainingDataForm" class="nav-link" aria-controls="trainingDataForm" role="tab" data-toggle="tab">@lang('labels.frontend.user.profile.answer_training_data_form')</a>
                            </li>
                            @endif
                        </ul>
                        <div class="tab-content">
                            
                            
                          
                                <div role="tabpanel" class="tab-pane fade show  active pt-3" id="password" aria-labelledby="password-tab">
                                    @include('backend.account.tabs.change_password1')
                                </div><!--tab panel change password-->
                           
                            {{-- answer form --}}
                            <div role="tabpanel" class="tab-pane fade show pt-3" id="trainingDataForm" aria-labelledby="password-tab">
                                @include('backend.account.tabs.trainingDataForm')
                            </div><!--tab panel change password-->
                            {{-- answer form --}}
                        </div><!--tab content-->
                    </div><!--tab panel-->
                </div><!--card body-->
            </div><!-- card -->
        </div><!-- col-xs-12 -->
    </div><!-- row -->
@endsection
