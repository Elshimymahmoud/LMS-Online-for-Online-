@extends('frontend.layouts.courses')
{{-- @extends('frontend.layouts.app'.config('theme_layout')) --}}

@push('after-styles')
    {{-- <link rel="stylesheet" href="{{asset('plugins/YouTube-iFrame-API-Wrapper/css/main.css')}}"> --}}
    <link rel="stylesheet" href="https://cdn.plyr.io/3.5.3/plyr.css" />
    <link href="{{ asset('plugins/touchpdf-master/jquery.touchPDF.css') }}" rel="stylesheet">
    <link href="{{ asset('css/buttons.css') }}" rel="stylesheet">

    <style>
        .test-form {
            color: #333333;
        }

        .course-details-category ul li {
            width: 100%;
        }

        .sidebar.is_stuck {
            top: 15% !important;
        }

        .options-list li {
            list-style-type: none;
        }

        .options-list li.correct {
            color: green;
        }

        .options-list li.incorrect {
            color: red;
        }

        .options-list li.correct:before {
            content: "\f058";
            /* FontAwesome Unicode */
            font-family: 'Font Awesome\ 5 Free';
            display: inline-block;
            color: green;
            margin-left: -1.3em;
            /* same as padding-left set on li */
            width: 1.3em;
            /* same as padding-left set on li */
        }

        .options-list li.incorrect:before {
            content: "\f057";
            /* FontAwesome Unicode */
            font-family: 'Font Awesome\ 5 Free';
            display: inline-block;
            color: red;
            margin-left: -1.3em;
            /* same as padding-left set on li */
            width: 1.3em;
            /* same as padding-left set on li */
        }

        .options-list li:before {
            content: "\f111";
            /* FontAwesome Unicode */
            font-family: 'Font Awesome\ 5 Free';
            display: inline-block;
            color: black;
            margin-left: -1.3em;
            /* same as padding-left set on li */
            width: 1.3em;
            /* same as padding-left set on li */
        }

        .touchPDF {
            border: 1px solid #e3e3e3;
        }

        .touchPDF>.pdf-outerdiv>.pdf-toolbar {
            height: 0;
            color: black;
            padding: 5px 0;
            text-align: right;
        }

        .pdf-tabs {
            width: 100% !important;
        }

        .pdf-outerdiv {
            width: 100% !important;
            left: 0 !important;
            padding: 0px !important;
            transform: scale(1) !important;
        }

        .pdf-viewer {
            left: 0px;
            width: 100% !important;
        }

        .pdf-drag {
            width: 100% !important;
        }

        .pdf-outerdiv {
            left: 0px !important;
        }

        .pdf-outerdiv {
            padding-left: 0px !important;
            left: 0px;
        }

        .pdf-toolbar {
            left: 0px !important;
            width: 99% !important;
            height: 30px;
        }

        .pdf-viewer {
            box-sizing: border-box;
            left: 0 !important;
            margin-top: 10px;
        }

        .pdf-title {
            display: none !important;
        }

        .course-timeline-list,
        .couse-feature.ul-li-block ul {
            list-style: none;
            padding-inline-start: 0px;
        }

        .course-timeline-list li {
            padding-bottom: 10px;
            margin-bottom: 10px;
            font-size: 14px;
            border-bottom: 1px solid #ccc;
            background-color: ##3bcfcb;
            border-radius: 5px;
            padding: 15px 10px;
        }

        .course-timeline-list li.completed_lessons {
            position: relative;
            background: url({{ asset('images/success.png') }}) #14a876;
            background-size: 50px;
            background-position: center left;
            background-repeat: no-repeat
        }

        .course-timeline-list i.fa-check-circle {
            font-size: 32px;
            position: absolute;
            top: 10px;
            left: 10px;
            z-index: 1;
        }

        .course-timeline-list li.completed_lessons a {
            color: #fff !important
        }

        .course-timeline-list li.active a {
            font-weight: bolder;
            color: #fff !important
        }

        .pdf-outerdiv {
            background: ##3bcfcb;
            color: #ccc
        }

        .pdf-page-count {
            color: #ccc
        }

        .pdf-button .btn-primary {
            background-color: transparent;
            border-color: #343a40;
            border-radius: 5px
        }

        .pdf-button .btn-success {
            background-color: #495057;
            border-color: #495057;
            border-radius: 5px;
            margin: 0 2px;
        }

        .course-details-category .btn-block,
        .course-details-item .btn-block {
            border-bottom: 1px solid #ccc;
            background-color: ##3bcfcb;
            border-radius: 5px;
            padding: 5px;
            direction: ltr
        }

        .couse-feature {
            padding-bottom: 10px;
            margin-bottom: 10px;
            font-size: 14px;
            border-bottom: 1px solid #ccc;
            background-color: #fff;
            border-radius: 5px;
            padding: 15px 10px;
            color: ##3bcfcb;
        }

        .couse-feature a {
            color: #ccc !important;
        }

        .course-timeline-list li a {
            color: #ccc !important;
        }

        .media i::before {
            font-size: 20px;
        }

        .cicuclum_title {
            border-bottom: 1px gray solid;
            font-size: 18px !important;
            color: #802d42 !important;
            font-weight: 700 !important;
        }

        .cicuclum_li {
            border-bottom: 1px gray solid;

        }

        @media screen and (max-width: 768px) {}

    </style>
