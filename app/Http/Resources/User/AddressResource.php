<?php

namespace App\Http\Resources\User;

use Illuminate\Http\Resources\Json\JsonResource;

class AddressResource extends JsonResource
{

    public function toArray($request)
    {
        return [
            'id' => $this->id,
            'notes' => $this->notes,
            'address' => $this->address,
            'latitude'  => $this->latitude,
            'longitude' => $this->longitude
        ];
    }
}
