
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

                                    <section class="slide" style="border-radius: 10px;background-image: url({{asset('ivory')}}/assets/img/slider/4.jpg);">
                                        <div class="slide-overlay" style="padding: 10px">
                                            <div class="slide-content">
                                                <h3>@lang('custom-menu.nav-menu.technical-support')</h3>
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



                                            
                                    </section>

                                    <!--  Welcome  -->

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
    