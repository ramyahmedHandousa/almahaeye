<?php

namespace App\Http\Controllers\Website\Auth;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Http\Request;

class ResetPasswordController extends Controller
{

    public function __invoke(Request $request)
    {
        $user = User::whereApiToken($request->token)->first();

        if (!$user){
            session()->flash('my-errors','تم إنتهاء صلاحية هذه العملية يرجي إعادة المحاولة');
            return redirect()->to('/');
        }

        return view('website.auth.new-password',['token' => $request->token]);
    }

    public function updatePassword(Request $request)
    {
        $user = User::whereApiToken($request->token)->first();

        if (!$user){
            session()->flash('my-errors','تم إنتهاء صلاحية هذه العملية يرجي إعادة المحاولة');
            return redirect()->to('/');
        }

        $this->validate($request,[
            'password'      => 'required',
            'confirm_password'   => 'required|same:password',
        ]);

        $user->update(['password' => $request->password]);

        session()->flash('success','تم تغير الباسورد بنجاح');

        return redirect()->to('/');
    }
}
