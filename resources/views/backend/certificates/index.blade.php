
@extends('backend.layouts.app')

@section('title', __('labels.backend.certificates.title').' | '.app_name())

@section('content')

    <div class="card">

      
        <div class="card-header">
            <h3 class="page-title ">@lang('labels.backend.certificates.title')</h3>
        </div>
     
        <div class="card-body">
            <div class="row">
                <div class="col-12">
                    <div class="table-responsive">

                        <table id="myTable"
                               class="table table-bordered table-striped ">
                            <thead>
                            <tr>
                                <th>@lang('labels.general.sr_no')</th>
                                <th>@lang('labels.backend.certificates.fields.course_name')</th>
                                <th>@lang('labels.backend.certificates.fields.progress')</th>
                                <th>@lang('labels.backend.certificates.fields.action')</th>
                            </tr>
                            </thead>

                            <tbody>
                            @if(count($certificates) > 0 )
                                @foreach($certificates as $key=>$certificate)

                                    @php $key++; @endphp
                                    @if($certificate->course)
                                        <tr>
                                            <td>{{$key}}</td>
                                            <td>{{ app()->getLocale() == 'ar' ? $certificate->course->title_ar : $certificate->course->title}}</td>
                                            <td>{{$certificate->course->progress($certificate->group_id) }}%</td>
                                            <th>
                                                @if($certificate->show_to_user != 1)
                                                    @lang('labels.backend.certificates.waiting_teacher_approve')
                                                @else
                                                    @if($certificate->course->progress($certificate->group_id) == 100)

                                                        <a href="{{asset('storage/certificates/'.$certificate->url)}}" class="btn btn-success">
                                                            @lang('labels.backend.certificates.view') </a>

                                                        <a class="btn btn-primary" href="{{route('admin.certificates.download',['certificate_id'=>$certificate->id])}}">
                                                            @lang('labels.backend.certificates.download') </a>

                                                    @endif
                                                @endif
                                            </th>
                                        </tr>
                                    @endif
                                @endforeach
                                @else
                                <tr>
                                    <td colspan="4" class="text-center">@lang('labels.frontend.certificate_verification.not_found')</td>
                                </tr>
                            @endif
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
        $(document).ready(function() {

            $('#myTable').DataTable({
                processing: false,
                serverSide: false,
                iDisplayLength: 4,
                retrieve: true,
                dom: 'lfBrtip<"actions">',
                buttons: [{
                    extend: 'csv',
                    bom: true,
                    exportOptions: {
                        columns: [0, 1, 2]
                    }
                },
                    {
                        extend: 'print',
                        exportOptions: {
                            columns: [0, 1, 2]
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
                        "targets": 8
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

        });


    </script>

@endpush