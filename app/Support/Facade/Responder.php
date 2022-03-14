<?php

namespace App\Support\Facade;

use Illuminate\Support\Facades\Facade;

/**
 * @method static \Illuminate\Http\JsonResponse executed()
 * @method static \Illuminate\Http\JsonResponse failed()
 * @method static \Illuminate\Http\JsonResponse success($body, int $code = 200, array $extra = [])
 * @method static \Illuminate\Http\JsonResponse error($body,   $code = 400, array $extra = [])
 * @method static \Illuminate\Http\JsonResponse base()
 * @see \App\Support\JsonResponder
 */
class Responder extends Facade
{
    protected static function getFacadeAccessor()
    {
        return 'responder';
    }
}
