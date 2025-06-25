
@if (!auth()->check() || ($group->students->where('id',auth()->user()->id)->count()==0&&auth()->user()->hasRole('student'))||count($course->teachers->where('id',auth()->user()->id))==0&&auth()->user()->hasRole('teacher'))

    @if(!auth()->check() &&$group->end< \Carbon\Carbon::now() && $course->type_id!=1)
        <a    href="#" disabled class="btn btn-primary btn-get-course  link-border">
            @lang('labels.frontend.course.course_finish')
        </a>
    @elseif(!auth()->check())
        <form id="checkoutForm-{{ $group->id }}" action="{{ route('cart.checkout') }}" method="POST"
              class="show-login"  style="padding:0;margin-left: 0">
            @csrf
            <input type="hidden" name="course_id" value="{{ $course->id }}"/>
            <input type="hidden" name="group_id" value="{{ $group->id }}"/>
            <input type="hidden" name="currency" value="{{ $group->currency }}"/>


            <input type="hidden" name="amount" value="{{($course->free == 1) ? 0 : $group->price}}"/>
            <button class="btn btn-primary btn-get-course  link-border"   type="submit">
                <span style="color: white">@lang('labels.frontend.layouts.course.get_course')</span>
            </button>
        </form>
    @elseif(auth()->check() && auth()->user()->hasRole('student') &&$group->end < \Carbon\Carbon::now()&&
    $course->type_id!=1)
        <a    href="#" disabled class="btn btn-primary btn-get-course  link-border">
            @lang('labels.frontend.course.course_finish')
        </a>
    @elseif(auth()->check() && (auth()->user()->hasRole('student')||auth()->user()->hasRole('teacher')))

        @if($course->free == 1)
            <a    href="{{route('courses.details',['course'=>$course->slug,'group'=>$group->id])}}" class="btn btn-primary btn-get-course  link-border">
                @lang('labels.frontend.course.alreadyـsubscribed')
            </a>
        @elseif($group->end < \Carbon\Carbon::now())
            <a    href="#" disabled class="btn btn-primary btn-get-course  link-border">
                @lang('labels.frontend.course.course_finish')
            </a>
        @else
            <form id="checkoutForm-{{ $group->id }}" action="{{ route('cart.checkout') }}" method="POST"
                  class="show-login"  style="padding:0;margin-left: 0">
                @csrf
                <input type="hidden" name="course_id" value="{{ $course->id }}"/>
                <input type="hidden" name="group_id" value="{{ $group->id }}"/>
                <input type="hidden" name="currency" value="{{ $group->currency }}"/>


                <input type="hidden" name="amount" value="{{($course->free == 1) ? 0 : $group->price}}"/>
                <button class="btn btn-primary btn-get-course  link-border"   type="submit">
                    <span style="color: white">@lang('labels.frontend.layouts.course.get_course')</span>
                </button>
            </form>
        @endif

    @else
        @if(@$continue_course)
            <a href="{{route('courses.details',['course'=>$course->slug,'group'=>$group->id])}}" class="btn btn-primary btn-get-course  link-border">
                @lang('labels.frontend.course.alreadyـsubscribed')
            </a>
        @endif
    @endif

@else

    @if(@$continue_course )
        <a href="{{route('courses.details',['course'=>$course->slug,'group'=>$group->id])}}" class="btn btn-primary btn-get-course  link-border">
            @lang('labels.frontend.course.alreadyـsubscribed')
        </a>


    @elseif($group->students->where('id',auth()->user()->id)->count()!=0&&auth()->user()->hasRole('student'))
            <a href="{{route('courses.details',['course'=>$course->slug,'group'=>$group->id])}}" class="btn btn-primary btn-get-course  link-border">
                @lang('labels.frontend.course.alreadyـsubscribed')
            </a>
    @endif

@endif
