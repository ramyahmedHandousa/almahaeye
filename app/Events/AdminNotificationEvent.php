<?php

namespace App\Events;

use Illuminate\Broadcasting\InteractsWithSockets;
use Illuminate\Contracts\Broadcasting\ShouldBroadcast;
use Illuminate\Foundation\Events\Dispatchable;
use Illuminate\Queue\SerializesModels;

class AdminNotificationEvent implements ShouldBroadcast
{
    use Dispatchable, InteractsWithSockets, SerializesModels;


    public function __construct( public  $message)
    {
    }

    public function broadcastOn()
    {
        return ['admin-channel'];
    }

    public function broadcastAs()
    {
        return 'my-admin-notification';
    }
}
