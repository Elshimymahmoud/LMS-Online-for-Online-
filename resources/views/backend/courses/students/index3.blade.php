@inject('request', 'Illuminate\Http\Request')
@extends('backend.layouts.app')

@section('title', __('labels.backend.blogs.title') . ' | ' . app_name())

@section('content')
    <style>
        .datetime {
            width: 100%;

            padding: 5px;
        }

        .headerr {
            top: 15%;
            /* width:80%;  */
            height: 100px;
            background: white;
            /* position:fixed; */
            text-align: center;
            -webkit-box-shadow: 0 3px 5px rgba(57, 63, 72, 0.3);
            -moz-box-shadow: 0 3px 5px rgba(57, 63, 72, 0.3);
            box-shadow: 0 3px 5px rgba(57, 63, 72, 0.3);
            border: 1px solid #d7cece;
            padding: 20px;
            color: darkslategray;
            font-size: x-large;
            border-radius: 7px;
        }

    </style>
    <nav aria-label="breadcrumb" class="headerr ">
        <ol class="breadcrumb">
            <li class="breadcrumb-item"><a href="{{ route('admin.courses.index') }}"><i class="fa fa-home"></i></a>
            </li>
            <li class="breadcrumb-item"> {{ session('locale') == 'ar' ? $course->type->name_ar : $course->type->name }} </li>
            <li class="breadcrumb-item" style="color:red">{{ session('locale') == 'ar' ? $course->title_ar : $course->title }}</li>
            <li class="breadcrumb-item">{{ $currentCourseLocation->start_date ?? '' }}</li>
            <li class="breadcrumb-item active">
                {{ session('locale') == 'ar' ? $currentCourseLocation->location->name_ar ?? '': $currentCourseLocation->location->name ?? ''}}
            </li>



        </ol>
    </nav>
    <div class="card" style="margin-top: 2%;">
        <div class="card-header">
            <h3 class="page-title d-inline">@lang('menus.backend.sidebar.certificates.abroveall')</h3>
            @can('blog_create')
                <div class="float-right">

                </div>
            @endcan
            <div class="float-right">
                <a href="{{ route('admin.courses.index') }}"
            class="btn btn-primary">&#8592</a>
            </div>
        </div>
        <div class="card-body">
            <div class="row">
                <div class="col-12">
                    <div class="table-responsive">


                        {{ html()->form('POST', route('admin.certificates.updateshow2'))->id('rate-create')->class('form-horizontal')->acceptsFiles()->open() }}

                        <table id="myTable" class="table table-border table-hover">
                            <thead>
                                <tr>
                                    <th>@lang('labels.general.sr_no')</th>
                                    <th>@lang('labels.backend.courses.students.student_name')</th>
                                    <th>@lang('menus.backend.sidebar.certificates.abrov')</th>

                                </tr>
                            </thead>
                            <tbody>

                                @csrf


                                @foreach ($course->studentsCourseLocation(request('course_location_id'))->get() as $key => $student)
                                    @foreach ($certificates as $key => $certificate)
                                        @php
                                            
                                            $key++;
                                        @endphp
                                        @if ($certificate->user_id == $student->id)
                                            <tr>
                                                <td>
                                                    {{ $key }}
                                                </td>

                                                <td>
                                                    @if (Lang::locale() == 'en')
                                                        {{ $student->first_name . ' ' . $student->last_name }}
                                                    @else
                                                        {{ $student->name_ar ?? $student->first_name . ' ' . $student->last_name }}
                                                    @endif
                                                </td>

                                                <td>
                                                    @if ($certificate->show_to_user == 1)
                                                        {!! Form::checkbox('forms[]', 1, true, [ 'id' => 'cheak' . $key . '']) !!}
                                                        <input type="hidden" disabled name="forms[]" value="0"
                                                            id={{ 'cheakHidden' . $key . '' }}>
                                                        <input type="hidden" name="certid[]"
                                                            value="{{ $certificate->id }}">
                                                    @else
                                                        {!! Form::checkbox('forms[]', 0, false, ['id' => 'cheak' . $key . '']) !!}
                                                        <input type="hidden" name="forms[]" value="0"
                                                            id={{ 'cheakHidden' . $key . '' }}>
                                                        <input type="hidden" name="certid[]"
                                                            value="{{ $certificate->id }}">
                                                    @endif

                                                    {{-- <td>
                                                    <a target="_blank" href="{{ route('admin.certificates.create_cert', ['course_id' => $course->id, 'student_id' => $student->id]) }}" class="btn btn-success">@lang('labels.backend.courses.students.certificate')</a>
                                                </td> --}}
                                            </tr>

                                            @push('after-scripts')
                                                <script>
                                                    $(document).ready(function() {


                                                        $('#cheak{{ $key }}').on('change', function() {
                                                            var id = $(this).val();

                                                            if (id == 1) {
                                                                // document.getElementById("cheak{{ $key }}").val = 0;
                                                                $(this).val(0);

                                                            } else if (id == 0) {
                                                                // document.getElementById("cheak{{ $key }}").val = 1;
                                                                // console.log($(this).val());

                                                                $(this).val(1);

                                                            }
                                                            console.log($(this).val());

                                                            if ($('#cheak{{ $key }}')[0].checked) {

                                                                $('#cheakHidden{{ $key }}')[0].disabled = true;

                                                            } else {
                                                                $('#cheakHidden{{ $key }}')[0].disabled = false;

                                                            }
                                                        });
                                                    });
                                                </script>
                                            @endpush
                                        @endif
                                    @endforeach
                                @endforeach



                            </tbody>
                        </table>


                        {!! Form::submit(trans('strings.backend.general.app_save'), ['class' => 'btn mt-auto  btn-danger', 'style' => 'float: left;']) !!}


                        {!! Form::close() !!}

                    </div>
                </div>
            </div>
        </div>
    </div>

@endsection

@push('after-scripts')
@endpush
