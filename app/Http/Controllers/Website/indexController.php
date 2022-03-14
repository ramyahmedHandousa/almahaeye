<?php

namespace App\Http\Controllers\Website;

use App\Http\Controllers\Controller;
use App\Models\Category;
use App\Models\Product;
use Illuminate\Http\Request;

class indexController extends Controller
{

    public function __invoke()
    {
        $mainCategories = Category::whereIsSuspended(0)->whereNull('parent_id')->get(['id']);

        $productsMostOrder = Product::take(10)->with('brand')->latest()->get();

        $categoriesHaveProducts = Category::whereIsSuspended(0)->whereHas('children',
                                                            fn($child) => $child->whereHas('products'))
            ->with(['children.products'])->take(3)->get(['id']);


        $offers = Product::with('brand')->where('discount','!=',0)->get();

        return view('website.home',compact('mainCategories','productsMostOrder','categoriesHaveProducts','offers'));
    }
}
