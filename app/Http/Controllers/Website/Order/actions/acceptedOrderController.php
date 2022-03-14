<?php

namespace App\Http\Controllers\Website\Order\actions;

use App\Http\Controllers\Controller;
use App\Models\Order;
use Illuminate\Http\Request;

class acceptedOrderController extends Controller
{
    public function __invoke(Request $request,Order $order)
    {
        if ($order->status != 'pending'){

            session()->flash('my-errors','للأسف تم تغير حالة الطلب الأن لم يعد بالإمكان..');

            return redirect()->back();
        }

        $order->update(['status' => 'accepted']);

        session()->flash('success','تم قبول طلبك بنجاح');

        return redirect()->back();
    }
}
