<!-- Start of footer area
    ============================================= -->
@php
$footer_data = json_decode(config('footer_data'));
@endphp
@push('after-styles')

@endpush
@if ($footer_data != '')


    <!--  -->
   
    <!--==========How its Works==========-->
    <section class="row join-us">
        <div class="container">
            <div class="row  wow fadeInUp mb-30">
                <div class=" col-md-6 mt-50">
                    <p>@lang('labels.frontend.home.speak_to_our_specialist')</p>
                    <p>
                        @lang('labels.frontend.home.speak_to_our_specialist_details')
                    </p>
                </div>
                <div class=" col-md-6 mt-50">
                    {{-- <form action="{{ route('subscribe') }}" id="subscribeform" class="row newsletter-form" method="post"> --}}
                    <div class="row newsletter-form">

                        @csrf
                        <div class="input-group">
                            <input id="subscribe_email" type="email" class="form-control newsletter-email" name="email"
                                placeholder="@lang('labels.frontend.home.email')" />
                            <span class="input-group-addon">
                                <button type="submit" id="js-subscribe-btn">@lang('labels.frontend.home.send')</button>
                            </span>
                           
                            
                        </div>
                        {{-- <p style="color: white" id="subscribe_msg"></p> --}}
                        {{--  --}}
                        <br>
                        <div style="display: none" class="alert alert-success fadeInUp" id="subscribe_msg" role="alert">
                            <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                                <span aria-hidden="true">&times;</span>
                            </button>
                            <span id="subscribe_msg-content"></span>
                          
                        </div>
                        {{--  --}}
                    </div>
                    {{-- </form> --}}
                </div>
            </div>
        </div>
    </section>


    <!--==========Footer==========-->
    <footer class="row footer-top">
        <div class="container">
            <div class="row m0 menu-rights">
                <div class=" col-md-3">
                    @if (session('locale') == 'ar')
                        @if(config('footer_image_ar') != "")
                            <img src="{{ asset('storage/logos/'.config('footer_image_ar'))  }}" style="
                                width: 160px;
                                height: auto;" alt="" />
                        @else
                            <img src="{{ asset('iv') }}/images/logo-ar.png" style="
                                width: 160px;
                                height: auto;" alt="" />
                      @endif
                    @else
                        @if(config('footer_image_en') != "")
                            <img src="{{ asset('storage/logos/'.config('footer_image_en'))  }}" style="
                                width: 160px;
                                height: auto;" alt="" />
                        @else
                            <img src="{{ asset('iv') }}/images/logo-en.png" style="
                                width: 160px;
                                height: auto;" alt="" />
                        @endif
                    @endif
                    <img src="{{ asset('iv') }}/images/foot.png" alt="" />
                    <h5 style="color: black; margin-bottom: 0;font-size: 17px;">
                        @if(config('provider.name') != "")
                            {{ config('provider.name') }}
                        @else
                            Broaden Your Success
                        @endif
                    </h5>
                    
                      
                    
                </div>
                <div class=" col-md-3 ">
                    <h4>
                        @lang('labels.backend.general_settings.footer.popular_courses')
                    </h4>
                    {{-- <ul class="nav footer-top-links">
                        @foreach ($popularCoursesFooter as $popularCourseFooter)
                            <li>
                                <a href="{{route('courses.show',['course'=>$popularCourseFooter->slug])}}">
                                    {{ Lang::locale() == 'ar' ? $popularCourseFooter->title_ar : $popularCourseFooter->title }}
                                </a>
                            </li>
                          
                        @endforeach
                    </ul> --}}
                      {{--  --}}
                <div class="footer-widget-content" style="margin-top: 15px;">
                    @foreach ($popularCoursesFooter as $popularCourseFooter)

                    <div class="media" style="display: flex;align-items: center">
                        <div class="media-left">
                           <a href="{{route('courses.show',['course'=>$popularCourseFooter->slug])}}">
                            <img class="media-object" @if($popularCourseFooter->course_image != "" &&  file_exists('storage/uploads/'.$popularCourseFooter->course_image)) src="{{ resize('uploads/'.$popularCourseFooter->course_image,60,40)}}" @else  src="{{asset('images/course-default.jpeg')}}"   @endif width='60' height='40'  style="border-radius:5px" alt="..."></a>
                        </div>
                        <div class="media-body">
                           <p style="line-height: inherit;">
                            <a class="mediaLnkCourseFooter" href="{{route('courses.show',['course'=>$popularCourseFooter->slug])}}">
                                {{ Lang::locale() == 'ar' ? $popularCourseFooter->title_ar : $popularCourseFooter->title }}
                            </a>
                           </p>
                         

                        </div>
                    </div>

                    @endforeach
                   
                </div>

                {{--  --}}
                </div>
              
                <div class=" col-md-3 ">
                    <h4> @lang('labels.backend.general_settings.footer.important_link') </h4>
                    <ul class="footer-top-menu">
                        <li><a href="https://ivorytraining.com"> @lang('navs.general.about') </a></li>
                        <li><a href="/">@lang('navs.general.home') </a></li>
                        <li><a href="https://ivorytraining.com/training-plans"> @lang('navs.general.training-plan') </a></li>
                        <li><a href="/contact"> @lang('navs.general.contact-us') </a></li>
                        <li><a href="{{ url('page/ntham-hmay-albyanat-alshkhsy') }}">
                            @lang('custom-menu.nav-menu.royal_decree')
                        </a></li>

                    </ul>
                    <a href="#" data-toggle="modal" class="btn btn-footer" data-target="#RequestModalCenter">  @lang('labels.backend.general_settings.footer.course_order') </a>
                </div>
                <div class=" col-md-3 ">
                    <h4> @lang('labels.backend.general_settings.footer.stay_connected') </h4>
                    <div> @lang('labels.backend.general_settings.footer.ivory_address') </div>
                    <div style="direction: ltr;padding-top: 10px;"><a href="tel:+96611445518">+966 11 445 518</a></div>
                    <div style="direction: ltr;"><a href="tel:+966533993220">+966 53 399 3220</a></div>
                    <div><a href="mailto:info@ivorytraining.com"></a></div>

                    <div class="row m0 social-links" style="padding-top: 20px">
                        <ul class="nav">
                            <li class="wow fadeInUp"><a href="https://www.facebook.com/ivorytraining" target="_blank"><i class="fab fa-facebook"></i></a></li>
                            <!-- <li class="wow fadeInUp" data-wow-delay="0.1s"><a href="https://twitter.com/ivorytraining" target="_blank"><i class="fab fa-twitter"></i></a></li> -->
                            <li class="wow fadeInUp" style="visibility: visible; animation-name: fadeInUp; width: 12%;">
                                <a href="https://twitter.com/ivorytraining" target="_blank" class="m-2">
                               <img style=" max-width: 75%;border-radius: 50%; opacity: 0.5;" src="{{ asset('iv')
                               }}/images/x.png" alt="twitter">
                                </a>
                            </li>
                            <li class="wow fadeInUp" style="visibility: visible; animation-name: fadeInUp;width: 12%;">
                                <a href="https://www.instagram.com/ivorytraining" target="_blank" class="m-2">
                               <img style="background-color: black; max-width: 75%;border-radius: 50%; opacity: 0.5;"
                                    src="{{ asset('iv') }}/images/insta.png" alt="instgram">
                                </a>
                            </li>
                            <li class="wow fadeInUp" style="visibility: visible; animation-name: fadeInUp;width: 12%;">
                                <a href="https://www.tiktok.com/@ivorytraining?_t=8ZSERQefACw&_r=1" target="_blank" class="m-2">
                               <img style=" background-color: black; max-width: 75%;border-radius: 50%; opacity: 0.5;
                               " src="{{ asset('iv') }}/images/tiktok.png" alt="tiktok">
                                </a>
                            </li>
                            <li class="wow fadeInUp" style="visibility: visible; animation-name: fadeInUp;width: 12%;">
                                <a href="https://www.snapchat.com/add/ivorytraining?share_id=SbBBF3sgS8y7/eHJQREm7A&locale=ar_SA@calendar=gregorian" target="_blank" class="m-2">
                               <img style=" background-color: black;max-width: 75%;border-radius: 50%; opacity: 0.5;"
                                    src="{{ asset('iv') }}/images/snapchat.png" alt="snapchat">
                                </a>
                            </li>
                            <li class="wow fadeInUp" data-wow-delay="0.2s"><a href="https://www.linkedin.com/company/ivorytraining" target="_blank"><i class="fab fa-linkedin"></i></a></li>
                            <li class="wow fadeInUp" data-wow-delay="0.3s"><a href="https://www.linkedin.com/in/ivorytraining/" target="_blank"><i class="fab fa-youtube"></i></a></li>
                            
                        </ul>
                    </div>

                </div>


            </div>
        </div>

        {{-- Modal Request --}}
