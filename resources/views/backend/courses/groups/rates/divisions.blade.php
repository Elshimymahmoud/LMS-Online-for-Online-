@extends('backend.layouts.app')

@section('title', __('labels.backend.rates.division.title').' | '.app_name())

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
        }

        ul.sorter li > span .btn {
            width: 20%;
        }


    </style>
@endpush

@section('content')
    <div class="card">
        <div class="card-header">
            <h3 class="page-title d-inline">@lang('labels.backend.rates.division.title')</h3>
            <div class="float-right">
                <a href="{{ route('admin.groups.rate.division.create', ['rate'=>$rate->id]) }}"
                   class="btn btn-success"><i class="icon-plus" title="@lang('strings.backend.general.app_add_new')"></i></a>
                <a href="{{ route('admin.group.rates') }}"
                   class="btn btn-primary"><i class="icon-arrow left"></i> @lang('strings.backend.general.app_back_to_list')</a>
            </div>
        </div>
        <div class="card-body table-responsive">
            <div class="row">
            </div>
            <div class="d-block">
                <ul class="list-inline">
                    <li class="list-inline-item">
                        <a href="{{ route('admin.group.rates') }}"
                           style="{{ request('show_deleted') == 1 ? '' : 'font-weight: 700' }}">{{trans('labels.general.all')}}</a>
                    </li>
                    |
                    <li class="list-inline-item">
                        <a href="{{trashUrl(request()) }}"
                           style="{{ request('show_deleted') == 1 ? 'font-weight: 700' : '' }}">{{trans('labels.general.trash')}}</a>
                    </li>
                </ul>
            </div>

            <table id="myTable"
                   class="table table-border table-hover @can('test_delete') @if ( request('show_deleted') != 1 ) dt-select @endif @endcan">
                <thead>
                    <tr>
                        @can('test_delete')
                            @if ( request('show_deleted') != 1 )
                                <th style="text-align:center;"><input type="checkbox" class="mass" id="select-all"/>
                                </th>@endif
                        @endcan

                        <th>@lang('labels.general.sr_no')</th>

                        <th>@lang('labels.backend.general-titles.title')</th>
                        <th>@lang('labels.backend.questions.number')</th>
                        <th>@lang('labels.backend.tests.fields.published')</th>

                        @if( request('show_deleted') == 1 )
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

@endsection

@push('after-scripts')

    <script>


        $(document).ready(function () {
            var route = '{{ route('admin.group.get_rate_divisions', ['rate_id' => $rate->id]) }}';

            @php
                $show_deleted = request('show_deleted') == 1 ? 1 : 0;
                $route = route('admin.group.get_rate_divisions', ['show_deleted' => $show_deleted, 'rate_id' => $rate->id]);
            @endphp
            route = '{{ $route }}';
            //remove &amp; from the url
            route = route.replace(/&amp;/g, '&');
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
                        @if(request('show_deleted') != 1){
                        "data": function (data) {
                            return '<input type="checkbox" class="single" name="id[]" value="' + data.id + '" />';
                        }, "orderable": false, "searchable": false, "name": "id"
                    }, @endif
                    {data: "DT_RowIndex", name: 'DT_RowIndex'},
                    {data: "title", name: "title"},
                    {data: "questions", name: "questions"},
                    {data: "published", name: "published"},
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

