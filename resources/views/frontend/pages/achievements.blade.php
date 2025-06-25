@extends('frontend.layouts.app'.config('theme_layout'))

@section('title', trans('labels.frontend.home.title') . ' | ' . app_name())
@section('meta_description', '')
@section('meta_keywords', '')


@push('after-styles')
    <link rel="stylesheet" href="{{ asset('iv') }}/css/plan.css" />
    <style>
        p {
            font-weight: 600;

        }

        h5 {
            font-weight: bold;
            color: #800000;
        }

        h3 {
            color: white;
        }

        li span {
            font-size: 10px;
        }

        .fnt-wght-900 {
            font-weight: 900;

        }

        .welcome {
            padding: 15px;
            border-radius: 10px;
        }
        .cont img{
            object-fit: contain;
            width: 1050px !important;
            height: 750px !important;
        }
        @media only screen and (max-width: 600px) {
            .join-us-mt100 {
                margin-top: unset !important;
            }

        }

        @media only screen and (max-width: 350px) {
            .join-us-mt100 {
                margin-top: unset !important;
            }
        }
        @media only screen and (max-width: 400px) {
            .join-us-mt100 {
                margin-top: unset !important;
            }
        }
        @media only screen and (max-width: 900px) {
            .join-us-mt100 {
                margin-top: unset !important;
            }
        }
        @media only screen and (max-width: 800px) {
            .join-us-mt100 {
                margin-top: unset !important;
            }
        }
    </style>
    <link rel="stylesheet" href="{{ 'iv' }}/css/about.css">
@endpush

@section('content')





    <section class="row the-slider" id="slider">
        <div style="height: 100%;
                background-size: cover;
                color: white;;background-color: #f1f3f3;padding-bottom: 20px;">
            <div class="container">
                <div class="row benefit-notes">
                    <div class="col-sm-12 col-md-12   wow fadeInUp2  register-parent mt-0">

                        <!--========== /.navbar-collapse ==========-->
                    </div>
                    <!--========== /.container-fluid ==========-->



                </div>

                <!--==========blog details ==========-->
                <div class="row">

                    <div class="container">


                        @php $title='انجازات '; @endphp

                        <div class="col-sm-12 col-md-12   wow fadeInUp ptb-50  mt-0">
 

                            <section class="welcome">
                                <div class="welcome-overlay">
                                    <div class="container-about">
                                        <div class="welcome-content">
                                            <div class="head-welcome">
                                                <h2 style="color: #661527;font-size: 30px;margin-bottom: 50px"> {{ Lang::locale() == 'ar' ? $achievement->title_ar : $achievement->title }}</h2>
                                            </div>
                                            <div class="middle-welcome">
                                                <p>
                                                    {!! Lang::locale() == 'ar' ? $achievement->introduction_ar : $achievement->introduction !!}
                                                </p>

                                            </div>


                                        </div>
                                        <div class="cont" style="
                                        display: flex;
                                        flex-direction: column;
                                    ">
                                            {!! $achievement->content !!}
                                        </div>
                                    </div>
                                </div>
                            </section>




                            {{-- @for ($i = 1; $i <= 48; $i++)
                                <div>
                                    <img src="{{ asset('achievements-imgs/' . $i . '.jpg') }}" alt="{{ $title }}"
                                        style="width: 100%">
                                </div>
                            @endfor --}}



                        </div>



                    </div>
                </div>
            </div>


        </div>
        </div>
    </section>


    <!--==========How its Works==========-->
    <section class="row join-urs">
        <div class="container">
            <div class="row  wow fadeInUp">
                <div class="col-sm-6 col-md-3 ">
                    <img src="{{ asset('iv') }}/images/join2.jpeg" alt="" />
                </div>
                <div class="col-sm-6 col-md-3 join-us-mt80" >
                    {{-- <p> اطلب دورة تعاقدية الآن </p> --}}
                    <h3 style="color: black;white-space: nowrap;">  
                        اطلب دورتك التعاقدية 
                    </h3>

                </div>
                <div class="col-sm-6 col-md-3 col-sm-2 join-us-mt180" style="margin-top: 80px">
                    {{-- @if (auth()->check()) --}}
                        <a href="#" data-toggle="modal" class="btn btn-primary btn-sm btn-revert-color "
                            data-target="#RequestModalCenter">  اضغط هنا
                        </a>
                    {{-- @endif --}}
                </div>
            </div>
        </div>
    </section>

@endsection

