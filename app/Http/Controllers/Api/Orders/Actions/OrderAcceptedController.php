<?php

namespace App\Http\Controllers\Api\Orders\Actions;

use App\classes\NotificationClass;
use App\Http\Controllers\Controller;
use App\Models\Order;
use App\Notifications\OrderNotification;
use App\Support\Facade\Responder;
use Illuminate\Auth\Access\AuthorizationException;
use Illuminate\Http\Request;

class OrderAcceptedController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth:api');
    }

    public function __invoke(Request $request,Order $order)
    {
        throw_if(auth()->id() !== $order->vendor_id ,
            new AuthorizationException(__('Un authorized'))
        );

        if ($order->status != 'pending'){
            return Responder::error((array)'للأسف تم تغير حالة الطلب الأن لم يعد بالإمكان..');
        }

        $order->update(['status' => 'accepted']);

        $dataNotification  =  new NotificationClass(title: 'order.orders',message: 'order.accepted order' );

        $order?->user?->notify(new OrderNotification($order,$dataNotification));

        return Responder::success('تم قبول طلبك بنجاح');
    }
}
