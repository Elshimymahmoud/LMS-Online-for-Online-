@php use App\Models\Page; @endphp
<!DOCTYPE html>
@langrtl
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}" dir="rtl">
@else
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
@endlangrtl

<head>
    <link rel="stylesheet" href="{{asset('assets/css/colors/switch.css')}}">
    <link href="{{asset('assets/css/colors/color-2.css')}}" rel="alternate stylesheet" type="text/css"
          title="color-2">
    <link href="{{asset('assets/css/colors/color-3.css')}}" rel="alternate stylesheet" type="text/css"
          title="color-3">
    <link href="{{asset('assets/css/colors/color-4.css')}}" rel="alternate stylesheet" type="text/css"
          title="color-4">
    <link href="{{asset('assets/css/colors/color-5.css')}}" rel="alternate stylesheet" type="text/css"
          title="color-5">
    <link href="{{asset('assets/css/colors/color-6.css')}}" rel="alternate stylesheet" type="text/css"
          title="color-6">
    <link href="{{asset('assets/css/colors/color-7.css')}}" rel="alternate stylesheet" type="text/css"
          title="color-7">
    <link href="{{asset('assets/css/colors/color-8.css')}}" rel="alternate stylesheet" type="text/css"
          title="color-8">
    <link href="{{asset('assets/css/colors/color-9.css')}}" rel="alternate stylesheet" type="text/css"
          title="color-9">
