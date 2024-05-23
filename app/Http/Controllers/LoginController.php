<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class LoginController extends Controller
{
    public function login(){
        return view('admin.login');
    }
    public function register(){
        return view('admin.register');
    }
    public function user_register(Request $request){
        return $request->all();
    }
   
}
