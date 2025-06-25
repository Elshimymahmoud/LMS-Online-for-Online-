    <!--==========Reviews==========-->
    <section class="row ltr  the-slider" id="slider">
            <div class="row">
                <div class="large-12 columns">
                    <div class="home-slider owl-theme">
                       
                        @foreach($slides as $slide)
                        @php $content = json_decode($slide->content) @endphp
                        
                        <div class="item">
                            <div  style="background: url({{asset('storage/uploads/'.$slide->bg_image)}});background-size: cover;height:500px;background-color: #fdfaf1;">
                                <div class="container">
                                    <div class="row benefit-notes rtl">
                                        <!--==========Single Benefit==========-->
                                        <div class="col-sm-6 col-md-5 benefit wow fadeInUp ptb-50 slider-content">
                                            <h3>@if(session('locale') == 'ar') {{ $content->hero_text_ar }} @else  {{ $content->hero_text }}   @endif</h3>
                                            <p>
                                              @if(session('locale') == 'ar') {{ $content->sub_text_ar }} @else  {{ $content->sub_text }}   @endif
                                            </p>
                                            <h2 style="margin-right: 13px"> @if(session('locale') == 'ar') {{ @$content->hero_title_ar }} @else  {{ @$content->hero_title }}   @endif </h2>
                                            {{-- <a href="https://www.youtube.com/watch?v=dPL1-8ypnEs" class="btn btn-primary btn-lg video">انضم
                                                الآن لتمهير</a> --}}
                                                @if(!auth()->check() )
                                                <a href="{{route('frontend.auth.login')}}" class="btn btn-primary btn-lg ">
                                                    @lang('labels.frontend.home.join_now_bottom')
                                                </a>
                                                    @endif
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        @endforeach

                    </div>

                    <script>
                        $(document).ready(function() {
                            var owl = $(".home-slider");
                            owl.owlCarousel({
                                margin: 10,
                                nav: true,
                                loop: true,
                                dots: false,
                                navText: [
                                    '<i class="fa fa-angle-left" aria-hidden="true"></i>',
                                    '<i class="fa fa-angle-right" aria-hidden="true"></i>'
                                ],
                                responsive: {
                                    0: {
                                        items: 1
                                    },
                                    600: {
                                        items: 1
                                    },
                                    1000: {
                                        items: 1
                                    }
                                }
                            });
                        });
                    </script>
                </div>
            </div>
    </section>


    