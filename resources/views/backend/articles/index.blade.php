@extends('backend.layouts.app')

@section('title', __('labels.backend.articles.title').' | '.app_name())

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
            <h3 class="page-title d-inline">@lang('labels.backend.rates.title')</h3>
            <div class="float-right">
                <a href="{{ route('admin.course.articles.create',$course_id) }}"
                   class="btn btn-success"><i class="icon-plus" title="@lang('strings.backend.general.app_add_new')"></i></a>

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
                                <th>@lang('labels.backend.rates.fields.course')</th>

                                <th>@lang('labels.backend.rates.fields.course_type')</th>
                                <th>@lang('labels.backend.articles.fields.title')</th>
                                
                                

                                @if( request('show_deleted') == 1 )
                                    <th>&nbsp; @lang('strings.backend.general.actions')</th>
                                @else
                                    <th>&nbsp; @lang('strings.backend.general.actions')</th>
                                @endif
                            </tr>
                            </thead>
                            <tbody>
                            @foreach($articles as $key=>$item)
                                @php $key++ @endphp
                                <tr>
                                    <td>
                                        {{ $key }}
                                    </td>
                                    @if(Lang::locale()=="en")
                                    <td>
                                       
                                        {{ $item->course->title }}
                                       
                                        
                                    </td>
                                    <td>
                                      
                                        {{$item->course->type->name}}
                                       
                                    </td>

                                    <td>
                                        {{$item->title}}
                                    </td>
                                   @else
                                   <td>
                                       
                                    {{ $item->course->title_ar }}
                                   
                                    
                                </td>
                                <td>
                                  
                                    {{$item->course->type->name_ar}}
                                   
                                </td>

                                <td>
                                    {{$item->title_ar}}
                                </td>
                                   @endif
                                  
                                    <td>
                                        <a href="{{route('admin.articles.edit',['id'=>$item->id]) }}"
                                         
                                           class="btn btn-xs btn-info mb-1"><i class="icon-pencil"></i></a>

                                        <a data-method="delete" data-trans-button-cancel="Cancel"
                                           data-trans-button-confirm="Delete" data-trans-title="Are you sure?"
                                           class="btn btn-xs btn-danger text-white mb-1" style="cursor:pointer;"
                                           onclick="$(this).find('form').submit();">
                                            <i class="fa fa-trash"
                                               data-toggle="tooltip"
                                               data-placement="top" title=""
                                               data-original-title="Delete"></i>
                                            <form action="{{route('admin.articles.destroy',['id'=>$item->id])}}"
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
                            columns: ':visible',
                            format: {
                                body: handleCheckboxes
                            }
                        }
                    },
                    'colvis'
                ],

                columnDefs: [
                    {"width": "10%", "targets": 0},
                    {"width": "15%", "targets": 4},
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















{{-- /////////////////////////////////////////////////// --}}
{{-- ////////////////////////////////////////////////////// --}}
