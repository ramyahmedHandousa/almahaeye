<?php

namespace App\Http\Resources\Cart;

use App\Http\Resources\Products\ListProductResource;
use Illuminate\Http\Resources\Json\JsonResource;

class CartResource extends JsonResource
{

    public function toArray($request)
    {
        return [
            'id'        => $this->id,
            'quantity'  => $this->quantity,
            'product'   => new  ListProductResource($this->product)
        ];
    }
}
