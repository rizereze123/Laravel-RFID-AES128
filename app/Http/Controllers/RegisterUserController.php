<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;

class RegisterUserController extends Controller
{

    public function create()
    {
        return view('register/register');
    }

    public function store(Request $request)
    {
        
        $validatedData = $request->validate([
            'name' => 'required|max:120',
            'email' => 'required|email|unique:users',
            'password' => 'required|min:6|max:255|confirmed'
        ]);

        $validatedData['password'] = bcrypt($validatedData['password']);

        // dd($validatedData);

        User::create($validatedData);

        return redirect('/login')->with('successRegister', 'Registrasi Berhasil!');
    }
}
