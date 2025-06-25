
@extends('frontend.layouts.app'.config('theme_layout'))

@section('title', trans('labels.frontend.home.title').' | '.app_name())
@section('meta_description', '')
@section('meta_keywords','')

@push('course_pixel_code')
{!! $course?$course->pixel_code:'' !!}
@endpush
@push('after-styles')

<link href="{{ asset('iv') }}/assets/rating/css/star-rating.css" media="all" rel="stylesheet" type="text/css" />
<link href="{{ asset('iv') }}/assets/rating/themes/krajee-svg/theme.css" media="all" rel="stylesheet" type="text/css" />

<link rel="stylesheet" href="{{ asset('iv') }}/css/course_curriculum.css" />
<style>
    .name-ar{
        width: 25% !important;
        float: right;
    }
    .countrySelection{
        width: 50% !important;
       

    }
    #countrySelection, #gds-cr-one{
        border-radius: 10px;
    }
   
    .gds-cr-one{
        width: 50% !important;
        float: left;
    }
    .user-avatar-span{
        float: right !important;
        min-width: 65px !important;
    }
    .user-avatar{
        width: 50% !important;
    }
    .nationality{
        border-radius: 30px;
    }
    .white-normal{
            white-space: normal;
    line-height: normal;
        }
        .progress{
            margin-bottom: 0 !important;
        }
        .course-nav-toggle{
            border: none;
            background: #4f198d !important;
        }
</style>
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
{{-- @$UserIpLocation --}}
@if($IsUserFilledData==false &&auth()->user()->isAdmin()==false)
@include('includes.partials.messages')
<section class="row the-slider" id="slider" style="    margin-top: 25px;">
    <div style="background-size: cover;height:fit-content;background-color: white;padding-bottom: 20px;">
        <div class="containers" style="background-color: #fdfaf1;padding-top:10px">
          <h1 style="text-align: center;color:4f198d">@lang('validation.complete-data')</h1>
            <div class="col-md-2">
            </div>
            <div class="col-md-8">
                @include('backend.account.tabs.edit')
            </div>
            <div class="col-md-2">
            </div>

        </div>
    </div>
