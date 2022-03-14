<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Shipping;
use Illuminate\Http\Request;

class ShippingController extends Controller
{
    public function index()
    {
        return view('admin.shipping.index',[
            'shipping' => Shipping::latest()->get(),
            'pageName' => 'شركات الشحن'
        ]);
    }


    public function create()
    {
        return view('admin.shipping.create',['pageName' => 'شركات الشحن']);
    }

    public function edit(Shipping $shipping)
    {
        $pageName = 'شركة الشحن';
        return view('admin.shipping.edit',compact('shipping','pageName'));
    }


    public function store(Request $request)
    {

        $this->validate($request,[
            'name_ar'           => 'required|string|max:255',
            'name_en'           => 'required|string|max:255',
            'time_delivery'     => 'required|string|max:255',
            'price'             => 'required|string|max:255',
            'pay'               => 'sometimes',
        ]);

        $promo_code = new Shipping();
        $this->modelData($request,$promo_code);
        session()->flash('success','تم الإضافة بنجاح');

        return redirect()->route('shipping.index') ;
    }

    public function update(Request $request,Shipping $shipping)
    {
        $this->validate($request,[
            'name_ar'           => 'required|string|max:255',
            'name_en'           => 'required|string|max:255',
            'time_delivery'     => 'sometimes|string|max:255',
            'price'             => 'sometimes|string|max:255',
            'pay'               => 'sometimes',
        ]);

        $this->modelData($request,$shipping);
        session()->flash('success','تم التعديل بنجاح');

        return redirect()->route('shipping.index') ;
    }

    public function delete(Request $request)
    {
        $model = Shipping::find($request->id);

        if ($model->delete()) {
            return response()->json(['status' => true, 'data' => $model->id]);
        }
    }

    private function modelData($request,$shipping)
    {
        $shipping->time_delivery    = $request->time_delivery? : $shipping->time_delivery;
        $shipping->price            = $request->price? : $shipping->price;
        $shipping->pay              = $request->pay? : $shipping->pay;
        $shipping->{'name:ar'}      = $request->name_ar;
        $shipping->{'name:en'}      = $request->name_en;
        $shipping->save();
    }
}
