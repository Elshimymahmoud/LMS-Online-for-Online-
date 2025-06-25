@inject('request', 'Illuminate\Http\Request')

<div class="sidebar">
    <nav class="sidebar-nav">
        <ul class="nav">
            <li class="nav-title">
                @lang('menus.backend.sidebar.general')
            </li>
            <li class="nav-item">
                <a class="nav-link {{ active_class(Active::checkUriPattern('admin/dashboard')) }}"
                    href="{{ route('admin.dashboard') }}">
                    <i class="nav-icon icon-speedometer"></i> @lang('menus.backend.sidebar.dashboard')
                </a>
            </li>


            <!--=======================Custom menus===============================-->
            @can('order_access')
                <li class="nav-item ">
                    <a class="nav-link {{ $request->segment(1) == 'orders' ? 'active' : '' }}"
                        href="{{ route('admin.orders.index') }}">
                        <i class="nav-icon icon-bag"></i>
                        <span class="title text-color">@lang('menus.backend.sidebar.orders.title')</span>
                    </a>
                </li>
                <li class="nav-item ">
                    <a class="nav-link {{ $request->segment(1) == 'checkout' ? 'active' : '' }}"
                        href="{{ route('admin.checkout.index') }}">
                        <i class="nav-icon icon-bag"></i>
                        <span class="title text-color">@lang('labels.backend.orders.checkout_title')</span>
                    </a>
                </li>
            @endcan
            @if ($logged_in_user->isAdmin())
                <li class="nav-item ">
                    <a class="nav-link {{ $request->segment(2) == 'teachers' ? 'active' : '' }}"
                        href="{{ route('admin.teachers.index') }}">
                        <i class="nav-icon icon-directions"></i>
                        <span class="title text-color">@lang('menus.backend.sidebar.teachers.title')</span>
                    </a>
                </li>
            @endif


            @if (!$logged_in_user->hasRole('student') && ($logged_in_user->hasRole('teacher') || $logged_in_user->isAdmin() || $logged_in_user->hasAnyPermission(['course_access', 'lesson_access', 'test_access', 'question_access', 'bundle_access']))|| $logged_in_user->hasRole('coordinator'))
                {{-- @if ($logged_in_user->hasRole('teacher') || $logged_in_user->isAdmin() || $logged_in_user->hasAnyPermission(['course_access', 'lesson_access', 'test_access', 'question_access', 'bundle_access'])) --}}

                <li
                    class="nav-item nav-dropdown {{ active_class(Active::checkUriPattern(['user/courses(?!/groups)*', 'user/lessons*', 'user/tests*', 'user/questions*']), 'open') }}">
                    <a class="nav-link nav-dropdown-toggle {{ active_class(Active::checkUriPattern('admin/*')) }}"
                        href="#">
                        <i class="nav-icon icon-puzzle"></i> @lang('menus.backend.sidebar.courses.management')


                    </a>

                    <ul class="nav-dropdown-items">

                        @can('course_access')
                            <li class="nav-item ">
                                <a class="nav-link {{ $request->segment(2) == 'courses' ? 'active' : '' }}"
                                    href="{{ route('admin.courses.index') }}">
                                    <span class="title text-color">@lang('menus.backend.sidebar.courses.title')</span>
                                </a>
                            </li>
                            <!-- <li class="nav-item ">
                                <a class="nav-link {{ $request->segment(2) == 'courses' ? 'active' : '' }}"
                                    href="{{ route('admin.courses.index') }}">
                                    <span class="title text-color">@lang('menus.backend.sidebar.courses.title')2</span>
                                </a>
                            </li> -->
                        @endcan
