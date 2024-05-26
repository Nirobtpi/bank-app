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
        // return "Okk";
        $request->validate([
            'ammount'=>['required','numeric'],
            'date'=>['required'],
            'transation_type'=>['required'],
        ]);
    //    return $date=date('D',strtotime($request->date));
        // Every Friday withdrawal is free of charge 
        $ten=Transation::where('transation_type','withdraw')->where('user_id',Auth::user()->id)->count();
        if($request->ammount < Auth::user()->blance){
            
            if(date('m') == date('m',strtotime($request->date)) AND $ten <0){
                return 'Ok';
                if($request->ammount >= 5000){
                    // return 'Ok';
                    Transation::create([
                        'user_id'=>$id,
                        'ammount'=>$request->ammount,
                        'transation_type'=>$request->transation_type,
                        'Withdraw_date'=>$request->date,
                    ]);
                    $admin=User::findOrFail($id);
            
                    User::findOrFail($id)->update([
                        'blance'=>$admin->blance - $request->ammount,
                    ]);
                }
                return back()->with('success','Withdraw Success Fully');
            }

            if('Friday' == date('D',strtotime($request->date))){
                Transation::create([
                    'user_id'=>$id,
                    'ammount'=>$request->ammount,
                    'transation_type'=>$request->transation_type,
                    'Withdraw_date'=>$request->date,
                ]);
                $admin=User::findOrFail($id);
        
                User::findOrFail($id)->update([
                    'blance'=>$admin->blance - $request->ammount,
                ]);
            }

            if(Auth::user()->account_type == 'individual'){
            
                $totalFee=$request->ammount * 0.015;
                $totalAmmount=$request->ammount + $totalFee;

                Transation::create([
                    'user_id'=>$id,
                    'ammount'=>$request->ammount,
                    'transation_type'=>$request->transation_type,
                    'Withdraw_date'=>$request->date,
                    'fee'=>$totalFee,
                ]);
                $admin=User::findOrFail($id);
        
                User::findOrFail($id)->update([
                    'blance'=>$admin->blance - $totalAmmount,
                ]);
            }
            

            if(Auth::user()->account_type == 'busuness'){
            
                $totalFee=$request->ammount * 0.025;
                $totalAmmount=$request->ammount + $totalFee;

                Transation::create([
                    'user_id'=>$id,
                    'ammount'=>$request->ammount,
                    'transation_type'=>$request->transation_type,
                    'Withdraw_date'=>$request->date,
                    'fee'=>$totalFee,
                ]);
                $admin=User::findOrFail($id);
        
                User::findOrFail($id)->update([
                    'blance'=>$admin->blance - $totalAmmount,
                ]);
            }
            return back()->with('success','Withdraw Success Fully');
        }else{
            return back()->with('success','INSUFFEINCENT BLANCE');
        }
       
        
        
    }
}
