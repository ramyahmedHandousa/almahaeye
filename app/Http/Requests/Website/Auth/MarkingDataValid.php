<?php

namespace App\Http\Requests\Website\Auth;

use Illuminate\Foundation\Http\FormRequest;

class MarkingDataValid extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
    {
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        return [

            'date_now'                  => 'required|date',

            'master_one.name'           => 'required|string',
            'master_one.status_card'    => 'required|string',
            'master_one.comingـfrom'    => 'required|string',
            'master_one.date'           => 'required|date',

            'master_two.company_name'           => 'required|string',
            'master_two.commercialـrecord'      => 'required|string',
            'master_two.number'                 => 'required',
            'master_two.name'                   => 'required|string',
            'master_two.status_card'            => 'required|string',
            'master_two.comingـfrom'            => 'required|string',
            'master_two.date'                   => 'required|date',

            'products.*.brand_image'        => 'sometimes|image|mimes:jpeg,png,jpg|max:20000',
            'products.*.product_type'       => 'required|exists:product_types,id',
            'products.*.product_price'      => 'required',

        ];
    }


    public function messages()
    {
        return [

            'date_now.required'                     =>  'يرجي التآكد من تاريخ اليوم',
            'date_now.date'                         =>  'تاريخ اليوم يجب ان يكون بصيغة صحيحة',

            'master_one.name.required'              =>  'إسم السيد في البيان رقم 1',
            'master_one.status_card.required'       =>  'بطاقة الآحوال في البيان رقم 1',
            'master_one.comingـfrom.required'       =>  'صادرة من  في البيان رقم 1',
            'master_one.date.required'              =>  'التاريخ  في البيان رقم 1',

            'master_two.company_name.required'      =>  'إسم الشركة في البيان رقم 2',
            'master_two.commercialـrecord.required' =>  'دقم السجل التجاري في البيان رقم 2',
            'master_two.number.required'            =>  'الهاتف  في البيان رقم 2',
            'master_two.name.required'              =>  'إسم السيد في البيان رقم 2',
            'master_two.status_card.required'       =>  'بطاقة الآحوال   في البيان رقم 2',
            'master_two.comingـfrom.required'       =>  'صادرة من   في البيان رقم 2',
            'master_two.date.required'              =>  ' التاريخ في البيان رقم 2',

        ];
    }
}
