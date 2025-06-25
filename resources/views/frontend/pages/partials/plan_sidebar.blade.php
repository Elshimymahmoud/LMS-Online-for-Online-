<div class="border-end bg-white" id="sidebar-wrapper">

    <div class="list-group list-group-flush course-sidebar">
        <a class=" plan-link list-group-item list-group-item-action list-group-item-light p-3 {{Route::currentRouteName()=='plan2024'?'active':''}}"
            href="{{route('plan2024')}}">@lang('custom-menu.nav-menu.plan2024')</a>
        <a class=" plan-link list-group-item list-group-item-action list-group-item-light p-3 {{Route::currentRouteName()=='plan2023'?'active':''}}"
            href="{{route('plan2023')}}">@lang('custom-menu.nav-menu.plan2023')</a>
        <a class="plan-link list-group-item list-group-item-action list-group-item-light p-3 {{Route::currentRouteName()=='plan2022'?'active':''}}"
            href="{{route('plan2022')}}">@lang('custom-menu.nav-menu.plan2022')</a>
        <a class=" plan-link list-group-item list-group-item-action list-group-item-light p-3 {{Route::currentRouteName()=='plan2021'?'active':''}} "
            href="{{route('plan2021')}}">@lang('custom-menu.nav-menu.plan2021')</a>
        <a class=" plan-link list-group-item list-group-item-action list-group-item-light p-3 {{Route::currentRouteName()=='plan2020'?'active':''}}"
            href="{{route('plan2020')}}">@lang('custom-menu.nav-menu.plan2020')</a>
    </div>
</div>
