@php use Carbon\Carbon; @endphp
@inject('request', 'Illuminate\Http\Request')
@extends('backend.layouts.app')

@section('title', __('labels.backend.attendance.title') . ' | ' . app_name())

@section('content')
    <style>
        .datetime {
            width: 100%;

            padding: 5px;
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
    @if(@$group)
        <nav aria-label="breadcrumb" class="headerr ">
            <ol class="breadcrumb">
                <li class="breadcrumb-item"><a href="{{ route('admin.groups.index') }}"><i class="fa fa-home"></i></a>
                </li>
                <li class="breadcrumb-item">   {{session('locale')=='ar'?$course->type->name_ar:$course->type->name}} </li>
                <li class="breadcrumb-item"
                    style="color:red">{{session('locale')=='ar'?$course->title_ar:$course->title}}</li>
                @if(isset($user))
                    <li class="breadcrumb-item active" aria-current="page">

                        {{ (app()->getLocale() == 'ar') ? $user->full_name_ar : $user->full_name }}

                    </li>
                @endif

            </ol>
        </nav>
    @endif
    <div class="card" style="margin-top: 2%;">
        <div class="card-header">
            <h3 class="page-title d-inline">@lang('labels.backend.attendance.title')</h3>


                <div class="float-right">
                    @if($group->students->count() > 0)

                        {{--  <a href="{{ route('admin.Attendance.show', ['course_id' => $course->id,'course_location_id'=>$course_location_id]) }}"
                             class="btn btn-success">@lang('labels.backend.attendance.show')</a>

                             --}}
                        @if(request('student_id') )
                            <a href="{{route('admin.Attendance.show', ['group' => $group->id,
                                             'course'=>$group->courses->id,'student_id'=>request('student_id'),
                                             'lesson'=>request('lesson')])}}"
                               class="btn btn-success">@lang('labels.backend.attendance.show')</a>
                            </a>
                        @else
                            <a href="{{ route('admin.Attendance.show', ['group' => $group->id,
                                             'course'=>$group->courses->id,
                                             'lesson'=>request('lesson')]) }}"
                               class="btn btn-success">@lang('labels.backend.attendance.show')</a>
                        @endif
                    @else
                        <a href="#"
                           class="btn btn-success">@lang('labels.backend.attendance.fields.no_student')</a>
                    @endif
                    <a href="{{ route('admin.groups.index') }}"
                       class="btn btn-primary">&#8592</a>
                </div>

        </div>

        <div class="card-body">
            <div class="row">
                <div class="col-12">

                    <div class="table-responsive" id="AllStudent">
                        {!! Form::open(['method' => 'POST', 'route' => ['admin.Attendance.store'], 'files' => true]) !!}
                        <input type="hidden" name="group_id" value="{{$group->id}}">
                        <input type="hidden" name="lesson_id" value="{{$lesson->id}}">
                        <table id="myTable" class="table table-bordered table-striped">
                            <thead>
                            <tr>

                                <th>@lang('labels.general.sr_no')</th>

                                <th>@lang('labels.backend.attendance.fields.student_name')</th>
                                <th>@lang('labels.backend.attendance.fields.status')</th>
                                <th>@lang('labels.backend.attendance.fields.attendance_time')</th>
                                <th>@lang('labels.backend.attendance.fields.late_time')</th>


                            </tr>
                            </thead>
                            <tbody>

                            @csrf
                            @if(request('student_id'))
                                @if(count($group->students->where('id', request('student_id'))) > 0)

                                    @foreach ($group->students->where('id', request('student_id')) as $keyind => $student)

                                        @php
                                            $keyind += 1;
                                            $attend = $student->AttendanceCourseLocation($course->id,$group->id, $lesson->id)
                                            ->first();
                                            $attendanceTimeValue = '';
                                            $lateTimeValue = '';

                                            try {
                                                if ($attend && $attend->attendance_time) {
                                                    $attendanceTime = Carbon::parse($attend->attendance_time);
                                                    $attendanceTimeValue = $attendanceTime->format('Y-m-d\TH:i');
                                                }
                                                if ($attend && $attend->late_time) {
                                                    $lateTime = Carbon::parse($attend->late_time);
                                                    $lateTimeValue = $lateTime->format('Y-m-d\TH:i');
                                                }
                                            } catch (\Exception $e) {
                                                // Handle the exception if either $attend->attendance_time or $attend->late_time is not a valid date string
                                                // You can set $attendanceTimeValue and $lateTimeValue to a default value or handle as needed
                                                $attendanceTimeValue = ''; // Set a default value or handle as needed
                                                $lateTimeValue = ''; // Set a default value or handle as needed
                                            }
                                        @endphp

                                        <tr>
                                            <td>

                                                <input type="checkbox"
                                                       onchange="changeStudentValues({{ $student->id }},'[]')"
                                                       value="{{ $student->id ?? 0 }}" id="student-{{ $student->id }}">
                                                <input type="hidden" value="{{ $student->id ?? 0 }}"
                                                       name="student_ids[]"
                                                       id="studentHideen-{{ $student->id }}">


                                            </td>

                                            <td>

                                                @if (Lang::locale() == 'en')
                                                    {{ $student->full_name }}

                                                @else
                                                    {{ $student->full_name_ar }}

                                                @endif

                                            </td>

                                            <td>
                                                <div>
                                                    <input type="radio" id="present-{{ $student->id }}"
                                                           name="attendance_status[]" value="1" {{
                                                           $student->getAttendanceStatus($group->id, $lesson->id) ==
                                                            1 ? 'checked' : '' }} required>
                                                    <label for="present-{{ $student->id }}">@lang('labels.backend.attendance.present')</label>
                                                </div>
                                                <div>
                                                    <input type="radio" id="absent-{{ $student->id }}"
                                                           name="attendance_status[]" value="0" {{ $student->getAttendanceStatus($group->id, $lesson->id) == 0 ? 'checked' : '' }} required>
                                                    <label for="absent-{{ $student->id }}">@lang('labels.backend.attendance.absent')</label>
                                                </div>
                                            </td>

                                            <td>


                                                @if($attend)

                                                    <input onchange="setValues('change')" value="{{ $attendanceTimeValue }}" class="datetime"
                                                           type="datetime-local" name="attendance_time[]" id="">

                                                @else

                                                    <input onchange="setValues('change')" class="datetime"
                                                           type="datetime-local" name="attendance_time[]" id="">
                                                @endif
                                            </td>

                                            <td>
                                                @if($attend)
                                                    <input onchange="setValues('change')" class="datetime" value="{{ $lateTimeValue }}"
                                                           type="datetime-local" name="late_time[]" id="">
                                                @else
                                                    <input onchange="setValues('change')" class="datetime"
                                                           type="datetime-local" name="late_time[]" id="">
                                                @endif
                                            </td>


                                        </tr>
                                    @endforeach

                                @endif
                            @else
                                @if($group->students->count() > 0)

                                    @foreach ($group->students as $keyind => $student)

                                        @php
                                            $keyind += 1;
                                            $attend = $student->AttendanceCourseLocation($course->id,$group->id,
                                            $lesson->id)
                                            ->first();
                                            $attendanceTimeValue = '';
                                            $lateTimeValue = '';

                                            try {
                                                if ($attend && $attend->attendance_time) {
                                                    $attendanceTime = Carbon::parse($attend->attendance_time);
                                                    $attendanceTimeValue = $attendanceTime->format('Y-m-d\TH:i');
                                                }
                                                if ($attend && $attend->late_time) {
                                                    $lateTime = Carbon::parse($attend->late_time);
                                                    $lateTimeValue = $lateTime->format('Y-m-d\TH:i');
                                                }
                                            } catch (\Exception $e) {
                                                // Handle the exception if either $attend->attendance_time or $attend->late_time is not a valid date string
                                                // You can set $attendanceTimeValue and $lateTimeValue to a default value or handle as needed
                                                $attendanceTimeValue = ''; // Set a default value or handle as needed
                                                $lateTimeValue = ''; // Set a default value or handle as needed
                                            }
                                        @endphp

                                        <tr>
                                            <td>

                                                <input type="checkbox"
                                                       onchange="changeStudentValues({{ $student->id }},'[]')"
                                                       value="{{ $student->id ?? 0 }}" id="student-{{ $student->id }}">
                                                <input type="hidden" value="{{ $student->id ?? 0 }}"
                                                       name="student_ids[]"
                                                       id="studentHideen-{{ $student->id }}">


                                            </td>

                                            <td>

                                                @if (Lang::locale() == 'en')
                                                    {{ $student->full_name }}

                                                @else
                                                    {{ $student->full_name_ar }}

                                                @endif

                                            </td>

                                            <td>
                                                <div>
                                                    <input type="radio" id="present-{{ $student->id }}"
                                                           name="attendance_status[{{ $student->id }}]" value="1" {{
                                                           $student->getAttendanceStatus($group->id, $lesson->id) ==
                                                            1 ? 'checked' : '' }} required>
                                                    <label for="present-{{ $student->id }}">@lang('labels.backend.attendance.present')</label>
                                                </div>
                                                <div>
                                                    <input type="radio" id="absent-{{ $student->id }}"
                                                           name="attendance_status[{{ $student->id }}]" value="0" {{ $student->getAttendanceStatus($group->id, $lesson->id) == 0 ? 'checked' : '' }} required>
                                                    <label for="absent-{{ $student->id }}">@lang('labels.backend.attendance.absent')</label>
                                                </div>
                                            </td>

                                            <td>


                                                 @if($attend)

                                                <input onchange="setValues('change')" value="{{ $attendanceTimeValue }}" class="datetime"
                                                       type="datetime-local" name="attendance_time[{{ $student->id }}]" id="">

                                                @else

                                                <input onchange="setValues('change')" class="datetime"
                                                       type="datetime-local" name="attendance_time[{{ $student->id }}]" id="">
                                                 @endif
                                            </td>

                                            <td>
                                                @if($attend)
                                                <input onchange="setValues('change')" class="datetime" value="{{ $lateTimeValue }}"
                                                    type="datetime-local" name="late_time[{{ $student->id }}]" id="">
                                                @else
                                                <input onchange="setValues('change')" class="datetime"
                                                       type="datetime-local" name="late_time[{{ $student->id }}]" id="">
                                                 @endif
                                            </td>

                                        </tr>
                                    @endforeach

                                @endif
                            @endif
                            </tbody>
                        </table>
                        @if($group->students->count() == 0)

                            <span style="color: red;font-weight:bold">@lang('labels.backend.attendance.fields.no_student')</span>
                        @endif
                        <div class="row">
                            <input type="hidden" value="{{ $course->id ? $course->id : request('course') }}"
                                   name="course_id">

                            <div class="col-md-12 text-center form-group">
                                @if($group->students->count() > 0)

                                    <button type="submit" class="btn btn-info waves-effect waves-light ">
                                        @lang('labels.backend.attendance.create')


                                    </button>
                                @endif

                            </div>

                        </div>

                        {!! Form::close() !!}

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
        function changeStudentValues(id = 0, ids = "{{ json_encode($course->students->pluck('id')->toArray()) }}") {
            ids = JSON.parse(ids);

            if (id) {
                if (document.getElementById("student-" + id).checked == false) {

                    document.getElementById("studentHideen-" + id).value = id;

                } else {

                    document.getElementById("studentHideen-" + id).value = id;
                }
            }
            if (ids.length > 0) {
                for (let index = 0; index < ids.length; index++) {
                    const id = ids[index];
                    if (document.getElementById("student-" + id).checked == false) {

                        document.getElementById("studentHideen-" + id).value = id;

                    } else {

                        document.getElementById("studentHideen-" + id).value = id;
                    }

                }
            }

        }

        function getDateTimeNow(value = null) {

// set here

            if (value == null) {

                // var today = new Date();
                // dateTime = moment(today).format('yyyy-MM-DDThh:mm');
                // =====================================================
                //selected date input
                var SelectedDate = document.getElementById('SelectedDate').value;
                var today = new Date(SelectedDate);
                dateTime = moment(today).format('yyyy-MM-DDThh:mm');


            } else {
                dateTime = null
            }
            return dateTime;


            // 2018-06-12T19:30

        }


        function getDateTimeNow2(value) {

            dateTime = moment(value).format('A');

            return dateTime;
            // 2018-06-12T19:30

        }

        changeStudentValues()

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


            columnDefs: [{
                "width": "10%",
                "targets": 0
            },
                {
                    "width": "15%",
                    "targets": 4
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

        function setValues(value) {

            $("input[type='datetime-local'][name='attendance_time[]']").each(function (index1, ele) {

                setTimeout(() => {
                    if (value != null) {
                        ele.value = getDateTimeNow(ele.value) == null ? ele.value : getDateTimeNow(ele.value);

                    } else {

                        ele.value = getDateTimeNow()
                        ele.min = getDateTimeNow(ele.value) == null ? ele.value : getDateTimeNow(ele
                            .value)
                        // ele.max=getDateTimeNow(ele.value) == null ? ele.value : getDateTimeNow(ele
                        // .value)
                        var SelectedDate = document.getElementById('SelectedDate').value;
                        if (SelectedDate != '')
                            $('#AllStudent').show()
                    }


                }, 2000);


            })
            //    ///////////////

            // $("input[type='datetime-local'][name='late_time[]']").each(function(index1, ele) {

            //     setTimeout(() => {
            //         if (value != null)
            //             ele.value = getDateTimeNow(ele.value) == null ? ele.value : getDateTimeNow(ele
            //                 .value)
            //         else {

            //             ele.value = getDateTimeNow()
            //         }


            //     }, 2000);


            // })

        }

        // //////


        setValues(null)
    </script>
@endpush