<!-- ************************************** -->
                        @can('course_access')
                                                    <!-- <li class="nav-item ">
                                                        <a class="nav-link {{ $request->segment(2) == 'courses' ? 'active' : '' }}"
                                                            href="{{ route('admin.courses.index2') }}">
                                                            <span class="title text-color">@lang('menus.backend.sidebar.courses.courses_include')</span>
                                                        </a>
                                                    </li> -->
                        @endcan


                 @if ($logged_in_user->hasRole('teacher') || $logged_in_user->isAdmin()|| $logged_in_user->hasRole('coordinator'))

                    <li
                        class="nav-item nav-dropdown {{ active_class(Active::checkUriPattern(['user/courses_clints*','user/courses_place*','user/categories*','user/courseTypes*','user/coordinator*','all_certificates/abrove_certificate*','all_certificates/abrove_certificate_online*']), 'open') }}">
                        <a class="nav-link nav-dropdown-toggle {{ active_class(Active::checkUriPattern('admin/*')) }}"
                            href="#">
                            <i class="nav-icon icon-settings"></i></i>@lang('menus.backend.sidebar.settings.title')

                        </a>
                        <ul class="nav-dropdown-items">
                                           <li class="nav-item ">
                                                <a class="nav-link {{ $request->segment(1) == 'banners' ? 'active' : '' }}"
                                                    href="{{ route('admin.courses_clints.index') }}">
                                                    @lang('menus.backend.sidebar.courses_clints.title')
                                                </a>
                                            </li>
                                            <li class="nav-item ">
                                                <a class="nav-link {{ $request->segment(1) == 'banners' ? 'active' : '' }}"
                                                    href="{{ route('admin.courses_place.index') }}">
                                                    @lang('menus.backend.sidebar.courses_place.title')
                                                </a>
                                            </li>
                                            @can('category_access')
                                                <li class="nav-item ">
                                                    <a class="nav-link {{ $request->segment(2) == 'categories' ? 'active' : '' }}"
                                                        href="{{ route('admin.categories.index') }}">
                                                        <!-- <i class="nav-icon icon-folder-alt"></i> -->
                                                        <span class="title text-color">@lang('menus.backend.sidebar.categories.title')</span>
                                                    </a>
                                                </li>
                                            @endcan
                                           <!-- * -->
                                            <li class="nav-item ">
                                                <a class="nav-link {{ $request->segment(1) == 'courseTypes' ? 'active' : '' }}"
                                                    href="{{ route('admin.courseTypes.index') }}">
                                                    @lang('menus.backend.sidebar.courseTypes.title')
                                                </a>
                                            </li>
                                            <li class="nav-item ">
                                                <a class="nav-link {{ $request->segment(1) == 'course_classification' ? 'active' : '' }}"
                                                    href="{{ route('admin.course_classification.index') }}">
                                                    @lang('labels.backend.courses.fields.classification')
                                                </a>
                                            </li>
                                            <li class="nav-item ">
                                                <a class="nav-link {{ $request->segment(1) == 'banners' ? 'active' : '' }}"
                                                    href="{{ route('admin.coordinator.index') }}">
                                                    @lang('menus.backend.sidebar.coordinator.title')
                                                </a>
                                            </li>
                                          {{--  <li class="nav-item ">
                                                <a class="nav-link {{ $request->segment(1) == 'all_certificates' ? 'active' : '' }}"
                                                    href="{{ route('admin.all_certificates.abrove_certificate') }}">
                                                    <span class="title text-color">@lang('menus.backend.sidebar.certificates.abrove')</span>
                                                </a>
                                            </li>
                                            <li class="nav-item ">
                                                <a class="nav-link {{ $request->segment(1) == 'all_certificates' ? 'active' : '' }}"
                                                    href="{{ route('admin.all_certificates.abrove_certificate_online') }}">
                                                    <span class="title text-color">@lang('menus.backend.sidebar.certificates.abrove_online')</span>
                                                </a>
                                            </li>
                                            --}}

                        </ul>
                    </li>
                @endif


<!--
                            <li class="nav-item nav-dropdown {{ active_class(Active::checkUriPattern(['user/courses_clints*','user/courses_place*']), 'open') }}">
                                <a class="nav-link nav-dropdown-toggle {{ active_class(Active::checkUriPattern('admin/*')) }}"
                                    href="#">
                                         <i class="nav-icon icon-puzzle"></i> @lang('menus.backend.sidebar.courses.management')


                                </a>
                                      <ul class="nav-dropdown-items">


                                            <li class="nav-item ">
                                                <a class="nav-link {{ $request->segment(1) == 'banners' ? 'active' : '' }}"
                                                    href="{{ route('admin.courses_clints.index') }}">
                                                    @lang('menus.backend.sidebar.courses_clints.title')
                                                </a>
                                            </li>
                                            <li class="nav-item ">
                                                <a class="nav-link {{ $request->segment(1) == 'banners' ? 'active' : '' }}"
                                                    href="{{ route('admin.courses_place.index') }}">
                                                    @lang('menus.backend.sidebar.courses_place.title')
                                                </a>
                                            </li>


                                     <ul>
                         </li> -->


<!-- **************************************** -->

                        {{-- @can('lesson_access')
                            <li class="nav-item ">
                                <a class="nav-link {{ $request->segment(2) == 'chapters' ? 'active' : '' }}"
                                   href="{{ route('admin.chapters.index') }}">
                                    <span class="title text-color">@lang('menus.backend.sidebar.chapters.title')</span>
                                </a>
                            </li>
                        @endcan --}}
                        {{-- @can('lesson_access')
                            <li class="nav-item ">
                                <a class="nav-link {{ $request->segment(2) == 'lessons' ? 'active' : '' }}"
                                   href="{{ route('admin.lessons.index') }}">
                                    <span class="title text-color">@lang('menus.backend.sidebar.lessons.title')</span>
                                </a>
                            </li>
                        @endcan


                        @can('question_access')
                            <li class="nav-item">
                                <a class="nav-link {{ $request->segment(2) == 'questions' ? 'active' : '' }}"
                                   href="{{ route('admin.questions.index') }}">
                                    <span class="title text-color">@lang('menus.backend.sidebar.questions.title')</span>
                                </a>
                            </li>
                        @endcan


                        @can('test_access')
                            <li class="nav-item ">
                                <a class="nav-link {{ $request->segment(2) == 'tests' ? 'active' : '' }}"
                                   href="{{ route('admin.tests.index') }}">
                                    <span class="title text-color">@lang('menus.backend.sidebar.tests.title')</span>
                                </a>
                            </li>
                        @endcan --}}

                        @can('bundle_access')

                            <li class="nav-item ">
                                <a class="nav-link {{ $request->segment(2) == 'bundles' ? 'active' : '' }}"
                                    href="{{ route('admin.bundles.index') }}">
                                    <span class="title text-color">@lang('menus.backend.sidebar.bundles.title')</span>
                                </a>
                            </li>
                        @endcan

                        @can('test_access')
                            <!-- <li class="nav-item ">
                                <a class="nav-link {{ $request->segment(2) == 'tests_result' ? 'active' : '' }}"
                                    href="{{ route('admin.tests_result.index') }}">
                                    <span class="title text-color">@lang('menus.backend.sidebar.tests.result')</span>
                                </a>
                            </li> -->
                        @endcan

