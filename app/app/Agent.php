<?php

namespace App;

use App\Models\Deposit;
use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;

class Agent  extends Authenticatable implements MustVerifyEmail
{
    use Notifiable;
    

    protected $fillable = ['ref_code', 'name', 'email', 'password', 'remember_token', 'phone', 'city', 'state', 'country', 'working_hours', 'pay_day', 'email_verify', 'doc', 'address', 'wallet_address', 'payment_method', 'next_pay', 'prev_balance', 'avail_balance', 'total', 'is_accepted', 'is_admin', 'last_login', 'login_counts', 'login_ip'];


    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'password', 'remember_token',
    ];

    /**
     * The attributes that should be cast to native types.
     *
     * @var array
     */
    protected $casts = [
        'email_verified_at' => 'datetime',
        'is_admin' => 'bool'
    ];


    public function wallets(){
        return $this->hasOne(AgentWallet::class, 'agent_id', 'id');
    }
    public function Ref(){
        return $this->hasMany(Referrals::class);
    }
    public function referred(){
        return $this->hasMany(Referrals::class);
    }

    public function userAgent(){
        return $this->hasMany(User::class, 'ref_code', 'ref_code');
    }


    
    public function levelBonus($agent){
        $stage = CampaignStage::where('agent_id', $agent->id)->first();
        if(!empty($stage)){
            $bonus = AffiliateCampaign::where('id', $stage->campaign_id)->first();
            return $bonus;
        }else{
           CampaignStage::create(['agent_id' => $agent->id, 'campaign_id' => 1, 'referral' => 0, 'commission' => 10]); 
           $stage = CampaignStage::where('agent_id', $agent->id)->first();
           $bonus = AffiliateCampaign::where('id', $stage->campaign_id)->first();
         return  $bonus;

        }
    }

    


    public function affiliateCommision($agent, $user, $reason){
        $agents = AffiliateCommission::whereId($agent->id)->latest()->first();
        $bonus = $this->levelBonus($agent);
      AffiliateCommission::create([
            'agent_id' => $agent->id,
            'user_id' => $user->id,
            'amount' => $bonus->reg_comm,
            'float_balance' => $agents->float_balance,
            'avail_balance' => $bonus->reg_comm+ $agents->float_balance,
            'source' => $reason
      ]);

     $data = (new AgentWallet)->AddBonus($agent, $bonus->reg_comm);
      return $data;
    }

    public function InvesmentCommision($agent, $user, $reason, $Cal_amount){
        $agents = AffiliateCommission::whereId($agent->id)->latest()->first();
      AffiliateCommission::create([
            'agent_id' => $agent->id,
            'user_id' => $user->id,
            'amount' => $Cal_amount,
            'float_balance' => $Cal_amount,
            'avail_balance' => $Cal_amount + $agents->float_balance,
            'source' => $reason
      ]);

     $data = (new AgentWallet)->AddBonus($agent, $Cal_amount);
      return $data;
    }

    // public function ReferralCount($agent){
    //     $agents = AffiliateReferrals::where('agent_id', $agent->id)->first();
    //     if(!$agents){
    //        $agents = AffiliateReferrals::create([
    //             'agent_id' => $agent->id,
    //             'total_referrals' => 1,
    //             'traded_referrals' => 0,
    //             'active_referrals' => 1,
    //             'inactive_referrals' => 0
    //         ]);
    //     }else{
    //         $agents->total_referrals  = ($agents->total_referrals + 1);
    //         $agents->active_referrals = ($agents->active_referrals + 1);
    //         $agents->save();
    //     }
    //     return $agents;
    // }

}
