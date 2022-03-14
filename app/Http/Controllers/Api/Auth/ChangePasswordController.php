<?php

namespace App\Http\Controllers\Api\Auth;

use App\Http\Controllers\Controller;
use App\Http\Requests\Api\Auth\ChangePasswordValid;
use App\Support\Facade\Responder;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;

class ChangePasswordController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth:api');

    }

    public function __invoke(ChangePasswordValid $request)
    {
        $user =  auth()->user();

        if ($request->new_password){

            $user->update( [ 'password' => $request->new_password] );

            $message =  trans('global.password_was_edited_successfully') ;

        }else{

            $message = trans('global.password_not_edited');
        }

        return Responder::success($message);
    }
}