{{--
                        @can('test_access')
                            <li class="nav-item ">
                                <a class="nav-link {{ $request->segment(2) == 'all_certificates' ? 'active' : '' }}"
                                    href="{{ route('admin.all_certificates.index') }}">
                                    <span class="title text-color">@lang('menus.backend.sidebar.certificates.title')</span>
                                </a>
                            </li>



                        @endcan --}}

                    </ul>
                </li>

                <li class="nav-item nav-dropdown {{ active_class(Active::checkUriPattern(['user/course/groups*']), 'open') }}">
                    <a class="nav-link nav-dropdown-toggle {{ active_class(Active::checkUriPattern('admin/*')) }}"
                       href="#">
                        <i class="nav-icon icon-settings"></i>
                        @lang('labels.backend.group.administration')
                    </a>
                    <ul class="nav-dropdown-items">

                        <li class="nav-item ">
                            <a class="nav-link {{ $request->segment(2) == 'groupes' ? 'active' : '' }}"
                               href="{{ route('admin.groups.index') }}">
                                @lang('labels.backend.group.title')
                            </a>
                        </li>
                        <li class="nav-item ">
                            <a class="nav-link {{ $request->segment(2) == 'groupes' ? 'active' : '' }}"
                               href="{{ route('admin.group.students.all') }}">
                                @lang('menus.backend.sidebar.students.title')
                            </a>
                        </li>
                        <li class="nav-item ">
                            <a class="nav-link {{ $request->segment(2) == 'groupes' ? 'active' : '' }}"
                               href="{{ route('admin.courses.groups.tests2.index') }}">
                                @lang('labels.backend.tests.title')
                            </a>
                        </li>
                        <li class="nav-item ">
                            <a class="nav-link {{ $request->segment(2) == 'groups' ? 'active' : '' }}"
                               {{-- href="{{ route('admin.programRecommendation.index') }}"> --}}
                               href="{{route('admin.group.recommendations')}}">
                                <span class="title text-color">@lang('menus.backend.sidebar.programRec.group_title')</span>
                            </a>
                        </li>
                        <li class="nav-item ">
                            <a class="nav-link {{ $request->segment(2) == 'groups' ? 'active' : '' }}"
                               href="{{route('admin.group.impacts')}}">
                                {{-- href="{{ route('admin.impact.index') }}"> --}}
                                <span class="title text-color">@lang('menus.backend.sidebar.impact.title')</span>
                            </a>
                        </li>
                        <li class="nav-item ">
                            <a class="nav-link {{ $request->segment(2) == 'groups' ? 'active' : '' }}"
                               href="{{route('admin.group.rates')}}">
                                {{-- href="{{ route('admin.impact.index') }}"> --}}
                                <span class="title text-color">@lang('menus.backend.sidebar.rates.title_group')</span>
                            </a>
                        </li>
                        <li class="nav-item ">
                            <a class="nav-link {{ $request->segment(2) == 'groups' ? 'active' : '' }}"
                               href="{{route('admin.courses.groups.activity.index')}}">
                                {{-- href="{{ route('admin.impact.index') }}"> --}}
                                <span class="title text-color">@lang('labels.backend.activities.title')
                                </span>
                            </a>
                        </li>
                        <li class="nav-item ">
                            <a class="nav-link {{ $request->segment(2) == 'groups' ? 'active' : '' }}"
                               href="{{route('admin.certificates.templates.index')}}">
                                {{-- href="{{ route('admin.impact.index') }}"> --}}
                                <span class="title text-color">@lang('labels.backend.cert_templates.title')
                                </span>
                            </a>
                        </li>

                    </ul>
                </li>

