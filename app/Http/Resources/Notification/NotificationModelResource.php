<?php

namespace App\Http\Resources\Notification;

use Illuminate\Http\Resources\Json\JsonResource;

class NotificationModelResource extends JsonResource
{


    public function toArray($request)
    {
        return [
            'type'              =>  $this->data['type'] ?? '',
            'title'             =>  __('eye_lang.'. $this->data['title'])  ?? '',
            'body'              =>  __('eye_lang.'. $this->data['body']) ?? '',
            'related_data'      =>  $this->data['related_data'] ?: null,
            'read_at'           =>  $this['read_at']
        ];
    }
}
