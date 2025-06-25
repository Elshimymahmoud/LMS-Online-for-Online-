@extends('frontend.layouts.app'.config('theme_layout'))

@section('title', trans('labels.frontend.home.title') . ' | ' . app_name())
@section('meta_description', '')
@section('meta_keywords', '')


@push('after-styles')
    <style>
        .contact-info {
            border-radius: 28px;
            padding: 10px;
            border: 1px solid;
            margin-bottom: 10px;
            margin-right: 15px;
            width: 93.666667%;

        }

        #terms {
            width: unset;
        }

        .link-terms {
            border: none !important;
        }

        .register .col-md-6 {
            min-height: 87px
        }

        #loading,
        #loading2 {
            background: rgba(255, 255, 255, 0.8);
            display: none;
            height: 100%;
            position: fixed;
            width: 100%;
            z-index: 999999999;
        }

        #loading img,
        #loading2 img {
            left: 50%;
            margin-left: -107px;
            margin-top: -32px;
            position: absolute;
            top: -27%;
            width: 300px;
        }

        #loading-center-absolute {
            transform: unset
        }

    </style>
@endpush

@section('content')
    <div id="loading2">
        <div id="loading-center">
            <div id="loading-center-absolute">
                {{-- <img src="{{asset('iv').'/loader2.gif'}}"  alt=""> --}}
                <div class="object" id="object_four"></div>
                <div class="object" id="object_three"></div>
                <div class="object" id="object_two"></div>
                <div class="object" id="object_one"></div>
            </div>
        </div>
    </div>

    <section class="row the-slider" id="slider">
        <div style="width: 25%; right:15px;">
            @include('includes.partials.messages')
        </div>
        <div style="background-size: cover;height:fit-content;background-color: #f1f3f3;padding-bottom: 20px;">
            <div class="container">
                <div class="row benefit-notes">
                    <div class="col-sm-12 col-md-12   wow fadeInUp2  register-parent mt-0">

                        <!--========== /.navbar-collapse ==========-->
                    </div>
                    <!--========== /.container-fluid ==========-->


                </div>

                <!--==========blog details ==========-->
                <div class="row">

                    <div class="container">

                        <!--==========blog details  ==========-->
                        <div class="col-sm-12 col-md-3   wow fadeInUp ptb-50  mt-0">

                        </div>

                        <div class="col-sm-12 col-md-6   wow fadeInUp ptb-50  mt-0">

                            @if ($errors->has('error'))
                                <div class="alert alert-dismissable alert-danger show">
                                    <button type="button" class="close" data-dismiss="alert">&times;</button>
                                    {{ $errors->first('error') }}
                                </div>
                            @endif
                            <div class="register">
                                {{-- <img src="images/logo.png" alt="" class="logo-register"> --}}
                                <h3 class=" register-title1" style="margin-top: 17px;">انضم الى منصة تمهير</h3>
                                <h4 class="register-title">ابدأ في اكتساب مهارات جديدة من الان</h4>
                                <form id="registerForm3" action="{{ route('frontend.auth.register.post') }}"
                                      class="contact_form" method="post">
                                    {!! csrf_field() !!}
                                    <input type="hidden" name="course_slug"
                                           value="{{ request('course') ? request('course') : null }}">
                                    <input type="hidden" name="group_id"
                                           value="{{ request('group_id') ? request('group_id') : null }}">
                                    <!-- ********** -->
                                    <!-- *********** -->
                                    <div class="col-md-12">
                                        <p class="input-message">تأكد من ادخال اسمك بالشكل الذي ترغب في ظهوره في الشهادة
                                            لاحقا</p>

                                    </div>
{{--                                    {{ dd($errors) }}--}}

                                    <div class="col-md-6">

                                        <div class="form-group">
                                            <input type="text" name="name_ar" id=""
                                                   placeholder="  {{ __('validation.attributes.frontend.first_name_ar') }} ">
                                            <i class="fa fa-user"></i>
                                            @if ($errors->has('name_ar'))
                                                <span class="text-danger"> {{ $errors->first('name_ar') }}</span>
                                            @endif

                                            {{-- <p class="input-message">تأكد من ادخال اسمك بالشكل الذي ترغب في ظهوره في الشهادة لاحقا</p> --}}
                                        </div>
                                    </div>


                                    <div class="col-md-6">

                                        <div class="form-group">
                                            <input type="text" name="fourth_name_ar" id=""
                                                   placeholder="  {{ __('validation.attributes.frontend.fourth_name_ar') }} ">
                                            <i class="fa fa-user"></i>
                                            @if ($errors->has('fourth_name_ar'))
                                                <span class="text-danger">{{ $errors->first('fourth_name_ar') }}</span>
                                            @endif

                                            {{-- <p class="input-message">تأكد من ادخال اسمك بالشكل الذي ترغب في ظهوره في الشهادة لاحقا</p> --}}
                                        </div>
                                    </div>
                                    <!-- ************************** -->


                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <input type="email" name="email"
                                                   placeholder="{{ __('validation.attributes.frontend.email') }} "
                                                   id="">
                                            <i class="fa fa-envelope-o"></i>
                                            @if ($errors->has('email'))
                                                <span class="text-danger">{{ $errors->first('email') }}</span>
                                            @endif
                                        </div>
                                    </div>
                                    @if (config('registration_fields') != null)
                                        @php
                                            $fields = json_decode(config('registration_fields'));
                                            $inputs = ['text', 'number', 'date', 'tel'];
                                        @endphp
                                        @foreach ($fields as $item)
                                            @if (in_array($item->type, $inputs))
                                                @if($item->name == 'phone')
                                                    <div class="col-md-6">
                                                        <div class="form-group">

                                                            <input type="tel" class="form-control mb-0" value=""
                                                                   name="phoneNumber" id="phone"
                                                                   placeholder="{{ __('labels.backend.general_settings.user_registration_settings.fields.phone') }}">
                                                            @if ($errors->has('phoneNumber'))
                                                                <span class="text-danger">{{ $errors->first('phoneNumber') }}</span>
                                                            @endif

                                                        </div>
                                                    </div>
                                                @else
                                                    <div class="col-md-6">
                                                        <div class="form-group">

                                                            <input type="{{ $item->type }}" class="form-control mb-0"
                                                                   value=""
                                                                   name="{{ $item->name }}" id="{{ $item->name }}"
                                                                   placeholder="{{ __('labels.backend.general_settings.user_registration_settings.fields.' . $item->name) }}">
                                                            <span id="{{ $item->name }}" class="text-danger"></span>
                                                            @if ($errors->has( $item->name))
                                                                <span class="text-danger">{{ $errors->first($item->name) }}</span>
                                                            @endif
                                                        </div>
                                                    </div>
                                                @endif
                                            @elseif($item->type == 'gender')
                                                <div class="contact-info mb-2 col-md-10">

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
                                                <div class="contact-info mb-2 col-md-10">

           <textarea name="{{ $item->name }}"
                     placeholder="{{ __('labels.backend.general_settings.user_registration_settings.fields.' . $item->name) }}"
                     class="form-control mb-0" cols="5"
                     rows="2">{{ old($item->name) }}</textarea>
                                                </div>
                                            @endif
                                        @endforeach
                                    @endif
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <input type="password" name="password"
                                                   placeholder="{{ __('validation.attributes.frontend.password') }} "
                                                   id="">
                                            <i class="fa fa-lock"></i>
                                            <p class="input-message"> يجب ان لا تقل كلمة المرور عن ٨ احرف</p>
                                            @if ($errors->has('password'))
                                                <span class="text-danger">{{ $errors->first('password') }}</span>
                                            @endif

                                        </div>
                                    </div>

                                    <div class="col-md-6">

                                        <div class="form-group">
                                            <input type="password" name="password_confirmation"
                                                   placeholder="{{ __('validation.attributes.frontend.password_confirmation') }} "
                                                   id="">
                                            <i class="fa fa-lock"></i>
                                            <p class="input-message"> يجب ان لا تقل كلمة المرور عن ٨ احرف</p>

                                        </div>
                                    </div>
                                    @if (config('access.captcha.registration'))
                                        <div class="contact-info mt-3 text-center">
                                            {!! Captcha::display() !!}
                                            {{ html()->hidden('captcha_status', 'true')->id('captcha_status') }}
                                            @if ($errors->has('captcha'))
                                                <span class="text-danger">{{ $errors->first('captcha') }}</span>
                                            @endif

                                        </div>
                                        <!--col-->
                                    @endif
                                    <div class="col-md-12">
                                        <div class="form-group">
                                            <input type="checkbox" class="" name="terms" id="terms">
                                            <label for="terms">
                                                <a class='link-terms'
                                                   href="{{route('termsConditions')}}">{{ __('validation.attributes.frontend.conditions') }} </a>
                                            </label>
                                        </div>
                                    </div>

                                    <div class="col-md-10">
                                        <div class="form-group">
                                            <input type="checkbox" style="width: unset;" class="" name="allow_personal_info" id="allow_personal_info">
                                            <label for="allow_personal_info" style="width: unset;">
                                                {{ __('validation.attributes.frontend.allow_personal_info') }}
                                            </label>
                                        </div>
                                    </div>

                                    <div class="col-md-12">
                                        <div class="form-group">
                                            <input class="submit" type="submit" name="submit" value="انشيء الحساب"
                                                   id="submit">

                                        </div>
                                    </div>

                                    <div class="col-md-12">
                                        <div class="form-group">

                                            <a
                                                    href="/login?course={{ request('course') }}&group_id={{ request('group_id') }}">
                                                <span style="color: green;"> ألديك حساب؟</span> سجل دخولك هنا </a>
                                        </div>
                                    </div>

                                </form>

                            </div>
                        </div>
                        <div class="col-sm-12 col-md-3   wow fadeInUp ptb-50  mt-0">
                        </div>
                        <!--==========blog details  ==========-->
                        <!--========== more blog details  ==========-->


                    </div>
                </div>
            </div>
        </div>

    </section>

