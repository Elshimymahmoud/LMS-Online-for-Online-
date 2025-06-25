
@php
   $currentPage=request()->segment(count(request()->segments())); 
  
    $lessonCourse = $course;
    $mainLesson = $lesson ?? [];
@endphp
<style>
    .two-card{
        display: flex;
        justify-content: space-between;
        align-items: start;
    }
    .two-card .card-header{
        width: 50%
    }
    .card-header.bb{
        width: 20% !important;
    }
    .card-header.bbbb{

    }
</style>
<div class="border-end bg-white" id="sidebar-wrapper">

    <div class="list-group list-group-flush course-sidebar">

        <div id="accordion" class="curriclum-content">
            <div class="card two-card">

                <div class="card-header bbbb" id="headingOne">
                    <h5 class="mb-0">
{{--                        <a class="active btn btn-chapter-collapse2  white-normal list-group-item list-group-item-action list-group-item-light p-3 "--}}
{{--                            href="{{ route('courses.show', ['course' => $course->slug]) }}">--}}
{{--                            @lang('labels.frontend.course.home')--}}
{{--                        </a>--}}
                        <a class="active btn btn-chapter-collapse2  white-normal list-group-item list-group-item-action list-group-item-light p-3 "
                           href="{{ route('courses.show', ['course' => $course->slug]) }}">
                            <img src="{{ $group->image ? asset('storage/uploads/' . $group->image) : ($course->course_image ? asset('storage/uploads/' . $course->course_image) :  asset('iv' . '/images/courses/1.jpg')) }}" alt="{{ $group->title }}" style="width:100%;height:20px;object-fit:contain">
                        </a>
                    </h5>
                </div>
                <div class="card-header" id="headingOne">
                    <h5 class="mb-0">
                        <a class="active list-group-item btn btn-chapter-collapse2  white-normal "
                            data-toggle="collapse" data-target="#lessons-collapse" aria-expanded="true"
                            aria-controls="blogs-collapse">
                            @lang('menus.backend.sidebar.courses.circulum')
                        </a>
                    </h5>
                </div>

           

