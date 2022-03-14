<?php

namespace App\Http\Controllers\Api\Auth;

use App\Events\PhoneOrEmailChange;
use App\Http\Controllers\Controller;
use App\Http\Requests\Api\Auth\ResendCodeValid;
use App\Models\VerifyUser;
use App\Support\Facade\Responder;

class ResendCodeController extends Controller
{
    public function __invoke(ResendCodeValid $request)
    {
        $verifyUser = VerifyUser::wherePhone($request->phone)->with('user')->first();

        event(new PhoneOrEmailChange($verifyUser['user'],$request));

        return Responder::executed();
    }
}
