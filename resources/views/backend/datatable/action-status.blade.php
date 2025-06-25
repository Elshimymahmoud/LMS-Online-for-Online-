@if(!$published)
    <a data-method="post" data-trans-button-cancel="{{__('buttons.general.cancel')}}"
       data-trans-button-confirm="{{__('buttons.general.crud.publish')}}" data-trans-title="{{__('strings.backend.general.are_you_sure')}}"
       class="btn btn-xs btn-success text-white mb-1" style="cursor:pointer;"
       onclick="$(this).find('form').submit();">
        <i class="fa fa-check"
           data-toggle="tooltip"
           data-placement="top" title=""
           data-original-title="{{__('buttons.general.crud.publish')}}"></i>
        <form action="{{$route}}"
              method="POST" name="confirm_item" style="display:none">
            <input type="hidden" name="published" value="1">
            @csrf
            {{method_field('POST')}}
        </form>
    </a>
    @else
    <a data-method="post" data-trans-button-cancel="{{__('buttons.general.cancel')}}"
       data-trans-button-confirm="{{__('buttons.general.crud.unpublish')}}" data-trans-title="{{__('strings.backend.general.are_you_sure')}}"
       class="btn btn-xs btn-dark text-white mb-1" style="cursor:pointer;"
       onclick="$(this).find('form').submit();">
        <i class="fa fa-close"
           data-toggle="tooltip"
           data-placement="top" title=""
           data-original-title="{{__('buttons.general.crud.unpublish')}}"></i>
        <form action="{{$route}}"
              method="POST" name="confirm_item" style="display:none">
            <input type="hidden" name="published" value="0">
            @csrf
            {{method_field('POST')}}
        </form>
    </a>
    @endif


