@extends('backend.layouts.app')

@section('title', __('labels.backend.group.title') . ' | ' . app_name())

@push('after-styles')
    <link rel="stylesheet" type="text/css" href="{{ asset('plugins/amigo-sorter/css/theme-default.css') }}">
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
        .fixed-label-width{
            width: 6rem;
            @if(session('locale') == 'ar')
                margin-left: 1rem;
            @else
            margin-right: 1rem;
            @endif
        }
        .flex-container {
            width: 100%;
        }

        .input-widget {
            width: 40%;
            margin: 0 5%;
            margin-bottom: 10px;
        }

        .input-widget label {
            color: #fff;
            margin-bottom: 3px;
        }

        .filter-items {
            flex-wrap: wrap
        }

        ul.sorter li > span .title {
            padding-left: 15px;
        }

        ul.sorter li > span .btn {
            width: 20%;
        }

        .animated {
            background-color: #f5f5f5;
        }

        .filter {
            /* position: absolute; */
            left: 230px;
            background-color: #e9e9e9;
            height: 32px;
            z-index: 222;

        }

        .filter i {
            color: #4f198d;;
        }

        .filter-form {
            display: flex;
            width: 99%;
            background-color: #4f198d;;
            height: fit-content;
            margin: 10px;
            border-radius: 36px;
            padding: 30px;
            align-items: center;
        }

        .formcontent {
            display: flex;
            align-content: center;
            align-items: center;

        }

        .filter-button {
            display: flex;
            justify-content: center;
            margin-top: 10px;

        }

        .filter-button > input {
            color: #802d42;
            background-color: #fff;
        }

        .formcontent > input {

            color: white;
            width: 150px;
            margin: 10px;
            text-align: center;
            line-height: 75px;
            font-size: 15px;

        }

        .formcontent > label {
            color: white;
        }

        .iconFilterM-T {
            margin-top: 10px;
        }

    </style>
@endpush

@section('content')
    <div class="card">
        <div class="card-header">
            <h3 class="page-title float-left mb-0">@lang('labels.backend.courses.fields.course-group-head')</h3>

            @can('course_create')
                <div class="float-right">
                    <a href="{{ route('admin.groups.create') }}"
                       class="btn btn-success"><i class="icon-plus"
                                                  title="@lang('strings.backend.general.app_add_new')"></i></a>
                    <!-- <a href="{{ route('admin.courses.add_students_to_course') }}"
                        class="btn btn-success">@lang('buttons.backend.access.users.addToCourse')</a>
                    <a href="{{ route('admin.courses.remove_students_from_course') }}"
                        class="btn btn-success">@lang('buttons.backend.access.users.removeFromCourse')</a> -->
                    <a href="#" class="btn  filter" id="filter"><i class=" fa icon-filter"></i></a>
                </div>
            @endcan
        </div>
    </div>
    <div class="card-body">
        <div class="table-responsive">
            <div class="d-block">
                <ul class="list-inline" style="padding-inline-start: 0px;">
                    <li class="list-inline-item">
                        <a href="{{ route('admin.groups.index') }}"
                           style="{{ request('show_deleted') == 1 ? '' : 'font-weight: 700' }}">{{trans('labels.general.all')}}</a>
                    </li>
                    |
                     <li class="list-inline-item">
                        <a href="{{ route('admin.groups.index') }}?show_deleted=1"
                           style="{{ request('show_deleted') == 1 ? 'font-weight: 700' : '' }}">{{trans('labels.general.trash')}}</a>
                    </li>
                </ul>
            </div>
            <div class="d-block">
                <div class="d-none" id="filterForm">
                    <form action="{{ route('admin.groups.filter_data') }}" method="POST" id="search-form"
                          class="flex-container">
                        @csrf
                        <div class="d-flex filter-items">
                            <div class="input-group mb-3">
                                <span class="input-group-text rounded-end fixed-label-width">@lang('labels.backend.courses.fields.group_title')</span>
                                <input type="text" class="form-control"
                                       placeholder="@lang('labels.backend.courses.fields.group_title')" name="group_name">
                            </div>
                            <div class="input-group mb-3">
                                <span class="input-group-text rounded-end fixed-label-width">@lang('labels.backend.courses.course-title')</span>
                                <input type="text" class="form-control"
                                       placeholder="@lang('labels.backend.courses.course-title')" name="course_name">
                            </div>
                            <div class="input-group mb-3">
                                <label class="input-group-text rounded-end fixed-label-width"
                                       for="type">@lang('labels.backend.courses.fields.type_choose')</label>
                                <select class="form-select js-example-placeholder-single" name="type">
                                    <option value="">@lang('labels.backend.courses.fields.type_choose')</option>
                                    @foreach ($types as $index => $type)
                                        <option value="{{ $index }}">{{ $type }}</option>
                                    @endforeach
                                </select>
                            </div>
                            <div class="input-group mb-3">
                                <span class="input-group-text rounded-end fixed-label-width">@lang('labels.backend.courses.fields.start_date')</span>
                                <input type="date" class="form-control"
                                       placeholder="@lang('labels.backend.courses.fields.start_date')"
                                       name="start_date">
                            </div>
                            <div class="input-group mb-3">
                                <span class="input-group-text rounded-end fixed-label-width">@lang('labels.backend.courses.fields.end_date')</span>
                                <input type="date" class="form-control"
                                       placeholder="@lang('labels.backend.courses.fields.end_date')" name="end_date">
                            </div>
                            <div class="input-group mb-3">
                                <span class="input-group-text rounded-end fixed-label-width">@lang('labels.backend.group.location')</span>
                                <select class="form-select js-example-placeholder-single" name="location">
                                    <option value="">{{ __('labels.general.all') }}</option>
                                    @foreach ($locations as $index => $location)
                                        <option value="{{ $index }}">{{ $location }}</option>
                                    @endforeach
                                </select>
                            </div>
                            <div class="input-group mb-3">
                                <span class="input-group-text rounded-end fixed-label-width" for="client">@lang('labels.backend.courses.fields.client')</span>
                                <select class="form-select js-example-placeholder-single" name="client">
                                    <option value="">{{ __('labels.general.all') }}</option>
                                    @foreach ($clients as $index => $client)
                                        <option value="{{ $index }}">{{ $client }}</option>
                                    @endforeach
                                </select>
                            </div>
                            <div class="input-group mb-3">
                                <span class="input-group-text rounded-end fixed-label-width" for="teacher">@lang('labels.backend.courses.fields.teacher')</span>
                                <select class="form-select js-example-placeholder-single" name="teacher">
                                    <option value="">{{ __('labels.general.all') }}</option>
                                    @foreach ($teachers as $teacher)
                                        <option value="{{ $teacher->id }}">{{ $teacher->name }}</option>
                                    @endforeach
                                </select>
                            </div>
                            <div class="input-group mb-3">
                                <span class="input-group-text rounded-end fixed-label-width">@lang('labels.backend.courses.fields.timeRange')</span>
                                <input type="text" class="form-control"
                                       placeholder="@lang('labels.backend.courses.fields.timeRange')" name="dateRange"
                                       id="dateRange">
                            </div>
                        </div>
                        <div class="filter-button">
                            <button type="submit"
                                    class="btn btn-success">@lang('labels.backend.courses.search')</button>
                        </div>
                    </form>
                </div>
                <table id="myTable"
                       class="table table-border table-hover  @can('course_delete') @if ( request('show_deleted') != 1 ) dt-select @endif @endcan">
                    <thead class="table-light">
                    <tr>
                        <th>@lang('labels.general.sr_no')</th>
                        <th>@lang('labels.backend.courses.fields.course-group-title')</th>

                        <th>@lang('labels.backend.courses.course-title')</th>

                        <th>@lang('labels.backend.courses.fields.start_date')</th>
                        <th>@lang('labels.backend.courses.fields.end_date')</th>
                        <th>@lang('labels.backend.courses.fields.enrolled_students')</th>
                        <th>@lang('labels.backend.teachers.fields.company')</th>

                        <th>@lang('labels.backend.courses.fields.teacher')</th>


                        @if (request('show_deleted') == 1)
                            <th>&nbsp; @lang('strings.backend.general.actions')</th>
                        @else
                            <th>&nbsp; @lang('strings.backend.general.actions')</th>
                        @endif
                    </tr>
                    </thead>
                    <tbody>

                    </tbody>
                </table>
            </div>
        </div>

    </div>
    </div>

