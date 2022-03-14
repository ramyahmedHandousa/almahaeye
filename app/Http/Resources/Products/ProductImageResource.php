<?php

namespace App\Http\Resources\Products;

use Illuminate\Http\Resources\Json\JsonResource;

class ProductImageResource extends JsonResource
{

    public function toArray($request)
    {
        return [
            'name'      => $this->name,
            'url'       => $this->getUrl(),
        ];
    }
}
