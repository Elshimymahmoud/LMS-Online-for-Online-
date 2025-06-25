<div class="relat">
    <div class="head-relat">
        <div class="img-relat">
            <img @if($bundle->course_image != "") src="{{asset('storage/uploads/'.$bundle->course_image)}}" @else src="{{asset('images/course-default.jpeg')}}"  @endif  alt="Course3" class="img-fluid">
        </div>
        <a href="{{ route('bundles.show', [$bundle->slug]) }}"> {{$appCurrency['symbol'].' '.$bundle->price}}</a>
    </div>
    <div class="body-relat">
        <div class="top-body">
            <a href="{{ route('bundles.show', [$bundle->slug]) }}">
                <h5> @if(session('locale') == 'ar') {{ $bundle->title_ar?$bundle->title_ar:$bundle->title }} @else {{$bundle->title?$bundle->title:$bundle->title_ar}}  @endif</h5>
            </a>
            <p> @if(session('locale') == 'ar') {{ $bundle->category->name_ar?$bundle->category->name_ar:$bundle->category->name }} @else {{$bundle->category->name}}  @endif </p>
        </div>
        <div class="bottom-body d-flex">
            <p>
                <i class="far fa-chart-bar"></i>
                {{ $bundle->students()->count() }}  @lang('labels.frontend.layouts.home.students')
            </p>
            <p>
                <i class="fas fa-list-ul"></i>
                {{ $bundle->courses()->count() }}
                @if($bundle->courses()->count() > 1 )
                    @lang('labels.frontend.course.courses')
                @else
                    @lang('labels.frontend.course.course')
                @endif 
            </p>
           
        </div>
    </div>
</div>
