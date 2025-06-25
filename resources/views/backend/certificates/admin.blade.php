
@extends('backend.layouts.app')

@section('title', __('labels.backend.certificates.title').' | '.app_name())

@section('content')
 
    <div class="card">
        {{-- <div class="row" style="padding:10px ">
            <div class="col-6 form-group">
                {!! Form::label('name', trans('labels.backend.courses.fields.course').'*', ['class' => 'control-label']) !!}
                {!! Form::select('course_id', $courses,  old('course_id'), ['class' => 'form-control select2','id'=>'course_id']) !!}
    
    
            </div>
            <div class="col-lg-6 form-group">
                {!! Form::label('course_location_label', trans('labels.backend.courses.fields.location').'*', ['class' => 'control-label ']) !!}
                <select name="course_location_id" id="course_location_id" class="form-control" required>
                </select>
            </div>
        </div> --}}
       
        <div class="card-header">
            <h3 class="page-title ">@lang('labels.backend.certificates.title')</h3>
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
                                <th>@lang('labels.backend.certificates.fields.course_name')</th>
                                <th>@lang('labels.backend.certificates.fields.user')</th>
                                <th>@lang('labels.backend.certificates.fields.action')</th>
                            </tr>
                            </thead>

                            <tbody>
                               
                            @if(count($certificates) > 0)
                            
                                @foreach($certificates as $key => $certificate)
                            
                                @php $key++; @endphp
                                    <tr>
                                        <td>{{$key}}</td>
                                        <td>{{$certificate->course->title}}</td>
                                        <td><a href="{{url('/user/auth/user').'/'.$certificate->user->id}}">{{$certificate->user->name }}</a></td>
                                        <th>
                                            @if($certificate->course->type_id==3)
                                            <a class="btn btn-primary" href="{{route('admin.certificates.showDirect',['certificate_id'=>$certificate->id,'direct'=>'true'])}}">
                                                @lang('labels.backend.certificates.show') </a>
                                            <button class="btn btn-primary" onclick="copy(event)" value="{{route('certificates.showDirect',['certificate_id'=>$certificate->id,'direct'=>'true'])}}"> @lang('labels.backend.certificates.copy')</button>
                                            @else
                                                <a href="{{asset('storage/certificates/'.$certificate->url)}}" class="btn btn-success">
                                                    @lang('labels.backend.certificates.view') </a>
                                                @endif
                                                <a class="btn btn-primary" href="{{route('admin.certificates.download',['certificate_id'=>$certificate->id])}}">
                                                    @lang('labels.backend.certificates.download') </a>
                                                    {{-- <a href="{{route('admin.certificates.destroy',['certificate_id'=>$certificate->id])}}" class="btn btn-danger">
                                                        @lang('labels.backend.certificates.delete') </a> --}}
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

