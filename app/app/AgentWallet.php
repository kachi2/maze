<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class AgentWallet extends Model
{
    //

    protected $table = "agent_wallets";
    protected $fillable = [

        'agent_id', 'payments', 'salary_paid', 'salary_pending'
    ];
}
