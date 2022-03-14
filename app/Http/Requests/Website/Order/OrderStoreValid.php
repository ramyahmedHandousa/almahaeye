<?php

namespace App\Http\Requests\Website\Order;

use App\Http\Requests\Website\MasterWebsiteFormRequest;
use App\Models\Product;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Session;

class OrderStoreValid extends MasterWebsiteFormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
    {
        if (Auth::check() && auth()->user()->type == 'client'){
            return true;
        }
        return false;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        return [
            'address_id'    => 'required|exists:addresses,id',
            'shipping_id'   => 'required|exists:shippings,id',
            'coupon'        => 'nullable|exists:promo_codes,code',
        ];
    }

    public function withValidator($validator)
    {
        $validator->after(function ($validator){

            $products = Session::get('cart');

            if ($products && count($products) > 0){

                $ids = collect($products)->keys();

                $checkAvailable = Product::whereIn('id',$ids)->count();

                if (count($ids) !== $checkAvailable){
                    $validator->errors()->add('unavailable', 'يوجد منتجات لم تعد متاحة الأن'); return;
                }

            }else{
                $validator->errors()->add('unavailable', 'يرجي التأكد من وجود منتجات لديك'); return;
            }


        });
    }
}