@endsection

@push('after-scripts')
    <script>
        $(function () {
            $.ajaxSetup({
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                }
            });
            $(document).ready(function () {
{{--                $(document).on('submit', '#registerForm3', function (e) {--}}
{{--                    e.preventDefault();--}}


{{--                    var $this = $(this);--}}

{{--                    $("#loading2").fadeIn();--}}

{{--                    $.ajax({--}}
{{--                        type: $this.attr('method'),--}}
{{--                        headers: {--}}
{{--                            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content'),--}}
{{--                        },--}}
{{--                        url: "{{ route('frontend.auth.register.post') }}",--}}
{{--                        data: $this.serializeArray(),--}}
{{--                        dataType: $this.data('type'),--}}
{{--                        success: function (data) {--}}
{{--                        /--}}
{{--                            $('#email-error').empty()--}}
{{--// $('#phone').empty()--}}
{{--                            $('#password-error').empty()--}}
{{--                            $('#captcha-error').empty()--}}
{{--                            $('#nationa-id-number-error').empty()--}}
{{--                            $('#name-ar-error').empty()--}}
{{--// $('#sec_name-ar-error').empty()--}}
{{--// $('#third_name-ar-error').empty()--}}
{{--                            $('#fourth_name-ar-error').empty()--}}
{{--                            console.log(data);--}}
{{--                            error: function (jqXHR, textStatus, errorThrown) {--}}
{{--                                var errors = jqXHR.responseJSON.errors;--}}
{{--                                console.log("error", errors);--}}
{{--// Now you can handle your errors--}}
{{--                            }--}}

{{--                            if (data.errors) {--}}
{{--                                console.log(data.errors);--}}
{{--                                $("#loading2").fadeOut();--}}

{{--// if (data.errors.first_name) {--}}
{{--//     $('#first-name-error').html(data.errors.first_name[0]);--}}
{{--// }--}}
{{--// if (data.errors.last_name) {--}}
{{--//     $('#last-name-error').html(data.errors.last_name[0]);--}}
{{--// }--}}
{{--// if (data.errors.third_name) {--}}
{{--//     $('#third-name-error').html(data.errors.third_name[0]);--}}
{{--// }--}}
{{--// if (data.errors.fourth_name) {--}}
{{--//     $('#fourth-name-error').html(data.errors.fourth_name[0]);--}}
{{--// }--}}
{{--                                if (data.errors.name_ar) {--}}
{{--                                    $('#name-ar-error').html(data.errors.name_ar[0]);--}}
{{--                                }--}}
{{--// **********--}}
{{--// if (data.errors.sec_name-ar-error) {--}}
{{--//     $('#sec_name-ar-error').html(data.errors.sec_name-ar[0]);--}}
{{--// }if (data.errors.third_name-ar) {--}}
{{--//     $('#third_name-ar-error').html(data.errors.third_name-ar[0]);--}}

{{--                                if (data.errors.fourth_name - ar) {--}}
{{--                                    $('#fourth_name-ar-error').html(data.errors--}}
{{--                                        .fourth_name - ar[0]);--}}
{{--                                }--}}
{{--// ********--}}
{{--                                if (data.errors.email) {--}}
{{--                                    $('#email-error').html(data.errors.email[0]);--}}
{{--                                }--}}
{{--                                if (data.errors.password) {--}}
{{--                                    $('#password-error').html(data.errors.password[0]);--}}
{{--                                }--}}
{{--                                if (data.errors.national_id_number) {--}}
{{--                                    $('#national-id-number-error').html(data.errors--}}
{{--                                        .national_id_number[0]);--}}
{{--                                }--}}
{{--                                if (data.errors.phone) {--}}
{{--                                    $('#phoneNumber').html(data.errors.phoneNumber[0]);--}}
{{--                                }--}}
{{--                                var captcha = "g-recaptcha-response";--}}
{{--                                if (data.errors[captcha]) {--}}
{{--                                    $('#captcha-error').html(data.errors[captcha][0]);--}}
{{--                                }--}}
{{--                            }--}}
{{--                            if (data.success) {--}}

{{--                                $('#registerForm3')[0].reset();--}}
{{--                                $('.error-response').empty();--}}
{{--                                $("fieldset").removeClass("show");--}}
{{--                                $('#tab011').addClass("show");--}}
{{--                                $('.success-response').empty().html(--}}
{{--                                    "@lang('labels.frontend.modal.registration_message')");--}}
{{--                                location.reload();--}}
{{--                            }--}}
{{--                        }--}}
{{--                    });--}}
{{--                });--}}
            })
        });
    </script>
@endpush