{{--                                            --}}{{-- chapter blogs --}}
{{--                                            --}}{{-- TODO: trace and make relation between blogs/disccusions and groups --}}
{{--                                            @if (count($chapter->blogs()->get()) > 0)--}}
{{--                                                --}}{{----}}{{-- chapter blogs --}}
{{--                                                @php--}}
{{--                                                    $chapterLocBlogs=$chapter->blogs()->whereHas('courseLocations', function($query) use($course_location_id) {--}}
{{--                                                    $query->where('course_location_id', '=', $course_location_id)--}}
{{--                                                    ->where('model_type', '=', 'App\Models\Blog');--}}
{{--                                                })->pluck('id');--}}
{{--                                                @endphp--}}
{{--                                                 @if(count($chapterLocBlogs)>0)--}}
{{--                                                    <div id="accordion" class="curriclum-content lesson-cards">--}}
{{--    --}}
{{--    --}}
{{--                                                        <div class="">--}}
{{--                                                            <div class="card-header" id="headingOne">--}}
{{--                                                                <h5 class="mb-0">--}}
{{--                                                                    <a class=" active list-group-item btn btn-chapter-collapse"--}}
{{--                                                                        data-toggle="collapse"--}}
{{--                                                                        data-target="#collapse-blog-chapter-0" aria-expanded="true"--}}
{{--                                                                        aria-controls="collapse-blog-0">--}}
{{--    --}}
{{--                                                                        @lang('labels.frontend.course.blog')--}}
{{--    --}}
{{--                                                                    </a>--}}
{{--                                                                </h5>--}}
{{--                                                            </div>--}}
{{--    --}}
{{--                                                            <div id="collapse-blog-chapter-0"--}}
{{--                                                                class="course-sidebar collapsed collapsed collapse {{ $mainLesson ? (in_array($mainLesson->slug, $slugs) && get_class($mainLesson) == 'App\Models\Blog' ? 'in' : '') : '' }} "--}}
{{--                                                                aria-labelledby="headingOne" data-parent="#accordion">--}}
{{--                                                                <div class="card-body">--}}
{{--                                                                    @foreach ($chapter->blogs()->get() as $chapterBlog)--}}
{{--                                                                   @if(in_array($chapterBlog->id,$chapterLocBlogs->toArray()))--}}
{{--    --}}
{{--                                                                        <div class=" mb-7 d-flex chapter-lesson hover-zoom course-sidebar"--}}
{{--                                                                            style="{{ $mainLesson ? ($chapterBlog->slug == $mainLesson->slug ? 'background-color:aliceblue;' : '') : '' }}">--}}
{{--                                                                            <i--}}
{{--                                                                                class=" mb-14 fa fa-graduation-cap chapter-lesson-icon "></i>--}}
{{--                                                                            <a--}}
{{--                                                                                href="{{ route('courses.blogs', ['slug' => $chapterBlog->slug, 'course_id' => $course->id,'course_location_id'=>$course_location_id]) }}">--}}
{{--                                                                                <p class="display-content">--}}
{{--                                                                                    {{                                                                         session('locale') == 'ar' ? $chapterBlog->title_ar ?? $chapterBlog->title : $chapterBlog->title }}--}}
{{--    --}}
{{--                                                                                </p>--}}
{{--                                                                            </a>--}}
{{--    --}}
{{--                                                                        </div>--}}
{{--                                                                        @endif--}}
{{--                                                                    @endforeach--}}
{{--    --}}
{{--    --}}
{{--    --}}
{{--                                                                </div>--}}
{{--                                                            </div>--}}
{{--                                                        </div>--}}
{{--    --}}
{{--    --}}
{{--    --}}
{{--    --}}
{{--    --}}
{{--                                                    </div>--}}
{{--                                                @endif--}}
{{--                                                --}}{{----}}{{-- chapter blogs --}}
{{--                                            @endif--}}
{{--                                        </div>--}}



                </div>
                <div id="lessons-collapse" class="collapse @if(isset($show_course_lesson)) in @endif" aria-labelledby="headingOne" data-parent="#accordion">

                    <div id="accordion" class="curriclum-content lesson-cards">
                        @if($course->type_id == 1)
                            @foreach ($lessonCourse->chapters()->orderBy('sequence', 'asc')->get() as $key => $chapter)
                                @if(count($chapter->lessons)>0)
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
                                            $testsSlug = array_column($chapter->tests->where('published', 1)->toArray
                                            (), 'slug');

                                            $slugs = array_merge($slugs, $testsSlug);
                                        @endphp

                                        <div id="collapse-{{ $key }}"
                                             class="course-sidebar collapsed collapsed collapse {{ $mainLesson ? (in_array($mainLesson->slug, $slugs) ? 'in' : '') : '' }} "
                                             aria-labelledby="headingTwo" data-parent="#accordion">
                                           
                                        </div>
                                    </div>

                                @endif
                            @endforeach
                        @else
                            <div>
                                @php
                                    $mainLesson != [] ? ($slugs = array_column($lessonCourse->lessons->where('published', 1)->toArray(), 'slug')) : ($slugs = []);
                                @endphp

                                <div class="active course-sidebar">
                                    <div class="card-body">
                                        @php
                                            // Get all GroupTimeline items for the specified group_id, sorted by sequence
                                            $groupTimelines = \App\Models\GroupTimeline::where('group_id', $group->id)
                                                ->whereIn('model_type', ['App\Models\Lesson', 'App\Models\CourseGroupTest'])
                                                ->orderBy('sequence')->get();

                                            // Initialize an empty collection to hold the sorted items
                                            $sortedItems = collect();
                                            // Foreach GroupTimeline item...
                                            foreach ($groupTimelines as $groupTimeline) {
                                                // Get the related Lesson or Test item
                                                $relatedItem = $groupTimeline->model;
                                                // Add the related item to the sorted items collection
                                                $sortedItems->push($groupTimeline);
                                            }
                                        @endphp

                                        @foreach ($sortedItems as $item)
                                            @if($item->model_type == 'App\Models\Lesson')
                                                @foreach($lessonCourse->lessons as $lesson)
                                                    @if($item->model->id == $lesson->id)
                                                        <!-- Display the lessons here -->
                                                        <div class=" mb-7 d-flex chapter-lesson hover-zoom course-sidebar "
                                                             style="{{ $mainLesson ? ($item->model->id == $mainLesson->id ? 'background-color:#ebcdd4;' : '') : '' }}">
                                                            {{--                                                                @dd($lesson)--}}
                                                            <a class="btn-video-collapse"
                                                               data-toggle="collapse"
                                                               data-target="#collapse-video-{{ $lesson->id }}"
                                                               aria-expanded="true"
                                                               aria-controls="collapse-video-{{ $lesson->id }}" >
                                                                @php
                                                                    $lesson_time = $group->courseLessons()->where('lesson_id', $lesson->id)->first();
                                                                    $dateTime = new \DateTime($lesson_time->pivot->start_time);
                                                                @endphp
                                                                <p class="display-content">
                                                                    {{ (session('locale') == 'ar' ?
                                                                    $lesson->title_ar : $lesson->title) }}
                                                                    @if($lesson_time && $course->type_id != 1)
                                                                        <span class="badge badge-secondary">
                                                                    {{ $lesson_time->pivot->date.' ('.$dateTime->format('h:i A') }})
                                                                </span>
                                                                    @endif
                                                                </p>

                                                            </a>

                                                        </div>
                                                    @endif
                                                @endforeach

                                            @elseif($item->model_type == 'App\Models\CourseGroupTest')
                                                @foreach($course_tests as $test)
                                                    @if($item->model->id == $test->id)
                                                        <!-- Display the lessons here -->
                                                        <div class=" mb-7 d-flex chapter-lesson hover-zoom
                                                            course-sidebar "
                                                             style="{{ $mainLesson ? ($item->model->id == $mainLesson->id ? 'background-color:#ebcdd4;' : '') : '' }}">
                                                            @php
                                                                $solved = $test->studentResults(auth()->id(), $group->id)->latest()->first() ? 'true' : 'false';
                                                            @endphp
                                                            <a class="btn-test-collapse"
                                                               data-toggle="collapse"
                                                               data-target="#collapse-test-{{ $test->id }}"
                                                               aria-expanded="true"
                                                               aria-controls="collapse-test-{{ $test->id }}"
                                                               data-solved="{{ $solved }}">

                                                                <p class="display-content">
                                                                    {{ session('locale') == 'ar' ? $test->title_ar : $test->title }}
                                                                </p>
                                                            </a>
                                                        </div>
                                                    @endif
                                                @endforeach
                                            @endif
                                        @endforeach

                                        @foreach ($lessonCourse->lessons as $lesson)
                                            @if(!$sortedItems->contains('model_id', $lesson->id))
                                                <div class=" mb-7 d-flex chapter-lesson hover-zoom course-sidebar "
                                                     style="background-color:#ebcdd4">
                                                    <a class="btn-video-collapse"
                                                       data-toggle="collapse"
                                                       data-target="#collapse-video-{{ $lesson->id }}"
                                                       aria-expanded="true"
                                                       aria-controls="collapse-video-{{ $lesson->id }}" >

                                                        @php
                                                            $lesson_time = $group->courseLessons()->where('lesson_id', $lesson->id)->first();
                                                            $dateTime = new \DateTime($lesson_time->pivot->start_time);
                                                        @endphp
                                                        <p class="display-content">
                                                            {{ (session('locale') == 'ar' ?
                                                            $lesson->title_ar : $lesson->title) }}
                                                            @if($lesson_time && $course->type_id != 1)
                                                                <span class="badge badge-secondary">
                                                                    {{ $lesson_time->pivot->date.' ('.$dateTime->format('h:i A') }})
                                                                </span>
                                                            @endif
                                                        </p>

                                                    </a>

                                                </div>
                                            @endif
                                        @endforeach

                                    </div>
                                </div>
                            </div>
                        @endif

                    </div>
            </div>
        </div>
        {{-- ====New Design --}}
        {{-- if course is direct course type (id==>3) show rates button --}}
        {{-- @if ($lessonCourse->type_id == 3) --}}
        <div id="" class="curriclum-content lesson-cards">

            <div class="">

                    <div class="card-header" id="headingOne">
                        <h5 class="mb-0" >
                            <a class="active btn btn-chapter-collapse2 btn-right-collapse-2 white-normal list-group-item list-group-item-action list-group-item-light p-3" href="#" id="anchor1">
                                @lang('labels.frontend.blog.title')
                            </a>
                        </h5>
                    </div>




            </div>

        </div>

        @if (count($impactMeasurments) > 0||count($programRecommendations) > 0)
        <div class="card-header" id="headingTwo">
            <h5 class="mb-0">
                <a class="  active list-group-item btn btn-chapter-collapse2 btn-right-collapse-2 white-normal collapsed"
                    data-toggle="collapse" data-target="#lessonss-collapse" aria-expanded="true"
                    aria-controls="blogs-collapse">
                    @lang('menus.backend.sidebar.forms.title')
                </a>
            </h5>
        </div>
        @endif

        <div id="lessonss-collapse" class="collapse" aria-labelledby="headingOne" data-parent="#accordion">

            @if (count($impactMeasurments) > 0)

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
                                        <a class="btn-impact-collapse"
                                           data-toggle="collapse"
                                           data-target="#collapse-impact-{{ $item->id }}" aria-expanded="true"
                                           aria-controls="collapse-impact-{{ $item->id }}"
                                           style="display: flex; width:100%"
                                        >
                                            <i class=" mb-14 fa fa-graduation-cap chapter-lesson-icon "></i>
                                            <p class="display-content">
                                                {{ session('locale') == 'ar' ? $item->impact_ar ?? $item->impact_ar : $item->impact }}
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
{{--                                @foreach ($programRecommendations as $item)--}}
{{--                                    <div class=" mb-7 d-flex chapter-lesson hover-zoom course-sidebar"--}}
{{--                                        style="{{ $mainLesson ? ($item->id == $mainLesson->id && $mainLesson->form_type == 'program_recommendation' ? 'background-color:aliceblue;' : '') : '' }}">--}}
{{--                                        <i class=" mb-14 fa fa-graduation-cap chapter-lesson-icon "></i>--}}
{{--                                        <a--}}
{{--                                            href="{{ route('courses.programRecommendations', ['id' => $item->id,--}}
{{--                                            'course_id' => $course->id,'group'=>$group->id]) }}">--}}
{{--                                            <p class="display-content">--}}
{{--                                                {{                                             session('locale') == 'ar' ? $item->title_ar ?? $item->title : $item->title }}--}}

