@extends('backend.layouts.app')
@section('title', __('labels.backend.orders.title').' | '.app_name())

@section('content')

    <div class="card">

        <div class="card-header">
            <h3 class="page-title mb-0 float-left">@lang('labels.backend.orders.title')</h3>
        </div>
        <div class="card-body">
            <div class="row">
                <div class="col-12">
                    <table class="table table-bordered table-striped">
                        <tr>
                            <th>@lang('labels.backend.orders.fields.user_name')</th>
                            <td>
                                <b><a href="{{route('admin.auth.user.show', $user->id)}}">{{ (app()->getLocale() == 'ar') ? $user->full_name_ar : $user->full_name }}</a></b>
                            </td>
                        </tr>
                        <tr>
                            <th>@lang('labels.backend.orders.fields.user_email')</th>
                            <td>
                                <b>{{$user->email}}</b>
                            </td>
                        </tr>
                        <tr>
                            <th>@lang('labels.backend.orders.fields.items')</th>
                            <td>
                                @foreach($items as $key => $item)
                                    @php $key++ @endphp
                                    {{$key.'. '.((app()->getLocale() == 'ar') ? $item->course->title_ar.' ( '.$item->group->title_ar.' )' :  $item->course->title.' ( '.$item->group->title.' ) ')}}
                                    <br>
                                @endforeach
                            </td>
                        </tr>
                        <tr>
  
                            <th>@lang('labels.backend.orders.fields.items_payed')</th>
                            <td>
                                @if($courseItems->count() > 0)
                                    @foreach($courseItems as $key => $item)
                                        @php $key++ @endphp
                                        {{$key.'. '.((app()->getLocale() == 'ar') ? $item->course->title_ar.' ( '.$item->group->title_ar.' )' :  $item->course->title.' ( '.$item->group->title.' ) ')}}
                                        <br>
                                    @endforeach
                                @else
                                    <span class="badge badge-danger">@lang('labels.backend.orders.fields.no_items_is_payed')</span>
                                @endif
                            </td>
                        </tr>

                    </table>
                </div>
            </div><!-- Nav tabs -->
            @if(Auth::user()->isAdmin())
            <a href="{{ route('admin.checkout.index') }}" class="btn btn-default border">@lang('strings.backend.general.app_back_to_list')</a>
            @else
            <a href="{{ route('admin.payments') }}" class="btn btn-default border">@lang('strings.backend.general.app_back_to_list')</a>
            @endif
        </div>
    </div>
@stop