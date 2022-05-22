<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;

class RegisterController extends Controller
{
    public function create(){
        return view('register.create');
    }
    public function store(Request $request){
        $attributes = $request->validate([
            'name'=>'required|min:3|max:225',
            'username'=>'required|min:3|max:225|unique:users,username',
            'email'=>'required|email|max:225|unique:users,email',
            'password'=>'required|max:225|min:7'
        ]);
//        $attributes['password'] = bcrypt($attributes['password']); //hash in model
        $user = User::create($attributes);

        auth()->login($user);

        return redirect('/')->with('success', 'Your account has been created');
    }
}
