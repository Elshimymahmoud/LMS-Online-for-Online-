@extends('backend.layouts.app')
@section('title', __('labels.backend.cert_templates.edit').' | '.app_name())
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

        .checkbox-wrapper-26 input[type="checkbox"]:checked+label {
            background-color: #6e0b25;
            box-shadow: 0 var(--shadow) #eee;
        }

        .checkbox-wrapper-26 input[type="checkbox"]:checked+label:before {
            width: 0;
            height: 0;
        }

        .checkbox-wrapper-26 input[type="checkbox"]:checked+label .tick_mark:before,
        .checkbox-wrapper-26 input[type="checkbox"]:checked+label .tick_mark:after {
            transform: translate(0);
            opacity: 1;
        }



        @media (min-width:776px) {
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

        .rate-title{
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
    <style>
        .content-creator {
            display: flex;
            flex-direction: row-reverse;
            align-items: center;
            gap: 10px;
        }

        .sub-contents {
            padding-top: 1rem;
        }

        .addSubContentBtn {
            padding: 8px 12px;
            background-color: #007bff;
            color: white;
            border: none;
            border-radius: 4px;
            cursor: pointer;
        }

        .removeSubContentBtn {
            padding: 1px 9px;
            background-color: #dc3545;
            color: white;
            border: none;
            border-radius: 4px;
            cursor: pointer;
            /* height: 19px; */
        }

        .removeMainContentBtn {
            padding: 8px 12px;
            background-color: #dc3545;
            color: white;
            border: none;
            border-radius: 4px;
            cursor: pointer;
        }

        #contentCardsContainer {
            display: flex;
            flex-wrap: wrap;
            align-items: center;
            gap: 10px;
        }

        #mainContentInput {
            flex-grow: 1;
            padding: 8px;
            border: 1px solid #ccc;
            border-radius: 4px;
        }

        #addContentBtn {
            padding: 8px 12px;
            background-color: #007bff;
            color: white;
            border: none;
            border-radius: 4px;
            cursor: pointer;
        }

        .content-card {
            background-color: #f9f9f9;
            border: 1px solid #ddd;
            border-radius: 4px;
            padding: 15px;
            margin-top: 10px;
        }

        .sub-content-input {
            display: flex;
            gap: 10px;
            margin-top: 10px;
        }
    </style>
@endpush
@section('content')

    {!! Form::model($cert_template, ['method' => 'PUT', 'route' => ['admin.certificates.templates.update'], 'files' => true,'enctype'=>"multipart/form-data"]) !!}

    <div class="card" style="      font-family: 'Cairo', sans-serif;">
        <div class="card-header">
            <h3 class="page-title float-left">@lang('labels.backend.cert_templates.edit')</h3>
            <div class="float-right" style="margin-right: 10px;">
                <a href="{{ route('admin.certificates.templates.index') }}" class="btn btn-primary">&#8592</a>
            </div>

        </div>

        <div class="card-body">

            <div class="form-group row">
                <div class="col-lg-6">
                    {!! Form::label('title_ar', trans('labels.backend.cert_templates.fields.title_ar')) !!}
                    {!! Form::text('title_ar', null, ['class' => 'form-control', 'placeholder' => 'Title']) !!}
                </div>
                <div class="col-lg-6">
                    {!! Form::label('title', trans('labels.backend.cert_templates.fields.title_en')) !!}
                    {!! Form::text('title', null, ['class' => 'form-control', 'placeholder' => 'Title']) !!}
                </div>
            </div>
            <div class="form-group">
                {!! Form::label('course_type', trans('labels.backend.cert_templates.fields.course_type')) !!}
                <select name="course_type" class="form-control">
                    @foreach($courseTypes as $key => $courseType)
                        <option value="{{ $key }}" {{ $cert_template->course_type == $key ? 'selected' : '' }}>
                            {{ $courseType }}
                        </option>
                    @endforeach
                </select>
            </div>
            <div class="form-group row">
                <div class="col-lg-6">
                    {!! Form::label('qr_width', trans('labels.backend.cert_templates.fields.qr_width')) !!}
                    {!! Form::number('qr_width', null, ['class' => 'form-control', 'placeholder' => 'QR Width']) !!}
                </div>
                <div class="col-lg-6">
                    {!! Form::label('qr_height', trans('labels.backend.cert_templates.fields.qr_height')) !!}
                    {!! Form::number('qr_height', null, ['class' => 'form-control', 'placeholder' => 'QR Height']) !!}
                </div>
            </div>
            <ul style="max-height: 12rem;  display: flex; flex-direction: column; flex-wrap: wrap;">
                <li><code>{name_ar}</code> - @lang('labels.backend.cert_templates.code.name_ar')</li>
                <li><code>{name}</code> - @lang('labels.backend.cert_templates.code.name')</li>
                <li><code>{national_id}</code> - @lang('labels.backend.cert_templates.code.national_id')</li>
                <li><code>{course_name_ar}</code> - @lang('labels.backend.cert_templates.code.course_name_ar')</li>
                <li><code>{course_name}</code> - @lang('labels.backend.cert_templates.code.course_name')</li>
                <li><code>{group_name_ar}</code> - @lang('labels.backend.cert_templates.code.group_name_ar')</li>
                <li><code>{group_name}</code> - @lang('labels.backend.cert_templates.code.group_name')</li>
                <li><code>{start_date}</code> - @lang('labels.backend.cert_templates.code.start_date')</li>
                <li><code>{end_date}</code> - @lang('labels.backend.cert_templates.code.end_date')</li>
                <li><code>{hours}</code> - @lang('labels.backend.cert_templates.code.hours')</li>
                <li><code>{certificate_number}</code> - @lang('labels.backend.cert_templates.code.certificate_number')</li>
                <li><code>{accreditation_number}</code> - @lang('labels.backend.cert_templates.code.accreditation_number')</li>
                <li><code>{issued_date}</code> - @lang('labels.backend.cert_templates.code.issued_date')</li>
                <li><code>{qr_code}</code> - @lang('labels.backend.cert_templates.code.qr_code')</li>
                <li><code>{location}</code> - @lang('labels.backend.cert_templates.code.location')</li>
                <li><code>{location_ar}</code> - @lang('labels.backend.cert_templates.code.location_ar')</li>
            </ul>
            <div class="form-group">
                {!! Form::label('template_content', trans('labels.backend.cert_templates.fields.template_content')) !!}
{{--                {!! Form::textarea('template_content', old('template'), ['class' => 'form-control editor', 'rows' => 3,--}}
{{--                'placeholder' => '']) !!}--}}
                <textarea name="template_content" id="template_content" class="form-control editor" rows="3" placeholder="">{{ $cert_template->content }}</textarea>
            </div>

            <div class="form-group">
                {!! Form::label('bg_image', trans('labels.backend.cert_templates.fields.bg_image')) !!}
                {!! Form::file('bg_image', ['class' => 'form-control-file']) !!}
            </div>
            <div class="form-group">
                <img src="{{ asset('storage/uploads/certificate_templates/' . $cert_template->bg_image) }}"
                     width="250px" height="250px">
            </div>

            {!! Form::hidden('template_id', $cert_template->id) !!}
            <button type="submit" class="btn btn-primary">@lang('strings.backend.general.app_update')</button>
        </div>
    </div>
    {!! Form::close() !!}


@stop

@push('after-scripts')
    <script>
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