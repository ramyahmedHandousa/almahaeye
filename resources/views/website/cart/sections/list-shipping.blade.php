<div class="title cart-list-shipping" style="display: none"> اختيار شركة الشحن</div>

<div class="col-lg-8 cart-list-shipping" style="display: none">
    <div class="box">
        @foreach($shipping as $ship)
        <div class="form-group">
            <label class="form-check-label">
                <input class="form-check-input cart-choose-shipping" name="Shipping" type="radio" value="{{$ship->id}}">
                {{$ship->name}} -
                ( تكلفة:{{$ship->price}} ر.س)
                 -
                 (دفع عند الإستلام :{{$ship->pay == 1 ? ' يوجد ' : ' لا يوجد  '}}  )
            </label>
        </div>
        @endforeach
    </div>
</div>
