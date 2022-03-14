<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Project;
use App\traits\ImageUploadMedia;
use Illuminate\Http\Request;
use Illuminate\Support\Arr;

class ProjectsController extends Controller
{
    use ImageUploadMedia;

    public function index()
    {

        return view('admin.projects.index',[
            'projects' => Project::latest()->get(),
            'pageName' => 'المشاريع'
        ]);
    }

    public function create()
    {
        return view('admin.projects.create');
    }

    public function edit($id)
    {
        $project =  Project::with('media')->findOrFail($id);

        return view('admin.projects.edit',[
            'project' =>  $project,
            'images' => $project?->media->where('collection_name', '!=', 'master_image'),
        ]);
    }

    public function store(Request $request)
    {
        $validated = $this->validate($request,[
            'owner'          => 'required|string|max:255',
            'title'          => 'required|string|max:255',
            'type'           => 'required|string|max:255',
            'size'           => 'required|string|max:255',
            'consultants'    => 'required|string|max:255',
            'scope_of_work'  => 'required|string',
            'image'          => 'required|image|mimes:jpeg,png,jpg|max:10000',
            'images.*'       => 'nullable|image|mimes:jpeg,png,jpg|max:10000',
        ]);

        Arr::pull($validated,'image');
        Arr::pull($validated,'images');

        $project = Project::create($validated);

        $this->upload_image($project,$request);

        $this->upload_multi_images($project,$request);

        session()->flash('success','تم إضافة المشروع بنجاح');

        return redirect()->route('projects.index');
    }

    public function update(Request $request ,Project $project)
    {
        $validated = $this->validate($request,[
            'order'          => 'nullable|unique:projects,order,' . $project->order,
            'owner'          => 'required|string|max:255',
            'title'          => 'required|string|max:255',
            'type'           => 'required|string|max:255',
            'size'           => 'required|string|max:255',
            'consultants'    => 'required|string|max:255',
            'scope_of_work'  => 'required|string',
            'image'          => 'nullable|image|mimes:jpeg,png,jpg|max:10000',
            'images.*'       => 'nullable|image|mimes:jpeg,png,jpg|max:10000',
        ]);

        Arr::pull($validated,'image');
        Arr::pull($validated,'images');

        $project->update($validated);

        $this->upload_image($project,$request);

        $this->upload_multi_images($project,$request);

        session()->flash('success','تم تعديل المشروع بنجاح');

        return redirect()->route('projects.index');
    }

    public function delete(Request $request){

        return $request->all();
    }


}
