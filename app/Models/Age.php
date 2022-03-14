<?php

namespace App\Models;

use Astrotomic\Translatable\Translatable;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Age extends Model
{
    use HasFactory , Translatable;

    public $translatedAttributes = ['name'];

    protected $fillable = ['is_suspended'];

    protected $with = ['translations'];

}
