@extends('frontend.layouts.app'.config('theme_layout'))
@section('title', trans('labels.frontend.cart.payment_status').' | '.app_name())

@push('after-styles')
    <style>
        input[type="radio"] {
            display: inline-block !important;
        }
        .cartStatus{
            background-color: #cfdce6;
    padding: 26px;
    background-color: #f8fbfd;
    border-radius: 10px;
    color: ##3bcfcb;
    margin-bottom: 27px;
    border: 1px solid;
    
    margin: 18px;
    margin-bottom: 50px;

        }
        .cartStatusHead{
            background-color: #cfdce6;
    padding: 26px;
    background-color: #f8fbfd;
    border-radius: 10px;
    color: ##3bcfcb;
    margin-bottom: 27px;
    margin: 18px;
        }
    </style>
@endpush

@section('content')

    <!-- Start of breadcrumb section
        ============================================= -->
    <section id="breadcrumb" class="breadcrumb-section relative-position backgroud-style cartStatusHead">
        <div class="blakish-overlay"></div>
        <div class="container">
            <div class="page-breadcrumb-content text-center">
                <div class="page-breadcrumb-title">
                    <h2 class="breadcrumb-head black bold">@lang('labels.frontend.cart.your_payment_status')</h2>
                </div>
            </div>
        </div>
    </section>
    <!-- End of breadcrumb section
        ============================================= -->
    <section id="checkout" class="checkout-section cartStatus" >
        <div class="container">
            <div class="section-title mb45 headline text-center">
                @if(Session::has('success'))
                    <h2>  {{session('success')}}</h2>
                    <hr>
                    <h3>@lang('labels.frontend.cart.success_message')</h3>
                    <h4 style="padding-top: 22px;"><a class="btn btn-primary" href="{{route('admin.dashboard')}}">@lang('labels.frontend.cart.see_more_courses')</a></h4>
                @endif
                @if(Session::has('failure'))

                    <button type="button" class="close" data-dismiss="alert">&times;</button>
                    <h2>  {{session('failure')}}</h2>
                    <hr>
                    <h4 style="padding-top: 22px;"><a class="btn btn-primary" href="{{route('cart.index')}}">@lang('labels.frontend.cart.go_back_to_cart')</a></h4>
                @endif
            </div>
        </div>
    </section>
@endsection