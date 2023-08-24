<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class AgentSalary extends Model
{
    protected $table = "agent_salaries";
    
    protected $fillable = ['agent_id', 'amount', 'status', 'payment_method', 'wallet_address', 'is_approved', 'avail_balance', 'prev_balance', 'total', 'next_pay'];

    public function agent(){
        return $this->belongsTo(Agent::class, 'agent_id', 'id');
    }
}
