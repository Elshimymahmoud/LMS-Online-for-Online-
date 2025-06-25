

@if (!$purchased_course)
 
    @if(auth()->check() && (auth()->user()->hasRole('student')) && (Cart::session(auth()->user()->id)->get( $course->id)))
        <button class="show-login"   style="margin-left: 0" type="submit">
            <span>@lang('labels.frontend.layouts.course.get_course')</span>
            <div class="price"> @if($course->free == 1)  {{trans('labels.backend.courses.fields.free')}} @else {{$appCurrency['symbol'].' '.$course->price}} @endif </div>
        </button>
    @elseif(!auth()->check())
        <div class="show-login share openpop" data-value="model" style="margin-left: 0;">
            <span>@lang('labels.frontend.layouts.course.get_course')</span>
            <div class="price"> @if($course->free == 1)  {{trans('labels.backend.courses.fields.free')}} @else {{$appCurrency['symbol'].' '.$course->price}} @endif </div>
        </div>
    @elseif(auth()->check() && (auth()->user()->hasRole('student')))

        @if($course->free == 1)
            <form action="{{ route('cart.getnow') }}" method="POST" class="show-login"  style="padding:0;margin-left: 0">
                @csrf
                <input type="hidden" name="course_id" value="{{ $course->id }}"/>
                <input type="hidden" name="amount" value="{{($course->free == 1) ? 0 : $course->price}}"/>
                <button class="show-login"  type="submit" style="width: 100%;border:none">
                    <span>@lang('labels.frontend.layouts.course.get_course')</span>
                    <div class="price"> @if($course->free == 1)  {{trans('labels.backend.courses.fields.free')}} @else {{$appCurrency['symbol'].' '.@$course->price}} @endif </div>
                </button>
            </form>
        @else
       
            <form action="{{ route('cart.checkout') }}" method="POST" class="show-login"  style="padding:0;margin-left: 0">
                @csrf
                <input type="hidden" name="course_id" value="{{ $course->id }}"/>
                <input type="hidden" name="amount" value="{{($course->free == 1) ? 0 : $course->price}}"/>
              
                {{-- <button class="show-login"  type="submit" style="width: 100%;border:none">
                    <span>@lang('labels.frontend.layouts.course.get_course')</span>
                    <div class="price"> @if($course->free == 1)  {{trans('labels.backend.courses.fields.free')}} @else {{$appCurrency['symbol'].' '.$course->price}} @endif </div>
                </button> --}}
                
                <button onClick='goToCourseLocation()' class="show-login"  data-toggle="collapse" data-target="#collapseExample" aria-expanded="true" aria-controls="collapseExample" class="show-login"  type="button" style="width: 100%;border:none">
                    <span>@lang('labels.frontend.layouts.course.get_course')</span>
                    {{-- <div class="price"> @if($course->free == 1)  {{trans('labels.backend.courses.fields.free')}} @else {{$appCurrency['symbol'].' '.@$course->price}} @endif </div> --}}
                    <div class="price"> @if($course->free == 1)  {{trans('labels.backend.courses.fields.free')}} @else   @endif </div>
                
                </button>
            
            </form>
            
        @endif


    @else
    @if(@$continue_course)  
        <a  href="{{route('lessons.show',['id' => $course->id,'slug'=>$continue_course->model->slug])}}" class="show-login dark-red-bg" style="margin-left: 0;padding: 25px"  data-value="model">
            @lang('labels.frontend.course.continue_course')
        </a>
    @endif
    @endif

@else

    @if(@$continue_course)            
        <a  href="{{route('lessons.show',['id' => $course->id,'slug'=>$continue_course->model->slug])}}" class="show-login dark-red-bg" style="margin-left: 0;padding: 25px"  data-value="model">
            @lang('labels.frontend.course.continue_course')
        </a>
    @endif

@endif
@push('after-scripts')
<script>
    function goToCourseLocation(){
        window.location="#CourseLocation";
        document.getElementById('CourseLocation').classList.add('zoom-in-out-box');
       setTimeout(() => {
        document.getElementById('CourseLocation').classList.remove('zoom-in-out-box');
           
       }, 1000);

}
</script>

@endpush