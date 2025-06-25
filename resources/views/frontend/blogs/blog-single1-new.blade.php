@extends('frontend.layouts.app'.config('theme_layout'))

@section('title', trans('labels.frontend.home.title') . ' | ' . app_name())
@section('meta_description', '')
@section('meta_keywords', '')


@push('after-styles')
    <link rel="stylesheet" href="https://cdn.plyr.io/3.5.3/plyr.css" />
    <link href="{{ asset('plugins/touchpdf-master/jquery.touchPDF.css') }}" rel="stylesheet">

    <link href="{{ asset('iv') }}/assets/rating/css/star-rating.css" media="all" rel="stylesheet" type="text/css" />
    <link href="{{ asset('iv') }}/assets/rating/themes/krajee-svg/theme.css" media="all" rel="stylesheet"
        type="text/css" />

    <link rel="stylesheet" href="{{ asset('iv') }}/css/blog_details.css" />
    <style>
        .text-right {
            text-align: right;
        }

        .text-left {
            text-align: left;
        }

        .blog-body .fa {
            padding: 10px;
        }

        .blog {
            padding: 15px
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
    <style>
        .card {
            border: none;
            box-shadow: 5px 6px 6px 2px #e9ecef;
            border-radius: 4px;
            padding: 10px;
            background-color: aliceblue;
            margin-top: 19px;
        }

        .dots {
            height: 4px;
            width: 4px;
            margin-bottom: 2px;
            background-color: #bbb;
            border-radius: 50%;
            display: inline-block
        }

        .badge {
            padding: 7px;
            padding-right: 9px;
            padding-left: 16px;
            box-shadow: 5px 6px 6px 2px #e9ecef
        }

        .user-img {
            margin-top: 4px
        }

        .check-icon {
            font-size: 17px;
            color: #c3bfbf;
            top: 1px;
            position: relative;
            margin-left: 3px
        }

        .form-check-input {
            margin-top: 6px;
            margin-left: -24px !important;
            cursor: pointer
        }

        .form-check-input:focus {
            box-shadow: none
        }

        .icons i {
            margin-left: 8px
        }

        .reply {
            margin-left: 12px
        }

        .reply small {
            color: #b7b4b4
        }
/*  */
.date {
    font-size: 11px
}

.comment-text {
    font-size: 12px
}

.fs-12 {
    font-size: 12px
}

.shadow-none {
    box-shadow: none
}

.name {
    color: #007bff
}

.cursor:hover {
    color: blue
}

.cursor {
    cursor: pointer
}

.textarea {
    resize: none
}
.comment_textarea{
    margin-left: 20px
}
.textarea_parent{
    display: flex;
    align-items: center;
}
img.rounded-circle{
    border-radius: 50%;
    margin-left: 10px;
}
.blog-comment-area{
    margin-top: 20px;
}
    </style>
@endpush

@section('content')

    <div class="row">

        <div class="container">



            <!--==========blog details  ==========-->
            <div class="col-sm-12 col-md-1   wow fadeInUp ptb-50 blog mt-0">
            </div>
            <div class="col-sm-12 col-md-10   wow fadeInUp ptb-50 blog mt-0">


                <div class="blog-header">
                    <h5>
                        {{ Lang::locale() == 'ar' ? $blog->category->name_ar : $blog->category->name }}

                    </h5>
                    <h3 class="@if (session('locale') == 'ar') text-right @else  text-left @endif">{{ $blog->title }}</h3>

                </div>
                <div class="blog-body">
                    <div class="col-md-6">
                        <img @if ($blog->image != '') src="{{ asset('storage/uploads/' . $blog->image) }}"@else src="{{ asset('iv') }}/images/courses/1.jpg" @endif
                        class="blog-img" alt="">
                    </div>
                    <div class="col-md-6">
                   
                    <p>
                        <i style="color: brown" class="fa fa-calendar-o"> {{ $blog->created_at->format('d M Y') }}</i>

                        <i style="color: brown" class="fa fa-user"><small style="margin:3px;"
                            >{{ Lang::locale() == 'ar' ? $blog->author->full_name_ar : $blog->author->full_name }}</small></i>
                        <i class="fa fa-comment">{{ $blog->comments->count() }}</i>
                    </p>
                    <hr>

                    <p class="blog-p">
                        {!! $blog->content !!}

                    </p>
                   
                </div>
                {{-- downloadable files --}}
                @if ($blog->downloadableMedia != '' && $blog->downloadableMedia->count() > 0)
                <div class=" col-lg-12">
               
                <div class="course-single-text mt-4 px-3 py-1  ">
                    <div class="course-title mt10 headline relative-position">
                        <h4>
                            @lang('labels.frontend.course.download_files')
                        </h4>
                    </div>

                    @foreach ($blog->downloadableMedia as $media)
                        <div class="course-details-content">
                            <p class="form-group">
                                <a href="{{ route('download', ['filename' => $media->name, 'blog' => $blog->id]) }}"
                                    class="font-weight-bold"><i class="fa fa-download"></i>
                                    {{ $media->name }}
                                    ({{ number_format((float) $media->size / 1024, 2, '.', '') }}
                                    @lang('labels.frontend.course.mb')
                                    )</a>
                            </p>
                        </div>
                    @endforeach
                </div>
                </div>
            @endif

                {{-- =================== --}}
                    {{-- blog comment --}}
                    <hr>
                    <div class="blog-comment-area ul-li about-teacher-2 col-lg-12">
                        <div class="reply-comment-box">
                            <div class="section-title-2  headline ">
                                <h2 style="    color: #641225;"> @lang('labels.frontend.blog.post_comments')</h2>
                            </div>

                            @if (auth()->check())
                                <div class="teacher-faq-form">
                                    <form method="POST" action="{{ route('blogs.comment', ['id' => $blog->id]) }}"
                                        data-lead="Residential">
                                        @csrf
                                        {{-- <div class="form-group">
                                            <label for="comment"> @lang('labels.frontend.blog.write_a_comment')</label>
                                            <textarea name="comment" required
                                                class="mb-0 @if (session('locale') == 'en') editor @else editor_ar @endif"
                                                id="comment" rows="2" cols="20"></textarea>
                                            <span
                                                class="help-block text-danger">{{ $errors->first('comment', ':message') }}</span>
                                        </div> --}}

                                        {{-- <div class="nws-button text-center text-uppercase">
                                            <button type="submit" value="Submit">
                                                @lang('labels.frontend.blog.add_comment')</button>
                                        </div> --}}

                                        <div class="bg-light p-2">
                                            <label for="comment"> @lang('labels.frontend.blog.write_a_comment')</label>

                                            <div class="d-flex flex-row align-items-start textarea_parent form-group">
                                                <img class="rounded-circle" src="{{auth()->user()->picture}}" width="40">
                                                <textarea name="comment" required class="form-control ml-1 comment_textarea shadow-none textarea @if (session('locale') == 'en') editor @else editor_ar @endif"></textarea>
                                                <span style="color:red" class="help-block text-danger">{{ $errors->first('comment', ':message') }}</span>
                                            </div>
                                            <div class="nws-button text-center  text-uppercase">
                                            <button type="submit" class="btn btn-primary" value="Submit">
                                                @lang('labels.frontend.blog.add_comment')</button>
                                        </div>
                                        </div>
                                    </form>
                                </div>
                            @else
                                <a id="openLoginModal" class="btn nws-button  text-white" data-target="#myModal">
                                    @lang('labels.frontend.blog.login_to_post_comment')</a>
                            @endif
                        </div>
                        @if ($blog->comments->count() > 0)

                            @foreach ($blog->comments as $item)
                                <div class="card p-3">
                                    <div class="d-flex justify-content-between align-items-center">
                                        <div class="user d-flex flex-row align-items-center"> <img
                                                src="{{ $item->user->picture }}" width="30"
                                                class="user-img rounded-circle mr-2"> <span><small
                                                    class="font-weight-bold text-primary"> {{ $item->name }}</small>
                                                <small class="font-weight-bold">
                                                    <p style="    margin-top: 10px;">{!! $item->comment !!}</p>
                                                </small></span> </div>
                                        <small>{{ $item->created_at->diffforhumans() }}</small>
                                    </div>
                                    <div class="action d-flex justify-content-between mt-2 align-items-center">
                                        <div class="reply px-4"> <small>
                                                @if (auth()->user())
                                                    @if ($item->user_id == auth()->user()->id)
                                                        <a class="text-danger font-weight-bolf"
                                                            href="{{ route('blogs.comment.delete', ['id' => $item->id]) }}">
                                                            @lang('labels.general.delete')</a>
                                                    @endif
                                                @endif


                                        </div>
                                    </div>
                                </div>
                            @endforeach
                            {{-- <ul class="comment-list my-5">
                        @foreach ($blog->comments as $item)
                        <li class="d-block">
                            <div class="comment-avater">
                                <img style="max-width: 100%;" src="{{$item->user->picture}}" alt="">
                            </div>

                            <div class="author-name-rate">
                                <div class="author-name float-left">
                                    @lang('labels.frontend.blog.by'): <span>{{$item->name}}</span>
                                </div>

                                <div class="time-comment float-right">{{$item->created_at->diffforhumans()}}
                                </div><br>
                                @if (auth()->user())
                                @if ($item->user_id == auth()->user()->id)
                                <div class="time-comment float-right">

                                    <a class="text-danger font-weight-bolf"
                                        href="{{route('blogs.comment.delete',['id'=>$item->id])}}">
                                        @lang('labels.general.delete')</a>

                                </div>
                                @endif
                                @endif

                            </div>
                            <div class="author-designation-comment">
                                <p>{!!$item->comment!!}</p>
                            </div>
                        </li>
                        @endforeach


                    </ul> --}}



                        @else
                            <p class="my-5">@lang('labels.frontend.blog.no_comments_yet')</p>
                        @endif



                    </div>

                </div>
            </div>
            <div class="col-sm-12 col-md-2   wow fadeInUp ptb-50 blog mt-0">
            </div>
            <!--==========blog details  ==========-->
            <!--========== more blog details  ==========-->

            <div class="col-sm-12 col-md-12 collections   wow fadeInUp ptb-50 blogs-container mt-0">
                <h4 class="primary-color blog-read-more">اقرآ المزيد</h4>
                @if (count($related_news) > 0)
                    @foreach ($related_news as $item)
                        <div class="blog-box item col-sm-6 col-md-4">
                            @include('frontend.blogs.partials.blog_box_new')
                        </div>
                    @endforeach
                @endif


            </div>
        </div>
    </div>








@endsection

@push('after-scripts')
    <!-- custom js -->



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
