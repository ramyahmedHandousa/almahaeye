<?php

namespace App\Http\Controllers\Website\Auth;

use App\Http\Controllers\Controller;
use App\Http\Requests\Website\Auth\MarkingDataValid;
use App\Models\Brand;
use App\Models\ProductType;
use App\Models\VendorBrand;
use Illuminate\Http\Request;

class MarkingAgreeController extends Controller
{
    public function __invoke(Request $request)
    {
        $user = $request->user();

        if ($user->marketing_agree_info != null){

            session()->flash('my-errors','تم تقديم طلبك مسبقا ..');

            return redirect()->back();
        }

        $brands = Brand::with('media')->get();

        $productTypes = ProductType::all();

        return view('website.auth.complete_marketing_agree',compact('brands','productTypes'));
    }

    public function store(MarkingDataValid $request)
    {



        $user = $request->user();

        if ($user->marketing_agree_info != null){

            session()->flash('my-errors','تم تقديم طلبك مسبقا ..');

            return redirect()->back();
        }

        $this->addBrands($request);

        $data = [
            'date_now' => $request->date_now,
            'master_one' => $request->master_one,
            'master_two' => $request->master_two,
        ];

        $user->update(['marketing_agree_info' => $data]);

        session()->flash('success','تم تقديم السمتند بنجاح ');

        return redirect('/');
    }

    private function addBrands($request)
    {
        if ($request->products){

            $requestBrands = collect($request->products)->values();

            foreach ($requestBrands as $requestBrand){

                $brand = Brand::find($requestBrand['brand_name']);

                if (!$brand){
                    $brand = new Brand();
                    $brand->{'name:ar'} = $requestBrand['brand_name'];
                    $brand->{'name:en'} = $requestBrand['brand_name'];
                    $brand->save();
                }
                $vendorBrand =  new VendorBrand();
                $vendorBrand->user_id = auth()->id();
                $vendorBrand->brand_id = $brand->id;
                $vendorBrand->product_type_id = $requestBrand['product_type'];
                $vendorBrand->price = $requestBrand['product_price'];
                $vendorBrand->save();

                if (isset($requestBrand['brand_image']) ){
                    $vendorBrand->addMedia($requestBrand['brand_image'])->toMediaCollection();
                }

            }

        }
    }
}
