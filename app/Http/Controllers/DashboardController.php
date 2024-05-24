<?php

namespace App\Http\Controllers;

use App\Models\Transation;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\Admin;

class DashboardController extends Controller
{
     public function dashboard(){
        
        $trangsion=Transation::where('admin_id',Auth::guard('admin')->user()->id)->count();
        $allTrangsion=Transation::where('admin_id',Auth::guard('admin')->user()->id)->with('adminName')->get();
        return view('admin.dashboard',compact('trangsion','allTrangsion'));
    }
}
