<?php

namespace App\Http\Controllers\Admin;

use App\Models\Setting;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class SettingsController extends Controller
{

    /**
     * @var string
     * @ public variable to save path.
     */
    public $public_path;

    function __construct()
    {
        $this->public_path = 'files/settings/';
    }


    public function global()
    {
        return view('admin.settings.global');
    }

    public function contactus()
    {

        return view('admin.settings.contactus');
    }



    public function create()
    {
        return view('admin.settings.index');
    }

    public function store(Request $request)
    {

        foreach ($request->all() as $key => $value) {
            if ($key != '_token' && $key != 'about_app_image_old'):
                Setting::updateOrCreate(['key' => $key], ['body' => strip_tags($value)]);
            endif;
        }

        if ($request->hasFile('about_app_image')):
            $imageName = time().'.'.$request->about_app_image->extension();

            $request->about_app_image->move(public_path( $this->public_path), $imageName);

            Setting::updateOrCreate(['key' => 'about_app_image'], ['body' =>  $this->public_path . $imageName]);
        endif;

        if ($request->ajax()) {
            return response()->json([
                'status' => true,
                'message' => "لقد تم حفظ بيانات الإعدادات بنجاح",

            ]);
        } else {
            session()->flash('success', 'لقد حفظ الإعدادات بنجاح');
            return redirect()->back();
        }
    }

}
