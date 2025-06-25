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
                            <h2 class="title text-color">@lang('labels.frontend.layouts.partials.location')</h2>

                            <div id="contact-map" class="contact-map-section">
                                {!! $contact_data["location_on_map"]["value"] !!}
                            </div>
                        </div>
                    @endif

                    <div class="col-md-6">
                        <div class="contact-content ">
                            <div class="row">
                                <div class="border-bottom">
                                    <h2 class="title text-color" style="margin-bottom: 20px;">@lang('labels.frontend.layouts.partials.contact_info')</h2>
                                </div>
                                
                                <!-- <div class="border-bottom">
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
                                                <i class="fas fa-map-marker-alt "></i>
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
                                            <i class="fas fa-mobile"></i>
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
                                            <i class="fas fa-phone"></i>
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
                                            <i class="fas fa-globe-asia"></i>
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
                                            <i class="fas fa-envelope"></i>
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
