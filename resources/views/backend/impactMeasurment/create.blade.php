@extends('backend.layouts.app')
@section('title', __('labels.backend.impact.title').' | '.app_name())

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
    {{ html()->form('POST', route('admin.forms.store',['form_type'=>'impact_measurments']))->id('impact-create')->class('form-horizontal')->acceptsFiles()->open() }}
    <div class="alert alert-danger d-none" role="alert">
        <button type="button" class="close" data-dismiss="alert" aria-label="Close">
            <span aria-hidden="true">×</span>
        </button>
        <div class="error-list">
        </div>
    </div>
    <div class="card">
        <div class="card-header">
            <h3 class="page-title d-inline">@lang('labels.backend.impact.create')</h3>
            <div class="float-right">
                   <a href="{{route('admin.forms.index', ['form_type'=>'impact_measurments'])}}"
                   class="btn btn-primary">&#8592</a>

            </div>
        </div>
        <div class="card-body">
           
            {{-- rate type --}}
            <div class="row form-group">
                {{ html()->label(__('labels.backend.impact.fields.impact_title'))->class('col-md-2 form-control-label')->for('impact_title') }}

                <div class="col-md-10">
                    {{-- {!! Form::select('rate_types_id', $rate_types,  (request('rate_types')) ? request('rate_types') : old('rate_types'), ['class' => 'form-control select2','id'=>'rate_types']) !!} --}}
                    {!! Form::text('title', old('title'), ['class' => 'form-control ']) !!}


                </div><!--col-->
            </div>
            {{--  --}}

            <div class="row form-group">
                {{ html()->label(__('labels.backend.impact.fields.impact_title_ar'))->class('col-md-2 form-control-label')->for('impact_title_ar') }}
            
                <div class="col-md-10">
                    {{-- {!! Form::select('rate_types_id', $rate_types_ar,  (request('rate_types_ar')) ? request('rate_types_ar') : old('rate_types_ar'), ['class' => 'form-control select2','id'=>'rate_types_ar']) !!} --}}
                    {!! Form::text('title_ar', old('title_ar'), ['class' => 'form-control ']) !!}
                   
            
                </div><!--col-->
            </div>
            {{--  --}}
              {{--  --}}

              <div class="row form-group">
                {{ html()->label(__('labels.backend.impact.fields.type'))->class('col-md-2 form-control-label')->for('impact_title_ar') }}
            
                <div class="col-md-10">
                  <select name="type" id="" class="form-control" >
                      <option value="teacher">{{__('labels.backend.impact.fields.teacher')}}</option>
                      <option value="student">{{__('labels.backend.impact.fields.student')}}</option>

                  </select>
                   
            
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
                    {{ form_cancel(route('admin.forms.index', ['form_type'=>'impact_measurments']), __('buttons.general.cancel')) }}

                    <button class="btn btn-success pull-right" type="submit">{{__('buttons.general.crud.create')}}</button>
                </div>
            </div><!--col-->
        </div>
    </div>
   
    <input type="hidden" value="{{isset($course_id)?$course_id:null}}" name="course_id">
    <input type="hidden" value="impact_measurments" name="form_type">
  
    {{ html()->form()->close() }}
@endsection

@push('after-scripts')
<script>
 
    
</script>
@endpush
