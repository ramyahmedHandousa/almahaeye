<?php

namespace App\Http\Controllers\Api\Auth;

use App\Events\PhoneOrEmailChange;
use App\Http\Controllers\Controller;
use App\Http\Requests\Api\Auth\ResendCodeValid;
use App\Models\VerifyUser;
use App\Support\Facade\Responder;
use Illuminate\Support\Facades\RateLimiter;

class ResendCodeController extends Controller
{
    public function __invoke(ResendCodeValid $request)
    {
        $verifyUser = VerifyUser::wherePhone($request->phone)->with('user')->first();

        if (RateLimiter::tooManyAttempts($request->phone, 1)) {
            return Responder::error(['من فضلك إنتظر دقيقة اخري  ']) ;
        }

        if (RateLimiter::remaining($request->phone, 1)) {
            RateLimiter::hit($request->phone);
        }

        event(new PhoneOrEmailChange($verifyUser['user'],$request));

        return Responder::executed();
    }
}
