<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Brand;
use App\traits\ImageUploadMedia;
use Illuminate\Http\Request;

class BrandController extends Controller
{
    use ImageUploadMedia;

    public function index()
    {
        $brands = Brand::latest()->get();

        $pageName = 'الماركات';

        return view('admin.brands.index',compact('brands','pageName'));
    }

    public function create()
    {
        return view('admin.brands.create');
    }

    public function edit(Brand $brand)
    {
        return view('admin.brands.edit',compact('brand'));
    }

    public function store(Request $request)
    {
        $this->validate($request,[
            'name_ar'        => 'required|string|max:255',
            'name_en'        => 'required|string|max:255',
            'image'          => 'required|image|mimes:jpeg,png,jpg|max:10000',
        ]);

        $brand = new Brand();
        $this->modelData($request,$brand);
        $this->upload_image($brand,$request);

        session()->flash('success','تم إضافة الماركة بنجاح');

        return redirect()->route('brands.index');
    }

    public function update(Request $request, Brand $brand)
    {
        $this->validate($request,[
            'name_ar'        => 'sometimes|string|max:255',
            'name_en'        => 'sometimes|string|max:255',
            'image'          => 'sometimes|image|mimes:jpeg,png,jpg|max:10000',
        ]);

        $this->modelData($request,$brand);
        $this->upload_image($brand,$request);

        session()->flash('success','تم تعديل الماركة بنجاح');

        return redirect()->route('brands.index');
    }

    public function delete(Request $request)
    {
        $model = Brand::find($request->id);

        $model->clearMediaCollection('master_image');
        if ($model->delete()) {
            return response()->json([
                'status' => true,
                'data' => $model->id
            ]);
        }
    }

    private function modelData($request,$brand)
    {
        $brand->{'name:ar'} = $request->name_ar;
        $brand->{'name:en'} = $request->name_en;
        $brand->save();
    }
}
