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
   $currentPage=request()->segment(count(request()->segments())); 
  
    $lessonCourse = $course;
    $mainLesson = $lesson ?? [];
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
                    <h5 class="mb-0">
                        <a class="active btn btn-chapter-collapse2 white-normal list-group-item list-group-item-action list-group-item-light p-3 "
                            href="{{ route('courses.show', ['course' => $course->slug]) }}">
                            @lang('labels.frontend.course.home')
                        </a>
                    </h5>
                </div>
                <div class="card-header" id="headingOne">
                    <h5 class="mb-0">
                        <a class="active list-group-item btn btn-chapter-collapse2 white-normal "
                            data-toggle="collapse" data-target="#lessons-collapse" aria-expanded="true"
                            aria-controls="blogs-collapse">
                            @lang('menus.backend.sidebar.courses.circulum')
                        </a>
                    </h5>
                </div>

                <div id="lessons-collapse" class="collapse @if(isset($show_course_lesson)) in @endif" aria-labelledby="headingOne" data-parent="#accordion">
                    {{-- ================================ --}}
                    <div id="accordion" class="curriclum-content lesson-cards">
                        @foreach ($lessonCourse->chapter()->orderBy('sequence', 'asc')->get() as $key => $chapter)
                        @php
                        $chapterLessons=$chapter->lessons()->whereHas('courseLocations', function($query) use($course_location_id) {
                            $query->where('course_location_id', '=', $course_location_id)
                            ->where('model_type', '=', 'App\Models\Lesson');
                        })->pluck('id')->merge($lessonCourse->tests()->whereHas('courseLocations', function($query) use($course_location_id) {
                            $query->where('course_location_id', '=', $course_location_id)
                            ->where('model_type', '=', 'App\Models\Forms');
                        })->pluck('forms.id')
                    );
                    @endphp
                    
                    @if(count($chapterLessons)>0)
                            <div class="">
                                <div class="card-header" id="headingOne">
                                    <h5 class="mb-0">
                                        <a class=" active list-group-item btn btn-chapter-collapse chapters white-normal "
                                            data-toggle="collapse" data-target="#collapse-{{ $key }}"
                                            aria-expanded="{{ $key == 0 ? 'true' : '' }}"
                                            aria-controls="collapse-{{ $key }}">

                                            {{  session('locale') == 'ar' ? $chapter->title_ar ?? $chapter->title : $chapter->title }}
                                            -{{ $chapter->session_length }}
                                            @lang('labels.backend.courses.hours')
                                        </a>
                                    </h5>
                                </div>
                                @php
                                    
                                    $mainLesson != [] ? ($slugs = array_column($chapter->lessons->where('published', 1)->toArray(), 'slug')) : ($slugs = []);
                                    $testsSlug = array_column($chapter->test->where('published', 1)->toArray(), 'slug');
                                    $chapterBlogsSlug = array_column($chapter->blogs->toArray(), 'slug');
                                    
                                    $slugs = array_merge($slugs, $testsSlug);
                                    $slugs = array_merge($slugs, $chapterBlogsSlug);
                                    
                                @endphp

                                <div id="collapse-{{ $key }}"
                                    class="course-sidebar collapsed collapsed collapse {{ $mainLesson ? (in_array($mainLesson->slug, $slugs) ? 'in' : '') : '' }} "
                                    aria-labelledby="headingOne" data-parent="#accordion">
                                    <div class="card-body">
                                        @foreach ($course->courseTimeline as $item)
                                            @if (@$item->model->chapter_id == $chapter->id&&(($item->model_type=='App\Models\Lesson'||$item->model_type=='App\Models\Forms')&&in_array($course_location_id,$item->model->courseLocations->pluck('id')->toArray())))

                                                <div class=" mb-7 d-flex chapter-lesson hover-zoom course-sidebar "
                                                    style="{{ $mainLesson ? ($item->model->id == $mainLesson->id ? 'background-color:#ebcdd4;' : '') : '' }}">

                                                    <a
                                                        href="{{ route('lessons.show', ['course_id' => $item->course_id, 'slug' => $item->model->slug,'course_location_id'=>$course_location_id]) }}">
                                                        <p class="display-content">
                                                            {{ session('locale') == 'ar' ? $item->model->title_ar : $item->model->title }}
                                                        </p>
                                                    </a>

                                                </div>
                                            @endif
                                        @endforeach
                                    </div>
                                   
                                    @if (count($chapter->blogs()->get()) > 0)
                                        {{-- chapter blogs --}}
                                        @php
                                            $chapterLocBlogs=$chapter->blogs()->whereHas('courseLocations', function($query) use($course_location_id) {
                                            $query->where('course_location_id', '=', $course_location_id)
                                            ->where('model_type', '=', 'App\Models\Blog');
                                        })->pluck('id');
                                        @endphp
                                         @if(count($chapterLocBlogs)>0)
                                        <div id="accordion" class="curriclum-content lesson-cards">


                                            <div class="">
                                                <div class="card-header" id="headingOne">
                                                    <h5 class="mb-0">
                                                        <a class=" active list-group-item btn btn-chapter-collapse"
                                                            data-toggle="collapse"
                                                            data-target="#collapse-blog-chapter-0" aria-expanded="true"
                                                            aria-controls="collapse-blog-0">

                                                            @lang('labels.frontend.course.blog')

                                                        </a>
                                                    </h5>
                                                </div>

                                                <div id="collapse-blog-chapter-0"
                                                    class="course-sidebar collapsed collapsed collapse {{ $mainLesson ? (in_array($mainLesson->slug, $slugs) && get_class($mainLesson) == 'App\Models\Blog' ? 'in' : '') : '' }} "
                                                    aria-labelledby="headingOne" data-parent="#accordion">
                                                    <div class="card-body">
                                                        @foreach ($chapter->blogs()->get() as $chapterBlog)
                                                       @if(in_array($chapterBlog->id,$chapterLocBlogs->toArray()))
                                                       
                                                            <div class=" mb-7 d-flex chapter-lesson hover-zoom course-sidebar"
                                                                style="{{ $mainLesson ? ($chapterBlog->slug == $mainLesson->slug ? 'background-color:aliceblue;' : '') : '' }}">
                                                                <i
                                                                    class=" mb-14 fa fa-graduation-cap chapter-lesson-icon "></i>
                                                                <a
                                                                    href="{{ route('courses.blogs', ['slug' => $chapterBlog->slug, 'course_id' => $course->id,'course_location_id'=>$course_location_id]) }}">
                                                                    <p class="display-content">
                                                                        {{                                                                         session('locale') == 'ar' ? $chapterBlog->title_ar ?? $chapterBlog->title : $chapterBlog->title }}

                                                                    </p>
                                                                </a>

                                                            </div>
                                                            @endif
                                                        @endforeach



                                                    </div>
                                                </div>
                                            </div>





                                        </div>
                                        @endif
                                        {{-- chapter blogs --}}
                                    @endif
                                </div>

                            </div>
                    @endif
                        @endforeach




                    </div>
                    {{-- ============================== --}}
                </div>

            </div>
        </div>
        {{-- ====New Design --}}
        {{-- if course is direct course type (id==>3) show rates button --}}
        {{-- @if ($lessonCourse->type_id == 3) --}}
        <div id="" class="curriclum-content lesson-cards">



            <div class="">

                @if(Route::currentRouteName() == 'courses.details.rates' || Route::currentRouteName() == 'courses.details.blogs')

                    <div class="card-header" id="headingOne">
                        <h5 class="mb-0" >
                            <a class="active btn btn-chapter-collapse2 white-normal list-group-item list-group-item-action list-group-item-light p-3" href="#" id="anchor1">
                                @lang('labels.frontend.blog.title')
                            </a>
                        </h5>
                    </div>

                    <div class="card-header" id="headingOne">
                        <h5 class="mb-0" >
                            <a class="active btn btn-chapter-collapse2 white-normal list-group-item list-group-item-action list-group-item-light p-3" href="#" id="anchor2">
                                @lang('labels.frontend.rates.title')
                            </a>
                        </h5>
                    </div>

                @else
                    <div class="card-header" id="headingOne">
                        <h5 class="mb-0" >
                            <a class="active btn btn-chapter-collapse2 white-normal list-group-item list-group-item-action list-group-item-light p-3" href="{{route('courses.details.blogs',['course'=>$course->slug,'course_location_id'=>$course_location_id])}}">
                                @lang('labels.frontend.blog.title')
                            </a>
                        </h5>
                    </div>

                    <div class="card-header" id="headingOne">
                        <h5 class="mb-0" >
                            <a class="active btn btn-chapter-collapse2 white-normal list-group-item list-group-item-action list-group-item-light p-3 {{$currentPage=='rates'?'active':''}}" href="{{route('courses.details.rates',['course'=>$course->slug,'course_location_id'=>$course_location_id])}}">
                                @lang('labels.frontend.rates.title')
                            </a>
                        </h5>
                    </div>
                @endif

            </div>

            
        </div>
       
        {{-- @endif --}}
        {{-- ///// --}}
       
        @if (count($impactMeasurments) > 0||count($programRecommendations) > 0)
        <div class="card-header" id="headingOne">
            <h5 class="mb-0">
                <a class="  active list-group-item btn btn-chapter-collapse2 white-normal collapsed"
                    data-toggle="collapse" data-target="#lessonss-collapse" aria-expanded="true"
                    aria-controls="blogs-collapse">
                    @lang('menus.backend.sidebar.forms.title')
                </a>
            </h5>
        </div>
        @endif

        <div id="lessonss-collapse" class="collapse " aria-labelledby="headingOne" data-parent="#accordion">

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
                @php
                    $mainLesson != [] ? ($ImpactIds = array_column($impactMeasurments->toArray(), 'id')) : [];
                @endphp
                <div id="accordion" class="curriclum-content lesson-cards">


                    <div class="">
                        <div class="card-header" id="headingOne">
                            <h5 class="mb-0">
                                <a class=" active list-group-item btn btn-chapter-collapse white-normal  "
                                    data-toggle="collapse" data-target="#collapse-impact-0" aria-expanded="true"
                                    aria-controls="collapse-impact-0">

                                    @lang('labels.frontend.course.impact')

                                </a>
                            </h5>
                        </div>

                        <div id="collapse-impact-0"
                            class="course-sidebar collapsed collapsed collapse {{ $mainLesson ? (in_array($mainLesson->id, $ImpactIds) && $mainLesson->form_type == 'impact_measurments' ? 'in' : '') : '' }} "
                            aria-labelledby="headingOne" data-parent="#accordion">
                            <div class="card-body">
                                @foreach ($impactMeasurments as $item)

                                    <div class=" mb-7 d-flex chapter-lesson hover-zoom course-sidebar"
                                        style="{{ $mainLesson ? ($item->id == $mainLesson->id && $mainLesson->form_type == 'impact_measurments' ? 'background-color:aliceblue;' : '') : '' }}">
                                        <i class=" mb-14 fa fa-graduation-cap chapter-lesson-icon "></i>
                                        <a
                                            href="{{ route('courses.impacts', ['id' => $item->id, 'course_id' => $course->id,'course_location_id'=>$course_location_id]) }}">
                                            <p class="display-content">
                                                {{ session('locale') == 'ar' ? $item->title_ar ?? $item->title : $item->title }}
                                            </p>
                                        </a>

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

                    @php
                        $mainLesson != [] ? ($programRecIds = array_column($programRecommendations->toArray(), 'id')) : [];
                    @endphp
                    <div class="">
                        <div class="card-header" id="headingOne">
                            <h5 class="mb-0">
                                <a class=" active list-group-item btn btn-chapter-collapse white-normal   "
                                    data-toggle="collapse" data-target="#collapse-programRec-0" aria-expanded="true"
                                    aria-controls="collapse-programRec-0">

                                    @lang('labels.frontend.course.programRec')

                                </a>
                            </h5>
                        </div>

                        <div id="collapse-programRec-0"
                            class="course-sidebar collapsed collapsed collapse {{ $mainLesson ? (in_array($mainLesson->id, $programRecIds) && $mainLesson->form_type == 'program_recommendation' ? 'in' : '') : '' }} "
                            aria-labelledby="headingOne" data-parent="#accordion">
                            <div class="card-body">
                                @foreach ($programRecommendations as $item)
                                    <div class=" mb-7 d-flex chapter-lesson hover-zoom course-sidebar"
                                        style="{{ $mainLesson ? ($item->id == $mainLesson->id && $mainLesson->form_type == 'program_recommendation' ? 'background-color:aliceblue;' : '') : '' }}">
                                        <i class=" mb-14 fa fa-graduation-cap chapter-lesson-icon "></i>
                                        <a
                                            href="{{ route('courses.programRecommendations', ['id' => $item->id, 'course_id' => $course->id,'course_location_id'=>$course_location_id]) }}">
                                            <p class="display-content">
                                                {{                                             session('locale') == 'ar' ? $item->title_ar ?? $item->title : $item->title }}

                                            </p>
                                        </a>

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
    <div class="card-header" id="headingOne">
        <h5 class="mb-0" >
            <a id="invite_friends" style="    background-color: #4f198d;color:white; " class="btn btn-chapter-collapse2 white-normal list-group-item list-group-item-action list-group-item-light p-3 "
             href="{{route('courses.inviteFriends',['course_id'=>$course->id,'course_location_id'=>$course_location_id])}}">
                @lang('labels.frontend.course.inviteFrindes')
            </a>
        </h5>
    </div>
</div>
