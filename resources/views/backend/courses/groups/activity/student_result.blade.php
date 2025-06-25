@inject('request', 'Illuminate\Http\Request')
@extends('backend.layouts.app')
@section('title', __('labels.backend.tests_result.title').' | '.app_name())

@section('content')
    <div class="successMessage">
        @include('includes.partials.messages')
        <div id="flash-message">

        </div>
    </div>
    <div class="card">
        <div class="card-header">

            <h3 class="page-title d-inline">@lang('labels.backend.tests_result.title')</h3>
            <div class="float-right" style="margin-right: 10px;">
                <a href="{{ url()->previous()  }}" class="btn btn-primary">&#8592</a>
            </div>
        </div>

        <div class="card-body table-responsive">

            <table id="myTable"
                   class="table table-bordered table-striped @can('test_delete') @if ( request('show_deleted') != 1 ) dt-select @endif @endcan">

                <thead>
                <tr>
                    <th>@lang('labels.backend.tests.qust')</th>
                    <th>@lang('labels.backend.tests.fields.test_type')</th>
                    <th>@lang('labels.backend.faqs.fields.answer')</th>
                    <th>@lang('labels.backend.questions.fields.score')</th>
                    <th>@lang('labels.backend.tests.fields.plagiarism_degree')</th>
                    <th>@lang('labels.general.actions')</th>

                </tr>
                </thead>
                <tbody>

                    <tr>
                        <td>
                            {{ app()->getLocale() == "ar" ? $activity->title_ar : $activity->title }}
                        </td>
                        <td>
                            @lang('labels.backend.activities.fields.'.$activity->type )
                        </td>
                        <td style="display: flex">

                            @if($result->answers != null)
                                {!! $result->answers !!}
                            @endif
                            @if($result->file != null)
                                 ( <a href="{{ $result->file }}" target="_blank">@lang('labels.frontend.course.download_file')</a> )
                            @endif
                        </td>
                        <td>
                            @if($activity->type == 'points')
                                <input type="number" name="score" value="{{ $result->score }}" class="form-control">
                            @elseif($activity->type == 'rates')
                                <select name="score" class="form-control">
                                    <option value="bad" {{ $result->score == 'bad' ?'selected' : '' }}>
                                        @lang('labels.backend.activities.rates.bad')
                                    </option>
                                    </option>
                                    <option value="good" {{ $result->score == 'good' ? 'selected' : '' }}>
                                        @lang('labels.backend.activities.rates.good')
                                    </option>
                                    <option value="very_good" {{ $result->score == 'very_good' ? 'selected' : '' }}>
                                        @lang('labels.backend.activities.rates.very_good')
                                    </option>
                                    <option value="excellent" {{ $result->score == 'excellent' ? 'selected' : '' }}>
                                        @lang('labels.backend.activities.rates.excellent')
                                    </option>
                                </select>
                            @endif


                        </td>
                        <td>
                            {{ $result->plagiarism_degree ?? 0 }} %
                        </td>
                        <td>
                            <button class="btn btn-primary" name="sendResult_{{ $result->id }}">@lang('labels.backend.activities.fields.save')</button>
                        </td>

                    </tr>
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

    $('button[name^="sendResult_"]').on('click', function() {
        @if($activity->type == 'points')
        var score = $(this).parent().parent().find('input[name="score"]').val();

        @else
        var score = $(this).parent().parent().find('select[name="score"]').val();

        @endif
        console.log(score);
        var id = $(this).attr('name').split('_')[1];
        var type = '{{ $activity->type }}';
        var url = '{{ route('admin.courses.groups.activity.result.update', ['activity'=>$activity->id]) }}?result_id=' + id;
        $.ajax({
            url: url,
            type: 'POST',
            data: {
                _token: '{{ csrf_token() }}',
                score: score,
                type: type
            },
            success: function(data) {
                var successAlert = '<div class="alert alert-success" role="alert" id="success-alert">' +
                    '<button type="button" class="close" data-dismiss="alert" aria-label="Close">' +
                    '<span aria-hidden="true">&times;</span>' +
                    '</button>' +
                    '@lang('labels.backend.activities.activity_added')' +
                    '</div>';

                $('#flash-message').append(successAlert);
            },
            error: function() {
                var errorAlert = '<div class="alert alert-danger" role="alert" id="error-alert">' +
                    '<button type="button" class="close" data-dismiss="alert" aria-label="Close">' +
                    '<span aria-hidden="true">&times;</span>' +
                    '</button>' +
                    '@lang('labels.backend.activities.activity_not_added')' +
                    '</div>';

                $('#flash-message').append(errorAlert);
            }
        });
    });


</script>

@endpush
