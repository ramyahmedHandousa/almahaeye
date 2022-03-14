<?php

namespace App\Http\Controllers\Api\Auth;

use App\Events\PhoneOrEmailChange;
use App\Http\Controllers\Controller;
use App\Http\Requests\Api\Auth\EditProfileValid;
use App\Http\Resources\User\UserResource;
use App\Http\Resources\Vendor\VendorResource;
use App\Support\Facade\Responder;
use App\traits\ImageUploadMedia;
use Illuminate\Http\Request;

class EditProfileController extends Controller
{
    use  ImageUploadMedia;

    public function __construct()
    {
        $this->middleware('auth:api');
    }

    public function __invoke(EditProfileValid $request)
    {
        $user = $request->user();
        $user->fill($request->validated());
        $user->save();

        if ($user->phone !== $request->phone){
            event(new PhoneOrEmailChange($user,$request));
        }

        if ($request->hasFile('image')){
            $this->upload_image($user,$request);
        }

        $data = $user->type == 'vendor' ? new VendorResource($user) : new UserResource($user);

        return  Responder::success($data);
    }
}
