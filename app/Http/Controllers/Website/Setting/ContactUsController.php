<?php

namespace App\Http\Controllers\Website\Setting;

use App\Http\Controllers\Controller;
use App\Models\ContactUs;
use App\Models\Setting;
use Illuminate\Http\Request;

class ContactUsController extends Controller
{

    public function __invoke()
    {
        return view('website.setting.contact-us');
    }

    public function store(Request $request)
    {
        $this->validate($request, [
            'name' => 'required|string|max:100',
            'phone' => 'required|max:100',
            'email' => 'required|email|max:100',
            'message' => 'required|string|max:255',
        ]);

        $has_link = stristr($request->message, 'http://') ?: stristr($request->message, 'https://');
        if (!$has_link){
            ContactUs::create([
                    'name' => $request->name,'phone' => $request->phone,
                    'email' => $request->email, 'message' => $request->message
            ]);
        }

        session()->flash('success','تم إرسال  الرسالة بنجاح');

        return redirect()->back();
    }
}
