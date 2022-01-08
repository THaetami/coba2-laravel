<?php

namespace App\Http\Controllers;

use App\Models\Author;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash; //enkripsi password

class RegisterController extends Controller
{
    public function index()
    {
        return view('register.index', [
            'title' => 'Register'
        ]);
    }

    public function store(Request $request)
    {
        $validatedData = $request->validate([ //validasi proses authenticate
            'name' => 'required|max:30|min:4|regex:/^[a-zA-Z ]*$/',
            'username' => 'required|min:6|max:10|unique:authors|regex:/^[a-zA-Z0-9]*$/',
            'email' => 'required|email:dns|unique:authors',
            'password' => 'required|min:5 max:12|regex:/^[a-zA-Z0-9]*$/'
        ]);

        $validatedData['password'] = Hash::make($validatedData['password']);

        Author::create($validatedData);

        return redirect('/login')->with('success', 'Registrasi telah berhasil, squy login!!'); //pesan ke halaman login
    }

}
