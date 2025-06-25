@extends('backend.layouts.app')
@section('title', (app()->getLocale() == "ar" ? $course->title_ar : $course->title).' | '.app_name())

@push('after-styles')
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
            <h3 class="page-title d-inline">@lang('labels.backend.courses.title')</h3>
            <div class="float-right">

                <a href="{{ route('admin.courses.index') }}"
                   class="btn btn-primary">&#8592</a>
            </div>
        </div>

        <div class="card-body">
            <div class="row">
                <div class="col-12">
                    <table class="table table-bordered">
{{--                        <tr>--}}
{{--                            <th>@lang('labels.backend.courses.fields.teachers')</th>--}}
{{--                            <td>--}}
{{--                                @foreach ($course->teachers as $singleTeachers)--}}
{{--                                    <span class="label label-info label-many">{{ (session('locale') == 'ar')?($singleTeachers->name_ar??$singleTeachers->name):($singleTeachers->name??$singleTeachers->name_ar) }}</span>--}}
{{--                                @endforeach--}}
{{--                            </td>--}}
{{--                        </tr>--}}
                        <tr>
                            <th>@lang('labels.backend.courses.fields.title_ar')</th>
                            <td>
                                @if($course->published == 1)
                                    <a target="_blank"
                                       href="{{ route('courses.show', [$course->slug]) }}">{{ $course->title_ar }}</a>
                                @else
                                    {{ $course->title_ar }}
                                @endif
                            </td>
                        </tr>
                        <tr>
                            <th>@lang('labels.backend.courses.fields.title')</th>
                            <td>
                                @if($course->published == 1)
                                    <a target="_blank"
                                       href="{{ route('courses.show', [$course->slug]) }}">{{ $course->title }}</a>
                                @else
                                    {{ $course->title }}
                                @endif
                            </td>
                        </tr>
                        <tr>
                            <th>@lang('labels.backend.courses.fields.accreditation_number')</th>
                            <td>

                                {{ $course->accreditation_number }}

                            </td>
                        </tr>

                        <tr>
                            <th>@lang('labels.backend.courses.fields.short_description_ar')</th>
                            <td>

                                {{ $course->short_description_ar }}

                            </td>
                        </tr>
                        <tr>
                            <th>@lang('labels.backend.courses.fields.short_description')</th>
                            <td>

                                {{ $course->short_description }}

                            </td>
                        </tr>
                        <tr>
                            <th>@lang('labels.backend.courses.fields.slug')</th>
                            <td>{{ $course->slug }}</td>
                        </tr>
                        <tr>
                            <th>@lang('labels.backend.courses.fields.category')</th>
                            <td>{{ Lang::locale()=='en'?$course->category->name:$course->category->name_ar }}</td>
                        </tr>
                        <tr>
                            <th>@lang('labels.backend.courses.fields.description_ar')</th>
                            <td>{!! $course->description_ar !!}</td>
                        </tr>
                        <tr>
                            <th>@lang('labels.backend.courses.fields.description')</th>
                            <td>{!! $course->description !!}</td>

                        </tr>
                        <tr>
                            <th>@lang('labels.backend.courses.fields.type')</th>
                            <td>{!! app()->getLocale() == "ar" ? $course->type->name_ar : $course->type->name !!}</td>

                        </tr>
                        <tr>
                            <th>@lang('labels.backend.courses.fields.classification')</th>
                            <td>{!! app()->getLocale() == "ar" ? $course->classification->name_ar :
                            $course->classification->name !!}</td>

                        </tr>
                        <tr>
                            <th>@lang('labels.backend.courses.fields.level')</th>
                            <td>{!! app()->getLocale() == "ar" ? $course->level->name_ar : $course->level->name !!}</td>

                        </tr>
                        <tr>
                            <th>@lang('labels.backend.courses.fields.course_image')</th>
                            <td>@if($course->course_image)
                                    <a
                                            href="{{ asset('storage/uploads/' . $course->course_image) }}"
                                            target="_blank"><img
                                                src="{{ asset('storage/uploads/' . $course->course_image) }}"
                                                height="50px"/></a>
                                @endif</td>
                        </tr>
                        <tr>

                                @if($course->mediaVideo !=  null )

                                    @if(pathinfo($course->mediaVideo->file_name, PATHINFO_EXTENSION) == 'pdf')
                                        <th>@lang('labels.backend.lessons.fields.media_pdf')</th>
                                        <td>
                                            <a href="{{ $course->mediaVideo->url }}"
                                               target="_blank">
                                                <i class="fa fa-file-pdf-o"></i>
                                                {{ $course->mediaVideo->file_name }}
                                            </a>
                                        </td>
                                    @elseif(pathinfo($course->mediaVideo->file_name, PATHINFO_EXTENSION) == 'mp4')
                                        <th>@lang('labels.backend.lessons.fields.media_video')</th>
                                        <td>
                                            <a href="{{  $course->mediaVideo->url  }}"
                                               target="_blank">
                                                <i class="fa fa-file-video-o"></i>
                                                {{ $course->mediaVideo->file_name }}
                                            </a>
                                        <td>
                                    @else
                                        <th>@lang('labels.backend.lessons.fields.media')</th>
                                        <td>
                                            <a href="{{ $course->mediaVideo->url }}"
                                               target="_blank">
                                                <i class="fa fa-link"></i>
                                                {{ $course->mediaVideo->file_name }}
                                            </a>
                                        </td>
                                    @endif
                                @else
                                    <th>@lang('labels.backend.lessons.fields.media_pdf')</th>
                                    <td>
                                        <p>@lang('labels.backend.dashboard.no_data')</p>
                                    </td>
                                @endif
                        </tr>
                        <tr>
                            <th>@lang('labels.backend.lessons.fields.add_pdf')</th>
                            <td>
                                @if($course->mediaPdf !=  null )
                                    <a href="{{ $course->mediaPdf->url }}"
                                       target="_blank">
                                        <i class="fa fa-file-pdf-o"></i>
                                        {{ $course->mediaPdf->file_name }}
                                @else
                                    @lang('labels.backend.dashboard.no_data')
                                @endif
                            </td>
                        </tr>
                        <tr>
                            <th>@lang('labels.backend.courses.fields.published')</th>
                            <td>{{ Form::checkbox("published", 1, $course->published == 1 ? true : false, ["disabled"]) }}</td>
                        </tr>
                        <tr>
                            <th>@lang('labels.backend.courses.fields.featured')</th>
                            <td>{{ Form::checkbox("is_featured", 1, $course->featured == 1 ? true : false, ["disabled"]) }}</td>
                        </tr>
                        <tr>
                            <th>@lang('labels.backend.courses.fields.trending')</th>
                            <td>{{ Form::checkbox("is_trending", 1, $course->trending == 1 ? true :false, ["disabled"])
                            }}</td>
                        </tr>
                        <tr>
                            <th>@lang('labels.backend.courses.fields.meta_title')</th>
                            <td>{{ $course->meta_title }}</td>
                        </tr>
                        <tr>
                            <th>@lang('labels.backend.courses.fields.meta_description')</th>
                            <td>{{ $course->meta_description }}</td>
                        </tr>
                        <tr>
                            <th>@lang('labels.backend.courses.fields.meta_keywords')</th>
                            <td>{{ $course->meta_keywords }}</td>
                        </tr>
                    </table>
                </div>
            </div><!-- Nav tabs -->

        </div>
    </div>
