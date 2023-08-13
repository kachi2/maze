<?php

namespace App\Http\Controllers\Affiliate;

use AgentPayment;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Agent;
use App\AgentActivity;
use App\Payment;
use App\Referrals;
use App\AgentTask;
use Illuminate\Support\Facades\Session;
use App\AgentWallet;
use Illuminate\Support\Facades\Validator;
use App\AgentSalary;
use Carbon\Carbon;


class HomeController extends Controller
{
    //

    public function Index(){
   
        $date = Carbon::now()->addDays(-14);
        $data['agent'] = Agent::where('id', agent_user()->id)->first();
        $data['referrals'] = Referrals::where('agent_id', agent_user()->id)->get();
        $data['referral'] = Referrals::where('agent_id', agent_user()->id)->where('created_at', '>', $date)->get();
        $data['payments'] = Payment::where('agent_id', agent_user()->id)->latest()->get();
        $data['payment'] = Payment::where('agent_id', agent_user()->id)->where('created_at', '>', $date)->get();
        $data['wallet'] = AgentWallet::where('agent_id', agent_user()->id)->first();
        $data['task'] = AgentTask::where('agent_id', agent_user()->id)->latest()->get();
        $data['completed_task'] = AgentTask::where(['agent_id' => agent_user()->id])->where('completion', '=', '100')->where('created_at', '>', $date)->get();
        $data['activity'] = AgentActivity::where('agent_id', agent_user()->id)->where('created_at', '>', $date)->latest()->get();
        $data['activities'] = AgentActivity::where('agent_id', agent_user()->id)->latest()->take(6)->get();
       // $data['next_AgentSalary'] = AgentSalary::where('agent_id', agent_user()->id)->latest()->first();
        return view('agency.home', $data);
    }

    public function Task(){
        return view('agency.task')
        ->with('tasks', AgentTask::where('agent_id', agent_user()->id)->get());
    }

    public function Payments(){
        return view('agency.payments')
        ->with('payments', Payment::where('agent_id', agent_user()->id)->latest()->get());
    }

    public function AgentSalaryPayments(){
        return view('agency.AgentSalary')
        ->with('payments', AgentSalary::where('agent_id', agent_user()->id)->get());
    }

    public function AgentSalaryInvoice(Request $request){

        $valid = Validator::make($request->all(), [
            'amount' => 'required',
            'payment_method' => 'required',
            'wallet_address' => 'required'
        ]);
        if($valid->fails()){
            Session::flash('alert', 'error');
            Session::flash('msg', $valid->errors()->first());
            return back();
        }

        if($request->amount < 500){
            Session::flash('alert', 'error');
            Session::flash('msg', "Amount should not be less than $500");
            return back();
        }

        $agentWallet = agent_user()->wallets->payments;
        if($agentWallet < $request->amount){
            Session::flash('alert', 'error');
            Session::flash('msg', "Amount is greater than your Available Balance");
            return back();
        }
        $payment = AgentSalary::where('agent_id', agent_user()->id)->latest()->first();
        $now = Carbon::now();
        if($payment->pay_day > $now){
        
            Session::flash('alert', 'error');
            Session::flash('msg', "Your next payment is on ". Date("M,d", strtotime($payment->next_pay)));
            return back();
        }

        #======deduct agent fund ========
       $wallet = AgentWallet::where('agent_id', agent_user()->id)->first();

       $addToPending = $wallet->AgentSalary_pending + $request->amount;
       $removeWallet = $wallet->payments - $request->amount;
       $wallet->update([
        'AgentSalary_pending' => $addToPending,
        'payments' => $removeWallet
       ]);

        $ref = generate_reference();
        $AgentSalary = new AgentSalary;
        $AgentSalary->ref = $ref;
        $AgentSalary->agent_id = agent_user()->id;
        $AgentSalary->amount = $request->amount;
        $AgentSalary->total = $request->amount - ($request->amount * 0.075);
        $AgentSalary->payment_method = $request->payment_method;
        $AgentSalary->wallet_address = $request->wallet_address;
        $AgentSalary->prev_balance = $wallet->payments;
        $AgentSalary->avail_balance = $removeWallet;
        $AgentSalary->is_approved = 0;
        $AgentSalary->next_pay = Carbon::now()->addDays(14);

        if($AgentSalary->save()){
            Session::flash('alert', 'success');
            Session::flash('msg', 'Invoice Generated Successfully');
            return redirect()->back();
        }

    }

    public function AgentSalaryInvoices($id){
        $AgentSalary = AgentSalary::where('id', decrypt($id))->first();
        return view('agency.invoice', compact('AgentSalary', $AgentSalary));
    }

    public function paymentProcessor(){
        $ref = generate_reference();
        $payment = new Payment;
        $payment->agent_id = agent_user()->id;
        $payment->amount = 20;
        $payment->ref = $ref;
        $payment->status = 'success';
        if($payment->save()){
        $wallet = AgentWallet::where('agent_id', agent_user()->id)->first();
        $wallet->update(['payments' => $wallet->payments + 20]);
        Session::flash('alert', 'success');
        Session::flash('msg', 'Payment Proccessed Successfully');
        return redirect()->back();
        }
    }

    public function AgentReferral(){

        return view('agency.referral');
    }
}
