
    <div class="product-div">
        <div class="row m0 featured-img">
            <img src="{{$item->image?asset('storage/uploads/'.$item->image):asset('iv').'/images/courses/1.jpg'}}" alt="" />
        </div>
        <div style="padding: 10px 25px;text-align: right;">
            <h5 class="category">
              
              {{Lang::locale()=='ar'?$item->category->name_ar:$item->category->name}}
                    
                
            </h5>
            <h4 style="height:42px" class="title text-color">
                <a style="color: #4f198d !important;" href="{{route('blogs.index',['slug'=> $item->slug.'-'.$item->id])}}">{{$item->title}}</a>
            </h4>

            <a href="{{route('blogs.index',['slug'=> $item->slug.'-'.$item->id])}}" class=" btn btn-view mtb-10"
                style="width: 100%;">@lang('labels.general.read_more')</a>
              

        </div>
    </div>