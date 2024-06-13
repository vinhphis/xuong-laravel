<?php

namespace App\Http\Controllers\Client;

use App\Http\Controllers\Auth\RegisterController;
use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class SignUpController extends Controller
{
    public function showSignUp()
    {
        return view('client.signin_signup.signUp');
    }

    public function signUp(Request $request)
    {
        $data = $request->validate([
            'name' => ['required', 'string', 'max:255'],
            'email' => ['required', 'string', 'email', 'max:255', 'unique:users'],
            'password' => ['required', 'string', 'min:8', 'confirmed'],
        ]);


        $user = User::query()->create($data);

        Auth::login($user);

        $request->session()->regenerate();

        return redirect()->route('client.home');
    }
}
