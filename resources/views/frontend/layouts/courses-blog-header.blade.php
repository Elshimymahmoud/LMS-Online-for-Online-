<header class="app-header navbar" style="height:112px">
    
    <div class="col-lg-2 col-md-2 col-sm-6 col-xs-4">
        <a class="navbar-brand" href="{{ route('admin.dashboard') }}">
            <img class="navbar-brand-full" src="{{asset('ivory')}}/assets/img/logo/logo-wh.png"  width="150px" alt="Square Logo">
            <img class="navbar-brand-minimized" src="{{asset('ivory')}}/assets/img/logo/logo-wh.png" width="150px" alt="Square Logo">
        </a>

        <button style="position: absolute;right:10px;left:10px;top:100px;background:#aaa!important" class="navbar-toggler sidebar-toggler d-md-down-none" type="button" data-toggle="sidebar-lg-show">
            <span class="navbar-toggler-icon"></span>
        </button>

    </div>
    <style>
        .app-header.navbar{
            justify-content: start !important;
            background: #4f198d;

        }
    </style>
    <div class="col-lg-7 col-md-8 col-sm-6 col-xs-4">
            
        <h5 style="color:white;font-size:1.5rem">
            @if (session('locale') == 'ar') {{ $course->title_ar }} @else
                    {{ $course->title }} @endif
        </h5>
        <h6 style="color:white;font-size:1.1rem">          
                {{ $blog->title }} 
        </h6>
       
    </div>
        
    <div class="col-lg-3 col-md-2 col-sm-6 col-xs-4">
        <ul class="nav navbar-nav  mr-4">
            <li class="nav-item d-md-down-none">
                <a class="nav-link" data-toggle="dropdown" href="#" role="button" aria-haspopup="true" aria-expanded="false">
                    <i class="icon-envelope"></i>
                    <span class="badge badge-pill d-none badge-success unreadMessageCounter"></span>
                </a>
                <div class="dropdown-menu dropdown-menu-right">
                    <div class="dropdown-header text-center">
                        <strong>@lang('navs.general.messages')</strong>
                    </div>
                    <div class="unreadMessages">
                    <p class="mb-0 text-center py-2">@lang('navs.general.no_messages')</p>
                    </div>


                </div>
            </li>

            <li class="nav-item dropdown">
            <a class="nav-link" data-toggle="dropdown" href="#" role="button" aria-haspopup="true" aria-expanded="false">
                <img src="{{ $logged_in_user->picture }}" class="img-avatar" alt="{{ $logged_in_user->email }}">
                <span style="right: 0;left: inherit" class="badge d-md-none d-lg-none d-none mob-notification badge-success">!</span>
                <span class="d-md-down-none">{{ $logged_in_user->full_name }}</span>
            </a>
            <div class="dropdown-menu dropdown-menu-right">
                <div class="dropdown-header text-center">
                <strong>@lang('navs.general.account')</strong>
                </div>

                <a class="dropdown-item" href="{{route('admin.messages')}}">
                <i class="fa fa-envelope"></i> @lang('navs.general.messages')
                <span class="badge unreadMessageCounter d-none badge-success">5</span>
                </a>

                <a class="dropdown-item" href="{{ route('admin.account') }}">
                <i class="fa fa-user"></i> @lang('navs.general.profile')
                </a>

                <div class="divider"></div>
                <a class="dropdown-item" href="{{ route('frontend.auth.logout') }}">
                    <i class="fas fa-lock"></i> @lang('navs.general.logout')
                </a>
            </div>
            </li>
        </ul>
    </div>
    
</header>
