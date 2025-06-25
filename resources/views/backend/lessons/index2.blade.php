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
      <li class="breadcrumb-item"><a href="{{ route('admin.courses.index') }}"><i class="fa fa-home" ></i></a></li>
      <li class="breadcrumb-item">   {{session('locale')=='ar'?$course->type->name_ar:$course->type->name}} </li>
      <li class="breadcrumb-item" style="color:red">{{session('locale')=='ar'?$course->title_ar:$course->title}}</li>
    </ol>
  </nav>
    <div class="card"style="margin-top: 2%;">
        <div class="card-header">
            <h3 class="page-title d-inline">
                @lang('labels.backend.lessons.title')
               
            </h3>
            @can('lesson_create')
                <div class="float-right">
                    <a href="{{ route('admin.lessons.create') }}@if(request('course_id')){{'?course_id='.request('course_id')}}@endif"
                       class="btn btn-success"><i class="icon-plus" title="@lang('strings.backend.general.app_add_new')"></i></a>
                       <a href="{{ route('admin.courses.index') }}"
                       class="btn btn-primary">&#8592</a>
                </div>
            @endcan
        </div>
        <div class="card-body">
            <div class="row">
                {{-- <div class="col-12 col-lg-6 form-group">
                    {!! Form::label('course_id', trans('labels.backend.lessons.fields.course'), ['class' => 'control-label']) !!}
                    {!! Form::select('course_id', $courses,  (request('course_id')) ? request('course_id') : old('course_id'), ['class' => 'form-control js-example-placeholder-single select2 ', 'id' => 'course_id','disabled'=>true]) !!}
                </div>
                <div class="col-lg-6 form-group">
                    {!! Form::label('course_location_label', trans('labels.backend.courses.fields.location').'*', ['class' => 'control-label']) !!}
                    {!! Form::select('course_location_id[]', $courseLocations,'', ['class' => 'form-control select2 col-12 col-lg-12  js-example-placeholder-single2','placeholder'=>' ','required'=>true,'id'=>'course_location_id','disabled'=>true]) !!}
                   
                    
                </div> --}}
            </div>
            <div class="d-block">
                <ul class="list-inline">
                    <li class="list-inline-item">
                        <a href="{{ route('admin.lessons.index',['course_id'=>request('course_id')]) }}"
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
                <div class="table-responsive">

                    <table id="myTable"
                           class="table table-bordered table-striped @can('lesson_delete') @if ( request('show_deleted') != 1 ) dt-select @endif @endcan">
                        <thead>
                        <tr>                           
                            <th>#</th>
                            <th>@lang('labels.backend.lessons.title')</th>
                            <th>@lang('labels.backend.lessons.fields.chapter')</th>

                            {{-- <th>@lang('labels.backend.general-titles.locations')</th> --}}

                            <th>@lang('labels.backend.lessons.fields.published')</th>
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
            var route = '{{route('admin.lessons.get_data2')}}';

            @if(request()->course_id)
            $("#course_id").val('{{request()->course_id}}');
            @endif
            @if(request()->lesson_id)
            $("#lesson_id").val('{{request()->lesson_id}}');
            @endif
            @if(request()->course_location_id)
            $("#course_location_id").val('{{request()->course_location_id}}');
            @endif
            @if(request()->chapter_id)
            $("#chapter_id").val('{{request()->chapter_id}}');
            @endif
            @php
                $show_deleted = (request('show_deleted') == 1) ? 1 : 0;
                $course_id = (request('course_id') != "") ? request('course_id') : 0;
                $lesson_id = (request('lesson_id') != "") ? request('lesson_id') : 0;
                $course_location_id = (request('course_location_id') != "") ? request('course_location_id') : " ";
                $chapter_id = (request('chapter_id') != "") ? request('chapter_id') : " ";

            $route = route('admin.lessons.get_data',['show_deleted' => $show_deleted,'course_id' => $course_id,'course_location_id'=>$course_location_id,'chapter_id'=>$chapter_id,'lesson_id'=>$lesson_id]);
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
                        
                    {
                        data: "DT_RowIndex", name: 'DT_RowIndex'
                    },
                    {data: "title", name: 'title'},
                    {data: "chapter", name: 'chapter'},
                  

                    // {data: "locations", name: "locations"},

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

            @endif

            @can('lesson_delete')
            @if(request('show_deleted') != 1)
            $('.actions').html('<a href="' + '{{ route('admin.lessons.mass_destroy') }}' + '" class="btn btn-xs btn-danger js-delete-selected" style="margin-top:0.755em;margin-left: 20px;">Delete selected</a>');
            @endif
            @endcan


            $(".js-example-placeholder-single").select2({
                placeholder: "{{trans('labels.backend.lessons.select_course')}}",
            });
            $(".js-example-placeholder-single2").select2({
                placeholder: "{{trans('labels.backend.courses.fields.location')}}",
            });
            $(document).on('change', '#course_location_id', function (e) {
                var course_location_id = $(this).val();
                var course_id=$('#course_id').val();
              
                window.location.href = "{{route('admin.lessons.index')}}" + "?course_id=" + course_id+'&course_location_id='+course_location_id
           
            })
            $(document).on('change', '#course_id', function (e) {
                var course_id = $(this).val();
               
                var course_location_id=$('#course_location_id').val();
              
                window.location.href = "{{route('admin.lessons.index')}}" + "?course_id=" + course_id
  
                $.ajax({
                    url: "{{ url('/user/getCourseLoc/ajax/') }}/"+course_id,
                    type: "GET", 
                    dataType: "json",                  
                    success: function(data) {                                                
                        $('select[name="course_location_id[]"]').empty();
                        

                        $.each(data, function(key, value) {
                            $('select[name="course_location_id[]"]').append('<option value="'+ key +'">'+ value +'</option>');
                        });   
                    }
                })
               
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