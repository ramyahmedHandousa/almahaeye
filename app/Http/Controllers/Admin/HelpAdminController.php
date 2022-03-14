<?php

namespace App\Http\Controllers\Admin;


use App\Models\User;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Gate;

use Validator;
class HelpAdminController extends Controller
{
    public $public_path;

    public function __construct()
    {
        $this->public_path = 'files/helpAdmin/';

    }



    public function edit($id)
    {

        $user = User::findOrFail($id);

        return view('admin.helpAdmin.edit', compact('user'));
    }

    public function update(Request $request, $id)
    {

        $postData = $this->postData($request);

        // Declare Validation Rules.
        $valRules = $this->valRules($id);

        // Declare Validation Messages
        $valMessages = $this->valMessages();

        // Validate Input
        $valResult = Validator::make($postData, $valRules, $valMessages);

        // Check Validate
        if ($valResult->passes()) {

            $user = User::findOrFail($id);
            $user->name = $request->name;
            $user->email = $request->email;
                if ($request->password) {
                    $user->password = $request->password;
                }
                if ($request->hasFile('image')):
                    $user->clearMediaCollection();
                    $user->addMediaFromRequest('image')->toMediaCollection();
                endif;
            $user->save();


            session()->flash('success', "لقد تم التعديل بنجاح");

            return redirect()->back();
        } else {

            $valErrors = $valResult->messages();

            // Error, Redirect To User Edit
            return redirect()->back()->withInput()
                ->withErrors($valErrors);

        }
    }



    private function postData($request)
    {
        $data =  [
            'name' => $request->name,
            'email' => $request->email,
            'password' => $request->password,
            'password_confirmation' => $request->password_confirmation,
        ];

        if ($request->file('image')){
            $data['image'] = $request->image;
        }

        return $data;
    }

    /**
     * @return array
     */
    private function valRules($id)
    {
        return [
             'name' => 'required',
            'email' => 'required|email|unique:users,email,' . $id,
            'image' => 'image|mimes:jpeg,png,jpg|max:2048',
            'password_confirmation' => 'same:password'
        ];
    }

    /**
     * @return array
     */
    private function valMessages()
    {
        return [
             'name.required' => trans('global.field_required'),
            'name.unique' => trans('global.unique_name'),
            'email.required' => trans('global.field_required'),
            'email.unique' => trans('global.unique_email'),
            'phone.required' => trans('global.field_required'),
            'phone.unique' => trans('global.unique_phone'),
        ];
    }


}
