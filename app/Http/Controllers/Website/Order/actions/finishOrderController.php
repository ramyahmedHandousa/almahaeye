<?php

namespace App\Http\Controllers\Website\Order\actions;

use App\Http\Controllers\Controller;
use App\Models\Order;
use Illuminate\Http\Request;

class finishOrderController extends Controller
{

    public function __invoke(Request $request,Order $order)
    {
        if ($order->status != 'accepted'){

            session()->flash('my-errors','للأسف تم تغير حالة الطلب الأن لم يعد بالإمكان..');

            return redirect()->back();
        }

        $order->update(['status' => 'finish']);

        session()->flash('success','تم إنهاء طلبك بنجاح');

        return redirect()->back();
    }
}
