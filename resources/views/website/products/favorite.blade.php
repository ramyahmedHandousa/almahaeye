@extends('website.layouts.master')
@section('styles')

    <link href="/assets/admin/plugins/bootstrap-sweetalert/sweet-alert.css" rel="stylesheet"
          type="text/css"/>
@endsection
@section('content')


    <!-- start breadcrumbs -->
    <div class="container">
        <div class="sec-title" style="margin-top: 10px;">
            <h2 class="title">{{trans('website.profile.information')}}  </h2>
        </div>
        <!-- profile card -->
        <div class="profile-bg">
            <div>
                <div class="profile-img" style="border: 1px solid #DCDC;border-radius:100px;">
                    <img style="width: 100%; height: 100%;" loading="lazy"
                         src="{{ auth()->user()?->getFirstMediaUrl('master_image') ?: asset('website/templates/images/avatar.png') }}">
                </div>

                <div class="profile-name">
                    <h4>{{ auth()->user()?->name}}</h4>
                    <p>{{ auth()->user()?->email }}</p>
                </div>
            </div>
            <a href="{{route('my-profile')}}" class="btn">{{trans('website.profile.edit_information')}}    </a>
        </div>
        <!-- tabs -->

        <div class="row">

            <div class="col-md-12 col-xs-12">
                <ul class="nav nav-tabs nav-tabs-profile">
                    <li class="{{ request()->route()->getName() == 'my-favorite-products.index'? "active" :"" }}">
                        <a href="{{ route('my-favorite-products.index') }}">
                            <img src="{{ asset('website/azkataam/img/t1-a.png') }}"
                                 class="img-a mr-5">
                            <img src="{{ asset('website/azkataam/img/t1-b.png') }}" class="img-b mr-5">
                            {{trans('website.profile.menu_favourite')}}
                        </a>
                    </li>
                    <li class="{{ request()->route()->getName() == 'addresses.index'? "active" :"" }}">
                        <a href="{{ request()->route()->getName() != 'addresses.index'? route('addresses.index') : '#' }}">
                            <img loading="lazy" src="{{ asset('website/azkataam/img/t3-a.png') }}"
                                 class="img-a mr-5">
                            <img loading="lazy" src="{{ asset('website/azkataam/img/t3-b.png') }}" class="img-b mr-5">
                            {{trans('website.profile.menu_address')}}
                        </a>
                    </li>
                </ul>

                <div class="tab-content">
                    <div class="sec-title">
                        <h4 class="title">قائمة التمني</h4>
                    </div>
                    <!-- addresses -->
{{--                    @if(count(auth()->user()?->address) > 0)--}}

                        <div class="row products">
                            @foreach($products as $product)
                                <div class="col-lg-2">
                                <div class="product">
                                    @if($product['discount'])
                                        <div class="discount-percent">{{round($product['discount'] / $product['price'] * 100,2)}} <span>%</span></div>
                                    @endif
                                    <a class="wishlist add-product-to-favorite" data-id="{{$product['id']}}" href="#">
                                        <i class="fas fa-heart colorRed favorite-product-{{$product['id']}}"></i>
                                    </a>
                                    <div class="product-img"><img loading="lazy" alt="image" src="{{$product['image']}}"></div>
                                    <div class="product-content">
                                        <h4 class="product-title">
                                            <a href="{{route('products',$product['id'])}}">{{$product['name']}}</a>
                                        </h4>
                                        <div class="product-price"><span>{{$product['discount']?:$product['price']}}</span> ر.س</div>
                                        <div class="product-color">
                                            <span class="product-black"></span>
                                            <span class="product-red"></span>
                                            <span class="product-blue"></span>
                                            <span class="product-yelow"></span>
                                            <span class="product-white"></span>
                                        </div>
                                    </div>
                                    <a class="product-basket add-to-cart" data-id="{{$product['id']}}"  href="#">
                                        <i class="fas fa-plus"></i>
                                    </a>
                                </div>
                            </div>
                            @endforeach
                        </div>

{{--                    @else--}}

{{--                        <div class="no-result">--}}
{{--                            <div class="container">--}}
{{--                                <div class="row">--}}
{{--                                    <div class="col-md-12 text-center" style="height: 60vh; padding: 100px 0;">--}}
{{--                                        <h3>لا يوجد قائمة تمني لديك.</h3>--}}
{{--                                        <span>لتصفح الموقع<a href="{{ route('home-page') }}"> اضغط هنا </a></span>--}}
{{--                                    </div>--}}
{{--                                </div>--}}
{{--                            </div>--}}
{{--                        </div>--}}

{{--                    @endif--}}
                </div>
            </div>
        </div>
    </div>


    <!-- end internal-page -->
@endsection

@section('scripts')

@endsection
