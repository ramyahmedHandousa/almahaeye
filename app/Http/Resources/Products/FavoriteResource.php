<?php

namespace App\Http\Resources\Products;

use Illuminate\Http\Resources\Json\JsonResource;

class FavoriteResource extends JsonResource
{

    public function toArray($request)
    {
        return [
            'id'  => $this->id,
            'name' => $this->name,
            'price' => number_format($this->price,2),
            'discount' => $this->discount,
            'discount_after' => number_format($this->price - $this->discount,2),
            'discount_percentage' => $this->discountProduct(),
            'image' => $this->getFirstMediaUrl('master_image'),
            'in_cart' => false,
            'in_favourite' => true
        ];
    }

    private function discountProduct()
    {
        $discount = $this->discount;

        return $discount ? (string) round($this->discount / $this->price * 100,2) : "0";
    }
}
