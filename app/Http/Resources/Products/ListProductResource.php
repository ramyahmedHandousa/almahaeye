<?php

namespace App\Http\Resources\Products;

use Illuminate\Http\Resources\Json\JsonResource;

class ListProductResource extends JsonResource
{


    public function toArray($request)
    {
        return [
            'id'                    => $this->id,
            'name'                  => $this->name ? : $this->brand?->name,
            'price'                 => number_format( $this->price_percentage  ?? $this->price ,2),
            'avg_rate'              => (float) number_format($this->rating_avg_rate,2),
            'discount'              => $this->discount,
            'discount_after'        => number_format(($this->price_percentage  ?? $this->price) - $this->discount,2),
            'discount_percentage'   => $this->discountProduct(),
            'image'                 => $this->getFirstMediaUrl('master_image'),
            'frame_colors'          => ProductColorsResource::collection($this->frame_colors),
            'in_cart'               =>  $this->in_cart ?? false,
            'in_favourite'          =>  $this->in_favourite ?? false
        ];
    }

    private function discountProduct()
    {
        $discount = $this->discount;

        return $discount ? (string) round($this->discount / $this->price * 100,2) : "0";
    }
}
