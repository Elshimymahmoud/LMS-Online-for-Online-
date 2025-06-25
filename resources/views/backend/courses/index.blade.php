@extends('backend.layouts.app')

@section('title', __('labels.backend.courses.fields.location') . ' | ' . app_name())

@push('after-styles')
    <link rel="stylesheet" type="text/css" href="{{ asset('plugins/amigo-sorter/css/theme-default.css') }}">
    <style>
        ul.sorter>span {
            display: inline-block;
            width: 100%;
            height: 100%;
            background: #f5f5f5;
            color: #333333;
            border: 1px solid #cccccc;
            border-radius: 6px;
            padding: 0px;
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

        ul.sorter li>span .title {
            padding-left: 15px;
        }

        ul.sorter li>span .btn {
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
            color: #662434;
        }

        .filter-form {
            display: flex;
            width: 99%;
            background-color: #4f198d;
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

        .filter-button>input {
            color: #802d42;
            background-color: #fff;
        }

        .formcontent>input {

            color: white;
            width: 150px;
            margin: 10px;
            text-align: center;
            line-height: 75px;
            font-size: 15px;

        }

        .formcontent>label {
            color: white;
        }

        .iconFilterM-T {
            margin-top: 10px;
        }
        .fixed-label-width {
            width: 150px;
            margin-left:10px;
        }

    </style>
@endpush

@section('content')
    <div class="card">
        <div class="card-header">
            <h3 class="page-title float-left mb-0">@lang('labels.backend.courses.title')</h3>

            @can('course_create')
                <div class="float-right">
                    <a href="{{ route('admin.courses.create') }}"
                       class="btn btn-success"><i class="icon-plus" title="@lang('strings.backend.general.app_add_new')"></i></a>
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
                        <a href="{{ route('admin.courses.index') }}" style="{{ request('show_deleted') == 1 ? '' : 'font-weight: 700' }}">{{trans('labels.general.all')}}</a>
                    </li>
                    |
                    <li class="list-inline-item">
                        <a href="{{ route('admin.courses.index') }}?show_deleted=1" style="{{ request('show_deleted') == 1 ? 'font-weight: 700' : '' }}">{{trans('labels.general.trash')}}</a>
                    </li>
                </ul>
            </div>
            <div class="d-block">
                <div class="d-none" id="filterForm">
                    <form action="{{ route('admin.courses.filter_data') }}" method="POST" id="search-form" class="flex-container">
                        @csrf
                        <div class="d-flex filter-items">
                            <div class="input-group mb-3">
                                <span class="input-group-text rounded-end fixed-label-width">@lang('labels.backend.courses.course-title')</span>
                                <input type="text" class="form-control" placeholder="@lang('labels.backend.courses.course-title')" name="course_name">
                            </div>
                            <div class="input-group mb-3">
                                <label class="input-group-text rounded-end fixed-label-width" for="type">@lang('labels.backend.courses.fields.type')</label>
                                {!! Form::select('type', $types, old('type_id'), ['class' => 'form-select js-example-placeholder-single']) !!}
                            </div>
                            <div class="input-group mb-3">
                                <span class="input-group-text rounded-end fixed-label-width">@lang('labels.backend.courses.fields.start_date')</span>
                                <input type="date" class="form-control" placeholder="@lang('labels.backend.courses.fields.start_date')" name="start_date">
                            </div>
                            <div class="input-group mb-3">
                                <span class="input-group-text rounded-end fixed-label-width">@lang('labels.backend.courses.fields.end_date')</span>
                                <input type="date" class="form-control" placeholder="@lang('labels.backend.courses.fields.end_date')" name="end_date">
                            </div>
                            <div class="input-group mb-3">
                                <span class="input-group-text rounded-end fixed-label-width">@lang('labels.backend.courses.fields.location')</span>
                                <input type="text" class="form-control" placeholder="@lang('labels.backend.courses.fields.location')" name="location">
                            </div>
                            <div class="input-group mb-3">
                                <span class="input-group-text rounded-end fixed-label-width">@lang('labels.backend.courses.fields.price')</span>
                                <input type="text" class="form-control" placeholder="@lang('labels.backend.courses.fields.price')" name="price">
                            </div>
                            <div class="input-group mb-3">
                                <span class="input-group-text rounded-end fixed-label-width">@lang('labels.backend.courses.fields.client')</span>
                                <input type="text" class="form-control" placeholder="@lang('labels.backend.courses.fields.client')" name="client">
                            </div>
                            <div class="input-group mb-3">
                                <span class="input-group-text rounded-end fixed-label-width">@lang('labels.backend.courses.fields.teacher')</span>
                                <input type="text" class="form-control" placeholder="@lang('labels.backend.courses.fields.teacher')" name="teacher">
                            </div>
                            <div class="input-group mb-3">
                                <span class="input-group-text rounded-end fixed-label-width">@lang('labels.backend.courses.fields.timeRange')</span>
                                <input type="text" class="form-control" placeholder="@lang('labels.backend.courses.fields.timeRange')" name="dateRange" id="dateRange">
                            </div>
                        </div>
                        <div class="filter-button">
                            <button type="submit" class="btn btn-success">@lang('labels.backend.courses.search')</button>
                        </div>
                    </form>
                </div>
                <table id="myTable" class="table table-border table-hover  @can('course_delete') @if ( request('show_deleted') != 1 ) dt-select @endif @endcan">
                    <thead class="table-light">
                    <tr>
                        <th>@lang('labels.general.sr_no')</th>

                        <th>@lang('labels.backend.courses.course-title')</th>
                        <th>@lang('labels.backend.courses.fields.type')</th>
                        <th>@lang('labels.backend.courses.fields.category')</th>
                        <th>@lang('labels.backend.group.number')</th>
                        <th>@lang('labels.backend.courses.fields.classification')</th>
                        <th>@lang('labels.backend.courses.fields.level')</th>




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
        var route = '{{ route('admin.courses.getData') }}';

        var params = [];

        @if(request()->has('cat_id'))
        params.push('cat_id=' + '{{ request('cat_id') }}');
        @endif

        @if(request()->has('show_deleted'))
        params.push('show_deleted=' + '{{ request('show_deleted') }}');
        @endif

        if(params.length > 0) {
            route += '?' + params.join('&');
        }
        $(document).ready(function() {
            $('#myTable').DataTable({
                processing: true,
                serverSide: true,

                iDisplayLength: 10,
                retrieve: true,
                dom: 'lfBrtip<"actions">',
                ajax: route,
                columns: [
                    {data: 'id', name: 'id'},
                    {data: 'title', name: 'title'},
                    {data: 'type', name: 'type'},
                    {data: 'category', name: 'category'},
                    {data: 'groups', name: 'groups'},
                    {data: 'classification', name: 'classification'},
                    {data: 'level', name: 'level'},
                    {data: 'actions', name: 'actions', orderable: false, searchable: false},
                ],
                buttons: [{
                    extend: 'csv',
                    bom: true,
                    exportOptions: {
                        columns: [0, 1, 2, 3, 4, 5, 6]
                    }
                },
                    {
                        extend: 'print',
                        exportOptions: {
                            columns: [0, 1, 2, 3, 4, 5, 6]
                        }
                    },
                    'colvis'
                ],

                columnDefs: [],
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
