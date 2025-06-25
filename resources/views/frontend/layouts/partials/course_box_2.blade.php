{{-- @dd(asset('public/').'uploads/'.$course->course_image) --}}
<style>
      .tabs-details .tabs {
            display: flex;
            cursor: pointer;
            margin-bottom: 20px;
            justify-content: center;
            flex-wrap: wrap;
        }
        .tabs-details .tab {
            padding: 10px 20px;
            background-color: #f1f1f1;
            border: 1px solid #ccc;
            margin-right: 5px;
            font-size: 20px;
          
            margin: 5px;
            border-radius: 6px;
          
        }
        .tabs-details .tab.active {
            background-color: #4f198d;
            border-bottom: none;
            color: #fff;
            box-shadow: rgba(0, 0, 0, 0.24) 0px 3px 8px;
        }
        .tabs-details .tab-content {
            display: none;
            padding: 20px;
            border: 1px solid #ccc;
            background-color: #f9f9f9;
            border-radius: 10px;
        }
        .tabs-details .tab-content.active {
            display: block;
        }
</style>
<div class="tabs-details">
    <h3>تفاصيل الدورة</h3>
    <div class="tabs">
        <div class="tab active" data-tab="1"> أهداف الدورة</div>
        <div class="tab" data-tab="7"> المجموعات</div>

        <div class="tab" data-tab="2">الفئة المستهدفة</div>
        <div class="tab" data-tab="3">محاور الدورة</div>
        <div class="tab" data-tab="4"> المدربون</div>
        <div class="tab" data-tab="5">محتويات الدورة</div>
        <div class="tab" data-tab="6">بوايات الدفع</div>
    </div>

    <div id="tab-content-1" class="tab-content active">
    </div>
    <div id="tab-content-2" class="tab-content">
    </div>
</div>









<div class="product-div" style="    height: 550px;">
    <div class="row m0 featured-img">
        <img style="width: 100%;height:200px"
            @if ($course->course_image != '' && file_exists('storage/uploads/' . $course->course_image)) src="{{ asset('storage/uploads/' . $course->course_image) }}" @else  src="{{ asset('images/course-default.jpeg') }}" @endif
            alt="" />
        {{-- <img  @if ($course->course_image != '' && file_exists('storage/uploads/' . $course->course_image)) src="{{ resize('uploads/'.$course->course_image,300,200)}}" @else  src="{{asset('images/course-default.jpeg')}}"   @endif  alt="" /> --}}


    </div>
    @php
        $lessonOfFirstLocationNum = 0;
        if (count($course->locations) > 0) {
            $last = $course->locations[0];
            
            $lessonOfFirstLocationNum=DB::table('lesson_course_location')->where('course_location_id',$last->pivot->id)->where('model_type','App\Models\Lesson')->whereIn('model_id',$course->courseTimeline->pluck('model_id')->toArray())->count();
           
            // foreach ($course->courseTimeline as $item) {
            //     if ($item->model_type == 'App\Models\Lesson') {
            //         $lessonOfFirstLocation = $item->model
            //             ? $item->model
            //                 ->whereHas('courseLocations', function ($qq) use ($last) {
            //                     $qq->where('lesson_course_location.course_location_id', $last->pivot->id)->where('lesson_course_location.model_type', 'App\Models\Lesson');
            //                 })
            //                 ->get()
            //                 ->pluck('id')
            //                 ->toArray()
            //             : [];
            //         $lessonOfFirstLocationNum = count($lessonOfFirstLocation);
            //         break;
            //     }
            // }
        }
        
    @endphp
    <div class="inner-contain text-center">
        <a href="{{ route('courses.category', ['category' => $course->category->slug]) }}">
            <h5 class="category">
                @if (session('locale') == 'ar')
                    {{ $course->category->name_ar }}
                @else
                    {{ $course->category->name }}
                @endif
            </h5>
        </a>
        <a href="{{ route('courses.show', ['course' => $course->slug]) }}">
            <h4 class="title text-color" style="white-space:normal;font: 500 18px/1 'Noto Kufi Arabic', sans-serif;">
                @if (session('locale') == 'ar')
                    {{ $course->title_ar }}
                @else
                    {{ $course->title }}
                @endif
            </h4>
        </a>
        <p class="prod-det">
            @if (session('locale') == 'ar')
                {{ sub($course->description_ar, 0, 120) }}
            @else
                {{ sub($course->description, 0, 120) }}
            @endif
        </p>
        <a href="{{ route('courses.show', ['course' => $course->slug]) }}"
            class=" btn btn-view fw100 mtb-10">@lang('labels.general.more')</a>
        <div class="row">
            <div class="  col-md-6 course-lectures">
                {{-- {{ $course->lessons()->count() }} @lang('labels.frontend.layouts.home.lectures') --}}
                {{ $lessonOfFirstLocationNum }} @lang('labels.frontend.layouts.home.lectures')
                
                
            </div>

            <div class="  col-md-6 course-price">{{ $course->minPricelocation() }}
                @if ($course->minPricelocationCurr() == 'SAR')
                    {{ $course->minPricelocationCurr() }}
                @else
                    $
                @endif
            </div>
        </div>
    </div>
</div>
<script>
       
    const tabs = document.querySelectorAll('.tabs-details .tab');
    const contents = document.querySelectorAll('.tabs-details .tab-content');

    tabs.forEach(tab => {
        tab.addEventListener('click', () => {
           
            tabs.forEach(t => t.classList.remove('active'));
            contents.forEach(c => c.classList.remove('active'));

           
            tab.classList.add('active');
            document.getElementById(`tab-content-${tab.getAttribute('data-tab')}`).classList.add('active');
        });
    });
</script>