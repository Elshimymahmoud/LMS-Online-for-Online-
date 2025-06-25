<div class="relat">
    <div class="head-relat">
        <div class="img-relat" @if($item->image != "")  style="background-image: url({{asset('storage/uploads/'.$item->image)}});background-repeat: no-repeat;
            background-size: cover;
            background-position: center;" @endif>
            {{-- <img @if($item->image != "")  style="background-image: url({{asset('storage/uploads/'.$item->image)}})" @endif  alt="Course3" class="img-fluid"> --}}
        </div>
        <a href="{{route('blogs.index',['slug'=> $item->slug.'-'.$item->id])}}">{{$item->title}}</a>
    </div>
    <div class="body-relat">
        <div class="top-body">
            <a>
                <h5>   {!!  strip_tags(mb_substr($item->content,0,100).'...')  !!}</h5>
            </a>
     
            {{-- // --}}
        </div>
        <div class="bottom-body d-flex">
            <p>
                <i class="far fa-chart-bar"></i>
                <a href="{{route('blogs.index',['slug'=> $item->slug.'-'.$item->id])}}">@lang('labels.general.read_more')  <i
                    class="fas fa-chevron-circle-right"></i></a>
            </p>
           
        </div>
    </div>
</div>