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

    ul li,ol li {
        margin-bottom: 13px;
        font-weight: 600;
    }
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
</style>
@endpush

@section('content')



<!--  Slide  -->

<section class="slide" style="background-image: url({{asset('ivory')}}/assets/img/slider/4.jpg);">
    <div class="slide-overlay">
        <div class="slide-content">
            <h3>@lang('custom-menu.nav-menu.common-questions')</h3>
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
                        <h3 class="dark-red fnt-wght-900">
                            @lang('custom-menu.nav-menu.common-questions')‬‬
                            ‬
                        </h3>
                        <br>
                        <p>التسجيل في المنصة</p>
                        <p class="dark-red">
                            كيف أسجل في منصة تمهير؟
                        </p>
                        <p>للتسجيل اتبع الخطوات التالية:</p>
                        <ul>
                            <li>
                                من القائمة في الأعلى اختر “تسجيل الدخول” ثم انقر على “تسجيل جديد”
                            </li>
                            <li>
                                قم بتعبئة البيانات بشكل صحيح
                            </li>
                            <li>
                                ثم انقر على “تسجيل“.
                            </li>
                            <li>
                                ستظهر صفحة تسجيل الدخول، قم بتعبئة بيانات حسابك الذي أنشأته للتو ومن ثم اضغط تسجيل
                                الدخول.
                                مرفق لكم رابط فيديو توضيحي لطريقة استعمال منصة تمهير و متابعة البرنامج التدريبي و ذلك
                                على منصة تمهير التدريبية نرجوا منكم و نؤكد على مشاهدته أولا :
                                <strong>

                                    <a href="https://vimeo.com/481429736/811e12c4d2 ">How to register in ivory</a>

                                </strong>
                            </li>
                        </ul>

                    </div>

                    <div class="middle-welcome">
                        <h5>
                            كيف يمكنني استعادة كلمة المرور؟
                            ‬
                        </h5>
                        <p>
                            لاستعادة كلمة المرور اتبع الخطوات التالية:
                        </p>
                        <p>
                            <ul>
                                <li>
                                    من القائمة في الأعلى انقر تسجيل الدخول.
                                </li>
                                <li>
                                    ثم اضغط على”نسيت كلمة المرور“.

                                </li>
                                <li>
                                    قم بإدخال إيميلك في المكان المخصص ثم اضغط على “استعادة كلمة المرور.
                                </li>
                            </ul>
                        </p>

                    </div>
                    <div class="middle-welcome">
                        <h5>
                            الالتحاق بالدورات وبدء التعلم

                        </h5>

                        <p class="dark-red">
                            هل الدورات مجانية ؟
                        </p>
                        <p>
                            نقدم لك في منصة ايفورى عدة أنواع من الدورات:
                        </p>
                        <p>

                            <ul>
                                <li>
                                    دورات بالتحاق مجاني وشهادة مجانية.

                                </li>
                                <li>
                                    دورات بالتحاق مجاني وشهادة مدفوعة إذا رغبت بالحصول عليها بعد اجتياز الدورة.

                                </li>
                                <li>
                                    دورات مسبقة الدفع (تتضمن الشهادة).
                                </li>
                                <li>
                                    نوع الدورة موضح في الصفحة الخاصة بها.

                                </li>


                            </ul>
                        </p>

                    </div>

                    <div class="middle-welcome">
                        <h5>
                            كيف التحق بدورة على تمهير؟

                        </h5>


                        <p>

                            <ul>
                                <li>
                                    توجه لصفحة “تصفح الدورات”وستظهر لك جميع الدورات المتاحة.
                                </li>
                                <li>
                                    قم بالضغط على الدورة التي تريد الالتحاق بها، ومن ثم ستفتح لك صفحة الدورة.

                                </li>
                                <li>
                                    اضغط على زر الالتحاق (إذا كانت الدورة مسبقة الدفع ستحتاج إلى إتمام عملية الدفع)، او
                                    من خلال التواصل مع فريق المبيعات والتسجيل في البرنامج مباشرة.
                                </li>
                                <li>
                                    يتم تجهيز حسا ب مشارك لك عن طريق فريق التنفيذ وارساله لك على الإيميل الشخصي الذي قمت
                                    بتزويدنا به عند التسجيل
                                </li>
                                <li>
                                    بعد تسجيل الدخول إلى المنصة من خلال الحساب قم بالضغط على دوراتي وستجد الدورة جاهزة
                                    للبدء.
                                </li>

                            </ul>
                        </p>
                        <p class="dark-red">
                            متى يكون حضور الدورة؟ وهل يوجد وقت معين للحضور؟
                        </p>
                        <p>
                            وضع سياسة الحضور منصة تمهير هي منصة تعلم عن بعد، وهذا يعني حضور المحاضرات المسجلة عن بعد في
                            الوقت والمكان المناسبين لك خلال مدة الدورة، وذلك عن طريق مشاهدة المحاضرات المصورة و القراءات
                            الإثرائية و أداء المهام عبر جهاز الكمبيوتر أو الجوال أو الجهاز اللوحي. لذلك، الدورة في
                            الاساس مسجلة و متاحة لك طوال المدة المحددة لها. في حال وجود لقاءات مباشرة مع المدرب يتم
                            الإعلان عن ذلك ضمن تنويهات الدورة.
                        </p>
                    </div>

                    <div class="middle-welcome">
                        <h5>
                            كيف أقوم بتسليم المهام؟

                        </h5>


                        <p>

                            <ul>
                                <li>
                                    توجه للمهمة التي تريد حلها وانقر عليها.
                                </li>
                                <li>
                                    قم بالإجابة على الأسئلة ثم انقر إرسال المهمة، وستظهر لك النتيجة فور التسليم.
                                </li>
                                <li>
                                    <strong class="dark-red"> ملاحظة:</strong>
                                    لديك فرصة واحدة لإتمام المهمة ولا يمكن إعادتها مرة أخرى.
                                </li>


                            </ul>
                        </p>
                        <p class="dark-red">
                            هل يمكنني تسليم المهام أو إكمال المحتويات الإلزامية بعد انتهاء مدة الدورة؟
                        </p>
                        <p>
                            يتم تحديد موعد نهائي للمشاركين لتسليم مهام الدورة أو إكمال محتواها، ولا يتم قبول استلام
                            المهام بعد انتهاء هذا الموعد.
                        </p>
                    </div>
                    <div class="middle-welcome">
                        <h5>
                            كيف يمكنني رؤية نسبة حضوري في دورة ما؟

                        </h5>
                        <p>
                            يمكنك الاطلاع على نسبة حضورك من خلال تبويب “تقدمك في الدورة” ، حيث يمكنك الضغط على كلمة
                            “استكمل” في كل جزء من أجزاء الدورة، ليقوم النظام باحتساب نسبة حضورك.
                        </p>


                        <h5>
                            كيف اعرف اني اجتزت الدورة؟ متى احصل على الشهادة؟

                        </h5>

                        <p>
                            بعد إكمال المحتويات الإلزامية وتسليم المهام خلال مدة الدورة، يتم إعلامك بتحقيق متطلبات حضور
                            الدورة واستحقاق الشهادة، وهي نسبة 85% حضور بالاضافة إلى إتمام نسبة 50% من المهام..
                        </p>
                        <h5>
                            في حال عدم الاجتياز، هل يوجد فرصة أخرى لإكمال الدورة والحصول على درجة الاجتياز؟
                        </h5>
                        <strong>
                            <p>
                                نعم، يمكنك المحاولة مرة أخرى لاجتياز الدورة والحصول على الشهادة كالتالي:
                            </p>
                        </strong>
                        <p>
                            إتمام نسبة الحضور المطلوبة من الجلسات الإلكترونية المسجلة لنفس الدورة، حيث يظهر على النظام تقدمك في الدورة وتتاح لك الفرصة لإكمال ما تبقى لك من المحتوى أو المهام. ضمن مدة محددة يتم الاتفاق عليها مع فريق التنفيذ في تمهير
                        </p>

                    </div>
                    <div class="middle-welcome">
                        <h5>
                            هل سأتمكن من الوصول للمحتوى بعد الانتهاء من الدورة والحصول على الشهادة؟

                        </h5>
                        <p>
                            نعم سيظل لديك صلاحية مدتها عام للوصول للمحتوى وقت ما أردت.
                        </p>


                        <h5>
                            ماهي المدة المتاحة لإكمال الدورة بعد اختيار التمديد؟

                        </h5>

                        <p>
                            يتاح لك نفس المدة الأساسية التي تم تحديدها مسبقاً في الدورة.


                        </p>
                        <h5>
                            مما تتكون صفحة الدورة؟
                        </h5>
                
                        <p>
                            تتكون صفحة الدورة من الأقسام التالية:
                        </p>
                        <p>
                            <ul>
                                <li>
                                    قسم الوحدات والجلسات المسجلة: تعتبر بمثابة الحقيبة التدريبية وتحتوي على جميع المواد المرئية والمقروءة والمهمات الخاصة بمحتوى الدورة.
                                </li>
                                <li>
                                    قسم النقاشات: هي صفحة مخصصة لطرح جميع النقاشات الخاصة بمحتوى الدورة لمناقشتها مع المتدربين والمدرب.
                                </li>
                                <li>
                                    قسم التنويهات: هي صفحة للإعلان عن أي ملاحظات مهمة في الدورة أو تنويهات متعلقة بها.
                                </li>
                                <li>
                                    الصفحة الرئيسية: هي الصفحة الأولى التي تظهر للمتدرب عند دخوله للدورة وغالباً ما تحتوي على الوحدات والجلسة الإلكترونية المسجلة، ويظهر فيها إشعار الاستكمال أو عدمه. 
                                </li>

                            </ul>
                        </p>
                    </div>
                    <div class="middle-welcome">
                        <h5>
                            الشهادات والدفع

                        </h5>
                        <p>
                            ماهي متطلبات الحصول على الشهادة؟ ماهي معايير اجتياز الدورة؟ كيف أحصل على الشهادة؟
                        </p>

                        <p>
                            إن الدورات التدريبية في تمهير، هي دورات تطويرية، يتطلب الحصول على الشهادة تحقيق معايير الحضور المحددة للدورة وهي
                        </p>
                       

                        <p>
                           <ul>
                               <li>
                                إكمال المحتويات الإلزامية في الدورة وتسليم المهام بنسبة 50%.
                               </li>
                               <li>
                                تحقيق نسبة حضور تتجاوز 85% من مدة الدورة. 
                               </li>
                           </ul>


                        </p>
                        <h5>
                            ما هي طرق الدفع المتوفرة؟


                        </h5>
                
                        <p>
                            طرق الدفع المتوفرة هي:


                        </p>
                        <p>
                            <ul>
                                <li>
                                   ماي فاتورة
                                </li>
                                <li>
                                    التحويل البنكي
                                </li>
                              

                            </ul>
                        </p>
                    </div>
                    <div class="middle-welcome">
                        <h5>
                            أسئلة عامة

                        </h5>
                        <p class="dark-red">
                            ماهي صفحة “شهاداتي” ؟ 
                        </p>

                        <p>
                            صفحة شهاداتي تمكنك من استعراض وتحميل جميع الشهادات التي استحققتها لكل دورة اجتزتها، بالإضافة إلى الشهادات التي يمكنك شراؤها بسبب اجتيازك للدورة الخاصة ولكن لم تحصل عليها بعد.
                        </p>
                        <p class="dark-red">
                            ماهي صفحة دوراتي؟ 

 
                        </p>

                        <p>
                            تمكنك هذه الصفحة من استعراض جميع دوراتك الحالية والسابقة.  
                        </p>
                        <p class="dark-red">
                            كيف أقوم بالتحكم بتفضيلات الإشعارات التي تصلني على البريد الإلكتروني من المنصة؟ 

 
                        </p>

                        <p>
                            يمكنك تحديد الإشعارات التي تصلك على البريد الإلكتروني من خلال التوجه إلى إعدادات الحساب ومن ثم اختيار تفضيلات الإشعارات.
                        </p>

                        <p class="dark-red">
                            كيف أقوم بإضافة السيرة الذاتية وصورة الملف الشخصي لحسابي؟ 

 
                        </p>

                        <p>
                            <ul>
                                <li>
                                    من القائمة في الأعلى اضغط على أيقونة إعدادات الملف الشخصي.
                                </li>
                                <li>
                                    ستظهر لك صفحة الإعدادات،
                                </li>
                                <li>
                                    اضغط على البيانات الشخصية، و من ثم توجه إلى زر “تعديل البيانات”
                                </li>
                                <li>
                                    قم بتعديل بياناتك وحفظ التغييرات. 
                                </li>
                            </ul>
                        </p>

                        <p class="dark-red">
                            كيف أقوم بإرسال رسالة خاصة إلى مدرب الدورة؟ 
                        </p>
                        <p>
                            إذا كنت بحاجة إلى التواصل مع مدرب الدورة عن طريق الرسائل الخاصة اتبع الخطوات التالية:
                        </p>
                        <p>
                            <ul>
                                <li>
                                    إضغط على أيقونة “اشارة الاستفهام” فيظهر لك تبويب “اطرح سؤال”
                                </li>
                                <li>
                                    كما يمكنك استعراض الاسئلة التي تم طرحها
                                </li>
                                <li>
                                    يمكنك ايضا سؤال المدرب مباشرة عبر الجروب في الواتس اب، او بواسطة منسق الدورة.
                                </li>
                            </ul>
                        </p>
                    </div>
                </div>
                {{-- end first --}}



            </div>
        </div>
    </div>
</section>

<!--  Welcome  -->












@endsection