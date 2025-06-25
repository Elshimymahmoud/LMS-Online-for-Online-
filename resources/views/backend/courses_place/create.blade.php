@extends('backend.layouts.app')
@section('title', __('menus.backend.sidebar.courses_place.title').' | '.app_name())
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

    {!! Form::open(['method' => 'POST', 'route' => ['admin.courses_place.store']]) !!}

    <div class="card" style="      font-family: 'Cairo', sans-serif;">
        <div class="card-header">
            <h3 class="page-title float-left">@lang('menus.backend.sidebar.courses_place.title')</h3>
            <div class="float-right" style="margin-right: 10px;">
                <a href="{{ route('admin.courses_place.index') }}" class="btn btn-primary">&#8592</a>
            </div>
        </div>

        <div class="card-body">

            <div class="form-group">
                {!! Form::label('name_ar', trans('labels.backend.hall.fields.name_ar').' *', ['class' => 'control-label']) !!}
                <input class="form-control" name="name_ar" type="text" required>
            </div>
            <div class="form-group">
                {!! Form::label('name', trans('labels.backend.hall.fields.name').' *', ['class' => 'control-label']) !!}
                <input class="form-control" name="name" type="text" required>
            </div>
            <div class="form-group">
                {!! Form::label('location_id', trans('labels.backend.hall.fields.location').' *', ['class' => 'control-label']) !!}
                {!! Form::select('location_id', $locations, null, ['class' => 'form-control js-example-placeholder-single', 'required' => 'required']) !!}
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
        // Function to strip HTML tags from a string
        function stripHtmlTags(html) {
            var doc = new DOMParser().parseFromString(html, 'text/html');
            return doc.body.textContent || "";
        }

    </script>

@endpush

