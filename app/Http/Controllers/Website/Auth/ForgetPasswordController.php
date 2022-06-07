<?php

namespace App\Http\Controllers\Website\Auth;

use App\Http\Controllers\Controller;
use App\Http\Helpers\Sms;
use App\Models\User;
use App\Models\VerifyUser;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\RateLimiter;
use Illuminate\Support\Str;

class ForgetPasswordController extends Controller
{

    public function __invoke()
    {
        return view('website.auth.forget-password');
    }


    public function forgetPassword(Request $request)
    {
        $this->validate($request,[
            'phone'         => 'required|numeric|exists:users,phone|digits:10|regex:/(05)[0-9]{8}/',
        ],[
            'phone.exists' => 'هذا الهاتف غير موجود لدينا'
        ]);

        $user = User::wherePhone($request->phone)->first();

        if (RateLimiter::tooManyAttempts($request->phone, 1)) {
            return back()->withErrors([
                'phone' => 'من فضلك إنتظر دقيقة اخري  ',
            ]);
        }

        if (RateLimiter::remaining($request->phone, 1)) {
            RateLimiter::hit($request->phone);
        }

        $code = rand(1000,9999) ;


        Sms::sendMessageToPhone($request->phone, ' كود الخاص بك  ' . $code);

        VerifyUser::updateOrCreate(['user_id' => $user->id],[
            'phone' => $request->phone,
            'email' => $user->email,
            'action_code' => $code
        ]);

        return  redirect()->route('check-user-code',['token' => $user->api_token]);
    }


}
