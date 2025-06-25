@inject('request', 'Illuminate\Http\Request')
@extends('backend.layouts.app')
@section('title', __('labels.backend.courses.title').' | '.app_name())
@push('after-styles')
<style>
    .drop:hover {

        overflow: scroll !important;
        max-height: 200px !important;
    }
</style>
@endpush


@section('content')
{{-- @dd(Auth::user()->hasRole('coordinator')) --}}

<div class="card">
    <div class="card-header">
        <h3 class="page-title float-left mb-0">@lang('labels.backend.courses.title')</h3>
        @can('course_create')
        <div class="float-right">
            <a href="{{ route('admin.courses.create') }}" class="btn btn-success"><i class="icon-plus" title="@lang('strings.backend.general.app_add_new')"></i></a>
            <a href="{{ route('admin.courses.add_students_to_course') }}" class="btn btn-success">@lang('buttons.backend.access.users.addToCourse')</a>
            <a href="{{ route('admin.courses.remove_students_from_course') }}" class="btn btn-success">@lang('buttons.backend.access.users.removeFromCourse')</a>
        </div>
        @endcan
    </div>
    <div class="card-body">
        <div class="table-responsive">
            <div class="d-block">
                <ul class="list-inline" style="padding-inline-start: 0px;">
                    <li class="list-inline-item">
                        <a href="{{ route('admin.courses.index') }}" style="{{ request('show_deleted') == 1 ? '' : 'font-weight: 700' }}">{{trans('labels.general.all')}}</a>
                    </li>
                    |
                    <li class="list-inline-item">
                        <a href="{{ route('admin.courses.index') }}?show_deleted=1" style="{{ request('show_deleted') == 1 ? 'font-weight: 700' : '' }}">{{trans('labels.general.trash')}}</a>
                    </li>
                </ul>
            </div>


            <table id="myTable" class="table table-border table-hover  @can('course_delete') @if ( request('show_deleted') != 1 ) dt-select @endif @endcan">
                <thead class="table-light">
                    <!-- <tr>
                        @can('course_delete')
                            @if ( request('show_deleted') != 1 )
                                <th style="text-align:center;"><input type="checkbox" class="mass" id="select-all"/></th>@endif
                        @endcan

                        @can('course_access')
                        @if (Auth::user()->isAdmin())

                        {{-- @if (Auth::user()->isAdmin()||Auth::user()->hasRole('coordinator')) --}}

                                <th>@lang('labels.general.sr_no')</th>
                                <th>@lang('labels.backend.courses.fields.teachers')</th>
                        @else
                                <th>@lang('labels.general.sr_no')</th>
                               
                             
                               
                            @endif
                        @endcan
                        <th>@lang('labels.backend.general-titles.title')</th>
                        <th>@lang('labels.backend.courses.fields.category')</th>
                        {{-- <th>@lang('labels.backend.courses.fields.price') <br><small>(in {{$appCurrency['symbol']}})</small></th> --}}
                            <th>@lang('labels.backend.courses.fields.status')</th>
                        @if( request('show_deleted') == 1 )
                            <th>&nbsp; @lang('strings.backend.general.actions')</th>
                        @else
                            <th>&nbsp; @lang('strings.backend.general.actions')</th>
                        @endif
                    </tr> -->
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
                    @if($course->locations->isEmpty())
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

                            {{ $item->name ?? "" }}

                        </td>
                        @else
                        <td>
                            {{ $item->name_ar ?? "" }}


                        </td>
                        @endif
                        <td>
                            {{ $item->pivot->start_date ?? ""}}
                        </td>
                        <td>
                            {{ $item->pivot->end_date ?? ""}}
                        </td>
                        <td>
                            {{ $item->pivot->price ?? ""}}
                        </td>
                        <td>
                        <span></span>
                        </td>
                        <td>
                            <span></span>
                        </td>
                        <td>
                            <a href="{{ route('admin.courses.show', ['course' => $course->id,'course_location_id'=>$item->pivot->id ?? '']) }}" class="btn btn-xs btn-info mb-1"><i class="icon-eye"></i></a>
                            {{-- <a href="{{ route('admin.courses.edit', ['course' => $course->id]) }}"
                            class="btn btn-xs btn-info mb-1"><i class="icon-pencil"></i></a> --}}
                            <!-- <a href="{{ route('admin.courses.location2.index', ['course_id' => $course->id]) }}" class="btn btn-xs btn-info mb-1" title="@lang('menus.backend.sidebar.courses.locations_times')"><i class="icon-arrow-left"></i></a> -->

                            {{-- <a href="{{route('admin.courses.location.edit', ['course_id'=>$course->id,'location_id'=>$item->pivot->id ?? ''])}}" class="btn btn-xs btn-info mb-1"><i class="icon-pencil"> تعديل المكان </i></a> --}}


                            @if(\Auth::user()->id==1)
                            <a data-method="delete" data-trans-button-cancel="Cancel" data-trans-button-confirm="Delete" data-trans-title="Are you sure?" class="btn btn-xs btn-danger text-white mb-1" style="cursor:pointer;" onclick="$(this).find('form').submit();">
                                <i class="fa fa-trash" data-toggle="tooltip" data-placement="top" title="" data-original-title="Delete"></i>

                                <form action="{{ route('admin.courses.location.destroy', ['course_id' => $course->id, 'location_id' => $item->pivot->id ?? '']) }}" method="POST" name="delete_item" style="display:none">
                                    @csrf
                                    {{ method_field('DELETE') }}
                                </form>
                            </a>
                            @endif
                            <div class="btn-group btn-group-sm" style="display: inline-block;" role="group">
                                <a id="userActions" type="button" class="btn btn-xs bg-warning mb-1 p-2 dropdown-toggle" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                    <i class="fa fa-plus-square" aria-hidden="true"></i>
                                </a>
                                <div class="dropdown-menu drop" id="moreCourse" style=" max-height:200px;
                                                    overflow:scroll; " aria-labelledby="userActions">
                                    <a tabindex="1" href="{{ route('admin.chapters2.index2', ['course_id' => $course->id, 'course_location_id' => $item->pivot->id ?? '']) }}" class="dropdown-item">{{ __('menus.backend.sidebar.chapters.title') }}</a>
                                    <a tabindex="1" href="{{ route('admin.courses.location2.index', ['course_id' => $course->id]) }}" class="dropdown-item">{{ __('menus.backend.sidebar.chapters.location') }}</a>
                                    <a tabindex="1" href="{{ route('admin.chapters.rearrange', ['course_id' => $course->id, 'course_location_id' => $item->pivot->id ?? ''])}}" class='dropdown-item'>{{ __('labels.backend.chapters.rearrange') }}</a>
                                    <a tabindex=" 1" href="{{ route('admin.forms2.index2', ['course_id' => $course->id,'course_location_id' => $item->pivot->id ?? '','form_type' => 'test']) }}" class="dropdown-item">{{ __('menus.backend.sidebar.tests.title') }}</a>
                                    {{-- <a tabindex="1" href="{{route('admin.chapters.index', ['course_id' => $course->id,'course_location_id'=>$item->id ?? ''])}}" class="dropdown-item">{{ __('menus.backend.sidebar.chapters.title')}}</a> --}}
                                    <a tabindex="1" href="{{ route('admin.lessons.index2', ['course_id' => $course->id, 'course_location_id' => $item->pivot->id ?? '']) }}" class="dropdown-item">{{ __('menus.backend.sidebar.lessons.title') }}</a>
                                    <a tabindex="1" href="{{ route('admin.courses.get_course_student2', ['course_id' => $course->id,'course_location_id' => $item->pivot->id ?? '']) }}" class="dropdown-item">{{ __('menus.backend.sidebar.students.title') }}</a>


                                    <a tabindex="1" href="{{route('admin.Attendance.index', ['course' => $course->id,'course_location_id'=>$item->pivot->id ?? ''])}}" class="dropdown-item">{{ __('menus.backend.sidebar.attendance.title')}}</a>
                                    <a tabindex="1" href="{{route('admin.all_certificates.index2', ['course_id' => $course->id,'course_location_id'=>$item->pivot->id ?? ''])}}" class="dropdown-item">
                                        {{ __('menus.backend.sidebar.certificates.title')}}</a>
                                    {{-- <a tabindex="1"
                                                    href="{{ route('admin.all_certificates.index2', ['course_id' => $course->id,'course_location_id' => $item->pivot->location_id ?? '']) }}"
                                    class="dropdown-item">{{ __('menus.backend.sidebar.certificates.title') }}</a>--}}

                                    <a tabindex="1" href="{{route('admin.courses.get_course_student3', ['course_id' => $course->id,'course_location_id'=>$item->pivot->id ?? ''])}}" class="dropdown-item">{{ __('menus.backend.sidebar.certificates.abroveall')}}</a>


                                    <a tabindex="1" href="{{route('admin.forms2.index2', ['course_id' => $course->id, 'form_type' => 'rate','course_location_id'=>$item->pivot->id ?? ''] )}}" class="dropdown-item"> {{__('menus.backend.sidebar.rates.title')}}</a>
                                    <a tabindex="1" href="{{route('admin.forms2.index2', ['course_id' => $course->id, 'form_type' => 'impact_measurments','course_location_id'=>$item->pivot->id ?? ''])}}" class="dropdown-item"> {{__('menus.backend.sidebar.impact.title')}}</a>
                                    <a tabindex="1" href="{{route('admin.forms2.index2', ['course_id' => $course->id, 'form_type' => 'program_recommendation','course_location_id'=>$item->pivot->id ?? ''])}}" class="dropdown-item"> {{__('menus.backend.sidebar.programRec.title')}}</a>

                                    <a tabindex="1" href="{{ route('admin.courses.get_invitations', ['course_id' => $course->id,'course_location_id'=>$item->pivot->id ?? '']) }}" class="dropdown-item">{{ __('menus.backend.sidebar.courses.invitation') }}</a>
                                    <a tabindex="1" href="{{route('courses.landing', ['course' => $course->slug]) }}" class="dropdown-item">{{ __('menus.backend.sidebar.courses.landing')}}</a>

                                    <a tabindex="1" href="{{ route('admin.courses.add_students_to_course',['course_id' => $course->id,'course_location_id'=>$item->pivot->id ?? '']) }}" class="dropdown-item">@lang('buttons.backend.access.users.addToCourse')</a>
                                    <a tabindex="1" href="{{ route('admin.courses.remove_students_from_course',['course_id' => $course->id,'course_location_id'=>$item->pivot->id ?? '']) }}" class="dropdown-item">@lang('buttons.backend.access.users.removeFromCourse')</a>
                                    {{-- <a tabindex="1"
                                                    href="{{ route('admin.Attendance.course_locations2', ['course' => $course->id,'course_location_id' => $item->pivot->id ?? '']) }}"
                                    class="dropdown-item">{{ __('menus.backend.sidebar.attendance.title') }}</a>
                                    <a tabindex="1" href="{{ route('admin.all_certificates.index2', ['course_id' => $course->id,'course_location_id' => $item->pivot->location_id ?? '']) }}" class="dropdown-item">{{ __('menus.backend.sidebar.certificates.title') }}</a>




                                    <a tabindex="1" href="{{ route('admin.forms2.index2', ['course_id' => $course->id,'form_type' => 'rate','course_location_id' => $item->pivot->id ?? '']) }}" class="dropdown-item">
                                        {{ __('menus.backend.sidebar.rates.title') }}</a>
                                    <a tabindex="1" href="{{ route('admin.courses.get_invitations', ['course' => $course->id]) }}" class="dropdown-item">{{ __('menus.backend.sidebar.courses.invitation') }}</a>

                                    <a tabindex="1" href="{{ route('courses.landing', ['course' => $course->slug]) }}" class="dropdown-item">{{ __('menus.backend.sidebar.courses.landing') }}</a>






                                    --}}
                                    <!-- ** -->



                                </div>
                        </td>
                    </tr>
                    @else
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
                            <a href="{{ route('admin.courses.show', ['course' => $course->id,'course_location_id'=>$item->pivot->id]) }}" class="btn btn-xs btn-info mb-1"><i class="icon-eye"></i></a>
                            {{-- <a href="{{ route('admin.courses.edit', ['course' => $course->id]) }}"
                            class="btn btn-xs btn-info mb-1"><i class="icon-pencil"></i></a> --}}
                            <!-- <a href="{{ route('admin.courses.location2.index', ['course_id' => $course->id]) }}" class="btn btn-xs btn-info mb-1" title="@lang('menus.backend.sidebar.courses.locations_times')"><i class="icon-arrow-left"></i></a> -->

                            {{-- <a href="{{route('admin.courses.location.edit', ['course_id'=>$course->id,'location_id'=>$item->pivot->id])}}" class="btn btn-xs btn-info mb-1"><i class="icon-pencil"> تعديل المكان </i></a> --}}


                            @if(\Auth::user()->id==1)
                            <a data-method="delete" data-trans-button-cancel="Cancel" data-trans-button-confirm="Delete" data-trans-title="Are you sure?" class="btn btn-xs btn-danger text-white mb-1" style="cursor:pointer;" onclick="$(this).find('form').submit();">
                                <i class="fa fa-trash" data-toggle="tooltip" data-placement="top" title="" data-original-title="Delete"></i>

                                <form action="{{ route('admin.courses.location.destroy', ['course_id' => $course->id, 'location_id' => $item->pivot->id]) }}" method="POST" name="delete_item" style="display:none">
                                    @csrf
                                    {{ method_field('DELETE') }}
                                </form>
                            </a>
                            @endif
                            <div class="btn-group btn-group-sm" style="display: inline-block;" role="group">
                                <a id="userActions" type="button" class="btn btn-xs bg-warning mb-1 p-2 dropdown-toggle" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                    <i class="fa fa-plus-square" aria-hidden="true"></i>
                                </a>
                                <div class="dropdown-menu drop" id="moreCourse" style=" max-height:200px;
                                                    overflow:scroll; " aria-labelledby="userActions">
                                    <a tabindex="1" href="{{ route('admin.chapters2.index2', ['course_id' => $course->id, 'course_location_id' => $item->pivot->id]) }}" class="dropdown-item">{{ __('menus.backend.sidebar.chapters.title') }}</a>
                                    <a tabindex="1" href="{{ route('admin.courses.location2.index', ['course_id' => $course->id]) }}" class="dropdown-item">{{ __('menus.backend.sidebar.chapters.location') }}</a>
                                    <a tabindex="1" href="{{ route('admin.chapters.rearrange', ['course_id' => $course->id, 'course_location_id' => $item->pivot->id])}}" class='dropdown-item'>{{ __('labels.backend.chapters.rearrange') }}</a>
                                    <a tabindex=" 1" href="{{ route('admin.forms2.index2', ['course_id' => $course->id,'course_location_id' => $item->pivot->id,'form_type' => 'test']) }}" class="dropdown-item">{{ __('menus.backend.sidebar.tests.title') }}</a>
                                    {{-- <a tabindex="1" href="{{route('admin.chapters.index', ['course_id' => $course->id,'course_location_id'=>$item->id])}}" class="dropdown-item">{{ __('menus.backend.sidebar.chapters.title')}}</a> --}}
                                    <a tabindex="1" href="{{ route('admin.lessons.index2', ['course_id' => $course->id, 'course_location_id' => $item->pivot->id]) }}" class="dropdown-item">{{ __('menus.backend.sidebar.lessons.title') }}</a>
                                    <a tabindex="1" href="{{ route('admin.courses.get_course_student2', ['course_id' => $course->id,'course_location_id' => $item->pivot->id]) }}" class="dropdown-item">{{ __('menus.backend.sidebar.students.title') }}</a>


                                    <a tabindex="1" href="{{route('admin.Attendance.index', ['course' => $course->id,'course_location_id'=>$item->pivot->id])}}" class="dropdown-item">{{ __('menus.backend.sidebar.attendance.title')}}</a>
                                    <a tabindex="1" href="{{route('admin.all_certificates.index2', ['course_id' => $course->id,'course_location_id'=>$item->pivot->id])}}" class="dropdown-item">
                                        {{ __('menus.backend.sidebar.certificates.title')}}</a>
                                    {{-- <a tabindex="1"
                                                    href="{{ route('admin.all_certificates.index2', ['course_id' => $course->id,'course_location_id' => $item->pivot->location_id]) }}"
                                    class="dropdown-item">{{ __('menus.backend.sidebar.certificates.title') }}</a>--}}

                                    <a tabindex="1" href="{{route('admin.courses.get_course_student3', ['course_id' => $course->id,'course_location_id'=>$item->pivot->id])}}" class="dropdown-item">{{ __('menus.backend.sidebar.certificates.abroveall')}}</a>


                                    <a tabindex="1" href="{{route('admin.forms2.index2', ['course_id' => $course->id, 'form_type' => 'rate','course_location_id'=>$item->pivot->id])}}" class="dropdown-item"> {{__('menus.backend.sidebar.rates.title')}}</a>
                                    <a tabindex="1" href="{{route('admin.forms2.index2', ['course_id' => $course->id, 'form_type' => 'impact_measurments','course_location_id'=>$item->pivot->id])}}" class="dropdown-item"> {{__('menus.backend.sidebar.impact.title')}}</a>
                                    <a tabindex="1" href="{{route('admin.forms2.index2', ['course_id' => $course->id, 'form_type' => 'program_recommendation','course_location_id'=>$item->pivot->id])}}" class="dropdown-item"> {{__('menus.backend.sidebar.programRec.title')}}</a>

                                    <a tabindex="1" href="{{ route('admin.courses.get_invitations', ['course_id' => $course->id,'course_location_id'=>$item->pivot->id]) }}" class="dropdown-item">{{ __('menus.backend.sidebar.courses.invitation') }}</a>
                                    <a tabindex="1" href="{{route('courses.landing', ['course' => $course->slug]) }}" class="dropdown-item">{{ __('menus.backend.sidebar.courses.landing')}}</a>

                                    <a tabindex="1" href="{{ route('admin.courses.add_students_to_course',['course_id' => $course->id,'course_location_id'=>$item->pivot->id]) }}" class="dropdown-item">@lang('buttons.backend.access.users.addToCourse')</a>
                                    <a tabindex="1" href="{{ route('admin.courses.remove_students_from_course',['course_id' => $course->id,'course_location_id'=>$item->pivot->id]) }}" class="dropdown-item">@lang('buttons.backend.access.users.removeFromCourse')</a>
                                    {{-- <a tabindex="1"
                                                    href="{{ route('admin.Attendance.course_locations2', ['course' => $course->id,'course_location_id' => $item->pivot->id]) }}"
                                    class="dropdown-item">{{ __('menus.backend.sidebar.attendance.title') }}</a>
                                    <a tabindex="1" href="{{ route('admin.all_certificates.index2', ['course_id' => $course->id,'course_location_id' => $item->pivot->location_id]) }}" class="dropdown-item">{{ __('menus.backend.sidebar.certificates.title') }}</a>




                                    <a tabindex="1" href="{{ route('admin.forms2.index2', ['course_id' => $course->id,'form_type' => 'rate','course_location_id' => $item->pivot->id]) }}" class="dropdown-item">
                                        {{ __('menus.backend.sidebar.rates.title') }}</a>
                                    <a tabindex="1" href="{{ route('admin.courses.get_invitations', ['course' => $course->id]) }}" class="dropdown-item">{{ __('menus.backend.sidebar.courses.invitation') }}</a>

                                    <a tabindex="1" href="{{ route('courses.landing', ['course' => $course->slug]) }}" class="dropdown-item">{{ __('menus.backend.sidebar.courses.landing') }}</a>






                                    --}}
                                    <!-- ** -->



                                </div>
                        </td>
                    </tr>
                    @endforeach
                    @endif

                    
                    @endforeach
                </tbody>
            </table>
        </div>
    </div>
