@extends('frontend.layouts.app'.config('theme_layout'))

@section('title', trans('labels.frontend.home.title') . ' | ' . app_name())
@section('meta_description', '')
@section('meta_keywords', '')


@push('after-styles')
    <link rel="stylesheet" href="https://cdn.plyr.io/3.5.3/plyr.css" />
    <link href="{{ asset('plugins/touchpdf-master/jquery.touchPDF.css') }}" rel="stylesheet">
    <link href="{{ asset('css/buttons.css') }}" rel="stylesheet">



    <link rel="stylesheet" href="{{ asset('iv') }}/css/course_curriculum.css" />
    <style>
        .noData {
            width: 100%;
            height: 500px;
        }

        .next {
            width: 47%;
            display: flex;
            /* padding: 10px; */
            border: 1px solid #337ab7;
            border-radius: 26px;
            padding: 10px;
        }

        button.next {
            width: 74%;
            color: white;
            background-color: #802c41
        }

        button.retest {
            width: 30%;
            color: white;
            background-color: #802c41;
            display: flex;
            /* padding: 10px; */
            border: 1px solid #337ab7;
            border-radius: 26px;
            padding: 10px;

        }

        .course-details-category {
            display: flex;
            flex-wrap: wrap;
            flex-direction: column;
            align-content: stretch;
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
            font-family: 'FontAwesome';
            display: inline-block;
            color: green;
            @if (session('locale') == 'ar')margin-right: -2.3em;
        @else margin-left: -2.3em;
            @endif
            /* same as padding-left set on li */
            width: 1.3em;
            /* same as padding-left set on li */
        }

        .options-list li.incorrect:before {
            content: "\f057";
            /* FontAwesome Unicode */
            font-family: 'FontAwesome';
            display: inline-block;
            color: red;
            @if (session('locale') == 'ar')margin-right: -2.3em;
        @else margin-left: -2.3em;
            @endif
            /* same as padding-left set on li */
            width: 1.3em;
            /* same as padding-left set on li */
        }

        .nested-ul {
            /* border-bottom: 1px solid black; */
            border-radius: 10px;
        }

    </style>

    {{-- rate --}}
    <link rel="stylesheet" href="https://cdn.plyr.io/3.5.3/plyr.css" />


    <style>
        .cicuclum_title {
            border-bottom: 1px gray solid;
            font-size: 18px !important;
            color: #802d42 !important;
            font-weight: 700 !important;
        }

        .cicuclum_li {
            border-bottom: 1px gray solid;

        }

        .complete-btn {
            background-color: #802d42;
            color: white;
            padding: 10px;
            border-radius: 10px;
        }

        .benefit .course-details-item {
            padding: 20px;
        }

        .comment-list {
            list-style: none;
        }

        .comment-li {
            margin-top: 30px;
        }

        .comment-li .comment-avater {
            height: 70px;
            width: 70px;
            float: right;
            margin-left: 20px;
        }

        .comment-li .author-name-rate {
            width: 88%;
            font-size: 13px;
            font-weight: 700;
            display: inline-block;
            margin-top: 20px;
        }

        .comment-li .time-comment {
            float: left;
        }

        .comment-li .author-designation-comment {
            overflow: hidden;
            width: 100%;
            display: inline-block;
            margin-top: 10px;
        }

    </style>
<link rel="stylesheet" href="https://code.jquery.com/ui/1.12.1/themes/base/jquery-ui.css">

    <link href="{{ asset('assets/rating/themes/krajee-svg/theme.css') }}" media="all" rel="stylesheet" type="text/css" />
    <link href="{{ asset('assets/rating/css/star-rating.css') }}" media="all" rel="stylesheet" type="text/css" />
    <style>
        .rating-container .star {
            display: unset;
        }

    </style>
            <link rel="stylesheet" href="//cdnjs.cloudflare.com/ajax/libs/timepicker/1.3.5/jquery.timepicker.min.css">
            <link rel="stylesheet" href="{{ asset('iv') }}/css/course-sidebar-right.css" />
            @if (session('locale') == 'en')
            <style>
                .list-group-item {
                    width: 210px
                }
    
            </style>
    
        @endif
@endpush

@section('content')

@php
use Carbon\Carbon;

