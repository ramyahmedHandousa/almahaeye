<?php

namespace App\Http\Controllers\Website;

use App\Http\Controllers\Controller;
use App\Models\Ad;
use App\Models\Category;
use App\Models\Product;
use Illuminate\Http\Request;

class CategoryController extends Controller
{

    public function __invoke(Request $request,Category $category)
    {
        if ($category?->id){
            return  redirect()->route('search',['category_id' => $category->id]);
        }


        $sliders = Ad::all();

        $category->load('children.products');

        $products = $category?->children?->pluck('products')?->collapse();

        $mainCategories = count($products) > 0 ? [] : Category::whereIsSuspended(0)->whereNull('parent_id')->get(['id']);

        $productsMostOrder = count($products) > 0 ? [] : Product::whereIsNew(1)->take(5)->latest()->get();

        $categoriesHaveProducts = count($products) > 0 ? [] : Category::whereIsSuspended(0)->whereHas('children',
            fn($child) => $child->whereHas('products'))
            ->with(['children.products' => fn($pro) => $pro->where('is_new','=',1)])->take(3)->get(['id']);

        return view('website.categories',compact('sliders','category','products',
            'mainCategories','productsMostOrder','categoriesHaveProducts'));
    }
}
