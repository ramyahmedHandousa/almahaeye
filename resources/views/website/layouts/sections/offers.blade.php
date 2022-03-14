
<section>
    <div class="container">
        <div class="row">
            <div class="sec-title">
                <h3 class="title">العروض الحديثة</h3>
            </div>
        </div>
        <!-- nav-pills -->
        <ul class="nav nav-pills home" id="pills-tab" role="tablist">
            <li class="nav-item" role="presentation">
                <button class="nav-link active" id="pills-1-tab" data-bs-toggle="pill" data-bs-target="#pills-1"
                        type="button" role="tab" aria-controls="pills-1" aria-selected="true">جميع العروض</button>
            </li>
        </ul>
        <!-- tab-content -->
        <div class="tab-content" id="pills-tabContent">
                <div class="row products">
                    @foreach($offers as $offer)
                        <div class="col-lg-2">
                        <div class="product">
                            <div class="discount-percent">{{round($offer->discount / $offer->price * 100,2)}} <span>%</span></div>
                            <a class="wishlist add-product-to-favorite" data-id="{{$offer->id}}" href="#">
                                <i class="fas fa-heart favorite-product-{{$offer->id}}"></i>
                            </a>
                            <div class="product-img">
                                <img loading="lazy"  src="{{$offer->getFirstMediaUrl('master_image')}}" alt="{{$offer->name}}">
                            </div>
                            <div class="product-content">
                                <h4 class="product-title"><a href="#">{{$offer->name}}</a></h4>
                                <span class="product-price"><span>{{$offer->price  - $offer->discount}}</span> ر.س</span>
                                <span class="old-price"><span>{{$offer->price}}</span> ر.س</span>
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
                            <a class="product-basket add-to-cart" data-id="{{$offer->id}}" href="#">
                                <i class="fas fa-plus"></i>
                            </a>
                        </div>
                    </div>
                    @endforeach
                </div>
        </div>
    </div>
</section>
