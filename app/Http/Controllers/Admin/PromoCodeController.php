<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\PromoCode;
use Illuminate\Http\Request;

class PromoCodeController extends Controller
{
    public function index()
    {
        return view('admin.promo_codes.index',[
            'promo_codes' => PromoCode::latest()->get(),
            'pageName' => 'أكواد الخصم '
        ]);
    }


    public function create()
    {
        return view('admin.promo_codes.create',['pageName' => 'أكواد الخصم']);
    }

    public function edit(PromoCode $promoCode)
    {
        $pageName = 'كود الخصم ';
        return view('admin.promo_codes.edit',compact('promoCode','pageName'));
    }


    public function store(Request $request)
    {
        $this->validate($request,[
            'code'              => 'required|string|max:255',
            'percentage'        => 'required|string|max:255',
            'time_used'         => 'required',
            'start_at'          => 'required|date|after:yesterday',
            'end_at'            => 'required|date|after_or_equal:start_at',
        ]);

        $promo_code = new PromoCode();
        $this->modelData($request,$promo_code);
        session()->flash('success','تم الإضافة بنجاح');

        return redirect()->route('promo_codes.index') ;
    }

    public function update(Request $request,PromoCode $promoCode)
    {
        $this->validate($request,[
            'code'              => 'sometimes|string|max:255',
            'percentage'        => 'sometimes|string|max:255',
            'time_used'         => 'sometimes',
            'start_at'          => 'sometimes|date|after:yesterday',
            'end_at'            => 'sometimes|date|after_or_equal:start_at',
        ]);

        $this->modelData($request,$promoCode);
        session()->flash('success','تم التعديل بنجاح');

        return redirect()->route('promo_codes.index') ;
    }

    public function delete(Request $request)
    {
        $model = PromoCode::find($request->id);

        if ($model->delete()) {
            return response()->json([
                'status' => true,
                'data' => $model->id
            ]);
        }
    }

    private function modelData($request,$promoCode)
    {
        $promoCode->code            = $request->code? : $promoCode->code;
        $promoCode->percentage      = $request->percentage? : $promoCode->percentage;
        $promoCode->time_used       = $request->time_used? : $promoCode->time_used;
        $promoCode->start_at        = $request->date('start_at')? : $promoCode->start_at;
        $promoCode->end_at          = $request->date('end_at') ? : $promoCode->end_at;
        $promoCode->save();
    }
}
