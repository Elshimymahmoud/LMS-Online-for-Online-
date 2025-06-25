@extends('frontend.layouts.courses')
{{-- @extends('frontend.layouts.app'.config('theme_layout')) --}}

@push('after-styles')
    {{-- <link rel="stylesheet" href="{{asset('plugins/YouTube-iFrame-API-Wrapper/css/main.css')}}"> --}}
    <link rel="stylesheet" href="https://cdn.plyr.io/3.5.3/plyr.css" />
    <link href="{{ asset('plugins/touchpdf-master/jquery.touchPDF.css') }}" rel="stylesheet">
    <link href="{{ asset('css/buttons.css') }}" rel="stylesheet">

    <style>
        .noData {
            width: 100%;
            height: 500px;
        }

        .test-form {
            color: #333333;
        }

        .course-details-category ul li {
            width: 100%;
        }

        .sidebar.is_stuck {
            top: 15% !important;
        }

        .options-list li {
            list-style-type: none;
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
            font-family: 'Font Awesome\ 5 Free';
            display: inline-block;
            color: green;
            margin-left: -1.3em;
            /* same as padding-left set on li */
            width: 1.3em;
            /* same as padding-left set on li */
        }

        .options-list li.incorrect:before {
            content: "\f057";
            /* FontAwesome Unicode */
            font-family: 'Font Awesome\ 5 Free';
            display: inline-block;
            color: red;
            margin-left: -1.3em;
            /* same as padding-left set on li */
            width: 1.3em;
            /* same as padding-left set on li */
        }

        .options-list li:before {
            content: "\f111";
            /* FontAwesome Unicode */
            font-family: 'Font Awesome\ 5 Free';
            display: inline-block;
            color: black;
            margin-left: -1.3em;
            /* same as padding-left set on li */
            width: 1.3em;
            /* same as padding-left set on li */
        }

        .touchPDF {
            border: 1px solid #e3e3e3;
        }

        .touchPDF>.pdf-outerdiv>.pdf-toolbar {
            height: 0;
            color: black;
            padding: 5px 0;
            text-align: right;
        }

        .pdf-tabs {
            width: 100% !important;
        }

        .pdf-outerdiv {
            width: 100% !important;
            left: 0 !important;
            padding: 0px !important;
            transform: scale(1) !important;
        }

        .pdf-viewer {
            left: 0px;
            width: 100% !important;
        }

        .pdf-drag {
            width: 100% !important;
        }

        .pdf-outerdiv {
            left: 0px !important;
        }

        .pdf-outerdiv {
            padding-left: 0px !important;
            left: 0px;
        }

        .pdf-toolbar {
            left: 0px !important;
            width: 99% !important;
            height: 30px;
        }

        .pdf-viewer {
            box-sizing: border-box;
            left: 0 !important;
            margin-top: 10px;
        }

        .pdf-title {
            display: none !important;
        }

        .course-timeline-list,
        .couse-feature.ul-li-block ul {
            list-style: none;
            padding-inline-start: 0px;
        }

        .course-timeline-list li {
            padding-bottom: 10px;
            margin-bottom: 10px;
            font-size: 14px;
            border-bottom: 1px solid #ccc;
            background-color: ##3bcfcb;
            border-radius: 5px;
            padding: 15px 10px;
        }

        .course-timeline-list li.completed_lessons {
            position: relative;
            background: url({{ asset('images/success.png') }}) #14a876;
            background-size: 50px;
            background-position: center left;
            background-repeat: no-repeat
        }

        .course-timeline-list i.fa-check-circle {
            font-size: 32px;
            position: absolute;
            top: 10px;
            left: 10px;
            z-index: 1;
        }

        .course-timeline-list li.completed_lessons a {
            color: #fff !important
        }

        .course-timeline-list li.active a {
            font-weight: bolder;
            color: #fff !important
        }

        .pdf-outerdiv {
            background: ##3bcfcb;
            color: #ccc
        }

        .pdf-page-count {
            color: #ccc
        }

        .pdf-button .btn-primary {
            background-color: transparent;
            border-color: #343a40;
            border-radius: 5px
        }

        .pdf-button .btn-success {
            background-color: #495057;
            border-color: #495057;
            border-radius: 5px;
            margin: 0 2px;
        }

        .course-details-category .btn-block,
        .course-details-item .btn-block {
            border-bottom: 1px solid #ccc;
            background-color: ##3bcfcb;
            border-radius: 5px;
            padding: 5px;
            direction: ltr
        }

        .couse-feature {
            padding-bottom: 10px;
            margin-bottom: 10px;
            font-size: 14px;
            border-bottom: 1px solid #ccc;
            background-color: #fff;
            border-radius: 5px;
            padding: 15px 10px;
            color: ##3bcfcb;
        }

        .couse-feature a {
            color: #ccc !important;
        }

        .course-timeline-list li a {
            color: #ccc !important;
        }

        .media i::before {
            font-size: 20px;
        }

        .cicuclum_title {
            border-bottom: 1px gray solid;
            font-size: 18px !important;
            color: #802d42 !important;
            font-weight: 700 !important;
        }

        .cicuclum_li {
            border-bottom: 1px gray solid;

        }

        @media screen and (max-width: 768px) {}

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


                        @if ($logged_in_user->hasRole('student') && $programRecommendation)
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
                                                <p>
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
                                                                    placeholder="paragraph" style="height:100px"
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
                                                                    placeholder="date" name="{{ $question->id }}-options" />
                                                            @break
                                                            @case("time")
                                                                <input type="text" class="form-control timepicker"
                                                                    value="{{ @test_res($test_result->id, $question->id)->option_id }}"
                                                                    placeholder="time" name="{{ $question->id }}-options" />
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
                                    <div class="form-group row justify-content-center"
                                        style="margin-top: 20px;margin-left: 16%;">
                                        <div class="col-4">
                                            <button class="btn btn-success" style="background-color: ##3bcfcb;"
                                                type="submit">{{ __('buttons.general.crud.create') }}</button>
                                        </div>
                                    </div>
                                    <!--col-->
                                </form>

                            </div>
                        @else
                            <div class="course-single-text noData"
                                style="background-image: url('{{ asset('assets/img/noData.png') }}')"></div>
                        @endif



                    </div>
                    <!-- /course-details -->

                    <!-- /market guide -->

                    <!-- /review overview -->
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
                                        @if (in_array($lesson_item->id, $completed_lessons))href="{{ route('lessons.show', ['id' => $course->id, 'slug' => $lesson_item->slug]) }}"@endif>

                                        <span class="title text-color"> @if (session('locale') == 'ar') {{ $lesson_item->title_ar ?? $lesson_item->title }} @else {{ $lesson_item->title ?? $lesson_item->title_ar }}  @endif</span>

                                    </a>
                                </li>
                            @endforeach

                        </ul>
                    </li>
                @endforeach
                {{--  --}}
                {{-- @foreach ($lesson_item->course->tests()->get() as $key => $item)                                      
                 <li class="nav-item nav-dropdown {{ active_class(Active::checkUriPattern(['user/courses*', 'user/lessons*', 'user/tests*', 'user/questions*']), 'open') }}">
                     <a class="nav-link nav-dropdown-toggle {{ active_class(Active::checkUriPattern('admin/*')) }}"  href="#">                                               
                         
                         <i class="nav-icon icon-puzzle"></i>  @if (session('locale') == 'ar') {{ $item->title_ar??$item->title }} @else {{ $item->title??$item->title_ar }} @endif
                                                                        
                     </a>
 
                    
                 </li>            
                 @endforeach --}}
                {{--  --}}

            </ul>
        </nav>

        @if (count($blogs) > 0)


            <li style="background: #e4e5e6;margin-top: 20px"
                class="nav-item nav-dropdown list-unstyled cicuclum_li {{ active_class(Active::checkUriPattern(['user/courses*', 'user/lessons*', 'user/tests*', 'user/questions*']), 'open') }}">
                <a class="nav-link nav-dropdown-toggle {{ active_class(Active::checkUriPattern('admin/*')) }}" href="#">

                    <i class="nav-icon icon-puzzle"></i> @lang('labels.frontend.course.blog')

                </a>
                @foreach ($blogs as $item)
                    <ul class="nav-dropdown-items">
                        <li>
                            <a class="nav-link "
                                href="{{ route('courses.blogs', ['slug' => $item->slug, 'course_id' => $course->id]) }}">{{ $item->title }}</a>
                        </li>
                    </ul>
                @endforeach
            </li>
        @endif
        @if (count($impactMeasurments) > 0)

            <li style="background: #e4e5e6;margin-top: 20px"
                class="nav-item nav-dropdown list-unstyled cicuclum_li {{ active_class(Active::checkUriPattern(['user/courses*', 'user/lessons*', 'user/tests*', 'user/questions*']), 'open') }}">
                <a class="nav-link nav-dropdown-toggle {{ active_class(Active::checkUriPattern('admin/*')) }}" href="#">

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
                <a class="nav-link nav-dropdown-toggle {{ active_class(Active::checkUriPattern('admin/*')) }}" href="#">

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

        <div style="margin-bottom: 50px"></div>
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
    {{-- <script src="//www.youtube.com/iframe_api"></script> --}}
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

<script src="//cdnjs.cloudflare.com/ajax/libs/timepicker/1.3.5/jquery.timepicker.min.js"></script>
<script src="{{ asset('ivory/assets/js/datepickerConfig.js') }}"></script>
@endpush
