<?php

namespace App\Http\Controllers\Admin\Products;

use App\Http\Controllers\Controller;
use App\Models\ProductType;
use Illuminate\Http\Request;
use function redirect;
use function response;
use function session;
use function view;

class ProductTypeController extends Controller
{

    public function index()
    {
        $productTypes = ProductType::latest()->get();

        $pageName = 'أنواع النظارة';
        return view('admin.products.product_types.index',compact('productTypes','pageName'));
    }

    public function create()
    {
        return view('admin.products.product_types.create');
    }

    public function edit(ProductType $productType)
    {
        return view('admin.products.product_types.edit',compact('productType'));
    }

    public function store(Request $request)
    {
        $this->validate($request,[
            'name_ar'        => 'required|string|max:255',
            'name_en'        => 'required|string|max:255',
        ]);
        $productType = new ProductType();
        $this->modelData($request,$productType);

        session()->flash('success','تم إضافة نوع نظارة بنجاح');

        return redirect()->route('product_types.index') ;
    }

    public function update(Request $request,ProductType $productType)
    {
        $this->modelData($request,$productType);

        session()->flash('success','تم تعديل نوع النظارة بنجاح');

        return redirect()->route('product_types.index') ;
    }

    public function delete(Request $request)
    {
        $model = ProductType::find($request->id);

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
