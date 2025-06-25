@inject('request', 'Illuminate\Http\Request')
@extends('backend.layouts.app')
@section('title', __('labels.backend.chapters.title').' | '.app_name())
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
      <li class="breadcrumb-item"><a href="{{ route('admin.courses.index') }}"><i class="fa fa-home" ></i></a></li>
      <li class="breadcrumb-item">   {{session('locale')=='ar'?$course->type->name_ar:$course->type->name}} </li>
      <li class="breadcrumb-item" style="color:red">{{session('locale')=='ar'?$course->title_ar:$course->title}}</li>

      
    </ol>
  </nav>
    <div class="card"style="margin-top: 2%;">
        <div class="card-header">
            <h3 class="page-title d-inline">@lang('labels.backend.chapters.title')</h3>
    
            @can('lesson_create')
                <div class="float-right">
                    <a href="{{ route('admin.chapters.create') }}@if(request('course_id')){{'?course_id='.request('course_id').'&course_location_id='.request('course_location_id')}}@endif"
                       class="btn btn-success"><i class="icon-plus" title="@lang('strings.backend.general.app_add_new')"></i></a>
                       <a href="{{ route('admin.courses.index') }}"
                   class="btn btn-primary">&#8592</a>
                </div>
                <div class="float-right" style="margin-left: 10px">
                    {{-- <a href="{{ route('admin.chapters.rearrange') }}@if(request('course_id')){{'?course_id='.request('course_id')}}@endif"
                       class="btn btn-success">@lang('labels.backend.chapters.rearrange')</a> --}}

                </div>
            @endcan 
        </div>
       
        <div class="card-body">
            <div class="row">
                {{-- <div class="col-12 col-lg-6 form-group">
                    {!! Form::label('course_id', trans('labels.backend.chapters.fields.course'), ['class' => 'control-label']) !!}
                    {!! Form::select('course_id', $courses,  (request('course_id')) ? request('course_id') : old('course_id'), ['class' => 'form-control js-example-placeholder-single select2 ', 'id' => 'course_id']) !!}
                </div> --}}
            </div>
            <div class="d-block">
                <ul class="list-inline">
                    <li class="list-inline-item">
                        <a href="{{ route('admin.chapters.index',['course_id'=>request('course_id')]) }}"
                           style="{{ request('show_deleted') == 1 ? '' : 'font-weight: 700' }}">{{trans('labels.general.all')}}</a>
                    </li>
                    |
                    <li class="list-inline-item">
                        <a href="{{trashUrl(request()) }}"
                           style="{{ request('show_deleted') == 1 ? 'font-weight: 700' : '' }}">{{trans('labels.general.trash')}}</a>
                    </li>
                </ul>
            </div>

            @if(request('course_id') != "" || request('show_deleted') != "")

                    <table id="myTable"  class="table table-hover table-sm  @can('lesson_delete') @if ( request('show_deleted') != 1 ) dt-select @endif @endcan">
                        <thead>
                        <tr>
                            @can('lesson_delete')
                                @if ( request('show_deleted') != 1 )
                                    <th style="text-align:center;"><input class="mass" type="checkbox" id="select-all"/>
                                    </th>@endif
                            @endcan
                            <th> # </th>
                            <th>@lang('labels.backend.general-titles.title')</th>
                            <th>@lang('menus.backend.sidebar.lessons.title')</th>
                             @if( request('show_deleted') == 1 )
                                <th style="width: 20%">@lang('strings.backend.general.actions') &nbsp;</th>
                            @else
                                <th style="width: 20%">@lang('strings.backend.general.actions') &nbsp;</th>
                            @endif
                        </tr>
                        </thead>
                        <tbody>
                        </tbody>
                    </table>

            @endif

        </div>
    </div>

@stop

@push('after-scripts')
    <script>

        $(document).ready(function () {
            var route = '{{route('admin.chapters.get_data2')}}';


            @php
                $show_deleted = (request('show_deleted') == 1) ? 1 : 0;
                $course_id = (request('course_id') != "") ? request('course_id') : 0;
                $course_location_id = (request('course_location_id') != "") ? request('course_location_id') : 0;

            $route = route('admin.chapters.get_data2',['show_deleted' => $show_deleted,'course_id' => $course_id,'course_location_id'=>$course_location_id]);
            
            @endphp

            route = '{{$route}}';
            route = route.replace(/&amp;/g, '&');


            @if(request('course_id') != "" || request('show_deleted') != "")

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
                            columns: [ 1, 2, 3, 4]
                        }
                    },
                    {
                        extend: 'print',
                        exportOptions: {
                            columns: [ 1, 2, 3, 4]
                        }
                    },
                    'colvis'
                ],
                ajax: route,
                columns: [
                        @if(request('show_deleted') != 1 && auth()->user()->can('lesson_delete'))
                    {
                        "data": function (data) {
                            return '<input type="checkbox" class="single" name="id[]" value="' + data.id + '" />';
                        }, "orderable": false, "searchable": false, "name": "id"
                    },
                        @endif
                    {
                        data: "DT_RowIndex", name: 'DT_RowIndex'
                    },
                    {data: "title", name: 'title'},
                    {data: "lessons", name: 'lessons'},
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

            @endif

            @can('lesson_delete')
            @if(request('show_deleted') != 1)
            $('.actions').html('<a href="' + '{{ route('admin.chapters.mass_destroy') }}' + '" class="btn btn-xs btn-danger js-delete-selected" style="margin-top:0.755em;margin-left: 20px;">Delete selected</a>');
            @endif
            @endcan


            $(".js-example-placeholder-single").select2({
                placeholder: "{{trans('labels.backend.chapters.select_course')}}",
            });
            $(document).on('change', '#course_id', function (e) {
                var course_id = $(this).val();
                window.location.href = "{{route('admin.chapters.index')}}" + "?course_id=" + course_id
            });
        });

    </script>
@endpush