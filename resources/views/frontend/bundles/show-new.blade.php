@extends('frontend.layouts.app'.config('theme_layout'))

@section('title', ($bundle->meta_title) ? $bundle->meta_title : app_name() )
@section('meta_description', $bundle->meta_description)
@section('meta_keywords', $bundle->meta_keywords)

@push('after-styles')
    <!-- ====Custom Stylesheet -->
    <link rel="stylesheet" href="{{ asset('iv/css/course_details.css') }}" />
    <link href="{{ asset('iv/assets/rating/css/star-rating.css') }}" media="all" rel="stylesheet" type="text/css" />
    <link href="{{ asset('iv/assets/rating/themes/krajee-svg/theme.css') }}" media="all" rel="stylesheet" type="text/css" />
    @if (session('locale') == 'en')
    <style>
 .course-location .title{
        margin-right: 11;
        float: right;
    }
    .course-location-container div{
    width: 24%
}
.the-product.details .course-content .course-curriclum .btn-curr{
    text-align: left
}
.bundle-share{
    background-color: #641225 !important;
    color: white !important;
    height: 51px !important;
}
    </style>
   @else
   <style>
       
       /* .course-location-container div{
    width: 20%
}
.location-name{
           width: 40% !important;
       } */
       .bundle-share{
    background-color: #641225 !important;
    color: white !important;
    height: 51px !important;
}

   </style>
    @endif
@endpush


