<?php

namespace App\Http\Controllers\Admin\Manager;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Silber\Bouncer\Database\Ability;

class AbilitiesController extends Controller
{
    public function index()
    {
        $abilities = Ability::all();

        return view('admin.abilities.index', compact('abilities'));
    }


    public function create()
    {
        $abilities = Ability::whereNull('parent_id')->get();

        return view('admin.abilities.create',compact('abilities'));
    }


    public function store(Request $request)
    {
        $this->validate($request,['name' => 'required','title' => 'required']);

        Ability::create($request->all());

        return redirect()->route('abilities.index');
    }


    public function edit($id)
    {
        $ability = Ability::findOrFail($id);

        return view('admin.abilities.edit', compact('ability'));
    }

    public function update(Request $request, $id)
    {

        $this->validate($request,['name' => 'required','title' => 'required']);

        $ability = Ability::findOrFail($id);

        $ability->update($request->all());

        return redirect()->route('abilities.index');
    }



    public function destroy($id)
    {

        $ability = Ability::findOrFail($id);
        $ability->delete();

        return redirect()->route('admin.abilities.index');
    }


    public function massDestroy(Request $request)
    {

        if ($request->input('ids')) {
            $entries = Ability::whereIn('id', $request->input('ids'))->get();

            foreach ($entries as $entry) {
                $entry->delete();
            }
        }
    }
}
