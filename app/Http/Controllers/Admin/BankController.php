<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Bank;
use App\traits\ImageUploadMedia;
use Illuminate\Http\Request;

class BankController extends Controller
{
    use ImageUploadMedia;

    public function index()
    {
        return view('admin.banks.index',[
            'banks' => Bank::latest()->get(),
            'pageName' => 'البنوك'
        ]);
    }

    public function create()
    {
        return view('admin.banks.create');
    }

    public function edit(Bank $bank)
    {

        return view('admin.banks.edit',compact('bank'));
    }

    public function store(Request $request)
    {
        $this->validate($request,[
            'name_ar'           => 'sometimes|string|max:255',
            'name_en'           => 'sometimes|string|max:255',
//            'account_name_ar'           => 'sometimes|string|max:255',
//            'account_name_en'           => 'sometimes|string|max:255',
//            'iban'              => 'sometimes|string|max:255',
        ]);

        $bank = new Bank();

        $this->modelData($request,$bank);
        $this->upload_image($bank,$request);
        session()->flash('success','تم الإضافة بنجاح');

        return redirect()->route('banks.index') ;
    }

    public function update(Request $request, Bank $bank)
    {
        $this->validate($request,[
            'name_ar'           => 'sometimes|string|max:255',
            'name_en'           => 'sometimes|string|max:255',
//            'account_name_ar'           => 'sometimes|string|max:255',
//            'account_name_en'           => 'sometimes|string|max:255',
//            'iban'              => 'sometimes|string|max:255',
        ]);

        $this->modelData($request,$bank);
        $this->upload_image($bank,$request);
        session()->flash('success','تم التعديل بنجاح');

        return redirect()->route('banks.index') ;
    }

    public function delete(Request $request){

        $model = Bank::find($request->id);

        $model->clearMediaCollection('master_image');
        if ($model->delete()) {
            return response()->json([
                'status' => true,
                'data' => $model->id
            ]);
        }
    }

    private function modelData($request,$country)
    {
        $country->{'name:ar'} = $request->name_ar;
        $country->{'name:en'} = $request->name_en;
//        $country->{'account_name:ar'} = $request->account_name_ar;
//        $country->{'account_name:en'} = $request->account_name_en;
//        $country->iban           = $request->iban ;
        $country->save();
    }
}
