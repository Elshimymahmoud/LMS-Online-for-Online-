
<div class="in-total font-weight-normal mb-3">@lang('labels.frontend.cart.price')
    <small class="text-muted">
        ({{Cart::getContent()->count()}}{{(Cart::getContent()->count() > 1) ? ' '.trans('labels.frontend.cart.items') : ' '.trans('labels.frontend.cart.item')}})
    </small>
    <span class="font-weight-bold">
         @if(isset($total))
        
         @if(count($course_location_currency)>0)
         {{ $course_location_currency[0]=='SAR'? $appCurrency['symbol']:'$' .' '.$total }}
         @else 
         {{$appCurrency['symbol'].' '.$total}}
         @endif
           
        @endif
                                            </span>
</div>
@if(Cart::getConditionsByType('coupon') != null)
    @foreach(Cart::getConditionsByType('coupon') as $condition)
        <div class="in-total font-weight-normal  mb-3"> {{ $condition->getValue().' '.$condition->getName()}}
            <span class="font-weight-bold">
                @if(count($course_location_currency)>0)
                {{ $course_location_currency[0]=='SAR'? $appCurrency['symbol']:'$' .' '.number_format($condition->getCalculatedValue($total),2) }}
                @else 
                {{$appCurrency['symbol'].' '.number_format($condition->getCalculatedValue($total),2)}}
                @endif
               
            </span>
         <i style="cursor: pointer" id="removeCoupon" class="fa text-danger fa-times-circle"></i>
        </div>
    @endforeach


@endif
@if($taxData != null)
    @foreach($taxData as $tax)
        <div class="in-total font-weight-normal  mb-3"> {{ $tax['name']}}
           
            <span class="font-weight-bold">
                @if(count($course_location_currency)>0)
                {{ $course_location_currency[0]=='SAR'? $appCurrency['symbol']:'$' .' '.number_format($tax['amount'],2) }}
                @else 
                {{$appCurrency['symbol'].' '.number_format($tax['amount'],2)}}
                @endif
                
            </span>
        </div>
    @endforeach
@endif
<div class="in-total border-top pt-3">@lang('labels.frontend.cart.total_payable')
    <span>
     
        @if(count($course_location_currency)>0)
                {{ $course_location_currency[0]=='SAR'? $appCurrency['symbol']:'$' .' '.number_format(Cart::session(auth()->user()->id)->getTotal(),2) }}
                @else 
                {{$appCurrency['symbol'].' '.number_format(Cart::session(auth()->user()->id)->getTotal(),2)}}
                @endif
  
      </span>
</div>


<div class="input-group mt-3 mb-1">
    <input type="text" id="coupon" pattern="[^\s]+" name="coupon"
           class="form-control" placeholder="Enter Coupon">
    <div class="input-group-append">
        <button class="btn btn-dark shadow-none " id="applyCoupon"
                type="button">
            @lang('labels.frontend.cart.apply')
        </button>
    </div>
</div>
<p class="d-none" id="coupon-error"></p>
