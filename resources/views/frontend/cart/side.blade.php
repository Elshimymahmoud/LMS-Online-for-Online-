@push('after-styles')
    <style>
        .shopping-cart {
              width: 750px;
              height: 423px;
              margin: 80px auto;
              background: #FFFFFF;
              box-shadow: 1px 2px 3px 0px rgba(0,0,0,0.10);
              border-radius: 6px;
              display: none;
              flex-direction: column;

        }

        .page-shadow {
            position: fixed;
            top: 0;
            left: 0;
            width: 100%;
            height: 100%;
            background-color: rgba(0, 0, 0, 0.5);
            z-index: 2000;
            display: none;
        }

        .cart-title {
            height: 60px;
            border-bottom: 1px solid #E1E8EE;
            padding: 20px 30px;
            color: #5E6977;
            font-size: 18px;
            font-weight: 400;
            display: flex;
            justify-content: space-between;
        }

        .cart-item {
            padding: 20px 30px;
            height: 120px;
            display: flex;
            flex-direction: row;
            justify-content: space-between;
        }

        .cart-item{
          border-top:  1px solid #E1E8EE;
          border-bottom:  1px solid #E1E8EE;
        }
        .cart-buttons {
          position: relative;
          padding-top: 30px;
          margin-right: 35px;
        }
        .cart-delete-btn,
        .cart-like-btn {
          display: inline-block;
          Cursor: pointer;
        }
        .cart-delete-btn {
          width: 18px;
          height: 17px;
          background: url('https://designmodo.com/demo/shopping-cart/delete-icn.svg') no-repeat center;
        }

        .cart-item .image {
            margin-left: 30px;
        }
        .no-scroll {
            overflow: hidden;
        }
        .cart-like-btn {
          position: absolute;
          top: 9px;
          left: 15px;
          background: url('twitter-heart.png');
          width: 60px;
          height: 60px;
          background-size: 2900%;
          background-repeat: no-repeat;
        }
        .is-active {
          animation-name: animate;
          animation-duration: .8s;
          animation-iteration-count: 1;
          animation-timing-function: steps(28);
          animation-fill-mode: forwards;
        }

        @keyframes animate {
          0%   { background-position: left;  }
          50%  { background-position: right; }
          100% { background-position: right; }
        }
        .shopping-cart image {
          margin-right: 50px;
        }
        .cart-description {
          padding-top: 10px;
          width: fit-content;
        }

        .cart-description span {
          display: block;
          font-size: 14px;
          color: #43484D;
          font-weight: 400;
        }

        .cart-description span:first-child {
          margin-bottom: 5px;
        }
        .cart-description span:last-child {
          font-weight: 300;
          margin-top: 8px;
          color: #86939E;
        }
        @media (max-width: 800px) {
          .shopping-cart {
            width: 100%;
            height: auto;
            overflow: hidden;
          }
          .cart-item {
            height: auto;
            flex-wrap: wrap;
            justify-content: center;
          }
          .shopping-cart .image img {
            width: 50%;
          }
          .shopping-cart .image,
          .cart-quantity,
          .cart-description {
            width: 100%;
            text-align: center;
            margin: 6px 0;
          }
          .cart-buttons {
            margin-right: 20px;
          }
        }
        .cart-total-price {
          width: 83px;
          padding-top: 27px;
          text-align: center;
          font-size: 16px;
          color: #43484D;
          font-weight: 300;
        }
        .cart-quantity {
          padding-top: 20px;
          margin-right: 60px;
        }
        .cart-quantity input {
          -webkit-appearance: none;
          border: none;
          text-align: center;
          width: 32px;
          font-size: 16px;
          color: #43484D;
          font-weight: 300;
        }

        .shopping-cart button[class*=btn] {
          width: 30px;
          height: 30px;
          background-color: #E1E8EE;
          border-radius: 6px;
          border: none;
          cursor: pointer;
        }
        .minus-btn img {
          margin-bottom: 3px;
        }
        .plus-btn img {
          margin-top: 2px;
        }

        .shopping-cart button:focus,
        .shopping-cart input:focus {
          outline:0;
        }
        .cart-actions {
            display: flex;
            justify-content: space-between;
            height: 40px;
            top: -8px;
            position: relative;
        }

        .cart-actions .btn {
            padding: 10px 20px;
            text-decoration: none;
            color: white;
            border-radius: 5px;
            text-align: center;
        }
        .btn-secondary {
            background-color: #6c757d !important;
        }
    </style>
@endpush

<div style="position: relative;z-index: 2100;">
    <div class="shopping-cart">
        <!-- Title -->
        <div class="cart-title">
            <span>@lang('labels.frontend.cart.cart')</span>
{{--            <span class="cart-delete-btn" id="closeCart"></span>--}}
            <div class="cart-actions">
                <a href="#" id="closeCart" class="btn btn-primary">@lang('labels.frontend.cart.complete_shopping')</a>
                <a href="/cart" class="btn btn-secondary" style="margin-right: 5px;">@lang('labels.frontend.cart.pay_now')</a>
            </div>
        </div>
        @php
            if(auth()->check()){
                $cart_items = Cart::session(auth()->user()->id)->getContent();
            }
            else{
                $cart_items = Cart::session('guest')->getContent();
            }
        @endphp
        <div style="overflow-y: scroll; height: 100%;" id="side-cart">
            @foreach($cart_items as $cart_item)
                @php
                    $group = \App\Models\CourseGroup::find($cart_item->attributes->course_group_id);
                @endphp
                <div class="cart-item">
                    <div style="display: flex; gap: 35px;">
                        <div class="cart-buttons">
                            <a href="{{ route('cart.remove', ['course' => $group->courses->id]) }}"><span class="cart-delete-btn"></span></a>
                        </div>
                        <div class="cart-description">
                            <span>{{ $cart_item->name }}</span>
                            <span>{{ (app()->getLocale() == 'ar') ? $group->title_ar : $group->title }}</span>
                        </div>
                        <div class="cart-total-price">{{ $cart_item->price }} {{ $cart_item->attributes->currency }}</div>
                    </div>

                    <div class="image">
                        @if ($group->courses->course_image)
                            <img src="{{ asset('storage/uploads/' . $group->courses->course_image) }}" style="width: 100%;object-fit: cover;border-radius: 10px;height: 100%;" alt="{{ $cart_item->name }}" />
                        @else
                            <img src="{{ asset('iv' . '/images/courses/1.jpg') }}" style="width: 100%;object-fit: cover;border-radius: 10px;height: 100%;" alt="{{ $cart_item->name }}">
                        @endif
                    </div>

                </div>

            @endforeach
        </div>


    </div>
</div>

@push('after-styles')
    <script>
        $(document).ready(function() {
            $('.btn-open-cart').on('click', function() {
                if ($('.shopping-cart').css('display') == 'none') {
                    $('.shopping-cart').css('display', 'flex');
                    $('body').addClass('no-scroll');
                } else {
                    $('.shopping-cart').css('display', 'none');
                    $('body').removeClass('no-scroll');
                }
                $('.page-shadow').toggle();
            });
            $('.page-shadow').on('click', function() {
                $(this).hide();
                $('.shopping-cart').hide();
                $('body').removeClass('no-scroll');
            });
            $('#closeCart').on('click', function() {
                $('.shopping-cart').hide();
                $('.page-shadow').hide();
                $('body').removeClass('no-scroll');
            });
        });

    </script>
@endpush