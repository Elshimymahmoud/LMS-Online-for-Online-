@extends('frontend.layouts.courses')
{{-- @extends('frontend.layouts.app'.config('theme_layout')) --}}

@push('after-styles')
    {{-- <link rel="stylesheet" href="{{asset('plugins/YouTube-iFrame-API-Wrapper/css/main.css')}}"> --}}
    <link rel="stylesheet" href="https://cdn.plyr.io/3.5.3/plyr.css" />
    <link href="{{ asset('plugins/touchpdf-master/jquery.touchPDF.css') }}" rel="stylesheet">
    <link href="{{ asset('css/buttons.css') }}" rel="stylesheet">

    <style>
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
            @if(session('locale') == 'ar')
            margin-right: -1.3em;
            @else
            margin-left: -1.3em;
            @endif
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
            @if(session('locale') == 'ar')
            margin-right: -1.3em;
            @else
            margin-left: -1.3em;
            @endif
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
            @if(session('locale') == 'ar')
            margin-right: -1.3em;
            @else
            margin-left: -1.3em;
            @endif
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
        .course-details-category .btn-block,.course-details-item .btn-block {
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
        @media screen and (max-width: 768px) {}
    </style>
@endpush

@section('content')


@if($IsUserFilledData==false)
<div class="alert alert-danger">
   <a href="{{route('admin.account')}}"><i class="fa fa-edit"></i> @lang('validation.complete-data')</a>
</div>
@endif
    <!-- Start of course details section
            ============================================= -->
    <section id="course-details" class="course-details-section" style="margin-bottom: 50px">
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
                        @if ($lesson->lesson_image != '')
                            <div class="course-single-pic mb30">
                                <img src="{{ asset('storage/uploads/' . $lesson->lesson_image) }}" alt="">
                            </div>
                        @endif



                        @if ($lesson->mediaVideo && $lesson->mediavideo->count() > 0)
                            <div class="course-single-text">
                                @if ($lesson->mediavideo != '')
                                    <div class="course-details-content mt-3">
                                        <div class="video-container mb-5" data-id="{{ $lesson->mediavideo->id }}">
                                            @if ($lesson->mediavideo->type == 'youtube')


                                                <div id="player" class="js-player" data-plyr-provider="youtube"
                                                    data-plyr-embed-id="{{ $lesson->mediavideo->file_name }}"></div>
                                            @elseif($lesson->mediavideo->type == 'vimeo')
                                                <div id="player" class="js-player" data-plyr-provider="vimeo"
                                                    data-plyr-embed-id="{{ $lesson->mediavideo->file_name }}"></div>
                                            @elseif($lesson->mediavideo->type == 'upload')
                                                <video poster="" id="player" class="js-player" playsinline controls>
                                                    <source src="{{ $lesson->mediavideo->url }}" type="video/mp4" />
                                                </video>
                                            @elseif($lesson->mediavideo->type == 'embed')
                                                {!! $lesson->mediavideo->url !!}
                                            @endif
                                        </div>
                                    </div>
                                @endif
                            </div>
                        @endif

                        @if ($lesson->mediaAudio)
                            <div class="course-single-text mb-5">
                                <audio id="audioPlayer" controls>
                                    <source src="{{ $lesson->mediaAudio->url }}" type="audio/mp3" />
                                </audio>
                            </div>
                        @endif
                     
                        <div class="course-single-text">
                            <div class="course-title mt10 headline relative-position">
                                <h3 style="margin: 30px 0">
                                    <b>
                                        @if (session('locale') == 'ar')
                                        {{ $lesson->title_ar }} @else {{ $lesson->title }} @endif 
                                    </b>
                                </h3>
                            </div>
                            <div class="course-details-content">
                                @if (session('locale') == 'ar') {!! $lesson->full_text_ar ?? $lesson->full_text !!}
                                @else {!! $lesson->full_text !!} @endif
                            </div>
                        </div>
 
                        @if ($lesson->mediaPDF)
                        @if($IsUserFilledData)
                            <div class="course-single-text mb-5">
                                <iframe src="{{asset('storage/uploads/'.$lesson->mediaPDF->name)}}" width="100%"
                                height="500px">
                                </iframe>
                                <div id="myPDF"></div>

                            </div>
                            
                                
                            @else
                                
                            <div class="course-single-text mb-5">
                                <iframe src="{{asset('storage/uploads/'.$lesson->mediaPDF->name.'#toolbar=0')}}" width="100%"
                                height="500px">
                                </iframe>
                                <div id="myPDF"></div>

                            </div>
                            @endif
                        @endif



                        @if ($lesson->downloadableMedia != '' && $lesson->downloadableMedia->count() > 0)
                            <div class="course-single-text mt-4 px-3 py-1 gradient-bg ">
                                <div class="course-title mt10 headline relative-position">
                                    <h4>
                                        @lang('labels.frontend.course.download_files')
                                    </h4>
                                </div>

                                @foreach ($lesson->downloadableMedia as $media)
                                    <div class="course-details-content">
                                        <p class="form-group">
                                            <a href="{{ route('download', ['filename' => $media->name, 'lesson' => $lesson->id]) }}"
                                                class="font-weight-bold"><i class="fa fa-download"></i>
                                                {{ $media->name }}
                                                ({{ number_format((float) $media->size / 1024, 2, '.', '') }}
                                                @lang('labels.frontend.course.mb')
                                                )</a>
                                        </p>
                                    </div>
                                @endforeach
                            </div>
                        @endif



                        @if ($test_exists)
                           
                            <hr/>
                            @if (!is_null($test_result))
                                <div class="alert alert-info">@lang('labels.frontend.course.your_test_score')  : {{ $test_result->test_result }}</div>
                               
                                @if(count($lesson->questions) > 0  )
                                    <hr>

                                    @foreach ($lesson->questions as $question)

                                        <h4 class="mb-0">{{ $loop->iteration }}
                                            . {!! $question->question !!}   @if(!$question->isAttempted($test_result->id))
                                                <small class="badge badge-danger"> @lang('labels.frontend.course.not_attempted')</small> @endif
                                        </h4>
                                        <br/>
                                        <ul class="options-list pl-4">


                                            @if(sizeof($question->options))
                                            @foreach ($question->options as $option)

                                                <li class="@if(($option->answered($test_result->id) != null && $option->answered($test_result->id) == 1) || ($option->correct == true)) correct @elseif($option->answered($test_result->id) != null && $option->answered($test_result->id) == 2) incorrect  @endif"> {{ $option->option_text }}

                                                    @if($option->correct == 1 && $option->explanation != null)
                                                        <p class="text-dark" style="color:#802c41 !important">
                                                            <b>@lang('labels.frontend.course.explanation')</b><br>
                                                            {{$option->explanation}}
                                                        </p>
                                                    @endif
                                                </li>

                                            @endforeach
                                            @else
                                                <input type="text" class="form-control" value="{{ @test_res($test_result->id,$question->id)->option_id }}"  name="questions[{{ $question->id }}]">
                                                <p class=" warning  ">@if(!empty(test_res($test_result->id,$question->id)->option_id))   @lang('labels.frontend.course.will_be_revied') @endif</p>
                                                <p>
                                                    {!! get_test_file(auth()->id(),$question->id) !!}
                                                </p>

                                            @endif


                                           
                                        </ul>
                                        <br/>
                                    @endforeach
                                    @if(config('retest'))
                                    <div class="row main-content" style="margin-bottom: 60px;">
                                        <div class="col-4 offset-4">
                                            <form action="{{route('lessons.retest',[$test_result->test->slug])}}" method="post">
                                                @csrf
                                                <input type="hidden" name="result_id" value="{{$test_result->id}}">
        
                                                <button  class="next-button"  role="button">
                                                    <span> @lang('labels.frontend.course.give_test_again') </span>
                                                    <div class="icon">
                                                        <i class="fa fa-repeat"></i>
                                                        <i class="fa fa-check"></i>
                                                    </div>
                                                </button>
        
                                            
                                            </form>
                                        </div>
                                    </div>
                                    <div class="clear"></div>                                   
                                @endif
                                @else
                                    <h3>@lang('labels.general.no_data_available')</h3>
                                @endif
                            @else
                                <div class="test-form">
                                    @if(count($lesson->questions) > 0  )
                                        <form action="{{ route('lessons.test', [$lesson->slug]) }}" method="post" enctype="multipart/form-data">
                                            {{ csrf_field() }}
                                            @foreach ($lesson->questions as $question)
                                                <h4 class="mb-0">{{ $loop->iteration }}. {!! $question->question !!}  </h4>
                                                <br/>
                                                @if(sizeof($question->options))
                                            @foreach ($question->options as $option)
                                                <div class="radio">
                                                    <label>
                                                        <input type="radio" name="questions[{{ $question->id }}]"  value="{{ $option->id }}" />
                                                        {{ $option->option_text }}<br />
                                                    </label>
                                                </div>
                                            @endforeach
                                            @else
                                                <textarea type="text" class="form-control editor" style="height:100px"  name="questions[{{ $question->id }}]"></textarea>
                                               
                                                <div style="margin-top: 20px">
                                                    <label> @lang('labels.frontend.course.or_upload')</label>
                                                <input type="file" name="answer_file_{{ $question->id }}">
                                                </div>
                                            @endif
                                                <br/>
                                            @endforeach

                                             
                                            <div style="position: relative;width: 300px;margin: auto;margin-bottom: 90px">                                                   
                                                <button style="height: 60px" class="next-button"  role="button">
                                                    <span> @lang('labels.frontend.course.submit_results') </span>
                                                    <div class="icon">
                                                        <i class="fa fa-save"></i>
                                                        <i class="fa fa-check"></i>
                                                    </div>
                                                </button>
                                            </div>
                                   



                                          
                                        </form>
                                    @else
                                        <h3>@lang('labels.general.no_data_available')</h3>

                                    @endif
                                </div>
                            @endif                                    
                        @endif
              

                        
                        <div class="course-details-category ul-li" style="margin-top: 30px">
                            <div class="row main-content">
                                <div class="col-md-4">
                                    @if ($previous_lesson)
                                    
                                          
                                        
                                    <a class="next-button" href="{{ route('lessons.show', [$previous_lesson->course_id, $previous_lesson->model->slug]) }}" role="button">
                                        <span> @lang('labels.frontend.course.prev')  </span>
                                        <div class="icon">
                                            <i class="fa fa-chevron-right"></i>
                                            <i class="fa fa-check"></i>
                                        </div>
                                    </a>

                                     

                                    @endif
                                </div>
                                <div class="col-md-4">
                                    @if(!$lesson->isCompleted() && !$test_exists)

                                    <a  href="#"  class="next-button complete-btn" @if(!$lesson->isCompleted()) onclick='courseCompleted("{{ $lesson->id }}", "{{ get_class($lesson) }}")' @endif role="button">
                                        <span> @lang('labels.frontend.course.complete') </span>
                                        <div class="icon">
                                            <i class="fa fa-check-circle"></i>
                                            <i class="fa fa-check"></i>
                                        </div>
                                    </a>

                                    
                                  
                                    @endif
                                </div>
                                <div class="col-md-4">
                                    @if ($next_lesson)
                                      
                                          
                                        
                                    <a class="next-button" href="{{ route('lessons.show', [$next_lesson->course_id, $next_lesson->model->slug]) }}" role="button">
                                        <span> @lang('labels.frontend.course.next')  </span>
                                        <div class="icon">
                                            <i class="fa fa-chevron-left"></i>
                                            <i class="fa fa-check"></i>
                                        </div>
                                    </a>

                                     


                                      
                                    @endif
                                </div>
                                <div class="col-md-4 offset-4" style="margin-top: 74px;">
                                    @if ($lesson->course->progress() == 100)
                                        @if (!$lesson->course->isUserCertified())
                                            <form method="post" action="{{ route('admin.certificates.generate') }}">
                                                @csrf
                                                <input type="hidden" value="{{ $lesson->course->id }}" name="course_id">
                                                <button id="finish" class="next-button complete-btn" @if(!$lesson->isCompleted()) onclick='courseCompleted("{{ $lesson->id }}", "{{ get_class($lesson) }}")' @endif role="button">
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


        
            <ul class="list-unstyled ps-0">
                <li class="mb-1">
                  <button class="btn btn-toggle align-items-center rounded collapsed" data-bs-toggle="collapse" data-bs-target="#home-collapse" aria-expanded="true">
                    Home
                  </button>
                  <div class="collapse show" id="home-collapse">
                    <ul class="btn-toggle-nav list-unstyled fw-normal pb-1 small">
                      <li><a href="#" class="link-dark rounded">Overview</a></li>
                      <li><a href="#" class="link-dark rounded">Updates</a></li>
                      <li><a href="#" class="link-dark rounded">Reports</a></li>
                    </ul>
                  </div>
                </li>
                <li class="mb-1">
                  <button class="btn btn-toggle align-items-center rounded collapsed" data-bs-toggle="collapse" data-bs-target="#dashboard-collapse" aria-expanded="false">
                    Dashboard
                  </button>
                  <div class="collapse" id="dashboard-collapse" style="">
                    <ul class="btn-toggle-nav list-unstyled fw-normal pb-1 small">
                      <li><a href="#" class="link-dark rounded">Overview</a></li>
                      <li><a href="#" class="link-dark rounded">Weekly</a></li>
                      <li><a href="#" class="link-dark rounded">Monthly</a></li>
                      <li><a href="#" class="link-dark rounded">Annually</a></li>
                    </ul>
                  </div>
                </li>
                <li class="mb-1">
                  <button class="btn btn-toggle align-items-center rounded collapsed" data-bs-toggle="collapse" data-bs-target="#orders-collapse" aria-expanded="false">
                    Orders
                  </button>
                  <div class="collapse" id="orders-collapse">
                    <ul class="btn-toggle-nav list-unstyled fw-normal pb-1 small">
                      <li><a href="#" class="link-dark rounded">New</a></li>
                      <li><a href="#" class="link-dark rounded">Processed</a></li>
                      <li><a href="#" class="link-dark rounded">Shipped</a></li>
                      <li><a href="#" class="link-dark rounded">Returned</a></li>
                    </ul>
                  </div>
                </li>
                <li class="border-top my-3"></li>
                <li class="mb-1">
                  <button class="btn btn-toggle align-items-center rounded collapsed" data-bs-toggle="collapse" data-bs-target="#account-collapse" aria-expanded="false">
                    Account
                  </button>
                  <div class="collapse" id="account-collapse" style="">
                    <ul class="btn-toggle-nav list-unstyled fw-normal pb-1 small">
                      <li><a href="#" class="link-dark rounded">New...</a></li>
                      <li><a href="#" class="link-dark rounded">Profile</a></li>
                      <li><a href="#" class="link-dark rounded">Settings</a></li>
                      <li><a href="#" class="link-dark rounded">Sign out</a></li>
                    </ul>
                  </div>
                </li>
              </ul>
          
        </nav>

                
    
        
        {{-- programRecommendations --}}
        <div class="couse-feature ul-li-block">
            <ul>
                <li>@lang('labels.frontend.course.chapters')
                    <span> {{ $lesson->course->chapterCount() }} </span>
                </li>
                <li>@lang('labels.frontend.course.category') <span><a
                            href="{{ route('courses.category', ['category' => $lesson->course->category->slug]) }}"
                            target="_blank">{{ $lesson->course->category->name }}</a> </span></li>
                <li>@lang('labels.frontend.course.author') <span>

                        @foreach ($lesson->course->teachers as $key => $teacher)
                            @php $key++ @endphp
                            <a href="{{ route('teachers.show', ['id' => $teacher->id]) }}" target="_blank">
                                {{ $teacher->full_name }}@if ($key < count($lesson->course->teachers)), @endif
                            </a>
                        @endforeach
                    </span>
                </li>
                <li>@lang('labels.frontend.course.progress') <span> <b>
                            {{ $lesson->course->progress() }}
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


    <script>
        @if ($lesson->mediaPDF)
            $(function () {
            $("#myPDF").pdf({
            source: "{{ asset('storage/uploads/' . $lesson->mediaPDF->name) }}",
            loadingHeight: 800,
            loadingWidth: 800,
            loadingHTML: ""
            });
        
            });
        @endif
        var storedDuration = 0;
        var storedLesson;
        storedDuration = Cookies.get("duration_" + "{{ auth()->user()->id }}" + "_" + "{{ $lesson->id }}" + "_" +
            "{{ $lesson->course->id }}");
        storedLesson = Cookies.get("lesson" + "{{ auth()->user()->id }}" + "_" + "{{ $lesson->id }}" + "_" +
            "{{ $lesson->course->id }}");
        var user_lesson;
        if (parseInt(storedLesson) != parseInt("{{ $lesson->id }}")) {
            Cookies.set('lesson', parseInt('{{ $lesson->id }}'));
        }
        @if ($lesson->mediaVideo && $lesson->mediaVideo->type != 'embed')
            var current_progress = 0;
        
        
            @if ($lesson->mediaVideo->getProgress(auth()->user()->id) != '')
                current_progress = "{{ $lesson->mediaVideo->getProgress(auth()->user()->id)->progress }}";
            @endif
        
        
        
            const player2 = new Plyr('#audioPlayer');
        
            const player = new Plyr('#player');
            duration = 10;
            var progress = 0;
            var video_id = $('#player').parents('.video-container').data('id');
            player.on('ready', event => {
            player.currentTime = parseInt(current_progress);
            duration = event.detail.plyr.duration;
        
        
            if (!storedDuration || (parseInt(storedDuration) === 0)) {
            Cookies.set("duration_" + "{{ auth()->user()->id }}" + "_" + "{{ $lesson->id }}" + "_" +
            "{{ $lesson->course->id }}", duration);
            }
        
            });
        
            {{-- if (!storedDuration || (parseInt(storedDuration) === 0)) { --}}
            {{-- Cookies.set("duration_" + "{{auth()->user()->id}}" + "_" + "{{$lesson->id}}" + "_" + "{{$lesson->course->id}}", player.duration); --}}
            {{-- } --}}
        
        
            setInterval(function () {
            player.on('timeupdate', event => {
            if ((parseInt(current_progress) > 0) && (parseInt(current_progress) < parseInt(event.detail.plyr.currentTime))) {
                progress=current_progress; } else { progress=parseInt(event.detail.plyr.currentTime); } }); if(duration !==0 ||
                parseInt(progress) !==0 ) { saveProgress(video_id, duration, parseInt(progress)); } }, 3000); function
                saveProgress(id, duration, progress) { $.ajax({ url: "{{ route('update.videos.progress') }}" , method: "POST" ,
                data: { "_token" : "{{ csrf_token() }}" , 'video' : parseInt(id), 'duration' : parseInt(duration), 'progress'
                : parseInt(progress) }, success: function (result) { if (progress===duration) { location.reload(); } } }); }
                $('#notice').on('hidden.bs.modal', function () { location.reload(); }); @endif
        $("#sidebar").stick_in_parent();
        @if ((int) config('lesson_timer') != 0)
            //Next Button enables/disable according to time
        
            var readTime, totalQuestions, testTime;
            user_lesson = Cookies.get("user_lesson_" + "{{ auth()->user()->id }}" + "_" + "{{ $lesson->id }}" + "_" +
            "{{ $lesson->course->id }}");
        
            @if ($test_exists)
                totalQuestions = '{{ count($lesson->questions) }}'
                readTime = parseInt(totalQuestions) * 30;
            @else
                readTime = parseInt("{{ $lesson->readTime() }}") * 60;
            @endif
        
            @if (!$lesson->isCompleted())
                storedDuration = Cookies.get("duration_" + "{{ auth()->user()->id }}" + "_" + "{{ $lesson->id }}" + "_" +
                "{{ $lesson->course->id }}");
                storedLesson = Cookies.get("lesson" + "{{ auth()->user()->id }}" + "_" + "{{ $lesson->id }}" + "_" +
                "{{ $lesson->course->id }}");
        
        
                var totalLessonTime = readTime + (parseInt(storedDuration) ? parseInt(storedDuration) : 0);
                var storedCounter = (Cookies.get("storedCounter_" + "{{ auth()->user()->id }}" + "_" + "{{ $lesson->id }}" +
                "_" + "{{ $lesson->course->id }}")) ? Cookies.get("storedCounter_" + "{{ auth()->user()->id }}" + "_" +
                "{{ $lesson->id }}" + "_" + "{{ $lesson->course->id }}") : 0;
                var counter;
                if (user_lesson) {
                if (user_lesson === 'true') {
                counter = 1;
                }
                } else {
                if ((storedCounter != 0) && storedCounter < totalLessonTime) { counter=storedCounter; } else {
                    counter=totalLessonTime; } } var interval=setInterval(function () { counter--; // Display 'counter' wherever
                    you want to display it. if (counter>= 0) {
                    // Display a next button box
                    $('#nextButton').html("<a class='btn btn-block bg-danger font-weight-bold text-white'
                        href='#'>@lang('labels.frontend.course.next') (in " + counter + " seconds)</a>")
                    Cookies.set("duration_" + "{{ auth()->user()->id }}" + "_" + "{{ $lesson->id }}" + "_" +
                    "{{ $lesson->course->id }}", counter);
        
                    }
                    if (counter === 0) {
                    Cookies.set("user_lesson_" + "{{ auth()->user()->id }}" + "_" + "{{ $lesson->id }}" + "_" +
                    "{{ $lesson->course->id }}", 'true');
                    Cookies.remove('duration');
        
                    @if ($test_exists && is_null($test_result))
                        $('#nextButton').html("<a class='btn btn-block bg-danger font-weight-bold text-white'
                            href='#'>@lang('labels.frontend.course.complete_test')</a>")
                    @else
                        @if ($next_lesson)
                            $('#nextButton').html("<a class='btn btn-block gradient-bg font-weight-bold text-white'" +
                            " href='{{ route('lessons.show', [$next_lesson->course_id, $next_lesson->model->slug]) }}'>@lang('labels.frontend.course.next')<i
                                    class='fa fa-angle-double-right'></i> </a>");
                        @else
                            $('#nextButton').html("<form method='post' action='{{ route('admin.certificates.generate') }}'>" +
                                "<input type='hidden' name='_token' id='csrf-token' value='{{ Session::token() }}' />" +
                                "<input type='hidden' value='{{ $lesson->course->id }}' name='course_id'> " +
                                "<button id='finish' class='next-button complete-btn' @if(!$lesson->isCompleted()) onclick='courseCompleted(\'{{ $lesson->id }}\', \'{{ get_class($lesson) }}\')' @endif role='button' ><span>@lang('labels.frontend.course.finish_course') </span><div class='icon'><i class='fa fa-check-circle'></i> <i class='fa fa-check'></i></div></button>"+
                                "</form>");
        
                        @endif
        
                        @if (!$lesson->isCompleted())
                            courseCompleted("{{ $lesson->id }}", "{{ get_class($lesson) }}");
                        @endif
                    @endif
                    clearInterval(counter);
                    }
                    }, 1000);
        
            @endif
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