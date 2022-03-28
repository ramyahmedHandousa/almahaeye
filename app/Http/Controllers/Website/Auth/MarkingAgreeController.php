<?php

namespace App\Http\Controllers\Website\Auth;

use App\Http\Controllers\Controller;
use App\Http\Requests\Website\Auth\MarkingDataValid;
use Illuminate\Http\Request;

class MarkingAgreeController extends Controller
{
    public function __invoke(Request $request)
    {
        $user = $request->user();

        if ($user->marketing_agree_info != null){

            session()->flash('my-errors','تم تقديم طلبك مسبقا ..');

            return redirect()->back();
        }

        return view('website.auth.complete_marketing_agree');
    }

    public function store(MarkingDataValid $request)
    {

        $user = $request->user();

        if ($user->marketing_agree_info != null){

            session()->flash('my-errors','تم تقديم طلبك مسبقا ..');

            return redirect()->back();
        }

        $data = [
            'date_now' => $request->date_now,
            'master_one' => $request->master_one,
            'master_two' => $request->master_two,
        ];

        $user->update(['marketing_agree_info' => $data]);

        session()->flash('success','تم تقديم السمتند بنجاح ');

        return redirect('/');
    }
}
