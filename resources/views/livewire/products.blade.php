
<div>
    <section>
        <div class="container">
            <div class="sec-title">
                <h3 class="title">المنتجات</h3>
                <form class="filter">
                    <button class=" btn btn-sm form-control">
                        <i class="fa fa-minus"></i>
                    </button>
                    <div >
                        <input class="form-control me-2" name="q" wire:model.debounce.500ms="q" type="search" placeholder="Search" aria-label="Search">
                    </div>

                                    <div class="dropdown">
                                        <button class="dropdown-toggle" type="button" id="dropdownMenuButton1" data-bs-toggle="dropdown"
                                                aria-expanded="false">
                                            الأقسام
                                        </button>
                                        <ul class="dropdown-menu" aria-labelledby="dropdownMenuButton1">
                                            @foreach($categories as $category)
                                                <li>
                                                    <a class="dropdown-item" wire:click="selectCategory({{$category->id}})" href="#">{{$category->name}}</a>
                                                </li>
                                            @endforeach
                                        </ul>
                                    </div>
                                    <div class="dropdown">
                                        <button class="dropdown-toggle" type="button" id="dropdownMenuButton1" data-bs-toggle="dropdown"
                                                aria-expanded="false">
                                            العلامة التجارية
                                        </button>
                                        <ul class="dropdown-menu" aria-labelledby="dropdownMenuButton1">
                                            @foreach($brands as $brand)
                                                <li><a class="dropdown-item" wire:click="selectBrand({{$brand->id}})" href="#">{{$brand->name}}</a></li>
                                            @endforeach
                                        </ul>
                                    </div>
                    {{--                <div class="dropdown">--}}
                    {{--                    <button class="dropdown-toggle" type="button" id="dropdownMenuButton1" data-bs-toggle="dropdown"--}}
                    {{--                            aria-expanded="false">--}}
                    {{--                        ترتيب حسب--}}
                    {{--                    </button>--}}
                    {{--                    <ul class="dropdown-menu" aria-labelledby="dropdownMenuButton1">--}}
                    {{--                        <li><a class="dropdown-item" href="#">الأقل سعر</a></li>--}}
                    {{--                        <li><a class="dropdown-item" href="#">الأعلى سعر</a></li>--}}
                    {{--                        <li><a class="dropdown-item" href="#">الأكثر مبيعا</a></li>--}}
                    {{--                    </ul>--}}
                    {{--                </div>--}}
                    {{--                <button class="btn" type="submit">فلتر</button>--}}
                </form>
            </div>
            <!-- products -->
            <div class="row products">
                <!-- product -->
                @foreach($products as $product)
                    <div class="col-lg-2">
                        <div class="product">
                            @if($product->discount)
                                <div class="discount-percent">{{round($product->discount / $product->price * 100,2)}} <span>%</span></div>
                            @endif
                            <a class="wishlist add-product-to-favorite" data-id="{{$product->id}}" href="#">
                                <i class="fas fa-heart favorite-product-{{$product->id}}"></i>
                            </a>
                            <div class="product-img">
                                <a href="{{route('products',$product->id)}}">
                                <img loading="lazy"  src="{{$product->getFirstMediaUrl('master_image')}}" alt="{{$product->name}}">
                                </a>
                            </div>
                            <div class="product-content">
                                <h4 class="product-title"><a href="{{route('products',$product->id)}}">{{$product->name}}</a></h4>
                                <div class="product-price"><span>{{$product->price_percentage ?? $product->price}}</span> ر.س</div>

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
                            <a class="product-basket add-to-cart" data-id="{{$product->id}}" href="#">
                                <i class="fas fa-plus"></i>
                            </a>
                        </div>
                    </div>
                @endforeach

            </div>
        </div>
    </section>
</div>
