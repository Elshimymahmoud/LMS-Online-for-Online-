
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

                

                    
                    <div class="col-sm-12 col-md-12 plan  wow fadeInUp ptb-50  mt-0">
                       
        <!--  Slide  -->

        <section class="slide" style="height: 200px;
        background-size: cover;
        color: white;background-image: url({{asset('ivory')}}/assets/img/slider/4.jpg);">
            <div class="slide-overlay">
                <div class="slide-content">
                    <h1 class="about-title" style="margin-right:39%">عن تمهير</h1>
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
                            <h2>مرحبا بك في تمهير للتدريب</h2>
                        </div>
                        <div class="middle-welcome">
                            <p>
                                تمهير …و2020 لاشك أنها سنة التحديات العظيمة والمنعطف لبداية عقد جديد من التحولات والتطور في التكنولوجيا والعلوم ولأن مسؤولية التدريب تعاظمت ومجالاته تنوعت تبقى تمهير على استعداد لكل التحديات ولخلق ميادين جديدة للتدريب ، ولذلك كانت استراتيجيتنا في التدريب مختلفة ومتميزة . تمهير المتألقة ببرامجها دائما تواكب التطور المذهل والتقدم في شتى المجالات تسعى لنهضة الوطن والمواطن في مسارات متطورة نحو رؤية شاملة.
                            </p>
  
                        </div>
                        <div class="body-welcome web">
                            <div class="top-content nav-center m-b-40 missions">
                                <ul class="nav nav-pills" role="tablist" id="schedule-tabs">
                                    <li role="presentation" class="list active">
                                        
                                        <a href="#tab-1" aria-controls="tab-1" role="tab" data-toggle="tab">التأسيس</a>
                                    </li>
                                  
                                    <li role="presentation" class="">
                                        
                                        <a href="#tab-2" aria-controls="tab-2" role="tab" data-toggle="tab">الرؤية</a>
                                    </li>
                                    <li role="presentation" class="">
                                        
                                        <a href="#tab-3" aria-controls="tab-3" role="tab" data-toggle="tab">الرسالة</a>
                                    </li>
                                </ul>
                                {{-- /////////// --}}
                              
                                <div class="tab-content">
                                    <div role="tabpanel" class="tab-pane active" id="tab-1">
                                        <div class="row collections">
                                           
                                            <p>
                                                <strong>تمهير علامة تجارية مسجلة في التدريب والاستشارات باسم العاج الفضي للتدريب ومقرها الرياض , المملكة العربية السعودية.</strong>
                                            </p>
                                           
                                          
                                        </div>
                                    </div>
                                    <!-- end .tabpanel -->
                                    <div role="tabpanel" class="tab-pane" id="tab-2">
                                        <div class="row collections">
                                         
                                            <p>
                                                <strong>الريادة الاقليمية في تطوير و تنمية ممارسة القيادة والإدارة لعملائنا.</strong>
                                            </p>
                                            
                                        </div>
                                    </div>
                                    <!-- end .tabpanel -->

                                    <div role="tabpanel" class="tab-pane" id="tab-3">
                                        <div class="row collections">
                                         
                                            <p>
                                                <strong>التدريب الاحترافي والنوعي للممارسات الإدارية والقيادية العالمية بما يمكن عملاءنا من إعادة صياغة مفاهيم العمل وتطوير الأداء.</strong>
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
                <div class="slide-content about-title">
                    <h1 class="about-title" style="margin-right:454px">قيمنا</h1>
                </div>
            </div>
        </section>

        <!--  Slide  -->

        <!--  Services About  -->

        <section class="services-about">
            <div class="services-about-overlay">
                <div class="container-about">
                    <div class="services-about-conetnt">
                        <div class="row" style="padding: 15px;">
                            <div class="col-lg-3 col-md-6" style="border-left: 1px solid #b74e4b;height: 224px">
                                <div class="service">
                                    <div class="service-front">
                                        <div class="front-content">
                                            <div class="icon">
                                                <i class="fa fa-suitcase"></i>
                                            </div>
                                            <div class="title-icon">
                                                الاحترافية
                                            </div>
                                        </div>
                                    </div>
                                    <div class="service-back">
                                        <div class="back-content">
                                            <p>
                                                تسعى تمهير لتحقيق مستوى عال من التميزفي برامجها التدريبية ضمن آليات عمل دقيقة وأولاويات محددة ينم عن فهم عميق لتوقعات العملاء والتصرف وفقا لذلك
                                            </p>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="col-lg-3 col-md-6" style="border-left: 1px solid #b74e4b;height: 224px">
                                <div class="service">
                                    <div class="service-front">
                                        <div class="front-content">
                                            <div class="icon">
                                                <i class="fa fa-bars"></i>
                                            </div>
                                            <div class="title-icon">
                                                المصداقية والالتزام
                                            </div>
                                        </div>
                                    </div>
                                    <div class="service-back">
                                        <div class="back-content">
                                            <p>
                                                نؤمن بأن نجاح العملاء هو نجاحنا لذا نحن ملتزمون بما يحقق رضا عملاؤنا ونسعى دائما لأن تكون علاقتنا مع العملاء هي علاقة نمو متبادل نلتزم بتعزيزها وحمايتها
                                            </p>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="col-lg-3 col-md-6" style="border-left: 1px solid #b74e4b;height: 224px">
                                <div class="service">
                                    <div class="service-front">
                                        <div class="front-content">
                                            <div class="icon">
                                                <i class="fa fa-users"></i>
                                            </div>
                                            <div class="title-icon">
                                                الريادة والابتكار
                                            </div>
                                        </div>
                                    </div>
                                    <div class="service-back">
                                        <div class="back-content">
                                            <p>
                                                تقديم الجديد والحديث في عالم التدريب والتطويروالمبادرة في تلبية احتياج العملاء هو أهم قيم ايفوري التي نسعى من خلالها الى تسخير التقنيات الحديثة لمخرجات تدريبية أفضل وكسب ثقة العميل أينما كان
                                            </p>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="col-lg-3 col-md-6" style="height: 224px">
                                <div class="service">
                                    <div class="service-front">
                                        <div class="front-content">
                                            <div class="icon">
                                                <i class="fa fa-cogs"></i>
                                            </div>
                                            <div class="title-icon">
                                                الجودة والكفاءة
                                            </div>
                                        </div>
                                    </div>
                                    <div class="service-back">
                                        <div class="back-content">
                                            <p>
                                                تسعى ايفوري لضمان جودة البرامج التدريبية المقدمة للعملاء من خلال تصميم برامج تلائم احتياج العملاء وأيضا الحفاظ على رضا العملاء التام من خلال التقييم المستمر لفرق العمل المسؤولة عن توفير الخدمات عالية الجودة
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
                            <h2>تقوم تمهير ببناء مجتمع تعليمي للجميع</h2>
                        </div>
                        <div class="middle-building">
                            <iframe style="width: 100%" height="315" src="https://www.youtube.com/embed/Odhx02TwZw8" frameborder="0" allow="accelerometer; autoplay; clipboard-write; encrypted-media; gyroscope; picture-in-picture" allowfullscreen></iframe>
                        </div>
                        <div class="body-building">
                            <div class="row" style="margin: 0px;color:black;padding-bottom:25px">
                                <div class="col-md-3">
                                    <div class="cert">
                                        <div class="img-icon">
                                            <i class="fa fa-calendar"></i>
                                        </div>
                                        <div class="title-cert">
                                            <h2 class="count" data-value="4">4</h2>
                                            <div class="title text-color">سنوات الخبرة</div>
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
                                            <div class="title text-color">البرامج التدريبية</div>
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
                                            <div class="title text-color">الحضور</div>
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
                                            <div class="title text-color">الساعات التدريبية</div>
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


        <!--  Team  -->

    

        <!--  Team  -->
    

        <!--  Features  -->


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
    