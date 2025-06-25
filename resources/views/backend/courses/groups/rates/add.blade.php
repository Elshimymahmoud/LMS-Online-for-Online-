@extends('backend.layouts.app')
@section('title', __('buttons.backend.rates.addToGroup').' | '.app_name())
@push('after-styles')
    <link rel="stylesheet" type="text/css" href="{{asset('plugins/amigo-sorter/css/theme-default.css')}}">
    <style>
.headerr{
            top: 15%;
            /* width:80%;  */
            height:100px; 
            background:white; 
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

{!! Form::open(['method' => 'POST', 'route' => ['admin.group.rates.attach'], 'files' => true,]) !!}

    <div class="card" style="margin-top: 2%;">
        <div class="card-header">
            <h3 class="page-title d-inline float-left mb-0">@lang('buttons.backend.rates.addToGroup')</h3>
            <div class="float-right">
                <a href="{{ route('admin.group.rates', ['group_id' => $group->id]) }}"
                class="btn btn-primary">&#8592</a>
                </div>
        </div>
        <div class="card-body">
            <div class="row">
                <div class="col-12 form-group">
                    {!! Form::label('rates',trans('labels.backend.rates.title'), ['class' => 'control-label']) !!}
                    {!! Form::select('rates[]', $rates ,old('rates'), ['class' => 'form-control select2 js-example-placeholder-multiple', 'multiple' => 'multiple', 'required' => true]) !!}
                </div>
                <div class="col-12 form-group">
                    {!! Form::hidden('published', 0) !!}
                    {!! Form::checkbox('published', 1, false, []) !!}
                    {!! Form::label('published', trans('labels.backend.tests.fields.published'), ['class' => 'control-label font-weight-bold']) !!}

                </div>
                <input type="hidden" value="{{ $group->id }}" name="group_id">
            </div>
        </div>
    </div>


    <div class="col-12 text-center">
        {!! Form::submit(trans('strings.backend.general.app_save'), ['class' => 'btn btn-danger mb-4 form-group']) !!}
    </div>

    {!! Form::close() !!}
@stop

@push('after-scripts')
<script type="text/javascript">
    $(document).ready(function() {
       
        $(".js-example-placeholder-multiple").select2({
                placeholder: "{{trans('labels.backend.rates.fields.choose_rate')}}",
            });


    });
   
</script>
@endpush