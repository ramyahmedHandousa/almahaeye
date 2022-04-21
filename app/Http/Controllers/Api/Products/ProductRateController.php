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
use Illuminate\Support\Facades\DB;

class ProductRateController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth:api')->except('index');
    }

    public function index(ValidExitProduct $request)
    {
        $rating = ProductRate::whereProductId($request->product_id)->whereNull('parent_id')->with('user','children')->get();

        $countRatingProducts = ProductRate::where('product_id',$request->product_id)->select('product_id',
            DB::raw('count(*) as count'),
            DB::raw('round(AVG(rate),1) as avg_rate'),
            DB::raw('count(IF(rate = 0,1,NULL)) as  one'),
            DB::raw('count(IF(rate = 2,2.5,NULL)) as two'),
            DB::raw('count(IF(rate = 3,3.5,NULL)) as three'),
            DB::raw('count(IF(rate = 4,4.5,NULL)) as four'),
            DB::raw('count(IF(rate = 5,5,NULL))  as five')
        )->groupBy('product_id')->first();

        return Responder::success([
            'info' => $countRatingProducts,
            'data' => RatingProductResource::collection($rating)
        ]);
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