{{--                <li class="nav-item ">--}}
{{--                    <a class="nav-link {{ $request->segment(1) == 'contact-requests' ? 'active' : '' }}"--}}
{{--                        --}}{{-- href="{{ route('admin.rate.index') }}"> --}}
{{--                        href="{{route('admin.forms.index', ['form_type'=>'rate'])}}">--}}
{{--                        <i class="nav-icon icon-envelope-letter"></i>--}}
{{--                        <span class="title text-color">@lang('menus.backend.sidebar.rates.title')</span>--}}
{{--                    </a>--}}
{{--                </li>--}}
                @if ($logged_in_user->isAdmin())
                <li class="nav-item ">
                    <a class="nav-link {{ $request->segment(1) == 'contact-requests' ? 'active' : '' }}"
                        {{-- href="{{ route('admin.trainingData.index') }}"> --}}
                        href="{{route('admin.forms.index', ['form_type'=>'training_data'])}}">
                        <i class="nav-icon icon-envelope-letter"></i>
                        <span class="title text-color">@lang('menus.backend.sidebar.trainingData.title')</span>
                    </a>
                </li>
                    <li class="nav-item ">
                        <a class="nav-link {{ $request->segment(1) == 'contact-requests' ? 'active' : '' }}"
                           {{-- href="{{ route('admin.programRecommendation.index') }}"> --}}
                           href="{{route('admin.forms.index', ['form_type'=>'complainment'])}}">

                            <i class="nav-icon icon-envelope-letter"></i>
                            <span class="title text-color">@lang('menus.backend.sidebar.complainment.title')</span>
                        </a>
                    </li>
{{--                <li class="nav-item nav-dropdown {{ active_class(Active::checkUriPattern(['user/trainingData*', 'user/impact*', 'user/programRecommendation*']), 'open') }} ">--}}
{{--                    <a class="nav-link nav-dropdown-toggle {{ active_class(Active::checkUriPattern('admin/*')) }}"--}}
{{--                        href="#">--}}
{{--                        <i class="nav-icon icon-envelope-letter"></i>--}}
{{--                        <span class="title text-color">@lang('menus.backend.sidebar.forms.title')</span>--}}
{{--                    </a>--}}
{{--                    <ul class="nav-dropdown-items">--}}




{{--<!-- ********************* -->--}}
{{--                        <li--}}
{{--                        class="nav-item nav-dropdown {{ active_class(Active::checkUriPattern(['user/impact*', 'user/programRecommendation*']), 'open') }}">--}}
{{--                        <a class="nav-link nav-dropdown-toggle {{ active_class(Active::checkUriPattern('admin/*')) }}"--}}
{{--                            href="#">--}}
{{--                            <i class="nav-icon icon-pie-chart"></i>@lang('menus.backend.sidebar.recomend.title')--}}

{{--                        </a>--}}
{{--                        <ul class="nav-dropdown-items">--}}
{{--                        <li class="nav-item ">--}}
{{--                            <a class="nav-link {{ $request->segment(1) == 'contact-requests' ? 'active' : '' }}"--}}
{{--                                --}}{{-- href="{{ route('admin.programRecommendation.index') }}"> --}}
{{--                                href="{{route('admin.forms.index', ['form_type'=>'program_recommendation'])}}">--}}

{{--                                <i class="nav-icon icon-envelope-letter"></i>--}}
{{--                                <span class="title text-color">@lang('menus.backend.sidebar.programRec.title')</span>--}}
{{--                            </a>--}}
{{--                        </li>--}}
{{--                        <li class="nav-item ">--}}
{{--                            <a class="nav-link {{ $request->segment(1) == 'contact-requests' ? 'active' : '' }}"--}}
{{--                               href="{{route('admin.forms.index', ['form_type'=>'impact_measurments'])}}">--}}
{{--                                --}}{{-- href="{{ route('admin.impact.index') }}"> --}}

{{--                                <i class="nav-icon icon-envelope-letter"></i>--}}
{{--                                <span class="title text-color">@lang('menus.backend.sidebar.impact.title')</span>--}}
{{--                            </a>--}}
{{--                        </li>--}}
{{--                        </ul>--}}
{{--                    </li>--}}

{{--<!-- ******************** -->--}}
{{--                        <li class="nav-item ">--}}
{{--                            <a class="nav-link {{ $request->segment(1) == 'contact-requests' ? 'active' : '' }}"--}}
{{--                                --}}{{-- href="{{ route('admin.programRecommendation.index') }}"> --}}
{{--                                href="{{route('admin.forms.index', ['form_type'=>'complainment'])}}">--}}

