<?php

namespace App\Http\Resources\Orders;

use Illuminate\Http\Resources\Json\JsonResource;

class OrderItemsResource extends JsonResource
{

    public function toArray($request)
    {
        return [
            'id'                => $this->id,
            'price'             => $this->price,
            'price_discount'    => $this->price_discount,
            'quantity'          => $this->quantity,
            'product_name'      => $this->product?->name,
            'product_image'     => $this->product?->getFirstMediaUrl('master_image'),
        ];
    }
}
