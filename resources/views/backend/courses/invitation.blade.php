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
    <li class="breadcrumb-item">   {{$course->type->name_ar}} </li>
    <li class="breadcrumb-item active" aria-current="page">{{$course->title_ar}}</li>
  </ol>
</nav>
    <div class="card"style="margin-top: 2%;">
        <div class="card-header">
            <h3 class="page-title d-inline">@lang('labels.backend.courses.students.title')</h3>
           

                <div class="float-right">
                    {{-- <a href="{{ route('admin.courses.show', ['course_id' => $course->id]) }}"
                        class="btn btn-success">@lang('labels.backend.courses.show')</a> --}}
                        <a href="{{ route('admin.courses.get_invitations', ['course_id' => request('course_id')]) }}"
                        class="btn btn-primary">&#8592</a>
                </div>
               

        </div>
        <div class="card-body">
            <div class="row">
                <div class="col-12">
                    <div class="table-responsive">
                        
                    <form style="
                             padding: 30px;
                             border-radius: 10px;margin: 0px 0px;" action="{{ route('courses.sendInvitation') }}" id="subscribeform"
                                class="row newsletter-form" method="post">
                                <div class="row newsletter-form" id="EmailsDiv" style="margin-right: 20%;width: 100%;">

                                    @csrf
                                    <div class="input-group"style="width: 66%;">
                                        <input type="email" required style=" border-radius: 10px;
                                margin-bottom: 10px;width: 62% !important" class="form-control newsletter-email InviteEmail" name="emails[]"
                                            placeholder="@lang('labels.frontend.home.email')" />

                                    </div>
                                    <span style="
                            margin-right: 20%;
                            font-size: 19px;
                            color: #4f198d;">
                                    <a onclick="addNewEmail()" style="cursor: pointer">
                                        <i style="padding: 10px;
                            border: 1px solid;
                            color: #4f198d;
                            border-radius: 5px;" class="fa fa-plus"></i>
                                    </a>
                                </span>
                                    <input type="hidden" name="course_id" value="{{ $course->id }}">
                                {{--   <!-- <input type="hidden" name="user_id" value="{{ $user->id }}"> -->--}} 


                                    {{--  --}}
                                </div>
                               

                                {{-- <p style="color: white" id="subscribe_msg"></p> --}}
                                {{--  --}}


                                <button class="btn btn-primary" style="padding: 10px;    margin-right: 68%;;
                                
                                font-weight: bold;" type="submit" id="js-subscribe-btn">@lang('labels.frontend.home.send')</button>

                            </form>
                       
                    

                     

                    </div>
                </div>
            </div>
        </div>
    </div>

@endsection


@push('after-scripts')
        <!-- custom js -->
       
<script src="{{ asset('iv') }}/assets/rating/js/star-rating.js"></script>
<script src="{{ asset('iv') }}/js/toggleSideBar.js"></script>

<script>
    $(document).on('change', 'input[name="stars"]', function() {
        $('#rating').val($(this).val());

    })
    $(document).ready(function() {
        $('.caption').css({
            'display': 'none'
        })

        $('.course-sidebar').on('click', 'a.list-group-item', function() {
            $(".course-sidebar .list-group-item").removeClass("active");
            $(this).addClass("active");
        });

    })
    
   
</script>
<script>
   
    $(document).ready(function() {
        $('.caption').css({
            'display': 'none'
        })

        $('.course-sidebar').on('click', 'a.list-group-item', function() {
            $(".course-sidebar .list-group-item").removeClass("active");
            $(this).addClass("active");
        });

    })
    function addNewEmail(){
        
        $EmailsDiv=$('#EmailsDiv');
        $newemail='<div class="input-group"style="width: 66%;">'+
                           ' <input  type="email" style=" border-radius: 10px;margin-bottom: 10px;" class="form-control InviteEmail newsletter-email" name="emails[]"'+
                                'placeholder="@lang('labels.frontend.home.email')" />'
                           
                            +'</div>';
        $EmailsDiv.append($newemail)
        
    }
    $("#success-alert").fadeTo(2000, 500).slideUp(500, function(){
    $("#success-alert").slideUp(500);
    })
</script>

@endpush

