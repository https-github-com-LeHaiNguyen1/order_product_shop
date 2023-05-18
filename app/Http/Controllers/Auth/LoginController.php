<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Providers\RouteServiceProvider;
use Illuminate\Foundation\Auth\AuthenticatesUsers;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Http\Controllers\HomeController;

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
    protected $redirectTo = RouteServiceProvider::HOME;

    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('guest')->except('logout');
    }

    /**
     * It logs the user out, invalidates the session, and regenerates the session token.
     * 
     * @param Request request The request object.
     * 
     * @return The user is being returned.
     */
    public function logout(Request $request)
    {
        Auth::logout();
        $request->session()->invalidate();
        $request->session()->regenerateToken();

        return redirect()->route('login');
    }

    public function login(Request $request)
    {
        if(Auth::check()){
            return redirect()->route('home');
        }
        return view('Auth.login');
    }

    public function postLogin(Request $request)
    {
        $data = $request->all();
        $db_check = [
            'email' => @$data['email'],
            'password' => @$data['password'],
        ];
        if (Auth::attempt($db_check)) {
            return app(HomeController::class)->index();
        } else {
            return redirect()->route('login');
        }
    }
}
