@extends('frontend.layouts.app'.config('theme_layout'))

@section('title', app_name() . ' | ' . __('labels.frontend.auth.activation_code'))

@push('after-styles')
    <style>
        .link-terms{
            border: none !important;
        }
        .title{
            font-size: 22px !important;
            color: ##3bcfcb;
            text-align: center;
            padding: 10px;
        }
        .submit{
            background-color: ##3bcfcb;
            padding: 10px;
            font-weight: bold;
        }
    </style>
@endpush
@section('content')

    <section id="breadcrumb" class="breadcrumb-section relative-position backgroud-style">
        <div class="blakish-overlay"></div>
        <div class="container">
            <div class="page-breadcrumb-content text-center">
                <div class="page-breadcrumb-title">
                    <h2 class="breadcrumb-head black bold">{{__('labels.frontend.auth.activation_code')}}</h2>
                </div>
            </div>
        </div>
    </section>
    <section id="about-page" class="about-page-section pb-0">
        <div class="row justify-content-center align-items-center" style="overflow: hidden;max-width: 100%;">
            <div class="col col-sm-6 col-sm-offset-3 align-self-center">

                <div class="card border-0">
                    <div class="card-body">
                        <div class="successMessage">
                            @include('includes.partials.messages')
                            <div id="flash-message">

                            </div>
                        </div>


                        {{ html()->form('POST', route('frontend.auth.password.otp.sendOtp'))->class('form-horizontal')->open() }}
                        <br>
                        <br>

                        <div class="row" id="mobileContainer">
                            <div class="col">
                                <div class="form-group">
                                    {{ html()->label(__('labels.frontend.passwords.user_mobile'))->for('mobile') }}
                                    <span class="small_note">* {{ __('labels.frontend.passwords.user_mobile_note') }}</span>
                                    {{ html()->number('mobile')
                                        ->class('form-control')
                                        ->placeholder(__('labels.frontend.passwords.user_mobile'))
                                        ->required() }}
                                </div><!--form-group-->
                            </div><!--col-->
                        </div><!--row-->

                        <div class="row">
                            <div class="col">
                                <div class="form-group mb-0 clearfix">
                                    <button id="sendOtpButton" class="submit nws-button btn-info btn" type="button">{{__('labels.frontend.passwords.send_otp')}}</button>
                                </div><!--form-group-->
                            </div><!--col-->
                        </div><!--row-->

                        <div class="row" id="otpInput" style="display: none;">
                            <div class="col">
                                <div class="form-group">
                                    {{ html()->label(__('labels.frontend.auth.otp'))->for('otp') }}

                                    {{ html()->number('otp')
                                        ->class('form-control')
                                        ->placeholder(__('labels.frontend.auth.otp'))
                                        ->required()
                                        ->attribute('max', '999999') }}

                                </div><!--form-group-->
                            </div><!--col-->
                        </div><!--row-->

                        <div class="row" id="otpInputBtn" style="display: none;">
                            <div class="col">
                                <div class="form-group mb-0 clearfix">
                                    <button id="verifyOtpButton" class="submit nws-button btn-info btn" type="button">{{__('labels.frontend.passwords.verify_otp')}}</button>
                                </div><!--form-group-->
                            </div><!--col-->
                        </div><!--row-->

                        {{ html()->form()->close() }}
                        <br>
                        <br>
                    </div><!-- card-body -->
                </div><!-- card -->
            </div><!-- col-6 -->
        </div><!-- row -->
    </section>
@endsection

@push('after-scripts')
    <script>
        $(document).ready(function() {
            $('#sendOtpButton').click(function(e) {
                e.preventDefault();
                var phoneNumber = $('#mobile').val();

                $.ajax({
                    url: '{{ route("frontend.auth.password.otp.sendOtp") }}',
                    type: 'POST',
                    data: {
                        _token: '{{ csrf_token() }}',
                        mobile: phoneNumber
                    },
                    success: function(response) {
                        if (response.success) {
                            $('#mobileContainer').hide();
                            $('#sendOtpButton').hide();
                            $('#otpInput').show();
                            $('#otpInputBtn').show();

                            var successAlert = '<div class="alert alert-success" role="alert" id="success-alert">' +
                                '<button type="button" class="close" data-dismiss="alert" aria-label="Close">' +
                                '<span aria-hidden="true">&times;</span>' +
                                '</button>' +
                               '@lang('labels.frontend.auth.otp_sent')' +
                                '</div>';

                            $('#flash-message').append(successAlert);
                        } else {
                            var errorAlert = '<div class="alert alert-danger" role="alert" id="error-alert">' +
                                '<button type="button" class="close" data-dismiss="alert" aria-label="Close">' +
                                '<span aria-hidden="true">&times;</span>' +
                                '</button>' +
                                response.error +
                                '</div>';

                            $('#flash-message').append(errorAlert);
                        }
                    },
                    error: function(xhr) {
                        var errorAlert = '<div class="alert alert-danger" role="alert" id="error-alert">' +
                            '<button type="button" class="close" data-dismiss="alert" aria-label="Close">' +
                            '<span aria-hidden="true">&times;</span>' +
                            '</button>' +
                            xhr.error +
                            '</div>';

                        $('#flash-message').append(errorAlert);
                    }
                });
            });

            $('#verifyOtpButton').click(function(e) {
                e.preventDefault();
                var otp = $('#otp').val();

                $.ajax({
                    url: '{{ route("frontend.auth.password.otp.verifyOtp") }}',
                    type: 'POST',
                    data: {
                        _token: '{{ csrf_token() }}',
                        otp: otp
                    },
                    success: function(response) {
                        if (response.success) {
                            window.location.href = response.redirect;
                        } else {

                            var errorAlert = '<div class="alert alert-danger" role="alert" id="error-alert">' +
                                '<button type="button" class="close" data-dismiss="alert" aria-label="Close">' +
                                '<span aria-hidden="true">&times;</span>' +
                                '</button>' +
                                response.error +
                                '</div>';

                            $('#flash-message').append(errorAlert);
                        }
                    },
                    error: function(xhr) {

                        var errorAlert = '<div class="alert alert-danger" role="alert" id="error-alert">' +
                            '<button type="button" class="close" data-dismiss="alert" aria-label="Close">' +
                            '<span aria-hidden="true">&times;</span>' +
                            '</button>' +
                            xhr.error +
                            '</div>';

                        $('#flash-message').append(errorAlert);
                    }
                });
            });
        });
    </script>
@endpush