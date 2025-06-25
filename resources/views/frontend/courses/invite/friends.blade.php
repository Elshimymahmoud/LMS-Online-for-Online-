@extends('frontend.layouts.app'.config('theme_layout'))

@section('title', trans('labels.frontend.home.title') . ' | ' . app_name())
@section('meta_description', '')
@section('meta_keywords', '')


@push('after-styles')

    <link href="{{ asset('iv') }}/assets/rating/css/star-rating.css" media="all" rel="stylesheet" type="text/css" />
    <link href="{{ asset('iv') }}/assets/rating/themes/krajee-svg/theme.css" media="all" rel="stylesheet"
        type="text/css" />

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


    <section class="row the-slider" id="slider">
        <div style="background-size: cover;height:fit-content;background-color: white;padding-bottom: 20px;">
            <div class="containers">
                <div class="row benefit-notes">
                    <div class="col-sm-12 col-md-12   wow fadeInUp2  course-nav mt-0">

                        <!--========== /.navbar-collapse ==========-->
                    </div>
                    <!--========== /.container-fluid ==========-->

                    <div class="top-banner"></div>

                </div>
                <!-- ===========course details part1============ -->
                <!--==========course description right==========-->
                <div class="row">

                    <div class="container">
                        <div class="col-sm-12 col-md-12  benefit wow fadeInUp ptb-50 course-content mt-0" id="sidebar-right">
                            <!-- Sidebar right-->

                            <h2>دعوة الاصدقاء</h2>
                            <hr>
                            <h3 style="color: #4f198d;padding:10px"> {{ $course->title_ar }}</h3>
                            <form style="border: 2px solid #4f198d;
                             padding: 30px;
                             border-radius: 10px;" action="{{ route('courses.sendInvitation') }}" id="subscribeform"
                                class="row newsletter-form" method="post">
                                <div class="row newsletter-form" id="EmailsDiv" style="margin-right: 20%;">

                                    @csrf
                                    <div class="input-group">
                                        <input type="email" style=" border-radius: 10px;
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


                                <button class="btn btn-primary" style="padding:10px;width: 50%;
                            font-weight: bold;" type="submit" id="js-subscribe-btn">@lang('labels.frontend.home.send')</button>

                            </form>

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
        $(document).ready(function() {
            $('.caption').css({
                'display': 'none'
            })

            $('.course-sidebar').on('click', 'a.list-group-item', function() {
                $(".course-sidebar .list-group-item").removeClass("active");
                $(this).addClass("active");
            });

        })

        function addNewEmail() {

            $EmailsDiv = $('#EmailsDiv');
            $newemail = '<div class="input-group">' +
                ' <input  type="email" style=" border-radius: 10px;margin-bottom: 10px;" class="form-control InviteEmail newsletter-email" name="emails[]"' +
                'placeholder="@lang('
            labels.frontend.home.email ')" />'

                +
                '</div>';
            $EmailsDiv.append($newemail)

        }
    </script>
@endpush
