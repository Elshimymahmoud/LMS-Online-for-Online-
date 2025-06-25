<a href="{{ route('admin.groups.show', ['course' => $group->id]) }}"
   class="btn btn-xs btn-info mb-1"><i class="icon-eye"></i></a>
{{-- <a href="{{ route('admin.courses.edit', ['course' => $group->id]) }}"
class="btn btn-xs btn-info mb-1"><i class="icon-pencil"></i></a> --}}
<!-- <a href="{{ route('admin.courses.location2.index', ['course_id' => $group->id]) }}" class="btn btn-xs btn-info mb-1" title="@lang('menus.backend.sidebar.courses.locations_times')"><i class="icon-arrow-left"></i></a> -->

{{-- <a href="{{route('admin.courses.location.edit', ['course_id'=>$group->id,'location_id'=>$item->pivot->id ?? ''])}}" class="btn btn-xs btn-info mb-1"><i class="icon-pencil"> تعديل المكان </i></a> --}}


@if(Auth::user()->id==1)
    <a data-method="delete" data-trans-button-cancel="Cancel"
       data-trans-button-confirm="Delete" data-trans-title="Are you sure?"
       class="btn btn-xs btn-danger text-white mb-1" style="cursor:pointer;"
       onclick="$(this).find('form').submit();">
        <i class="fa fa-trash" data-toggle="tooltip" data-placement="top" title=""
           data-original-title="Delete"></i>

        <form action="{{ route('admin.groups.destroy', ['course_id' => $group->id]) }}"
              method="POST" name="delete_item" style="display:none">
            @csrf
            {{ method_field('DELETE') }}
        </form>
    </a>
@endif
<div class="btn-group btn-group-sm" style="display: inline-block;" role="group">
    <a id="userActions" type="button"
       class="btn btn-xs bg-warning mb-1 p-2 dropdown-toggle" data-toggle="dropdown"
       aria-haspopup="true" aria-expanded="false" style="    height: fit-content;">
        <i class="fa fa-plus-square" aria-hidden="true"></i>
    </a>
    <div class="dropdown-menu drop" id="moreCourse" style=" max-height:200px;
                                                    overflow:scroll; " aria-labelledby="userActions">

        <a tabindex="1"
           href="{{ route('admin.groups.edit', ['course' => $group->id]) }}"
           class="dropdown-item">@lang('labels.backend.group.edit')</a>
        {{--                                            <a tabindex=" 1" href="#" class="dropdown-item">@lang('labels.backend.chapters.title')</a>--}}
        {{--                                            <a tabindex=" 1" href="#" class="dropdown-item">@lang('menus.backend.sidebar.lessons.title')</a>--}}
        <a tabindex=" 1" href="{{ route('admin.courses.groups.tests2.index', ['group_id' => $group->id]) }}" class="dropdown-item">@lang('menus.backend.sidebar.tests.title')</a>
        <a tabindex=" 1" href="{{ route('admin.courses.groups.activity.index', ['group_id' => $group->id]) }}"
           class="dropdown-item">@lang('menus.backend.sidebar.activity.title')</a>
        <a tabindex="1" href="{{ route('admin.group.students', ['group' => $group->id]) }}" class="dropdown-item">@lang('menus.backend.sidebar.students.title') </a>
{{--        @if($group->courses->type_id != 1)--}}
{{--            <a tabindex="1" href="{{route('admin.Attendance.index', ['course' => $group->courses->id,'group'=>$group->id])}}" class="dropdown-item">{{ __('menus.backend.sidebar.attendance.title')}}</a>--}}
{{--        @endif--}}
        <a tabindex="1" href="{{ route('admin.groups.cert.edit', ['group' =>
                                            $group->id]) }}"
           class="dropdown-item">@lang('menus.backend.sidebar.certificates.title') </a>
        <a tabindex="1" href="{{ route('admin.group.rates', ['group_id' => $group->id]) }}" class="dropdown-item">@lang('labels.backend.group.rate') </a>
        <a tabindex="1" href="{{ route('admin.group.impacts', ['group_id' => $group->id]) }}" class="dropdown-item">@lang('menus.backend.sidebar.impact.title') </a>
        <a tabindex="1" href="{{ route('admin.group.recommendations', ['group_id' => $group->id]) }}" class="dropdown-item">@lang('menus.backend.sidebar.programRec.title') </a>
        <a tabindex="1" href="{{ route('admin.group.rearrange', ['group' =>
                                            $group->id]) }}" class="dropdown-item">@lang('labels.backend.group.rearrange') </a>

            <a tabindex="1" href="{{ route('admin.groups.lessons', ['group' =>
                                                $group->id]) }}" class="dropdown-item">@lang('labels.backend.lessons.title') </a>

        <a tabindex="1" href="{{ route('courses.landing', ['course' =>
                                            $group->courses->slug, 'group'=> $group->id]) }}"
           class="dropdown-item">@lang('menus.backend.sidebar.courses.landing')
        </a>

    </div>
</div>