</section>
@else
<section class="row the-slider" id="slider">
    <div style="background-size: cover;height:fit-content;background-color: white;padding-bottom: 20px;">
        <div class="containers">
            <div class="row benefit-notes">
                <div class="col-sm-12 col-md-12   wow fadeInUp2  course-nav mt-0">
                    <nav class="navbar navbar-default second-nav">
                        <div class="container">
                            <!--========== Brand and toggle get grouped for better mobile display ==========-->


                            <div class="nav navbar-nav  col-md-6">
                                <button type="button" onclick="toggleShow()" id="sidebarToggle"
                                    class="Button Button--link course-nav-toggle" aria-live="polite"
                                    aria-label="إخفاء قائمة التنقل بين الدورات" title="إخفاء قائمة التنقل بين الدورات">
                                    <i class="fa fa-bars" aria-hidden="true"></i>
                                </button>
                            </div>
                            <div class="nav navbar-nav navbar-left col-md-6"></div>
                            <!--========== Collect the nav links, forms, and other content for toggling ==========-->

                            <div class="pull-right col-md-3 col-xs-6  ">
                                <div class="progress mb-0" style="margin-bottom:0 !important">
                                    <div class="progress-bar "
                                    style='width:{{ $course->progress() ? $course->progress() : 0 }}%'
                                    role="progressbar" aria-valuenow="0" aria-valuemin="0" aria-valuemax="100">
                                    
                                    <span style="color:{{$course->progress()?'white':'#641225'}}" class="color">{{ $course->progress() ? $course->progress() : 0 }}%</span>
                               
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

                    </div>
                    <!--/*==========course description right ==========-->

                    <!--==========course description details ==========-->

                    <div class="col-sm-12 col-md-6  benefit wow fadeInUp ptb-50 course-content mt-0">
                        <div id="accordion" class="curriclum-content lesson-cards">
                            @php
                                $currentPage=request()->segment(count(request()->segments())); 
                                $lessonCourse = $course;
                                $mainLesson = $lesson ?? [];
                                $count=0;
                            @endphp
                            @foreach ($lessonCourse->chapter()->orderBy('sequence', 'asc')->get() as $key => $chapter)
                                @php
                                    $chapterLessons=$chapter->lessons()->whereHas('courseLocations', function($query) use($course_location_id) {
                                        $query->where('course_location_id', '=', $course_location_id)
                                        ->where('model_type', '=', 'App\Models\Lesson');
                                    })->pluck('id')->merge($lessonCourse->tests()->whereHas('courseLocations', function($query) use($course_location_id) {
                                        $query->where('course_location_id', '=', $course_location_id)
                                        ->where('model_type', '=', 'App\Models\Forms');
                                    })->pluck('forms.id')
                                );
                                @endphp
                                
                                @if(count($chapterLessons)>0)
                            <div class="card">
                                <div class="card-header" id="headingOne">
                                    <h5 class="mb-0">
                                        <button class="btn white-normal btn-chapter-collapse {{$key==0?'':'collapsed??'}} " data-toggle="collapse"
                                            data-target="#collapse2-{{$key}}" aria-expanded="{{$key==0?'true':''}}" aria-controls="collapse2-{{$key}}">
                                           {{ session('locale') == 'ar'?$chapter->title_ar??$chapter->title:$chapter->title  }}
                                           -{{$chapter->session_length}}
                                           {{-- @lang('labels.backend.courses.hours') --}}
                                           @if($chapter->length_type=='hour')
                                           @if(in_array($chapter->session_length,[3,4,5,6,7,8,9,10]))
                                           @lang('labels.frontend.course.hours')
                                           @else
                                           @lang('labels.frontend.course.hour')

                                           @endif
                                           @else 
                                           @if(in_array($chapter->session_length,[3,4,5,6,7,8,9,10]))

                                           @lang('labels.frontend.course.minutes')
                                           @else
                                           @lang('labels.frontend.course.minute')

                                           @endif

                                           @endif
                                        </button>
                                    </h5>
                                </div>

                                <div id="collapse2-{{$key}}" class="collapsed collapsed collapse {{$key==0?'in':''}} in"
                                    aria-labelledby="headingOne" data-parent="#accordion">
                                    <div class="card-body">
                                    
                                        @foreach ($course->courseTimeline as $item)
 
                                        @if (@$item->model->chapter_id == $chapter->id &&(($item->model_type=='App\Models\Lesson'||$item->model_type=='App\Models\Forms')&&in_array($course_location_id,$item->model->courseLocations->pluck('id')->toArray())))
                                      
                                        <div class=" mb-7 d-flex chapter-lesson hover-zoom">
                                            <i class=" mb-14 fa  fa-graduation-cap chapter-lesson-icon "></i>
                                            <a href="{{ route('lessons.show', ['course_id' => $item->course_id, 'slug' => $item->model->slug,'course_location_id'=>$course_location_id]) }}">
                                                <p class="display-content">
                                                    {{ session('locale') == 'ar' ? $item->model->title_ar : $item->model->title }}
                                                </p>
                                            </a>
                                           
                                        </div>
                                        @endif
                                        @endforeach
                                    


                                    </div>
                                </div>
                            </div>
                            @php
                              $count+=1;
                          @endphp
                            @endif
                            @endforeach

                           @if($count==0)
                           <div class="card">
                            <div class="card-header" id="headingOne">
                                <h5 class="mb-0">
                                   
                                    @lang('labels.backend.dashboard.no_data')
                                </h5>
                            </div>

                        </div>
                          @endif

                        </div>


                    </div>
                    <!-- =======course side bar left -->
                    <div class="col-sm-12 col-md-3  benefit wow fadeInUp ptb-50 course-content mt-0">

                        <!-- Sidebar left-->
                        
                    @include('frontend.courses.course_sidebar_left')

                    </div>
                </div>
            </div>
        </div>


    </div>
    </div>
</section>
@endif







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

        $('.course-sidebar').on('click', 'a.list-group-item', function() {
            $(".course-sidebar .list-group-item").removeClass("active");
            $(this).addClass("active");
        });

    })
    
   
</script>
@endpush
@push('course-pixel_code_footer')
<footer>
    {{$course?$course->pixel_code:''}}
</footer>
@endpush

