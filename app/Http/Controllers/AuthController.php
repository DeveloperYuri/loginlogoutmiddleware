<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\Hash;


class AuthController extends Controller
{
    public function registration()
    {
        return view('auth.registration');
    }

    public function registration_post(Request $request)
    {
        //dd($request->all());

        $user = request()->validate([
            'name' => 'required',
            'email' => 'required|unique:users',
            'password' => 'required|min:6',
            'confirm_password' => 'required_with:password|same:password|min:6',
            'is_role' => 'required'
        ]);

        $user = new User;
        $user->name = trim($request->name);
        $user->email = trim($request->email);
        $user->password = Hash::make($request->password);
        $user->is_role = trim($request->is_role);
        $user->remember_token = Str::random(50);
        $user->save();

        return redirect('login')->with('success', 'Register successfully');
    }

    public function login()
    {
        return view('auth.login');
    }

    public function login_post(Request $request)
    {
        //dd($request->all());

        if (Auth::attempt(['email' => $request->email, 'password' => $request->password], true)) {
            if (Auth::user()->is_role == 2) {
                return redirect()->intended('superadmin/dashboard');
            } else if (Auth::user()->is_role == 1) {
                return redirect()->intended('admin/dashboard');
            } else if (Auth::user()->is_role == 0) {
                return redirect()->intended('user/dashboard');
            } else {
                return redirect('login')->with('error', 'No Available Email.. Please Check');
            }
        } else {
            return redirect()->back()->with('error', 'Please enter the correct credentials');
        }
    }

    public function forgot()
    {
        return view('auth.forgot');
    }

    public function logout()
    {
        Auth::logout();
        return redirect(url('login'));
    }
}
