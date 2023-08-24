<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Payment extends Model
{
    //

    protected $table = "payments";

    protected $fillabls = ['agent_id', 'amount', 'status', 'payment_method', 'wallet_address', 'is_approved'];


    public function agent(){
        return $this->belongsTo(Agent::class);
    }
}
