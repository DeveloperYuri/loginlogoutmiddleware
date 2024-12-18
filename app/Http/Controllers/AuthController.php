<?php

namespace App\Http\Controllers;

use App\Http\Requests\ResetPassword;
use App\Mail\ForgotPasswordMail;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Mail;

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

    public function forgot_post(Request $request)
    {
        //dd($request->all());

        $count = User::where('email', '=', $request->email)->count();
        if ($count) {

            $user = User::where('email', '=', $request->email)->first();
            $user->remember_token = Str::random(50);
            $user->save();

            Mail::to($user->email)->send(new ForgotPasswordMail($user));

            return redirect()->back()->with('success', 'Password has been reset');
        } else {
            return redirect()->back()->with('error', 'Email not found in the system');
        }
    }

    public function getReset(Request $request, $token)
    {
        //dd($token);

        $user = User::where('remember_token', '=', $token);

        if ($user->count() == 0) {
            abort(403);
        }

        $user = $user->first();
        $data['token'] = $token;

        return view('auth.reset', $data);
    }

    public function postReset($token, ResetPassword $request)
    {
        $user = User::where('remember_token', '=', $token);

        if ($user->count() == 0) {
            abort(403);
        }

        $user = $user->first();

        $user->password = Hash::make($request->password);
        $user->remember_token = Str::random(50);
        $user->save();

        return redirect('login')->with('success', 'Successfully Password Reset');
    }

    public function logout()
    {
        Auth::logout();
        return redirect(url('login'));
    }
}
