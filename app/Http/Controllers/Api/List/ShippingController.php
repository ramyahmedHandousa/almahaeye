<?php

namespace App\Http\Controllers\Api\List;

use App\Http\Controllers\Controller;
use App\Http\Resources\GlobalFilterNameResource;
use App\Http\Resources\List\ShippingResource;
use App\Models\Shipping;
use App\Support\Facade\Responder;
use Illuminate\Http\Request;

class ShippingController extends Controller
{
    public function __invoke()
    {
        return Responder::success(ShippingResource::collection(Shipping::all()));
    }
}
