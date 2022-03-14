<?php

namespace App\Notifications;

use App\Http\Resources\Orders\OrderNotificationModelResource;
use App\Support\FireBase\FireBaseChannel;
use App\Support\FireBase\FireBaseModel;
use App\Support\FireBase\HasFirebaseChannel;
use Illuminate\Notifications\Notification;

class OrderNotification extends Notification implements HasFirebaseChannel
{
    public function __construct(public $order,public $dataPass)
    {}

    public function via($notifiable)
    {
        return [ 'database',
//            FireBaseChannel::class
        ];
    }

    public function toArray($notifiable)
    {
        return $this->dataSendToUser($notifiable);
    }

    public function toFirebase($notifiable): FireBaseModel
    {

        return $this->arrayToFireBase($notifiable);
    }

    private function arrayToFireBase($notifiable)
    {

        $orderModel  = ['order' => (new OrderNotificationModelResource($this->order))->resolve(request())] ;

        return new FireBaseModel(
            'order',
            $this->dataPass->title,
            $this->dataPass->message,
            $orderModel
        );
    }


    private function dataSendToUser($notifiable): array
    {
        return $this->dataPass->relatedData ??  $this->getData($notifiable);
    }

    private function getData($notifiable): array
    {
        $data = [];
        $data['type']           = 'order';
        $data['title']          = $this->dataPass->title;
        $data['message']        = $this->dataPass->message;
        $data['related_data']   = ['order' => new OrderNotificationModelResource($this->order)];
        return $data;
    }
}
