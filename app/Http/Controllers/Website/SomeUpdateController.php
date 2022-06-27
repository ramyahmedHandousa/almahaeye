<?php

namespace App\Http\Controllers\Website;

use App\Http\Controllers\Controller;
use App\Models\Brand;
use App\Models\User;
use App\Models\VendorBrand;
use Illuminate\Http\Request;

class SomeUpdateController extends Controller
{
    public function __invoke()
    {

      return  $this->createNewBrandForVendor();

    }


    private function createNewBrandForVendor()
    {
        $user_id = 63;

        $data = [
            [
                'user_id'           => $user_id,
                'product_type_id'   => 5,
                'price'             => '65',
                'brand_name'        => 'VOTCHY' ,
            ],
            [
                'user_id'           => $user_id,
                'product_type_id'   => 7,
                'price'             => '65',
                'brand_name'        =>  'PURE OPTICS',
            ],
        ];

        foreach ($data as $value){
            $brand = new Brand();
            $brand->{'name:ar'} = $value['brand_name'];
            $brand->{'name:en'} = $value['brand_name'];
            $brand->save();

            $vendorBrand =  new VendorBrand();
            $vendorBrand->user_id = $value['user_id'];
            $vendorBrand->brand_id = $brand->id;
            $vendorBrand->product_type_id = $value['product_type_id'];
            $vendorBrand->price = $value['price'];
            $vendorBrand->save();
        }

        return VendorBrand::whereUserId($user_id)->with('brand','product_type')->latest()->get();
    }
}
