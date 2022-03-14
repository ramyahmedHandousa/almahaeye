<?php

namespace App\Http\Controllers\Api\Auth;

use App\Http\Controllers\Controller;
use App\Http\Requests\Api\Auth\CheckCodeValid;
use App\Http\Resources\User\UserResource;
use App\Http\Resources\Vendor\VendorResource;
use App\Models\VerifyUser;
use App\Support\Facade\Responder;

class CheckCodeController extends Controller
{
    public function __invoke(CheckCodeValid $request)
    {
        $verifyUser = VerifyUser::wherePhone($request->phone)->with('user')->first();

        $user =  $verifyUser['user'];

        $user->update(['phone' => $verifyUser->phone,'is_active' => 1]);

        $verifyUser->delete();

        $data = $user->type == 'vendor' ? new VendorResource($user) : new UserResource($user);

        return Responder::success($data);
    }
}
