<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Admin;
use App\Models\User;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;

class LoginController extends Controller
{
    public function login(){
        return view('admin.login');
    }
    public function register(){
        return view('admin.register');
    }
    public function user_register(Request $request){
        // $current= date('6',strtotime('m'));
        // $us=date('6',strtotime('m'));
        // $withdrow=5000;
        // if($current == $us){
        //     if($withdrow >= 5000){
        //         return "ok";
        //     }else{
        //         return "no";
        //     }
        // }
        $request->validate([
            'name'=>['required'],
            'email'=>['required','unique:admins,email,','min:8'],
            'password'=>['required','confirmed'],
            'account_type'=>['required'],
            'blance'=>['required','numeric'],
        ]);
        User::create([
            'name'=>$request->name,
            'email'=>$request->email,
            'account_type'=>$request->account_type,
            'blance'=>$request->blance,
            'password'=>Hash::make($request->password),
            
        ]);
        return back()->with('success','Account Create Successfully!');
    }

    public function user_login(Request $request){
        // return $request->all();
        
        $request->validate([
            'email'=>['required'],
            'password'=>['required'],
        ]);

        if(Auth::attempt(['email'=>$request->email,'password'=>$request->password ])){
            
            return redirect ('admin/dashboard');
          
        }else{
            return back()->with('error','User Name Or Password Is Wrong');
        }
        
    }
    public function logout(){
        Auth::logout();
        return redirect('/');
    }
   
}
