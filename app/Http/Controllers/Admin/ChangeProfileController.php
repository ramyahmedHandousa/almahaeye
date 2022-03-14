<?php

namespace App\Http\Controllers\Admin;

use App\classes\NotificationClass;
use App\Http\Controllers\Controller;
use App\Models\ChangeProfile;
use App\Notifications\SimpleNotification;
use Illuminate\Http\Request;

class ChangeProfileController extends Controller
{
    public function __invoke()
    {
        $changes = ChangeProfile::with('user')->where('is_accepted','=',0)->get();

        return view('admin.vendors.changes.index',compact('changes'));
    }

    public function accepted(ChangeProfile $changeProfile)
    {
       $changeProfile->update(['is_accepted' => 1]);

        session()->flash('success','تم الموافقة علي التعديلات بنجاح');

        return redirect()->back();
    }

    public function refuse(ChangeProfile $changeProfile)
    {
        $changeProfile->update(['is_accepted' => -1]);

        session()->flash('success','تم رفض التعديلات بنجاح');

        return redirect()->back();
    }

    public function acceptedOrRefuse(Request $request, $id)
    {
        $changeProfile = ChangeProfile::findOrFail($id);

        if ($request->type == 'accepted'){
            $type = 1;
            $message = 'تم الموافقة علي التعديلات  ';
            $messageKey = 'admin_accepted_change_profile';
        }else{
            $type = -1;
            $message = 'تم رفض التعديلات ';
            $messageKey = 'admin_refuse_change_profile';
        }

        $changeProfile->update(['is_accepted' => $type]);

        $dataNotification  =  new NotificationClass(title: 'users.change_profile',message: 'users.change_profile.'.$messageKey);

        $changeProfile?->user?->notify(new SimpleNotification($dataNotification));

        session()->flash('success',$message);

        return redirect()->back();
    }
}
