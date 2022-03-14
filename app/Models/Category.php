<?php

namespace App\Models;

use Astrotomic\Translatable\Translatable;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Spatie\MediaLibrary\HasMedia;
use Spatie\MediaLibrary\InteractsWithMedia;

class Category extends Model implements HasMedia
{
    use HasFactory , Translatable , InteractsWithMedia;

    public $translatedAttributes = ['name'];

    protected $fillable = ['parent_id' ,'is_suspended'];

    protected $with = ['translations','media'];

    public function parent()
    {
        return $this->belongsTo(Category::class,'parent_id');
    }

    public function children()
    {
        return $this->hasMany(Category::class,'parent_id');
    }

    public function products()
    {
        return $this->hasMany(Product::class);
    }
}
