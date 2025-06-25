@extends('backend.layouts.app')
@section('title', __('labels.backend.lessons.title').' | '.app_name())

@push('after-styles')
    <link rel="stylesheet" type="text/css" href="{{asset('plugins/bootstrap-tagsinput/bootstrap-tagsinput.css')}}">
    <style>
        .link-wrapper {
            border: 1px solid #ccc;
            padding: 5px;
            margin-bottom: 5px;
            display: flex;
            justify-content: space-between;
            align-items: center;
            background-color: #f9f9f9;
        }

        .remove-link-btn {
            border: none;
            background-color: #4f198d;
            color: white;
            cursor: pointer;
            padding: 2px 6px;
            border-radius: 50%;
        }


        .select2-container--default .select2-selection--single {
            height: 35px;
        }

        .select2-container--default .select2-selection--single .select2-selection__rendered {
            line-height: 35px;
        }

        .select2-container--default .select2-selection--single .select2-selection__arrow {
            height: 35px;
        }

        .bootstrap-tagsinput {
            width: 100% !important;
            display: inline-block;
        }

        .bootstrap-tagsinput .tag {
            line-height: 1;
            margin-right: 2px;
            background-color: #2f353a;
            color: white;
            padding: 3px;
            border-radius: 3px;
        }
            label {
        font-size: 14px;
        line-height: 22px;
        padding: 5px;
        font-weight: 600;
    }

    </style>

@endpush

@section('content')
    {!! Form::open(['method' => 'POST', 'route' => ['admin.lessons.store'], 'files' => true,]) !!}
    {!! Form::hidden('model_id',0,['id'=>'lesson_id']) !!}

    <div class="card" style="      font-family: 'Cairo', sans-serif;">
        <div class="card-header">
            <h3 class="page-title float-left mb-0">@lang('labels.backend.lessons.create')</h3>
            <div class="float-right">
                <!-- <a href="{{ route('admin.lessons.index2') }}"
                   class="btn btn-success">@lang('labels.backend.lessons.view')</a> -->
                   <a href="{{ route('admin.lessons.index2', ['course_id' => request('course_id')]) }}"
                    class="btn btn-primary">&#8592</a>
            </div>
        </div>

        <div class="card-body">
            <div class="row">
            <div class="col-12 col-lg-6 form-group">
                    {!! Form::label('title_ar', trans('labels.backend.lessons.fields.title_ar').'*', ['class' => 'control-label']) !!}
                    {!! Form::text('title_ar', old('title_ar'), ['class' => 'form-control', 'placeholder' => trans('labels.backend.lessons.fields.title_ar'), 'required' => '']) !!}
                </div>
            <div class="col-12 col-lg-6 form-group">
                    {!! Form::label('title', trans('labels.backend.lessons.fields.title').'*', ['class' => 'control-label']) !!}
                    {!! Form::text('title', old('title'), ['class' => 'form-control', 'placeholder' => trans('labels.backend.lessons.fields.title'), 'required' => '']) !!}
                </div>
               
{{--                <div class="col-12 form-group">--}}
{{--                    {!! Form::label('short_text_ar', trans('labels.backend.lessons.fields.short_text_ar'), ['class' => 'control-label']) !!}--}}
{{--                  --}}
{{--                    {!! Form::textarea('short_text_ar', old('short_text_ar'), ['class' => 'form-control editor_ar', 'placeholder' => trans('labels.backend.lessons.short_description_placeholder_ar')]) !!}--}}
{{--              --}}
{{--            </div>--}}
{{--                <div class="col-12 form-group">--}}
{{--                    {!! Form::label('short_text', trans('labels.backend.lessons.fields.short_text'), ['class' => 'control-label']) !!}--}}
{{--                   --}}
{{--                    {!! Form::textarea('short_text', old('short_text'), ['class' => 'form-control editor', 'placeholder' => trans('labels.backend.lessons.short_description_placeholder'),'id' => 'editor_en']) !!}--}}

