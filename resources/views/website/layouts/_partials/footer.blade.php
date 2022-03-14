
<footer>
    <div class="container">
        <div class="row">
            <div class="col-lg-4">
                <a href="#"><img  loading="lazy" src="{{asset('website/templates/images/flogo.svg')}}"></a>
            </div>
            <div class="col-lg-2">
                <h5 class="title">القائمة</h5>
                <ul>
                    <li><a href="{{url('/')}}">الرئيسية</a></li>
                    <li><a href="{{url('/search'.'?discount=true')}}">العروض</a></li>
                    <li><a href="{{route('global-setting','about_app')}}">نبذة عنا</a></li>
                    <li><a href="{{route('contact-us')}}">تواصل معنا</a></li>
                </ul>
            </div>
            <div class="col-lg-2">
                <h5 class="title">القائمة</h5>
                <ul>
                    <li><a href="{{route('global-setting','privacy')}}">سياسة الاستخدام</a></li>
                    <li><a href="{{route('global-setting','terms')}}">الشروط و الاحكام</a></li>
{{--                    <li><a href="#">معلومات التوصيل</a></li>--}}
                    <li><a href="{{route('global-setting','developer')}}">عن المطور</a></li>
                </ul>
            </div>
            <div class="col-lg-4">
                <h5 class="title">تواصل معنا</h5>
                <ul>
                    <li><i class="fas fa-map-marker-alt"></i>{{$setting['address'] ?? ' '}}</li>
                    <li class="phone"><i class="fas fa-phone"></i><a href="tel:+98888377261">{{$setting['whatsapp'] ?? ' '}}</a></li>
                    <li><i class="fas fa-envelope"></i><a href="mailto:almahaeye@gamil.com">{{$setting['contactus_email'] ?? ' '}}</a>
                    </li>
                </ul>
            </div>
{{--            <div class="col-lg-3">--}}
{{--                <h5 class="title">افضل العروض</h5>--}}
{{--                <ul class="fproducts">--}}
{{--                    <li class="product">--}}
{{--                        <div class="product-img"><img loading="lazy" src="{{asset('website/templates/images/img1.png')}}" ></div>--}}
{{--                        <div class="product-content">--}}
{{--                            <div class="product-title"><a href="product-details.html">إسم المنتج </a></div>--}}
{{--                            <div class="product-price"><span>12.59</span> ر.س</div>--}}
{{--                        </div>--}}
{{--                    </li>--}}
{{--                    <li class="product">--}}
{{--                        <div class="product-img"><img loading="lazy"  src="{{asset('website/templates/images/img1.png')}}"></div>--}}
{{--                        <div class="product-content">--}}
{{--                            <div class="product-title"><a href="product-details.html">إسم المنتج </a></div>--}}
{{--                            <div class="product-price"><span>12.59</span> ر.س</div>--}}
{{--                        </div>--}}
{{--                    </li>--}}
{{--                </ul>--}}
{{--            </div>--}}
        </div>
    </div>
</footer>
