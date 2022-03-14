<?php

namespace App\Http\Controllers\Api;

use App\Models\ContactUs;
use App\Models\Setting;
use App\Models\User;
use App\Support\Facade\Responder;
use Illuminate\Http\Request;

class SettingsController extends MasterApiController
{

    public function __invoke($key)
    {

        return Responder::success([$key => Setting::getBody($key.'_'.app()->getLocale())]);
    }


    public function contactUs(Request $request)
    {

        $this->validate($request,[
            'message' => 'required'
        ]);

        $user = User::whereApiToken($request->bearerToken())->first();


        ContactUs::create([
            'user_id'   => $user?->id,
            'name'      => $request->name,
            'phone'     => $request->phone,
            'email'     => $request->email,
            'message'   => $request->message,
        ]);

        return Responder::success('success');
    }

}
