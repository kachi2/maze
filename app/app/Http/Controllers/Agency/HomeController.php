<?php

namespace App\Http\Controllers\Agency;

use App\AffiliateCampaign;
use App\AffiliateCommission;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Agent;
use App\User;
use App\AgentActivity;
use App\Payment;
use App\AgentReferral;
use App\Referrals;
use App\AgentTask;
use Illuminate\Support\Facades\Session;
use App\AgentWallet;
use App\CampaignStage;
use Illuminate\Support\Facades\Validator;
use App\Salary;
use Carbon\Carbon;
use App\AgentSalary;
use Illuminate\Support\Facades\Hash;

class HomeController extends Controller
{

        //
        public function __construct()
    {
        
        return $this->middleware('agentMiddleware');
    }

        public function Index(){
            $date = Carbon::now()->addDays(-30);
            $agent  = Agent::where('id', auth('agent')->user()->id)->first();
                if($agent->ref_code == null){   
                    $agent->update(['ref_code' => $this->generateRefCode()]);
                }
            $data['agent'] = Agent::where('id', auth('agent')->user()->id)->first();
            $data['referrals'] = User::where(['referral_id' => agent_user()->ref_code])->get();
            $data['referral'] = User::where('referral_id', agent_user()->ref_code)->where('created_at', '>', $date)->get();
            $data['campaign'] = CampaignStage::where(['agent_id' => agent_user()->id, 'status' => 1])->first();
            $data['campaigns'] = CampaignStage::where(['agent_id' => agent_user()->id])->get();
            $data['commission'] = AffiliateCommission::whereAgentId(agent_user()->id)->latest()->get();
            $data['wallet'] = AgentWallet::where('agent_id', agent_user()->id)->first();
            $data['activities'] = AgentActivity::where('agent_id', agent_user()->id)->latest()->take(6)->get();
            // dd($data);
            return view('agency.home', $data);
        }

        public function Commissions(){
            $data['agent'] = Agent::where('id', auth('agent')->user()->id)->first();
            $data['campaign'] = CampaignStage::where(['agent_id' => agent_user()->id, 'status' => 1])->first();
            $data['campaigns'] = CampaignStage::where(['agent_id' => agent_user()->id])->get();
            $data['wallet'] = AgentWallet::where('agent_id', agent_user()->id)->first();
            $data['commission'] = AffiliateCommission::whereAgentId(agent_user()->id)->latest()->get();
            return view('agency.commissions', $data);
        }
    
        public function Payments(){
            return view('agency.payments')
            ->with('payments', AgentSalary::where('agent_id', agent_user()->id)->latest()->get());
        }
    
    
        public function PaymentsInvoice(Request $request){
    
            $valid = Validator::make($request->all(), [
                'amount' => 'required',
            ]);
            if($valid->fails()){
                Session::flash('alert', 'error');
                Session::flash('msg', $valid->errors()->first());
                return back();
            }
            if(!agent_user()->wallet_address){
                Session::flash('alert', 'error');
                Session::flash('msg', "Please update your payment Wallet Address"."<br>"."Got to your Account Section to update");
                return back();
            }
            if($request->amount < 50){
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
            #======deduct agent fund ========
           $wallet = AgentWallet::where('agent_id', agent_user()->id)->first();
    
           $addToPending = $wallet->salary_pending + $request->amount;
           $removeWallet = $wallet->payments - $request->amount;
           $wallet->update([
            'salary_pending' => $addToPending,
            'payments' => $removeWallet
           ]);
    
            $ref = generate_reference();
            $salary = new AgentSalary;
            $salary->ref = $ref;
            $salary->agent_id = agent_user()->id;
            $salary->amount = $request->amount;
            $salary->total = $request->amount - ($request->amount * 0.075);
            $salary->payment_method = $request->payment_method;
            $salary->wallet_address = $request->wallet_address;
            $salary->prev_balance = $wallet->payments;
            $salary->avail_balance = $removeWallet;
            $salary->is_approved = 0;
            $salary->next_pay = Carbon::now()->addDays(14);
    
            if($salary->save()){
                Session::flash('alert', 'success');
                Session::flash('msg', 'Invoice Generated Successfully');
                return redirect()->back();
            }
    
        }
    
        public function PaymentsInvoices($id){
            $salary = AgentSalary::where('id', decrypt($id))->first();
            return view('agency.invoice', compact('salary', $salary));
        }
    

public function Account(){
    return view('agency.accounts');
}


    public function UpdateAccount(Request $request){

        $user = Agent::where('id', agent_user()->id)->first();
        if($request->name){
            $data['name'] = $request->name;
        }
        if($request->name){
            $data['city'] = $request->city;
        }
        if($request->name){
            $data['state'] = $request->state;
        }
        if($request->name){
            $data['country'] = $request->country;
        }
        if($request->name){
            $data['payment_method'] = strtoupper($request->payment_method);
        }
        if($request->name){
            $data['wallet_address'] = $request->wallet_address;
        }
        if($request->image){
            $image = request()->file('image');
            $ext = $image->getClientOriginalExtension();
            $file = md5(time()).'.'.$ext;
            $image->move('images', $file);
            $data['img'] = $file;
        }
      $update = $user->update($data);
      if($update){
        Session::flash('alert', 'success');
        Session::flash('msg', 'Account information updated successfully');
        return redirect()->back();
      }

    }


    public function UpdatePassword(Request $request){

        $valid = validator::make($request->all(), [

            'old_password' => 'required',
            'password' => 'required|confirmed'
        ]);
        if($valid->fails()){

            Session::flash('alert', 'error');
            Session::flash('msg', $valid->errors()->first());
            return back();
        }

        $agent = Agent::where('id', agent_user()->id)->first();
        //check old password 
        if(Hash::check($request->old_password,$agent->password)){
            $pwd = bcrypt($request->password);
            $agent->update( array( 'password' =>  $pwd));
            Session::flash('alert', 'success');
            Session::flash('msg', 'Password Updated Successfully');
            return back();
        }else{
            Session::flash('alert', 'error');
            Session::flash('msg', 'Old Password is not correct');
            return back();

        }
    }
public function logout(Request $request){
    Auth::guard('agent')->logout();
    $request->session()->flush();    
    return redirect()->route('Agent-login');            
        } 

        public function generateRefCode(){
            $code = substr(md5(uniqid(time())),0,10);
            return $code;
        }
}

