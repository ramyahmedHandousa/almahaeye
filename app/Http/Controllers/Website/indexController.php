<?php

namespace App\Http\Controllers\Website;

use App\Http\Controllers\Controller;
use App\Models\Ad;
use App\Models\Category;
use App\Models\Product;
use Illuminate\Http\Request;

class indexController extends Controller
{

    public function __invoke()
    {

        $sliders = Ad::all();

        $mainCategories = Category::whereIsSuspended(0)->whereNull('parent_id')->get(['id']);

        $productsMostOrder = Product::whereIsNew(1)->take(10)->with('brand')->latest()->get();

        $categoriesHaveProducts = Category::whereIsSuspended(0)
            ->whereHas('children', fn($child) => $child->whereHas('products',fn($pro) => $pro->where('is_new','=',1)))
            ->with(['children.products' => fn($pro) => $pro->where('is_new','=',1)])->take(3)->get(['id']);


        $offers = Product::whereIsNew(1)->with('brand')->where('discount','!=',0)->get();

        return view('website.home',compact('sliders','mainCategories','productsMostOrder','categoriesHaveProducts','offers'));
    }
}
