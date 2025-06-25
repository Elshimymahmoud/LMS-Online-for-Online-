@extends('frontend.layouts.app'.config('theme_layout'))

@section('title', trans('labels.frontend.home.title') . ' | ' . app_name())
@section('meta_description', '')
@section('meta_keywords', '')


@push('after-styles')
    <style>
        .link-terms {
            border: none !important;
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


                            <div>
                                @include('includes.partials.messages')
                            </div>
                            <div class="register">


                                {{-- <img src="images/logo.png" alt="" class="logo-register"> --}}
                                <h3 class=" register-title1" style="margin-top:28px;">انضم الى منصة تمهير</h3>
                                <h4 class="register-title">ابدأ في اكتساب مهارات جديدة من الان</h4>
                                <form class="contact_form" id="loginForm"
                                    action="{{ route('frontend.auth.login.post') }}" method="POST"
                                    enctype="multipart/form-data">
                                    {!! csrf_field() !!}
                                    <input type="hidden" name="course_slug"
                                        value="{{ request('course') ? request('course') : null }}">
                                        <input type="hidden" name="course_location_id"
                                        value="{{ request('course_location_id') ? request('course_location_id') : null }}">
                                    <div class="form-group">

                                        <input type="text" value="{{request('email')?request('email'):(request('phone')?request('phone'):'')}}" name="email_phone" placeholder="البريد الالكتروني/ رقم الجوال"
                                            id="">

                                        {{-- <input type="email" name="email" placeholder="البريد الالكتروني" id=""> --}}
                                        <i class="fa fa-envelope-o"></i>
                                    </div>

                                    <div class="form-group">
                                        <input type="password" name="password" placeholder="كلمة المرور" id="">
                                        <i class="fa fa-lock"></i>


                                    </div>
                                    <div class="form-group">
                                        <input class="submit" type="submit" name="submit" value=" سجل الان" id="">

                                    </div>
                                    <div class="row">
                                        <div class="col">
                                            <div class="form-group text-right">
                                                <a href="{{ route('frontend.auth.password.otp.form') }}">@lang('labels.frontend.passwords.use_otp')</a>
                                            </div><!--form-group-->
                                        </div><!--col-->
                                    </div><!--row-->
                                    <div class="form-group">

                                        <a href="/register"> <span style="color: #4f198d;"> ليس لديك حساب؟</span> انشيء حساب
                                        </a>
                                    </div>
                                    <div class="col-md-12">

                                        <div class="form-group">
                                            <a class='link-terms' style="text-align: center;"
                                                href="{{ url('/password/reset2').'?email='.request('email') }}">@lang('labels.frontend.passwords.forgot_password')</a>
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
        </div>
    </section>




@endsection

@push('after-scripts')
@endpush
