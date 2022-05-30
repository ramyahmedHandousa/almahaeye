<?php

namespace App\Http\Controllers\Api\User;

use App\Http\Controllers\Api\MasterApiController;
use App\Support\Facade\Responder;
use Illuminate\Http\Request;

class ProfileController extends MasterApiController
{

    public function __construct()
    {
        parent::__construct();
        $this->middleware('auth:api');
    }


    public function updateLang(Request $request)
    {
        auth()->user()->update(['lang' => app()->getLocale()]);

        return  Responder::executed();
    }
}
