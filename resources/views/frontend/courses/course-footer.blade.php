@php
    $course=$mainCourse;
@endphp
<div class="get-course">
    <div class="get-overlay">
        <div class="container-about">
            <div class="get-content web">
                <div class="row">
                    <div class="col-lg-6 col-md-12">
                        <div class="left-get">
                            <div class="title-get">@if(session('locale') == 'ar') {{ $mainCourse->title_ar }} @else {{$mainCourse->title}}
                                @endif</div>
                        </div>
                    </div>
                    <div class="col-lg-6 col-md-12">
                        <div class="right-get">
                            <div class="price-course">
                               
                               
                            </div>
                            <div class="anchor-course">
                                 @include('frontend.courses.buy_button')
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="get-content mob">
                <div class="row">
                    <div class="col-md-12">
                        <div class="right-get">
                            <div class="anchor-course">
                                @include('frontend.courses.buy_button')
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>