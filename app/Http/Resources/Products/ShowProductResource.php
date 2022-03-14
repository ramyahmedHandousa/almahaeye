<?php

namespace App\Http\Resources\Products;

use App\Http\Resources\GlobalFilterNameResource;
use App\Models\Product;
use Illuminate\Http\Resources\Json\JsonResource;

class ShowProductResource extends JsonResource
{

    public function toArray($request)
    {
        return [
            'id'                    => $this->id,
            'name'                  => $this->name,
            'price'                 => $this->price,
            'discount'              => $this->discount,
            'discount_after'        => number_format($this->price - $this->discount,2),
            'discount_percentage'   => $this->discountProduct(),
            'image'                 => $this->getFirstMediaUrl('master_image'),
            'in_cart'               => false,
            'in_favourite'          => false,
            'category'              => new GlobalFilterNameResource($this->category),
            'brand'                 => new GlobalFilterNameResource($this->brand),
            'age'                   => new GlobalFilterNameResource($this->age),
            'product_type'          => new GlobalFilterNameResource($this->product_type),
            'frame_material'        => new GlobalFilterNameResource($this->frame_material),
            'frame_shap'            => new GlobalFilterNameResource($this->frame_shap),
            'lens_colors'           =>  GlobalFilterNameResource::collection($this->lens_colors),
            'frame_colors'          => GlobalFilterNameResource::collection($this->frame_colors),
            'media'                 => ProductImageResource::collection($this->getMedia()),
            'related_products'     => ListProductResource::collection($this->relatedProducts())
        ];
    }

    private function discountProduct()
    {
        $discount = $this->discount;

        return $discount ? (string) round($this->discount / $this->price * 100,2) : "0";
    }

    private function relatedProducts()
    {
        return Product::where('id','!=', $this->id)->where('brand_id',$this->brand_id)->take(5)->get();
    }
}
