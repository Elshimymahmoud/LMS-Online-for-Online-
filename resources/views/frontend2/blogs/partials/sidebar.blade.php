@push('after-styles')
<style>
.search-blog-btn
{
    display: contents;
}
.item-side{
    line-height: 24px;
    font-size: 16px;
    margin-top: -3px;
    margin-bottom: 5px;
    font-weight: 700;
    transition: 0.25s all ease;
    color: ##3bcfcb;
}
.item-side a{
    color: gray;

}
.course-side-bar-widget h3 {
    font-size: 30px;
    font-weight: 300;
    color: #333;
    margin-bottom: 20px;
}

.course-side-bar-widget h3 span {
    font-weight: 700;
    color: #17d0cf;
}
.best-course-pic {
    background-position: center;
    height: 101px;
    background-size: cover;
    background-repeat: no-repeat;
}
.course-title h5 a{
color: #504d4e !important;
cursor: pointer;
}
.course-title h5 a:hover{
color: #3bcfcb!important;
}
</style>
@endpush
<div class="col-md-3">
    <div class="side-bar side">
        <div class="one-side">

        <div class="side-bar-search head-side">
            <form action="{{route('blogs.search')}}" method="get">
                <input type="text" class="" name="q" placeholder="@lang('labels.frontend.blog.search_blog')">
                <button class="search-blog-btn" type="submit"><i class="fas fa-search"></i></button>
            </form>
        </div>
        @if($categories != "")
        <div class="side-bar-widget ">
            <div class="head-side">
            <h3 class="widget-title text-capitalize ">@lang('labels.frontend.blog.blog_categories')</h3>
        </div>
            <div class="body-side post-categori ul-li-block ">
                <ul>
                    @if(count($categories) > 0)

                        @foreach($categories as $item)
                            <li class="item-side cat-item @if(isset($category) && ($item->slug == $category->slug))  active @endif "><a href="{{route('blogs.category',[
                                                'category' => $item->slug])}}">{{$item->name}}</a></li>

                        @endforeach
                    @endif
                </ul>
            </div>
        </div>
        @endif
    </div>


        @if(count($popular_tags) > 0)
            <div class="side-bar-widget">
                <h2 class="widget-title text-capitalize">@lang('labels.frontend.blog.popular_tags')</h2>
                <div class="tag-clouds ul-li">
                    <ul>
                        @foreach($popular_tags as $item)

                            <li @if(isset($tag) && ($item->slug == $tag->slug))  class="active" @endif ><a href="{{route('blogs.tag',['tag'=>$item->slug])}}">{{$item->name}}</a></li>
                        @endforeach
                    </ul>
                </div>
            </div>
        @endif


        @if($global_featured_course != "")
        <hr>
            <div class="side-bar-widget">
                <h3 class="widget-title text-capitalize">@lang('labels.frontend.blog.featured_course')</h3>
                <div class="featured-course">
                    <div class="best-course-pic-text relative-position pt-0 ">
                        <div class=" best-course-pic relative-position " @if($global_featured_course->course_image != "") style="background-image: url({{asset('storage/uploads/'.$global_featured_course->course_image)}})" @endif>

                        @if($global_featured_course->trending == 1)
                                <div class="trend-badge-2 text-center text-uppercase">
                                    <i class="fas fa-bolt"></i>
                                    <span>@lang('labels.frontend.badges.trending')</span>
                                </div>
                            @endif
                        </div>
                        <div class="best-course-text" style="left: 0;right: 0;">
                            <div class="course-title mb20 headline relative-position">
                                <h5><a href="{{ route('courses.show', [$global_featured_course->slug]) }}">{{$global_featured_course->title}}</a></h5>
                            </div>
                            <div class="course-meta">
                                <span class="course-category"><a href="{{route('courses.category',['category'=>$global_featured_course->category->slug])}}">{{$global_featured_course->category->name}}</a></span>
                                <span class="course-author">{{ $global_featured_course->students()->count() }}</span>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        @endif
    </div>
</div>
