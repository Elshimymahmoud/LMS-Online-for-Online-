@extends('backend.layouts.app')
@section('title', __('labels.backend.courses.title') . ' | ' . app_name())

@push('after-styles')
    <style>
        .rate-title {
            color: #802d42;
            font-weight: bold;
            padding: 5px;
            border-bottom: 1px solid;
            margin-bottom: 17px;

        }

        label {
            font-size: 14px;
            line-height: 22px;
            padding: 5px;
            font-weight: 600;
        }


        select option:hover {
            background-color: #6e0b25;
            color: #fff;
        }

        /* span {
          color: #6e0b25;
        } */

        .craete-title {
            display: flex;
            justify-content: space-between;
            align-items: center;
            border-bottom: 2px solid #E6E9ED;
            padding: 10px 0;
            margin-bottom: 20px;
        }

        label.two {
            display: flex !important;
            align-items: center;
        }

        label.two b {
            margin: auto 5px;
            line-height: 28px;
        }

        .craete-title h3 {
            font-size: 20px;
            line-height: 28px;
            font-weight: 700;
        }

        body {
            background-color: #F7F7F7;
            font-family: 'Cairo', sans-serif;
        }

        #createbtn {
            text-decoration: none;
            color: #000;
            background-color: #6e0b25;
            display: block;
            padding: 8px 10px;
            color: #ffffff;
            border-radius: 4px;
            height: 40px;
            text-align: center;
            max-width: 150px;
            min-width: 100px;
            width: 150px;
            font-size: 14px;
            margin-top: 10px;
            margin-bottom: 10px;
            display: block;
            margin: 10px;

        }

        #createbtn.twobtn {
            margin: 10px auto;
        }

        .custom-select {
            position: relative;

        }

        .custom-select select {
            appearance: none;
            -webkit-appearance: none;
            -moz-appearance: none;
            padding: 10px;
            border: 1px solid #ccc;
            cursor: pointer;
        }

        .custom-select:after {
            content: '\25BC';
            position: absolute;
            top: 75%;
            left: 10px;
            transform: translateY(-50%);

            font-size: 12px;
            height: 16px;
            color: rgb(0, 0, 0, .6);

        }

        .two-part .custom-select:after {
            top: 55%;
        }

        input,
        select,
        textarea {
            font-size: 12px;
            line-height: 22px;
        }

        .form-btn {
            background-color: #6e0b25;
            color: #fff;
            display: inline-block;
            margin: auto;
            min-width: 200px;
            line-height: 28px;
            margin: 5px;
        }

        .dropdown {
            position: relative;
            display: block;
            width: 100%;
            font-size: 16px;
            border: none !important;
            line-height: 28px;
            outline: none !important;

        }

        .dropdown button {
            outline: none !important;
            border: none !important;
            width: 100%;
            padding: 6px 10px;
            text-align: start;
            /* background-color: #6e0b25; */
            /* color: #fff; */
            margin: 5px auto;
            border-radius: 4px;

        }

        .dropdown.open .dropdown-toggle:focus {
            outline: none !important;
            border: none !important;
        }

        .dropdown-content {
            display: none;
            position: absolute;
            background-color: #f9f9f9;
            min-width: 160px;
            border: 1px solid #ccc;
            border-radius: 4px;
            z-index: 1;
        }

        .dropdown-content label {
            display: block;
            padding: 8px;
            cursor: pointer;
        }

        .dropdown-content label:hover {
            background-color: #ddd;
        }

        .dropdown.open .dropdown-content {
            display: block;
            width: 100%;
            margin-left: 10px;
        }

        .dropdown-toggle::after {
            position: absolute;
            top: 50%;
            left: 10px;
        }


        .checkbox-wrapper-26 * {
            -webkit-tap-highlight-color: transparent;
            outline: none;
        }

        .checkbox-wrapper-26 input[type="checkbox"] {
            display: none;
        }

        .checkbox-wrapper-26 label {
            --size: 15px;
            height: 15px;
            --shadow: calc(var(--size) * .07) calc(var(--size) * .1);

            position: relative;
            display: block;
            width: 10px !important;

            margin: 0 auto;
            background-color: #6e0b25;
            border-radius: 50%;
            box-shadow: 0 var(--shadow) #ffbeb8;
            cursor: pointer;
            transition: 0.2s ease transform, 0.2s ease background-color,
            0.2s ease box-shadow;
            overflow: hidden;
            z-index: 1;
            text-align: center;
        }

        .checkbox-wrapper-26 label:before {
            content: "";
            position: absolute;
            top: 50%;
            right: 0;
            left: 0;
            width: calc(var(--size) * .7);
            height: calc(var(--size) * .7);
            margin: 0 auto;
            background-color: #fff;
            transform: translateY(-50%);
            border-radius: 50%;
            box-shadow: inset 0 var(--shadow) #ffbeb8;
            transition: 0.2s ease width, 0.2s ease height;
        }

        .checkbox-wrapper-26 label:hover:before {
            width: calc(var(--size) * .55);
            height: calc(var(--size) * .55);
            box-shadow: inset 0 var(--shadow) #ff9d96;
        }

        .checkbox-wrapper-26 label:active {
            transform: scale(0.9);
        }

        .checkbox-wrapper-26 .tick_mark {
            position: absolute;
            top: 0px;
            right: 1px;
            left: 0px;
            width: 8px;
            height: 10px;
            margin: 0 auto;
            margin-left: calc(var(--size) * .14);
            transform: rotateZ(-40deg);
        }

        .checkbox-wrapper-26 .tick_mark:before,
        .checkbox-wrapper-26 .tick_mark:after {
            content: "";
            position: absolute;
            background-color: #fff;
            border-radius: 2px;
            opacity: 0;
            transition: 0.2s ease transform, 0.2s ease opacity;
        }

        .checkbox-wrapper-26 .tick_mark:before {
            left: 0;
            bottom: 0;
            width: calc(var(--size) * .1);
            height: calc(var(--size) * .3);
            box-shadow: -2px 0 5px rgba(0, 0, 0, 0.23);
            transform: translateY(calc(var(--size) * -.68));
        }

        .checkbox-wrapper-26 .tick_mark:after {
            left: 0;
            bottom: 0;
            width: 100%;
            height: calc(var(--size) * .1);
            box-shadow: 0 3px 5px rgba(0, 0, 0, 0.23);
            transform: translateX(calc(var(--size) * .78));
        }

        .checkbox-wrapper-26 input[type="checkbox"]:checked + label {
            background-color: #6e0b25;
            box-shadow: 0 var(--shadow) #eee;
        }

        .checkbox-wrapper-26 input[type="checkbox"]:checked + label:before {
            width: 0;
            height: 0;
        }

        .checkbox-wrapper-26 input[type="checkbox"]:checked + label .tick_mark:before,
        .checkbox-wrapper-26 input[type="checkbox"]:checked + label .tick_mark:after {
            transform: translate(0);
            opacity: 1;
        }


        @media (min-width: 776px) {
            .two-part {
                display: flex;
                justify-content: space-between;
                flex-direction: row;
            }

            #createbtn {
                margin: 0 10px;
            }

            #createbtn.twobtn {
                margin: 0 10px;
            }


        }

        .rate-title {
            margin-bottom: 1px !important;
        }

        /* @media (min-width:992px) {
          .dropdown {
            display: inline-block;
            width: 49.8%;
            margin: auto;


          }
        } */
    </style>
