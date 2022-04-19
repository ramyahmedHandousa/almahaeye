<?php

namespace App\Http\Controllers\Api;

use App\classes\NotificationClass;
use App\Models\ContactUs;
use App\Models\Order;
use App\Models\Setting;
use App\Models\User;
use App\Notifications\OrderNotification;
use App\Support\Facade\Responder;
use App\Support\FireBase\FireBase;
use Illuminate\Http\Request;

class SettingsController extends MasterApiController
{

    public function __invoke($key)
    {

        return Responder::success([$key => Setting::getBody($key.'_'.app()->getLocale())]);
    }


    public function contactUs(Request $request)
    {

        $this->validate($request,[
            'message' => 'required'
        ]);

        $user = User::whereApiToken($request->bearerToken())->first();


        ContactUs::create([
            'user_id'   => $user?->id,
            'name'      => $request->name,
            'phone'     => $request->phone,
            'email'     => $request->email,
            'message'   => $request->message,
        ]);

        return Responder::success('success');
    }

    public function testNotification()
    {

//        $data = ['dNyvu_8vS_WqfsLWemimFY:APA91bFEVEy3rxAz1RI8Uzqmgx8r44ub35DMg7jLX4qAjS6-Z_vJliTER1kMJ2gg68YgE0vz9GNHBheH7H2IbtQjvlcB0TY50qvCQ3nzU6cH_qEd9no4Y16zVpCUqOQhMTnwlcX-xwFt'];

//        return FireBase::usingTokens($data,['title' => 'testing','body' => 'bola','ramy' => 'testing now'],true);

        $order = Order::find(5);
//
        $dataNotification  =  new NotificationClass(title: 'order.orders',message: 'order.new order' );

        $order?->user?->notify(new OrderNotification($order,$dataNotification));
//
//        return 'ok';

//        return FireBase::usingTopic('public_notification','topic','public notification channel');

    }

}
