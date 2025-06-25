<style>
    .container {
        margin: 200px auto
    }

    fieldset {
        display: none
    }

    fieldset.show {
        display: block
    }

    select:focus,
    input:focus {
        -moz-box-shadow: none !important;
        -webkit-box-shadow: none !important;
        box-shadow: none !important;
        border: 1px solid #2196F3 !important;
        outline-width: 0 !important;
        font-weight: 400
    }

    button:focus {
        -moz-box-shadow: none !important;
        -webkit-box-shadow: none !important;
        box-shadow: none !important;
        outline-width: 0
    }

  

    a:hover {
        text-decoration: none;
        color: #1565C0
    }

    .box {
        margin-bottom: 10px;
        border-radius: 5px;
        padding: 10px
    }

    .modal-backdrop {
        background-color: #64B5F6
    }

    .line {
        background-color: #CFD8DC;
        height: 1px;
        width: 100%
    }

    @media screen and (max-width: 768px) {
        .tabs h6 {
            font-size: 12px
        }
    }

</style>

@if(!auth()->check())
<div class="model" id="myModal">
    <div class="close-popup"></div>
    <div class="model-overlay">
        <div class="model-content">
            <div class="head-model">
                <ul class="list-unstyled d-flex list-head">
                    
                    <li class="active tabs active list-unstyled d-flex list-head" id="tab01">login</li>
                    <li class="tabs  list-unstyled d-flex list-head" id="tab02">register</li>
                </ul>
             
            </div>
            <div class="body-model">
                

                <fieldset id="tab011" class="show body-content body-login">
                    <span class="error-response text-danger"></span>
                    <span class="success-response text-success">{{ session()->get('flash_success') }}</span>
                    <form class="contact_form" id="loginForm" action="{{ route('frontend.auth.login.post') }}"
                        method="POST" enctype="multipart/form-data">
                        <div class="row">
                            <div class="col-md-12">
                                <div class="form-group">
                                    <label for="name">username</label>
                                    {{ html()->email('email')->class('form-control mb-0')->placeholder(__('validation.attributes.frontend.email'))->attribute('maxlength', 191) }}
                                    <span id="login-email-error" class="text-danger"></span>
                                </div>
                            </div>
                            <div class="col-md-12">
                                <div class="form-group">
                                    <label for="name">password</label>
                                    {{ html()->password('password')->class('form-control mb-0')->placeholder(__('validation.attributes.frontend.password')) }}
                                    <span id="login-password-error" class="text-danger"></span>
                                </div>
                            </div>
                            <div class="row">&nbsp;</div>
                            <div class="col-md-4">
                                <div class="form-group">
                                    <input type="checkbox" name="remember_me" id="remember_me">
                                    <label for="remember_me"> Remember Me </label>
                                </div>
                            </div>
                            <div class="col-md-5">
                                <div class="form-group">
                                    <span style="color: #fff;" href="{{ route('frontend.auth.password.reset') }}">@lang('labels.frontend.passwords.forgot_password')</span>
                                </div>
                            </div>
                            @if (config('access.captcha.registration'))
                                <div class="contact-info mb-2 text-center">
                                    {!! Captcha::display() !!}
                                    {{ html()->hidden('captcha_status', 'true') }}
                                    <span id="login-captcha-error" class="text-danger"></span>

                                </div>
                                <!--col-->
                            @endif
                           
                            <div class="col-md-3 mt-3">
                                <div class="form-group">
                                    <button type="submit" style="color:##3bcfcb" class="ml-auto" id="login">@lang('labels.frontend.modal.login_now')</button>
                                </div>
                            </div>
                            <div>&nbsp;</div>
                        </div>
                    </form>
                </fieldset>
                <fieldset id="tab021" class="body-content body-register">
                    <form id="registerForm" class="contact_form" action="#" method="post">
                        {!! csrf_field() !!}

                        <div class="row">
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label for="name">{{ __('validation.attributes.frontend.first_name') }}</label>
                                    {{ html()->text('first_name')->class('form-control mb-0')->placeholder(__('validation.attributes.frontend.first_name'))->attribute('maxlength', 191) }}
                                    <span id="first-name-error" class="text-danger"></span>
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label for="name">{{ __('validation.attributes.frontend.last_name') }}</label>
                                    {{ html()->text('last_name')->class('form-control mb-0')->placeholder(__('validation.attributes.frontend.last_name'))->attribute('maxlength', 191) }}
                                    <span id="last-name-error" class="text-danger"></span>
                                </div>
                            </div>

                            <div class="col-md-6">
                                <div class="form-group">
                                    <label for="name">{{ __('validation.attributes.frontend.email') }}</label>
                                    {{ html()->email('email')->class('form-control mb-0')->placeholder(__('validation.attributes.frontend.email'))->attribute('maxlength', 191) }}
                                    <span id="email-error" class="text-danger"></span>
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label for="name">{{ __('validation.attributes.frontend.phone') }}</label>
                                    {{ html()->text('phone')->class('form-control mb-0')->placeholder(__('validation.attributes.frontend.phone'))->attribute('maxlength', 191) }}
                                    <span id="phone-error" class="text-danger"></span>
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label for="name">password</label>
                                    {{ html()->password('password')->class('form-control mb-0')->placeholder(__('validation.attributes.frontend.password')) }}
                                    <span id="password-error" class="text-danger"></span>
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label for="name">password again</label>
                                    {{ html()->password('password_confirmation')->class('form-control mb-0')->placeholder(__('validation.attributes.frontend.password_confirmation')) }}
                                </div>
                            </div>
                            @if (config('registration_fields') != null)
                                @php
                                    $fields = json_decode(config('registration_fields'));
                                    $inputs = ['text', 'number', 'date'];
                                @endphp
                                @foreach ($fields as $item)
                                    @if (in_array($item->type, $inputs))
                                        <div class="contact-info mb-2">
                                            <input type="{{ $item->type }}" class="form-control mb-0"
                                                value="{{ old($item->name) }}" name="{{ $item->name }}"
                                                placeholder="{{ __('labels.backend.general_settings.user_registration_settings.fields.' . $item->name) }}">
                                        </div>
                                    @elseif($item->type == 'gender')
                                        <div class="contact-info mb-2">
                                            <label class="radio-inline mr-3 mb-0">
                                                <input type="radio" name="{{ $item->name }}" value="male">
                                                {{ __('validation.attributes.frontend.male') }}
                                            </label>
                                            <label class="radio-inline mr-3 mb-0">
                                                <input type="radio" name="{{ $item->name }}" value="female">
                                                {{ __('validation.attributes.frontend.female') }}
                                            </label>
                                            <label class="radio-inline mr-3 mb-0">
                                                <input type="radio" name="{{ $item->name }}" value="other">
                                                {{ __('validation.attributes.frontend.other') }}
                                            </label>
                                        </div>
                                    @elseif($item->type == 'textarea')
                                        <div class="contact-info mb-2">

                                            <textarea name="{{ $item->name }}"
                                                placeholder="{{ __('labels.backend.general_settings.user_registration_settings.fields.' . $item->name) }}"
                                                class="form-control mb-0">{{ old($item->name) }}</textarea>
                                        </div>
                                    @endif
                                @endforeach
                            @endif

                            @if (config('access.captcha.registration'))
                                <div class="contact-info mt-3 text-center">
                                    {!! Captcha::display() !!}
                                    {{ html()->hidden('captcha_status', 'true')->id('captcha_status') }}
                                    <span id="captcha-error" class="text-danger"></span>

                                </div>
                                <!--col-->
                            @endif
                            <div class="col-md-12">
                                <div class="form-group">
                                    <input type="checkbox" name="terms" id="terms">
                                    <label for="terms">
                                        <a href="#"> I agree to the terms and conditions</a>
                                    </label>
                                </div>
                            </div>
                            <div class="col-md-12">
                                <div class="form-group" style="margin-bottom: 0">
                                    <button type="submit" style="background-color:##3bcfcb" class="ml-auto" id="register"><span>register</span></button>
                                </div>
                            </div>
                        </div>
                    </form>
                </fieldset>


            </div>

        </div>
    </div>
