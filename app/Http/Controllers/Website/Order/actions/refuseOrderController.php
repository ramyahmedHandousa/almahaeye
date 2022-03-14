<?php

namespace App\Http\Controllers\Website\Order\actions;

use App\Http\Controllers\Controller;
use App\Models\Order;
use Illuminate\Http\Request;

class refuseOrderController extends Controller
{

    public function __invoke(Request $request,Order $order)
    {
         $this->validate($request,['message' => 'required|string|max:5000']);

        if ($order->status != 'pending'){

            session()->flash('my-errors','للأسف تم تغير حالة الطلب الأن لم يعد بالإمكان..');

            return redirect()->back();
        }

        $status = auth()->user()->type === 'client' ? 'refuse_by_user' : 'refuse_by_vendor';

        $order->update(['status' => $status,'message' => $request->message]);

        session()->flash('success','تم إلغاء طلبك بنجاح');

        return redirect()->back();
    }

}
