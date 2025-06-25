@extends('frontend.layouts.app'.config('theme_layout'))

@section('title', trans('labels.frontend.home.title') . ' | ' . app_name())
@section('meta_description', '')
@section('meta_keywords', '')


@push('after-styles')
    <link rel="stylesheet" href="{{ asset('iv') }}/css/plan.css" />
    <style>
        .plan-link{
            margin-bottom: 10px;
            border-radius: 15px !important;
        }
        .plan-link.active{
           background-color: #811934;
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
                            @include('frontend.pages.partials.plan_sidebar')

                        </div>
                        <div class="col-sm-12 col-md-8 plan  wow fadeInUp ptb-50  mt-0">
                            <div class="plan1">
                                <p class="color-primary text-color"> @lang('custom-menu.nav-menu.plan2021')‬‬</p>
                                <img src="{{ asset('images/plan/plan2021-1.jpg') }}" alt="">
                                <p class="plan-text">
                                    @lang('buttons.plan.intro')
                                </p>
                                <a class=" color-primary link" target="_blank"
                                    href="{{ asset('storage/helpsPdf/Tr_Plan_2021.pdf') }}" title="">
                                    @lang('buttons.plan.2021-1')
                                </a>
                            </div>
                            <div class="plan2">

                            <!-- <img  class="img-header" src="http://ivorytraining.com/mail_temp_ar/tr_plan/2018_200.PNG" alt="" width="1000" height="50"> -->
                                
                                <img src="{{ asset('images/plan/plan2021-2.jpg') }}" alt="">

                                <a class=" color-primary link" target="_blank"
                                    href="{{ asset('storage/helpsPdf/Tr_Plan_2021_D.pdf') }}" title="">
                                    @lang('buttons.plan.2021-2')


                                </a>
                            </div>
                            <div class="plan3">

                            <!-- <img  class="img-header" src="http://ivorytraining.com/mail_temp_ar/tr_plan/2018_200.PNG" alt="" width="1000" height="50"> -->
                                
                                <img src="{{ asset('images/plan/plan2021-3.jpg') }}" alt="">

                                <a class=" color-primary link" target="_blank"
                                href="{{ asset('storage/helpsPdf/Tr_Plan_2021_DE.pdf') }}" title="">
                                @lang('buttons.plan.2021-3')


                            </a>
                           
                            </div>
                            <div class="plan4">
                            <!-- <img  class="img-header" src="http://ivorytraining.com/mail_temp_ar/tr_plan/2018_200.PNG" alt="" width="1000" height="50"> -->

                                <img src="{{ asset('images/plan/plan2021-4.jpg') }}" alt="">

                               
                                <a class=" color-primary link" target="_blank"
                                href="{{ asset('storage/helpsPdf/Tr_Plan_2021_DO.pdf') }}" title="">
                                @lang('buttons.plan.2021-4')

                            </a>
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
