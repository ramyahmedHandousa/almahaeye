<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Http\Request;

class UsersController extends Controller
{

    public function index()
    {
        $users = User::where('type','client')->with('country.parent.parent','verify')->get();

        $pageName = 'المستخدمين';

        return view('admin.users.index',compact('users','pageName'));
    }

    public function suspend(Request $request)
    {
        $model = User::findOrFail($request->id);
        $model->is_suspend = $request->type;
        if ($request->type == 1) {
            $message = "لقد تم حظر  بنجاح";
        } else {
            $message = "لقد تم فك الحظر بنجاح";
        }

        if ($model->save()) {
            return response()->json([
                'status' => true,
                'message' => $message,
                'id' => $request->id,
                'type' => $request->type
            ]);
        }
    }
}
