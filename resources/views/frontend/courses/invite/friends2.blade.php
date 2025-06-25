
@extends('frontend.layouts.app'.config('theme_layout'))

@section('title', trans('labels.frontend.home.title').' | '.app_name())
@section('meta_description', '')
@section('meta_keywords','')


@push('after-styles')

<link href="{{ asset('iv') }}/assets/rating/css/star-rating.css" media="all" rel="stylesheet" type="text/css" />
<link href="{{ asset('iv') }}/assets/rating/themes/krajee-svg/theme.css" media="all" rel="stylesheet" type="text/css" />

<link rel="stylesheet" href="{{ asset('iv') }}/css/course_curriculum.css" />
<style>
    .name-ar {
        width: 25% !important;
        float: right; 
    }

    .white-normal {
        white-space: normal;
        line-height: normal;
    }

    .countrySelection {
        width: 50% !important;


    }

    #countrySelection,
    #gds-cr-one {
        border-radius: 10px;
    }

    .gds-cr-one {
        width: 50% !important;
        float: left;
    }

    .user-avatar-span {
        float: right !important;
        min-width: 65px !important;
    }

    .user-avatar {
        width: 50% !important;
    }

    .nationality {
        border-radius: 30px;
    }

    .InviteEmail {
        border-radius: 10px;
        margin-bottom: 10px;
    }

</style>
@endpush

@section('content')
@php
use Carbon\Carbon;

$days=0;

if($group->count() > 0){
    if($course->free!=1){
   $isEndDatePast = Carbon::parse($group->end)->isPast();
    if($isEndDatePast==true){
        $days=0;
    }
    else{
        $days=now()->diffInDays($group->end);
    }
}
}



@endphp
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
                                <div class="progress">
                                    <div class="progress-bar "
                                    style='width:{{ $course->progress($group->id) ? $course->progress($group->id) : 0 }}%'
                                    role="progressbar" aria-valuenow="0" aria-valuemin="0" aria-valuemax="100">
                                    <span style="color:{{$course->progress($group->id)?'white':'#641225'}}" class="color">{{
                                    $course->progress($group->id) ? $course->progress($group->id) : 0 }}%</span>
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
            <br>
            <!--==========course description right==========-->
            <div class="row">

                <div class="container">
                    <div class="col-sm-12 col-md-3  benefit wow fadeInUp ptb-50 course-content mt-0" id="sidebar-right">
                        <!-- Sidebar right-->
                       
                    @include('frontend.courses.course_curr_sidebar_right')


                    </div>
                    <!--/*==========course description right ==========-->

                    <!--==========course description details ==========-->

                    <div class="col-sm-12 col-md-6  benefit wow fadeInUp ptb-50 course-content mt-0">
                      
                        <div id="accordion" class="curriclum-content lesson-cards" style="padding: 30px">
                          
                          {{-- invitation start --}}
                        
                           

                            <h3> @lang('labels.frontend.course.invitation')</h3>
                            <hr>
                            @include('includes.partials.messages')
                            <h3 style="color: #4f198d;padding:10px"> {{ $course->title_ar }}</h3>
                            <form style="border: 2px solid #4f198d;
                             padding: 30px;
                             border-radius: 10px;" action="{{ route('courses.sendInvitation') }}" id="subscribeform"
                                class="row newsletter-form" method="post">
                                <div class="row newsletter-form" id="EmailsDiv" style="margin-right: 20%;">

                                    @csrf
                                    <div class="input-group">
                                        <input type="email" required style=" border-radius: 10px;
                                margin-bottom: 10px;" class="form-control newsletter-email InviteEmail" name="emails[]"
                                            placeholder="@lang('labels.frontend.home.email')" />

                                    </div>
  
                                    <input type="hidden" name="course_id" value="{{ $course->id }}">
                                    <input type="hidden" name="user_id" value="{{ $user->id }}">


                                    {{--  --}}
                                </div>
                                <span style="margin-top: 17px;
                            margin-right: 20%;
                            font-size: 19px;
                            color: #4f198d;">
                                    <a onclick="addNewEmail()" style="cursor: pointer">
                                        <i style="padding: 10px;
                            border: 1px solid;
                            color: #4f198d;
                            border-radius: 5px;" class="fa fa-plus"></i>
                                    </a>
                                </span>

                                {{-- <p style="color: white" id="subscribe_msg"></p> --}}
                                {{--  --}}


                                <button class="btn btn-primary" style="padding: 10px;
                                width: 69%;
                                font-weight: bold;" type="submit" id="js-subscribe-btn">@lang('labels.frontend.home.send')</button>

                            </form>

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
<script>
   
    $(document).ready(function() {
        $('.caption').css({
            'display': 'none'
        })

        $('.course-sidebar').on('click', 'a.list-group-item', function() {
            $(".course-sidebar .list-group-item").removeClass("active");
            $(this).addClass("active");
        });

    })
    function addNewEmail(){
        
        $EmailsDiv=$('#EmailsDiv');
        $newemail='<div class="input-group">'+
                           ' <input  type="email" style=" border-radius: 10px;margin-bottom: 10px;" class="form-control InviteEmail newsletter-email" name="emails[]"'+
                                'placeholder="@lang('labels.frontend.home.email')" />'
                           
                            +'</div>';
        $EmailsDiv.append($newemail)
        
    }
    $("#success-alert").fadeTo(2000, 500).slideUp(500, function(){
    $("#success-alert").slideUp(500);
    })
</script>

@endpush


