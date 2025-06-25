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

        .mx-wdt-100 {
            max-width: 100%;
        }

        .plan {
            color: white;
            background-color: ##3bcfcb;
            padding: 10px;
            font-size: 14px;
        }
        
        .plan:hover {
            color: #f7dfda;
        }
        .btn-link{
            color: ##3bcfcb;
        }
        .btn-link:hover {
            color: black;


        }
        .plan:before {
            background: #e2e2e2;
            color: ##3bcfcb;
            z-index: 2;
            border-radius: 10px 0 0 10px;
            position: absolute;
            height: 100%;
            left: -51px;
            top: 0;
            line-height: 3;
            font-size: 116%;
            width: 60px;
            content: "\f1c1";
            font-family: "Font Awesome 5 Free";
            speak: none;
            font-style: normal;
            font-weight: normal;
            font-variant: normal;
            text-transform: none;
            -webkit-font-smoothing: antialiased;
        }

        .planlnk {
            position: absolute;
            margin-left: 55px;
        }

    </style>
@endpush

@section('content')



    <!--  Slide  -->

    <section class="slide" style="background-image: url({{ asset('ivory') }}/assets/img/slider/4.jpg);">
        <div class="slide-overlay">
            <div class="slide-content">
                <h3>@lang('custom-menu.nav-menu.plan2021')</h3>
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

                            <div class="row">
                                <div class="col-md-6">
                                    <img class="mx-wdt-100" src="{{ asset('images/plan/plan2021-1.jpg') }}" alt="">
                                </div>
                                <div class="col-md-6">
                                    <h5>
                                        @lang('custom-menu.nav-menu.plan2021')‬‬

                                    </h5>
                                    <p>
                                        @lang('buttons.plan.intro')
                                       
                                    </p>
                                    <div class="planlnk">
                                        <a class=" plan btn btn-default md" target="_blank"
                                            href="{{ asset('storage/helpsPdf/Tr_Plan_2021.pdf') }}" title="">
                                            @lang('buttons.plan.2021-1')
                                        </a>
                                    </div>
                                </div>

                            </div>
                            <hr>
                            <div class="row">
                                <div class="col-md-6">
                                    <img class="mx-wdt-100" src="{{ asset('images/plan/plan2021-2.jpg') }}" alt="">
                                </div>
                                <div class="col-md-6">
                                    {{-- <h5>
                                    @lang('custom-menu.nav-menu.plan2021')‬‬

                                </h5> --}}

                                    <div class="planlnk" style="margin-top: 19%;">
                                        <a class=" plan btn btn-default md" target="_blank"
                                            href="{{ asset('storage/helpsPdf/Tr_Plan_2021_D.pdf') }}" title="">
                                            @lang('buttons.plan.2021-2')


                                        </a>
                                    </div>
                                </div>

                            </div>

                            <hr>
                            <div class="row">
                                <div class="col-md-6">
                                    <img class="mx-wdt-100" src="{{ asset('images/plan/plan2021-3.jpg') }}" alt="">
                                </div>
                                <div class="col-md-6">


                                    <div class="planlnk" style="margin-top: 19%;">
                                        <a class=" plan btn btn-default md" target="_blank"
                                            href="{{ asset('storage/helpsPdf/Tr_Plan_2021_DE.pdf') }}" title="">
                                            @lang('buttons.plan.2021-3')

                                        </a>
                                    </div>
                                </div>

                            </div>
                            <hr>
                            <div class="row">
                                <div class="col-md-6">
                                    <img class="mx-wdt-100" src="{{ asset('images/plan/plan2021-4.jpg') }}" alt="">
                                </div>
                                <div class="col-md-6">


                                    <div class="planlnk" style="margin-top: 19%;">
                                        <a class=" plan btn btn-default md" target="_blank"
                                            href="{{ asset('storage/helpsPdf/Tr_Plan_2021_DO.pdf') }}" title="">
                                            @lang('buttons.plan.2021-4')

                                        </a>
                                    </div>
                                </div>

                            </div>
                            <hr>
                            <div class="row">
                                <div class="col-md-12">

                                   
                                

                                    <div id="accordion">
                                        <div class="card">
                                          <div class="card-header" id="headingOne">
                                            <h5 class="mb-0">
                                              <button class="btn btn-link" data-toggle="collapse" data-target="#collapseOne" aria-expanded="true" aria-controls="collapseOne">
                                                -@lang('buttons.plan.prev-plan')
                                              </button>
                                            </h5>
                                          </div>
                                      
                                          <div id="collapseOne" class="collapse" aria-labelledby="headingOne" data-parent="#accordion">
                                            <div class="card-body" style="height: 100px">
                                             
                                                <p class="planlnk" style="left: 50%;">
                                                    <a class=" plan btn btn-default md" target="_blank"
                                                        href="{{ route('plan2020') }}" title="">
                                                       
                                                        @lang('custom-menu.nav-menu.plan2020')‬‬
            
                                                    </a>
                                                </p>
                                               

                                            </div>
                                          </div>
                                        </div>
                                       
                                       
                                      </div>
                                      

                                </div>
                            </div>
                        </div>

                    </div>
                    {{-- end first --}}



                </div>
            </div>
        </div>
    </section>

    <!--  Welcome  -->












@endsection
