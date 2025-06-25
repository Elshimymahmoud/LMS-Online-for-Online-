@extends('backend.layouts.app')
@section('title', __('labels.backend.group.edit').' | '.app_name())
@push('after-styles')
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

        .link-wrapper span{
            display: flex;
            flex-direction: row;
            gap: 10px;
        }

        .remove-link-btn {
            border: none;
            background-color: #4f198d;
            color: white;
            cursor: pointer;
            padding: 2px 6px;
            border-radius: 50%;
        }
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
        .flex-row {
            display: flex;
            justify-content: flex-start;
            align-items: center;
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
@endpush
@section('content')

    {!! Form::open( ['method' => 'PUT', 'route' => ['admin.groups.update', $group->id], 'files' => true,'enctype'=>"multipart/form-data"]) !!}
        {{ method_field('PUT') }}
    <div class="card" style="      font-family: 'Cairo', sans-serif;">
        <div class="card-header">
            <h3 class="page-title float-left">@lang('labels.backend.group.edit')</h3>
            <div class="float-right" style="margin-right: 10px;">
                <a href="{{ route('admin.groups.index') }}" class="btn btn-primary">&#8592</a>
            </div>
        </div>

        <div class="card-body">

            {{--Course--}}
            <div class="form-group">
                {!! Form::label('course_group_image', trans('labels.backend.courses.course-title'), ['class' => 'control-label']) !!}

                <select name="course_id" id="course_id" class="form-control">
                        @foreach($courses as $key => $courseName)
                            <option value="{{ $key }}" {{ $key == $course->id ? 'selected' : '' }}>{{ $courseName }}</option>
                        @endforeach
                </select>
            </div>

            <div class="form-group">
                {!! Form::label('description_ar',trans('labels.backend.courses.fields.description_ar'), ['class' => 'control-label']) !!}
                <textarea class="form-control" name="description_ar" id="course_description_ar"  rows="5" required>
                    {{ $group->description_ar }}
                </textarea>
            </div>

            <div class="form-group">
                {!! Form::label('description_en', trans('labels.backend.courses.fields.description'), ['class' => 'control-label']) !!}
                <textarea class="form-control" name="description_en" id="course_description"  rows="5" required>
                    {{ $group->description_en }}
                </textarea>
            </div>


            <div class="form-group">
                {!! Form::label('type_id',trans('labels.backend.courses.fields.type'), ['class' => 'control-label']) !!}
                <select class="form-control select2" name="type" disabled required>
                    <option value="">@lang('labels.backend.group.fields.type_choose')</option>
                    @foreach($types as $index => $type)
                        <option value="{{ $index }}" {{ $course->type_id == $index ? 'selected' : '' }}>
                            {{ $type}}
                        </option>
                    @endforeach
                </select>
            </div>
            @if ($course->type_id != 1)
                <div class="form-group">
                    {!! Form::label('location2', trans('labels.backend.hall.fields.city').' *', ['class' => 'control-label']) !!}<br>
                    <select name="location2" id="location2" class="form-control">
                        @foreach($locations as $index => $location)
                            <option value="{{ $index }}" {{ $group->location_id == $index ? 'selected' : '' }}>
                                {{ $location }}
                            </option>
                        @endforeach
                    </select>
                </div>
                @if ($course->type_id == 3)
                    <div class="form-group">
                        {!! Form::label('location', trans('labels.backend.hall.name').' *', ['class' => 'control-label']) !!}<br>
                        <select name="location" id="location" class="form-control">
                            <option value="{{ $hall[0]->id }}"> {{ $hall[0]->name }} </option>
                        </select>
                    </div>
               @endif
            @endif


            {{-- Resources --}}
            <div class="form-group">
                {!! Form::label('linksContainer', trans('labels.frontend.course.resources'), ['class' => 'control-label']) !!}

                <div class="input-group mb-3" style="display: flex; flex-direction: row-reverse; gap: 10px;">
                    <input type="text" id="linkInput" class="form-control" placeholder="@lang('labels.frontend.course.enter_resources')" aria-label="Resource Link">
                    <input type="text" id="linkTitleInput" class="form-control" placeholder="@lang('labels.frontend.course.enter_resource_title')" aria-label="Resource Title">
                    <div class="input-group-append">
                        <button class="btn btn-outline-secondary" type="button" id="addLinkBtn" style="background-color: #4f198d">+</button>
                    </div>
                </div>

                <div id="linksContainer">
                    @foreach($group->resources as $resource)
                        <div class="link-wrapper">
                            <span>{{ $resource->link }}</span>
                            <button class="btn btn-danger remove-link-btn" type="button" data-resource-id="{{
                            $resource->id }}" style="background-color: #4f198d">X</button>
                        </div>
                    @endforeach
                </div>
                <input type="hidden" name="resourceLinks" id="resourceLinks" value="@foreach($group->resources as $resource){{ $loop->last ? $resource->title . '|' . $resource->link : $resource->title . '|' . $resource->link . ',' }}@endforeach">
            </div>



            <div class="form-group">
                {!! Form::label('title_ar', trans('labels.backend.courses.fields.price').' *', ['class' => 'control-label']) !!}
                <input class="form-control" name="price" type="number" value="{{ $group->price }}">
            </div>
            <div class="form-group">
                {!! Form::label('title_ar', trans('labels.backend.courses.fields.group_title_ar').' *', ['class' => 'control-label']) !!}
                <input class="form-control" name="title_ar" type="text" value="{{ $group->title_ar }}">
            </div>
            <div class="form-group">
                {!! Form::label('title', trans('labels.backend.courses.fields.group_title_en').' *', ['class' => 'control-label']) !!}
                <input class="form-control" name="title_en" type="text" value="{{ $group->title_en }}">
            </div>

                <div class="flex-row" id="date-container">
                    <div class="form-group{{ $errors->has('from_datetime') ? ' has-error' : '' }}">
                        {!! Form::label('from',trans('labels.backend.courses.fields.from'), ['class' => 'control-label']) !!}

                        <div class="col-md-12">
                            <input type="datetime-local" value="{{ $group->start }}" id="date" name="from_datetime" class="form-control col-md-10 col-xs-12 w-100">
                            @if ($errors->has('from_datetime'))
                                <span class="help-block">{{ $errors->first('from_datetime') }}</span>
                            @endif
                        </div>
                    </div>

                    <div class="form-group{{ $errors->has('to_datetime') ? ' has-error' : '' }}">
                        {!! Form::label('to',trans('labels.backend.courses.fields.to'), ['class' => 'control-label']) !!}

                        <div class="col-md-12">
                            <input type="datetime-local" value="{{ $group->end }}" id="date" name="to_datetime" class="form-control col-md-10 col-xs-12">
                            @if ($errors->has('to_datetime'))
                                <span class="help-block">{{ $errors->first('to_datetime') }}</span>
                            @endif
                        </div>
                    </div>

                </div>


            <div class="col-12 form-group">
                {!! Form::label('coordinators[0][]',trans('labels.backend.coordinator.title'), ['class' => 'control-label']) !!}
                <select name="coordinators[0][]" class="form-control select2 js-example-placeholder-multiple-coord" multiple="multiple">
                    @foreach($coordinators as $coordinator)
                        <option value="{{ $coordinator }}" {{ in_array($coordinator, $group->coordinators->pluck('name_ar')->toArray()) ? 'selected' : '' }}>
                            {{ $coordinator }}
                        </option>
                    @endforeach
                </select>
            </div>

            <div class="col-12 form-group">
                {!! Form::label('teachers',trans('labels.backend.courses.fields.teachers'), ['class' => 'control-label']) !!}
                <select name="teachers[0][]" class="form-control select2 js-example-placeholder-multiple-coord" multiple>
                    @foreach($teachers as $teacher)
                        <option value="{{ $teacher->id }}" {{ in_array($teacher->id, $group->teachers->pluck('id')->toArray()) ? 'selected' : '' }}>
                            {{ $teacher->name }}
                        </option>
                    @endforeach
                </select>

            </div>

            <div class="col-12 form-group">
                {!! Form::label('students[0][]',trans('labels.backend.courses.fields.students'), ['class' => 'control-label']) !!}
                <select name="students[0][]" class="form-control select2 js-example-placeholder-multiple-coord" multiple>
                    @foreach($students as $student)
                        <option value="{{ $student->id }}" {{ in_array($student->id, $group->students->pluck('id')->toArray()) ? 'selected' : '' }}>
                            {{ app()->isLocale('ar') ? $student->full_name_ar : $student->full_name }}
                    @endforeach
                </select>
            </div>
{{--            <div class="col-12 form-group">--}}
{{--                {!! Form::label('tests[0][]', trans('labels.backend.tests.title'), ['class' => 'control-label']) !!}--}}
{{--                <select name="tests[0][]" class="form-control select2 js-example-placeholder-multiple-coord" multiple>--}}
{{--                    @foreach($tests as $test)--}}
{{--                        <option value="{{ $test->id }}" {{ in_array($test->id, $group->tests->pluck('id')->toArray()) ? 'selected' : '' }}>--}}
{{--                            {{ $test->title }}--}}
{{--                        </option>--}}
{{--                    @endforeach--}}
{{--                </select>--}}
{{--            </div>--}}

            <div class="col-12 form-group">
                {!! Form::label('clients[0][]',trans('labels.backend.courses.fields.client'), ['class' => 'control-label']) !!}
                <select name="clients[0][]" class="form-control select2 js-example-placeholder-multiple-coord" multiple>
                    @foreach( $clients as $client)
                        <option value="{{ $client }}" {{ in_array($client, $group->clients->pluck('name_ar')->toArray()) ? 'selected' : '' }}>
                            {{ $client }}
                        </option>
                    @endforeach
                </select>
            </div>

            <div class="col-12 form-group">
                {!! Form::label('impacts',trans('labels.backend.impact.title'), ['class' => 'control-label']) !!}
                <select name="impacts[0][]" class="form-control select2 js-example-placeholder-multiple-coord" multiple>
                    @foreach($impacts as $impact)
                        <option value="{{ $impact->id }}" {{ in_array($impact->id, $group->impacts->pluck('id')->toArray()) ? 'selected' : '' }}>
                            {{ $impact->impact }}
                        </option>
                    @endforeach
                </select>
            </div>
            <div class="col-12 form-group">
                {!! Form::label('rates',trans('labels.backend.rates.fields.rateStudent'), ['class' => 'control-label']) !!}
                <select name="rates[0][]" class="form-control select2 js-example-placeholder-multiple-coord" multiple required>
                    @foreach($rates as $rate)
                        <option value="{{ $rate->id }}" {{ in_array($rate->id, $group->rates->pluck('id')->toArray()) ? 'selected' : '' }}>
                            {{ (app()->getLocale() == 'ar') ? $rate->title : $rate->title }}
                        </option>
                    @endforeach
                </select>
            </div>
            <div class="col-12 form-group">
                {!! Form::label('rateTeacher',trans('labels.backend.rates.fields.teacher_rate_student'), ['class' => 'control-label'])!!}
                <select name="rateTeacher[0][]" class="form-control select2 js-example-placeholder-multiple-coord"
                        multiple required>
                    @foreach($rateTeacher as $rate)
                        <option value="{{ $rate->id }}" {{ in_array($rate->id, $group->rates->pluck('id')->toArray()) ? 'selected' : '' }}>
                            {{ (app()->getLocale() == 'ar') ? $rate->title : $rate->title }}
                        </option>
                    @endforeach
                </select>
            </div>
            <div class="col-12 form-group">
                {!! Form::label('reccomendations',trans('labels.backend.programRec.title'), ['class' => 'control-label']) !!}
                <select name="reccomendations[0][]" class="form-control select2 js-example-placeholder-multiple-coord" multiple>

                    @foreach($reccomendations as $reccomendation)
                        <option value="{{ $reccomendation->id }}" {{ in_array($reccomendation->id, $group->reccomendations->pluck('id')->toArray()) ? 'selected' : '' }}>
                            {{ $reccomendation->recommendation }}
                        </option>
                    @endforeach
                </select>
            </div>
            <div class="col-12 form-group">
                {!! Form::label('cert_templates',trans('labels.backend.cert_templates.add'), ['class' =>
                'control-label']) !!}
                <select name="cert_templates" class="form-control" required>

                    @foreach($cert_templates as $key => $cert_template)
                        <option value="{{ $key }}" {{ $group->cert_template &&$key == $group->cert_template->id ? 'selected' : '' }}>
                            {{ $cert_template }}
                        </option>
                    @endforeach
                </select>
            </div>



            {{--Image--}}
            <div class="row">
                <div class="form-group">
                    {!! Form::label('course_group_image', trans('labels.backend.courses.fields.course_group_image'), ['class' => 'control-label']) !!}
                    @if($group->image)
                        <img src="{{ asset('storage/uploads/'.$group->image) }}" alt="Group Image" style="width: 100px; height: 100px;">
                    @else
                        <span class="label label-danger">@lang('labels.general.none')</span>
                    @endif
                    <input type="file" name="image" id="image" class="form-control-file">
                </div>
            </div>


            <div class="row">
                <div class="col-12  text-center form-group">
                    {!! Form::submit(trans('strings.backend.general.app_save'), ['class' => 'btn btn-lg btn-danger']) !!}
                </div>
            </div>
        </div>
    </div>
    </div>
    {!! Form::close() !!}

    <input type="hidden" id="course_type">

