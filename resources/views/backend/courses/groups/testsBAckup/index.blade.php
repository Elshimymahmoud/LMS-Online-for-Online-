@inject('request', 'Illuminate\Http\Request')
@extends('backend.layouts.app')
@section('title', __('labels.backend.tests.title').' | '.app_name())
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


<nav aria-label="breadcrumb" class="headerr ">
    <ol class="breadcrumb">
      <li class="breadcrumb-item"><a href="{{ route('admin.groups.index') }}"><i class="fa fa-home" ></i></a></li>
      <li class="breadcrumb-item">   {{session('locale')=='ar'?$course->type->name_ar:$course->type->name}} </li>
      <li class="breadcrumb-item" style="color:red">{{session('locale')=='ar'?$course->title_ar:$course->title}}</li>
      <li class="breadcrumb-item">{{ date('d-m-Y', strtotime($group->start)) ?? '' }}</li>
      <li class="breadcrumb-item active">{{session('locale')=='ar'?$location->name_ar ?? '':$location->name ?? ''}}</li>

      
    </ol>
  </nav>
    <div class="card"style="margin-top: 2%;">
        <div class="card-header">
            <h3 class="page-title d-inline">@lang('labels.backend.tests.title')</h3>
            @can('test_create') 
                <div class="float-right">
                    <a href="{{ route('admin.courses.groups.tests.create', ['group' => $group->id]) }}"
                       class="btn btn-success"><i class="icon-plus" title="@lang('strings.backend.general.app_add_new')"></i></a>
                       <a href="{{  url()->previous() }}"
                       class="btn btn-primary">&#8592</a>
                </div>
               
            @endcan
        </div>
        <div class="card-body table-responsive">
            <div class="row">
            </div>
            <div class="d-block">
                <ul class="list-inline">
                    <li class="list-inline-item">
                        <a href="{{ route('admin.courses.groups.tests.index', ['group' => $group->id]) }}"
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
                    <th style="max-width: 100px">@lang('labels.backend.tests.fields.course')</th>
                    <th>@lang('labels.backend.tests.fields.title')</th>
                    <th>@lang('labels.backend.tests.fields.questions')</th>
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
            var route = '{{route('admin.courses.groups.tests.get_data')}}';

            $("#group_id").val('{{ $group->id ?? '' }}');

            @php
                $show_deleted = (request('show_deleted') == 1) ? 1 : 0;
                $group_id = $group->id ?? "";
                $route = route('admin.courses.groups.tests.get_data',['show_deleted' => $show_deleted,'group_id' => $group_id,'form_type'=>'group_test']);
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
                    {data: "course", name: 'course'},
                        @if(Lang::locale()=='en')
                    {data: "title", name: 'title'},
                        @else
                    {data: "title_ar", name: 'title_ar'},

                        @endif
                    {data: "questions", name: "questions"},
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

            $(".js-example-placeholder-single").select2({
                placeholder: "{{trans('labels.backend.lessons.select_course')}}",
            });

        });

        function checkCourse(group_id){
            console.log(group_id);
        if(group_id==0){
            alert('plz choose course')
        }
    }
    </script>

@endpush