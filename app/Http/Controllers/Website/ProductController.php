<?php

namespace App\Http\Controllers\Website;

use App\Http\Controllers\Controller;
use App\Models\Product;
use Illuminate\Http\Request;

class ProductController extends Controller
{

    public function __invoke(Request $request,Product $product)
    {

        if ( $product?->id){

            $relatedProducts = Product::where('id','!=',$product->id)
                ->where(function ($pro) use ( $product){
                $pro->where('brand_id',$product->brand_id)->orWhere('category_id',$product->category_id);
            })->take(10)->get();

            return view('website.products.show',compact('product','relatedProducts'));
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
