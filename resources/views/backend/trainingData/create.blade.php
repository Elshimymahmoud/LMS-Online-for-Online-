@extends('backend.layouts.app')
@section('title', __('labels.backend.trainingData.title').' | '.app_name())

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
    {{ html()->form('POST', route('admin.trainingData.store'))->id('trainingData-create')->class('form-horizontal')->acceptsFiles()->open() }}
    <div class="alert alert-danger d-none" role="alert">
        <button type="button" class="close" data-dismiss="alert" aria-label="Close">
            <span aria-hidden="true">×</span>
        </button>
        <div class="error-list">
        </div>
    </div>
    <div class="card">
        <div class="card-header">
            <h3 class="page-title d-inline">@lang('labels.backend.trainingData.create')</h3>
            <div class="float-right">
                <a href="{{ route('admin.trainingData.index') }}"
                   class="btn btn-success">@lang('labels.backend.trainingData.view')</a>

            </div>
        </div>
        <div class="card-body">
           
            {{-- rate type --}}
            <div class="row form-group">
                {{ html()->label(__('labels.backend.trainingData.fields.training_title'))->class('col-md-2 form-control-label')->for('trainingData_title') }}

                <div class="col-md-10">
                    {{-- {!! Form::select('rate_types_id', $rate_types,  (request('rate_types')) ? request('rate_types') : old('rate_types'), ['class' => 'form-control select2','id'=>'rate_types']) !!} --}}
                    {!! Form::text('name', old('name'), ['class' => 'form-control ']) !!}


                </div><!--col-->
            </div>
            {{--  --}}

            <div class="row form-group">
                {{ html()->label(__('labels.backend.trainingData.fields.training_title_ar'))->class('col-md-2 form-control-label')->for('training_title_ar') }}
            
                <div class="col-md-10">
                    {{-- {!! Form::select('rate_types_id', $rate_types_ar,  (request('rate_types_ar')) ? request('rate_types_ar') : old('rate_types_ar'), ['class' => 'form-control select2','id'=>'rate_types_ar']) !!} --}}
                    {!! Form::text('name_ar', old('name_ar'), ['class' => 'form-control ']) !!}
                   
            
                </div><!--col-->
            </div>
            {{--  --}}
             
            <div class="form-group row justify-content-center">
                <div class="col-4">
                    {{ form_cancel(route('admin.trainingData.index'), __('buttons.general.cancel')) }}

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
