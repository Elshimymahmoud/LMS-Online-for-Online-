
    <!-- Sidebar left-->
    <div class="border-end bg-white" id="sidebar-wrapper">

        <div class="list-group list-group-flush course-sidebar-left">
            <a class="list-group-item list-group-item-action list-group-item-light p-3 active"
            href="{{ route('admin.dashboard') }}"><i class="fa fa-area-chart primary-color"></i> @lang('labels.backend.dashboard.my_courses')</a>
            <a class="list-group-item list-group-item-action list-group-item-light p-3 active "
            href="{{ route('admin.certificates.index') }}">@lang('navs.general.certificates')</a>
            <a class="list-group-item list-group-item-action list-group-item-light p-3 active"
            href="{{ route('admin.account') }}">@lang('navs.general.profile')</a>


        </div>
    </div>