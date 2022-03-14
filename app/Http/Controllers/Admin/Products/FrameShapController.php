<?php

namespace App\Http\Controllers\Admin\Products;

use App\Http\Controllers\Controller;
use App\Models\FrameShap;
use Illuminate\Http\Request;

class FrameShapController extends Controller
{
    public function index()
    {
        $frame_shaps = FrameShap::latest()->get();

        $pageName = 'أشكال الإطار ';
        return view('admin.products.frame_shaps.index',compact('frame_shaps','pageName'));
    }

    public function create()
    {
        return view('admin.products.frame_shaps.create');
    }

    public function edit(FrameShap $frameShap)
    {
        return view('admin.products.frame_shaps.edit',compact('frameShap'));
    }

    public function store(Request $request)
    {
        $this->validate($request,[
            'name_ar'        => 'required|string|max:255',
            'name_en'        => 'required|string|max:255',
        ]);
        $productType = new FrameShap();
        $this->modelData($request,$productType);

        session()->flash('success','تم الإضافة  بنجاح');

        return redirect()->route('frame_shaps.index') ;
    }

    public function update(Request $request,FrameShap $frameShap)
    {
        $this->modelData($request,$frameShap);

        session()->flash('success','تم التعديل  بنجاح');

        return redirect()->route('frame_shaps.index') ;
    }

    public function delete(Request $request)
    {
        $model = FrameShap::find($request->id);

        if ($model->delete()) {
            return response()->json(['status' => true, 'data' => $model->id]);
        }
    }

    private function modelData($request,$frameShap)
    {
        $frameShap->{'name:ar'} = $request->name_ar;
        $frameShap->{'name:en'} = $request->name_en;
        $frameShap->save();
    }
}
