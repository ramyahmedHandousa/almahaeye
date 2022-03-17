<?php

namespace App\Http\Resources\Orders;

use Illuminate\Http\Resources\Json\JsonResource;

class OrderNotificationModelResource extends JsonResource
{

    public function toArray($request)
    {
        $isUser = auth()->user()?->type == 'client' ;

        return [
            'id'            => $this->id,
            'created_at'    => $this->created_at,
            'total_price'   => number_format($this->total_price,2),
            'status'        => $this->status,
            'items_count'   => $this->order_items_count,
            'user_info'         => new OrderUserFilterResource($isUser ? $this->vendor : $this->user),
        ];
    }
}
