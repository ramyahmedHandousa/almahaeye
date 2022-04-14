@extends('website.layouts.master')

@section('content')


    <section class="product-details">
        <div class="container">
            <!-- breadcrumb -->
            <div class="row">
                <nav class="col-12" aria-label="breadcrumb">
                    <ol class="breadcrumb">
                        <li class="breadcrumb-item"><a href="#">الرئيسية</a></li>
                        <li class="breadcrumb-item"><a href="#">{{$product?->category?->parent?->name}}</a></li>
                        <li class="breadcrumb-item"><a href="#">{{$product?->category?->name}}</a></li>
                        <li class="breadcrumb-item active">{{$product->name}}</li>
                    </ol>
                </nav>
            </div>
            <!-- product details -->
            <div class="row">
                <!-- product slider -->
                <div class="col-lg-6">
                    <div class="product-slider">
                        <div id="carouselExampleIndicators" class="carousel slide" data-bs-ride="carousel">

                            <div class="carousel-indicators">
                                @foreach($product->media->where('collection_name','!=','glb') as $media)
                                    <button type="button" data-bs-target="#carouselExampleIndicators" data-bs-slide-to="0"
                                            class="active" aria-current="true" aria-label="Slide 1">
                                        <img loading="lazy"  src="{{$media->getUrl()}}">
                                    </button>
                                @endforeach
                            </div>
                            <div class="carousel-inner">
                                @foreach($product->media->where('collection_name','!=','glb') as $media)
                                    <div class="carousel-item active">
                                        <img loading="lazy"  src="{{$media->getUrl()}}">
                                    </div>
                                @endforeach
                            </div>
                            <button class="carousel-control-prev" type="button"
                                    data-bs-target="#carouselExampleIndicators" data-bs-slide="prev">
                                <span class="carousel-control-prev-icon" aria-hidden="true"></span>
                                <span class="visually-hidden">Previous</span>
                            </button>
                            <button class="carousel-control-next" type="button"
                                    data-bs-target="#carouselExampleIndicators" data-bs-slide="next">
                                <span class="carousel-control-next-icon" aria-hidden="true"></span>
                                <span class="visually-hidden">Next</span>
                            </button>
                        </div>
                    </div>
                </div>
                <!-- product details -->
                <div class="col-lg-6">
                    <!-- product name -->
                    <h2 class="product-name">{{$product->name}}</h2>
                    <!-- product price -->
                    <div class="product-price">
                        @if($product->discount)
                            <span>{{$product->discount}}</span> ريال سعودى
                            <span class="old-price"><span>{{$product->price}}</span> ريال سعودى</span>
                        @else

                            <span>{{$product->price}}</span> ريال سعودى
                        @endif
                    </div>
                    <!-- product summary -->
                    <div class="summary">
                        <p>{{$product->description}}</p>
                    </div>
                    <!-- product attributes & action -->
                    <div class="row">
                        <!-- attributes -->
                        <div class="col-lg-6">
                            <ul class="attributes">
                                <li>
                                    <span class="attribute-name">القسم</span>
                                    <span class="attribute-value">{{$product?->category?->name}}</span>
                                </li>
                                <li>
                                    <span class="attribute-name">نوع المنتج</span>
                                    <span class="attribute-value">{{$product?->product_type?->name}}</span>
                                </li>
                                <li>
                                    <span class="attribute-name">الماركة</span>
                                    <span class="attribute-value">{{$product?->brand?->name}}</span>
                                </li>
                                <li>
                                    <span class="attribute-name">خامة الإطار</span>
                                    <span class="attribute-value">{{$product?->frame_material?->name}}</span>
                                </li>
                                <li>
                                    <span class="attribute-name">شكل الإطار</span>
                                    <span class="attribute-value">{{$product?->frame_shap?->name}}</span>
                                </li>
                                <li>
                                    <span class="attribute-name">السن</span>
                                    <span class="attribute-value">{{$product?->age?->name}}</span>
                                </li>
                                @if(count($product->frame_colors) > 0)
                                    <li>
                                        <span class="attribute-name">لون الإطار</span>
                                        <span class="attribute-value">
                                            <span class="colors">
                                                @foreach($product->frame_colors as $color)
                                                    <span class="color">{{$color->name}}</span>
                                                @endforeach
                                            </span>
                                        </span>
                                    </li>
                                @endif
                                @if(count($product->lens_colors) > 0)
                                <li>
                                    <span class="attribute-name">لون العدسة</span>
                                    <span class="attribute-value">
                                        <span class="colors">
                                            @foreach($product->lens_colors as $color)
                                                <span class="color">{{$color->name}}</span>
                                            @endforeach
                                        </span>
                                    </span>
                                </li>
                                @endif
                            </ul>
                        </div>
                        <!-- action -->
                        <div class="col-lg-6">
                            <div class="action">

                                <!-- product add to favorite button -->
                                <a class="btn btn-gray add-product-to-favorite" data-id="{{$product->id}}" href="#">
                                    <div class="icon"><i class="fas fa-heart favorite-product-{{$product->id}}"></i></div>
                                    <span>أضف لقائمة التمنى</span>
                                </a>
                                <!-- product number -->
                                <div class="number">
                                    <button class="value-button" id="decrease" onclick="decreaseValue()"
                                            value="Decrease Value"><i class="fa fa-minus"></i></button>
                                    <input type="number" id="quantity" name="quantity" class="form-control" readonly value="1" min="1" max="5" />
                                    <button class="value-button" id="increase" onclick="increaseValue()"
                                            value="Increase Value"><i class="fa fa-plus"></i></button>
                                </div>
                                <!-- product add to card button -->
                                <a class="btn add-to-cart" data-id="{{$product->id}}" href="#">
                                    <div class="icon">
                                        <svg xmlns="http://www.w3.org/2000/svg" id="Group_10183" data-name="Group 10183"
                                             width="17.842" height="16" viewBox="0 0 17.842 16">
                                            <path id="Path_2807" data-name="Path 2807"
                                                  d="M14.484,6.708a.712.712,0,0,0,.75-.667v-2.6a2.254,2.254,0,0,1,2.372-2.108,2.255,2.255,0,0,1,2.372,2.108v2.6a.755.755,0,0,0,1.5,0v-2.6A3.68,3.68,0,0,0,17.605,0a3.68,3.68,0,0,0-3.871,3.442v2.6A.712.712,0,0,0,14.484,6.708Z"
                                                  transform="translate(-8.663)" fill="#220e0e" />
                                            <path id="Path_2808" data-name="Path 2808"
                                                  d="M17.755,15.631H13.774v.831a1.425,1.425,0,0,1-1.5,1.333,1.426,1.426,0,0,1-1.5-1.333v-.831H7.531v.831a1.425,1.425,0,0,1-1.5,1.333,1.425,1.425,0,0,1-1.5-1.333v-.831H.506c-.207,0-.335.145-.286.324l2.624,9.5a1.52,1.52,0,0,0,1.412.967h9.749a1.522,1.522,0,0,0,1.413-.967l2.623-9.5C18.09,15.776,17.962,15.631,17.755,15.631Z"
                                                  transform="translate(-0.21 -10.421)" fill="#220e0e" />
                                        </svg>
                                    </div>
                                    <span>أضف إلى سلة الشراء</span>
                                </a>


                                @if($product->getFirstMediaUrl('glb'))
                                    <!-- product Virtual experience button -->
                                    <a class="btn btn-black"   href="{{route('virtual-product',$product->id)}}">
                                        <div class="icon">
                                            <svg xmlns="http://www.w3.org/2000/svg" width="39.064" height="16"
                                                 viewBox="0 0 39.064 16">
                                                <path id="Path_3765" data-name="Path 3765"
                                                      d="M37.92,153.342H35.214a7.988,7.988,0,0,0-11.709.769,6.42,6.42,0,0,0-7.947,0,7.988,7.988,0,0,0-11.709-.769H1.144a1.144,1.144,0,1,0,0,2.289h1.02a8,8,0,1,0,14.583.474,4.125,4.125,0,0,1,5.571,0A8,8,0,1,0,36.9,155.63h1.02a1.144,1.144,0,1,0,0-2.289ZM9.348,164.858a5.711,5.711,0,1,1,5.711-5.711A5.718,5.718,0,0,1,9.348,164.858Zm20.367,0a5.711,5.711,0,1,1,5.711-5.711A5.718,5.718,0,0,1,29.716,164.858Z"
                                                      transform="translate(0 -151.147)" fill="#fff"/>
                                            </svg>
                                        </div>
                                        <span>التجربة الإفتراضى</span>
                                    </a>
                                @endif
                                <!-- product share -->
                                <div class="share">
                                    <span class="title">شارك المنتج</span>
                                    <span class="links">
                                        <a href="#"><i class="fab fa-facebook-f"></i></a>
                                        <a href="#"><i class="fab fa-twitter"></i></a>
                                        <a href="#"><i class="fab fa-instagram"></i></a>
                                    </span>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <!-- End product detils -->
    </section>
    <!-- section product-review -->

