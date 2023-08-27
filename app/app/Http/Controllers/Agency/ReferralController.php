<?php

namespace App\Http\Controllers\Agency;

use App\Http\Controllers\Controller;
use App\Agent;
use App\AgentWallet;
use App\CampaignStage;
use App\User;
use App\AgentReferral;
use App\AffiliateCampaign;
use App\AffiliateCommission;
use App\AffiliateReferrals;
use App\Models\Deposit;
use App\Referrals;
use Carbon\Carbon;

class ReferralController extends Controller
{

    public function Index(){
    $data['total_referrals'] = Referrals::where('agent_id', agent_user()->id)->get();
    $data['refer_weekly'] = Referrals::where(['agent_id' => agent_user()->id, ['created_at', '>=', Carbon::now()->addDays(-7)]])->get();
    $data['active_referrals'] = User::where(['ref_code' => agent_user()->ref_code, 'status' => '0'])->get();
    $data['referrals'] = AgentReferral::where(['agent_id' => agent_user()->id])->get();
    $data['refs'] = AffiliateReferrals::where('agent_id', agent_user()->id)->first();
    $data['campaign'] = CampaignStage::where(['agent_id' => agent_user()->id, 'status' => 1])->first();
    $data['campaigns'] = CampaignStage::where(['agent_id' => agent_user()->id])->get();
    $data['commission'] = AffiliateCommission::whereAgentId(agent_user()->id)->latest()->get();
    $data['wallet'] = AgentWallet::where('agent_id', agent_user()->id)->first();
    return view('agency.referral', $data);
    }

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
