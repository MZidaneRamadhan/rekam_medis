<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\Validator;

class LoginController extends Controller
{
    public function checklogin()
    {
        if (Auth::check()) {
            return redirect('dashboard');
        }else {
            return view('login');
        }
    }

    public function login_action(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'email'     => 'required',
            'password'  => 'required',
        ]);
        if ($validator->fails()) {
            return back()
                ->withErrors($validator)
                ->withInput();
        }
        $credentials = $request->only('email', 'password');
        if (Auth::Attempt($credentials)) {
            return redirect('dashboard')->with('success','Selamat Datang '. Auth::user()->name);
        } else {
            return redirect()->back()->with('error', 'Email atau password salah.')->withInput();;

        }
    }

    public function logout()
    {
        Auth::logout();
        return redirect('/')->with('success','Anda telah logout');
    }
}
