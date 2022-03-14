<?php

namespace App\Http\Controllers\Api\Auth;

use App\Http\Controllers\Controller;
use App\Models\Device;
use App\Support\Facade\Responder;
use Illuminate\Http\Request;
use Illuminate\Support\Str;

class LogOutController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth:api');
    }

    public function __invoke(Request $request)
    {
        $user =  auth()->user();

        $user->update(['api_token' => Str::random(60)]);

        if ($request->device){
           $device =  Device::firstWhere('device',$request->device);
           $device?->delete();
        }

        return Responder::executed();
    }
}