@endpush

@section('content')




    <!-- Start of course details section
                    ============================================= -->
    <section id="course-details" class="course-details-section">
        <div class="container ">
            <div class="row main-content">
                <div class="col-md-12">
                    @if (session()->has('success'))
                        <div class="alert alert-dismissable alert-success fade show">
                            <button type="button" class="close" data-dismiss="alert">&times;</button>
                            {{ session('success') }}
                        </div>
                    @endif

                    <div class="course-details-item border-bottom-0 mb-0">



                        <div class="course-single-text">

                            <div class="course-title mt10 headline relative-position">
                                <h3 style="margin: 30px 0">
                                    <b>
                                        {{ $blog->title }}
                                    </b>
                                </h3>
                            </div>

                            @if ($blog->image != '')
                                <div class="course-single-pic mb30" style="margin: 30px 0">
                                    <img src="{{ asset('storage/uploads/' . $blog->image) }}" style="width: 100%" alt="">
                                </div>
                            @endif


                            {{-- /////////////////////////////////// --}}
                            {{-- <div class="col-lg-12 col-md-12 details-content">
                                    <div class="teacher justify-content-start">
                                        <a href="#">
                                            <div class="media">
                                                <i class="fas fa-calendar-alt blog"></i>
                                                <div class="media-body">
                                                    <h5>{{$blog->created_at->format('d M Y')}}</h5>
                                                </div>
                                            </div>
                                        </a>
                                        <a href="#">
                                            <div class="media">
                                                <i class="fas fa-user blog"></i>
                                                <div class="media-body">
                                                    <h4>{{$blog->author->name}}</h4>

                                                </div>
                                            </div>
                                        </a>
                                        <a href="#">
                                            <div class="media">
                                                <i class="fas fa-comment-dots blog"></i>
                                                <div class="media-body">
                                                    <h4> {{$blog->comments->count()}}</h4>


                                                </div>
                                            </div>
                                        </a>
                                        <a href="#" class="media">
                                            <i class="fas fa-tag media-body blog">


                                            </i>
                                            <a class="cat-blog-name"
                                                href="{{route('blogs.category',['category' => $blog->category->slug])}}">

                                                {{$blog->category->name}}



                                            </a>
                                        </a>
                                    </div>
                                </div> --}}
                            {{-- //////// //// --}}
                            <hr>
                            <div class="course-details-content">
                                {!! $blog->content !!}
                            </div>


                        </div>

                        {{-- <div class="blog-details-content">
                        <div class="blog-share-tag">
                            <div class="share-text float-left">
                                @lang('labels.frontend.blog.share_this_news')
                            </div>

                            <div class="share-social ul-li float-right">
                                <ul>
                                    <li><a target="_blank"
                                            href="http://www.facebook.com/sharer/sharer.php?u={{url()->current()}}"><i
                                                class="fab fa-facebook-f"></i></a></li>
                                    <li><a target="_blank"
                                            href="http://twitter.com/share?url={{url()->current()}}&text={{$blog->title}}"><i
                                                class="fab fa-twitter"></i></a></li>
                                    <li><a target="_blank"
                                            href="http://www.linkedin.com/shareArticle?url={{url()->current()}}&title={{$blog->title}}&summary={{substr(strip_tags($blog->content),0,40)}}..."><i
                                                class="fab fa-linkedin"></i></a></li>
                                    <li><a target="_blank"
                                            href="https://api.whatsapp.com/send?phone=&text={{url()->current()}}"><i
                                                class="fab fa-whatsapp"></i></a></li>
                                </ul>
                            </div>
                        </div>
                    </div> --}}
                        {{-- //// --}}

                        <div class="blog-comment-area ul-li about-teacher-2">
                            <div class="reply-comment-box">
                                <div class="section-title-2  headline ">
                                    <h2> @lang('labels.frontend.blog.post_comments')</h2>
                                </div>

                                @if (auth()->check())
                                    <div class="teacher-faq-form">
                                        <form method="POST" action="{{ route('blogs.comment', ['id' => $blog->id]) }}"
                                            data-lead="Residential">
                                            @csrf
                                            <div class="form-group">
                                                <label for="comment"> @lang('labels.frontend.blog.write_a_comment')</label>
                                                <textarea name="comment" required class="mb-0 @if (session('locale') == 'en') editor @else editor_ar @endif" id="comment"
                                                    rows="2" cols="20"></textarea>
                                                <span
                                                    class="help-block text-danger">{{ $errors->first('comment', ':message') }}</span>
                                            </div>

                                            <div class="  text-center  gradient-bg text-uppercase">

                                                <div class="row"
                                                    style="min-height: 60px;max-width: 300px;;position: relative;">
                                                    <button class="next-button" role="button">
                                                        <span> @lang('labels.frontend.blog.add_comment') </span>
                                                        <div class="icon">
                                                            <i class="fa fa-comment"></i>
                                                            <i class="fa fa-check"></i>
                                                        </div>
                                                    </button>

                                                </div>


                                            </div>
                                        </form>
                                    </div>
                                @else
                                    <a id="openLoginModal" class="btn nws-button gradient-bg text-white"
                                        data-target="#myModal"> @lang('labels.frontend.blog.login_to_post_comment')</a>
                                @endif
                            </div>
                            @if ($blog->comments->count() > 0)

                                <ul class="comment-list my-5">
                                    @foreach ($blog->comments as $item)
                                        <li class="d-block">
                                            <div class="comment-avater">
                                                <img src="{{ $item->user->picture }}" alt="">
                                            </div>

                                            <div class="author-name-rate">
                                                <div class="author-name float-left">
                                                    @lang('labels.frontend.blog.by'): <span>{{ $item->name }}</span>
                                                </div>

                                                <div class="time-comment float-right">
                                                    {{ $item->created_at->diffforhumans() }}
                                                </div><br>
                                                @if (auth()->user())
                                                    @if ($item->user_id == auth()->user()->id)
                                                        <div class="time-comment float-right">

                                                            <a class="text-danger font-weight-bolf"
                                                                href="{{ route('blogs.comment.delete', ['id' => $item->id]) }}">
                                                                @lang('labels.general.delete')</a>

                                                        </div>
                                                    @endif
                                                @endif

                                            </div>
                                            <div class="author-designation-comment">
                                                <p>{{ $item->comment }}</p>
                                            </div>
                                        </li>
                                    @endforeach


                                </ul>
                            @else
                                <p class="my-5">@lang('labels.frontend.blog.no_comments_yet')</p>
                            @endif



                        </div>


                        {{-- ///// --}}

                    </div>
                    <!-- /course-details -->

                    <!-- /market guide -->

                    <!-- /review overview -->
                </div>


            </div>
        </div>
    </section>
    <!-- End of course details section
                ============================================= -->

@endsection


@section('sidebar')
    @inject('request', 'Illuminate\Http\Request')

    <div class="sidebar">
        <nav class="sidebar-nav">



            <ul class="nav" style="    margin-top: 37px;">
                <li class="nav-title cicuclum_title">
                    @lang('menus.backend.sidebar.courses.circulum')
                </li>


                @foreach ($course->chapter()->get() as $key => $item)
                    <li
                        class="nav-item nav-dropdown cicuclum_li {{ active_class(Active::checkUriPattern(['user/courses*', 'user/lessons*', 'user/tests*', 'user/questions*']), 'open') }}">
                        <a class="nav-link nav-dropdown-toggle {{ active_class(Active::checkUriPattern('admin/*')) }}"
                            href="#">

                            <i class="nav-icon icon-puzzle"></i> @if (session('locale') == 'ar') {{ $item->title_ar ?? $item->title }} @else {{ $item->title ?? $item->title_ar }} @endif

                        </a>

                        <ul class="nav-dropdown-items">
                            @foreach ($item->lessons as $lesson_key => $lesson_item)

                                <li class="nav-item ">
                                    <a class="nav-link {{ $request->segment(2) == 'courses' ? 'active' : '' }}"
                                        @if (in_array($lesson_item->id, $completed_lessons))href="{{ route('lessons.show', ['id' => $course->id, 'slug' => $lesson_item->slug]) }}"@endif>

                                        <span class="title text-color"> @if (session('locale') == 'ar') {{ $lesson_item->title_ar ?? $lesson_item->title }} @else {{ $lesson_item->title ?? $lesson_item->title_ar }}  @endif</span>

                                    </a>
                                </li>
                            @endforeach
                            @foreach ($item->test as $lesson_key => $lesson_item)

                                <li class="nav-item ">
                                    <a class="nav-link {{ $request->segment(2) == 'courses' ? 'active' : '' }}"
                                        @if (in_array($lesson_item->id, $completed_lessons))href="{{ route('lessons.show', ['id' => $course->id, 'slug' => $lesson_item->slug]) }}"@endif>

                                        <span class="title text-color"> @if (session('locale') == 'ar') {{ $lesson_item->title_ar ?? $lesson_item->title }} @else {{ $lesson_item->title ?? $lesson_item->title_ar }}  @endif</span>

                                    </a>
                                </li>
                            @endforeach

                        </ul>
                    </li>
                @endforeach
                {{--  --}}
                {{-- @foreach ($lesson_item->course->tests()->get() as $key => $item)                                      
                 <li class="nav-item nav-dropdown {{ active_class(Active::checkUriPattern(['user/courses*', 'user/lessons*', 'user/tests*', 'user/questions*']), 'open') }}">
                     <a class="nav-link nav-dropdown-toggle {{ active_class(Active::checkUriPattern('admin/*')) }}"  href="#">                                               
                         
                         <i class="nav-icon icon-puzzle"></i>  @if (session('locale') == 'ar') {{ $item->title_ar??$item->title }} @else {{ $item->title??$item->title_ar }} @endif
                                                                        
                     </a>
 
                    
                 </li>            
                 @endforeach --}}
                {{--  --}}

            </ul>
        </nav>

        @if (count($blogs) > 0)


            <li style="background: #e4e5e6;margin-top: 20px"
                class="nav-item nav-dropdown list-unstyled cicuclum_li {{ active_class(Active::checkUriPattern(['user/courses*', 'user/lessons*', 'user/tests*', 'user/questions*']), 'open') }}">
                <a class="nav-link nav-dropdown-toggle {{ active_class(Active::checkUriPattern('admin/*')) }}" href="#">

                    <i class="nav-icon icon-puzzle"></i> @lang('labels.frontend.course.blog')

                </a>
                @foreach ($blogs as $item)
                    <ul class="nav-dropdown-items">
                        <li>
                            <a class="nav-link "
                                href="{{ route('courses.blogs', ['slug' => $item->slug, 'course_id' => $course->id]) }}">{{ $item->title }}</a>
                        </li>
                    </ul>
                @endforeach
            </li>
        @endif
        @if (count($impactMeasurments) > 0)

            <li style="background: #e4e5e6;margin-top: 20px"
                class="nav-item nav-dropdown list-unstyled cicuclum_li {{ active_class(Active::checkUriPattern(['user/courses*', 'user/lessons*', 'user/tests*', 'user/questions*']), 'open') }}">
                <a class="nav-link nav-dropdown-toggle {{ active_class(Active::checkUriPattern('admin/*')) }}" href="#">

                    <i class="nav-icon icon-puzzle"></i> @lang('labels.frontend.course.impact')

                </a>
                @foreach ($impactMeasurments as $item)

                    <ul class="nav-dropdown-items">
                        <li>
                            <a class="nav-link "
                                href="{{ route('courses.impacts', ['id' => $item->id, 'course_id' => $course->id]) }}">@if (Lang::locale() == 'en'){{ $item->name ? $item->name : $item->name_ar }}@else {{ $item->name_ar ? $item->name_ar : $item->name }} @endif</a>
                        </li>
                    </ul>
                @endforeach
            </li>
        @endif
        @if (count($programRecommendations) > 0)

            <li style="background: #e4e5e6;margin-top: 20px"
                class="nav-item nav-dropdown list-unstyled cicuclum_li {{ active_class(Active::checkUriPattern(['user/courses*', 'user/lessons*', 'user/tests*', 'user/questions*']), 'open') }}">
                <a class="nav-link nav-dropdown-toggle {{ active_class(Active::checkUriPattern('admin/*')) }}" href="#">

                    <i class="nav-icon icon-puzzle"></i> @lang('labels.frontend.course.programRec')

                </a>
                @foreach ($programRecommendations as $item)

                    <ul class="nav-dropdown-items">
                        <li>
                            <a class="nav-link "
                                href="{{ route('courses.programRecommendations', ['id' => $item->id, 'course_id' => $course->id]) }}">@if (Lang::locale() == 'en'){{ $item->name ? $item->name : $item->name_ar }}@else {{ $item->name_ar ? $item->name_ar : $item->name }} @endif</a>
                        </li>
                    </ul>
                @endforeach
            </li>
        @endif
        <div style="margin-bottom: 50px"></div>
        <span class="float-none">@lang('labels.frontend.course.course_timeline')</span>
        <div class="couse-feature ul-li-block">
            <ul>
                <li>@lang('labels.frontend.course.chapters')
                    <span> {{ $course->chapterCount() }} </span>
                </li>
                <li>@lang('labels.frontend.course.category') <span><a
                            href="{{ route('courses.category', ['category' => $course->category->slug]) }}"
                            target="_blank">{{ $course->category->name }}</a> </span></li>
                <li>@lang('labels.frontend.course.author') <span>

                        @foreach ($course->teachers as $key => $teacher)
                            @php $key++ @endphp
                            <a href="{{ route('teachers.show', ['id' => $teacher->id]) }}" target="_blank">
                                {{ $teacher->full_name }}@if ($key < count($course->teachers)), @endif
                            </a>
                        @endforeach
                    </span>
                </li>
                <li>@lang('labels.frontend.course.progress') <span> <b>
                            {{ $course->progress() }}
                            % @lang('labels.frontend.course.completed')</b></span></li>
            </ul>

        </div>
        <button class="sidebar-minimizer brand-minimizer" type="button"></button>
    </div>
    <!--sidebar-->
@endsection
@push('after-scripts')
    {{-- <script src="//www.youtube.com/iframe_api"></script> --}}
    <script src="{{ asset('plugins/sticky-kit/sticky-kit.js') }}"></script>
    <script src="https://cdn.plyr.io/3.5.3/plyr.polyfilled.js"></script>
    <script src="{{ asset('plugins/touchpdf-master/pdf.compatibility.js') }}"></script>
    <script src="{{ asset('plugins/touchpdf-master/pdf.js') }}"></script>
    <script src="{{ asset('plugins/touchpdf-master/jquery.touchSwipe.js') }}"></script>
    <script src="{{ asset('plugins/touchpdf-master/jquery.touchPDF.js') }}"></script>
    <script src="{{ asset('plugins/touchpdf-master/jquery.panzoom.js') }}"></script>
    <script src="{{ asset('plugins/touchpdf-master/jquery.mousewheel.js') }}"></script>
    <script src="https://cdn.jsdelivr.net/npm/js-cookie@2/src/js.cookie.min.js"></script>



@endpush
