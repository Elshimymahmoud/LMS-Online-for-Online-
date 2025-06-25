@extends('backend.layouts.app')
@section('title', __('labels.backend.blogs.title').' | '.app_name())

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
    {!! Form::open(['method' => 'POST', 'route' => ['admin.blogs.store'], 'files' => true,]) !!}
    <input type="hidden" value="{{$course_id}}" name="course_id">
    <div class="card">
        <div class="card-header">
            <h3 class="page-title float-left mb-0">@lang('labels.backend.blogs.create')</h3>
            <div class="float-right">
                <a href="{{ route('admin.blogs.index') }}"
                   class="btn btn-success">@lang('labels.backend.blogs.view')</a>
            </div>
        </div>

        <div class="card-body">
            <div class="row">
                <div class="col-12 col-lg-6 form-group">
                    {!! Form::label('title', trans('labels.backend.blogs.fields.title'), ['class' => 'control-label']) !!}
                    {!! Form::text('title', old('title'), ['class' => 'form-control', 'placeholder' => trans('labels.backend.blogs.fields.title'), ]) !!}
                </div>

                <div class="col-12 col-lg-6 form-group">
                    {!! Form::label('category', trans('labels.backend.blogs.fields.category'), ['class' => 'control-label']) !!}
                    {!! Form::select('category', $category,  $category_id  ? $category_id : old('category'), ['class' => 'form-control select2']) !!}
                   
              
                </div>
                @if(@isset($chapters))
                    
               
                <div class="col-12 col-lg-12 form-group">
                    {!! Form::label('chapter', trans('labels.backend.blogs.fields.chapter'), ['class' => 'control-label']) !!}
                    {!! Form::select('chapter_id', $chapters,  old('chapter_id'), ['class' => 'form-control select2']) !!}
                   
              
                </div>
                @endif
                @if(@isset($chapters))

                <div class="col-lg-12 form-group">
                    {!! Form::label('course_location_label', trans('labels.backend.courses.fields.location').'*', ['class' => 'control-label']) !!}
                    {!! Form::select('course_location_id[]', $courseLocations,'', ['class' => 'form-control select2 col-12 col-lg-12  js-example-placeholder-multiple', 'multiple' => 'multiple','required'=>true]) !!}
                   
                    
                </div>
                @endif
            </div>
    
            <div class="row">
                <div class="col-12 form-group">
                    {!! Form::label('downloadable_files', trans('labels.backend.lessons.fields.downloadable_files').' '.trans('labels.backend.lessons.max_file_size'), ['class' => 'control-label']) !!}
                    {!! Form::file('downloadable_files[]', [
                        'multiple',
                        'class' => 'form-control file-upload',
                        'id' => 'downloadable_files',
                        'accept' => "image/jpeg,image/gif,image/png,application/msword,audio/mpeg,application/vnd.ms-excel,application/vnd.openxmlformats-officedocument.spreadsheetml.sheet,application,application/vnd.openxmlformats-officedocument.presentationml.presentation,application/vnd.ms-powerpoint,application/pdf,video/mp4"
                        ]) !!}
                    <div class="photo-block">
                        <div class="files-list"></div>
                    </div>
    
                </div>
            </div>
            <div class="row">
                <div class="col-12 col-lg-6 form-group">
                    {!! Form::label('slug',trans('labels.backend.blogs.fields.slug'), ['class' => 'control-label']) !!}
                    {!! Form::text('slug', old('slug'), ['class' => 'form-control', 'placeholder' => trans('labels.backend.lessons.slug_placeholder')]) !!}

                </div>
                <div class="col-12 col-lg-6 form-group">
                    {!! Form::label('featured_image', trans('labels.backend.blogs.fields.featured_image').' '.trans('labels.backend.blogs.max_file_size'), ['class' => 'control-label']) !!}
                    {!! Form::file('featured_image', ['class' => 'form-control' , 'accept' => 'image/jpeg,image/gif,image/png']) !!}
                    {!! Form::hidden('featured_image_max_size', 8) !!}
                    {!! Form::hidden('featured_image_max_width', 4000) !!}
                    {!! Form::hidden('featured_image_max_height', 4000) !!}

                </div>
            </div>

            <div class="row">
                <div class="col-12 form-group">
                    {!! Form::label('content', trans('labels.backend.blogs.fields.content'), ['class' => 'control-label']) !!}
                    {!! Form::textarea('content', old('content'), ['class' => 'form-control editor', 'placeholder' => '','id' => 'editor']) !!}

                </div>
            </div>
            <div class="row">
                <div class="col-md-12 form-group">
                    {!! Form::text('tags', old('tags'), ['class' => 'form-control','data-role' => 'tagsinput', 'placeholder' => trans('labels.backend.blogs.fields.tags_placeholder'),'id'=>'tags']) !!}

                </div>
            </div>
            <div class="row">
                <div class="col-12 form-group">
                    {!! Form::label('meta_title',trans('labels.backend.blogs.fields.meta_title'), ['class' => 'control-label']) !!}
                    {!! Form::text('meta_title', old('meta_title'), ['class' => 'form-control', 'placeholder' => trans('labels.backend.blogs.fields.meta_title')]) !!}

                </div>
                <div class="col-12 form-group">
                    {!! Form::label('meta_description',trans('labels.backend.blogs.fields.meta_description'), ['class' => 'control-label']) !!}
                    {!! Form::textarea('meta_description', old('meta_description'), ['class' => 'form-control', 'placeholder' => trans('labels.backend.blogs.fields.meta_description')]) !!}
                </div>
                <div class="col-12 form-group">
                    {!! Form::label('meta_keywords',trans('labels.backend.blogs.fields.meta_keywords'), ['class' => 'control-label']) !!}
                    {!! Form::textarea('meta_keywords', old('meta_keywords'), ['class' => 'form-control', 'placeholder' => trans('labels.backend.blogs.fields.meta_keywords')]) !!}
                </div>
            </div>
            <div class="row">

                <div class="col-md-12 text-center form-group">
                    <button type="submit" class="btn btn-info waves-effect waves-light ">
                       {{trans('labels.backend.blogs.fields.publish')}}
                    </button>
                    <button type="reset" class="btn btn-danger waves-effect waves-light ">
                       {{trans('labels.backend.blogs.fields.clear')}}
                    </button>
                </div>

            </div>

        </div>
    </div>

@endsection

@push('after-scripts')
    <script src="{{asset('plugins/bootstrap-tagsinput/bootstrap-tagsinput.js')}}"></script>

    <script>
       
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
        $(document).ready(function() {
           
           $(".js-example-placeholder-multiple").select2({
                   placeholder: "{{trans('labels.backend.courses.fields.location')}}",
               });
            });
    </script>
@endpush