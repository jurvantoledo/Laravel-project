<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Models\User;
use Illuminate\Http\Request; // Request method takes in an request and shows the output you filled in
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Hash;

class RegisterController extends Controller
{
    public function index()
    {
        return view('auth.register');
    }

    public function store(Request $request) 
    {
        // validation --> use request method for validation
        $this->validate($request, [
            'name' => 'required|max:255', // can also do it like this : ['required', 'max:255']
            'username' => 'required|max:255',
            'email' => 'required|email|max:255',
            'password' => 'required|confirmed', // confirmed will look for any other data that u submitted with a _confirmed name. EXAMPLE: password_confirmation 
            ]);

        // store user
        User::create([
            'name' => $request->name,
            'username' => $request->username,
            'email' => $request->email,
            'password' => Hash::$request->password,
        ]);

        // sign user in
        //with attempt() you sign a user in
        auth()->attempt($request->only('email', 'password')); //The only() method gives back an array of the items you want

       /* THIS IS ALSO A WAY TO DO IT
        auth()->attempt([
            'email' => $request->email,
            'password' => $request->password,
        ]);
       */

        // redirect
        return redirect()->route('dashboard');
    }
}
