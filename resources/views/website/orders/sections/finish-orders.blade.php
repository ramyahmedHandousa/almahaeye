<div class="row">
    <!-- box -->
    @foreach($finishOrders as $order)
        <div class="col-lg-4">
        <div class="box">
            <ul class="orders-list">
                <li>
                    <span>  {{trans('website.orders.number')}}</span>
                    <span><a target="_blank" href="{{route('orders.show',$order->id)}}">{{$order->id}}</a></span>
                </li>
                <li>
                    <span>{{trans('website.orders.created_at')}}  </span>
                    <span>{{$order->created_at?->format('Y-m-d')}}</span>
                </li>
                <li>
                    <span>{{trans('website.orders.time')}}</span>
                    <span>{{$order->created_at?->diffForHumans()}}</span>
                </li>
                <li>
                    <span>{{trans('website.orders.product_count')}}  </span>
                    <span>{{$order->order_items_count}}</span>
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
    </div>
    @endforeach
</div>
