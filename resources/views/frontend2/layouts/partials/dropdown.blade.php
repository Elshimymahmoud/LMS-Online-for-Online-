@if($item->subs)

    <li class="list-item">
        <a class="list-link" id="menu-{{$item->id}}" href="{{$item->link}}">{{trans('custom-menu.'.$menu_name.'.'.str_slug($item->label))}}</a>
        <ul class="depth-{{$item->depth}} list-unstyled mb-0 d-flex web-links">
            @foreach($item->subs as $item)
                @include('frontend.layouts.partials.dropdown', $item)
            @endforeach
        </ul>
    </li>
@else
    <li class="list-item">
        <a class="list-link" id="menu-{{$item->id}}" href="{{$item->link}}">{{trans('custom-menu.'.$menu_name.'.'.str_slug($item->label))}}</a>
    </li>
@endif

