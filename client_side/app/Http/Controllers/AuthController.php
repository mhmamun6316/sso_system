<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Http;
use App\Models\User;

class AuthController extends Controller
{
    public function login(Request $request){
        if (Auth::attempt(['email' => $request->local_email, 'password' => $request->local_password]))
        {
            return redirect()->intended('dashboard');
        }else{
            return redirect()->back()->with('fail','please provide valid email address and password');
        }
    }

    public function ssoLogin(Request $request){
        return redirect('http://127.0.0.1:8000/sso/login?token=32f279f3fe893bdac71a4f03cccc7916');
    }

    public function dashboard(){
        return view('dashboard');
    }

    public function ssoDashboard(){
        return view('sso-dashboard');
    }

    public function logout(){
        auth()->logout();
        return redirect('/');
    }
}
