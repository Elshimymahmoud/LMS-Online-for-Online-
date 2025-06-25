@inject('request', 'Illuminate\Http\Request')
@extends('backend.layouts.app')

@section('title', __('labels.backend.attendance.title') . ' | ' . app_name())

@section('content')
    <style>
        .datetime {
            width: 100%;

            padding: 5px;
        }

        .center {
            height: 100px;
            line-height: 100px;
            text-align: center;

        }

        .tble-color {
            background-color: #802d42 !important;
            color: white;
            font-weight: bold;
        }

        .headerr {
            top: 15%;
            /* width:80%;  */
            height: 100px;
            background: white;
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
    <nav aria-label="breadcrumb" class="headerr ">
        <ol class="breadcrumb">
            <li class="breadcrumb-item"><a href="{{ route('admin.groups.index') }}"><i class="fa fa-home"></i></a></li>
            <li class="breadcrumb-item">   {{$course->type->name_ar}} </li>
            <li class="breadcrumb-item active" aria-current="page">{{$course->title_ar}}</li>

            @if(isset($user))
                <li class="breadcrumb-item active" aria-current="page">

                    {{ (app()->getLocale() == 'ar') ? $user->full_name_ar : $user->full_name }}

                </li>
            @endif
        </ol>
    </nav>
    <div class="card" style="margin-top: 2%;">
        <div class="card-header">
            <h3 class="page-title d-inline">@lang('labels.backend.attendance.title')</h3>
            @can('blog_create')
                <div class="float-right">
                    <a href="{{ route('admin.Attendance.index', ['course' => $course->id,'group'=>$group->id,
                    'student_id'=>request('student_id'), 'lesson'=> $lesson->id]) }}"
                       class="btn btn-success">@lang('labels.backend.attendance.title')</a>
                    <a href="{{ route('admin.groups.index') }}"
                       class="btn btn-primary">&#8592</a>
                </div>
            @endcan
        </div>
        <div class="card-body">
            <div class="row">
                <div class="col-12">
                    <div class="table-responsive">


                        <table id="myTable" class="table table-border table-hover">
                            {{-- <thead>
                                <tr>

                                    <th rowspan="1" >@lang('labels.general.sr_no')</th>
                                    <th >@lang('labels.backend.attendance.fields.student_name')</th>
                                    <th colspan="5" >
                                  
                                        @lang('labels.backend.attendance.fields.attendance_time')
                                    </th>
                                    



                                </tr>
                            </thead> --}}
                            <tbody id="here">
                            <tr class="tble-color">

                                <td class="center" rowspan="3">@lang('labels.general.sr_no')</td>
                                <td class="center" rowspan="3">
                                    @lang('labels.backend.attendance.fields.student_name')</td>
                                <td colspan="{{count($attendencesByDay)*2}}">

                                    @lang('labels.backend.attendance.fields.attendance_time')
                                </td>


                            </tr>

                            @csrf
                            <tr class="tble-color">


                                @foreach ($attendencesByDay as $key0 => $attendences0)
                                    <td colspan="2">
                                        {{ $key0 }}

                                    </td>
                                @endforeach


                            </tr>

                            <tr>


                                @foreach ($attendencesByDay as $key0 => $attendences0)

                                    <td>
                                        @lang('labels.backend.attendance.fields.attendance')

                                    </td>
                                    <td>
                                        @lang('labels.backend.attendance.fields.leave')

                                    </td>
                                @endforeach

                            </tr>
                            @php
                                $count = 1;
                            @endphp
                            @if(count($attendencesByuser)>0)
                                @foreach ($attendencesByuser as $key => $attendences)

                                    @if(request('student_id'))
                                        @if($attendencesByuser[$key][0]->user->id==(int)request('student_id'))
                                            <tr>
                                                <td>
                                                    {{ $count }}

                                                </td>
                                                <td>
                                                    @if (Lang::locale() == 'ar')
                                                        {{ $attendencesByuser[$key][0]->user->name_ar }}
                                                    @else
                                                        {{ $attendencesByuser[$key][0]->user->first_name . ' ' . $attendencesByuser[$key][0]->user->last_name }}

                                                    @endif

                                                </td>

                                                @foreach ($attendences as $key => $attendence)

                                                    <td>

                                                        @if($attendence->attendance_time)
                                                            {{ date('h:i a', strtotime($attendence->attendance_time)) }}
                                                        @else
                                                            {{$attendence->attendance_time}}
                                                        @endif


                                                    </td>
                                                    <td>
                                                        @if($attendence->late_time)
                                                            {{ date('h:i a', strtotime($attendence->late_time)) }}
                                                        @else
                                                            {{$attendence->late_time}}
                                                        @endif


                                                    </td>

                                                @endforeach

                                            </tr>
                                        @endif
                                    @else
                                        <tr>
                                            <td>
                                                {{ $count }}

                                            </td>
                                            <td>
                                                @if (Lang::locale() == 'ar')
                                                    {{ $attendencesByuser[$key][0]->user->name_ar }}
                                                @else
                                                    {{ $attendencesByuser[$key][0]->user->first_name . ' ' . $attendencesByuser[$key][0]->user->last_name }}

                                                @endif

                                            </td>

                                            @foreach ($attendences as $key => $attendence)

                                                <td>

                                                    @if($attendence->attendance_time)
                                                        {{ date('h:i a', strtotime($attendence->attendance_time)) }}
                                                    @else
                                                        {{$attendence->attendance_time}}
                                                    @endif


                                                </td>
                                                <td>
                                                    @if($attendence->late_time)
                                                        {{ date('h:i a', strtotime($attendence->late_time)) }}
                                                    @else
                                                        {{$attendence->late_time}}
                                                    @endif


                                                </td>

                                            @endforeach

                                        </tr>
                                    @endif
                                    @php
                                        $count = $count + 1;
                                    @endphp
                                @endforeach
                            @else
                                No attendance yet
                            @endif


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
        // $('#myTable').DataTable({
        //     processing: true,
        //     serverSide: false,
        //     iDisplayLength: 10,
        //     retrieve: true,
        //     dom: 'lfBrtip<"actions">',
        //     buttons: [{
        //             extend: 'csv',
        //             bom: true,
        //             exportOptions: {
        //                 columns: [0, 1, 2, 3]
        //             }
        //         },
        //         {
        //             extend: 'print',
        //             exportOptions: {
        //                 columns: [0, 1, 2, 3]
        //             }
        //         },
        //         'colvis'
        //     ],

        //     columnDefs: [{
        //             "width": "10%",
        //             "targets": 0
        //         },
        //         {
        //             "width": "15%",
        //             "targets": 3
        //         },
        //         {
        //             "className": "text-center",
        //             "targets": [0]
        //         }
        //     ],
        //     language: {
        //         url: "//cdn.datatables.net/plug-ins/9dcbecd42ad/i18n/{{ $locale_full_name }}.json",
        //         buttons: {
        //             colvis: '{{ trans('datatable.colvis') }}',
        //             pdf: '{{ trans('datatable.pdf') }}',
        //             csv: '{{ trans('datatable.csv') }}',
        //         }
        //     }

        // });
        function changestr(event) {

            let x = "<?php $test = true; ?>"

            console.log(x);
            $("#here").load(window.location.href + " #here");
        }
    </script>
@endpush
