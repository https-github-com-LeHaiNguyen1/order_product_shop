<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class HomeController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }
    public function index()
    {
        return Auth::check() ? (Auth::user()->role == 1 ? redirect('/admin/menus?view_mode=output&full_name=' . urlencode(Auth::user()->name)) : view('MyPage.index')) : redirect()->route('login');
    }

}