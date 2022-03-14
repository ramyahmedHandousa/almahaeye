<?php

namespace App\Http\Controllers\Api\List;

use App\Http\Controllers\Controller;
use App\Http\Resources\GlobalFilterNameResource;
use App\Models\ProductType;
use App\Support\Facade\Responder;

class ProductTypeController extends Controller
{
   public function __invoke()
   {
       return Responder::success(GlobalFilterNameResource::collection(ProductType::all()));
   }
}
