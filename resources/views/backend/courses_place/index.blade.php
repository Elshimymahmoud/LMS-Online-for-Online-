@extends('backend.layouts.app')
@section('title', __('menus.backend.sidebar.courses_place.title').' | '.app_name())

@section('content')

    <div class="card">
        <div class="card-header">
            @if(isset($course_places))
            <h3 class="page-title d-inline">@lang('menus.backend.sidebar.courses_place.title')</h3>
                <div class="float-right">
                    <a href="{{ route('admin.courses_place.create') }}"
                       class="btn btn-success">@lang('labels.backend.clients.view')</a>
                </div>
            @else
                <h3 class="page-title d-inline">@lang('menus.backend.sidebar.courses_place.title')</h3>
                <div class="float-right">
                       <a href="{{ route('admin.courses_place.create') }}"
                       class="btn btn-success">@lang('labels.backend.clients.createunite')</a>
                </div>
            @endif

        </div>
        <div class="card-body">

            <!-- ************** -->
            <div class="row">
                <div class="col-12">
                    <div class="table-responsive">



                        <table id="myTable"
                               class="table table-bordered table-striped @can('category_delete') @if ( request('show_deleted') != 1 ) dt-select @endif @endcan">
                            <thead>
                            <tr>

                                @can('category_delete')
                                    @if ( request('show_deleted') != 1 )
                                        <th style="text-align:center;"><input type="checkbox" class="mass"
                                                                              id="select-all"/>
                                        </th>@endif
                                @endcan

                                <th>@lang('labels.general.sr_no')</th>
                                <th>@lang('labels.backend.clients.fields.name_ar')</th>
                                <th>@lang('labels.backend.clients.fields.name_en')</th>
                                <th>&nbsp; @lang('strings.backend.general.actions')</th>
                               
                            </tr>
                            </thead>

                            <tbody>
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>

@stop

@push('after-scripts')
    <script>

        $(document).ready(function () {
            var route = '{{route('admin.courses_place.get_data')}}';

            @if(request('show_deleted') == 1)
                route = '{{route('admin.courses_place.get_data',['show_deleted' => 1])}}';
            @endif

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
                            columns: [ 1, 2]
                        }
                    },
                    {
                        extend: 'print',
                        exportOptions: {
                            columns: [ 1, 2]
                        }
                    },
                    'colvis'
                ],
                ajax: route,
                columns: [
                        @if(request('show_deleted') != 1)
                    {
                        "data": function (data) {
                            return '<input type="checkbox" class="single" name="id[]" value="' + data.id + '" />';
                        }, "orderable": false, "searchable": false, "name": "id"
                    },
                        @endif
                    {
                        data: "DT_RowIndex", name: 'DT_RowIndex'
                    },
                    
                    // {data: "logo", name: 'logo'},
                    {data: "name_ar", name: "name_ar"},
                    {data: "name", name: 'name'},
                    // {data: "status", name: "status"},
                    {data: "actions", name: "actions"}
                ],
                @if(request('show_deleted') != 1)
                columnDefs: [
                    {"width": "5%", "targets": 0},
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
            $('.actions').html('<a href="' + '{{ route('admin.courses_place.mass_destroy') }}' + '" class="btn btn-xs btn-danger js-delete-selected" style="margin-top:0.755em;margin-left: 20px;">Delete selected</a>');


            @if(request()->has('create'))
                $('#createCatBtn').click();
            @endif
        });

       

    </script>

@endpush