@endsection

@push('after-scripts')
    <script>
        $(document).ready(function() {
            var route = '{{ route('admin.groups.get_group_data') }}';

            var params = [];

            @if(request()->has('teacher_id'))
            params.push('teacher_id=' + '{{ request('teacher_id') }}');
            @endif

            @if(request()->has('show_deleted'))
            params.push('show_deleted=' + '{{ request('show_deleted') }}');
            @endif

            if(params.length > 0) {
                route += '?' + params.join('&');
            }
            $('#myTable').DataTable({
                processing: true,
                serverSide: true,
                searching: true,
                iDisplayLength: 10,
                retrieve: true,
                dom: 'lfBrtip<"actions">',
                buttons: [{
                    extend: 'csv',
                    bom: true,
                    exportOptions: {
                        columns: [0, 1, 2, 3, 4, 5, 6, 7, 8]
                    }
                },
                    {
                        extend: 'print',
                        exportOptions: {
                            columns: [0, 1, 2, 3, 4, 5, 6, 7, 8]
                        }
                    },
                    'colvis'
                ],
                ajax: route,
                columns: [
                    {data: "DT_RowIndex", name: 'DT_RowIndex'},
                    {data: "title", name: 'title'},
                    {data: "course", name: "course"},
                    {data: "start", name: "start"},
                    {data: "end", name: "end"},
                    {data: "students", name: "students"},
                    {data: "clients", name: "clients"},
                    {data: "teachers", name: "teachers"},
                    {data: "actions", name: "actions"}
                ],
                columnDefs: [{
                    "width": "10%",
                    "targets": 0
                },
                    {
                        "width": "15%",
                        "targets": 8
                    },
                    {
                        "className": "text-center",
                        "targets": [0]
                    }
                ],
                createdRow: function (row, data, dataIndex) {
                    $(row).attr('data-entry-id', data.id);
                },
                language: {
                    url: "//cdn.datatables.net/plug-ins/9dcbecd42ad/i18n/{{ $locale_full_name }}.json",
                    buttons: {
                        colvis: '{{ trans('datatable.colvis') }}',
                        pdf: '{{ trans('datatable.pdf') }}',
                        csv: '{{ trans('datatable.csv') }}',
                    }
                }

            });
            $('#filter').on('click', function() {
                $('#filterForm').toggleClass('filter-form')
                $('#filterForm').toggleClass('d-none')
                // $('#filter').toggleClass('iconFilterM-T')

            })

        });

        // Date range picker
        document.addEventListener("DOMContentLoaded", function() {
            flatpickr("#dateRange", {
                mode: "range",
                dateFormat: "Y-m-d",
                // Additional options can be added here
            });
        });

    </script>
@endpush
