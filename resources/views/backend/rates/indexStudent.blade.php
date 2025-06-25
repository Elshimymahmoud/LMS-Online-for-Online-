@extends('backend.layouts.app')
@php
   $form_type=request('form_type'); 
   $title="menus.backend.forms.$form_type";
   $Create="menus.backend.forms.create";
   $Edit="menus.backend.forms.edit";


@endphp
@section('title', __($title).' | '.app_name())

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
    <li class="breadcrumb-item"><a href="{{ route('admin.courses.index') }}"><i class="fa fa-home" ></i></a></li>
    <li class="breadcrumb-item">   {{@$course->type->name_ar}} </li>
    <li class="breadcrumb-item" aria-current="page">{{@$course->title_ar}}</li>
    @if(isset($user))
    <li class="breadcrumb-item active" aria-current="page">
       
        @if(session('locale')=='ar')
        {{$user->name_ar}}
          {{$user->second_name_ar}}
          {{$user->third_name_ar}}
          {{$user->fourth_name_ar}}
        @else
        {{$user->first_name}}
        {{$user->last_name}}
        {{$user->third_name}}
        {{$user->fourth_name}}
        @endif
       
        </li>
    @endif
  </ol>
</nav>
    <div class="card" style="margin-top: 2%;">
        <div class="card-header">
            <h3 class="page-title d-inline">@lang($title)</h3>
            <div class="float-right">
                {{-- <a 
              
                href="{{ route('admin.forms.create',['form_type'=>request('form_type'),'course_id'=>request('course_id')]) }}"

                   class="btn btn-success">@lang('strings.backend.general.app_add_new')</a>
                  --}}
                  <a href="{{ route('admin.courses.index') }}"
                  class="btn btn-primary">&#8592</a>
                 
                   
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

                                <th>@lang('labels.backend.rates.fields.rate_title')</th>
                                <th>@lang('labels.backend.rates.fields.rate_title_ar')</th>
                                

                                @if( request('show_deleted') == 1 )
                                    <th>&nbsp; @lang('strings.backend.general.actions')</th>
                                @else
                                    <th>&nbsp; @lang('strings.backend.general.actions')</th>
                                @endif
                            </tr>
                            </thead>
                            <tbody>

                            @foreach($rates as $key=>$item)
                           
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
                                 
                             
                                    {{-- <td> --}}
                                        
                                        {{-- <a href="{{route('admin.questions.create', ['forms_id' => $item->id,'form_type'=>$item->form_type])}}" class="btn btn-success mb-1"><i class="fa fa-plus-circle"></i></a>  --}}
                                        
                                        {{-- <a href="{{route('admin.question.create', ['rate_id' => $item->id])}}" class="btn btn-success mb-1"><i class="fa fa-plus-circle"></i></a>  --}}
                                        {{-- <a href="{{route('admin.question.index', ['rate_id' => $item->id])}}" class="btn mb-1 btn-warning text-white"><i class="fa fa-arrow-right"></i></a> --}}
                                       
                                        {{-- <a href="{{route('admin.questions.index', ['forms_id' => $item->id,'form_type' => $item->form_type])}}" class="btn mb-1 btn-warning text-white"><i class="fa fa-arrow-right"></i></a> --}}
                                        
                                    {{-- </td> --}}
                                    <td>
                                     
                                        {{-- <a href="{{route('admin.forms.edit',['id'=>$item->id,'form_type'=>$item->form_type]) }}" class="btn btn-xs btn-info mb-1"><i class="icon-pencil"></i></a> --}}
                                       <a class="btn btn-xs btn-info mb-1" href="{{ route('admin.forms.make_student_rate', ['id'=>$item->id,'form_type'=>$item->form_type,'course_id' => $course->id, 'student_id' => $student_id,'course_location_id' => request('course_location_id')]) }}">
                                        <i class="icon-pencil"></i>
                                    </a>

                                        <a href="{{route('admin.results.index', ['forms_id' => $item->id,'form_type' => $item->form_type,'course_id'=>@$course_id,'student_id'=>@$student_id])}}" class="btn btn-xs btn-warning mb-1"><i class="icon-check"></i></a>

                                        {{-- <a data-method="delete" data-trans-button-cancel="Cancel"
                                           data-trans-button-confirm="Delete" data-trans-title="Are you sure?"
                                           class="btn btn-xs btn-danger text-white mb-1" style="cursor:pointer;"
                                           onclick="$(this).find('form').submit();">
                                            <i class="fa fa-trash" data-toggle="tooltip" data-placement="top" title="" data-original-title="Delete"></i>
                                            <form action="{{route('admin.forms.destroy',['id'=>$item->id])}}" method="POST" name="delete_item" style="display:none">
                                                @csrf
                                                {{method_field('DELETE')}}
                                            </form>
                                        </a> --}}
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

            $('#myTable').DataTable();
        });

  
    </script>
@endpush

