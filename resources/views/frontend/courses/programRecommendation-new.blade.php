@extends('frontend.layouts.app'.config('theme_layout'))

@section('title', trans('labels.frontend.home.title') . ' | ' . app_name())
@section('meta_description', '')
@section('meta_keywords', '')


@push('after-styles')
<link rel="stylesheet" href="https://cdn.plyr.io/3.5.3/plyr.css" />
<link href="{{ asset('plugins/touchpdf-master/jquery.touchPDF.css') }}" rel="stylesheet">
<link href="{{ asset('css/buttons.css') }}" rel="stylesheet">



    <link rel="stylesheet" href="{{ asset('iv') }}/css/course_curriculum.css" />
    <style>
         .noData {
        width: 100%;
        height: 500px;
    }
    .white-normal {
    white-space: normal;
    line-height: normal;
}
        .next {
            width: 47%;
            display: flex;
            /* padding: 10px; */
            border: 1px solid #337ab7;
            border-radius: 26px;
            padding: 10px;
        }

        button.next {
            width: 74%;
            color: white;
            background-color: #802c41
        }

        button.retest {
            width: 30%;
            color: white;
            background-color: #802c41;
            display: flex;
            /* padding: 10px; */
            border: 1px solid #337ab7;
            border-radius: 26px;
            padding: 10px;

        }

        .course-details-category {
            display: flex;
            flex-wrap: wrap;
            flex-direction: column;
            align-content: stretch;
        }

        .options-list li.correct {
            color: green;
        }

        .options-list li.incorrect {
            color: red;
        }

        .options-list li.correct:before {
            content: "\f058";
            /* FontAwesome Unicode */
            font-family: 'FontAwesome';
            display: inline-block;
            color: green;
            @if (session('locale') == 'ar')margin-right: -2.3em;
        @else margin-left: -2.3em;
            @endif
            /* same as padding-left set on li */
            width: 1.3em;
            /* same as padding-left set on li */
        }

        .options-list li.incorrect:before {
            content: "\f057";
            /* FontAwesome Unicode */
            font-family: 'FontAwesome';
            display: inline-block;
            color: red;
            @if (session('locale') == 'ar')margin-right: -2.3em;
        @else margin-left: -2.3em;
            @endif
            /* same as padding-left set on li */
            width: 1.3em;
            /* same as padding-left set on li */
        }
        .nested-ul{
            /* border-bottom: 1px solid black; */
    border-radius: 10px;
        }

    </style>
<link rel="stylesheet" href="https://code.jquery.com/ui/1.12.1/themes/base/jquery-ui.css">

    {{-- rate --}}
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

        .complete-btn {
            background-color: #802d42;
            color: white;
            padding: 10px;
            border-radius: 10px;
        }
        .benefit .course-details-item {
            padding: 20px;
        }

    </style>

    <link href="{{ asset('assets/rating/themes/krajee-svg/theme.css') }}" media="all" rel="stylesheet" type="text/css" />
    <link href="{{ asset('assets/rating/css/star-rating.css') }}" media="all" rel="stylesheet" type="text/css" />
    <style>
        .rating-container .star {
            display: unset;
        }

    </style>
            <link rel="stylesheet" href="//cdnjs.cloudflare.com/ajax/libs/timepicker/1.3.5/jquery.timepicker.min.css">
            <link rel="stylesheet" href="{{ asset('iv') }}/css/course-sidebar-right.css" />
            @if (session('locale') == 'en')
            <style>
                .list-group-item {
                    width: 210px
                }
    
            </style>
    
        @endif
@endpush

@section('content')


@php
use Carbon\Carbon;

$days=0;
if(count(auth()->user()->courseLoc($course->id)->get())>0){
    if($course->free!=1){
    $courseLocId=isset($course_location_id)?$course_location_id:auth()->user()->courseLoc($course->id)->latest('pivot_created_at')->first()->pivot->course_location_id;
   $courseLocation=\App\Models\CourseLocation::find($courseLocId) ;
   
   
   $isEndDatePast = Carbon::parse($courseLocation->end_date)->isPast();
    if($isEndDatePast==true){
        $days=0;
    }
    else{
        $days=now()->diffInDays($courseLocation->end_date);
    }
}
}



