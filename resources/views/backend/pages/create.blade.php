@extends('backend.layouts.app')
@section('title', __('labels.backend.pages.title').' | '.app_name())

@push('after-styles')
    <link rel="stylesheet" type="text/css" href="{{asset('plugins/bootstrap-tagsinput/bootstrap-tagsinput.css')}}">
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
        .bootstrap-tagsinput{
            width: 100%!important;
            display: inline-block;
        }
        .bootstrap-tagsinput .tag{
            line-height: 1;
            margin-right: 2px;
            background-color: #2f353a ;
            color: white;
            padding: 3px;
            border-radius: 3px;
        }

    </style>
@endpush

@section('content')
    {!! Form::open(['method' => 'POST', 'route' => ['admin.pages.store'], 'files' => true,]) !!}

    <div class="card">
        <div class="card-header">
            <h3 class="page-title float-left mb-0">@lang('labels.backend.pages.create')</h3>
            <div class="float-right">
                <a href="{{ route('admin.pages.index') }}"
                   class="btn btn-success">@lang('labels.backend.pages.view')</a>
            </div>
        </div>

        <div class="card-body">
            <div class="row">
                <div class="col-6 form-group">
                    {!! Form::label('title', trans('labels.backend.pages.fields.title'), ['class' => 'control-label']) !!}
                    {!! Form::text('title', old('title'), ['class' => 'form-control', 'placeholder' => trans('labels.backend.pages.fields.title'), ]) !!}
                </div>
                <div class="col-6 form-group">
                    {!! Form::label('title_en', trans('labels.backend.pages.fields.title_en'), ['class' =>
                    'control-label']) !!}
                    {!! Form::text('title_en', old('title_en'), ['class' => 'form-control', 'placeholder' => trans('labels.backend.pages.fields.title_en'), ]) !!}
                </div>

            </div>

            <div class="row">
                <div class="col-12 col-lg-6 form-group">
                    {!! Form::label('slug',trans('labels.backend.pages.fields.slug'), ['class' => 'control-label']) !!}
                    {!! Form::text('slug', old('slug'), ['class' => 'form-control', 'placeholder' => trans('labels.backend.lessons.slug_placeholder')]) !!}

                </div>
                <div class="col-12 col-lg-6 form-group">
                    {!! Form::label('page_image', trans('labels.backend.pages.fields.featured_image').' '.trans('labels.backend.pages.max_file_size'), ['class' => 'control-label']) !!}
                    {!! Form::file('page_image', ['class' => 'form-control' , 'accept' => 'image/jpeg,image/gif,image/png']) !!}
                    {!! Form::hidden('page_image_max_size', 8) !!}
                    {!! Form::hidden('page_image_max_width', 4000) !!}
                    {!! Form::hidden('page_image_max_height', 4000) !!}

                </div>
            </div>
            <div class="row">
                <div class="col-12 form-group">
                    {!! Form::label('content', trans('labels.backend.pages.fields.content'), ['class' => 'control-label']) !!}
                    {!! Form::textarea('content_ar', old('content_ar'), ['class' => 'form-control editor_ar', 'placeholder' => '']) !!}

                </div>
            </div>
            <div class="row">
                <div class="col-12 form-group">
                    {!! Form::label('content', trans('labels.backend.pages.fields.content_en'), ['class' =>
                    'control-label']) !!}
                    {!! Form::textarea('content', old('content'), ['class' => 'form-control editor', 'placeholder' => '','id' => 'editor']) !!}

                </div>
            </div>

            <div class="row">
                <div class="col-12 form-group">
                    {!! Form::label('meta_title',trans('labels.backend.pages.fields.meta_title'), ['class' => 'control-label']) !!}
                    {!! Form::text('meta_title', old('meta_title'), ['class' => 'form-control', 'placeholder' => trans('labels.backend.pages.fields.meta_title')]) !!}

                </div>
                <div class="col-12 form-group">
                    {!! Form::label('meta_description',trans('labels.backend.pages.fields.meta_description'), ['class' => 'control-label']) !!}
                    {!! Form::textarea('meta_description', old('meta_description'), ['class' => 'form-control', 'placeholder' => trans('labels.backend.pages.fields.meta_description')]) !!}
                </div>
                <div class="col-12 form-group">
                    {!! Form::label('meta_keywords',trans('labels.backend.pages.fields.meta_keywords'), ['class' => 'control-label']) !!}
                    {!! Form::textarea('meta_keywords', old('meta_keywords'), ['class' => 'form-control', 'placeholder' => trans('labels.backend.pages.fields.meta_keywords')]) !!}
                </div>
                <div class="col-12 form-group">
                    {!! Form::label('page_doc', trans('labels.general.add_docs') . ' * <span
                    class="small_note">' . trans('labels.general.add_docs_note') . '</span>', ['class' =>
                    'control-label'], false) !!}

                    {!! Form::file('page_doc', ['class' => 'form-control' , 'accept' => 'pdf/docx']) !!}
                </div>
                <div class="col-12 form-group">
                    <div class="checkbox d-inline mr-3">
                        {!! Form::hidden('published', 0) !!}
                        {!! Form::checkbox('published', 1, false, []) !!}
                        {!! Form::label('published',  trans('labels.backend.courses.fields.published'), ['class' => 'checkbox control-label font-weight-bold']) !!}
                    </div>

                    <div class="checkbox mr-3" id="sidebarCheckBox" style="display: inline">
                        {!! Form::hidden('sidebar', 0) !!}
                        {!! Form::checkbox('sidebar', 1, false, []) !!}
                        {!! Form::label('sidebar',  trans('labels.backend.courses.fields.sidebar'), ['class' => 'checkbox control-label font-weight-bold']) !!}
                    </div>
                </div>

            </div>
            <div class="row">
                <div class="col-md-12 text-center form-group">
                    <button type="submit" class="btn btn-info waves-effect waves-light ">
                       {{trans('labels.general.buttons.save')}}
                    </button>
                    <button type="reset" class="btn btn-danger waves-effect waves-light ">
                       {{trans('labels.backend.pages.fields.clear')}}
                    </button>
                </div>

            </div>

        </div>
    </div>

@endsection

@push('after-scripts')
    <script src="{{asset('plugins/bootstrap-tagsinput/bootstrap-tagsinput.js')}}"></script>

    <script>
        //if clicked on the checkbox is_footer then the sidebar will be disabled
        $(document).on('change', 'input[name="is_footer"]', function () {
            if ($(this).is(':checked')) {
                $('#sidebarCheckBox').toggle();
            } else{
                $('#sidebarCheckBox').toggle();
            }
        });

        var uploadField = $('input[type="file"]');

        $(document).on('change','input[type="file"]',function () {
            var $this = $(this);
            $(this.files).each(function (key,value) {
                if((value.size/1024) > 10240){
                    alert('"'+value.name+'"'+'exceeds limit of maximum file upload size' )
                    $this.val("");
                }
            })
        })

    </script>
@endpush