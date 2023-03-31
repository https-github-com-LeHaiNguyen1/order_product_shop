<?php

namespace App\Http\Controllers;


use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Arr;

class HomeController extends Controller
{
    public function index()
    {
        /* This is a conditional statement that checks the role of the user and returns the appropriate view. */
        $user = Auth::user();
        $role = $user->role;

        return view($role == 0 ? 'MyPage/index' : 'Admin/index');
    }
}