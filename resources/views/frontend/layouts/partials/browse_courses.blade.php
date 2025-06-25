<section id="best-course" class="best-course-section {{isset($class) ? $class : ''}} mt-5">
    <div class="container">
        
        <div class="desc related" style="margin-bottom: 0;padding-top: 0;padding-bottom: 0;">
            <div class="container-custome related-overlay">            
                <div class="row">
                @if(count($featured_courses) > 0)
                    @foreach($featured_courses as $course)
                    @if(count($course->locations)>0)

                        <div class="col-md-4">
                            @include('frontend.layouts.partials.course_box')
                        </div>
                     @endif
                    @endforeach
                @else
                    <h4 class="text-center">@lang('labels.general.no_data_available')</h4>
                @endif

            </div>
        </div>
    </div>
    </div>
</section>
