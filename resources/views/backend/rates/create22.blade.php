@extends('backend.layouts.app')
@php
$form_type=request('form_type');
$title="menus.backend.forms.$form_type";
$Create="menus.backend.forms.create";
$Edit="menus.backend.forms.edit";


@endphp
@section('title', __($title).' | '.app_name())

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

    .rate-title {
        color: #802d42;
        font-weight: bold;
        padding: 5px;
        border-bottom: 1px solid;
        margin-bottom: 17px;

    }

    .headerr {
        top: 15%;
        /* width:80%;  */
        height: 100px;
        background: white;
        /* position:fixed; */
        text-align: center;
        -webkit-box-shadow: 0 3px 5px rgba(57, 63, 72, 0.3);
        -moz-box-shadow: 0 3px 5px rgba(57, 63, 72, 0.3);
        box-shadow: 0 3px 5px rgba(57, 63, 72, 0.3);
        border: 1px solid #d7cece;
        padding: 20px;
        color: darkslategray;
        font-size: x-large;
        border-radius: 7px;
    }
</style>

@endpush
@section('content')
@if($course)
<nav aria-label="breadcrumb" class="headerr ">
    <ol class="breadcrumb">
        <li class="breadcrumb-item"><a href="{{ route('admin.courses.index') }}"><i class="fa fa-home"></i></a></li>
        <li class="breadcrumb-item"> {{@$course->type->name_ar}} </li>
        <li class="breadcrumb-item active" aria-current="page">{{@$course->title_ar}}</li>
    </ol>
</nav>
@endif
{{ html()->form('POST', route('admin.forms.store'))->id('rate-create')->class('form-horizontal')->acceptsFiles()->open() }}
<input type="hidden" name="form_type" value="{{request('form_type')}}">
<div class="alert alert-danger d-none" role="alert">
    <button type="button" class="close" data-dismiss="alert" aria-label="Close">
        <span aria-hidden="true">×</span>
    </button>
    <div class="error-list">
    </div>
</div>
<div class="card" style="margin-top: 2%;">
    <div class="card-header">
        <h3 class="page-title d-inline"> @lang($Create) @lang($title)</h3>
        <div class="float-right">
            <a href="{{ request('course_id')?(route('admin.forms2.index2',['form_type'=>request('form_type'),'course_id'=>request('course_id')])):(route('admin.forms.index',['form_type'=>request('form_type')])) }}" class="btn btn-primary">&#8592</a>

        </div>
    </div>
    <div class="card-body">

        {{-- ////////////////// --}}
        <div class="row">
            <div class="col-12 form-group">
                <h5 class="rate-title">تقييم المدرب</h5>
                @foreach ($rates->where('type','teacher') as $rate)
                <div class="checkbox d-inline mr-4">

                    {!! Form::checkbox('forms[]', $rate->id, []) !!}
                    {!! Form::label($rate->title, (Lang::locale()=='en')?$rate->title:($rate->title_ar?$rate->title_ar:$rate->title), ['class' => 'checkbox control-label font-weight-bold']) !!}
                </div>

                @endforeach




            </div>
        </div>

        {{-- ////////////////// --}}
        <div class="row">
            <div class="col-12 form-group">
                <h5 class="rate-title">تقييم المتدرب</h5>
                @foreach ($rates->where('type','student') as $rate)
                <div class="checkbox d-inline mr-4">

                    {!! Form::checkbox('forms[]', $rate->id, []) !!}
                    {!! Form::label($rate->title, (Lang::locale()=='en')?$rate->title:($rate->title_ar?$rate->title_ar:$rate->title), ['class' => 'checkbox control-label font-weight-bold']) !!}
                </div>

                @endforeach




            </div>
        </div>
        <div class="form-group row justify-content-center">
            <div class="col-4">
                <a href="{{ url()->previous() }}" class="btn btn-primary"> {{__('buttons.general.cancel')}}</a>

                <button class="btn btn-success pull-right" type="submit">{{__('buttons.general.crud.create')}}</button>
            </div>
        </div><!--col-->
    </div>


</div>

<input type="hidden" value="{{request('course_id')}}" name="course_id">

{{ html()->form()->close() }}
@endsection