<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Setting extends Model
{
    

    protected $primaryKey = 'key';

    protected $fillable = [
        'body', 'key'
    ];
       public $incrementing = false;
    
    public static function createOrUpdate($data, $keys)
    {
        $record = self::where($keys)->first();
        if (is_null($record)) {
            return self::create($data);
        } else {
            return self::where($keys)->update($data);
        }
    }

    public static function getBody($key)
    {
        $option = Setting::where('key', $key)->first();
        return $option?->body;
    }


}