{{--                                            </p>--}}
{{--                                        </a>--}}

{{--                                    </div>--}}
{{--                                @endforeach--}}
                                @foreach ($programRecommendations as $item)

                                    <div class=" mb-7 d-flex chapter-lesson hover-zoom course-sidebar"
                                         style="{{ $mainLesson ? ($item->id == $mainLesson->id && $mainLesson->form_type == 'program_recommendation' ? 'background-color:aliceblue;' : '') : '' }}">
                                        <a class="btn-impact-collapse"
                                           data-toggle="collapse"
                                           data-target="#collapse-rec-{{ $item->id }}" aria-expanded="true"
                                           aria-controls="collapse-rec-{{ $item->id }}"
                                           style="display: flex; width:100%"
                                        >
                                            <i class=" mb-14 fa fa-graduation-cap chapter-lesson-icon "></i>
                                            <p class="display-content">
                                                {{ session('locale') == 'ar' ? $item->recommendation_ar ?? $item->recommendationt_ar : $item->recommendation }}
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

                <div class="card-header" id="headingOne">
                    <h5 class="mb-0" >
                        <a class="active btn btn-chapter-collapse2 btn-right-collapse-2 white-normal list-group-item list-group-item-action list-group-item-light p-3" href="#" id="anchor2">
                            @lang('labels.frontend.rates.title')
                        </a>
                    </h5>
                </div>

        </div>

        @if (count($activity) > 0)
        <div class="card-header bb" id="headingOne">
            <h5 class="mb-0">
                <a class="active list-group-item btn btn-chapter-collapse2  white-normal "
                   data-toggle="collapse" data-target="#activity-collapse" aria-expanded="true"
                   aria-controls="activity-collapse">
                    @lang('menus.backend.sidebar.activity.title')
                </a>
            </h5>
        </div>
        <div id="activity-collapse" class="collapse "
             aria-labelledby="headingOne" data-parent="#accordion">

            <div id="accordion" class="curriclum-content lesson-cards">
                @foreach ($activity as $key => $act)
                        <div class="">
                            <div class="card-body">
                                    <div class="mb-7 d-flex chapter-lesson hover-zoom course-sidebar"
                                         style="">
                                        <a class="btn-activity-collapse"
                                           data-toggle="collapse"
                                           data-target="#collapse-activity-{{ $act->id }}" aria-expanded="true"
                                           aria-controls="collapse-activity-{{ $act->id }}"
                                           style="display: flex; width:100%"
                                        >
                                            <i class="mb-14 fa fa-graduation-cap chapter-lesson-icon "></i>
                                            <p class="display-content">
                                                {{  session('locale') == 'ar' ? $act->title_ar ?? $act->title : $act->title }}
                                            </p>
                                        </a>

                                    </div>
                            </div>
                        </div>
                @endforeach
            </div>

        </div>
        @endif
    </div>
    <div class="card-header" id="headingOne">
        <h5 class="mb-0" >
            <a id="invite_friends" style="    background-color: #4f198d;color:white; " class="btn btn-chapter-collapse2 btn-right-collapse-2 white-normal list-group-item list-group-item-action list-group-item-light p-3 "
             href="{{route('courses.inviteFriends',['course_id'=>$course->id,'group'=>$group->id])}}">
                @lang('labels.frontend.course.inviteFrindes')
            </a>
        </h5>
    </div>
</div>
