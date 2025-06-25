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
    {{ html()->form('POST', route('admin.rateType.store'))->id('rate-create')->class('form-horizontal')->acceptsFiles()->open() }}
    <div class="alert alert-danger d-none" role="alert">
        <button type="button" class="close" data-dismiss="alert" aria-label="Close">
            <span aria-hidden="true">×</span>
        </button>
        <div class="error-list">
        </div>
    </div>
    <div class="card">
        <div class="card-header">
            <h3 class="page-title d-inline">@lang('menus.backend.sidebar.rates.createRateType')</h3>
            <div class="float-right">
                <a href="{{ route('admin.rate.index') }}"
                   class="btn btn-success">@lang('labels.backend.rates.view')</a>

            </div>
        </div>
        <div class="card-body">
        
            <div class="row form-group">
                {{ html()->label(__('labels.backend.rates.fields.rate_type'))->class('col-md-2 form-control-label')->for('rate_type') }}
    
                <div class="col-md-10">
             
              
                    {{ html()->text('rate_type')
                        ->class('form-control')
                        ->required('true')
                        ->placeholder(__('labels.backend.rates.fields.rate_type'))
                    ->autofocus()
                    }}
    
     
                </div><!--col-->
            </div>
    
    
            <div class="row form-group">
                {{ html()->label(__('labels.backend.rates.fields.rate_type_ar'))->class('col-md-2 form-control-label')->for('rate_type_ar') }}
    
                <div class="col-md-10">
             
              
                
                    {{ html()->text('rate_type_ar')
                        ->class('form-control')
                        ->placeholder(__('labels.backend.rates.fields.rate_type_ar'))
                    ->autofocus()
                    }}
    
     
                </div><!--col-->
            </div>
         
            <div class="form-group row justify-content-center">
                <div class="col-4">
                    {{ form_cancel(route('admin.rate.index'), __('buttons.general.cancel')) }}

                    <button class="btn btn-success pull-right" type="submit">{{__('buttons.general.crud.create')}}</button>
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
