<!DOCTYPE html>
@if(app()->getLocale() == 'ar')
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}" dir="rtl">
@else
    <html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    @endif
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1, minimum-scale=1, maximum-scale=1">
        <meta name="csrf-token" content="{{ csrf_token() }}">
        @if(config('favicon_image') != "")
            <link rel="shortcut icon" type="image/x-icon" href="{{asset('storage/logos/'.config('favicon_image'))}}"/>
        @endif
        <title>@yield('title', app_name())</title>
        <meta name="description" content="@yield('meta_description', '')">
        <meta name="keywords" content="@yield('meta_keywords', '')">
        {{-- See https://laravel.com/docs/5.5/blade#stacks for usage --}}
        @stack('before-styles')
        <link rel="shortcut icon" href="{{asset('ivory')}}/assets/img/logo/square.png">
        <link rel="stylesheet" href="{{asset('ivory')}}/assets/css/normalize.css">
        <link rel="preconnect" href="https://fonts.gstatic.com">
        <link href="https://fonts.googleapis.com/css2?family=Cairo:wght@200;300;400;600;700;900&family=Montserrat:ital,wght@0,100;0,200;0,300;0,400;0,500;0,600;0,700;0,800;0,900;1,100;1,200;1,300;1,400;1,500;1,600;1,700;1,800;1,900&family=Open+Sans:ital,wght@0,300;0,400;0,600;0,700;0,800;1,300;1,400;1,600;1,700;1,800&display=swap" rel="stylesheet">
        <link rel="stylesheet" href="{{asset('ivory')}}/assets/css/all.min.css">
        <link rel="stylesheet" href="{{asset('ivory')}}/assets/css/bootstrap.min.css">
        @if(app()->getLocale() == 'ar')
            <link rel="stylesheet" href="{{asset('ivory')}}/assets/css/bootstrap.min-rtl.css">
        @endif
        <link rel="stylesheet" href="{{asset('ivory')}}/assets/css/bootstrap.min-rtl.css">

        
        <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/animate.css/4.1.1/animate.min.css">
        <link rel="stylesheet" href="{{asset('ivory')}}/assets/css/swiper.css">
        <link rel="stylesheet" href="{{asset('ivory')}}/assets/css/owl.carousel.min.css">
        <link rel="stylesheet" href="{{asset('ivory')}}/assets/css/framework.css">
        <link rel="stylesheet" href="{{asset('ivory')}}/assets/css/style.css">
        @if(app()->getLocale() == 'ar')
            <link rel="stylesheet" href="{{asset('ivory')}}/assets/css/style-rtl.css">
        @else
        <style>
            header .header-top .navbar .menu-list .menu-links ul .list-item ul li a{
                text-align: left
            }
        </style>
        @endif
        
        @yield('css')
        @stack('after-styles')

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
        <script type="text/javascript">
            var Tawk_API=Tawk_API||{}, Tawk_LoadStart=new Date();
            (function(){
            var s1=document.createElement("script"),s0=document.getElementsByTagName("script")[0];
            s1.async=true;
            s1.src='https://embed.tawk.to/619530e16885f60a50bc45ac/1fkncdsdr';
            s1.charset='UTF-8';
            s1.setAttribute('crossorigin','*');
            s0.parentNode.insertBefore(s1,s0);
            })();
            </script>
            <!--End of Tawk.to Script-->
    </head>
    <body  class="{{config('layout_type')}}">
        @php
            $footer_data = json_decode(config('footer_data'));
        @endphp
        @include('frontend.layouts.modals.loginModal')

        <div class="wrapper-page">
            
            <main class="">
    
                <!--  Header  -->
                
             
                <header>
                    <div class="header-top">
                        <div class="navbar">
                            <div class="container-fluid">
                                @if(count($locales) > 1)
                                <div class="lang">
                                    <div class="lang-current">
                                        @lang('menus.language-picker.langs.'.strtolower(app()->getLocale())) <i class="fas fa-chevron-down"></i>
                                    </div>
                                    <div class="lang-want">
                                        <ul class="list-unstyled">
                                            @foreach($locales as $lang)
                                                @if($lang != app()->getLocale())
                                                    <li>
                                                        <a href="{{ '/lang/'.$lang }}" class=""> @lang('menus.language-picker.langs.'.$lang)</a>
                                                    </li>
                                                @endif
                                            @endforeach
                                            
                                        </ul>
                                    </div>
                                </div>
                                @endif
                                <div class="menu-list pull-left d-flex">
                                   
                                    <div class="menu-links">
                                        <ul class="list-unstyled mb-0 d-flex web-links">
                                            {{-- @if(count($custom_menus) > 0 )
                                                @foreach($custom_menus as $menu) --}}
                                                {{-- old comments--}}
                                                    {{--@if(is_array($menu['id']) && $menu['id'] == $menu['parent'])--}}
                                                        {{--@if($menu->subs && (count($menu->subs) > 0))--}}
                                                  {{-- old comments --}}
                                                        {{-- @if($menu['id'] == $menu['parent'])
                                                        @if(count($menu->subs) == 0)
                                                            <li class="list-item">
                                                                <a href="{{asset($menu->link)}}"
                                                                class="list-link {{ active_class(Active::checkRoute('frontend.user.dashboard')) }}"
                                                                id="menu-{{$menu->id}}">{{trans('custom-menu.'.$menu_name.'.'.str_slug($menu->label))}}</a>
                                                            </li>

                                                        @else
                                                        
                                                            <li class="list-item">
                                                                <a href="#!" class="list-link">{{trans('custom-menu.'.$menu_name.'.'.str_slug($menu->label))}}</a>
                                                                <ul class="list-unstyled mb-0">
                                                                    @foreach($menu->subs as $item)
                                                                        @include('frontend.layouts.partials.dropdown', $item)
                                                                    @endforeach
                                                                </ul>
                                                            </li>
                                                        @endif
                                                    @endif
                                                @endforeach
                                            @endif      --}}
                                            <li class="list-item">
                                                <a href="{{asset('about-us')}}"
                                                class="list-link {{ active_class(Active::checkRoute('frontend.user.dashboard')) }}"
                                                id="menu-1">
                                                {{trans('custom-menu.nav-menu.about-us')}}
                                            </a>
                                            </li>  
                                            {{-- policy --}}
                                            <li class="list-item">
                                                <a href="#!" class="list-link">{{trans('custom-menu.nav-menu.policy')}}</a>
                                                <ul class="list-unstyled mb-0">
                                                    <li class="list-item">
                                                        <a href="{{asset('AcademicIntegrity')}}"
                                                        class="list-link {{ active_class(Active::checkRoute('frontend.user.dashboard')) }}"
                                                        id="menu-2">
                                                        {{trans('custom-menu.nav-menu.academic-integrity')}}
                                                    </a>
                                                    </li> 
                                                    <li class="list-item">
                                                        <a href="{{asset('commonQuestions')}}"
                                                        class="list-link {{ active_class(Active::checkRoute('frontend.user.dashboard')) }}"
                                                        id="menu-3">
                                                        {{trans('custom-menu.nav-menu.common-questions')}}
                                                    </a>
                                                    </li> 
                                                    <li class="list-item">
                                                        <a href="{{asset('termsConditions')}}"
                                                        class="list-link {{ active_class(Active::checkRoute('frontend.user.dashboard')) }}"
                                                        id="menu-4">
                                                        {{trans('custom-menu.nav-menu.terms-conditions')}}
                                                    </a>
                                                    </li> 
                                                    <li class="list-item">
                                                        <a href="{{asset('complainments')}}"
                                                        class="list-link {{ active_class(Active::checkRoute('frontend.user.dashboard')) }}"
                                                        id="menu-3">
                                                        {{trans('custom-menu.nav-menu.complainments')}}
                                                    </a>
                                                    </li> 
                                                </ul>
                                            </li>
                                            {{-- techinicalsupport --}}
                                            <li class="list-item">
                                                <a href="#!" class="list-link">{{trans('custom-menu.nav-menu.technical-support')}}</a>
                                                <ul class="list-unstyled mb-0">
                                                    <li class="list-item">
                                                        <a href="{{asset('technicalSpecifications')}}"
                                                        class="list-link {{ active_class(Active::checkRoute('frontend.user.dashboard')) }}"
                                                        id="menu-5">
                                                        {{trans('custom-menu.nav-menu.technical-specifications')}}
                                                    </a>
                                                    </li> 
                                                    <li class="list-item">
                                                        <a href="{{asset('technicalSupport')}}"
                                                        class="list-link {{ active_class(Active::checkRoute('frontend.user.dashboard')) }}"
                                                        id="menu-6">
                                                        {{trans('custom-menu.nav-menu.technical-support')}}
                                                    </a>
                                                    </li> 
                                                   
                                                </ul>
                                            </li>
                                            {{-- plan2021 --}}
                                            <li class="list-item">
                                                <a href="{{asset('plan2021')}}"
                                                class="list-link {{ active_class(Active::checkRoute('frontend.user.dashboard')) }}"
                                                id="menu-7">
                                                {{trans('custom-menu.nav-menu.plan2021')}}
                                            </a>
                                            </li> 
                                             {{-- courses --}}
                                             <li class="list-item">
                                                <a href="{{route('courses.all')}}"
                                                class="list-link {{ active_class(Active::checkRoute('frontend.user.dashboard')) }}"
                                                id="menu-8">
                                                {{trans('custom-menu.nav-menu.courses')}}
                                            </a>
                                            </li> 
                                               {{-- bundles --}}
                                               <li class="list-item">
                                                <a href="{{asset('bundles')}}"
                                                class="list-link {{ active_class(Active::checkRoute('frontend.user.dashboard')) }}"
                                                id="menu-9">
                                                {{trans('custom-menu.nav-menu.bundles')}}
                                            </a>
                                            </li> 
                                             {{-- blog --}}
                                             <li class="list-item">
                                                <a href="{{asset('blog')}}"
                                                class="list-link {{ active_class(Active::checkRoute('frontend.user.dashboard')) }}"
                                                id="menu-10">
                                                {{trans('custom-menu.nav-menu.blog')}}
                                            </a>
                                            </li> 
                                             {{-- forums --}}
                                             <li class="list-item">
                                                <a href="{{asset('forums')}}"
                                                class="list-link {{ active_class(Active::checkRoute('frontend.user.dashboard')) }}"
                                                id="menu-11">
                                                {{trans('custom-menu.nav-menu.forums')}}
                                            </a>
                                            </li>  {{-- contact --}}
                                            <li class="list-item">
                                               <a href="{{asset('contact')}}"
                                               class="list-link {{ active_class(Active::checkRoute('frontend.user.dashboard')) }}"
                                               id="menu-12">
                                               {{trans('custom-menu.nav-menu.contact')}}
                                           </a>
                                           </li> 
                                        </ul>
                                        <ul class="list-unstyled mb-0 mob-links">
                                            <li class="list-item"><a href="#" class="menu-list openpop" data-value="menu">Menu</a></li>
                                        </ul>
                                    </div>
                                    <div class="menu-social">
                                        <ul class="list-unstyled mb-0 d-flex">
                                            @foreach($footer_data->social_links->links as $item)
                                                <li class="item-social">
                                                    <a href="{{$item->link}}" class="link-icon">
                                                        <i class="{{$item->icon}}"></i>
                                                    </a>
                                                </li>
                                             @endforeach
                                        </ul>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="header-bottom pt-20">
                        <div class="container-fluid">
                            <div class="header-bottom-content d-flex">
                                <div class="logo">
                                    <a href="{{url('')}}">
                                        <img src="{{asset('ivory')}}/assets/img/logo/1.png" alt="Logo" class="img-fluid" width="150">
                                    </a>
                                </div>
                                <div class="search-courses d-flex">
                                    <div class="bars">
                                        <span><i class="fas fa-bars"></i></span>
                                        <ul class="list-unstyled">
                                            @foreach($featured_categories as $category)
                                            <li class="list-bar">
                                                <a href="{{route('courses.category',['category'=>$category->slug])}}"> @if(app()->getLocale() == 'ar') {{ $category->name_ar }} @else {{$category->name}}  @endif</a>
                                            </li>
                                            @endforeach
                                        </ul>
                                    </div>
                                    <form action="#">
                                        <input type="text" name="search" id="search-field" placeholder="@lang('navs.frontend.search_courses')">
                                        <button type="submit"><i class="fas fa-search"></i></button>
                                        <div class="found">
                                            <ul class="m-0 list-unstyled">
                                                @foreach($all_courses as $course)
                                                <li >
                                                    <a href="{{ route('courses.show', [$course->slug]) }}" title="@if(app()->getLocale() == 'ar') {{ $course->title_ar }} @else {{$course->title}}  @endif" class="active  search-item">
                                                        <b>
                                                            @if(app()->getLocale() == 'ar') {{ $course->title_ar }} @else {{$course->title}}  @endif
                                                        </b>
                                                    </a>
                                                    {{-- search by arabic in english  --}}
                                                    <a href="{{ route('courses.show', [$course->slug]) }}" title="@if(app()->getLocale() == 'ar') {{ $course->title }} @else {{$course->title_ar}}  @endif" class="active  search-item">
                                                        <b>
                                                            @if(app()->getLocale() == 'ar') {{ $course->title }} @else {{$course->title_ar}}  @endif
                                                        </b>
                                                    </a>
                                                </li>
                                                @endforeach
                                            </ul>
                                        </div>
                                    </form>
                                </div>
                                <div class="login">
                                    <ul class="list-unstyled d-flex web">
                                        
                                                                                       
                                        @if(auth()->check())
                                            <div class="member">                                                     
                                                    <div class="menu-list ml-auto d-flex">
                                                        <div class="menu-links">
                                                            <ul >
                                                                <li class="list-item">
                                                                    <i class="far fa-user"></i> <a href="#" class="list-link">{{ $logged_in_user->name }}</a>
                                                                    <ul >
                                                                        <li class="menu-item-has-children ul-li-block">
                                                                            <a href="{{ route('admin.dashboard') }}">@lang('navs.frontend.dashboard')</a>                                                                             
                                                                        </li>
                                                                        <li class="menu-item-has-children ul-li-block">
                                                                            <a href="{{ route('frontend.auth.logout') }}">@lang('navs.general.logout')</a>                                                                            
                                                                        </li>

                                                                        
                                                                    </ul>
                                                                </li>
                                                                
                                                            </ul>
                                                             
                                                        </div>
                                                         
                                                </div>
                                            </div>
                                    @else
                                        <li>
                                            <div class="log-in mt-0">
                                                <a class="show-login openpop" data-value="model"
                                                href="#"> <i class="far fa-user"></i> @lang('navs.general.login')</a>
                                                {{--@include('frontend.layouts.modals.loginModal')--}}

                                            </div>
                                        </li>
                                    @endif
                                   

                                        
                                        <li class="ml-15"><a href><i class="far fa-heart"></i></a></li>
                                    </ul>
                                    <ul class="list-unstyled d-flex mob">
                                        <li class="ml-15">
                                            <a href class="open-search openpop" data-value="search" href="#">
                                                <i class="fas fa-search"></i>
                                            </a>
                                        </li>
                                        <li class="ml-15">
                                            <a  class="show-login  mob-user  openpop" data-value="model" href="#">
                                                <i class="far fa-user"></i>
                                            </a>
                                        </li>
                                    </ul>
                                </div>
                            </div>
                        </div>
                    </div>
                </header>
    
                <!--  Header  -->
                @if(auth()->user())
                @if(auth()->user()->is_activate==0)
                <div style="margin: 10px 50px 50px 50px" class="alert alert-danger " role="alert">
                    <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                        <span aria-hidden="true">×</span>
                    </button>
                    <div class="error-list">
                        
                        @lang('menus.backend.access.activation_msg')
                        
                        <a style="margin:0 50px" href="{{route('send.activate',[auth()->user()->id,"true"])}}"><i class="fas fa-sync" style="font-size: 10px"></i> @lang('menus.backend.access.activation_resend') </a>
                    </div>
                </div>
                @if(session()->get('flash_danger'))
                        <div class="alert alert-danger" role="alert">
                    <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
            
                    @if(is_array(json_decode(session()->get('flash_danger'), true)))
                        {{ implode('', session()->get('flash_danger')->all(':message<br/>')) }}
                    @else
                        {{ session()->get('flash_danger') }}
                    @endif
                </div>
                @endif

                @if(Session::has('success'))
                    <div style="margin: 10px 50px 50px 50px" class="alert alert-success " role="alert">
                        <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                            <span aria-hidden="true">×</span>
                        </button>
                        <div class="error-list">
                            {{ Session::get('success') }}                                             
                        </div>
                    </div>               
                @endif
                @if(Session::has('error'))
                    <div style="margin: 10px 50px 50px 50px" class="alert alert-danger " role="alert">
                        <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                            <span aria-hidden="true">×</span>
                        </button>
                        <div class="error-list">
                            {{ Session::get('error') }}                                                    
                        </div>
                    </div>
                @endif

                @endif
                @endif
                @yield('content')
                @include('cookieConsent::index')

    
            </main>
    
            @include('frontend.layouts.partials.footer')
            @yield('course-footer')
        </div>

        

        <div class="loading">
            <div class="loading-icon"></div>
        </div>


        <div class="menu">
            <div class="menu-overlay overlay">
                <div class="menu-content content">
                    <div class="menu-head head">
                        <h2>Menu</h2>
                    </div>
                    <div class="menu-body body">
                        <ul class="list-unstyled">
                            @if(count($custom_menus) > 0 )
                                @foreach($custom_menus as $menu)
                                    {{--@if(is_array($menu['id']) && $menu['id'] == $menu['parent'])--}}
                                        {{--@if($menu->subs && (count($menu->subs) > 0))--}}
                                    @if($menu['id'] == $menu['parent'])
                                        @if(count($menu->subs) == 0)
                                            <li class="list-item">
                                                <a href="{{asset($menu->link)}}"
                                                class="list-link {{ active_class(Active::checkRoute('frontend.user.dashboard')) }}"
                                                id="menu-{{$menu->id}}">{{trans('custom-menu.'.$menu_name.'.'.str_slug($menu->label))}}</a>
                                            </li>

                                        @else
                                            <li class="list-item">
                                                <a href="#" class="open-list">{{trans('custom-menu.'.$menu_name.'.'.str_slug($menu->label))}}</a>
                                                <ul class="list-unstyled">
                                                    @foreach($menu->subs as $item)
                                                        @include('frontend.layouts.partials.dropdown', $item)
                                                    @endforeach
                                                </ul>
                                            </li>
                                        @endif
                                    @endif
                                @endforeach
                            @endif      
                        </ul>
                    </div>
                </div>
                <div class="close-popup">
                    <i class="fas fa-times"></i>
                </div>
            </div>
            <div class="close-popup"></div>

        </div>


        <div class="search">
            <div class="overlay search-overlay">
                <div class="content search-content">
                    <div class="head search-head">
                        <h2>Search</h2>
                    </div>
                    <div class="middle search-middle mb-35">
                        <form action="#">
                            <div class="form-group">
                                <input type="text" name="search_text" id="search_text" placeholder="@lang('navs.frontend.search_courses')" class="form-control">
                                <button type="submit"><i class="fas fa-search"></i></button>
                            </div>
                        </form>
                    </div>
                    <div class="body search-body">
                        
                        <ul class="list-unstyled">
                            @if(count($custom_menus) > 0 )
                                @foreach($custom_menus as $menu)
                                    {{--@if(is_array($menu['id']) && $menu['id'] == $menu['parent'])--}}
                                        {{--@if($menu->subs && (count($menu->subs) > 0))--}}
                                    @if($menu['id'] == $menu['parent'])
                                        @if(count($menu->subs) == 0)
                                            <li class="list-item">
                                                <a href="{{asset($menu->link)}}"
                                                class="list-link {{ active_class(Active::checkRoute('frontend.user.dashboard')) }}"
                                                id="menu-{{$menu->id}}">{{trans('custom-menu.'.$menu_name.'.'.str_slug($menu->label))}}</a>
                                            </li>

                                        @else
                                            <li class="list-item">
                                                <a href="#" class="open-list">{{trans('custom-menu.'.$menu_name.'.'.str_slug($menu->label))}}</a>
                                                <ul class="list-unstyled">
                                                    @foreach($menu->subs as $item)
                                                        @include('frontend.layouts.partials.dropdown', $item)
                                                    @endforeach
                                                </ul>
                                            </li>
                                        @endif
                                    @endif
                                @endforeach
                            @endif
                        </ul>
                    </div>
                </div>
                <div class="close-popup">
                    <i class="fas fa-times"></i>
                </div>
            </div>
            <div class="close-popup"></div>
        </div>

        <div class="login-register">
            <div class="overlay login-register-overlay">
                <div class="content login-register-content">
                    <div class="head login-register-head">
                        <h2>
                            <span><i class="fas fa-user"></i></span>
                            Login/Sign Up
                        </h2>
                    </div>
                    <div class="body login-register-body">
                        <ul class="list-unstyled">
                            <li>
                                <a href="#">Courses</a>
                            </li>
                            <li>
                                <a href="#" class="fave">Favorites</a>
                            </li>
                        </ul>
                    </div>
                </div>
                <div class="close-popup">
                    <i class="fas fa-times"></i>
                </div>
            </div>
            <div class="close-popup"></div>
        </div>

        @stack('before-scripts')
        <script src="{{asset('ivory')}}/assets/js/popper.min.js"></script>
 <!-- For Js Library -->
 <script src="{{asset('assets/js/jquery-2.1.4.min.js')}}"></script>
 <script src="{{asset('assets/js/popper.min.js')}}"></script>
 <script src="{{asset('assets/js/bootstrap.min.js')}}"></script>
 

 <script src="{{asset('assets/js/owl.carousel.min.js')}}"></script>
 <script src="{{asset('assets/js/jarallax.js')}}"></script>
 <script src="{{asset('assets/js/jquery.magnific-popup.min.js')}}"></script>
 <script src="{{asset('assets/js/lightbox.js')}}"></script>
 <script src="{{asset('assets/js/jquery.meanmenu.js')}}"></script>
 <script src="{{asset('assets/js/scrollreveal.min.js')}}"></script>
 <script src="{{asset('assets/js/jquery.counterup.min.js')}}"></script>
 <script src="{{asset('assets/js/waypoints.min.js')}}"></script>
 <script src="{{asset('assets/js/jquery-ui.js')}}"></script>
 <script src="{{asset('assets/js/gmap3.min.js')}}"></script>

 <script src="{{asset('assets/js/switch.js')}}"></script>        <script src="{{asset('ivory')}}/assets/js/bootstrap.min.js"></script>
        <script src="{{asset('ivory')}}/assets/js/wow.min.js"></script>
        <script>
            new WOW().init();
        </script>
        <script src="{{asset('ivory')}}/assets/js/swiper.js"></script>
        <script src="{{asset('ivory')}}/assets/js/owl.carousel.min.js"></script>
        <script src="{{asset('ivory')}}/assets/js/plugins.js"></script>
        <script>
            @if((session()->has('show_login')) && (session('show_login') == true))
            $('#myModal').modal('show');
                    @endif
            var font_color = "{{config('font_color')}}"
            setActiveStyleSheet(font_color);
        </script>
 
    
        @yield('js')
    
        @stack('after-scripts')

    </body>
</html>