@stop

@push('after-scripts')
    <script src="{{asset('plugins/amigo-sorter/js/amigo-sorter.min.js')}}"></script>
    <script>
        {{--$(function () {--}}
        {{--    $('ul.sorter').amigoSorter({--}}
        {{--        li_helper: "li_helper",--}}
        {{--        li_empty: "empty",--}}
        {{--    });--}}
        {{--    $(document).on('click', '#save_timeline', function (e) {--}}
        {{--        e.preventDefault();--}}
        {{--        var list = [];--}}
        {{--        $('ul.sorter li').each(function (key, value) {--}}
        {{--            key++;--}}
        {{--            var val = $(value).find('span').data('id');--}}
        {{--            list.push({id: val, sequence: key});--}}
        {{--        });--}}

        {{--        $.ajax({--}}
        {{--            method: 'POST',--}}
        {{--            url: "{{route('admin.courses.saveSequence')}}",--}}
        {{--            data: {--}}
        {{--                _token: '{{csrf_token()}}',--}}
        {{--                list: list--}}
        {{--            }--}}
        {{--        }).done(function () {--}}
        {{--            location.reload();--}}
        {{--        });--}}
        {{--    })--}}
        {{--});--}}
        $(function () {
            $('ul.sorter').amigoSorter({
                li_helper: "li_helper",
                li_empty: "empty",
                onDrop: function (item, container, _super) {
                    // This is called when an item is dropped
                    _super(item, container);

                    // Update sequence numbers
                    $(container.el).find('li').each(function (index, value) {
                        var sequence = index + 1; // sequence numbers start from 1
                        $(value).find('span').attr('data-sequence', sequence);
                    });
                },
            });

            $(document).on('click', '#save_timeline', function (e) {
                e.preventDefault();
                var list = [];
                $('ul.sorter li').each(function (index, value) {
                    var id = $(value).find('span').data('id');
                    var sequence = $(value).find('span').data('sequence');
                    list.push({id: id, sequence: sequence});
                });

                $.ajax({
                    method: 'POST',
                    url: "{{route('admin.courses.saveSequence')}}",
                    data: {
                        _token: '{{csrf_token()}}',
                        list: list
                    }
                }).done(function () {
                    location.reload();
                });
            })
        });
    </script>
@endpush