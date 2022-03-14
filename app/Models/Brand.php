<?php

namespace App\Models;

use Astrotomic\Translatable\Translatable;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Spatie\MediaLibrary\HasMedia;
use Spatie\MediaLibrary\InteractsWithMedia;

class Brand extends Model implements HasMedia
{
    use HasFactory ,  Translatable , InteractsWithMedia;

    public $translatedAttributes = ['name'];

    protected $fillable = [ 'is_suspended'];

    protected $with = ['translations'];


    public function products()
    {
        return $this->hasMany(Product::class);
    }

}