{{--                                <i class="nav-icon icon-envelope-letter"></i>--}}
{{--                                <span class="title text-color">@lang('menus.backend.sidebar.complainment.title')</span>--}}
{{--                            </a>--}}
{{--                        </li>--}}
{{--                    </ul>--}}
{{--                </li>--}}

                @endif

                @if ($logged_in_user->hasRole('teacher') || $logged_in_user->isAdmin())
                    <li
                        class="nav-item nav-dropdown {{ active_class(Active::checkUriPattern(['user/reports*']), 'open') }}">
                        <a class="nav-link nav-dropdown-toggle {{ active_class(Active::checkUriPattern('admin/*')) }}"
                            href="#">
                            <i class="nav-icon icon-pie-chart"></i>@lang('menus.backend.sidebar.reports.title')

                        </a>
                        <ul class="nav-dropdown-items">
                            <li class="nav-item ">
                                <a class="nav-link {{ $request->segment(1) == 'sales' ? 'active' : '' }}"
                                    href="{{ route('admin.reports.sales') }}">
                                    @lang('menus.backend.sidebar.reports.sales')
                                </a>
                            </li>
                            <li class="nav-item ">
                                <a class="nav-link {{ $request->segment(1) == 'students' ? 'active' : '' }}"
                                    href="{{ route('admin.reports.students') }}">@lang('menus.backend.sidebar.reports.students')
                                </a>
                            </li>
                        </ul>
                    </li>
                @endif


                @if ($logged_in_user->isAdmin())
                    <li
                        class="nav-item nav-dropdown {{ active_class(Active::checkUriPattern(['user/sliders*']), 'open') }}">
                        <a class="nav-link nav-dropdown-toggle {{ active_class(Active::checkUriPattern('admin/*')) }}"
                            href="#">
                            <i class="nav-icon icon-pie-chart"></i>@lang('menus.backend.sidebar.home')

                        </a>
                        <ul class="nav-dropdown-items">
                            <li class="nav-item ">
                                <a class="nav-link {{ $request->segment(1) == 'sliders' ? 'active' : '' }}"
                                    href="{{ route('admin.sliders.index') }}">
                                    @lang('menus.backend.sidebar.slider')
                                </a>
                            </li>
                            <li class="nav-item ">
                                <a class="nav-link {{ $request->segment(1) == 'home_services' ? 'active' : '' }}"
                                    href="{{ route('admin.home_services.index') }}">
                                    @lang('menus.backend.sidebar.home_services')
                                </a>
                            </li>
                            <li class="nav-item ">
                                <a class="nav-link {{ $request->segment(1) == 'locations' ? 'active' : '' }}"
                                    href="{{ route('admin.locations.index') }}">
                                    @lang('menus.backend.sidebar.locations')
                                </a>
                            </li>
                            <li class="nav-item ">
                                <a class="nav-link {{ $request->segment(1) == 'reasons' ? 'active' : '' }}"
                                    href="{{ route('admin.reasons.index') }}">
                                    @lang('menus.backend.sidebar.reasons.title')
                                </a>
                            </li>
                            <li class="nav-item ">
                                <a class="nav-link {{ $request->segment(1) == 'sponsors' ? 'active' : '' }}"
                                    href="{{ route('admin.sponsors.index') }}">
                                    @lang('menus.backend.sidebar.sponsors.title')
                                </a>
                            </li>
                            <li class="nav-item ">
                                <a class="nav-link {{ $request->segment(1) == 'clients' ? 'active' : '' }}"
                                    href="{{ route('admin.clients.index') }}">
                                    @lang('menus.backend.sidebar.clients')
                                </a>
                            </li>
                            <li class="nav-item ">
                                <a class="nav-link {{ $request->segment(1) == 'stories' ? 'active' : '' }}"
                                    href="{{ route('admin.stories.index') }}">
                                    @lang('menus.backend.sidebar.stories')
                                </a>
                            </li>

                            <li class="nav-item ">
                                <a class="nav-link {{ $request->segment(1) == 'testimonials' ? 'active' : '' }}"
                                    href="{{ route('admin.testimonials.index') }}">
                                    @lang('menus.backend.sidebar.testimonials.title')
                                </a>
                            </li>
                            <li class="nav-item ">
                                <a class="nav-link {{ $request->segment(1) == 'banners' ? 'active' : '' }}"
                                    href="{{ route('admin.banners.index') }}">
                                    @lang('menus.backend.sidebar.banners.title')
                                </a>
                            </li>
                            <li class="nav-item ">
                                <a class="nav-link {{ $request->segment(1) == 'guests' ? 'active' : '' }}"
                                    href="{{ route('admin.guests.index') }}">
                                    @lang('menus.backend.sidebar.guest.title')
                                </a>
                            </li>

                            <li class="nav-item ">
                                <a class="nav-link {{ $request->segment(1) == 'acheivment' ? 'active' : '' }}"
                                    href="{{ route('admin.acheivment.index') }}">
                                    @lang('menus.backend.sidebar.acheivment.title')
                                </a>
                            </li>
                            <li class="nav-item ">
                                <a class="nav-link {{ $request->segment(1) == 'banners' ? 'active' : '' }}"
                                    href="{{ route('admin.home_free_course.index') }}">
                                    @lang('menus.backend.sidebar.courseHomeFree.title')
                                </a>
                            </li>
                        </ul>
                    </li>
                @endif


            @endif




            @if ($logged_in_user->isAdmin() || $logged_in_user->hasAnyPermission(['blog_access', 'page_access', 'reason_access']))
                <li
                    class="nav-item nav-dropdown {{ active_class(Active::checkUriPattern(['user/contact', 'user/faqs*', 'user/footer*', 'user/blogs', 'user/sitemap*']), 'open') }}">
                    <a class="nav-link nav-dropdown-toggle {{ active_class(Active::checkUriPattern('admin/*')) }}"
                        href="#">
                        <i class="nav-icon icon-note"></i> @lang('menus.backend.sidebar.site-management.title')
                    </a>

                    <ul class="nav-dropdown-items">
                        @can('page_access')
                            <li class="nav-item ">
                                <a class="nav-link {{ $request->segment(2) == 'pages' ? 'active' : '' }}"
                                    href="{{ route('admin.pages.index') }}">
                                    <span class="title text-color">@lang('menus.backend.sidebar.pages.title')</span>
                                </a>
                            </li>
                        @endcan
                        @can('blog_access')
                            <li class="nav-item ">
                                <a class="nav-link {{ $request->segment(2) == 'blogs' ? 'active' : '' }}"
                                    href="{{ route('admin.blogs.index') }}">
                                    <span class="title text-color">@lang('menus.backend.sidebar.blogs.title')</span>
                                </a>
                            </li>
                        @endcan

                        @if ($logged_in_user->isAdmin())
                            <li class="nav-item">
                                <a class="nav-link {{ active_class(Active::checkUriPattern('admin/menu-manager')) }}"
                                    href="{{ route('admin.menu-manager') }}">
                                    {{ __('menus.backend.sidebar.menu-manager.title') }}</a>
                            </li>



                            <li class="nav-item ">
                                <a class="nav-link {{ $request->segment(2) == 'forums-category' ? 'active' : '' }}"
                                    href="{{ route('admin.forums-category.index') }}">
                                    <span
                                        class="title text-color">@lang('menus.backend.sidebar.forums-category.title')</span>
                                </a>
                            </li>
                            <li class="nav-item ">
                                <a class="nav-link {{ $request->segment(2) == 'faqs' ? 'active' : '' }}"
                                    href="{{ route('admin.faqs.index') }}">
                                    <span class="title text-color">@lang('menus.backend.sidebar.faqs.title')</span>
                                </a>
                            </li>
                            <li class="nav-item ">
                                <a class="nav-link {{ $request->segment(2) == 'contact' ? 'active' : '' }}"
                                    href="{{ route('admin.contact-settings') }}">
                                    <span class="title text-color">@lang('menus.backend.sidebar.contact.title')</span>
                                </a>
                            </li>
                            <li class="nav-item ">
                                <a class="nav-link {{ $request->segment(2) == 'newsletter' ? 'active' : '' }}"
                                    href="{{ route('admin.newsletter-settings') }}">
                                    <span
                                        class="title text-color">@lang('menus.backend.sidebar.newsletter-configuration.title')</span>
                                </a>
                            </li>
                            <li class="nav-item ">
                                <a class="nav-link {{ $request->segment(2) == 'footer' ? 'active' : '' }}"
                                    href="{{ route('admin.footer-settings') }}">
                                    <span class="title text-color">@lang('menus.backend.sidebar.footer.title')</span>
                                </a>
                            </li>
                            <li class="nav-item ">
                                <a class="nav-link {{ $request->segment(2) == 'sitemap' ? 'active' : '' }}"
                                    href="{{ route('admin.sitemap.index') }}">
                                    <span class="title text-color">@lang('menus.backend.sidebar.sitemap.title')</span>
                                </a>
                            </li>
                        @endif

                    </ul>


                </li>
            @else
                @can('blog_access')
                    <li class="nav-item ">
                        <a class="nav-link {{ $request->segment(2) == 'blogs' ? 'active' : '' }}"
                            href="{{ route('admin.blogs.index') }}">
                            <i class="nav-icon icon-note"></i>
                            <span class="title text-color">@lang('menus.backend.sidebar.blogs.title')</span>
                        </a>
                    </li>
                @endcan
                @can('reason_access')
                    <li class="nav-item">
                        <a class="nav-link {{ $request->segment(2) == 'reasons' ? 'active' : '' }}"
                            href="{{ route('admin.reasons.index') }}">
                            <i class="nav-icon icon-layers"></i>
                            <span class="title text-color">@lang('menus.backend.sidebar.reasons.title')</span>
                        </a>
                    </li>
                @endcan
            @endif

            <li class="nav-item ">
                <a class="nav-link {{ $request->segment(1) == 'messages' ? 'active' : '' }}"
                    href="{{ route('admin.messages') }}">
                    <i class="nav-icon icon-envelope-open"></i> <span
                        class="title text-color">@lang('menus.backend.sidebar.messages.title')</span>
                </a>
            </li>
            @if ($logged_in_user->isAdmin())
                <li class="nav-item ">
                    <a class="nav-link {{ in_array($request->segment(1), ['tickets', 'ticket']) ? 'active' : '' }}"
                       href="{{ route('admin.tickets.index') }}">
                        <i class="nav-icon icon-envelope-open"></i> <span
                                class="title text-color">@lang('labels.backend.tickets.title')</span>
                    </a>
                </li>
            @endif
            @if ($logged_in_user->hasRole('student'))
                <li class="nav-item ">
                    <a class="nav-link {{ $request->segment(1) == 'invoices' ? 'active' : '' }}"
                        href="{{ route('admin.invoices.index') }}">
                        <i class="nav-icon icon-notebook"></i> <span
                            class="title text-color">@lang('menus.backend.sidebar.invoices.title')</span>
                    </a>
                </li>
                <li class="nav-item ">
                    <a class="nav-link {{ $request->segment(1) == 'certificates' ? 'active' : '' }}"
                        href="{{ route('admin.certificates.index') }}">
                        <i class="nav-icon icon-badge"></i> <span
                            class="title text-color">@lang('menus.backend.sidebar.certificates.title')</span>
                    </a>
                </li>
            @endif
            @if ($logged_in_user->hasRole('teacher'))
                <li class="nav-item ">
                    <a class="nav-link {{ $request->segment(1) == 'reviews' ? 'active' : '' }}"
                        href="{{ route('admin.reviews.index') }}">
                        <i class="nav-icon icon-speech"></i> <span
                            class="title text-color">@lang('menus.backend.sidebar.reviews.title')</span>
                    </a>
                </li>
            @endif

            @if ($logged_in_user->isAdmin())
                <li class="nav-item ">
                    <a class="nav-link {{ $request->segment(1) == 'contact-requests' ? 'active' : '' }}"
                        href="{{ route('admin.contact-requests.index') }}">
                        <i class="nav-icon icon-envelope-letter"></i>
                        <span class="title text-color">@lang('menus.backend.sidebar.contacts.title')</span>
                    </a>
                </li>
                {{-- <li class="nav-item ">
                    <a class="nav-link {{ $request->segment(1) == 'complains' ? 'active' : '' }}"
                        href="{{ route('admin.forms.get_complainForms') }}">
                        <i class="nav-icon icon-star"></i>
                        <span class="title text-color">@lang('menus.backend.sidebar.complains.title')</span>
                    </a>
                </li> --}}
                <li class="nav-item ">
                    <a class="nav-link {{ $request->segment(1) == 'contact-requests' ? 'active' : '' }}"
                        href="{{ route('admin.coupons.index') }}">
                        <i class="nav-icon icon-star"></i>
                        <span class="title text-color">@lang('menus.backend.sidebar.coupons.title')</span>
                    </a>
                </li>

                {{-- //Rate --}}
                {{-- <li class="nav-item nav-dropdown">
                    <a class="nav-link nav-dropdown-toggle{{ $request->segment(1) == 'contact-requests' ? 'active' : '' }}"
                       href="#">

                        <i class="nav-icon icon-star"></i>@lang('menus.backend.sidebar.rates.title')

                    </a>

                    <ul class="nav-dropdown-items">
                        <li class="nav-item ">
                            <a class="nav-link"
                                href="{{ route('admin.rate.index') }}">
                                 <i class="nav-icon icon-star"></i>
                                 <span class="title text-color">@lang('menus.backend.sidebar.rates.createRate')</span>
                             </a>
                        </li>
                        <li class="nav-item ">
                            <a class="nav-link {{ $request->segment(1) == 'home_services' ? 'active' : '' }}"
                               href="{{ route('admin.rateType.create') }}">
                               <i class="nav-icon icon-plus"></i>

                                <span>@lang('menus.backend.sidebar.rates.createRateType')</span>
                            </a>
                        </li>
                    </ul>
                </li> --}}
                {{-- /end rate --}}
                <li class="nav-item ">
                    <a class="nav-link {{ $request->segment(1) == 'contact-requests' ? 'active' : '' }}"
                        href="{{ route('admin.tax.index') }}">
                        <i class="nav-icon icon-credit-card"></i>
                        <span class="title text-color">@lang('menus.backend.sidebar.tax.title')</span>
                    </a>
                </li>
                <li class="nav-item ">
                    <a class="nav-link {{ $request->segment(1) == 'contact-requests' ? 'active' : '' }}"
                        href="{{ route('admin.payments.requests') }}">
                        <i class="nav-icon icon-people"></i>
                        <span class="title text-color">@lang('menus.backend.sidebar.payments_requests.title')</span>
                    </a>
                </li>
            @endif
            <li class="nav-item ">
                <a class="nav-link {{ $request->segment(1) == 'account' ? 'active' : '' }}"
                    href="{{ route('admin.account') }}">
                    <i class="nav-icon icon-key"></i>
                    <span class="title text-color">@lang('menus.backend.sidebar.account.title')</span>
                </a>
            </li>
            @if ($logged_in_user->isAdmin())


                <li class="nav-title">
                    @lang('menus.backend.sidebar.system')
                </li>

                <li
                    class="nav-item nav-dropdown {{ active_class(Active::checkUriPattern('admin/auth*'), 'open') }}">
                    <a class="nav-link nav-dropdown-toggle {{ active_class(Active::checkUriPattern('admin/auth*')) }}"
                        href="#">
                        <i class="nav-icon icon-user"></i> @lang('menus.backend.access.title')

                        @if ($pending_approval > 0)
                            <span class="badge badge-danger">{{ $pending_approval }}</span>
                        @endif
                    </a>

                    <ul class="nav-dropdown-items">
                        <li class="nav-item">
                            <a class="nav-link {{ active_class(Active::checkUriPattern('admin/auth/user*')) }}"
                                href="{{ route('admin.auth.user.index') }}">
                                @lang('labels.backend.access.users.management')

                                @if ($pending_approval > 0)
                                    <span class="badge badge-danger">{{ $pending_approval }}</span>
                                @endif
                            </a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link {{ active_class(Active::checkUriPattern('admin/auth/role*')) }}"
                                href="{{ route('admin.auth.role.index') }}">
                                @lang('labels.backend.access.roles.management')
                            </a>
                        </li>
                    </ul>
                </li>


                <!--==================================================================-->
                <li class="divider"></li>

                <li class="nav-item nav-dropdown {{ active_class(Active::checkUriPattern('admin/*'), 'open') }}">
                    <a class="nav-link nav-dropdown-toggle {{ active_class(Active::checkUriPattern('admin/settings*')) }}"
                        href="#">
                        <i class="nav-icon icon-settings"></i> @lang('menus.backend.sidebar.settings.title')
                    </a>

                    <ul class="nav-dropdown-items">
                        <li class="nav-item">
                            <a class="nav-link {{ active_class(Active::checkUriPattern('admin/settings')) }}"
                                href="{{ route('admin.general-settings') }}">
                                @lang('menus.backend.sidebar.settings.general')
                            </a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link {{ active_class(Active::checkUriPattern('admin/log-viewer/logs*')) }}"
                                href="{{ route('admin.social-settings') }}">
                                @lang('menus.backend.sidebar.settings.social-login')
                            </a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link {{ active_class(Active::checkUriPattern('admin/log-viewer/logs*')) }}"
                                href="{{ route('admin.landing-settings') }}">
                                @lang('labels.backend.landing.landing_colors')
                            </a>
                        </li>
                    </ul>
                </li>

                <li
                    class="nav-item nav-dropdown {{ active_class(Active::checkUriPattern('admin/log-viewer*'), 'open') }}">
                    <a class="nav-link nav-dropdown-toggle {{ active_class(Active::checkUriPattern('admin/log-viewer*')) }}"
                        href="#">
                        <i class="nav-icon icon-list"></i> @lang('menus.backend.sidebar.debug-site.title')
                    </a>

                    <ul class="nav-dropdown-items">
                        <li class="nav-item">
                            <a class="nav-link {{ active_class(Active::checkUriPattern('admin/log-viewer')) }}"
                                href="{{ route('log-viewer::dashboard') }}">
                                @lang('menus.backend.log-viewer.dashboard')
                            </a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link {{ active_class(Active::checkUriPattern('admin/log-viewer/logs*')) }}"
                                href="{{ route('log-viewer::logs.list') }}">
                                @lang('menus.backend.log-viewer.logs')
                            </a>
                        </li>
                    </ul>
                </li>

                <li class="nav-item ">
                    <a class="nav-link {{ $request->segment(1) == 'translation-manager' ? 'active' : '' }}"
                        href="{{ asset('user/translations') }}">
                        <i class="nav-icon icon-docs"></i>
                        <span class="title text-color">@lang('menus.backend.sidebar.translations.title')</span>
                    </a>
                </li>

                <li class="nav-item ">
                    <a class="nav-link {{ $request->segment(1) == 'backup' ? 'active' : '' }}"
                        href="{{ route('admin.backup') }}">
                        <i class="nav-icon icon-shield"></i>
                        <span class="title text-color">@lang('menus.backend.sidebar.backup.title')</span>
                    </a>
                </li>
                <li class="nav-item ">
                    <a class="nav-link {{ $request->segment(1) == 'update-theme' ? 'active' : '' }}"
                        href="{{ route('admin.update-theme') }}">
                        <i class="nav-icon icon-refresh"></i>
                        <span class="title text-color">@lang('menus.backend.sidebar.update.title')</span>
                    </a>
                </li>
            @endif

            @if ($logged_in_user->hasRole('teacher'))
                <li class="nav-item ">
                    <a class="nav-link {{ $request->segment(2) == 'payments' ? 'active' : '' }}"
                        href="{{ route('admin.payments') }}">
                        <i class="nav-icon icon-wallet"></i>
                        <span class="title text-color">@lang('menus.backend.sidebar.payments.title')</span>
                    </a>
                </li>
            @endif

        </ul>
    </nav>

    <button class="sidebar-minimizer brand-minimizer" type="button"></button>
</div>
<!--sidebar-->
