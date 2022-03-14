<?php

namespace App\Listeners;

use App\Events\PhoneOrEmailChange;
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

        $data = [ 'email' => $email,'phone' => $phone , 'action_code'  => 1111  ];

        VerifyUser::updateOrCreate(['user_id' => $event->user->id], $data);

    }
}
