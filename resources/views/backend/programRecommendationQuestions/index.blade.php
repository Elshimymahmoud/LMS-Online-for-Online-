@extends('backend.layouts.app')

@section('title', __('labels.backend.programRec.title').' | '.app_name())

@push('after-styles')
    <link rel="stylesheet" type="text/css" href="{{asset('plugins/amigo-sorter/css/theme-default.css')}}">
    <style>
        ul.sorter > span {
            display: inline-block;
            width: 100%;
            height: 100%;
            background: #f5f5f5;
            color: #333333;
            border: 1px solid #cccccc;
            border-radius: 6px;
            padding: 0px;
        }

        ul.sorter li > span .title {
            padding-left: 15px;
        }

        ul.sorter li > span .btn {
            width: 20%;
        }


    </style>
@endpush

@section('content')
    <div class="card">
        <div class="card-header">
            <h3 class="page-title d-inline">@lang('labels.backend.programRec.fields.questions')</h3>
            <div class="float-right">
                <a href="{{route('admin.programRecommendationQuestions.create', ['programRec_id' => $programRecommendation->id])}}" class="btn btn-success mb-1"><i class="fa fa-plus-circle"></i></a> 

            </div>
            <div class="float-left">
                <a href="{{ route('admin.programRecommendation.index') }}"
                   class="btn "><i class="nav-icon icon-arrow-left-circle"></i></a>

            </div>
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
                                <th>@lang('labels.backend.rates.fields.question')</th>

                                <th>@lang('labels.backend.rates.fields.questions_ar')</th>
                               
                                
                                

                                @if( request('show_deleted') == 1 )
                                    <th>&nbsp; @lang('strings.backend.general.actions')</th>
                                @else
                                    <th>&nbsp; @lang('strings.backend.general.actions')</th>
                                @endif
                            </tr>
                            </thead>
                            <tbody>
                            @foreach($programRecommendation->ProgramRecommendationQuestion as $key=>$item)
                                @php $key++ @endphp
                                <tr>
                                    <td>
                                        {{ $key }}
                                    </td>
                                    
                                    <td> {{ $item->question }}</td>
                                    <td> {{ $item->question_ar }}</td>
                                   
                                   
                                    <td>
                                        <a href="{{route('admin.programRecommendationQuestions.edit',['id'=>$item->id]) }}"
                                           class="btn btn-xs btn-info mb-1"><i class="icon-pencil"></i></a>

                                        <a data-method="delete" data-trans-button-cancel="Cancel"
                                           data-trans-button-confirm="Delete" data-trans-title="Are you sure?"
                                           class="btn btn-xs btn-danger text-white mb-1" style="cursor:pointer;"
                                           onclick="$(this).find('form').submit();">
                                            <i class="fa fa-trash"
                                               data-toggle="tooltip"
                                               data-placement="top" title=""
                                               data-original-title="Delete"></i>
                                            <form action="{{route('admin.programRecommendationQuestions.destroy',['id'=>$item->id])}}"
                                                  method="POST" name="delete_item" style="display:none">
                                                @csrf
                                                {{method_field('DELETE')}}
                                            </form>
                                        </a>
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

    <script>


        $(document).ready(function () {

            $('#myTable').DataTable({
                processing: true,
                serverSide: false,
                iDisplayLength: 10,
                retrieve: true,
                dom: 'lfBrtip<"actions">',
                buttons: [
                    {
                        extend: 'csv',
                        bom: true,
                        exportOptions: {
                            columns: [ 0,1, 2,3]
                        }
                    },
                    {
                        extend: 'print',
                        exportOptions: {
                            columns: [ 0,1, 2, 3]
                        }
                    },
                    'colvis'
                ],

                columnDefs: [
                    {"width": "10%", "targets": 0},
                    {"width": "15%", "targets": 3},
                    {"className": "text-center", "targets": [0]}
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

