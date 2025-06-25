<!DOCTYPE html>
@langrtl
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}" dir="rtl">
@else
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
@endlangrtl

<head>
    @php
    header("Access-Control-Allow-Origin: *");
   @endphp
    <meta charset="utf-8" />
    <meta http-equiv="X-UA-Compatible" content="IE=edge" />
    <meta name="viewport" content="width=device-width, initial-scale=1" />
    <meta name="csrf-token" content="{{ csrf_token() }}">
    @if(config('favicon_image') != "")
        <link rel="shortcut icon" type="image/x-icon" href="{{asset('storage/logos/'.config('favicon_image'))}}"/>
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
    <link
        href="https://fonts.googleapis.com/css2?family=Noto+Kufi+Arabic:wght@100;200;300;400;500;600;700;800&display=swap"
        rel="stylesheet" />

    <!-- CSS Plugin Files -->
    <link href="{{ asset('iv') }}/css/lib/bootstrap.min.css" rel="stylesheet" />
    <link href="{{ asset('iv') }}/css/plugins/font-awesome.min.css" rel="stylesheet" />
    <link href="{{ asset('iv') }}/css/plugins/lineicons.css" rel="stylesheet" />
    <link href="{{ asset('iv') }}/vendors/magnific-popup/magnific-popup.css" rel="stylesheet" />
    <link href="{{ asset('iv') }}/vendors/bootstrap-touchspin/jquery.bootstrap-touchspin.min.css" rel="stylesheet" />
    <link href="{{ asset('iv') }}/vendors/bootstrap-select/css/bootstrap-select.min.css" rel="stylesheet" />
    <link href="{{ asset('iv') }}/vendors/owl-carousel/assets/owl.carousel.css" rel="stylesheet" />
    <link href="{{ asset('iv') }}/css/plugins/animate.css" rel="stylesheet" />
    <link rel="stylesheet" href="https://pro.fontawesome.com/releases/v5.10.0/css/all.css" integrity="sha384-AYmEC3Yw5cVb3ZcuHtOA93w35dYTsvhLPVnYs9eStHfGJvOvKxVfELGroGkvsg+p" crossorigin="anonymous"/>

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
    <link
     rel="stylesheet"
     href="https://cdnjs.cloudflare.com/ajax/libs/intl-tel-input/17.0.8/css/intlTelInput.css"
   />
   {{-- twilio phone international code --}}

