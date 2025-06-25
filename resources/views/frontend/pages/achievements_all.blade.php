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

        .block {
            border: 1px solid black;
        }

        .icon {
            border: 2px #4f198d solid;
            padding: 10px;
            border-radius: 50%;
            margin-top: -18px;
            position: absolute;
            margin-right: -16px;/*! z-index: 222222; */
            background-color: white;/*! width: 13%; */
        }

    </style>
@endpush

@section('content')



<section class="slide" style="height: 200px;
        background-size: cover;
        color: white;background-image: url({{asset('ivory/assets/img/slider/about3.jpg')}});">
            <div class="slide-overlay" style="    position: absolute;
            margin-top: 5%;
            margin-right: 33%;">
                <div class="slide-content">
                    <h1 class="about-title" style="margin-right:43%;padding: 26px;">الانجازات</h1>
                </div>
            </div>
        </section>


    <section class="row the-product course-related" id="product">
        <div class="container">
          
            <div class="tab-content">

                <div role="tabpanel" class="tab-pane active" id="tab-1">
                    <div class="row collections" style="justify-content: center;
                    display: flex;">
                        @foreach ($achievements as $achievement)
                             <!--==========Collection Items==========-->
                        <div class="  {{count($achievements)<2? 'col-lg-10':'col-md-4'}} item  fadeIn">
                            <div class="product-div">
                                <div class="row m0 featured-img">
                                   
                                    <i class="fa fa-calendar icon"  aria-hidden="true" ></i>
                                </div>
                                <div style="padding: 10px 25px;text-align: right;">
                                    <h5 class="category" style="text-align: center">{{Lang::locale()=='ar'?$achievement->title_ar:$achievement->title}}</h5>
                                    <h4 class="title text-color" style="text-align: center">{{$achievement->year}}</h4>
                                    <p class="prod-det" style="text-align: center;
                                    justify-content: center;line-height: initial;">
                           {{Lang::locale()=='ar'?sub($achievement->introduction_ar,0,120):sub($achievement->introduction,0,120)}}
                                    </p>
                                    <a href="{{route('achievements',$achievement->id)}}" class=" btn btn-view mtb-10" style="width: 100%;">المزيد</a>
                                  
                                </div>
                            </div>
                        </div>

                        <!--==========Collection Items==========-->
                        @endforeach
                       
                    </div>
                </div>
            </div>
        </div>
    </section>

@endsection

@push('after-scripts')
@endpush
