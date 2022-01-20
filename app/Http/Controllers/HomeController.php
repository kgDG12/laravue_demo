<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class HomeController extends Controller
{
    //
    public function index()
    {
        $menu = "home";
        $title = "Home";
        return view('index', compact('menu', 'title'));
    }

    public function register()
    {
        $menu = "register";
        $title = "Register";
        return view('register', compact('menu', 'title'));
    }

    public function login()
    {
        $menu = "login";
        $title = "Login";
        return view('login', compact('menu', 'title'));
    }
}
