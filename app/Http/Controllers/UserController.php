<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class UserController extends Controller
{
    //
    public function index(Request $request){
        if (!Auth::check()){
            return redirect("/user/login");
        }

        return view('index');
    }

    public function loginPage(Request $request){

        return view('login')
            ->with('failed', 0);
    }

    public function login(Request $request){

        return view('welcome');

        return view('login')
            ->with('failed', 1);
    }

    public function registerPage(Request $request){

        return view('register');
    }

    public function register(Request $request){

        return redirect('/user/login');
    }
}
