@extends('backend.layouts.app')
@section('title', __('labels.backend.courses.title').' | '.app_name())

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
            <h3 class="page-title d-inline">@lang('labels.backend.courses.fields.course-group-head')</h3>
            <div class="float-right" style="margin-right: 10px;">
                <a href="{{ route('admin.groups.index') }}" class="btn btn-primary">&#8592</a>
            </div>
        </div>
     
        <div class="card-body">
            <div class="row">
                <div class="col-12">
                    <table class="table table-bordered">
                        <tr>
                            <th>@lang('labels.backend.courses.fields.title_ar')</th>
                            <td>
                                {{ $group->title_ar}}
                            </td>
                        </tr>
                        <tr>
                            <th>@lang('labels.backend.courses.fields.title')</th>
                            <td>
                                    {{ $group->title_en }}
                            </td>                       

                        <tr>
                            <th>@lang('labels.backend.courses.fields.description_ar')</th>
                            <td>
                                {{ $group->description_ar }}
                            </td>
                        </tr>
                        <tr>
                            <th>@lang('labels.backend.courses.fields.description')</th>
                            <td>
                                
                                    {{ $group->description_en }}
                               
                            </td>
                        </tr>
                        <tr>
                            <th>@lang('labels.backend.courses.fields.category')</th>
                            <td>{{ Lang::locale()=='en'?$course->category->name:$course->category->name_ar }}</td>
                        </tr>

                        @if($group->groupPlaces)
                            <tr>
                                <th>@lang('labels.backend.group.location')</th>
                                <td>{{ $group->groupPlaces->name_ar }}</td>
                            </tr>
                        @endif

                        <tr>
                            <th>@lang('labels.backend.courses.fields.teachers')</th>
                            <td>
                                @foreach($teachers as $teacher)
                                    <span class="label label-info label-many">{{ (session('locale') == 'ar')?($teacher->name_ar??$teacher->name):($teacher->name??$teacher->name_ar) }}</span>@if(!$loop->last)-@endif
                                @endforeach
                            </td>
                        </tr>
                        <tr>
                            <th>@lang('labels.backend.courses.fields.enrolled_students')</th>
                            <td>
                                @foreach($students as $student)
                                    <span class="label label-info label-many">{{ $student->first_name.' '.$student->last_name }}</span>@if(!$loop->last)-@endif
                                @endforeach
                            </td>
                        </tr>
                        <tr>
                            <th>@lang('labels.backend.coordinator.title')</th>
                            <td>
                                @foreach($coordinators as $coordinator)
                                    <span class="label label-info label-many">{{ $coordinator->name }}</span>@if(!$loop->last)-@endif
                                @endforeach
                            </td>
                        </tr>
                        <tr>
                            <th>@lang('labels.backend.clients.title')</th>
                            <td>
                                @foreach($clients as $client)
                                    <span class="label label-info label-many">{{ (session('locale') == 'ar')?($client->name_ar??$client->name):($client->name??$client->name_ar) }}</span>@if(!$loop->last)-@endif
                                @endforeach
                            </td>
                        </tr>
                        <tr>
                            <th>@lang('labels.backend.courses.fields.from')</th>
                            <td>{{ $group->start }}</td>
                        </tr>
                        <tr>
                            <th>@lang('labels.backend.courses.fields.to')</th>
                            <td>{{ $group->end }}</td>
                        </tr>
                        <tr>
                            <th>@lang('labels.backend.courses.fields.course_group_image')</th>
                            <td>
                                @if($group->image)
                                    <img src="{{ asset('storage/uploads/'.$group->image) }}" style="max-width: 200px;max-height: 200px;">
                                @else
                                    <span class="label label-danger">@lang('labels.general.none')</span>
                                @endif
                            </td>
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
        $(function () {
            $('ul.sorter').amigoSorter({
                li_helper: "li_helper",
                li_empty: "empty",
            });
            $(document).on('click', '#save_timeline', function (e) {
                e.preventDefault();
                var list = [];
                $('ul.sorter li').each(function (key, value) {
                    key++;
                    var val = $(value).find('span').data('id');
                    list.push({id: val, sequence: key});
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