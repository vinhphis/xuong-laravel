<?php

namespace App\Http\Controllers\Client;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class SignInController extends Controller
{
    public function showSignIn()
    {
        return view('client.signin_signup.signIn');
    }

    public function signIn(Request $request)
    {
        $data = $request->validate([
            'email' => ['required', 'email'],
            'password' => ['required']
        ]);

        if (Auth::attempt($data)) {
            $request->session()->regenerate();
            return redirect('client/');
        }
        return back()->withErrors([
            'email' => 'Tài khoản hoặc mật khẩu sai',
            'password' => 'Tài khoản hoặc mật khẩu sai',
        ]);
    }

    public function logOut()
    {
        Auth::logout();
        \request()->session()->invalidate();
        return redirect('client/');
    }
}
