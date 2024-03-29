
<section>
    <div class="container">
        <div class="row">
            <div class="sec-title">
                <h3 class="title">  {{trans('website.home.most_product_order')}}   </h3>
{{--                <a class="more" href="#">--}}
{{--                    مشاهدة الكل--}}
{{--                    <i class="fas fa-angle-double-left"></i>--}}
{{--                </a>--}}
            </div>
        </div>
        <div class="row products">
            @foreach($productsMostOrder as $product)
                <div class="col-lg-2">
                <div class="product">
                    <a class="wishlist add-product-to-favorite" data-id="{{$product->id}}" href="#">
                        <i class="fas fa-heart favorite-product-{{$product->id}}" ></i>
                    </a>
                    <div class="product-img">
                        <a href="{{route('products',$product->id)}}">
                        <img loading="lazy"  src="{{$product->getFirstMediaUrl('master_image')}}" alt="{{$product->name}}">
                        </a>
                    </div>
                    <div class="product-content">
                        <h4 class="product-title">
                            <a href="{{route('products',$product->id)}}">{{$product->name}}</a>
                        </h4>
                        <div class="product-price">
                            <span>{{$product->price_percentage ?? $product->price}}</span> ر.س
                        </div>
                        <div class="product-title">
                            <span>{{$product->brand?->name}}</span>
                        </div>

                        <div class="stars">
                            <i class="fas fa-star yellow"></i>
                            <i class="fas fa-star yellow"></i>
                            <i class="fas fa-star yellow"></i>
                            <i class="fas fa-star yellow"></i>
                            <i class="fas fa-star"></i>
                        </div>
                        <div class="product-color">
                            <span class="product-black"></span>
                            <span class="product-red"></span>
                            <span class="product-blue"></span>
                            <span class="product-yelow"></span>
                            <span class="product-white"></span>
                        </div>
                    </div>
                    <a class="product-basket add-to-cart" data-id="{{$product->id}}"  href="#">
                        <i class="fas fa-plus"></i>
                    </a>
                </div>
            </div>
            @endforeach
        </div>
    </div>
</section>
