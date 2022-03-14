<?php

namespace App\Http\Controllers\Admin\Products;

use App\Http\Controllers\Controller;
use App\Models\FrameMaterial;
use Illuminate\Http\Request;

class FrameMaterialController extends Controller
{
    public function index()
    {
        $frame_materials = FrameMaterial::latest()->get();

        $pageName = '  خامات الإطارات';

        return view('admin.products.frame_materials.index',compact('frame_materials','pageName'));
    }

    public function create()
    {
        return view('admin.products.frame_materials.create');
    }

    public function edit(FrameMaterial $frameMaterial)
    {
        return view('admin.products.frame_materials.edit',compact('frameMaterial'));
    }

    public function store(Request $request)
    {
        $this->validate($request,[
            'name_ar'        => 'required|string|max:255',
            'name_en'        => 'required|string|max:255',
        ]);
        $productType = new FrameMaterial();
        $this->modelData($request,$productType);

        session()->flash('success','تم الإضافة  بنجاح');

        return redirect()->route('frame_materials.index') ;
    }

    public function update(Request $request,FrameMaterial $frameMaterial)
    {
        $this->modelData($request,$frameMaterial);

        session()->flash('success','تم التعديل بنجاح');

        return redirect()->route('frame_materials.index') ;
    }

    public function delete(Request $request)
    {
        $model = FrameMaterial::find($request->id);

        if ($model->delete()) {
            return response()->json(['status' => true, 'data' => $model->id]);
        }
    }

    private function modelData($request,$productType)
    {
        $productType->{'name:ar'} = $request->name_ar;
        $productType->{'name:en'} = $request->name_en;
        $productType->save();
    }
}
