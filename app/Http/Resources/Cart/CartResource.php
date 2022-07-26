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
            'color'     => $this->myColor(),
            'product'   => new  ListProductResource($this->product)
        ];
    }

    private function myColor(): array
    {
        return [
            'id' => $this->color?->id,
            'name' => $this->color?->name,
            'hash_code' => $this->color?->hash_code,
        ];
    }
}
