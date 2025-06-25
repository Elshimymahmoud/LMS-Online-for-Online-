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
            @can('blog_create')
            <div class="float-right">
                <a href="{{ route('admin.Attendance.index',['course'=>$course->id]) }}" class="btn btn-success">@lang('labels.backend.attendance.title')</a>
            </div>
            @endcan
        </div>
        <div class="card-body">
            <div class="row">
                <div class="col-12">
                    <div class="table-responsive">


                        <table id="myTable"
                            class="table table-border table-hover">
                            <thead>
                                <tr>

                                    <th>@lang('labels.general.sr_no')</th>

                                    <th>@lang('labels.backend.attendance.fields.student_name')</th>
                                    <th>@lang('labels.backend.attendance.fields.attendance_time')</th>
                                    <th>@lang('labels.backend.attendance.fields.late_time')</th>



                                </tr>
                            </thead>
                            <tbody>

                                @csrf
                                @foreach ($attendences as $key => $attendence)
                                    @php
                                        $key += 1;
                                    @endphp


                                    <tr>
                                        <td>

                                            {{ $key }}


                                        </td>


                                        <td>

                                            @if (Lang::locale() == 'en')
                                                {{ $attendence->user->first_name . ' ' . $attendence->user->last_name }}

                                            @else
                                                {{ $attendence->user->name_ar ?? $attendence->user->first_name . ' ' . $attendence->user->last_name }}

                                            @endif

                                        </td>

                                        <td>
                                            {{$attendence->attendance_time}}
                                        </td>



                                        <td>

                                            {{$attendence->late_time}}

                                        </td>

                                    </tr>
                                @endforeach
                                <input type="hidden" value="{{ $course->id }}" name="course_id">


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
                        columns: [0, 1, 2, 3]
                    }
                },
                {
                    extend: 'print',
                    exportOptions: {
                        columns: [0, 1, 2, 3]
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
