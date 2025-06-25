@inject('request', 'Illuminate\Http\Request')
@extends('backend.layouts.app')

@section('title', __('menus.backend.sidebar.courses.invitation') . ' | ' . app_name())

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
    
                        <a href="{{ route('admin.courses_invite', ['course_id' => $course->id]) }}"
                        class="btn btn-success">
                        {{-- @lang('labels.backend.invite.create') --}}
                        <i class="icon-plus" title="@lang('labels.backend.invite.create')"></i>
                    </a>
                        @if(@$currentCourseLocation)
                   <a href="{{ route('admin.courses.index') }}"
                   class="btn btn-primary">&#8592</a>
                  @endif
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
                                    <th>@lang('labels.backend.courses.students.invited_email')</th>
                                   



                                </tr>
                            </thead>
                            <tbody>

                                @csrf
                                @foreach ($invitations as $key => $invitation)
                                    @php
                                        $key += 1;
                                    @endphp


                                    <tr>
                                        <td>
                                            
                                            {{ $key }}


                                        </td>


                                        <td>

                                            @if (Lang::locale() == 'en')
                                                {{ $invitation->user->first_name . ' ' . $invitation->user->last_name }}

                                            @else
                                                {{ $invitation->user->name_ar ?? $invitation->user->first_name . ' ' . $invitation->user->last_name }}

                                            @endif

                                        </td>

                                        <td>
                                            {{$invitation->email}}

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