@endpush
@section('content')

    {!! Form::model($group, ['method' => 'POST', 'route' => ['admin.group.update', $group->id], 'files' => true,'enctype'=>"multipart/form-data"]) !!}
    @csrf
    <div class="card">
        <div class="card-header">
            <h3 class="page-title float-left mb-0">@lang('labels.backend.courses.fields.group_edit')</h3>
            <div class="float-right" style="margin-right: 10px;">
                <a href="{{ route('admin.groups.index') }}"
                   class="btn btn-primary">&#8592</a>
            </div>
            <!-- <div class="float-right">
                <a href="{{ route('admin.courses.index') }}"
                    class="btn btn-success">@lang('labels.backend.groups.view')</a>
            </div> -->
        </div>

        <div class="card-body">

            {{-- @if (Auth::user()->isAdmin())
                <div class="row">

                    <div class="col-10 form-group">
                        {!! Form::label('teachers', trans('labels.backend.courses.fields.teachers'), ['class' => 'control-label']) !!}
                        {!! Form::select('teachers[]', $teachers, old('teachers') ? old('teachers') : $course->teachers->pluck('id')->toArray(), ['class' => 'form-control select2', 'multiple' => 'multiple', 'required' => true]) !!}
                    </div>
                    <div class="col-2 d-flex form-group flex-column">
                        OR <a target="_blank" class="btn btn-primary mt-auto"
                            href="{{ route('admin.teachers.create') }}">{{ trans('labels.backend.courses.add_teachers') }}</a>
                    </div>
                </div>
            @endif --}}

            <div class="row">

                <div class="col-12 col-lg-12 form-group">
                    {!! Form::label('title_ar', trans('labels.backend.courses.fields.title_ar') . ' *', ['class' => 'control-label']) !!}
                    {!! Form::text('title_ar', old('title_ar'), ['class' => 'form-control', 'placeholder' => '', 'required' => 'true']) !!}
                </div>
                <div class="col-12 col-lg-12 form-group">
                    {!! Form::label('title_en', trans('labels.backend.courses.fields.title') . ' *', ['class' => 'control-label']) !!}
                    {!! Form::text('title_en', old('title'), ['class' => 'form-control', 'placeholder' => '', 'required' => 'true']) !!}
                </div>
                <div class="col-12 col-lg-12 form-group">
                    {!! Form::label('description_ar', trans('labels.backend.courses.fields.short_description_ar') . ' * <span class="small_note">' . trans('labels.backend.courses.fields.short_description_note') . '</span>', ['class' => 'control-label'], false) !!}
                    {!! Form::textarea('description_ar', old('short_description_ar'), ['class' => 'form-control', 'rows' => 3, 'placeholder' => '']) !!}
                </div>

                <div class="col-12 col-lg-12 form-group">
               <span>
                   {!! Form::hidden('short_desc_in_certificate', 0) !!}
                   {{--                        {!! Form::checkbox('short_desc_in_certificate', 1, old('short_desc_in_certificate'), []) !!}--}}
                   {{-- <input type="checkbox"  {{$course->short_desc_in_certificate==1? 'checked': ''}} name="short_desc_in_certificate" id=""> --}}
               </span>
                    {!! Form::label('description_en', trans('labels.backend.courses.fields.short_description') . ' * <span class="small_note">' . trans('labels.backend.courses.fields.short_description_note') . '</span>', ['class' => 'control-label'], false) !!}
                    {!! Form::textarea('description_en', old('short_description'), ['class' => 'form-control', 'rows' => 3, 'placeholder' => '']) !!}
                </div>
            </div>

            <div class="row">
                <div class="col-12 form-group">
                    {!! Form::label('type_id',trans('labels.backend.courses.fields.type'), ['class' => 'control-label']) !!}
                    {!! Form::select('type_id', $types, old('type_id'), ['class' => 'form-control select2 js-example-placeholder-single', 'multiple' => false, 'required' => true]) !!}
                </div>
            </div>
            <div class="col-12 form-group">
                {!! Form::label('teachers',trans('labels.backend.courses.fields.teachers'), ['class' => 'control-label']) !!}
                {!! Form::select('teachers[0][]', $teachers->pluck('name'), old('name'), ['class' => 'form-control select2 js-example-placeholder-multiple', 'multiple' => 'multiple', 'required' => true]) !!}
            </div>

            <div class="col-12 form-group">
                {!! Form::label('students',trans('labels.backend.courses.fields.students'), ['class' => 'control-label']) !!}
                {!! Form::select('students[0][]', $students->pluck('first_name'), old('first_name'), ['class' => 'form-control select2 js-example-placeholder-multiple-student', 'multiple' => 'multiple', 'required' => true]) !!}
            </div>
            <div class="row">
                <div class="col-12 form-group">
                    {!! Form::label('coordinators',trans('labels.backend.coordinator.title'), ['class' => 'control-label']) !!}
                    {!! Form::select('coordinator[0][]', $coordinators->pluck('name'), old('name'), ['class' => 'form-control select2 js-example-placeholder-multiple-coord', 'multiple' => 'multiple', 'required' => true]) !!}
                </div>
            </div>
            <div class="row">
                @if ($group->image)
                    <a href="{{ asset('storage/uploads/' . $group->image) }}" target="_blank"><img
                                height="50px" src="{{ asset('storage/uploads/' . $group->image) }}"
                                alt="Course's photo"
                                class="mt-1"></a>
                @endif
                <div class="col-12 col-lg-12 form-group">

                    {!! Form::label('course_image', trans('labels.backend.courses.fields.course_image'), ['class' => 'control-label', 'accept' => 'image/jpeg,image/gif,image/png']) !!}
                    {!! Form::file('course_image', ['class' => 'form-control']) !!}
                    {!! Form::hidden('course_image_max_size', 8) !!}
                    {!! Form::hidden('course_image_max_width', 4000) !!}
                    {!! Form::hidden('course_image_max_height', 4000) !!}

                </div>

            </div>

            <div class="row">
                <div class="col-12  text-center form-group">
                    {!! Form::submit(trans('strings.backend.general.app_update'), ['class' => 'btn btn-danger']) !!}
                </div>
            </div>
        </div>
    </div>

    {!! Form::close() !!}
