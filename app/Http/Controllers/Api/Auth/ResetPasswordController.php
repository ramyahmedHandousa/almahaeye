<?php

namespace App\Http\Controllers\Api\Auth;

use App\Http\Controllers\Controller;
use App\Http\Requests\Api\Auth\CheckUserPhoneValid;
use App\Http\Resources\User\UserResource;
use App\Http\Resources\Vendor\VendorResource;
use App\Models\User;
use App\Support\Facade\Responder;
use Illuminate\Http\Request;

class ResetPasswordController extends Controller
{
    public function __invoke(CheckUserPhoneValid $request)
    {
        $user = User::firstWhere('phone',$request->phone);

        if ($request->password){
            $user->update(['password' => $request->password]);
        }

        $data = $user->type == 'vendor' ? new VendorResource($user) : new UserResource($user);

        return  Responder::success($data);
    }
}
