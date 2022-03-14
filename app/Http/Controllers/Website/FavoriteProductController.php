<?php

namespace App\Http\Controllers\Website;

use App\Http\Controllers\Controller;
use App\Models\Product;
use App\Models\Setting;
use Illuminate\Http\Request;

class FavoriteProductController extends Controller
{
    public function index()
    {
        $wishlist = session()->get('wishlist');

        if (!$wishlist || count($wishlist) <= 0){
            return redirect()->route('home-page');
        }

        $products = collect($wishlist)->values();


        return view('website.products.favorite',compact('products'));
    }


    public function store(Request $request)
    {
        $product = Product::find($request->product_id);

        if ($product){

            $wishlist = session()->get('wishlist');
             ;
            if(collect($wishlist)->contains('id',$product->id)){

                $removeFromWishList = collect($wishlist)->values()->toArray();

                array_splice($removeFromWishList,
                    array_search($request->product_id,
                        array_column($removeFromWishList,'id'))
                    ,1);

                session()->put('wishlist',collect($removeFromWishList)->keyBy('id'));


            }else{

                $wishlist[$product->id] = [
                    'id'            => $product->id,
                    'product_id'    => $product->id,
                    'user_id'       => $product->user_id,
                    'name'          => $product->name,
                    'price'         => $product->price,
                    'discount'      => $product->discount,
                    'quantity'      => $product->quantity,
                    'image'         => $product->getFirstMediaUrl('master_image')
                ];

                session()->put('wishlist',$wishlist);
            }

            return response()->json([
                'status' => 200,
                'data' => [
                    'total_wishlist'  => count(session()->get('wishlist')),
                    'wishlist'      => session()->get('wishlist')
                ]
            ]);
        }

        return response()->json(['status' => 400,'data' => null],400);
    }
}
