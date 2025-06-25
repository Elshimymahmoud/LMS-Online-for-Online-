@extends('frontend.layouts.app'.config('theme_layout'))

@section('title', 'Contact | '.app_name())
@section('meta_description', '')
@section('meta_keywords','')

@push('after-styles')
    <style>
        .my-alert{
            position: absolute;
            z-index: 10;
            left: 0;
            right: 0;
            top: 25%;
            width: 50%;
            margin: auto;
            display: inline-block;
        }
    </style>
@endpush

@section('content')
    @php
        $footer_data = json_decode(config('footer_data'));
    @endphp
    @if(session()->has('alert'))
        <div class="alert alert-light alert-dismissible fade my-alert show">
            <button type="button" class="close" data-dismiss="alert">&times;</button>
            <strong>{{session('alert')}}</strong>
        </div>
    @endif

 
 

    <!-- Start of contact area
        ============================================= -->
    @include('frontend.layouts.partials.contact_area')
    <!-- End of contact area
        ============================================= -->


    <!-- Start of contact area form
        ============================================= -->
        <section id="contact-form" class="contact-form-area_3 contact-page-version">

        
            <div class="container">
                <div class="section-title mb45 headline">
                    <h2 class="title text-color">@lang('labels.frontend.contact.send_us_a_message')</h2>
                </div>
    
                <div class="contact_third_form">
                    <form class="contact_form" action="{{route('contact.send')}}" method="POST" enctype="multipart/form-data">
                        @csrf
                        <div class="row" style="margin-bottom: 20px">
                            <div class="col-md-4">
                                    <input class="form-control" name="name" type="text" placeholder="@lang('labels.frontend.contact.your_name')">
                                    @if($errors->has('name'))
                                        <span class="help-block text-danger">{{$errors->first('name')}}</span>
                                    @endif
                            </div>
                            <div class="col-md-4">
                                    <input class="form-control" name="email" type="email" placeholder="@lang('labels.frontend.contact.your_email')">
                                    @if($errors->has('email'))
                                        <span class="help-block text-danger">{{$errors->first('email')}}</span>
                                    @endif
                            </div>
                            <div class="col-md-4">
                                    <input class="form-control" name="phone" type="number" placeholder="@lang('labels.frontend.contact.phone_number')">
                                    @if($errors->has('phone'))
                                        <span class="help-block text-danger">{{$errors->first('phone')}}</span>
                                    @endif
                            </div>
                        </div>
                        <textarea class="form-control" style="height: 150px" name="message" placeholder="@lang('labels.frontend.contact.message')"></textarea>
                        @if($errors->has('message'))
                            <span class="help-block text-danger">{{$errors->first('message')}}</span>
                        @endif
                        <div class="nws-button text-center  gradient-bg text-uppercase mt-3">
                            <button class="more" type="submit" value="Submit">@lang('labels.frontend.contact.send_email') </button>
                        </div>
                    </form>
                </div>
            </div>
        </section>
        <!-- End of contact area form
            ============================================= -->

            
            
@endsection    