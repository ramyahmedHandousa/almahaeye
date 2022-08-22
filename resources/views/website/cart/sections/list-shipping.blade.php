<div class="title cart-list-shipping"
     style="display: none"
>{{trans('website.cart.choose_shipping')}}  </div>

<div class="col-lg-8 cart-list-shipping"
     style="display: none"
>
    <div class="box">
        @foreach($shipping as $ship)
        <div class="form-group">
            <label class="form-check-label">
                <input class="form-check-input cart-choose-shipping" name="Shipping" type="radio" value="{{$ship->id}}">
                {{$ship->name}} -
                ( {{trans('website.cart.cost')}}:{{$ship->price}} {{trans('website.cart.sr')}})
                 -
                 ({{trans('website.cart.on_receipt')}}  :{{$ship->pay == 1 ? trans('website.cart.found') : trans('website.cart.not_found')  }}  )
            </label>
        </div>
        @endforeach
    </div>

    <div class="box  aramex-cities" style="display: none">
        <h3> {{trans('website.cart.aramex_cities')}}     </h3>
        <select name="name_shipping" class="form-control change-aramex-cities">
            @foreach (collect(\Illuminate\Support\Facades\Lang::get('aramex')) as $key => $name){
                <option value="{{$key}}">{{trans('aramex.'.$key)}}</option>
            @endforeach
        </select>

    </div>

</div>



