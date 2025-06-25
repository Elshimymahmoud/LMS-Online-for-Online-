@inject('request', 'Illuminate\Http\Request')
@extends('backend.layouts.app')
@section('title', __('labels.backend.tests_result.title').' | '.app_name())

@section('content')

    <div class="card">
        <div class="card-header">
            <h3 class="page-title d-inline">@lang('labels.backend.tests_result.title')</h3>
            <div class="float-right" style="margin-right: 10px;">
                <a href="{{ route('admin.courses.groups.activity.index', ['group_id' => $request->group])  }}" class="btn
                btn-primary">&#8592</a>
            </div>
        </div>

        <div class="card-body table-responsive">

            <table id="myTable"
                   class="table table-bordered table-striped @can('test_delete') @if ( request('show_deleted') != 1 ) dt-select @endif @endcan">

                    <thead>
                    <tr>
                        <th>@lang('labels.backend.tests_result.student_name')</th>
                        <th>@lang('labels.backend.tests_result.student_email')</th>
                        <th>@lang('labels.backend.tests_result.result')</th>
                        <th>@lang('labels.general.actions')</th>
                    </tr>
                    </thead>
                    <tbody>
                    @foreach($results as $result)
                        <tr>
                            <td>{{ app()->getLocale() == 'ar' ? $result->user->full_name_ar : $result->user->full_name }}</td>
                            <td>{{ $result->user->email }}</td>
                            @if($activity->type == 'points')
                                <td>{{ $result->result }}</td>
                            @else
                                @if($result->result != null)
                                    <td> @lang('labels.backend.activities.rates.'.$result->result)</td>
                                @else
                                    <td> @lang('labels.status.pending') </td>
                                @endif
                            @endif

                            <td>
                                @if($result)
                                    <a href="{{ route('admin.courses.groups.activity.result.view', ['activity' =>
                                    $activity->id, 'result' => $result->id]) }}"
                                       class="btn btn-xs btn-warning mb-1" title="results">
                                        <i class="icon-check"></i>
                                    </a>

                                @endif


                                <a data-method="delete" data-trans-button-cancel="إلغاء" data-trans-button-confirm="حذف" data-trans-title="هل انت متأكد من أنك تريد أن تفعل هذا؟" class="btn btn-xs btn-danger text-white mb-1" style="cursor:pointer;" onclick="$(this).find('form').submit();">
                                    <i class="fa fa-trash" data-toggle="tooltip" data-placement="top" title="" data-original-title="حذف"></i>
                                    <form action="{{ route('admin.courses.groups.activity.result.delete', ['activity' =>
                                    $activity->id, 'result' => $result->id]) }}"
                                          method="POST" name="delete_item" style="display:none">
                                        @csrf
                                        <input type="hidden" name="_method" value="DELETE">
                                    </form>
                                </a>


                            </td>
                        </tr>
                    @endforeach
                    </tbody>

            </table>
{{--            @else--}}
{{--            {{trans('labels.backend.dashboard.no_data')}}--}}
{{--            @endif--}}
        </form>
        </div>
    </div>
@stop

@push('after-scripts')
<script src="{{asset('plugins/amigo-sorter/js/amigo-sorter.min.js')}}"></script>

<script>
    $(document).ready(function() {

        $('#myTable').DataTable({
            processing: false,
            serverSide: false,
            iDisplayLength: 3,
            retrieve: false,
            dom: 'lfBrtip<"actions">',
            buttons: [{
                extend: 'csv',
                bom: true,
                exportOptions: {
                    columns:[0, 1, 2, 3]
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
            "columnDefs": [
                { "orderable": false, "targets": 3 }
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
