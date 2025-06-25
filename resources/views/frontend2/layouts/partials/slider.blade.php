<section class="sliders">
    <div class="sliders-overlay">
        <div class="swiper-container swiper-sliders">
            <div class="swiper-wrapper">
                @foreach($slides as $slide)
                @php $content = json_decode($slide->content) @endphp
                @if(isset($content->widget) && $content->widget->type == 3)
                <div class="swiper-slide first-slide  @if($slide->overlay == 1) overlay  @endif" style="background-image: url({{asset('storage/uploads/'.$slide->bg_image)}});">
                    <div class="slide-content">
                        <h1 class="text-center cl-white">
                            @if(session('locale') == 'ar') {{ $content->hero_text_ar }} @else  {{ $content->hero_text }}   @endif 
                        </h1>
                        <p>
                            @if(session('locale') == 'ar') {{ $content->sub_text_ar }} @else  {{ $content->sub_text }}   @endif
                        </p>
                        <div class="container">
                            <div class="row">
                                <div class="col-md-3">
                                    <div class="cert">
                                        <div class="img-icon">
                                            <i class="fas fa-calendar-alt"></i>
                                        </div>
                                        <div class="title-cert">
                                            <h2 class="count" data-value="{{config('total_years')}}">0</h2>
                                            <div class="title text-color">@lang('labels.frontend.layouts.partials.years')</div>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-md-3">
                                    <div class="cert">
                                        <div class="img-icon">
                                            <i class="fas fa-tasks"></i>
                                        </div>
                                        <div class="title-cert">
                                            <h2 class="count" data-value="{{config('total_courses')}}">0</h2>
                                            <div class="title text-color">@lang('labels.frontend.layouts.partials.Programs')</div>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-md-3">
                                    <div class="cert">
                                        <div class="img-icon">
                                            <i class="fas fa-user-graduate"></i>
                                        </div>
                                        <div class="title-cert">
                                            <h2 class="count" data-value="{{config('total_students')}}">0</h2>
                                            <div class="title text-color">@lang('labels.frontend.layouts.partials.students')</div>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-md-3">
                                    <div class="cert">
                                        <div class="img-icon">
                                            <i class="fas fa-clock"></i>
                                        </div>
                                        <div class="title-cert">
                                            <h2 class="count" data-value="{{config('total_hours')}}">0</h2>
                                            <div class="title text-color">@lang('labels.frontend.layouts.partials.hours')</div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        @if(isset($content->buttons))
                        <div class="anchor">
                            @foreach($content->buttons as $button)
                            <a href="{{$button->link}}"><i class="fas fa-briefcase"></i> @if(session('locale') == 'ar') {{ $button->label_ar}} @else {{ $button->label}} @endif </a>
                            @endforeach
                        </div>
                        @endif
                    </div>
                </div>
                @else
                <div class="swiper-slide   @if($slide->overlay == 1) overlay  @endif" style="background-image: url({{asset('storage/uploads/'.$slide->bg_image)}});">
                    <div class="slide-content">
                        <h1 style="height: 160px">
                            @if(session('locale') == 'ar') {{ $content->hero_text_ar }} @else  {{ $content->hero_text }}   @endif 
                        </h1>
                        <p>
                            @if(session('locale') == 'ar') {{ $content->sub_text_ar }} @else  {{ $content->sub_text }}   @endif 
                        </p>
                        @if(isset($content->widget))
                            @if($content->widget->type == 2)
                                <div class="layer-1-3">

                                    <span class="timer-data d-none" data-timer="{{$content->widget->timer}}"></span>
                                    <div class="coming-countdown ul-li">
                                        <ul>
                                            <li class="days">
                                                <span class="number"></span>
                                                <span class>@lang('labels.frontend.layouts.partials.days')</span>
                                            </li>

                                            <li class="hours">
                                                <span class="number"></span>
                                                <span class>@lang('labels.frontend.layouts.partials.hours')</span>
                                            </li>

                                            <li class="minutes">
                                                <span class="number"></span>
                                                <span class>@lang('labels.frontend.layouts.partials.minutes')</span>
                                            </li>

                                            <li class="seconds">
                                                <span class="number"></span>
                                                <span class>@lang('labels.frontend.layouts.partials.seconds')</span>
                                            </li>
                                        </ul>
                                    </div>
                                </div>
                            @endif

                            @if($content->widget->type == 1)
                                <div class="search-course mb30 relative-position">
                                    <form action="{{route('search')}}" method="get">
                                        <input class="course" name="q" type="text"
                                            placeholder="@lang('labels.frontend.layouts.partials.search_placeholder')">
                                        <div class="nws-button text-center  gradient-bg text-capitalize">
                                            <button type="submit" value="Submit">@lang('labels.frontend.layouts.partials.search_courses')</button>
                                        </div>
                                    </form>
                                </div>
                            @endif
                        @endif

                        <div class="anchor">
                            @foreach($content->buttons as $button)
                            <a href="{{$button->link}}"><i class="fas fa-briefcase"></i> @if(session('locale') == 'ar') {{ $button->label_ar}} @else {{ $button->label}} @endif </a>
                            @endforeach
                        </div>
                    </div>
                </div>
                @endif
                @endforeach
                
            </div>
            <!-- Add Arrows -->
            <div class="swiper-sliders-next swiper-turn"><i class="fas fa-angle-right"></i></div>
            <div class="swiper-sliders-prev swiper-turn"><i class="fas fa-angle-left"></i></div>
        </div>
    </div>
</section>



<!-- End of slider section
============================================= -->

@push('after-scripts')
    <script>
        if ($('.coming-countdown').length > 0) {
            var date = $('.coming-countdown').siblings('.timer-data').data('timer')
            // Specify the deadline date
            var deadlineDate = new Date(date).getTime();
            // var deadlineDate = new Date('2019/02/09 22:00').getTime();

            // Cache all countdown boxes into consts
            var countdownDays = document.querySelector('.days .number');
            var countdownHours = document.querySelector('.hours .number');
            var countdownMinutes = document.querySelector('.minutes .number');
            var countdownSeconds = document.querySelector('.seconds .number');

            // Update the count down every 1 second (1000 milliseconds)
            setInterval(function () {
                // Get current date and time
                var currentDate = new Date().getTime();

                // Calculate the distance between current date and time and the deadline date and time
                var distance = deadlineDate - currentDate;

                // Time calculations for days, hours, minutes and seconds
                var days = Math.floor(distance / (1000 * 60 * 60 * 24));
                var hours = Math.floor((distance % (1000 * 60 * 60 * 24)) / (1000 * 60 * 60));
                var minutes = Math.floor((distance % (1000 * 60 * 60)) / (1000 * 60));
                var seconds = Math.floor((distance % (1000 * 60)) / 1000);

                // Insert the result data into individual countdown boxes
                countdownDays.innerHTML = days;
                countdownHours.innerHTML = hours;
                countdownMinutes.innerHTML = minutes;
                countdownSeconds.innerHTML = seconds;

                if (distance < 0) {
                    $('.coming-countdown').empty();
                }
            }, 1000);

        }

    </script>
@endpush