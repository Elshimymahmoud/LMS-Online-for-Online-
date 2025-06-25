@extends('frontend.layouts.app'.config('theme_layout'))

@section('title', app_name() . ' | ' . __('labels.frontend.auth.activation_code'))

@push('after-styles')
<style>
    .link-terms{
    border: none !important;
  }
  .title{
    font-size: 22px !important;
    color: ##3bcfcb;
    text-align: center;
    padding: 10px;
  }
  .submit{
    background-color: ##3bcfcb;
    padding: 10px;
    font-weight: bold;
  }
</style>
@endpush
@section('content')

    <section id="breadcrumb" class="breadcrumb-section relative-position backgroud-style">
        <div class="blakish-overlay"></div>
        <div class="container">
            <div class="page-breadcrumb-content text-center">
                <div class="page-breadcrumb-title">
                    <h2 class="breadcrumb-head black bold">{{__('labels.frontend.auth.activation_code')}}</h2>
                </div>
            </div>
        </div>
    </section>
    <section id="about-page" class="about-page-section pb-0">
        <div class="row justify-content-center align-items-center" style="overflow: hidden;max-width: 100%;">
            <div class="col col-sm-6 col-sm-offset-3 align-self-center">
                <div class="card border-0">
                    <div class="card-body">
                        @if ($errors->any())
                            <div class="alert alert-danger">
                                <ul class="list-inline list-style-none">
                                    @foreach ($errors->all() as $error)
                                        <li>{{ $error }}</li>
                                    @endforeach
                                </ul>
                            </div>
                        @endif

                        {{ html()->form('POST', route('frontend.auth.account.activate.conform', ['uuid' => $user->uuid]))->class
                        ('form-horizontal')->open() }}
<br>
<br>


                        <div class="row">
                            <div class="col">
                                <div class="form-group">
                                    {{ html()->label(__('labels.frontend.auth.activation_code'))->for('activation_code') }}

                                    {{ html()->text('activation_code')
                                        ->class('form-control')
                                        ->placeholder(__('labels.frontend.auth.enter_activation_code'))
                                        ->required() }}
                                </div><!--form-group-->
                            </div><!--col-->
                        </div><!--row-->


                        <div class="row">
                            <div class="col">
                                <div class="form-group mb-0 clearfix">
                                    <button class="submit nws-button btn-info btn " type="submit">{{__('labels.frontend.auth.check_activation_code')}}</button>
                                </div><!--form-group-->
                            </div><!--col-->
                        </div><!--row-->
                        {{ html()->form()->close() }}
                            <br>
                            <br>
                    </div><!-- card-body -->
                </div><!-- card -->
            </div><!-- col-6 -->
        </div><!-- row -->
    </section>
@endsection