@push('after-scripts')
@endpush

{{-- @extends('frontend.layouts.app'.config('theme_layout'))

@section('title', trans('labels.frontend.home.title') . ' | ' . app_name())
@section('meta_description', '')
@section('meta_keywords', '')


@push('after-styles')
    <link rel="stylesheet" href="{{ asset('iv') }}/css/plan.css" />
    <style>
        p {
            font-weight: 600;

        }

        h5 {
            font-weight: bold;
            color: #800000;
        }

        h3 {
            color: white;
        }

        li span {
            font-size: 10px;
        }

        .fnt-wght-900 {
            font-weight: 900;

        }

        .welcome {
            padding: 15px;
            border-radius: 10px;
        }

    </style>
    <link rel="stylesheet" href="{{ 'iv' }}/css/about.css">
@endpush

@section('content')





    <section class="row the-slider" id="slider">
        <div style="height: 100%;
            background-size: cover;
            color: white;;background-color: #f1f3f3;padding-bottom: 20px;">
            <div class="container">
                <div class="row benefit-notes">
                    <div class="col-sm-12 col-md-12   wow fadeInUp2  register-parent mt-0">

                        <!--========== /.navbar-collapse ==========-->
                    </div>
                    <!--========== /.container-fluid ==========-->



                </div>

                <!--==========blog details ==========-->
                <div class="row">

                    <div class="container">


                        @php $title='انجازات '; @endphp

                        <div class="col-sm-12 col-md-12   wow fadeInUp ptb-50  mt-0">

                            <!--  Slide  -->

                            <section class="slide"
                                style="height: 200px;background-size: cover;color: white;background-image: url({{ asset('ivory') }}/assets/img/slider/4.jpg);">
                                <div class="slide-overlay">
                                    <div class="slide-content">
                                        <h1 class="about-title" style="">التقرير السنوي لإنجازات شركة العاج الفضي للتدريب
                                            و الاستشارات</h1>
                                    </div>
                                </div>
                            </section>

                            <!--  Slide  -->


                            <!--  Welcome  -->

                            <section class="welcome">
                                <div class="welcome-overlay">
                                    <div class="container-about">
                                        <div class="welcome-content">
                                            <div class="head-welcome">
                                                <h2 style="color: #661527">التقرير السنوي لإنجازات شركة العاج الفضي للتدريب
                                                    و الاستشارات</h2>
                                            </div>
                                            <div class="middle-welcome">
                                                <p>
                                                    تمهير …و2020 لاشك أنها سنة التحديات العظيمة والمنعطف لبداية عقد جديد من
                                                    التحولات والتطور في التكنولوجيا والعلوم ولأن مسؤولية التدريب تعاظمت
                                                    ومجالاته تنوعت تبقى تمهير على استعداد لكل التحديات ولخلق ميادين جديدة
                                                    للتدريب ، ولذلك كانت استراتيجيتنا في التدريب مختلفة ومتميزة . تمهير
                                                    المتألقة ببرامجها دائما تواكب التطور المذهل والتقدم في شتى المجالات تسعى
                                                    لنهضة الوطن والمواطن في مسارات متطورة نحو رؤية شاملة.
                                                </p>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </section>




                            @for ($i = 1; $i <= 48; $i++)
                                <div>
                                    <img src="{{ asset('achievements-imgs/' . $i . '.jpg') }}" alt="{{ $title }}"
                                        style="width: 100%">
                                </div>
                            @endfor

                           


                        </div>



                    </div>
                </div>
            </div>


        </div>
        </div>
    </section>


    <!--==========How its Works==========-->
    <section class="row join-urs">
        <div class="container">
            <div class="row  wow fadeInUp">
                <div class="col-sm-6 col-md-3 join-us-mt-30">
                    <img src="{{ asset('iv') }}/images/join.png" alt="" />
                </div>
                <div class="col-sm-6 col-md-6 join-us-mt80">
                    <p> اطلب دورة تعاقدية الآن </p>
                    <h2> اغتنم فترة الخصومات      </h2>
                </div>
                <div class="col-sm-6 col-md-3 join-us-mt100">
                    @if (!auth()->check())
                        <a href="#" data-toggle="modal" class="btn btn-primary btn-lg btn-revert-color "   data-target="#RequestModalCenter">  @lang('labels.backend.general_settings.footer.course_order') </a>
                    @endif
                </div>
            </div>
        </div>
    </section>

@endsection

@push('after-scripts')
@endpush --}}