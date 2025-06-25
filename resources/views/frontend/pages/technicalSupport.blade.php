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
            <h3>@lang('custom-menu.nav-menu.technical-support')</h3>
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
                            @lang('custom-menu.nav-menu.technical-support')‬‬
                            ‬
                        </h5>
                        <p>
                            <ol type="1">
                                <li>
                                    يتم تقديم الخدمات التدريبية عبر الموقع للمشاركين والمنتسبين إليه ويلتزم بتقديم الدعم
                                    اللازم للاستفادة من هذه الخدمات من خلال وسائل التواصل المعرفة بهذا الموقع
                                    <a href="{{route('contact')}}">تواصل معنا</a>
                                    وطوال مدة تنفيذ البرنامج
                                </li>
                                <li>
                                    <h5>يتم تقديم الدعم الفني من خلال القنوات التالية:</h5>
                                    <ol>
                                        <li>
                                            الاتصال او رسائل الواتس اب على الرقم ( 966115209894+ )
                                        </li>
                                        <li>
                                            البريد الإلكتروني: support@ivorytraining.com
                                        </li>
                                        <li>
                                            صفحة اتصل بنا على الموقع الإلكتروني
                                            <a href="{{route('contact')}}">اتصل بنا</a>

                                        </li>
                                    </ol>
                                </li>
                                <li>
                                    يتم إرفاق رابط فيديو توضيحي لطريقة استعمال منصة تمهير و متابعة البرامج التدريبية و
                                    ذلك على منصة تمهير التدريبية
                                    <a href="https://vimeo.com/481429736/811e12c4d2">فيديو توضيحي</a>
                                     ومساعدة
                                    المتدربين الدخول إلى المنصة عبر الضغط على الرابط التالي :
                                   <a class="dark-red" href="{{route('frontend.index')}}">Ivory training</a>
                                    حيث يتم إنشاء اسم المستخدم و كلمة السر لكل متدرب
                                </li>
                            </ol>
                        </p>
                        <p>
                            دليل الكادر الإشرافي على البيئة التدريبية وكوادر الدعم التقني والتعليمي:
                        </p>
                        <table class="table table">
                            <thead>
                                <tr>
                                    <th>اسم الممثل</th>
                                    <th>المسمى الوظيفي	</th>
                                    <th>الإيميل</th>
                                    <th>الجوال</th>
    
                                </tr>
                            </thead>
                           <tbody>
                            <tr>
                                <td>إبراهيم الغانم</td>
                                <td>مدير المركز	</td>
                                <td >institute.director@ivorytraining.com	</td>
                                <td>(+2)0115209894</td>

                            </tr>
                            <tr>
                                <td>م. محمود الصالح	</td>
                                <td>مدير الدعم التقني		</td>
                                <td>support@ivorytraining.com</td>
                                <td></td>
                                
                            </tr>
                            <tr >
                                <td>محمد مطلق القحطاني	</td>
                                <td>مدير حسابات العملاء			</td>
                                <td>cs@ivorytraining.com</td>
                               <td></td>

                            </tr>
                            <tr>
                                <td>نوير  العتيبي		</td>
                                <td>مسؤول تنسيق التدريب			</td>
                                <td>coordination@ivorytraining.com</td>
                               <td></td>
                            </tr>
                          
                        </tbody>
                        </table>
                      
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