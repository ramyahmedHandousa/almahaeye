<?php

namespace App\Models;

use Astrotomic\Translatable\Contracts\Translatable as TranslatableContract;
use Astrotomic\Translatable\Translatable;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Country extends Model implements TranslatableContract
{
    use HasFactory , Translatable;

    public $translatedAttributes = ['name'];

    protected $fillable = ['parent_id' ,'is_suspended'];

    protected $with = ['translations'];

    public function parent()
    {
        return $this->belongsTo(Country::class,'parent_id');
    }

    public function children()
    {
        return $this->hasMany(Country::class,'parent_id');
    }


}
