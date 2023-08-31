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
        $stage = CampaignStage::where('agent_id', $agent)->first();
        if($stage->exist()){
            return  $stage->campaign->commission;
        }else{
           CampaignStage::create(['agent_id' => $agent, 'campaign_id' => 1, 'referral' => 0, 'commission' => 10]); 
         return  10;

        }
    }


    public function affiliateCommision($agent, $user, $reason){
        $agent = Agent::whereId($agent)->first();
      return  AffiliateCommission::create([
            'agent_id' => $agent,
            'user_id' => $user,
            'amount' => $this->levelBonus($agent),
            'float_balance' => $agent->float_balance,
            'avail_balance' => $this->levelBonus($agent) + $agent->float_balance,
            'source' => $reason
      ]);

      (new AgentWallet)->AddBonus($agent, $this->levelBonus($agent));
    }

    public function AddBonus($agent, $amount){
        $agent = (new AgentWallet)->whereAgentId($agent)->first();
        if(!$agent){
            AgentWallet::create([
                'agent_id' => $agent,
                'payments' => 0,
                'salary_paid' => 0,
                'salary_pending' => 0
            ]);
        }else{
            $agent->update([
                'payment' =>  $agent->payment + $amount, 
                'salary_paid' => $agent->salary_paid,
                'salary_pending' => $agent->salary_pending
            ]);
        } 
    }


}
