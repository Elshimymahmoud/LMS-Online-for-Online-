
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
<link rel="stylesheet" href="{{ asset('iv') }}/css/facilitator.css" />
<link rel="stylesheet" href="{{ asset('iv') }}/css/facilitator.scss" />

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
                    
                    <div class="col-sm-12 col-md-12 plan  wow fadeInUp ptb-50  mt-0">
                        <div class="plan1">
                           
                                                        <!--  Slide  -->

                                    <section class="slide" style="height:200px;background-size:cover; background-image: url({{ asset('ivory') }}/assets/img/slider/10.jpg);">
                                        <div class="slide-overlay" style="padding: 10px">
                                            <div class="slide-content">
                                                <h1 style="margin-top: 7%;
                                                text-align: center;color:white">@lang('labels.frontend.facilitator.title')</h1>
                                            </div>
                                        </div>
                                    </section>

                                    <!--  Slide  -->


                                    <!--  About  -->

                                    <section style="padding: 20px" class="about pt-35 pb-35">
                                        <div class="about-overlay">
                                            <div class="container-about">
                                                <div class="about-content">
                                                    <div class="row">
                                                        
                                                        <div class="col-md-6">
                                                            <div class="disc-about mb-35">
                                                                <div class="grid-6 last" style="text-align: justify;">
                                                                    <div class="grid-6 last">@lang('labels.frontend.facilitator.paragraph')</div>
                                                                   
                                                                    </div>
                                                            </div>
                                                        </div>
                                                        <div class="col-md-6">
                                                            <div class="img-about text-center mb-35">
                                                                <img style="width: 50%" src="{{ asset('ivory') }}/assets/img/about/1.png" alt="About" class="img-fluid">
                                                            </div>
                                                        </div>
                                                    </div>
                                                    <div class="join">
                                                        <div class="head-join">
                                                            <h4>
                                                                <div class="span-icon">
                                                                    <i class="fa fa-plus"></i>
                                                                </div>
                                                                <span>@lang('labels.frontend.facilitator.join_us')</span>
                                                            </h4>
                                                        </div>
                                                        <div class="body-join">
                                                            <div class="body-content">
                                                                <form action="#">
                                                                    <div class="row">
                                                                        <div class="col-md-4">
                                                                            <div class="form-group">
                                                                                <label for="name">@lang('labels.frontend.facilitator.name') <span style="color: red;">*</span></label>
                                                                                <input type="text" name="join" id="name" class="form-control">
                                                                            </div>
                                                                        </div>
                                                                        <div class="col-md-4">
                                                                            <div class="form-group">
                                                                                <label for="email">@lang('labels.frontend.facilitator.mail') <span style="color: red;">*</span></label>
                                                                                <input type="email" name="join" id="email" class="form-control">
                                                                            </div>
                                                                        </div>
                                                                        <div class="col-md-4">
                                                                            <div class="form-group">
                                                                                <label for="phone">@lang('labels.frontend.facilitator.phone') <span style="color: red;">*</span></label>
                                                                                <input id="phone" name="phone" type="tel" class="form-control">
                                                                            </div>
                                                                        </div>
                                                                        <div class="col-md-12">
                                                                            <div class="form-group">
                                                                                <div class="heading-group">
                                                                                    <label>
                                                                                       
                                                                                        @lang('labels.frontend.facilitator.training-categories')
                                                                                         <span style="color: red;">*</span>
                                                                                    </label>
                                                                                </div>
                                                                                <ul class="list-unstyled checkboxs">
                                                                                    @foreach ($categories as $key=>$item)
                                                                                    <li>
                                                                                        <input type="checkbox" name="categ[]" id="{{$key}}" value="{{$item->id}}" class="mr-10">
                                                                                        <label for="1">{{Lang::locale()=='ar'?$item->name_ar:$item->name}}</label>
                                                                                    </li>
                                                                                    @endforeach
                                                                                    
                                                                                </ul>
                                                                                {{-- <span class="field" style="color: #990000;font-size: 12px;">
                                                                                    This field is required.
                                                                                </span> --}}
                                                                            </div>
                                                                        </div>
                                                                        <div class="col-md-12">
                                                                            <div class="form-group">
                                                                                <label for="cv">@lang('labels.frontend.facilitator.cv') <span style="color: red;">*</span></label>
                                                                                <div style="visibility:hidden; opacity:0" id="dropzone">
                                                                                    <div id="textnode"></div>
                                                                                </div>
                                                                                <div class="drag">
                                                                                    <div id='text' class="">
                                                                                        <input type="file" style="    height: 100%;
                                                                                        position: absolute;opacity: 0;cursor: pointer;" name="cv" id="">
                                                                                        <svg viewBox="0 0 1024 1024" focusable="false" class="" data-icon="inbox" width="50px" height="50px" fill="#B1B1B1" aria-hidden="true"><path d="M885.2 446.3l-.2-.8-112.2-285.1c-5-16.1-19.9-27.2-36.8-27.2H281.2c-17 0-32.1 11.3-36.9 27.6L139.4 443l-.3.7-.2.8c-1.3 4.9-1.7 9.9-1 14.8-.1 1.6-.2 3.2-.2 4.8V830a60.9 60.9 0 0 0 60.8 60.8h627.2c33.5 0 60.8-27.3 60.9-60.8V464.1c0-1.3 0-2.6-.1-3.7.4-4.9 0-9.6-1.3-14.1zm-295.8-43l-.3 15.7c-.8 44.9-31.8 75.1-77.1 75.1-22.1 0-41.1-7.1-54.8-20.6S436 441.2 435.6 419l-.3-15.7H229.5L309 210h399.2l81.7 193.3H589.4zm-375 76.8h157.3c24.3 57.1 76 90.8 140.4 90.8 33.7 0 65-9.4 90.3-27.2 22.2-15.6 39.5-37.4 50.7-63.6h156.5V814H214.4V480.1z"></path></svg>
                                                                                        <p>@lang('labels.frontend.facilitator.drag-msg')</p>
                                                                                    </div>
                                                                                </div>
                                                                                {{-- <span id="field">This field is required.</span> --}}
                                                                            </div>
                                                                        </div>
                                                                        <div class="col-md-12">
                                                                            <div class="form-group">
                                                                                <button type="submit">@lang('labels.frontend.facilitator.submit')</button>
                                                                            </div>
                                                                        </div>
                                                                    </div>
                                                                </form>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </section>

                                    <!--  About  -->


                                    <div class="line">
                                        <img style="width: 100%" src="{{ asset('ivory') }}/assets/img/slider/7.jpg" alt="Untitled" class="img-fluid">
                                    </div>

                        
                                    {{-- ===expert --}}
                                    <section class="experts pb-85 pt-85 col-md-12">
                                        <div class="experts-overlay">
                                            <div class="container-about">
                                                <div class="experts-content">
                                                    <div class="row">
                                                        <div class="col-lg-3 col-md-6">
                                                            <div class="expert">
                                                                <a href="#">
                                                                    <div class="img-expert">
                                                                        <img src="{{ asset('ivory') }}/assets/img/team/1.png" alt="Expert" class="img-fluid">
                                                                    </div>
                                                                    <div class="name-expert">
                                                                        <h3>د. عبد العزيز طاحون</h3>
                                                                    </div>
                                                                </a>
                                                            </div>
                                                        </div>
                                                        <div class="col-lg-3 col-md-6">
                                                            <div class="expert">
                                                                <a href="#">
                                                                    <div class="img-expert">
                                                                        <img src="{{ asset('ivory') }}/assets/img/team/5.jpg" alt="Expert" class="img-fluid">
                                                                    </div>
                                                                    <div class="name-expert">
                                                                        <h3>Ahmad Ghazi</h3>
                                                                    </div>
                                                                </a>
                                                            </div>
                                                        </div>
                                                        <div class="col-lg-3 col-md-6">
                                                            <div class="expert">
                                                                <a href="#">
                                                                    <div class="img-expert">
                                                                        <img src="{{ asset('ivory') }}/assets/img/team/2.png" alt="Expert" class="img-fluid">
                                                                    </div>
                                                                    <div class="name-expert">
                                                                        <h3>أ. أحمد أبو المكارم</h3>
                                                                    </div>
                                                                </a>
                                                            </div>
                                                        </div>
                                                        <div class="col-lg-3 col-md-6">
                                                            <div class="expert">
                                                                <a href="#">
                                                                    <div class="img-expert">
                                                                        <img src="{{ asset('ivory') }}/assets/img/team/4.jpg" alt="Expert" class="img-fluid">
                                                                    </div>
                                                                    <div class="name-expert">
                                                                        <h3>أ. علاء السيد</h3>
                                                                    </div>
                                                                </a>
                                                            </div>
                                                        </div>
                                                   
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </section>
                            
                                    {{-- expert --}}
                        </div>
                     
                     
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
        <script>
            $( document ).ready(function() {
                var countAbout = 0;
    $('.about .join .head-join').click(function(){
        if( countAbout % 2 === 0){
            $(this).find('.span-icon').find('i').removeClass('fa-plus').addClass('fa-minus')
            $(this).siblings().addClass('active')
            countAbout++
        }
        else{
            $(this).find('.span-icon').find('i').removeClass('fa-minus').addClass('fa-plus')
            $(this).siblings().removeClass('active')
            countAbout++
        }
    })
            })
     

        </script>
    @endpush
    