<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Service;
use App\Models\Slider;
use App\traits\ImageUploadMedia;
use Illuminate\Http\Request;
use Illuminate\Support\Arr;

class ServicesController extends Controller
{
    use ImageUploadMedia;

    public function index()
    {

        return view('admin.services.index',[
            'services' => Service::latest()->get(),
            'pageName' => 'الخدمات'
        ]);
    }

    public function create()
    {
        return view('admin.services.create');
    }

    public function edit($id)
    {
        $service =  Service::with('media')->findOrFail($id);

        return view('admin.services.edit',[
            'service' =>  $service,
        ]);
    }

    public function store(Request $request)
    {
        $validated = $this->validate($request,[
            'title'          => 'required|string|max:255',
            'description'          => 'required|string|max:255',
            'content'          => 'required|string|max:255',
            'image'          => 'required|image|mimes:jpeg,png,jpg|max:10000',
        ]);

        Arr::pull($validated,'image');
        Arr::pull($validated,'images');

        $project = Service::create($validated);

        $this->upload_image($project,$request);

        session()->flash('success','تم إضافة الخدمة بنجاح');

        return redirect()->route('services.index');
    }

    public function update(Request $request ,Service $project)
    {
        $validated = $this->validate($request,[
            'title'          => 'required|string|max:255',
            'description'          => 'required|string|max:255',
            'content'          => 'required|string|max:255',
            'image'          => 'nullable|image|mimes:jpeg,png,jpg|max:10000',
        ]);

        Arr::pull($validated,'image');

        $project->update($validated);

        $this->upload_image($project,$request);

        session()->flash('success','تم تعديل الخدمة بنجاح');

        return redirect()->route('services.index');
    }

    public function delete(Request $request){

        $model = Service::find($request->id);

        $model->clearMediaCollection('master_image');
        if ($model->delete()) {
            return response()->json([
                'status' => true,
                'data' => $model->id
            ]);
        }
    }
}
