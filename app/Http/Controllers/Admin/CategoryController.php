<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Category;
use App\traits\ImageUploadMedia;
use Illuminate\Http\Request;

class CategoryController extends Controller
{
    use ImageUploadMedia;

    public function index()
    {
        $categoriesQuery = Category::query();

        if (!\request('type')){
            $categoriesQuery->whereNull('parent_id');
        }else{
            $categoriesQuery->whereNotNull('parent_id');
        }

        $categories = $categoriesQuery->latest()->get();

        $pageName = 'الأقسام';

        return view('admin.categories.index',compact('categories','pageName'));
    }

    public function create()
    {
        $masterCategories = Category::whereNull('parent_id')->get();

        return view('admin.categories.create',compact('masterCategories'));
    }

    public function edit(Category $category)
    {
        $masterCategories = Category::whereNull('parent_id')->get();

        return view('admin.categories.edit',compact('category','masterCategories'));
    }

    public function store(Request $request)
    {

        $this->validate($request,[
            'name_ar'        => 'required|string|max:255',
            'name_en'        => 'required|string|max:255',
            'parent_id'      => 'sometimes|exists:categories,id',
            'image'          => 'required|image|mimes:jpeg,png,jpg|max:10000',
        ]);

        $category = new Category();
        $this->modelData($request,$category);
        $this->upload_image($category,$request);

        session()->flash('success','تم إضافة القسم بنجاح');

        return redirect()->route('categories.index',['type' => $request->type]) ;
    }

    public function update(Request $request, Category $category)
    {

        $this->validate($request,[
            'name_ar'        => 'sometimes|string|max:255',
            'name_en'        => 'sometimes|string|max:255',
            'parent_id'      => 'sometimes|exists:categories,id',
            'image'          => 'sometimes|image|mimes:jpeg,png,jpg|max:10000',
        ]);

        $this->modelData($request,$category);
        $this->upload_image($category,$request);

        session()->flash('success','تم تعديل القسم بنجاح');

        return redirect()->route('categories.index',['type' => $request->type ? : null]) ;
    }

    public function delete(Request $request)
    {
        $model = Category::find($request->id);

        $model->clearMediaCollection('master_image');
        if ($model->delete()) {
            return response()->json([
                'status' => true,
                'data' => $model->id
            ]);
        }
    }

    private function modelData($request,$category)
    {
        $category->{'name:ar'} = $request->name_ar;
        $category->{'name:en'} = $request->name_en;
        $category->parent_id = $request->parent_id ? : null;
        $category->save();
    }

    public function sub_categories(Request $request)
    {
        return response()->json(['status' => 200,'data' =>  Category::whereParentId($request->id)->get()]);
    }
}
