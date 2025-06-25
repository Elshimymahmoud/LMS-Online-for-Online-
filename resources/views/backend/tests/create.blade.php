@extends('backend.layouts.app')
@section('title', __('labels.backend.tests.title').' | '.app_name())

@push('after-styles')
    <style>
        .select2-container--default .select2-selection--single {
            height: 35px;
        }

        .select2-container--default .select2-selection--single .select2-selection__rendered {
            line-height: 35px;
        }

        .select2-container--default .select2-selection--single .select2-selection__arrow {
            height: 35px;
        }

    </style>
@endpush
@section('content')

    {!! Form::open(['method' => 'POST', 'route' => ['admin.forms.store']]) !!}
    <input type="hidden" name="form_type" value="{{$form_type}}">
    <div class="card">
        <div class="card-header">
            <h3 class="page-title float-left mb-0">@lang('labels.backend.tests.create')</h3>
            <div class="float-right">
                <a  href="{{ route('admin.forms.index',['form_type'=>request('form_type'),'course_id'=>request('course_id')?request('course_id'):0]) }}"
                   class="btn btn-success">@lang('labels.backend.tests.view')</a>
            </div>
        </div>
        <div class="card-body">
            <div class="row">
                
                <div class="col-12 col-lg-6 form-group">
                    {!! Form::label('course_id',trans('labels.backend.tests.fields.course'), ['class' => 'control-label']) !!}
                    {!! Form::select('course_id', $courses, old('course_id')??request('course_id'), ['class' => 'form-control select2']) !!}
                </div>

                <div class="col-12 col-lg-6 form-group">
                    {!! Form::label('chapter_id', trans('labels.backend.lessons.fields.test_chapter'), ['class' => 'control-label']) !!}
                    {!! Form::select('chapter_id', $chapters, old('chapter_id'), ['class' => 'form-control select2']) !!}
                </div>

                <div class="col-12 col-lg-6  form-group">
                    {!! Form::label('title',trans('labels.backend.tests.fields.title'), ['class' => 'control-label']) !!}
                    {!! Form::text('title', old('title'), ['class' => 'form-control', 'placeholder' => trans('labels.backend.tests.fields.title')]) !!}
                </div>

                <div class="col-12 col-lg-6  form-group">
                    {!! Form::label('title',trans('labels.backend.tests.fields.title_ar'), ['class' => 'control-label']) !!}
                    {!! Form::text('title_ar', old('title_ar'), ['class' => 'form-control', 'placeholder' => trans('labels.backend.tests.fields.title_ar')]) !!}
                </div>

            </div>

            {{-- <div class="row">
                <div class="col-12 form-group">
                    {!! Form::label('description',trans('labels.backend.tests.fields.description'), ['class' => 'control-label']) !!}
                    {!! Form::textarea('description', old('description'), ['class' => 'form-control ', 'placeholder' => trans('labels.backend.tests.fields.description')]) !!}
                </div>
            </div>
           
            <div class="row">
                <div class="col-12 form-group">
                    {!! Form::label('description',trans('labels.backend.tests.fields.description_ar'), ['class' => 'control-label']) !!}
                    {!! Form::textarea('description_ar', old('description_ar'), ['class' => 'form-control ', 'placeholder' => trans('labels.backend.tests.fields.description_ar')]) !!}
                </div>
            </div> --}}
            <div class="row question">
                <div class="col-6 form-group">
                    {!! Form::label('qusetion',trans('labels.backend.tests.fields.qusetion'), ['class' => 'control-label']) !!}
                    {!! Form::text('qusetion', old('qusetion'), ['class' => 'form-control ', 'placeholder' => trans('labels.backend.tests.fields.qusetion')]) !!}
                </div>
                <div class="col-6 col-lg-6 form-group">
                    {!! Form::label('question_type', trans('labels.backend.lessons.fields.question_type'), ['class' => 'control-label']) !!}
                    {!! Form::select('question_type', ['short_answer','paragraph','multiple_choice','drop_down','file_upload','date','time'], old('question_type'), ['class' => 'form-control select2']) !!}
                </div>
            </div>

            <div class="row">
                <div class="col-12 form-group">
                   <button>Add new question</button>
                </div>
            </div>
            

            <div class="row">
                <div class="col-12 form-group">
                    {!! Form::hidden('published', 0) !!}
                    {!! Form::checkbox('published', 1, false, []) !!}
                    {!! Form::label('published', trans('labels.backend.tests.fields.published'), ['class' => 'control-label font-weight-bold']) !!}

                </div>
            </div>
            
        </div>
    </div>

    {!! Form::submit(trans('strings.backend.general.app_save'), ['class' => 'btn btn-danger']) !!}
    {!! Form::close() !!}
@stop


