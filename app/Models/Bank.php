<?php

namespace App\Models;

use Astrotomic\Translatable\Translatable;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Spatie\MediaLibrary\HasMedia;
use Spatie\MediaLibrary\InteractsWithMedia;

class Bank extends Model implements HasMedia
{
    use HasFactory ,  Translatable , InteractsWithMedia;

    public $translatedAttributes = ['name','account_name'];

    protected $fillable = [ 'is_suspended'];

    protected $with = ['translations'];


}
