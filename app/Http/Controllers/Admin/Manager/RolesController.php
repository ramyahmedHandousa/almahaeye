<?php

namespace App\Http\Controllers\Admin\Manager;

use App\Http\Controllers\Controller;
use Illuminate\Auth\Access\Gate;
use Illuminate\Http\Request;
use Illuminate\Support\Str;
use Silber\Bouncer\Database\Ability;
use Silber\Bouncer\Database\Role;

class RolesController extends Controller
{
    public function index()
    {
        $roles = Role::all();

        return view('admin.roles.index')->with(compact('roles'));
    }

    public function  create()
    {
        $abilities = $this->getAbilities();

        return view('admin.roles.create', compact('abilities'))->render();
    }

    public function store(Request $request)
    {

        $mainAbilities = collect($request->input('main_abilities'));
        $subAbilities = collect($request->input('sub_abilities'));

        $abilites =  $mainAbilities->merge($subAbilities);

        $this->validate($request,[
            'title' => 'required|unique:roles,title',
            'main_abilities' => 'required|array'
        ], [
            'title.required' => __('trans.required'),
            'main_abilities.required' => 'إختار مهمة واحدة علي الأقل',
            'title.unique' => __('trans.unique_ar_title'),
        ]);

        $role = new Role;
        $role->title = $request->title;
        $role->name = mb_strtolower(str_replace(' ', '_', $request->title),'UTF-8');
        $role->save();

        if ($abilites->count() > 0) {
            $role->allow($abilites);
        }

        session()->flash('success', __('trans.addingSuccess'));

        return redirect(route('roles.index'));
    }

    public function edit($id)
    {

        $abilities = $this->getAbilities();

        $role = Role::findOrFail($id);

        return view('admin.roles.edit', compact('role', 'abilities'));
    }

    public function update(Request $request, $id)
    {
        $this->validate($request,[
            'title' => 'required|unique:roles,title,'.$id,
        ], [
            'title.required' => __('trans.required'),
            'title.unique' => __('trans.unique_ar_title'),
        ]);

        $role = Role::findOrFail($id);

        $role->title = $request->title;
        $role->name = mb_strtolower(str_replace(' ', '_', $request->title),'UTF-8');

        $role->save();

        $mainAbilities = collect($request->input('main_abilities'));
        $subAbilities = collect($request->input('sub_abilities'));

        $abilites =  $mainAbilities->merge($subAbilities);

        if ($abilites->count() > 0) {
            foreach ($role->getAbilities() as $ability) {
                $role->disallow($ability->id);
            }
            $role->allow($abilites);
        }

        session()->flash('success', "لقد تم تعديل الدور  ($role->title) بنجاح");

        return redirect(route('roles.index'));
    }

    public function delete(Request $request)
    {

        $role = Role::findOrFail($request->id);

        if ($role->users->count() > 0) {
            return response()->json([
                'status' => false,
                'message' => 'عفواً, لا يمكنك حذف الدور نظراً لوجود مستخدمين مشتركين فيه'
            ]);
        }

        foreach ($role->getAbilities() as $ability) {
            $role->disallow($ability->id);
        }

        if ($role->delete()) {
            return response()->json([
                'status' => true,
                'data' => [
                    'id' => $request->id
                ],
                'message' => 'لقد تم عمليه الحذف بنجاح'
            ]);
        }

    }

    public function groupDelete(Request $request)
    {
        if (!Gate::allows('users_manage')) {
            return abort(401);
        }

        $ids = $request->ids;
        foreach ($ids as $id) {
            $role = Role::findOrFail($id);
            $role->delete();
        }

        return response()->json([
            'status' => true,
            'data' => [
                'id' => $request->id
            ]
        ]);
    }


    private function getAbilities()
    {
       return Ability::whereNull('parent_id')->where('name','!=','*')->get()->each(function ($ab) {
            $ab->children = Ability::whereParentId($ab->id)->get();
        });

    }
}
