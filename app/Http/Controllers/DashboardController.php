<?php

namespace App\Http\Controllers;

use App\Models\Transation;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\Admin;
use App\Models\User;
use Carbon\Carbon;

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

        $user=User::findOrFail($id);
        

        if ($user->blance > $request->ammount){
            
            $fee=$this->calculateWithdrawFee($request->ammount);
            $totalAmmount=$request->ammount + $fee;

            // if ($user->ammount > $totalAmmount) {
            //     // return response()->json(['message' => 'Insufficient balance'], 400);
            //     return redirect()->route('admin.withdraw')->with('success','Insufficient balance');

            // }

            Transation::create([
                'user_id'=>$id,
                'ammount'=>$request->ammount,
                'transation_type'=>$request->transation_type,
                'Withdraw_date'=>$request->date,
                'fee'=>$fee,
            ]);
            $user->update([
                'blance'=>$user->blance - $totalAmmount,
            ]);

            return redirect()->route('admin.withdraw')->with('success','Withdraw Success Fully');
        }else{
             return redirect()->route('admin.withdraw')->with('success','Insufficient balance');
        }
    }

    private function calculateWithdrawFee($ammount){
        $user=Auth::user();
        $fee=0;
        $today= Carbon::now();
        $monthStart=$today->copy()->startOfMonth();

        $monthlyWithdraw = Transation::where('user_id', $user->id)
            ->where('transation_type', 'withdraw')
            ->whereBetween('withdraw_date', [$monthStart, $today])
            ->sum('ammount');

        if($user->account_type =='individual'){
            if($today->isFriday()){
                return 0;
            }
            if($ammount <= 1000){
                return 0;
            }else{
                $ammount -=1000;
            }
            if($monthlyWithdraw <= 5000){
                $feeAmmount=max(0,$monthlyWithdraw + $ammount - 5000);
            }else{
                $feeAmmount=$ammount;
            }
            
            return $fee =$feeAmmount * 0.015;
        }else{
            if($user->account_type =='busuness'){
                if($monthlyWithdraw <= 5000){
                    $fee= $ammount * 0.015;
                }elseif($monthlyWithdraw == 50000){
                    $fee= $ammount * 0.015;
                }
                else{
                    $fee= $ammount * 0.025;
                }
                
            }
          return $fee;
        }
    }
}
