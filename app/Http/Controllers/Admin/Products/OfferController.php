<?php

namespace App\Http\Controllers\Admin\Products;

use App\Http\Controllers\Controller;
use App\Models\Product;
use Illuminate\Http\Request;

class OfferController extends Controller
{

    public function index()
    {
        return view('admin.products.offers.index',[
            'pageName' => ' العروض',
            'offers' => Product::where('discount','!=',0)->get(['id','price','discount','start_at','end_at'])
        ]);
    }

    public function create()
    {
        return view('admin.products.offers.create',[
            'products' => Product::where('discount','=',0)->get(['id']),
            'pageName' => 'إضافة عرض'
        ]);
    }

    public function edit($id)
    {
        return view('admin.products.offers.edit',[
            'offer'     => Product::findOrFail($id),
            'products' => Product::all(),
            'pageName' => 'تعديل العرض'
        ]);
    }

    public function store(Request $request)
    {
        $this->validate($request,[
            'discount'        => 'required|string|max:255',
            'start_at'          => 'required|date|after:yesterday',
            'end_at'            => 'required|date|after:start_at',
            'product_id'     => 'required|exists:products,id',
        ]);

        $product = Product::findOrFail($request->product_id);

        if ($request->discount > $product->price){
            session()->flash('myErrors', 'سعر الخصم اعلي من سعر المنتج');

            return  redirect()->back();
        }

        $product->update([
            'discount' =>  $request->discount,
            'start_at' =>  $request->date('start_at'),
            'end_at' =>    $request->date('end_at'),
        ]);

        session()->flash('success','تم الإضافة  بنجاح');

        return redirect()->route('offers.index') ;
    }


    public function update(Request $request, $id)
    {
        $this->validate($request,[
            'discount'          => 'sometimes|string|max:255',
            'start_at'          => 'sometimes|date|after:yesterday',
            'end_at'            => 'sometimes|date|after:start_at',

        ]);

        $product = Product::findOrFail($id);

        if ($request->discount){
            if ($request->discount > $product->price){
                session()->flash('myErrors', 'سعر الخصم اعلي من سعر المنتج');
                return  redirect()->back();
            }
        }

        $product->update([
            'discount' =>  $request->discount ? : $product->discount,
            'start_at' =>   $request->date('start_at') ? : $product->start_at,
            'end_at' =>    $request->date('end_at') ? : $product->end_at,
        ]);

        session()->flash('success','تم التعديل  بنجاح');

        return redirect()->route('offers.index') ;
    }


    public function destroy (Request $request)
    {
        $model = Product::find($request->id);

        $model->update(['discount' => 0,'start_at'=> null,'end_at' => null]);

        return response()->json(['status' => true, 'data' => $model->id]);
    }
}
