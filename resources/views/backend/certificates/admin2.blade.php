
@extends('backend.layouts.app')

@section('title', __('labels.backend.certificates.title').' | '.app_name())
@push('after-styles')
<style>
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

    @if(!empty($group) && !empty($course))
        <nav aria-label="breadcrumb" class="headerr ">
            <ol class="breadcrumb">
                <li class="breadcrumb-item"><a href="{{ route('admin.groups.index') }}"><i class="fa fa-home"
                        ></i></a></li>
                <li class="breadcrumb-item">   {{session('locale')=='ar'?$course->type->name_ar:$course->type->name}} </li>
                <li class="breadcrumb-item" style="color:red">{{session('locale')=='ar'?$course->title_ar:$course->title}}</li>
                <li class="breadcrumb-item">{{$group->start->format('Y-M-D') ?? ''}}</li>
                <li class="breadcrumb-item active">{{session('locale')=='ar'?$group->title_ar ?? '':$group->title ?? ''}}</li>
            </ol>
        </nav>
    @endif
    <div class="card"style="margin-top: 2%;">

        <div class="card-header">
            <h3 class="page-title d-inline">@lang('labels.backend.certificates.title')</h3>
            <div class="float-right">
                <a href="{{ route('admin.groups.index') }}" class="btn btn-primary">&#8592</a>
                @if(!empty($group))
                    <a href="{{ route('admin.certificates.generateAll',['group_id'=>$group->id]) }}"
                    class="btn btn-primary">+</a>
                @endif
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
                                <th>@lang('labels.backend.certificates.fields.course_name')</th>
                                <th>@lang('labels.backend.certificates.fields.user')</th>
                                <th>@lang('labels.backend.certificates.fields.action')</th>
                            </tr>
                            </thead>

                            <tbody>

                            @if(count($certificates) > 0)

                                @foreach($certificates as $key=>$certificate)



                                @php $key++; @endphp
                                    <tr>
                                        <td>{{$key}}</td>
                                        <td>{{$certificate->course->title}}</td>
                                        <td><a href="{{url('/user/auth/user').'/'.$certificate->user->id}}">{{app()
                                        ->getLocale() =='ar'?$certificate->user->full_name_ar:$certificate->user->full_name}}</a></td>
                                        <th>
                                            @if($certificate->course->type_id==3)
                                                <a href="{{asset('storage/certificates/'.$certificate->url)}}" class="btn btn-success">
                                                    @lang('labels.backend.certificates.view') </a>

                                                <button class="btn btn-primary" onclick="copy(event)" value="{{route('certificates.showDirect',['certificate_id'=>$certificate->id,'direct'=>'true'])}}"> @lang('labels.backend.certificates.copy')</button>
                                            @else
                                                <a href="{{asset('storage/certificates/'.$certificate->url)}}" class="btn btn-success">
                                                    @lang('labels.backend.certificates.view') </a>
                                            @endif
                                                @if ($certificate->show_to_user==0)
                                                    <a class="btn btn-primary" href="{{route('admin.certificates.approveStudent',['certificate_id'=>$certificate->id])}}">
                                                        @lang('labels.backend.certificates.approve') </a>
                                                @endif
                                                <a class="btn btn-primary" href="{{route('admin.certificates.download',['certificate_id'=>$certificate->id])}}">
                                                    @lang('labels.backend.certificates.download') </a>
                                                <a href="{{route('admin.certificates.destroy',['certificate_id'=>$certificate->id])}}" class="btn btn-danger">
                                                    @lang('labels.backend.certificates.delete') </a>

                                                @if($certificate->course->type_id != 1)
{{--                                                    <a class="btn btn-primary" href="{{route('admin.certificates.showDirect2',['certificate_id'=>$certificate->id])}}">--}}
{{--                                                        @lang('labels.backend.certificates.show_date') </a>--}}
                                                @endif

                                        </th>
                                    </tr>


                                @endforeach
                              @endif


                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>

@stop

@push('after-scripts')
    <script>

        $(document).ready(function () {

            $('#myTable').DataTable({
                dom: 'lfBrtip<"actions">',
                buttons: [
                    {
                        extend: 'csv',
                        bom: true,
                        exportOptions: {
                            columns: [0, 1, 2]

                        }
                    },
                    {
                        extend: 'print',
                        exportOptions: {
                            columns: [0, 1, 2]
                        }
                    },
                    'colvis'
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
<script type="text/javascript">
    $(document).ready(function() {

        $('select[name="course_id"]').on('change', function() {
            var courseID = $(this).val();
            route = '{{route('admin.courses.getCourseLocAjax',['course_id'=>'courseID'])}}';
            route=route.replace('courseID',courseID);

            if(courseID) {
                $.ajax({
                    url: route,
                    type: "GET",
                    dataType: "json",
                    success:function(data) {


                        $('select[name="course_location_id"]').empty();
                        $.each(data, function(key, value) {
                            $('select[name="course_location_id"]').append('<option value="'+ key +'">'+ value +'</option>');
                        });


                    },
                    error:function(){

                    }
                });
            }else{
                $('select[name="city"]').empty();
            }
            setTimeout(() => {
            $("#course_location_id").val($("#course_location_id option:first").val());
            var course_id = $(this).val();
    var course_location_id = $('#course_location_id').val();

    window.location.href = "{{route('admin.all_certificates.index')}}" + "?course_id=" + course_id+'&course_location_id='+course_location_id

            }, 1000);

        });

        // =======================================
        var route = '{{route('admin.all_certificates.index')}}';

@if(request()->course_id)
$("#course_id").val('{{request()->course_id}}');
@endif
@if(request()->course_location_id)
$("#course_location_id").val('{{request()->course_location_id}}');
@endif
@php
    $show_deleted = (request('show_deleted') == 1) ? 1 : 0;
    $course_id = (request('course_id') != "") ? request('course_id') : 0;
    $course_location_id = (request('course_location_id') != "") ? request('course_location_id') : " ";

$route = route('admin.all_certificates.index',['show_deleted' => $show_deleted,'course_id' => $course_id,'course_location_id'=>$course_location_id]);
@endphp

route = '{{$route}}';
route = route.replace(/&amp;/g, '&');


$('select[name="course_location_id"]').on('change', function() {
    var course_location_id = $(this).val();
    var course_id = $('#course_id').val();
    window.location.href = "{{route('admin.all_certificates.index')}}" + "?course_id=" + course_id+'&course_location_id='+course_location_id



});
        // ====================================
    });
   function copy(event){
    let value=$(event.target).attr('value');

    navigator.clipboard.writeText(value);

    $(event.target).css({
        backgroundColor:'green',
        color:'white'
    })
    setTimeout(() => {
        $(event.target).css({
        backgroundColor:'##3bcfcb'
    })
    }, 1000);

   }
</script>

@endpush

