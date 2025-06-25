<header class="app-header navbar">
    <button class="navbar-toggler sidebar-toggler d-lg-none mr-auto" type="button" data-toggle="sidebar-show">
        <span class="navbar-toggler-icon"></span>
    </button>
  
    {{-- <a class="navbar-brand" href="{{ route('admin.dashboard') }}">
      <img class="navbar-brand-full" src="{{asset('storage/logos/'.config('logo_b_image'))}}"  height="25" alt="Square Logo">
        <img class="navbar-brand-minimized" src="{{asset('storage/logos/'.config('logo_popup'))}}" height="30" alt="Square Logo">
    </a> --}}
    <style>
        .app-header.navbar{
            justify-content: start !important;
            background: #4f198d;

        }
        .navbar-brand-full{
            background: #fff!important;
            padding: 5px;
            height: auto;
            border-radius: 5px;

        }
    </style>
        @if(session('locale') == 'ar')
        <a class="navbar-brand" href="{{ route('admin.dashboard') }}">
            @if(config('logo_w_image') != "")
                <img class="navbar-brand-full" style="width: 100px" src="{{asset('storage/logos/'.config('logo_w_image'))}}" height="25" alt="Square Logo" />
                <img class="navbar-brand-minimized" src="{{asset('storage/logos/'.config('logo_w_image'))}}" height="30" alt="Square Logo">
            @endif
        </a>
    @else
    <a class="navbar-brand" href="{{ route('admin.dashboard') }}">
        @if(config('primary_logo_en_image') != "")
            <img class="navbar-brand-full" style="width: 73px" src="{{asset('storage/logos/'.config('primary_logo_en_image'))}}" height="25" alt="Square Logo" />
            <img class="navbar-brand-minimized" src="{{asset('storage/logos/'.config('primary_logo_en_image'))}}" height="30" alt="Square Logo">
        @endif
   
    </a>
    @endif
    
    <button class="navbar-toggler sidebar-toggler d-md-down-none" type="button" data-toggle="sidebar-lg-show">
        <span class="navbar-toggler-icon"></span>
    </button>

    <ul class="nav navbar-nav d-md-down-none">
        <li class="nav-item px-3">
            <a class="nav-link" href="{{ route('frontend.index') }}"><i class="icon-home"></i></a>
        </li>

        <li class="nav-item px-3">
            <a class="nav-link" href="{{ route('admin.dashboard') }}">@lang('navs.frontend.dashboard')</a>
        </li>
        {{--@if(config('locale.status') && count(config('locale.languages')) > 1)--}}
            {{--<li class="nav-item px-3 dropdown">--}}
                {{--<a class="nav-link dropdown-toggle nav-link" data-toggle="dropdown" href="#" role="button" aria-haspopup="true" aria-expanded="false">--}}
                    {{--<span class="d-md-down-none">@lang('menus.language-picker.language') ({{ strtoupper(app()->getLocale()) }})</span>--}}
                {{--</a>--}}

                {{--@include('includes.partials.lang')--}}
            {{--</li>--}}
        {{--@endif--}}
        @if(config('locale.status') && count($locales) > 1)

            <li class="nav-item px-3 dropdown">
                <a class="nav-link dropdown-toggle nav-link" data-toggle="dropdown" href="#" role="button" aria-haspopup="true" aria-expanded="false">
                    <span class="d-md-down-none">@lang('menus.language-picker.language') ({{ strtoupper(app()->getLocale()) }})</span>
                </a>

                @include('includes.partials.lang')
            </li>
        @endif
    </ul>
    <style>
        .nav.navbar-nav{
         
            justify-content: start!important;

}
    </style>

    <ul class="nav navbar-nav ">
        <li class="nav-item d-md-down-none">
            <a class="nav-link" data-toggle="dropdown" href="#" role="button" aria-haspopup="true" aria-expanded="false">
                <i class="icon-envelope"></i>
                <span class="badge badge-pill d-none badge-success unreadMessageCounter"></span>
                @if($logged_in_user->unreadNotifications->count() > 0)
                    <span id="notify-item-count">{{ $logged_in_user->unreadNotifications->count() }}</span>
                @endif
            </a>
            <div class="dropdown-menu dropdown-menu-right">
                <div class="dropdown-header text-center">
                    <strong>@lang('navs.general.messages')</strong>
                </div>
                <div class="unreadMessages">
                    {{-- Check user notification --}}
                    @if($logged_in_user->unreadNotifications->count() > 0)
                        @foreach($logged_in_user->unreadNotifications as $notification)
                            {{-- Check if has url --}}
                            @if(isset($notification->data['url']))
                                <a class="dropdown-item" href="{{ $notification->data['url'] }}" data-id="{{ $notification->id }}">
                                    <div>{{ $notification->data['message'] }}</div>
                                    <small class="text-muted text-nowrap">{{ $notification->created_at->diffForHumans() }}</small>
                                </a>
                            @else
                                <a class="dropdown-item" href="#" data-id="{{ $notification->id }}">
                                    <div>{{ $notification->data['message'] }}</div>
                                    <small class="text-muted
                                    text-nowrap">{{ $notification->created_at->diffForHumans() }}</small>
                                </a>
                            @endif
                        @endforeach
                    @else
                        <p class="mb-0 text-center py-2">@lang('navs.general.no_messages')</p>
                    @endif
                </div>


            </div>
        </li>

        <li class="nav-item dropdown">
          <a class="nav-link" data-toggle="dropdown" href="#" role="button" aria-haspopup="true" aria-expanded="false">
            <img src="{{ $logged_in_user->picture }}" class="img-avatar" alt="{{ $logged_in_user->email }}">
              <span style="right: 0;left: inherit" class="badge d-md-none d-lg-none d-none mob-notification badge-success">!</span>
            <span class="d-md-down-none">
                {{ app()->getLocale() == 'ar' ? $logged_in_user->full_name_ar : $logged_in_user->full_name }}
            </span>
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

    {{--<button class="navbar-toggler aside-menu-toggler d-md-down-none" type="button" data-toggle="aside-menu-lg-show">--}}
        {{--<span class="navbar-toggler-icon"></span>--}}
    {{--</button>--}}
    {{--<button class="navbar-toggler aside-menu-toggler d-lg-none" type="button" data-toggle="aside-menu-show">--}}
        {{--<span class="navbar-toggler-icon"></span>--}}
    {{--</button>--}}
</header>

@push('after-scripts')
    <script>
        $(document).ready(function() {
            $('.dropdown-item').click(function(e) {
                e.preventDefault();

                var notificationId = $(this).data('id');
                console.log(notificationId);
                var url = $(this).attr('href');

                $.ajax({
                    url: '{{ route('notifications.read', ['id' => '']) }}' +'/'+ notificationId,
                    method: 'GET',
                    success: function() {
                        window.location.href = url;
                        // Remove notification from dropdown
                        $('.unreadMessages').find('a[data-id="'+notificationId+'"]').remove();
                    }
                });
            });
        });
    </script>
@endpush
