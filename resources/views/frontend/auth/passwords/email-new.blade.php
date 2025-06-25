@extends('frontend.layouts.app'.config('theme_layout'))

@section('title', trans('labels.frontend.home.title') . ' | ' . app_name())
@section('meta_description', '')
@section('meta_keywords', '')


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

@section('title', app_name() . ' | ' . __('labels.frontend.passwords.reset_password_box_title'))

@section('content')
<section class="row the-slider" id="slider">
    <div style="background-size: cover;height:fit-content;background-color: #f1f3f3;padding-bottom: 20px;">
        <div class="container">
            <div class="row benefit-notes">
                <div class="col-sm-12 col-md-12   wow fadeInUp2  register-parent mt-0">

                    <!--========== /.navbar-collapse ==========-->
                </div>
                <!--========== /.container-fluid ==========-->
                <div class="row">

                    <div class="container">

                     

                        <!--==========blog details  ==========-->
                        <div class="col-sm-12 col-md-3   wow fadeInUp ptb-50  mt-0">
                        </div>
                        <div class="col-sm-12 col-md-6   wow fadeInUp ptb-50  mt-0">
                            <div class="page-breadcrumb-title">
                                <h2 class="breadcrumb-head title black bold">{{__('labels.frontend.passwords.reset_password_box_title')}}</h2>
                            </div>
                            <div class="card border-0">

                                <div class="card-body">
                                    @if ($errors->has('error'))
                                    <div class="alert alert-dismissable alert-danger show">
                                        <button type="button" class="close" data-dismiss="alert">&times;</button>
                                        {{ $errors->first('error') }}
                                    </div>
                                @endif
                                    @if(session('status'))
                                        <div class="alert alert-success">
                                            {{ session('status') }}
                                        </div>
                                    @endif
            
                                    {{ html()->form('POST', route('frontend.auth.password.email.post'))->open() }}
                                    <div class="row">
                                        <div class="col">
                                            <div class="form-group">
                                                {{ html()->email('email')
                                                    ->class('form-control')
                                                    ->placeholder(__('validation.attributes.frontend.email'))
                                                    ->attribute('maxlength', 191)
                                                    ->required()
                                                    ->value($errors->has('error')?'':request('email'))
                                                    ->autofocus() }}
                                            </div><!--form-group-->
                                        </div><!--col-->
                                    </div><!--row-->
            
                                    <div class="row">
                                        <div class="col">
                                            <div class="form-group mb-0 clearfix">
                                                <div class="text-center  text-capitalize">
                                                    <button type="submit" class="submit nws-button btn-info btn "
                                                            value="Submit">{{__('labels.frontend.passwords.send_password_reset_link_button')}}</button>
                                                </div>
                                            </div><!--form-group-->
                                        </div><!--col-->
                                    </div><!--row-->
                                    {{ html()->form()->close() }}
                                </div><!-- card-body -->
                            </div><!-- card -->
                        </div>
                    </div>
                </div>
{{--  --}}

            </div>
        </div>
    </div>
</section>

@endsection

@push('after-scripts')

@endpush