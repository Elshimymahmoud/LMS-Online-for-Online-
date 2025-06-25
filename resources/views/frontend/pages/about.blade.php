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

        <section class="slide" style="background-image: url({{asset('ivory')}}/assets/img/slider/4.jpg);">
            <div class="slide-overlay">
                <div class="slide-content">
                    <h1>ABOUT IVORY</h1>
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
                            <div class="top-content">
                                <ul class="list-unstyled d-flex">
                                    <li class="nav-list active" data-list="establ">ESTABLISHMENT</li>
                                    <li class="nav-list" data-list="vision">VISION</li>
                                    <li class="nav-list" data-list="mission">MISSION</li>
                                </ul>
                            </div>
                            <div class="bottom-content">
                                <div class="establ content active">
                                    <p>
                                        <strong>IVORY is a registered training and consultancy&nbsp; trade mark under the name silver ivory based in Riyadh, Saudi Arabia and has a branch in Istanbul.</strong>
                                    </p>
                                </div>
                                <div class="vision content">
                                    <p>
                                        <strong>Regional leadership in developing leadership &amp; management practices for our customers.</strong>
                                    </p>
                                </div>
                                <div class="mission content">
                                    <p>
                                        <strong>Professional qualitative training in global management and leadership practices, to help our customers to redefine work concepts and develop performance.</strong>
                                    </p>
                                </div>
                            </div>
                        </div>
                        <div class="body-welcome mob">
                            <div class="head-content">
                                <h4 class="active" data-list="establ">Establishment</h4>
                            </div>
                            <div class="establ content active">
                                <p>
                                    <strong>IVORY is a registered training and consultancy&nbsp; trade mark under the name silver ivory based in Riyadh, Saudi Arabia and has a branch in Istanbul.</strong>
                                </p>
                            </div>
                            <div class="head-content">
                                <h4 class="" data-list="vision">Vision</h4>
                            </div>
                            <div class="vision content">
                                <p>
                                    <strong>IVORY is a registered training and consultancy&nbsp; trade mark under the name silver ivory based in Riyadh, Saudi Arabia and has a branch in Istanbul.</strong>
                                </p>
                            </div>
                            <div class="head-content">
                                <h4 class="" data-list="mission">mission</h4>
                            </div>
                            <div class="mission content">
                                <p>
                                    <strong>IVORY is a registered training and consultancy&nbsp; trade mark under the name silver ivory based in Riyadh, Saudi Arabia and has a branch in Istanbul.</strong>
                                </p>
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
                <div class="slide-content">
                    <h1>IVORY VALUES</h1>
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
                                                <i class="fas fa-suitcase"></i>
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
                                                <i class="fas fa-bars"></i>
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
                                                <i class="fas fa-users"></i>
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
                                                <i class="fas fa-cogs"></i>
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
                            <iframe width="700" height="315" src="https://www.youtube.com/embed/Odhx02TwZw8" frameborder="0" allow="accelerometer; autoplay; clipboard-write; encrypted-media; gyroscope; picture-in-picture" allowfullscreen></iframe>
                        </div>
                        <div class="body-building">
                            <div class="row">
                                <div class="col-md-3">
                                    <div class="cert">
                                        <div class="img-icon">
                                            <i class="fas fa-calendar"></i>
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
                                            <i class="fas fa-tasks"></i>
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
                                            <i class="fas fa-user-graduate"></i>
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
                                            <i class="fas fa-clock"></i>
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

        <section class="partner">
            <div class="partner-overlay">
                <div class="container-about">
                    <div class="partner-content">
                        <div class="head-partner">
                            <h2>OUR EDUCATIONAL PARTNERS</h2>
                        </div>
                        <div class="body-partner">
                            <div dir="ltr" class="owl-carousel owl-partner">
                                <div class="item">
                                    <img src="{{asset('ivory')}}/assets/img/partners/1.jpg" alt="1" class="img-fluid">
                                </div>
                                <div class="item">
                                    <img src="{{asset('ivory')}}/assets/img/partners/2.jpg" alt="2" class="img-fluid">
                                </div>
                                <div class="item">
                                    <img src="{{asset('ivory')}}/assets/img/partners/3.jpg" alt="3" class="img-fluid">
                                </div>
                                <div class="item">
                                    <img src="{{asset('ivory')}}/assets/img/partners/4.jpg" alt="4" class="img-fluid">
                                </div>
                                <div class="item">
                                    <img src="{{asset('ivory')}}/assets/img/partners/5.jpg" alt="5" class="img-fluid">
                                </div>
                                <div class="item">
                                    <img src="{{asset('ivory')}}/assets/img/partners/6.jpg" alt="6" class="img-fluid">
                                </div>
                                <div class="item">
                                    <img src="{{asset('ivory')}}/assets/img/partners/7.jpg" alt="7" class="img-fluid">
                                </div>
                                <div class="item">
                                    <img src="{{asset('ivory')}}/assets/img/partners/8.jpg" alt="8" class="img-fluid">
                                </div>
                                <div class="item">
                                    <img src="{{asset('ivory')}}/assets/img/partners/9.jpg" alt="9" class="img-fluid">
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </section>

        <!--  Partners  -->

        <div class="line">
            <img src="{{asset('ivory')}}/assets/img/slider/7.jpg" alt="Untitled" class="img-fluid">
        </div>


        <!--  Team  -->

        <section class="team">
            <div class="team-overlay">
                <div class="container-about">
                    <div class="team-content">
                        <div class="head-team">
                            <h2>OUR EXPERTS</h2>
                        </div>
                        <div class="body-team">
                            <div class="row">
                                <div class="col-md-4">
                                    <div class="member">
                                        <div class="img-member">
                                            <img src="{{asset('ivory')}}/assets/img/team/1.jpg" alt="1" class="img-fluid">
                                        </div>
                                        <div class="name-member">
                                            <h3>DR. QASEM TURKI</h3>
                                        </div>
                                        <div class="disc-member">
                                            <p style="text-align: justify;">
                                                He Has a PhD in Management Information Systems, bachelor and Master of Economics and Management.
                                                A Strategic Management Expert
                                                He Worked at Orange Company Training Institute in Jordan and as a Professor Assistant in many Jordanian universities for 9 years. Presented many strategic plans for government and private institutions.
                                                Coach and international consultant for many government and private institutions
                                            </p>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-md-4">
                                    <div class="member">
                                        <div class="img-member">
                                            <img src="{{asset('ivory')}}/assets/img/team/2.jpg" alt="1" class="img-fluid">
                                        </div>
                                        <div class="name-member">
                                            <h3>DR. QASEM TURKI</h3>
                                        </div>
                                        <div class="disc-member">
                                            <p style="text-align: justify;">
                                                Management leadership skills Trainer
                                                Preparation of Trainers Trainer.
                                                Former CEO of ADAMCO Academy for Training and Consulting.
                                                Former academic supervisor for Business Institutions Administration diploma at the Training Center of the Chamber of Commerce and Industry in Riyadh
                                                More than 25 years of experience as an expert in assessing and developing functional leaders in the Kingdom of Saudi Arabia.
                                            </p>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-md-4">
                                    <div class="member">
                                        <div class="img-member">
                                            <img src="{{asset('ivory')}}/assets/img/team/3.jpg" alt="1" class="img-fluid">
                                        </div>
                                        <div class="name-member">
                                            <h3>MOHAMAD HASAN ALSHEHRI</h3>
                                        </div>
                                        <div class="disc-member">
                                            <p style="text-align: justify;">
                                                Dr. Mohammad Hassan Alshehri has a Master of Business Administration – human resources
                                                He is an Educational and family counselor
                                                He has Provided more than training course in different and various fields, totally equals to 750 training hours in 2019
                                                Dr. Mohammad is very interested in both developing and individuals’ development
                                            </p>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="more">
                                <a href="#"><span>see more</span></a>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </section>

        <!--  Team  -->
    

        <!--  Features  -->

        <section class="features">
            <div class="features-overlay">
                <div class="container-about">
                    <div class="features-content">
                        <div class="body-features">
                            <div class="row">
                                <div class="col-md-4">
                                    <div class="feature">
                                        <img src="{{asset('ivory')}}/assets/img/services/5.jpg" alt="Training" class="img-fluid">
                                        <div class="feature-content">
                                            <h2>Training</h2>
                                            <div class="tail">
                                                <p>See More</p>
                                            </div>
                                        </div>
                                        <a href="#" title="Courses"></a>
                                    </div>
                                </div>
                                <div class="col-md-4">
                                    <div class="feature">
                                        <img src="{{asset('ivory')}}/assets/img/services/2.jpg" alt="Consulting" class="img-fluid">
                                        <div class="feature-content">
                                            <h2>Consulting</h2>
                                            <div class="tail">
                                                <p>See More</p>
                                            </div>
                                        </div>
                                        <a href="#" title="Courses"></a>
                                    </div>
                                </div>
                                <div class="col-md-4">
                                    <div class="feature">
                                        <img src="{{asset('ivory')}}/assets/img/services/3.jpg" alt="Coaching" class="img-fluid">
                                        <div class="feature-content">
                                            <h2>Coaching</h2>
                                            <div class="tail">
                                                <p>See More</p>
                                            </div>
                                        </div>
                                        <a href="#" title="Courses"></a>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </section>

        <!--  Features  -->

@endsection