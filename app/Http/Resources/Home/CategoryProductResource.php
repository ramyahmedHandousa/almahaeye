<?php

namespace App\Http\Resources\Home;

use App\Http\Resources\Products\ListProductResource;
use Illuminate\Http\Resources\Json\JsonResource;

class CategoryProductResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return array|\Illuminate\Contracts\Support\Arrayable|\JsonSerializable
     */
    public function toArray($request)
    {
        return [
            'id'  => $this->id,
            'name' => $this->name,
            'products' => ListProductResource::collection($this->children->pluck('products'))
        ];
    }
}
