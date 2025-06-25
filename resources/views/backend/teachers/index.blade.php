@extends('backend.layouts.app')
@section('title', __('labels.backend.teachers.title').' | '.app_name())
@push('after-styles')
    <link rel="stylesheet" href="{{asset('assets/css/colors/switch.css')}}">
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
        .fixed-label-width{
            width: 6rem;
            @if(session('locale') == 'ar')
                margin-left: 1rem;
            @else
            margin-right: 1rem;
        @endif
}
        .flex-container {
            width: 100%;
        }

        .input-widget {
            width: 40%;
            margin: 0 5%;
            margin-bottom: 10px;
        }

        .input-widget label {
            color: #fff;
            margin-bottom: 3px;
        }

        .filter-items {
            flex-wrap: wrap
        }

        ul.sorter li > span .title {
            padding-left: 15px;
        }

        ul.sorter li > span .btn {
            width: 20%;
        }

        .animated {
            background-color: #f5f5f5;
        }

        .filter {
            /* position: absolute; */
            left: 230px;
            background-color: #e9e9e9;
            height: 32px;
            z-index: 222;

        }

        .filter i {
            color: #4f198d;;
        }

        .filter-form {
            display: flex;
            width: 99%;
            background-color: #4f198d;;
            height: fit-content;
            margin: 10px;
            border-radius: 36px;
            padding: 30px;
            align-items: center;
        }

        .formcontent {
            display: flex;
            align-content: center;
            align-items: center;

        }

        .filter-button {
            display: flex;
            justify-content: center;
            margin-top: 10px;

        }

        .filter-button > input {
            color: #802d42;
            background-color: #fff;
        }

        .formcontent > input {

            color: white;
            width: 150px;
            margin: 10px;
            text-align: center;
            line-height: 75px;
            font-size: 15px;

        }

        .formcontent > label {
            color: white;
        }

        .iconFilterM-T {
            margin-top: 10px;
        }

    </style>
@endpush
@section('content')

    <div class="card">
        <div class="card-header">
            <h3 class="page-title d-inline">@lang('labels.backend.teachers.title')</h3>
            @can('course_create')
                <div class="float-right">
                    <a href="{{ route('admin.teachers.create') }}"
                       class="btn btn-success">
                        <i class="icon-plus" title="@lang('strings.backend.general.app_add_new')"></i>
                    </a>
                    <a href="#" class="btn filter" id="filter"><i class=" fa icon-filter"></i></a>

                </div>
            @endcan
        </div>
        <div class="card-body">
            <div class="row">
                <div class="col-12">
                    <div class="table-responsive">
                        <div class="d-block">
                            <ul class="list-inline">
                                <li class="list-inline-item">
                                    <a href="{{ route('admin.teachers.index') }}"
                                       style="{{ request('show_deleted') == 1 ? '' : 'font-weight: 700' }}">{{trans('labels.general.all')}}</a>
                                </li>
                                |
                                <li class="list-inline-item">
                                    <a href="{{ route('admin.teachers.index') }}?show_deleted=1"
                                       style="{{ request('show_deleted') == 1 ? 'font-weight: 700' : '' }}">{{trans('labels.general.trash')}}</a>
                                </li>
                            </ul>
                        </div>
                        <div class="d-block">
                            <div class="d-none" id="filterForm">
                                <form action="{{ route('admin.teachers.filter_data') }}" method="POST" id="search-form"
                                      class="flex-container">
                                    @csrf
                                    <div class="d-flex filter-items">
                                        <div class="input-group mb-3">
                                            <span class="input-group-text rounded-end fixed-label-width">@lang('labels.backend.courses.course-title')</span>
                                            <input type="text" class="form-control"
                                                   placeholder="@lang('labels.backend.courses.course-title')" name="course_name">
                                        </div>
                                        <div class="input-group mb-3">
                                            <label class="input-group-text rounded-end fixed-label-width"
                                                   for="teacher">@lang('labels.backend.courses.fields.teacher')</label>
                                            <input type="text" class="form-control"
                                                   placeholder="@lang('labels.backend.courses.fields.teacher_name')" name="name">
                                        </div>
                                        <div class="input-group mb-3">
                                            <label class="input-group-text rounded-end fixed-label-width"
                                                   for="email">@lang('labels.backend.access.users.table.email')</label>
                                            <input type="text" class="form-control"
                                                   placeholder="@lang('labels.backend.access.users.table.email')" name="email">
                                        </div>
                                        <div class="input-group mb-3">
                                            <label class="input-group-text rounded-end fixed-label-width"
                                                   for="type">@lang('labels.backend.courses.fields.type')</label>
                                            {!! Form::select('type', $types, old('type_id'), ['class' => 'form-select js-example-placeholder-single']) !!}
                                        </div>
                                    </div>
                                    <div class="filter-button">
                                        <button type="submit"
                                                class="btn btn-success">@lang('labels.backend.courses.search')</button>
                                    </div>
                                </form>
                            </div>
                            <table id="myTable"
                               class="table table-bordered table-striped @if(auth()->user()->isAdmin()) @if ( request('show_deleted') != 1 ) dt-select @endif @endcan">
                            <thead>
                            <tr>

                                @can('category_delete')
                                    @if ( request('show_deleted') != 1 )
                                        <th style="text-align:center;"><input type="checkbox" class="mass"
                                                                              id="select-all"/>
                                        </th>
                                    @endif
                                @endcan

                                <th>@lang('labels.general.sr_no')</th>
                                <th>@lang('labels.backend.teachers.fields.name')</th>
                                <th>@lang('labels.backend.teachers.fields.email')</th>
                                <th>@lang('labels.backend.teachers.fields.status')</th>
                                @if( request('show_deleted') == 1 )
                                    <th>&nbsp; @lang('strings.backend.general.actions')</th>
                                @else
                                    <th>&nbsp; @lang('strings.backend.general.actions')</th>
                                @endif
                            </tr>
                            </thead>
                            <tbody>
                            @foreach($users as $user)
                                <tr data-entry-id="{{$user->id}}" role="row" class="odd">
                                    <td class="text-center sorting_1">
                                        <input type="checkbox" class="single" name="id[]" value="{{$user->id}}">
                                    </td>
                                    <td>{{$user->id}}</td>
                                    <td>{{ (app()->getLocale() == 'ar') ? $user->full_name_ar : $user->full_name }}</td>
                                    <td>{{$user->email}}</td>
                                    <td>
                                        <label class="switch switch-lg switch-3d switch-primary">
                                            <input class="switch-input" type="checkbox" value="1" id="{{$user->id}}"
                                                   @if($user->active == 1) checked
                                                   @endif data-id="{{$user->id}}">
                                            <span class="switch-label"></span>
                                            <span class="switch-handle"></span>
                                        </label>
                                    </td>
                                    <td>
                                        <a href="{{ route('admin.teachers.show', $user->id) }}"
                                           class="btn btn-xs btn-primary mb-1">
                                            <i class="icon-eye"></i>
                                        </a>
                                        <a href="{{ route('admin.teachers.edit', $user->id) }}"
                                           class="btn btn-xs btn-info mb-1" title="Edit">
                                            <i class="icon-pencil"></i>
                                        </a>
                                        <a data-method="delete" data-trans-button="@lang('buttons.general.cancel')"
                                            data-trans-button-confirm="@lang('buttons.general.crud.delete')"
                                            data-trans-title="@lang('strings.backend.general.are_you_sure')"
                                            class="btn btn-xs btn-danger text-white mb-1" style="cursor:pointer;"
                                            onclick="$(this).find('form').submit();">

                                            <i class="fa fa-trash" data-toggle="tooltip" data-placement="top" title=""
                                               data-original-title="@lang('buttons.general.crud.delete')"></i>
                                            <form action="{{ route('admin.teachers.destroy', $user->id) }}" method="POST"
                                                  name="delete_item" style="display:none">
                                                <input type="hidden" name="_token" value="{{ csrf_token() }}">
                                                <input type="hidden" name="_method" value="DELETE">
                                            </form>
                                        </a>
                                        <a class="btn btn-warning mb-1"
                                           href="{{ route('admin.groups.index', ['teacher_id' => $user->id]) }}">
                                            @lang('labels.backend.group.title')
                                        </a>
                                    </td>
                                </tr>

                            @endforeach
                            </tbody>
                        </table>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

