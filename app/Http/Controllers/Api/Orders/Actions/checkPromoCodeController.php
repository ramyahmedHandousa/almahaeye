<?php

namespace App\Http\Controllers\Api\Orders\Actions;

use App\Http\Controllers\Controller;
use App\Models\PromoCode;
use App\Support\Facade\Responder;
use Illuminate\Http\Request;

class checkPromoCodeController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth:api');
    }

    public function __invoke(Request $request)
    {
        if (!$request->coupon) return Responder::error((array) 'pls pass code' );

        $promoCode = PromoCode::where('end_at','>',now())->where('code',$request->coupon)->first();

        if (!$promoCode) return  Responder::error((array) 'sorry can`t find code');

        return  Responder::success(['percentage' => $promoCode->percentage]);
    }

}
