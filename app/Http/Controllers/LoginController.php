<?php

namespace App\Http\Controllers;


use Illuminate\Support\Facades\Auth; //proses authenticate


use Illuminate\Http\Request;

class LoginController extends Controller
{

    public function index()
    {
        return view('login.index', [
            'title' => 'login'
        ]);
    }


    public function authenticate(Request $request)
    {
        $credentials = $request->validate([ //validasi proses authenticate
            'email' => 'required|email:dns',
            'password' => 'required'
        ]);

        if (Auth::attempt($credentials)) {
            $request->session()->regenerate();

            return redirect()->intended('/');
        }

        return back()->with('loginError', 'Login failed');
    }

    public function logout(Request $request)
    {
        Auth::logout();

        $request->session()->invalidate();

        $request->session()->regenerateToken();

        return redirect('/login');
    }
}
