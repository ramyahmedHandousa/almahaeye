<?php

namespace App\Http\Controllers\Admin\Products;

use App\Http\Controllers\Controller;
use App\Models\Color;
use Illuminate\Http\Request;

class ColorController extends Controller
{
    public function index(Request $request)
    {
        if (!$request->type){ return  redirect()->back();}

        $colors = Color::latest()->when($request->type,
            fn($q) =>  $q->where('type','=',$request->type == 'lens_colors' ? 'lens': 'frame')
        )->get();

        $pageName = 'الألوان';

        try {
            $view = \request('type');

            return view('admin.products.'.$view.'.index',compact('colors','pageName'));
        }catch (\Exception $exception){

            return view('admin.products.frame_colors.index',compact('colors','pageName'));
        }
    }

    public function create(Request $request)
    {
        if (!$request->type){ return  redirect()->back();}

        try {
            $view = \request('type');

            return view('admin.products.'.$view.'.create');

        }catch (\Exception $exception){

            return view('admin.products.frame_colors.create');
        }
    }

    public function edit(Request $request ,$id  )
    {
        if (!$request->type){ return  redirect()->back();}

        $color = Color::findOrFail($id);

        try {

            $view = \request('type');

            return view('admin.products.'.$view.'.edit',compact('color'));

        }catch (\Exception $exception){

            return view('admin.products.frame_colors.create');
        }
    }

    public function store(Request $request)
    {

        $this->validate($request,[
            'name_ar'        => 'required|string|max:255',
            'name_en'        => 'required|string|max:255',
        ]);
        $color = new color();
        $this->modelData($request,$color);

        session()->flash('success','تم الإضافة بنجاح');

        return redirect()->route('colors.index',['type' => $request->type]);
    }

    public function update(Request $request,$id)
    {

        $color = Color::findOrFail($id);

        $this->modelData($request,$color);

        session()->flash('success','تم التعديل بنجاح');

        return redirect()->route('colors.index',['type' => $request->type ? : null]);
    }


    public function delete(Request $request)
    {
        $model = Color::find($request->id);

        if ($model->delete()) {
            return response()->json(['status' => true, 'data' => $model->id]);
        }
    }

    private function modelData($request,$color)
    {
        $color->{'name:ar'} = $request->name_ar;
        $color->{'name:en'} = $request->name_en;
        $color->type        = $request->type_color ? : $color->type;
        $color->hash_code   = $request->hash_code_color ? : $color->hash_code_color;
        $color->save();
    }
}
