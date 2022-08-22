<div class="col-lg-4">
    <div class="box">
        <h5 class="title">  {{trans('website.cart.code_coupon')}}</h5>

        <div class="form-group">
            <input type="text" id="coupon-code" name="code" class="form-control" placeholder=" {{trans('website.cart.code_coupon')}}">
        </div>
        <button class="btn" id="check-code" type="button">   {{trans('website.cart.ues_coupon')}}</button>

    </div>
    <div class="box cart-orders">
        <h5 class="title">    {{trans('website.cart.order_info')}}</h5>

        <ul class="cart-orders-list">
            <li>
                <span>    {{trans('website.cart.coupon')}}</span>
                <span class="coupon">-----</span>
            </li>
            <li>
                <span> {{trans('website.cart.percentage_discount')}}</span>
                <span class="percent-price "><span class="percent-by-coupon">0</span>%</span>
            </li>
            {{--                        <li>--}}
            {{--                            <span>خصم</span>--}}
            {{--                            <span class="discount-price "><span class="discount-by-coupon">0</span>ر.س</span>--}}
            {{--                        </li>--}}
        </ul>
        <ul class="cart-orders-list">
            <li>
                <span> {{trans('website.cart.discount')}}  </span>
                <span class="discount-price total"><span class="discount-by-coupon">0</span>{{trans('website.cart.sr')}}  </span>
            </li>
            <li>
                <span> {{trans('website.cart.tax')}}  </span>
                <input type="hidden" class="cart-percentage-setting" value="{{$percentage}}">
                <span>{{$percentage}} %</span>
            </li>
            <li>
                <span>   {{trans('website.cart.total')}}</span>
                <span class="product-price total"><span class="total-price-cart">{{$totalPrice}}</span> {{trans('website.cart.sr')}} </span>
            </li>
        </ul>
        <div class="row btn-rows">
            <div class="col-lg-6">
                <a class="btn btn-black" href="{{url('/')}}">
                        {{trans('website.cart.continue')}}
                </a>
            </div>
            <div class="col-lg-6">
                @if(auth()->check())
                    <a class="btn" id="cartNextStep" href="#">
                         {{trans('website.cart.continue_order')}}
                    </a>
                @else
                    <a class="btn" href="#">
                            {{trans('website.cart.login')}}
                    </a>
                @endif
            </div>
        </div>
    </div>
</div>
