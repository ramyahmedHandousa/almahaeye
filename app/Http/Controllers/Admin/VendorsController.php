<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Brand;
use App\Models\ProductType;
use App\Models\User;
use App\Models\VendorBrand;
use Illuminate\Http\Request;

class VendorsController extends Controller
{
    public function index(Request $request)
    {
        $vendorsQuery = User::where('type','vendor');

        $pageName = 'التجار';
        if ($request->type == 'new'){

            $vendorsQuery->where('is_accepted',0);

            $view = 'new';
        }else{

            $vendorsQuery->where('is_accepted',1);

            $view = 'index';
        }

       $users = $vendorsQuery->with('country','bank')->get();

        return view('admin.vendors.'.$view,compact('users','pageName'));
    }


    public function show(User $user)
    {
          $user->loadCount('products','address');

          return view('admin.vendors.show',compact('user'));
    }

    public function marketing_information(User $user)
    {
        $vendorBrands = VendorBrand::where('user_id',$user->id)->with('brand','product_type')->get();

        $brands = Brand::all();

        $productTypes = ProductType::all();

        return view('admin.vendors.marketing_agreement',compact('user','vendorBrands','brands','productTypes'));
    }


    public function accepted(Request $request,User $user)
    {
          $user->update(['is_accepted' => 1,'marketing_agree' => 1]);

            session()->flash('success','تم قبول التاجر بنجاح');

            return redirect()->back() ;
    }

    public function refuse(Request $request,User $user)
    {

        $user->update(['is_accepted' => -1]);

        session()->flash('success','تم رفض  التاجر بنجاح');

        return redirect()->back() ;
    }

    public function percentage(Request $request)
    {
        $user = User::find($request->id);
        if ($user && (intval($request->value) <= 1000)){
            $user->update(['percentage' => intval($request->value)]);
        }
    }

    public function deliveryPrice(Request $request)
    {
        $user = User::find($request->id);
        if ($user ){
            $user->update(['delivery_price' => $request->value]);
        }
    }

    public function updateVendorBrandData(Request $request)
    {
        $vendorBrand = VendorBrand::findOrFail($request->id);

        $vendorBrand->fill([$request->type  => $request->value]);
        $vendorBrand->save();
    }
}
