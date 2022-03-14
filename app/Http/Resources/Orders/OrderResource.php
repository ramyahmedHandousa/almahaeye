<?php

namespace App\Http\Resources\Orders;

use Illuminate\Http\Resources\Json\JsonResource;

class OrderResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return array|\Illuminate\Contracts\Support\Arrayable|\JsonSerializable
     */
    public function toArray($request)
    {
        return [
            'id'            => $this->id,
            'created_at'    => $this->created_at,
            'address'       => $this->address?->address,
            'total_price'   => $this->total_price,
            'status'        => $this->status,
            'status_translate'            => $this->status_translate,
            'items_count'   => $this->order_items_count
        ];
    }
}
