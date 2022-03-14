<?php

namespace App\Http\Controllers\Api\List;

use App\Http\Controllers\Api\MasterApiController;
use App\Http\Resources\GlobalFilterNameResource;
use App\Models\Brand;
use App\Support\Facade\Responder;

class BrandController extends MasterApiController
{
    public function __invoke()
    {
        return Responder::success(GlobalFilterNameResource::collection(Brand::all()));
    }
}