@stop

@push('after-scripts')
    <script>
        $(document).ready(function() {
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
            $(".js-example-placeholder-multiple-coord").select2({
                placeholder: "{{ trans('labels.backend.courses.select_coord') }}",
            });
            $(".js-example-placeholder-multiple-student").select2({
                placeholder: "{{ trans('labels.backend.courses.select_students') }}",
            });
            $(".js-example-placeholder-multiple-client").select2({
                placeholder: "{{ trans('labels.backend.courses.select_clients') }}",
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
    <script>
        document.getElementById('addLinkBtn').addEventListener('click', function() {
            const linkTitleInput = document.getElementById('linkTitleInput');
            const linkInput = document.getElementById('linkInput');
            const linksContainer = document.getElementById('linksContainer');
            const resourceLinksInput = document.getElementById('resourceLinks');

            const title = linkTitleInput.value.trim();
            const link = linkInput.value.trim();
            if (title && link) {
                // Create a container for the title, link, and the remove button
                const linkWrapper = document.createElement('div');
                linkWrapper.classList.add('link-wrapper');

                // Create the title element
                const titleElement = document.createElement('span');
                titleElement.innerHTML = `${title}: <a href="${link}" target="_blank">${link}</a>`;
                linkWrapper.appendChild(titleElement);


                const removeBtn = document.createElement('button');
                removeBtn.textContent = 'X';
                removeBtn.classList.add('remove-link-btn');
                linkWrapper.appendChild(removeBtn);

                linksContainer.appendChild(linkWrapper);

                const resource = `${title}|${link}`;
                if (resourceLinksInput.value) {
                    resourceLinksInput.value += ',' + resource;
                } else {
                    resourceLinksInput.value = resource;
                }

                linkTitleInput.value = '';
                linkInput.value = '';

                removeBtn.addEventListener('click', function() {
                    const resourcesArray = resourceLinksInput.value.split(',');
                    const resourceIndex = resourcesArray.indexOf(resource);
                    if (resourceIndex > -1) {
                        resourcesArray.splice(resourceIndex, 1);
                        resourceLinksInput.value = resourcesArray.join(',');
                    }
                    linkWrapper.remove();
                });
            }
        })
    </script>
    <script>
        // Function to strip HTML tags from a string
        function stripHtmlTags(html) {
            var doc = new DOMParser().parseFromString(html, 'text/html');
            return doc.body.textContent || "";
        }
        document.getElementById('course_id').addEventListener('change', function () {
            var courseId = this.value;
            var locationSelect2 = document.getElementById('location2');
            var locationSelect = document.getElementById('location');
            var defaultOption = document.createElement('option');
            if (courseId !== '') {
                var url = '/user/courses/' + courseId + '/description';
                fetch(url)
                    .then(response => response.json()) // Parse JSON response
                    .then(data => {
                        console.log("Response Data:", data);
                        locationSelect2.innerHTML = ''; // Clear existing options

                        var strippedDataEn = stripHtmlTags(data.description); // Assuming English description key is 'description'
                        var strippedDataAr = stripHtmlTags(data.description_ar); // Assuming Arabic description key is 'description_ar'
                        var strippedDataType = stripHtmlTags(data.course_type); // Assuming Arabic description key is 'course_type'

                        document.getElementById('course_description').innerText = strippedDataEn;
                        document.getElementById('course_description_ar').innerText = strippedDataAr;
                        document.getElementById('course_type').innerText = strippedDataType;
                        if(data.locations){
                            console.log("Locations:", data.locations);
                            // defaultOption.textContent = 'select a location';
                            // locationSelect2.appendChild(defaultOption);
                            locationSelect2.parentNode.style.display='block';
                            @if ($course->type_id == 3)
                                locationSelect.parentNode.style.display='block';
                                if(data.course_type == 'Live Online Training'){
                                    locationSelect.parentNode.style.display='none';
                                    //change locationSelect2 label
                                    document.querySelector('label[for="location2"]').textContent = '@lang('labels.backend.hall.fields.select_app')';
                                }
                            @endif

                            if(data.course_type == 'Online Training'){
                                locationSelect2.parentNode.style.display='none';
                                @if ($course->type_id == 3)
                                    locationSelect.parentNode.style.display='none';
                                @endif
                                //add warning span to div with id date-container
                                var dateContainer = document.getElementById('date-container');
                                var warningSpan = document.createElement('span');
                                warningSpan.textContent = '@lang('labels.backend.group.online_notification')';
                                warningSpan.style.color = 'red';
                                dateContainer.appendChild(warningSpan);
                            }else{
                                Object.entries(data.locations).forEach(([key, value]) => {
                                    var option = document.createElement('option');
                                    option.value = key; // location id
                                    option.textContent = value; // location name
                                    locationSelect2.appendChild(option);
                                });
                            }
                        } else {
                            defaultOption.textContent = 'No locations available';
                            locationSelect2.appendChild(defaultOption);
                        }

                        if(data.resources){
                            console.log("resources:", data.resources);
                            const linksContainer = document.getElementById('linksContainer');
                            const resourceLinksInput = document.getElementById('resourceLinks');
                            linksContainer.innerHTML = ''; // Clear existing links
                            resourceLinksInput.value = ''; // Clear hidden input

                            data.resources.forEach(function(resource) {
                                // Create a container for the resource and the remove button
                                const linkWrapper = document.createElement('div');
                                linkWrapper.classList.add('link-wrapper');

                                // Create the resource element
                                const linkElement = document.createElement('span');
                                linkElement.textContent = resource;
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
                                    resourceLinksInput.value += ',' + resource;
                                } else {
                                    resourceLinksInput.value = resource;
                                }


                                // Add event listener to the remove button
                                removeBtn.addEventListener('click', function() {
                                    // Remove the resource from the hidden input
                                    const linksArray = resourceLinksInput.value.split(',');
                                    const linkIndex = linksArray.indexOf(resource);
                                    if (linkIndex > -1) {
                                        linksArray.splice(linkIndex, 1);
                                        resourceLinksInput.value = linksArray.join(',');
                                    }
                                    // Remove the resource wrapper
                                    linkWrapper.remove();
                                });
                                console.log(resource);
                            });

                        }

                    })
                    .catch(error => console.error('Error:', error));
            } else {
                document.getElementById('course_description').innerText = 'Select a course to see its description.';
                document.getElementById('course_description_ar').innerText = 'Select a course to see its description_ar.';
                document.getElementById('course_type').innerText = 'Select a course to see its Type.';
                locationSelect2.innerHTML = ''; // Clear options if no course is selected

                defaultOption.textContent = 'Select a course to see its locations';
                locationSelect2.appendChild(defaultOption);
            }

        });
        document.getElementById('location2').addEventListener('change', function () {
            var locationId = this.value;
            var locationSelect = document.getElementById('location');
            var defaultOption = document.createElement('option');
            if (locationId !== '') {
                var url = '/user/courses/' + locationId + '/hall';
                fetch(url)
                    .then(response => response.json()) // Parse JSON response
                    .then(data => {
                        console.log("Response Data:", data);
                        locationSelect.innerHTML = ''; // Clear existing options

                        if(data.halls){
                            console.log("Halls:", data.halls);
                            // defaultOption.textContent = 'Select a hall';
                            // locationSelect.appendChild(defaultOption);
                            Object.entries(data.halls).forEach(([key, value]) => {
                                var option = document.createElement('option');
                                option.value = key; // hall id
                                option.textContent = value; // hall name
                                locationSelect.appendChild(option);
                            });
                        } else {
                            defaultOption.textContent = 'No halls available';
                            locationSelect.appendChild(defaultOption);
                        }

                    })
                    .catch(error => console.error('Error:', error));
            } else {
                locationSelect.innerHTML = ''; // Clear options if no location is selected
                defaultOption.textContent = 'Select the group location to see its Halls';
                locationSelect.appendChild(defaultOption);
            }

        });

    </script>


@endpush

