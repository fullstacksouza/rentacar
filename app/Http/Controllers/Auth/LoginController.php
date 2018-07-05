<?php

namespace App\Http\Controllers\Auth;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Foundation\Auth\AuthenticatesUsers;
use Illuminate\Support\Facades\Auth;
class LoginController extends Controller
{
    /*
    |--------------------------------------------------------------------------
    | Login Controller
    |--------------------------------------------------------------------------
    |
    | This controller handles authenticating users for the application and
    | redirecting them to your home screen. The controller uses a trait
    | to conveniently provide its functionality to your applications.
    |
    */

    use AuthenticatesUsers;

    /**
     * Where to redirect users after login.
     *
     * @var string
     */
    protected $redirectTo = '/home';

    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function login(Request $request)
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
    public function __construct()
    {
        $this->middleware('guest')->except('logout');
    }

}
