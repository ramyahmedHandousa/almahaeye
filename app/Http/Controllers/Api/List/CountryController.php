<?php

namespace App\Http\Controllers\Api\List;

use App\Http\Controllers\Api\MasterApiController;
use App\Http\Resources\List\CountryFilterResource;
use App\Models\Country;
use App\Support\Facade\Responder;
use Illuminate\Http\Request;

class CountryController extends MasterApiController
{
   public function __invoke(Request $request)
   {
       $countryQuery = Country::query();

       if ($request->countryId){

           $countryQuery->where('parent_id','=',$request->countryId);

       }else{

           $countryQuery->whereNull('parent_id');
       }

       return Responder::success(CountryFilterResource::collection($countryQuery->get()));
   }
}
