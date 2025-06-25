@inject('request', 'Illuminate\Http\Request')
@extends('backend.layouts.app')

@section('title', __('labels.backend.blogs.title') . ' | ' . app_name())

@section('content')
    <style>
        .datetime {
            width: 100%;

            padding: 5px;
        }

    </style>
    <div class="card">
        <div class="card-header">
            <h3 class="page-title d-inline">@lang('labels.backend.courses.students.title')</h3>
            @can('blog_create')
                <div class="float-right">
            
                </div>
            @endcan
        </div>
        <div class="card-body">
            <div class="row">
                <div class="col-12">
                    <div class="table-responsive">


                        <table id="myTable" class="table table-bordered table-striped">
                            <thead>
                                <tr>
                                    <th>@lang('labels.general.sr_no')</th>
                                    <th>@lang('labels.backend.courses.students.student_name')</th>
                                    <th>@lang('labels.backend.courses.students.evaluate')</th>
                                    <th>@lang('labels.backend.courses.students.evaluate')</th>
                                </tr>
                            </thead>
                            <tbody>

                                @csrf

                                @foreach ($course->students as $key => $student)

                                    @php
                                        $key += 1;
                                    @endphp
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
                                            <a href="{{ route('admin.courses.evaluate_student', ['course_id' => $course->id, 'student_id' => $student->id]) }}" class="btn btn-success">@lang('labels.backend.courses.students.evaluate')</a>
                                        </td>

                                        <td>
                                            <a target="_blank" href="{{ route('admin.certificates.create_cert', ['course_id' => $course->id, 'student_id' => $student->id]) }}" class="btn btn-success">@lang('labels.backend.courses.students.certificate')</a>
                                        </td>
                                    </tr>
                                @endforeach


                            </tbody>
                        </table>





                    </div>
                </div>
            </div>
        </div>
    </div>

@endsection

@push('after-scripts')
@endpush
