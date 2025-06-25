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

    </style>

@endpush
@section('content')
    {!! Form::model($rate, ['method' => 'PUT', 'route' => ['admin.rates.update', "id"=> $rate->id],'files' => true]) !!}

    <div class="alert alert-danger d-none" role="alert">
        <button type="button" class="close" data-dismiss="alert" aria-label="Close">
            <span aria-hidden="true">×</span>
        </button>
        <div class="error-list">
        </div>
    </div>
    <div class="card">
        <div class="card-header">
            <h3 class="page-title d-inline">@lang('labels.backend.rates.edit')</h3>
            <div class="float-right">
                <a href="{{ route('admin.group.rates') }}" class="btn btn-success">@lang('labels.backend.rates.view')</a>

            </div>
        </div>
        <div class="card-body">

            {{-- rate title --}}
            <div class="row form-group">
                {{ html()->label(__('labels.backend.impact.fields.impact_title_ar'))->class('col-md-2 form-control-label')->for('impact_title') }}

                <div class="col-md-10">
                    {!! Form::text('title_ar', old('title_ar'), ['class' => 'form-control', 'placeholder' => trans('labels.backend.tests.fields.title_ar')]) !!}

                </div>
                <!--col-->
            </div>
            {{--  --}}
            <div class="row form-group">
                {{ html()->label(__('labels.backend.impact.fields.impact_title'))->class('col-md-2 form-control-label')->for('rate_title_ar') }}

                <div class="col-md-10">
                    {!! Form::text('title', old('title'), ['class' => 'form-control', 'placeholder' => trans('labels.backend.tests.fields.title')]) !!}
                </div>
                <!--col-->
            </div>
            {{--  --}}

            {{--  --}}

            <div class="row form-group">
                {{ html()->label(__('labels.backend.rates.fields.type'))->class('col-md-2 form-control-label')->for('impact_title_ar') }}

                <div class="col-md-10">
                    <select name="user_type" id="" class="form-control">
                        <option value="student" @if($rate->user_type=='student') selected @endif>@lang('labels.backend.rates.fields.student')</option>
                        <option value="teacher" @if($rate->user_type=='teacher') selected @endif>@lang('labels.backend.rates.fields.teacher')</option>
                        <option value="teacher_rate_student" @if($rate->user_type=='teacher_rate_student') selected @endif>@lang('labels.backend.rates.fields.teacher_rate_student')</option>
                    </select>
                </div>
                <!--col-->
            </div>
            {{--  --}}


            <div class="row">
                <div class="col-12 form-group">
                    {!! Form::hidden('published', 0) !!}
                    {!! Form::checkbox('published', 1, old('published'), []) !!}
                    {!! Form::label('published', trans('labels.backend.tests.fields.published'), ['class' => 'control-label font-weight-bold']) !!}
                </div>
            </div>


            {{--  --}}
            <div class="form-group row justify-content-center">
                <div class="col-4">
                    {{ form_cancel(route('admin.group.rates'), __('buttons.general.cancel')) }}

                    <button class="btn btn-success pull-right" type="submit">{{ __('buttons.general.crud.edit') }}</button>
                </div>
            </div>
            <!--col-->
        </div>
    </div>
    {{ html()->form()->close() }}
@endsection

@push('after-scripts')

@endpush
