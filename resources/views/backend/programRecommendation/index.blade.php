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
            <h3 class="page-title d-inline">@lang('labels.backend.programRec.title')</h3>
            <div class="float-right">
            <a href="{{ route('admin.forms.create',['form_type'=>'program_recommendation']) }}"
                   class="btn btn-success"><i class="icon-plus" title="@lang('strings.backend.general.app_add_new')"></i></a>

                <!-- <a href="{{ route('admin.programRecommendation.create') }}"
                   class="btn btn-success"><i class="icon-plus" title="@lang('strings.backend.general.app_add_new')"></i></a> -->

            </div>
        </div>
        <div class="card-body">
            <div class="row">
                <div class="col-12">
                    <div class="table-responsive">
                        <table id="myTable"
                               class="table table-border table-hover ">
                            <thead>
                            <tr>
                               
                                <th>@lang('labels.general.sr_no')</th>

                                <th>@lang('labels.backend.programRec.fields.program_title')</th>
                                <th>@lang('labels.backend.programRec.fields.program_title_ar')</th>
                            

                                

                                @if( request('show_deleted') == 1 )
                                    <th>&nbsp; @lang('strings.backend.general.actions')</th>
                                @else
                                    <th>&nbsp; @lang('strings.backend.general.actions')</th>
                                @endif
                            </tr>
                            </thead>
                            <tbody>
                            @foreach($programRecommendations as $key=>$item)
                                @php $key++ @endphp
                                <tr>
                                    <td>
                                        {{ $key }}
                                    </td>
                                   
                                   
                                    <td>
                                      
                                        {{$item->title}}
                                       
                                    </td>

                                    <td>
                                        {{$item->title_ar}}
                                    </td>
                                 
                                    <td>
                                       
                                        <!-- <a href="forms/edit/{{$item->id}}" class="btn btn-xs btn-info mb-1"><i class="icon-pencil"></i></a> -->
                                        
                                        <a href="{{route('admin.forms.edit', ['forms_id' => $item->id,'form_type' => $item->form_type,'course_id'=>request('course_id')])}}" class="btn btn-xs btn-info mb-1"><i class="icon-pencil"></i></a>
                                        
                                        <a href="{{route('admin.results.index', ['forms_id' => $item->id,'form_type' => $item->form_type,'course_id'=>request('course_id')])}}" class="btn btn-xs btn-warning mb-1"><i class="icon-check"></i></a>
                                       
                                        <a data-method="delete" data-trans-button-cancel="Cancel"
                                           data-trans-button-confirm="Delete" data-trans-title="Are you sure?"
                                           class="btn btn-xs btn-danger text-white mb-1" style="cursor:pointer;"
                                           onclick="$(this).find('form').submit();">
                                            <i class="fa fa-trash" data-toggle="tooltip" data-placement="top" title=""  data-original-title="Delete"></i>
                                               
                                            <form action="{{route('admin.forms.destroy',['id'=>$item->id])}}" method="POST" name="delete_item" style="display:none">
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
                            columns: [ 0,1, 2]
                        }
                    },
                    {
                        extend: 'print',
                        exportOptions: {
                            columns: [ 0,1, 2]
                        }
                    },
                    'colvis'
                ],

                columnDefs: [
                    {"width": "10%", "targets": 0},
                    {"width": "15%", "targets": 2},
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

