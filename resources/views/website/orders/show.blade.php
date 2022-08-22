@extends('website.layouts.master')

@section('content')

    <section class="cart">
        <!-- start internal-page -->

        @if ($errors->any())
            <div class="alert alert-danger">
                <ul>
                    @foreach ($errors->all() as $error)
                        <li>{{ $error }}</li>
                    @endforeach
                </ul>
            </div>
        @endif

        <div class="container">
            <div class="title">{{trans('website.orders.details_number')}}     {{$order->id}}</div>
            <div class="row">
                <!-- cart products -->
                <div class="col-lg-8">
                    <!-- cart product -->
                    @foreach($order->orderItems as $orderItem)
                    <div class="product">
                        <div class="product-img">
                            <img class="mr-5 mt-14" loading="lazy" alt="{{trans('website.orders.image')}}  "   src="{{$orderItem?->product?->getFirstMediaUrl('master_image')}}">
                        </div>
                        <div class="product-title">
                            <h4 class="title">
                                <a target="_blank"
                                   href="{{route('products',$orderItem->product_id)}}">
                                    {{$orderItem?->product?->name}} -  {{trans('website.orders.color')}}    ( {{$orderItem->color?->name }} )
                                </a>
                            </h4>
                            <div class="product-price"><span>{{$orderItem->price_discount?:$orderItem->price }}</span>{{trans('website.orders.sr')}}</div>

                        </div>
                        <div class="product-count">
                            {{trans('website.orders.quantity')}} : {{$orderItem->quantity}}
                        </div>
                    </div>
                    @endforeach


                    <div class="row btn-rows">


                        @if($order->status == 'pending')
                            @include('website.orders.actions.refuse-order')
                        @endif

                        @if($order->status == 'pending' && auth()->user()->type === 'vendor')
                            @include('website.orders.actions.accepted-order')
                        @endif

                        @if($order->status == 'accepted' && auth()->user()->type === 'vendor')
                            @include('website.orders.actions.finish-order')
                        @endif


                        <div class="col-lg-6">
                            <a style="background-color: #a5eb6c;margin: 1%" class="btn btn-gray" href="{{route('orders.index')}}">رجوع</a>
                        </div>
                    </div>


                </div>
                <div class="col-lg-4">
                    <div class="box">
                        <ul class="orders-list">
                            <li>
                                <span>  {{trans('website.orders.number')}} </span>
                                <span><a href="#">{{$order->id}}</a></span>
                            </li>
                            <li>
                                <span> {{trans('website.orders.user_name')}}  </span>
                                <span>{{$order->user?->name}}</span>
                            </li>
                            <li>
                                <span>{{trans('website.orders.vendor_name')}}   </span>
                                <span>{{$order->vendor?->name}}</span>
                            </li>
                            <li>
                                <span>{{trans('website.orders.created_at')}}  </span>
                                <span>{{$order->created_at?->format('Y-m-d')}}</span>
                            </li>
                            <li>
                                <span>{{trans('website.orders.time')}}  </span>
                                <span>{{$order->created_at?->diffForHumans()}}</span>
                            </li>
                            <li>
                                <span>{{trans('website.orders.product_count')}}  </span>
                                <span>{{$order->orderItems?->count()}}</span>
                            </li>
                            <li>
                                <span>{{trans('website.orders.status')}}  </span>
                                <span>{{$order->status_translate}}</span>
                            </li>
                            <li>
                                <span>{{trans('website.orders.rate')}} </span>
                                <span>
                                  <div class="stars">
                                    <span class="total">4.35 </span>
                                    <i class="fas fa-star yellow"></i>
                                    <i class="fas fa-star yellow"></i>
                                    <i class="fas fa-star yellow"></i>
                                    <i class="fas fa-star yellow"></i>
                                    <i class="fas fa-star"></i>
                                  </div>
                                </span>
                            </li>
                        </ul>
                    </div>
                    <div class="box cart-orders">
                        <h5 class="title">{{trans('website.orders.details_process')}}  </h5>
                        <ul class="cart-orders-list">
                            <li>
                                <span>{{trans('website.orders.number')}}</span>
                                <span>{{$order->id}}</span>
                            </li>
                            <li>
                                <span>{{trans('website.orders.time')}}  </span>
                                <span>{{$order->created_at?->format('Y/m/d')}}</span>
                            </li>
                        </ul>
                        <ul class="cart-orders-list">
                            <li>
                                <span>{{trans('website.orders.coupon')}}  </span>
                                <span>{{$order?->promoCode?->code ?? '-----'}}</span>
                            </li>
                        </ul>
{{--                        <ul class="cart-orders-list">--}}
{{--                            <li>--}}
{{--                                <span>الشحن</span>--}}
{{--                                <span class="product-price"><span>{{$order->shipping_price}}</span> ريال سعودى</span>--}}
{{--                            </li>--}}
{{--                        </ul>--}}
                        <ul class="cart-orders-list">
                            <li>
                                <span>{{trans('website.orders.coupon')}}  </span>
                                <span class="product-price"><span>{{$order->shipping_price}}</span> {{trans('website.orders.sr')}}  </span>
                            </li>
                        </ul>
                        <ul class="cart-orders-list">
                            <li>
                                <span>   {{trans('website.orders.tax')}}</span>
                                <span class="product-price"><span>{{$order->tax}}</span> %</span>
                            </li>
                        </ul>
                        <ul class="cart-orders-list">
                            <li>
                            <span>
                               {{trans('website.orders.total')}}
                              <small> {{trans('website.orders.total_with_tax')}}</small>
                            </span>
                                <span class="product-price total"><span>{{$order->total_price}}</span> {{trans('website.orders.sr')}}  </span>
                            </li>
                        </ul>
                    </div>
                </div>
            </div>
        </div>
        <!-- end internal-page -->
    </section>

@endsection
