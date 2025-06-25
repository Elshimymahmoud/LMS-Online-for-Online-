@inject('request', 'Illuminate\Http\Request')
@extends('backend.layouts.app')
@section('title', __('labels.backend.orders.checkout_title').' | '.app_name())
@push('after-styles')
    <link rel="stylesheet" href="{{asset('assets/css/colors/switch.css')}}">
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
            <h3 class="page-title d-inline mb-0">@lang('labels.backend.orders.title')</h3>
            <div class="float-right">

            </div>
        </div>
        <div class="card-body">

            <div class="table-responsive">

                <table id="myTable" class="table table-bordered table-striped">
                    <thead>
                    <tr>
                        <th style="text-align:center;">
                            <input type="checkbox" class="mass" id="select-all"/>
                        </th>
                        <th>@lang('labels.general.sr_no')</th>
                        <th>@lang('labels.backend.orders.fields.user_name')</th>
                        <th>@lang('labels.backend.orders.fields.user_email')</th>
                        <th>@lang('labels.backend.orders.fields.user_phone')</th>
                        <th>@lang('labels.backend.orders.fields.items_count')</th>

                        <th>&nbsp; @lang('strings.backend.general.actions')</th>
                   
                    </tr>
                    </thead>
                    <tbody>


                    </tbody>
                </table>
            </div>
        </div>
    </div>
@stop

@push('after-scripts')
    <script>
        $(document).ready(function () {
            $('#filter').on('click', function () {
                $('#filterForm').toggleClass('filter-form')
                $('#filterForm').toggleClass('d-none')
            });
            let isFilterApplied = false;
            var route = ' {{ route('admin.checkout.get_data') }}';
            $('#filterSubmit').on('click', function(e) {
                e.preventDefault(); // Prevent the form from submitting normally
                isFilterApplied = true;
                var params = $.param({
                    name: $('input[name="name"]').val(),
                    email: $('input[name="email"]').val(),
                });

                filterRoute = '{{route('admin.checkout.filter_data')}}' + '?' + params;
                var table = $('#myTable').DataTable();

                // Set the new Ajax source
                table.ajax.url(filterRoute).load();
            });

            @if(request('offline_requests') == 1)
                route = '{{route('admin.checkout.get_data',['offline_requests' => 1])}}';
            @endif

            $('#myTable').DataTable({
                processing: true,
                serverSide: true,
                iDisplayLength: 6,
                retrieve: true,
                dom: 'lfBrtip<"actions">',
                buttons: [
                    {
                        extend: 'csv',
                        bom: true,
                        exportOptions: {
                            columns: [ 1, 2, 3, 4, 5, 6]
                        }
                    },
                    {
                        extend: 'print',
                        exportOptions: {
                            columns: [ 1, 2, 3, 4, 5, 6]
                        }
                    },
                    'colvis'
                ],
                ajax: route,
                drawCallback: function() {
                    isFilterApplied = false;
                },
                columns: [
                    {
                        data: function (data) {
                            console.log(data);
                            return '<input type="checkbox" class="single" name="user_id[]" value="' + data.user_id + '" />';
                        }, "orderable": false, "searchable": false, "name": "user_id"
                    },
                    {data: "DT_RowIndex", name: 'DT_RowIndex'},
                    {data: "user_name", name: 'user_name'},
                    {data: "user_email", name: 'user_email'},
                    {data: "user_phone", name: 'user_phone'},
                    {data: "item_count", name: 'item_count'},
                    {data: "actions", name: "actions"}
                ],
                @if(request('show_deleted') != 1)
                columnDefs: [
                    {"width": "5%", "targets": 0},
                    {"width": "10%", "targets": 6},
                    {"className": "text-center", "targets": [0]}
                ],
                @endif
                createdRow: function (row, data, dataIndex) {
                    $(row).attr('data-entry-id', data.user_id);
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
            @can('course_delete')
            @if(request('show_deleted') != 1)
                $('.actions').html('<a href="' + '{{ route('admin.checkout.mass_destroy') }}' + '" class="btn btn-xs btn-danger js-delete-selected" style="margin-top:0.755em;margin-left: 20px;">Delete selected</a>');
            @endif
            @endcan

        });
    </script>

@endpush