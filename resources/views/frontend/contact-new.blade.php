

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
    <link rel="stylesheet" href="{{asset('iv')}}/css/contact.css">
@endpush

@section('content')








<section id="contact-area" class="contact-area-section backgroud-style">
    <div class="container">
        <div class="contact-area-content">
            <div class="row">
                @if(config('contact_data') != "")
                    @php
                        $contact_data = contact_data(config('contact_data'));
                    @endphp

                    @if($contact_data["location_on_map"]["status"] == 1)
                        <div class="col-md-6">
                            <h2 class="color-primary title">@lang('labels.frontend.layouts.partials.location')</h2>

                            <div id="contact-map" class="contact-map-section">
                                {!! $contact_data["location_on_map"]["value"] !!}
                            </div>
                        </div>
                    @endif

                    <div class="col-md-6">
                        <div class="contact-content ">
                            <div class="row">
                                <div class="color-primary border-bottom">
                                    <h2 class="title text-color" style="margin-bottom: 20px;">@lang('labels.frontend.layouts.partials.contact_info')</h2>
                                </div>
                                
                                <!-- <div class="color-primary border-bottom">
                                    <p>
                                        {{ $contact_data["short_text"]["value"] }}
                                    </p>
                                </div> -->
                                    
                            </div>

                            <div class="row">
                                @if(($contact_data["primary_address"]["status"] == 1) || ($contact_data["secondary_address"]["status"] == 1))
                                    <div class="col-md-12 border-bottom " style="margin-top: 0">
                                        <div class="contact-address-details">

                                            <div class="address-icon">
                                                <i class="fa fa-map-marker "></i>
                                            </div>
                                            <div class="address-details">
                                                
                                                <ul>
                                                    <li><h5 style="margin-bottom: 0;color:#555555">@lang('labels.frontend.layouts.partials.location'):</h5></li>
                                                    @if($contact_data["primary_address"]["status"] == 1)
                                                        <li>
                                                            <span></span>{{$contact_data["primary_address"]["value"]}}
                                                        </li>
                                                    @endif

                                                    @if($contact_data["secondary_address"]["status"] == 1)
                                                        <li>
                                                            <span>@lang('labels.frontend.layouts.partials.second'): </span>{{$contact_data["secondary_address"]["value"]}}
                                                        </li>
                                                    @endif
                                                </ul>
                                            </div>
                                        </div>
                                    </div>
                                @endif

                                <div class="row border-bottom">
                                @if(($contact_data["primary_phone"]["status"] == 1) || ($contact_data["secondary_phone"]["status"] == 1))
                                <div class="col-md-6">
                                    <div class="contact-address-details">
                                        <div class="address-icon">
                                            <i class="fa fa-mobile"></i>
                                        </div>
                                        <div class="address-details ul-li-block">
                                            <ul>
                                                @if($contact_data["primary_phone"]["status"] == 1)
                                                    <li><h5 style="margin-bottom: 0;color:#555555">@lang('labels.frontend.layouts.partials.mobile'):</h5></li>
                                                    <li>
                                                        {{$contact_data["primary_phone"]["value"]}}
                                                    </li>
                                                @endif
                                            </ul>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="contact-address-details">
                                        <div class="address-icon">
                                            <i class="fa fa-phone"></i>
                                        </div>
                                        <div class="address-details ul-li-block">
                                            <ul>
                                                @if($contact_data["secondary_phone"]["status"] == 1)
                                                    <li><h5 style="margin-bottom: 0;color:#555555">@lang('labels.frontend.layouts.partials.phone') :</h5></li>
                                                    <li>
                                                        {{$contact_data["secondary_phone"]["value"]}}
                                                    </li>
                                                @endif
                                            </ul>
                                        </div>
                                    </div>
                                </div>
                                @endif
                                </div>


                                @if(($contact_data["primary_email"]["status"] == 1) || ($contact_data["secondary_email"]["status"] == 1))
                                <div class="col-md-6">
                                    <div class="contact-address-details">
                                        <div class="address-icon">
                                            <i class="fa fa-map-marker"></i>
                                        </div>
                                        <div class="address-details ul-li-block">
                                            <ul>
                                                @if($contact_data["primary_email"]["status"] == 1)
                                                    <li><h5 style="margin-bottom: 0;color:#555555">@lang('labels.frontend.layouts.partials.country'):</h5></li>
                                                    <li>
                                                        @lang('labels.frontend.layouts.partials.saudi')
                                                    </li>
                                                @endif

                                                
                                            </ul>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="contact-address-details">
                                        <div class="address-icon">
                                            <i class="fa fa-envelope"></i>
                                        </div>
                                        <div class="address-details ul-li-block">
                                            <ul>
                                                @if($contact_data["primary_email"]["status"] == 1)
                                                    <li><h5 style="margin-bottom: 0;color:#555555">@lang('labels.frontend.layouts.partials.email') :</h5></li>
                                                    <li>
                                                        {{$contact_data["primary_email"]["value"]}}
                                                    </li>
                                                @endif

                                              
                                            </ul>
                                        </div>
                                    </div>
                                </div>
                                @endif


                            </div>
                        </div>
                    </div>

                @else
                    <h4>@lang('labels.general.no_data_available')</h4>
                @endif
            </div>
            
        </div>
    </div>

    <div class="wpb_column vc_column_container vc_col-sm-12"><div class="vc_column-inner vc_custom_1589684120491"><div class="wpb_wrapper">
        <div class="wpb_single_image wpb_content_element   vc_custom_1589684020709">
            
            <figure class="wpb_wrapper vc_figure">
                <div class="vc_single_image-wrapper   vc_box_border_grey">
                    <img width="100%" height="19" src="{{asset('ivory')}}/assets/img/line.jpg" ></div>
            </figure>
        </div>
    </div></div></div>

