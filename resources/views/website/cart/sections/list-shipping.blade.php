<div class="title cart-list-shipping"
     style="display: none"
> اختيار شركة الشحن</div>

<div class="col-lg-8 cart-list-shipping"
     style="display: none"
>
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

    <div class="box  aramex-cities" style="display: none">
        <h3> مدن شركة ارامكس</h3>
        <select name="name_shipping" class="form-control change-aramex-cities">
            @foreach (collect(\Illuminate\Support\Facades\Lang::get('aramex')) as $key => $name){
                <option value="{{$key}}">{{trans('aramex.'.$key)}}</option>
            @endforeach
        </select>

    </div>

</div>



