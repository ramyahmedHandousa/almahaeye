<?php

namespace App\Http\Controllers\Website\Auth;

use App\Http\Controllers\Controller;
use App\Http\Helpers\Sms;
use App\Http\Requests\Website\Auth\RegisterValid;
use App\Http\Requests\Website\Auth\RegisterVendorValid;
use App\Models\Address;
use App\Models\Bank;
use App\Models\Country ;
use App\Models\User;
use App\Models\VerifyUser;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class RegisterController extends Controller
{
   public function __invoke()
   {
       return view('website.auth.register',[
           'countries' => Country::whereNull('parent_id')->get()
       ]);
   }

    public function signUpVendor()
    {
        return view('website.auth.register-vendor',[
            'countries' => Country::whereNull('parent_id')->get(),
            'banks' => Bank::all()
        ]);
    }


    public function register(RegisterValid $request)
    {
        $user = User::create($request->validated());

        $this->createAddress($user,$request);

        $this->verifyUser($user,$request);

        auth()->login($user);

        session()->flash('success','برجاء تفعيل الحساب');

        return redirect()->route('check-user-code');
    }


    public function registerVendor(RegisterVendorValid $request)
    {
        DB::beginTransaction();

        try {

            $user = User::create($request->validated());

            $this->createAddress($user,$request);

            $this->verifyUser($user,$request);

            $user->addMedia($request->image_commercial)->toMediaCollection('image_commercial');
//            $user->addMedia($request->image_marketing_agreement)->toMediaCollection('image_marketing_agreement');
            $user->addMedia($request->image_service_provider)->toMediaCollection('image_service_provider');

            DB::commit();

            auth()->login($user);

            session()->flash('success','برجاء تفعيل الحساب');

            return redirect()->route('check-user-code');

        } catch (\Exception $e) {

            DB::rollback();

            session()->flash('my-errors','للأسف حدث خطأ ما .برجاء المحاولة مرة اخري..');

            return redirect()->back();
        }

    }

    private function createAddress($user,$request)
    {
        Address::create([
            'user_id' => $user->id,'latitude' => $request->latitude,
            'longitude' => $request->longitude,'address' => $request->address,
            'is_default' => 1
        ]);
    }


    private function verifyUser($user,$request)
    {
        $code = rand(1000,9999) ;

        Sms::sendMessageToPhone($request->phone, ' كود الخاص بك  ' . $code);

        VerifyUser::create([
            'user_id' => $user->id,'email' => $request->email,
            'phone' => $request->phone, 'action_code' => $code
        ]);
    }

    public function countriesData(Request $request): \Illuminate\Http\JsonResponse
    {
        return response()->json(Country::where('parent_id', $request->countryID)->get(['id']));
    }

}
