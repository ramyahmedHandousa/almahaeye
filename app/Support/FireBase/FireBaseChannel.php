<?php

namespace App\Support\FireBase;


class FireBaseChannel
{

    public function send($notifiable, HasFirebaseChannel $notification)
    {
        $model = $notification->toFirebase($notifiable);
        $model->setTokens($notifiable->devices->all());
        FireBase::send($model);
    }
}