<link rel="stylesheet" href="https://fonts.googleapis.com/css2?family={{ config('google_font') }}:wght@300;400;500;600;700&display=swap">

    @php
    header("Access-Control-Allow-Origin: *");
    @endphp
    <meta charset="utf-8" />
    <meta http-equiv="X-UA-Compatible" content="IE=edge" />
    <meta name="viewport" content="width=device-width, initial-scale=1" />
    <meta name="csrf-token" content="{{ csrf_token() }}">
    @if(config('favicon_image') != "")
    <link rel="shortcut icon" type="image/x-icon" href="{{asset('storage/logos/'.config('favicon_image'))}}" />
    @endif
    <title>@yield('title', app_name())</title>
    <meta name="description" content="@yield('meta_description', '')">
    <meta name="keywords" content="@yield('meta_keywords', '')">
    {{-- config Pixel Code --}}
    {!! config('pixel_code') !!}
    {{-- config Pixel Code --}}

    {{-- course Pixel Code --}}
    @stack('course_pixel_code')
    {{-- course Pixel Code --}}

    {{-- See https://laravel.com/docs/5.5/blade#stacks for usage --}}
    @stack('before-styles')

    <link rel="preconnect" href="https://fonts.googleapis.com" />
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin />
    <link href="https://fonts.googleapis.com/css2?family={{ config('google_font') }}:wght@100;200;300;400;500;600;700;800&display=swap" rel="stylesheet" />

    <!-- CSS Plugin Files -->
    <link href="{{ asset('iv') }}/css/lib/bootstrap.min.css" rel="stylesheet" />
    <link href="{{ asset('iv') }}/css/plugins/font-awesome.min.css" rel="stylesheet" />
    <link href="{{ asset('iv') }}/css/plugins/lineicons.css" rel="stylesheet" />
    <link href="{{ asset('iv') }}/vendors/magnific-popup/magnific-popup.css" rel="stylesheet" />
    <link href="{{ asset('iv') }}/vendors/bootstrap-touchspin/jquery.bootstrap-touchspin.min.css" rel="stylesheet" />
    <link href="{{ asset('iv') }}/vendors/bootstrap-select/css/bootstrap-select.min.css" rel="stylesheet" />
    <link href="{{ asset('iv') }}/vendors/owl-carousel/assets/owl.carousel.css" rel="stylesheet" />
    <link href="{{ asset('iv') }}/css/plugins/animate.css" rel="stylesheet" />
    <link rel="stylesheet" href="https://pro.fontawesome.com/releases/v5.10.0/css/all.css" integrity="sha384-AYmEC3Yw5cVb3ZcuHtOA93w35dYTsvhLPVnYs9eStHfGJvOvKxVfELGroGkvsg+p" crossorigin="anonymous" />

    <!-- Preloader -->
    <link href="{{ asset('iv') }}/css/plugins/preloader.css" rel="stylesheet" />

    <!--========== Main Styles==========-->
    <link href="{{ asset('iv') }}/css/style.css" rel="stylesheet" />

    @if(session('locale') == 'ar')
    <!--========== RTL Version ==========-->
    <link href="{{ asset('iv') }}/css/lib/bootstrap-rtl.css" rel="stylesheet" />
    <link href="{{ asset('iv') }}/css/rtl.css" rel="stylesheet" />
    <link href="{{ asset('iv') }}/css/extra-rtl.css?v2=0" rel="stylesheet" />
    @else
    <link href="{{ asset('iv') }}/css/extra.css" rel="stylesheet" />
    <link href="{{ asset('iv') }}/css/ltr.css" rel="stylesheet" />
    @endif


    <!-- Owl Stylesheets -->
    <link rel="stylesheet" href="{{ asset('iv') }}/assets/owlcarousel/assets/owl.carousel.min.css" />
    <link rel="stylesheet" href="{{ asset('iv') }}/assets/owlcarousel/assets/owl.theme.default.min.css" />
    <link rel="stylesheet" href="{{ asset('iv') }}/assets/css/docs.theme.min.css" />

    {{-- twilio phone international code --}}
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/intl-tel-input/17.0.8/css/intlTelInput.css" />
    {{-- twilio phone international code --}}

    <script src="https://cdnjs.cloudflare.com/ajax/libs/intl-tel-input/17.0.8/js/intlTelInput.min.js"></script>
    {{-- /////// --}}

    <script>
        setTimeout(() => {
            const phoneInputField = document.querySelector("#phone");

            const phoneInput = window.intlTelInput(phoneInputField, {
                utilsScript: "https://cdnjs.cloudflare.com/ajax/libs/intl-tel-input/17.0.8/js/utils.js",
            });

            const phoneNumber = phoneInput.getNumber();
            $('#phone').on('change', () => {
                const phoneNumber = phoneInput.getNumber();

                $('#phone').val(phoneNumber);
                console.log(phoneNumber);
            })
            //    $('#phone').on('keyPress',()=>{
            //     const phoneNumber = phoneInput.getNumber();
            //     console.log(phoneNumber,"Dddd");
            //     $('#phone').val(phoneNumber);
            //     console.log(phoneNumber);
            //    })
            $('#iti-0__country-listbox').on('change', () => {
                const phoneNumber = phoneInput.getNumber();

                $('#phone').val(phoneNumber);
                console.log(phoneNumber);
            })
            let phoneInput2 = document.querySelector("#phone");
            window.intlTelInput(phoneInput2, {
                initialCountry: "auto",
                geoIpLookup: function(success, failure) {
                    $.get("https://ipinfo.io", function() {}, "jsonp").always(function(resp) {
                        var countryCode = (resp && resp.country) ? resp.country : "us";
                        success(countryCode);
                    });
                },
            });
        }, 1000);
    </script>
    {{-- /////// --}}
    <!-- javascript -->
    <script src="{{ asset('iv') }}/assets/vendors/jquery.min.js"></script>
    <script src="{{ asset('iv') }}/assets/owlcarousel/owl.carousel.js"></script>

    <!-- Theme CSS (For Available Color Options, See Documentation ) -->
    <!-- <link href="css/themes/blue-orange.css" rel="stylesheet"> -->

    <!--========== HTML5 shim and Respond.js (Required) ==========-->
    <!--[if lt IE 9]>
      <script src="js/lib/html5shiv.min.js"></script>
      <script src="js/lib/respond.min.js"></script>
    <![endif]-->

    @yield('css')
    @stack('after-styles')
    <style>
        .mediaLnkCourseFooter:hover {
            color: #4f198d;
        }
        #main-navbar {
            width: 105%;
        }

        .float {
            position: fixed;
            width: 60px;
            height: 60px;
            bottom: 40px;
            right: 40px;
            background-color: #25d366;
            color: #FFF;
            border-radius: 50px;
            text-align: center;
            font-size: 30px;
            box-shadow: 2px 2px 3px #999;
            z-index: 100;
        }

        .my-float {
            margin-top: 16px;
        }
    </style>
    @if(config('onesignal_status') == 1)
    {!! config('onesignal_data') !!}
    @endif

    @if(config('google_analytics_id') != "")
    <!-- Global site tag (gtag.js) - Google Analytics -->
    <script async src="https://www.googletagmanager.com/gtag/js?id={{config('google_analytics_id')}}"></script>
    <script>
        window.dataLayer = window.dataLayer || [];

        function gtag() {
            dataLayer.push(arguments);
        }
        gtag('js', new Date());

        gtag('config', '{{config('
            google_analytics_id ')}}');
    </script>
    @endif
    <!--Start of Tawk.to Script-->
    {{-- website tawk.to === username:ivorytraining2021@gmail.com ====== password:IvoryTraining123456 --}}
    {{-- <script type="text/javascript">
            var Tawk_API=Tawk_API||{}, Tawk_LoadStart=new Date();
            (function(){
            var s1=document.createElement("script"),s0=document.getElementsByTagName("script")[0];
            s1.async=true;
            s1.src='https://embed.tawk.to/619530e16885f60a50bc45ac/1fkncdsdr';
            s1.charset='UTF-8';
            s1.setAttribute('crossorigin','*');
            s0.parentNode.insertBefore(s1,s0);
            })();
        </script> --}}
    <!--End of Tawk.to Script-->
   

    {{-- whatsaap lnk --}}
    @stack('after-scripts2')

{{-- Cart Styles --}}
    <style>
        .shopping-cart {
            width: 750px;
            height: 423px;
            margin: 80px auto;
            background: #FFFFFF;
            box-shadow: 1px 2px 3px 0px rgba(0,0,0,0.10);
            border-radius: 6px;
            display: none;
            flex-direction: column;

        }

        .page-shadow {
            position: fixed;
            top: 0;
            left: 0;
            width: 100%;
            height: 100%;
            background-color: rgba(0, 0, 0, 0.5);
            z-index: 2000;
            display: none;
        }

        .cart-title {
            height: 60px;
            border-bottom: 1px solid #E1E8EE;
            padding: 20px 30px;
            color: #5E6977;
            font-size: 18px;
            font-weight: 400;
            display: flex;
            justify-content: space-between;
        }

        .cart-item {
            padding: 20px 30px;
            height: 120px;
            display: flex;
            flex-direction: row;
            justify-content: space-between;
        }

        .cart-item {
            border-top:  1px solid #E1E8EE;
            border-bottom:  1px solid #E1E8EE;
        }
        .cart-buttons {
            position: relative;
            padding-top: 30px;
            margin-right: 35px;
        }
        .cart-delete-btn,
        .cart-like-btn {
            display: inline-block;
            Cursor: pointer;
        }
        .cart-delete-btn {
            width: 18px;
            height: 17px;
            background: url('https://designmodo.com/demo/shopping-cart/delete-icn.svg') no-repeat center;
        }

        .cart-item .image {
            margin-left: 30px;
            width: 25%;
        }
        .no-scroll {
            overflow: hidden;
        }
        .cart-like-btn {
            position: absolute;
            top: 9px;
            left: 15px;
            /*background: url('');*/
            width: 60px;
            height: 60px;
            background-size: 2900%;
            background-repeat: no-repeat;
        }


        @keyframes animate {
            0%   { background-position: left;  }
            50%  { background-position: right; }
            100% { background-position: right; }
        }
        .shopping-cart image {
            margin-right: 50px;
        }
        .cart-description {
            padding-top: 10px;
            width: fit-content;
        }

        .cart-description span {
            display: block;
            font-size: 14px;
            color: #43484D;
            font-weight: 400;
        }

        .cart-description span:first-child {
            margin-bottom: 5px;
        }
        .cart-description span:last-child {
            font-weight: 300;
            margin-top: 8px;
            color: #86939E;
        }
        @media (max-width: 800px) {
            .shopping-cart {
                width: 100%;
                height: auto;
                overflow: hidden;
            }
            .cart-item {
                height: auto;
                flex-wrap: wrap;
                justify-content: center;
            }
            .shopping-cart .image img {
                width: 50%;
            }
            .shopping-cart .image,
            .cart-quantity,
            .cart-description {
                width: 100%;
                text-align: center;
                margin: 6px 0;
            }
            .cart-buttons {
                margin-right: 20px;
            }
        }
        .cart-total-price {
            width: 83px;
            padding-top: 27px;
            text-align: center;
            font-size: 16px;
            color: #43484D;
            font-weight: 300;
        }
        .cart-quantity {
            padding-top: 20px;
            margin-right: 60px;
        }
        .cart-quantity input {
            -webkit-appearance: none;
            border: none;
            text-align: center;
            width: 32px;
            font-size: 16px;
            color: #43484D;
            font-weight: 300;
        }

        .shopping-cart button[class*=btn] {
            width: 30px;
            height: 30px;
            background-color: #E1E8EE;
            border-radius: 6px;
            border: none;
            cursor: pointer;
        }
        .minus-btn img {
            margin-bottom: 3px;
        }
        .plus-btn img {
            margin-top: 2px;
        }

        .shopping-cart button:focus,
        .shopping-cart input:focus {
            outline:0;
        }
        .cart-actions {
            display: flex;
            justify-content: space-between;
            height: 40px;
            top: -8px;
            position: relative;
        }

        .cart-actions .btn {
            padding: 10px 20px;
            text-decoration: none;
            color: white;
            border-radius: 5px;
            text-align: center;
        }
        .btn-secondary {
            background-color: #6c757d !important;
        }
    </style>
{{-- Cart Scripts --}}
    <script>
        $(document).ready(function() {
            $('.btn-open-cart').on('click', function() {
                if ($('.shopping-cart').css('display') == 'none') {
                    $('.shopping-cart').css('display', 'flex');
                    $('body').addClass('no-scroll');
                } else {
                    $('.shopping-cart').css('display', 'none');
                    $('body').removeClass('no-scroll');
                }
                $('.page-shadow').toggle();
            });
            $('.page-shadow').on('click', function() {
                $(this).hide();
                $('.shopping-cart').hide();
                $('body').removeClass('no-scroll');
            });
            $('#closeCart').on('click', function() {
                $('.shopping-cart').hide();
                $('.page-shadow').hide();
                $('body').removeClass('no-scroll');
            });
        });

    </script>
   <style>
        *:not(.fa) {
            font-family: '{{ str_replace('+', ' ', config('google_font')) }}', sans-serif !important;
        }
        .fa, .fas{
            font-family: "Font Awesome 5 Pro" !important;
            font-weight: 900;
        }
        /* if not image use     filter: invert( 1) hue-rotate(180deg);*/
        [data-theme="dark"] body:not(img) {
            filter: invert(1) hue-rotate(180deg);
            background-color: black;
        }
        [data-theme="dark"] img {
            filter: invert(1) hue-rotate(180deg);
        }
    </style>


    <style>
        /*:root {*/
        /*    --background-color: #ffffff;*/
        /*    --text-color: #000000;*/
        /*    --link-color: #1a0dab;*/
        /*    --border-color: initial;*/
        /*}*/

        /*[data-theme="dark"] {*/
        /*    --background-color: #181818;*/
        /*    --text-color: #ffffff;*/
        /*    --link-color: #bb86fc;*/
        /*    --border-color: 2px solid #ffffff;*/
        /*}*/

        /*body {*/
        /*    background-color: var(--background-color)!important;*/
        /*    color: var(--text-color)!important;*/
        /*}*/

        /*section {*/
        /*    background: var(--background-color);*/
        /*    color: var(--text-color);*/
        /*}*/

        /*.product-div {*/
        /*    background-color: #ffff!important;*/
        /*}*/
        /*[data-theme="dark"] .main-color{*/
        /*    color: var(--text-color)!important;*/
        /*}*/
        /*!*[data-theme="dark"] .text-color{*!*/
        /*!*    color: var(--text-color)!important;*!*/
        /*!*}*!*/
        /*[data-theme="dark"] .main-color-border{*/
        /*    border: var(--border-color);*/
        /*}*/
        [data-theme="dark"] .course_banner{
            background-color: transparent!important;
            filter: invert(1) hue-rotate(180deg);

        }
        /*[data-theme="dark"] .sc-8a38d207-0, [data-theme="dark"] .sc-f43f071d-0{*/
        /*    background: var(--background-color)!important;*/
        /*}*/
        /*[data-theme="dark"] span p {*/
        /*    color: var(--text-color)!important;*/
        /*}*/
        /*[data-theme="dark"] .the-product.details .course-content h3, .the-product.details .course-content h4 {*/
        /*    color: var(--text-color)!important;*/
        /*}*/
        /*[data-theme="dark"] .course-content p {*/
        /*    color: #ababab!important;*/
        /*}*/
        /*[data-theme="dark"] .course-content .btn-xl {*/
        /*    background-color: #ffffff00!important;*/
        /*    color: #ffffff!important;*/
        /*}*/

        @media (min-width: 1200px){
            .container {
                max-width: 92%;
            }
        }
        /*.top-banner{*/
        /*    padding-top: 0;*/
        /*}*/
        .navbar{
            border-top-width: 0px;
        }
        a {
            color: var(--link-color);
        }

        /* Add to your CSS file */
        .cart-icon {
            height: 30px;
            position: relative;
            display: inline-flex;
            align-items: center;
        }

        #cart-item-count {
            background-color: #4f198d;
            color: white;
            border-radius: 50%;
            padding: 0 3px;
            margin-left: 5px;
            font-size: 12px;
            position: absolute;
            right: 0;
            height: 20px;
            width: 20px;
            top: -10px;
            font: -webkit-small-control;
            display: flex;
    justify-content: center;
    align-items: center;

        }
        @media(max-width: 800px) {
            .b24-widget-button-position-bottom-right {
                right: 50px;
                bottom: 9px !important;
            }
        }

        .b24-widget-button-position-bottom-right {
            right: 20px !important;
        }

        body{
            font-family: "Poppins", Arial, sans-serif;
            font-family: "Poppins", Arial, sans-serif;
            font-size: 16px;
            line-height: 1.8;
            font-weight: normal;
            background: #fafafa;
            color: #666;
        }

        .text-white {
            color: #fff !important;
            text-align: center;
        }

    </style>
</head>

<body class="home" data-scroll-animation="true" class="{{config('layout_type')}}">
<div class="page-shadow"></div>

<!-- link whatsapp -->
{{-- whatsaap lnk --}}
    @if(request()->url() != url('/contact'))
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/font-awesome/4.5.0/css/font-awesome.min.css">
    <!-- <a href="https://api.whatsapp.com/message/KXHDE3ZAYCOZC1" class="float" target="_blank">
    <i class="fa fa-whatsapp my-float"></i>
    </a> -->

    <a href="{{url('/contact')}}">
        <img style="width: 48px;
    height: auto;
    position: fixed;
    bottom: 32px;
    right: 17px;
    z-index: 1111;
    border-radius: 100%;
    background: #fff" class="chat-icon" src="https://image.winudf.com/v2/image1/eHl6LnRoZXRvb2xzLmNhbGxyZWNvcmRlcl9pY29uXzE1OTI2MjIwODlfMDQ2/icon.webp?w=140&fakeurl=1&type=.webp"
             width="100%" alt="contact support">
    </a>
    @else
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/font-awesome/4.5.0/css/font-awesome.min.css">
    <div id="chat-icon" class="position-fixed b24-widget-button-position-bottom-right">
        <!-- You can customize the icon and its behavior as needed -->
        <button class="btn btn-primary" onclick="openChat()">
            <i class="fas fa-comment"></i>
        </button>
    </div>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/js/all.min.js" integrity="sha384-ZoHpQkP2iwjeOJO+woR1D8tR0x5oFU7EqhlzE5Mdz5VLUn2vk0u7M/xeoNVV4Mnh" crossorigin="anonymous"></script>
    <!-- Your custom JS -->



    <script>
        // Adding the provided JavaScript snippet
        (function(w, d, u) {
            var s = d.createElement('script');
            s.async = true;
            s.src = u + '?' + (Date.now() / 60000 | 0);
            var h = d.getElementsByTagName('script')[0];
            h.parentNode.insertBefore(s, h);
        })(window, document, 'https://cdn.bitrix24.com/b13599703/crm/site_button/loader_3_0f75a3.js');
    </script>
    @endif
    <!--==========Preloader==========-->
    <div id="loading">
        <div id="loading-center" >
            <div id="loading-center-absolute">
                <div class="object" id="object_four"></div>
                <div class="object" id="object_three"></div>
                <div class="object" id="object_two"></div>
                <div class="object" id="object_one"></div>
            </div>
        </div>
    </div>
    <script>
    // Display loading animation after 3 seconds
    setTimeout(function() {
        document.getElementById('loading').style.display = 'none';
        // document.getElementById('loading-center').style.display = 'none';
    }, 3000); // 3000 milliseconds = 3 seconds
</script>

    <!--==========Header==========-->
    <header class="row" id="header">
        <nav class="navbar navbar-default navbar-fixed-top">


            <!--========== /.container-fluid ==========-->
            <div class="container">
                <!--========== Brand and toggle get grouped for better mobile display ==========-->
                <div class="navbar-header">
                    @if(session('locale') == 'ar')
                        @if(config('primary_logo_ar_image') != "")
                            <a class="navbar-brand" href="/"><img src="{{asset('storage/logos/'.config
                            ('primary_logo_ar_image'))}}" alt="logo" /></a>
                        @endif
                    @else
                        @if(config('primary_logo_en_image') != "")
                            <a class="navbar-brand" href="/"><img src="{{asset('storage/logos/'.config('primary_logo_en_image'))}}" alt="logo" /></a>
                        @endif
                    @endif
                    <button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#main-navbar" aria-expanded="false">
                        <span class="sr-only">Toggle navigation</span>
                        <span class="icon-bar"></span>
                        <span class="icon-bar"></span>
                        <span class="icon-bar"></span>
                    </button>
                </div>

                <!--========== Collect the nav links, forms, and other content for toggling ==========-->
                <div class="collapse navbar-collapse" id="main-navbar">

                    <a href="#" class="btn btn-view pull-right cart-icon btn-open-cart" id="cart-item-count-container">
                        <i class="fa fa-shopping-cart"></i>
                        @php
                            if(auth()->check()){
                                $cart_items = Cart::session(auth()->user()->id)->getContent();
                            }
                            else{
                                $cart_items = Cart::session('guest')->getContent();
                            }
                        @endphp
                        @if($cart_items->count() > 0)
                            <span id="cart-item-count">{{ $cart_items->count() }}</span>
                        @endif
                    </a>

                    @foreach($locales as $lang)
                        @if($lang != app()->getLocale())
                        <a href="{{ '/lang/'.$lang }}" class=" btn btn-view pull-right">
                            @lang('menus.language-picker.langs.'.$lang)
                        </a>
                        @endif
                    @endforeach

                    @if(auth()->check())
                    <ul class="nav navbar-nav btn btn-view pull-right" style="float: left;margin-right:10px ">
                        <li class="dropdown">
                            <a href="#" class="dropdown-toggle" data-toggle="dropdown" style="line-height: 32px">
                                @if (session('locale') == 'ar')
                                    {{ $logged_in_user->name_ar . ' ' . $logged_in_user->last_name_ar}}
                                @else
                                    {{$logged_in_user->first_name . ' ' . $logged_in_user->last_name}}
                                @endif
                                <span class="caret"></span>
                            </a>
                            <ul class="dropdown-menu">
                                <li><a href="{{ route('admin.dashboard') }}">@lang('labels.backend.dashboard.my_courses')</a></li>
                                <li><a href="{{ route('admin.account') }}">@lang('navs.general.profile')</a></li>
                                <li><a href="{{ route('admin.certificates.index') }}">@lang('navs.general.certificates')</a></li>
                                <li class="divider"></li>
                                <li><a href="{{ route('frontend.auth.logout') }}">@lang('navs.general.logout')</a></li>
                            </ul>
                        </li>
                    </ul>
                    @else
                    <a href="/login" class=" btn btn-default pull-right">
                        @lang('navs.general.login')
                    </a>
                    @endif

                    <a href="/courses" class="btn btn-view pull-right ">
                        @lang('navs.general.browse-courses')
                    </a>

                    <a href="#" class="btn btn-view pull-right" id="theme-toggle">
                        <i class="fa fa-moon-o"></i>
                    </a>

                    <ul class="nav navbar-nav navbar-right">
                        <li><a href="https://ivorytraining.com"> @lang('custom-menu.nav-menu.about-us') </a></li>
                        <li class="dropdown">
                            <a href="#" class="dropdown-toggle pages-menu" data-toggle="dropdown"> @lang('custom-menu.nav-menu.policy-guide') <span class="caret"></span></a>
                            <ul class="dropdown-menu">
                                @php
                                    $pages = Page::where('published', 1)->get();
                                @endphp
                                @foreach($pages as $page)
                                    @if(!$page->is_footer)
                                        <li><a href="/page/{{$page->slug}}">{{(app()->getLocale() == 'ar') ? $page->title : $page->title_en}}</a></li>
                                    @endif
                                @endforeach
                                <li><a href="/AcademicIntegrity"> @lang('custom-menu.nav-menu.academic-integrity')</a></li>
                                <li><a href="/commonQuestions"> @lang('custom-menu.nav-menu.common-questions')</a></li>
                                <li class="divider"></li>
                                <li><a href="/termsConditions"> @lang('custom-menu.nav-menu.terms-conditions')</a></li>
                                <li><a href="/complainments"> @lang('custom-menu.nav-menu.complainments')</a></li>
                                <li><a href="/returnPolicy"> @lang('custom-menu.nav-menu.return_policy')</a></li>

                            </ul>
                        </li>
                        <li class="dropdown">
                            <a href="#" class="dropdown-toggle pages-menu" data-toggle="dropdown"> @lang('custom-menu.nav-menu.technical-support') <span class="caret"></span></a>
                            <ul class="dropdown-menu ">
                                <li><a href="/technicalSpecifications"> @lang('custom-menu.nav-menu.technical-specifications')</a></li>
                                <li><a href="/technicalSupport"> @lang('custom-menu.nav-menu.technical-support')</a></li>
                                <li><a href="{{ route('tickets.index') }}"> @lang('labels.frontend.tickets.title')
                                    </a></li>
                            </ul>
                        </li>
                        <li><a href="https://ivorytraining.com/training-plans"> @lang('navs.general.training-plan') </a></li>
                        <li><a href="{{ route('blogs.index') }}"> @lang('labels.frontend.layouts.blog.title') </a></li>
                        <!-- <li><a href="/all_achievements/all"> @lang('navs.general.achievements')  </a></li> -->

                        {{-- <li><a href="/contact"> @lang('navs.general.contact-us') </a></li> --}}
                    </ul>
                </div>
                <!--========== /.navbar-collapse ==========-->
            </div>
            <!--========== /.container-fluid ==========-->
        </nav>
        <div class="top-banner"></div>
    </header>

    @include('frontend.cart.side')

    @yield('content')

    @include('cookieConsent::index')


    <script>
        const toggleButton = document.getElementById('theme-toggle');
        const currentTheme = localStorage.getItem('theme') || 'light';

        document.documentElement.setAttribute('data-theme', currentTheme);

        toggleButton.addEventListener('click', () => {
            console.log(document.documentElement.getAttribute('data-theme'));
            const newTheme = document.documentElement.getAttribute('data-theme') === 'light' ? 'dark' : 'light';
            document.documentElement.setAttribute('data-theme', newTheme);
            localStorage.setItem('theme', newTheme);
            //change icon
            if (newTheme === 'dark') {
                toggleButton.innerHTML = '<i class="fa fa-cloud-sun"></i>';
            } else {
                toggleButton.innerHTML = '<i class="fa fa-moon-o"></i>';
            }
        });
    </script>
    @include('frontend.layouts.partials.footer')
    <footer>
        {{-- config Pixel Code --}}
        {{-- config Pixel Code --}}
    </footer>
    @yield('course-pixel_code_footer')

    @yield('course-footer')
    <!--========== Javascript Files ==========-->

    <!-- jQuery Latest -->
    <script src="{{ asset('iv') }}/js/lib/jquery-2.2.0.min.js"></script>

    <!-- Bootstrap JS -->
    <script src="{{ asset('iv') }}/js/lib/bootstrap.min.js"></script>

    <!-- Plugins -->
    <script src="{{ asset('iv') }}/vendors/owl-carousel/owl.carousel.js"></script>
    <script src="{{ asset('iv') }}/vendors/magnific-popup/jquery.magnific-popup.min.js"></script>
    <script src="{{ asset('iv') }}/vendors/bootstrap-touchspin/jquery.bootstrap-touchspin.min.js"></script>
    <script src="{{ asset('iv') }}/vendors/bootstrap-select/js/bootstrap-select.min.js"></script>
    <script src="https://maps.googleapis.com/maps/api/js"></script>
    <script src="{{ asset('iv') }}/js/plugins/gmaps.min.js"></script>
    <script src="{{ asset('iv') }}/js/plugins/google-map.js"></script>
    <script src="{{ asset('iv') }}/js/plugins/wow.min.js"></script>
    <script src="{{ asset('iv') }}/js/plugins/validate.js"></script>
    <!-- Includes -->
    {{-- <script src="{{ asset('iv') }}/js/includes/pre-order.js"></script>
    <script src="{{ asset('iv') }}/js/includes/subscribe.js"></script>
    <script src="{{ asset('iv') }}/js/includes/contact.js"></script> --}}

    <!-- Main JS -->
    <script src="{{ asset('iv') }}/js/main.js"></script>
    <script src="{{asset('assets/js/switch.js')}}"></script>

    <script src="{{ asset('iv') }}/assets/vendors/highlight.js"></script>
    <script src="{{ asset('iv') }}/assets/js/app.js"></script>
    <script src="{{ asset('vendor/tinymce/tinymce.min.js') }}" referrerpolicy="origin"></script>
    {{-- twilio phone international code --}}

    <script src="https://cdnjs.cloudflare.com/ajax/libs/intl-tel-input/17.0.8/js/intlTelInput.min.js"></script>
    {{-- /////// --}}

    <script>
        tinymce.init({
            selector: '.editor',
            language: 'en',
            directionality: 'ltr',
            setup: function(editor) {
                editor.on('change', function() {
                    editor.save();
                });
            },
            plugins: "link image code table lists contextmenu",
            contextmenu: "paste | link ",
            menubar: true,
            a11y_advanced_options: true,
            relative_urls: false,
            image_dimensions: true,
            document_base_url: 'https://ucas.e-9.co',
            content_style: "@import  url('https://fonts.googleapis.com/css2?family=Tajawal:wght@200;300;400;500;700;800;900&display=swap');",
            font_formats: "Tajawal=Tajawal,times; Arial=arial,helvetica,sans-serif; Arial Black=arial black;  Comic Sans MS=comic sans ms,sans-serif; Courier New=courier new,courier; Georgia=georgia,palatino; Helvetica=helvetica;Tahoma=tahoma,arial,helvetica,sans-serif;Times New Roman=times new roman,times",
            toolbar: 'code | bold italic | alignleft aligncenter alignright alignjustify link | table | styleselect | fontselect  forecolor  backcolor fontsizeselect  | image | outdent indent|numlist bullist',

            image_title: false,
            automatic_uploads: true,

            file_picker_types: 'image',
            /* and here's our custom image picker*/
            images_upload_handler: function(blobInfo, success, failure) {
                var xhr, formData;
                xhr = new XMLHttpRequest();
                xhr.withCredentials = false;
                xhr.open('POST', '/user/upload-image');
                var token = '{{ csrf_token() }}';
                xhr.setRequestHeader("X-CSRF-Token", token);
                xhr.onload = function() {
                    var json;
                    if (xhr.status != 200) {
                        failure('HTTP Error: ' + xhr.status);
                        return;
                    }
                    json = JSON.parse(xhr.responseText);

                    if (!json || typeof json.location != 'string') {
                        failure('Invalid JSON: ' + xhr.responseText);
                        return;
                    }
                    success(json.location);
                };
                formData = new FormData();
                formData.append('file', blobInfo.blob(), blobInfo.filename());
                xhr.send(formData);
            },
        });

        tinymce.init({
            selector: '.editor_ar',
            language: 'ar',
            directionality: 'rtl',
            setup: function(editor) {
                editor.on('change', function() {
                    editor.save();
                });
            },
            plugins: "link image code table lists  contextmenu",
            contextmenu: "paste | link ",
            menubar: true,
            a11y_advanced_options: true,
            relative_urls: false,
            image_dimensions: true,
            document_base_url: 'https://ucas.e-9.co',
            content_style: "@import  url('https://fonts.googleapis.com/css2?family=Tajawal:wght@200;300;400;500;700;800;900&display=swap');",
            font_formats: "Tajawal=Tajawal,times; Arial=arial,helvetica,sans-serif; Arial Black=arial black;  Comic Sans MS=comic sans ms,sans-serif; Courier New=courier new,courier; Georgia=georgia,palatino; Helvetica=helvetica;Tahoma=tahoma,arial,helvetica,sans-serif;Times New Roman=times new roman,times",
            toolbar: 'code | bold italic | alignleft aligncenter alignright alignjustify link | table | styleselect | fontselect  forecolor  backcolor fontsizeselect  | image | outdent indent|numlist bullist',
            image_title: false,
            automatic_uploads: true,

            file_picker_types: 'image',
            /* and here's our custom image picker*/
            images_upload_handler: function(blobInfo, success, failure) {
                var xhr, formData;
                xhr = new XMLHttpRequest();
                xhr.withCredentials = false;
                xhr.open('POST', '/user/upload-image');
                var token = '{{ csrf_token() }}';
                xhr.setRequestHeader("X-CSRF-Token", token);
                xhr.onload = function() {
                    var json;
                    if (xhr.status != 200) {
                        failure('HTTP Error: ' + xhr.status);
                        return;
                    }
                    json = JSON.parse(xhr.responseText);

                    if (!json || typeof json.location != 'string') {
                        failure('Invalid JSON: ' + xhr.responseText);
                        return;
                    }
                    success(json.location);
                };
                formData = new FormData();
                formData.append('file', blobInfo.blob(), blobInfo.filename());
                xhr.send(formData);
            },
        });
    </script>
<script>

    var font_color = "{{config('font_color')}}";
    setActiveStyleSheet(font_color);
</script>

    @stack('after-scripts')
    @stack('country-dropdown')


</body>

</html>