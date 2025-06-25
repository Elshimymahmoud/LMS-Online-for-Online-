@inject('request', 'Illuminate\Http\Request')
@extends('backend.layouts.app')

@section('title', __('labels.backend.attendance.title') . ' | ' . app_name())

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
                    @if(count($course->studentsCourseLocation($course_location_id)->get())>0)

                    <a href="{{ route('admin.Attendance.show', ['course_id' => $course->id,'course_location_id'=>$course_location_id]) }}"
                        class="btn btn-success">@lang('labels.backend.attendance.show')</a>
                       
                        @else
                        <a href="#"
                            class="btn btn-success">@lang('labels.backend.attendance.fields.no_student')</a>
                        @endif
                </div>

            @endcan
        </div>
        <div class="card-body">
            <div class="row">
                <div class="col-12">
                   
                    <div class="table-responsive" id="AllStudent">
                        {!! Form::open(['method' => 'POST', 'route' => ['admin.Attendance.store'], 'files' => true]) !!}
                        <input type="hidden" name="course_location_id" value="{{$course_location_id}}">
                        <table id="myTable" class="table table-border table-hover">
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
                                @if(count($course->studentsCourseLocation($course_location_id)->get())>0)

                                @foreach ($course->studentsCourseLocation($course_location_id)->get() as $key => $student)
                                    @php
                                        $key += 1;
                                    @endphp


                                    <tr>
                                        <td>
                                            <input type="checkbox" onchange="changeStudentValues({{ $student->id }},'[]')"
                                                value="{{ $student->id ?? 0 }}" id="student-{{ $student->id }}">
                                            <input type="hidden" value="{{ $student->id ?? 0 }}" name="student_ids[]"
                                                id="studentHideen-{{ $student->id }}">
                                            {{ $key }}-


                                        </td>


                                        <td>

                                            @if (Lang::locale() == 'en')
                                                {{ $student->first_name . ' ' . $student->last_name }}

                                            @else
                                                {{ $student->name_ar ?? $student->first_name . ' ' . $student->last_name }}

                                            @endif

                                        </td>

                                        <td>
                                            @php
                                                $attend=$student->AttendanceCourseLocation($course->id,
                                                $course_location_id, $lesson->id)->first();
                                            
                                            @endphp
                                           
                                            @if($attend)
                                            
                                            <input onchange="setValues('change')" value="{{$attend->attendance_time}}" class="datetime" 
                                                type="datetime" name="attendance_time[]" id="">
                                              
                                            @else
                                            
                                            <input onchange="setValues('change')" class="datetime"
                                            type="datetime-local" name="attendance_time[]" id="">
                                            @endif
                                        </td>



                                        <td>
                                            @if($attend)
                                            <input onchange="setValues('change')" class="datetime" value="{{$attend->late_time}}"
                                                type="datetime" name="late_time[]" id="">
                                            @else
                                            <input onchange="setValues('change')" class="datetime"
                                                type="datetime-local" name="late_time[]" id="">
                                            @endif
                                        </td>

                                    </tr>
                                @endforeach
                               
                                    @endif
                            </tbody>
                        </table>
                        @if(count($course->studentsCourseLocation($course_location_id)->get())==0)

                        <span style="color: red;font-weight:bold">@lang('labels.backend.attendance.fields.no_student')</span>
                        @endif
                        <div class="row">
                            <input type="hidden" value="{{ $course->id ? $course->id : request('course') }}" name="course_id">

                            <div class="col-md-12 text-center form-group">
                                @if(count($course->studentsCourseLocation($course_location_id)->get())>0)
                               
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
                
                var today = new Date();

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

        function setValues(value) {

            $("input[type='datetime-local'][name='attendance_time[]']").each(function(index1, ele) {

                setTimeout(() => {
                    if (value != null)
                        ele.value = getDateTimeNow(ele.value) == null ? ele.value : getDateTimeNow(ele
                            .value)
                    else {

                        ele.value = getDateTimeNow()
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
