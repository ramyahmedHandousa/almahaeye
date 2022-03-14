<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Country;
use Illuminate\Http\Request;

class CountryController extends Controller
{
    public function index(Request $request)
    {
        $countriesQuery = Country::query();
        if ($request->has('type') && $request->type == 'sub'){

            $countriesQuery->whereHas('parent',fn($parent) => $parent->whereDoesntHave('parent'));

            $pageName = 'المحافظات';

        }elseif ($request->has('type') && $request->type == 'subSub'){

            $countriesQuery->whereHas('parent',fn($parent) => $parent->whereHas('parent',fn($parent) => $parent->whereDoesntHave('parent')));

            $pageName = 'المدن';
        }elseif ($request->has('type') && $request->type == 'subSubSub'){

            $countriesQuery->whereHas('parent',
                    fn($parent) => $parent->whereHas('parent',fn($parent) => $parent->whereHas('parent')));

            $pageName = 'الأحياء';
        }else{

            $countriesQuery->whereNull('parent_id');
            $pageName = 'الدول';
        }

        $countries = $countriesQuery->latest()->with('parent.parent')->get();

        return view('admin.countries.index',compact('countries','pageName'));
    }

    public function create(Request $request)
    {
        $pageName = $this->pageNameView($request);

        $countries = Country::whereNull('parent_id')->get();

        return view('admin.countries.create',compact('pageName','countries'));
    }

    public function edit(Request $request,Country $country)
    {
        $pageName =   $this->pageNameView($request);

        $countries = Country::whereNull('parent_id')->whereHas('children')->get();

        return view('admin.countries.edit',compact('country','pageName','countries'));
    }


    private function pageNameView($request)
    {
        return match ($request->type) {
            'sub' => 'المحافظة',
            'subSub' => 'المدينة',
            default => 'الدولة',
        };
    }

    public function store(Request $request)
    {
        $this->validate($request,[
            'name_ar'        => 'required|string|max:255',
            'name_en'        => 'required|string|max:255',
            'parent_id'      => 'sometimes|exists:countries,id',
        ]);

        $country = new Country();
        $this->modelData($request,$country);

        session()->flash('success','تم الإضافة بنجاح');

        return redirect()->route('countries.index',['type' => $request->type ?: null]) ;
    }

    public function update(Request $request,Country $country)
    {
        $this->validate($request,[
            'name_ar'        => 'sometimes|string|max:255',
            'name_en'        => 'sometimes|string|max:255',
            'parent_id'      => 'sometimes|exists:countries,id',
        ]);

        $this->modelData($request,$country);

        session()->flash('success','تم التعديل بنجاح');

        return redirect()->route('countries.index',['type' => $request->type ? 'sub' : null]) ;
    }

    public function delete(Request $request)
    {
        $model = Country::find($request->id);

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
        $country->parent_id   = $request->parent_id ? : null;
        $country->save();
    }

    public function sub_countries(Request $request)
    {
        return response()->json(['status' => 200,'data' =>  Country::whereParentId($request->id)->get()]);
    }
}
