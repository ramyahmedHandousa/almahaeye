<?php

namespace App\Http\Controllers\Website\Setting;

use App\Http\Controllers\Controller;
use App\Models\Setting;
use Illuminate\Http\Request;

class SettingController extends Controller
{

    public function __invoke($name)
    {

        return view('website.setting.global',[
            'text' => $this->pageName($name),
            'body' =>  Setting::getBody($name.'_'.app()->getLocale()),
        ]);
    }

    private function pageName($name)
    {
        return match ($name) {
            'privacy' => 'سياسة الإسترجاع',
            'terms' => 'الشروط والأحكام',
            'about_app' => 'نبذة عن الموقع',
            'developer' => 'عن الموقع',
             default => ''
        };
    }
}
