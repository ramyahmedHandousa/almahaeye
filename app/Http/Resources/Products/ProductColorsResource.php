<?php

namespace App\Http\Resources\Products;

use Illuminate\Http\Resources\Json\JsonResource;

class ProductColorsResource extends JsonResource
{

    public function toArray($request)
    {
        return [
            'id' => $this->id,
            'name'  =>$this->name,
            'hash_code' => $this->hash_code
        ];
    }
}
