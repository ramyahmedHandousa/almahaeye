<?php

namespace App\Http\Resources\List;

use Illuminate\Http\Resources\Json\JsonResource;

class CountryFilterResource extends JsonResource
{
    public function toArray($request)
    {
        return [
            'id' => $this->id,
            'name' => $this->name
        ];
    }
}
