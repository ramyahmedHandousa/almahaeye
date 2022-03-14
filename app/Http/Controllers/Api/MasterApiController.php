<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class MasterApiController extends Controller
{
    public function __construct()
    {
        $language = request()->header('Accept-Language');

        $lang = in_array($language,['ar','en']) ? $language : 'ar';

        app()->setLocale($lang);
    }
}
