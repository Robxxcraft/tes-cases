<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Auth;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Session;

class AuthController extends Controller
{
    public function register()
    {
        return view('auth.register');
    }

    // public function registerPost(Request $request)
    // {
    //     $request->validate([
    //         'username' => 'required|min:2|max:60',
    //         'email' => 'required|email|unique:users,email',
    //         'password' => 'required|min:6|max:30',
    //     ],
    //     [
    //         'username.required' => ':attribute should not be null',
    //         'email.required' => ':attribute should not be null',
    //         'password.required' => ':attribute should not be null',
    //     ]);

    //     User::create([
    //         'username' => ucwords(strtolower($request->username)),
    //         'email' => $request->email,
    //         // 'password' => Hash::make($request->password),
    //         'password' => $request->password,
    //         'role_id' => $request->role_id
    //     ]);

    //     return redirect()->to('/login')->with('registered', 'Account registered successfully');
    // }

    public function login()
    {
        return view('auth.login');
    }
    public function loginPost(Request $request)
    {
        $request->validate([
            'email' => 'required',
            'password' => 'required',
        ], 
        [
            'email.required' => ':attribute column should not be null',
            'password.required' => ':attribute column should not be null',
        ]);

        $user = User::where('email', $request->email)->where('password', $request->password)->first();

        if (!$user) {
            return back()->withErrors(['email' => 'The provided credentials are incorrect.']);
        }

        Auth::login($user);

        return redirect()->to('/')->with('logged', 'Your account logged');

        // $credentials = $request->only('email', 'password');

        // if (Auth::attempt($credentials)) {
        //     return redirect()->to('/')->with('logged', 'Your account logged');
        // } 
    }

    public function logout()
    {
        Session::flush();
        Auth::logout();
        return redirect()->to('/');
    }
}
