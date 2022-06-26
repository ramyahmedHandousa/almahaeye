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
        $product = Product::with(['frame_colors'])->find($request->product_id);

        $productColor =  $product->frame_colors->firstWhere('id',$request->frame_color_id) ? : $product->frame_colors->first();

        if ($product && $productColor){

            $key = $productColor?->id;

            $cart = session()->get('cart');

            $quantity = $request->quantity ? : 1;

            $firstCart = collect($cart)->where('id',$product->id)
                ->where('frame_color_id','=',$key)->first();

            if($firstCart){

                $newQuantity = $quantity + $firstCart['quantity'];

                $cart[$product->id .'-'. $key] = $this->baseModelCart($product,$newQuantity,$productColor);
            }else{

                $cart[$product->id .'-'. $key] = $this->baseModelCart($product,$quantity,$productColor);
            }

            session()->put('cart',$cart);

            return response()->json(['status' => 200,
                'data' => [
                    'total_cart' => count(session()->get('cart')),
                    'cart' => session()->get('cart')
                ]
            ]);
        }

        return response()->json(['status' => 400,'data' => null],400);
    }

    private function baseModelCart($product,$quantity,$productColor): array
    {
        return  [
            'key'                   => $product->id .'-'. $productColor?->id ,
            'frame_color_id'        =>  $productColor?->id ,
            'frame_color_name'      =>  $productColor?->name ,
            'id'                    => $product->id,
            'user_id'               => $product->user_id,
            'name'                  => $product->name,
            'price'                 =>  $product->price_percentage  ?? $product->price,
            'discount'              => $product->discount,
            'quantity'              => $quantity,
            'image'                 => $product->getFirstMediaUrl('master_image')
        ];
    }

    public function update(Request $request,Product $product)
    {
        $productColor =  $product->frame_colors->firstWhere('id',$request->frame_color_id) ? : $product->frame_colors->first();

        $cart = collect(session()->get('cart'))->keyBy('key');

        $key = $productColor?->id ;

        $cart[$product->id .'-'. $key] = $this->baseModelCart($product,$request->quantity,$productColor);

        session()->put('cart',$cart);

        return response()->json(['status' => 200,
            'data' => [
                'total_cart' => count(session()->get('cart')),
                'cart' => session()->get('cart')
            ]
        ]);
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