</div>
@endif




@push('after-scripts')
    @if (session('openModel'))
        <script>
            $('#myModal').modal('show');
        </script>
    @endif


    @if(config('access.captcha.registration'))
        {!! Captcha::script() !!}
    @endif

    <script>
        $(function () {

            $.ajaxSetup({
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                }
            }); 

            $(document).ready(function () {
                $(document).on('click', '.go-login', function () {
                    $('#register').removeClass('active').addClass('fade')
                    $('#login').addClass('active').removeClass('fade')

                });
                $(document).on('click', '.go-register', function () {
                    $('#login').removeClass('active').addClass('fade')
                    $('#register').addClass('active').removeClass('fade')
                });

                $(document).on('click', '#openLoginModal', function (e) {
                    $.ajax({
                        type: "GET",
                        url: "{{route('frontend.auth.login')}}",
                        success: function (response) {
                            $('#socialLinks').html(response.socialLinks)
                            $('#myModal').modal('show');
                        },
                    });
                });

                $('#loginForm').on('submit', function (e) {
                    e.preventDefault();

                    var $this = $(this);
                    $('.success-response').empty();
                    $('.error-response').empty();

                    $.ajax({
                        type: $this.attr('method'),
                        url: $this.attr('action'),
                        data: $this.serializeArray(),
                        dataType: $this.data('type'),
                        success: function (response) {
                            $('#login-email-error').empty();
                            $('#login-password-error').empty();
                            $('#login-captcha-error').empty();

                            if (response.errors) {
                                if (response.errors.email) {
                                    $('#login-email-error').html(response.errors.email[0]);
                                }
                                if (response.errors.password) {
                                    $('#login-password-error').html(response.errors.password[0]);
                                }

                                var captcha = "g-recaptcha-response";
                                if (response.errors[captcha]) {
                                    $('#login-captcha-error').html(response.errors[captcha][0]);
                                }
                            }
                            if (response.success) {
                                $('#loginForm')[0].reset();
                                if (response.redirect == 'back') {
                                    location.reload();
                                } else {
                                    window.location.href = "{{route('admin.dashboard')}}"
                                }
                            }
                        },
                        error: function (jqXHR) {
                            var response = $.parseJSON(jqXHR.responseText);
                            console.log(jqXHR)
                            if (response.message) {
                                $('#login').find('span.error-response').html(response.message)
                            }
                        }
                    });
                });

                $(document).on('submit','#registerForm', function (e) {
                    e.preventDefault();
                    console.log('he')
                    var $this = $(this);

                    $.ajax({
                        type: $this.attr('method'),
                        headers:{
                            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content'),
                        },
                        url: "{{  route('frontend.auth.register.post')}}",
                        data: $this.serializeArray(),
                        dataType: $this.data('type'),
                        success: function (data) {
                            $('#first-name-error').empty()
                            $('#last-name-error').empty()
                            $('#email-error').empty()
                            $('#phone-error').empty()
                            $('#password-error').empty()
                            $('#captcha-error').empty()
                            if (data.errors) {
                                if (data.errors.first_name) {
                                    $('#first-name-error').html(data.errors.first_name[0]);
                                }
                                if (data.errors.last_name) {
                                    $('#last-name-error').html(data.errors.last_name[0]);
                                }
                                if (data.errors.email) {
                                    $('#email-error').html(data.errors.email[0]);
                                }
                                if (data.errors.password) {
                                    $('#password-error').html(data.errors.password[0]);
                                }

                                var captcha = "g-recaptcha-response";
                                if (data.errors[captcha]) {
                                    $('#captcha-error').html(data.errors[captcha][0]);
                                }
                            }
                            if (data.success) {
                                $('#registerForm')[0].reset();
                                $('.error-response').empty();
                                $("fieldset").removeClass("show");
                                $('#tab011').addClass("show");
                                $('.success-response').empty().html("@lang('labels.frontend.modal.registration_message')");
                                window.location.href = "{{route('admin.dashboard')}}"
                            }
                        }
                    });
                });
            });

        });

        
        $(document).ready(function() {

$(".tabs").click(function() {

    $(".tabs").removeClass("active");
    $(".tabs h6").removeClass("font-weight-bold");
    $(".tabs h6").addClass("text-muted");
    $(this).children("h6").removeClass("text-muted");
    $(this).children("h6").addClass("font-weight-bold");
    $(this).addClass("active");

    current_fs = $(".active");

    next_fs = $(this).attr('id');
    next_fs = "#" + next_fs + "1";

    $("fieldset").removeClass("show");
    $(next_fs).addClass("show");

    current_fs.animate({}, {
        step: function() {
            current_fs.css({
                'display': 'none',
                'position': 'relative'
            });
            next_fs.css({
                'display': 'block'
            });
        }
    });
});

});
    </script>
@endpush
