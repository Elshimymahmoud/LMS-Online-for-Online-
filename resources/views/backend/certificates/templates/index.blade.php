@extends('backend.layouts.app')

@section('title', __('labels.backend.cert_templates.title') . ' | ' . app_name())

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
            color: #662434;
        }

        .filter-form {
            display: flex;
            width: 99%;
            background-color: #802d42;
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
            <h3 class="page-title float-left mb-0">@lang('labels.backend.cert_templates.title')</h3>

            @can('course_create')
                <div class="float-right">
                    <a href="{{ route('admin.certificates.templates.create') }}"
                       class="btn btn-success"><i class="icon-plus"
                                                  title="@lang('strings.backend.general.app_add_new')"></i></a>
                </div>
            @endcan
        </div>
    </div>
    <div class="card-body">
        <div class="table-responsive">
            <div class="d-block">
                <ul class="list-inline" style="padding-inline-start: 0px;">
                    <li class="list-inline-item">
                        <a href="{{ route('admin.certificates.templates.create') }}"
                           style="{{ request('show_deleted') == 1 ? '' : 'font-weight: 700' }}">{{trans('labels.general.all')}}</a>
                    </li>
                    |
                     <li class="list-inline-item">
                        <a href="{{ route('admin.certificates.templates.create') }}?show_deleted=1"
                           style="{{ request('show_deleted') == 1 ? 'font-weight: 700' : '' }}">{{trans('labels.general.trash')}}</a>
                    </li>
                </ul>
            </div>
            <div class="d-block">

                <table id="myTable"
                       class="table table-border table-hover  @can('course_delete') @if ( request('show_deleted') != 1 ) dt-select @endif @endcan">
                    <thead class="table-light">
                    <tr>
                        <th>@lang('labels.general.sr_no')</th>
                        <th>@lang('labels.backend.cert_templates.image')</th>

                        <th>@lang('labels.backend.cert_templates.name')</th>

                        <th>@lang('labels.backend.cert_templates.type')</th>
                        <th>@lang('labels.backend.cert_templates.status')</th>


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
        $(document).ready(function () {
            var route = '{{ route('admin.certificates.templates.get_data') }}';


            $('#myTable').DataTable({
                processing: true,
                serverSide: true,
                iDisplayLength: 10,
                retrieve: true,
                dom: 'lfBrtip<"actions">',
                buttons: [
                    {
                        extend: 'csv',
                        bom: true,
                        exportOptions: {
                            columns: [ 0,1, 2,3, 4]
                        }
                    },
                    {
                        extend: 'print',
                        exportOptions: {
                            columns: [ 0,1, 2, 3, 4]
                        }
                    },
                    'colvis'
                ],
                ajax: route,
                columns: [
                    {data: "DT_RowIndex", name: 'DT_RowIndex'},
                    {data: "bg_image", name: "bg_image"},
                    {data: "title", name: "title"},
                    {data: "type", name: "type"},
                    {data: "status", name: "status"},
                    {data: "actions", name: "actions"}
                ],
                columnDefs: [
                    {"width": "10%", "targets": 0},
                    {"width": "15%", "targets": 4},
                    {"className": "text-center", "targets": [0]}
                ],
                createdRow: function (row, data, dataIndex) {
                    $(row).attr('data-entry-id', data.id);
                },
                language:{
                    url : "//cdn.datatables.net/plug-ins/9dcbecd42ad/i18n/{{$locale_full_name}}.json",
                    buttons :{
                        colvis : '{{trans("datatable.colvis")}}',
                        pdf : '{{trans("datatable.pdf")}}',
                        csv : '{{trans("datatable.csv")}}',
                    }
                }

            });



        });

    </script>
@endpush
