{{--<div id="cart-list-products">--}}
<div class="title cart-list-products"> عربية التسوق ({{count($products)}})</div>
<div class="col-lg-8 cart-list-products">
    <!-- cart product -->
    @foreach($products as $product)
        <div class="product" id="cart-info-{{$product['id']}}">
            <div class="product-img">
                <img loading="lazy"  alt="{{$product['name']}}" class="mr-5 mt-14" src="{{$product['image']}}">
            </div>
            <div class="product-title">
                <h4 class="title"><a href="{{route('products',$product['id'])}}" target="_blank">{{$product['name']}}</a></h4>
                <div class="product-price">
                    @if($product['discount'])

                        <span style="line-height: normal; text-decoration: line-through">{{$product['price']}}</span>ر.س
                        <span>{{$product['discount']}}</span>ر.س
                    @else
                        <span>{{$product['price']}}</span>ر.س
                    @endif
                </div>
                                        <div class="product-seller">اللون:<a href="#">{{$product['frame_color_name']}}</a></div>
            </div>
            <div class="product-count">
                <div class="number">
                    <button class="value-button decreaseValue decrease"  data-frame-color-id="{{$product['frame_color_id'] ?? 0}}" data-id="{{$product['id']}}"   value="Decrease Value"><i
                            class="fa fa-minus"></i></button>
                    <input type="number" id="quantity" class="form-control cartQuantity " data-price="{{$product['discount'] ?: $product['price']}}"  readonly value="{{$product['quantity']}}" min="1" max="50">
                    <button class="value-button increaseValue increase" data-frame-color-id="{{$product['frame_color_id'] ?? 0}}" data-id="{{$product['id']}}"  value="Increase Value"><i
                            class="fa fa-plus"></i></button>
                </div>
            </div>
            <div class="product-delete">
                <a href="#" data-token="{{ csrf_token() }}" data-id="{{$product['id']}}" class="remove-from-cart"><i class="fas fa-trash"></i></a>
            </div>
        </div>
    @endforeach
</div>
{{--</div>--}}
