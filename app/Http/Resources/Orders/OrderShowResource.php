<?php

namespace App\Http\Resources\Orders;

use Illuminate\Http\Resources\Json\JsonResource;

class OrderShowResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return array|\Illuminate\Contracts\Support\Arrayable|\JsonSerializable
     */
    public function toArray($request)
    {
        $isUser = auth()->user()->type == 'client' ;

        return [
            'id'                => $this->id,
            'shipping_price'    => $this->shipping_price,
            'promo_discount'    => $this->promo_discount,
            'total_price'       => $this->total_price,
            'address'           => $this->address?->address,
            'status'            => $this->status,
            'status_translate'            => $this->status_translate,
            'tax'               => $this->tax,
            'price'             => $this->price,
            'notes'             => $this->notes,
            'message'           => $this->message,
            'created_at'        => $this->created_at ,
            'items_count'       => $this->orderItems->count(),
            'user_info'         => new OrderUserFilterResource($isUser ? $this->vendor : $this->user),
            'items'             => OrderItemsResource::collection($this->orderItems)
        ];
    }
}
