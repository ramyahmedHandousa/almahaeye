<?php

namespace App\Http\Controllers\Website;

use App\Http\Controllers\Controller;
use App\Models\Address;
use Illuminate\Http\Request;

class AddressController extends Controller
{
    public function index()
    {
        return view('website.address.index');
    }

    public function create()
    {
        if (!auth()->user()){
            session()->flash('my-errors','برجاء تسجيل الدخول اولا ..');

            return redirect()->back();
        }
        return view('website.address.create');
    }


    public function show()
    {
        return redirect()->back();
    }

    public function edit(Address $address)
    {
        return view('website.address.edit',compact('address'));
    }
    public function store(Request $request)
    {
        $this->validate($request,[
            'latitude'       => 'required',
            'longitude'      => 'required',
            'address'        => 'required',
        ]);

        auth()->user()->address()->create([
            'notes'     =>  $request->notes,'latitude' => $request->latitude,
            'longitude' =>  $request->longitude,'address' => $request->address,
            'is_default'  => $request->is_default ? : 0
        ]);

        session()->flash('success','تم إضافة العنوان بنجاح');

        return redirect()->route('addresses.index');
    }


    public function update(Request $request,Address $address)
    {
        $validData = $this->validate($request,[
            'latitude'       => 'required',
            'longitude'      => 'required',
            'address'        => 'required',
            'notes'         => 'sometimes'
        ]);

        $address->update($validData);

        session()->flash('success','تم تعديل العنوان بنجاح');

        return redirect()->route('addresses.index');
    }


    public function destroy(Request $request)
    {
        return response()->json(['status' => true,'id' => $request->id]);
    }
}
