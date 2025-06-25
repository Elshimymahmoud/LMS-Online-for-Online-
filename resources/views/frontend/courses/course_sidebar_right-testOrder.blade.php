{{-- <div class="border-end bg-white" id="sidebar-wrapper">

    <div class="list-group list-group-flush course-sidebar">
        <a class="list-group-item list-group-item-action list-group-item-light p-3 active"
            href="#!">الصفحة الرئيسية</a>
        <a class="list-group-item list-group-item-action list-group-item-light p-3 "
            href="#!">الوحدات</a>
        <a class="list-group-item list-group-item-action list-group-item-light p-3"
            href="#!">النقاشات</a>
        <a class="list-group-item list-group-item-action list-group-item-light p-3"
            href="#!">الدرجات</a>

    </div>
</div> --}}

@php

    $lessonCourse = $course;
    $mainLesson=$lesson??[];


@endphp
<div class="border-end bg-white" id="sidebar-wrapper">

    <div class="list-group list-group-flush course-sidebar">
{{-- /////// --}}
      

            {{-- //////// --}}
        {{-- ========Old Design --}}

            {{-- <div id="accordion">
                <div class="card">
                    <div class="card-header" id="headingOne">
                        <h5 class="mb-0" >
                            <a class="  active btn btn-link list-group-item list-group-item-action list-group-item-light p-3"
                                data-toggle="collapse" data-target="#lessons-collapse"
                                aria-expanded="false" aria-controls="blogs-collapse">
                                @lang('menus.backend.sidebar.courses.circulum')
                            </a>
                        </h5>
                    </div>

                    <div id="lessons-collapse" class="collapse collapsed"
                        aria-labelledby="headingOne" data-parent="#accordion">
                       

                            <div class="card-body list-body">
                                <ul class="nav-dropdown-items nested-ul">
                                    @foreach ($lessonCourse->chapter()->get() as $key => $item)
                                    <li class="nav-item"  >
                                        <a class="nav-link " style="color: ##3bcfcb;font-weight: bold;"
                                            href="#">
                                            @if (session('locale') == 'ar') {{ $item->title_ar ?? $item->title }} @else {{ $item->title ?? $item->title_ar }} @endif
                                        </a>
                                        
                                        <ul class="nav-dropdown-items" style="padding-right: 16px;">
                    
                                            @foreach ($item->lessons as $lesson_key => $lesson_item)
                                            
                                                <li class="nav-item " style="    padding: 5px;">
                                                    <a class="nav-link" style="color: ##3bcfcb"
                                                    
                                                        @if (in_array($lesson_item->id, $completed_lessons))href="{{ route('lessons.show', ['id' => $lesson_item->course->id, 'slug' => $lesson_item->slug]) }}"@endif>
                                                    
                                                        <span class="title text-color"> @if (session('locale') == 'ar') {{ $lesson_item->title_ar ?? $lesson_item->title }} @else {{ $lesson_item->title ?? $lesson_item->title_ar }}  @endif</span>
                    
                                                    </a>
                                                </li>
                                            
                                            @endforeach
                                        
                                            @foreach ($item->test as $lesson_key => $lesson_item)
                                        
                                                <li class="nav-item ">
                                                    <a class="nav-link"
                                                        @if (in_array($lesson_item->id, $completed_lessons))href="{{ route('lessons.show', ['id' => $lessonCourse->id, 'slug' => $lesson_item->slug]) }}"@endif>
                    
                                                        <span class="title text-color"> <i class="fa fa-question-circle"></i>
                                                            @if (session('locale') == 'ar') {{ $lesson_item->title_ar ?? $lesson_item->title }} @else {{ $lesson_item->title ?? $lesson_item->title_ar }}  @endif</span>
                    
                                                    </a>
                                                </li>
                                            @endforeach
                    
                                        </ul>
                                    </li>
                                    @endforeach
                                </ul>
                            </div>
                      


                    </div>

                </div>
            </div> --}}
        {{-- ========Old Design --}}
    {{-- ====New Design --}}
    <div id="accordion" class="curriclum-content">
        <div class="card">
            <div class="card-header" id="headingOne">
                <h5 class="mb-0" >
                    <a class="  active list-group-item btn btn-chapter-collapse"
                        data-toggle="collapse" data-target="#lessons-collapse"
                        aria-expanded="false" aria-controls="blogs-collapse">
                        @lang('menus.backend.sidebar.courses.circulum')
                    </a>
                </h5>
            </div>

            <div id="lessons-collapse" class="collapse collapsed collapse in"
                aria-labelledby="headingOne" data-parent="#accordion">
        {{-- ================================ --}}
        <div id="accordion" class="curriclum-content lesson-cards">
            @php
            $lessonFirst=$lessons[0]->model_type::findOrFail($lessons[0]->model_id);
            $chapterFirst=$lessonFirst->chapter ;
            $key=0;
            @endphp
            @foreach ($lessons as $key=>$SeqTimeLine)
                @php
                $lesson=$SeqTimeLine->model_type::findOrFail($SeqTimeLine->model_id);
                $chapter=$lesson->chapter ;
                // if($chapter->id==$chapterFirst->id){
                //     $key=$key;
                // }
                // else{
                //     $key+=1;
                //     $chapterFirst=$chapter;
                // }
                @endphp
               
            <div class="">
                <div class="card-header" id="headingOne">
                    <h5 class="mb-0">
                        <a class=" active list-group-item btn btn-chapter-collapse chapters " data-toggle="collapse"
                            data-target="#collapse-{{$key}}" aria-expanded="{{$key==0?'true':''}}" aria-controls="collapse-{{$key}}">
                        
                        {{
                            session('locale') == 'ar'?$chapter->title_ar??$chapter->title:$chapter->title
                        }}
                        -{{$chapter->session_length}}
                        @lang('labels.backend.courses.hours')
                        </a>
                    </h5>
                </div>
                @php
                    $mainLesson!=[]?$slugs=array_column($chapter->lessons->where('published',1)->toArray(),'slug'):[];
                @endphp
            
                <div id="collapse-{{$key}}" class="course-sidebar collapsed collapsed collapse {{$mainLesson?(in_array($mainLesson->slug,$slugs)?'in': ''):''}} "
                    aria-labelledby="headingOne" data-parent="#accordion">
                    <div class="card-body">
                        @php
                            $currentLesson=0;
                        @endphp
                        {{-- @foreach ($chapter->lessons->where('published',1) as $lesson) --}}
                      
                        
                        <div class=" mb-7 d-flex chapter-lesson hover-zoom course-sidebar">
                            <i class=" mb-14 fa fa-video-camera chapter-lesson-icon "></i>
                            <a href="{{route('lessons.show',['course_id'=>$course->id,'slug'=>$lesson->slug])}}">
                                <p class="display-content">
                                    {{
                                        session('locale') == 'ar'?$lesson->title_ar??$lesson->title:$lesson->title

                                    }}
                                    
                                    </p>
                            </a>
                            <div class="module-item-status-icon" style="margin-right: auto;"><i
                                    data-tooltip="" class="fa fa-circle-thin" title="يجب عرض الصفحة"
                                    aria-label="يجب عرض الصفحة"></i></div>
                        </div>
                      
                        {{-- @endforeach --}}


                    </div>
                </div>
            </div>
            @endforeach

        
        

        </div>
        {{-- ============================== --}}
            </div>
        </div>
    </div>
    {{-- ====New Design --}}
           
        {{-- ///// --}}
        @if (count($blogs) > 0)

        {{-- ========Old Design --}}
  
            {{-- <div id="accordion">
                <div class="card">
                    <div class="card-header" id="headingOne">
                        <h5 class="mb-0" >
                            <a class="  active btn btn-link list-group-item list-group-item-action list-group-item-light p-3"
                                data-toggle="collapse" data-target="#blogs-collapse"
                                aria-expanded="false" aria-controls="blogs-collapse">
                                @lang('labels.frontend.course.blog')
                            </a>
                        </h5>
                    </div>

                    <div id="blogs-collapse" class="collapse collapsed "
                        aria-labelledby="headingOne" data-parent="#accordion">
                        @foreach ($blogs as $item)

                            <div class="card-body list-body">
                                <ul class="nav-dropdown-items nested-ul">
                                    <li class="nav-item">
                                        <a class="nav-link color-primary "
                                            href="{{ route('courses.blogs', ['slug' => $item->slug, 'course_id' => $course->id]) }}">{{ $item->title }}</a>
                                    </li>
                                </ul>
                            </div>
                        @endforeach


                    </div>

                </div>
            </div> --}}
        {{-- ========Old Design --}}
            {{-- ====New Design --}}
            <div id="accordion" class="curriclum-content lesson-cards">
               
                    
                <div class="">
                    <div class="card-header" id="headingOne">
                        <h5 class="mb-0">
                            <a class=" active list-group-item btn btn-chapter-collapse  " data-toggle="collapse"
                                data-target="#collapse-blog-0" aria-expanded="true" aria-controls="collapse-blog-0">
                               
                                @lang('labels.frontend.course.blog')
                              
                            </a>
                        </h5>
                    </div>
            
                    <div id="collapse-blog-0" class="course-sidebar collapsed collapsed collapse "
                        aria-labelledby="headingOne" data-parent="#accordion">
                        <div class="card-body">
                            @foreach ($blogs as $item)
                            <div class=" mb-7 d-flex chapter-lesson hover-zoom course-sidebar">
                                <i class=" mb-14 fa fa-video-camera chapter-lesson-icon "></i>
                                <a href="{{ route('courses.blogs', ['slug' => $item->slug, 'course_id' => $course->id]) }}">
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
        @if (count($impactMeasurments) > 0)


        {{-- ========Old Design --}}
            {{-- <div id="accordion">
                <div class="card">
                    <div class="card-header" id="headingOne">
                        <h5 class="mb-0" >
                            <a class="  active btn btn-link list-group-item list-group-item-action list-group-item-light p-3"
                                data-toggle="collapse" data-target="#impactMes-collapse"
                                aria-expanded="false" aria-controls="impactMes-collapse">
                                @lang('labels.frontend.course.impact')
                            </a>
                        </h5>
                    </div>

                    <div id="impactMes-collapse" class="collapse collapsed "
                        aria-labelledby="headingOne" data-parent="#accordion">


                        @foreach ($impactMeasurments as $item)


                            <div class="card-body list-body">
                                <ul class="nav-dropdown-items nested-ul">
                                    <li>
                                        <a class="nav-link color-primary "
                                            href="{{ route('courses.impacts', ['id' => $item->id, 'course_id' => $course->id]) }}">@if (Lang::locale() == 'en'){{ $item->title ? $item->title : $item->title_ar }}@else {{ $item->title_ar ? $item->title_ar : $item->title }} @endif</a>
                                    </li>
                                </ul>
                            </div>
                        @endforeach
                    </div>

                </div>
            </div> --}}
        {{-- ========Old Design --}}

        {{-- ====New Design --}}
        <div id="accordion" class="curriclum-content lesson-cards">
               
                    
            <div class="">
                <div class="card-header" id="headingOne">
                    <h5 class="mb-0">
                        <a class=" active list-group-item btn btn-chapter-collapse  " data-toggle="collapse"
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

   
         {{-- ====Old Design --}}

        {{-- <div id="accordion">
            <div class="card">
                <div class="card-header" id="headingOne">
                    <h5 class="mb-0" >
                        <a class="  active btn btn-link list-group-item list-group-item-action list-group-item-light p-3"
                            data-toggle="collapse" data-target="#programRec-collapse"
                            aria-expanded="false" aria-controls="programRec-collapse">
                            @lang('labels.frontend.course.programRec')
                        </a>
                    </h5>
                </div>

                <div id="programRec-collapse" class="collapse collapsed "
                    aria-labelledby="headingOne" data-parent="#accordion">


                    @foreach ($programRecommendations as $item)


                        <div class="card-body list-body">
                            <ul class="nav-dropdown-items nested-ul">
                                <li>
                                    <a class="nav-link color-primary "
                                        href="{{ route('courses.programRecommendations', ['id' => $item->id, 'course_id' => $course->id]) }}">@if (Lang::locale() == 'en'){{ $item->name ? $item->title : $item->title_ar }}@else {{ $item->title_ar ? $item->title_ar : $item->title }} @endif</a>
                                </li>
                            </ul>
                        </div>
                    @endforeach
                </div>

            </div>
        </div> --}}
         {{-- ====Old Design --}}

         {{-- ====New Design --}}
         <div id="accordion" class="curriclum-content lesson-cards">
               
                    
            <div class="">
                <div class="card-header" id="headingOne">
                    <h5 class="mb-0">
                        <a class=" active list-group-item btn btn-chapter-collapse  " data-toggle="collapse"
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

    </div>
</div>