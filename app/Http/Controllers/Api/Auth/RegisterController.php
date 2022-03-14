<?php

namespace App\Http\Controllers\Api\Auth;

use App\Events\PhoneOrEmailChange;
use App\Http\Controllers\Controller;
use App\Http\Requests\Api\Auth\RegisterValid;
use App\Http\Resources\User\UserResource;
use App\Models\Address;
use App\Models\User;
use App\Support\Facade\Responder;
use App\traits\ImageUploadMedia;
use Illuminate\Support\Facades\DB;

class RegisterController extends Controller
{
    use ImageUploadMedia;

    public function __invoke(RegisterValid $request)
    {
        DB::beginTransaction();

        try {

            $user = User::create($request->validated());

            $this->upload_image($user,$request);

            $this->createAddress($user,$request);

            event(new PhoneOrEmailChange($user,$request));

            DB::commit();

            return  Responder::success(new  UserResource($user));

        } catch (\Exception $e) {

            DB::rollback();

           return  Responder::error($e->getMessage());
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
}
