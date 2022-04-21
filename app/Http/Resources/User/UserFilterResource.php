<?php

namespace App\Http\Resources\User;

use Illuminate\Http\Resources\Json\JsonResource;

class UserFilterResource extends JsonResource
{

    public function toArray($request)
    {
        return [
            'id'            => $this->id,
            'first_name'    => $this->first_name,
            'last_name'     => $this->last_name,
            'image_profile' => $this->getFirstMediaUrl('master_image'),
        ];
    }
}