{{--    @include('website.products.comments')--}}

    <!-- products related -->
{{--    <section class="products-related">--}}
{{--        <div class="container">--}}
{{--            <!-- section title -->--}}
{{--            <div class="sec-title">--}}
{{--                <h3 class="title">منتجات متعلقة</h3>--}}
{{--            </div>--}}
{{--            <!-- products -->--}}
{{--            <div class="products">--}}
{{--                <!-- product -->--}}
{{--                @foreach($relatedProducts as $product_re)--}}
{{--                    <div class="product">--}}
{{--                        <a class="wishlist" href="#">--}}
{{--                            <i class="fas fa-heart"></i>--}}
{{--                        </a>--}}
{{--                        <div class="product-img">--}}
{{--                            <img loading="lazy"  src="{{$product_re->getFirstMediaUrl('master_image')}}" alt="{{$product_re->name}}">--}}
{{--                        </div>--}}
{{--                        <div class="product-content">--}}
{{--                            <h4 class="product-title"><a href="product-details.html">{{$product_re->name}}</a></h4>--}}
{{--                            <div class="product-price"><span>{{$product_re->price}}</span> ريال سعودى</div>--}}
{{--                            <div class="product-color">--}}
{{--                                <span class="product-black"></span>--}}
{{--                                <span class="product-red"></span>--}}
{{--                                <span class="product-blue"></span>--}}
{{--                                <span class="product-yelow"></span>--}}
{{--                                <span class="product-white"></span>--}}
{{--                            </div>--}}
{{--                        </div>--}}
{{--                        <a class="product-basket" href="#">--}}
{{--                            <i class="fas fa-plus"></i>--}}
{{--                        </a>--}}
{{--                    </div>--}}
{{--                @endforeach--}}

