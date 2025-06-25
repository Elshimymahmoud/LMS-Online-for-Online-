@extends('backend.layouts.app')
@section('title', __('labels.backend.group.rearrange').' | '.app_name())

@push('after-styles')
    <link rel="stylesheet" type="text/css" href="{{asset('plugins/bootstrap-tagsinput/bootstrap-tagsinput.css')}}">
    <link rel="stylesheet" type="text/css" href="{{asset('plugins/amigo-sorter/css/theme-default.css')}}">
    <style>
        ul.sorter > span {
            display: inline-block;
            width: 100%;
            height: 100%;
            background: #f5f5f5;
            color: #333333;
            border: 1px solid #cccccc;
            border-radius: 6px;
            padding: 0px;
        }

        ul.sorter li > span .title {
            padding-left: 15px;
            width: 70%;
        }

        ul.sorter li > span .btn {
            width: 20%;
        }

        @media screen and (max-width: 768px) {

            ul.sorter li > span .btn {
                width: 30%;
            }

            ul.sorter li > span .title {
                padding-left: 15px;
                width: 70%;
                float: left;
                margin: 0 !important;
            }

        }


    </style>

@endpush

@section('content')



    <div class="card">
        <div class="card-header">
            <h3 class="page-title float-left mb-0">@lang('labels.backend.group.rearrange')</h3>
             <div class="float-right">
                 <a href="{{ route('admin.groups.index') }}" class="btn btn-primary">&#8592</a>
            </div>
        </div>
      
        <div class="card-body">
           
            <div class="row">
                <div class="col-12 col-lg-12 form-group">
                    {{-- start test --}}
                   
                    <div class="row justify-content-center">
                        <div class="col-lg-8 col-12  ">
                            <h4 class="">@lang('labels.backend.group.group_timeline')</h4>
                            <p class="mb-0">@lang('labels.backend.courses.listing_note')</p>
                            <p class="">@lang('labels.backend.group.timeline_description')</p>
                            <ul class="sorter d-inline-block">

                                @php


                                    $sequence = 1;
                                    $tests = $group->tests;
                                    $lessons = $group->lessons;
                                    $course = $group->courses;
                                    $chapters = $course->chapters()->orderBy('sequence', 'asc')->get(); // Assuming $course->chapters gives you the chapters
                                @endphp
                                @if($chapters)
                                    @foreach($chapters as $chapter)
                                        <li>
                                        <span class="chapter-title">
                                            <p class="d-inline-block mb-0 btn btn-primary">
                                                {{  (session('locale') == 'ar') ? $chapter->title_ar : $chapter->title}}
                                            </p>
                                        </span>
                                            <ul class="sorter mSorter d-inline-block">

                                                @foreach($groupTimelines as $timeline)
                                                    @php
                                                        $model = $timeline->model_type::find($timeline->model_id);
                                                    @endphp
                                                    @if($model && ($model->chapter_id == $chapter->id || ($timeline->model_type == 'App\Models\CourseGroupTest' && $model->chapters->contains($chapter->id))))
                                                        <li>
                                                        <span data-id="{{strtolower(class_basename($timeline->model_type))}}-{{$timeline->model_id}}" data-sequence="{{$timeline->sequence}}">
                                                            <p class="d-inline-block mb-0 btn {{class_basename($timeline->model_type) == 'Lesson' ? 'btn-success' : 'btn-danger'}}">
                                                                @lang('labels.backend.' . strtolower(class_basename($timeline->model_type)) . '.title')
                                                            </p>
                                                            <p class="title d-inline ml-2">{{  (session('locale') == 'ar')?($model->title_ar??$model->title):($model->title??$model->title_ar)}}</p>
                                                        </span>
                                                        </li>
                                                    @endif
                                                @endforeach
                                            </ul>
                                        </li>
                                    @endforeach

                                        @if($groupTimelines->isEmpty())
                                            @foreach($chapters as $chapter)
                                                <li>
                                            <span data-id="chapter-{{$chapter->id}}" data-sequence="{{$sequence++}}">
                                                <p class="d-inline-block mb-0 btn btn-primary">
                                                    {{  (session('locale') == 'ar') ? $chapter->title_ar : $chapter->title}}
                                                </p>
                                            </span>
                                                </li>
                                                @foreach($chapter->lessons as $lesson)
                                                    <li>
                                                <span data-id="lesson-{{$lesson->id}}" data-sequence="{{$sequence++}}">
                                                    <p class="d-inline-block mb-0 btn btn-success">
                                                        @lang('labels.backend.lessons.title')
                                                    </p>
                                                    @if($lesson)
                                                        <p class="title d-inline ml-2">{{  (session('locale') == 'ar')?($lesson->title_ar??$lesson->title):($lesson->title??$lesson->title_ar)}}</p>
                                                    @endif
                                                </span>
                                                    </li>
                                                @endforeach
                                                @foreach($chapter->tests as $test)
                                                    <li>
                                                <span data-id="test-{{$test->id}}" data-sequence="{{$sequence++}}">
                                                    <p class="d-inline-block mb-0 btn btn-danger">
                                                        @lang('labels.backend.tests.title')
                                                    </p>
                                                    @if($test)
                                                        <p class="title d-inline ml-2">{{  (session('locale') == 'ar')?($test->title_ar??$test->title):($test->title??$test->title_ar)}}</p>
                                                    @endif
                                                </span>
                                                    </li>
                                                @endforeach
                                            @endforeach
                                        @endif
                                @else
                                    <ul class="sorter mSorter d-inline-block">
                                        @foreach($groupTimelines as $timeline)
                                            @php
                                                $model = $timeline->model_type::find($timeline->model_id);
                                            @endphp
                                            @if($model)
                                                <li>
                                                    <span data-id="{{strtolower(class_basename($timeline->model_type))}}-{{$timeline->model_id}}" data-sequence="{{$timeline->sequence}}">
                                                        <p class="d-inline-block mb-0 btn {{class_basename($timeline->model_type) == 'Lesson' ? 'btn-success' : 'btn-danger'}}">
                                                            @lang('labels.backend.' . strtolower(class_basename($timeline->model_type)) . '.title')
                                                        </p>
                                                        <p class="title d-inline ml-2">{{  (session('locale') == 'ar')?($model->title_ar??$model->title):($model->title??$model->title_ar)}}</p>
                                                    </span>
                                                </li>
                                            @endif
                                        @endforeach
                                    </ul>
                                @endif






                            </ul>
{{--                            <a href="{{ route('admin.groups.index')  }}"--}}
{{--                                class="btn btn-default border float-left">@lang('strings.backend.general.app_back_to_list')</a>--}}
    
                            <a href="#" id="save_timeline"
                               class="btn btn-primary float-right">@lang('labels.backend.courses.save_timeline')</a>
    
                        </div>

                    </div>

                </div>
            </div>
 
         
  
 
           
        </div>
    </div>

  



@stop

@push('after-scripts')
    <script src="{{asset('plugins/amigo-sorter/js/amigo-sorter.min.js')}}"></script>
    <script>
        $(function () {
            $('ul.mSorter').amigoSorter({
                li_helper: "li_helper",
                li_empty: "empty",
            });
            $(document).on('click', '#save_timeline', function (e) {
                e.preventDefault();
                var list = [];
                $('ul.mSorter li').each(function (key, value) {
                    key++;
                    var val = $(value).find('span').data('id');
                    list.push({id: val, sequence: key});
                });

                $.ajax({
                    method: 'POST',
                    url: "{{route('admin.group.rearrange.save', ['group' => $group->id])}}",
                    data: {
                        _token: '{{csrf_token()}}',
                        list: list
                    }
                }).done(function (data) {
                    location.reload();
                });
            })
        });

    </script>
@endpush