@extends('backend.layouts.app')
@section('title', __('menus.backend.sidebar.courses.editLocation').' | '.app_name())
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

    {!! Form::open(['method' => 'PUT', 'route' => ['admin.courses.location.update','course_id'=>$course->id,'location_id'=>$courseLocation->id], 'files' => true]) !!}

    <div class="card" style="font-family: 'Cairo', sans-serif;">
        <div class="card-header">
            <h3 class="page-title float-left">@lang('menus.backend.sidebar.courses.editLocation')</h3>
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
                <div class="col-12 form-group">
                    {!! Form::label('location_id',trans('labels.backend.courses.fields.location'), ['class' => 'control-label']) !!}
                    <select name="location_id" id="locations" class="form-control" required>
                        @foreach($locations as $key => $location)
                            <option value="{{$key}}" {{$key == $courseLocation->location->id ? 'selected' : ''}}>{{$location}}</option>
                        @endforeach
                    </select>
                </div>

                @if (Auth::user()->isAdmin())

                    <div class="col-12 form-group">
                        {!! Form::label('teachers',trans('labels.backend.courses.fields.teachers'), ['class' => 'control-label']) !!}
                        {!! Form::select('teachers[]', $teachers,  old('teachers') ? old('teachers') : $courseLocation->teachers->pluck('id')->toArray(), ['class' => 'form-control select2 js-example-placeholder-multiple', 'multiple' => 'multiple', 'required' => true]) !!}
                    </div>
                    <!-- <div class="col-2 d-flex form-group flex-column">
                        OR <a target="_blank" class="btn btn-primary mt-auto"
                              href="{{route('admin.teachers.create')}}">{{trans('labels.backend.courses.add_teachers')}}</a>
                    </div> -->

                @endif

                <div class="col-12 col-lg-6 form-group">
                    {!! Form::label('price',  trans('labels.backend.courses.fields.price').' (in '.$appCurrency["symbol"].')', ['class' => 'control-label']) !!}
                    {!! Form::number('price', $courseLocation->price, ['class' => 'form-control', 'placeholder' => trans('labels.backend.courses.fields.price'), 'pattern' => "[0-9]"]) !!}
                </div>
                <div class="col-12 col-lg-6 form-group">
                    {!! Form::label('currency', trans('labels.backend.courses.fields.currency'), ['class' => 'control-label']) !!}

                    {!! Form::select('currency', Lang::locale()=='ar'?['dollar'=>'دولار','SAR'=>'ريال']:['dollar'=>'Dollar','SAR'=>'SAR'],$courseLocation->currency, ['class' => 'form-control select2', 'placeholder' => trans('labels.backend.courses.fields.currency'), 'required' => '']) !!}

                </div>
                <div class="col-12 col-lg-6  form-group">
                    {!! Form::label('start_date', trans('labels.backend.courses.fields.start_date').' (yyyy-mm-dd)', ['class' => 'control-label']) !!}
                    {!! Form::text('start_date', $courseLocation->start_date, ['class' => 'form-control date','pattern' => '(?:19|20)[0-9]{2}-(?:(?:0[1-9]|1[0-2])-(?:0[1-9]|1[0-9]|2[0-9])|(?:(?!02)(?:0[1-9]|1[0-2])-(?:30))|(?:(?:0[13578]|1[02])-31))', 'placeholder' => trans('labels.backend.courses.fields.start_date').' (Ex . 2019-01-01)', 'autocomplete' => 'off']) !!}

                </div>

                <div class="col-12 col-lg-6 form-group">
                    {!! Form::label('end_date', trans('labels.backend.courses.fields.end_date').' (yyyy-mm-dd)', ['class' => 'control-label']) !!}
                    {!! Form::text('end_date', $courseLocation->end_date, ['class' => 'form-control date', 'pattern' => '(?:19|20)[0-9]{2}-(?:(?:0[1-9]|1[0-2])-(?:0[1-9]|1[0-9]|2[0-9])|(?:(?!02)(?:0[1-9]|1[0-2])-(?:30))|(?:(?:0[13578]|1[02])-31))', 'placeholder' => trans('labels.backend.courses.fields.end_date').' (Ex . 2019-01-01)','autocomplete'=>"off"]) !!}
                    <p class="help-block"></p>
                    @if($errors->has('end_date'))
                        <p class="help-block">
                            {{ $errors->first('end_date') }}
                        </p>
                    @endif
                </div>


                <div class="col-12 col-lg-6 form-group">
                    {!! Form::label('$Course_clints', trans('labels.backend.courses.fields.Course_clints'), ['class' => 'control-label']) !!}
                    {!! Form::select('Course_clints[]', $Course_clints, old('CoursClint_id',$courseLocation->clients->pluck('id')->toArray()), ['class' => 'form-control select2 js-example-placeholder-multiple-coord', 'multiple' => true]) !!}
                </div>

                {{--                    <div class="col-12 col-lg-6 form-group">--}}
                {{--                        {!! Form::label('CoursClint_id', trans('labels.backend.courses.fields.Course_clints'), ['class' => 'control-label']) !!}--}}
                {{--                        {!! Form::select('CoursClint_id[]', $Course_clints,  old('CoursClint_id'),['class' => 'form-control select2 js-example-placeholder-single', 'multiple' => true]) !!}--}}
                {{--                    </div>--}}
                <div class="col-12 col-lg-6  form-group">
                    {!! Form::label('place', trans('labels.backend.clients.fields.place_name').' *', ['class' => 'control-label']) !!}
                    <select name="place" id="place" class="form-control select2 js-example-placeholder-single">
                        @foreach($place as $key => $location)
                            <option value="{{$key}}" {{$key == $courseLocation->place ? 'selected' : ''}}>{{$location}}</option>
                        @endforeach
                    </select>
                </div>


                <div class="col-12 col-lg-12 form-group" id='days[0][days]'>

                    @for ($index = 0; $index<count($LocationDays); $index++)

                        {{$LocationDays[$index]->name_ar}}<input type="checkbox" checked
                                                                 name="daysAr[0][days][{{$index}}]"
                                                                 value="{{$LocationDays[$index]->name_ar}}" id="">
                        <input type="hidden" name="daysEn[0][days][{{$index}}]" value="{{$LocationDays[$index]->name}}"
                               id="">

                    @endfor
                </div>
                <div class="col-lg-12 form-group">
                    {!! Form::label('coordinators', trans('labels.backend.coordinator.title'), ['class' => 'control-label']) !!}
                    {!! Form::select('coordinator[]',$coordinators, $courseLocation->coordinators->pluck('id')->toArray(), ['class' => 'form-control select2 js-example-placeholder-multiple-coord', 'id' => 'locations', 'multiple' => true,'onchange'=>'checkZoomLoc(event)']) !!}
                </div>

                <div class="col-lg-6 form-group">
                    {!! Form::label('fromTime', 'التوقيت من', ['class' => 'control-label']) !!}
                    {!! Form::time('fromTime' ,$courseLocation->from_time, ['class' => 'form-control  js-example-placeholder-',   'required' => true,]) !!}
                </div>
                <div class="col-lg-6 form-group">
                    {!! Form::label('toTime', 'التوقيت الي', ['class' => 'control-label']) !!}
                    {!! Form::time('toTime' ,$courseLocation->to_time, ['class' => 'form-control  js-example-placeholder-',   'required' => true,]) !!}
                </div>
                <div class="col-lg-12 form-group">
                    {!! Form::label('time_links', ' جدول التوقيت', ['class' => 'control-label']) !!}
                    {!! Form::text('time_links' ,$courseLocation->time_links, ['class' => 'form-control  js-example-placeholder-']) !!}
                </div>

            </div>
            <div class="row">
            </div>
            <div class="row d-none" id="zoom_input">
                <div class="col-md-12 form-group">
                    {!! Form::label('add_video', trans('labels.backend.lessons.fields.add_zoom_link'), ['class' => 'control-label']) !!}



                    {!! Form::text('zoom_url', old('zoom_url'), ['class' => 'form-control mt-3 ', 'placeholder' => trans('labels.backend.lessons.fields.add_zoom_link'),'id'=>'video'  ]) !!}


                </div>


            </div>


        </div>


        <div class="row">
            <div class="col-12   form-group" style="text-align:left;">

                {!! Form::submit(trans('strings.backend.general.app_update'), ['class' => 'btn ml-3 btn-lg btn-danger edit']) !!}
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
            $('#start_date').change(function () {

                var startDate = $("#start_date").val();

                var endDate = $("#end_date").val();

                if ((Date.parse(endDate) < Date.parse(startDate))) {
                    alert("End date should be greater than Start date");
                    $("#end_date").val('')
                }
                // /////get days
                $daysAll = getDatesBetweenDates(Date.parse(startDate), Date.parse(endDate) + 1);
                console.log($daysAll[0]);
                console.log($daysAll[1]);
                let html = '';
                for (let index = 0; index < $daysAll[0].length; index++) {
                    const element = $daysAll[0][index];
                    const elementEn = $daysAll[1][index];

                    html += element + ' <input type="checkbox" name="daysAr[0][days][' + index + ']" value="' + element + '" id="">';
                    html += ' <input type="hidden" name="daysEn[0][days][' + index + ']" value="' + elementEn + '" id="">';

                }
                //   html+='<input type="text" placeholder="الوقت من " name="fromTime['+key[0]+'][time]">'+'<input type="text" placeholder="الوقت الي"  name="toTime['+key[0]+'][time]">'
                document.getElementById('days[0][days]').innerHTML = html
            });
            $('#end_date').change(function () {

                var startDate = $("#start_date").val();

                var endDate = $("#end_date").val();

                if ((Date.parse(endDate) < Date.parse(startDate))) {
                    alert("End date should be greater than Start date");
                    $("#end_date").val('')
                }
                // /////get days
                $daysAll = getDatesBetweenDates(Date.parse(startDate), Date.parse(endDate) + 1);
                console.log($daysAll[0]);
                console.log($daysAll[1]);
                let html = '';
                for (let index = 0; index < $daysAll[0].length; index++) {
                    const element = $daysAll[0][index];
                    const elementEn = $daysAll[1][index];

                    html += element + ' <input type="checkbox" name="daysAr[0][days][' + index + ']" value="' + element + '" id="">';
                    html += ' <input type="hidden" name="daysEn[0][days]' + index + '" value="' + elementEn + '" id="">';

                }
                //   html+='<input type="text" placeholder="الوقت من " name="fromTime['+key[0]+'][time]">'+'<input type="text" placeholder="الوقت الي"  name="toTime['+key[0]+'][time]">'
                document.getElementById('days[0][days]').innerHTML = html
            });
            $(".js-example-placeholder-single").select2({
                placeholder: "{{trans('labels.backend.courses.select_category')}}",
            });

            $(".js-example-placeholder-multiple").select2({
                placeholder: "{{trans('labels.backend.courses.select_teachers')}}",
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


        $(document).on('change', '#locations', function () {
            if ($(this).val()) {
                var selectElement = event.target;
                var customData = selectElement.getAttribute('data-type');

                if (customData == 2) {
                    $('#zoom_input').removeClass('d-none').attr('required', true)

                } else {
                    $('#zoom_input').addClass('d-none').attr('required', false)

                }
            } else {

                $('#zoom_input').addClass('d-none').attr('required', false)
            }
        })
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