<?php

namespace App\Http\Resources\List;

use Illuminate\Http\Resources\Json\JsonResource;

class CategoryFilterResource extends JsonResource
{


    public function toArray($request)
    {
        return [
            'id' => $this->id,
            'name' => $this->name,
            'image' => $this->getFirstMediaUrl('master_image')
        ];
    }
}
