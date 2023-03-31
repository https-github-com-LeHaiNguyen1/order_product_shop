<?php

namespace App\Http\Controllers;


use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Arr;

class HomeController extends Controller
{
    public function __construct() {
        $this->middleware('auth');
    }
    public function index()
    {
        if(Auth::check()){
            /* This  is a conditional statement that checks the role of the user and returns the appropriate view. */
            $user = Auth::user();
            $role = $user->role;
            if($user->role == 1){//admin
                return view('Admin.index');
            }

            if($user->role == 0){//client
                return view('MyPage.index');
            }
            
        }
        return redirect()->route('login');
    }
}