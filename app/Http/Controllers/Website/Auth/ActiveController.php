<?php

namespace App\Http\Controllers\Website\Auth;

use App\Http\Controllers\Controller;
use App\Models\User;
use App\Models\VerifyUser;
use Illuminate\Http\Request;
use Illuminate\Support\Str;

class ActiveController extends Controller
{

    public function __invoke()
    {
       return view('website.auth.check-code');
    }

    public function active(Request $request)
    {
        $this->validate($request,[
            'code1' => 'required',
            'code2' => 'required',
            'code3' => 'required',
            'code4' => 'required',
        ]);

        $code = $request->code1.$request->code2.$request->code3.$request->code4;

        if (auth()->check()){

            $verify = VerifyUser::whereUserIdAndActionCode(auth()->id(),$code)->first();
        }else{
            $user = User::whereApiToken($request->token)->first();
            if (!$user){
                session()->flash('my-errors','تم إنتهاء صلاحية الكود');
                return redirect()->back();
            }
            $verify = VerifyUser::whereUserIdAndActionCode($user->id,$code)->first();
        }

        if (!$verify){
            session()->flash('my-errors','هذا الكود غير صحيح');
            return redirect()->back();
        }

        $verify->user?->update(['is_active' => 1,'phone' => $verify->phone,'email' => $verify->email ]);

        $verify->delete();

        if (isset($user)){

            session()->flash('success','برجاء إدخل الباسورد الجديد');

            return redirect()->route('auth-new-password',['token' => $user->api_token]);
        }

        session()->flash('success','تم تحديث الحساب بنجاح');

        return redirect()->to('/');
    }


    public function resendCode(Request $request)
    {
        $verify = VerifyUser::whereUserId(auth()->id())->first();

        if (!$verify){
            session()->flash('my-errors','لا يوجد بيانات لإرسال الكود');
            return redirect()->back();
        }

        $verify->update(['action_code' => 1111 ]);

        session()->flash('success','تم إعادة إرسال الكود بنجاح');

        return redirect()->back();
    }

}
