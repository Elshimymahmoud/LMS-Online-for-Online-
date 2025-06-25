@inject('request', 'Illuminate\Http\Request')
@extends('backend.layouts.app')

@section('title', __('menus.backend.sidebar.students.title') . ' | ' . app_name())

@section('content')
    <style>
        .datetime {
            width: 100%;

            padding: 5px;
        }
        .headerr{
            top: 15%;
            /* width:80%;  */
            height:100px;
            background:white;
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
      <li class="breadcrumb-item"><a href="{{ route('admin.courses.index') }}"><i class="fa fa-home" ></i></a></li>
      <li class="breadcrumb-item" style="color:red">{{session('locale')=='ar'?$group->title_ar:$group->title}}</li>
      <li class="breadcrumb-item">{{$group->start->format('Y-m-d') ?? ""}}</li>


    </ol>
  </nav>
    <div class="card"style="margin-top: 2%;">
        <div class="card-header">
            <h3 class="page-title d-inline">@lang('labels.backend.courses.students.title')</h3>
            @can('blog_create')
                <div class="float-right">
                    <a href="{{ route('admin.group.add.students', ['group' => $group->id]) }}"
                       class="btn btn-success">@lang('buttons.backend.access.users.addToGroup')
                    </a>
                    <a href="{{ route('admin.groups.index') }}"
                    class="btn btn-primary">&#8592</a>

                </div>

            @endcan
        </div>
        <div class="card-body">
            <div class="row">
                <div class="col-12">
                    <div class="table-responsive" style="overflow: initial;">


                        <table id="myTable" class="table table-border table-hover">
                            <thead>
                                <tr>
                                    <th>@lang('labels.general.sr_no')</th>
                                    <th>@lang('labels.backend.courses.students.student_name')</th>
                                    <th>@lang('labels.backend.certificates.fields.progress')</th>
                                    <th>@lang('menus.backend.sidebar.certificates.abrov')</th>
                                    @php
                                        $groupRates = $group->rates;
                                        $hasTeacherRateStudent = $groupRates->contains(function ($rate) {
                                                    return $rate->user_type == 'teacher_rate_student';
                                                });
                                    @endphp
                                    @if($hasTeacherRateStudent)
                                        <th>@lang('labels.backend.rates.fields.rateStudent')</th>
                                    @endif

                                    <th>&nbsp; @lang('strings.backend.general.actions')</th>

                                </tr>
                            </thead>
                            <tbody>

                                @csrf

                                @foreach ($students as $key => $student)


                                    @php
                                        $key += 1;
                                    @endphp
                                    <tr>
                                        <td>
                                            {{ $key }}
                                        </td>

                                        <td>
                                            @if (Lang::locale() == 'en')
                                                {{$student->full_name }}
                                            @else
                                                {{ $student->full_name_ar }}
                                            @endif
                                        </td>

                                        <td>
                                            {{ $group->courses->getStudentProgress($student->id, $group->id) }}%
                                        </td>
                                        <td>
                                            @php
                                                $certificate = $student->getCertificateForCourse($course->id);
                                            @endphp
                                            @if($certificate && $certificate->show_to_user)
                                                @lang('labels.backend.courses.students.cert_avaliable')
                                            @else
                                                @lang('labels.backend.courses.students.cert_not_avaliable')
                                            @endif
                                        </td>
                                        @if($hasTeacherRateStudent)
                                            <td>
                                                @php
                                                    $groupRates = $group->rates;
                                                    $hasTeacherRateStudent = $groupRates->contains(function ($rate) {
                                                        return $rate->user_type == 'teacher_rate_student';
                                                    });
                                                    //if there is a teacher rate student then see if the student has been rated
                                                    if ($hasTeacherRateStudent) {
                                                        $teacherRateStudent = $groupRates->where('user_type', 'teacher_rate_student')->first();
                                                       $studentRate = $teacherRateStudent->divisions->contains(function ($division) use ($student, $group) {
                                                            return $division->questions->contains(function ($question) use ($student, $group) {
                                                                return $question->answers->contains(function ($answer) use ($student, $group) {
                                                                    return $answer->student_id == $student->id && $answer->group_id == $group->id;
                                                                });
                                                            });
                                                        });
                                                    }
                                                @endphp
                                                @if($hasTeacherRateStudent)
                                                    @if($studentRate)
                                                        @lang('labels.backend.rates.fields.rated')
                                                    @else
                                                        @lang('labels.backend.rates.fields.not_rated')
                                                    @endif
                                                @else
                                                    @lang('labels.backend.rates.fields.not_rated')
                                                @endif

                                            </td>
                                        @endif
                                        <td>
                                            <div class="btn-group btn-group-sm" role="group">
                                                <a id="userActions" type="button" class="btn btn-xs bg-warning mb-1 p-2 dropdown-toggle" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                                    <i class="fa fa-plus-square" aria-hidden="true"></i>
                                                </a>
                                                <div class="dropdown-menu drop" id="moreCourse" style=" max-height:200px; overflow:scroll; " aria-labelledby="userActions">
                                                    @if($certificate && $certificate->show_to_user)
                                                        <a tabindex="1" href="{{ route('admin.certificates.user.show', ['course_id' => $group->courses->id, 'student_id' => $student->id]) }}"
                                                           class="dropdown-item">{{ __('labels.backend.courses.students.certificate') }}</a>
                                                    @endif

                                                    <a tabindex="1" href="{{ route('admin.group.rates', ['group_id'
                                                    => $group->id, 'user_id' => $student->id]) }}"
                                                       class="dropdown-item"> {{__('menus.backend.sidebar.rates.title')}}</a>
                                                    <a tabindex="1" href="{{ route('admin.courses.groups.tests2.result', [''=> '','group'=> $group->id, 'user_id'
                                                     => $student->id]) }}"
                                                       class="dropdown-item">
                                                        {{__('menus.backend.sidebar.tests.title')}}</a>

                                                    @if($group->courses->type_id != 1)
                                                            <a tabindex="1" href="{{ route('admin.groups.lessons',
                                                        ['student_id'=>$student->id, 'course' => $course->id,
                                                        'group'=>$group->id]) }}" class="dropdown-item">
                                                                @lang('labels.backend.attendance.title')</a>
                                                    @endif
                                                    @if($hasTeacherRateStudent)
                                                        <a tabindex="1" href="{{ route('admin.groups.rates.rateStudent', ['group'=> $group->id, 'student' => $student->id]) }}"
                                                           class="dropdown-item"> {{__('labels.backend.rates.fields.rate_student')}}</a>
                                                    @endif

                                                </div>
                                            </div>
                                            {{-- delete Btn --}}

                                                <a data-method="delete" data-trans-button-cancel="Cancel"
                                                   data-trans-button-confirm="Delete" data-trans-title="Are you sure?"
                                                   class="btn btn-xs btn-danger text-white mb-1" style="cursor:pointer;"
                                                   onclick="$(this).find('form').submit();">
                                                    <i class="fa fa-trash" data-toggle="tooltip" data-placement="top" title=""
                                                       data-original-title="Delete"></i>

                                                    <form action="{{ route('admin.group.students.detach', ['group_id'
                                                     =>
                                                    $group->id, 'student_id' => $student->id]) }}"
                                                          method="POST" name="delete_item" style="display:none">
                                                        @csrf
                                                        {{ method_field('DELETE') }}
                                                    </form>
                                                </a>

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
