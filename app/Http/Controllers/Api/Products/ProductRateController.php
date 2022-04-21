<?php

namespace App\Http\Controllers\Api\Products;

use App\Http\Controllers\Controller;
use App\Http\Requests\Api\Products\Rate\StoreRateProduct;
use App\Http\Requests\Api\Products\Rate\UpdateRateProduct;
use App\Http\Requests\Api\Products\ValidExitProduct;
use App\Http\Resources\Products\RatingProductResource;
use App\Models\ProductRate;
use App\Support\Facade\Responder;
use Illuminate\Http\Request;

class ProductRateController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth:api');
    }

    public function index(ValidExitProduct $request)
    {
        $rating = ProductRate::whereProductId($request->product_id)->whereNull('parent_id')->with('user','children')->get();

        return Responder::success(RatingProductResource::collection($rating));
    }

    public function show($id)
    {
        $rate = ProductRate::findOrFail($id);

        return Responder::success(new RatingProductResource($rate));
    }

    public function store(StoreRateProduct $request)
    {
        $rate = ProductRate::updateOrCreate(
            [
                'user_id' => auth()->id(),'product_id' => $request->product_id , 'parent_id' => $request->parent_id
            ],
            [
                'rate' => $request->rate ? : 0 ,'comment' => $request->comment
            ]
        );

        return Responder::success(new RatingProductResource($rate));
    }

    public function update(UpdateRateProduct $request,$id)
    {
        $rate = ProductRate::findOrFail($id);

        $rate->update(['rate' => $request->rate ? : $rate->rate ,'comment' => $request->comment]);

        return Responder::success(new RatingProductResource($rate));
    }


    public function destroy(Request $request,$id)
    {
        $rate = ProductRate::findOrFail($id);

        $rate->delete();

        return Responder::executed();
    }


}
