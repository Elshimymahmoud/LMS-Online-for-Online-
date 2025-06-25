
@extends('frontend.layouts.app'.config('theme_layout'))

@section('title', trans('labels.frontend.home.title').' | '.app_name())
@section('meta_description', '')
@section('meta_keywords','')


@push('after-styles')
<link rel="stylesheet" href="{{ asset('iv') }}/css/plan.css" />
    <style>
         p{
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
    .fnt-wght-900{
        font-weight: 900;

    }
    .welcome{
        padding: 15px;
        border-radius: 10px;
    }
    </style>
@endpush

@section('content')


  
   

<section class="row the-slider" id="slider">
    <div style="background-size: cover;height:fit-content;background-color: #f1f3f3;padding-bottom: 20px;">
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

                

                    <!--==========blog details  ==========-->
                    <div class="col-sm-12 col-md-3   wow fadeInUp ptb-50  mt-0">
                    
                       
                    </div>
                    <div class="col-sm-12 col-md-8 plan  wow fadeInUp ptb-50  mt-0">
                        <div class="plan1">
                           

        <!--  Slide  -->

        <section class="slide" style="border-radius:10px;background-image: url({{asset('ivory')}}/assets/img/slider/8.jpg);">
            <div class="slide-overlay" style="padding: 10px">
                <div class="slide-content">
                    <h1>WHY IVORY?</h1>
                </div>
            </div>
        </section>

        <!--  Slide  -->


        <!--  Services About  -->

        <section class="services-about services-why">
            <div class="services-about-overlay" style="padding: 15px">
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
                        </div>
                     
                        <!-- <div class="comment">
                            
                        </div> -->
                    </div>
                    <div class="col-sm-12 col-md-1   wow fadeInUp ptb-50  mt-0">
                    </div>
                    <!--==========blog details  ==========-->
                    <!--========== more blog details  ==========-->
                   
                    
                </div>
            </div>
        </div>


    </div>
    </div>
</section>
    
    @endsection

    @push('after-scripts')
        
    @endpush
    