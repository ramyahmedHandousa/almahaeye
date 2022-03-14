<?php

namespace App\Http\Controllers\Api\Products;

use App\Http\Controllers\Controller;
use App\Http\Requests\Api\Products\StoreFavoriteProduct;
use App\Http\Resources\Products\FavoriteResource;
use App\Support\Facade\Responder;
use Illuminate\Http\Request;

class FavoriteProductController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth:api');
    }

    public function index()
    {
        $products = auth()->user()->favorite_products;

        return Responder::success(FavoriteResource::collection($products));
    }

    public function store(StoreFavoriteProduct $request)
    {
        auth()->user()->favorite_products()->toggle($request->product_id);

        $products = auth()->user()->favorite_products;

        return Responder::success(FavoriteResource::collection($products));
    }
}
