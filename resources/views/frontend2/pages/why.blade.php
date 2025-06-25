@extends('frontend.layouts.app'.config('theme_layout'))

@push('after-styles')
    <style>
        .content img {
            margin: 10px;
        }
        .about-page-section ul{
            padding-left: 20px;
            font-size: 20px;
            color: #333333;
            font-weight: 300;
            margin-bottom: 25px;
        }
    </style>
@endpush

@section('content')



        <!--  Slide  -->

        <section class="slide" style="background-image: url({{asset('ivory')}}/assets/img/slider/8.jpg);">
            <div class="slide-overlay">
                <div class="slide-content">
                    <h1>WHY IVORY?</h1>
                </div>
            </div>
        </section>

        <!--  Slide  -->


        <!--  Services About  -->

        <section class="services-about services-why">
            <div class="services-about-overlay">
                <div class="container-about">
                    <div class="services-about-conetnt">
                        <div class="row">
                            <div class="col-lg-3 col-md-6">
                                <div class="service about-why">
                                    <div class="service-front">
                                        <div class="front-content">
                                            <div class="icon">
                                                <i class="far fa-edit"></i>
                                            </div>
                                            <div class="title-icon">
                                                Professionalism
                                            </div>
                                        </div>
                                    </div>
                                    <div class="service-back">
                                        <div class="back-content">
                                            <p>
                                                IVORY aims achieve a high level of excellence in its training programs within accurate and specific work mechanisms, according to priorities that show a deep understanding of customer expectations and act accordingly
                                            </p>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="col-lg-3 col-md-6">
                                <div class="service about-why">
                                    <div class="service-front">
                                        <div class="front-content">
                                            <div class="icon">
                                                <i class="fas fa-suitcase"></i>
                                            </div>
                                            <div class="title-icon">
                                                Credibility and Commitment
                                            </div>
                                        </div>
                                    </div>
                                    <div class="service-back">
                                        <div class="back-content">
                                            <p>
                                                IVORY aims achieve a high level of excellence in its training programs within accurate and specific work mechanisms, according to priorities that show a deep understanding of customer expectations and act accordingly
                                            </p>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="col-lg-3 col-md-6">
                                <div class="service about-why">
                                    <div class="service-front">
                                        <div class="front-content">
                                            <div class="icon">
                                                <i class="fas fa-cubes"></i>
                                            </div>
                                            <div class="title-icon">
                                                Entrepreneurship and Innovation
                                            </div>
                                        </div>
                                    </div>
                                    <div class="service-back">
                                        <div class="back-content">
                                            <p>
                                                IVORY aims achieve a high level of excellence in its training programs within accurate and specific work mechanisms, according to priorities that show a deep understanding of customer expectations and act accordingly
                                            </p>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="col-lg-3 col-md-6">
                                <div class="service about-why">
                                    <div class="service-front">
                                        <div class="front-content">
                                            <div class="icon">
                                                <i class="far fa-thumbs-up"></i>
                                            </div>
                                            <div class="title-icon">
                                                Quality and Efficiency
                                            </div>
                                        </div>
                                    </div>
                                    <div class="service-back">
                                        <div class="back-content">
                                            <p>
                                                IVORY aims achieve a high level of excellence in its training programs within accurate and specific work mechanisms, according to priorities that show a deep understanding of customer expectations and act accordingly
                                            </p>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </section>

        <!--  Services About  -->


        <!--  Slide  -->

        <section class="slide" style="background-image: url({{asset('ivory')}}/assets/img/slider/9.jpg);height: 255px;">
            <div class="slide-overlay">
                <div class="slide-content">
                    <h1 style="font-size: 45px;">CHANGE IS INEVITABLE. WE ANTICIPATE IT.</h1>
                </div>
            </div>
        </section>

        <!--  Slide  -->


        <!--  Services About  -->

        <section class="services-about services-why">
            <div class="services-about-overlay">
                <div class="container-about">
                    <div class="services-about-conetnt">
                        <div class="row">
                            <div class="col-lg-3 col-md-6">
                                <div class="service">
                                    <div class="service-front">
                                        <div class="front-content">
                                            <div class="icon">
                                                <i class="fas fa-globe-americas"></i>
                                            </div>
                                            <div class="title-icon">
                                                Professionalism
                                            </div>
                                        </div>
                                    </div>
                                    <div class="service-back">
                                        <div class="back-content">
                                            <p>
                                                IVORY aims achieve a high level of excellence in its training programs within accurate and specific work mechanisms, according to priorities that show a deep understanding of customer expectations and act accordingly
                                            </p>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="col-lg-3 col-md-6">
                                <div class="service">
                                    <div class="service-front">
                                        <div class="front-content">
                                            <div class="icon">
                                                <i class="fas fa-graduation-cap"></i>
                                            </div>
                                            <div class="title-icon">
                                                Credibility and Commitment
                                            </div>
                                        </div>
                                    </div>
                                    <div class="service-back">
                                        <div class="back-content">
                                            <p>
                                                IVORY aims achieve a high level of excellence in its training programs within accurate and specific work mechanisms, according to priorities that show a deep understanding of customer expectations and act accordingly
                                            </p>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="col-lg-3 col-md-6">
                                <div class="service">
                                    <div class="service-front">
                                        <div class="front-content">
                                            <div class="icon">
                                                <i class="far fa-check-square"></i>
                                            </div>
                                            <div class="title-icon">
                                                Entrepreneurship and Innovation
                                            </div>
                                        </div>
                                    </div>
                                    <div class="service-back">
                                        <div class="back-content">
                                            <p>
                                                IVORY aims achieve a high level of excellence in its training programs within accurate and specific work mechanisms, according to priorities that show a deep understanding of customer expectations and act accordingly
                                            </p>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="col-lg-3 col-md-6">
                                <div class="service">
                                    <div class="service-front">
                                        <div class="front-content">
                                            <div class="icon">
                                                <i class="fas fa-university"></i>
                                            </div>
                                            <div class="title-icon">
                                                Quality and Efficiency
                                            </div>
                                        </div>
                                    </div>
                                    <div class="service-back">
                                        <div class="back-content">
                                            <p>
                                                IVORY aims achieve a high level of excellence in its training programs within accurate and specific work mechanisms, according to priorities that show a deep understanding of customer expectations and act accordingly
                                            </p>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </section>

        <!--  Services About  -->
    

@endsection