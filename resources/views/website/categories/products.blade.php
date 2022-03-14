@section('styles')

    <link rel="stylesheet" href="{{asset('website/templates/css/bootstrap-slider.min.css')}}">
@endsection


<section>
    <div class="container">
        <div class="sec-title">
            <h3 class="title">المنتجات</h3>
            <form class="filter">
                <div class="the-range-slider">
                    <span class="slider-min">1 <span>ر.س</span></span>
                    <input id="price" type="text" data-slider-min="1" data-slider-max="10000" data-slider-step="1"
                           data-slider-value="1" />
                    <span class="slider-max">10000 <span>ر.س</span></span>
                </div>
                <div class="dropdown">
                    <button class="dropdown-toggle" type="button" id="dropdownMenuButton1" data-bs-toggle="dropdown"
                            aria-expanded="false">
                        الأقسام
                    </button>
                    <ul class="dropdown-menu" aria-labelledby="dropdownMenuButton1">
                        <li><a class="dropdown-item" href="#">رجالى</a></li>
                        <li><a class="dropdown-item" href="#">نسائى</a></li>
                        <li><a class="dropdown-item" href="#">أطفالى</a></li>
                    </ul>
                </div>
                <div class="dropdown">
                    <button class="dropdown-toggle" type="button" id="dropdownMenuButton1" data-bs-toggle="dropdown"
                            aria-expanded="false">
                        العلامة التجارية
                    </button>
                    <ul class="dropdown-menu" aria-labelledby="dropdownMenuButton1">
                        <li><a class="dropdown-item" href="#">العلامة التجارية</a></li>
                        <li><a class="dropdown-item" href="#">العلامة التجارية</a></li>
                        <li><a class="dropdown-item" href="#">العلامة التجارية</a></li>
                    </ul>
                </div>
                <div class="dropdown">
                    <button class="dropdown-toggle" type="button" id="dropdownMenuButton1" data-bs-toggle="dropdown"
                            aria-expanded="false">
                        ترتيب حسب
                    </button>
                    <ul class="dropdown-menu" aria-labelledby="dropdownMenuButton1">
                        <li><a class="dropdown-item" href="#">الأقل سعر</a></li>
                        <li><a class="dropdown-item" href="#">الأعلى سعر</a></li>
                        <li><a class="dropdown-item" href="#">الأكثر مبيعا</a></li>
                    </ul>
                </div>
                <button class="btn" type="submit">فلتر</button>
            </form>
        </div>
        <!-- products -->
        <div class="row products">
            <!-- product -->
            @foreach($products as $product)
                <div class="col-lg-2">
                <div class="product">
                    <a class="wishlist" href="#">
                        <i class="fas fa-heart"></i>
                    </a>
                    <div class="product-img">
                        <img loading="lazy"  src="{{$product->getFirstMediaUrl('master_image')}}" alt="{{$product->name}}">
                    </div>
                    <div class="product-content">
                        <h4 class="product-title"><a href="{{route('products',$product->id)}}">{{$product->name}}</a></h4>
                        <span class="product-price"><span>{{$product->price}}</span> ريال سعودى</span>

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
            <!-- product -->
        </div>
    </div>
</section>

@section('scripts')


    <script src="{{asset('website/templates/js/bootstrap-slider.min.js')}}"></script>
    <script>
        $("#price").slider();
    </script>
@endsection