<script src="https://cdnjs.cloudflare.com/ajax/libs/intl-tel-input/17.0.8/js/intlTelInput.min.js"></script>
{{-- /////// --}}

<script>
    
    setTimeout(() => {
        const phoneInputField = document.querySelector("#phone");
    
    const phoneInput = window.intlTelInput(phoneInputField, {
      utilsScript:
        "https://cdnjs.cloudflare.com/ajax/libs/intl-tel-input/17.0.8/js/utils.js",
    });
   
    const phoneNumber = phoneInput.getNumber();
   $('#phone').on('change',()=>{
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
   $('#iti-0__country-listbox').on('change',()=>{
    const phoneNumber = phoneInput.getNumber();
   
    $('#phone').val(phoneNumber);
console.log(phoneNumber);
   })
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
        .container-fluid {
            padding-left: 81px;
            padding-right: 93px;
        }
        #main-navbarr {
                padding-top: 8px;
                transition: all 300ms linear 0s;
            }
        #main-navbarr .nav {
                 /* margin-right: 0; */
                 padding-right: 8px;
        }
        #main-navbarr .nav li a {
            padding: 0 14px;
            text-transform: uppercase;
            font: 500 15px/40px "Noto Kufi Arabic", sans-serif;
}
.navbarr .btn-view {
    border-radius: 0px;
    
}
#nav_a{
    
    background-color: #4f198d;
    color: white;
}
#main-navbarr .nav li a.btn {
    color: white;
    border-radius: 0px;

}
        /* ******************** */
         .mediaLnkCourseFooter:hover{
        color: #4f198d;
    }
        .float{
        position:fixed;
        width:60px;
        height:60px;
        bottom:40px;
        right:40px;
        background-color:#25d366;
        color:#FFF;
        border-radius:50px;
        text-align:center;
      font-size:30px;
        box-shadow: 2px 2px 3px #999;
      z-index:100;
    }
    
    .my-float{
        margin-top:16px;
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
        function gtag(){dataLayer.push(arguments);}
        gtag('js', new Date());

        gtag('config', '{{config('google_analytics_id')}}');
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
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/font-awesome/4.5.0/css/font-awesome.min.css">
    <a href="https://api.whatsapp.com/message/KXHDE3ZAYCOZC1" class="float" target="_blank">
    <i class="fa fa-whatsapp my-float"></i>
    </a>
{{-- whatsaap lnk --}}
@stack('after-scripts2')
</head>

<body class="home" data-scroll-animation="true"    class="{{config('layout_type')}}">
    <!--==========Preloader==========-->
    <div id="loading">
        <div id="loading-center">
            <div id="loading-center-absolute">
                <div class="object" id="object_four"></div>
                <div class="object" id="object_three"></div>
                <div class="object" id="object_two"></div>
                <div class="object" id="object_one"></div>
            </div>
        </div>
    </div> 

    <!--==========Header==========-->
    <header class="row" id="header">
        <nav class="navbar navbar-default navbar-fixed-top">
            

            <!--========== /.container-fluid ==========-->  
            <div class="container-fluid">
                <!--========== Brand and toggle get grouped for better mobile display ==========-->
                <div class="navbar-header">
                    @if(session('locale') == 'ar')
                        <a class="navbar-brand" href="/"><img src="{{ asset('iv') }}/images/logo-ar.png" alt="" /></a>
                    @else
                        <a class="navbar-brand" href="/"><img src="{{ asset('iv') }}/images/logo-en.png" alt="" /></a>
                    @endif
                    <button type="button" class="navbar-toggle collapsed" data-toggle="collapse"
                        data-target="#main-navbarr" aria-expanded="false">
                        <span class="sr-only">Toggle navigation</span>
                        <span class="icon-bar"></span>
                        <span class="icon-bar"></span>
                        <span class="icon-bar"></span>
                    </button>
                </div>

                <!--========== Collect the nav links, forms, and other content for toggling ==========-->
                <div class="collapse navbar-collapse " id="main-navbarr">
                   <div class="container">
                   
                

                                <ul class="nav navbar-nav navbar-right">
                                    <li><a href="https://ivorytraining.com"> @lang('custom-menu.nav-menu.about-us') </a></li>
                                    <li class="dropdown">
                                        <a href="#" class="dropdown-toggle pages-menu" data-toggle="dropdown"> @lang('custom-menu.nav-menu.policy-guide')  <span class="caret"></span></a>
                                        <ul class="dropdown-menu">
                                            <li><a href="/AcademicIntegrity"> @lang('custom-menu.nav-menu.academic-integrity')</a></li>
                                            <li><a href="/commonQuestions"> @lang('custom-menu.nav-menu.common-questions')</a></li>
                                            <li class="divider"></li>
                                            <li><a href="/termsConditions"> @lang('custom-menu.nav-menu.terms-conditions')</a></li>
                                            <li><a href="/complainments"> @lang('custom-menu.nav-menu.complainments')</a></li>
                                            <li><a href="/returnPolicy"> @lang('custom-menu.nav-menu.return_policy')</a></li>
                                        
                                        </ul>
                                    </li>
                                    <li class="dropdown">
                                        <a href="#" class="dropdown-toggle pages-menu" data-toggle="dropdown"> @lang('custom-menu.nav-menu.technical-support')  <span class="caret"></span></a>
                                        <ul class="dropdown-menu ">
                                            <li><a href="/technicalSpecifications"> @lang('custom-menu.nav-menu.technical-specifications')</a></li>
                                            <li><a href="/technicalSupport"> @lang('custom-menu.nav-menu.technical-support')</a></li>
                                        </ul>
                                    </li>
                                    <li><a href="https://ivorytraining.com/training-plans"> @lang('navs.general.training-plan')  </a></li>
                                    <!-- <li><a href="/all_achievements/all"> @lang('navs.general.achievements')  </a></li> -->
                                
                                    {{-- <li><a href="/contact"> @lang('navs.general.contact-us') </a></li> --}}
                                </ul>
                                <ul class="nav navbar-nav nav2" >
                                <li>
                                    <a href="/courses" id="nav_a" class="btn btn-view pull-right ">
                                                    @lang('navs.general.browse-courses')
                                                </a>
                                    </li>
                                   
                                    <li>
                                        @if(auth()->check())
                                            
                                            <ul class="nav navbar-nav btn btn-view pull-right" style="float: left;margin-right:10px;margin-right: 10px;border: 1px solid #4f198d; background-color: white; border-radius: 0px;">
                                                <li class="dropdown">
                                                    <a href="#" class="dropdown-toggle" data-toggle="dropdown" style="line-height: 39px;color: #4f198d;">  {{ $logged_in_user->name }}  <span class="caret"></span></a>
                                                    <ul class="dropdown-menu">
                                                        <li><a href="{{ route('admin.dashboard') }}" >@lang('labels.backend.dashboard.my_courses')</a></li>
                                                        <li><a href="{{ route('admin.account') }}">@lang('navs.general.profile')</a></li>
                                                        <li><a href="{{ route('admin.certificates.index') }}">@lang('navs.general.certificates')</a></li>
                                                        <li class="divider"></li>
                                                        <li><a href="{{ route('frontend.auth.logout') }}">@lang('navs.general.logout')</a></li>
                                                    </ul>
                                                </li>
                                            </ul>
                                            @else
                                            <a href="/login" class=" btn btn-default pull-right" style="color: #4f198d;border: 1px solid #4f198d;">
                                                @lang('navs.general.login')
                                            </a>
                                            @endif
                                    </li>
                                    <li>
                                        @foreach($locales as $lang)
                                                    @if($lang != app()->getLocale())
                                                        <a href="{{ '/lang/'.$lang }}" id="nav_a"class=" btn btn-view pull-right">
                                                            @lang('menus.language-picker.langs.'.$lang)
                                                        </a>
                                                    @endif
                                                @endforeach
                                                
                                    </li>
                            </ul>                    
          
                    </div>
                </div>
                <!--========== /.navbar-collapse ==========-->
            </div>
            <!--========== /.container-fluid ==========-->
        </nav>
        <div class="top-banner"></div>
        <!-- ************* -->

        <!-- ************** -->
    </header>


   
    @yield('content')
    
    @include('cookieConsent::index')


    @include('frontend.layouts.partials.footernew')
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

    <script src="{{ asset('iv') }}/assets/vendors/highlight.js"></script>
    <script src="{{ asset('iv') }}/assets/js/app.js"></script>
   
    @stack('after-scripts')
    @stack('country-dropdown')

    
</body>

</html>
