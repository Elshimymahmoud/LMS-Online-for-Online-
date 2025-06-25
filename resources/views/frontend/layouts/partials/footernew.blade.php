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



<!--==========Footer==========-->
<footer class="row footer-top mt-4 mb-4" style="background-image: url('{{ asset('images/footer.png')}}');background-repeat: no-repeat;width: 100%;background-size:100% 100%;">
 
    <div style="background-color: #4f198ddb">
        <div class="container">
            <div class="row m0 menu-rights">
                <div class=" col-md-3">
                    @if (session('locale') == 'ar')
                    <img src="{{ asset('iv') }}/images/logo-ar.png" style="
            width: 160px;
            height: auto;" alt="" />
                    @else
                    <img src="{{ asset('iv') }}/images/logo-en.png" style="
            width: 160px;
            height: auto;" alt="" />
                    @endif
                    {{-- <p>وسع نطاق نجاحك </p> --}}
                    <img src="{{ asset('iv') }}/images/foot.png" alt="" />
                    <h5 style="color: black; margin-bottom: 0;font-size: 17px;">Broaden Your Success</h5>


                </div>
                <div class=" col-md-3 ">
                    <h4 style="color:white">
                        @lang('labels.backend.general_settings.footer.popular_courses')
                    </h4>
                    <h4 style="color: white">_______</h4>

                    {{-- <ul class="nav footer-top-links">
                        @foreach ($popularCoursesFooter as $popularCourseFooter)
                            <li tyle="color:white">
                                <a href="{{route('courses.show',['course'=>$popularCourseFooter->slug])}}">
                    {{ Lang::locale() == 'ar' ? $popularCourseFooter->title_ar : $popularCourseFooter->title }}
                    </a>
                    </li>

                    @endforeach
                    </ul> --}}
                    {{-- --}}
                    <div class="footer-widget-content" style="margin-top: 15px;">
                        @foreach ($popularCoursesFooter as $popularCourseFooter)

                        <div class="media" style="display: flex;align-items: center">
                            <div class="media-left">
                                <a href="{{route('courses.show',['course'=>$popularCourseFooter->slug])}}">
                                    <img class="media-object" @if($popularCourseFooter->course_image != "" && file_exists('storage/uploads/'.$popularCourseFooter->course_image)) src="{{ resize('uploads/'.$popularCourseFooter->course_image,60,40)}}" @else src="{{asset('images/course-default.jpeg')}}" @endif width='60' height='40' style="border-radius:5px" alt="..."></a>
                            </div>
                            <div class="media-body">
                                <p style="line-height: inherit;color:white">
                                    <a class="mediaLnkCourseFooter" style="color:white" href="{{route('courses.show',['course'=>$popularCourseFooter->slug])}}">
                                        {{ Lang::locale() == 'ar' ? $popularCourseFooter->title_ar : $popularCourseFooter->title }}
                                    </a>
                                </p>


                            </div>
                        </div>

                        @endforeach

                    </div>

                    {{-- --}}
                </div>

                <div class=" col-md-3 ">
                    <h4 style="color: white"> @lang('labels.backend.general_settings.footer.important_link') </h4>
                    <h4 style="color: white">_______</h4>


                    <ul class="footer-top-menu" style="color: white">
                        <li><a href="https://ivorytraining.com" style="color: white"> @lang('navs.general.about') </a></li>
                        <li><a href="/" style="color: white">@lang('navs.general.home') </a></li>
                        <li><a href="https://ivorytraining.com/training-plans" style="color: white"> @lang('navs.general.training-plan') </a></li>
                        <li><a href="/contact" style="color: white"> @lang('navs.general.contact-us') </a></li>
                    </ul>

                </div>
                <div class="col-sm-6 col-md-3 ">
                    <h4 style="color: white"> @lang('labels.backend.general_settings.footer.stay_connected') </h4>
                    <h4 style="color: white">_______</h4>

                    <div style="color: white"> @lang('labels.backend.general_settings.footer.ivory_address') </div>
                    <div style="direction: ltr;padding-top: 10px;"><a style="color: white" href="tel:+96611445518">+966 11 445 518</a></div>
                    <div style="direction: ltr;"><a href="tel:+966533993220" style="color: white">+966 53 399 3220</a></div>
                    <div><a href="mailto:info@ivorytraining.com" style="color: white"></a></div>

                    <div class="row m0 social-links" style="padding-top: 20px">
                        <ul class="nav">
                            <li class="wow fadeInUp"><a href="https://www.facebook.com/ivorytraining" target="_blank"><i class="fab fa-facebook"></i></a></li>
                            <!-- <li class="wow fadeInUp" data-wow-delay="0.1s"><a href="https://twitter.com/ivorytraining" target="_blank"><i class="fab fa-twitter"></i></a></li> -->
                            <li class="wow fadeInUp" style="visibility: visible; animation-name: fadeInUp; width: 12%;">
                                <a href="https://twitter.com/ivorytraining" target="_blank" class="m-2">
                               <img style=" max-width: 75%;border-radius: 50%; opacity: 0.5;" src="{{ asset('iv') }}/images/x.png" alt="تويتر">
                                </a>
                            </li>
                            <li class="wow fadeInUp" style="visibility: visible; animation-name: fadeInUp;width: 12%;">
                                <a href="https://www.instagram.com/ivorytraining" target="_blank" class="m-2">
                               <img style="background-color: black; max-width: 75%;border-radius: 50%; opacity: 0.5;" src="{{ asset('iv') }}/images/insta.png" alt="تويتر">
                                </a>
                            </li>
                            <li class="wow fadeInUp" style="visibility: visible; animation-name: fadeInUp;width: 12%;">
                                <a href="https://www.tiktok.com/@ivorytraining?_t=8ZSERQefACw&_r=1" target="_blank" class="m-2">
                               <img style=" background-color: black; max-width: 75%;border-radius: 50%; opacity: 0.5;" src="{{ asset('iv') }}/images/tiktok.png" alt="تويتر">
                                </a>
                            </li>
                            <li class="wow fadeInUp" style="visibility: visible; animation-name: fadeInUp;width: 12%;">
                                <a href="https://www.snapchat.com/add/ivorytraining?share_id=SbBBF3sgS8y7/eHJQREm7A&locale=ar_SA@calendar=gregorian" target="_blank" class="m-2">
                               <img style=" background-color: black;max-width: 75%;border-radius: 50%; opacity: 0.5;" src="{{ asset('iv') }}/images/snapchat.png" alt="تويتر">
                                </a>
                            </li>
                            <li class="wow fadeInUp" data-wow-delay="0.2s"><a href="https://www.linkedin.com/company/ivorytraining" target="_blank"><i class="fab fa-linkedin"></i></a></li>
                            <li class="wow fadeInUp" data-wow-delay="0.3s"><a href="https://www.linkedin.com/in/ivorytraining/" target="_blank"><i class="fab fa-youtube"></i></a></li>
                            
                        </ul>
                    </div>



                </div>
                <!-- ************* -->
                <div class="row  wow fadeInUp mb-30">
                    <div class="col-sm-2 col-md-2 mt-50"></div>
                    <div class="col-sm-4 col-md-4 mt-50">
                        <h3 style="color:white">@lang('labels.frontend.home.speak_to_our_specialist')</h3>

                    </div>
                    <div class=" col-md-6 mt-50">
                        {{-- <form action="{{ route('subscribe') }}" id="subscribeform" class="row newsletter-form" method="post"> --}}
                        <div class="row newsletter-form">

                            @csrf
                            <div class="input-group" style="border: 3px solid white;">
                                <input id="subscribe_email" type="email" class="form-control newsletter-email" name="email" placeholder="@lang('labels.frontend.home.email')" style="border-radius: 0px; background-color: #f0f8ff00;" />
                                <span class="input-group-addon" style="border-radius: 0px !important;">
                                    <button type="submit" id="js-subscribe-btn" style="border-radius: 0px !important;
                                 background-color: white; color:#4f198d">@lang('labels.frontend.home.send')</button>
                                </span>


                            </div>
                            {{-- <p style="color: white" id="subscribe_msg"></p> --}}
                            {{-- --}}
                            <br>
                            <div style="display: none" class="alert alert-success fadeInUp" id="subscribe_msg" role="alert">
                                <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                                    <span aria-hidden="true">&times;</span>
                                </button>
                                <span id="subscribe_msg-content"></span>

                            </div>
                            {{-- --}}
                        </div>
                        {{-- </form> --}}
                    </div>
                </div>
                <!-- ********* -->


            </div>
        </div>

    </div>
