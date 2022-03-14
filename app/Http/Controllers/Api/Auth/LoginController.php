<?php

namespace App\Http\Controllers\Api\Auth;

use App\Http\Controllers\Controller;
use App\Http\Requests\Api\Auth\LoginValid;
use App\Http\Resources\User\UserResource;
use App\Http\Resources\Vendor\VendorResource;
use App\Support\Facade\Responder;

class LoginController extends Controller
{
    public function __invoke(LoginValid $request)
    {
        $user = auth()->user();

        $data = $user->type == 'vendor' ? new VendorResource($user) : new UserResource($user);

        return  Responder::success($data);
    }
}
