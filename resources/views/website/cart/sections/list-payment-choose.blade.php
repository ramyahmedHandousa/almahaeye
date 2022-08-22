<div class="title cart-payment-choose" style="display: none"> {{trans('website.cart.choose_payment_method')}}      </div>

<div class="col-lg-8 cart-payment-choose" style="display: none">
    <div class="box">
            <div class="form-group">
                <label class="form-check-label">
                    <input class="form-check-input cart-choose-payment" name="choose_payment" type="radio" value="cash">
                    {{trans('website.cart.on_receipt')}}
                </label>
            </div>
            <div class="form-group">
                <label class="form-check-label">
                    <input class="form-check-input cart-choose-payment" name="choose_payment" type="radio" value="online">
                    {{trans('website.cart.online')}}
                </label>
            </div>
    </div>
</div>