<div class="modal fade" id="RequestModalCenter" style="z-index: 2000" tabindex="-1" role="dialog" aria-labelledby="RequestModalCenterTitle" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered  modal-lg" role="document">
      <div class="modal-content" style="background-color: #4f198d;text-align: center;">
        <div class="modal-header">
          <!-- <h3 class="modal-title" style="color: #4f198d" id="exampleModalLongTitle"> @lang('labels.backend.general_settings.footer.course_order') </h3> -->
          <h5 class="modal-title text-center text-white" style="color : #fff !important;" id="exampleModalLabel"> سجل الان</h5>
          <button type="button" class="close" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">&times;</span>
          </button>
        </div>
        <div class="modal-body">
            @include('frontend.pages.RequestForm')
          
        </div>
        {{-- <div class="modal-footer">
          <button type="button" class="btn btn-secondary" data-dismiss="modal">@lang('labels.backend.complainments.close')</button>
         
        </div> --}}
      </div>
    </div>
</div>
{{-- ///////////// --}}
    </footer>
    <!--==========Footer==========-->
    <footer class="row footer">
        <div class="container">
            <div class="row m0 menu-rights">
                <div class=" col-md-3">
                    @lang('labels.backend.general_settings.footer.copyrights')
                </div>
                <div class=" col-md-9 left-align">
                    <ul class="nav footer-menu">
                        <li><a href="https://ivorytraining.com"> @lang('custom-menu.nav-menu.about-us') </a></li>
                        <li><a href="/technicalSpecifications">
                                @lang('custom-menu.nav-menu.technical-specifications')</a></li>
                        <li><a href="/technicalSupport"> @lang('custom-menu.nav-menu.technical-support')</a></li>
                        <li><a href="https://ivorytraining.com/training-plans"> @lang('navs.general.training-plan') </a></li>
                        <li><a href="/contact"> @lang('navs.general.contact-us') </a></li>
                        <li><a href="{{ asset('storage/Royal_Decree/Royal_decree.pdf') }}" target="_blank">
                            @lang('custom-menu.nav-menu.royal_decree')
                        </a></li>
                    </ul>
                </div>
            </div>
        </div>
    </footer>
@endif

@push('after-scripts')
    <script type="text/javascript">
        $(document).ready(function() {
            $('#js-subscribe-btn').on('click', function() {
              
                var email = $('#subscribe_email').val();


                route = '{{ route('newsletter.subscribe') }}';


                $.ajaxSetup({
                    headers: {
                        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                    }
                });

                if (email) {
                    $.ajax({
                        url: route,
                        type: "POST",
                        dataType: "json",
                        data: {'email':email},
                        success: function(data) {
                            console.log(data);
                            console.log(data.success);

                           $('#subscribe_msg-content').html(data.success)
                           $('#subscribe_msg').show();
                          
                           setTimeout(() => {
                            $('#subscribe_msg').removeAttr("style").hide();
                           }, 9000);

                        },
                        error: function() {
                            console.log("error:" + data);
                        }
                    });
                } else {
                    $('select[name="city"]').empty();
                }
            });
        });
    </script>
@endpush