$days=0;
if(count(auth()->user()->courseLoc($course->id)->get())>0){
    if($course->free!=1){
    $courseLocId=isset($course_location_id)?$course_location_id:auth()->user()->courseLoc($course->id)->latest('pivot_created_at')->first()->pivot->course_location_id;
   $courseLocation=\App\Models\CourseLocation::find($courseLocId) ;
   
   
   $isEndDatePast = Carbon::parse($courseLocation->end_date)->isPast();
    if($isEndDatePast==true){
        $days=0;
    }
    else{
        $days=now()->diffInDays($courseLocation->end_date);
    }
}
}



@endphp

    <section class="row the-slider" id="slider">
        <div style="background-size: cover;height:fit-content;background-color: white;padding-bottom: 20px;">
            <div class="containers">
                <div class="row benefit-notes">
                    <div class="col-sm-12 col-md-12   wow fadeInUp2  course-nav mt-0">
                        <nav class="navbar navbar-default second-nav" style="position: unset">
                            <div class="container">
                                <!--========== Brand and toggle get grouped for better mobile display ==========-->


                                <div class="nav navbar-nav navbar-right col-md-6">
                                    <button type="button" onclick="toggleShow()" id="sidebarToggle"
                                        class="Button Button--link course-nav-toggle" aria-live="polite"
                                        aria-label="إخفاء قائمة التنقل بين الدورات" title="إخفاء قائمة التنقل بين الدورات">
                                        <i class="fa fa-bars" aria-hidden="true"></i>
                                    </button>
                                </div>
                                <div class="nav navbar-nav navbar-left col-md-6"></div>
                                <!--========== Collect the nav links, forms, and other content for toggling ==========-->

                                <div class="pull-right col-md-3 col-xs-6  ">
                                    <div class="progress">
                                        <div class="progress-bar "
                                            style='width:{{ $course->progress() ? $course->progress() : 0 }}%'
                                            role="progressbar" aria-valuenow="0" aria-valuemin="0" aria-valuemax="100">
                                            <span class="color-primary text-color">{{ $course->progress() ? $course->progress() : 0 }}%</span>
                                        </div>


                                    </div>
                                </div>
                                <div class="pull-right col-md-3 col-xs-6 mb-10 ">
                                    @if($days>0)
                                   @include('frontend.courses.remaining_days')
                                 @endif

                                </div>
                            </div>

                        </nav>
                        <!--========== /.navbar-collapse ==========-->
                    </div>
                    <!--========== /.container-fluid ==========-->

                    <div class="top-banner"></div>

                </div>
                <!-- ===========course details part1============ -->
                <!--==========course description right==========-->
                <div class="row">

                    <div class="container">
                        <div class="col-sm-12 col-md-3  benefit wow fadeInUp ptb-50 course-content mt-0" id="sidebar-right">
                            <!-- Sidebar right-->

                            @include('frontend.courses.course_sidebar_right')
                            {{-- Sidebar right --}}

                            {{-- Sidebar right --}}

                        </div>
                        <!--/*==========course description right ==========-->

                        <!--==========course description details ==========-->

                        <div class="col-sm-12 col-md-9  benefit wow fadeInUp ptb-50 course-content mt-0">
                            {{-- content blog --}}
                            @include('includes.partials.messages')

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
                                            <img src="{{ asset('storage/uploads/' . $blog->image) }}" style="width: 100%"
                                                alt="">
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
                                                <form method="POST"
                                                    action="{{ route('blogs.comment', ['id' => $blog->id]) }}"
                                                    data-lead="Residential">
                                                    @csrf
                                                    <div class="form-group">
                                                        <label for="comment">
                                                            @lang('labels.frontend.blog.write_a_comment')</label>
                                                        <textarea name="comment" required
                                                            class="mb-0 @if (session('locale') == 'en') editor @else editor_ar @endif" id="comment" rows="2"
                                                            cols="20"></textarea>
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
                                                data-target="#myModal">
                                                @lang('labels.frontend.blog.login_to_post_comment')</a>
                                        @endif
                                    </div>
                                    
                                    @if ($blog->comments->count() > 0)

                                        <ul class="comment-list my-5">
                                            @foreach ($blog->comments as $item)
                                                <li class="d-block comment-li">
                                                    <div class="comment-avater">
                                                        <img src="{{ $item->user->picture }}" alt="">
                                                    </div>

                                                    <div class="author-name-rate">
                                                        <div class="author-name float-left">
                                                            @lang('labels.frontend.blog.by'):
                                                            <span>{{ $item->name }}</span>
                                                        </div>

                                                        <div class="time-comment ">
                                                            {{ $item->created_at->diffforhumans() }}
                                                        </div><br>
                                                        @if (auth()->user())
                                                            @if ($item->user_id == auth()->user()->id)
                                                                <div class="time-comment">

                                                                    <a class="text-danger font-weight-bolf"
                                                                        href="{{ route('blogs.comment.delete', ['id' => $item->id]) }}">
                                                                        @lang('labels.general.delete')</a>

                                                                </div>
                                                            @endif
                                                        @endif

                                                    </div>
                                                    <div class="author-designation-comment">
                                                        <p>{!! $item->comment !!}</p>
                                                    </div>
                                                </li>
                                                <hr>
                                            @endforeach


                                        </ul>
                                    @else
                                        <p class="my-5">@lang('labels.frontend.blog.no_comments_yet')</p>
                                    @endif



                                </div>


                                {{-- ///// --}}

                            </div>

                            {{-- // --}}
                            {{-- content blog --}}

                        </div>
                        <!-- =======course side bar left -->
                        {{-- <div class="col-sm-12 col-md-3  benefit wow fadeInUp ptb-50 course-content mt-0">

                        <!-- Sidebar left-->
                        
                    @include('frontend.courses.course_sidebar_left')

                    </div> --}}
                    </div>
                </div>
            </div>


        </div>
        </div>
    </section>








@endsection

@push('after-scripts')
    <!-- custom js -->

    <script src="{{ asset('iv') }}/assets/rating/js/star-rating.js"></script>
    <script src="{{ asset('iv') }}/js/toggleSideBar.js"></script>

    <script>
        $(document).on('change', 'input[name="stars"]', function() {
            $('#rating').val($(this).val());

        })
        $(document).ready(function() {
            $('.caption').css({
                'display': 'none'
            })
            $barWidth=$('.progress-bar').width();
            if($barWidth!=0){
                $('.progress-bar span').removeClass("color-primary");
            }
            $('.course-sidebar').on('click', 'a.list-group-item', function() {
                $(".course-sidebar .list-group-item").removeClass("active");
                $(".course-sidebar .list-group-item").addClass("unactive");


                $(this).addClass("active");
            });

        })
    </script>
    {{-- <script src="//www.youtube.com/iframe_api"></script> --}}

    <script src="{{ asset('plugins/touchpdf-master/jquery.mousewheel.js') }}"></script>
    <script src="https://cdn.jsdelivr.net/npm/js-cookie@2/src/js.cookie.min.js"></script>

    <script src="https://cdn.plyr.io/3.5.3/plyr.polyfilled.js"></script>
    <script src="{{ asset('assets/rating/js/star-rating.js') }}"></script>

    <script src="{{ asset('plugins/sticky-kit/sticky-kit.js') }}"></script>
    <script src="https://cdn.plyr.io/3.5.3/plyr.polyfilled.js"></script>
    <script src="{{ asset('plugins/touchpdf-master/pdf.compatibility.js') }}"></script>
    <script src="{{ asset('plugins/touchpdf-master/pdf.js') }}"></script>
    <script src="{{ asset('plugins/touchpdf-master/jquery.touchSwipe.js') }}"></script>
    <script src="{{ asset('plugins/touchpdf-master/jquery.touchPDF.js') }}"></script>
    <script src="{{ asset('plugins/touchpdf-master/jquery.panzoom.js') }}"></script>
    <script src="{{ asset('plugins/touchpdf-master/jquery.mousewheel.js') }}"></script>
    <script src="https://cdn.jsdelivr.net/npm/js-cookie@2/src/js.cookie.min.js"></script>
    <script src="{{ asset('vendor/tinymce/tinymce.min.js') }}" referrerpolicy="origin"></script>
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
            plugins: "link image code table lists ",

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
                xhr.open('POST', '/admin/upload-image');
                var token = 'pPzi2iR54hDF07shAjUZokNGDPaf1JAW8goECiJj';
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
            plugins: "link image code table lists ",
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
            plugins: "link image code table lists ",
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
    <script src="http://code.jquery.com/jquery-1.9.1.js"></script>
    <script src="http://code.jquery.com/ui/1.11.0/jquery-ui.js"></script>
    <script src="//cdnjs.cloudflare.com/ajax/libs/timepicker/1.3.5/jquery.timepicker.min.js"></script>
    <script src="{{ asset('ivory/assets/js/datepickerConfig.js') }}"></script>
@endpush
