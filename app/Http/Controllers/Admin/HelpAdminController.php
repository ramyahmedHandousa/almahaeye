<?php

namespace App\Http\Controllers\Admin;


use App\Models\User;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Silber\Bouncer\Database\Role;
use Validator;
class HelpAdminController extends Controller
{
    public $public_path;

    public function __construct()
    {
        $this->public_path = 'files/helpAdmin/';

    }

    public function index(Request $request)
    {
        $users = User::whereType('helper_admin')->get();

        return view('admin.helpAdmin.index',compact('users'));
    }

    public function show($id)
    {
        $user = User::findOrFail($id);

        return view('admin.helpAdmin.show',compact('user'));
    }

    public function create()
    {
        $roles =  Role::all();

        if(count($roles) == 0){
            session()->flash('myErrors','برجاء إضافة صلاحيات و أدوار !!');

            return redirect()->back();
        }
        return view('admin.helpAdmin.create',[
            'roles' => $roles
        ]);
    }

    public function edit($id)
    {

        $user = User::findOrFail($id);

        return view('admin.helpAdmin.edit', compact('user'));
    }

    public function store(Request $request)
    {
        $this->validate($request,[
            'first_name'    => 'required',
            'last_name'     => 'required',
            'email'         => 'required|email|unique:users,email',
//            'phone'         => 'required|numeric|unique:users,phone|digits:10|regex:/(05)[0-9]{8}/',
            'phone'         => 'required|unique:users,phone',
            'password'      => 'required|min:6|max:32|confirmed',
            'roles'         => 'required|array',
            'image'         => 'nullable|image|mimes:jpeg,png,jpg|max:2048',
        ]);

        $user = User::create([
            'type'          => 'helper_admin',
            'name'          => $request->first_name .'-' .$request->last_name,
            'first_name'    => $request->first_name,
            'last_name'     => $request->last_name,
            'email'         => $request->email,
            'phone'         => $request->phone,
            'password'      => $request->password,

        ]);

        if ($request->hasFile('image')):
            $user->clearMediaCollection();
            $user->addMediaFromRequest('image')->toMediaCollection();
        endif;

        $user->save();

        foreach ($request->input('roles') as $role) {
            if ($role && $role != "") {
                $user->assign($role);
            }
        }

        session()->flash('success', __('trans.addingSuccess'));

        return redirect(route('helpAdmin.index'));
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
            $user->name         = $request->name;
            $user->first_name   = $request->first_name;
            $user->last_name    = $request->last_name;
            $user->phone        = $request->phone;
            $user->email        = $request->email;
            if ($request->password) {
                $user->password = $request->password;
            }
            if ($request->hasFile('image')):
                $user->clearMediaCollection();
                $user->addMediaFromRequest('image')->toMediaCollection();
            endif;
            $user->save();

            if ($request->input('roles')) {
                foreach ($user->roles as $role) {
                    $user->retract($role);
                }

                foreach ($request->input('roles') as $role) {
                    $user->assign($role);
                }
            }

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
            'phone' => $request->phone,
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
            'phone'         => 'required|unique:users,phone,'. $id,
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
