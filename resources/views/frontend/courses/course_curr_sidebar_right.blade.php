@if(Route::currentRouteNamed('courses.details.blogs'))
    @include('frontend.courses.course_sidebar_right_new')
@elseif(Route::currentRouteNamed('courses.details') || Route::currentRouteNamed('courses.inviteFriends'))
    @include('frontend.courses.course_sidebar_right_new')
@else
    @include('frontend.courses.course_sidebar_right')
@endif
@php
   /*
@endphp
<div class="border-end bg-white" id="sidebar-wrapper">

    <div class="list-group list-group-flush course-sidebar">
        <a class="list-group-item list-group-item-action list-group-item-light p-3 "
        href="{{route('courses.show',['course'=>$course->slug])}}"> @lang('labels.frontend.course.home')</a>
        <a class="list-group-item list-group-item-action list-group-item-light p-3 {{$currentPage=='details'?'active':''}}"
        href="{{route('courses.details',['course'=>$course->slug])}}">@lang('labels.frontend.chapters.title')</a>
{{--        <a class="list-group-item list-group-item-action list-group-item-light p-3 {{$currentPage=='blogs'?'active':''}}"--}}
{{--        href="{{route('courses.details.blogs',['course'=>$course->slug])}}">@lang('labels.frontend.blog.title')</a>--}}
{{--        <a class="list-group-item list-group-item-action list-group-item-light p-3 {{$currentPage=='rates'?'active':''}}"--}}
{{--        href="{{route('courses.details.rates',['course'=>$course->slug])}}">@lang('labels.frontend.rates.title')</a> --}}
        <a class="list-group-item list-group-item-action list-group-item-light p-3 active" id="anchor1"
        href="#">@lang('labels.frontend.blog.title')</a>
        <a class="list-group-item list-group-item-action list-group-item-light p-3" id="anchor2"
        href="#">@lang('labels.frontend.rates.title')</a>
      
        {{-- Forms --}}
        @if (count($impactMeasurments) > 0)
        {{-- ====New Design --}}
        <div id="accordion" class="curriclum-content lesson-cards">
               
                    
            <div class="">
                <div class="card-header" id="headingOne">
                    <h5 class="mb-0">
                        <a class="list-group-item list-group-item-action list-group-item-light p-3" data-toggle="collapse"
                            data-target="#collapse-impact-0" aria-expanded="true" aria-controls="collapse-impact-0">
                           
                            @lang('labels.frontend.course.impact')
                          
                        </a>
                    </h5>
                </div>
        
                <div id="collapse-impact-0" class="course-sidebar collapsed collapsed collapse "
                    aria-labelledby="headingOne" data-parent="#accordion">
                    <div class="card-body">
                        @foreach ($impactMeasurments as $item)
                        <div class=" mb-7 d-flex chapter-lesson hover-zoom course-sidebar">
                            <i class=" mb-14 fa fa-video-camera chapter-lesson-icon "></i>
                            <a  href="{{ route('courses.impacts', ['id' => $item->id, 'course_id' => $course->id]) }}">
                                <p class="display-content">
                                    {{
                                        session('locale') == 'ar'?$item->title_ar??$item->title:$item->title
        
                                    }}
                                    
                                    </p>
                            </a>
                            <div class="module-item-status-icon" style="margin-right: auto;"><i
                                    data-tooltip="" class="fa fa-circle-thin" title="يجب عرض الصفحة"
                                    aria-label="يجب عرض الصفحة"></i></div>
                        </div>
                        @endforeach
                    
        
        
                    </div>
                </div>
            </div>
       
        
           
          
        
        </div>
        {{-- ====New Design --}}
        @endif

        @if (count($programRecommendations) > 0)



         {{-- ====New Design --}}
         <div id="accordion" class="curriclum-content lesson-cards">
               

            <div class="">
                <div class="card-header" id="headingOne">
                    <h5 class="mb-0">
                        <a class="list-group-item list-group-item-action list-group-item-light p-3" data-toggle="collapse"
                            data-target="#collapse-programRec-0" aria-expanded="true" aria-controls="collapse-programRec-0">
                           
                            @lang('labels.frontend.course.programRec')
                          
                        </a>
                    </h5>
                </div>
        
                <div id="collapse-programRec-0" class="course-sidebar collapsed collapsed collapse "
                    aria-labelledby="headingOne" data-parent="#accordion">
                    <div class="card-body">
                        @foreach ($programRecommendations as $item)
                        <div class=" mb-7 d-flex chapter-lesson hover-zoom course-sidebar">
                            <i class=" mb-14 fa fa-video-camera chapter-lesson-icon "></i>
                            <a  href="{{ route('courses.programRecommendations', ['id' => $item->id, 'course_id' => $course->id]) }}">
                                <p class="display-content">
                                    {{
                                        session('locale') == 'ar'?$item->title_ar??$item->title:$item->title
        
                                    }}
                                    
                                    </p>
                            </a>
                            <div class="module-item-status-icon" style="margin-right: auto;"><i
                                    data-tooltip="" class="fa fa-circle-thin" title="يجب عرض الصفحة"
                                    aria-label="يجب عرض الصفحة"></i></div>
                        </div>
                        @endforeach
                    
        
        
                    </div>
                </div>
            </div>
        
            </div>
        {{-- ====New Design --}}
         @endif
        {{-- Forms --}}
    </div>
</div>
@php */  @endphp