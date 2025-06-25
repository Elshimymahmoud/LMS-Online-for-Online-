@inject('request', 'Illuminate\Http\Request')
@extends('backend.layouts.app')
@section('title', __('labels.backend.tests_result.title').' | '.app_name())

@section('content')



    <div class="card">
        <div class="card-header">
            <h3 class="page-title d-inline">@lang('labels.backend.tests_result.title')</h3>
            @can('test_create')
                @if(count($tests_result)==0)
                    <div class="float-right">
                        <a href="{{ route('admin.tests_result.create')."?lesson_id=".request('lesson_id') }}"
                        class="btn btn-success">@lang('strings.backend.general.app_add_test') </a>

                    </div>
                @endif
            @endcan
        </div>

        <div class="card-body table-responsive">
             
              <div class="row">
                <div class="col-12 col-lg-6 form-group">
                    {!! Form::label('location_id', trans('labels.backend.courses.fields.location'), ['class' => 'control-label']) !!}
                    {!! Form::select('location_id', $locations,  (request('location_id')) ? request('location_id') : old('location_id'), ['onchange'=>'setData(event)','class' => 'form-control  select2 ','placeholder'=>trans('labels.backend.courses.fields.choose_location'), 'id' => 'location_id']) !!}
                </div>
            </div>
           
            <table id="myTable"
                   class="table table-bordered table-striped @can('test_delete') @if ( request('show_deleted') != 1 ) dt-select @endif @endcan">
                <thead>
                <tr>
                    @can('test_delete')
                        @if ( request('show_deleted') != 1 )
                            <th style="text-align:center;"><input type="checkbox" class="mass" id="select-all"/>
                            </th>@endif
                    @endcan
                    <th>@lang('labels.general.sr_no')</th>
                    <th>@lang('labels.backend.tests_result.fields.course')</th>
                    <th>@lang('labels.backend.tests_result.fields.title')</th>
                    <th>@lang('labels.backend.tests_result.fields.questions')</th>
                    <th>@lang('labels.backend.tests_result.fields.published')</th>
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
<script src="{{asset('plugins/amigo-sorter/js/amigo-sorter.min.js')}}"></script>

    <script>

        $(document).ready(function () {
            var route = '{{route('admin.tests_result.get_data')}}';


            @php
                $show_deleted = (request('show_deleted') == 1) ? 1 : 0;
                $lesson_id = (request('lesson_id') != "") ? request('lesson_id') : 0;
                $form_id = (request('id') != "") ? request('id') : (request('form_id')?request('form_id'):0);
                $form_type = (request('form_type') != "") ? request('form_type') : 'all';
               
                $location_id = (request('location_id') != "") ? request('location_id') : '0';

            $route = route('admin.tests_result.get_data',['show_deleted' => $show_deleted,'lesson_id' => $lesson_id,'form_id' => $form_id,'location_id'=>$location_id]);
            @endphp

            route = '{{$route}}';
            route = route.replace(/&amp;/g, '&');

 
            $('#myTable').DataTable({
                processing: true,
                serverSide: true,
                iDisplayLength: 10,
                retrieve: true,
                dom: 't<"actions">',
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
                    {data: "test", name: 'test'},
                    {data: "user", name: "user"},
                    {data: "test_result", name: "test_result"},
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

 

 
            $(document).on('change', '#lesson_id', function (e) {
                var lesson_id = $(this).val();
                window.location.href = "{{route('admin.tests_result.index')}}" + "?lesson_id=" + lesson_id
            });
            @can('test_delete')
            @if(request('show_deleted') != 1)
            $('.actions').html('<a href="' + '{{ route('admin.tests_result.mass_destroy') }}' + '" class="btn btn-xs btn-danger js-delete-selected" style="margin-top:0.755em;margin-left: 20px;">Delete selected</a>');
            @endif
            @endcan

            $(".js-example-placeholder-single").select2({
                placeholder: "{{trans('labels.backend.lessons.select_course')}}",
            });

        });


        function setData(event){
  
            $(document).on('change', '#location_id', function (e) {
                var location_id = $(this).val();
                var form_id='{{$form_id}}';
                var form_type='{{$form_type}}';

                window.location.href = "{{route('admin.tests_result.index')}}" + "?location_id=" + location_id+"&form_id="+ form_id+"&form_type="+ form_type
            });
        


        }

    </script>

@endpush