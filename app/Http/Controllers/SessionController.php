<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Nette\Schema\ValidationException;

class SessionController extends Controller
{
    public function login(){
        return view('sessions.create');
    }
    public function store(){
        //validate request
        $attributes = request()->validate([
           'email' => 'required|email', //exist:users,
           'password' => 'required'
        ]);

        //attempt to authentication and login the user
        //based on the provided credentials
        if (auth()->attempt($attributes)) {
            //auth failed
            throw \Illuminate\Validation\ValidationException::withMessages([
                'email' => 'Your provided credentials value does not match our records.'
            ]);

        }
        //session fixation
        session()->regenerate();

        //redirect with flash message
        return redirect('/')->with('success', 'Welcome Back!');

    }

    public function destroy(){
         auth()->logout();

         return redirect('/')->with('logout', 'Good bye!');
    }
}
