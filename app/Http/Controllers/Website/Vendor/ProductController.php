<?php

namespace App\Http\Controllers\Website\Vendor;

use App\Events\AdminNotificationEvent;
use App\Http\Controllers\Controller;
use App\Http\Requests\Website\Product\ProductStoreValid;
use App\Http\Requests\Website\Product\ProductUpdateValid;
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
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;

class ProductController extends Controller
{
    use ImageUploadMedia;

    public function __construct()
    {
        $this->middleware('auth');
    }

    public function index()
    {
        return  view('website.vendor.products.index',[
            'products' => auth()->user()->products()->select('id','price')->get()
        ]);
    }

    public function show(Product $product)
    {
        $colors             = Color::whereIsSuspended(0)->get();
        $lensColors         =   $colors->where('type','lens')->values();
        $framesColors       = $colors->where('type','frame')->values();
        return view('website.vendor.products.show',[
            'product' => $product,
            'lensColors' => $lensColors,
            'framesColors' => $framesColors,
        ]);
    }
    public function create()
    {
        $brands             = Brand::whereIsSuspended(0)->get();
        $categories         = Category::whereIsSuspended(0)->whereNull('parent_id')->whereHas('children')->get();
        $frame_materials    = FrameMaterial::whereIsSuspended(0)->get();
        $frame_shaps        = FrameShap::whereIsSuspended(0)->get();
        $product_types      = ProductType::whereIsSuspended(0)->get();
        $ages               = Age::whereIsSuspended(0)->get();
        $colors             = Color::whereIsSuspended(0)->get();
        $lensColors         =   $colors->where('type','lens')->values();
        $framesColors       = $colors->where('type','frame')->values();

        return  view('website.vendor.products.create',[
            'brands' => $brands,
            'categories' => $categories,
            'frame_materials' => $frame_materials,
            'frame_shaps' => $frame_shaps,
            'product_types' => $product_types,
            'ages' => $ages,
            'lensColors' => $lensColors,
            'framesColors' => $framesColors,
        ]);
    }

    public function edit(Product $product)
    {
        $brands             = Brand::whereIsSuspended(0)->get();
        $categories         = Category::whereIsSuspended(0)->whereNull('parent_id')->whereHas('children')->get();
        $frame_materials    = FrameMaterial::whereIsSuspended(0)->get();
        $frame_shaps        = FrameShap::whereIsSuspended(0)->get();
        $product_types      = ProductType::whereIsSuspended(0)->get();
        $ages               = Age::whereIsSuspended(0)->get();
        $colors             = Color::whereIsSuspended(0)->get();
        $lensColors         =   $colors->where('type','lens')->values();
        $framesColors       = $colors->where('type','frame')->values();

        return  view('website.vendor.products.edit',[
            'product' => $product,
            'brands' => $brands,
            'categories' => $categories,
            'frame_materials' => $frame_materials,
            'frame_shaps' => $frame_shaps,
            'product_types' => $product_types,
            'ages' => $ages,
            'lensColors' => $lensColors,
            'framesColors' => $framesColors,
        ]);
    }

    public function store(ProductStoreValid $request)
    {
        DB::beginTransaction();

        try {

            $product = auth()->user()->products()->create($request->validated());

            $product->lens_colors()->sync($request->lens_color_id);
            $product->frame_colors()->sync($request->frame_color_id);
            $this->upload_image($product,$request);
            $this->upload_multi_images($product,$request);
            event(new AdminNotificationEvent('تم إضافة منتج جديد من التاجر '. auth()->user()->name));
            DB::commit();

            session()->flash('success','تم إضافة المنتج بنجاح');

            return redirect()->route('vendor-products.index');

        } catch (\Exception $e) {

            Log::info($e->getMessage());

            DB::rollback();

            session()->flash('my-errors','للأسف حدث خطأ ما .برجاء المحاولة مرة اخري..');

            return redirect()->back();
        }
    }

    public function update(ProductUpdateValid $request,Product $product)
    {
        DB::beginTransaction();

        try {

            $product->fill($request->validated());
            $product->save();
            $product->lens_colors()->sync($request->lens_color_id);
            $product->frame_colors()->sync($request->frame_color_id);
            $this->upload_image($product,$request);
            $this->upload_multi_images($product,$request);

            DB::commit();

            session()->flash('success','تم تعديل المنتج بنجاح');

            return redirect()->route('vendor-products.index');

        } catch (\Exception $e) {

            DB::rollback();

            session()->flash('my-errors','للأسف حدث خطأ ما .برجاء المحاولة مرة اخري..');

            return redirect()->back();
        }
    }

    public function destroy(Request $request)
    {
        return response()->json(['status' => true,'id' => $request->id]);
    }

    public function categoriesData(Request $request)
    {
        return response()->json(Category::whereParentId($request->categoryId)->get(['id']));
    }



    private function modelData($request,$product)
    {
        $additional_data = [
            'frame_height'  => $request->additional_data['frame_height'] ? : $product->frame_height,
            'temple_length' => $request->additional_data['temple_length'] ? : $product->temple_length,
            'lens_width'    => $request->additional_data['lens_width']? : $product->lens_width,
            'nose_bridge'   => $request->additional_data['nose_bridge'] ? : $product->nose_bridge,
        ];

        $product->user_id               = auth()->id();
        $product->category_id           = $request->category_id         ?:$product->category_id;
        $product->brand_id              = $request->brand_id            ?:$product->brand_id;
        $product->frame_material_id     = $request->frame_material_id   ?:$product->frame_material_id;
        $product->age_id                = $request->age_id              ?:$product->age_id;
        $product->frame_shap_id         = $request->frame_shap_id       ?:$product->frame_shap_id;
        $product->product_type_id       = $request->product_type_id     ?:$product->product_type_id;
        $product->additional_data       = $additional_data;
        $product->price                 = $request->price               ?:$product->price;
        $product->quantity              = $request->quantity            ?:$product->quantity;
        $product->{'name:ar'}           = $request->name_ar             ?:$product->name_ar;
        $product->{'name:en'}           = $request->name_en             ?:$product->name_en;
        $product->{'description:ar'}    = $request->description_ar      ?:$product->description_ar;
        $product->{'description:en'}    = $request->description_en      ?:$product->description_en;
        $product->save();
    }
}
