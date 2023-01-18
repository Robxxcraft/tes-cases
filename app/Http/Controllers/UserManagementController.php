<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\Role;
use App\Models\User;

class UserManagementController extends Controller
{
    public function index(Request $request)
    {
        $data = User::with('role')->when($request->has('search'), function($q)use($request){
            $q->where('username', 'like', '%'.$request->query('search').'%')->orWhere('email', 'like', '%'.$request->query('search').'%');
        })->latest()->paginate(5);
        return view('user.manage', ['data' => $data]);
    }

    public function create()
    {
       $roles = Role::all();
       
       return view('user.create', ['roles' => $roles]);
    }

    public function createPost(Request $request)
    {
        $request->validate([
            'username' => 'required|min:2|max:60',
            'email' => 'required|email|unique:users,email',
            'password' => 'required|min:6|max:30',
            'role_id' => 'required',
        ],
        [
            'username.required' => ':attribute should not be null',
            'email.required' => ':attribute should not be null',
            'password.required' => ':attribute should not be null',
            'role_id.required' => 'Role should not be null',
        ]);

        User::create([
            'username' => ucwords(strtolower($request->username)),
            'email' => $request->email,
            // 'password' => Hash::make($request->password),
            'password' => $request->password,
            'role_id' => $request->role_id
        ]);
            
        return redirect()->to('/user-management')->with('alert', 'user created successfully')->with('alert-class', 'alert-success');
    }

    public function edit($id)
    {
        $user = User::findOrFail($id);
        $roles = Role::all();

        return view('user.edit', ['user' => $user, 'roles' => $roles]);
    }

    public function update(Request $request, $id)
    {
        $request->validate([
            'username' => 'required|min:2|max:60|unique:users,username,'.$id,
            'email' => 'required|email|unique:users,email,'.$id,
            'password' => 'required|min:6|max:30',
        ],
        [
            'username.required' => ':attribute should not be null',
            'email.required' => ':attribute should not be null',
            'password.required' => ':attribute should not be null',
        ]);

        $user = User::find($id);

        $user->update([
            'username' => ucwords(strtolower($request->username)),
            'email' => $request->email,
            // 'password' => Hash::make($request->password),
            'password' => $request->password,
            'role_id' => $request->role_id
        ]);

        return redirect()->to('/user-management')->with('alert', 'User updated successfully')->with('alert-class', 'alert-success');
    }

    public function destroy($id)
    {
        $user = User::findOrFail($id);
        $user->delete();

        return redirect()->back()->with('alert', 'User deleted successfully')->with('alert-class', 'alert-success');
    }
}