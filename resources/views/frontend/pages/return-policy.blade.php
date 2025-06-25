
@extends('frontend.layouts.app'.config('theme_layout'))

@section('title', trans('custom-menu.nav-menu.return_policy').' | '.app_name())
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
    ol li{
        font-weight: 500;
        text-align: justify;
        line-height: initial;
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
                    <div class="col-sm-12 col-md-1   wow fadeInUp ptb-50  mt-0">
                    
                       
                    </div>
                    <div class="col-sm-12 col-md-10 plan  wow fadeInUp ptb-50  mt-0">
                        <div class="plan1">
                           
                                                            
                                    <!--  Slide  -->

                                    <section class="slide" style="border-radius: 10px;background-image: url({{asset('ivory')}}/assets/img/slider/4.jpg);">
                                        <div class="slide-overlay" style="padding: 10px">
                                            <div class="slide-content">
                                                <h3 style="text-align: center">@lang('custom-menu.nav-menu.return_policy')</h3>
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
                                                            {{-- <h5>
                                                                @lang('custom-menu.nav-menu.technical-support')‬‬
                                                                ‬
                                                            </h5> --}}
                                                            <p>
                                                                <ol type="1">
                                                                    <li>
                                                                         يحق للمتدرب استرجاع المبلغ المدفوع قبل بدء الدورة ب 3 أيام عمل
                                                                    </li>
                                                                    <li>
                                                                        يحق للمتدرب استبدال مبلغ الدورة المدفوعه بدورة أخرى قبل بدء الدورة التي تم دفع قيمتها ب 24 ساعة
                                                                    </li>
                                                                    <li>
                                                                        لايحق للمتدرب المطالبة بالمبلغ المدفوع بعد عقد الدورة في يومها المحدد
                                                                    </li>
                                                                    <li>
                                                                        لا يحق للمتدرب  المطالبة بالمبلغ بعد تسجيل الحضور في الدورة
                                                                    </li>
                                                                    <li>
                                                                        في حال تم الغاء الدورة لأي سبب , فإنه يتم ارجاع المبلغ للمتدربين أو تعويضهم بدورة أخرى وهذا يعتبر خيار للمتدرب وليس إلزامي
                                                                    </li>
                                                                </ol>
                                                            </p>
                                                           
                                                          
                                                        
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
    