
@extends('frontend.layouts.app'.config('theme_layout'))

@section('title', ((app()->getLocale() == 'ar') ? $page->title : $page->title_en).' | '.app_name())
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


                    <div class="col-sm-12 col-md-12 plan  wow fadeInUp ptb-50  mt-0">
                        <div class="plan1">

                        <section class="welcome">

                                        <div class="head-welcome">
                                            <h2></h2>
                                        </div>
                                        {{-- start first --}}
                                        <div class="first">
                                            <div class="middle-welcome">
                                                <h3 class="color-primary fnt-wght-900">
                                                   {{ (app()->getLocale() == 'ar') ? $page->title : $page->title_en}}
                                                </h3>
                                                <br>
                                            </div>

                                            <div class="middle-welcome">
                                                {!! (app()->getLocale() == 'ar') ? $page->content : $page->content_en!!}
                                            </div>
                                        </div>
                                        {{-- end first --}}
                                        <br>

                                        @if($page->file != null)
                                            <div class="course-details-content" style="width: fit-content">
                                                <p class="form-group">
                                                        <a href="{{asset('storage/pages/'.$page->file)}}"
                                                           class="font-weight-bold">
                                                            <i class="fa fa-download"></i>
                                                            {{ (app()->getLocale() == 'ar') ? $page->title : $page->title_en}}

                                                        </a>
                                                </p>
                                            </div>
                                        @endif


                        </section>

                        </div>

                        <!-- <div class="comment">

                        </div> -->
                    </div>

                </div>
            </div>
        </div>


    </div>
    </div>
</section>

    @endsection

    @push('after-scripts')

    @endpush
