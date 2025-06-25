@extends('backend.layouts.app')

@section('title', __('labels.backend.courses.fields.location') . ' | ' . app_name())

@push('after-styles')
    <link rel="stylesheet" type="text/css" href="{{ asset('plugins/amigo-sorter/css/theme-default.css') }}">
    <style>
        ul.sorter>span {
            display: inline-block;
            width: 100%;
            height: 100%;
            background: #f5f5f5;
            color: #333333;
            border: 1px solid #cccccc;
            border-radius: 6px;
            padding: 0px;
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

        ul.sorter li>span .title {
            padding-left: 15px;
        }

        ul.sorter li>span .btn {
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
            background-color:#4f198d;;
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

        .filter-button>input {
            color: #802d42;
            background-color: #fff;
        }

        .formcontent>input {

            color: white;
            width: 150px;
            margin: 10px;
            text-align: center;
            line-height: 75px;
            font-size: 15px;

        }

        .formcontent>label {
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
            <h3 class="page-title float-left mb-0">@lang('labels.backend.courses.title')</h3>

            @can('course_create')
                <div class="float-right">
                    {{-- <a href="{{ route('admin.courses.create') }}"
                       class="btn btn-success"><i class="icon-plus" title="@lang('strings.backend.general.app_add_new')"></i></a> --}}
                    {{-- <a href="{{ route('admin.courses.add_students_to_course') }}"
                        class="btn btn-success">@lang('buttons.backend.access.users.addToCourse')</a>
                    <a href="{{ route('admin.courses.remove_students_from_course') }}"
                        class="btn btn-success">@lang('buttons.backend.access.users.removeFromCourse')</a> --}}
                    <a href="#" class="btn  filter" id="filter"><i class=" fa icon-filter"></i></a>

                </div>
            @endcan
        </div>
    </div>
    <div class="card-body">

        <div class="table-responsive">

            <div class="d-block">
                <div class="d-none" id="filterForm">
                    <form action="{{route('admin.courses.filter_data')}}" method="POST" id="search-form" class="flex-container">
                        @csrf
                        <div class="d-flex filter-items">
                            <div class="input-widget">
                                <label for="course_name">@lang('labels.backend.courses.course-title')</label><input
                                    type="text" class="form-control"
                                    placeholder="@lang('labels.backend.courses.course-title')" name="course_name" id="">
                            </div>
                            <div class="input-widget">
                                <label for="type">@lang('labels.backend.courses.fields.type')</label>
                                {{-- <input type="text"
                                    class="form-control" placeholder="@lang('labels.backend.courses.fields.type')"
                                    name="type" id=""> --}}
                                 {!! Form::select('type', $types, old('type_id'), ['class' => 'form-control select2 js-example-placeholder-single', 'multiple' => false]) !!}

                            </div>

                            <div class="input-widget">
                                <label for="start_date">@lang('labels.backend.courses.fields.start_date')</label><input
                                    type="date" class="form-control"
                                    placeholder="@lang('labels.backend.courses.fields.start_date')" name="start_date" id="">
                            </div>

                            <div class="input-widget">
                                <label for="end_date">@lang('labels.backend.courses.fields.start_date')</label> <input
                                    type="date" class="form-control"
                                    placeholder="@lang('labels.backend.courses.fields.end_date')" name="end_date" id="">
                            </div>

                        </div>
                        <div class="filter-button">
                            <input type="submit" class="btn btn-success" value="@lang('labels.backend.courses.search')">
                        </div>

                    </form>
                </div>
                <table id="myTable" class="table table-bordered table-striped ">

                    <thead>
                        <tr>

                            <th>@lang('labels.general.sr_no')</th>

                            <th>@lang('labels.backend.courses.course-title')</th>
                            <th>@lang('labels.backend.courses.fields.type')</th>
                            @if (session('locale') == 'en')
                                <th>@lang('labels.backend.courses.fields.location_en')</th>
                            @else
                                <th>@lang('labels.backend.courses.fields.location_ar')</th>
                            @endif
                            <th>@lang('labels.backend.courses.fields.start_date')</th>
                            <th>@lang('labels.backend.courses.fields.end_date')</th>
                            <th>@lang('labels.backend.courses.fields.price')</th>
                            <th>@lang('labels.backend.courses.fields.client')</th>

                            <th>@lang('labels.backend.courses.fields.teacher')</th>



                            @if (request('show_deleted') == 1)
                                <th>&nbsp; @lang('strings.backend.general.actions')</th>
                            @else
                                <th>&nbsp; @lang('strings.backend.general.actions')</th>
                            @endif
                        </tr>
                    </thead>
                    <tbody>
                        @php
                            $count = 0;
                        @endphp
                        @foreach ($courses as $key => $course)
                            @foreach ($course->locations as $key2 => $item)
                            
                                @php $count++ @endphp

                                <tr>
                                    <td>
                                        {{ $count }}
                                    </td>
                                    <td>

                                        {{ session('locale') == 'ar' ? $course->title_ar : $course->title }}

                                    </td>
                                    <td>

                                        {{ session('locale') == 'ar' ? $course->type->name_ar : $course->type->name }}

                                    </td>
                                    @if (session('locale') == 'en')
                                        <td>

                                            {{ $item->name }}

                                        </td>
                                    @else
                                        <td>
                                            {{ $item->name_ar }}


                                        </td>
                                    @endif
                                    <td>
                                        {{ $item->pivot->start_date }}
                                    </td>
                                    <td>
                                        {{ $item->pivot->end_date }}
                                    </td>
                                    <td>
                                        {{ $item->pivot->price }}
                                    </td>
                                    <td>

                                        @php
                                            $course_Loc = App\Models\CourseLocation::find($item->pivot->id);
                                        @endphp


                                        {{ $course_Loc->client ? $course_Loc->client->name : '' }}
                                    </td>
                                    <td>
                                        @php
                                            $teachers = $course_Loc->teachers ? $course_Loc->teachers : [];
                                        @endphp
                                        @foreach ($teachers as $teacher)
                                            {{ session('locale') == 'ar'? $teacher->name_ar: $teacher->first_name . ' ' . $teacher->last_name . ' ' . $teacher->third_name . ' ' . $teacher->fourth_name }}<br>
                                        @endforeach

                                    </td>
                                    <td>
                                        <a href="{{ route('admin.courses.show', ['course' => $course->id,'course_location_id'=>$item->pivot->id]) }}"
                                            class="btn btn-xs btn-info mb-1"><i class="icon-eye"></i></a>
                                        {{-- <a href="{{ route('admin.courses.edit', ['course' => $course->id]) }}"
                                            class="btn btn-xs btn-info mb-1"><i class="icon-pencil"></i></a> --}}
                                            <a href="{{ route('admin.courses.location2.index', ['course_id' => $course->id]) }}"
                                                class="btn btn-xs btn-info mb-1" title="@lang('menus.backend.sidebar.courses.locations_times')"><i class="icon-arrow-left"></i></a>
                                             
                                        {{-- <a href="{{route('admin.courses.location.edit', ['course_id'=>$course->id,'location_id'=>$item->pivot->id])}}" class="btn btn-xs btn-info mb-1"><i class="icon-pencil"> تعديل المكان </i></a> --}}


                                        @if(\Auth::user()->id==1)
                                        <a data-method="delete" data-trans-button-cancel="Cancel"
                                            data-trans-button-confirm="Delete" data-trans-title="Are you sure?"
                                            class="btn btn-xs btn-danger text-white mb-1" style="cursor:pointer;"
                                            onclick="$(this).find('form').submit();">
                                            <i class="fa fa-trash" data-toggle="tooltip" data-placement="top" title=""
                                                data-original-title="Delete"></i>

                                            <form
                                                action="{{ route('admin.courses.location.destroy', ['course_id' => $course->id, 'location_id' => $item->pivot->id]) }}"
                                                method="POST" name="delete_item" style="display:none">
                                                @csrf
                                                {{ method_field('DELETE') }}
                                            </form>
                                        </a>
                                        @endif
                                        <div class="btn-group btn-group-sm" role="group">
                                            <button id="userActions" type="button" class="btn btn-secondary dropdown-toggle"
                                                data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                                {{ __('labels.general.more') }}
                                            </button>
                                            <div class="dropdown-menu drop" id="moreCourse" style=" max-height:200px;
                                                    overflow:scroll; " aria-labelledby="userActions">
                                                <a tabindex="1"
                                                    href="{{ route('admin.chapters2.index2', ['course_id' => $course->id, 'course_location_id' => $item->pivot->id]) }}"
                                                    class="dropdown-item">{{ __('menus.backend.sidebar.chapters.title') }}</a>
                                                <a tabindex="1" href="{{ route('admin.chapters.rearrange', ['course_id' => $course->id, 'course_location_id' => $item->pivot->id])}}" class='dropdown-item'>{{ __('labels.backend.chapters.rearrange') }}</a>
                                                    <a tabindex=" 1"
                                                    href="{{ route('admin.forms2.index2', ['course_id' => $course->id,'course_location_id' => $item->pivot->id,'form_type' => 'test']) }}"
                                                    class="dropdown-item">{{ __('menus.backend.sidebar.tests.title') }}</a>
                                                {{-- <a tabindex="1" href="{{route('admin.chapters.index', ['course_id' => $course->id,'course_location_id'=>$item->id])}}" class="dropdown-item">{{ __('menus.backend.sidebar.chapters.title')}}</a> --}}
                                                <a tabindex="1"
                                                    href="{{ route('admin.lessons.index2', ['course_id' => $course->id, 'course_location_id' => $item->pivot->id]) }}"
                                                    class="dropdown-item">{{ __('menus.backend.sidebar.lessons.title') }}</a>
                                                <a tabindex="1"
                                                    href="{{ route('admin.courses.get_course_student2', ['course_id' => $course->id,'course_location_id' => $item->pivot->id]) }}"
                                                    class="dropdown-item">{{ __('menus.backend.sidebar.students.title') }}</a>


                                            <a tabindex="1" href="{{route('admin.Attendance.index', ['course' => $course->id,'course_location_id'=>$item->pivot->id])}}" class="dropdown-item">{{ __('menus.backend.sidebar.attendance.title')}}</a> 
                                             <a tabindex="1" href="{{route('admin.all_certificates.index2', ['course_id' => $course->id,'course_location_id'=>$item->pivot->id])}}" class="dropdown-item">
                                               {{ __('menus.backend.sidebar.certificates.title')}}</a> 
                                               {{--  <a tabindex="1"
                                                    href="{{ route('admin.all_certificates.index2', ['course_id' => $course->id,'course_location_id' => $item->pivot->location_id]) }}"
                                                    class="dropdown-item">{{ __('menus.backend.sidebar.certificates.title') }}</a>--}}

                                            <a tabindex="1" href="{{route('admin.courses.get_course_student3', ['course_id' => $course->id,'course_location_id'=>$item->pivot->id])}}" class="dropdown-item">{{ __('menus.backend.sidebar.certificates.abroveall')}}</a> 
             
                                           
                                            <a tabindex="1" href="{{route('admin.forms2.index2', ['course_id' => $course->id, 'form_type' => 'rate','course_location_id'=>$item->pivot->id])}}" class="dropdown-item"> {{__('menus.backend.sidebar.rates.title')}}</a>
                                            <a tabindex="1" href="{{route('admin.forms2.index2', ['course_id' => $course->id, 'form_type' => 'impact_measurments','course_location_id'=>$item->pivot->id])}}" class="dropdown-item"> {{__('menus.backend.sidebar.impact.title')}}</a>
                                            <a tabindex="1" href="{{route('admin.forms2.index2', ['course_id' => $course->id, 'form_type' => 'program_recommendation','course_location_id'=>$item->pivot->id])}}" class="dropdown-item"> {{__('menus.backend.sidebar.programRec.title')}}</a>
                                            
                                            <a tabindex="1" href="{{ route('admin.courses.get_invitations', ['course_id' => $course->id,'course_location_id'=>$item->pivot->id]) }}" class="dropdown-item">{{ __('menus.backend.sidebar.courses.invitation') }}</a> 
                                            <a tabindex="1" href="{{route('courses.landing', ['course' => $course->slug]) }}" class="dropdown-item">{{ __('menus.backend.sidebar.courses.landing')}}</a> 
 
                                            <a tabindex="1" href="{{ route('admin.courses.add_students_to_course',['course_id' => $course->id,'course_location_id'=>$item->pivot->id]) }}"
                                            class="dropdown-item">@lang('buttons.backend.access.users.addToCourse')</a>
                                        <a tabindex="1" href="{{ route('admin.courses.remove_students_from_course',['course_id' => $course->id,'course_location_id'=>$item->pivot->id]) }}"
                                        class="dropdown-item">@lang('buttons.backend.access.users.removeFromCourse')</a>
                                            {{--  <a tabindex="1"
                                                    href="{{ route('admin.Attendance.course_locations2', ['course' => $course->id,'course_location_id' => $item->pivot->id]) }}"
                                                    class="dropdown-item">{{ __('menus.backend.sidebar.attendance.title') }}</a>
                                                <a tabindex="1"
                                                    href="{{ route('admin.all_certificates.index2', ['course_id' => $course->id,'course_location_id' => $item->pivot->location_id]) }}"
                                                    class="dropdown-item">{{ __('menus.backend.sidebar.certificates.title') }}</a>




                                                <a tabindex="1"
                                                    href="{{ route('admin.forms2.index2', ['course_id' => $course->id,'form_type' => 'rate','course_location_id' => $item->pivot->id]) }}"
                                                    class="dropdown-item">
                                                    {{ __('menus.backend.sidebar.rates.title') }}</a>
                                                <a tabindex="1"
                                                    href="{{ route('admin.courses.get_invitations', ['course' => $course->id]) }}"
                                                    class="dropdown-item">{{ __('menus.backend.sidebar.courses.invitation') }}</a>
                                                   
                                                    <a tabindex="1"
                                                    href="{{ route('courses.landing', ['course' => $course->slug]) }}"
                                                    class="dropdown-item">{{ __('menus.backend.sidebar.courses.landing') }}</a>



                                               

                               
                                                    --}}
                                                                 <!-- ** -->



                                        </div>
                                    </td>
                                </tr>
                            @endforeach
                        @endforeach
                    </tbody>
                </table>
            </div>
        </div>

    </div>
    </div>

@endsection

@push('after-scripts')
    <script>
        $(document).ready(function() {

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
                            columns: [0, 1, 2, 3, 4, 5, 6, 7, 8, 9]
                        }
                    },
                    {
                        extend: 'print',
                        exportOptions: {
                            columns: [0, 1, 2, 3, 4, 5, 6, 7, 8, 9]
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
                        "targets": 9
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
            $('#filter').on('click', function() {
                $('#filterForm').toggleClass('filter-form')
                $('#filterForm').toggleClass('d-none')
                // $('#filter').toggleClass('iconFilterM-T')

            })
          
        });
    </script>
@endpush
