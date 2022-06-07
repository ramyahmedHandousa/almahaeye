<?php

namespace App\Listeners;

use App\Events\PhoneOrEmailChange;
use App\Http\Helpers\Sms;
use App\Models\VerifyUser;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Queue\InteractsWithQueue;

class PhoneOrEmailChangeListener
{


    public function __construct()
    {
        //
    }

    public function handle(PhoneOrEmailChange $event)
    {
        $email = $event->request?->email ? : $event->user?->email;

        $phone = $event->request?->phone ? : $event->user?->phone;

        $code = rand(1000,9999) ;

        $data = [ 'email' => $email,'phone' => $phone , 'action_code'  => $code  ];

        VerifyUser::updateOrCreate(['user_id' => $event->user->id], $data);

        Sms::sendMessageToPhone($phone, ' كود الخاص بك  ' . $code);

    }
}
