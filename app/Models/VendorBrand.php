<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Spatie\MediaLibrary\HasMedia;
use Spatie\MediaLibrary\InteractsWithMedia;

class VendorBrand extends Model  implements HasMedia
{
    use HasFactory , InteractsWithMedia;

    protected $with  = ['media'];

    protected $guarded = [];

    public function brand()
    {
        return $this->belongsTo(Brand::class);
    }

    public function product_type()
    {
        return $this->belongsTo(ProductType::class);
    }
}