{{--                </div>--}}
            
                <div class="col-12 form-group">
                    {!! Form::label('full_text_ar', trans('labels.backend.lessons.fields.full_text_ar'), ['class' => 'control-label']) !!}
                    {!! Form::textarea('full_text_ar', old('full_text_ar'), ['class' => 'form-control editor_ar', 'placeholder' => '']) !!}
                </div>
                <div class="col-12 form-group">
                    {!! Form::label('full_text', trans('labels.backend.lessons.fields.full_text'), ['class' => 'control-label']) !!}
                    {!! Form::textarea('full_text', old('full_text'), ['class' => 'form-control editor', 'placeholder' => '','id' => 'editor']) !!}

                </div>

                        

              
               
                <!-- <div class="col-12 col-lg-6 form-group">
                    {!! Form::label('course_id', trans('labels.backend.lessons.fields.course'), ['class' => 'control-label']) !!}
                    {!! Form::select('course_id', $courses, old('course_id')??request()->course_id, ['class' => 'form-control select2']) !!}
                    
                </div>  -->
                <input type="hidden" name="course_id" value="{{request('course_id')}}">
                    @if($course->type_id == 1)
                        <!-- <div class="col-12 form-group" style="@if(request('chapter_id')) display:none; @endif">
                            {!! Form::label('chapter_id', trans('labels.backend.lessons.fields.chapters'), ['class' => 'control-label']) !!}
                            {!! Form::select('chapter_id', $chapters , old('chapter_id')??request()->chapter_id, ['class' => 'form-control select2','required' => '']) !!}
                        </div> -->
                   @endif
                   <div class="col-12 form-group" style="@if(request('chapter_id')) display:none; @endif">
                            {!! Form::label('chapter_id', trans('labels.backend.lessons.fields.chapters'), ['class' => 'control-label']) !!}
                            {!! Form::select('chapter_id', $chapters , old('chapter_id')??request()->chapter_id, ['class' => 'form-control select2','required' => '']) !!}
                    </div>

{{--                <div class="col-12 col-lg-6 form-group">--}}
{{--                    {!! Form::label('group_id', trans('labels.backend.courses.fields.location').'*', ['class' => 'control-label']) !!}--}}
{{--                    {!! Form::select('group_id[]', $courseLocations,'', ['class' => 'form-control select2 col-12 col-lg-12  js-example-placeholder-multiple', 'multiple' => 'multiple']) !!}--}}


{{--                </div>--}}


