<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class AgentReferral extends Model
{
    //

    protected $table = 'agent_referrals';
    protected $fillable = ['agent_id', 'bonus', 'user_id', 'status'];


    public function user(){
        return $this->hasOne(User::class, 'id', 'user_id');
    }
}