</div>
@stop

@push('after-scripts')
<!-- <script>

        $(document).ready(function () {
            setTimeout(() => {
                $('#moreCourse').hover(function(){
                console.log($(this)[0].firstChild);
                $(this)[0].firstChild.focus()
            })
            }, 1000);
          
            var route = '{{route('admin.courses.get_data')}}';

            @if(request('show_deleted') == 1)
                route = '{{route('admin.courses.get_data',['show_deleted' => 1])}}';
            @endif

            @if(request('teacher_id') != "")
                route = '{{route('admin.courses.get_data',['teacher_id' => request('teacher_id')])}}';
            @endif

            @if(request('cat_id') != "")
                route = '{{route('admin.courses.get_data',['cat_id' => request('cat_id')])}}';
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
                            columns: [ 1, 2, 3, 4,5]
                        }
                    },
                    {
                        extend: 'print',
                        exportOptions: {
                            columns: [ 1, 2, 3, 4,5 ]
                        }
                    },
                    'colvis'
                ],
                ajax: route,
                columns: [
                        @if(request('show_deleted') != 1 && (Auth::user()->isAdmin()))
                    { "data": function(data){
                       
                        return '<input type="checkbox" class="single" name="id[]" value="'+ data.id +'" />';
                    }, "orderable": false, "searchable":false, "name":"id" },
                        @endif
                        @if (Auth::user()->isAdmin())
                      
                    {data: "DT_RowIndex", name: 'DT_RowIndex'},
                    {data: "teachers", name: 'teachers'},

                    @else
                    {data: "DT_RowIndex", name: 'DT_RowIndex'},

                    @endif
                    {data: "title", name: 'title'},
                    {data: "category", name: 'category'},
                    // {data: "price", name: "price"},
                    {data: "status", name: "status"},
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
            {{--@can('course_delete')--}}
            {{--@if(request('show_deleted') != 1)--}}
            {{--$('.actions').html('<a href="' + '{{ route('admin.courses.mass_destroy') }}' + '" class="btn btn-xs btn-danger js-delete-selected" style="margin-top:0.755em;margin-left: 20px;">Delete selected</a>');--}}
            {{--@endif--}}
            {{--@endcan--}}
        });
        

    </script> -->
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
                    colvis: '{{ trans('
                    datatable.colvis ') }}',
                    pdf: '{{ trans('
                    datatable.pdf ') }}',
                    csv: '{{ trans('
                    datatable.csv ') }}',
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