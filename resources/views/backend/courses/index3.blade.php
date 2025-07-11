@inject('request', 'Illuminate\Http\Request')
@extends('backend.layouts.app')
@section('title', __('labels.backend.courses.title').' | '.app_name())
@push('after-styles')
    <style>
.drop:hover{

   overflow: scroll !important;
   max-height: 200px !important;
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
                       <a href="{{ route('admin.courses.add_students_to_course') }}"
                       class="btn btn-success">@lang('buttons.backend.access.users.addToCourse')</a>
                       <a href="{{ route('admin.courses.remove_students_from_course') }}"
                       class="btn btn-success">@lang('buttons.backend.access.users.removeFromCourse')</a>

                </div>
            @endcan
        </div>
        <div class="card-body">
            <div class="table-responsive">
                <div class="d-block">
                    <ul class="list-inline" style="padding-inline-start: 0px;">
                        <li class="list-inline-item">
                            <a href="{{ route('admin.courses.index') }}"
                               style="{{ request('show_deleted') == 1 ? '' : 'font-weight: 700' }}">{{trans('labels.general.all')}}</a>
                        </li>
                        |
                        <li class="list-inline-item">
                            <a href="{{ route('admin.courses.index') }}?show_deleted=1"
                               style="{{ request('show_deleted') == 1 ? 'font-weight: 700' : '' }}">{{trans('labels.general.trash')}}</a>
                        </li>
                    </ul>
                </div>


                <table id="myTable" class="table table-bordered table-striped @can('course_delete') @if ( request('show_deleted') != 1 ) dt-select @endif @endcan">
                    <thead>
                    <tr>
                        @can('course_delete')
                            @if ( request('show_deleted') != 1 )
                                <th style="text-align:center;"><input type="checkbox" class="mass" id="select-all"/></th>@endif
                        @endcan


                        @if (Auth::user()->isAdmin())
                                <th>@lang('labels.general.sr_no')</th>
                                <th>@lang('labels.backend.courses.fields.teachers')</th>
                        @else
                                <th>@lang('labels.general.sr_no')</th>





                            @endif

                        <th>@lang('labels.backend.courses.course-title')</th>
                        <th>@lang('labels.backend.courses.fields.type')</th>

                        <th>@lang('labels.backend.courses.fields.category')</th>
                        {{-- <th>@lang('labels.backend.courses.fields.price') <br><small>(in {{$appCurrency['symbol']}})</small></th> --}}
                            <th>@lang('labels.backend.courses.fields.status')</th>
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
    </div>
@stop

@push('after-scripts')
    <script>

        $(document).ready(function () {
            setTimeout(() => {
                $('#moreCourse').hover(function(){
                console.log($(this)[0].firstChild);
                $(this)[0].firstChild.focus()
            })
            }, 1000);

            var route = '{{route('admin.courses.get_data2')}}';

            @if(request('show_deleted') == 1)
                route = '{{route('admin.courses.get_data2',['show_deleted' => 1])}}';
            @endif

            @if(request('teacher_id') != "")
                route = '{{route('admin.courses.get_data2',['teacher_id' => request('teacher_id')])}}';
            @endif

            @if(request('cat_id') != "")
                route = '{{route('admin.courses.get_data2',['cat_id' => request('cat_id')])}}';
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
                            columns: [ 1, 2, 3, 4,5,6]
                        }
                    },
                    {
                        extend: 'print',
                        exportOptions: {
                            columns: [ 1, 2, 3, 4,5 ,6]
                        }
                    },
                    'colvis'
                ],
                ajax: route,
                columns: [
                        @if(request('show_deleted') != 1 && Auth::user()->isAdmin())
                    { "data": function(data){
                        return '<input type="checkbox" class="single" name="id[]" value="'+ data.id +'" />';
                    }, "orderable": false, "searchable":false, "name":"id" },
                        @endif
                        @if (Auth::user()->isAdmin())
                    {data: "DT_RowIndex", name: 'DT_RowIndex'},
                    {data: "teachers", name: 'teachers'},

                    @else
                    {data: "DT_RowIndex", name: 'DT_RowIndex'},

                    @endif
                    {data: "title", name: 'title'},
                    {data: "type", name: 'type'},

                    {data: "category", name: 'category'},
                    // {data: "price", name: "price"},
                    {data: "status", name: "status"},
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
            {{--@can('course_delete')--}}
            {{--@if(request('show_deleted') != 1)--}}
            {{--$('.actions').html('<a href="' + '{{ route('admin.courses.mass_destroy') }}' + '" class="btn btn-xs btn-danger js-delete-selected" style="margin-top:0.755em;margin-left: 20px;">Delete selected</a>');--}}
            {{--@endif--}}
            {{--@endcan--}}
        });

    </script>

@endpush