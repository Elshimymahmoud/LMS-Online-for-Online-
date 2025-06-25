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
    {!! Form::model($blog, ['method' => 'PUT', 'route' => ['admin.blogs.update', $blog->id], 'files' => true,]) !!}
    <div class="card">
        <div class="card-header">
            <h3 class="page-title float-left mb-0">@lang('labels.backend.blogs.edit')</h3>
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
                    {!! Form::select('category', $category,  $blog->category_id, ['class' => 'form-control select2']) !!}
                </div>

            </div>
            @if(@isset($chapters))
                    
               
            <div class="col-12 col-lg-12 form-group">
                {!! Form::label('chapter', trans('labels.backend.blogs.fields.chapter'), ['class' => 'control-label']) !!}
                {!! Form::select('chapter_id', $chapters,  old('chapter_id'), ['class' => 'form-control select2']) !!}
               
          
            </div>
            @endif

            <div class="row">
                <div class="col-12 form-group">
                    {!! Form::label('downloadable_files', trans('labels.backend.lessons.fields.downloadable_files').' '.trans('labels.backend.lessons.max_file_size'), ['class' => 'control-label']) !!}
                    {!! Form::file('downloadable_files[]', [
                        'multiple',
                        'class' => 'form-control file-upload',
                        'id' => 'downloadable_files',
                        'accept' => "image/jpeg,image/gif,image/png,application/msword,audio/mpeg,application/vnd.ms-excel,application/vnd.openxmlformats-officedocument.spreadsheetml.sheet,application,application/vnd.openxmlformats-officedocument.presentationml.presentation,application/vnd.ms-powerpoint,application/pdf,video/mp4"
                        ]) !!}
                     <div class="photo-block mt-3">
                        <div class="files-list">
                            @if(count($blog->downloadableMedia) > 0)
                                @foreach($blog->downloadableMedia as $media)
                                    <p class="form-group">
                                        <a href="{{ asset('storage/uploads/'.$media->name) }}"
                                           target="_blank">{{ $media->name }}
                                            ({{ $media->size }} KB)</a>
                                        <a href="#" data-media-id="{{$media->id}}"
                                           class="btn btn-xs btn-danger delete remove-file">@lang('labels.backend.test.remove')</a>
                                    </p>
                                @endforeach
                            @endif
                        </div>
                    </div>
    
                </div>
            </div>
            <div class="row">
                <div class="col-12 col-lg-6 form-group">
                    {!! Form::label('slug', trans('labels.backend.blogs.fields.slug'), ['class' => 'control-label']) !!}
                    {!! Form::text('slug', old('slug'), ['class' => 'form-control', 'placeholder' => trans('labels.backend.blogs.slug_placeholder')]) !!}
                </div>
                @if ($blog->image)
                    <div class="col-12 col-lg-5 form-group">
                        {!! Form::label('featured_image', trans('labels.backend.blogs.fields.featured_image').' '.trans('labels.backend.blogs.max_file_size'), ['class' => 'control-label']) !!}
                        {!! Form::file('featured_image', ['class' => 'form-control', 'accept' => 'image/jpeg,image/gif,image/png']) !!}
                        {!! Form::hidden('featured_image_max_size', 8) !!}
                        {!! Form::hidden('featured_image_max_width', 4000) !!}
                        {!! Form::hidden('featured_image_max_height', 4000) !!}
                    </div>
                    <div class="col-lg-1 col-12 form-group">
                        <a href="{{ asset('storage/uploads/'.$blog->image) }}" target="_blank"><img
                                    src="{{ asset('storage/uploads/'.$blog->image) }}" height="65px"
                                    width="65px"></a>
                    </div>
                @else
                    <div class="col-12 col-lg-6 form-group">

                        {!! Form::label('featured_image', trans('labels.backend.blogs.fields.featured_image').' '.trans('labels.backend.blogs.max_file_size'), ['class' => 'control-label']) !!}
                        {!! Form::file('featured_image', ['class' => 'form-control']) !!}
                        {!! Form::hidden('featured_image_max_size', 8) !!}
                        {!! Form::hidden('featured_image_max_width', 4000) !!}
                        {!! Form::hidden('featured_image_max_height', 4000) !!}
                    </div>
                @endif

            </div>


            <div class="row">
                <div class="col-12 form-group">
                    {!! Form::label('content', trans('labels.backend.blogs.fields.content'), ['class' => 'control-label']) !!}
                    {!! Form::textarea('content', old('content'), ['class' => 'form-control editor', 'placeholder' => '','id'=>'editor']) !!}
                </div>
            </div>

            <div class="row">
                <div class="col-md-12 form-group">
                    {!! Form::text('tags', $tags, ['class' => 'form-control','data-role' => 'tagsinput', 'placeholder' => trans('labels.backend.blogs.fields.tags_placeholder'),'id'=>'tags']) !!}

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
                        {{trans('labels.general.buttons.update')}}
                    </button>
                    <a href="{{route('admin.blogs.index')}}" class="btn btn-danger waves-effect waves-light ">
                        {{trans('strings.backend.general.app_back_to_list')}}
                    </a>
                </div>
            </div>
        </div>
    </div>
    {!! Form::close() !!}

@endsection


@push('after-scripts')
    <script src="{{asset('plugins/bootstrap-tagsinput/bootstrap-tagsinput.js')}}"></script>

    <script>

        $(document).ready(function () {
            $(document).on('click', '.delete', function (e) {
                e.preventDefault();
                var parent = $(this).parent('.form-group');
                var confirmation = confirm('{{trans('strings.backend.general.are_you_sure')}}')
                if (confirmation) {
                    var media_id = $(this).data('media-id');
                    $.post('{{route('admin.media.destroy')}}', {media_id: media_id, _token: '{{csrf_token()}}'},
                        function (data, status) {
                            if (data.success) {
                                parent.remove();
                            }else{
                                alert('Something Went Wrong')
                            }
                        });
                }
            })
            $(".js-example-placeholder-multiple").select2({
                   placeholder: "{{trans('labels.backend.courses.fields.location')}}",
               });
        })
     
    </script>
@endpush