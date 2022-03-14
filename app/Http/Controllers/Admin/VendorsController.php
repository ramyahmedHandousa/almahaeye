<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Http\Request;

class VendorsController extends Controller
{
    public function index(Request $request)
    {
        $vendorsQuery = User::where('type','vendor');

        $pageName = 'التجار';
        if ($request->type == 'new'){

            $vendorsQuery->where('is_accepted',0);

            $view = 'new';
        }else{

            $vendorsQuery->where('is_accepted',1);

            $view = 'index';
        }

       $users = $vendorsQuery->with('country','bank')->get();

        return view('admin.vendors.'.$view,compact('users','pageName'));
    }


    public function show(User $user)
    {
          $user->loadCount('products','address');

          return view('admin.vendors.show',compact('user'));
    }


    public function accepted(Request $request,User $user)
    {
          $user->update(['is_accepted' => 1]);

        session()->flash('success','تم قبول التاجر بنجاح');

        return redirect()->back() ;
    }

    public function refuse(Request $request,User $user)
    {

        $user->update(['is_accepted' => -1]);

        session()->flash('success','تم رفض  التاجر بنجاح');

        return redirect()->back() ;
    }

    public function percentage(Request $request)
    {
        $user = User::find($request->id);
        if ($user && (intval($request->value) < 100)){
            $user->update(['percentage' => intval($request->value)]);
        }
    }
}
