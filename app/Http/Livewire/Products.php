<?php

namespace App\Http\Livewire;


use App\Models\Brand;
use App\Models\Category;
use App\Models\Product;
use Illuminate\Support\Facades\Log;
use Livewire\Component;
use function request;
use function view;

class Products extends Component
{
    public string|null $q = '';

    public int|string|null $category_id = null;
    public int|string|null $brand_id = null;
    public int|string|null  $price = null;
    public bool|null  $discount = false;

    protected $queryString = [
        'q' => ['except' => ' '],
        'category_id',
        'discount',
    ];


    public function mount()
    {
        $this->q = request()->query('q', $this->q);
        $this->category_id = request()->query('category_id', $this->category_id);
        $this->price = request('price');
        $this->discount = request('discount');
    }

    public function render()
    {

        $products = Product::whereIsNew(1)->when(filled($this->q),function ($q) {
                        $q->where(function ($pro) {
                            $pro->whereTranslationLike('name', '%' . $this->q . '%')
                                ->orWhereHas('brand', fn($brand) => $brand->whereTranslationLike('name', '%' . $this->q . '%'));
                        });

        })->when(filled($this->category_id),
            fn($pro) => $pro->whereHas('category',
                fn($category) => $category->whereHas('parent',
                    fn($parent) => $parent->where('id',$this->category_id))))
            ->when(filled($this->brand_id),fn($pro) => $pro->where('brand_id',$this->brand_id))
            ->when(filled($this->price),fn($pro) => $pro->where('price','>=',$this->price))
            ->when($this->discount,fn($pro) => $pro->where('discount','!=',0))
            ->take(27)->latest()->get();

        $categories = Category::whereIsSuspended(0)->whereHas('children',
            fn($child) => $child->whereHas('products'))->get(['id']);

        $brands = Brand::whereIsSuspended(0)->whereHas('products')->get(['id']);

        return view('livewire.products',compact('products','categories','brands'))
            ->extends('website.layouts.master');
    }


    public function selectCategory($categoryId)
    {
        $this->category_id = $categoryId;
    }


    public function selectBrand($brandId)
    {
        $this->brand_id = $brandId;
    }


}
