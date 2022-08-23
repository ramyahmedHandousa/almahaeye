
let carts =   document.querySelectorAll('.add-to-cart'),
    cartPercentage = 0,
    products = [],
    cartCoupon = null,
    cartAddressId = null,
    cartShippingId = null,
    cartShippingCityName = null,
    cartPaymentChoose = null,
    pageStatus = 0;


// for (let i = 0; i < carts.length; i++) {
    // carts[i].addEventListener('click',() => itemsNumber())
    // carts[i].addEventListener('click',function (e){
    //     console.log($(this).attr('data-id'))
    // })
// }


function itemsNumber(){

    let itemsNumber = parseInt(localStorage.getItem('itemsNumbers'));

    if (itemsNumber){
        localStorage.setItem('itemsNumbers',itemsNumber + 1 );
        document.querySelector('.cart-basket span').textContent = itemsNumber + 1;
    }else {
        localStorage.setItem('itemsNumbers', 1 );
        document.querySelector('.cart-basket span').textContent = 1;
    }
}


$(".add-to-cart").click(function(){

    $(".cart-basket a").removeAttr("onclick");

    var quantity = $("#quantity").val(),
        frame_color_id = $(".frame_color_id").val();

    $.ajax({
        url: "/cart",
        type:"POST",
        beforeSend:function () {
            $('.add-to-cart').css({"color":"#220e0e","background-color": "#9cd96d", "transition": "all .3s ease-in-out"});
            $('.add-to-cart span').text(trans('website.cart.add_success'));
        },
        data:{
            product_id:$(this).attr('data-id'),
            quantity:quantity,
            frame_color_id:frame_color_id,
        },
        success:function(response){

            var data = response.data;

            localStorage.setItem('itemsNumbers',data['total_cart']);
            $('.add-to-cart span').text(trans('website.cart.success'));
            document.querySelector('.cart-basket span').textContent = data['total_cart'];
            $(".cart-basket span ").css({"font-size":"40px"});
        },
        error: function() {
            $('.add-to-cart span').text("something wrong!");

        },complete:function () {
            $('.add-to-cart').css({"background-color":"#ffd609", "transition": "all .3s ease-in-out"});
            $('.add-to-cart span').text(trans('website.cart.add_to'));
            setTimeout(function () {
                $(".cart-basket span ").css({"font-size":"20px"});
            },500);
        }
    });
});

$('.increaseValue').click(function () {
    var max = $(this).closest('.number').find('input').attr('max');
    var input_value = $(this).closest('.number').find('input');
    //var max = $('.quantity').attr('max');
    var value = parseInt(input_value.val(), 10);
    value = isNaN(value) ? max : value;
    value < max ? value++ : value = max;
    input_value.val(value);
    updateCartQuantity($(this).attr('data-id'),value,$(this).attr('data-frame-color-id'));
    updateTotalPrice();

});
// Increase/Decrease quantity
$('.decreaseValue').click(function () {
    var min = $(this).closest('.number').find('input').attr('min');
    var input_value = $(this).closest('.number').find('input');
    //var max = $('.quantity').attr('max');
    var value = parseInt(input_value.val(), 10);
    value = isNaN(value) ? min : value;
    value > min ? value-- : value = min;
    input_value.val(value);
    updateCartQuantity($(this).attr('data-id'),value,$(this).attr('data-frame-color-id'));
    updateTotalPrice();
});


function updateTotalPrice(){

    var tax = $('.cart-percentage-setting').val(),
    sub_total = 0;

    $('.cartQuantity' ).each( function() {
        product_quantity = parseInt ( $(this).val() ) ? parseInt ( $(this).val() ) : 0;
        product_price = parseFloat($(this).attr('data-price'))?parseFloat($(this).attr('data-price')):0;
        sub_total += parseFloat ( product_price * product_quantity );
    });

    if (cartPercentage !== 0){
        sub_total = (sub_total - ((sub_total * cartPercentage) / 100));
    }

    if (tax !== 0){
        sub_total = (sub_total + ((sub_total * tax) / 100));
    }

    $(".total-price-cart").text(sub_total.toFixed(2));

}

function updateCartQuantity(id,quantity,frame_color_id){

    $.ajax({
        url: "/cart/" + id,
        type:"POST",
        data:{
            product_id:id,
            quantity:quantity,
            frame_color_id:frame_color_id,
            _method: "PUT",
        },
        success:function(response){

            var data = response.data;

            localStorage.setItem('itemsNumbers',data['total_cart']);
        }
    });
}

$(".remove-from-cart").click(function(){

    var product_id = $(this).attr('data-id'),
        key = $(this).attr('data-my-key'),
        item = $(this);

    $.ajax({
        url: "/cart/"+product_id,
        type:"post",
        beforeSend:function () {
            item.hide();
        },
        data:{
            product_id:product_id,
            key:key,
            _method: 'delete',
            _token :$(this).attr('data-token')
        },
        success:function(response){
            var data = response.data;
            localStorage.setItem('itemsNumbers',data['total_cart']);
            document.querySelector('.cart-basket span').textContent = data['total_cart'];
            $(".cart-basket span ").css({"font-size":"40px"});
            $("#cart-info-"+product_id).remove();

            if (data['total_cart'] === 0){
                window.location.href = '/';
            }
        },
        error: function( ) {
            $('.add-to-cart span').text("something wrong!");

        },complete:function () {
            $(".cart-basket span ").css({"font-size":"20px"});
            updateTotalPrice();
        }
    });
});

