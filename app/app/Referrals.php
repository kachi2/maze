<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Referrals extends Model
{
    //

    protected $table = "agent_referrals";

    protected $fillable = [
        'agent_id', 'user_id','status','bonus'
    ];

    public function user(){
        return $this->belongsTo(User::class, 'user_id', 'id');
    }

    public function activeUsers(){
        return $this->belongsTo(User::class,'user_id', 'id')
            ->where('status', 'active')
            ->orderBy('created_at', 'desc')
            ->limit(20);
    }

    public function referal(){
        return $this->belongsTo(Agent::class, 'agent_id', 'id');
    }
}
