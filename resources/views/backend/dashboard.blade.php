@extends('backend.layouts.app')

@section('title', __('strings.backend.dashboard.title').' | '.app_name())

@push('after-styles')
    <style>
        .trend-badge-2 {
            top: -10px;
            left: -52px;
            color: #fff;
            font-size: 12px;
            font-weight: 700;
            position: absolute;
            padding: 40px 40px 12px;
            -webkit-transform: rotate(-45deg);
            transform: rotate(-45deg);
            background-color: #ff5a00;
        }

        .progress {
            background-color: #b6b9bb;
            height: 2em;
            font-weight: bold;
            font-size: 0.8rem;
            text-align: center;
        }

        .best-course-pic {
            background-color: #333333;
            background-position: center;
            background-size: cover;
            height: 150px;
            width: 100%;
            background-repeat: no-repeat;
        }

.management{
    background: #4f198d;
    padding: 5px;
    border-radius: 5px;
    color: #fff;
    margin: 10px 0;
    display:inline-block;
}

.management:hover{
    color: #fff;
}
.k-letter{
    background: #4f198d;
    color: #fff;
}
.k-letter:hover{
    background: #4f198d;
    color: #fff;
}
    </style>
@endpush

@section('content')

    <div class="row">
        <div class="col">
            <div class="card">
                <div class="card-header">
                    <strong>@lang('strings.backend.dashboard.welcome') {{ app()->getLocale() == 'ar' ? $logged_in_user->full_name_ar : $logged_in_user->full_name }}!</strong>
                </div><!--card-header-->
                <div class="card-body">
                    <div class="row">
                        @if(auth()->user()->hasRole('student'))


                            @if(count($pending_orders) > 0)
                                <div class="col-12">
                                    <h4>@lang('labels.backend.dashboard.pending_orders')</h4>
                                </div>
                                <div class="col-12 text-center">

                                    <table class="table table table-bordered table-striped">
                                        <thead>
                                        <tr>

                                            <th>@lang('labels.general.sr_no')</th>
                                            <th>@lang('labels.backend.orders.fields.reference_no')</th>
                                            <th>@lang('labels.backend.orders.fields.items')</th>
                                            <th>@lang('labels.backend.orders.fields.amount')
                                                {{-- <small>(in {{$appCurrency['symbol']}})</small> --}}
                                            </th>
                                            <th>@lang('labels.backend.orders.fields.payment_status.title')</th>
                                            <th>@lang('labels.backend.orders.fields.date')</th>
                                        </tr>
                                        </thead>
                                        <tbody>
                                        @foreach($pending_orders as $key=>$item)

                                            @php $key++ @endphp
                                            <tr>
                                                <td>
                                                    {{$key}}
                                                </td>
                                                <td>
                                                    {{$item->reference_no}}
                                                </td>
                                                <td>
                                                    @foreach($item->items as $key=>$subitem)
                                                        @php $key++ @endphp
                                                        @if($subitem->item != null)
                                                            @if(Lang::locale()=='en'){{$key.'. '.$subitem->item->title}} @else {{$key.'. '.$subitem->item->title_ar?$subitem->item->title_ar:$subitem->item->title}} @endif <br>
                                                        @endif
                                                    @endforeach
                                                </td>
                                                <td>

                                                    {{$item->amount}}

                                                </td>
                                                <td>
                                                    @if($item->status == 0)
                                                        @lang('labels.backend.dashboard.pending')
                                                    @elseif($item->status == 1)
                                                        @lang('labels.backend.dashboard.success')
                                                    @elseif($item->status == 2)
                                                        @lang('labels.backend.dashboard.failed')
                                                    @endif
                                                </td>
                                                <td>
                                                    {{$item->created_at->format('d-m-Y h:i:s')}}
                                                </td>
                                            </tr>
                                        @endforeach
                                        </tbody>
                                    </table>
                                </div>

                            @endif

                            <div class="col-12">
                                <h4>@lang('labels.backend.dashboard.my_courses')</h4>
                            </div>


                            @if(count($purchased_groups) > 0)

                                @foreach($purchased_groups as $item)
                                @php

                                    $course_id = $item->courses->id;


                                @endphp

                            {{-- @foreach($$purchasedOrderItems as $orderItem)

                          @endforeach --}}

                                    <div class="col-md-3">
                                        <div class="best-course-pic-text position-relative border" style="max-height:320px;min-height:320px">
                                            <div class="best-course-pic position-relative overflow-hidden"
                                                 @if($item->courses->course_image != "") style="background-image: url({{asset('storage/uploads/'.$item->courses->course_image)}})" @endif>

                                                @if($item->courses->trending == 1)
                                                    <div class="trend-badge-2 text-center text-uppercase">
                                                        <i class="fas fa-bolt"></i>
                                                        <span>@lang('labels.backend.dashboard.trending') </span>
                                                    </div>
                                                @endif

                                                <div class="course-rate ul-li">
                                                    <ul>
                                                        @for($i=1; $i<=(int)$item->courses->rating; $i++)
                                                            <li><i class="fas fa-star"></i></li>
                                                        @endfor
                                                    </ul>
                                                </div>
                                            </div>
                                            <div class="best-course-text d-inline-block w-100 p-2" >
                                                <div class="course-title mb20 headline relative-position">
                                                    <h5>

                                                        {{-- <a href="{{ route('courses.show', [$item->slug]) }}">@if(Lang::locale()=='en'){{$item->title}}@else {{$item->title_ar?$item->title_ar:$item->title}} @endif</a> --}}

                                                        <a href="{{route('courses.details',
                                                        ['course'=>$item->courses->slug,'group'=>$item->id])
                                                        }}">
                                                        @if(Lang::locale()=='en'){{$item->courses->title}}@else {{$item->courses->title_ar?$item->courses->title_ar:$item->courses->title}} @endif
                                                        </a>

                                                    </h5>
                                                </div>
                                                <div class="course-meta d-inline-block w-100 ">
                                                    <div class="d-inline-block w-100 0 mt-2">
                                                     <span class="course-category float-left">
                                                <a href="{{route('courses.category',['category'=>$item->courses->category->slug])}}"
                                                   class=" text-decoration-none px-2 p-1 management">@if(Lang::locale()=='en'){{$item->courses->category->name}} @else {{$item->courses->category->name_ar?$item->courses->category->name_ar:$item->courses->category->name}} @endif</a>
                                            </span>
                                                        <span class="course-author float-right">
                                                 {{ $item->students()->count() }}
                                                            @lang('labels.backend.dashboard.students')
                                            </span>
                                                    </div>

                                                    @if($item->courses->progress($item->id) == 100)
                                                        @if(!$item->courses->isUserCertified())
                                                            <form method="post"
                                                                  action="{{route('admin.certificates.generate')}}">
                                                                @csrf
                                                                <input type="hidden" value="{{$item->courses->id}}"
                                                                       name="course_id">
                                                                <input type="hidden" value="{{$item->id }}"
                                                                       name="group_id">
{{--                                                                       <input type="hidden" value="{{ $course_location_id }}"--}}
{{--                                                                       name="course_location_id">--}}
                                                                <button class="btn btn-block text-white mb-3 text-uppercase font-weight-bold k-letter"
                                                                        id="finish">@lang('labels.frontend.course.finish_course')</button>
                                                            </form>
                                                        @else
                                                            <div class="alert alert-success px-1 text-center mb-0">
                                                                @lang('labels.frontend.course.certified')
                                                            </div>
                                                        @endif

                                                    @else

                                                        <div class="progress my-2">
                                                            <div class="progress-bar"
                                                                 style="width:{{$item->courses->progress($item->id) }}%">
                                                                @lang('labels.backend.dashboard.completed')
                                                                {{ $item->courses->progress($item->id)  }} %

                                                            </div>
                                                        </div>
                                                    @endif
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                @endforeach
                            @else
                                <div class="col-12 text-center">
                                    <h4 class="text-center">@lang('labels.backend.dashboard.no_data')</h4>
                                    <a class="btn btn-primary"
                                       href="{{route('courses.all')}}">@lang('labels.backend.dashboard.buy_course_now')
                                        <i class="fa fa-arrow-right"></i></a>
                                </div>
                            @endif
                            @if(count($purchased_bundles) > 0)

                                <div class="col-12 mt-5">
                                    <h4>@lang('labels.backend.dashboard.my_course_bundles')</h4>
                                </div>
                                @foreach($purchased_bundles as $key=>$bundle)
                                    @php $key++ @endphp
                                    <div class="col-12"><h5><a
                                                    href="{{route('bundles.show',['slug'=>$bundle->slug ])}}">
                                                {{$key.'. '.$bundle->title}}</a></h5>
                                    </div>
                                    @if(count($bundle->courses) > 0)
                                        @foreach($bundle->courses as $item)
                                            <div class="col-md-3 mb-5">
                                                <div class="best-course-pic-text position-relative border">
                                                    <div class="best-course-pic position-relative overflow-hidden"
                                                         @if($item->course_image != "") style="background-image: url({{asset('storage/uploads/'.$item->course_image)}})" @endif>

                                                        @if($item->trending == 1)
                                                            <div class="trend-badge-2 text-center text-uppercase">
                                                                <i class="fas fa-bolt"></i>
                                                                <span>@lang('labels.backend.dashboard.trending') </span>
                                                            </div>
                                                        @endif

                                                        <div class="course-rate ul-li">
                                                            <ul>
                                                                @for($i=1; $i<=(int)$item->rating; $i++)
                                                                    <li><i class="fas fa-star"></i></li>
                                                                @endfor
                                                            </ul>
                                                        </div>
                                                    </div>
                                                    @php
                                                    $course_location_id=$item->studentCourseLocationById(auth()->user()->id)->first()->pivot->course_location_id;

                                                @endphp
                                                    <div class="best-course-text d-inline-block w-100 p-2">
                                                        <div class="course-title mb20 headline relative-position">
                                                            <h5>
                                                                {{-- <a href="{{ route('courses.show', [$item->slug]) }}">@if(Lang::locale()=='en'){{$item->title}}@else {{$item->title_ar?$item->title_ar:$item->title}}@endif</a> --}}
                                                                <a href="{{route('courses.details',['course'=>$item->slug,'course_location_id'=>$course_location_id])}}">@if(Lang::locale()=='en'){{$item->title}}@else {{$item->title_ar?$item->title_ar:$item->title}}@endif</a>


                                                            </h5>
                                                        </div>
                                                        <div class="course-meta d-inline-block w-100 ">
                                                            <div class="d-inline-block w-100 0 mt-2">
                                                     <span class="course-category float-left">
                                                <a href="{{route('courses.category',['category'=>$item->category->slug])}}"
                                                   class=" text-decoration-none px-2 p-1">@if(Lang::locale()=='en'){{$item->category->name}}@else {{$item->category->name_ar?$item->category->name_ar:$item->category->name}} @endif</a>
                                            </span>
                                                                <span class="course-author float-right">
                                                 {{ $item->students()->count() }}
                                                                    @lang('labels.backend.dashboard.students')
                                            </span>
                                                            </div>

                                                            <div class="progress my-2">
                                                                <div class="progress-bar"
                                                                     style="width:{{$item->progress() }}%">{{ $item->progress()  }}
                                                                    %
                                                                    @lang('labels.backend.dashboard.completed')
                                                                </div>
                                                            </div>
                                                            @if($item->progress() == 100)
                                                                @if(!$item->isUserCertified())
                                                                    <form method="post"
                                                                          action="{{route('admin.certificates.generate')}}">
                                                                        @csrf
                                                                        <input type="hidden" value="{{$item->id}}"
                                                                               name="course_id">
                                                                        <input type="hidden" value="{{$item->id}}"
                                                                               name="course_id">
                                                                               <input type="hidden" value="{{ $course_location_id }}"
                                                                               name="course_location_id">
                                                                        <button class="btn  btn-block text-white mb-3 text-uppercase font-weight-bold"
                                                                                id="finish">@lang('labels.frontend.course.finish_course')</button>
                                                                    </form>
                                                                @else
                                                                    <div class="alert alert-success px-1 text-center mb-0">
                                                                        @lang('labels.frontend.course.certified')
                                                                    </div>
                                                                @endif
                                                            @endif
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        @endforeach
                                    @endif
                                @endforeach
                    </div>
                    @endif
                    @elseif(auth()->user()->hasRole('teacher'))
                        <div class="col-12">
                            <div class="row">
                                <div class="col-md-3 col-12 border-right">
                                    <div class="row">
                                        <div class="col-12">
                                            <div class="card text-white bg-primary text-center">
                                                <div class="card-body">
                                                    <h2 class="">{{count(auth()->user()->courses) + count(auth()->user()->bundles)}}</h2>
                                                    <h5>@lang('labels.backend.dashboard.your_courses_and_bundles')</h5>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="col-12">
                                            <div class="card text-white bg-success text-center">
                                                <div class="card-body">
                                                    <h2 class="">{{$students_count}}</h2>
                                                    <h5>@lang('labels.backend.dashboard.students_enrolled')</h5>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-md-5 col-12 border-right">
                                    <div class="d-inline-block form-group w-100">
                                        <h4 class="mb-0">@lang('labels.backend.dashboard.recent_reviews') <a
                                                    class="btn btn-primary float-right"
                                                    href="{{route('admin.reviews.index')}}">@lang('labels.backend.dashboard.view_all')</a>
                                        </h4>

                                    </div>
                                    <table class="table table-responsive-sm table-striped">
                                        <thead>
                                        <tr>
                                            <td>@lang('labels.backend.dashboard.course')</td>
                                            <td>@lang('labels.backend.dashboard.review')</td>
                                            <td>@lang('labels.backend.dashboard.time')</td>
                                        </tr>
                                        </thead>
                                        <tbody>
                                        @if(count($recent_reviews) > 0)
                                            @foreach($recent_reviews as $item)
                                                <tr>
                                                    <td>
                                                        <a target="_blank"
                                                           href="{{route('courses.show',[$item->reviewable->slug])}}">{{$item->reviewable->title}}</a>
                                                    </td>
                                                    <td>{{$item->content}}</td>
                                                    <td>{{$item->created_at->diffforhumans()}}</td>
                                                </tr>
                                            @endforeach
                                        @else
                                            <tr>
                                                <td colspan="3">@lang('labels.backend.dashboard.no_data')</td>
                                            </tr>
                                        @endif
                                        </tbody>
                                    </table>
                                </div>
                                <div class="col-md-4 col-12">
                                    <div class="d-inline-block form-group w-100">
                                        <h4 class="mb-0">@lang('labels.backend.dashboard.recent_messages') <a
                                                    class="btn btn-primary float-right"
                                                    href="{{route('admin.messages')}}">@lang('labels.backend.dashboard.view_all')</a>
                                        </h4>
                                    </div>


                                    <table class="table table-responsive-sm table-striped">
                                        <thead>
                                        <tr>
                                            <td>@lang('labels.backend.dashboard.message_by')</td>
                                            <td>@lang('labels.backend.dashboard.message')</td>
                                            <td>@lang('labels.backend.dashboard.time')</td>
                                        </tr>
                                        </thead>
                                        <tbody>
                                        @if(count($threads) > 0)
                                            @foreach($threads as $item)

                                                <tr>
                                                    <td>
                                                        <a target="_blank"
                                                           href="{{asset('/user/messages/?thread='.$item->id)}}">{{$item->title}}</a>
                                                    </td>
                                                    <td>{{$item->lastMessage->body}}</td>
                                                    <td>{{$item->lastMessage->created_at->diffForHumans() }}</td>
                                                </tr>
                                            @endforeach

                                        @else
                                            <tr>
                                                <td colspan="3">@lang('labels.backend.dashboard.no_data')</td>
                                            </tr>
                                        @endif
                                        </tbody>
                                    </table>
                                </div>
                            </div>
                        </div>

                    @elseif(auth()->user()->hasRole('administrator'))

                        <div class="col-md-3 col-12">
                            <div class="card text-white bg-dark text-center py-3">
                                <div class="card-body">
                                    <h1 class="">{{$courses_count}}</h1>
                                    <h5>@lang('labels.backend.dashboard.course_and_bundles')</h5>
                                </div>
                            </div>
                        </div>
                        <div class="col-md-3 col-12">
                            <div class="card text-white bg-dark text-center py-3">
                                <div class="card-body">
                                    <h1 class="">{{$group_count}}</h1>
                                    <h3>@lang('labels.backend.group.title')</h3>
                                </div>
                            </div>
                        </div>
                        <div class="col-md-3 col-12">
                            <div class="card text-white  text-dark text-center py-3" style="background:#4f198d">
                                <div class="card-body">
                                    <h1 class="">{{$students_count}}</h1>
                                    <h3>@lang('labels.backend.dashboard.students')</h3>
                                </div>
                            </div>
                        </div>
                        <div class="col-md-3 col-12">
                            <div class="card text-white bg-primary text-center py-3">
                                <div class="card-body">
                                    <h1 class="">{{$teachers_count}}</h1>
                                    <h3>@lang('labels.backend.dashboard.teachers')</h3>
                                </div>
                            </div>
                        </div>
                        <div class="col-md-6 col-12 border-right">
                            <div class="d-inline-block form-group w-100">
                                <h4 class="mb-0">@lang('labels.backend.dashboard.recent_orders') <a
                                            class="btn btn-primary float-right"
                                            href="{{route('admin.orders.index')}}">@lang('labels.backend.dashboard.view_all')</a>
                                </h4>

                            </div>
                            <table class="table table-responsive-sm table-striped">
                                <thead>
                                <tr>
                                    <td>@lang('labels.backend.dashboard.name')</td>
                                    <td>@lang('labels.backend.dashboard.amount')</td>
                                    <td>@lang('labels.backend.dashboard.time')</td>
                                    <td>@lang('labels.backend.dashboard.view')</td>
                                </tr>
                                </thead>
                                <tbody>

                                @if(count($recent_orders) > 0)
                                    @foreach($recent_orders as $item)

                                    @if(isset($item->user->full_name)==false)

                                    @endif
                                        <tr>
                                            <td>
                                                {{ app()->getLocale() == 'ar' ? $item->user->full_name_ar :
                                                $item->user->full_name}}
                                            </td>
                                            <td>{{$item->amount}}</td>
                                            <td>{{$item->created_at->diffforhumans()}}</td>
                                            <td><a class="btn btn-sm btn-primary"
                                                   href="{{route('admin.orders.show', $item->id)}}" target="_blank"><i
                                                            class="fa fa-arrow-right"></i></a></td>
                                        </tr>
                                    @endforeach
                                @else
                                    <tr>
                                        <td colspan="4">@lang('labels.backend.dashboard.no_data')</td>
                                    </tr>
                                @endif
                                </tbody>
                            </table>
                        </div>
                        <div class="col-sm-6 col-12">
                            <div class="d-inline-block form-group w-100">
                                <h4 class="mb-0">@lang('labels.backend.dashboard.recent_contact_requests') <a
                                            class="btn btn-primary float-right"
                                            href="{{route('admin.contact-requests.index')}}">@lang('labels.backend.dashboard.view_all')</a>
                                </h4>

                            </div>
                            <table class="table table-responsive table-striped">
                                <thead>
                                <tr>
                                    <td>@lang('labels.backend.dashboard.name')</td>
                                    <td>@lang('labels.backend.dashboard.email')</td>
                                    <td>@lang('labels.backend.dashboard.message')</td>
                                    <td>@lang('labels.backend.dashboard.time')</td>
                                </tr>
                                </thead>
                                <tbody>
                                @if(count($recent_contacts) > 0)
                                    @foreach($recent_contacts as $item)
                                        <tr>
                                            <td>
                                                {{$item->name}}
                                            </td>
                                            <td>{{$item->email}}</td>
                                            <td>{{$item->message}}</td>
                                            <td>{{$item->created_at->diffforhumans()}}</td>
                                        </tr>
                                    @endforeach
                                @else
                                    <tr>
                                        <td colspan="4">@lang('labels.backend.dashboard.no_data')</td>

                                    </tr>
                                @endif
                                </tbody>
                            </table>
                        </div>

                    @else
                        <div class="col-12">
                            <h1>@lang('labels.backend.dashboard.title')</h1>
                        </div>
                    @endif
                </div>
            </div><!--card-body-->
        </div><!--card-->
    </div><!--col-->
@endsection
