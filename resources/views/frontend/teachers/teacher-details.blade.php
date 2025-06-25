@extends('frontend.layouts.app'.config('theme_layout'))



@push('after-styles')
    <!-- ====Custom Stylesheet -->
    <link rel="stylesheet" href="{{ asset('iv/css/course_details.css') }}" />
    <link href="{{ asset('iv/assets/rating/css/star-rating.css') }}" media="all" rel="stylesheet" type="text/css" />
    <link href="{{ asset('iv/assets/rating/themes/krajee-svg/theme.css') }}" media="all" rel="stylesheet"
        type="text/css" />
    @if (session('locale') == 'en')
        <style>
            .course-location .title {
                margin-right: 11;
                float: right;
            }

            .course-location-container div {
                width: 24%
            }

            .the-product.details .course-content .course-curriclum .btn-curr {
                text-align: left
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
            .teacher-img-parent {
                border-radius: 50%;
                width: 250px;
            }

        </style>
    @endif
@endpush


@section('content')


    <section class="row the-slider" id="slider">
        <div style="background-size: cover;height:fit-content;padding-bottom: 20px;">
            <div class="container">
                <div class="row collections benefit-notes">
                    <!-- ===========course details part1============ -->
                    <!--==========course description right==========-->
                    <div class="col-sm-6 col-md-3  benefit wow fadeInUp ptb-50 course-content mt-0">
                        <img class="teacher-img-parent" src="{{ $teacher->picture }}" alt="">
                    </div>
                    <!--/*==========course description right ==========-->

                    <!--==========course description left ==========-->

                    <div class="col-sm-6 col-md-9  benefit wow fadeInUp ptb-50 course-content mt-0">
                        <h2>
                            @if (session('locale') == 'ar')
                                {{ $teacher->name_ar ?? $teacher->name }}
                            @else
                                {{ $teacher->name ?? $teacher->name_ar }}
                            @endif
                        </h2>
                        <p>
                            {!!  (session('locale') == 'ar')?@$teacher->teacherProfile->description_ar:@$teacher->teacherProfile->description !!}
                        </p>
                    </div>


                </div>
                <div class="row collections benefit-notes">
                    <!-- ===========course details part1============ -->

                    <div class="col-sm-12 col-md-12  benefit wow fadeInUp ptb-50 course-content mt-0">

                        <h3 style="text-align: center">
                            @lang('labels.frontend.allCourses.by')
                            @if (session('locale') == 'ar')
                                {{ $teacher->name_ar ?? $teacher->name }}
                            @else
                                {{ $teacher->name ?? $teacher->name_ar }}
                            @endif
                        </h3>

                        @foreach ($teacher->courses as $course)
                            @if(count($course->locations)>0)

                                <div class="col-sm-6 col-md-4 item  fadeIn">
                                    @include('frontend.layouts.partials.course_box')
                                </div>
                            @endif
                        @endforeach

                    </div>


                </div>
            </div>
    </section>
@endsection

@push('after-scripts')
    <script src="{{ asset('iv/assets/rating/js/star-rating.js') }}"></script>
@endpush
