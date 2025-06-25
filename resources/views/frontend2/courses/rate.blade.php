@extends('frontend.layouts.courses')
{{-- @extends('frontend.layouts.app'.config('theme_layout')) --}}

@push('after-styles')
    {{-- <link rel="stylesheet" href="{{asset('plugins/YouTube-iFrame-API-Wrapper/css/main.css')}}"> --}}
    <link rel="stylesheet" href="https://cdn.plyr.io/3.5.3/plyr.css" />

    
    <style>
        .cicuclum_title {
            border-bottom: 1px gray solid;
            font-size: 18px !important;
            color: #802d42 !important;
            font-weight: 700 !important;
        }

        .cicuclum_li {
            border-bottom: 1px gray solid;

        }
        .complete-btn{
            background-color: #802d42;
            color: white;
            padding: 10px;
            border-radius: 10px;
        }

    </style>

<link href="{{ asset('assets/rating/themes/krajee-svg/theme.css') }}" media="all" rel="stylesheet" type="text/css" />
<link href="{{ asset('assets/rating/css/star-rating.css') }}" media="all" rel="stylesheet" type="text/css" />
<style>
    .rating-container .star {
     display: unset;}
</style>
@endpush

@section('content')




    <!-- Start of course details section
                ============================================= -->
    <section id="course-details" class="course-details-section">
        <div class="container ">
            <div class="row main-content">
                <div class="col-md-12">
                    @if (session()->has('success'))
                        <div class="alert alert-dismissable alert-success fade show">
                            <button type="button" class="close" data-dismiss="alert">&times;</button>
                            {{ session('success') }}
                        </div>
                    @endif

                    <div class="course-details-item border-bottom-0 mb-0">




                        <div class="rates content">
                            {{ html()->form('POST', route('admin.answerEvaluate.store'))->id('rate-create')->class('form-horizontal')->acceptsFiles()->open() }}

                            <div id="accordion">

                                @foreach ($rates as $rate)
                                    <input type="hidden" name="rate_ids[]" value="{{ $rate->id }}">
                                    <input type="hidden" name="course_id" value="{{ $course->id }}">
                                    @php
                                    $quest_count = 0;
                                   
                                    $userAnswers = $rate->getUserRate(null,$course->id);
                                    
                                    $test_result = App\Models\Result::where('course_forms_id', $rate->course()->first()->pivot->id)
                                                    ->where('user_id', \Auth::id())
                                                    ->first();
                                @endphp
                                    <div class="card0">
                                        <div class="card-header0" id="heading{{ $rate->id }}">
                                            <h5 class="mb-0 card-body">
                                                {{-- <button class="btn btn-link" data-toggle="collapse" data-target="#collapse{{$rate->id}}" aria-expanded="true" aria-controls="collapseOne"> --}}
                                                @if (Lang::locale() == 'en')
                                                    {{ $rate->title }}
                                                    @lang('labels.backend.rates.rate')

                                                @else
                                                    @lang('labels.backend.rates.rate')
                                                    {{ $rate->title_ar }}

                                                @endif



                                            </h5>

                                            {{-- <h5 class="mb-0">
                                                <button class="btn btn-link" data-toggle="collapse" data-target="#collapse{{$rate->id}}" aria-expanded="true"  aria-controls="collapseOne"></button>
                                            </h5> --}}
                                        </div>
                                       

                                        <div id="collapse{{ $rate->id }}" class=" show"
                                            aria-labelledby="headingOne" data-parent="#accordion">
                                            <div class="card-body">
                                               
                                                <ol type="A">
                                                @foreach ($rate->questions as $Mainkey => $question)
                                                    @php
                                                        $quest_count++;
                                                        
                                                    @endphp

                                                    <input type="hidden" name="rateQuestions[]"
                                                        value="{{ $question->id }}">
                                                    <li>
                                                        <p>
                                                            @if (Lang::locale() == 'en')
                                                                {{ $question->question }}
                                                            @else
                                                                {{ $question->question_ar ? $question->question_ar : $question->question }}
                                                        
                                                            @endif
                                                        </p>


                                                        @if ($question->question_type == 'radio')

                                                            <div style="direction: ltr;display: inline-block;width: 100%">
                                                                <input name="{{ $question->id }}-options" id="kartik" class="rating" data-stars="5" data-step="0.1" title="" data-rtl=1 />
                                                            </div>


                                                        @else

                                                            {{-- <textarea name="{{ $question->id }}-options" id="" cols="50"
                                                                rows="2"></textarea> --}}
                                                       
                                                                <br />
                                                                <ul class="options-list pl-4">


                                                                    @if (sizeof($question->options) && $question->question_type=="multiple_choice")
                                                                        @foreach ($question->options as $option)
                        
                                                                        <div class="radio">
                                                                            <label>
                                                                                <input type="radio" name="{{ $question->id }}-options"
                                                                                    value="{{ $option->id }}" />
                                                                                    {{Lang::locale() == 'en'? $option->option_text: $option->option_text_ar}}<br />
                                                                                    <br />
                                                                            </label>
                                                                        </div>
                                                                        @endforeach
                                                                    @elseif (sizeof($question->options) && $question->question_type=="drop_down")
                                                                        <select  name="{{ $question->id }}-options"    class="form-control">
                                                                        @foreach ($question->options as $option)
                                                                            <option @if (($option->answered(@$test_result->id) != null && $option->answered(@$test_result->id) == 1) || $option->correct == true)  selected @endif value="{{ $option->id }}" >
                                                                                {{Lang::locale() == 'en'? $option->option_text: $option->option_text_ar}}<br />

                                                                            </option>
                                                                        @endforeach
                                                                        </select>
                                                                    @else
                                                                        @switch($question->question_type)
                                                                                @case("paragraph")
                                                                                <textarea type="text" class="form-control editor"   placeholder="paragraph" style="height:100px" name="{{ $question->id }}-options">{{ @test_res($test_result->id, $question->id)->option_id }}</textarea>
                                                                                @break
                                                                                @case("short_answer")
                                                                                <input type="text" class="form-control" value="{{ @test_res($test_result->id, $question->id)->option_id }}" placeholder="short_answer" name="{{ $question->id }}-options" />
                                                                                @break
                                                                                @case("date")
                                                                                <input type="text" class="form-control datepicker" value="{{ @test_res($test_result->id, $question->id)->option_id }}" placeholder="date" name="{{ $question->id }}-options" />
                                                                                @break
                                                                                @case("time")
                                                                                <input type="text" class="form-control timepicker" value="{{ @test_res($test_result->id, $question->id)->option_id }}"  placeholder="time" name="{{ $question->id }}-options" />
                                                                                @break
                                                                                @case("file_upload")
                                                                                <div style="margin-top: 20px">
                                                                                    <label> @lang('labels.frontend.course.or_upload')</label>
                                                                                    <input type="file" name="answer_file_{{ $question->id }}">
                                                                                    <p>{!! get_test_file(auth()->id(), $question->id) !!} </p>
                                                                                </div>
                                                                                @break
                                                                        @endswitch
                                                                    @endif                                                       
                                                                    </ul>
                                                                    <br />
                                                        @endif
                                                  
                                                    </li>
                                                @endforeach
                                                </ol>
                                            </div>
                                        </div>
                                    </div>
                                    <hr>
                                @endforeach
                                @if (count($rates) > 0)
                                    @if (count($userAnswers) == 0)
                                        <div class="form-group row justify-content-center"
                                            style="margin-top: 20px;margin-left: 16%;">
                                            <div class="col-4">
                                                <button class="btn btn-success" style="background-color: ##3bcfcb;"
                                                    type="submit">{{ __('buttons.general.crud.create') }}</button>
                                            </div>
                                        </div>
                                        <!--col-->
                                    @endif
                                @else
                                    <div class="form-group row">
                                        <div class="col-12" style="text-align: center">
                                            <h3>@lang('labels.general.no_data_available')</h3>
                                        </div>
                                    </div>
                                @endif
                            </div>

                            {{ html()->form()->close() }}

                        </div>









                    </div>
                    <!-- /course-details -->

                    <!-- /market guide -->

                    <!-- /review overview -->
                </div>
                <div class="col-md-4 offset-4" style="margin-top: 74px;">
                                   
                    @if ($course->progress() >= 100)
                        @if (!$course->isUserCertified())
                            <form method="post" action="{{ route('admin.certificates.generate') }}">
                                @csrf
                                <input type="hidden" value="{{ $course->id }}" name="course_id">
                                <button id="finish" class="next-button complete-btn"
                                    @if (!$rates[0]->isCompleted()) onclick='courseCompleted("{{ $rates[0]->id }}", "{{ get_class($rates[0]) }}")' @endif role="button">
                                    <span>@lang('labels.frontend.course.finish_course') </span>
                                    <div class="icon">
                                        <i class="fa fa-check-circle"></i>
                                        <i class="fa fa-check"></i>
                                    </div>
                                </button>


                            </form>
                            {{-- @else
                       
                            <div class="alert alert-success">
                                @lang('labels.frontend.course.certified')
                            </div> --}}
                        @endif
                    @endif
                </div>

            </div>
        </div>
    </section>
    <!-- End of course details section
            ============================================= -->