{{--            </div>--}}
{{--        </div>--}}
{{--    </section>--}}

@endsection


@section('scripts')

    <script>

        $('.products').slick({
            rtl: true,
            slidesToShow: 6,
            slidesToScroll: 1,
            autoplay: true,
            autoplaySpeed: 2000,
            infinite: true,
            dots: false,
            responsive: [
                {
                    breakpoint: 1024,
                    settings: {
                        slidesToShow: 3,
                        slidesToScroll: 3
                    }
                },
                {
                    breakpoint: 600,
                    settings: {
                        slidesToShow: 2,
                        slidesToScroll: 2
                    }
                },
                {
                    breakpoint: 480,
                    settings: {
                        arrows: false,
                        slidesToShow: 1,
                        slidesToScroll: 1
                    }
                }]

        });



        function increaseValue() {
            var max = $('#quantity').attr('max');
            var value = parseInt(document.getElementById('quantity').value, 10);
            value = isNaN(value) ? max : value;
            value < max ? value++ : value = max;
            document.getElementById('quantity').value = value;
        }
        function decreaseValue() {
            var min = $('#quantity').attr('min');
            var value = parseInt(document.getElementById('quantity').value, 10);
            value = isNaN(value) ? min : value;
            value > min ? value-- : value = min;

            document.getElementById('quantity').value = value;
        }
    </script>


    <script>

    </script>

@endsection
