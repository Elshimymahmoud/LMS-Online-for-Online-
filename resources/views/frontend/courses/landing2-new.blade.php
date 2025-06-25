@extends('frontend.layouts.app1new')

@section('title', trans('labels.frontend.home.title') . ' | ' . app_name())
@section('meta_description', '')
@section('meta_keywords', '')


@push('after-styles')
    <style>
        .the-product {
            background-color: ##3bcfcb;
        }

        .fs {
            font: 500 28px/26px "Noto Kufi Arabic", sans-serif;
            color: white;
            top: 20%
        }

        .head-content-1 {
            margin-top: 20%;
            text-align: center;
        }

        .the-product {
            padding: 0px;
        }

        .head-content-1 button {
            margin-top: 20px;
            color: ##3bcfcb;
            font-family: cairo;
            font-size: 30px;
        }
        .section2 .container{
            margin-bottom: 20px;
        }
        .section2 .head {
            color: #5e0a30;
            text-align: center;
            font-size: 30px;
            margin-bottom: 55px;
        }

        .course-content-less {
            min-height: 550px;
            max-height: 550px;
            border-radius: 10px;
            padding: 0px;
            background-image: linear-gradient(#630921, #4e0b59);
        }

        .less-icon {

            background-color: rgb(190, 187, 187);
            min-height: 150px;
            border-top-right-radius: 10px;
            border-top-left-radius: 10px;
            display: flex;
    justify-content: center;
}

.less-icon img{
    object-fit: contain;
}
        

        .card-body h3 {
            color: white;
            text-align: center;
            font-size: 19px;
        }

        .card-body p {

            text-align: justify;
            padding: 20px;
            color: white;
            font-size: 12px;

        }
        .section-3{
            background-image: url({{asset('images/Background6.png')}});
            background-size: cover;
            background-repeat: no-repeat;
            height:400px;

        }
        .section-3 .join{
            background-color: #630921;
            color: white;
        }
        .head-content-2  {
            float: left;
    margin-top: 17%;
    text-align: center;
        }
        .head-content-2 button {
            margin-top: 15px;
            color: ##3bcfcb;
            font-family: cairo;
            font-size: 30px;
        }
        .head-content-2 p {
            color: ##3bcfcb
        }
    </style>
@endpush

@section('content')
    <section class="row the-product padding-b-13" id="features">
        <div class="container">
            <div class="col-xs-6 head-content-1">
                <p class="fs">إحصــل الآن علي الـــدورة</p>
                <p class="fs">لتنمية مهاراتك وقدراتك</p>
                <button> انضم الان</button>

            </div>
            <div class="col-xs-6">
                <img src="{{ asset('images/landing/Background.png') }}" alt="">
            </div>


        </div>
        <div>


        </div>
    </section>
    <section class="row section2 padding-b-13">
        <div class="container">
            <div class="head">
                <h2 class="">ما الذي ستتعلّمه في هذه الدورة</h2>
            </div>
            <div class="col-md-3 col-xs-6 course-content-less">
                <div class="card" style="width: 100%;">
                    <div class="less-icon">
                        <img src="{{asset('icons/Background1.png')}}" alt="">
                    </div>
                    <div class="card-body">
                        <h3>تحديد رسالتك ومعرفة
                            عميلك المثالي</h3>
                        <p class="card-text">قد تكون حاليًا مدربًا أو استشاري قد تكون حاليًا مدربًا أو استشاريًا تقدم
                            خدماتك أو تبيع دوراتك عبر الإنترنت، لكنك غير قادر على جذب عدد كافٍ من العملاء الذين تريدهم و
                            تعتقد أن هذا هو خطأ الخوارزمية أو أن هناك منافسة شديدة ولكن المشكلة الرئيسية هي رسالتك. اكتشف
                            كيف يمكنك تحديد تحديد رسالتك ومعرفة عميلك المثال استراتيجية جذب الجمهور المستهدف كيف تتوقع
                            نجاحدورتك التدريبية كيف تتوقع نجاحدورتك التدريبية.</p>

                    </div>
                </div>
            </div>
            <div class="col-md-3 col-xs-6 course-content-less">
                <div class="card" style="width: 100%;">
                    <div class="less-icon">
                        <img src="{{asset('icons/Background2.png')}}" alt="">
                    </div>
                    <div class="card-body">
                        <h3>تحديد رسالتك ومعرفة
                            عميلك المثالي</h3>
                        <p class="card-text">قد تكون حاليًا مدربًا أو استشاري قد تكون حاليًا مدربًا أو استشاريًا تقدم
                            خدماتك أو تبيع دوراتك عبر الإنترنت، لكنك غير قادر على جذب عدد كافٍ من العملاء الذين تريدهم و
                            تعتقد أن هذا هو خطأ الخوارزمية أو أن هناك منافسة شديدة ولكن المشكلة الرئيسية هي رسالتك. اكتشف
                            كيف يمكنك تحديد تحديد رسالتك ومعرفة عميلك المثال استراتيجية جذب الجمهور المستهدف كيف تتوقع
                            نجاحدورتك التدريبية كيف تتوقع نجاحدورتك التدريبية.</p>

                    </div>
                </div>
            </div> <div class="col-md-3 col-xs-6 course-content-less">
                <div class="card" style="width: 100%;">
                    <div class="less-icon">
                        <img src="{{asset('icons/Background3.png')}}" alt="">
                    </div>
                    <div class="card-body">
                        <h3>تحديد رسالتك ومعرفة
                            عميلك المثالي</h3>
                        <p class="card-text">قد تكون حاليًا مدربًا أو استشاري قد تكون حاليًا مدربًا أو استشاريًا تقدم
                            خدماتك أو تبيع دوراتك عبر الإنترنت، لكنك غير قادر على جذب عدد كافٍ من العملاء الذين تريدهم و
                            تعتقد أن هذا هو خطأ الخوارزمية أو أن هناك منافسة شديدة ولكن المشكلة الرئيسية هي رسالتك. اكتشف
                            كيف يمكنك تحديد تحديد رسالتك ومعرفة عميلك المثال استراتيجية جذب الجمهور المستهدف كيف تتوقع
                            نجاحدورتك التدريبية كيف تتوقع نجاحدورتك التدريبية.</p>

                    </div>
                </div>
            </div> <div class="col-md-3 col-xs-6 course-content-less">
                <div class="card" style="width: 100%;">
                    <div class="less-icon">
                        <img src="{{asset('icons/Background4.png')}}" alt="">
                    </div>
                    <div class="card-body">
                        <h3>تحديد رسالتك ومعرفة
                            عميلك المثالي</h3>
                        <p class="card-text">قد تكون حاليًا مدربًا أو استشاري قد تكون حاليًا مدربًا أو استشاريًا تقدم
                            خدماتك أو تبيع دوراتك عبر الإنترنت، لكنك غير قادر على جذب عدد كافٍ من العملاء الذين تريدهم و
                            تعتقد أن هذا هو خطأ الخوارزمية أو أن هناك منافسة شديدة ولكن المشكلة الرئيسية هي رسالتك. اكتشف
                            كيف يمكنك تحديد تحديد رسالتك ومعرفة عميلك المثال استراتيجية جذب الجمهور المستهدف كيف تتوقع
                            نجاحدورتك التدريبية كيف تتوقع نجاحدورتك التدريبية.</p>

                    </div>
                </div>
            </div>
        </div>
    </section>

    {{-- /// --}}
    <section class="row section-3 the-product padding-b-13" id="features">
        <div class="container">
            <div class="col-xs-6 head-content-2" style="float: left">
                <button class="join"> انضم الان</button>

                <p class="fs">تنمية مهارات فريقك</p>

            </div>
            


        </div>
        <div>


        </div>
    </section>


    {{-- customer clients --}}
        <!--==========Reviews==========-->
        <section class="row partners" id="partners">
            <div class="container">
                <div class="row section-header wow fadeInUp">
                    <button style="background-color: white;border: 4px solid #4f198d;border-radius: 13px;padding: 8px 24px;">
                      <h2 class="main-color">@lang('labels.frontend.layouts.home.clients')</h2>
    
                         </button>
                </div>
                <div class="row">
                    <div class="large-12 columns">
                        <div class="home-partners owl-theme">
    
                            @foreach ($clients as $client)
                                <div class="item">
                                    <div class="partner-box">
                                        <a href="#">
                                            <img src="{{ $client->image }}" class="img-fluid" alt="   " />
                                        </a>
                                    </div>
                                </div>
                            @endforeach
    
    
                        </div>
    
                        <script>
                            $(document).ready(function() {
                                var owl = $(".home-partners");
                                owl.owlCarousel({
                                    margin: 10,
                                    nav: false,
                                    loop: true,
                                    dots: true,
                                    responsive: {
                                        0: {
                                            items: 1
                                        },
                                        600: {
                                            items: 3
                                        },
                                        1000: {
                                            items: 5
                                        }
                                    }
                                });
                            });
                        </script>
                    </div>
                </div>
            </div>
        </section>
    
        <!--==========Reviews==========-->
        <section class="row clients" id="clients">
            <div class="container">
                <div class="row section-header wow fadeInUp">
                    <button style="background-color: white;border: 4px solid #4f198d;border-radius: 13px;padding: 8px 24px;">
                    <h2 class="main-color">@lang('labels.frontend.layouts.home.partners')</h2>
    
                         </button>
                </div>
                <div class="row">
                    <div class="large-12 columns">
                        <div class="home-clients owl-theme">
                            @foreach ($sponsors as $sponsor)
                                <div class="item">
                                    <div class="client-box">
                                        <a href="#">
    
                                            <img style="height: 200px;object-fit: contain" src="{{ $sponsor->image }}"
                                                class="img-fluid" alt="   " />
                                        </a>
                                    </div>
                                </div>
                            @endforeach
                        </div>
    
                        <script>
                            $(document).ready(function() {
                                var owl = $(".home-clients");
                                owl.owlCarousel({
                                    margin: 10,
                                    nav: false,
                                    loop: true,
                                    dots: true,
                                    responsive: {
                                        0: {
                                            items: 1
                                        },
                                        600: {
                                            items: 3
                                        },
                                        1000: {
                                            items: 5
                                        }
                                    }
                                });
                            });
                        </script>
                    </div>
                </div>
            </div>
        </section>
@endsection
@push('after-scripts')
@endpush
