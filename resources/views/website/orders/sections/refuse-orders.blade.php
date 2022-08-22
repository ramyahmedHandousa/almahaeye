

<div class="row">
    <!-- box -->
    @foreach($refuseOrders as $order)
        <div class="col-lg-4">
        <div class="box">
            <ul class="orders-list">
                <li>
                    <span>{{trans('website.orders.number')}}  </span>
                    <span><a target="_blank" href="{{route('orders.show',$order->id)}}">{{$order->id}}</a></span>
                </li>
                <li>
                    <span>{{trans('website.orders.created_at')}}  </span>
                    <span>{{$order->created_at?->format('Y-m-d')}}</span>
                </li>
                <li>
                    <span>{{trans('website.orders.time')}}   </span>
                    <span>{{$order->created_at?->diffForHumans()}}</span>
                </li>
                <li>
                    <span>{{trans('website.orders.product_count')}} </span>
                    <span>{{$order->order_items_count}}</span>
                </li>
                <li>
                    <span>{{trans('website.orders.status')}}  </span>
                    <span>{{$order->status_translate}}</span>
                </li>
                <li>
                    <span> {{trans('website.orders.refuse_message')}}  </span>
                    <span>{{ \Illuminate\Support\Str::limit($order->message,20,'...') ? : trans('website.orders.not_found_msg')}}</span>
                </li>
            </ul>
        </div>
    </div>
    @endforeach
</div>
