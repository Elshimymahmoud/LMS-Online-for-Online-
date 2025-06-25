@extends('backend.layouts.app')
@section('title', __('labels.backend.articles.title').' | '.app_name())

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
    {{ html()->form('PUT', route('admin.articles.update',['id'=>$article->id]))->id('rate-create')->class('form-horizontal')->acceptsFiles()->open() }}
    <input type="hidden" value="{{$article->id}}" name="article_id">
    <div class="alert alert-danger d-none" role="alert">
        <button type="button" class="close" data-dismiss="alert" aria-label="Close">
            <span aria-hidden="true">×</span>
        </button>
        <div class="error-list">
        </div>
    </div>
    <div class="card">
        <div class="card-header">
            <h3 class="page-title d-inline">@lang('labels.backend.articles.create')</h3>
            <div class="float-right">
                <a href="{{ route('admin.sliders.index') }}"
                   class="btn btn-success">@lang('labels.backend.rates.view')</a>

            </div>
        </div>
        <div class="card-body">
           

         
            
       
           <div class="row form-group">
            {{ html()->label(__('labels.backend.articles.fields.title'))->class('col-md-2 form-control-label')->for('course_type') }}

            <div class="col-md-10">
                {{ html()->text('title')
                ->class('form-control')
                ->value($article->title)
                ->placeholder(__('labels.backend.articles.fields.title'))
            ->autofocus()
            }}

            </div>
        </div>
        <div class="row form-group">
            {{ html()->label(__('labels.backend.articles.fields.title_ar'))->class('col-md-2 form-control-label')->for('course_type') }}

            <div class="col-md-10">
                {{ html()->text('title_ar')
                ->class('form-control')
                ->value($article->title_ar)
                ->placeholder(__('labels.backend.articles.fields.title_ar'))
            ->autofocus()
            }}

            </div>
        </div>
        <div class="row form-group">
            {{ html()->label(__('labels.backend.articles.fields.article'))->class('col-md-2 form-control-label')->for('course_type') }}

            <div class="col-md-10">
                {{ html()->textarea('article')
                ->class('form-control')
                ->value($article->article)
                ->placeholder(__('labels.backend.articles.fields.article'))
            ->autofocus()
            }}

            </div>
        </div>
        <div class="row form-group">
            {{ html()->label(__('labels.backend.articles.fields.article_ar'))->class('col-md-2 form-control-label')->for('course_type') }}

            <div class="col-md-10">
                {{ html()->textarea('article_ar')
                ->class('form-control')
                ->value($article->article_ar)

                ->placeholder(__('labels.backend.articles.fields.article_ar'))
            ->autofocus()
            }}
            </div>
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
