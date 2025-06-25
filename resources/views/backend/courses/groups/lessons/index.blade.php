@inject('request', 'Illuminate\Http\Request')
@extends('backend.layouts.app')
@section('title', __('labels.backend.lessons.title').' | '.app_name())
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
      <li class="breadcrumb-item">{{session('locale')=='ar'?$course->title_ar:$course->title}}</li>
      <li class="breadcrumb-item" style="color:red">{{session('locale')=='ar'?$group->title_ar:$group->title}}</li>
    </ol>
  </nav>
    <div>
        @include('includes.partials.messages')
    </div>
    <div class="card" style="margin-top: 2%;">
        <div class="card-header">
            <h3 class="page-title d-inline">
                @lang('labels.backend.lessons.title')
               
            </h3>
                <div class="float-right">
                       <a href="{{ route('admin.groups.index') }}"
                       class="btn btn-primary">&#8592</a>
                </div>
        </div>
        <div class="card-body">
            <div class="row">

            </div>


            @if(request('group') != "" || request('show_deleted') != "")
                <div class="table-responsive">

                    <table id="myTable"
                           class="table table-bordered table-striped @can('lesson_delete') @if ( request('show_deleted') != 1 ) dt-select @endif @endcan">
                        <thead>
                        <tr>                           
                            <th>#</th>
                            <th>@lang('labels.backend.lessons.title')</th>
                            <th>@lang('labels.backend.lessons.fields.chapter')</th>
                            {{-- <th>@lang('labels.backend.general-titles.locations')</th> --}}
                            @if($group->courses->type_id != 1)
                                <th>@lang('labels.backend.lessons.fields.date')</th>
                                <th>@lang('labels.backend.lessons.fields.from_time')</th>
                                <th>@lang('labels.backend.lessons.fields.to_time')</th>
                            @endif
                            <th>@lang('labels.backend.courses.fields.status')</th>
                            @if( request('show_deleted') == 1 )
                                <th>@lang('strings.backend.general.actions') &nbsp;</th>
                            @else
                                <th>@lang('strings.backend.general.actions') &nbsp;</th>
                            @endif
                        </tr>
                        </thead>
                        <tbody>

                        </tbody>
                    </table>

                </div>
            @endif

        </div>
    </div>



@stop
@push('after-scripts')
    <script src="{{asset('plugins/amigo-sorter/js/amigo-sorter.min.js')}}"></script>
    <script>

        $(document).ready(function () {


            $("#group_id").val('{{$group->id}}');


            @if(request()->chapter_id)
            $("#chapter_id").val('{{request()->chapter_id}}');
            @endif
            @php
                $show_deleted = (request('show_deleted') == 1) ? 1 : 0;
                $course_location_id = (request('course_location_id') != "") ? request('course_location_id') : " ";
                $chapter_id = (request('chapter_id') != "") ? request('chapter_id') : " ";

            $route = route('admin.groups.lessons.get_data',['group' => $group->id,'show_deleted' => $show_deleted,
            'chapter_id'=>$chapter_id, 'student_id'=>request('student_id')]);
            @endphp

            var route = '{{$route}}';
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
                            columns: [ 1, 2, 3, 4,5, 6, 7]
                        }
                    },
                    {
                        extend: 'print',
                        exportOptions: {
                            columns: [ 1, 2, 3, 4,5, 6, 7]
                        }
                    },
                    'colvis'
                ],
                ajax: route,
                columns: [

                    {data: "DT_RowIndex", name: 'DT_RowIndex'},
                    {data: "lesson", name: 'lesson'},
                    {data: "chapter", name: 'chapter'},
                    @if($group->courses->type_id != 1)
                        {data: "date", name: "date"},
                        {data: "start_time", name: "start_time"},
                        {data: "end_time", name: "end_time"},
                    @endif
                    {data: "status", name: 'status'},

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
            $(".js-example-placeholder-single2").select2({
                placeholder: "{{trans('labels.backend.courses.fields.location')}}",
            });


        }); 
        
        $('ul.sorter').amigoSorter({
            li_helper: "li_helper",
            li_empty: "empty",
        });
        $(document).on('click', '#save_timeline', function (e) {
            e.preventDefault();
            var list = [];
            $('ul.sorter li').each(function (key, value) {
                key++;
                var val = $(value).find('span').data('id');
                list.push({id: val, sequence: key});
            });

            $.ajax({
                method: 'POST',
                url: "{{route('admin.lessons.saveSequence')}}",
                data: {
                    _token: '{{csrf_token()}}',
                    list: list
                }
            }).done(function () {
                location.reload();
            });
        })


    </script>
@endpush