@inject('request', 'Illuminate\Http\Request')
@extends('backend.layouts.app')
@section('title', __('labels.backend.tests_result.title').' | '.app_name())

@section('content')

    <div class="card">
        <div class="card-header">
            <h3 class="page-title d-inline">@lang('labels.backend.tests_result.title')</h3>
            <div class="float-right" style="margin-right: 10px;">

                <a href="{{ route('admin.courses.groups.tests2.result', ['test' => $test->id])}}?group={{request
                ('group_id')}}"
                   class="btn
                btn-primary">&#8592</a>
            </div>
        </div>

        <div class="card-body table-responsive">

            <table id="myTable"
                   class="table table-bordered table-striped @can('test_delete') @if ( request('show_deleted') != 1 ) dt-select @endif @endcan">

                <thead>
                <tr>
                    <th>@lang('labels.backend.tests.qust')</th>
                    <th>@lang('labels.backend.tests.fields.test_type')</th>
                    <th>@lang('labels.backend.questions.fields.score')</th>
                    <th>@lang('labels.backend.faqs.fields.answer')</th>
                    <th>@lang('labels.backend.tests.fields.plagiarism_degree')</th>
                    <th>@lang('labels.general.actions')</th>
                </tr>
                </thead>
                <tbody>
                @foreach($questions as $question)
                    @php
//                        dd($answers, $questions);
                        // Filter the $result array to find the result with the same question_id
                        $matchingResults = array_filter($answers->toArray(), function ($res) use ($question) {
                            return $res['question_id'] == $question->id;
                        });

                        // If there is a matching result, compare the scores
                        if (!empty($matchingResults)) {
                            $matchingResult = reset($matchingResults);
                            if ($matchingResult['correct'] == 1){
                                $isCorrect = true;
                            } else {
                                $isCorrect = false;
                            }
                        } else {
                            $isCorrect = false;
                        }
                        //if question has an option then get it
                        if($question->question_type == 'option' || $question->question_type == 'multiple_choice'){
                            $answer = $question->options->where('correct', 1)->first();
                            $option = $answer->option_text;
                            $plagiarism_degree = $answer->plagiarism_degree;
                        }else{
                            if (!empty($matchingResults)) {
                                $plagiarism_degree = $matchingResult['plagiarism_degree'];
                                $option = $matchingResult['answer'];
                            }else{
                                $option = trans('labels.backend.questions.fields.answer_removed');
                            }
                        }
                    @endphp
                    <tr>
                        <td>
                            @if(empty($matchingResults))
                                {{ app()->getLocale() == "ar" ? $question->title_ar ?? $question->title :
                                $question->title ?? $question->title_ar }}
                                ( @lang('labels.backend.questions.fields.removed') )
                            @else
                                {{ app()->getLocale() == "ar" ? $question->title_ar ?? $question->title :
                                $question->title ?? $question->title_ar }}
                            @endif
                        </td>
                        <td>
                            @if(empty($question->question_type))
                                @lang('labels.backend.questions.fields.removed')
                            @else
                                {{ $question->question_type }}
                            @endif
                        </td>
                        <td>{!! $option !!}</td>
                        <td>
                            @if($question->question_type != 'multiple_choice' && $question->question_type != 'option')

                                {{ $isCorrect ? 'Correct' : 'Incorrect/Pending' }}
                            @else
                                {{ $isCorrect ? 'Correct' : 'Incorrect' }}
                            @endif
                        </td>
                        <td>
                            {{ $plagiarism_degree }} %
                        </td>
                        <td>
                            @if($question->question_type != 'multiple_choice' && $question->question_type != 'option')
                                @if(!empty($matchingResults))
                                    @if(!$isCorrect)
                                        <a class="btn btn-xs btn-warning text-white mb-1" style="cursor:pointer;" onclick="$(this).find('form').submit();">
                                            <i class="icon-check" data-toggle="tooltip" data-placement="top" title="" data-original-title="تقييم"></i>
                                            <form action="{{ route('admin.courses.groups.tests2.markStudentAnswer') }}" method="POST" name="edit_item"
                                                  style="display:none">
                                                @csrf
                                                <input type="hidden" name="_method" value="POST">
                                                <input type="hidden" name="result_id" value="{{ $result->id }}">
                                                @if (!empty($matchingResults))
                                                    <input type="hidden" name="answer_id" value="{{ $matchingResult['id'] }}">
                                                @endif
                                            </form>
                                        </a>
                                    @endif
                                    @else
                                        @lang('labels.backend.questions.fields.answer_removed')
                                @endif
                            @endif
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
            iDisplayLength: 4,
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
