<?php

namespace App\Support\FireBase;

use Illuminate\Support\Facades\Log;

class FireBaseChannel
{

    public function send($notifiable, HasFirebaseChannel $notification)
    {
        $model = $notification->toFirebase($notifiable);
        $model->setTokens($notifiable->devices->all());
        FireBase::send($model);
    }
}
