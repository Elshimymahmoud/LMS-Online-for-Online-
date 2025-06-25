@extends('backend.layouts.app')

@section('title', __('labels.backend.courses.fields.location').' | '.app_name())

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
  
       
        .headerr{
            top: 15%;
            /* width:80%;  */
            height:100px; 
            background:white; 
            /* position:fixed; */
            text-align: center;
            -webkit-box-shadow: 0 3px 5px rgba(57, 63, 72, 0.3);
                -moz-box-shadow: 0 3px 5px rgba(57, 63, 72, 0.3);
                box-shadow: 0 3px 5px rgba(57, 63, 72, 0.3);
                border: 1px solid #d7cece;
                padding: 20px;
                color: darkslategray;
                font-size: x-large;
                border-radius: 7px;
}
    </style>
@endpush

@section('content') 

<nav aria-label="breadcrumb" class="headerr ">
  <ol class="breadcrumb">
    <li class="breadcrumb-item"><a href="{{ route('admin.courses.index2') }}"><i class="fa fa-home" ></i></a></li>
    <li class="breadcrumb-item">   {{$course->type->name_ar}} </li>
    <li class="breadcrumb-item active" aria-current="page">{{$course->title_ar}}</li>
  </ol>
</nav>
    <div class="card" style="margin-top: 2%;">
        <div class="card-header">

{{--
            <h3 class="page-title d-inline">@lang('labels.backend.courses.fields.location') </h3>
--}}
            <h3 class="page-title d-inline">@lang('labels.backend.courses.fields.location') </h3>

          <div class="float-right">
                <a href="{{ route('admin.courses.location.create',['course_id'=>$course->id]) }}"
                   class="btn btn-success">
                   <i class="icon-plus" title="@lang('strings.backend.general.app_add_new')"></i>
                   {{-- @lang('menus.backend.sidebar.courses.createLocation') --}}
                </a>
                   <a href="{{ route('admin.courses.index') }}"
                   class="btn btn-primary">&#8592</a>
                  
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
                               
                               

                                <!-- <th>@lang('labels.backend.courses.fields.location_en')</th> -->
                                <th>@lang('labels.backend.courses.fields.location_ar')</th>
                                <th>@lang('labels.backend.courses.fields.start_date')</th>
                                <th>@lang('labels.backend.courses.fields.end_date')</th>
                                <th>@lang('labels.backend.courses.fields.price')</th>
                                <th>@lang('labels.backend.courses.fields.client')</th>

                                <th>@lang('labels.backend.courses.fields.teacher')</th>

                                

                                @if( request('show_deleted') == 1 )
                                    <th>&nbsp; @lang('strings.backend.general.actions')</th>
                                @else
                                    <th>&nbsp; @lang('strings.backend.general.actions')</th>
                                @endif
                            </tr>
                            </thead>
                            <tbody>
                            @foreach($courseLocations as $key=>$item)
                                @php $key++ @endphp
                                <tr>
                                    <td>
                                        {{ $key }}
                                    </td>
                                  
                                   
                                   {{-- <td>
                                      
                                        {{$item->location->name}}
                                       
                                    </td>--}}

                                    <td>
                                        {{$item->location->name_ar}}

                                       
                                    </td>
                                 
                                  <td>
                                    {{$item->start_date}}
                                  </td>
                                    <td>
                                        {{$item->end_date}}
                                    </td>
                                    <td>
                                        {{$item->price}}
                                    </td>
                                    <td>
                                        @php
                                        $courseClients = $item->clients ? $item->clients : [];
                                        @endphp
                                        
                                        @foreach ($courseClients as $clientcourse)
                                        <p style="margin-top: -10pxx;">{{session('locale') == 'ar'? $clientcourse->name_ar : $clientcourse->name }}</p>
                                        @endforeach
                                    </td>
                                    <td>
                                        
                                        @foreach ($item->teachers as $teacher)
                                                {{session('locale')=='ar'?$teacher->name_ar:$teacher->first_name.' '.$teacher->last_name.' '.$teacher->third_name.' '.$teacher->fourth_name}}
                                        @endforeach
                                        
                                    </td>
                                    <td>

                                        <a href="{{route('admin.courses.location.edit', ['course_id'=>$course->id,'location_id'=>$item->id])}}" class="btn btn-xs btn-info mb-1"><i class="icon-pencil"></i></a>
                                        
                                        
                                        @if(\Auth::user()->id==1)
                                       
                                        <a data-method="delete" data-trans-button-cancel="Cancel"
                                           data-trans-button-confirm="Delete" data-trans-title="Are you sure?"
                                           class="btn btn-xs btn-danger text-white mb-1" style="cursor:pointer;"
                                           onclick="$(this).find('form').submit();">
                                            <i class="fa fa-trash" data-toggle="tooltip" data-placement="top" title=""  data-original-title="Delete"></i>
                                               
                                            <form action="{{route('admin.courses.location.destroy',['course_id'=>$course->id,'location_id'=>$item->id])}}" method="POST" name="delete_item" style="display:none">
                                                @csrf
                                                {{method_field('DELETE')}}
                                            </form>
                                        </a>
                                        @endif
                                        {{-- <div class="btn-group btn-group-sm" role="group">
                                            <button id="userActions" type="button" class="btn btn-secondary dropdown-toggle" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                               {{__('labels.general.more')}} 
                                            </button>
                                            <div class="dropdown-menu drop" id="moreCourse" style=" max-height:200px;
                                            overflow:scroll; " aria-labelledby="userActions">
                                            <a tabindex="1" href="{{route('admin.chapters2.index2', ['course_id' => $course->id,'course_location_id'=>$item->id])}}" class="dropdown-item">{{ __('menus.backend.sidebar.chapters.title')}}</a> 
                                            <a tabindex="1" href="{{route('admin.forms2.index2', ['course_id' => $course->id,'course_location_id'=>$item->id,'form_type' => 'test'])}}" class="dropdown-item">{{ __('menus.backend.sidebar.tests.title')}}</a> 
                                           
                                        </div> --}}
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
                            columns: [ 0,1, 2,3,4,5,6,7,8]
                        }
                    },
                    {
                        extend: 'print',
                        exportOptions: {
                            columns: [ 0,1, 2, 3,4,5,6,7,8]
                        }
                    },
                    'colvis'
                ],

                columnDefs: [
                    {"width": "10%", "targets": 0},
                    {"width": "15%", "targets": 7},
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

