<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class AuthController extends Controller
{
    public function login (Request $request){
        if ($request->isMethod('post')){
            $credentials = $request->validate([
                'email' => ['required', 'email'],
                'password' => ['required'],
            ]);

            if (Auth::attempt($credentials)){
                $request->session()->regenerate();
                return redirect()->route('admin.dashboard');
            } else {
                return back()->withErrors([
                    'email' => 'The provided credentials do not match our records'
                ]);
            }
        }
        return view('auth.login');
    }

    public function logout(){
        if (Auth::check()){
            Auth::logout();
        }
        return view('auth.login');
    }

}
