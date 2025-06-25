@inject('request', 'Illuminate\Http\Request')
@extends('backend.layouts.app')

@section('title', __('menus.backend.sidebar.students.title') . ' | ' . app_name())

@section('content')
    <style>
        .datetime {
            width: 100%;

            padding: 5px;
        }
        .headerr{
            top: 15%;
            /* width:80%;  */
            height:100px;
            background:white;
            /* position:fixed; */
            text-align: center;
            -webkit-box-shadow: 0 3px 5px rgba(57, 63, 72, 0.3);
                -moz-box-shadow: 0 3px 5px rgba(57, 63, 72, 0.3);
                box-shadow: 0 3px 5px rgba(57, 63, 72, 0.3);
                border: 1px solid #d7cece;
                padding: 20px;
                color: darkslategray;
                font-size: x-large;
                border-radius: 7px;
}
    </style>
    <div class="card"style="margin-top: 2%;">
        <div class="card-header">
            <h3 class="page-title d-inline">@lang('labels.backend.courses.students.title')</h3>
            <div class="float-right">
                <a href="{{ route('admin.group.students.all.add') }}"
                   class="btn btn-success">@lang('buttons.backend.access.users.addToGroup')
                </a>
                <a href="{{ route('admin.auth.user.create', ['type' => 'student']) }}"
                   class="btn btn-success">@lang('buttons.backend.access.users.createStudent')
                </a>
            </div>
        </div>
        <div class="card-body">
            <div class="row">
                <div class="col-12">
                    <div class="table-responsive">


                        <table id="myTable" class="table table-border table-hover">
                            <thead>
                                <tr>
                                    <th>@lang('labels.general.sr_no')</th>
                                    <th>@lang('labels.backend.courses.students.student_name')</th>
                                    {{-- groups in --}}
                                    <th>@lang('labels.backend.group.number')</th>
                                    <th>&nbsp; @lang('labels.backend.access.users.table.email')</th>
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

@endsection

@push('after-scripts')
    <script>


        $(document).ready(function () {
            var route = '{{ route('admin.group.students.get_data') }}';
            $('#myTable').DataTable({
                processing: true,
                serverSide: true,
                searching: true,
                iDisplayLength: 10,
                retrieve: true,
                dom: 'lfBrtip<"actions">',
                buttons: [
                    {
                        extend: 'csv',
                        bom: true,
                        exportOptions: {
                            columns: [ 0,1, 2]
                        }
                    },
                    {
                        extend: 'print',
                        exportOptions: {
                            columns: [ 0,1, 2]
                        }
                    },
                    'colvis'
                ],
                ajax: route,
                columns: [
                    {data: "DT_RowIndex", name: 'DT_RowIndex'},
                    {data: "name", name: 'name'},
                    {data: "groups_count", name: "groups_count"},
                    {data: "email", name: "email"},
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
