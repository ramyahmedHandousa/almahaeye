<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class NotificationController extends Controller
{

    public function __invoke( )
    {
        return view('admin.notifications.create');
    }

    public function send(Request $request)
    {
        session()->flash('success','تم إرسال الإشعار بنجاح');

        return redirect()->back() ;
    }
}
