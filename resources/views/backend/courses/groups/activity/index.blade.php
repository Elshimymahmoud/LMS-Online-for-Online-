@inject('request', 'Illuminate\Http\Request')
@extends('backend.layouts.app')
@section('title', __('labels.backend.activities.title').' | '.app_name())
@push('after-styles')
<style>
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
@endpush
@section('content')


    <div class="card"style="margin-top: 2%;">
        <div class="card-header">

            <h3 class="page-title d-inline">@lang('labels.backend.activities.title')</h3>
            @can('test_create') 
                <div class="float-right">
                    @if(request('group_id'))
                        <a href="{{ route('admin.courses.groups.activity.atttach', ['group'=>request('group_id')]) }}"
                           class="btn btn-success"><i class="icon-plus" title="@lang('strings.backend.general.app_add_new')"></i></a>
                        <a href="{{ route('admin.groups.index') }}"
                           class="btn btn-primary"><i class="icon-arrow left"></i> @lang('strings.backend.general.app_back_to_list')</a>
                    @else
                        <a href="{{ route('admin.courses.groups.activity.create') }}"
                           class="btn btn-success"><i class="icon-plus" title="@lang('strings.backend.general.app_add_new')"></i></a>
                    @endif
                </div>
               
            @endcan
        </div>
        <div class="card-body table-responsive">
            <div class="row">
            </div>
            <div class="d-block">
                <ul class="list-inline">
                    <li class="list-inline-item">
                        <a href="{{ route('admin.courses.groups.activity.index') }}"
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
                    <th style="max-width: 100px">@lang('labels.backend.tests.fields.title')</th>
                    <th>@lang('labels.backend.group.number')</th>
                    <th>@lang('labels.backend.tests.fields.published')</th>
                    @if( request('show_deleted') == 1 )
                        <th>@lang('labels.general.actions')</th>

                    @else
                        <th>@lang('labels.general.actions')</th>
                    @endif
                </tr>
                </thead>

                <tbody>

                </tbody>
            </table>

        </div>
    </div>
@stop

@push('after-scripts')
    <script>

        $(document).ready(function () {
            var route = '{{route('admin.courses.groups.activity.get_data')}}';

            @php
                $show_deleted = (request('show_deleted') == 1) ? 1 : 0;
                if(request('group_id')){
                    $group_id = request('group_id');
                    $route = route('admin.courses.groups.activity.get_data',['show_deleted' => $show_deleted,'group_id' => $group_id]);
                }
                else{
                    $route = route('admin.courses.groups.activity.get_data',['show_deleted' => $show_deleted]);
                }
            @endphp

                route = '{{$route}}';
                //remove &amp; from url
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
                            columns: [ 1, 2, 3, 4,5]
                        }
                    },
                    {
                        extend: 'print',
                        exportOptions: {
                            columns: [ 1, 2, 3, 4,5]
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
                    {data: "DT_RowIndex", name: 'DT_RowIndex'},
                    {data: "title", name: 'title'},
                    {data: "course_groups_count", name: "course_groups_count"},
                    {data: "published", name: "published"},
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

        });

    </script>

@endpush