@endsection

@push('after-scripts')
    <script>
        $(document).ready(function () {

            $('#myTable').DataTable({
                processing: true,
                serverSide: false,
                iDisplayLength: 5,
                retrieve: true,
                dom: 'lfBrtip<"actions">',
                buttons: [{
                    extend: 'csv',
                    bom: true,
                    exportOptions: {
                        columns: [0, 1, 2, 3, 4]
                    }
                },
                    {
                        extend: 'print',
                        exportOptions: {
                            columns: [0, 1, 2, 3, 4]
                        }
                    },
                    'colvis'
                ],
                columnDefs: [
                    {"width": "10%", "targets": 0},
                    // {"width": "15%", "targets": 5},
                    {"className": "text-center", "targets": [0]}
                ],
                language: {
                    url: "//cdn.datatables.net/plug-ins/9dcbecd42ad/i18n/{{ $locale_full_name }}.json",
                    buttons: {
                        colvis: '{{ trans('datatable.colvis') }}',
                        pdf: '{{ trans('datatable.pdf') }}',
                        csv: '{{ trans('datatable.csv') }}',
                    }
                }

            });
            $('#filter').on('click', function () {
                $('#filterForm').toggleClass('filter-form')
                $('#filterForm').toggleClass('d-none')
            });
            @if(auth()->user()->isAdmin())
            $('.actions').html('<a href="' + '{{ route('admin.teachers.mass_destroy') }}' + '" class="btn btn-xs btn-danger js-delete-selected" style="margin-top:0.755em;margin-left: 20px;">Delete selected</a>');
            @endif
        });

        // Date range picker
        document.addEventListener("DOMContentLoaded", function () {
            flatpickr("#dateRange", {
                mode: "range",
                dateFormat: "Y-m-d",
            });
        });

        $(document).on('click', '.switch-input', function (e) {
            var id = $(this).data('id');
            $.ajax({
                type: "POST",
                url: "{{ route('admin.teachers.status') }}",
                data: {
                    _token: '{{ csrf_token() }}',
                    id: id,
                },
            })
        })
    </script>
@endpush
