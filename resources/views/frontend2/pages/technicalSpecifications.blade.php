@extends('frontend.layouts.app'.config('theme_layout'))

@push('after-styles')
<style>
    .content img {
        margin: 10px;
    }

    .about-page-section ul {
        padding-left: 20px;
        font-size: 20px;
        color: #333333;
        font-weight: 300;
        margin-bottom: 25px;
    }

    ol li {
        margin-bottom: 13px;
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
</style>
@endpush

@section('content')



<!--  Slide  -->

<section class="slide" style="background-image: url({{asset('ivory')}}/assets/img/slider/4.jpg);">
    <div class="slide-overlay">
        <div class="slide-content">
            <h3>@lang('custom-menu.nav-menu.technical-specifications')</h3>
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
                            تستخدم تمهير منصة زوم الإلكترونية وهي منصة سحابية عن طريق الإنترنت، وتحوي المميزات التالية
                        </h5>
                        <p>
                          <ul>
                              <li>
                                خدمة الدخول الموحد (SSO) للفصل الإفتراضي
                              </li>
                              <li>
                                ميزات الأمان في الاجتماع ، وغيرها من الإجراءات على تأمين القاعة الإفتراضية في Zoom
                              </li>
                              <li>
                                منع الاضطرابات ، وتمكين الامتثال لقانون حماية البيانات المالية وحقوق الإنسان (FERPA) واللائحة العامة لحماية البيانات (GDPR)
                              </li>
                              <li>
                                إن الأنظمة التي تقوم بتوفيرها إدارة تمهير للتعليم الإلكتروني تدعم أجهزة الحاسب الآلي (مثل: أنظمة Mac OS وأنظمة Windows) بمختلف المتصفحات (مثل: متصفح جوجل كروم، مايكروسوفت إدج، والمتصفحات الأخرى) وأجهزة الهواتف الذكية والأجهزة اللوحية مع اختلاف أنظمة تشغيلها (أنظمة IOS وأظمة Android) واختلاف أحجام شاشاتها. المنصة تستوعب عدد من المستخدمين يصل إلى 500 شخص.إن منصة زوم الإلكترونية مربوطة على منصة تمهير الإلكترونية و بإمكان المشارك الوصول للرابط مباشرة من حسابه
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
                                يتم مساعدة المشاركين بالتسجيل على برنامج زوم، ثم الدخول إلى الزوم بالاسم الصحيح و ذلك لتسجيل الحضور
                              </li>
                              <li>
                                يتم التواصل مع المشاركين الذين يدخلون بأسماء غير صحيحة و الطلب منهم إما إعادة التسمية أو ارسال الاسم الصحيح
                              </li>
                              <li>
                                في حال عدم الرد سيتم إخراج المشارك من المنصة إلى حين تزويدنا بالاسم الصحيح.
                                يتم توفير خدمة التنبيهات عبر الإيميل الإلكتروني او عبر الاتصال المباشر لتنبيه المتدربين على المهام المطلوبة بشكل مستمر
                              </li>
                          </ul>
                      </p>
                    </div>
                    <div class="middle-welcome">
                        <h5>
                            منصة تمهير الإلكترونية لمتابعة البرامج التدريبية
                        </h5>
                        <p>
                            يوفر موقع تمهير الإلكتروني خاصية البحث عن المحتويات الرقمية بسهولة، مع إمكانية استخدام المحتوى للتعلم ومتابعة الجلسات المسجلة، ويمنح المشارك حق الدخول لمدة عام كامل.  يتم إرفاق رابط فيديو توضيحي لطريقة استعمال منصة تمهير و متابعة البرامج التدريبية و ذلك على منصة تمهير التدريبية
                        </p>
                        <p>
                            <iframe loading="lazy" src="https://player.vimeo.com/video/481429736?dnt=1&amp;app_id=122963&amp;h=811e12c4d2" width="1170" height="624" frameborder="0" allow="autoplay; fullscreen; picture-in-picture" allowfullscreen=""></iframe>
                        </p>
                    </div>

                    <div class="middle-welcome">
                        <h5>
                            روابط تهمك 

                        </h5>
                      <ul>
                          <li>
                              <a  target="_blank" href="{{asset('storage/helpsPdf/zoomivory.pdf')}}">طريقة استخدام برنامج Zoom </a>
                          </li>
                          <li>
                            <a  target="_blank" href="{{route('contact')}}">تواصل معنا</a>
                        </li>
                      </ul>

                    </div>

                </div>
                {{-- end first --}}



            </div>
        </div>
    </div>
</section>

<!--  Welcome  -->












@endsection