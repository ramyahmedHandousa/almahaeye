<?php

namespace App\Http\Controllers\Api;

use App\Http\Resources\List\CategoryFilterResource;
use App\Http\Resources\Products\ListProductResource;
use App\Models\Category;
use App\Models\Product;
use App\Support\Facade\Responder;

class HomePageController extends MasterApiController
{
    public function __invoke()
    {
        $sliders = $this->sliders();

        $mainCategories = Category::whereIsSuspended(0)->whereNull('parent_id')->get(['id']);

        $productsMostOrder = Product::take(5)->latest()->withAvg('rating','rate')->get();

        $offers = Product::where('discount','!=',0)->withAvg('rating','rate')->get();

        $data = [
            'sliders'                   => $sliders,
            'categories'                =>  CategoryFilterResource::collection($mainCategories),
            'most_order_products'       => ListProductResource::collection($productsMostOrder),
            'offers'                    => ListProductResource::collection($offers),
            'new_product_of_categories' => $this->newProductOfCategories()
        ];

        return Responder::success($data);
    }

    private function sliders()
    {
        return [
            [
                'id' => 1,
                'image' => asset('website/templates/images/banner.jpg'),
                'action' => null
            ],
            [
                'id' => 2,
                'image' => asset('website/templates/images/banner.jpg'),
                'action' => null
            ]
        ];
    }

    private function newProductOfCategories()
    {
        $categoriesHaveProducts = Product::whereHas('category',fn($category) => $category->whereHas('parent'))
            ->with('category.parent')
            ->withAvg('rating','rate')
            ->get()
            ->groupBy('category.parent.id')->take(3);


        return collect($categoriesHaveProducts)->transform(function ($product,$key){
           return [
               'id' => $key,
               'name' => $product->first()?->category?->parent?->name,
               'products' => ListProductResource::collection($product)
           ];
        })->values();
    }
}
