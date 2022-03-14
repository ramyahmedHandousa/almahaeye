<?php

namespace App\Http\Controllers\Api\Auth;

use App\Http\Controllers\Api\MasterApiController;
use App\Models\Device;
use App\Support\Facade\Responder;
use Illuminate\Http\Request;

class RefreshTokenController extends MasterApiController
{
    public function __construct()
    {
        parent::__construct();
        $this->middleware('auth:api');
    }

    public function __invoke(Request $request)
   {
       $this->validate($request,[
           'device'       => 'required|string|max:5000',
           'device_type'  => 'required|string|in:android,ios',
       ]);

       Device::updateOrCreate(['device' => $request->device],[
           'user_id'        => auth()->id(),
           'device'         => $request->device,
           'device_type'    => $request->device_type
       ]);

       $user = auth()->user();

       $user->update(['lang' => app()->getLocale()]);

       return Responder::executed();
   }
}
