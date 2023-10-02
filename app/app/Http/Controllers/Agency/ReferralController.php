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
use Illuminate\Support\Facades\Auth;

class ReferralController extends Controller
{

    public function __construct()
    {
        
        return $this->middleware('agentMiddleware');
    }
    

    public function Index(){
    $data['refer_weekly'] = User::where(['referral_id' => agent_user()->ref_code, ['created_at', '>=', Carbon::now()->addDays(-7)]])->get();
    $data['active_referrals'] = User::where(['referral_id' => agent_user()->ref_code, 'status' => '0'])->get();
    $data['referrals'] = User::where(['referral_id' => agent_user()->ref_code])->get();
    $data['campaign'] = CampaignStage::where(['agent_id' => agent_user()->id, 'status' => 1])->first();
    $data['commission'] = AffiliateCommission::whereAgentId(agent_user()->id)->latest()->get();
    $data['wallet'] = AgentWallet::where('agent_id', agent_user()->id)->first();
    return view('agency.referral', $data);
    }

     public function AgentReferral(){
        $agent  = Agent::where('id', auth('agent')->user()->id)->first();
        if($agent->ref_code == null){   
            $agent->update(['ref_code' => $this->generateRefCode()]);
        }
        $referals = AgentReferral::where('agent_id', auth('agent')->user()->id)->get();
     
        $pending = AgentReferral::where(['agent_id' => auth('agent')->user()->id, 'status' => 0])->get();
        return view('agency.referral', compact('referals', $referals, 'pending',$pending));
        }

        public function generateRefCode(){
            $code = substr(md5(uniqid(time())),0,10);
            return $code;
        }

        public function ClaimBonus($id){
            $ref = AgentReferral::where(['agent_id' => auth('agent')->user()->id, 'id' => decrypt($id)])->first();
            $bonus = ($ref->user->deposit[0]->amount*5)/100;
            $ref->update(['status' => 1, 'bonus' =>  $bonus]);
            $agentWallet = AgentWallet::where('agent_id', auth('agent')->user()->id)->first();
            $agentWallet->update([
             'payments' => $agentWallet->payments +  $bonus
            ]);
            return back();
        }
}
