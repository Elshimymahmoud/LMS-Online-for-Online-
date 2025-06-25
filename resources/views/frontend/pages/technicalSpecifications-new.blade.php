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



                      
                        <div class="col-sm-12 col-md-12 plan  wow fadeInUp ptb-50  mt-0">
                            <div class="plan1">



                                <!--  Slide  -->

                                <section class="slide"
                                    style="border-radius:10px;background-image: url({{ asset('ivory') }}/assets/img/slider/4.jpg);">
                                    <div class="slide-overlay" style="padding: 10px">
                                        <div class="slide-content">
                                            <h3>@lang('custom-menu.nav-menu.technical-specifications')</h3>
                                        </div>
                                    </div>
                                </section>

                                <!--  Slide  -->


                                <!--  Welcome  -->

                                <section class="welcome">

                                    <div class="head-welcome">
                                        <h2></h2>
                                    </div>
                                    {{-- start first --}}
                                    <div class="first">
                                        <div class="middle-welcome">
                                            <h5>
                                                @lang('custom-menu.nav-menu.technical-specifications')‬‬
                                                ‬
                                            </h5>
                                            <h5>
                                                تستخدم تمهير منصة زوم الإلكترونية وهي منصة سحابية عن طريق الإنترنت، وتحوي
                                                المميزات التالية
                                            </h5>
                                            <p>
                                            <ul>
                                                <li>
                                                    خدمة الدخول الموحد (SSO) للفصل الإفتراضي
                                                </li>
                                                <li>
                                                    ميزات الأمان في الاجتماع ، وغيرها من الإجراءات على تأمين القاعة
                                                    الإفتراضية في Zoom
                                                </li>
                                                <li>
                                                    منع الاضطرابات ، وتمكين الامتثال لقانون حماية البيانات المالية وحقوق
                                                    الإنسان (FERPA) واللائحة العامة لحماية البيانات (GDPR)
                                                </li>
                                                <li>
                                                    إن الأنظمة التي تقوم بتوفيرها إدارة تمهير للتعليم الإلكتروني تدعم أجهزة
                                                    الحاسب الآلي (مثل: أنظمة Mac OS وأنظمة Windows) بمختلف المتصفحات (مثل:
                                                    متصفح جوجل كروم، مايكروسوفت إدج، والمتصفحات الأخرى) وأجهزة الهواتف
                                                    الذكية والأجهزة اللوحية مع اختلاف أنظمة تشغيلها (أنظمة IOS وأظمة
                                                    Android) واختلاف أحجام شاشاتها. المنصة تستوعب عدد من المستخدمين يصل إلى
                                                    500 شخص.إن منصة زوم الإلكترونية مربوطة على منصة تمهير الإلكترونية و
                                                    بإمكان المشارك الوصول للرابط مباشرة من حسابه
                                                </li>
                                            </ul>
                                            </p>
                                            <p>
                                                دليل الكادر الإشرافي على البيئة التدريبية وكوادر الدعم التقني والتعليمي:
                                            </p>
                                            <h5>
                                                وتكون خطوات التسجيل على منصة زوم كالتالي
                                            </h5>
                                            <p>
                                            <ul>
                                                <li>
                                                    يتم مساعدة المشاركين بالتسجيل على برنامج زوم، ثم الدخول إلى الزوم بالاسم
                                                    الصحيح و ذلك لتسجيل الحضور
                                                </li>
                                                <li>
                                                    يتم التواصل مع المشاركين الذين يدخلون بأسماء غير صحيحة و الطلب منهم إما
                                                    إعادة التسمية أو ارسال الاسم الصحيح
                                                </li>
                                                <li>
                                                    في حال عدم الرد سيتم إخراج المشارك من المنصة إلى حين تزويدنا بالاسم
                                                    الصحيح.
                                                    يتم توفير خدمة التنبيهات عبر الإيميل الإلكتروني او عبر الاتصال المباشر
                                                    لتنبيه المتدربين على المهام المطلوبة بشكل مستمر
                                                </li>
                                            </ul>
                                            </p>
                                        </div>
                                        <div class="middle-welcome">
                                            <h5>
                                                منصة تمهير الإلكترونية لمتابعة البرامج التدريبية
                                            </h5>
                                            <p>
                                                يوفر موقع تمهير الإلكتروني خاصية البحث عن المحتويات الرقمية بسهولة، مع
                                                إمكانية استخدام المحتوى للتعلم ومتابعة الجلسات المسجلة، ويمنح المشارك حق
                                                الدخول لمدة عام كامل. يتم إرفاق رابط فيديو توضيحي لطريقة استعمال منصة تمهير
                                                و متابعة البرامج التدريبية و ذلك على منصة تمهير التدريبية
                                            </p>
                                            <p>
                                                {{-- <iframe style="width: 100%" loading="lazy"
                                                    src="https://player.vimeo.com/video/481429736?dnt=1&amp;app_id=122963&amp;h=811e12c4d2"
                                                    width="1170" height="624" frameborder="0"
                                                    allow="autoplay; fullscreen; picture-in-picture"
                                                    allowfullscreen=""></iframe> --}}

                                                    <div itemscope itemtype="https://schema.org/VideoObject">
                                                        <meta itemprop="uploadDate" content="Tue Feb 01 2022 15:48:38 GMT+0300 (التوقيت العربي الرسمي)"/>
                                                        <meta itemprop="name" content="Gmt20220201-085303 Recording 1366x768"/>
                                                        <meta itemprop="duration" content="P0Y0M0DT0H2M13S" />
                                                        <meta itemprop="thumbnailUrl" content=""/>
                                                        <meta itemprop="contentUrl" content="https://content.jwplatform.com/videos/AfCP5DdL-hiwGi68d.mp4"/>
                                                        <script src="https://cdn.jwplayer.com/players/AfCP5DdL-Guipk0BF.js"></script>
                                                    </div>
                                                        
                                                </p>
                                            </div>
                                            </p>
                                        </div>

                                        <div class="middle-welcome">
                                            <h5>
                                                روابط تهمك

                                            </h5>
                                            <ul>
                                                <li>
                                                    <a target="_blank"
                                                        href="{{ asset('storage/helpsPdf/zoomivory.pdf') }}">طريقة استخدام
                                                        برنامج Zoom </a>
                                                </li>
                                                <li>
                                                    <a target="_blank" href="{{ route('contact') }}">تواصل معنا</a>
                                                </li>
                                            </ul>

                                        </div>

                                    </div>
                                    {{-- end first --}}




                                </section>

                                <!--  Welcome  -->


                            </div>

                            <!-- <div class="comment">
                                
                            </div> -->
                        </div>


                    </div>
                </div>
            </div>


        </div>
        </div>
    </section>

@endsection

@push('after-scripts')

@endpush
