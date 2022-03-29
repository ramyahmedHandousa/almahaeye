<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Category;
use App\Models\Country;
use App\Models\Product;
use App\Models\Shipping;
use App\Models\User;
use Illuminate\Http\Request;

class HomeController extends Controller
{

    public function __invoke()
    {
        $usersCount = User::where('type','=','client')->count();
        $vendorCount = User::where('type','=','vendor')->count();
        $countriesCount = Country::whereNull('parent_id')->count();
        $categoriesCount = Category::whereNull('parent_id')->count();
        $productsCount = Product::where('user_id','!=',auth()->id())->count();
        $shippingCount = Shipping::select('id')->count();
        $newProductsCount = Product::select('id')->whereIsNew(0)->count();

        return view('admin.home.index',compact('usersCount',
        'vendorCount','countriesCount','categoriesCount','productsCount',
            'shippingCount','newProductsCount'));
    }
}
