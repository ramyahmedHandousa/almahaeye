<?php

namespace App\Http\Controllers\Website;

use App\Http\Controllers\Controller;
use App\Models\Product;
use App\Models\ProductRate;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class ProductController extends Controller
{

    public function __invoke(Request $request,Product $product)
    {
        if ( $product?->id){

            $product->load('rating.user');

            $relatedProducts = Product::where('id','!=',$product->id)
                ->where(function ($pro) use ( $product){
                $pro->where('brand_id',$product->brand_id)->orWhere('category_id',$product->category_id);
            })->take(10)->get();


            $countRatingProducts = ProductRate::where('product_id',$product->id)->select('product_id',
                DB::raw('count(*) as count'),
                DB::raw('round(AVG(rate),1) as avg_rate'),
                DB::raw('count(IF(rate = 0,1,NULL)) as  one'),
                DB::raw('count(IF(rate = 2,2.5,NULL)) as two'),
                DB::raw('count(IF(rate = 3,3.5,NULL)) as three'),
                DB::raw('count(IF(rate = 4,4.5,NULL)) as four'),
                DB::raw('count(IF(rate = 5,5,NULL))  as five')
            )->groupBy('product_id')->first();

            $rating = $product->rating;

            return view('website.products.show',compact('product','relatedProducts','countRatingProducts','rating'));
        }

        return view('website.products.search-products');
    }


    public function virtual(Product $product)
    {
        if (!$product->getFirstMediaUrl('glb')){
            return redirect()->back();
        }

        return view('website.products.virtual',compact('product'));
    }


}