</section>

    <!-- Start of contact area form
        ============================================= -->
        <section id="contact-form" class="contact-form-area_3 contact-page-version">

        
            <div class="container">
                <div class="section-title mb45 headline">
                    <h2 class="title text-color">@lang('labels.frontend.contact.send_us_a_message')</h2>
                </div>
    
                <div class="contact_third_form">
                    <form class="contact_form" action="{{route('contact.send')}}" method="POST" enctype="multipart/form-data">
                        @csrf
                        <div class="row" style="margin-bottom: 20px">
                            <div class="col-md-4">
                                    <input class="form-control" name="name" type="text" placeholder="@lang('labels.frontend.contact.your_name')">
                                    @if($errors->has('name'))
                                        <span class="help-block text-danger">{{$errors->first('name')}}</span>
                                    @endif
                            </div>
                            <div class="col-md-4">
                                    <input class="form-control" name="email" type="email" placeholder="@lang('labels.frontend.contact.your_email')">
                                    @if($errors->has('email'))
                                        <span class="help-block text-danger">{{$errors->first('email')}}</span>
                                    @endif
                            </div>
                            <div class="col-md-4">
                                    <input class="form-control" name="phone" type="tel" placeholder="@lang('labels.frontend.contact.phone_number')">
                                    @if($errors->has('phone'))
                                        <span class="help-block text-danger">{{$errors->first('phone')}}</span>
                                    @endif
                            </div>
                        </div>
                        <textarea class="form-control" style="height: 150px" name="message" placeholder="@lang('labels.frontend.contact.message')"></textarea>
                        @if($errors->has('message'))
                            <span class="help-block text-danger">{{$errors->first('message')}}</span>
                        @endif
                        <div style="margin: 20px" class="nws-button text-center text-uppercase mt-3">
                            <button class="more submit" type="submit" value="Submit">@lang('labels.frontend.contact.send_email') </button>
                        </div>
                    </form>
                </div>
            </div>
        </section>
        <!-- End of contact area form
            ============================================= -->





@endsection
