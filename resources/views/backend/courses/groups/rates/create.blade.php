@extends('backend.layouts.app')
@section('title', __('labels.backend.rates.title') . ' | ' . app_name())

@push('after-styles')
    <style>
        .form-control-label {
            line-height: 35px;
        }

        .remove {
            float: right;
            color: red;
            font-size: 20px;
            cursor: pointer;
        }

        .error {
            color: red;
        }

        .delete_quest {
            position: absolute;
            left: 10px;
            top: 10px;
            z-index: 99999;
        }

    </style>

@endpush
@section('content')
    {{ html()->form('POST', route('admin.groups.rates.store'))->id('impact-create')->class('form-horizontal')->acceptsFiles()->open() }}
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
                <a href="{{route('admin.group.rates')}}"
                   class="btn btn-primary">&#8592</a>

            </div>
        </div>
        <div class="card-body">

            <div class="row form-group">
                {{ html()->label(__('labels.backend.impact.fields.impact_title_ar'))->class('col-md-2 form-control-label')->for('impact_title_ar') }}
                <div class="col-md-10">
                    {!! Form::text('title_ar', old('title_ar'), ['class' => 'form-control ']) !!}
                </div>
                <!--col-->
            </div>

            <div class="row form-group">
                {{ html()->label(__('labels.backend.impact.fields.impact_title'))->class('col-md-2 form-control-label')->for('impact_title') }}

                <div class="col-md-10">
                    {!! Form::text('title', old('title'), ['class' => 'form-control ']) !!}
                </div>
            </div>


            <div class="row form-group">
                {{ html()->label(__('labels.backend.rates.fields.type'))->class('col-md-2 form-control-label')->for('impact_title_ar') }}

                <div class="col-md-10">
                    <select name="user_type" id="" class="form-control">
                        <option value="">{{ __('labels.backend.courses.select_category') }}</option>
                        <option value="teacher">{{ __('labels.backend.rates.fields.teacher') }}</option>
                        <option value="student">{{ __('labels.backend.rates.fields.student') }}</option>
                        <option value="teacher_rate_student">@lang('labels.backend.rates.fields.teacher_rate_student')</option>

                    </select>
                </div>
            </div>




            <div class="row">
                <div class="col-12 form-group">

                    {!! Form::checkbox('published') !!}
                    {!! Form::label('published', trans('labels.backend.tests.fields.published'), ['class' => 'control-label font-weight-bold']) !!}

                </div>
            </div>
            <div class="form-group row justify-content-center">
                <div class="col-4">
                    <a href="{{ url()->previous() }}" class="btn btn-primary"> {{__('buttons.general.cancel')}}</a>
                    <!-- {{ form_cancel(route('admin.forms.index', ['form_type' => 'impact_measurments']), __('buttons.general.cancel')) }} -->

                    <button class="btn btn-success pull-right"
                            type="submit">{{ __('buttons.general.crud.create') }}</button>
                </div>
            </div>
            <!--col-->
        </div>
    </div>


    {{ html()->form()->close() }}
@endsection

@push('after-scripts')


@endpush