{{--                <div class="col-12 col-lg-12 form-group">--}}
{{--                    {!! Form::label('date', trans('labels.backend.lessons.fields.date'), ['class' => 'control-label']) !!}--}}
{{--                    {!! Form::date('date', old('date'), ['class' => 'form-control', 'placeholder' => trans('labels.backend.lessons.fields.title')]) !!}--}}
{{--                </div>--}}
{{--                <div class="col-12 col-lg-6 form-group">--}}
{{--                    {!! Form::label('from_time', trans('labels.backend.lessons.fields.from_time'), ['class' => 'control-label']) !!}--}}
{{--                    {!! Form::time('from_time', old('from_time'), ['class' => 'form-control', 'placeholder' => trans('labels.backend.lessons.fields.title')]) !!}--}}
{{--                </div>--}}
{{--                <div class="col-12 col-lg-6 form-group">--}}
{{--                    {!! Form::label('to_time', trans('labels.backend.lessons.fields.to_time'), ['class' => 'control-label']) !!}--}}
{{--                    {!! Form::time('to_time', old('to_time'), ['class' => 'form-control', 'placeholder' => trans('labels.backend.lessons.fields.title')]) !!}--}}
{{--                </div>--}}
               
            </div>


            <div class="row">
                <div class="col-12 col-lg-6 form-group">
                    {!! Form::label('slug',trans('labels.backend.lessons.fields.slug'), ['class' => 'control-label']) !!}
                    {!! Form::text('slug', old('slug'), ['class' => 'form-control', 'placeholder' => trans('labels.backend.lessons.slug_placeholder')]) !!}

                </div>
                <div class="col-12 col-lg-6 form-group">
                    {!! Form::label('lesson_image', trans('labels.backend.lessons.fields.lesson_image').' '.trans('labels.backend.lessons.max_file_size'), ['class' => 'control-label']) !!}
                    {!! Form::file('lesson_image', ['class' => 'form-control' , 'accept' => 'image/jpeg,image/gif,image/png']) !!}
                    {!! Form::hidden('lesson_image_max_size', 8) !!}
                    {!! Form::hidden('lesson_image_max_width', 4000) !!}
                    {!! Form::hidden('lesson_image_max_height', 4000) !!}

                </div>
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
                {!! Form::label('linksContainer', trans('labels.frontend.course.resources'), ['class' =>
                'control-label']) !!}
                <!-- Input for link and add button -->
                <div class="input-group mb-3" style="display: flex;flex-direction: row-reverse;gap: 10px;">
                    <input type="text" id="linkInput" class="form-control" placeholder="@lang('labels.frontend.course.enter_resources')" aria-label="Resource link" aria-describedby="button-addon2">
                    <div class="input-group-append">
                        <button class="btn btn-outline-secondary" type="button" id="addLinkBtn" style="background-color: #4f198d">+</button>
                    </div>
                </div>

                <!-- Container for displaying added links -->
                <div id="linksContainer"></div>

                <!-- Hidden input to store all links for form submission -->
                <input type="hidden" name="resourceLinks" id="resourceLinks">


            </div>
            <!-- <div class="row">
                <div class="col-12 form-group">
                    {!! Form::label('pdf_files', trans('labels.backend.lessons.fields.add_pdf_lesson'), ['class' => 'control-label']) !!}
                    {!! Form::file('add_pdf', [
                        'class' => 'form-control file-upload',
                         'id' => 'add_pdf',
                        'accept' => "application/pdf"

                        ]) !!}
                </div>
            </div> -->

            @if($course && $course->type_id == 1)
            <div class="row">
                <div class="col-12 form-group">
                    {!! Form::label('audio_files', trans('labels.backend.lessons.fields.add_audio'), ['class' => 'control-label']) !!}
                    {!! Form::file('add_audio', [
                        'class' => 'form-control file-upload',
                         'id' => 'add_audio',
                        'accept' => "audio/mpeg3"

                        ]) !!}
                </div>
            </div>
            @endif
            
            @if($course && $course->type_id == 2)
                <div class="row">
                    <div class="col-12 col-lg-12 form-group">
                        {!! Form::label('zoom_link',trans('labels.backend.lessons.fields.zoom_link'), ['class' => 'control-label']) !!}
                        {!! Form::text('zoom_link', old('zoom_link'), ['class' => 'form-control', 'placeholder' => trans('labels.backend.lessons.fields.zoom_link'),'required' => '']) !!}
                    </div>
                </div>
            @endif
            <div class="row">

            @if($course && $course->type_id == 1)
                <div class="col-md-12 form-group">
                    {!! Form::label('add_video', trans('labels.backend.lessons.fields.add_video'), ['class' => 'control-label']) !!}

                    {!! Form::select('media_type', ['youtube' => 'Youtube','vimeo' => 'Vimeo','upload' => 'Upload','embed' => 'Embed'],null,['class' => 'form-control', 'placeholder' => 'Select One','id'=>'media_type' ]) !!}

                    {!! Form::text('video', old('video'), ['class' => 'form-control mt-3 d-none', 'placeholder' => trans('labels.backend.lessons.enter_video_url'),'id'=>'video'  ]) !!}


                    {!! Form::file('video_file', ['class' => 'form-control mt-3 d-none', 'placeholder' => trans('labels.backend.lessons.enter_video_url'),'id'=>'video_file'  ]) !!}

                    @lang('labels.backend.lessons.video_guide')

                </div>
            @endif

            </div>

            <div class="row">

                <div class="col-12 col-lg-3 form-group">
                    <div class="checkbox">
                        {!! Form::hidden('published', 0) !!}
                        {!! Form::checkbox('published', 1, true, []) !!}
                        {!! Form::label('published', trans('labels.backend.lessons.fields.published'), ['class' => 'checkbox control-label font-weight-bold']) !!}
                    </div>
                </div>
                <div class="col-12  text-left form-group">
                    {!! Form::submit(trans('strings.backend.general.app_save'), ['class' => 'btn  btn-danger']) !!}
                </div>
            </div>
        </div>
    </div>

    {!! Form::close() !!}



