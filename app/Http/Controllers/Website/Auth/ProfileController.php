<?php

namespace App\Http\Controllers\Website\Auth;

use App\Http\Controllers\Controller;
use App\Models\VerifyUser;
use App\traits\ImageUploadMedia;
use Illuminate\Http\Request;
use Illuminate\Support\Arr;
use Illuminate\Support\Facades\Hash;

class ProfileController extends Controller
{
    use ImageUploadMedia;

    public function __invoke()
    {
        return view('website.auth.update-profile');
    }

    public function editProfile(Request $request)
    {
         $validData  = $this->validate($request,[
            'first_name'    => 'required|min:2',
            'last_name'     => 'required|min:4',
            'email'         => 'required|email|unique:users,email,'.auth()->id(),
            'phone'         => 'required|digits:10|regex:/(05)[0-9]{8}/|numeric|unique:users,phone,'.auth()->id(),
        ]);
        Arr::pull($validData,'phone');

        auth()->user()->update($validData);

        if ($request->phone !== auth()->user()->phone){

            $this->updateVerifyUser(auth()->user(),$request);

            session()->flash('success',' برجاء إدخل الكود لتحديث الهاتف لديك');

            return redirect()->route('check-user-code');
        }

        session()->flash('success','تم تعديل البروفيل بنجاح');

        return redirect()->back();
    }


    public function editImage(Request $request)
    {
        $this->validate($request,[
           'image' => 'required|image|mimes:jpeg,png,jpg|max:10240'
        ]);

        $this->upload_image(auth()->user(),$request);

        return redirect()->back();
    }

    public function editPassword(Request $request)
    {
        $this->validate($request,[
            'oldpassword' => 'required',
            'password' => 'required',
            'password_confirmation' => 'required|same:password'
        ]);

        if (! Hash::check($request->oldpassword, auth()->user()->password)) {

            session()->flash('my-errors', 'كلمة المرور القديمة غير صحيحة.');
            return redirect()->back();
        }

        auth()->user()->update(['password' => $request->password]);

        session()->flash('success','تم تعديل الباسورد بنجاح');

        return redirect()->back();
    }

    private function updateVerifyUser($user,$request)
    {
        VerifyUser::updateOrCreate(['user_id' => $user->id],[
            'email' => $request->email, 'phone' => $request->phone, 'action_code' => 1111
        ]);
    }
}