@endsection


@section('sidebar')
    @inject('request', 'Illuminate\Http\Request')

    <div class="sidebar">
        <nav class="sidebar-nav">



            <ul class="nav" style="    margin-top: 37px;">
                <li class="nav-title cicuclum_title">
                    @lang('menus.backend.sidebar.courses.circulum')
                </li>


                @foreach ($course->chapter()->get() as $key => $item)
                    <li
                        class="nav-item nav-dropdown cicuclum_li {{ active_class(Active::checkUriPattern(['user/courses*', 'user/lessons*', 'user/tests*', 'user/questions*']), 'open') }}">
                        <a class="nav-link nav-dropdown-toggle {{ active_class(Active::checkUriPattern('admin/*')) }}"
                            href="#">

                            <i class="nav-icon icon-puzzle"></i> @if (session('locale') == 'ar') {{ $item->title_ar ?? $item->title }} @else {{ $item->title ?? $item->title_ar }} @endif

                        </a>

                        <ul class="nav-dropdown-items">
                            @foreach ($item->lessons as $lesson_key => $lesson_item)

                                <li class="nav-item ">
                                    <a class="nav-link {{ $request->segment(2) == 'courses' ? 'active' : '' }}"
                                        @if (in_array($lesson_item->id, $completed_lessons))href="{{ route('lessons.show', ['id' => $lesson_item->course->id, 'slug' => $lesson_item->slug]) }}"@endif>

                                        <span class="title text-color"> @if (session('locale') == 'ar') {{ $lesson_item->title_ar ?? $lesson_item->title }} @else {{ $lesson_item->title ?? $lesson_item->title_ar }}  @endif</span>

                                    </a>
                                </li>
                            @endforeach

                            @foreach ($item->test as $lesson_key => $lesson_item)


                                <li class="nav-item ">
                                    <a class="nav-link {{ $request->segment(2) == 'courses' ? 'active' : '' }}"
                                        @if (in_array($lesson_item->id, $completed_lessons))href="{{ route('lessons.show', ['id' => $course_id, 'slug' => $lesson_item->slug]) }}"@endif>

                                        <span class="title text-color"> @if (session('locale') == 'ar') {{ $lesson_item->title_ar ?? $lesson_item->title }} @else {{ $lesson_item->title ?? $lesson_item->title_ar }}  @endif</span>

                                    </a>
                                </li>
                            @endforeach

                        </ul>
                    </li>
                @endforeach

                @if (count($blogs) > 0)
                    <li class="nav-item" style="background: #f9a19c">
                        <a class="nav-link " href="#">@lang('labels.frontend.course.blog')</a>
                    </li>
                    @foreach ($blogs as $item)
                        <li class="nav-item">
                            <a class="nav-link "
                                href="{{ route('courses.blogs', ['slug' => $item->slug, 'course_id' => $course->id]) }}">{{ $item->title }}</a>
                        </li>
                    @endforeach
                @endif
                @if (count($impactMeasurments) > 0)

                    <li style="background: #e4e5e6;margin-top: 20px"
                        class="nav-item nav-dropdown list-unstyled cicuclum_li {{ active_class(Active::checkUriPattern(['user/courses*', 'user/lessons*', 'user/tests*', 'user/questions*']), 'open') }}">
                        <a class="nav-link nav-dropdown-toggle {{ active_class(Active::checkUriPattern('admin/*')) }}"
                            href="#">

                            <i class="nav-icon icon-puzzle"></i> @lang('labels.frontend.course.impact')

                        </a>
                        @foreach ($impactMeasurments as $item)

                            <ul class="nav-dropdown-items">
                                <li>
                                    <a class="nav-link "
                                        href="{{ route('courses.impacts', ['id' => $item->id, 'course_id' => $course->id]) }}">@if (Lang::locale() == 'en'){{ $item->name ? $item->name : $item->name_ar }}@else {{ $item->name_ar ? $item->name_ar : $item->name }} @endif</a>
                                </li>
                            </ul>
                        @endforeach
                    </li>
                @endif
                @if (count($programRecommendations) > 0)

                    <li style="background: #e4e5e6;margin-top: 20px"
                        class="nav-item nav-dropdown list-unstyled cicuclum_li {{ active_class(Active::checkUriPattern(['user/courses*', 'user/lessons*', 'user/tests*', 'user/questions*']), 'open') }}">
                        <a class="nav-link nav-dropdown-toggle {{ active_class(Active::checkUriPattern('admin/*')) }}"
                            href="#">

                            <i class="nav-icon icon-puzzle"></i> @lang('labels.frontend.course.programRec')

                        </a>
                        @foreach ($programRecommendations as $item)

                            <ul class="nav-dropdown-items">
                                <li>
                                    <a class="nav-link "
                                        href="{{ route('courses.programRecommendations', ['id' => $item->id, 'course_id' => $course->id]) }}">@if (Lang::locale() == 'en'){{ $item->name ? $item->name : $item->name_ar }}@else {{ $item->name_ar ? $item->name_ar : $item->name }} @endif</a>
                                </li>
                            </ul>
                        @endforeach
                    </li>
                @endif
                <li style="margin-bottom: 50px"></li>
            </ul>
        </nav>
        <span class="float-none">@lang('labels.frontend.course.course_timeline')</span>
        <div class="couse-feature ul-li-block">
            <ul>
                <li>@lang('labels.frontend.course.chapters')
                    <span> {{ $course->chapterCount() }} </span>
                </li>
                <li>@lang('labels.frontend.course.category') <span><a
                            href="{{ route('courses.category', ['category' => $course->category->slug]) }}"
                            target="_blank">{{ $course->category->name }}</a> </span></li>
                <li>@lang('labels.frontend.course.author') <span>

                        @foreach ($course->teachers as $key => $teacher)
                            @php $key++ @endphp
                            <a href="{{ route('teachers.show', ['id' => $teacher->id]) }}" target="_blank">
                                {{ $teacher->full_name }}@if ($key < count($course->teachers)), @endif
                            </a>
                        @endforeach
                    </span>
                </li>
                <li>@lang('labels.frontend.course.progress') <span> <b>
                            {{ $course->progress() }}
                            % @lang('labels.frontend.course.completed')</b></span></li>
            </ul>

        </div>
        <button class="sidebar-minimizer brand-minimizer" type="button"></button>
    </div>
    <!--sidebar-->
@endsection
@push('after-scripts')

    <script src="{{ asset('plugins/touchpdf-master/jquery.mousewheel.js') }}"></script>
    <script src="https://cdn.jsdelivr.net/npm/js-cookie@2/src/js.cookie.min.js"></script>

    <script src="https://cdn.plyr.io/3.5.3/plyr.polyfilled.js"></script>
    <script src="{{asset('assets/rating/js/star-rating.js')}}"></script>
    <script>
        $(document).on('change', 'input[name="stars"]', function() {
            $('#rating').val($(this).val());
        })

        @if (isset($review))
            var rating = "{{ $review->rating }}";
            $('input[value="' + rating + '"]').prop("checked", true);
            $('#rating').val(rating);
        @endif

        function courseCompleted(id, type) {
            $.ajax({
                url: "{{ route('update.course.progress') }}",
                method: "POST",
                data: {
                    "_token": "{{ csrf_token() }}",
                    'model_id': parseInt(id),
                    'model_type': type,
                },
                success: function(data) {
                    alert("@lang('labels.frontend.course.completed_message')");
                    $(".complete-btn").hide();
                }
            });
        }
    </script>
@endpush
