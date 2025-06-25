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

    <div class="card" style="margin-top: 2%;">
        <div class="card-header">
            <h3 class="page-title d-inline">@lang('labels.backend.attendance.title')</h3>
            {{-- @can('blog_create')

                <div class="float-right">
                    <a href="{{ route('admin.Attendance.show', ['course_id' => $course->id]) }}"
                        class="btn btn-success">@lang('labels.backend.attendance.show')</a>
                </div>

            @endcan --}}
            <div class="float-right">
                <a href="{{ route('admin.groups.index') }}"
                   class="btn btn-primary">&#8592</a>
            </div>

        </div>
        <div class="card-body">
            <div class="row">
                <div class="col-12">
                    <div class="table-responsive">


                        <table id="myTable" class="table table-bordertable-hover">
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
                            @foreach ($groups as $key => $group)
                                @php
                                    $key += 1;
                                @endphp


                                <tr>
                                    <td>  {{ $key }} </td>


                                    <td> {{ (app()->getLocale() == 'ar') ? $group->title_ar : $group->title }} </td>

                                    <td>
                                        {{ $group->start->format('Y-m-d') }}
                                    </td>


                                    <td>
                                        {{ $group->end->format('Y-m-d') }}
                                    </td>
                                    <td>
                                      @if($group->courses)
                                          @if(request('student_id') )
                                                <a href="{{route('admin.groups.lessons', ['group' => $group->id,
                                                   'course'=>$group->courses->id,'student_id'=>request('student_id'),'lesson'=>request('lesson')])}}"
                                                   class="btn btn-primary">@lang('menus.backend.sidebar.attendance.title')
                                                </a>
                                          @else

                                              <a href="{{route('admin.Attendance.show', ['group' => $group->id,
                                                 'course'=>$group->courses->id,'student_id'=>request('student_id'),
                                                 'lesson'=>request('lesson')])}}"
                                                 class="btn btn-primary">@lang('menus.backend.sidebar.attendance.title')
                                              </a>
                                          @endif
                                      @else
                                          @lang('alerts.backend.group.course_not_found')
                                      @endif
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
