<?php

namespace App\Http\Controllers\Api\Auth;

use App\Events\PhoneOrEmailChange;
use App\Http\Controllers\Controller;
use App\Http\Requests\Api\Auth\CheckUserPhoneValid;
use App\Models\User;
use App\Support\Facade\Responder;
use Illuminate\Support\Facades\RateLimiter;

class ForgotPasswordController extends Controller
{
    public function __invoke(CheckUserPhoneValid $request)
    {
        $user = User::firstWhere('phone',$request->phone);

        if (RateLimiter::tooManyAttempts($request->phone, 1)) {
            return Responder::error(['من فضلك إنتظر دقيقة اخري  ']) ;
        }

        if (RateLimiter::remaining($request->phone, 1)) {
            RateLimiter::hit($request->phone);
        }
        event(new PhoneOrEmailChange($user,$request));

        return Responder::executed();
    }
}