</footer>
<!--==========Footer==========-->
<footer class="row footer" style="background: #58202b;color: white;">
    <div class="container">
        <div class="row m0 menu-rights">
            <div class="col-sm-6 col-md-3">
                @lang('labels.backend.general_settings.footer.copyrights')
            </div>
            <div class="col-sm-6 col-md-9 left-align">
                <ul class="nav footer-menu">
                    <li style="color: white"><a href="https://ivorytraining.com" style="color: white"> @lang('custom-menu.nav-menu.about-us') </a></li>
                    <li style="color: white"><a href="/technicalSpecifications" style="color: white">
                            @lang('custom-menu.nav-menu.technical-specifications')</a></li>
                    <li style="color: white"><a href="/technicalSupport" style="color: white"> @lang('custom-menu.nav-menu.technical-support')</a></li>
                    <li style="color: white"><a href="https://ivorytraining.com/training-plans" style="color: white"> @lang('navs.general.training-plan') </a></li>
                    <li style="color: white"><a href="/contact" style="color: white"> @lang('navs.general.contact-us') </a></li>
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


            route = '{{ route('
            newsletter.subscribe ') }}';


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
                    data: {
                        'email': email
                    },
                    success: function(data) {
                        console.log(data.success);

                        $('#subscribe_msg-content').html(data.success)
                        $('#subscribe_msg').show();

                        setTimeout(() => {
                            $('#subscribe_msg').removeAttr("style").hide();
                        }, 2000);

                    },
                    error: function() {

                    }
                });
            } else {
                $('select[name="city"]').empty();
            }
        });
    });
</script>
@endpush