
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
    <link rel="stylesheet" href="{{'iv'}}/css/about.css">
@endpush

@section('content')


  
   

<section class="row the-slider" id="slider">
    <div style="height: 200px;
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

                

                    
                    <div class="col-sm-12 col-md-12 plan  wow fadeInUp ptb-50  mt-0">
                       
        <!--  Slide  -->

        <section class="slide" style="height: 200px;
        background-size: cover;
        color: white;background-image: url({{asset('ivory')}}/assets/img/slider/4.jpg);">
            <div class="slide-overlay">
                <div class="slide-content">
                    <h1 class="about-title" style="margin-left: 40%;">ABOUT IVORY</h1>
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
                            <h2>Welcome to IVORY Training</h2>
                        </div>
                        <div class="middle-welcome">
                            <p>
                                IVORY … and 2020 is undoubtedly the year of great challenges and a turning point for the beginning of a new decade of transformations and developments in technology and science. Because the responsibility for training has grown and its fields diversified, IVORY remains ready for all challenges and to create new fields of training, and therefore our training strategy was different and distinct.
                            </p>
                            <p>
                                IVORY sparkling with its programs has always kept pace with the amazing development and progress in various fields, seeking the renaissance of the homeland and the citizen in advanced paths towards a comprehensive vision.
                            </p>
                        </div>
                        <div class="body-welcome web">
                            <div class="top-content nav-center m-b-40 missions">
                                <ul class="nav nav-pills" role="tablist" id="schedule-tabs">
                                    <li role="presentation" class="list active">
                                        
                                        <a href="#tab-1" aria-controls="tab-1" role="tab" data-toggle="tab">ESTABLISHMENT</a>
                                    </li>
                                  
                                    <li role="presentation" class="">
                                        
                                        <a href="#tab-2" aria-controls="tab-2" role="tab" data-toggle="tab">VISION</a>
                                    </li>
                                    <li role="presentation" class="">
                                        
                                        <a href="#tab-3" aria-controls="tab-3" role="tab" data-toggle="tab">MISSION</a>
                                    </li>
                                </ul>
                                {{-- /////////// --}}
                              
                                <div class="tab-content">
                                    <div role="tabpanel" class="tab-pane active" id="tab-1">
                                        <div class="row collections">
                                           
                                            <p>
                                                <strong>IVORY is a registered training and consultancy&nbsp; trade mark under the name silver ivory based in Riyadh, Saudi Arabia and has a branch in Istanbul.</strong>
                                            </p>
                                           
                                          
                                        </div>
                                    </div>
                                    <!-- end .tabpanel -->
                                    <div role="tabpanel" class="tab-pane" id="tab-2">
                                        <div class="row collections">
                                         
                                            <p>
                                                <strong>Regional leadership in developing leadership &amp; management practices for our customers.</strong>
                                            </p>
                                            
                                        </div>
                                    </div>
                                    <!-- end .tabpanel -->

                                    <div role="tabpanel" class="tab-pane" id="tab-3">
                                        <div class="row collections">
                                         
                                            <p>
                                                <strong>Professional qualitative training in global management and leadership practices, to help our customers to redefine work concepts and develop performance.</strong>
                                            </p>
                                            
                                        </div>
                                    </div>
                                </div>
                                {{-- ////////// --}}
                            </div>
                            
                        </div>
                       
                    </div>
                </div>
            </div>
        </section>

        <!--  Welcome  -->



        <!--  Slide  -->

        <section class="slide" style="background-image: url({{asset('ivory')}}/assets/img/slider/5.jpg);height: 255px;">
            <div class="slide-overlay">
                <div class="slide-content about-title" style="margin-top: 97px">
                    <h1 class="" style="margin-left:454px">Ivory Values</h1>
                </div>
            </div>
        </section>

        <!--  Slide  -->

        <!--  Services About  -->

        <section class="services-about">
            <div class="services-about-overlay">
                <div class="container-about">
                    <div class="services-about-conetnt">
                        <div class="row">
                            <div class="col-lg-3 col-md-6">
                                <div class="service">
                                    <div class="service-front">
                                        <div class="front-content">
                                            <div class="icon">
                                                <i class="fa fa-suitcase"></i>
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
                                                <i class="fa fa-bars"></i>
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
                                                <i class="fa fa-users"></i>
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
                                                <i class="fa fa-cogs"></i>
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



        <!--  Building  -->
        <section class="building">
            <div class="building-overlay">
                <div class="container-about">
                    <div class="building-content">
                        <div class="head-building">
                            <h2>IVORY is building a learning community for Everyone</h2>
                        </div>
                        <div class="middle-building">
                            <iframe style="width: 100%" height="315" src="https://www.youtube.com/embed/Odhx02TwZw8" frameborder="0" allow="accelerometer; autoplay; clipboard-write; encrypted-media; gyroscope; picture-in-picture" allowfullscreen></iframe>
                        </div>
                        <div class="body-building">
                            <div class="row" style="margin: 0px;color:black">
                                <div class="col-md-3">
                                    <div class="cert">
                                        <div class="img-icon">
                                            <i class="fa fa-calendar"></i>
                                        </div>
                                        <div class="title-cert">
                                            <h2 class="count" data-value="4">4</h2>
                                            <div class="title text-color">YEARS OF EXPERIENCE</div>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-md-3">
                                    <div class="cert">
                                        <div class="img-icon">
                                            <i class="fa fa-tasks"></i>
                                        </div>
                                        <div class="title-cert">
                                            <h2 class="count" data-value="282">282</h2>
                                            <div class="title text-color">TRAINING PROGRAMS</div>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-md-3">
                                    <div class="cert">
                                        <div class="img-icon">
                                            <i class="fa fa-user-graduate"></i>
                                        </div>
                                        <div class="title-cert">
                                            <h2 class="count" data-value="14800">14800</h2>
                                            <div class="title text-color">PARTICIPANTS</div>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-md-3">
                                    <div class="cert">
                                        <div class="img-icon">
                                            <i class="fa fa-clock"></i>
                                        </div>
                                        <div class="title-cert">
                                            <h2 class="count" data-value="28900">28900</h2>
                                            <div class="title text-color">TRAINING HOURS</div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </section>
        <!--  Building  -->

        <!--  Partners  -->

      

        <!--  Partners  -->

        <div class="line">
            <img src="{{asset('ivory')}}/assets/img/slider/7.jpg" alt="Untitled" class="img-fluid">
        </div>



        

        <!--  Features  -->
                     
                        <!-- <div class="comment">
                            
                        </div> -->
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
    