<?php

namespace App\Http\Controllers\Api\Orders\Actions;

use App\classes\NotificationClass;
use App\Http\Controllers\Controller;
use App\Models\Order;
use App\Notifications\OrderNotification;
use App\Support\Facade\Responder;
use Illuminate\Auth\Access\AuthorizationException;
use Illuminate\Http\Request;

class OrderFinishController extends Controller
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

        if ($order->status != 'accepted'){
            return Responder::error((array)'للأسف تم تغير حالة الطلب الأن لم يعد بالإمكان..');
        }

        $order->update(['status' => 'finish']);

        $dataNotification  =  new NotificationClass(title: 'order.orders',message: 'order.finish order' );

        $order?->user?->notify(new OrderNotification($order,$dataNotification));

        return Responder::success('تم إنهاء طلبك بنجاح');
    }
}
