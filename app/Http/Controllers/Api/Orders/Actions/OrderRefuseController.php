<?php

namespace App\Http\Controllers\Api\Orders\Actions;

use App\classes\NotificationClass;
use App\Http\Controllers\Controller;
use App\Models\Order;
use App\Notifications\OrderNotification;
use App\Support\Facade\Responder;
use Illuminate\Http\Request;

class OrderRefuseController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth:api');
    }

    public function __invoke(Request $request,Order $order)
    {
        $this->validate($request,['message' => 'required|string|max:5000']);

        if ($order->status != 'pending'){

            return Responder::error((array)'للأسف تم تغير حالة الطلب الأن لم يعد بالإمكان..');
        }

        $status = auth()->user()->type === 'client' ? 'refuse_by_user' : 'refuse_by_vendor';

        $order->update(['status' => $status,'message' => $request->message]);

        $dataNotification  =  new NotificationClass(title: 'order.orders',message: 'order.'.$status.' order' );

        if (auth()->user()->type === 'client' ){

            $order?->vendor?->notify(new OrderNotification($order,$dataNotification));
        }else{

            $order?->user?->notify(new OrderNotification($order,$dataNotification));
        }

        return Responder::success('تم إلغاء طلبك بنجاح');
    }
}
