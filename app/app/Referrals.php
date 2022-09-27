<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Referrals extends Model
{
    //

    protected $table = "agent_referrals";

    protected $fillables = [
        'agent_id', 'user_id',
    ];
}
