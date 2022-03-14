<div class="col-lg-4">
    <div class="box">
        <h5 class="title">كود الخصم</h5>

        <div class="form-group">
            <input type="text" id="coupon-code" name="code" class="form-control" placeholder="كود الخصم">
        </div>
        <button class="btn" id="check-code" type="button">استخدم الكود</button>

    </div>
    <div class="box cart-orders">
        <h5 class="title">تفاصيل الطلب</h5>

        <ul class="cart-orders-list">
            <li>
                <span>كوبون الخصم</span>
                <span class="coupon">-----</span>
            </li>
            <li>
                <span>نسبة الخصم</span>
                <span class="percent-price "><span class="percent-by-coupon">0</span>%</span>
            </li>
            {{--                        <li>--}}
            {{--                            <span>خصم</span>--}}
            {{--                            <span class="discount-price "><span class="discount-by-coupon">0</span>ر.س</span>--}}
            {{--                        </li>--}}
        </ul>
        <ul class="cart-orders-list">
            <li>
                <span>  الخصم</span>
                <span class="discount-price total"><span class="discount-by-coupon">0</span>ر.س</span>
            </li>
            <li>
                <span>  الضريبة</span>
                <input type="hidden" class="cart-percentage-setting" value="{{$percentage}}">
                <span>{{$percentage}} %</span>
            </li>
            <li>
                <span> الإجمالي </span>
                <span class="product-price total"><span class="total-price-cart">{{$totalPrice}}</span>ر.س</span>
            </li>
        </ul>
        <div class="row btn-rows">
            <div class="col-lg-6">
                <a class="btn btn-black" href="{{url('/')}}">
                    مواصلة التسوق
                </a>
            </div>
            <div class="col-lg-6">
                @if(auth()->check())
                    <a class="btn" id="cartNextStep" href="#">
                        متابعة الشراء
                    </a>
                @else
                    <a class="btn" href="#">
                        سجل الدخول
                    </a>
                @endif
            </div>
        </div>
    </div>
</div>
