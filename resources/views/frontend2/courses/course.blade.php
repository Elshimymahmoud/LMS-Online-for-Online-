@extends('frontend.layouts.app'.config('theme_layout'))

@section('title', ($course->meta_title) ? $course->meta_title : app_name() )
@section('meta_description', $course->meta_description)
@section('meta_keywords', $course->meta_keywords)

@push('after-styles')
<style>
    .leanth-course.go {
        right: 0;
    }
    .type-none{
        list-style-type: none;
    }
    .zoom-in-out-box {
 
  animation: zoom-in-zoom-out 1s ease infinite;
}

@keyframes zoom-in-zoom-out {
  0% {
    transform: scale(1, 1);
  }
  50% {
    transform: scale(1.2, 1.2);
  }
  100% {
    transform: scale(1, 1);
  }
}
</style>
<link rel="stylesheet" href="https://cdn.plyr.io/3.5.3/plyr.css" />

<link href="{{asset('assets/rating/css/star-rating.css')}}" media="all" rel="stylesheet" type="text/css"/>
<link href="{{asset('assets/rating/themes/krajee-svg/theme.css')}}" media="all" rel="stylesheet" type="text/css"/>
@endpush

@section('content')

@php
$mainCourse=$course;
@endphp

<section class="details pt-50 pb-100" id="details">
    <div class="details-overlay">
        <div class="container-about">
            <div class="details-content">
                <div class="row">
                    <div class="col-lg-9 col-md-9">
                        <div class="teacher justify-content-start">
                            <a href="{{route('courses.category',$course->category->slug)}}">
                                <div class="media">
                                    <i class="far fa-bookmark"></i>
                                    <div class="media-body">
                                        <h4>@lang('labels.frontend.layouts.course.category')</h4>
                                        <h5>@if(session('locale') == 'ar') {{ @$course->category->name_ar }} @else
                                            {{ @$course->category->name}} @endif 
                                          
                                        </h5>
                                    </div>
                                </div>
                            </a>
                            <a href="{{route('courses.search',$course->type_id)}}">
                                <div class="media">
                                    <i class="fas fa-tag"></i>
                                    <div class="media-body">
                                        <h4>@lang('labels.frontend.layouts.course.type')</h4>
                                        <h5>@if(session('locale') == 'ar') {{ $course->type->name_ar }} @else {{$course->type->name}} @endif</h5>
                                    </div>
                                </div>
                            </a>
                            {{-- <a href="#">
                                <div class="media">
                                    <i class="fas fa-map-marker-alt"></i>
                                    <div class="media-body">
                                        <h4>@lang('labels.frontend.layouts.course.location')</h4>
                                        <h5>@if(session('locale') == 'ar') {{ @$course->location->name_ar }} @else
                                            {{ @$course->location->name}} @endif</h5>
                                    </div>
                                </div>
                            </a> --}}
                            <a href="#">
                                <div class="media">
                                    <img src="{{ $course->teachers[0]->picture}}">
                                    <div class="media-body">
                                        <h4>@lang('labels.frontend.layouts.course.teacher')</h4>
                                        <h5>@if(session('locale') == 'ar')
                                            {{ $course->teachers[0]->name_ar??$course->teachers[0]->name }} @else
                                            {{$course->teachers[0]->name??$course->teachers[0]->name_ar}} @endif</h5>
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
                                    @if(session('locale') == 'ar') {{ $course->title_ar }} @else {{$course->title}}
                                    @endif</h1>
                            </div>

                            @include('frontend.courses.buy_button')
                        </div>
                    </div>


                    <div class="col-lg-4 col-md-12">
                        <div class="details-course mb-20">
                            <div class="details-content">
                                <ul class="list-unstyled m-0 p-0">
                                    <li id="CourseLocation">
                                        <i class="fas fa-plus mr-20"></i>
                                       
                                        <button class="btn" type="button" data-toggle="collapse" data-target="#collapseExample" aria-expanded="false" aria-controls="collapseExample">
                                           @lang('labels.frontend.layouts.course.locations')
                                          </button>
                                        
                                          <div class="collapse" id="collapseExample" style="margin-top: 7px;">
                                           
                                            <div class="card card-body">
                                                <ol type="1"  class="list-group list-group-horizontal">
                                                   
                                              @if(count($courseLocations)>0)
                                                @foreach ($courseLocations as $location)
                                                <li class="list-group-item">
                                                    <ul class="list-group">
                                                        <li class="type-none">{{$location->location->name_ar}} / {{$location->price}} {{$appCurrency['symbol']}}</li>
                                                        @if($location->start_date)
                                                        <li class="type-none">
                                                            <i class="fas fa-calendar mr-20"></i>
                                                            <span>@lang('labels.frontend.layouts.course.start-date'):</span>
                                                            <strong>{{$location->start_date}}
                                                               </strong>
                                                        </li>
                                                        @endif
                                                        @if($location->end_date)
                                                        <li class="type-none">
                                                            <i class="fas fa-calendar mr-20"></i>
                                                            <span>@lang('labels.frontend.layouts.course.end-date'):</span>
                                                            <strong>{{$location->end_date}}
                                                               </strong>
                                                        </li>
                                                        @endif
                                                    </ul>
                                                    
                                                </li>
                                                @include('frontend.courses.buy_button2')
                                                @endforeach
                                                
                                                    
                                                @else
                                                    @lang('menus.backend.sidebar.courses.no_location')
                                                @endif
                                            </ol>
                                            </div>
                                          </div>
                                    </li>
                                  @if($course->start_date)
                                    <li>
                                        <i class="fas fa-calendar mr-20"></i>
                                        <span>@lang('labels.frontend.layouts.course.start-date'):</span>
                                        <strong>{{$course->start_date}}
                                           </strong>
                                    </li>
                                    @endif
                                    @if($course->end_date)
                                    <li>
                                        <i class="fas fa-calendar mr-20"></i>
                                        <span>@lang('labels.frontend.layouts.course.end-date'):</span>
                                        <strong>{{$course->end_date}}
                                           </strong>
                                    </li>
                                    @endif
                                    <li>
                                        <i class="fas fa-clock mr-20"></i>
                                        <span>@lang('labels.frontend.layouts.course.duration'):</span>
                                        <strong>{{count($course->chapters)}}
                                            @lang('labels.frontend.layouts.course.sessions')</strong>
                                    </li>
                                    <li>
                                        <i class="fas fa-book mr-20"></i>
                                        <span>@lang('labels.frontend.layouts.course.lectures'):</span>
                                        <strong>{{count($lessons)}}</strong>
                                    </li>
                                    <li>
                                        <i class="fas fa-play-circle mr-20"></i>
                                        <span>@lang('labels.frontend.layouts.course.videos'):</span>
                                        <strong>{{ @$course->chapters->sum('session_length')}}
                                            @lang('labels.frontend.layouts.course.hours')</strong>
                                    </li>
                                    @if(@$course->level)
                                    <li>
                                        <i class="fas fa-chart-line mr-20"></i>
                                        <span>@lang('labels.frontend.layouts.course.level'): </span> <strong>
                                            @if(session('locale') == 'ar') {{ @$course->level->name_ar? @$course->level->name_ar: @$course->level->name }} @else
                                            {{ @$course->level->name}} @endif
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
                                    @if(count($student_trending_courses)>0)
                                    @foreach($student_trending_courses as $courseTrend)
                                    @include('frontend.layouts.partials.course_list')
                                    @endforeach
                                    @else
                                    @lang('labels.frontend.layouts.course.no-related')

                                    @endif
                                </div>
                               
                                {{-- <div class="multiseparator"></div>
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
                                </div> --}}
                                <div class="multiseparator"></div>


                            </div>
                        </div>
                    </div>
                    <div class="col-lg-8 col-md-12">
                        <div class="img-details mb-50 mt-10">
                            <img @if($course->course_image != "")
                            src="{{asset('storage/uploads/'.$course->course_image)}}" @else src="{{asset('images/course-default.jpeg')}}"  @endif alt="Details"
                            class="img-fluid"
                            style="border-radius: 10px;">
                        </div>
                        <div class="detail-course">
                            <div class="top-content">
                                <ul class="list-unstyled d-flex">
                                    <li class="nav-list active" data-list="descrip">
                                        @lang('labels.frontend.layouts.course.description')</li>
                                    <li class="nav-list" data-list="curri">
                                        @lang('labels.frontend.layouts.course.curriculum')</li>
                                  
                                    <li class="nav-list" data-list="rates">
                                        @lang('labels.frontend.layouts.rates.evaluate')</li>
                                        @if($student_exist_on_course==true)
                                    <li class="nav-list" data-list="blogs">
                                        @lang('labels.frontend.layouts.blog.title')</li>
                                        @endif
                                </ul>
                            </div>
                            
                            <div class="bottom-content">
                                <div class="descrip content active">


                                    @if ($course->mediaVideo && $course->mediavideo->count() > 0)
                                    <div class="course-single-text">
                                        @if ($course->mediavideo != '')
                                            <div class="course-details-content mt-3">
                                                <div class="video-container mb-5" data-id="{{ $course->mediavideo->id }}">
                                                    @if ($course->mediavideo->type == 'youtube')
        
        
                                                        <div id="player" class="js-player" data-plyr-provider="youtube"
                                                            data-plyr-embed-id="{{ $course->mediavideo->file_name }}"></div>
                                                    @elseif($course->mediavideo->type == 'vimeo')
                                                        <div id="player" class="js-player" data-plyr-provider="vimeo"
                                                            data-plyr-embed-id="{{ $course->mediavideo->file_name }}"></div>
                                                    @elseif($course->mediavideo->type == 'upload')
                                                        <video poster="" id="player" class="js-player" playsinline controls>
                                                            <source src="{{ $course->mediavideo->url }}" type="video/mp4" />
                                                        </video>
                                                    @elseif($course->mediavideo->type == 'embed')
                                                        {!! $course->mediavideo->url !!}
                                                    @endif
                                                </div>
                                            </div>
                                        @endif
                                    </div>
                                @endif

                                    <div class="body-disc">
                                        @if(session('locale') == 'ar') 
                                      
                                        {!! $course->description_ar?$course->description_ar:$course->description !!} 
                                      
                                        @else

                                        {!!$course->description? $course->description:$course->description_ar!!}
                                         @endif
                                      
                                    </div>
                                    @if ($pdf)
                                    <div class="body-disc">
                                        @if(session('locale') == 'ar')
                                        <h4 class="dark-red mb-3">{{ $course->pdf_title_ar??__('labels.frontend.course.brochure') }}</h4>
                                        @else
                                        <h4 class="dark-red mb-3">{{$course->pdf_title??__('labels.frontend.course.brochure') }}</h4>

                                        @endif

                                        @if(auth()->check())
                                      
                                            <div class="course-single-text mb-5">
                                                <iframe src="{{asset('storage/uploads/'.$pdf->name.'#toolbar=0')}}" width="100%"
                                                height="500px">
                                                </iframe>
                                                <div id="myPDF"></div>
                
                                            </div>
                                        @else
                                        <style>
                                            .pdf-warning-box{
                                                width: 100%;
                                                min-height: 200px;
                                                background-color: #732533
                                            }
                                            .pdf-warning-box h3{
                                               
                                               color: #fff;
                                               text-align: center;
                                               padding: 50px;
                                           }
                                           .pdf-warning-box div{
                                               
                                               color: #fff;
                                               text-align: center;
                                           }
                                           .pdf-warning-box div a{
                                               
                                               color: #fff;
                                               text-align: center;
                                               padding: 50px;
                                           }
                                        </style>
                                        <div class="pdf-warning-box">
                                            <h3> @lang('labels.frontend.course.pdf_warning')</h3>
                                            <div><a class="openpop" data-value="model" href="#"> @lang('navs.general.login') </a></div>                                            
                                        </div>

                                        @endif
                                
                                    </div>
                                    @endif
                                   
                                </div>
                                <div class="curri content">

                                    <div class="affiliate-market-guide mb65">

                                        <div class="affiliate-market-accordion">
                                            <div id="accordion" class="panel-group">
                                                @php $count = 0;  $quest_count = 0; @endphp
                                                
                                                @if(count($lessons) > 0)
                                                
                                                @foreach($lessons as $key=> $lesson)
                                                @if($lesson->model && $lesson->model->published == 1)
                                                @php $count++ @endphp

                                                <div class="body-curri" >
                                                    <div class="head-body">
                                                       
                                                        <button style="text-align: right;white-space: normal" class="btn btn-link" data-toggle="collapse" data-target="#collapse-{{$lesson->id}}" aria-expanded="true" aria-controls="collapse-{{$lesson->id}}">
                                                        <span class="num">{{$key+1}}</span>
                                                        <span class="icon" title="Text Lesson">
                                                            <i class="fas fa-file-alt"></i>
                                                        </span>
                                                        <span class="text"> @if(session('locale') == 'ar') {{$lesson->model->title_ar?$lesson->model->title_ar:$lesson->model->title}} @else {{$lesson->model->title?$lesson->model->title:$lesson->model->title_ar}} @endif
                                                            <i class="fas fa-sort-down down"></i>
                                                            <i class="fas fa-sort-up up"></i>
                                                        </span>
                                                        </button>
                                                       


                                                        <div id="collapse-{{$lesson->id}}" class="collapse " aria-labelledby="headingOne">
                                                            <div class="card-body">
                                                                <div>
                                                            
                                                                    @if(session('locale') == 'ar') {!! $lesson->model->short_text_ar?$lesson->model->short_text_ar:$lesson->model->short_text !!} @else {!! $lesson->model->short_text?$lesson->model->short_text:$lesson->model->short_text_ar !!} @endif
                                                                </div>
                                                            </div>
                                                          </div>
                                                        </div>
                                                   
                                                  
                                                    {{--  --}}

                                                   
                                                    {{--  --}}

                                                </div>

                                                @endif
                                                @endforeach
                                                @endif
                                            </div>
                                        </div>
                                    </div>


                                </div>
                                <div class="reviews content">


                                    <div class="couse-comment">
                                        <div class="blog-comment-area ul-li about-teacher-2">
                                            @if(count($course->reviews) > 0)
                                            <ul class="comment-list">
                                                @foreach($course->reviews as $item)
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

                                            @if ($purchased_course)
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
                                                    $route = route('courses.review',['course'=>$course->id]);
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

                                <div class="rates content">
                                    {{ html()->form('POST', route('admin.answerEvaluate.store'))->id('rate-create')->class('form-horizontal')->acceptsFiles()->open() }}
                                  
                                        <div id="accordion">

                                            @foreach ($rates as $rate)
                                            <input type="hidden" name="rate_ids[]" value="{{$rate->id}}">
                                            <input type="hidden" name="course_id" value="{{$course->id}}">

                                            <div class="card0">
                                                <div class="card-header0" id="heading{{$rate->id}}">
                                                    <h5 class="mb-0 card-body">
                                                        {{-- <button class="btn btn-link" data-toggle="collapse" data-target="#collapse{{$rate->id}}" aria-expanded="true" aria-controls="collapseOne"> --}}
                                                            @if(Lang::locale()=="en")
                                                            {{$rate->name}}
                                                            @lang('labels.backend.rates.rate')

                                                            @else
                                                            @lang('labels.backend.rates.rate')
                                                            {{$rate->name_ar}}

                                                            @endif

                                                       
                                                       
                                                    </h5>

                                                    {{--                                                     
                                                    <h5 class="mb-0">
                                                        <button class="btn btn-link" data-toggle="collapse" data-target="#collapse{{$rate->id}}" aria-expanded="true"  aria-controls="collapseOne"></button>
                                                    </h5> 
                                                    --}}
                                                </div>

                                                
                                                <div id="collapse{{$rate->id}}" class=" show"
                                                    aria-labelledby="headingOne" data-parent="#accordion">
                                                    <div class="card-body">
                                                        @php
                                                           $userAnswers=$rate->getUserRate();
                                                           
                                                        @endphp
                                                        @foreach ($rate->questions as $Mainkey=>$question)
                                                        @php
                                                         $quest_count++;

                                                         @endphp
                                                        <input type="hidden" name="rateQuestions[]" value="{{$question->id}}">

                                                        @if(Lang::locale()=="en")

                                                        <p for=""><b>{{ $question->question}}</b></p>

                                                        @if( $question->question_type=="radio")
                                                       
                                                        <div style="direction: ltr;display: inline-block;width: 100%">
                                                            <input name="{{$question->id}}-options" id="kartik" class="rating" data-stars="5" data-step="0.1" title="" />
                                                        </div>
                                                        
                                                        @else
                                                        <textarea name="{{$question->id}}-options" id="" cols="50" rows="2"></textarea>
                                                        @endif


                                                        @else
                                                        <p for=""><b>{{ $question->question_ar}}</b></p>

                                                        @if( $question->question_type=="radio")
                                                        
                                                        <div style="direction: ltr;display: inline-block;width: 100%">
                                                            <input name="{{$question->id}}-options" id="kartik" class="rating" data-stars="5" data-step="0.1" title=""  data-rtl=1/>
                                                        </div>
                                                       
                                                        
                                                        @else
                                     
                                                        <textarea name="{{$question->id}}-options" id="" cols="50" rows="2"></textarea>
                                                        @endif
                                                        @endif
                                                        @endforeach
                                                       
                                                    </div>
                                                </div>
                                            </div>
                                            @endforeach
                                            <hr>
                                            @lang('labels.backend.rates.total')
                                            <div style="direction: ltr;display: inline-block;width: 100%">
                                                <input disabled id="kartik" class="rating" value="{{$AllRateResult}}" data-stars="5" data-step="0.1" title="" />
                                            </div>
                                            @if(count($rates)>0)
                                            @if(count($userAnswers)==0)
                                            <div class="form-group row justify-content-center" style="margin-top: 20px;margin-left: 16%;">
                                                <div class="col-4">                                                                                   
                                                    <button class="btn btn-success" style="background-color: ##3bcfcb;" type="submit">{{__('buttons.general.crud.evaluate')}}</button>
                                                </div>
                                            </div><!--col-->
                                            @endif
                                            @else
                                            <div class="form-group row" >
                                                <div class="col-12" style="text-align: center">      
                                                    <h3>@lang('labels.general.no_data_available')</h3>
                                                </div>
                                            </div>
                                         @endif
                                            </div>
                                           
                                    {{ html()->form()->close() }}

                                </div>

                                {{-- /// end rates--}}
                                @if($student_exist_on_course==true)

                                <!-- Start of blog content
                                ============================================= -->
                                <section id="blog-item" class="blog-item-post blogs content">
                                    <div class="container">
                                        <div class="blog-content-details">
                                            <div class="desc related" style="margin-bottom: 0;padding-top: 0;padding-bottom: 0;">
                                                <div class="container-custome related-overlay">            
                                                    <div class="row">
                                                    @if(count($blogs) > 0)
                                                        @foreach($blogs as $item)
                                                            <div class="col-md-4">
                                                                @include('frontend.blogs.partials.blog_box')
                                                            </div>
                                                        @endforeach
                                                    @else
                                                        <h4 class="text-center">@lang('labels.general.no_data_available')</h4>
                                                    @endif
                                    
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </section>
                                <!-- End of blog content
                                    ============================================= -->
                                @endif
                            </div>
                        </div>
                        <div class="related">
                            <div class="related-overlay">
                                <div class="title-related">
                                    <h3>@lang('labels.frontend.layouts.course.related')</h3>
                                </div>



                                <div class="row">
                                    @if(count($student_featured_courses)>0)
                                    @foreach($student_featured_courses as $course)
                                    <div class="col-md-4">
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
                </div>
            </div>
           
        
        </div>
    </div>
  
</section>




@endsection
@section('course-footer')
@include('frontend.courses.course-footer')

@endsection

@push('after-scripts')
<script src="https://cdn.plyr.io/3.5.3/plyr.polyfilled.js"></script>
<script src="{{asset('assets/rating/js/star-rating.js')}}"></script>

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

        // $('#rating').rating( "{{$AllRateResult}}");
        $(window).scroll(function(){
        var bodyTop = $('html').scrollTop();
        if(bodyTop >= 30){
            $('.count').each(function () {
                $(this).prop('Counter',0).animate({
                    Counter: $(this).data('value')
                }, {
                    duration: 2000,
                    easing: 'swing',
                    step: function (now) {
                        $(this).text(Math.ceil(now));
                    }
                });
            });
        }
        if(bodyTop > 320){
            $('.get-course').addClass('active')
            $('.get-course').addClass('active2')

        }
        else{
            $('.get-course').removeClass('active')
            $('.get-course').removeClass('active2')

        }
        console.log(bodyTop)
    });

     
</script>
@endpush