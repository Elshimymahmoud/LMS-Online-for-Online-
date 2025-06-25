

    <style>

        #testimonials{
            margin: 100px 0;
            direction: ltr;
        }
        .testimonial-bg {
            border: 10px solid #4f198d;
            padding: 80px 70px;
            text-align: center;
            position: relative;
        }

        .testimonial-bg:before {
            content: "\f10d";
            font-family: "fontawesome";
            width: 75px;
            height: 75px;
            line-height: 75px;
            background: #fff;
            text-align: center;
            font-size: 50px;
            color: #3c414c;
            position: absolute;
            top: -40px;
            left: 2%;
        }

        .testimonial {
            padding: 0 15px;
        }

        .testimonial .description {
            font-size: 20px;
            font-weight: 400;
            font-style: italic;
            color: #848484;
            line-height: 30px;
            padding-bottom: 25px;
            margin-bottom: 15px;
            position: relative;
        }

        .testimonial .description:before {
            content: "";
            width: 75%;
            border-top: 1px solid #ddd;
            margin: 0 auto;
            position: absolute;
            bottom: 0;
            left: 0;
            right: 0;
        }

        .testimonial .description:after {
            content: "";
            width: 20px;
            height: 20px;
            background: #fff;
            position: absolute;
            bottom: -10px;
            left: 50%;
            border-bottom: 1px solid #ddd;
            border-right: 1px solid #ddd;
            transform: translateX(-50%) rotate(45deg);
        }

        .testimonial .pic {
            width: 100px;
            height: 100px;
            border-radius: 50%;
            margin: 25px auto;
            overflow: hidden;
        }

        .testimonial .pic img {
            width: 100%;
            height: auto;
        }

        .testimonial .title {
            display: inline-block;
            font-size: 23px;
            font-weight: 700;
            color: #848484;
            text-transform: capitalize;
            margin: 0;
        }

        .testimonial .post {
            display: inline-block;
            font-size: 20px;
            color: #848484;
        }

        .owl-theme .owl-controls {
            background: #fff;
            margin-top: 10px;
            position: absolute;
            bottom: -34%;
            right: 0;
        }

        .owl-theme .owl-controls .owl-buttons div {
            width: 30px;
            height: 30px;
            line-height: 30px;
            border-radius: 50%;
            background: #34363b;
            opacity: 1;
            padding: 0;
        }

        .owl-prev:before,
        .owl-next:before {
            content: "\f104";
            font-family: "fontawesome";
            font-size: 23px;
            font-weight: 700;
            color: #fff;
        }

        .owl-next:before {
            content: "\f105";
        }

        @media only screen and (max-width:767px) {
            .testimonial-bg {
                padding: 50px 40px;
            }

            .owl-theme .owl-controls {
                bottom: -22%;
            }
        }

        @media only screen and (max-width:480px) {
            .testimonial-bg:before {
                width: 55px;
                height: 55px;
                line-height: 55px;
                font-size: 40px;
            }

            .testimonial-bg {
                padding: 30px 10px;
            }

            .owl-theme .owl-controls {
                bottom: -15%;
            }
        }

        @media only screen and (max-width:360px) {

            .testimonial .title,
            .testimonial .post {
                font-size: 16px;
            }

            .owl-theme .owl-controls {
                bottom: -12%;
            }
        }

        .owl-theme .owl-controls{
            bottom: unset !important;
        }
    </style>

    <section class="row " id="testimonials">
        <div class="container">
            <div class="row">
                <div class="col-md-10 col-md-offset-1">
                    <div class="testimonial-bg">
                        <div id="testimonial-slider" class="owl-carousel">
                           
                           
                            @foreach ($testimonials as $index => $testimonial)
                            <div class="testimonial">
                                <p class="description">
                                    @if (session('locale') == 'ar')  {{ $testimonial->content_ar }} @else {{ $testimonial->content }} @endif
                                </p>
                                <div class="pic">
                                    @if ($testimonial->image)
                                        <a href="{{ asset('storage/uploads/'.$testimonial->image) }}" target="_blank"><img height="50px" src="{{ asset('storage/uploads/'.$testimonial->image) }}" class="mt-1"></a>
                                    @else
                                        <a href="{{ asset('storage/uploads/avatar.png') }}" target="_blank"><img height="50px" src="{{ asset('storage/uploads/'.$testimonial->image) }}" class="mt-1"></a>
                                    @endif
                                </div>
                                <h3 class="title text-color">@if (session('locale') == 'ar')  {{ $testimonial->name_ar }} @else {{ $testimonial->name }} @endif</h3>
                                <span class="post">@if (session('locale') == 'ar')  {{ $testimonial->occupation_ar }} @else {{ $testimonial->occupation }} @endif</span>
                            </div>
                            @endforeach
                            
                            
                        </div>
                    </div>
                </div>
            </div>
        </div>

    </section>






    <script>
        $(document).ready(function() {
            $("#testimonial-slider").owlCarousel({
                margin: 0,
                    responsiveClass: true,
                    nav: false,
                    loop:true,
                    dots: true,
                    autoplay: true,
                    navText: [" ", " "],
                    smartSpeed: 1000,
                    responsive: {
                        0: {
                            items: 1,
                        },
                        400: {
                            items: 1,
                        },
                        600: {
                            items: 1,
                        },
                        700: {
                            items: 1,
                        },
                        800: {
                            items: 1,
                        },
                        1000: {
                            items: 1,

                        }
                    },             
            });
        });
    </script>

