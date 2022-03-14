
<div class="row">
    <!-- box -->
    @foreach($pendingOrders as $order)
        <div class="col-lg-4">
        <div class="box">
            <ul class="orders-list">
                <li>
                    <span>رقم الطلب</span>
                    <span><a target="_blank" href="{{route('orders.show',$order->id)}}">{{$order->id}}</a></span>
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
