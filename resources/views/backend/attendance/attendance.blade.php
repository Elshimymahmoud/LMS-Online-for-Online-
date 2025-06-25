@inject('request', 'Illuminate\Http\Request')
@extends('backend.layouts.app')

@section('title', __('labels.backend.blogs.title') . ' | ' . app_name())

@section('content')
    <style>
        .datetime {
            width: 100%;

            padding: 5px;
        }

    </style>
    <div class="card">
        <div class="card-header">
            <h3 class="page-title d-inline">@lang('labels.backend.attendance.title')</h3>
            {{-- @can('blog_create')

                <div class="float-right">
                    <a href="{{ route('admin.Attendance.show', ['course_id' => $course->id]) }}"
                        class="btn btn-success">@lang('labels.backend.attendance.show')</a>
                </div>

            @endcan --}}
        </div>
        <div class="card-body">
            <div class="row">
                <div class="col-12">
                    <div class="table-responsive">
                       

                        <table id="myTable" class="table table-border table-hover">
                            <thead>
                                <tr>

                                    <th>@lang('labels.general.sr_no')</th>

                                    <th>@lang('labels.backend.attendance.fields.location')</th>
                                    <th>@lang('labels.backend.attendance.fields.start_date')</th>
                                    <th>@lang('labels.backend.attendance.fields.end_date')</th>

                                    <th>@lang('labels.backend.attendance.fields.action')</th>



                                </tr>
                            </thead>
                            <tbody>

                                @csrf
                                @foreach ($courseLocations as $key => $courseLocation)
                                    @php
                                        $key += 1;
                                    @endphp


                                    <tr>
                                        <td>
                                           
                                           
                                            {{ $key }}


                                        </td>


                                        <td>

                                            @if (Lang::locale() == 'en')
                                                {{ $courseLocation->location->name}}

                                            @else
                                            {{ $courseLocation->location->name_ar}}

                                            @endif

                                        </td>

                                        <td>
                                           {{$courseLocation->start_date}}
                                        </td>



                                        <td>

                                            {{$courseLocation->end_date}}


                                        </td>
                                        <td>
                                            <a href="{{route('admin.Attendance.index', ['course_location_id' => $courseLocation->id,'course'=>$course->id])}}" class="btn btn-primary">@lang('menus.backend.sidebar.attendance.title')</a> 
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

@endsection

@push('after-scripts')
    {{-- moment.js --}}
    <script src="https://cdnjs.cloudflare.com/ajax/libs/moment.js/2.29.1/moment.min.js"
        integrity="sha512-qTXRIMyZIFb8iQcfjXWCO8+M5Tbc38Qi5WzdPOYZHIlZpzBHG3L3by84BBBOiRGiEb7KKtAOAs5qYdUiZiQNNQ=="
        crossorigin="anonymous" referrerpolicy="no-referrer"></script>
    {{-- moment.js --}}
    <script>
       



        $('#myTable').DataTable({
            processing: true,
            serverSide: false,
            iDisplayLength: 10,
            retrieve: true,
            dom: 'lfBrtip<"actions">',
            buttons: [{
                    extend: 'csv',
                    bom: true,
                    exportOptions: {
                        columns: [0, 1, 2, 3،4]
                    }
                },
                {
                    extend: 'print',
                    exportOptions: {
                        columns: [0, 1, 2, 3,4]
                    }
                },
                'colvis'
            ],

            columnDefs: [{
                    "width": "10%",
                    "targets": 0
                },
                {
                    "width": "15%",
                    "targets": 3
                },
                {
                    "className": "text-center",
                    "targets": [0]
                }
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

    </script>
@endpush
