<?php

namespace App\Http\Resources\Orders;

use Illuminate\Http\Resources\Json\JsonResource;

class OrderUserFilterResource extends JsonResource
{

    public function toArray($request)
    {
        return [
            'id'            => $this->id,
            'first_name'    => $this->first_name,
            'image_profile' => $this->getFirstMediaUrl('master_image'),
        ];
    }
}
