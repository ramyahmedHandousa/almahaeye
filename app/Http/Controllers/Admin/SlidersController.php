<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Ad;
use App\traits\ImageUploadMedia;
use Illuminate\Http\Request;


class SlidersController extends Controller
{
    use ImageUploadMedia;

    public function index()
    {
        return view('admin.sliders.index',[
            'sliders' => Ad::latest()->get(),
            'pageName' => 'sliders'
        ]);
    }

    public function show()
    {

    }

    public function create()
    {

        return view('admin.sliders.create',[
            'pageName' => 'slider'
        ]);
    }

    public function edit($id)
    {
        $slider =  Ad::with('media')->findOrFail($id);

        return view('admin.sliders.edit',[
            'slider' =>  $slider,
            'pageName' => 'slider',
        ]);
    }

    public function store(Request $request)
    {
        $this->validate($request,[
            'category_id'       => 'sometimes|max:255',
            'product_id'        => 'sometimes|max:255',
            'link'              => 'sometimes|max:255',
            'image'             => 'required|image|mimes:jpeg,png,jpg|max:10000',
        ]);

        $slider = new Ad();
        $slider->save();

        $this->upload_image($slider,$request);

        session()->flash('success','تم إضافة slider بنجاح');

        return redirect()->route('sliders.index');
    }

    public function update(Request $request ,Ad $slider)
    {
        $this->validate($request,[
            'image'          => 'nullable|image|mimes:jpeg,png,jpg|max:10000',
        ]);

        $this->upload_image($slider,$request);

        session()->flash('success','تم تعديل slider بنجاح');

        return redirect()->route('sliders.index');
    }

    public function delete(Request $request){

        $model = Ad::find($request->id);

        $model->clearMediaCollection('master_image');
        if ($model->delete()) {
            return response()->json([
                'status' => true,
                'data' => $model->id
            ]);
        }
    }
}