@section('content')


    <section class="row the-slider" id="slider">
        <div style="background-size: cover;height:fit-content;padding-bottom: 20px;">
            <div class="container">
                <div class="row benefit-notes">
                    <!-- ===========course details part1============ -->
                    <!--==========course description right==========-->
                    <div class="  col-md-6  benefit wow fadeInUp ptb-50 course-content mt-0">
                        <h4>
                          {{-- <a class="color-primary text-color" href="{{route('courses.details',['course'=>$course->slug])}}"> --}}

                          <a class="color-primary text-color" href="#">
                            @if (session('locale') == 'ar') {{ $bundle->title_ar ?? $bundle->title }} @else {{ $bundle->title ?? $bundle->title_ar }} @endif
                        </a>  
                        </h4>
                        <p>
                            {!! $bundle->description !!}
                        </p>
                        <ul class="list-unstyled m-0 p-0">
                            <li>
                                <i class="fas fa-clock mr-20"></i>
                                <span>@lang('labels.frontend.layouts.courses'):</span>
                                <strong>{{count($bundle->courses)}}
                                    @lang('labels.frontend.course.course')</strong>
                            </li>

                            @if($bundle->start_date)
                            <li>
                                <i class="fas fa-calendar mr-20"></i>
                                <span>@lang('labels.frontend.layouts.course.start-date'):</span>
                                <strong>{{$bundle->start_date}}
                                   </strong>
                            </li>
                            @endif
                            @if($bundle->end_date)
                            <li>
                                <i class="fas fa-calendar mr-20"></i>
                                <span>@lang('labels.frontend.layouts.course.end-date'):</span>
                                <strong>{{$bundle->end_date}}
                                   </strong>
                            </li>
                            @endif
                          
                        </ul>
                        <div>

                        </div>

                        {{-- <a href="{{ route('courses.search', $course->type_id) }}"
                            class="btn btn-primary btn-sm btn-gray  link-border">@if (session('locale') == 'ar') {{ $course->type->name_ar }} @else {{ $course->type->name }} @endif </a> --}}
                        <a href="{{ route('bundles.category', $bundle->category->slug) }}"
                            class="btn btn-primary btn-gray btn-sm  link-border">@if (session('locale') == 'ar') {{ @$bundle->category->name_ar }} @else {{ @$bundle->category->name }} @endif </a>
                            @include('frontend.bundles.buy_button')

                    </div>
                    <!--/*==========course description right ==========-->

                    <!--==========course description left ==========-->

                <div class="  col-md-6  benefit wow fadeInUp ptb-50 course-content mt-0">
                    @if($bundle->course_image != "")
                    <a class="color-primary text-color" href="#">
                        <img src="{{asset('storage/uploads/'.$bundle->course_image)}}" style="width: 100%;object-fit: cover;
                        border-radius: 10px;
                        height: 307px;" alt="">
                    </a>
  
                        
                    @else
                    {{-- <a class="color-primary text-color" href="{{route('courses.details',['course'=>$course->slug])}}"> --}}
                    <a class="color-primary text-color" href="#">
                    
                        <img src="{{asset('iv'.'/images/courses/1.jpg')}}" style="width: 100%;object-fit: cover;
                        border-radius: 10px;
                        height: 307px;" alt="">
                    </a>
                  
                    @endif

                        <div class="mt-16" style="display: flex;justify-content: space-between;">
                            <div>


                                <div style="direction: ltr;display: block;width: 100%">
                                    <span class="rate-title" for=""> قيم الباقة التعليمية</span>
                                    <input name="course_rate" id="kartik" class="rating rating-loading" data-stars="5"
                                        data-step="1" title="" data-rtl=1 />
                                </div>
                            </div>
                            <div class="prefer">
                                <span class="rate-title mr-3 " for="">
                                    @lang('labels.frontend.layouts.course.add_to_wishlist') </span>
                                <a href="">
                                    <img class="add-star" src="{{ asset('iv') }}/images/star.png" alt="">
                                    <i class="fa fa-plus plus-icon-star"></i>
                                </a>
                            </div>

                            <div class="clear"></div>
                            <div>

                            </div>
                        </div>

                    </div>
                </div>
               


            </div>
        </div>
    </section>

    <!-- ===========More course Details -->
  
    <!--==========The Product==========-->
    <section class="row the-product course-related" id="product">
        <div class="container">
            <div class="row section-header wow fadeInUp">
                <h2>@lang('labels.frontend.course.courses')</h2>

            </div>
            <div class="tab-content">

                <div role="tabpanel" class="tab-pane active" id="tab-1">
                    <div class="row collections">

                        @if (count($bundle->courses) > 0)
                            @foreach ($bundle->courses as $course)
                                <div class="  col-md-4 item  fadeIn">
                                    @include('frontend.layouts.partials.course_box')
                                </div>
                            @endforeach
                        @else
                            @lang('labels.frontend.layouts.course.no-related')
                        @endif


                    </div>
                </div>

            </div>

        </div>
    </section>
    <!--========== /*The Product==========-->

    <!--  -->
  <!--==========The Product==========-->
  {{-- <section class="row the-product details" id="product">
    <div class="container">
        <div class="row benefit-notes">

            <div class="  col-md-6  benefit wow fadeInUp ptb-50 course-content mt-0">
               
        
        <div class="couse-comment">
            <div class="blog-comment-area ul-li about-teacher-2">
                @if(count($bundle->reviews) > 0)
                <ul class="comment-list">
                    @foreach($bundle->reviews as $item)
                    <li class="d-block">
                        <div class="comment-avater">
                            <img src="{{$item->user->picture}}" alt="">
                        </div>

                        <div class="author-name-rate">
                            <div class="author-name float-left">
                                @lang('labels.frontend.course.by'):
                                <span>{{$item->user->full_name}}</span>
                            </div>
                            <div class="comment-ratting float-right ul-li">
                                <ul>
                                    @for($i=1; $i<=(int)$item->rating; $i++)
                                        <li><i class="fas fa-star"></i></li>
                                        @endfor
                                </ul>
                                @if(auth()->check() && ($item->user_id ==
                                auth()->user()->id))
                                <div>
                                    <a href="{{route('courses.review.edit',['id'=>$item->id])}}"
                                        class="mr-2">@lang('labels.general.edit')</a>
                                    <a href="{{route('courses.review.delete',['id'=>$item->id])}}"
                                        class="text-danger">@lang('labels.general.delete')</a>
                                </div>

                                @endif
                            </div>
                            <div class="time-comment float-right">
                                {{$item->created_at->diffforhumans()}}</div>
                        </div>
                        <div class="author-designation-comment">
                            <p>{{$item->content}}</p>
                        </div>
                    </li>
                    @endforeach
                </ul>
                @else
                <h4> @lang('labels.frontend.course.no_reviews_yet')</h4>
                @endif

                @if ($purchased_bundle)
                @if(isset($review) || ($is_reviewed == false))
                <div class="reply-comment-box">
                    <div class="review-option">
                        <div class="section-title-2  headline text-left float-left">
                            <h2>@lang('labels.frontend.course.add_reviews')</h2>
                        </div>
                        <div class="review-stars-item float-right mt15">
                            <span>@lang('labels.frontend.course.your_rating'): </span>
                            <div class="rating">
                                <label>
                                    <input type="radio" name="stars" value="1" />
                                    <span class="icon"><i class="fas fa-star"></i></span>
                                </label>
                                <label>
                                    <input type="radio" name="stars" value="2" />
                                    <span class="icon"><i class="fas fa-star"></i></span>
                                    <span class="icon"><i class="fas fa-star"></i></span>
                                </label>
                                <label>
                                    <input type="radio" name="stars" value="3" />
                                    <span class="icon"><i class="fas fa-star"></i></span>
                                    <span class="icon"><i class="fas fa-star"></i></span>
                                    <span class="icon"><i class="fas fa-star"></i></span>
                                </label>
                                <label>
                                    <input type="radio" name="stars" value="4" />
                                    <span class="icon"><i class="fas fa-star"></i></span>
                                    <span class="icon"><i class="fas fa-star"></i></span>
                                    <span class="icon"><i class="fas fa-star"></i></span>
                                    <span class="icon"><i class="fas fa-star"></i></span>
                                </label>
                                <label>
                                    <input type="radio" name="stars" value="5" />
                                    <span class="icon"><i class="fas fa-star"></i></span>
                                    <span class="icon"><i class="fas fa-star"></i></span>
                                    <span class="icon"><i class="fas fa-star"></i></span>
                                    <span class="icon"><i class="fas fa-star"></i></span>
                                    <span class="icon"><i class="fas fa-star"></i></span>
                                </label>
                            </div>
                        </div>
                    </div>
                    <div class="teacher-faq-form">
                        @php
                        if(isset($review)){
                        $route = route('courses.review.update',['id'=>$review->id]);
                        }else{
                        $route = route('courses.review',['course'=>$bundle->id]);
                        }
                        @endphp
                        <form method="POST" action="{{$route}}" data-lead="Residential">
                            @csrf
                            <input type="hidden" name="rating" id="rating">
                            <label
                                for="review">@lang('labels.frontend.course.message')</label>
                            <textarea name="review" class="mb-2" id="review" rows="2"
                                cols="20">@if(isset($review)){{$review->content}} @endif</textarea>
                            <span
                                class="help-block text-danger">{{ $errors->first('review', ':message') }}</span>
                            <div class="nws-button text-center text-uppercase">
                                <button type="submit"
                                    value="Submit">@lang('labels.frontend.course.add_review_now')
                                </button>
                            </div>
                        </form>
                    </div>
                </div>
                @endif
                @endif


            </div>
        </div>
       
            </div>
         

        </div>

    </div>
</section> --}}



@endsection

@push('after-scripts')

    <!-- custom js -->
    <script src="{{ asset('iv/assets/rating/js/star-rating.js') }}"></script>

    <script>
        $(document).on('change', 'input[name="stars"]', function() {
            $('#rating').val($(this).val());

        })
        $(document).ready(function() {
            $('.caption').css({
                'display': 'none'
            })
        })
    </script>


    <script>
        const player = new Plyr('#player');

        $(document).on('change', 'input[name="stars"]', function() {
            $('#rating').val($(this).val());
        })
        @if (isset($review))
            var rating = "{{ $review->rating }}";
            $('input[value="' + rating + '"]').prop("checked", true);
            $('#rating').val(rating);
        
        
        @endif

    //    set rate result is deleted get from course
    // ////
        $(window).scroll(function() {
            var bodyTop = $('html').scrollTop();
            if (bodyTop >= 30) {
                $('.count').each(function() {
                    $(this).prop('Counter', 0).animate({
                        Counter: $(this).data('value')
                    }, {
                        duration: 2000,
                        easing: 'swing',
                        step: function(now) {
                            $(this).text(Math.ceil(now));
                        }
                    });
                });
            }
            if (bodyTop > 320) {
                $('.get-course').addClass('active')
                $('.get-course').addClass('active2')

            } else {
                $('.get-course').removeClass('active')
                $('.get-course').removeClass('active2')

            }
            console.log(bodyTop)
        });
    </script>
@endpush
