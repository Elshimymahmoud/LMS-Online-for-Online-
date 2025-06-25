@inject('request', 'Illuminate\Http\Request')
@extends('backend.layouts.app')
@section('title', __('labels.backend.tests_result.title').' | '.app_name())
@push('after-styles')
    <link href="{{ asset('iv') }}/assets/rating/css/star-rating.css" media="all" rel="stylesheet" type="text/css"/>
    <link href="{{ asset('iv') }}/assets/rating/themes/krajee-svg/theme.css" media="all" rel="stylesheet"
          type="text/css"/>
    <style>
        .rating-container .star {
            display: unset;
        }
        .filled-stars{
            direction: ltr !important;
        }
        .clear-rating{
            display: none!important;
        }

    </style>
    @endpush
@section('content')

    <div class="card">
        <div class="card-header">
            <h3 class="page-title d-inline">@lang('labels.backend.tests_result.title')</h3>
            <div class="float-right">
                <a href="{{ url()->previous() }}"
                   class="btn btn-primary">&#8592</a>
            </div>
        </div>

        <div class="card-body table-responsive">

            <table id="myTable"
                   class="table table-bordered table-striped @can('test_delete') @if ( request('show_deleted') != 1 ) dt-select @endif @endcan">
                <thead>
                <tr>
                    <th>Rate Name</th>
                    <th>Type</th>
                    <th>Question Title</th>
                    <th>Answer</th>
                    <th>Answered By</th>
                </tr>
                </thead>

                <tbody>

                   @if(Route::currentRouteName() == 'admin.groups.rates.getUserRates')
                       @foreach($rates as $rate)
                           @foreach($rate->divisions as $division)
                               @foreach($division->questions as $question)
                                   @foreach($question->answers as $answer)
                                       @if(request('user_id'))
                                           @if($answer->user_id == request('user_id'))
                                               <tr>
                                                   <td>{{ app()->getLocale() == 'ar' ? $rate->title_ar : $rate->title }}</td>
                                                   <td>{{ $rate->user_type }}</td>
                                                   <td>{{ app()->getLocale() == 'ar' ? $question->question_ar :
                                        $question->question }}</td>
                                                   <td>
                                                       @if($answer->answer_type == 'option')
                                                           {{ $answer->options->first()->option_text }}
                                                       @elseif ($answer->answer_type == 'radio')
                                                           <input name="{{ $question->id }}-options"
                                                                  id="kartik" class="rating"
                                                                  data-stars="5" data-step="0.1"
                                                                  title=""
                                                                  value="{{$answer->answer}}" disabled/>
                                                       @else
                                                           {{ $answer->answer }}
                                                       @endif
                                                   </td>
                                                   <td>
                                                       {{ app()->getLocale() == 'ar' ? $answer->user->full_name_ar :
                                                       $answer->user->full_name}}
                                                   </td>
                                               </tr>
                                           @endif
                                       @else
                                           <tr>
                                               <td>{{ $rate->title }}</td>
                                               <td>{{ $rate->user_type }}</td>
                                               <td>{{ $question->question }}</td>
                                               <td>
                                                   @if($answer->answer_type == 'option')
                                                       {{ $answer->options->first()->option_text }}
                                                   @elseif ($answer->answer_type == 'radio')
                                                       <input name="{{ $question->id }}-options"
                                                              id="kartik" class="rating"
                                                              data-stars="5" data-step="0.1"
                                                              title=""
                                                              value="{{$answer->answer}}" disabled/>
                                                   @else
                                                       {{ $answer->answer }}
                                                   @endif
                                               </td>
                                               <td>{{ app()->getLocale() == 'ar' ? $answer->user->full_name_ar :  $answer->user->full_name}}</td>
                                           </tr>
                                       @endif
                                   @endforeach
                               @endforeach
                           @endforeach

                       @endforeach
                   @else
                       @foreach($rate->divisions as $division)
                           @foreach($division->questions as $question)
                               @foreach($question->answers as $answer)
                                   @if(request('user_id'))
                                       @if($answer->user_id == request('user_id'))
                                           <tr>
                                               <td>{{ app()->getLocale() == 'ar' ? $rate->title_ar : $rate->title }}</td>
                                               <td>{{ $rate->user_type }}</td>
                                               <td>{{ app()->getLocale() == 'ar' ? $question->question_ar :
                                        $question->question }}</td>
                                               <td>
                                                   @if($answer->answer_type == 'option')
                                                       {{ $answer->options->first()->option_text }}
                                                   @elseif ($answer->answer_type == 'radio')
                                                       <input name="{{ $question->id }}-options"
                                                              id="kartik" class="rating"
                                                              data-stars="5" data-step="0.1"
                                                              title=""
                                                              value="{{$answer->answer}}" disabled/>
                                                   @else
                                                       {{ $answer->answer }}
                                                   @endif
                                               </td>
                                               <td>
                                                   {{ app()->getLocale() == 'ar' ? $answer->user->full_name_ar :
                                                   $answer->user->full_name}}
                                               </td>
                                           </tr>
                                       @endif
                                   @else
                                       <tr>
                                           <td>{{ $rate->title }}</td>
                                           <td>{{ $rate->user_type }}</td>
                                           <td>{{ $question->question }}</td>
                                           <td>
                                               @if($answer->answer_type == 'option')
                                                   {{ $answer->options->first()->option_text }}
                                               @elseif ($answer->answer_type == 'radio')
                                                   <input name="{{ $question->id }}-options"
                                                          id="kartik" class="rating"
                                                          data-stars="5" data-step="0.1"
                                                          title=""
                                                          value="{{$answer->answer}}" disabled/>
                                               @else
                                                   {{ $answer->answer }}
                                               @endif
                                           </td>
                                           <td>{{ app()->getLocale() == 'ar' ? $answer->user->full_name_ar :  $answer->user->full_name}}</td>
                                       </tr>
                                   @endif
                               @endforeach
                           @endforeach
                       @endforeach

                   @endif

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
<script src="{{ asset('iv') }}/assets/rating/js/star-rating.js"></script>
<script>
    $(document).on('change', 'input[name="stars"]', function () {
        $('#rating').val($(this).val());

    })
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
