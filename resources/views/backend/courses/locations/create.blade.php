@extends('backend.layouts.app')
@section('title', __('menus.backend.sidebar.courses.createLocation') . ' | ' . app_name())
@push('after-styles')
    <style>
        .split {

            border: none;
            height: 69px;
            border-bottom: 1px solid #3bcfcb;
            box-shadow: 0 20px 20px -20px #3bcfcb;
            margin: -50px auto 10px;
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

    {!! Form::open(['method' => 'POST', 'route' => ['admin.courses.location.store', 'course_id' => $course->id], 'files' => true]) !!}

    <div class="card" style="font-family: 'Cairo', sans-serif;">
        <div class="card-header">
            <h3 class="page-title float-left">@lang('menus.backend.sidebar.courses.createLocation')</h3>
            <div class="float-right" style="margin-right: 10px;">
                <a href="{{  url()->previous() }}"
                   class="btn btn-primary">&#8592</a>
            </div>
            <div class="float-right">
                <a href="{{ route('admin.courses.index') }}"
                   class="btn btn-success">@lang('labels.backend.courses.view')</a>
            </div>
        </div>

        <div class="card-body">


            <div class="row">


                <div class="form-group">
                    {!! Form::label('locations', trans('labels.backend.group.location').' *', ['class' => 'control-label']) !!}<br>
                    <select name="locations" id="locations" class="form-control">
                        @foreach($locations as $index => $location)
                            <option value="{{$index}}">{{$location}}</option>
                        @endforeach
                    </select>
                </div>
                @if (Auth::user()->isAdmin())

                    <div class="col-12 form-group">
                        {!! Form::label('teachers',trans('labels.backend.courses.fields.teachers'), ['class' => 'control-label']) !!}
                        {!! Form::select('teachers[0][]', $teachers, old('teachers'), ['class' => 'form-control select2 js-example-placeholder-multiple', 'multiple' => 'multiple', 'required' => true]) !!}
                    </div>
                    <!-- <div class="col-2 d-flex form-group flex-column">
                    OR <a target="_blank" class="btn btn-primary mt-auto"
                            href="{{route('admin.teachers.create')}}">{{trans('labels.backend.courses.add_teachers')}}</a>
                </div> -->

                @endif

                <div class="col-12 col-lg-6 form-group">
                    {!! Form::label('price', trans('labels.backend.courses.fields.price') , ['class' => 'control-label']) !!}
                    {!! Form::number('location[0][price]', old('price')??0, ['class' => 'form-control', 'placeholder' => trans('labels.backend.courses.fields.price'), 'pattern' => '[0-9]*']) !!}
                </div>
                <div class="col-12 col-lg-6 form-group">
                    {!! Form::label('currency', trans('labels.backend.courses.fields.currency'), ['class' => 'control-label']) !!}

                    {!! Form::select('location[0][currency]', Lang::locale()=='ar'?['dollar'=>'دولار','SAR'=>'ريال']:['dollar'=>'Dollar','SAR'=>'SAR'],'SAR', ['class' => 'form-control select2', 'placeholder' => trans('labels.backend.courses.fields.currency'), 'required' => '']) !!}

                </div>
                @if($course->type->id != 1)
                    <div class="col-12 col-lg-6  form-group">
                        {!! Form::label('start_date', trans('labels.backend.courses.fields.start_date') . ' (yyyy-mm-dd)'.'*', ['class' => 'control-label']) !!}
                        {!! Form::text('location[0][start_date]', old('start_date'), ['class' => 'form-control date start_date', 'pattern' => '(?:19|20)[0-9]{2}-(?:(?:0[1-9]|1[0-2])-(?:0[1-9]|1[0-9]|2[0-9])|(?:(?!02)(?:0[1-9]|1[0-2])-(?:30))|(?:(?:0[13578]|1[02])-31))', 'placeholder' => trans('labels.backend.courses.fields.start_date') . ' (Ex . 2019-01-01)', 'autocomplete' => 'off','required' => true]) !!}

                    </div>

                    <div class="col-12 col-lg-6 form-group">
                        {!! Form::label('end_date', trans('labels.backend.courses.fields.end_date') . ' (yyyy-mm-dd)'.'*', ['class' => 'control-label']) !!}
                        {!! Form::text('location[0][end_date]', old('end_date'), ['class' => 'form-control date end_date', 'pattern' => '(?:19|20)[0-9]{2}-(?:(?:0[1-9]|1[0-2])-(?:0[1-9]|1[0-9]|2[0-9])|(?:(?!02)(?:0[1-9]|1[0-2])-(?:30))|(?:(?:0[13578]|1[02])-31))', 'placeholder' => trans('labels.backend.courses.fields.end_date') . ' (Ex . 2019-01-01)', 'autocomplete' => 'off','required' => true]) !!}
                        <p class="help-block"></p>
                        @if ($errors->has('end_date'))
                            <p class="help-block">
                                {{ $errors->first('end_date') }}
                            </p>
                        @endif
                    </div>
                @endif

                @if($course->classification != "")
                    @if($course->classification->id== 5)
                        <div class="col-12 col-lg-6  form-group">
                            {!! Form::label('$Course_clints',trans('labels.backend.courses.fields.Course_clints').' *', ['class' => 'control-label']) !!}
                            {!! Form::select('Course_clints[0][]', $Course_clints, old('CoursClint_id'), ['class' => 'form-control select2 js-example-placeholder-multiple','required' => true, 'multiple' => true]) !!}

                        </div>
                    @else
                        <div class="col-12 col-lg-6  form-group">
                            {!! Form::label('$Course_clints',trans('labels.backend.courses.fields.Course_clints'), ['class' => 'control-label']) !!}
                            {!! Form::select('Course_clints[0][]', $Course_clints, old('CoursClint_id'), ['class' => 'form-control select2 js-example-placeholder-multiple', 'multiple' => true]) !!}

                        </div>
                    @endif
                @else
                    <div class="col-12 col-lg-12  form-group">
                        {!! Form::label('$Course_clints',trans('labels.backend.courses.fields.Course_clints'), ['class' => 'control-label']) !!}
                        {!! Form::select('Course_clints[0][]', $Course_clints, old('CoursClint_id'), ['class' => 'form-control select2 js-example-placeholder-multiple', 'multiple' => true]) !!}

                    </div>
                @endif

                @if($course->type->id != 1)
                    <div class="form-group">
                        {!! Form::label('place', trans('labels.backend.group.location').' *', ['class' => 'control-label']) !!}<br>
                        <select name="place" id="place" class="form-control">
                            <option>Select a location to see its halls</option>
                        </select>
                    </div>
                    <div class="col-12 col-lg-6 form-group" id='days[0][days]'>
                        @endif

                    </div>
                    <div class="col-12 form-group">
                        {!! Form::label('coordinators', trans('labels.backend.coordinator.title'), ['class' => 'control-label']) !!}
                        {!! Form::select('coordinator[0][]', $coordinators, old('coordinator_id'), ['class' => 'form-control select2 js-example-placeholder-multiple-coord', 'id' => 'locations', 'multiple' => true,]) !!}
                    </div>
            </div>

            @if($course->type->id != 1)
                <div class="row">
                    <div class="col-6 form-group">
                        {!! Form::label('fromTime', 'التوقيت من', ['class' => 'control-label']) !!}
                        {!! Form::time('fromTime[0][time]' ,old('fromTime'), ['class' => 'form-control  js-example-placeholder-',   ]) !!}
                    </div>
                    <div class="col-6 form-group">
                        {!! Form::label('toTime', 'التوقيت الي', ['class' => 'control-label']) !!}
                        {!! Form::time('toTime[0][time]' ,old('toTime'), ['class' => 'form-control  js-example-placeholder-', ]) !!}
                    </div>
                    <div class="col-12 form-group">
                        {!! Form::label('time_links', ' جدول التوقيت', ['class' => 'control-label']) !!}
                        {!! Form::text('time_links[0]' ,old('time_links'), ['class' => 'form-control  js-example-placeholder-' ]) !!}
                    </div>

                </div>

                <div class="row d-none" id="zoom_input-0">
                    <div class="col-md-12 form-group">
                        {!! Form::label('add_video', trans('labels.backend.lessons.fields.add_zoom_link'), ['class' => 'control-label']) !!}



                        {!! Form::text('location[0][zoom_url]', old('zoom_url'), ['class' => 'form-control mt-3 ', 'placeholder' => trans('labels.backend.lessons.fields.add_zoom_link'), 'id' => 'video-0']) !!}


                    </div>


                </div>
            @endif


            <div id="newLoc">

            </div>

            <div class="row">
                <div class="col-12 form-group">
                    <a href="javascript:void(0)"
                       class="btn btn-success add_location">{{ trans('labels.backend.courses.fields.add_location') }}</a>
                </div>
            </div>

        </div>


        <div class="row">
            <div class="col-12  text-center form-group">

                {!! Form::submit(trans('strings.backend.general.app_save'), ['class' => 'btn btn-lg btn-danger']) !!}
            </div>
        </div>
    </div>
    </div>
    {!! Form::close() !!}

@stop

@push('after-scripts')
    <script>
        $(document).ready(function () {
            $('.start_date').each(function (i, obj) {

                $(obj).datepicker({
                    autoclose: true,
                    dateFormat: "{{ config('app.date_format_js') }}"
                });
                // check if enddate is greater than start date
                $(obj).change(function () {
                    let key = $(obj).attr('name').match(/(\d+)/);
                    let endDateName = "location[" + key[0] + "][end_date]";
                    var endDate = $("input[name='" + endDateName + "']").val();

                    var startDate = $(obj).val();

                    if ((Date.parse(endDate) < Date.parse(startDate))) {
                        alert("End date should be greater than Start date");
                        $("input[name='" + endDateName + "']").val('')
                        $(obj).val('')
                    }
                    // /////get days
                    $daysAll = getDatesBetweenDates(Date.parse(startDate), Date.parse(endDate) + 1);
                    console.log($daysAll[0]);
                    console.log($daysAll[1]);
                    let html = '';
                    for (let index = 0; index < $daysAll[0].length; index++) {
                        const element = $daysAll[0][index];
                        const elementEn = $daysAll[1][index];

                        html += element + ' <input type="checkbox" name="daysAr[' + key[0] + '][days][' + index + ']" value="' + element + '" id=""><br>';
                        html += ' <input type="hidden" name="daysEn[' + key[0] + '][days]' + index + '" value="' + elementEn + '" id="">';

                    }
                    //   html+='<input type="text" placeholder="الوقت من " name="fromTime['+key[0]+'][time]">'+'<input type="text" placeholder="الوقت الي"  name="toTime['+key[0]+'][time]">'
                    document.getElementById('days[0][days]').innerHTML = html

                    // //////
                });

            });
            $('.end_date').each(function (i, obj) {
                $(obj).datepicker({
                    autoclose: true,
                    dateFormat: "{{ config('app.date_format_js') }}"
                });

                // check if enddate is greater than start date

                $(obj).change(function () {
                    let key = $(obj).attr('name').match(/(\d+)/);
                    let startDateName = "location[" + key[0] + "][start_date]";
                    var startDate = $("input[name='" + startDateName + "']").val();

                    var endDate = $(obj).val();

                    if ((Date.parse(endDate) < Date.parse(startDate))) {
                        alert("End date should be greater than Start date");
                        $(obj).val('')
                    }
                    $daysAll = getDatesBetweenDates(Date.parse(startDate), Date.parse(endDate) + 1);
                    console.log($daysAll[0]);
                    console.log($daysAll[1]);
                    let html = '';
                    for (let index = 0; index < $daysAll[0].length; index++) {
                        const element = $daysAll[0][index];
                        const elementEn = $daysAll[1][index];

                        html += element + ' <input type="checkbox" name="daysAr[' + key[0] + '][days][' + index + ']" value="' + element + '" id="">';
                        html += ' <input type="hidden" name="daysEn[' + key[0] + '][days][' + index + ']" value="' + elementEn + '" id="">';

                    }
                    //   html+='<input type="text" placeholder="الوقت من " name="fromTime['+key[0]+'][time]">'+'<input type="text" placeholder="الوقت الي"  name="toTime['+key[0]+'][time]">'
                    document.getElementById('days[0][days]').innerHTML = html
                });
            });
            $(".js-example-placeholder-single").select2({
                placeholder: "{{ trans('labels.backend.courses.select_category') }}",
            });

            $(".js-example-placeholder-multiple").select2({
                placeholder: "{{ trans('labels.backend.courses.select_teachers') }}",
            });
            $(".js-example-placeholder-multiple-coord").select2({
                placeholder: "{{ trans('labels.backend.courses.select_coord') }}",
            });
            $(".js-example-placeholder-multiple-example").select2({
                placeholder: "{{ trans('labels.backend.courses.fields.teachers') }}",
            });
            // /////////
            count_question = 0;
            $(".add_location").click(function () {
                count_question++;
                new_ques = '<hr class="split"/><div class="row">' +
                    '<div class="col-12 col-lg-6 form-group">' +
                    `{!! Form::label('price', trans('labels.backend.courses.fields.price'), ['class' => 'control-label']) !!}` +
                    `{!! Form::number('location[`+count_question+`][price]', old('price')??0, ['class' => 'form-control', 'placeholder' => trans('labels.backend.courses.fields.price'), 'pattern' => '[0-9]*']) !!}` +
                    '</div>' +

                    ' <div class="col-12 col-lg-6 form-group" >' +
                    `{!! Form::label('currency', trans('labels.backend.courses.fields.currency'), ['class' => 'control-label']) !!}` +

                    `{!! Form::select('location[`+count_question+`][currency]', Lang::locale()=='ar'?['dollar'=>'دولار','SAR'=>'ريال']:['dollar'=>'Dollar','SAR'=>'SAR'],'SAR', ['class' => 'form-control select2', 'placeholder' => trans('labels.backend.courses.fields.currency'), 'required' => '']) !!}` +

                    ' </div>' +
                    '<div class="col-12 col-lg-6  form-group">' +
                    `{!! Form::label('start_date', trans('labels.backend.courses.fields.start_date') . ' (yyyy-mm-dd)', ['class' => 'control-label']) !!}` +
                    `{!! Form::text('location[`+count_question+`][start_date]', old('start_date'), ['class' => 'form-control date start_date', 'pattern' => '(?:19|20)[0-9]{2}-(?:(?:0[1-9]|1[0-2])-(?:0[1-9]|1[0-9]|2[0-9])|(?:(?!02)(?:0[1-9]|1[0-2])-(?:30))|(?:(?:0[13578]|1[02])-31))', 'placeholder' => trans('labels.backend.courses.fields.start_date') . ' (Ex . 2019-01-01)', 'autocomplete' => 'off','required' => true]) !!}` +

                    '</div>' +

                    '<div class="col-12 col-lg-6 form-group">' +
                    `{!! Form::label('end_date', trans('labels.backend.courses.fields.end_date') . ' (yyyy-mm-dd)', ['class' => 'control-label']) !!}` +
                    `{!! Form::text('location[`+count_question+`][end_date]', old('end_date'), ['class' => 'form-control date end_date', 'pattern' => '(?:19|20)[0-9]{2}-(?:(?:0[1-9]|1[0-2])-(?:0[1-9]|1[0-9]|2[0-9])|(?:(?!02)(?:0[1-9]|1[0-2])-(?:30))|(?:(?:0[13578]|1[02])-31))', 'placeholder' => trans('labels.backend.courses.fields.end_date') . ' (Ex . 2019-01-01)', 'autocomplete' => 'off','required' => true]) !!}` +
                    '<p class="help-block"></p>' +
                    "@if ($errors->has('end_date'))" +
                    '<p class="help-block">' +
                    "{{ $errors->first('end_date') }}" +
                    '</p>' +
                    "@endif" +
                    '</div>' +


                        @if (Auth::user()->isAdmin())

                        `<div class="col-10 form-group">
      {!! Form::label('teachers',trans('labels.backend.courses.fields.teachers'), ['class' => 'control-label']) !!}
                        {!! Form::select('teachers[`+count_question+`][]', $teachers, old('teachers'), ['class' => 'form-control select2 js-example-placeholder-multiple', 'multiple' => 'multiple', 'required' => true]) !!}
                        </div>
                        <div class="col-2 d-flex form-group flex-column">
                            OR <a target="_blank" class="btn btn-primary mt-auto"
                                  href="{{route('admin.teachers.create')}}">{{trans('labels.backend.courses.add_teachers')}}</a>
  </div>


                    `@endif
                    +
                    '<div class="col-12 col-lg-6 form-group" id="days[' + count_question + '][days]"></div>' +
                    '</div>' +
                    '<div class="row">' +
                    ' <div class="col-12 form-group">' +
                    `{!! Form::label('location_id', trans('labels.backend.courses.fields.location'), ['class' => 'control-label']) !!}` +
                    `{!! Form::select('location[`+count_question+`][location_id]', $locations, old('location_id'), ['class' => 'form-control select2', 'id' => 'locations', 'multiple' => false, 'required' => true,'onchange'=>'checkZoomLoc(event)']) !!}` +
                    '</div>' +
                    `<div class="col-12 form-group">
                    {!! Form::label('coordinators', trans('labels.backend.coordinator.title'), ['class' => 'control-label ']) !!}
                    {!! Form::select('coordinator[`+count_question+`][]', $coordinators, old('coordinator_id'), ['class' => 'form-control select2 js-example-placeholder-multiple-coord', 'multiple' => 'multiple', 'required' => true]) !!}
                    </div>` +
                    `
                <div class="col-12 form-group">
                    {!! Form::label('time_links', ' جدول التوقيت', ['class' => 'control-label']) !!}
                    {!! Form::text('time_links[`+count_question+`]' ,old('time_links'), ['class' => 'form-control  js-example-placeholder-',   'required' => true,]) !!}
                    </div>
` +
                    `
                <div class="col-6 form-group">
                    {!! Form::label('fromTime', 'التوقيت من', ['class' => 'control-label']) !!}
                    {!! Form::text('fromTime[`+count_question+`][time]' ,old('fromTime'), ['class' => 'form-control  js-example-placeholder-',   'required' => true,]) !!}
                    </div>
                    <div class="col-6 form-group">
{!! Form::label('toTime', 'التوقيت الي', ['class' => 'control-label']) !!}
                    {!! Form::text('toTime[`+count_question+`][time]' ,old('toTime'), ['class' => 'form-control  js-example-placeholder-',   'required' => true,]) !!}
                    </div>
` +
                    ' </div>' +
                    '<div class="row d-none" id="zoom_input-' + count_question + '">' +
                    '<div class="col-md-12 form-group">' +
                    `{!! Form::label('add_video', trans('labels.backend.lessons.fields.add_zoom_link'), ['class' => 'control-label']) !!}` +

                    `{!! Form::text('location[`+count_question+`][zoom_url]', old('zoom_url'), ['class' => 'form-control mt-3 ', 'placeholder' => trans('labels.backend.lessons.fields.add_zoom_link'), 'id' => 'video-`+count_question+`']) !!}` +

                    '</div>' +
                    ' </div>';
                $("#newLoc").append(new_ques);
                $(".js-example-placeholder-multiple-coord").select2({
                    placeholder: "{{ trans('labels.backend.courses.select_coord') }}",
                });
                $(".js-example-placeholder-multiple").select2({
                    placeholder: "{{ trans('labels.backend.courses.select_coord') }}",
                });
                $(".js-example-placeholder-multiple-example").select2({
                    placeholder: "{{ trans('labels.backend.courses.fields.teachers') }}",
                });

                //    set datepicker
                $('.start_date').each(function (i, obj) {

                    $(obj).datepicker({
                        autoclose: true,
                        dateFormat: "{{ config('app.date_format_js') }}"
                    });

                    // check if enddate is greater than start date
                    $(obj).change(function () {
                        let key = $(obj).attr('name').match(/(\d+)/);
                        let endDateName = "location[" + key[0] + "][end_date]";
                        var endDate = $("input[name='" + endDateName + "']").val();

                        var startDate = $(obj).val();

                        if ((Date.parse(endDate) < Date.parse(startDate))) {
                            alert("End date should be greater than Start date");
                            $("input[name='" + endDateName + "']").val('')
                            $(obj).val('')
                        }
                        $daysAll = getDatesBetweenDates(Date.parse(startDate), Date.parse(endDate) + 1);
                        console.log($daysAll[0]);
                        console.log($daysAll[1]);
                        let html = '';
                        for (let index = 0; index < $daysAll[0].length; index++) {
                            const element = $daysAll[0][index];
                            const elementEn = $daysAll[1][index];

                            html += element + ' <input type="checkbox" name="daysAr[' + key[0] + '][days][' + index + ']" value="' + element + '" id="">';
                            html += ' <input type="hidden" name="daysEn[' + key[0] + '][days]' + index + '" value="' + elementEn + '" id="">';

                        }
                        //   html+='<input type="text" placeholder="الوقت من " name="fromTime['+key[0]+'][time]">'+'<input type="text" placeholder="الوقت الي"  name="toTime['+key[0]+'][time]">'
                        document.getElementById('days[' + key[0] + '][days]').innerHTML = html
                    });
                });
                $('.end_date').each(function (i, obj) {
                    $(obj).datepicker({
                        autoclose: true,
                        dateFormat: "{{ config('app.date_format_js') }}"
                    });
                    // check if enddate is greater than start date

                    $(obj).change(function () {
                        let key = $(obj).attr('name').match(/(\d+)/);
                        let startDateName = "location[" + key[0] + "][start_date]";
                        var startDate = $("input[name='" + startDateName + "']").val();

                        var endDate = $(obj).val();

                        if ((Date.parse(endDate) < Date.parse(startDate))) {
                            alert("End date should be greater than Start date");
                            $(obj).val('')
                        }
                        $daysAll = getDatesBetweenDates(Date.parse(startDate), Date.parse(endDate) + 1);
                        console.log($daysAll[0]);
                        console.log($daysAll[1]);
                        let html = '';
                        for (let index = 0; index < $daysAll[0].length; index++) {
                            const element = $daysAll[0][index];
                            const elementEn = $daysAll[1][index];

                            html += element + ' <input type="checkbox" name="daysAr[' + key[0] + '][days][' + index + ']" value="' + element + '" id="">';
                            html += ' <input type="hidden" name="daysEn[' + key[0] + '][days]' + index + '" value="' + elementEn + '" id="">';

                        }
                        //   html+='<input type="text" placeholder="الوقت من " name="fromTime['+key[0]+'][time]">'+'<input type="text" placeholder="الوقت الي"  name="toTime['+key[0]+'][time]">'
                        document.getElementById('days[' + key[0] + '][days]').innerHTML = html
                    });
                });
                // ////////////////

            });
        });

        var uploadField = $('input[type="file"]');

        $(document).on('change', 'input[type="file"]', function () {
            var $this = $(this);
            $(this.files).each(function (key, value) {
                if (value.size > 5000000) {
                    alert('"' + value.name + '"' + 'exceeds limit of maximum file upload size')
                    $this.val("");
                }
            })
        })


        function checkZoomLoc(event) {
            $name = $(event.target).attr('name');
            $location_count = $name.match(/\d+/)[0];
            $zoomInput = 'location[' + $location_count + '][zoom_url]';
            console.log($('#video-' + $location_count));
            if ($(event.target).val()) {

                var selectElement = event.target;
                var customData = selectElement.getAttribute('data-type');
                if (customData == 2) {
                    $('#zoom_input-' + $location_count).removeClass('d-none').attr('required', true)

                } else {
                    $('#zoom_input-' + $location_count).addClass('d-none').attr('required', false)

                }
            } else {

                $('#zoom_input-' + $location_count).addClass('d-none').attr('required', false)
            }

        }

        const getDatesBetweenDates = (startDate, endDate) => {
            let datesEn = []
            let datesAr = []

            //to avoid modifying the original date
            const theDate = new Date(startDate)
            while (theDate < endDate) {
                var days = ['Sunday', 'Monday', 'Tuesday', 'Wednesday', 'Thursday', 'Friday', 'Saturday'];
                var daysAr = ['الاحد', 'الاثنين', 'الثلاثاء', 'الاربعاء', 'الخميس', 'الجمعة', 'السبت'];

                var dayNameEn = days[new Date(theDate).getDay()];
                var dayNameAr = daysAr[new Date(theDate).getDay()];

                datesEn = [...datesEn, dayNameEn]
                datesAr = [...datesAr, dayNameAr]

                theDate.setDate(theDate.getDate() + 1)
            }
            return [datesAr, datesEn];
        }
        // $(document).on('change', '#locations', function() {
        //     if ($(this).val()) {

        //         if ($(this).val() == '1') {
        //             $('#zoom_input').removeClass('d-none').attr('required', true)

        //         } else {
        //             $('#zoom_input').addClass('d-none').attr('required', false)

        //         }
        //     } else {

        //         $('#zoom_input').addClass('d-none').attr('required', false)
        //     }
        // })
    </script>
    <script>
        // Fetch and display course description
        document.getElementById('locations').addEventListener('change', function () {
            var locationId = this.value;
            var locationSelect = document.getElementById('place');
            var defaultOption = document.createElement('option');
            if (locationId !== '') {
                var url = '/user/courses/' + locationId + '/hall';
                fetch(url)
                    .then(response => response.json()) // Parse JSON response
                    .then(data => {
                        console.log("Response Data:", data);
                        locationSelect.innerHTML = ''; // Clear existing options

                        if (data.halls) {
                            console.log("Halls:", data.halls);
                            defaultOption.textContent = 'Select a hall';
                            locationSelect.appendChild(defaultOption);
                            Object.entries(data.halls).forEach(([key, value]) => {
                                var option = document.createElement('option');
                                option.value = key;
                                option.textContent = value;
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
