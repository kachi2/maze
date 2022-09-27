<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Payment extends Model
{
    //
    protected $table = "agent_payments";

    protected $fillabls = ['agent_id', 'amount', 'status', 'payment_method', 'wallet_address', 'is_approved'];
}
