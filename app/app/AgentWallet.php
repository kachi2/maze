<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class AgentWallet extends Model
{
    
    protected $table = "agent_wallets";
    protected $fillable = [

        'agent_id', 'payments', 'salary_paid', 'salary_pending'
    ];


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
