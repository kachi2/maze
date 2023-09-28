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
        $agents = (new AgentWallet)->whereAgentId($agent->id)->first();
        if(!$agents){
            $data =  AgentWallet::create([
                'agent_id' => $agent->id,
                'payments' => $amount,
                'salary_paid' => 0,
                'salary_pending' => 0
            ]);
        }else{
           $data =  $agents->update([
                'payments' =>  $agents->payments + $amount, 
                'salary_paid' => $agents->salary_paid,
                'salary_pending' => $agents->salary_pending
            ]);
        } 
    return $data;
    }

}