@stop

@push('after-scripts')
    <script>
        $(document).ready(function () {
            $('#start_date').datepicker({
                autoclose: true,
                dateFormat: "{{ config('app.date_format_js') }}"
            });
            $('#end_date').datepicker({
                autoclose: true,
                dateFormat: "{{ config('app.date_format_js') }}"
            });
            $(".js-example-placeholder-single").select2({
                placeholder: "{{trans('labels.backend.courses.select_category')}}",
            });

            $(".js-example-placeholder-multiple").select2({
                placeholder: "{{trans('labels.backend.courses.select_teachers')}}",
            });
        });

        var uploadField = $('input[type="file"]');

        $(document).on('change', 'input[type="file"]', function() {
            var $this = $(this);
            $(this.files).each(function(key, value) {
                if (value.size > 5000000) {
                    alert('"' + value.name + '"' + 'exceeds limit of maximum file upload size')
                    $this.val("");
                }
            })
        })


        $(document).on('change', '#media_type', function() {
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

        document.addEventListener("DOMContentLoaded", function() {
            var dropdowns = document.querySelectorAll(".dropdown");
            dropdowns.forEach(function(dropdown) {
                dropdown.addEventListener("click", function() {
                    this.classList.toggle("open");
                });


                window.addEventListener("click", function(event) {
                    if (!dropdown.contains(event.target)) {
                        dropdown.classList.remove("open");
                    }
                });
            });
        });
    </script>

@endpush
