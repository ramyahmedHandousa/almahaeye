<?php

namespace App\Support\FireBase;

interface HasFirebaseChannel
{
    public function toFirebase($notifiable) : FireBaseModel;
}
