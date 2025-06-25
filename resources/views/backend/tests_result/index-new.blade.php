@inject('request', 'Illuminate\Http\Request')
@extends('backend.layouts.app')
@section('title', __('labels.backend.tests_result.title').' | '.app_name())

@section('content')
{{-- 
<div class="row">
    <div class="col-12 col-lg-6 form-group">
        {!! Form::label('course_id', trans('labels.backend.chapters.fields.course'), ['class' => 'control-label']) !!}
        {!! Form::select('course_id', $courses,  (request('course_id')) ? request('course_id') : old('course_id'), ['class' => 'form-control js-example-placeholder-single select2 ', 'id' => 'course_id']) !!}
    </div>
</div> --}}
@if($user)
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
@endif
    <div class="card">
        <div class="card-header">
            <h3 class="page-title d-inline">@lang('labels.backend.tests_result.title')</h3>
            @can('test_create')
                
                    <div class="float-right">
                    @if(count($tests_result)==0)
                        <a href="{{ route('admin.tests_result.create')."?lesson_id=".request('lesson_id') }}"
                        class="btn btn-success">@lang('strings.backend.general.app_add_test') </a>
                        @endif
                        <a href="{{request('form_type') == 'group_test' ? url()->previous() : (request('course_id')?(route('admin.forms2.index2',['form_type'=>request('form_type'),'course_id'=>request('course_id')])):(route('admin.forms.index',['form_type'=>request('form_type')]))) }}" class="btn btn-primary">&#8592</a>

                    </div>
            @endcan
        </div>

        <div class="card-body table-responsive">
             
              {{-- <div class="row">
                <div class="col-12 col-lg-6 form-group">
                    {!! Form::label('location_id', trans('labels.backend.courses.fields.location'), ['class' => 'control-label']) !!}
                    {!! Form::select('location_id', $locations,  (request('location_id')) ? request('location_id') : old('location_id'), ['onchange'=>'setData(event)','class' => 'form-control  select2 ','placeholder'=>trans('labels.backend.courses.fields.choose_location'), 'id' => 'location_id']) !!}
                </div>
            </div> --}}
           @if(count($users)>0)
            <table id="myTable"
                   class="table table-bordered table-striped @can('test_delete') @if ( request('show_deleted') != 1 ) dt-select @endif @endcan">
                <thead>
                <tr>
                    @foreach ($users as $user)
                        @if(isset($user))
                        <td>  {{Lang::locale()=='ar'?($user->name_ar??($user->first_name.' '.$user->last_name)):($user->first_name.' '.$user->last_name)}}</td>
                        @endif
                    @endforeach
                </tr>
                </thead>

                <tbody>
                    
                        @foreach ($questions as $result)
                        <tr>
                        @php  $curr_user=[]; $counter=0; @endphp
                       
                        @foreach ($answers as $answer)
                       @if($answer->question_id==$result->id &&  @$answer->testResult->user ) 

                        @if(!in_array($answer->testResult->user->id, $curr_user))
                        @php $curr_user[]=$answer->testResult->user->id;  @endphp
                        

                       <td>   

                           @if($result->question_type=='drop_down' ||$result->question_type=='multiple_choice')
                            {{Lang::locale()=='ar'?@$answer->option->option_text_ar:@$answer->option->option_text}}
                           @elseif($result->question_type=='radio')
                            
                           @php
                               $convertedNumber=number_format((float)$answer->answer, 1, '.', '');
                               $convertedNumber=$convertedNumber>5.0?5.0:$convertedNumber;
                           @endphp
                           {{$convertedNumber}}
                            @else
                           {{$answer->answer}}  
                            <!-- {{$answer->testResult->id}}   -->
                           @endif
                          
                       </td>
                       @endif
                      
                       @endif
                       
                       
                        @endforeach
                        @if(in_array($result->id,$answers->pluck('question_id')->toArray())==false)
                        @for ($i=0;$i< count($users);$i++)
                        @if($users[$i])
                            <td></td>
                            @endif
                        @endfor
                        @endif
                            <td>
                                {{$result->question_ar}}
                            </td>
                        </tr>
                       
                    @endforeach
                    <tr>
                        @foreach ($questions as $result)
                        @php  $curr_user=[]; $counter=0; @endphp
                        
                        <form action="{{route('admin.test_result.correct')}}" method="POST">
                            @csrf
                            @php $count=0;@endphp

                            @foreach ($answers->unique('result_id') as $answer)
                            @if($answer->question_id==$result->id &&  @$answer->testResult->user  ) 
                            @if(!in_array($answer->testResult->user->id, $curr_user))
                        @php $curr_user[]=$answer->testResult->user->id;  @endphp
                        
                        <td>
                            
                            <input name="resultAnswer[{{$answer->id}}]" value="{{$answer->testResult->test_result}}" type="number" step="any">
                        </td>
                        {{-- @endif --}}

                    @endif
                  

                    @endif
                    @endforeach
                        @endforeach
                        <td>{{trans('labels.backend.result.score')}}</td>
                        </tr>
                </tbody>
            </table>
           
            <input type="submit"  class="btn btn-primary" name="" value="{{trans('labels.backend.result.update')}}" id="">
            @else
            {{trans('labels.backend.dashboard.no_data')}}
            @endif
        </form>
        </div>
    </div>
@stop

@push('after-scripts')
<script src="{{asset('plugins/amigo-sorter/js/amigo-sorter.min.js')}}"></script>

    <script>

        $(document).ready(function () {
            var route = '{{route('admin.tests_result.get_data')}}';


            @php
                $show_deleted = (request('show_deleted') == 1) ? 1 : 0;
                $lesson_id = (request('lesson_id') != "") ? request('lesson_id') : 0;
                $form_id = (request('id') != "") ? request('id') : (request('form_id')?request('form_id'):0);
                $form_type = (request('form_type') != "") ? request('form_type') : 'all';
               
                $location_id = (request('location_id') != "") ? request('location_id') : '0';
                $course_id = (request('course_id') != "") ? request('course_id') : '0';

            $route = route('admin.tests_result.get_data',['show_deleted' => $show_deleted,'lesson_id' => $lesson_id,'form_id' => $form_id,'location_id'=>$location_id,'course_id'=>$course_id]);
            @endphp

 
            $(document).on('change', '#lesson_id', function (e) {
                var lesson_id = $(this).val();
                window.location.href = "{{route('admin.tests_result.index')}}" + "?lesson_id=" + lesson_id
            });
            @can('test_delete')
            @if(request('show_deleted') != 1)
            $('.actions').html('<a href="' + '{{ route('admin.tests_result.mass_destroy') }}' + '" class="btn btn-xs btn-danger js-delete-selected" style="margin-top:0.755em;margin-left: 20px;">Delete selected</a>');
            @endif
            @endcan

            $(".js-example-placeholder-single").select2({
                placeholder: "{{trans('labels.backend.lessons.select_course')}}",
            });

            $(document).on('change', '#course_id', function (e) {
                var course_id = $(this).val();
                
                window.location.href = "{{route('admin.tests_result.index')}}" + "?course_id=" + course_id+"&form_id={{$form_id}}"
            });
        });


        function setData(event){
  
            $(document).on('change', '#location_id', function (e) {
                var location_id = $(this).val();
                var form_id='{{$form_id}}';
                var form_type='{{$form_type}}';
                var course_id='{{$course_id}}';


                window.location.href = "{{route('admin.tests_result.index')}}" + "?location_id=" + location_id+"&form_id="+ form_id+"&form_type="+ form_type+"&course_id="+course_id
            });
        


        }

    </script>

@endpush
