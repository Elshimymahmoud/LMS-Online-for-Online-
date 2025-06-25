
@if (!$purchased_bundle)
 
    @if(auth()->check() && (auth()->user()->hasRole('student')) && (Cart::session(auth()->user()->id)->get( $bundle->id)))
        
    <button class="show-login btn btn-primary btn-gray btn-sm  link-border bundle-share"  type="submit">
            <span>@lang('labels.frontend.layouts.course.get_course')</span>
            (<span class="price"> @if($bundle->free == 1)  {{trans('labels.backend.courses.fields.free')}} @else {{$appCurrency['symbol'].' '.$bundle->price}} @endif </span>)
        </button>
    @elseif(!auth()->check())
        <div class="show-login openpop" data-value="model">
            <span>@lang('labels.frontend.layouts.course.get_course')</span>
           ( <span class="price"> @if($bundle->free == 1)  {{trans('labels.backend.courses.fields.free')}} @else {{$appCurrency['symbol'].' '.$bundle->price}} @endif </span>)
        </div>
    @elseif(auth()->check() && (auth()->user()->hasRole('student')))

        @if($bundle->free == 1)
            <form action="{{ route('cart.getnow') }}" method="POST" class="show-login"  style="padding:0;display:inline">
                @csrf
                <input type="hidden" name="bundle_id" value="{{ $bundle->id }}"/>
                <input type="hidden" name="amount" value="{{($bundle->free == 1) ? 0 : $bundle->price}}"/>
                <button class=" btn btn-primary btn-gray btn-sm  link-border bundle-share"  type="submit" style="border:none">
                    <span>@lang('labels.frontend.layouts.course.get_course')</span>
                   ( <span class="price"> @if($bundle->free == 1)  {{trans('labels.backend.courses.fields.free')}} @else {{$appCurrency['symbol'].' '.$bundle->price}} @endif </span>)
                </button>
            </form>
        @else
            <form action="{{ route('cart.checkout') }}" method="POST" class="show-login"  style="padding:0;display:inline">
                @csrf
                <input type="hidden" name="bundle_id" value="{{ $bundle->id }}"/>
                <input type="hidden" name="amount" value="{{($bundle->free == 1) ? 0 : $bundle->price}}"/>
                <button class="btn btn-primary btn-gray btn-sm  link-border bundle-share"  type="submit" style="border:none">
                    <span>@lang('labels.frontend.layouts.course.get_course')</span>
                   ( <span class="price"> @if($bundle->free == 1)  {{trans('labels.backend.courses.fields.free')}} @else {{$appCurrency['symbol'].' '.$bundle->price}} @endif </span>)
                </button>
            </form>
            
        @endif


    @else
    @if(@$continue_course)  
        <a href="{{route('lessons.show',['id' => $bundle->id,'slug'=>@$continue_course->model->slug])}}" class="show-login btn btn-primary btn-gray btn-sm  link-border bundle-share" style="background: #0c6e6e" data-value="model">
            @lang('labels.frontend.course.continue_course')
        </a>
    @endif
    @endif

@else

    @if(@$continue_course)            
        <a href="{{route('lessons.show',['id' => $bundle->id,'slug'=>@$continue_course->model->slug])}}" class="show-login" style="background: #0c6e6e" data-value="model">
            @lang('labels.frontend.course.continue_course')
        </a>
    @endif

@endif
