<?php

namespace App\Http\Controllers\Api\Orders;

use App\classes\NotificationClass;
use App\Http\Controllers\Controller;
use App\Http\Resources\Orders\OrderResource;
use App\Http\Resources\Orders\OrderShowResource;
use App\Models\Order;
use App\Models\Address;
use App\Models\Shipping;
use App\Models\Setting;
use App\Models\PromoCode;
use App\Notifications\OrderNotification;
use App\Support\Facade\Responder;
use App\traits\paginationTrait;
use Illuminate\Http\Request;

class OrderController extends Controller
{
    use paginationTrait;

    public function __construct()
    {
        $this->middleware('auth:api');
    }

    public function index(Request $request)
    {
        $user = $request->user();

        $ordersQuery = $user->type == 'client' ? $user->orders(): $user->order_vendors();

        $this->filterQuery($request,$ordersQuery);

        $totalCount = $ordersQuery->count();

        $this->pagination_query($request,$ordersQuery);

        $data =  $ordersQuery->withCount('orderItems')->with('address')->get();

        return Responder::success(['total_count' => $totalCount,'data' => OrderResource::collection($data)]);
    }

    private function filterQuery($request,$ordersQuery)
    {
        if ($request->has('filter')&& in_array($request->filter,['pending','accepted','finish','refuse'])){

            if ($request->filter == 'refuse'){
                $ordersQuery->whereIn('status',['refuse_by_user','refuse_by_vendor']);
            }else{
                $ordersQuery->where('status','=',$request->filter);
            }
        }else{
            $ordersQuery->where('status','=','pending');
        }
    }

    public function show(Order $order)
    {
        $order->load('orderItems.product');

        return Responder::success( new OrderShowResource($order));
    }

    public function store(Request $request){

         $user = $request->user();

        $orders =  $user->orders()->whereStatus('cart')->withCount('orderItems')->get();

        if(count($orders) == 0){

            return Responder::error((array)' cart empty');
        }

        $address = Address::findOrFail($request->address_id);

        $shipping  = Shipping::findOrFail($request->shipping_id);

        $promoCode = $request->coupon ? PromoCode::firstWhere('code',$request->coupon) : null;

        $percentage = Setting::getBody('percentage');

        foreach($orders as $order){

            $totalCart = collect( $order->orderItems)->sum(function ($product) {
                 return ($product['price_discount'] ?: $product['price'] ) * $product['quantity'];
            });

            $discount = $promoCode ? round($totalCart * $promoCode?->percentage /100,2) : 0;

            $totalAfterDisCount = $totalCart - $discount;

            $totalAfterDisCount +=  round(($totalAfterDisCount) * $percentage / 100,2);

            $data = [
                'address_id'        => $request->address_id,
                'shipping_id'       => $shipping?->id,
                'shipping_price'    => $shipping?->price,
                'promo_code_id'     => $promoCode?->id,
                'promo_discount'    => $discount,
                'tax'               => $percentage,
                'price'             => $totalCart,
                'total_price'       => $totalAfterDisCount + $shipping?->price,
                'status'            => 'pending',
                'payment'           => $request->payment ? : 'cash'
            ];

            $order->update($data);

            $dataNotification  =  new NotificationClass(title: 'order.orders',message: 'order.new order' );

            $order?->vendor?->notify(new OrderNotification($order,$dataNotification));

        }

        return Responder::success('تم عمل طلبك بنجاح');
    }




}
