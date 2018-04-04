<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
class LoginController extends Controller
{
    //
    public function __construct()
    {
        $this->middleware('guest')->except('logout');
    }

    public function auth(Request $request)
    {
        if(filter_var($request->email,FILTER_VALIDATE_EMAIL))
        {
            Auth::attempt(['email'=>$request->email,'password'=>$request->password]);
        }else
        {
            Auth::attempt(['registration'=>$request->email,'password'=>$request->password]);

        }

        if(Auth::check())
        {
            return redirect()->intended('home');
        }
        

        return redirect()->back()->withErrors(['email'=>'credenciais invalidas']);

    }
}
