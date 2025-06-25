@extends('backend.layouts.app')
@section('title', __('labels.backend.clients.title').' | '.app_name())

@section('content')

    <div class="card">
        <div class="card-header">
            @if(isset($course_unites))
            <h3 class="page-title d-inline">@lang('labels.backend.clients.edit')</h3>
                <div class="float-right">
                    <a href="{{ route('admin.courses_place_unit.index') }}"
                       class="btn btn-success">@lang('labels.backend.clients.view')</a>
                       <a href="{{ route('admin.courses_place.index') }}"
                       class="btn btn-success">@lang('labels.backend.clients.view_place')</a>
                </div>
            @else
                <h3 class="page-title d-inline">@lang('labels.backend.clients.create')</h3>
                <div class="float-right">
                    <a data-toggle="collapse" id="createCatBtn" data-target="#createCat" href="#"
                       class="btn btn-success"><i class="icon-plus" title="@lang('strings.backend.general.app_add_new')"></i></a>
                       <a href="{{ route('admin.courses_place.index') }}"
                       class="btn btn-success">@lang('labels.backend.clients.view_place')</a>
                       
                </div>
            @endif

        </div>
        <div class="card-body">
            <div class="row @if(!isset($course_unites)) collapse @endif" id="createCat">
                <div class="col-12">
                   
                @if(isset($course_unites))
                        {!! Form::model($course_unites, ['method' => 'PUT', 'route' => ['admin.courses_place_unit.update', $course_unites->id], 'files' => true,]) !!}
                    @else
                        {!! Form::open(['method' => 'POST', 'route' => ['admin.courses_place_unit.store'], 'files' => true,]) !!}
                    @endif
                    <div class="row">
                    <div class="col-lg-4 col-12 form-group mb-0">
                            {!! Form::label('place_id', trans('labels.backend.clients.fields.place_name').' *', ['class' => 'control-label']) !!}
                            {!! Form::select('place_id', $course_place, old('place_id'), ['class' => 'form-control select2 js-example-placeholder-single', 'multiple' => 'false', 'required' => true]) !!}
                   
                        </div>
                        <div class="col-lg-4 col-12 form-group mb-0">
                            {!! Form::label('name', trans('labels.backend.clients.fields.name').' *', ['class' => 'control-label']) !!}
                            {!! Form::text('name', old('name'), ['class' => 'form-control', 'placeholder' => trans('labels.backend.clients.fields.name'), 'required' => false]) !!}

                        </div>
                        <div class="col-lg-4 col-12 form-group mb-0">
                            {!! Form::label('name_ar', trans('labels.backend.clients.fields.name_ar').' *', ['class' => 'control-label']) !!}
                            {!! Form::text('name_ar', old('name_ar'), ['class' => 'form-control', 'placeholder' => trans('labels.backend.clients.fields.name'), 'required' => false]) !!}

                        </div>
            

                 
                        <div class="col-12 form-group mt-3 text-center  mb-0 ">

                            {!! Form::submit(trans('strings.backend.general.app_save'), ['class' => 'btn mt-auto  btn-danger']) !!}
                        </div>
                    </div>

                    {!! Form::close() !!}
                        <hr>


                </div>

            </div>
            <!-- **************** -->

            <!-- ************** -->
            <div class="row">
                <div class="col-12">
                    <div class="table-responsive">
                        <div class="d-block">
                            <ul class="list-inline">
                                <li class="list-inline-item">
                                    <a href="{{ route('admin.courses_place_unit.index') }}"
                                       style="{{ request('show_deleted') == 1 ? '' : 'font-weight: 700' }}">{{trans('labels.general.all')}}</a>
                                </li>
                                |
                                <li class="list-inline-item">
                                    <a href="{{ route('admin.courses_place_unit.index') }}?show_deleted=1"
                                       style="{{ request('show_deleted') == 1 ? 'font-weight: 700' : '' }}">{{trans('labels.general.trash')}}</a>
                                </li>
                            </ul>
                        </div>


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
                                
                                <th>@lang('labels.backend.clients.fields.name')</th>
                                
                                <th>@lang('labels.backend.clients.fields.name_ar')</th>
                                
                                
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
            var route = '{{route('admin.courses_place_unit.get_data')}}';

            @if(request('show_deleted') == 1)
                route = '{{route('admin.courses_place_unit.get_data',['show_deleted' => 1])}}';
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
                    {data: "name", name: 'name'},
                    {data: "name_ar", name: "name_ar"},
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
            $('.actions').html('<a href="' + '{{ route('admin.courses_place_unit.mass_destroy') }}' + '" class="btn btn-xs btn-danger js-delete-selected" style="margin-top:0.755em;margin-left: 20px;">Delete selected</a>');


            @if(request()->has('create'))
                $('#createCatBtn').click();
            @endif
        });

       

    </script>

@endpush