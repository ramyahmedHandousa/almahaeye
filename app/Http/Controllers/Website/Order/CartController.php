<?php

namespace App\Http\Controllers\Website\Order;

use App\Http\Controllers\Controller;
use App\Models\Product;
use App\Models\PromoCode;
use App\Models\Setting;
use App\Models\Shipping;
use Illuminate\Http\Request;

class CartController extends Controller
{


    public function index()
    {
        $cart = session()->get('cart');

        if (!$cart || count($cart) <= 0){
            return redirect()->route('home-page');
        }

        $products = collect($cart)->values();

        $totalPrice = $products->sum(function ($product) {
            return ($product['discount'] ?: $product['price'] ) * $product['quantity'];
        });

        $percentage = Setting::getBody('percentage');

        $totalPrice += round($totalPrice * $percentage / 100,2);

        $shipping = Shipping::all();

        return  view('website.cart.index',compact('products','totalPrice','percentage','shipping'));
    }

    public function store(Request $request)
    {
        $product = Product::find($request->product_id);

        if ($product){

            $cart = session()->get('cart');

            $quantity = $request->quantity ? : 1;

            if(collect($cart)->contains('id',$product->id)){

                $firstCart = collect($cart)->firstWhere('id','=',$product->id);

                $cart[$product->id] = $this->baseModelCart($product,$quantity + $firstCart['quantity']);
            }else{

                $cart[$product->id] = $this->baseModelCart($product,$quantity);
            }


            session()->put('cart',$cart);

            return response()->json(['status' => 200,
                'data' => [
                    'total_cart' => count(session()->get('cart')),
                    'cart' => session()->get('cart')
                ]]);
        }

        return response()->json(['status' => 400,'data' => null],400);
    }

    private function baseModelCart($product,$quantity): array
    {
        return [
            'id'        => $product->id,
            'user_id'   => $product->user_id,
            'name'      => $product->name,
            'price'     => $product->price,
            'discount'  => $product->discount,
            'quantity'  => $quantity,
            'image'     => $product->getFirstMediaUrl('master_image')
        ];
    }
    public function update(Request $request,Product $product)
    {
        $cart = collect(session()->get('cart'))->keyBy('id');

        $cart[$product->id] = $this->baseModelCart($product,$request->quantity);

        session()->put('cart',$cart);

        return response()->json(['status' => 200,
            'data' => [
                'total_cart' => count(session()->get('cart')),
                'cart' => session()->get('cart')
            ]]);

    }

    public function destroy(Request $request)
    {
        $cart = collect(session()->get('cart'))->values()->toArray();

        array_splice($cart,
            array_search($request->product_id,
                array_column($cart,'id'))
            ,1);

        session()->put('cart',collect($cart)->keyBy('id'));

        return response()->json(['status' => 200,'data' => [
            'cart' => session()->get('cart'),
            'total_cart' => count(session()->get('cart'))
        ]]);
    }


    public function checkCode(Request $request)
    {
        $promoCode = PromoCode::where('end_at','>',now())->where('code',$request->code)->first();
        if (!$promoCode){
            return response()->json(['status' => 400],400);
        }

        $totalCart = collect( session()->get('cart'))->sum(function ($product) {
            return ($product['discount'] ?: $product['price'] ) * $product['quantity'];
        });

        $discount = round($totalCart * $promoCode->percentage /100,2);

        $percentage = Setting::getBody('percentage');

        $totalCart += round(($totalCart - $discount) * $percentage / 100,2);

        return response()->json(['data' => [
            'code'          => $request->code ,
            'percentage'    => $promoCode->percentage,
            'discount'         =>  $discount,
            'total_price'      => round($totalCart - $discount,2),
        ]]);

    }
}
