@inject('request', 'Illuminate\Http\Request')
@extends('backend.layouts.app')

@section('title', __('labels.backend.blogs.title') . ' | ' . app_name())

@section('content')
    <style>
        .datetime {
            width: 100%;

            padding: 5px;
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
    
    <nav aria-label="breadcrumb" class="headerr ">
    <ol class="breadcrumb">
      <li class="breadcrumb-item"><a href="{{ route('admin.courses.index') }}"><i class="fa fa-home" ></i></a></li>
      <li class="breadcrumb-item">   {{session('locale')=='ar'?$course->type->name_ar:$course->type->name}} </li>
      <li class="breadcrumb-item" style="color:red">{{session('locale')=='ar'?$course->title_ar:$course->title}}</li>

        
    </ol>
  </nav>
    <div class="card"style="margin-top: 2%;">
        <div class="card-header">
            <h3 class="page-title d-inline">@lang('labels.backend.courses.students.title')</h3>
            @can('blog_create')
                <div class="float-right">
                    <a href="{{ route('admin.courses.index') }}"
                    class="btn btn-primary">&#8592</a>
                </div>
            @endcan
        </div>
        <div class="card-body">
            <div class="row">
                <div class="col-12">
                    <div class="table-responsive">


                        <table id="myTable" class="table table-border table-hover">
                            <thead>
                                <tr>
                                    <th>@lang('labels.general.sr_no')</th>
                                    <th>@lang('labels.backend.courses.students.student_name')</th>
                                    
                                <th>&nbsp; @lang('strings.backend.general.actions')</th>
                        
                                </tr>
                            </thead>
                            <tbody>

                                @csrf
                                 
                                @foreach ($course->studentsCourseLocation(request('course_location_id'))->get() as $key => $student)
                                

                                    @php
                                        $key += 1;
                                    @endphp
                                    <tr>
                                        <td>
                                            {{ $key }}
                                        </td>

                                        <td>
                                            @if (Lang::locale() == 'en')
                                                {{ $student->first_name . ' ' . $student->last_name }}
                                            @else
                                                {{ $student->name_ar ?? $student->first_name . ' ' . $student->last_name }}
                                            @endif
                                        </td>

                             
                                        <td>
                                            <div class="btn-group btn-group-sm" role="group">
                                                <!-- <button id="userActions" type="button" class="btn btn-secondary dropdown-toggle"
                                                    data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                                    {{ __('labels.general.more') }}
                                                </button> -->
                                                <a id="userActions" type="button" class="btn btn-xs bg-warning mb-1 p-2 dropdown-toggle" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                                    <i class="fa fa-plus-square" aria-hidden="true"></i>
                                                </a>
                                                <div class="dropdown-menu drop" id="moreCourse" style=" max-height:200px;
                                                        overflow:scroll; " aria-labelledby="userActions">
                                                    <a tabindex="1"
                                                    href="{{ route('admin.certificates.create_cert', ['course_id' => $course->id, 'student_id' => $student->id]) }}"
                                                        class="dropdown-item">{{ __('labels.backend.courses.students.certificate') }}</a>
                                                   
                                                        {{-- <a tabindex="1"
                                                        href="{{ route('admin.courses.evaluate_student', ['course_id' => $course->id, 'student_id' => $student->id,'course_location_id' => request('course_location_id')]) }}"
                                                            class="dropdown-item">{{ __('labels.backend.courses.students.evaluate') }}</a>
                                                        --}}
                                            <a tabindex="1" href="{{route('admin.forms2.indexStudent', ['course_id' => $course->id, 'form_type' => 'rate','course_location_id'=>request('course_location_id'),'student_id' => $student->id])}}" class="dropdown-item"> {{__('menus.backend.sidebar.rates.title')}}</a>
                                            <a tabindex="1" href="{{route('admin.forms2.indexStudent', ['course_id' => $course->id, 'form_type' => 'test','course_location_id'=>request('course_location_id'),'student_id' => $student->id])}}" class="dropdown-item"> {{__('menus.backend.sidebar.tests.title')}}</a>
                                            <a tabindex="1" href="{{route('admin.Attendance.index', ['course' => $course->id,'course_location_id'=>request('course_location_id'),'student_id' => $student->id])}}" class="dropdown-item">{{ __('menus.backend.sidebar.attendance.title')}}</a> 
                                                  
    
                                                    <!-- ** -->
    
    
    
                                            </div>
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
@endpush
