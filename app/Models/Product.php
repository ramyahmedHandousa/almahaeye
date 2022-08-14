<?php

namespace App\Models;

use Astrotomic\Translatable\Translatable;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Spatie\MediaLibrary\HasMedia;
use Spatie\MediaLibrary\InteractsWithMedia;

class Product extends Model implements HasMedia
{
    use HasFactory , Translatable,  InteractsWithMedia;

    public $translatedAttributes = ['name','description'];

    protected $guarded = [];

    protected $appends = ['price_percentage'];

    protected $with = ['translations','media','user'];

    protected $casts = [
        'additional_data' => 'array'
    ];

    protected $dates = [
        'start_at','end_at'
    ];

    function roundUpToAny($n,$x=5) {

        return (ceil($n)%$x === 0) ? ceil($n) : round(($n+$x/2)/$x)*$x;
    }

    public function getPricePercentageAttribute($key)
    {
        if ($this->user?->percentage){

            return $this->roundUpToAny( $this->price  + ($this->user?->percentage * $this->price / 100)) ;
        }else{
            return $this->roundUpToAny($this->price); 
        }

    }

    public function user(): \Illuminate\Database\Eloquent\Relations\BelongsTo
    {
        return $this->belongsTo(User::class);
    }

    public function category()
    {
        return $this->belongsTo(Category::class);
    }

    public function brand()
    {
        return $this->belongsTo(Brand::class);
    }

    public function product_type()
    {
        return $this->belongsTo(ProductType::class);
    }

    public function frame_material()
    {
        return $this->belongsTo(FrameMaterial::class);
    }

    public function frame_shap()
    {
        return $this->belongsTo(FrameShap::class);
    }

    public function age()
    {
        return $this->belongsTo(Age::class);
    }


    public function lens_colors()
    {
        return $this->belongsToMany(Color::class,'product_lens_colors');
    }

    public function frame_colors()
    {
        return $this->belongsToMany(Color::class,'product_frame_colors');
    }

    public function rating()
    {
        return $this->hasMany(ProductRate::class);
    }
}
