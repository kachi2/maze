<?php

namespace App;

use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;


class Agent extends Authenticatable
{
    //

    protected $hidden = [
        'password', 'remember_token',
    ];
    use Notifiable;

    protected $guard = "agent";

    protected $fillable = [
        'name', 'email', 'password', 'phone', 'city', 'state', 'country', 'working_hours', 'pay_day', 'email_verify', 'last_login', 'login_ip', 'is_accepted', 'doc', 'login_counts', 'address', 'wallet_address', 'payment_method'
    ];

    protected $table = "agents";

    public function wallets(){
        return $this->hasOne(AgentWallet::class, 'agent_id', 'id');
    }
}