@stop

@push('after-scripts')
    <script src="{{asset('plugins/bootstrap-tagsinput/bootstrap-tagsinput.js')}}"></script>
  
    <script>
        
        var uploadField = $('input[type="file"]');

        $(document).on('change', 'input[name="lesson_image"]', function () {
            var $this = $(this);
            $(this.files).each(function (key, value) {
                if (value.size > 5000000) {
                    alert('"' + value.name + '"' + 'exceeds limit of maximum file upload size')
                    $this.val("");
                }
            })
        });

        $(document).on('change', '#media_type', function () {
            if ($(this).val()) {
                if ($(this).val() != 'upload') {
                    $('#video').removeClass('d-none').attr('required', true)
                    $('#video_file').addClass('d-none').attr('required', false)
                } else if ($(this).val() == 'upload') {
                    $('#video').addClass('d-none').attr('required', false)
                    $('#video_file').removeClass('d-none').attr('required', true)
                }
            } else {
                $('#video_file').addClass('d-none').attr('required', false)
                $('#video').addClass('d-none').attr('required', false)
            }
        })

     
        $.ajaxSetup({
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            }
        });
        $(document).ready(function() {
           
        $(".js-example-placeholder-multiple").select2({
                placeholder: "{{trans('labels.backend.courses.fields.location')}}",
            });
            $('#course_id').on('change', function(e) {
                var course_id = e.target.value;
                $.ajax({
                    url: "{{ url('/user/get_chapter/') }}/"+course_id,
                    type: "GET",                   
                    success: function(data) {                                                
                         $('#chapter_id').empty();
                       
                        $.each(data.chapters, function(index,subcategory) {
                            console.log(data.chapters);

                            $('#chapter_id').append('<option value="' + index + '">' + subcategory + '</option>');
                        })
                                    
                        $("#chapter_id").select2("destroy");
                        $("#chapter_id").select2();     
                    }
                })
            });

            // ////

            $('#course_id').on('change', function(e) {
                var course_id = e.target.value;
                $.ajax({
                    url: "{{ url('/user/getCourseLoc/ajax/') }}/"+course_id,
                    type: "GET", 
                    dataType: "json",                  
                    success: function(data) {                                                
                        $('select[name="course_location_id[]"]').empty();
                        $.each(data, function(key, value) {
                            $('select[name="course_location_id[]"]').append('<option value="'+ key +'">'+ value +'</option>');
                        });   
                    }
                })
            });
        });

    </script>

    <script>
        document.getElementById('addLinkBtn').addEventListener('click', function() {
            const linkInput = document.getElementById('linkInput');
            const linksContainer = document.getElementById('linksContainer');
            const resourceLinksInput = document.getElementById('resourceLinks');

            const link = linkInput.value.trim();
            if (link) {
                // Create a container for the link and the remove button
                const linkWrapper = document.createElement('div');
                linkWrapper.classList.add('link-wrapper');

                // Create the link element
                const linkElement = document.createElement('span');
                linkElement.textContent = link;
                linkWrapper.appendChild(linkElement);

                // Create the remove button
                const removeBtn = document.createElement('button');
                removeBtn.textContent = 'X';
                removeBtn.classList.add('remove-link-btn');
                linkWrapper.appendChild(removeBtn);

                // Append the wrapper to the links container
                linksContainer.appendChild(linkWrapper);

                // Update the hidden input
                if (resourceLinksInput.value) {
                    resourceLinksInput.value += ',' + link;
                } else {
                    resourceLinksInput.value = link;
                }

                // Clear the input field
                linkInput.value = '';

                // Add event listener to the remove button
                removeBtn.addEventListener('click', function() {
                    // Remove the link from the hidden input
                    const linksArray = resourceLinksInput.value.split(',');
                    const linkIndex = linksArray.indexOf(link);
                    if (linkIndex > -1) {
                        linksArray.splice(linkIndex, 1);
                        resourceLinksInput.value = linksArray.join(',');
                    }
                    // Remove the link wrapper
                    linkWrapper.remove();
                });
            }
        });
    </script>

@endpush