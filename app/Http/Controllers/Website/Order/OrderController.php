<?php

namespace App\Http\Controllers\Website\Order;

use App\Http\Controllers\Controller;
use App\Http\Requests\Website\Order\OrderStoreValid;
use App\Models\Address;
use App\Models\Order;
use App\Models\OrderDetails;
use App\Models\PromoCode;
use App\Models\Setting;
use App\Models\Shipping;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Session;
use JetBrains\PhpStorm\ArrayShape;

class OrderController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }

    public function index()
    {
        $user = auth()->user();

        if ($user->type == 'client'){

            $ordersQuery =  $user->orders();
        }else{
            $ordersQuery = $user->order_vendors();
        }

        $orders = $ordersQuery->withCount('orderItems')->get();

        $pendingOrders = $orders->where('status','pending')->values();

        $acceptedOrders = $orders->where('status','accepted')->values();

        $finishOrders = $orders->where('status','finish')->values();

        $refuseOrders = $orders->whereIn('status',['refuse_by_user','refuse_by_vendor'])->values();

        return view('website.orders.index',[
            'pendingOrders'  => $pendingOrders ,
            'acceptedOrders' => $acceptedOrders,
            'finishOrders'  => $finishOrders,
            'refuseOrders'  => $refuseOrders,
        ]);
    }

    public function show(Order $order)
    {
        $order->load('orderItems.product');

        return view('website.orders.show',compact('order'));
    }


    public function store(OrderStoreValid $request)
    {
        $cart  = session()->get('cart');

        DB::beginTransaction();

        try {

            $cartProducts = collect($cart)->groupBy('user_id');

            foreach ($cartProducts as $vendorId =>  $cartProduct){

                $order = $this->createOrder($cartProduct,$vendorId,$request);

                OrderDetails::insert($this->transformProducts($cartProduct,$order));
            }

            Session::forget('cart');

            DB::commit();

            return response()->json(['status' => 200]);

        } catch (\Exception $e) {

            DB::rollback();

            return  response()->json(['status' => 500]);
        }
    }

    private function createOrder($cart,$vendorId,$request)
    {
        $shipping = Shipping::find($request->shipping_id);

        $promoCode = $request->coupon ? PromoCode::firstWhere('code',$request->coupon) : null;

        $percentage = Setting::getBody('percentage');

        $calculatorCart  = $this->calculatorTotalCart($cart,$promoCode,$percentage);

        return auth()->user()->orders()->create([
            'vendor_id'        => $vendorId,
            'address_id'        => $request->address_id,
            'shipping_id'       => $shipping?->id,
            'shipping_price'    => $shipping?->price,
            'promo_code_id'     => $promoCode?->id,
            'promo_discount'    => $calculatorCart['discount'],
            'tax'               => $percentage,
            'price'             => $calculatorCart['cartPrice'],
            'total_price'       => $calculatorCart['totalPrice'] + $shipping?->price,
            'status'            => 'pending',
            'payment'           => $request->payment ? : 'cash'
        ]);

    }



    #[ArrayShape(['cartPrice' => "mixed", 'discount' => "float|int", 'totalPrice' => "float|int|mixed"])]
    private function calculatorTotalCart($cart, $promoCode, $percentage): array
    {
        $totalCart = collect( $cart)->sum(function ($product) {
            return ($product['discount'] ?: $product['price'] ) * $product['quantity'];
        });

        $discount = $promoCode ? round($totalCart * $promoCode?->percentage /100,2) : 0;

        $totalAfterDisCount = $totalCart - $discount;

        $totalAfterDisCount +=  round(($totalAfterDisCount) * $percentage / 100,2);

        return ['cartPrice' => $totalCart,'discount' => $discount , 'totalPrice' => $totalAfterDisCount];
    }

    private function transformProducts($cart, $order)
    {
        return collect($cart)->transform(function ($product) use ($order){
           return [
               'order_id'           => $order->id,
               'user_id'            => $product['user_id'],
               'product_id'         => $product['id'],
               'quantity'           => $product['quantity'],
               'price'              => $product['price'],
               'price_discount'     => $product['discount'],
           ];
        })->toArray();

    }
}
