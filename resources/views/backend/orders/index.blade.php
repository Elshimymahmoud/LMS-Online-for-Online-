@inject('request', 'Illuminate\Http\Request')
@extends('backend.layouts.app')
@section('title', __('labels.backend.orders.title').' | '.app_name())
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
                <a href="#" class="btn filter" id="filter"><i class=" fa icon-filter"></i></a>
            </div>
        </div>
        <div class="card-body">
            <div class="d-block">
                <ul class="list-inline">
                    <li class="list-inline-item">
                        <a href="{{ route('admin.orders.index') }}"
                           style="{{ request('offline_requests') == 1 ? '' : 'font-weight: 700' }}">{{trans('labels.general.all')}}</a>
                    </li>
                    |
                    <li class="list-inline-item">
                        <a href="{{ route('admin.orders.index') }}?offline_requests=1"
                           style="{{ request('offline_requests') == 1 ? 'font-weight: 700' : '' }}">{{trans('labels.backend.orders.offline_requests')}}</a>
                    </li>
                </ul>
            </div>
            <div class="d-block">
                <div class="d-none" id="filterForm">
                    <form action="#" method="POST" id="search-form"
                          class="flex-container">
                        @csrf
                        <div class="d-flex filter-items">
                            <div class="input-group mb-3">
                                <span class="input-group-text rounded-end fixed-label-width">@lang('labels.backend.orders.fields.name')</span>
                                <input type="text" class="form-control"
                                       placeholder="@lang('labels.backend.orders.fields.name')" name="name">
                            </div>
                            <div class="input-group mb-3">
                                <span class="input-group-text rounded-end fixed-label-width">@lang('labels.backend.orders.fields.reference_no')</span>
                                <input type="text" class="form-control"
                                       placeholder="@lang('labels.backend.orders.fields.reference_no')" name="reference_no">
                            </div>
                            <div class="input-group mb-3">
                                <label class="input-group-text rounded-end fixed-label-width"
                                       for="status">@lang('labels.backend.orders.fields.payment_status.title')</label>
                                <select class="form-select" name="status">
                                    <option value="">@lang('labels.general.all')</option>
                                    @foreach($payment_status as $index=>$status)
                                        <option value="{{ $index }}">{{ $status }}</option>
                                    @endforeach
                                </select>
                            </div>
                            <div class="input-group mb-3">
                                <label class="input-group-text rounded-end fixed-label-width"
                                       for="email">@lang('labels.backend.access.users.table.email')</label>
                                <input type="text" class="form-control"
                                       placeholder="@lang('labels.backend.access.users.table.email')" name="email">
                            </div>
                            <div class="input-group mb-3">
                                <label class="input-group-text rounded-end fixed-label-width"
                                       for="date" style="width: 100px;">@lang('labels.backend.orders.fields.date')</label>
                                <input type="date" class="form-control" name="date">
                            </div>

                        </div>
                        <div class="filter-button">
                            <button type="submit"
                                    id="filterSubmit"
                                    class="btn btn-success">@lang('labels.backend.courses.search')</button>
                        </div>
                    </form>
                </div>
            </div>
            <div class="table-responsive">

                <table id="myTable" class="table table-bordered table-striped">
                    <thead>
                    <tr>
                        <th style="text-align:center;">
                            <input type="checkbox" class="mass" id="select-all"/>
                        </th>
                        <th>@lang('labels.general.sr_no')</th>
                        <th>@lang('labels.backend.orders.fields.reference_no')</th>
                        <th>@lang('labels.backend.orders.fields.items')</th>
                        <th>@lang('labels.backend.orders.fields.amount') </th>
                        <th>@lang('labels.backend.orders.fields.user_email')</th>
                        <th>@lang('labels.backend.orders.fields.name')</th>

                        <th>@lang('labels.backend.orders.fields.payment-type')</th>
                        <th>@lang('labels.backend.orders.fields.payment_status.title')</th>

                        <th>@lang('labels.backend.orders.fields.date')</th>

                        <th>&nbsp; @lang('strings.backend.general.actions')</th>
                   
                    </tr>
                    </thead>
                    <tbody>
{{--                    @foreach($orders as $order)--}}
{{--                        <tr data-entry-id="{{ $order->id }}" role="row" class="odd">--}}
{{--                            <td class="text-center sorting_1"><input type="checkbox" class="single" name="id[]"--}}
{{--                                                                     value="{{ $order->id }}"></td>--}}
{{--                            <td>{{ $order->id }}</td>--}}
{{--                            <td>{{ $order->reference_no }}</td>--}}
{{--                            <td>--}}
{{--                                @foreach($order->items as $key => $item)--}}
{{--                                    @if($item->item != null)--}}
{{--                                        {{ $loop->iteration }}. {{ $item->item->title }}<br>--}}
{{--                                    @endif--}}
{{--                                @endforeach--}}
{{--                            </td>--}}
{{--                            <td>{{ $order->amount }}</td>--}}
{{--                            <td>--}}
{{--                                @if($order->status == 0)--}}
{{--                                    <span>@lang('labels.backend.orders.fields.payment_status.pending')</span>--}}
{{--                                @elseif($order->status == 1)--}}
{{--                                    <span>@lang('labels.backend.orders.fields.payment_status.completed')</span>--}}
{{--                                @else--}}
{{--                                    <span >@lang('labels.backend.orders.fields.payment_status.failed')</span>--}}
{{--                                @endif--}}
{{--                            </td>--}}
{{--                            <td>{{ $order->user ? $order->user->email : '' }}</td>--}}
{{--                            <td>{{ $order->user->full_name }}</td>--}}
{{--                            <td>{{ $order->payment_type }}</td>--}}
{{--                            <td>{{ $order->updated_at->diffforhumans() }}</td>--}}
{{--                            <td>--}}
{{--                                <a href="{{ route('admin.orders.show', $order) }}"  class="btn btn-xs btn-primary mb-1">--}}
{{--                                    <i class="icon-eye"></i>--}}
{{--                                </a>--}}
{{--                            </td>--}}
{{--                        </tr>--}}
{{--                    @endforeach--}}

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
            var route = '{{route('admin.orders.get_data')}}';
            $('#filterSubmit').on('click', function(e) {
                e.preventDefault(); // Prevent the form from submitting normally
                isFilterApplied = true;
                var params = $.param({
                    name: $('input[name="name"]').val(),
                    email: $('input[name="email"]').val(),
                    reference_no: $('input[name="reference_no"]').val(),
                    status: $('select[name="status"]').val(),
                    date: $('input[name="date"]').val(),
                });

                filterRoute = '{{route('admin.orders.filter_data')}}' + '?' + params;
                var table = $('#myTable').DataTable();

                // Set the new Ajax source
                table.ajax.url(filterRoute).load();
            });

            @if(request('offline_requests') == 1)
                route = '{{route('admin.orders.get_data',['offline_requests' => 1])}}';
            @endif

            $('#myTable').DataTable({
                processing: true,
                serverSide: true,
                iDisplayLength: 9,
                retrieve: true,
                dom: 'lfBrtip<"actions">',
                buttons: [
                    {
                        extend: 'csv',
                        bom: true,
                        exportOptions: {
                            columns: [ 1, 2, 3, 4, 5, 6, 7,8,9 ]
                        }
                    },
                    {
                        extend: 'print',
                        exportOptions: {
                            columns: [ 1, 2, 3, 4, 5, 6, 7 ,8,9]
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
                            return '<input type="checkbox" class="single" name="id[]" value="' + data.id + '" />';
                        }, "orderable": false, "searchable": false, "name": "id"
                    },
                    {data: "DT_RowIndex", name: 'DT_RowIndex'},
                    {data: "reference_no", name: 'reference_no'},
                    {data: "items", name: 'items'},
                    {data: "amount", name: 'amount'},
                    {data: "user_email", name: 'user_email'},
                    {data: "user_name", name: 'user_name'},
                    {
                        data: "payment_type",
                        name: 'payment_type',
                        // 3 == ofline payment
                        //
                        render: function(data, type, row) {
                            let paytype = '';
                                if(data == 2)
                                    paytype = '@lang('labels.backend.orders.fields.payment_type.admin')';
                                if(data==3)
                                    paytype = '@lang('labels.backend.orders.fields.payment_type.offline')';
                                if(data==4)
                                    paytype = '@lang('labels.backend.orders.fields.payment_type.myfatoorah')';
                                if(data==5)
                                    paytype = '@lang('labels.backend.orders.fields.payment_type.tabby')';
                                if(data == 6)
                                    paytype = '@lang('labels.backend.orders.fields.payment_type.jeel')';

                            return paytype;
                        }
                    },
                    {
                        data: 'payment',
                        name: 'payment',
                        render: function(data, type, row) {
                            let status = '';
                            if(data==0)
                                status = '@lang('labels.backend.orders.fields.payment_status.pending')';
                            if(data==1)
                                status = '@lang('labels.backend.orders.fields.payment_status.completed')';
                            if(data == 2)
                                status = '@lang('labels.backend.orders.fields.payment_status.failed')';
                            return status;
                        }
                    },
                    {data: "date", name: "date"},
                    {data: "actions", name: "actions"}
                ],
                @if(request('show_deleted') != 1)
                columnDefs: [
                    {"width": "5%", "targets": 0},
                    {"width": "10%", "targets": 8},
                    {"className": "text-center", "targets": [0]}
                ],
                @endif
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
            @can('course_delete')
            @if(request('show_deleted') != 1)
            $('.actions').html('<a href="' + '{{ route('admin.orders.mass_destroy') }}' + '" class="btn btn-xs btn-danger js-delete-selected" style="margin-top:0.755em;margin-left: 20px;">Delete selected</a>');
            @endif
            @endcan

        });
    </script>

@endpush