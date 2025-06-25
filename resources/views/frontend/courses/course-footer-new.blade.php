@php
    $course= $mainCourse;
@endphp
<div class="get-course floatCourseFooter fadeInUp" style="display: none">
    <div class="get-overlay" style="width: 100%">
        <div class="container-about">
            <div class="get-content web">
                <div class="row">
                    <div class="col-lg-6 col-md-6">
                        <div class="left-get" style="margin-top:15px;font-weight:bold;padding: 10px;">
                            <div class="title-get" style="font-size: 20px;">@if(session('locale') == 'ar') {{ $mainCourse->title_ar }} @else {{$mainCourse->title}}
                                @endif</div>
                        </div>
                    </div>
                    <div class="col-lg-6 col-md-6 ">
                        <div class="right-get">
                            <div class="price-course">
                               
                               
                            </div>
                            <div class="anchor-course" style="display: flex;
                            justify-content: center;">
                                 @include('frontend.courses.buy_button')
                            </div>
                        </div>
                    </div>
                </div>
            </div>
           
        </div>
    </div>
</div>