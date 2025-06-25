@inject('request', 'Illuminate\Http\Request')
@extends('backend.layouts.app')
@section('title', __('labels.backend.tests_result.title').' | '.app_name())

@section('content')

    <div class="card">
        <div class="card-header">
            <h3 class="page-title d-inline">@lang('labels.backend.tests_result.title')</h3>
            <div class="float-right" style="margin-right: 10px;">
                <a href="{{ route('admin.courses.groups.tests2.index', ['group_id' => $request->group])  }}" class="btn
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
                    @foreach($testResults as $testResult)
                        <tr>
                            <td>{{ app()->getLocale() == 'ar' ? $testResult->user->full_name_ar : $testResult->user->full_name }}</td>
                            <td>{{ $testResult->user->email }} </td>
                            <td>{{ $testResult->test_result  }} / {{$test->questions()->sum('score')}}</td>
                            <td>
                                @if($test->count() > 0)
                                    <a href="{{ route('admin.courses.groups.tests2.result.view', ['test' =>
                                    $testResult->course_group_test_id, 'result' => $testResult->id, 'group_id' => $request->group]) }}"
                                       class="btn btn-xs btn-warning mb-1" title="results">
                                        <i class="icon-check"></i>
                                    </a>
                                @else
                                    <a href="{{ route('admin.courses.groups.tests2.result.view', ['test' =>
                                    $test->id, 'result' => $testResult->id, 'group_id' => $request->group]) }}"
                                       class="btn btn-xs btn-warning mb-1" title="results">
                                        <i class="icon-check"></i>
                                    </a>

                                @endif


                                <a data-method="delete" data-trans-button-cancel="إلغاء" data-trans-button-confirm="حذف" data-trans-title="هل انت متأكد من أنك تريد أن تفعل هذا؟" class="btn btn-xs btn-danger text-white mb-1" style="cursor:pointer;" onclick="$(this).find('form').submit();">
                                    <i class="fa fa-trash" data-toggle="tooltip" data-placement="top" title="" data-original-title="حذف"></i>
                                    <form action="#" method="POST" name="delete_item" style="display:none">
                                        <input type="hidden" name="_token" value="peauV1jI4HvT9ZcXpal8cNGglyPTLy3z9Cjy0jDA">                <input type="hidden" name="_method" value="DELETE">
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
