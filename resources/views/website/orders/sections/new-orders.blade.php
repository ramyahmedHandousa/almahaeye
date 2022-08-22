
<div class="row">
    <!-- box -->
    @foreach($pendingOrders as $order)
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
                    <span>{{trans('website.orders.time')}}  </span>
                    <span>{{$order->created_at?->diffForHumans()}}</span>
                </li>
                <li>
                    <span>{{trans('website.orders.product_count')}}  </span>
                    <span>{{$order->order_items_count}}</span>
                </li>
            </ul>
            <div class="row btn-rows">

                @if($order->status == 'pending' && auth()->user()->type === 'vendor')
                    @include('website.orders.actions.accepted-order')
                @endif

                @if($order->status == 'pending' )
                    @include('website.orders.actions.refuse-order')
                @endif
            </div>
        </div>
    </div>

    @endforeach
</div>
