<?php

namespace App\Http\Controllers\Api\Auth;

use App\Events\PhoneOrEmailChange;
use App\Http\Controllers\Controller;
use App\Http\Requests\Api\Auth\CheckUserPhoneValid;
use App\Models\User;
use App\Support\Facade\Responder;

class ForgotPasswordController extends Controller
{
    public function __invoke(CheckUserPhoneValid $request)
    {
        $user = User::firstWhere('phone',$request->phone);

        event(new PhoneOrEmailChange($user,$request));

        return Responder::executed();
    }
}
