<?php

namespace App\Http\Controllers;

use App\Models\Transation;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\Admin;
use App\Models\User;

class DashboardController extends Controller
{
     public function dashboard(){
        
        $trangsion=Transation::where('user_id',Auth::user()->id)->count();
        $allTrangsion=Transation::where('user_id',Auth::user()->id)->with('adminName')->get();
        return view('admin.dashboard',compact('trangsion','allTrangsion'));
    }

    public function deposit(){
        // dd(Auth::user()->id);
        $allDeposit=Transation::Where('transation_type','deposit')->Where('user_id',Auth::user()->id)
        ->get();

        return view('admin.deposit',compact('allDeposit'));
    }

    function depositUrl(){
        return view('admin.add-deposit');
    }
    function addDeposit(Request $request, $id){
        $request->validate([
            'ammount'=>['required','numeric'],
            'date'=>['required'],
            'transation_type'=>['required'],
        ]);
        Transation::create([
            'user_id'=>$id,
            'ammount'=>$request->ammount,
            'transation_type'=>$request->transation_type,
            'Withdraw_date'=>$request->date
        ]);
        $admin=User::findOrFail($id);
      
        User::findOrFail($id)->update([
            'blance'=>$admin->blance + $request->ammount,
        ]);
        return back()->with('success','Deposit Added Success Fully');
    }
    function getWithdraw(){
        // $tran=Transation::get();
        // dd(Auth::user());
        $withdraw=Transation::where('user_id',Auth::user()->id)->where('transation_type','withdraw')->get();
        return view('admin.withdrawal',compact('withdraw'));

    }
    public function withdrawUrl(){
        return view('admin.add-withdraw');
    }

    public function addWithdraw(Request $request, $id){
        $request->validate([
            'ammount'=>['required','numeric'],
            'date'=>['required'],
            'transation_type'=>['required'],
        ]);
        Transation::create([
            'user_id'=>$id,
            'ammount'=>$request->ammount,
            'transation_type'=>$request->transation_type,
            'Withdraw_date'=>$request->date
        ]);
        $admin=User::findOrFail($id);
      
        User::findOrFail($id)->update([
            'blance'=>$admin->blance - $request->ammount,
        ]);
        return back()->with('success','Deposit Added Success Fully');
    }
}
