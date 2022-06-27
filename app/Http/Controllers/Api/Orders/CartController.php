<?php

namespace App\Http\Controllers\Api\Orders;

use App\Http\Controllers\Controller;
use App\Http\Requests\Api\Cart\CartCreateOrUpdateManyValid;
use App\Http\Requests\Api\Cart\CartStoreValid;
use App\Http\Resources\Cart\CartResource;
use App\Models\Order;
use App\Models\OrderDetails;
use App\Models\Product;
use App\Models\Setting;
use App\Models\User;
use App\Support\Facade\Responder;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class CartController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth:api');
    }

    public function index()
    {
        $cart = Order::whereUserIdAndStatus(auth()->id(),'cart')->with('orderItems.product')->get();

        if (!$cart) return  Responder::success(['cart' => []]);

        return Responder::success($this->responseCart( $cart->plucK('orderItems')->flatten()));
    }

    public function store(CartStoreValid $request)
    {
        $product = Product::find($request->product_id);

        $orderCart = Order::firstOrCreate([
            'user_id' => auth()->id(),'vendor_id' => $product->user_id,'status' => 'cart'
        ]);

        OrderDetails::updateOrCreate(['order_id' => $orderCart->id, 'product_id' => $product->id,'frame_color_id' => $request->frame_color_id],[
            'user_id' => $product->user_id ,
            'price' => $product->price_percentage  ?? $product->price, 'price_discount' => $product->discount
        ]);

        $cart = auth()->user()->orders()->where('status','cart')->with('orderItems.product')->get();


        return Responder::success($this->responseCart( $cart->plucK('orderItems')->flatten()));
    }

    public function createOrUpdate(CartCreateOrUpdateManyValid $request)
    {
        foreach ($request->products as $productRequest){

            $product = Product::find($productRequest['id']);

            $orderCart = Order::firstOrCreate([
                'user_id' => auth()->id(),'vendor_id' => $product->user_id,'status' => 'cart'
            ]);

            OrderDetails::updateOrCreate(['order_id' => $orderCart->id, 'product_id' => $product->id,'frame_color_id' => $productRequest['frame_color_id']],[
                'user_id'   => $product->user_id ,
                'price'     => $product->price_percentage ?? $product->price, 'price_discount' => $product->discount,
                'quantity'  => $productRequest['quantity'] ?? DB::raw('quantity')
            ]);
        }

        $cart = auth()->user()->orders()->where('status','cart')->with('orderItems.product')->get();

        return Responder::success($this->responseCart( $cart->plucK('orderItems')->flatten()));
    }


    public function update(Request  $request,$id)
    {
        $orderDetail = OrderDetails::findOrFail($id);

        if ((int)$request->quantity){
            $orderDetail->update(['quantity' => $request->quantity]);
        }

        $cart = auth()->user()->orders()->where('status','cart')->with('orderItems.product')->get();

        return Responder::success($this->responseCart( $cart->plucK('orderItems')->flatten()));
    }

    public function destroy(Request $request,$id)
    {
        $orderDetail = OrderDetails::findOrFail($id);

        $orderDetail->delete();

        $cart = auth()->user()->orders()->where('status','cart')->with('orderItems.product')->get();

        return Responder::success($this->responseCart( $cart->plucK('orderItems')->flatten()));
    }

    private function responseCart($orderItems): array
    {
        $totalPrice = collect($orderItems)->sum(function ($product) {
            return ($product['price_discount'] ?: $product['price'] ) * $product['quantity'];
        });

        $percentage = Setting::getBody('percentage');

        $totalCart = $totalPrice;
        $totalPrice += round($totalPrice * $percentage / 100,2);

        return [
            'cart' =>   CartResource::collection($orderItems),
            'info' => [
                'total_cart' => number_format($totalCart,2),
                'percentage' => $percentage,
                'total_price' => number_format($totalPrice,2),
                'delivery_price'=> $this->calcDeliveryPrice($orderItems)
            ]
        ];
    }

    private function calcDeliveryPrice($orderItems)
    {

        $deliveryPrice = Setting::getBody('delivery_price') ? : 0;

        return User::whereIn('id', collect($orderItems)->groupBy('user_id')->keys())
            ->get(['id','delivery_price'])
            ->each(fn($user) => $user->delivery_price = $user?->delivery_price ? : $deliveryPrice)
            ->sum('delivery_price');
    }
}
