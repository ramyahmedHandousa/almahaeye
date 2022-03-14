

<div class="row">
    <!-- box -->
    @foreach($refuseOrders as $order)
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
                <li>
                    <span>حالة الطلب</span>
                    <span>{{$order->status_translate}}</span>
                </li>
                <li>
                    <span>سبب الرفض</span>
                    <span>{{ \Illuminate\Support\Str::limit($order->message,20,'...') ? : 'لايوجد '}}</span>
                </li>
            </ul>
        </div>
    </div>
    @endforeach
</div>
