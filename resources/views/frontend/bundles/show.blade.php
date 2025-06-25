@extends('frontend.layouts.app'.config('theme_layout'))

@section('title', ($bundle->meta_title) ? $bundle->meta_title : app_name() )
@section('meta_description', $bundle->meta_description)
@section('meta_keywords', $bundle->meta_keywords)

@push('after-styles')
    <style>
        .leanth-course.go {
            right: 0;
        }

    </style>
    <link rel="stylesheet" href="https://cdn.plyr.io/3.5.3/plyr.css"/>

@endpush

@section('content')

    <!-- Start of breadcrumb section
        ============================================= -->


      

<section class="details pt-50 pb-0" id="details">
    <div class="details-overlay">
        <div class="container-about">
            <div class="details-content">
                <div class="row">
                    
                    <div class="col-lg-9 col-md-9">
                        <div class="teacher justify-content-start">
                            <a href="#">
                                <div class="media">
                                    <i class="far fa-bookmark"></i>
                                    <div class="media-body">
                                        <h4>@lang('labels.frontend.layouts.course.category')</h4>
                                        <h5>@if(session('locale') == 'ar') {{ @$bundle->category->name_ar }} @else
                                            {{ @$bundle->category->name}} @endif </h5>
                                    </div>
                                </div>
                            </a>
                          

                        </div>
                    </div>
                    <div class="col-lg-3 col-md-3">
                        <div class="wishlist text-left">
                            <div class="wish">
                                <i class="fas fa-heart"></i>
                                <span>@lang('labels.frontend.layouts.course.add_to_wishlist')</span>
                            </div>
                        </div>
                    </div>

                    <div class="col-md-12">
                        <div class="head-details">
                            <div class="title-details">
                                <h1 class="@if(session('locale') == 'ar') text-right @else  text-left  @endif">
                                    @if(session('locale') == 'ar') {{ $bundle->title_ar }} @else {{$bundle->title}}
                                    @endif</h1>
                            </div>

                            @include('frontend.bundles.buy_button')
                        </div>
                    </div>


                    <div class="col-lg-3 col-md-12">
                        <div class="details-course mb-20">
                            <div class="details-content">
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
                            </div>
                        </div>
                        <div class="side">
                            <div class="one-side">
                                <div class="head-side">
                                    <h3> @lang('labels.frontend.layouts.course.related') </h3>
                                </div>
                                <div class="body-side">
                                    @foreach($relatedCourses as $courseTrend)
                                    @include('frontend.layouts.partials.course_list')
                                    @endforeach
                                </div>
                                <div class="multiseparator"></div>
                                <div class="head-side">
                                    <h3 class="second">CONTACT</h3>
                                </div>
                                <div class="body-side">
                                    <div class="item-side">
                                        <ul class="m-0 p-0 list-unstyled phone">
                                            <li>
                                                <i class="fas fa-phone-alt"></i>
                                                <span style="color: #000">00966533993220</span>
                                            </li>
                                        </ul>
                                    </div>
                                </div>
                                <div class="multiseparator"></div>


                            </div>
                        </div>
                    </div>
                    <div class="col-lg-9 col-md-12">
                        <div class="img-details mb-50 mt-10">
                            <img @if($bundle->course_image != "")
                            src="{{asset('storage/uploads/'.$bundle->course_image)}}" @else src="{{asset('images/course-default.jpeg')}}"  @endif alt="Details"
                            class="img-fluid"
                            style="border-radius: 10px;">
                        </div>
                        <div class="detail-course">
                           
                            <div class="bottom-content">
                                <div class="descrip content active">
                                    <div class="body-disc">
                                        <h3> @lang('labels.frontend.layouts.course.description')</h3>
                                        @if(session('locale') == 'ar') {!! $bundle->description_ar?$bundle->description_ar:$bundle->description !!} @else
                                        {!!$bundle->description !!} @endif
                                    </div>
                                </div>
                                <div class="curri content">

                                   


                                </div>
                                <div class="reviews content">


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
                                {{-- // Rates--}}

                               
                             
                            </div>
                        </div>
                      
                        <div class="related" style="margin-bottom: 0;padding-bottom:0">
                            <div class="related-overlay">
                                <div class="title-related">
                                    <h3>@lang('labels.frontend.course.courses')</h3>
                                </div>

                                <div class="row">

                                    @foreach($bundle->courses as $course)
                                    <div class="col-md-4">
                                        @include('frontend.layouts.partials.course_box')
                                    </div>
                                    @endforeach
                                </div>

                            </div>
                        </div>
                    </div>
                  
                </div>
            </div>
        </div>
    </div>
</section>


@endsection

@push('after-scripts')
    <script src="https://cdn.plyr.io/3.5.3/plyr.polyfilled.js"></script>

    <script>
        const player = new Plyr('#player');
        $(document).on('change', 'input[name="stars"]', function () {
            $('#rating').val($(this).val());
        })
                @if(isset($review))
        var rating = "{{$review->rating}}";
        $('input[value="' + rating + '"]').prop("checked", true);
        $('#rating').val(rating);
        @endif
    </script>
@endpush