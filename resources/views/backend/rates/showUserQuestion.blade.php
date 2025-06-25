@extends('backend.layouts.app')

@section('title', __('labels.backend.rates.title') . ' | ' . app_name())

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

        ul.sorter li>span .title {
            padding-left: 15px;
        }

        ul.sorter li>span .btn {
            width: 20%;
        }

    </style>
@endpush
@section('content')
    <div class="card">
        <div class="card-header">
            <h3 class="page-title d-inline">
                {{ $course->title }}

            </h3>
            <div class="float-right">
                {{ $user->first_name }} {{ $user->last_name }}

            </div>
        </div>
        <div class="card-body">
            {{-- //// --}}
            <div id="accordion">
                @foreach ($rate as $key => $user_rate)
                    <div class="card">
                        <div class="card-header" id="{{ $user_rate->id }}-userRate">
                            <h5 class="mb-0">
                                @if(Lang::locale()=="en") {{ $user_rate->Answer[0]->RateQuestion->question }} @else {{ $user_rate->Answer[0]->RateQuestion->question_ar }}  @endif
                            </h5>
                        </div>
                        <div class="card-header" id="{{ $user_rate->id }}-userRate">
                                {{ $user_rate->Answer[0]->answer }}
                        </div>

                    </div>

                @endforeach


            </div>

            {{-- //// --}}
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
        });
    </script>
@endpush
