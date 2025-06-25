<div class="item-side">
    <div class="media">
        <img src="{{asset('storage/uploads/'.$courseTrend->course_image)}}" alt="one"
            class="img-fluid mr-20">
        <div class="body-media">
            <h5>@if(session('locale') == 'ar') {{ $courseTrend->title_ar }} @else {{$courseTrend->title}}  @endif</h5>
            <div class="span">{{$courseTrend->price}} SAR</div>
            <p>By @if(session('locale') == 'ar') {{ $courseTrend->teachers[0]->name_ar??$courseTrend->teachers[0]->name }} @else {{$courseTrend->teachers[0]->name??$courseTrend->teachers[0]->name_ar}}  @endif</p>
        </div>
    </div>
    <a href="" class="link"></a>
</div>