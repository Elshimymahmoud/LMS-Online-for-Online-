@inject('request', 'Illuminate\Http\Request')
@extends('backend.layouts.app')
@section('title', __('labels.backend.tests_result.title').' | '.app_name())

@section('content')

    <div class="card">
        <div class="card-header">
            <h3 class="page-title d-inline">@lang('labels.backend.tests_result.title')</h3>

        </div>

        <div class="card-body table-responsive">

            <table id="myTable"
                   class="table table-bordered table-striped @can('test_delete') @if ( request('show_deleted') != 1 ) dt-select @endif @endcan">
                <thead>
                <tr>
                    <th>Impact Name</th>
                    <th>Type</th>
                    <th>Question Title</th>
                    <th>Answer</th>
                    <th>Answered By</th>
                </tr>
                </thead>

                <tbody>

                    @foreach($impact->questions as $question)
                        @foreach($question->answers as $answer)
                            @if($answer->group_id != $group->id)
                                @continue
                            @endif
                            <tr>
                                <td>{{ $impact->impact }}</td>
                                <td>{{ $impact->user_type }}</td>
                                <td>{{ $question->question }}</td>
                                <td>
                                    @if($answer->answer_type == 'option')
                                        {{ $answer->options->first()->option_text }}
                                        @else
                                        {{ $answer->answer }}
                                    @endif
                                </td>
                                <td>{{ $answer->user->name }}</td>
                            </tr>
                        @endforeach
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
            iDisplayLength: 10,
            retrieve: false,
            dom: 'lfBrtip<"actions">',
            buttons: [{
                extend: 'csv',
                bom: true,
                exportOptions: {
                    columns:[0, 1, 2, 3, 4]
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
            "columnDefs": [
                { "orderable": false, "targets": 4 }
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
