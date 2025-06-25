@extends('backend.layouts.app')
@section('title', __('labels.backend.chapters.title').' | '.app_name())

@section('content')

    <div class="card">
        <div class="card-header">
            <h3 class="page-title float-left mb-0">@lang('labels.backend.chapters.title')</h3>
        </div>
        <div class="card-body">
            <div class="row">
                <div class="col-md-12">
                    <table class="table table-bordered table-striped">
                        <tr>
                            <th>@lang('labels.backend.chapters.fields.course')</th>
                            <td>{{ $chapter->course?$chapter->course->title or '':'' }}</td>
                        </tr>
                        <tr>
                            <th>@lang('labels.backend.chapters.fields.title')</th>
                            <td>{{ $chapter->title }}</td>
                        </tr>
                        <tr>
                            <th>@lang('labels.backend.chapters.fields.title_ar')</th>
                            <td>{{ $chapter->title_ar }}</td>
                        </tr>
                        <tr>
                            <th>@lang('labels.backend.chapters.fields.session_length')</th>
                            <td>{{ $chapter->session_length }} @lang('labels.backend.chapters.fields.hours')</td>
                        </tr>
                        {{-- <tr>
                            <th>@lang('labels.backend.chapters.fields.slug')</th>
                            <td>{{ $chapter->slug }}</td>
                        </tr>
                        <tr>
                            <th>@lang('labels.backend.chapters.fields.chapter_image')</th>
                            <td>@if($chapter->chapter_image)<a href="{{ asset('storage/uploads/' . $chapter->chapter_image) }}" target="_blank"><img
                                            src="{{ asset('storage/uploads/' . $chapter->chapter_image) }}" height="100px"/></a>@endif</td>
                        </tr>
                        <tr>
                            <th>@lang('labels.backend.chapters.fields.short_text')</th>
                            <td>{!! $chapter->short_text !!}</td>
                        </tr>
                        <tr>
                            <th>@lang('labels.backend.chapters.fields.full_text')</th>
                            <td>{!! $chapter->full_text !!}</td>
                        </tr>
                        <tr>
                            <th>@lang('labels.backend.chapters.fields.position')</th>
                            <td>{{ $chapter->position }}</td>
                        </tr>

                        <tr>
                            <th>@lang('labels.backend.chapters.fields.media_pdf')</th>
                            <td>
                                @if($chapter->mediaPDF != null )
                                <p class="form-group">
                                    <a href="{{$chapter->mediaPDF->url}}" target="_blank">{{$chapter->mediaPDF->url}}</a>
                                </p>
                                @else
                                    <p>No PDF</p>
                                @endif
                            </td>
                        </tr>
                        <tr>
                            <th>@lang('labels.backend.chapters.fields.media_audio')</th>
                            <td>
                                @if($chapter->mediaAudio != null )
                                <p class="form-group">
                                    <a href="{{$chapter->mediaAudio->url}}" target="_blank">{{$chapter->mediaAudio->url}}</a>
                                </p>
                                @else
                                    <p>No Audio</p>
                                @endif
                            </td>
                        </tr>

                        <tr>

                            <th>@lang('labels.backend.chapters.fields.downloadable_files')</th>
                            <td>
                                @if(count($chapter->downloadableMedia) > 0 )
                                    @foreach($chapter->downloadableMedia as $media)
                                        <p class="form-group">
                                            <a href="{{ asset('storage/uploads/'.$media->name) }}"
                                               target="_blank">{{ $media->name }}
                                                ({{ $media->size }} KB)</a>
                                        </p>
                                    @endforeach
                                @else
                                    <p>No Files</p>
                                @endif
                            </td>
                        </tr>
                        <tr>
                            <th>@lang('labels.backend.chapters.fields.media_video')</th>
                            <td>
                                @if($chapter->mediaVideo !=  null )
                                        <p class="form-group">
                                           <a href="{{$chapter->mediaVideo->url}}" target="_blank">{{$chapter->mediaVideo->url}}</a>
                                        </p>
                                @else
                                    <p>No Videos</p>
                                @endif
                            </td>
                        </tr> --}}
                        <tr>
                            <th>@lang('labels.backend.chapters.fields.published')</th>
                            <td>{{ Form::checkbox("published", 1, $chapter->published == 1 ? true : false, ["disabled"]) }}</td>
                        </tr>
                    </table>
                </div>
            </div><!-- Nav tabs -->



            <a href="{{ url()->previous() }}"
               class="btn btn-default border">@lang('strings.backend.general.app_back_to_list')</a>
        </div>
    </div>
@stop