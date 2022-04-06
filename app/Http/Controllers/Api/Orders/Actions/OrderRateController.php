<?php

namespace App\Http\Controllers\Api\Orders\Actions;

use App\Http\Controllers\Controller;
use App\Models\Order;
use App\Support\Facade\Responder;
use Illuminate\Http\Request;

class OrderRateController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth:api');
    }

    public function __invoke(Request $request,Order $order)
    {
        $this->validate($request,[
            'rate' => 'required|min:1|max:5',
            'comment' => 'required|string|max:1000',
        ]);

        if ($order->status != 'finish'){

            return Responder::error((array)'يرجي التآكد من حاله الطلب..');
        }

        $order->update(['rate' => $request->rate,'rate_comment' => $request->comment]);

        return Responder::success('تم تقيمم طلبك بنجاح');
    }
}
