<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;

use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Validator;

class LoginController extends Controller
{
    public function authenticate(Request $request)
    {

        $credentials = $request->only('username', 'password');

        if (Auth::attempt($credentials)) {
            return redirect()->route('home');
        }else{
            return redirect()->back()->withErrors(['Incorrect username or password']);
        }
    }


    public function logout(Request $request){
        Auth::logout();

        return redirect('/');
    }

    public function login(Request $request){
        dump(session()->all());

        return view('auth.login');
    }



}
