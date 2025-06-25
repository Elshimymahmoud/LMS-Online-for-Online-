@extends('backend.layouts.app')
@section('title', __('labels.backend.rates.title').' | '.app_name())

@push('after-styles')
    <style>
        .form-control-label {
            line-height: 35px;
        }
        .remove{
            float: right;
            color: red;
            font-size: 20px;
            cursor: pointer;
        }
        .error{
            color: red;
        }

    </style>

@endpush
@section('content')
    {{ html()->form('PUT', route('admin.forms.update',['id'=>$rate->id,'form_type'=>$rate->form_type]))->id('rate-create')->class('form-horizontal')->acceptsFiles()->open() }}
    <div class="alert alert-danger d-none" role="alert">
        <button type="button" class="close" data-dismiss="alert" aria-label="Close">
            <span aria-hidden="true">×</span>
        </button>
        <div class="error-list">
        </div>
    </div>
    <div class="card">
        <div class="card-header">
            <h3 class="page-title d-inline">@lang('labels.backend.rates.create')</h3>
            <div class="float-right">
                <a href="{{ route('admin.sliders.index') }}"
                   class="btn btn-success">@lang('labels.backend.rates.view')</a>

            </div>
        </div>
        <div class="card-body">

            {{-- rate title --}}
            <div class="row form-group">
                {{ html()->label(__('labels.backend.rates.fields.rate_title'))->class('col-md-2 form-control-label')->for('rate_title') }}

                <div class="col-md-10">
                    {!! Form::text('title', $rate->title, ['class' => 'form-control ']) !!}



                </div><!--col-->
            </div>
            {{--  --}}
            <div class="row form-group">
                {{ html()->label(__('labels.backend.rates.fields.rate_title_ar'))->class('col-md-2 form-control-label')->for('rate_title_ar') }}
            
                <div class="col-md-10">
                    {!! Form::text('title_ar',$rate->title_ar, ['class' => 'form-control ']) !!}
                   
            
                </div><!--col-->
            </div>
            {{--  --}}

            <div class="row">
                <div class="col-12 form-group">
                    
                    {!! Form::checkbox('published') !!}
                    {!! Form::label('published', trans('labels.backend.tests.fields.published'), ['class' => 'control-label font-weight-bold']) !!}
        
                </div>
            </div>
            <div class="form-group row justify-content-center">
                <div class="col-4">
                    {{ form_cancel(route('admin.rate.index'), __('buttons.general.cancel')) }}

                    <button class="btn btn-success pull-right" type="submit">{{__('buttons.general.crud.edit')}}</button>
                </div>
            </div><!--col-->
        </div>
    </div>
    {{ html()->form()->close() }}
@endsection

@push('after-scripts')
<script>
 
    
</script>
@endpush