$("#check-code").on('click',function () {
    var code = $("#coupon-code").val();

    if(code){
        $.ajax({
            url: "/check-code",
            type:"Get",
            beforeSend:function () {
                $('#check-code').text(trans('website.cart.search_code'));
            },
            data:{ code:code },
            success:function(response){

                var data = response.data;

                cartPercentage = data['percentage'];
                cartCoupon = data['code'];
                $('.coupon').text(data['code']);
                $('.percent-by-coupon').text(data['percentage']);
                $('.discount-by-coupon').text(data['discount']);
                $('.total-price-cart').text(data['total_price']);
            },
            error: function( ) {
                $('#check-code').text(trans('website.cart.error_code'));

            },complete:function () {
                setTimeout(function () {
                    $("#coupon-code").val('');
                    $('#check-code').text(trans('website.cart.use_code'));
                },800);
            }
        });
    }

});


$(".cart-choose-shipping").on('click',function () {
    let cities = $('.aramex-cities'),
        citySelected = $( ".aramex-cities select option:selected" ).val();
    parseInt(this.value) === 1 ? cities.show() : cities.hide();
    cartShippingCityName = parseInt(this.value) === 1 ? citySelected : null;
});

$(".change-aramex-cities").on('change',function () {
    cartShippingCityName = this.value;
});

function trans(key, replace = {}) {
    var translation = key.split('.').reduce((t, i) => t[i] || null, window.translations);

    for (var placeholder in replace) {
        translation = translation.replace(`:${placeholder}`, replace[placeholder]);
    }
    return translation;
}

$("#cartNextStep").click(function () {

    let cartListProducts = $(".cart-list-products"),
        cartListAddress = $(".cart-list-address"),
        cartListShipping = $(".cart-list-shipping"),
        cartPayment = $(".cart-payment-choose");


    if (pageStatus === 0){

        cartListProducts.hide();
        cartListAddress.show();
        pageStatus = 1;

    }else if(pageStatus === 1){

        if ($(".cart-choose-address").is(":checked")){
            cartAddressId = $('.cart-choose-address:checked').val();
            cartListProducts.hide();
            cartListAddress.hide();
            cartListShipping.show();
            pageStatus = 2;
        }else {
            toastr['error'](trans('website.valid.cart.address.choose_valid'), trans('website.valid.cart.address.title'));
        }
    }else if (pageStatus === 2 ){
        if ($(".cart-choose-shipping").is(":checked")){
            cartShippingId = $('.cart-choose-shipping:checked').val();
            cartListProducts.hide();
            cartListAddress.hide();
            cartListShipping.hide();
            cartPayment.show();
            pageStatus = 3;
        }else {
            toastr['error'](trans('website.valid.cart.shipping.choose_valid'), trans('website.valid.cart.shipping.title'));
        }
    }else {

        if ($(".cart-choose-payment").is(":checked")){
            cartPaymentChoose = $('.cart-choose-payment:checked').val();
            cartListProducts.hide();
            cartListAddress.hide();
            cartListShipping.hide();
            cartPayment.show();

            if (cartAddressId && cartShippingId && cartPaymentChoose){
                makeOrderCart(cartAddressId,cartShippingId,cartCoupon,cartPaymentChoose);
            }

        }else {
            toastr['error'](trans('website.valid.cart.payment.choose_valid'), trans('website.valid.cart.payment.title'));
        }


    }

});

function makeOrderCart(cartAddressId,cartShippingId,cartCoupon,payment_method){

    $.ajax({
        url: "/orders",
        type:"post",
        beforeSend:function () {
            $("#cartNextStep").hide();
        },
        data:{
            address_id:cartAddressId,
            shipping_id:cartShippingId,
            shipping_city_name:cartShippingCityName,
            coupon:cartCoupon,
            payment_method: payment_method
        },
        success:function(response){

           if (response.status === 200){

               if(response.data.empty){
                   toastr['success'](trans('website.orders.success') , trans('website.orders.title'));
                   localStorage.setItem('itemsNumbers',0  );
               }

               window.location.href = response.data.url;
           }else {
               toastr['error'](trans('website.orders.error'), trans('website.orders.title'));
           }
        },
        error: function( ) {

            toastr['error'](trans('website.orders.error_complete_information'), trans('website.orders.title'));

            $("#cartNextStep").show();
        },complete:function () {

            $("#cartNextStep").show();
        }
    });

}


function onLoadItemsNumber(){
    let itemsNumber = parseInt(localStorage.getItem('itemsNumbers'));

    if (itemsNumber){
        localStorage.setItem('itemsNumbers',itemsNumber  );
        document.querySelector('.cart-basket span').textContent = itemsNumber;
    }
}

onLoadItemsNumber();
