<?php

namespace App\Http\Controllers\Agency;

use App\Http\Controllers\Controller;
use App\Agent;
use App\AgentWallet;
use App\Referrals;
class ReferralController extends Controller
{
     public function AgentReferral(){
        if(auth('agent')->user()->ref_code == null){
            $user = Agent::where('id', auth('agent')->user()->id)
            ->update(['ref_code' => $this->generateRefCode()]);
        }
        $referals = Referrals::where('agent_id', auth('agent')->user()->id)->get();
     
        $pending = Referrals::where(['agent_id' => auth('agent')->user()->id, 'status' => 0])->get();
        return view('agency.referral', compact('referals', $referals, 'pending',$pending));
        }

        public function generateRefCode(){
            $code = substr(md5(uniqid(time())),0,10);
            return $code;
        }

        public function ClaimBonus($id){
            $ref = Referrals::where(['agent_id' => auth('agent')->user()->id, 'id' => decrypt($id)])->first();
            $bonus = ($ref->user->deposit[0]->amount*5)/100;
            $ref->update(['status' => 1, 'bonus' =>  $bonus]);
            $agentWallet = AgentWallet::where('agent_id', auth('agent')->user()->id)->first();
            $agentWallet->update([
             'payments' => $agentWallet->payments +  $bonus
            ]);
            return back();
        }
}