@endphp
    <section class="row the-slider" id="slider">
        <div style="background-size: cover;height:fit-content;background-color: white;padding-bottom: 20px;">
            <div class="containers">
                <div class="row benefit-notes">
                    <div class="col-sm-12 col-md-12   wow fadeInUp2  course-nav mt-0">
                        <nav class="navbar navbar-default second-nav" style="position: unset">
                            <div class="container">
                                <!--========== Brand and toggle get grouped for better mobile display ==========-->


                                <div class="nav navbar-nav navbar-right col-md-6">
                                    <button type="button" onclick="toggleShow()" id="sidebarToggle"
                                        class="Button Button--link course-nav-toggle" aria-live="polite"
                                        aria-label="إخفاء قائمة التنقل بين الدورات" title="إخفاء قائمة التنقل بين الدورات">
                                        <i class="fa fa-bars" aria-hidden="true"></i>
                                    </button>
                                </div>
                                <div class="nav navbar-nav navbar-left col-md-6"></div>
                                <!--========== Collect the nav links, forms, and other content for toggling ==========-->

                                <div class="pull-right col-md-3 col-xs-6  ">
                                    <div class="progress">
                                        <div class="progress-bar "
                                            style='width:{{ $course->progress() ? $course->progress() : 0 }}%'
                                            role="progressbar" aria-valuenow="0" aria-valuemin="0" aria-valuemax="100">
                                            <span class="color-primary text-color">{{ $course->progress() ? $course->progress() : 0 }}%</span>
                                        </div>


                                    </div>
                                </div>
                                <div class="pull-right col-md-3 col-xs-6 mb-10 ">
                                    @if($days>0)
                                   @include('frontend.courses.remaining_days')
                                 @endif

                                </div>
                            </div>

                        </nav>
                        <!--========== /.navbar-collapse ==========-->
                    </div>
                    <!--========== /.container-fluid ==========-->

                    <div class="top-banner"></div>

                </div>
                <!-- ===========course details part1============ -->
                <!--==========course description right==========-->
                <div class="row">

                    <div class="container">
                        <div class="col-sm-12 col-md-3  benefit wow fadeInUp ptb-50 course-content mt-0" id="sidebar-right">
                            <!-- Sidebar right-->

                            @include('frontend.courses.course_sidebar_right')
                            {{-- Sidebar right --}}
                          
                            {{-- Sidebar right --}}

                        </div>
                        <!--/*==========course description right ==========-->

                        <!--==========course description details ==========-->

                        <div class="col-sm-12 col-md-9  benefit wow fadeInUp ptb-50 course-content mt-0">
                            {{-- content programRecommendation --}}
                            @include('includes.partials.messages')

                            <div class="course-details-item border-bottom-0 mb-0" style="background-color:unset">

                                <h3 style="border: 1px solid #88ceb9;
                                padding: 15px;
                                border-radius: 10px;color: #783141;">   @lang('labels.frontend.course.programRec')</h3>
                                @if ($logged_in_user->hasRole('student') || $programRecommendation)
                                    <div class="course-single-text">
        
                                        <div class="course-title mt10 headline relative-position">
                                            <h3 style="margin: 30px 0">
                                                <b>
                                                    @if (Lang::locale() == 'en'){{ $programRecommendation->name ? $programRecommendation->name : $programRecommendation->name_ar }}@else {{ $programRecommendation->name_ar ? $programRecommendation->name_ar : $programRecommendation->name }} @endif
                                                </b>
                                            </h3>
                                        </div>
        
        
                                        <hr>
                                        <form method="POST" action="{{ route('admin.answerEvaluate.store') }}"
                                            enctype="multipart/form-data">
                                            @csrf
                                            <input type="hidden" name="course_id" value="{{ $course->id }}">
                                            <input type="hidden" name="rate_ids[]" value="{{ $programRecommendation->id }}">
                                            @php
                                            $quest_count = 0;
                                            
                                            $userAnswers = $programRecommendation->getUserRate(null, $course->id);
                                            
                                            $test_result = App\Models\Result::where('course_forms_id', $programRecommendation->course()->first()->pivot->id)
                                                ->where('user_id', \Auth::id())
                                                ->first();
                                        @endphp
                                            <div class="">
        
                                                @foreach ($programRecommendations as $programRec)
                                                    @php
                                                        $test_result = \App\Models\Result::where(
                                                            'course_forms_id',
                                                            $programRec
                                                                ->course()
                                                                ->where('courses.id', $course->id)
                                                                ->first()->pivot->id,
                                                        )
                                                            ->where('user_id', \Auth::id())
                                                            ->first();
                                                        
                                                    @endphp
                                                    @foreach ($programRec->questions as $question)
                                                        <p style="color: black !important;
                                                        font-weight: bold !important;">
                                                            @if (Lang::locale() == 'en')
                                                                {{ $question->question }}
                                                            @else
                                                                {{ $question->question_ar ? $question->question_ar : $question->question }}
        
                                                            @endif
                                                        </p>
        
                                                        {{-- <textarea name="questionAnswer-{{ $question->id }}" id=""
                                                        class="form-control @if (Lang::locale() == 'en')editor @else editor_ar @endif">
                                                    {{count($programRec->getUserAnswers($course->id))>0?$programRec->getUserAnswers($course->id)->where('question_id', $question->id)->first()->answer:''}}
                                                       
                                                    </textarea> --}}
        
        
                                                        {{-- /////////////////// --}}
                                                        <br />
                                                        <ul class="options-list pl-4">
        
                                                            
        
                                                            @if (sizeof($question->options) && $question->question_type == 'multiple_choice')
                                                                @foreach ($question->options as $option)
        
        
                                                                    <div class="radio">
                                                                        <label>
                                                                            <input type="radio"
                                                                                name="{{ $question->id }}-options"
                                                                                @if ($option->answered(@$test_result->id) != null)checked @endif
                                                                                value="{{ $option->id }}" />
                                                                            {{ $option->option_text }}<br />
                                                                        </label>
                                                                    </div>
                                                                @endforeach
                                                            @elseif (sizeof($question->options) &&
                                                                $question->question_type=="drop_down")
        
        
                                                                <select name="{{ $question->id }}-options"
                                                                    class="form-control">
                                                                    @foreach ($question->options as $option)
        
                                                                        <option @if ($option->answered(@$test_result->id) != null)selected @endif
                                                                            value="{{ $option->id }}">
                                                                            {{ $option->option_text }}
                                                                        </option>
                                                                    @endforeach
                                                                </select>
                                                            @else
                                                                @switch($question->question_type)
                                                                    @case("paragraph")
                                                                        <textarea type="text" class="form-control"
                                                                             style="height:100px"
                                                                            name="{{ $question->id }}-options">{{ @test_res($test_result->id, $question->id)->option_id }}</textarea>
                                                                    @break
                                                                    @case("short_answer")
                                                                        <input type="text" class="form-control"
                                                                            value="{{ @test_res($test_result->id, $question->id)->option_id }}"
                                                                            placeholder="short_answer"
                                                                            name="{{ $question->id }}-options" />
                                                                    @break
                                                                    @case("date")
                                                                        <input type="text" class="form-control datepicker"
                                                                            value="{{ @test_res($test_result->id, $question->id)->option_id }}"
                                                                             name="{{ $question->id }}-options" />
                                                                    @break
                                                                    @case("time")
                                                                        <input type="text" class="form-control timepicker"
                                                                            value="{{ @test_res($test_result->id, $question->id)->option_id }}"
                                                                            name="{{ $question->id }}-options" />
                                                                    @break
                                                                    @case("file_upload")
                                                                        <div style="margin-top: 20px">
                                                                            <label> @lang('labels.frontend.course.or_upload')</label>
                                                                            <input type="file"
                                                                                name="answer_file_{{ $question->id }}">
                                                                            <p>{!! get_test_file(auth()->id(), $question->id) !!} </p>
                                                                        </div>
                                                                    @break
                                                                @endswitch
                                                            @endif
                                                        </ul>
                                                        <br />
                                                        {{-- ////////////////// --}}
        
                                                        <hr>
                                                    @endforeach
                                                @endforeach
        
        
                                            </div>
                                            @if (count($programRecommendations) > 0)
                                            {{-- @if (count($userAnswers) == 0) --}}
                                            <div class="form-group row justify-content-center"
                                                style="margin-top: 20px;margin-left: 16%;">
                                                <div class="col-4">
                                                    <button class="btn btn-success" style="background-color: ##3bcfcb;"
                                                        type="submit">{{ __('buttons.general.crud.send') }}</button>
                                                </div>
                                            </div>
                                            {{-- @endif --}}
                                            @endif

                                            <!--col-->
                                        </form>
        
                                    </div>
                                    <div style="    position: relative;
                                        display: flex;
                                        justify-content: space-around;
                                        flex-direction: row-reverse;">
                                        <form method="post" action="{{ route('admin.certificates.generate') }}">
                                            @csrf
                                            <input type="hidden" value="{{ $course->id }}" name="course_id">
                                            <input type="hidden" value="{{ $course_location_id }}"
                                                name="course_location_id">
                                            <button id="finish" class="btn btn-primary "
                                                style="justify-content: center;padding:10px" role="button">
                                                <span>
                                                    @if ($days > 0)
                                                        @lang('labels.frontend.course.finish_course')
                                                    @else
                                                        @lang('labels.frontend.course.get_certificate')
                                                    @endif
                                                </span>

                                            </button>


                                        </form>
                                    </div>
                                @else
                                    <div class="course-single-text noData"
                                        style="background-image: url('{{ asset('assets/img/noData.png') }}')"></div>
                                @endif
        
        
        
                            </div>

                           
                            {{-- // --}}
                            {{-- content programRecommendation --}}

                        </div>
                        <!-- =======course side bar left -->
                        {{-- <div class="col-sm-12 col-md-3  benefit wow fadeInUp ptb-50 course-content mt-0">

                        <!-- Sidebar left-->
                        
                    @include('frontend.courses.course_sidebar_left')

                    </div> --}}
                    </div>
                </div>
            </div>


        </div>
        </div>
    </section>








@endsection

@push('after-scripts')
    <!-- custom js -->

    <script src="{{ asset('iv') }}/assets/rating/js/star-rating.js"></script>
    <script src="{{ asset('iv') }}/js/toggleSideBar.js"></script>

    <script>
        $(document).on('change', 'input[name="stars"]', function() {
            $('#rating').val($(this).val());

        })
        $(document).ready(function() {
            $('.caption').css({
                'display': 'none'
            })
            $barWidth=$('.progress-bar').width();
            if($barWidth!=0){
                $('.progress-bar span').removeClass("color-primary");
            }
            $('.course-sidebar').on('click', 'a.list-group-item', function() {
                $(".course-sidebar .list-group-item").removeClass("active");
                $(".course-sidebar .list-group-item").addClass("unactive");

                
                $(this).addClass("active");
            });

        })
    </script>
    {{-- <script src="//www.youtube.com/iframe_api"></script> --}}

    <script src="{{ asset('plugins/touchpdf-master/jquery.mousewheel.js') }}"></script>
    <script src="https://cdn.jsdelivr.net/npm/js-cookie@2/src/js.cookie.min.js"></script>

    <script src="https://cdn.plyr.io/3.5.3/plyr.polyfilled.js"></script>
    <script src="{{ asset('assets/rating/js/star-rating.js') }}"></script>
   
    <script src="{{ asset('plugins/sticky-kit/sticky-kit.js') }}"></script>
    <script src="https://cdn.plyr.io/3.5.3/plyr.polyfilled.js"></script>
    <script src="{{ asset('plugins/touchpdf-master/pdf.compatibility.js') }}"></script>
    <script src="{{ asset('plugins/touchpdf-master/pdf.js') }}"></script>
    <script src="{{ asset('plugins/touchpdf-master/jquery.touchSwipe.js') }}"></script>
    <script src="{{ asset('plugins/touchpdf-master/jquery.touchPDF.js') }}"></script>
    <script src="{{ asset('plugins/touchpdf-master/jquery.panzoom.js') }}"></script>
    <script src="{{ asset('plugins/touchpdf-master/jquery.mousewheel.js') }}"></script>
    <script src="https://cdn.jsdelivr.net/npm/js-cookie@2/src/js.cookie.min.js"></script>
    <script src="{{ asset('vendor/tinymce/tinymce.min.js') }}" referrerpolicy="origin"></script>
    <script>
        tinymce.init({
            selector: '.editor',
            language: 'en',
            directionality: 'ltr',
            setup: function(editor) {
                editor.on('change', function() {
                    editor.save();
                });
            },
            plugins: "link image code table lists ",

            menubar: true,
            a11y_advanced_options: true,
            relative_urls: false,
            image_dimensions: true,
            document_base_url: 'https://ucas.e-9.co',
            content_style: "@import  url('https://fonts.googleapis.com/css2?family=Tajawal:wght@200;300;400;500;700;800;900&display=swap');",
            font_formats: "Tajawal=Tajawal,times; Arial=arial,helvetica,sans-serif; Arial Black=arial black;  Comic Sans MS=comic sans ms,sans-serif; Courier New=courier new,courier; Georgia=georgia,palatino; Helvetica=helvetica;Tahoma=tahoma,arial,helvetica,sans-serif;Times New Roman=times new roman,times",
            toolbar: 'code | bold italic | alignleft aligncenter alignright alignjustify link | table | styleselect | fontselect  forecolor  backcolor fontsizeselect  | image | outdent indent|numlist bullist',

            image_title: false,
            automatic_uploads: true,

            file_picker_types: 'image',
            /* and here's our custom image picker*/
            images_upload_handler: function(blobInfo, success, failure) {
                var xhr, formData;
                xhr = new XMLHttpRequest();
                xhr.withCredentials = false;
                xhr.open('POST', '/admin/upload-image');
                var token = 'pPzi2iR54hDF07shAjUZokNGDPaf1JAW8goECiJj';
                xhr.setRequestHeader("X-CSRF-Token", token);
                xhr.onload = function() {
                    var json;
                    if (xhr.status != 200) {
                        failure('HTTP Error: ' + xhr.status);
                        return;
                    }
                    json = JSON.parse(xhr.responseText);

                    if (!json || typeof json.location != 'string') {
                        failure('Invalid JSON: ' + xhr.responseText);
                        return;
                    }
                    success(json.location);
                };
                formData = new FormData();
                formData.append('file', blobInfo.blob(), blobInfo.filename());
                xhr.send(formData);
            },
        });

        tinymce.init({
            selector: '.editor_ar',
            language: 'ar',
            directionality: 'rtl',
            setup: function(editor) {
                editor.on('change', function() {
                    editor.save();
                });
            },
            plugins: "link image code table lists ",
            menubar: true,
            a11y_advanced_options: true,
            relative_urls: false,
            image_dimensions: true,
            document_base_url: 'https://ucas.e-9.co',
            content_style: "@import  url('https://fonts.googleapis.com/css2?family=Tajawal:wght@200;300;400;500;700;800;900&display=swap');",
            font_formats: "Tajawal=Tajawal,times; Arial=arial,helvetica,sans-serif; Arial Black=arial black;  Comic Sans MS=comic sans ms,sans-serif; Courier New=courier new,courier; Georgia=georgia,palatino; Helvetica=helvetica;Tahoma=tahoma,arial,helvetica,sans-serif;Times New Roman=times new roman,times",
            toolbar: 'code | bold italic | alignleft aligncenter alignright alignjustify link | table | styleselect | fontselect  forecolor  backcolor fontsizeselect  | image | outdent indent|numlist bullist',
            image_title: false,
            automatic_uploads: true,

            file_picker_types: 'image',
            /* and here's our custom image picker*/
            images_upload_handler: function(blobInfo, success, failure) {
                var xhr, formData;
                xhr = new XMLHttpRequest();
                xhr.withCredentials = false;
                xhr.open('POST', '/user/upload-image');
                var token = '{{ csrf_token() }}';
                xhr.setRequestHeader("X-CSRF-Token", token);
                xhr.onload = function() {
                    var json;
                    if (xhr.status != 200) {
                        failure('HTTP Error: ' + xhr.status);
                        return;
                    }
                    json = JSON.parse(xhr.responseText);

                    if (!json || typeof json.location != 'string') {
                        failure('Invalid JSON: ' + xhr.responseText);
                        return;
                    }
                    success(json.location);
                };
                formData = new FormData();
                formData.append('file', blobInfo.blob(), blobInfo.filename());
                xhr.send(formData);
            },
        });
        tinymce.init({
            selector: '.editor_ar',
            language: 'ar',
            directionality: 'rtl',
            setup: function(editor) {
                editor.on('change', function() {
                    editor.save();
                });
            },
            plugins: "link image code table lists ",
            menubar: true,
            a11y_advanced_options: true,
            relative_urls: false,
            image_dimensions: true,
            document_base_url: 'https://ucas.e-9.co',
            content_style: "@import  url('https://fonts.googleapis.com/css2?family=Tajawal:wght@200;300;400;500;700;800;900&display=swap');",
            font_formats: "Tajawal=Tajawal,times; Arial=arial,helvetica,sans-serif; Arial Black=arial black;  Comic Sans MS=comic sans ms,sans-serif; Courier New=courier new,courier; Georgia=georgia,palatino; Helvetica=helvetica;Tahoma=tahoma,arial,helvetica,sans-serif;Times New Roman=times new roman,times",
            toolbar: 'code | bold italic | alignleft aligncenter alignright alignjustify link | table | styleselect | fontselect  forecolor  backcolor fontsizeselect  | image | outdent indent|numlist bullist',
            image_title: false,
            automatic_uploads: true,

            file_picker_types: 'image',
            /* and here's our custom image picker*/
            images_upload_handler: function(blobInfo, success, failure) {
                var xhr, formData;
                xhr = new XMLHttpRequest();
                xhr.withCredentials = false;
                xhr.open('POST', '/user/upload-image');
                var token = '{{ csrf_token() }}';
                xhr.setRequestHeader("X-CSRF-Token", token);
                xhr.onload = function() {
                    var json;
                    if (xhr.status != 200) {
                        failure('HTTP Error: ' + xhr.status);
                        return;
                    }
                    json = JSON.parse(xhr.responseText);

                    if (!json || typeof json.location != 'string') {
                        failure('Invalid JSON: ' + xhr.responseText);
                        return;
                    }
                    success(json.location);
                };
                formData = new FormData();
                formData.append('file', blobInfo.blob(), blobInfo.filename());
                xhr.send(formData);
            },
        });
    </script>
    <script src="http://code.jquery.com/jquery-1.9.1.js"></script>
    <script src="http://code.jquery.com/ui/1.11.0/jquery-ui.js"></script>
    <script src="//cdnjs.cloudflare.com/ajax/libs/timepicker/1.3.5/jquery.timepicker.min.js"></script>
    <script src="{{ asset('ivory/assets/js/datepickerConfig.js') }}"></script>
@endpush
