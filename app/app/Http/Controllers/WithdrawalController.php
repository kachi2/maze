<?php

namespace App\Http\Controllers;

use App\Models\Withdrawal;
use Illuminate\Support\Facades\Session;
use App\WithdrawalAccount;
use Illuminate\Http\Request;

class WithdrawalController extends Controller
{
    //

    public function addWithdrawals(Request $req){

      //  dd($req->all());
         $this->validate($req, [
            'account_type' => 'required',
            'address' => 'required',
            'payment_method' => 'required'
        ]);

        $withdraw = new WithdrawalAccount;
        $withdraw->user_id = auth_user()->id;
        $withdraw->type = $req->account_type;
        $withdraw->address = $req->address;
        $withdraw->currency = $req->payment_method;

        if($withdraw->save()){
            Session::flash('alerts', 'success');
            Session::flash('msg', 'Withdrawal Account Added successfully.');
            return back();
        };

        return back();
    }

    public function DeleteAddress($id){

        $adr = WithdrawalAccount::where('id', decrypt($id))->first();
        if($adr){
            $adr->delete();
            Session::flash('alerts', 'success');
            Session::flash('msg', 'Withdrawal Account Deleted Successfully.');
            return back();   
        }
        return back();
    }
}
