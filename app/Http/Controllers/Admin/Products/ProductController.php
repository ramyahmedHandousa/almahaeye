<?php

namespace App\Http\Controllers\Admin\Products;

use App\Http\Controllers\Controller;
use App\Models\Age;
use App\Models\Brand;
use App\Models\Category;
use App\Models\Color;
use App\Models\FrameMaterial;
use App\Models\FrameShap;
use App\Models\Product;
use App\Models\ProductType;
use App\Models\User;
use App\traits\ImageUploadMedia;
use Illuminate\Http\Request;
use function view;

class ProductController extends Controller
{
    use ImageUploadMedia;

    public function index()
    {
        return view('admin.products.index',[
            'products' => Product::latest()->with('user','brand')->get(),
            'pageName' => 'المنتجات'
        ]);
    }

    public function create()
    {
        $vendors = User::whereType('vendor')->get(['id','name']);
        $brands = Brand::whereIsSuspended(0)->get();
        $categories = Category::whereIsSuspended(0)->whereNull('parent_id')->whereHas('children')->get();
        $frame_materials     = FrameMaterial::whereIsSuspended(0)->get();
        $frame_shaps     = FrameShap::whereIsSuspended(0)->get();
        $product_types     = ProductType::whereIsSuspended(0)->get();
        $ages               = Age::whereIsSuspended(0)->get();

        $colors         = Color::whereIsSuspended(0)->get();
        $lensColors     =   $colors->where('type','lens')->values();
        $framesColors   = $colors->where('type','frame')->values();

        return view('admin.products.create',compact('vendors','brands','categories',
            'frame_materials','frame_shaps','product_types','ages','lensColors','framesColors'
        ));
    }

    public function edit(Product $product)
    {
        return view('admin.products.edit',compact('product'));
    }

    public function store(Request $request)
    {

        $product = new Product();
        $this->modelData($request,$product);

        $product->lens_colors()->sync($request->lens_color_id);
        $product->frame_colors()->sync($request->frame_color_id);
        $this->upload_image($product,$request);
        $this->upload_multi_images($product,$request);

        session()->flash('success','تم الإضافة  بنجاح');

        return redirect()->route('products.index') ;
    }

    public function update(Request $request,Product $product)
    {
        if ($request->price){
            $product->update(['price' => $request->price ]);
        }

        session()->flash('success','تم التعديل  بنجاح');

        return redirect()->route('products.index') ;
    }

    public function delete(Request $request)
    {
        $model = Product::find($request->id);

        $model->clearMediaCollection('master_image');
        $model->clearMediaCollection();
        if ($model->delete()) {
            return response()->json(['status' => true, 'data' => $model->id]);
        }
    }

    private function modelData($request,$product)
    {
        $additional_data = [
            'frame_height'      => $request->additional_data['frame_height'] ??   $product->frame_height,
            'temple_length'     => $request->additional_data['temple_length'] ??   $product->temple_length,
            'lens_width'        => $request->additional_data['lens_width']  ?? $product->lens_width,
            'nose_bridge'       => $request->additional_data['nose_bridge'] ??   $product->nose_bridge,
            'delivery_price'    => $request->additional_data['delivery_price'] ??   $product->delivery_price,
            'delivery_days'     => $request->additional_data['delivery_days'] ??   $product->delivery_days,
        ];

        $product->user_id               = $request->user_id ? :  auth()->id();
        $product->category_id           = $request->category_id;
        $product->brand_id              = $request->brand_id;
        $product->frame_material_id     = $request->frame_material_id;
        $product->age_id                = $request->age_id;
        $product->frame_shap_id         = $request->frame_shap_id;
        $product->product_type_id       = $request->product_type_id;
        $product->additional_data       = $additional_data;
        $product->price                 = $request->price;
        $product->quantity              = $request->quantity;
        $product->{'name:ar'}           = $request->name_ar;
        $product->{'name:en'}           = $request->name_en;
        $product->{'description:ar'}    = $request->description_ar;
        $product->{'description:en'}    = $request->description_en;
        $product->save();
    }
}
