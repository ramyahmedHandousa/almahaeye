<?php

namespace App\Http\Controllers\Admin\Products;

use App\Http\Controllers\Controller;
use App\Models\Age;
use Illuminate\Http\Request;

class AgeController extends Controller
{
    public function index()
    {
        $ages = Age::latest()->get();

        $pageName = 'عدد السنوات';

        return view('admin.products.ages.index',compact('ages','pageName'));
    }

    public function create()
    {
        return view('admin.products.ages.create');
    }

    public function edit(Age  $age)
    {
        return view('admin.products.ages.edit',compact('age'));
    }

    public function store(Request $request)
    {
        $this->validate($request,[
            'name_ar'        => 'required|string|max:255',
            'name_en'        => 'required|string|max:255',
        ]);
        $age = new Age();
        $this->modelData($request,$age);

        session()->flash('success','تم الإضافة بنجاح');

        return redirect()->route('ages.index') ;
    }

    public function update(Request $request,Age $age)
    {
        $this->modelData($request,$age);

        session()->flash('success','تم التعديل بنجاح');

        return redirect()->route('ages.index') ;
    }

    public function delete(Request $request)
    {
        $model = Age::find($request->id);

        if ($model->delete()) {
            return response()->json(['status' => true, 'data' => $model->id]);
        }
    }

    private function modelData($request,$age)
    {
        $age->{'name:ar'} = $request->name_ar;
        $age->{'name:en'} = $request->name_en;
        $age->save();
    }
}
