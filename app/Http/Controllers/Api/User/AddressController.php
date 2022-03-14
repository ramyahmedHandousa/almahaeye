<?php

namespace App\Http\Controllers\Api\User;

use App\Http\Controllers\Api\MasterApiController;
use App\Http\Controllers\Controller;
use App\Http\Requests\Api\User\Address\StoreAddressValid;
use App\Http\Requests\Api\User\Address\UpdateAddressValid;
use App\Http\Resources\User\AddressResource;
use App\Models\Address;
use App\Support\Facade\Responder;
use Illuminate\Http\Request;

class AddressController extends MasterApiController
{
    public function __construct()
    {
        parent::__construct();

        $this->middleware('auth:api');
    }

    public function index()
    {
        return Responder::success(AddressResource::collection(auth()->user()?->address));
    }

    public function store(StoreAddressValid $request)
    {
        auth()->user()->address()->create($request->validated());

        return Responder::success(AddressResource::collection(auth()->user()?->address));
    }

    public function update(UpdateAddressValid $request,Address $address)
    {
        $address->update($request->validated());

        return Responder::success(AddressResource::collection(auth()->user()?->address));
    }

    public function destroy(Address $address)
    {

        if (auth()->id() != $address->user_id){
            return  Responder::error('unauthorized');
        }

        $address->delete();

        return Responder::success(AddressResource::collection(auth()->user()?->address));
    }
}
