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
            <div class="title">بيانات الطلب رقم {{$order->id}}</div>
            <div class="row">
                <!-- cart products -->
                <div class="col-lg-8">
                    <!-- cart product -->
                    @foreach($order->orderItems as $orderItem)
                    <div class="product">
                        <div class="product-img">
                            <img class="mr-5 mt-14" loading="lazy" alt="صورة المنتج"   src="{{$orderItem?->product?->getFirstMediaUrl('master_image')}}">
                        </div>
                        <div class="product-title">
                            <h4 class="title">
                                <a target="_blank"
                                   href="{{route('products',$orderItem->product_id)}}">
                                    {{$orderItem?->product?->name}} -  لون    ( {{$orderItem->color?->name }} )
                                </a>
                            </h4>
                            <div class="product-price"><span>{{$orderItem->price_discount?:$orderItem->price }}</span> ريال سعودى</div>

                        </div>
                        <div class="product-count">
                            الكمية : {{$orderItem->quantity}}
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
                                <span>رقم الطلب</span>
                                <span><a href="#">{{$order->id}}</a></span>
                            </li>
                            <li>
                                <span>إسم المستخدم</span>
                                <span>{{$order->user?->name}}</span>
                            </li>
                            <li>
                                <span>إسم البائع</span>
                                <span>{{$order->vendor?->name}}</span>
                            </li>
                            <li>
                                <span>تاريخ الطلب</span>
                                <span>{{$order->created_at?->format('Y-m-d')}}</span>
                            </li>
                            <li>
                                <span>وقت الطلب</span>
                                <span>{{$order->created_at?->diffForHumans()}}</span>
                            </li>
                            <li>
                                <span>عدد المنتج</span>
                                <span>{{$order->orderItems?->count()}}</span>
                            </li>
                            <li>
                                <span>حالة الطلب</span>
                                <span>{{$order->status_translate}}</span>
                            </li>
                            <li>
                                <span>تقييم </span>
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
                        <h5 class="title">تفاصيل العملية</h5>
                        <ul class="cart-orders-list">
                            <li>
                                <span>رقم العملية</span>
                                <span>{{$order->id}}</span>
                            </li>
                            <li>
                                <span>وقت العملية</span>
                                <span>{{$order->created_at?->format('Y/m/d')}}</span>
                            </li>
                        </ul>
                        <ul class="cart-orders-list">
                            <li>
                                <span>كوبون الخصم</span>
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
                                <span>قيمة التوصيل</span>
                                <span class="product-price"><span>{{$order->shipping_price}}</span> ريال سعودى</span>
                            </li>
                        </ul>
                        <ul class="cart-orders-list">
                            <li>
                                <span>الضريبة المضافة</span>
                                <span class="product-price"><span>{{$order->tax}}</span> %</span>
                            </li>
                        </ul>
                        <ul class="cart-orders-list">
                            <li>
                            <span>
                              الإجمالي
                              <small>شامل الضريبة المضافة</small>
                            </span>
                                <span class="product-price total"><span>{{$order->total_price}}</span> ريال سعودى</span>
                            </li>
                        </ul>
                    </div>
                </div>
            </div>
        </div>
        <!-- end internal-page -->
    </section>

@endsection
