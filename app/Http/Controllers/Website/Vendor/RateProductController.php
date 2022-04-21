<?php

namespace App\Http\Controllers\Website\Vendor;

use App\Http\Controllers\Controller;
use App\Models\ProductRate;
use App\Support\Facade\Responder;
use Illuminate\Http\Request;

class RateProductController extends Controller
{



    public function store(Request $request)
    {
        ProductRate::updateOrCreate(
            [
                'user_id' => auth()->id(),'product_id' => $request->product_id
            ],
            [
                'rate' => $request->rate ? : 0 ,'comment' => $request->comment
            ]
        );

        return Responder::executed();
    }
}
