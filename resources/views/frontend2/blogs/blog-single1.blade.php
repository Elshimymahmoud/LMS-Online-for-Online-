@extends('frontend.layouts.app'.config('theme_layout'))

@section('title', ($blog->meta_title) ? $blog->meta_title : app_name() )
@section('meta_description', $blog->meta_description)
@section('meta_keywords', $blog->meta_keywords)

@push('after-styles')
<style>
    i.blog {
        font-size: 17px !important;
    }

    .cat-blog-name {
        text-decoration: none;
        color: #aaa;
        font-weight: 700;
    }
    img.blog-img{
        width: 870px;
    height: 400px;
   object-fit: fill;


    }
</style>
@endpush
@push('after-scripts')
<script src="{{asset('vendor/tinymce/tinymce.min.js')}}" referrerpolicy="origin"></script>
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
            relative_urls : false,
            image_dimensions: true,
            document_base_url : 'https://ucas.e-9.co',
            content_style:"@import  url('https://fonts.googleapis.com/css2?family=Tajawal:wght@200;300;400;500;700;800;900&display=swap');",
            font_formats: "Tajawal=Tajawal,times; Arial=arial,helvetica,sans-serif; Arial Black=arial black;  Comic Sans MS=comic sans ms,sans-serif; Courier New=courier new,courier; Georgia=georgia,palatino; Helvetica=helvetica;Tahoma=tahoma,arial,helvetica,sans-serif;Times New Roman=times new roman,times",
            toolbar: 'code | bold italic | alignleft aligncenter alignright alignjustify link | table | styleselect | fontselect  forecolor  backcolor fontsizeselect  | image | outdent indent|numlist bullist',
        
            image_title: false,
            automatic_uploads: true,

            file_picker_types: 'image',
            /* and here's our custom image picker*/
            images_upload_handler: function (blobInfo, success, failure) {
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
            relative_urls : false,
            image_dimensions: true,
            document_base_url : 'https://ucas.e-9.co',
            content_style:"@import  url('https://fonts.googleapis.com/css2?family=Tajawal:wght@200;300;400;500;700;800;900&display=swap');",
            font_formats: "Tajawal=Tajawal,times; Arial=arial,helvetica,sans-serif; Arial Black=arial black;  Comic Sans MS=comic sans ms,sans-serif; Courier New=courier new,courier; Georgia=georgia,palatino; Helvetica=helvetica;Tahoma=tahoma,arial,helvetica,sans-serif;Times New Roman=times new roman,times",
            toolbar: 'code | bold italic | alignleft aligncenter alignright alignjustify link | table | styleselect | fontselect  forecolor  backcolor fontsizeselect  | image | outdent indent|numlist bullist',
            image_title: false,
            automatic_uploads: true,

            file_picker_types: 'image',
            /* and here's our custom image picker*/
            images_upload_handler: function (blobInfo, success, failure) {
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
@endpush
@section('content')

<!-- Start of breadcrumb section
    ============================================= -->
<section id="breadcrumb" class="breadcrumb-section relative-position backgroud-style">
    <div class="blakish-overlay"></div>
    <div class="container">
        <div class="page-breadcrumb-content text-center">
            <div class="page-breadcrumb-title">
                {{-- <h2 class="breadcrumb-head black bold">{{$blog->title}}</h2> --}}
            </div>
        </div>
    </div>
</section>
<!-- End of breadcrumb section
        ============================================= -->


<!-- Start of Blog single content
        ============================================= -->
<section class="details pt-50 pb-100" id="details">
    <div class="details-overlay">
        <div class="container-about">
            <div class="details-content">
                <div class="row">
                    <div class="col-md-12">
                        <div class="head-details">
                            <div class="title-details">
                                <h1 class="@if(session('locale') == 'ar') text-right @else  text-left  @endif">
                                    {{$blog->title}}
                                </h1>
                            </div>


                        </div>
                    </div>
                    <div class="col-lg-9 col-md-12">
                        {{-- //// --}}
                        <div class="img-details mb-50 mt-10">
                            <img @if($blog->image != "")
                            src="{{asset('storage/uploads/'.$blog->image)}}" @endif alt="Details"
                            class="img-fluid blog-img"
                            style="border-radius: 10px;">
                        </div>
                        {{-- /// --}}
                        <div class="blog-details-content">
                            <div class="post-content-details">





                                {{-- /////////////////////////////////// --}}
                                <div class="col-lg-12 col-md-12">
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
                                </div>
                                {{--//////// //// --}}


                                {{-- ///////////////// --}}
                                <p>
                                    {!! $blog->content !!}
                                </p>
                                <hr>

                            </div>

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
                            <div class="author-comment d-inline-block p-3   h-100 d-table text-center mx-auto">
                                <div class="author-img float-none">
                                    <img src="{{$blog->author->picture}}" alt="">
                                </div>
                                <span class="mt-2  d-table-cell align-middle">BY: <b>{{$blog->author->name}}</b></span>
                            </div>

                            <div class="next-prev-post">
                               
                                @if($previous != "")
                                <div class="next-post-item float-right">
                                    <a href="{{route('blogs.index',['slug'=>$previous->slug.'-'.$previous->id ])}}">
                                        Previous Post
                                        <i class="fas fa-arrow-circle-left"></i>
                                    </a>
                                </div>
                                @endif
                                @if($next != "")
                                <div class="next-post-item float-left">
                                    <a href="{{route('blogs.index',['slug'=>$next->slug.'-'.$next->id ])}}">
                                        <i class="fas fa-arrow-circle-right"></i>
                                        Next Post
                                       
                                    </a>
                                </div>
                                @endif

                               

                            </div>
                        </div>
{{-- ///////////////////////// --}}

                        {{-- //////////////////// --}}
                       

                        <div class="related">
                            <div class="related-overlay">
                                <div class="title-related">
                                    <h2> @lang('labels.frontend.blog.related_news')</h2>

                                </div>



                                <div class="row">
                                    @if(count($related_news) > 0)
                                    @foreach($related_news as $item)
                                    <div class="col-md-4">
                                        @include('frontend.blogs.partials.blog_box')
                                    </div>
                                    @endforeach
                                    @endif
                                </div>

                            </div>
                        </div>

                        <hr>
                        <div class="blog-comment-area ul-li about-teacher-2">
                            <div class="reply-comment-box">
                                <div class="section-title-2  headline ">
                                    <h2> @lang('labels.frontend.blog.post_comments')</h2>
                                </div>

                                @if(auth()->check())
                                <div class="teacher-faq-form">
                                    <form method="POST" action="{{route('blogs.comment',['id'=>$blog->id])}}"
                                        data-lead="Residential">
                                        @csrf
                                        <div class="form-group">
                                            <label for="comment"> @lang('labels.frontend.blog.write_a_comment')</label>
                                            <textarea name="comment" required class="mb-0 @if (session('locale') == 'en') editor @else editor_ar @endif" id="comment" rows="2"
                                                cols="20"></textarea>
                                            <span
                                                class="help-block text-danger">{{ $errors->first('comment', ':message') }}</span>
                                        </div>

                                        <div class="nws-button text-center text-uppercase">
                                            <button type="submit" value="Submit">
                                                @lang('labels.frontend.blog.add_comment')</button>
                                        </div>
                                    </form>
                                </div>
                                @else
                                <a id="openLoginModal" class="btn nws-button gradient-bg text-white"
                                    data-target="#myModal"> @lang('labels.frontend.blog.login_to_post_comment')</a>
                                @endif
                            </div>
                            @if($blog->comments->count() > 0)

                            <ul class="comment-list my-5">
                                @foreach($blog->comments as $item)
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
                                        @if(auth()->user())
                                        @if($item->user_id == auth()->user()->id)
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


                            </ul>
                            @else
                            <p class="my-5">@lang('labels.frontend.blog.no_comments_yet')</p>
                            @endif



                        </div>
                    </div>
                    @include('frontend.blogs.partials.sidebar')
                </div>
            </div>
        </div>
    </div>
</section>
<!-- End of Blog single content
        ============================================= -->


@endsection