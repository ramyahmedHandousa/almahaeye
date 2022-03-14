<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Http\Request;

class UsersController extends Controller
{

    public function index()
    {
        $users = User::where('type','client')->whereIsActive(1)->with('country')->get();

        $pageName = 'المستخدمين';

        return view('admin.users.index',compact('users','pageName'));
    }
}
