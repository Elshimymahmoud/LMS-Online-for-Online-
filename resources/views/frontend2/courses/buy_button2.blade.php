
@if (!$course->studentsCourseLocation($location->id)->where('user_id', \Auth::id())->count()>0)

@if(auth()->check() && (auth()->user()->hasRole('student')) && (Cart::session(auth()->user()->id)->get( $course->id)))
    <button class="show-login"   style="margin-left: 0" type="submit">
        <span>@lang('labels.frontend.layouts.course.get_course')</span>
        <div class="price"> @if($course->free == 1)  {{trans('labels.backend.courses.fields.free')}} @else {{$appCurrency['symbol'].' '.$location->price}} @endif </div>
    </button>
@elseif(!auth()->check())
    <div class="show-login share openpop" data-value="model" style="margin-left: 0;color:white;border-radius:0px">
        <span style="color: white">@lang('labels.frontend.layouts.course.get_course')</span>
        <div class="price"> @if($course->free == 1)  {{trans('labels.backend.courses.fields.free')}} @else {{$appCurrency['symbol'].' '.$location->price}} @endif </div>
    </div>
@elseif(auth()->check() && (auth()->user()->hasRole('student')))

    @if($course->free == 1)
        <form action="{{ route('cart.getnow') }}" method="POST" class="show-login"  style="padding:0;margin-left: 0">
            @csrf
            <input type="hidden" name="course_id" value="{{ $course->id }}"/>

            
            <input type="hidden" name="amount" value="{{($course->free == 1) ? 0 : $location->price}}"/>
            <button class="show-login"  type="submit" style="width: 100%;border:none">
                <span>@lang('labels.frontend.layouts.course.get_course')</span>
                <div class="price"> @if($course->free == 1)  {{trans('labels.backend.courses.fields.free')}} @else {{$appCurrency['symbol'].' '.$location->price}} @endif </div>
            </button>
        </form>
    @else
   
        <form action="{{ route('cart.checkout') }}" method="POST" class="show-login"  style="padding:0;margin-left: 0">
            @csrf
            <input type="hidden" name="course_id" value="{{ $course->id }}"/>
            <input type="hidden" name="course_location_id" value="{{ $location->id }}"/>


            <input type="hidden" name="amount" value="{{($course->free == 1) ? 0 : $location->price}}"/>
            <button class="show-login dark-red-bg"   type="submit" style="width: 100%;border:none;margin-left: 0;padding: 25px;color:white;border-radius:unset ">
                <span style="color: white">@lang('labels.frontend.layouts.course.get_course')</span>
                <div class="price"> @if($course->free == 1)  {{trans('labels.backend.courses.fields.free')}} @else {{$appCurrency['symbol'].' '.$location->price}} @endif </div>
            </button>
        </form>
        
    @endif


@else
@if(@$continue_course)  
    <a  href="{{route('lessons.show',['id' => $course->id,'slug'=>$continue_course->model->slug])}}" class="show-login dark-red-bg" style="margin-left: 0;padding: 25px;color:white;pointer-events: none;"  data-value="model">
        @lang('labels.frontend.course.alreadyـsubscribed')
    </a>
@endif
@endif

@else

@if(@$continue_course)            
    <a   href="{{route('lessons.show',['id' => $course->id,'slug'=>$continue_course->model->slug])}}" class="show-login dark-red-bg" style="margin-left: 0;padding: 25px;color:white;pointer-events: none;"  data-value="model">
        @lang('labels.frontend.course.alreadyـsubscribed')
    </a>
@endif

@endif
