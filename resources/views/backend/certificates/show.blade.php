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
                  ddddd
                </div>
            </div>
        </div>
    </div>

@stop

@push('after-scripts')
    <script>

        $(document).ready(function () {

            $('#myTable').DataTable({
                dom: 'lfBrtip<"actions">',
                buttons: [
                    {
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
                language:{
                    url : "//cdn.datatables.net/plug-ins/9dcbecd42ad/i18n/{{$locale_full_name}}.json",
                    buttons :{
                        colvis : '{{trans("datatable.colvis")}}',
                        pdf : '{{trans("datatable.pdf")}}',
                        csv : '{{trans("datatable.csv")}}',
                    }
                }

            });
        });

    </script>

@endpush